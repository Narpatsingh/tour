<?php
App::uses('AppController', 'Controller');
/**
 * BusDetails Controller
 *
 * @property BusDetail $BusDetail
 * @property PaginatorComponent $Paginator
 */
class BusDetailsController extends AppController {

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
        $this->Session->write('BusDetailSearch', '');
    }

    if (empty($this->request->data['BusDetail']) && $this->Session->read('BusDetailSearch')) {
        $this->request->data['BusDetail'] = $this->Session->read('BusDetailSearch');
    }
    if (!empty($this->request->data['BusDetail'])) {
        $this->request->data['BusDetail'] = array_filter($this->request->data['BusDetail']);
        $this->request->data['BusDetail'] = array_map('trim', $this->request->data['BusDetail']);
        if (!empty($this->request->data)) {
            if (isset($this->request->data['BusDetail']['first_name'])) {
                $conditions['BusDetail.first_name LIKE '] = '%' . $this->request->data['BusDetail']['first_name'] . '%';
            }
            if (isset($this->request->data['BusDetail']['last_name'])) {
                $conditions['BusDetail.last_name LIKE '] = '%' . $this->request->data['BusDetail']['last_name'] . '%';
            }
            if (isset($this->request->data['BusDetail']['name'])) {
                $conditions['BusDetail.name LIKE '] = '%' . $this->request->data['BusDetail']['name'] . '%';
            }
            if (isset($this->request->data['BusDetail']['email'])) {
                $conditions['BusDetail.email LIKE '] = '%' . $this->request->data['BusDetail']['email'] . '%';
            }
            if (isset($this->request->data['BusDetail']['status'])) {
                $conditions['BusDetail.status'] = $this->request->data['BusDetail']['status'];
            }
        }
        $this->Session->write('BusDetailSearch', $this->request->data['BusDetail']);
    }
    $this->AutoPaginate->setPaginate(array(
        'order' => ' BusDetail.id DESC',
        'conditions' => $conditions
    ));
    $this->loadModel('BusDetail');
    $this->set('busDetails', $this->paginate('BusDetail'));

}

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function view($id = null) {
    if (!$this->BusDetail->exists($id)) {
        $this->Message->setWarning(__('Invalid bus detail'),array('action'=>'index'));
    }
    $options = array('conditions' => array('BusDetail.' . $this->BusDetail->primaryKey => $id));
    $this->set('busDetail', $this->BusDetail->find('first', $options));
}

