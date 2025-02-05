<?php
App::uses('AppController', 'Controller');
/**
 * TrainDetails Controller
 *
 * @property TrainDetail $TrainDetail
 * @property PaginatorComponent $Paginator
 */
class TrainDetailsController extends AppController {

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
        $this->Session->write('TrainDetailSearch', '');
    }

    if (empty($this->request->data['TrainDetail']) && $this->Session->read('TrainDetailSearch')) {
        $this->request->data['TrainDetail'] = $this->Session->read('TrainDetailSearch');
    }
    if (!empty($this->request->data['TrainDetail'])) {
        $this->request->data['TrainDetail'] = array_filter($this->request->data['TrainDetail']);
        $this->request->data['TrainDetail'] = array_map('trim', $this->request->data['TrainDetail']);
        if (!empty($this->request->data)) {
            if (isset($this->request->data['TrainDetail']['first_name'])) {
                $conditions['TrainDetail.first_name LIKE '] = '%' . $this->request->data['TrainDetail']['first_name'] . '%';
            }
            if (isset($this->request->data['TrainDetail']['last_name'])) {
                $conditions['TrainDetail.last_name LIKE '] = '%' . $this->request->data['TrainDetail']['last_name'] . '%';
            }
            if (isset($this->request->data['TrainDetail']['name'])) {
                $conditions['TrainDetail.name LIKE '] = '%' . $this->request->data['TrainDetail']['name'] . '%';
            }
            if (isset($this->request->data['TrainDetail']['email'])) {
                $conditions['TrainDetail.email LIKE '] = '%' . $this->request->data['TrainDetail']['email'] . '%';
            }
            if (isset($this->request->data['TrainDetail']['status'])) {
                $conditions['TrainDetail.status'] = $this->request->data['TrainDetail']['status'];
            }
        }
        $this->Session->write('TrainDetailSearch', $this->request->data['TrainDetail']);
    }
    $this->AutoPaginate->setPaginate(array(
        'order' => ' TrainDetail.id DESC',
        'conditions' => $conditions
    ));
    $this->loadModel('TrainDetail');
    $this->set('trainDetails', $this->paginate('TrainDetail'));

}

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function view($id = null) {
    if (!$this->TrainDetail->exists($id)) {
        $this->Message->setWarning(__('Invalid train detail'),array('action'=>'index'));
    }
    $options = array('conditions' => array('TrainDetail.' . $this->TrainDetail->primaryKey => $id));
    $this->set('trainDetail', $this->TrainDetail->find('first', $options));
}

