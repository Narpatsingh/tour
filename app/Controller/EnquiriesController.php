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
        $this->loadModel('City');
        $cities = $this->City->find('list');
        $this->set('dbOpration',"Add");
        $this->set('cities',$cities);
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
        $package = $this->getSingleDetails($package);
        $this->set(compact('package','enquiries'));
    }

/**
* add method
*
* @return void
*/
    public function add($flag='') {
        $this->layout = 'tour';
        if ($this->request->is('post')) {
            if(!empty($this->request->data['travel_date'])){
                $date = new DateTime($this->request->data['travel_date']);
                $this->request->data['travel_date'] = $date->format('Y-m-d H:i:s');
            }
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
                //debug($this->request->data);exit;
                if ($this->Enquiry->save($this->request->data)) {

                    //send mail to customer & admin
                    /*
                     * #code here
                     *   
                    */
                    if(empty($flag)){
                        $this->Message->setSuccess(__('Your Enquiry has been sent to admin, we will contact you soon!'));
                        return $this->redirect('/');
                    }else{
                        $this->Message->setSuccess(__('The Enquiry has been save successfully.'));
                        return $this->redirect(array('action' => 'index'));
                    }
                }
                else {
                    $this->Message->setWarning(__('The Enquiry could not be saved. Please, try again.'));
                    return $this->redirect('/');
                }
            }else {
                $this->Message->setWarning(__('The Enquiry could not be saved. Please, select Enquiry type.'));
                return $this->redirect('/');
            }
        }else{
            return $this->redirect('/');
        }
        $this->set('dbOpration',"Add");
        $this->render('/Users/dashboard');
    }

    public function approve($id){
        $this->Enquiry->id = $id;
        if (!$this->Enquiry->exists()) {
        $this->Message->setWarning(__('Invalid Enquiry'),array('action'=>'index/all'));
        }
        //if ($this->Enquiry->saveField('is_approved','Yes')) {
        $this->loadModel('Tour');
        $options = array('conditions' => array('Enquiry.' . $this->Enquiry->primaryKey => $id));
        $enquiry =  $this->Enquiry->find('first', $options);
        $tour_id = $enquiry['Customer']['package_id'];
        $toptions = array('conditions' => array('Tour.' . $this->Tour->primaryKey => $tour_id));
        $package = $this->Tour->find('first', $toptions);
        $this->set(compact('package','id','enquiry'));
        $this->layout = 'pdf';
        $this->render('/Pdf/generate_receipt');
        $pdfpath = ROOT_DIR.PDF_PATH.$id.PDF_FILE;
            $this->Message->setSuccess(__('The Enquiry has been approved.'));
            //$this->sendMail($enquiry,'Quick Enquiry For Travel',$pdfpath);
        /*} else {
            $this->Message->setWarning(__('The Enquiry could not be approved. Please, try again.'));
        }*/        
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

    /**
    * delete method
    *
    * @throws NotFoundException
    * @param string $id
    * @return void
    */
    public function delete($id = null) {
        $this->Enquiry->id = $id;
        if (!$this->Enquiry->exists()) {
            $this->Message->setWarning(__('Invalid Enquiry detail'),array('action'=>'index'));
        }
        if ($this->Enquiry->delete()) {
            $this->Message->setSuccess(__('The Enquiry detail has been deleted.'));
        } else {
            $this->Message->setWarning(__('The Enquiry detail could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }   

    public function getSingleDetails($tour_data='')
    {
        $this->loadModel('Place');
        $this->loadModel('State');
        $this->loadModel('City');
        $this->loadModel('Hotel');
        if(!empty($tour_data['Tour']['city_id'])){
            $cities = [];
            $cityIds = explode(',', $tour_data['Tour']['city_id']);
            $City_detail = $this->City->find('all',array('conditions' => array('City.id'=> $cityIds),'fields'=>array('City.id','City.name')));
            foreach ($City_detail as $key => $city_value) {
               $cities[] = $city_value['City']['name'];
            }
            if(!empty($cities)){
                $tour_data['City']['name'] = implode(',', $cities);
            }
        }
        if(!empty($tour_data['Tour']['state_id'])){
            $states = [];
            $state_Ids = explode(',', $tour_data['Tour']['state_id']);
            $states_detail = $this->State->find('all',array('conditions' => array('State.id'=> $state_Ids),'fields'=>array('State.id','State.name')));
            if(!empty($states_detail)){
                foreach ($states_detail as $key => $state_value) {
                   $states[] = $state_value['State']['name'];
                }
                if(!empty($states)){
                    $tour_data['State']['name'] = implode(',', $states);
                }
            }
        }
        if(!empty($tour_data['Tour']['multi_hotel'])){
            $hotels = [];
            $hotelIds = explode(',', $tour_data['Tour']['multi_hotel']);
            $hotel_detail = $this->Hotel->find('all',array('conditions' => array('Hotel.id'=> $hotelIds),'fields'=>array('Hotel.id','Hotel.name')));
            foreach ($hotel_detail as $key => $hotel_value) {
               $hotels[] = $hotel_value['Hotel']['name'];
            }
            if(!empty($hotels)){
                $tour_data['Hotel']['name'] = implode(',', $hotels);
            }
        }
        if(!empty($tour_data['Tour']['place_id'])){
            $Places = [];
            $placeIds = explode(',', $tour_data['Tour']['place_id']);
            $Place_detail = $this->Place->find('all',array('conditions' => array('Place.id'=> $placeIds),'fields'=>array('Place.id','Place.name')));
            foreach ($Place_detail as $key => $Place_value) {
               $Places[] = $Place_value['Place']['name'];
            }
            if(!empty($Places)){
                $tour_data['Place']['name'] = implode(',', $Places);
            }
        }
        return $tour_data;
    }    
}