/**
* add method
*
* @return void
*/
public function add() {
    if ($this->request->is('post')) {
        if($this->request->data['BusDetail']['payment_received'] > $this->request->data['BusDetail']['price']){
            $this->Message->setWarning(__('Please enter valid payment detail,payment received is more than total payment.'));
            return $this->redirect(Router::url( $this->referer(), true ));
        }
        $this->BusDetail->create();
        $this->request->data['BusDetail']['invoice_no'] = $invoice_no = $this->get_invoice_no();
        if ($this->BusDetail->save($this->request->data)) {

            $voucher['all_t_and_c'] = $voucher['booking_id'] = '';
            $voucher['company_signature'] = Configure::read('Site.Name');
            $tour_types = Configure::read('tour_types');
            $config_gst = Configure::read('Site.gst_percent');
            $gst_percent = $voucher['gst_percent'] = empty($config_gst)?10:$config_gst;    
            $this->loadModel("Customer");$this->loadModel("Tour");$this->loadModel("Account");
            $options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $this->request->data['BusDetail']['customer_id']));
            $customer_data = $this->Customer->find('first', $options);
            $toptions = array('conditions' => array('Tour.' . $this->Tour->primaryKey => $customer_data['Customer']['package_id']));
            $package = $this->Tour->find('first', $toptions);
            $voucher['total_payment_sum'] = $total_payment_sum = $account_data['payment_amount'] = $this->request->data['BusDetail']['price'];
            $voucher['final_payment_with_gst'] = $account_data['total_payment_with_gst'] = get_gst_amount($total_payment_sum,$gst_percent);
            $voucher['customer_tour_type'] = $tour_types[$package['Tour']['type']];
            $voucher['customer_tour_name'] = $package['Tour']['name'];
            $voucher['customer_contact_no'] = $customer_data['Customer']['mobile'];
            $voucher['payment_type'] = 'cash';
            $voucher['redirect'] = 'bus_details';
            $voucher['invoice_no'] = $invoice_no;
            $voucher['bus_no'] = $this->request->data['BusDetail']['bus_no'];
            $voucher['source'] = $this->request->data['BusDetail']['source'];
            $voucher['destination'] = $this->request->data['BusDetail']['destination'];
            $voucher['pnr_no'] = $this->request->data['BusDetail']['pnr_no'];
            $voucher['company_name'] = $this->request->data['BusDetail']['company_name'];
            $voucher['payment_recieved']  = $this->request->data['BusDetail']['payment_received'];
            $account_data['customer_name'] = $voucher['customer_signature'] = $voucher['customer_full_name'] = $customer_data['Customer']['name'];
            $account_data['cus_id'] = $customer_data['Customer']['id'];
            $account_data['ac_type'] = 'bus';
            $account_data['ac_type_id'] = $this->BusDetail->getLastInsertID();
            $account_data['invoice_no'] = $invoice_no;
            $account_data['payment_recieved'] = $voucher['payment_recieved'];
            $voucher['grant_total'] = $account_data['total_payment_with_gst'] + $total_payment_sum;
            $account_data['payment_receivable'] = $voucher['grant_total'] - $account_data['payment_recieved'];
            $this->Account->save($account_data);
            $voucher['ac_id'] = $ac_id = $this->Account->getLastInsertID();
            $this->BusDetail->id = $this->BusDetail->getLastInsertID();
            $this->BusDetail->saveField('ac_id',$ac_id);    
            $this->Message->setSuccess(__('The bus detail has been saved.'));
            $this->set(compact('voucher'));
            $this->layout = 'pdf';
            $pdfpath = array(ROOT_DIR.RECEIPT_PATH.$ac_id.DS.$invoice_no.'.pdf');
            $this->render('/Pdf/bus_receipt');
            $arrData['Customer']['text'] = 'BUS '. $this->request->data['BusDetail']['pnr_no'];
            $arrData['Customer']['email'] = $customer_data['Customer']['email'];
            $arrData['Customer']['name'] = $customer_data['Customer']['name'];
            $arrData['Customer']['booking_type'] = 'Bus Ticket';
            $this->sendNewFormateMail($arrData,'Bus Booking',$pdfpath);
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The bus detail could not be saved. Please, try again.'));
        }
    }
    $this->loadModel("Customer");
    $this->set('customers',$this->Customer->find('list'));
}

/**
* edit method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function edit($id = null) {
    if (!$this->BusDetail->exists($id)) {
        $this->Message->setWarning(__('Invalid bus detail'),array('action'=>'index'));
    }
    if ($this->request->is(array('post', 'put'))) {
        if ($this->BusDetail->save($this->request->data)) {
            $this->Message->setSuccess(__('The bus detail has been updated.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The bus detail could not be updated. Please, try again.'));
        }
    } else {
        $options = array('conditions' => array('BusDetail.' . $this->BusDetail->primaryKey => $id));
        $this->request->data = $this->BusDetail->find('first', $options);
    }
    $this->loadModel("Customer");
    $this->set('customers',$this->Customer->find('list'));
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
    $this->BusDetail->id = $id;
    if (!$this->BusDetail->exists()) {
        $this->Message->setWarning(__('Invalid bus detail'),array('action'=>'index'));
    }
    if ($this->BusDetail->delete()) {
        $this->Message->setSuccess(__('The bus detail has been deleted.'));
    } else {
        $this->Message->setWarning(__('The bus detail could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}
}
