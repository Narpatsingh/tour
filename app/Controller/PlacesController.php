<?php
App::uses('AppController', 'Controller');
/**
 * Places Controller
 *
 * @property Place $Place
 * @property PaginatorComponent $Paginator
 */
class PlacesController extends AppController {

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
        $this->Session->write('PlaceSearch', '');
    }

    if (empty($this->request->data['Place']) && $this->Session->read('PlaceSearch')) {
        $this->request->data['Place'] = $this->Session->read('PlaceSearch');
    }
    if (!empty($this->request->data['Place'])) {
        $this->request->data['Place'] = array_filter($this->request->data['Place']);
        $this->request->data['Place'] = array_map('trim', $this->request->data['Place']);
        if (!empty($this->request->data)) {
            if (isset($this->request->data['Place']['first_name'])) {
                $conditions['Place.first_name LIKE '] = '%' . $this->request->data['Place']['first_name'] . '%';
            }
            if (isset($this->request->data['Place']['last_name'])) {
                $conditions['Place.last_name LIKE '] = '%' . $this->request->data['Place']['last_name'] . '%';
            }
            if (isset($this->request->data['Place']['name'])) {
                $conditions['Place.name LIKE '] = '%' . $this->request->data['Place']['name'] . '%';
            }
            if (isset($this->request->data['Place']['email'])) {
                $conditions['Place.email LIKE '] = '%' . $this->request->data['Place']['email'] . '%';
            }
            if (isset($this->request->data['Place']['status'])) {
                $conditions['Place.status'] = $this->request->data['Place']['status'];
            }
        }
        $this->Session->write('PlaceSearch', $this->request->data['Place']);
    }
    $this->AutoPaginate->setPaginate(array(
        'order' => ' Place.id DESC',
        'conditions' => $conditions
    ));
    $this->loadModel('Place');
    $this->set('places', $this->paginate('Place'));

}

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function view($id = null) {
    if (!$this->Place->exists($id)) {
        $this->Message->setWarning(__('Invalid place'),array('action'=>'index'));
    }
    $options = array('conditions' => array('Place.' . $this->Place->primaryKey => $id));
    $this->set('place', $this->Place->find('first', $options));
}

/**
* add method
*
* @return void
*/
public function add() {
    if ($this->request->is('post')) {
        $this->Place->create();
        if ($this->Place->save($this->request->data)) {
            $this->Message->setSuccess(__('The place has been saved.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The place could not be saved. Please, try again.'));
        }
    }
    $this->loadModel('State');
    $states = $this->State->find('list');
    $city = array(); 
    $this->set('city',$city);
    $this->set('states',$states);
}

/**
* edit method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function edit($id = null) {
    if (!$this->Place->exists($id)) {
        $this->Message->setWarning(__('Invalid place'),array('action'=>'index'));
    }
    if ($this->request->is(array('post', 'put'))) {
        if ($this->Place->save($this->request->data)) {
            $this->Message->setSuccess(__('The place has been updated.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The place could not be updated. Please, try again.'));
        }
    } else {
        $options = array('conditions' => array('Place.' . $this->Place->primaryKey => $id));
        $this->request->data = $this->Place->find('first', $options);
    }
    $this->loadModel('City');
    $this->loadModel('State');
    $states = $this->State->find('list');
    $city = $this->City->find('list',array('conditions'=>array('City.state_id' => $this->request->data['Place']['state_id']))); 
    $this->set('city',$city);
    $this->set('states',$states);
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
    $this->Place->id = $id;
    if (!$this->Place->exists()) {
        $this->Message->setWarning(__('Invalid place'),array('action'=>'index'));
    }
    if ($this->Place->delete()) {
        $this->Message->setSuccess(__('The place has been deleted.'));
    } else {
        $this->Message->setWarning(__('The place could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}

public function get_place_data($id){
        if ($this->request->is('ajax')) {        
        $this->layout = false;
        $this->render = false;
        $id = explode(',', $id);
        $place = array();
        $places = $this->Place->find('all',array('conditions' => array('city_id'=> $id),'fields'=>array('Place.id','Place.name','City.name')));
        foreach ($places as $key => $value) {
            $place[$value['City']['name']][$value['Place']['id']]=$value['Place']['name'];
        }
        echo json_encode($place);
        exit;
        }else{return $this->redirect('/');}
    }
}
