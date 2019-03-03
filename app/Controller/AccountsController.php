<?php
App::uses('AppController', 'Controller');
/**
 * Accounts Controller
 *
 * @property Account $Account
 * @property PaginatorComponent $Paginator
 */
class AccountsController extends AppController {

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
        $this->Session->write('AccountSearch', '');
    }

    if (empty($this->request->data['Account']) && $this->Session->read('AccountSearch')) {
        $this->request->data['Account'] = $this->Session->read('AccountSearch');
    }

    if (!empty($this->request->data['Account'])) {
        $this->request->data['Account'] = array_filter($this->request->data['Account']);
        $this->request->data['Account'] = array_map('trim', $this->request->data['Account']);
        if (!empty($this->request->data)) {

            if (isset($this->request->data['Account']['customer_name'])) {
                $conditions['Account.customer_name LIKE '] = '%' . $this->request->data['Account']['customer_name'] . '%';
            }
            if (isset($this->request->data['Account']['ac_type'])) {
                $conditions['Account.ac_type LIKE '] = '%' . $this->request->data['Account']['ac_type'] . '%';
            }
            
        }
        $this->Session->write('AccountSearch', $this->request->data['Account']);
    }
    $this->AutoPaginate->setPaginate(array(
        'order' => ' Account.id DESC',
        'conditions' => $conditions
    ));
    $ac_types = array('bus'=>'Bus','tour'=>'Tour','car'=>'Car','flight'=>'Flight','train'=>'Train','hotel'=>'Hotel');
    $this->set(compact('ac_types'));
    $this->loadModel('Account');
    $this->set('accounts', $this->paginate('Account'));

}

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function view($id = null) {
    if (!$this->Account->exists($id)) {
        $this->Message->setWarning(__('Invalid account'),array('action'=>'index'));
    }
    $options = array('conditions' => array('Account.' . $this->Account->primaryKey => $id));
    $this->set('account', $this->Account->find('first', $options));
}

/**
* add method
*
* @return void
*/
public function add() {
    if ($this->request->is('post')) {
        $this->Account->create();
        if ($this->Account->save($this->request->data)) {
 
            $this->Message->setSuccess(__('The account has been saved.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The account could not be saved. Please, try again.'));
        }
    }
    $vouchers = $this->Account->Voucher->find('list');
    $this->set(compact('vouchers'));
}

