<?php
App::uses('AppController', 'Controller');
/**
 * Vouchers Controller
 *
 * @property Voucher $Voucher
 * @property PaginatorComponent $Paginator
 */
class VouchersController extends AppController {

/**
 * Components
 *
 * @var array
 */
public $components = array('Paginator','RequestHandler');

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
        $this->Session->write('VoucherSearch', '');
    }

    if (empty($this->request->data['Voucher']) && $this->Session->read('VoucherSearch')) {
        $this->request->data['Voucher'] = $this->Session->read('VoucherSearch');
    }
    if (!empty($this->request->data['Voucher'])) {
        $this->request->data['Voucher'] = array_filter($this->request->data['Voucher']);
        $this->request->data['Voucher'] = array_map('trim', $this->request->data['Voucher']);
        if (!empty($this->request->data)) {
            if (isset($this->request->data['Voucher']['customer_full_name'])) {
                $conditions['Voucher.customer_full_name LIKE '] = '%' . $this->request->data['Voucher']['customer_full_name'] . '%';
            }
            if (isset($this->request->data['Voucher']['last_name'])) {
                $conditions['Voucher.last_name LIKE '] = '%' . $this->request->data['Voucher']['last_name'] . '%';
            }
            if (isset($this->request->data['Voucher']['name'])) {
                $conditions['Voucher.name LIKE '] = '%' . $this->request->data['Voucher']['name'] . '%';
            }
            if (isset($this->request->data['Voucher']['email'])) {
                $conditions['Voucher.email LIKE '] = '%' . $this->request->data['Voucher']['email'] . '%';
            }
            if (isset($this->request->data['Voucher']['status'])) {
                $conditions['Voucher.status'] = $this->request->data['Voucher']['status'];
            }
        }
        $this->Session->write('VoucherSearch', $this->request->data['Voucher']);
    }
    $this->AutoPaginate->setPaginate(array(
        'order' => ' Voucher.id DESC',
        'conditions' => $conditions
    ));
    $this->loadModel('Voucher');
    $this->set('vouchers', $this->paginate('Voucher'));

}

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function view($id = null) {
    if (!$this->Voucher->exists($id)) {
        $this->Message->setWarning(__('Invalid voucher'),array('action'=>'index'));
    }
    $options = array('conditions' => array('Voucher.' . $this->Voucher->primaryKey => $id));
    $this->set('voucher', $this->Voucher->find('first', $options));
}

