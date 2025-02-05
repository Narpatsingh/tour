<?php
App::uses('AppController', 'Controller');
/**
 * HotelBookings Controller
 *
 * @property HotelBooking $HotelBooking
 * @property PaginatorComponent $Paginator
 */
class HotelBookingsController extends AppController {

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
        $this->Session->write('HotelBookingSearch', '');
    }
    $voucher = ($all == 'voucher'?'voucher':'');
    if (empty($this->request->data['HotelBooking']) && $this->Session->read('HotelBookingSearch')) {
        $this->request->data['HotelBooking'] = $this->Session->read('HotelBookingSearch');
    }
    if (!empty($this->request->data['HotelBooking'])) {
        $this->request->data['HotelBooking'] = array_filter($this->request->data['HotelBooking']);
        $this->request->data['HotelBooking'] = array_map('trim', $this->request->data['HotelBooking']);
        if (!empty($this->request->data)) {
            if (isset($this->request->data['HotelBooking']['first_name'])) {
                $conditions['HotelBooking.first_name LIKE '] = '%' . $this->request->data['HotelBooking']['first_name'] . '%';
            }
            if (isset($this->request->data['HotelBooking']['last_name'])) {
                $conditions['HotelBooking.last_name LIKE '] = '%' . $this->request->data['HotelBooking']['last_name'] . '%';
            }
            if (isset($this->request->data['HotelBooking']['name'])) {
                $conditions['HotelBooking.name LIKE '] = '%' . $this->request->data['HotelBooking']['name'] . '%';
            }
            if (isset($this->request->data['HotelBooking']['email'])) {
                $conditions['HotelBooking.email LIKE '] = '%' . $this->request->data['HotelBooking']['email'] . '%';
            }
            if (isset($this->request->data['HotelBooking']['status'])) {
                $conditions['HotelBooking.status'] = $this->request->data['HotelBooking']['status'];
            }
        }
        $this->Session->write('HotelBookingSearch', $this->request->data['HotelBooking']);
    }
    $this->AutoPaginate->setPaginate(array(
        'order' => ' HotelBooking.id DESC',
        'conditions' => $conditions
    ));
    $this->loadModel('HotelBooking');
    $this->set('voucher', $voucher);
    $this->set('hotelBookings', $this->paginate('HotelBooking'));

}

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function view($id = null,$voucher = '') {
    if (!$this->HotelBooking->exists($id)) {
        $this->Message->setWarning(__('Invalid hotel booking'),array('action'=>'index'));
    }
    $options = array('conditions' => array('HotelBooking.' . $this->HotelBooking->primaryKey => $id));
    $this->set('voucher', $voucher);
    $this->set('hotelBooking', $this->HotelBooking->find('first', $options));
}

