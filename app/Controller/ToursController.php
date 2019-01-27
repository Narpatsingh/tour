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
            'conditions' => $conditions,
            'recursive'=>'1'
        ));
        $this->set('Tours', $this->paginate('Tour'));
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
        $this->loadModel('City');
        $cities = $this->City->find('list');
        $destination = $this->Tour->find('list',array('fields' => array('place','place')));
        $this->set('cities', $cities);
        $this->set('destination', $destination);
        $this->set('tour', $this->Tour->find('first', $options));
    }

    public function city_detail($id = null) {
        $this->layout = 'tour';
        if (!empty($id)) {
            $options = array('conditions' => array('Tour.city_id' => $id));
            $tour = $this->Tour->find('all', $options);
            $this->loadModel('City');
            $cities = $this->City->find('list');
            $destination = $this->Tour->find('list',array('fields' => array('place','place')));
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
            $options = array('conditions' => array('Tour.state_id' => $id));
            $tour = $this->Tour->find('all', $options);
            $this->loadModel('City');
            $cities = $this->City->find('list');
            $destination = $this->Tour->find('list',array('fields' => array('place','place')));
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
        $destination = $this->Tour->find('list',array('fields' => array('place','place')));
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
        $this->loadModel('Hotel');
        $this->loadModel('State');
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
                    $filename = WWW_ROOT. DS . 'images'.DS. $type .DS.time().$this->data['Tour']['img']['name']; 
                    move_uploaded_file($this->data['Tour']['img']['tmp_name'],$filename);
                    $this->request->data['Tour']['img'] = 'images/'.$type.'/'.time().$this->request->data['Tour']['img']['name'];
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
        $states = $this->State->find('list');
        $hotels = $this->Hotel->find('list');
        $city = array();
        $this->set('hotels',$hotels); 
        $this->set('city',$city);
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
                $filename = WWW_ROOT.'images'.DS. $type .DS.time().$this->data['Tour']['img']['name']; 
                move_uploaded_file($this->data['Tour']['img']['tmp_name'],$filename);
                $this->request->data['Tour']['img'] = 'images/'.$type.'/'.time().$this->request->data['Tour']['img']['name'];
            }else{
                $this->request->data['Tour']['img'] = $Tour_data['Tour']['img'];
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
        }
        $dbOpration = "Edit";
        $highlight_data=$this->Tour->Highlight->find('list',array('conditions' => array('Highlight.tour_id' => $id)));
        $this->loadModel('State');
        $states = $this->State->find('list');
        $city = $this->City->find('list',array('conditions'=>array('City.id' => $Tour_data['Tour']['city_id']))); 
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

}
