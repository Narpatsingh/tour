<?php
App::uses('AppController', 'Controller');
/**
 * TrainDetails Controller
 *
 * @property TrainDetail $TrainDetail
 * @property PaginatorComponent $Paginator
 */
class TrainDetailsController extends AppController {

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
        $this->Session->write('TrainDetailSearch', '');
    }

    if (empty($this->request->data['TrainDetail']) && $this->Session->read('TrainDetailSearch')) {
        $this->request->data['TrainDetail'] = $this->Session->read('TrainDetailSearch');
    }
    if (!empty($this->request->data['TrainDetail'])) {
        $this->request->data['TrainDetail'] = array_filter($this->request->data['TrainDetail']);
        $this->request->data['TrainDetail'] = array_map('trim', $this->request->data['TrainDetail']);
        if (!empty($this->request->data)) {
            if (isset($this->request->data['TrainDetail']['first_name'])) {
                $conditions['TrainDetail.first_name LIKE '] = '%' . $this->request->data['TrainDetail']['first_name'] . '%';
            }
            if (isset($this->request->data['TrainDetail']['last_name'])) {
                $conditions['TrainDetail.last_name LIKE '] = '%' . $this->request->data['TrainDetail']['last_name'] . '%';
            }
            if (isset($this->request->data['TrainDetail']['name'])) {
                $conditions['TrainDetail.name LIKE '] = '%' . $this->request->data['TrainDetail']['name'] . '%';
            }
            if (isset($this->request->data['TrainDetail']['email'])) {
                $conditions['TrainDetail.email LIKE '] = '%' . $this->request->data['TrainDetail']['email'] . '%';
            }
            if (isset($this->request->data['TrainDetail']['status'])) {
                $conditions['TrainDetail.status'] = $this->request->data['TrainDetail']['status'];
            }
        }
        $this->Session->write('TrainDetailSearch', $this->request->data['TrainDetail']);
    }
    $this->AutoPaginate->setPaginate(array(
        'order' => ' TrainDetail.id DESC',
        'conditions' => $conditions
    ));
    $this->loadModel('TrainDetail');
    $this->set('trainDetails', $this->paginate('TrainDetail'));

}

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function view($id = null) {
    if (!$this->TrainDetail->exists($id)) {
        $this->Message->setWarning(__('Invalid train detail'),array('action'=>'index'));
    }
    $options = array('conditions' => array('TrainDetail.' . $this->TrainDetail->primaryKey => $id));
    $this->set('trainDetail', $this->TrainDetail->find('first', $options));
}

/**
* add method
*
* @return void
*/
public function add() {
    if ($this->request->is('post')) {
        $this->TrainDetail->create();
        if ($this->TrainDetail->save($this->request->data)) {
            $this->Message->setSuccess(__('The train detail has been saved.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The train detail could not be saved. Please, try again.'));
        }
    }
    $this->loadModel("Customer");
    $this->set('customers',$this->Customer->find('list'));
}

/**
* edit method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function edit($id = null) {
    if (!$this->TrainDetail->exists($id)) {
        $this->Message->setWarning(__('Invalid train detail'),array('action'=>'index'));
    }
    if ($this->request->is(array('post', 'put'))) {
        if ($this->TrainDetail->save($this->request->data)) {
            $this->Message->setSuccess(__('The train detail has been updated.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The train detail could not be updated. Please, try again.'));
        }
    } else {
        $options = array('conditions' => array('TrainDetail.' . $this->TrainDetail->primaryKey => $id));
        $this->request->data = $this->TrainDetail->find('first', $options);
    }
    $this->loadModel("Customer");
    $this->set('customers',$this->Customer->find('list'));

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
    $this->TrainDetail->id = $id;
    if (!$this->TrainDetail->exists()) {
        $this->Message->setWarning(__('Invalid train detail'),array('action'=>'index'));
    }
    if ($this->TrainDetail->delete()) {
        $this->Message->setSuccess(__('The train detail has been deleted.'));
    } else {
        $this->Message->setWarning(__('The train detail could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}}
