<?php
App::uses('AppController', 'Controller');
/**
 * CarDetails Controller
 *
 * @property CarDetail $CarDetail
 * @property PaginatorComponent $Paginator
 */
class CarDetailsController extends AppController {

/**
 * Components
 *
 * @var array
 */
public $components = array('Paginator');

/**
* beforefilter method
*
* @return void
*/
public function beforeFilter()
{
    parent::beforeFilter();
    $this->_checkLogin();
}

/**
* index method
*
* @return void
*/
public function index($all = null) {
    $conditions = array();
    if ($all == "all") {
        $this->Session->write('CarDetailSearch', '');
    }
    $voucher = ($all == 'voucher'?'voucher':'');
    if (empty($this->request->data['CarDetail']) && $this->Session->read('CarDetailSearch')) {
        $this->request->data['CarDetail'] = $this->Session->read('CarDetailSearch');
    }
    if (!empty($this->request->data['CarDetail'])) {
        $this->request->data['CarDetail'] = array_filter($this->request->data['CarDetail']);
        $this->request->data['CarDetail'] = array_map('trim', $this->request->data['CarDetail']);
        if (!empty($this->request->data)) {
            if (isset($this->request->data['CarDetail']['first_name'])) {
                $conditions['CarDetail.first_name LIKE '] = '%' . $this->request->data['CarDetail']['first_name'] . '%';
            }
            if (isset($this->request->data['CarDetail']['last_name'])) {
                $conditions['CarDetail.last_name LIKE '] = '%' . $this->request->data['CarDetail']['last_name'] . '%';
            }
            if (isset($this->request->data['CarDetail']['name'])) {
                $conditions['CarDetail.name LIKE '] = '%' . $this->request->data['CarDetail']['name'] . '%';
            }
            if (isset($this->request->data['CarDetail']['email'])) {
                $conditions['CarDetail.email LIKE '] = '%' . $this->request->data['CarDetail']['email'] . '%';
            }
            if (isset($this->request->data['CarDetail']['status'])) {
                $conditions['CarDetail.status'] = $this->request->data['CarDetail']['status'];
            }
        }
        $this->Session->write('CarDetailSearch', $this->request->data['CarDetail']);
    }
    $this->AutoPaginate->setPaginate(array(
        'order' => ' CarDetail.id DESC',
        'conditions' => $conditions
    ));
    $this->loadModel('CarDetail');
    $this->set('voucher', $voucher);
    $this->set('carDetails', $this->paginate('CarDetail'));

}

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function view($id = null,$voucher = '') {
    if (!$this->CarDetail->exists($id)) {
        $this->Message->setWarning(__('Invalid car detail'),array('action'=>'index'));
    }
    $options = array('conditions' => array('CarDetail.' . $this->CarDetail->primaryKey => $id));
    $this->set('voucher', $voucher);
    $this->set('carDetail', $this->CarDetail->find('first', $options));
}

/**
* add method
*
* @return void
*/
public function add() {
    $this->loadModel('GstParameter');
    $this->loadModel("State");
    $this->loadModel("City");
    $states = $this->State->find('list');    
    $cities = $this->City->find('list');    
    $gst_value = $this->GstParameter->findByName('bus');
    $config_gst = $gst_value['GstParameter']['value'];
    if ($this->request->is('post')) {
        $payment_gst = (int)get_gst_amount($this->request->data['CarDetail']['price'],$config_gst);
        $this->request->data['CarDetail']['payment_with_gst'] = $payment_gst;
        if($this->request->data['CarDetail']['payment_received'] > $this->request->data['CarDetail']['payment_with_gst']){
            $this->Message->setWarning(__('Please enter valid payment detail,payment received is more than total payment.'));
            return $this->redirect(Router::url( $this->referer(), true ));
        }
        $this->CarDetail->create();
        $this->request->data['CarDetail']['invoice_no'] = $invoice_no = $this->get_invoice_no();
        if ($this->CarDetail->save($this->request->data)) {

        $voucher['all_t_and_c'] = $voucher['booking_id'] = '';
        $voucher['company_signature'] = Configure::read('Site.Name');
        $tour_types = Configure::read('tour_types');
        $gst_percent = $voucher['gst_percent'] = $config_gst;    
        $this->loadModel("Customer");$this->loadModel("Tour");$this->loadModel("Account");
        $options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $this->request->data['CarDetail']['customer_id']));
        $customer_data = $this->Customer->find('first', $options);
        $toptions = array('conditions' => array('Tour.' . $this->Tour->primaryKey => $customer_data['Customer']['package_id']));
        $package = $this->Tour->find('first', $toptions);
        $voucher['total_payment_sum'] = $total_payment_sum = $account_data['payment_amount'] = $this->request->data['CarDetail']['price'];
        $voucher['final_payment_with_gst'] = $account_data['total_payment_with_gst'] = get_gst_amount($total_payment_sum,$gst_percent);
        $voucher['customer_tour_type'] = $tour_types[$package['Tour']['type']];
        $voucher['customer_tour_name'] = $package['Tour']['name'];
        $voucher['customer_contact_no'] = $customer_data['Customer']['mobile'];
        $voucher['payment_type'] = Inflector::humanize($this->request->data['CarDetail']['payment_type']);
        $voucher['redirect'] = 'train_details';
        $voucher['invoice_no'] = $invoice_no;
        $voucher['car_no'] = $this->request->data['CarDetail']['car_no'];
        $voucher['source'] = $this->request->data['CarDetail']['source'];
        $voucher['pick_up_date'] = $this->request->data['CarDetail']['pick_up_date'];
        $voucher['drop_date'] = $this->request->data['CarDetail']['drop_date'];
        $voucher['nights'] = $this->request->data['CarDetail']['nights'];
        $voucher['state_id'] = $this->request->data['CarDetail']['state_id'];
        $voucher['city_id'] = $this->request->data['CarDetail']['city_id'];
        $voucher['destination'] = $this->request->data['CarDetail']['destination'];
        $voucher['pnr_no'] = $this->request->data['CarDetail']['pnr_no'];
        $voucher['company_name'] = $this->request->data['CarDetail']['company_name']; 
        $voucher['payment_recieved']  = $this->request->data['CarDetail']['payment_received']; 
        $voucher['special_remark'] = $this->request->data['CarDetail']['special_remark'];     
        $account_data['customer_name'] = $voucher['customer_signature'] = $voucher['customer_full_name'] = $customer_data['Customer']['name'];
        $account_data['ac_type'] = 'car';
        $account_data['cus_id'] = $customer_data['Customer']['id'];
        $account_data['ac_type_id'] = $this->CarDetail->getLastInsertID();
        $account_data['invoice_no'] = $invoice_no;
        $account_data['payment_recieved'] = $voucher['payment_recieved'];
        $account_data['payment_receivable'] = $account_data['total_payment_with_gst'] - $account_data['payment_recieved'];
        $this->Account->save($account_data);
        $voucher['ac_id'] = $ac_id = $this->Account->getLastInsertID();
        $this->CarDetail->id = $this->CarDetail->getLastInsertID();
        $this->CarDetail->saveField('ac_id',$ac_id);    
        $this->Message->setSuccess(__('The car detail has been saved.'));
        $this->set(compact('voucher','states','cities'));
        $this->layout = 'pdf';
        $this->render('/Pdf/car_receipt');
        $this->render('/Pdf/generate_car_voucher');
        $pdfpath = array(ROOT_DIR.RECEIPT_PATH.$ac_id.DS.$invoice_no.'.pdf',ROOT_DIR.CAR_VOUCHER_PATH.$ac_id.PDF_FILE);
        $arrData['Customer']['text'] = 'Car '. $this->request->data['CarDetail']['pnr_no'];
        $arrData['Customer']['email'] = $customer_data['Customer']['email'];
        $arrData['Customer']['name'] = $customer_data['Customer']['name'];
        $arrData['Customer']['booking_type'] = 'Car Ticket';
        //$this->sendNewFormateMail($arrData,'Car Booking',$pdfpath);
        return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The car detail could not be saved. Please, try again.'));
        }
    }

    $this->loadModel("Customer");
    $this->set('customers',$this->Customer->find('list'));
    $this->set('config_gst',$config_gst);
    $this->set(compact('states'));
}

