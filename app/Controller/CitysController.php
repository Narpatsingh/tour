<?php
App::uses('AppController', 'Controller');
/**
 * Itineraries Controller
 *
 * @property City $City
 * @property PaginatorComponent $Paginator
 */
class CitysController extends AppController {

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
            $this->Session->write('Citysearch', '');
        }

        if (empty($this->request->data['City']) && $this->Session->read('Citysearch')) {
            $this->request->data['City'] = $this->Session->read('Citysearch');
        }
        if (!empty($this->request->data['City'])) {
            $this->request->data['City'] = array_filter($this->request->data['City']);
            $this->request->data['City'] = array_map('trim', $this->request->data['City']);
            if (!empty($this->request->data)) {
                if (isset($this->request->data['City']['City_name'])) {
                    $conditions['City.name LIKE '] = '%' . $this->request->data['City']['City_name'] . '%';
                }
                if (isset($this->request->data['City']['status'])) {
                    $conditions['City.status'] = $this->request->data['City']['status'];
                }
            }
            $this->Session->write('Citysearch', $this->request->data['City']);
        }
        $this->AutoPaginate->setPaginate(array(
            'order' => ' City.id DESC',
            'conditions' => $conditions,
            'recursive'=>'1'
        ));
        $this->set('Citys', $this->paginate('City'));
    }

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
    public function view($id = null) {
        if (!$this->City->exists($id)) {
            $this->Message->setWarning(__('Invalid City'),array('action'=>'index'));
        }
        $options = array('conditions' => array('City.' . $this->City->primaryKey => $id,'recursive'=>1));
        $this->set('City', $this->City->find('first', $options));
    }

/**
* add method
*
* @return void
*/
    public function add() {
        $this->loadModel('State');
        if ($this->request->is('post')) {
            $tour_id = $this->request->data['City']['tour_id'];
            $this->City->create();
            if ($this->City->save($this->request->data)) {  
                $this->Message->setSuccess(__('The City has been saved.'));
            }else {
                $this->Message->setWarning(__('The City could not be saved. Please, select City type.'));
            }
            return $this->redirect(array('action' => 'index'));
        }
        $states=$this->State->find('list');
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
        $this->City->id = $id;
        $this->loadModel('State');
        if ($this->request->is(array('post', 'put'))) {
            $tour_id = $this->request->data['City']['tour_id'];
            if ($this->City->save($this->request->data)) {
                $this->Message->setSuccess(__('The City has been updated.'));
            } else {
                $this->Message->setWarning(__('The City could not be updated. Please, try again.'));
            }
            return $this->redirect(array('action' => 'index'));
        } else {
            $options = array('conditions' => array('City.' . $this->City->primaryKey => $id));
            $City_data=$this->City->find('first', $options);
            $this->request->data = $City_data;
        }
        $states=$this->State->find('list');
        $this->set('states',$states);
        $this->set('dbOpration',"Edit");
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
        $this->City->id = $id;
        if ($this->City->delete()) {
            $this->Message->setSuccess(__('The City has been deleted.'));
        } else {
            $this->Message->setWarning(__('The City could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function get_city($id = null) {
        if ($this->request->is('ajax')) {        
        $this->layout = false;
        $this->render = false;
        $city = $this->City->find('list',array('conditions' => array('state_id'=> $id)));
        echo json_encode($city);
        exit;
    }else{  return $this->redirect('/'); } 
}
}