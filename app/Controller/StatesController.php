<?php
App::uses('AppController', 'Controller');
/**
 * Itineraries Controller
 *
 * @property State $State
 * @property PaginatorComponent $Paginator
 */
class StatesController extends AppController {

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
            $this->Session->write('Statesearch', '');
        }

        if (empty($this->request->data['State']) && $this->Session->read('Statesearch')) {
            $this->request->data['State'] = $this->Session->read('Statesearch');
        }
        if (!empty($this->request->data['State'])) {
            $this->request->data['State'] = array_filter($this->request->data['State']);
            $this->request->data['State'] = array_map('trim', $this->request->data['State']);
            if (!empty($this->request->data)) {
                if (isset($this->request->data['State']['State_name'])) {
                    $conditions['State.name LIKE '] = '%' . $this->request->data['State']['State_name'] . '%';
                }
                if (isset($this->request->data['State']['status'])) {
                    $conditions['State.status'] = $this->request->data['State']['status'];
                }
            }
            $this->Session->write('Statesearch', $this->request->data['State']);
        }
        $this->AutoPaginate->setPaginate(array(
            'order' => ' State.id DESC',
            'conditions' => $conditions,
            'recursive'=>'1'
        ));
        $this->set('States', $this->paginate('State'));
    }

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
    public function view($id = null) {
        if (!$this->State->exists($id)) {
            $this->Message->setWarning(__('Invalid State'),array('action'=>'index'));
        }
        $options = array('conditions' => array('State.' . $this->State->primaryKey => $id));
        $this->set('State', $this->State->find('first', $options));
    }

/**
* add method
*
* @return void
*/
    public function add() {

        if ($this->request->is('post')) {
            $tour_id = $this->request->data['State']['tour_id'];
            $this->State->create();
            if ($this->State->save($this->request->data)) {  
                $this->Message->setSuccess(__('The State has been saved.'));
            }else {
                $this->Message->setWarning(__('The State could not be saved. Please, select State type.'));
            }
            return $this->redirect(array('action' => 'index'));
        }
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
        $this->State->id = $id;
        if ($this->request->is(array('post', 'put'))) {
            $tour_id = $this->request->data['State']['tour_id'];
            if ($this->State->save($this->request->data)) {
                $this->Message->setSuccess(__('The State has been updated.'));
            } else {
                $this->Message->setWarning(__('The State could not be updated. Please, try again.'));
            }
            return $this->redirect(array('action' => 'index'));
        } else {
            $options = array('conditions' => array('State.' . $this->State->primaryKey => $id));
            $State_data=$this->State->find('first', $options);
            $this->request->data = $State_data;
        }
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
        $this->State->id = $id;
        if ($this->State->delete()) {
            $this->Message->setSuccess(__('The State has been deleted.'));
        } else {
            $this->Message->setWarning(__('The State could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function get_city($id = null) {
        
        $this->layout = false;
        $this->render = false;
        $this->loadModel('City');
        $city = $this->City->find('list',array('conditions' => array('state_id'=> $id)));
        echo json_encode($city);
        exit;
    }    

}
