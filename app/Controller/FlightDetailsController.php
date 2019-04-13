<?php
App::uses('AppController', 'Controller');
/**
 * FlightDetails Controller
 *
 * @property FlightDetail $FlightDetail
 * @property PaginatorComponent $Paginator
 */
class FlightDetailsController extends AppController {

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
        $this->Session->write('FlightDetailSearch', '');
    }

    if (empty($this->request->data['FlightDetail']) && $this->Session->read('FlightDetailSearch')) {
        $this->request->data['FlightDetail'] = $this->Session->read('FlightDetailSearch');
    }
    if (!empty($this->request->data['FlightDetail'])) {
        $this->request->data['FlightDetail'] = array_filter($this->request->data['FlightDetail']);
        $this->request->data['FlightDetail'] = array_map('trim', $this->request->data['FlightDetail']);
        if (!empty($this->request->data)) {
            if (isset($this->request->data['FlightDetail']['first_name'])) {
                $conditions['FlightDetail.first_name LIKE '] = '%' . $this->request->data['FlightDetail']['first_name'] . '%';
            }
            if (isset($this->request->data['FlightDetail']['last_name'])) {
                $conditions['FlightDetail.last_name LIKE '] = '%' . $this->request->data['FlightDetail']['last_name'] . '%';
            }
            if (isset($this->request->data['FlightDetail']['name'])) {
                $conditions['FlightDetail.name LIKE '] = '%' . $this->request->data['FlightDetail']['name'] . '%';
            }
            if (isset($this->request->data['FlightDetail']['email'])) {
                $conditions['FlightDetail.email LIKE '] = '%' . $this->request->data['FlightDetail']['email'] . '%';
            }
            if (isset($this->request->data['FlightDetail']['status'])) {
                $conditions['FlightDetail.status'] = $this->request->data['FlightDetail']['status'];
            }
        }
        $this->Session->write('FlightDetailSearch', $this->request->data['FlightDetail']);
    }
    $this->AutoPaginate->setPaginate(array(
        'order' => ' FlightDetail.id DESC',
        'conditions' => $conditions
    ));
    $this->loadModel('FlightDetail');
    $this->set('flightDetails', $this->paginate('FlightDetail'));

}

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function view($id = null) {
    if (!$this->FlightDetail->exists($id)) {
        $this->Message->setWarning(__('Invalid flight detail'),array('action'=>'index'));
    }
    $options = array('conditions' => array('FlightDetail.' . $this->FlightDetail->primaryKey => $id));
    $this->set('flightDetail', $this->FlightDetail->find('first', $options));
}

