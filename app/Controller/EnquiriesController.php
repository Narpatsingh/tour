<?php
App::uses('AppController', 'Controller');
/**
 * Enquiries Controller
 *
 * @property Enquiry $Enquiry
 * @property PaginatorComponent $Paginator
 */
class EnquiriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Auth','Paginator','Session');

/**
* beforefilter method
*
* @return void
*/
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('add');
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
            $this->Session->write('EnquirySearch', '');
        }

        if (empty($this->request->data['Enquiry']) && $this->Session->read('EnquirySearch')) {
            $this->request->data['Enquiry'] = $this->Session->read('EnquirySearch');
        }
        if (!empty($this->request->data['Enquiry'])) {
            $this->request->data['Enquiry'] = array_filter($this->request->data['Enquiry']);
            $this->request->data['Enquiry'] = array_map('trim', $this->request->data['Enquiry']);
            if (!empty($this->request->data)) {
                if (isset($this->request->data['Enquiry']['Enquiry_name'])) {
                    $conditions['Enquiry.name LIKE '] = '%' . $this->request->data['Enquiry']['Enquiry_name'] . '%';
                }
                if (isset($this->request->data['Enquiry']['status'])) {
                    $conditions['Enquiry.status'] = $this->request->data['Enquiry']['status'];
                }
            }
            $this->Session->write('EnquirySearch', $this->request->data['Enquiry']);
        }
        $this->AutoPaginate->setPaginate(array(
            'order' => ' Enquiry.id DESC',
            'conditions' => $conditions,
            'recursive'=>2,
        ));
        $this->set('enquiries', $this->paginate('Enquiry'));
    }

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
    public function view($id = null) {
        
        if (!$this->Enquiry->exists($id)) {
            $this->Message->setWarning(__('Invalid Enquiry'),array('action'=>'index'));
        }
        $this->loadModel("Tour");
        $options = array('conditions' => array('Enquiry.' . $this->Enquiry->primaryKey => $id));
        $enquiries = $this->Enquiry->find('first', $options);
        $tour_id = $enquiries['Customer']['package_id'];
        $toptions = array('conditions' => array('Tour.' . $this->Tour->primaryKey => $tour_id));
        $package = $this->Tour->find('first', $toptions);
        $this->set(compact('package','enquiries'));
    }

/**
* add method
*
* @return void
*/
    public function add() {
        
        $this->layout = 'tour';
        if ($this->request->is('post')) {

        $save_customer['name'] = $this->request->data['firstname'].' '.$this->request->data['lastname'];
        $save_customer['email'] = $this->request->data['email'];
        $save_customer['mobile'] = $this->request->data['mobile']; unset($this->request->data['firstname'],$this->request->data['lastname'],$this->request->data['mobile'],$this->request->data['email']);

        $this->loadModel("Customer");
        $this->Customer->create();
        if ($this->Customer->save($save_customer)) {

            $last_customer_id  = $this->Customer->getLastInsertID();
            $this->Enquiry->create();
            $this->request->data['customer_id'] = $last_customer_id;
            $this->request->data['destination'] = $this->request->data['Enquiry']['city_id']; unset($this->request->data['Enquiry']);
            if ($this->Enquiry->save($this->request->data)) {

                //send mail to customer & admin
                /*
                 * #code here
                 *   
                */
                $this->Message->setSuccess(__('Your Enquiry has been sent to admin, we will contact you soon!'));
                return $this->redirect('/');
            }
                else {
                $this->Message->setWarning(__('The Enquiry could not be saved. Please, try again.'));
                return $this->redirect('/');
                }
            }else {
                $this->Message->setWarning(__('The Enquiry could not be saved. Please, select Enquiry type.'));
                return $this->redirect('/');
            }
        }else{return $this->redirect('/');}
        $this->set('dbOpration',"Add");
        $this->render('/Users/dashboard');
    }

    public function approve($id){
        $this->Enquiry->id = $id;
        if (!$this->Enquiry->exists()) {
        $this->Message->setWarning(__('Invalid Enquiry'),array('action'=>'index/all'));
        }
        if ($this->Enquiry->saveField('is_approved','Yes')) {
        $this->loadModel('Tour');
        $options = array('conditions' => array('Enquiry.' . $this->Enquiry->primaryKey => $id));
        $enquiry =  $this->Enquiry->find('first', $options);
        $tour_id = $enquiry['Customer']['package_id'];
        $toptions = array('conditions' => array('Tour.' . $this->Tour->primaryKey => $tour_id));
        $package = $this->Tour->find('first', $toptions);
        $this->set(compact('package','id','enquiry'));
        $this->layout = 'pdf';
        //$this->render('/Pdf/generate_pdf');
        $this->render('/Pdf/generate_receipt');
        $pdfpath = ROOT_DIR.PDF_PATH.$id.PDF_FILE;
            $this->Message->setSuccess(__('The Enquiry has been approved.'));
            //$this->sendMail($enquiry,'Quick Enquiry For Travel',$pdfpath);
        } else {
            $this->Message->setWarning(__('The Enquiry could not be approved. Please, try again.'));
        }        
        $enquiry_id = encrypt($id);
        return $this->redirect(array('controller'=>'bookings','action' => 'add',$enquiry_id));
    }

    public function reject($id = null) {
        $this->Enquiry->id = $id;
        if (!$this->Enquiry->exists()) {
        $this->Message->setWarning(__('Invalid Enquiry'),array('action'=>'index/all'));
        }
        if ($this->Enquiry->saveField('is_approved','No')) {
            $this->Message->setSuccess(__('The Enquiry has been rejected.'));
        } else {
            $this->Message->setWarning(__('The Enquiry could not be rejected. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }    
}