/**
* add method
*
* @return void
*/
public function add($id=null) {
    $id = $booking_id = ( ! filter_var($id, FILTER_VALIDATE_INT) )? (string) decrypt($id) : (string) $id;
    $this->loadModel("Booking");
    if ($this->request->is('post')) {

        ini_set('max_execution_time', 6000);ini_set('memory_limit', '-1');
        $config_gst = Configure::read('Site.gst_percent');
        $this->loadModel('GstParameter');
        $gst_value = $this->GstParameter->findByName('tour');
        $config_gst = $gst_value['GstParameter']['value'];        
        $gst_percent = empty($config_gst)?10:$config_gst;
        $payment2 = empty($this->request->data['Voucher']['total_payment2'])?0:$this->request->data['Voucher']['total_payment2'];
        $payment3 = empty($this->request->data['Voucher']['total_payment3'])?0:$this->request->data['Voucher']['total_payment3'];
        $this->request->data['Voucher']['total_payment_sum'] = $total_payment_sum = $this->request->data['Voucher']['total_payment'] + $payment2 + $payment3;        
        $this->request->data['Voucher']['final_payment_with_gst'] = get_gst_amount($total_payment_sum,$gst_percent);
        $this->request->data['Voucher']['gst_percent'] = $gst_percent;
        $this->request->data['Voucher']['id'] = '';
        $this->Voucher->create();
        $this->request->data['Voucher']['invoice_no'] = $invoice_no = $this->get_invoice_no();
        $hotels = $hotels_data = $hotels_data2 = $hotels_data3 = array();
        if ($this->Voucher->save($this->request->data)) {   

            if(!empty($this->request->data['Hotel'])){
                $hotels = $this->request->data['Hotel'];
                $this->loadModel("VoucherHotel");
                $this->loadModel("Hotel");
                foreach ($hotels as $key => $hotel) {
                    $hotel["voucher_id"] = $this->Voucher->getLastInsertID();
                    $this->VoucherHotel->create();
                    $this->VoucherHotel->save($hotel);
                    $hotels_data[$key] = $this->Hotel->find('first', array('conditions' => array('Hotel.' . $this->Hotel->primaryKey => $hotel['hotel_id'])));
                    $hotels_data[$key]['HotelData'] = $hotel;
                }
            }
            if(!empty($this->request->data['Hotel2'])){
                $hotels2 = $this->request->data['Hotel2'];
                $this->loadModel("VoucherHotel");
                $this->loadModel("Hotel");
                foreach ($hotels2 as $key => $hotel) {
                    $hotel["voucher_id"] = $this->Voucher->getLastInsertID();
                    $this->VoucherHotel->create();
                    $this->VoucherHotel->save($hotel);
                    $hotels_data2[$key] = $this->Hotel->find('first', array('conditions' => array('Hotel.' . $this->Hotel->primaryKey => $hotel['hotel_id'])));
                    $hotels_data2[$key]['HotelData'] = $hotel;
                }
            }
            if(!empty($this->request->data['Hotel3'])){
                $hotels3 = $this->request->data['Hotel3'];
                $this->loadModel("VoucherHotel");
                $this->loadModel("Hotel");
                foreach ($hotels3 as $key => $hotel) {
                    $hotel["voucher_id"] = $this->Voucher->getLastInsertID();
                    $this->VoucherHotel->create();
                    $this->VoucherHotel->save($hotel);
                    $hotels_data3[$key] = $this->Hotel->find('first', array('conditions' => array('Hotel.' . $this->Hotel->primaryKey => $hotel['hotel_id'])));
                    $hotels_data3[$key]['HotelData'] = $hotel;
                }
            }            
            $this->Booking->id = $id;
            $this->Booking->saveField('is_approved','Yes');
            $this->loadModel("Account");
            $account_data['voucher_id'] = $this->Voucher->getLastInsertID();
            $account_data['payment_amount'] = $total_payment_sum;
            $account_data['ac_type'] = 'tour';
            $account_data['invoice_no'] = $invoice_no;
            $account_data['total_payment_with_gst'] = $this->request->data['Voucher']['final_payment_with_gst'];
            $account_data['payment_recieved'] = $this->request->data['Voucher']['payment_recieved'];
            $account_data['payment_receivable'] = $this->request->data['Voucher']['final_payment_with_gst'] - $this->request->data['Voucher']['payment_recieved'];
           // $this->Account->save($account_data);
            $ac_id =  $this->request->data['Voucher']['ac_id'];   
            $this->Booking->id = $id;
            $this->Booking->saveField('ac_id',$ac_id);
            $voucher = $this->request->data['Voucher'];
            $voucher['ac_id'] = $ac_id;
            $voucher['redirect'] = 'bookings';
            $pcount = $voucher['package_count'];
            $this->layout = 'pdf';
            $this->set(compact('voucher','hotels_data','hotels_data2','hotels_data3'));

            if($pcount==1){
            $this->render('/Pdf/generate_voucher');
            }else{
            $this->render('/Pdf/generate_voucher'.$pcount);
            }
            $pdfpath = ROOT_DIR.VOUCHER_PATH.$id.PDF_FILE;
            if(!empty($voucher['generate_receipt'])){
            $this->loadModel("Booking");
            $this->Booking->id = $id;
            $this->Booking->saveField('invoice_no',$invoice_no);                

            if($pcount==1){
            $this->render('/Pdf/tour_receipt');     
            }else{
            $this->render('/Pdf/tour_receipt'.$pcount);         
            }            
            $pdfpath = array(ROOT_DIR.RECEIPT_PATH.$ac_id.DS.$invoice_no.'.pdf', ROOT_DIR.VOUCHER_PATH.$id.PDF_FILE );
            if(!empty($this->request->data['Voucher']['all_t_and_c'])){
            $this->layout = 'pdf';
            $this->set(compact('voucher'));
            $this->render('/Pdf/generate_terms_and_conditions');    
            $pdfpath = array(ROOT_DIR.RECEIPT_PATH.$ac_id.DS.$invoice_no.'.pdf', ROOT_DIR.VOUCHER_PATH.$booking_id.PDF_FILE , ROOT_DIR.TNCPATH.$booking_id.TNC_FILE );
            }
            }
            $this->loadModel('Enquiry');
            $options = array('conditions' => array('Enquiry.' . $this->Enquiry->primaryKey => $voucher['enc_id']));
            //$booking =  $this->Enquiry->find('first', $options);            
            
            $arrData['Customer']['text'] = 'Tour'. $invoice_no;
            $arrData['Customer']['email'] = $this->request->data['Voucher']['customer_email_id'];
            $arrData['Customer']['name'] = $this->request->data['Voucher']['customer_full_name'];
            $arrData['Customer']['booking_type'] = 'Tour';

            $this->sendNewFormateMail($arrData,'Tour Booking For Travel',$pdfpath);
            

            $this->Message->setSuccess(__('The voucher has been saved.'));
            return $this->redirect(array('controller' => 'bookings','action' => 'index'));
        } else {
            $this->Message->setWarning(__('The voucher could not be saved. Please, try again.'));
        }
    }else{
        if(!empty($id)){
            $options = array('conditions' => array('Booking.' . $this->Booking->primaryKey => $id));
            $bookings = $this->Booking->find('first', $options);

            $this->loadModel("Hotel");
            $hoptions = array('fields'=>array('Hotel.id','Hotel.name','Hotel.contact_no'),'conditions' => array('Hotel.' . $this->Hotel->primaryKey => explode(',', $bookings['Booking']['multi_hotel'])));
            $result = $this->Hotel->find('all', $hoptions);
            $hotels = Hash::extract($result,'{n}.Hotel');

            $hoptions2 = array('fields'=>array('Hotel.id','Hotel.name','Hotel.contact_no'),'conditions' => array('Hotel.' . $this->Hotel->primaryKey => explode(',', $bookings['Booking']['multi_hotel2'])));
            $result2 = $this->Hotel->find('all', $hoptions2);
            $hotels2 = Hash::extract($result2,'{n}.Hotel');

            $hoptions3 = array('fields'=>array('Hotel.id','Hotel.name','Hotel.contact_no'),'conditions' => array('Hotel.' . $this->Hotel->primaryKey => explode(',', $bookings['Booking']['multi_hotel3'])));
            $result3 = $this->Hotel->find('all', $hoptions3);
            $hotels3 = Hash::extract($result3,'{n}.Hotel');

            $this->set(compact('hotels','hotels2','hotels3'));
            $this->request->data['Voucher'] = $bookings['Booking'];
            $this->request->data['Voucher']['booking_id'] = $bookings['Booking']['id']; unset($this->request->data['Voucher']['id']);
            $this->request->data['Voucher']['enc_id'] = $bookings['Booking']['enquiry_id'];
            $this->request->data['Voucher']['ac_id'] = $bookings['Booking']['ac_id'];
            $this->request->data['Voucher']['customer_tour_type'] = $bookings['Booking']['tour_type'];
            $this->request->data['Voucher']['customer_email_id'] = $bookings['Booking']['customer_email_id'];
            $this->request->data['Voucher']['customer_tour_date'] = $bookings['Booking']['travel_date'];
            $this->request->data['Voucher']['customer_tour_name'] = $bookings['Booking']['customer_tour_name'];
            $this->request->data['Voucher']['customer_hotel_place_name'] = $bookings['Booking']['place_name'];
            $this->request->data['Voucher']['hotels'] = $bookings['Booking']['multi_hotel'];
            for ($i=2; $i <= $bookings['Booking']['package_count']; $i++) { 
            $this->request->data['Voucher']['customer_tour_type'.$i] = $bookings['Booking']['tour_type'.$i];
            $this->request->data['Voucher']['customer_tour_date'.$i] = $bookings['Booking']['travel_date'.$i];
            $this->request->data['Voucher']['customer_tour_name'.$i] = $bookings['Booking']['customer_tour_name'.$i];
            $this->request->data['Voucher']['customer_hotel_place_name'.$i] = $bookings['Booking']['place_name'.$i];

            }
        }
    }
}