/**
* add method
*
* @return void
*/
public function add() {
    $this->loadModel('GstParameter');
    $gst_value = $this->GstParameter->findByName('hotel');
    $config_gst = $gst_value['GstParameter']['value'];            
    if ($this->request->is('post')) {
        $payment_gst = (int)get_gst_amount($this->request->data['HotelBooking']['price'],$config_gst);
        $this->request->data['HotelBooking']['payment_with_gst'] = $payment_gst;
        if($this->request->data['HotelBooking']['payment_received'] > $this->request->data['HotelBooking']['payment_with_gst']){
            $this->Message->setWarning(__('Please enter valid payment detail,payment received is more than total payment.'));
            return $this->redirect(Router::url( $this->referer(), true ));
        }
        $this->HotelBooking->create();
        $this->request->data['HotelBooking']['invoice_no'] = $invoice_no = $this->get_invoice_no();
        
        if ($this->HotelBooking->save($this->request->data)) {

            $voucher['all_t_and_c'] = $voucher['booking_id'] = '';
            $voucher['company_signature'] = $voucher['company_name'] = Configure::read('Site.Name');
            $tour_types = Configure::read('tour_types');
            $gst_percent = $voucher['gst_percent'] = $config_gst;    
            $this->loadModel("Customer");$this->loadModel("Tour");$this->loadModel("Account");
            $options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $this->request->data['HotelBooking']['customer_id']));
            $customer_data = $this->Customer->find('first', $options);
            $toptions = array('conditions' => array('Tour.' . $this->Tour->primaryKey => $customer_data['Customer']['package_id']));
            $package = $this->Tour->find('first', $toptions);
            $voucher['total_payment_sum'] = $total_payment_sum = $account_data['payment_amount'] = $this->request->data['HotelBooking']['price'];
            $voucher['final_payment_with_gst'] = $account_data['total_payment_with_gst'] = get_gst_amount($total_payment_sum,$gst_percent);
            $voucher['customer_tour_type'] = $tour_types[$package['Tour']['type']];
            $voucher['customer_tour_name'] = $package['Tour']['name'];
            $voucher['meal_type'] = $this->request->data['HotelBooking']['meal_type'];
            $voucher['room_type'] = $this->request->data['HotelBooking']['room_type'];
            $voucher['customer_contact_no'] = $customer_data['Customer']['mobile'];
            $voucher['payment_type'] = 'cash';
            $voucher['special_remark'] = $this->request->data['HotelBooking']['special_remark'];
            $voucher['redirect'] = 'hotel_details';
            $voucher['invoice_no'] = $invoice_no;

            $this->loadModel('Hotel');
            $hotel_name = $this->Hotel->findById($this->request->data['HotelBooking']['hotel_id'],'name');
            $voucher['hotel_name'] = $hotel_name['Hotel']['name'];
            $voucher['payment_recieved']  = $this->request->data['HotelBooking']['payment_received'];
            $account_data['customer_name'] = $voucher['customer_signature'] = $voucher['customer_full_name'] = $customer_data['Customer']['name'];
            $account_data['ac_type'] = 'hotel';
            $account_data['cus_id'] = $customer_data['Customer']['id'];
            $account_data['ac_type_id'] = $this->HotelBooking->getLastInsertID();
            $account_data['invoice_no'] = $invoice_no;
            $voucher['check_in_date'] = $this->request->data['HotelBooking']['check_in_date'];
            $voucher['check_out_date'] = $this->request->data['HotelBooking']['check_out_date'];
            $voucher['city_id'] = $this->request->data['HotelBooking']['city_id'];
            $voucher['state_id'] = $this->request->data['HotelBooking']['state_id'];
            $voucher['nights'] = $this->request->data['HotelBooking']['nights'];            
            $account_data['payment_recieved'] = $voucher['payment_recieved'];
            $account_data['payment_receivable'] = $account_data['total_payment_with_gst'] - $account_data['payment_recieved'];
            $this->Account->save($account_data);
            $voucher['ac_id'] = $ac_id = $this->Account->getLastInsertID();
            $this->HotelBooking->id = $this->HotelBooking->getLastInsertID();
            $this->HotelBooking->saveField('ac_id',$ac_id);    
            $this->Message->setSuccess(__('The Hotel detail has been saved.'));
            $states = $this->HotelBooking->State->find('list');
            $cities = $this->HotelBooking->City->find('list');
            $this->set(compact('voucher','states','cities'));
            $this->layout = 'pdf';
            $this->render('/Pdf/hotel_receipt');
            $this->render('/Pdf/generate_hotel_voucher');
            $arrData['Customer']['text'] = 'Hotel '. $invoice_no;
            $arrData['Customer']['email'] = $customer_data['Customer']['email'];
            $arrData['Customer']['name'] = $customer_data['Customer']['name'];
            $arrData['Customer']['booking_type'] = 'hotel';           

            $this->Message->setSuccess(__('The hotel booking has been saved.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The hotel booking could not be saved. Please, try again.'));
        }
    }
    $states = $this->HotelBooking->State->find('list');
    $cities = [];
    $hotels = [];
    $customers = $this->HotelBooking->Customer->find('list');
    $this->set(compact('cities', 'states', 'hotels', 'customers','config_gst'));
}