/**
* add method
*
* @return void
*/
public function add() {
    $this->loadModel('GstParameter');
    $gst_value = $this->GstParameter->findByName('flight');
    $config_gst = $gst_value['GstParameter']['value'];        
    if ($this->request->is('post')) {
        $payment_gst = (int)get_gst_amount($this->request->data['FlightDetail']['price'],$config_gst);
        $this->request->data['FlightDetail']['payment_with_gst'] = $payment_gst;
        if($this->request->data['FlightDetail']['payment_received'] > $this->request->data['FlightDetail']['payment_with_gst']){
            $this->Message->setWarning(__('Please enter valid payment detail,payment received is more than total payment.'));
            return $this->redirect(Router::url( $this->referer(), true ));
        }
        $this->FlightDetail->create();
        $this->request->data['FlightDetail']['invoice_no'] = $invoice_no = $this->get_invoice_no();
    
        if ($this->FlightDetail->save($this->request->data)) {


        $voucher['all_t_and_c'] = $voucher['booking_id'] = '';
        $voucher['company_signature'] = Configure::read('Site.Name');
        $tour_types = Configure::read('tour_types');
        $gst_percent = $voucher['gst_percent'] = $config_gst;    
        $this->loadModel("Customer");$this->loadModel("Tour");$this->loadModel("Account");
        $options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $this->request->data['FlightDetail']['customer_id']));
        $customer_data = $this->Customer->find('first', $options);
        $toptions = array('conditions' => array('Tour.' . $this->Tour->primaryKey => $customer_data['Customer']['package_id']));
        $package = $this->Tour->find('first', $toptions);
        $voucher['total_payment_sum'] = $total_payment_sum = $account_data['payment_amount'] = $this->request->data['FlightDetail']['price'];
        $voucher['final_payment_with_gst'] = $account_data['total_payment_with_gst'] = get_gst_amount($total_payment_sum,$gst_percent);
        $voucher['customer_tour_type'] = $tour_types[$package['Tour']['type']];
        $voucher['customer_tour_name'] = $package['Tour']['name'];
        $voucher['customer_contact_no'] = $customer_data['Customer']['mobile'];
        $voucher['payment_type'] = Inflector::humanize($this->request->data['FlightDetail']['payment_type']);
        $voucher['redirect'] = 'flight_details';
        $voucher['invoice_no'] = $invoice_no;
        $voucher['flight_no'] = $this->request->data['FlightDetail']['flight_no'];
        $voucher['seat_no'] = $this->request->data['FlightDetail']['seat_no'];
        $voucher['source'] = $this->request->data['FlightDetail']['source'];
        $voucher['destination'] = $this->request->data['FlightDetail']['destination'];
        $voucher['pnr_no'] = $this->request->data['FlightDetail']['pnr_no'];
        $voucher['company_name'] = $this->request->data['FlightDetail']['company_name'];
        $voucher['payment_recieved']  = $this->request->data['FlightDetail']['payment_received'];        
        $account_data['customer_name'] = $voucher['customer_signature'] = $voucher['customer_full_name'] = $customer_data['Customer']['name'];
        $account_data['ac_type'] = 'flight';
        $account_data['cus_id'] = $customer_data['Customer']['id'];
        $account_data['ac_type_id'] = $this->FlightDetail->getLastInsertID();
        $account_data['invoice_no'] = $invoice_no;
        $account_data['payment_recieved'] = $voucher['payment_recieved'];
        $account_data['payment_receivable'] = $account_data['total_payment_with_gst'] - $account_data['payment_recieved'];
        $this->Account->save($account_data);
        $voucher['ac_id'] = $ac_id = $this->Account->getLastInsertID();
        $this->FlightDetail->id = $this->FlightDetail->getLastInsertID();
        $this->FlightDetail->saveField('ac_id',$ac_id);    
        $this->Message->setSuccess(__('The flight detail has been saved.'));
        $this->set(compact('voucher'));
        $this->layout = 'pdf';
        $this->render('/Pdf/flight_receipt');            
        $pdfpath = array(ROOT_DIR.RECEIPT_PATH.$ac_id.DS.$invoice_no.'.pdf');
        $arrData['Customer']['text'] = 'Flight '. $this->request->data['FlightDetail']['pnr_no'];
        $arrData['Customer']['email'] = $customer_data['Customer']['email'];
        $arrData['Customer']['name'] = $customer_data['Customer']['name'];
        $arrData['Customer']['booking_type'] = 'Flight Ticket';
        $this->sendNewFormateMail($arrData,'Flight Booking',$pdfpath);

        return $this->redirect(array('action' => 'index'));

        } else {
            $this->Message->setWarning(__('The flight detail could not be saved. Please, try again.'));
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
    if (!$this->FlightDetail->exists($id)) {
        $this->Message->setWarning(__('Invalid flight detail'),array('action'=>'index'));
    }
    if ($this->request->is(array('post', 'put'))) {
        if ($this->FlightDetail->save($this->request->data)) {
            $this->Message->setSuccess(__('The flight detail has been updated.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The flight detail could not be updated. Please, try again.'));
        }
    } else {
        $options = array('conditions' => array('FlightDetail.' . $this->FlightDetail->primaryKey => $id));
        $this->request->data = $this->FlightDetail->find('first', $options);
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
    $this->FlightDetail->id = $id;
    if (!$this->FlightDetail->exists()) {
        $this->Message->setWarning(__('Invalid flight detail'),array('action'=>'index'));
    }
    if ($this->FlightDetail->delete()) {
        $this->Message->setSuccess(__('The flight detail has been deleted.'));
    } else {
        $this->Message->setWarning(__('The flight detail could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}}
