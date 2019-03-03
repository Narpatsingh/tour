<?php
App::uses('AppController', 'Controller');
/**
 * Bookings Controller
 *
 * @property Booking $Booking
 * @property PaginatorComponent $Paginator
 */
class BookingsController extends AppController {

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
        $this->Session->write('BookingSearch', '');
    }
    if (empty($this->request->data['Booking']) && $this->Session->read('BookingSearch')) {
        $this->request->data['Booking'] = $this->Session->read('BookingSearch');
    }
    if (!empty($this->request->data['Booking'])) {
        $this->request->data['Booking'] = array_filter($this->request->data['Booking']);
        $this->request->data['Booking'] = array_map('trim', $this->request->data['Booking']);
        if (!empty($this->request->data)) {
            if (isset($this->request->data['Booking']['name'])) {
                $conditions['Booking.customer_full_name LIKE '] = '%' . $this->request->data['Booking']['name'] . '%';
            }
        }
        $this->Session->write('BookingSearch', $this->request->data['Booking']);
    }

    $this->AutoPaginate->setPaginate(array(
        'order' => ' Booking.id DESC',
        'conditions' => $conditions
    ));
    $this->loadModel('Booking');
    $this->set('bookings', $this->paginate('Booking'));

}

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function view($id = null) {
    if (!$this->Booking->exists($id)) {
        $this->Message->setWarning(__('Invalid booking'),array('action'=>'index'));
    }
    $options = array('conditions' => array('Booking.' . $this->Booking->primaryKey => $id));
    $this->set('booking', $this->Booking->find('first', $options));
}