/**
* edit method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function edit($id = null) {
    if (!$this->Voucher->exists($id)) {
        $this->Message->setWarning(__('Invalid voucher'),array('action'=>'index'));
    }
    if ($this->request->is(array('post', 'put'))) {
        
        if ($this->Voucher->save($this->request->data)) {

            if(!empty($this->request->data['Hotel'])){
                $hotels = $this->request->data['Hotel'];
                $this->loadModel("VoucherHotel");
                $this->loadModel("Hotel");
                foreach ($hotels as $key => $hotel) {
                    $hotel["voucher_id"] = $this->Voucher->getLastInsertID();
                    $this->VoucherHotel->create();
                    $this->VoucherHotel->save($hotel);
                    $hotels_data[$key] = $this->Hotel->find('first', array('conditions' => array('Hotel.' . $this->Hotel->primaryKey => $hotel['hotel_id'])));
                    $hotels_data[$key]['HotelData'] = $hotel;
                }
            }
            if(!empty($this->request->data['Hotel2'])){
                $hotels2 = $this->request->data['Hotel2'];
                $this->loadModel("VoucherHotel");
                $this->loadModel("Hotel");
                foreach ($hotels2 as $key => $hotel) {
                    $hotel["voucher_id"] = $this->Voucher->getLastInsertID();
                    $this->VoucherHotel->create();
                    $this->VoucherHotel->save($hotel);
                    $hotels_data2[$key] = $this->Hotel->find('first', array('conditions' => array('Hotel.' . $this->Hotel->primaryKey => $hotel['hotel_id'])));
                    $hotels_data2[$key]['HotelData'] = $hotel;
                }
            }
            if(!empty($this->request->data['Hotel3'])){
                $hotels3 = $this->request->data['Hotel3'];
                $this->loadModel("VoucherHotel");
                $this->loadModel("Hotel");
                foreach ($hotels3 as $key => $hotel) {
                    $hotel["voucher_id"] = $this->Voucher->getLastInsertID();
                    $this->VoucherHotel->create();
                    $this->VoucherHotel->save($hotel);
                    $hotels_data3[$key] = $this->Hotel->find('first', array('conditions' => array('Hotel.' . $this->Hotel->primaryKey => $hotel['hotel_id'])));
                    $hotels_data3[$key]['HotelData'] = $hotel;
                }
            }

            $config_gst = Configure::read('Site.gst_percent');
            $this->loadModel('GstParameter');
            $gst_value = $this->GstParameter->findByName('tour');
            $config_gst = $gst_value['GstParameter']['value'];            
            $gst_percent = empty($config_gst)?10:$config_gst;
            $payment2 = empty($this->request->data['Voucher']['total_payment2'])?0:$this->request->data['Voucher']['total_payment2'];
            $payment3 = empty($this->request->data['Voucher']['total_payment3'])?0:$this->request->data['Voucher']['total_payment3'];
            $this->request->data['Voucher']['total_payment_sum'] = $total_payment_sum = $this->request->data['Voucher']['total_payment'] + $payment2 + $payment3;        
            $this->request->data['Voucher']['final_payment_with_gst'] = get_gst_amount($total_payment_sum,$gst_percent);
            $this->request->data['Voucher']['gst_percent'] = $gst_percent;
            $this->request->data['Voucher']['invoice_no'] = $invoice_no = $this->get_invoice_no();

            $this->loadModel("Account");$this->loadModel("Booking");
            $account_data['voucher_id'] = $this->Voucher->getLastInsertID();
            $account_data['payment_amount'] = $total_payment_sum;
            $account_data['ac_type'] = 'tour';
            $account_data['invoice_no'] = $invoice_no;
            $account_data['total_payment_with_gst'] = $this->request->data['Voucher']['final_payment_with_gst'];
            $account_data['payment_recieved'] = $this->request->data['Voucher']['payment_recieved'];
            $account_data['payment_receivable'] = $this->request->data['Voucher']['final_payment_with_gst'] - $this->request->data['Voucher']['payment_recieved'];
            // $this->Account->save($account_data);
            $booking_id = $this->request->data['Voucher']['booking_id'];
            $ac_id =  $this->request->data['Voucher']['ac_id'];       
            $this->Booking->id = $booking_id;
            $this->Booking->saveField('ac_id',$ac_id);
            $voucher = $this->request->data['Voucher'];
            $voucher['ac_id'] = $ac_id;
            $voucher['redirect'] = 'bookings';
            $pcount = $voucher['package_count'];
            $this->layout = 'pdf';
            $this->set(compact('voucher'));
            if($pcount==1){
            $this->render('/Pdf/generate_voucher');     
            }else{
            $this->render('/Pdf/generate_voucher'.$pcount);         
            }
            $pdfpath = ROOT_DIR.VOUCHER_PATH.$booking_id.PDF_FILE;
            if(!empty($voucher['generate_receipt'])){
            $this->loadModel("Booking");
            $this->Booking->id = $booking_id;
            $this->Booking->saveField('invoice_no',$invoice_no);                
            if($pcount==1){
            $this->render('/Pdf/tour_receipt');     
            }else{
            $this->render('/Pdf/tour_receipt'.$pcount);         
            }
            $pdfpath = array(ROOT_DIR.RECEIPT_PATH.$ac_id.DS.$invoice_no.'.pdf', ROOT_DIR.VOUCHER_PATH.$booking_id.PDF_FILE );

            if(!empty($this->request->data['Voucher']['all_t_and_c'])){
            $this->layout = 'pdf';
            $this->set(compact('voucher'));
            $this->render('/Pdf/generate_terms_and_conditions');    
            $pdfpath = array(ROOT_DIR.RECEIPT_PATH.$ac_id.DS.$invoice_no.'.pdf', ROOT_DIR.VOUCHER_PATH.$booking_id.PDF_FILE , ROOT_DIR.TNCPATH.$booking_id.TNC_FILE );
            }

            }
            $this->loadModel('Enquiry');
            $options = array('conditions' => array('Enquiry.' . $this->Enquiry->primaryKey => $voucher['enc_id']));
            //$booking =  $this->Enquiry->find('first', $options);            
            
            $arrData['Customer']['text'] = 'Tour'. $invoice_no;
            $arrData['Customer']['email'] = $this->request->data['Voucher']['customer_email_id'];
            $arrData['Customer']['name'] = $this->request->data['Voucher']['customer_full_name'];
            $arrData['Customer']['booking_type'] = 'Tour';

            $this->sendNewFormateMail($arrData,'Tour Booking For Travel',$pdfpath);    

            $this->Message->setSuccess(__('The voucher has been updated.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The voucher could not be updated. Please, try again.'));
        }
    } else {
        $options = array('conditions' => array('Voucher.' . $this->Voucher->primaryKey => $id));
        $this->request->data = $this->Voucher->find('first', $options);
        if(!empty($this->request->data['Hotel'])){
            $this->set('hotels',$this->request->data['Hotel']);
        }
            $this->loadModel("Hotel");
            $hoptions = array('fields'=>array('Hotel.id','Hotel.name','Hotel.contact_no'),'conditions' => array('Hotel.' . $this->Hotel->primaryKey => explode(',', $this->request->data['Voucher']['multi_hotel'])));
            $result = $this->Hotel->find('all', $hoptions);
            $hotels = Hash::extract($result,'{n}.Hotel');

            $hoptions2 = array('fields'=>array('Hotel.id','Hotel.name','Hotel.contact_no'),'conditions' => array('Hotel.' . $this->Hotel->primaryKey => explode(',', $this->request->data['Voucher']['multi_hotel2'])));
            $result2 = $this->Hotel->find('all', $hoptions2);
            $hotels2 = Hash::extract($result2,'{n}.Hotel');

            $hoptions3 = array('fields'=>array('Hotel.id','Hotel.name','Hotel.contact_no'),'conditions' => array('Hotel.' . $this->Hotel->primaryKey => explode(',', $this->request->data['Voucher']['multi_hotel3'])));
            $result3 = $this->Hotel->find('all', $hoptions3);
            $hotels3 = Hash::extract($result3,'{n}.Hotel');

            $this->set(compact('hotels','hotels2','hotels3'));
        
    }
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
    $this->Voucher->id = $id;
    if (!$this->Voucher->exists()) {
        $this->Message->setWarning(__('Invalid voucher'),array('action'=>'index'));
    }
    if ($this->Voucher->delete()) {
        $this->Message->setSuccess(__('The voucher has been deleted.'));
    } else {
        $this->Message->setWarning(__('The voucher could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}

public function save_jspdf_file($id,$invoice_no) {
    if ($this->request->is('ajax')) {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $this->autoLayout = false;

        if(empty($this->request->form['pdf']['tmp_name'])){
            return false;
        }else{
            $pdf_path = APP . 'webroot/files/receipt' . DS . $id;
            createFolder($pdf_path); 
            $file_path = $pdf_path . DS .''.$invoice_no.'.pdf';
            if(move_uploaded_file($this->request->form['pdf']['tmp_name'],$file_path)){
            return true;
            }
        }

    }
    else{
        return $this->redirect('index');
    }
}

public function sendVoucher($id)
{
    if (empty($id)) {
        $this->Message->setWarning(__('The voucher could not be found. Please, try again.'));
    } else {
        $pdfpath = ROOT_DIR.VOUCHER_PATH.$id.PDF_FILE;
        $this->loadModel('Booking');
        $options = array('conditions' => array('Booking.' . $this->Booking->primaryKey => $id));
        $booking = $this->Booking->find('first', $options);
        $arrData['Customer']['text'] = 'Tour ';
        $arrData['Customer']['email'] = $booking['Booking']['customer_email_id'];
        $arrData['Customer']['name'] = $booking['Booking']['customer_full_name'];
        $arrData['Customer']['booking_type'] = 'Tour';
        $this->sendNewFormateMail($arrData,'Tour Booking For Travel',$pdfpath);        
        $this->Message->setSuccess(__('The voucher has been sent successfully.'));
    }
    return $this->redirect(array('action' => 'index'));     
}

}