/**
* edit method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function edit($id = null,$voucher = '') {
    if (!$this->HotelBooking->exists($id)) {
        $this->Message->setWarning(__('Invalid hotel booking'),array('action'=>'index'));
    }
    $flag = $voucher;
    $options = array('conditions' => array('HotelBooking.' . $this->HotelBooking->primaryKey => $id));
    $hotel_booking = $this->HotelBooking->find('first', $options);
    $this->loadModel('GstParameter');
    $gst_value = $this->GstParameter->findByName('hotel');
    $config_gst = $gst_value['GstParameter']['value']; 
    if ($this->request->is(array('post', 'put'))) {
        $payment_gst = (int)get_gst_amount($this->request->data['HotelBooking']['price'],$config_gst);
        $this->request->data['HotelBooking']['payment_with_gst'] = $payment_gst;
        if($this->request->data['HotelBooking']['payment_received'] > $this->request->data['HotelBooking']['payment_with_gst']){
            $this->Message->setWarning(__('Please enter valid payment detail,payment received is more than total payment.'));
            return $this->redirect(Router::url( $this->referer(), true ));
        }
        $this->request->data['HotelBooking']['invoice_no'] = $invoice_no = $this->get_invoice_no();
        if ($this->HotelBooking->save($this->request->data)) {
            $voucher['all_t_and_c'] = $voucher['booking_id'] = '';
            $voucher['company_signature'] = $voucher['company_name'] = Configure::read('Site.Name');
            $tour_types = Configure::read('tour_types');
            $gst_percent = $voucher['gst_percent'] = $config_gst;    
            $this->loadModel("Customer");$this->loadModel("Tour");$this->loadModel("Account");$this->loadModel('Hotel');
            $options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $this->request->data['HotelBooking']['customer_id']));
            $customer_data = $this->Customer->find('first', $options);
            $toptions = array('conditions' => array('Tour.' . $this->Tour->primaryKey => $customer_data['Customer']['package_id']));
            $package = $this->Tour->find('first', $toptions);
            $voucher['total_payment_sum'] = $total_payment_sum = $account_data['payment_amount'] = $this->request->data['HotelBooking']['price'];
            $voucher['final_payment_with_gst'] = $account_data['total_payment_with_gst'] = get_gst_amount($total_payment_sum,$gst_percent);
            $voucher['customer_tour_type'] = $tour_types[$package['Tour']['type']];
            $voucher['customer_tour_name'] = $package['Tour']['name'];
            $voucher['meal_type'] = $this->request->data['HotelBooking']['meal_type'];
            $voucher['room_type'] = $this->request->data['HotelBooking']['room_type'];
            $voucher['special_remark'] = $this->request->data['HotelBooking']['special_remark'];
            $voucher['customer_contact_no'] = $customer_data['Customer']['mobile'];
            $voucher['payment_type'] = 'cash';
            $voucher['redirect'] = 'hotel_details';
            $voucher['invoice_no'] = $invoice_no;
            $voucher['ac_id'] = $ac_id = $hotel_booking['HotelBooking']['ac_id'];
            $voucher['payment_recieved']  = $this->request->data['HotelBooking']['payment_received'];
            
            $this->Account->id = $ac_id;
            $account_data['customer_name'] = $voucher['customer_signature'] = $voucher['customer_full_name'] = $customer_data['Customer']['name'];
            $account_data['invoice_no'] = $invoice_no;;
            $account_data['payment_recieved'] = $voucher['payment_recieved'];
            $account_data['payment_receivable'] = $account_data['total_payment_with_gst'] - $account_data['payment_recieved'];
            $this->Account->save($account_data);

            $hotel_name = $this->Hotel->findById($this->request->data['HotelBooking']['hotel_id'],'name');
            $voucher['hotel_name'] = $hotel_name['Hotel']['name'];
            $voucher['check_in_date'] = $this->request->data['HotelBooking']['check_in_date'];
            $voucher['check_out_date'] = $this->request->data['HotelBooking']['check_out_date'];
            $voucher['city_id'] = $this->request->data['HotelBooking']['city_id'];
            $voucher['state_id'] = $this->request->data['HotelBooking']['state_id'];
            $voucher['nights'] = $this->request->data['HotelBooking']['nights'];
            $states = $this->HotelBooking->State->find('list');
            $cities = $this->HotelBooking->City->find('list');
            $this->set(compact('voucher','states','cities'));
            $this->layout = 'pdf';
            $this->render('/Pdf/hotel_receipt');
            $this->render('/Pdf/generate_hotel_voucher');

            $this->Message->setSuccess(__('The hotel booking has been updated.'));
            if(empty($flag)){
                return $this->redirect(array('action' => 'index'));
            }else{
                return $this->redirect(array('action' => 'index','voucher'));
            }
        } else {
            $this->Message->setWarning(__('The hotel booking could not be updated. Please, try again.'));
        }
    } else {
        $this->request->data = $hotel_booking ;
    }
    $states = $this->HotelBooking->State->find('list');
    $cities = $this->HotelBooking->City->find('list',array('conditions'=>array('City.state_id' => $this->request->data['HotelBooking']['state_id']))); 
    $hotels = $this->HotelBooking->Hotel->find('list',array('conditions'=>array('Hotel.city_id' => $this->request->data['HotelBooking']['city_id']))); 
    $customers = $this->HotelBooking->Customer->find('list');
    $this->set(compact('cities', 'states', 'hotels', 'customers','config_gst','voucher'));
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
    $this->HotelBooking->id = $id;
    if (!$this->HotelBooking->exists()) {
        $this->Message->setWarning(__('Invalid hotel booking'),array('action'=>'index'));
    }
    if ($this->HotelBooking->delete()) {
        $this->Message->setSuccess(__('The hotel booking has been deleted.'));
    } else {
        $this->Message->setWarning(__('The hotel booking could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}

public function sendVoucher($id , $voucher = '')
{
    if (empty($id)) {
        $this->Message->setWarning(__('The hotel booking could not be found. Please, try again.'));
    } else {
        $this->loadModel('Booking');
        $options = array('conditions' => array('HotelBooking.' . $this->HotelBooking->primaryKey => $id));
        $hotel_booking = $this->HotelBooking->find('first', $options);
        $invoice_no = $hotel_booking['HotelBooking']['invoice_no'];
        $ac_id = $hotel_booking['HotelBooking']['ac_id'];
        $this->loadModel("Customer");
        $options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $hotel_booking['HotelBooking']['customer_id']));
        $customer_data = $this->Customer->find('first', $options);
        $arrData['Customer']['text'] = 'Hotel '. $invoice_no;
        $arrData['Customer']['email'] = $customer_data['Customer']['email'];
        $arrData['Customer']['name'] = $customer_data['Customer']['name'];
        $arrData['Customer']['booking_type'] = 'hotel';
         if(empty($voucher)){
            $pdfpath = array(ROOT_DIR.RECEIPT_PATH.$ac_id.DS.$invoice_no.'.pdf',ROOT_DIR.HOTEL_VOUCHER_PATH.$ac_id.PDF_FILE);
        }else{
            $pdfpath = array(ROOT_DIR.HOTEL_VOUCHER_PATH.$ac_id.PDF_FILE);
        }
        $this->sendNewFormateMail($arrData,'Hotel Booking',$pdfpath);                  
        $this->Message->setSuccess(__('The voucher & receipt has been sent successfully.'));
    }
    if(empty($voucher)){
        return $this->redirect(array('action' => 'index'));
    }else{
        return $this->redirect(array('action' => 'index','voucher'));
    }   
}


}
