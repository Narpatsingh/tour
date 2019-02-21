<?php
App::uses('AppController', 'Controller');
/**
 * Tours Controller
 *
 * @property Tour $Tour
 * @property PaginatorComponent $Paginator
 */
class ToursController extends AppController {

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
        $this->Auth->allow('details','city_detail','state_detail','india');
        $this->_checkLogin();
    }

/**
* index method
*
* @return void
*/
    public function index($all = null) {
        $conditions = array();
        $this->loadModel('State');
        $this->loadModel('City');
        $this->loadModel('Place');
        $this->loadModel('Hotel');
        if ($all == "all") {
            $this->Session->write('TourSearch', '');
        }

        if (empty($this->request->data['Tour']) && $this->Session->read('TourSearch')) {
            $this->request->data['Tour'] = $this->Session->read('TourSearch');
        }
        if (!empty($this->request->data['Tour'])) {
            $this->request->data['Tour'] = array_filter($this->request->data['Tour']);
            $this->request->data['Tour'] = array_map('trim', $this->request->data['Tour']);
            if (!empty($this->request->data)) {
                if (isset($this->request->data['Tour']['Tour_name'])) {
                    $conditions['Tour.name LIKE '] = '%' . $this->request->data['Tour']['Tour_name'] . '%';
                }
                if (isset($this->request->data['Tour']['status'])) {
                    $conditions['Tour.status'] = $this->request->data['Tour']['status'];
                }
            }
            $this->Session->write('TourSearch', $this->request->data['Tour']);
        }
        $this->AutoPaginate->setPaginate(array(
            'order' => ' Tour.id DESC',
            'conditions' => $conditions
        ));
        $tour_data = $this->getTourDetails($this->paginate('Tour'));
        $this->set('Tours', $tour_data );
    }

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
    public function view($id = null) {
        if (!$this->Tour->exists($id)) {
            $this->Message->setWarning(__('Invalid Tour'),array('action'=>'index'));
        }
        $options = array('conditions' => array('Tour.' . $this->Tour->primaryKey => $id));
        $this->loadModel('Itinerary');
        $this->loadModel('Highlight');
        $Itinerary_data=$this->Tour->Itinerary->find('all',array('conditions' => array('Itinerary.tour_id' => $id)));
        $Highlight_data=$this->Tour->Highlight->find('all',array('conditions' => array('Highlight.tour_id' => $id)));
        $this->set('Itinerary_datas', $Itinerary_data);
        $this->set('Highlight_data', $Highlight_data);
        $this->set('tour', $this->Tour->find('first', $options));
    }