/**
* add method
*
* @return void
*/
public function add() {
    $this->loadModel('GstParameter');
    $gst_value = $this->GstParameter->findByName('train');
    $config_gst = $gst_value['GstParameter']['value'];        
    if ($this->request->is('post')) {
        $payment_gst = (int)get_gst_amount($this->request->data['TrainDetail']['price'],$config_gst);
        $this->request->data['TrainDetail']['payment_with_gst'] = $payment_gst;
        if($this->request->data['TrainDetail']['payment_received'] > $this->request->data['TrainDetail']['payment_with_gst']){
            $this->Message->setWarning(__('Please enter valid payment detail,payment received is more than total payment.'));
            return $this->redirect(Router::url( $this->referer(), true ));
        }
        $this->TrainDetail->create();
        $this->request->data['TrainDetail']['invoice_no'] = $invoice_no = $this->get_invoice_no();
        if ($this->TrainDetail->save($this->request->data)) {

        $voucher['all_t_and_c'] = $voucher['booking_id'] = '';
        $voucher['company_signature'] = Configure::read('Site.Name');
        $tour_types = Configure::read('tour_types');
        $gst_percent = $voucher['gst_percent'] = $config_gst;    
        $this->loadModel("Customer");$this->loadModel("Tour");$this->loadModel("Account");
        $options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $this->request->data['TrainDetail']['customer_id']));
        $customer_data = $this->Customer->find('first', $options);
        $toptions = array('conditions' => array('Tour.' . $this->Tour->primaryKey => $customer_data['Customer']['package_id']));
        $package = $this->Tour->find('first', $toptions);
        $voucher['total_payment_sum'] = $total_payment_sum = $account_data['payment_amount'] = $this->request->data['TrainDetail']['price'];
        $voucher['final_payment_with_gst'] = $account_data['total_payment_with_gst'] = get_gst_amount($total_payment_sum,$gst_percent);
        $voucher['customer_tour_type'] = $tour_types[$package['Tour']['type']];
        $voucher['customer_tour_name'] = $package['Tour']['name'];
        $voucher['customer_contact_no'] = $customer_data['Customer']['mobile'];
        $voucher['payment_type'] = Inflector::humanize($this->request->data['TrainDetail']['payment_type']);
        $voucher['redirect'] = 'train_details';
        $voucher['invoice_no'] = $invoice_no;
        $voucher['train_no'] = $this->request->data['TrainDetail']['train_no'];
        $voucher['seat_no'] = $this->request->data['TrainDetail']['seat_no'];
        $voucher['source'] = $this->request->data['TrainDetail']['source'];
        $voucher['destination'] = $this->request->data['TrainDetail']['destination'];
        $voucher['pnr_no'] = $this->request->data['TrainDetail']['pnr_no'];
        $voucher['company_name'] = $this->request->data['TrainDetail']['company_name'];
        $voucher['payment_recieved']  = $this->request->data['TrainDetail']['payment_received'];        
        $account_data['customer_name'] = $voucher['customer_signature'] = $voucher['customer_full_name'] = $customer_data['Customer']['name'];
        $account_data['ac_type'] = 'train';
        $account_data['cus_id'] = $customer_data['Customer']['id'];
        $account_data['ac_type_id'] = $this->TrainDetail->getLastInsertID();
        $account_data['invoice_no'] = $invoice_no;
        $account_data['payment_recieved'] = $voucher['payment_recieved'];
        $account_data['payment_receivable'] = $account_data['total_payment_with_gst'] - $account_data['payment_recieved'];
        $this->Account->save($account_data);
        $voucher['ac_id'] = $ac_id = $this->Account->getLastInsertID();
        $this->TrainDetail->id = $this->TrainDetail->getLastInsertID();
        $this->TrainDetail->saveField('ac_id',$ac_id);    
        $this->Message->setSuccess(__('The train detail has been saved.'));
        $this->set(compact('voucher'));
        $this->layout = 'pdf';
        $pdfpath = array(ROOT_DIR.RECEIPT_PATH.$ac_id.DS.$invoice_no.'.pdf');
        $this->render('/Pdf/train_receipt');            
            $arrData['Customer']['text'] = 'Train '. $this->request->data['TrainDetail']['pnr_no'];
            $arrData['Customer']['email'] = $customer_data['Customer']['email'];
            $arrData['Customer']['name'] = $customer_data['Customer']['name'];
            $arrData['Customer']['booking_type'] = 'Train Ticket';
            $this->sendNewFormateMail($arrData,'Train Booking',$pdfpath);            
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The train detail could not be saved. Please, try again.'));
        }
    }
    $this->loadModel("Customer");
    $this->set('customers',$this->Customer->find('list'));
    $this->set('config_gst',$config_gst);
}

/**
* edit method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function edit($id = null) {
    if (!$this->TrainDetail->exists($id)) {
        $this->Message->setWarning(__('Invalid train detail'),array('action'=>'index'));
    }
    if ($this->request->is(array('post', 'put'))) {
        if ($this->TrainDetail->save($this->request->data)) {
            $this->Message->setSuccess(__('The train detail has been updated.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The train detail could not be updated. Please, try again.'));
        }
    } else {
        $options = array('conditions' => array('TrainDetail.' . $this->TrainDetail->primaryKey => $id));
        $this->request->data = $this->TrainDetail->find('first', $options);
    }
    $this->loadModel("Customer");
    $this->set('customers',$this->Customer->find('list'));
    $this->loadModel('GstParameter');
    $gst_value = $this->GstParameter->findByName('bus');
    $config_gst = $gst_value['GstParameter']['value'];
    $this->set('config_gst',$config_gst);
    $this->set('edit',1);
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
    $this->TrainDetail->id = $id;
    if (!$this->TrainDetail->exists()) {
        $this->Message->setWarning(__('Invalid train detail'),array('action'=>'index'));
    }
    if ($this->TrainDetail->delete()) {
        $this->Message->setSuccess(__('The train detail has been deleted.'));
    } else {
        $this->Message->setWarning(__('The train detail could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}}