/**
* edit method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function edit($id = null,$voucher = '') {
    if (!$this->CarDetail->exists($id)) {
        $this->Message->setWarning(__('Invalid car detail'),array('action'=>'index'));
    }
    $flag = $voucher;
    $options = array('conditions' => array('CarDetail.' . $this->CarDetail->primaryKey => $id));
    $car_details = $this->CarDetail->find('first', $options);
    $this->loadModel('GstParameter');
    $this->loadModel("State");
    $this->loadModel("City");
    $states = $this->State->find('list');    
    $cities = $this->City->find('list');    
    $gst_value = $this->GstParameter->findByName('bus');
    $config_gst = $gst_value['GstParameter']['value'];
    if ($this->request->is(array('post', 'put'))) {
        $payment_gst = (int)get_gst_amount($this->request->data['CarDetail']['price'],$config_gst);
        $this->request->data['CarDetail']['payment_with_gst'] = $payment_gst;
        if($this->request->data['CarDetail']['payment_received'] > $this->request->data['CarDetail']['payment_with_gst']){
            $this->Message->setWarning(__('Please enter valid payment detail,payment received is more than total payment.'));
            return $this->redirect(Router::url( $this->referer(), true ));
        }
        $this->CarDetail->id = $id;
        $this->request->data['CarDetail']['invoice_no'] = $invoice_no = $this->get_invoice_no();
        if ($this->CarDetail->save($this->request->data)) {
            $voucher = [];
            $voucher['all_t_and_c'] = $voucher['booking_id'] = '';
            $voucher['company_signature'] = Configure::read('Site.Name');
            $tour_types = Configure::read('tour_types');
            $gst_percent = $voucher['gst_percent'] = $config_gst;    
            $this->loadModel("Customer");$this->loadModel("Tour");$this->loadModel("Account");
            $options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $this->request->data['CarDetail']['customer_id']));
            $customer_data = $this->Customer->find('first', $options);
            $toptions = array('conditions' => array('Tour.' . $this->Tour->primaryKey => $customer_data['Customer']['package_id']));
            $package = $this->Tour->find('first', $toptions);
            $voucher['total_payment_sum'] = $total_payment_sum = $account_data['payment_amount'] = $this->request->data['CarDetail']['price'];
            $voucher['final_payment_with_gst'] = $account_data['total_payment_with_gst'] = get_gst_amount($total_payment_sum,$gst_percent);
            $voucher['customer_tour_type'] = $tour_types[$package['Tour']['type']];
            $voucher['customer_tour_name'] = $package['Tour']['name'];
            $voucher['customer_contact_no'] = $customer_data['Customer']['mobile'];
            $voucher['payment_type'] = Inflector::humanize($this->request->data['CarDetail']['payment_type']);
            $voucher['redirect'] = 'train_details';
            $voucher['invoice_no'] = $invoice_no;
            $voucher['special_remark'] = $this->request->data['CarDetail']['special_remark']; 
            $voucher['car_no'] = $this->request->data['CarDetail']['car_no'];
            $voucher['source'] = $this->request->data['CarDetail']['source'];
            $voucher['pick_up_date'] = $this->request->data['CarDetail']['pick_up_date'];
            $voucher['drop_date'] = $this->request->data['CarDetail']['drop_date'];
            $voucher['nights'] = $this->request->data['CarDetail']['nights'];
            $voucher['state_id'] = $this->request->data['CarDetail']['state_id'];
            $voucher['city_id'] = $this->request->data['CarDetail']['city_id'];
            $voucher['destination'] = $this->request->data['CarDetail']['destination'];
            $voucher['pnr_no'] = $this->request->data['CarDetail']['pnr_no'];
            $voucher['company_name'] = $this->request->data['CarDetail']['company_name']; 
            $voucher['payment_recieved']  = $this->request->data['CarDetail']['payment_received'];       
            $voucher['ac_id'] = $ac_id = $car_details['CarDetail']['ac_id'];

            $this->Account->id = $ac_id;
            $account_data['customer_name'] = $voucher['customer_signature'] = $voucher['customer_full_name'] = $customer_data['Customer']['name'];
            $account_data['invoice_no'] = $invoice_no;
            $account_data['payment_recieved'] = $voucher['payment_recieved'];
            $account_data['payment_receivable'] = $account_data['total_payment_with_gst'] - $account_data['payment_recieved'];
            $this->Account->save($account_data);   

            $this->Message->setSuccess(__('The car detail has been saved.'));
            $this->set(compact('voucher','states','cities'));
            $this->layout = 'pdf';
            $this->render('/Pdf/car_receipt');
            $this->render('/Pdf/generate_car_voucher');

            $this->Message->setSuccess(__('The car detail has been updated.'));
            if(empty($flag)){
                return $this->redirect(array('action' => 'index'));
            }else{
                return $this->redirect(array('action' => 'index','voucher'));
            }
        } else {
            $this->Message->setWarning(__('The car detail could not be updated. Please, try again.'));
        }
    } else {
        $this->request->data = $car_details;
    }
    $this->loadModel("Customer");
    $this->set('customers',$this->Customer->find('list'));
    $this->loadModel("State");
    $this->loadModel("City");
    $states = $this->State->find('list');
    $cities = $this->City->find('list');   
    $this->set('config_gst',$config_gst);
    $this->set('edit',1);
    $this->set(compact('states','cities','voucher'));
    $this->render('add');
}

/**
* delete method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function delete($id = null) {
    $this->CarDetail->id = $id;
    if (!$this->CarDetail->exists()) {
        $this->Message->setWarning(__('Invalid car detail'),array('action'=>'index'));
    }
    if ($this->CarDetail->delete()) {
        $this->Message->setSuccess(__('The car detail has been deleted.'));
    } else {
        $this->Message->setWarning(__('The car detail could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}

public function sendVoucher($id)
{
    if (empty($id)) {
        $this->Message->setWarning(__('The car booking could not be found. Please, try again.'));
    } else {
        $options = array('conditions' => array('CarDetail.' . $this->CarDetail->primaryKey => $id));
        $carDetail = $this->CarDetail->find('first', $options);
        $invoice_no = $carDetail['CarDetail']['invoice_no'];
        $ac_id = $carDetail['CarDetail']['ac_id']; 
        $this->loadModel("Customer");
        $options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $carDetail['CarDetail']['customer_id']));
        $customer_data = $this->Customer->find('first', $options);
        if(empty($voucher)){
            $pdfpath = array(ROOT_DIR.RECEIPT_PATH.$ac_id.DS.$invoice_no.'.pdf',ROOT_DIR.CAR_VOUCHER_PATH.$ac_id.PDF_FILE);
        }else{
            $pdfpath = array(ROOT_DIR.CAR_VOUCHER_PATH.$ac_id.PDF_FILE);
        }
        $arrData['Customer']['text'] = 'Car '. $carDetail['CarDetail']['pnr_no'];
        $arrData['Customer']['email'] = $customer_data['Customer']['email'];
        $arrData['Customer']['name'] = $customer_data['Customer']['name'];
        $arrData['Customer']['booking_type'] = 'Car Ticket';
        $this->sendNewFormateMail($arrData,'Car Booking',$pdfpath);
        $this->Message->setSuccess(__('The voucher & receipt has been sent successfully.'));
    }
    return $this->redirect(array('action' => 'index'));     
}



}