/**
* details method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
    public function details($id = null) {
        $this->layout = 'tour';
        if (!$this->Tour->exists($id)) {
            $this->Message->setWarning(__('Invalid Tour'),array('controller'=>'users','action'=>'dashboard'));
        }
        $options = array('conditions' => array('Tour.' . $this->Tour->primaryKey => $id));
        $tour =  $this->getSingleDetails($this->Tour->find('first', $options));
        $blogs = $this->getTourDetails($this->Tour->find('all', array('contain' => false, 'limit'=>6,'order' => array('Tour.id' => 'DESC'))));
        $this->loadModel('Hotel');
        $hotels = [];
        if(!empty($tour['Tour']['multi_hotel'])){
            $hotel_ids = explode(",",$tour['Tour']['multi_hotel']);
            $hotels = $this->Hotel->find('all', array('conditions' => array('Hotel.id' => $hotel_ids)));
        }
        $this->loadModel('City');
        $cities = $this->City->find('list');
        $destination = $this->Tour->find('list',array('fields' => array('name','name')));
        $this->set(compact('cities','hotels','destination','tour','blogs')); 
    }

    public function city_detail($id = null) {
        $this->layout = 'tour';
        if (!empty($id)) {
            $options = array('conditions' => array('Tour.city_id LIKE' => '%'.$id.'%'));
            $tour = $this->getTourDetails($this->Tour->find('all', $options));
            $this->loadModel('City');
            $cities = $this->City->find('list');
            $destination = $this->Tour->find('list',array('fields' => array('name','name')));
            if(!empty($tour)){
                $this->set('destination', $destination);
                $this->set('cities', $cities);
                $this->set('tour', $tour);
            }else{
                $this->Message->setWarning(__('Invalid Tour'),array('controller'=>'users','action'=>'dashboard'));
            }
        }else{
            $this->Message->setWarning(__('Invalid Tour'),array('controller'=>'users','action'=>'dashboard'));
        }
    }

    public function state_detail($id = null) {
        $this->layout = 'tour';
        if (!empty($id)) {
            $options = array('conditions' => array('Tour.state_id LIKE' => '%'.$id.'%'));
            $tour = $this->getTourDetails($this->Tour->find('all', $options));
            $this->loadModel('City');
            $cities = $this->City->find('list');
            $destination = $this->Tour->find('list',array('fields' => array('name','name')));
            if(!empty($tour)){
                $this->set('destination', $destination);
                $this->set('cities', $cities);
                $this->set('tour', $tour);
            }else{
                $this->Message->setWarning(__('Invalid Tour'),array('controller'=>'users','action'=>'dashboard'));
            }
        }else{
            $this->Message->setWarning(__('Invalid Tour'),array('controller'=>'users','action'=>'dashboard'));
        }
        $this->render('city_detail');
    }

    public function india() {
        $this->layout = 'tour';
        $this->loadModel('City');
        $cities = $this->City->find('list');
        $destination = $this->Tour->find('list',array('fields' => array('name','name')));
        $this->set('destination', $destination);
        $this->set('cities', $cities);
        $this->set('tour', $this->Tour->find('all'));
        $this->render('city_detail');
    }

/**
* add method
*
* @return void
*/
    public function add() {
        $this->loadModel('Highlight');


        if ($this->request->is('post')) {
            $this->Tour->create();
            $type = $this->request->data['Tour']['type'];
            $Highlights=$this->request->data['Highlight']['name']['new'];
            $Highlights_data = array_filter($Highlights);
            if(!empty($type)){
                if($type == 1){
                    $type = "packages";
                }elseif($type == 2){
                    $type = "hot_deals";
                }else{
                    $type = "deals";
                }
                if (!empty($this->request->data['Tour']['img']['name'])){
                    $filename = WWW_ROOT.'images'.DS. $type .DS.time().str_replace(" ", "", $this->request->data['Tour']['img']['name']); 
                    move_uploaded_file($this->data['Tour']['img']['tmp_name'],$filename);
                    $this->request->data['Tour']['img'] = 'images/'.$type.'/'.time().str_replace(" ", "", $this->request->data['Tour']['img']['name']);
                }
                $hotels = $this->request->data['Tour']['hotel_id'];
                if(!empty($hotels)){
                    $this->request->data['Tour']['hotel_id'] = $hotels[0];
                    $this->request->data['Tour']['multi_hotel'] = implode(',', $hotels);
                }

                if(!empty($this->request->data['Tour']['state_id'])){
                    $this->request->data['Tour']['state_id'] = implode(',', $this->request->data['Tour']['state_id']);
                }

                if(!empty($this->request->data['Tour']['city_id'])){
                    $this->request->data['Tour']['city_id'] = implode(',', $this->request->data['Tour']['city_id']);
                }

                if(!empty($this->request->data['Tour']['place_id'])){
                    $this->request->data['Tour']['place_id'] = implode(',', $this->request->data['Tour']['place_id']);
                }

                if ($this->Tour->save($this->request->data)) {
                    $tour_id  = $this->Tour->getLastInsertID();
                    if(!empty($Highlights_data)){
                        foreach ($Highlights_data as $key => $value) {
                            $this->request->data['Highlight']['title']=$value;
                            $this->request->data['Highlight']['tour_id'] = $tour_id;
                            $this->Highlight->saveAll($this->request->data);
                        }
                    }   
                    $this->Message->setSuccess(__('The Tour has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                }
                else {
                $this->Message->setWarning(__('The Tour could not be saved. Please, try again.'));
                return $this->redirect(array('action' => 'index'));
                }
            }else {
                $this->Message->setWarning(__('The Tour could not be saved. Please, select tour type.'));
                return $this->redirect(array('action' => 'index'));
            }
        }
        $this->loadModel('State');
        $states = $this->State->find('list');
        $this->set('states',$states);
        $this->set('dbOpration',"Add");
    }

/**
* edit method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
    public function edit($id = null) {
        $this->loadModel('Highlight');
        $this->loadModel('Hotel');
        $this->loadModel('City');
        $userId = $this->Session->read('Auth.User.id');
        $this->Tour->id = $id;
        if (!$this->Tour->exists()) {
            $this->Message->setWarning(__('Invalid Tour'),array('action'=>'index/all'));
        }
        $options = array('conditions' => array('Tour.' . $this->Tour->primaryKey => $id));
        $Tour_data=$this->Tour->find('first', $options);
        if ($this->request->is(array('post', 'put'))) {
            $type = $this->request->data['Tour']['type'];
            if($type == 1){
                $type = "packages";
            }elseif($type == 2){
                $type = "hot_deals";
            }else{
                $type = "deals";
            }
            $Highlights_data = array();
            $old_data = array();
            if(!empty($this->request->data['Highlight']['name']['new'])){
                $Highlights_data=array_filter($this->request->data['Highlight']['name']['new']);
            }
            if(!empty($this->request->data['Highlight']['name']['old'])){
                $old_data=array_filter($this->request->data['Highlight']['name']['old']);
            }    
            if (!empty($this->request->data['Tour']['img']['name'])){
                $filename = WWW_ROOT.'images'.DS. $type .DS.time().str_replace(" ", "", $this->request->data['Tour']['img']['name']); 
                move_uploaded_file($this->data['Tour']['img']['tmp_name'],$filename);
                $this->request->data['Tour']['img'] = 'images/'.$type.'/'.time().str_replace(" ", "", $this->request->data['Tour']['img']['name']);
            }else{
                $this->request->data['Tour']['img'] = $Tour_data['Tour']['img'];
            }
            $hotels = $this->request->data['Tour']['hotel_id'];
            if(!empty($hotels)){
                $this->request->data['Tour']['hotel_id'] = $hotels[0];
                $this->request->data['Tour']['multi_hotel'] = implode(',', $hotels);
            }

            if(!empty($this->request->data['Tour']['state_id'])){
                $this->request->data['Tour']['state_id'] = implode(',', $this->request->data['Tour']['state_id']);
            }

            if(!empty($this->request->data['Tour']['city_id'])){
                $this->request->data['Tour']['city_id'] = implode(',', $this->request->data['Tour']['city_id']);
            }

            if(!empty($this->request->data['Tour']['place_id'])){
                $this->request->data['Tour']['place_id'] = implode(',', $this->request->data['Tour']['place_id']);
            }
            if ($this->Tour->save($this->request->data)) {
                foreach ($old_data as $old_key => $old_value) {
                    $this->Highlight->id = $old_key;
                    $this->Highlight->saveField('title', $old_value);
                }
                $tour_id  = $id;
                if(!empty($Highlights_data)){
                    foreach ($Highlights_data as $key => $value) {
                        $this->request->data['Highlight']['title']=$value;
                        $this->request->data['Highlight']['tour_id'] = $tour_id;
                        $this->Highlight->saveAll($this->request->data);
                    }
                }
                $this->Message->setSuccess(__('The Tour has been updated.'));
                return $this->redirect(array('action' => 'index/all'));
            } else {
                $this->Message->setWarning(__('The Tour could not be updated. Please, try again.'));
            }
        } else {
           $this->request->data = $Tour_data;
           $this->request->data['Tour']['state_id'] = explode(',',$this->request->data['Tour']['state_id']);
           $this->request->data['Tour']['city_id'] = explode(',',$this->request->data['Tour']['city_id']);
           $this->request->data['Tour']['place_id'] = explode(',',$this->request->data['Tour']['place_id']);
           $this->request->data['Tour']['hotel_id'] = explode(',',$this->request->data['Tour']['multi_hotel']);
        }
        $dbOpration = "Edit";
        $highlight_data=$this->Tour->Highlight->find('list',array('conditions' => array('Highlight.tour_id' => $id)));
        $this->loadModel('State');
        $states = $this->State->find('list');
        $city = $this->City->find('list',array('conditions'=>array('City.state_id' => $Tour_data['Tour']['state_id']))); 
        $hotels = $this->Hotel->find('list');
        $this->set(compact('dbOpration','highlight_data','states','city','hotels'));
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
        $this->Tour->id = $id;
        if (!$this->Tour->exists()) {
        $this->Message->setWarning(__('Invalid Tour'),array('action'=>'index/all'));
        }
        if ($this->Tour->delete()) {
            $this->Message->setSuccess(__('The Tour has been deleted.'));
        } else {
            $this->Message->setWarning(__('The Tour could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function delete_highlight($id = null) {
        $this->loadModel('Highlight');
        $this->Highlight->id = $id;
        if (!$this->Highlight->exists()) {
            $this->Message->setWarning(__('Invalid Highlight'));
        }
        $delete=$this->Highlight->delete();
        exit;
        
    }

    public function getTourDetails($tour_data)
    {
        $this->loadModel('Place');
        $this->loadModel('State');
        $this->loadModel('City');
        $this->loadModel('Hotel');
        foreach ($tour_data as $main_key => $tour_value) {
            if(!empty($tour_value['Tour']['city_id'])){
                $cities = [];
                $cityIds = explode(',', $tour_value['Tour']['city_id']);
                $City_detail = $this->City->find('all',array('conditions' => array('City.id'=> $cityIds),'fields'=>array('City.id','City.name')));
                foreach ($City_detail as $key => $city_value) {
                   $cities[] = $city_value['City']['name'];
                }
                if(!empty($cities)){
                    $tour_data[$main_key]['City']['name'] = implode(',', $cities);
                }
            }
            if(!empty($tour_value['Tour']['state_id'])){
                $states = [];
                $state_Ids = explode(',', $tour_value['Tour']['state_id']);
                $states_detail = $this->State->find('all',array('conditions' => array('State.id'=> $state_Ids),'fields'=>array('State.id','State.name')));
                if(!empty($states_detail)){
                    foreach ($states_detail as $key => $state_value) {
                       $states[] = $state_value['State']['name'];
                    }
                    if(!empty($states)){
                        $tour_data[$main_key]['State']['name'] = implode(',', $states);
                    }
                }
            }
            if(!empty($tour_value['Tour']['multi_hotel'])){
                $hotels = [];
                $hotelIds = explode(',', $tour_value['Tour']['multi_hotel']);
                $hotel_detail = $this->Hotel->find('all',array('conditions' => array('Hotel.id'=> $hotelIds),'fields'=>array('Hotel.id','Hotel.name')));
                foreach ($hotel_detail as $key => $hotel_value) {
                   $hotels[] = $hotel_value['Hotel']['name'];
                }
                if(!empty($hotels)){
                    $tour_data[$main_key]['Hotel']['name'] = implode(',', $hotels);
                }
            }
            if(!empty($tour_value['Tour']['place_id'])){
                $Places = [];
                $placeIds = explode(',', $tour_value['Tour']['place_id']);
                $Place_detail = $this->Place->find('all',array('conditions' => array('Place.id'=> $placeIds),'fields'=>array('Place.id','Place.name')));
                foreach ($Place_detail as $key => $Place_value) {
                   $Places[] = $Place_value['Place']['name'];
                }
                if(!empty($Places)){
                    $tour_data[$main_key]['Place']['name'] = implode(',', $Places);
                }
            }
            
        }
        return $tour_data;
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
