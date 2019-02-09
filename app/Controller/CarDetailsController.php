<?php
App::uses('AppController', 'Controller');
/**
 * CarDetails Controller
 *
 * @property CarDetail $CarDetail
 * @property PaginatorComponent $Paginator
 */
class CarDetailsController extends AppController {

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
        $this->Session->write('CarDetailSearch', '');
    }

    if (empty($this->request->data['CarDetail']) && $this->Session->read('CarDetailSearch')) {
        $this->request->data['CarDetail'] = $this->Session->read('CarDetailSearch');
    }
    if (!empty($this->request->data['CarDetail'])) {
        $this->request->data['CarDetail'] = array_filter($this->request->data['CarDetail']);
        $this->request->data['CarDetail'] = array_map('trim', $this->request->data['CarDetail']);
        if (!empty($this->request->data)) {
            if (isset($this->request->data['CarDetail']['first_name'])) {
                $conditions['CarDetail.first_name LIKE '] = '%' . $this->request->data['CarDetail']['first_name'] . '%';
            }
            if (isset($this->request->data['CarDetail']['last_name'])) {
                $conditions['CarDetail.last_name LIKE '] = '%' . $this->request->data['CarDetail']['last_name'] . '%';
            }
            if (isset($this->request->data['CarDetail']['name'])) {
                $conditions['CarDetail.name LIKE '] = '%' . $this->request->data['CarDetail']['name'] . '%';
            }
            if (isset($this->request->data['CarDetail']['email'])) {
                $conditions['CarDetail.email LIKE '] = '%' . $this->request->data['CarDetail']['email'] . '%';
            }
            if (isset($this->request->data['CarDetail']['status'])) {
                $conditions['CarDetail.status'] = $this->request->data['CarDetail']['status'];
            }
        }
        $this->Session->write('CarDetailSearch', $this->request->data['CarDetail']);
    }
    $this->AutoPaginate->setPaginate(array(
        'order' => ' CarDetail.id DESC',
        'conditions' => $conditions
    ));
    $this->loadModel('CarDetail');
    $this->set('carDetails', $this->paginate('CarDetail'));

}

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function view($id = null) {
    if (!$this->CarDetail->exists($id)) {
        $this->Message->setWarning(__('Invalid car detail'),array('action'=>'index'));
    }
    $options = array('conditions' => array('CarDetail.' . $this->CarDetail->primaryKey => $id));
    $this->set('carDetail', $this->CarDetail->find('first', $options));
}

/**
* add method
*
* @return void
*/
public function add() {
    if ($this->request->is('post')) {
        $this->CarDetail->create();
        if ($this->CarDetail->save($this->request->data)) {
            $this->Message->setSuccess(__('The car detail has been saved.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The car detail could not be saved. Please, try again.'));
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
    if (!$this->CarDetail->exists($id)) {
        $this->Message->setWarning(__('Invalid car detail'),array('action'=>'index'));
    }
    if ($this->request->is(array('post', 'put'))) {
        if ($this->CarDetail->save($this->request->data)) {
            $this->Message->setSuccess(__('The car detail has been updated.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The car detail could not be updated. Please, try again.'));
        }
    } else {
        $options = array('conditions' => array('CarDetail.' . $this->CarDetail->primaryKey => $id));
        $this->request->data = $this->CarDetail->find('first', $options);
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
    $this->CarDetail->id = $id;
    if (!$this->CarDetail->exists()) {
        $this->Message->setWarning(__('Invalid car detail'),array('action'=>'index'));
    }
    if ($this->CarDetail->delete()) {
        $this->Message->setSuccess(__('The car detail has been deleted.'));
    } else {
        $this->Message->setWarning(__('The car detail could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}}