/**
* edit method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function edit($id = null) {
    $id = decrypt($id);
    if (!$this->Account->exists($id)) {
        $this->Message->setWarning(__('Invalid account'),array('action'=>'index'));
    }
    $options = array('conditions' => array('Account.' . $this->Account->primaryKey => $id));
    $account_detail = $this->Account->find('first', $options);
    if ($this->request->is(array('post', 'put'))) {
        if(!empty($this->request->data['Account']['payment_recieved'])){

            $total_payment_with_gst = $this->Account->get_total_payment_with_gst($id);
            $this->request->data['Account']['payment_receivable'] = $total_payment_with_gst - $this->request->data['Account']['payment_recieved'];
        }
        $invoice_day =  $this->Account->find('first',array('order' => array("Account.updated DESC"),'fields' => array('Account.invoice_no')));
        if ($this->Account->save($this->request->data)) {   
            $this->loadModel("AccountHistory");
            $this->AccountHistory->ManageLog($this->request->data['Account']);            
            $cus_id = $account_detail['Account']['cus_id'];
            $module_id = $account_detail['Account']['ac_type_id'];
            $this->request->data['Account']['payment_amount'] = $account_detail['Account']['payment_amount'];
            $this->request->data['Account']['total_payment_with_gst'] = $account_detail['Account']['total_payment_with_gst'];
            if(!empty($this->request->data['Account']['generate_receipt'])){
                $this->generateReceipt($cus_id,$module_id,$this->request->data['Account'],$invoice_day['Account']['invoice_no']);
            }

            $this->Message->setSuccess(__('The account has been updated.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The account could not be updated. Please, try again.'));
        }
    } else {
        $options = array('conditions' => array('Account.' . $this->Account->primaryKey => $id));
        $this->request->data = $account_detail;
    }
    $vouchers = $this->Account->Voucher->find('list');
    $this->set(compact('vouchers'));
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
    $this->Account->id = $id;
    if (!$this->Account->exists()) {
        $this->Message->setWarning(__('Invalid account'),array('action'=>'index'));
    }
    if ($this->Account->delete()) {
        $this->Message->setSuccess(__('The account has been deleted.'));
    } else {
        $this->Message->setWarning(__('The account could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}

public function generateReceipt($cus_id='',$module_id='',$account_data='',$old_invoice_no='')
{
    $this->loadModel("Customer");
    $this->loadModel("Tour");
    $this->loadModel("Account"); 
    $invoice_no = $this->get_invoice_no($old_invoice_no);
    $voucher['company_signature'] = Configure::read('Site.Name');
    $tour_types = Configure::read('tour_types');
    $this->loadModel('GstParameter');
    $gst_value = $this->GstParameter->findByName('bus');
    $config_gst = $gst_value['GstParameter']['value'];    
    $gst_percent = $voucher['gst_percent'] = empty($config_gst)?10:$config_gst;    
    $customer_data = $this->Customer->find('first', array('conditions' => array('Customer.' . $this->Customer->primaryKey => $cus_id)));
    $toptions = array('conditions' => array('Tour.' . $this->Tour->primaryKey => $customer_data['Customer']['package_id']));
    $package = $this->Tour->find('first', $toptions);
    $voucher['all_t_and_c'] = '';
    $voucher['total_payment_sum'] = $account_data['payment_amount'];
    $voucher['final_payment_with_gst'] = $account_data['total_payment_with_gst'];
    $voucher['customer_tour_type'] = $tour_types[$package['Tour']['type']];
    $voucher['customer_tour_name'] = $package['Tour']['name'];
    $voucher['customer_contact_no'] = $customer_data['Customer']['mobile'];
    $voucher['payment_type'] = 'cash';
    $voucher['invoice_no'] = $invoice_no;
    $voucher['ac_id'] = $account_data['id'];
    $voucher['customer_signature'] = $voucher['customer_full_name'] = $customer_data['Customer']['name'];
    if($account_data['ac_type'] == 'bus'){
        $this->loadModel("BusDetail");
        $details =  $this->BusDetail->find('first', array('conditions' => array('BusDetail.id'=> $module_id)));
        $voucher['bus_no'] = $details['BusDetail']['bus_no'];
        $voucher['source'] = $details['BusDetail']['source'];
        $voucher['destination'] = $details['BusDetail']['destination'];
        $voucher['pnr_no'] = $details['BusDetail']['pnr_no'];
        $voucher['company_name'] = $details['BusDetail']['company_name'];
        $voucher['payment_recieved']  = $account_data['payment_recieved'];
        $this->BusDetail->id = $module_id;
        $this->BusDetail->saveField('invoice_no',$invoice_no); 
        $render = '/Pdf/bus_receipt';
    }elseif($account_data['ac_type'] == 'train'){
        $this->loadModel("TrainDetail");
        $details =  $this->TrainDetail->find('first', array('conditions' => array('TrainDetail.id'=> $module_id)));
        $voucher['train_no'] = $details['TrainDetail']['train_no'];
        $voucher['source'] = $details['TrainDetail']['source'];
        $voucher['destination'] = $details['TrainDetail']['destination'];
        $voucher['pnr_no'] = $details['TrainDetail']['pnr_no'];
        $voucher['company_name'] = $details['TrainDetail']['company_name'];
        $voucher['payment_recieved']  = $account_data['payment_recieved'];
        $this->TrainDetail->id = $module_id;
        $this->TrainDetail->saveField('invoice_no',$invoice_no); 
        $render = '/Pdf/train_receipt';
    }elseif($account_data['ac_type'] == 'car'){
        $this->loadModel("CarDetail");
        $details =  $this->CarDetail->find('first', array('conditions' => array('CarDetail.id'=> $module_id)));
        $voucher['car_no'] = $details['CarDetail']['car_no'];
        $voucher['source'] = $details['CarDetail']['source'];
        $voucher['destination'] = $details['CarDetail']['destination'];
        $voucher['pnr_no'] = $details['CarDetail']['pnr_no'];
        $voucher['company_name'] = $details['CarDetail']['company_name'];
        $voucher['payment_recieved']  = $account_data['payment_recieved'];
        $this->CarDetail->id = $module_id;
        $this->CarDetail->saveField('invoice_no',$invoice_no); 
        $render = '/Pdf/car_receipt';
    }elseif($account_data['ac_type'] == 'flight'){
        $this->loadModel("FlightDetail");
        $details =  $this->FlightDetail->find('first', array('conditions' => array('FlightDetail.id'=> $module_id)));
        $voucher['flight_no'] = $details['FlightDetail']['flight_no'];
        $voucher['source'] = $details['FlightDetail']['source'];
        $voucher['destination'] = $details['FlightDetail']['destination'];
        $voucher['pnr_no'] = $details['FlightDetail']['pnr_no'];
        $voucher['company_name'] = $details['FlightDetail']['company_name'];
        $voucher['payment_recieved']  = $account_data['payment_recieved'];
        $this->FlightDetail->id = $module_id;
        $this->FlightDetail->saveField('invoice_no',$invoice_no); 
        $render = '/Pdf/flight_receipt';
    }elseif($account_data['ac_type'] == 'hotel'){
        $this->loadModel("HotelBooking");
        $this->loadModel("Hotel");
        $HotelBooking_detail = $this->HotelBooking->find('first', array('conditions' => array('HotelBooking.id'=> $module_id)));
        $hotel_name = $this->Hotel->findById($HotelBooking_detail['HotelBooking']['hotel_id'],'name');
        $voucher['hotel_name'] = $hotel_name['Hotel']['name'];
        $voucher['payment_recieved']  = $account_data['payment_recieved'];
        $this->HotelBooking->id = $module_id;
        $this->HotelBooking->saveField('invoice_no',$invoice_no); 
        $render = '/Pdf/hotel_receipt';
    }elseif($account_data['ac_type'] == 'tour'){

        $this->loadModel("Booking");
        $options = array('conditions' => array('Booking.' . $this->Booking->primaryKey => $module_id));
        $voucher = $this->Booking->find('first', $options);
        $voucher  = $voucher['Booking'];
        $pcount = $voucher['package_count'];
        $payment2 = empty($voucher['total_payment2'])?0:$voucher['total_payment2'];
        $payment3 = empty($voucher['total_payment3'])?0:$voucher['total_payment3'];        
        $voucher['total_payment_sum'] = $total_payment_sum = $voucher['total_payment'] + $payment2 + $payment3;        
        $voucher['final_payment_with_gst'] = get_gst_amount($total_payment_sum,$gst_percent);
        $voucher['booking_id'] = $voucher['id']; $voucher['redirect'] = 'tours';
        $voucher['gst_percent'] = $gst_percent;        
        $voucher['customer_tour_type'] = $voucher['tour_type'];
        $voucher['customer_tour_date'] = $voucher['travel_date'];
        $voucher['customer_tour_name'] = $voucher['customer_tour_name'];
        $voucher['customer_hotel_place_name'] = $voucher['place_name'];
        for ($i=2; $i <= $pcount; $i++) { 
        $voucher['customer_tour_type'.$i] = $voucher['tour_type'.$i];
        $voucher['customer_tour_date'.$i] = $voucher['travel_date'.$i];
        $voucher['customer_tour_name'.$i] = $voucher['customer_tour_name'.$i];
        $voucher['customer_hotel_place_name'.$i] = $voucher['place_name'.$i];
        }
        if($pcount==1){
        $render = '/Pdf/tour_receipt';
        }else{   
        $render = '/Pdf/tour_receipt'.$pcount;
        }    
    }

    $this->Account->id = $account_data['id'];
    $this->Account->saveField('invoice_no',$invoice_no);
    $this->set(compact('voucher'));
    $this->layout = 'pdf';
    $this->render($render);
    return true;
}

public function sendReceipt($ac_id='')
{
    $id = decrypt($ac_id);
    $options = array('conditions' => array('Account.' . $this->Account->primaryKey => $id));
    $account_detail = $this->Account->find('first', $options);
    $type = $account_detail['Account']['ac_type'];
    $module_id = $account_detail['Account']['ac_type_id'];
     $this->loadModel("Customer");
    $customer_data = $this->Customer->find('first', array('conditions' => array('Customer.' . $this->Customer->primaryKey => $account_detail['Account']['cus_id'])));
    $arrData['Customer']['email'] = $customer_data['Customer']['email'];
    $arrData['Customer']['name'] = $customer_data['Customer']['name'];
    if($type == 'bus'){
        $this->loadModel("BusDetail");
        $details =  $this->BusDetail->find('first', array('conditions' => array('BusDetail.id'=> $module_id)));
        $invoice_no = $details['BusDetail']['invoice_no'];
        $arrData['Customer']['text'] = 'BUS '. $details['BusDetail']['pnr_no'];
        $arrData['Customer']['booking_type'] = 'Bus Ticket';
        $title = 'Bus Booking';
    }elseif($type == 'train'){
        $this->loadModel("TrainDetail");
        $details =  $this->TrainDetail->find('first', array('conditions' => array('TrainDetail.id'=> $module_id)));
        $invoice_no = $details['TrainDetail']['invoice_no'];
        $arrData['Customer']['text'] = 'Train '. $details['TrainDetail']['pnr_no'];
        $arrData['Customer']['booking_type'] = 'Train Ticket';
        $title = 'Train Booking';
    }elseif($type == 'car'){
        $this->loadModel("CarDetail");
        $details =  $this->CarDetail->find('first', array('conditions' => array('CarDetail.id'=> $module_id)));
        $invoice_no = $details['CarDetail']['invoice_no'];
        $arrData['Customer']['text'] = 'Car '. $details['CarDetail']['pnr_no'];
        $arrData['Customer']['booking_type'] = 'Car Ticket';
        $title = 'Car Booking';
    }elseif($type == 'flight'){
        $this->loadModel("FlightDetail");
        $details =  $this->FlightDetail->find('first', array('conditions' => array('FlightDetail.id'=> $module_id)));
        $invoice_no = $details['FlightDetail']['invoice_no'];
        $arrData['Customer']['text'] = 'Flight '. $details['FlightDetail']['pnr_no'];
        $arrData['Customer']['booking_type'] = 'Flight Ticket';
        $title = 'Flight Booking';
    }elseif($type == 'hotel'){
        $this->loadModel("HotelBooking");
        $details = $this->HotelBooking->find('first', array('conditions' => array('HotelBooking.id'=> $module_id)));
        $invoice_no = $details['HotelBooking']['invoice_no'];
        $arrData['Customer']['text'] = 'Hotel '. $details['HotelBooking']['invoice_no'];
        $arrData['Customer']['booking_type'] = 'Hotel Ticket';
        $title = 'Hotel Booking';
    }
    elseif($type == 'tour'){
            $this->loadModel("Booking");
            $details = $this->Booking->find('first', array('conditions' => array('Booking.id'=> $module_id)));
            $invoice_no = $details['Booking']['invoice_no'];
            $arrData['Customer']['text'] = 'Tour '. $details['Booking']['invoice_no'];
            $arrData['Customer']['booking_type'] = 'Tour ';
            $title = 'Tour';
        }
    $pdfpath = array(ROOT_DIR.RECEIPT_PATH.$id.DS.$invoice_no.'.pdf');
    $this->sendNewFormateMail($arrData,$title,$pdfpath);
    $this->Message->setSuccess(__('The receipt has been send to customer.'));
    return $this->redirect(array('action' => 'index'));
}

/**
 * view Account History method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function viewHistory($id = null)
{
    $remove_id=array('id');
    
    $this->loadModel('AccountHistory');
    //if ($this->request->is('ajax')) {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $this->autoLayout = false;

        if (!$this->AccountHistory->exists($id)) {
            throw new NotFoundException(__('Invalid audit log'));
        }

        $conditions = array(
            'AccountHistory.account_id' => $id
        );
        $account_histories = $this->AccountHistory->find('all', array(
                'conditions' => $conditions,
                'contain' => array('User')
            )
        );

        //debug($account_histories); exit;
        $this->set(compact('account_histories','remove_id'));
        $renderData = $this->render('/Accounts/account_histories')->body();
    // }else{
    //     return $this->redirect(array('controller'=>'reports', 'action' => 'audit_log'));
    // }
}

}