/**
* add method
*
* @return void
*/
public function add($id=null) {
    
    if ($this->request->is('post')) {
        $this->Booking->create();
        $this->request->data['Booking']['enquiry_id'] = decrypt($id);
        $this->request->data['Booking']['invoice_no'] = $invoice_no = $this->get_invoice_no();
        if ($this->Booking->save($this->request->data)) {
            //ToDo : Generate Receipt.
            $config_gst = Configure::read('Site.gst_percent');
            $gst_percent = $voucher['gst_percent'] = empty($config_gst)?10:$config_gst;
            $payment2 = empty($this->request->data['Booking']['total_payment2'])?0:$this->request->data['Booking']['total_payment2'];
            $payment3 = empty($this->request->data['Booking']['total_payment3'])?0:$this->request->data['Booking']['total_payment3'];
            $this->request->data['Booking']['total_payment_sum'] = $total_payment_sum = $this->request->data['Booking']['total_payment'] + $payment2 + $payment3;        
            $this->request->data['Booking']['final_payment_with_gst'] = get_gst_amount($total_payment_sum,$gst_percent);
            $this->request->data['Booking']['gst_percent'] = $gst_percent;
            $this->loadModel("Account");
            $account_data['customer_name'] = $this->request->data['Booking']['customer_full_name'];
            $account_data['ac_type_id'] = $this->Booking->getLastInsertID();
            $account_data['payment_amount'] = $total_payment_sum;
            $account_data['ac_type'] = 'tour';
            $account_data['cus_id'] = $this->request->data['Booking']['customer_id'];
            $account_data['total_payment_with_gst'] = $this->request->data['Booking']['final_payment_with_gst'];
            $account_data['payment_recieved'] = $this->request->data['Booking']['payment_recieved'];
            $account_data['payment_receivable'] = $this->request->data['Booking']['final_payment_with_gst'] - $this->request->data['Booking']['payment_recieved'];
            $this->Account->save($account_data);
            $ac_id = $this->Account->getLastInsertID();
            $this->Booking->id = $this->Booking->getLastInsertID();
            $this->Booking->saveField('ac_id',$ac_id);
            if(!empty($this->request->data['GuestMember'])){
            $this->request->data['GuestMember']['booking_id'] = $this->Booking->getLastInsertID();
            $this->loadModel("GuestMember");
            $this->GuestMember->save($this->request->data['GuestMember']);
            $voucher = $this->request->data['Booking'];
            $voucher['ac_id'] = $ac_id;            
            $pdfpath = '';
            if(!empty($this->request->data['Booking']['generate_receipt'])){
            $this->set(compact('voucher'));    
            $pcount = $this->request->data['Booking']['package_count'];
            if($pcount==1){
            $this->render('/Pdf/tour_receipt');     
            }else{
            $this->render('/Pdf/tour_receipt'.$pcount);         
            }
            $pdfpath = array(ROOT_DIR.RECEIPT_PATH.$ac_id.DS.$invoice_no.'.pdf');
            }
            $arrData['Customer']['text'] = 'Tour ';
            $arrData['Customer']['email'] = $this->request->data['Booking']['customer_email_id'];
            $arrData['Customer']['name'] = $this->request->data['Booking']['customer_full_name'];
            $arrData['Customer']['booking_type'] = 'Tour Booking';
            $this->sendNewFormateMail($arrData,'Tour Booking',$pdfpath);

            }
            $this->Message->setSuccess(__('The booking has been saved.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The booking could not be saved. Please, try again.'));
        }
    }else{
        if(!empty($id)){
            $id = decrypt($id);
            $this->loadModel("Tour");$this->loadModel("Enquiry");$this->loadModel("GuestMember");
            $options = array('conditions' => array('Enquiry.' . $this->Enquiry->primaryKey => $id));
            $enquiries = $this->Enquiry->find('first', $options);
            $tour_id = explode( ',', $enquiries['Customer']['multi_package'] );
            $pcount = count( $tour_id );
            $toptions = array('conditions' => array('Tour.' . $this->Tour->primaryKey => $tour_id));
            $packages = $this->Tour->find('all', $toptions);
            foreach ($packages as $key => $package) {
            $apn = empty($key)?'':$key+1;

            $this->loadModel('Place');
            $place_id = explode(',', $package['Tour']['place_id']);
            $place_name = $this->Place->findById($place_id[0],'name');
            $this->request->data['Booking']['place_name'.$apn] =  $place_name['Place']['name'];
            $this->request->data['Booking']['tour_photo'.$apn] =  $package['Tour']['img'];
            $this->request->data['Booking']['total_payment'.$apn] =  $package['Tour']['price'];
            $this->request->data['Booking']['customer_tour_name'.$apn] = $package['Tour']['name'];
            }
            $this->request->data['Booking']['customer_id'] = $enquiries['Customer']['id'];
            $this->request->data['Booking']['customer_full_name'] = $enquiries['Customer']['name'];
            $this->request->data['Booking']['customer_date_of_birth'] = $enquiries['Customer']['dob'];
            $this->request->data['Booking']['customer_contact_no'] = $enquiries['Customer']['mobile'];
            $this->request->data['Booking']['customer_email_id'] = $enquiries['Customer']['email'];
            $this->request->data['Booking']['total_tour_member'] = $enquiries['Customer']['member'];
            $this->request->data['Booking']['customer_emergency_contact_no'] =  $enquiries['Customer']['emergency_mobile'];
            $this->request->data['Booking']['customer_valid_id_proof'] = $enquiries['Customer']['dob_proof'];
            $this->request->data['Booking']['customer_tour_date'] = $enquiries['Enquiry']['travel_date'];
            $this->request->data['Booking']['package_count'] = $pcount;
        }        
        $this->request->data['Booking']['id'] = 0;
        $this->request->data['Booking']['proof_file'] = '';
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
    if (!$this->Booking->exists($id)) {
        $this->Message->setWarning(__('Invalid booking'),array('action'=>'index'));
    }
    if ($this->request->is(array('post', 'put'))) {
        if ($this->Booking->save($this->request->data)) {
            $this->Message->setSuccess(__('The booking has been updated.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The booking could not be updated. Please, try again.'));
        }
    } else {
        $options = array('conditions' => array('Booking.' . $this->Booking->primaryKey => $id));
        $this->request->data = $this->Booking->find('first', $options);
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
    $this->Booking->id = $id;
    if (!$this->Booking->exists()) {
        $this->Message->setWarning(__('Invalid booking'),array('action'=>'index'));
    }
    if ($this->Booking->delete()) {
        $this->Message->setSuccess(__('The booking has been deleted.'));
    } else {
        $this->Message->setWarning(__('The booking could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}
    public function approve($bid,$eid){
        $this->Booking->id = $bid;
        if (!$this->Booking->exists()) {
        $this->Message->setWarning(__('Invalid Booking'),array('action'=>'index/all'));
        }
        if ($this->Booking->saveField('is_approved','Yes')) {
        $this->loadModel('Tour');$this->loadModel('Enquiry');
        $options = array('conditions' => array('Enquiry.' . $this->Enquiry->primaryKey => $eid));
        $booking =  $this->Enquiry->find('first', $options);
        $tour_id = $booking['Customer']['package_id'];
        $toptions = array('conditions' => array('Tour.' . $this->Tour->primaryKey => $tour_id));
        $package = $this->Tour->find('first', $toptions);
        $id = $eid;
        $this->set(compact('package','id','Booking'));
        /*$this->layout = 'pdf';
        $this->render('/Pdf/generate_receipt');
        $pdfpath = ROOT_DIR.PDF_PATH.$eid.PDF_FILE;
        $this->sendMail($booking,'Quick Booking For Travel',$pdfpath);*/
            $this->Message->setSuccess(__('The Booking has been approved.'));
        } else {
            $this->Message->setWarning(__('The Booking could not be approved. Please, try again.'));
        }        
        return $this->redirect(array('controller' => 'vouchers','action' => 'add',encrypt($bid)));
    }

    public function reject($id = null) {
        $this->Booking->id = $id;
        if (!$this->Booking->exists()) {
        $this->Message->setWarning(__('Invalid Booking'),array('action'=>'index/all'));
        }
        if ($this->Booking->saveField('is_approved','No')) {
            $this->Message->setSuccess(__('The Booking has been rejected.'));
        } else {
            $this->Message->setWarning(__('The Booking could not be rejected. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }    
}
