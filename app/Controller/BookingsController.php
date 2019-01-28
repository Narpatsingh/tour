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
            if (isset($this->request->data['Booking']['first_name'])) {
                $conditions['Booking.first_name LIKE '] = '%' . $this->request->data['Booking']['first_name'] . '%';
            }
            if (isset($this->request->data['Booking']['last_name'])) {
                $conditions['Booking.last_name LIKE '] = '%' . $this->request->data['Booking']['last_name'] . '%';
            }
            if (isset($this->request->data['Booking']['name'])) {
                $conditions['Booking.name LIKE '] = '%' . $this->request->data['Booking']['name'] . '%';
            }
            if (isset($this->request->data['Booking']['email'])) {
                $conditions['Booking.email LIKE '] = '%' . $this->request->data['Booking']['email'] . '%';
            }
            if (isset($this->request->data['Booking']['status'])) {
                $conditions['Booking.status'] = $this->request->data['Booking']['status'];
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
        $this->request->data['Booking']['place_name'.$apn] =  $package['Tour']['place'];
        $this->request->data['Booking']['tour_photo'.$apn] =  $package['Tour']['img'];
        $this->request->data['Booking']['total_payment'.$apn] =  $package['Tour']['price'];
        $this->request->data['Booking']['customer_tour_name'.$apn] = $package['Tour']['name'];
        }
        $this->request->data['Booking']['customer_full_name'] = $enquiries['Customer']['name'];
        $this->request->data['Booking']['customer_date_of_birth'] = $enquiries['Customer']['dob'];
        $this->request->data['Booking']['customer_contact_no'] = $enquiries['Customer']['mobile'];
        $this->request->data['Booking']['customer_email_id'] = $enquiries['Customer']['email'];
        $this->request->data['Booking']['total_tour_member '] = $enquiries['Enquiry']['number_of_guest'];
        $this->request->data['Booking']['customer_emergency_contact_no'] =  $enquiries['Customer']['emergency_mobile'];
        $this->request->data['Booking']['customer_valid_id_proof'] = $enquiries['Customer']['dob_proof'];
        $this->request->data['Booking']['customer_tour_date'] = $enquiries['Enquiry']['time_of_travel'];
        $this->request->data['Booking']['total_tour_member'] = $enquiries['Enquiry']['number_of_guest'];
        $this->request->data['Booking']['package_count'] = $pcount;
    }
    if ($this->request->is('post')) {
        $this->Booking->create();
        $this->request->data['Booking']['enquiry_id'] = $id;
        if ($this->Booking->save($this->request->data)) {
            if(!empty($this->request->data['GuestMember'])){
            $this->request->data['GuestMember']['booking_id'] = $this->Booking->getLastInsertID();
            $this->GuestMember->save($this->request->data['GuestMember']);            
            }
            $this->Message->setSuccess(__('The booking has been saved.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The booking could not be saved. Please, try again.'));
        }
    }else{
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
