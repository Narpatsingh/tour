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
            if (isset($this->request->data['Voucher']['first_name'])) {
                $conditions['Voucher.first_name LIKE '] = '%' . $this->request->data['Voucher']['first_name'] . '%';
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
        $id = decrypt($id);
    if ($this->request->is('post')) {
        ini_set('max_execution_time', 6000);ini_set('memory_limit', '-1');
        $this->Voucher->create();
        $this->request->data['Voucher']['invoice_no'] = get_invoice_no();
        if ($this->Voucher->save($this->request->data)) {

            $voucher = $this->request->data['Voucher'];
            $pcount = $voucher['package_count'];
            $this->layout = 'pdf';
            $this->set(compact('voucher'));
            if($pcount==1){
            $this->render('/Pdf/generate_voucher');     
            }else{
            $this->render('/Pdf/generate_voucher'.$pcount);         
            }

            $pdfpath = ROOT_DIR.VOUCHER_PATH.$id.PDF_FILE;
            if(!empty($voucher['generate_receipt'])){
            $this->render('/Pdf/generate_receipt');     
            $pdfpath = array(ROOT_DIR.RECEIPT_PATH.$id.PDF_FILE, ROOT_DIR.VOUCHER_PATH.$id.PDF_FILE );
            }
            $this->loadModel('Enquiry');
            $options = array('conditions' => array('Enquiry.' . $this->Enquiry->primaryKey => $voucher['enc_id']));
            $booking =  $this->Enquiry->find('first', $options);            
            $this->sendMail($booking,'Quick Booking For Travel',$pdfpath);
            $this->Message->setSuccess(__('The voucher has been saved.'));
            return $this->redirect(array('controller' => 'bookings','action' => 'index'));
        } else {
            $this->Message->setWarning(__('The voucher could not be saved. Please, try again.'));
        }
    }else{
        if(!empty($id)){
            $this->loadModel("Booking");
            $options = array('conditions' => array('Booking.' . $this->Booking->primaryKey => $id));
            $bookings = $this->Booking->find('first', $options);        
            $this->request->data['Voucher'] = $bookings['Booking'];
            $this->request->data['Voucher']['booking_id'] = $bookings['Booking']['id'];
            $this->request->data['Voucher']['enc_id'] = $bookings['Booking']['enquiry_id'];
            $this->request->data['Voucher']['customer_tour_type'] = $bookings['Booking']['tour_type'];
            $this->request->data['Voucher']['customer_tour_date'] = $bookings['Booking']['travel_date'];
            $this->request->data['Voucher']['customer_tour_name'] = $bookings['Booking']['place_name'];
            $this->request->data['Voucher']['customer_hotel_place_name'] = $bookings['Booking']['place_name'];
            for ($i=2; $i <= $bookings['Booking']['package_count']; $i++) { 
            $this->request->data['Voucher']['customer_tour_type'.$i] = $bookings['Booking']['tour_type'.$i];
            $this->request->data['Voucher']['customer_tour_date'.$i] = $bookings['Booking']['travel_date'.$i];
            $this->request->data['Voucher']['customer_tour_name'.$i] = $bookings['Booking']['place_name'.$i];
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
            $this->Message->setSuccess(__('The voucher has been updated.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The voucher could not be updated. Please, try again.'));
        }
    } else {
        $options = array('conditions' => array('Voucher.' . $this->Voucher->primaryKey => $id));
        $this->request->data = $this->Voucher->find('first', $options);
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
}}