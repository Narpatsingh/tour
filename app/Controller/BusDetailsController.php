<?php
App::uses('AppController', 'Controller');
/**
 * BusDetails Controller
 *
 * @property BusDetail $BusDetail
 * @property PaginatorComponent $Paginator
 */
class BusDetailsController extends AppController {

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
$this->Session->write('BusDetailSearch', '');
}

if (empty($this->request->data['BusDetail']) && $this->Session->read('BusDetailSearch')) {
$this->request->data['BusDetail'] = $this->Session->read('BusDetailSearch');
}
if (!empty($this->request->data['BusDetail'])) {
$this->request->data['BusDetail'] = array_filter($this->request->data['BusDetail']);
$this->request->data['BusDetail'] = array_map('trim', $this->request->data['BusDetail']);
if (!empty($this->request->data)) {
if (isset($this->request->data['BusDetail']['first_name'])) {
$conditions['BusDetail.first_name LIKE '] = '%' . $this->request->data['BusDetail']['first_name'] . '%';
}
if (isset($this->request->data['BusDetail']['last_name'])) {
$conditions['BusDetail.last_name LIKE '] = '%' . $this->request->data['BusDetail']['last_name'] . '%';
}
if (isset($this->request->data['BusDetail']['name'])) {
$conditions['BusDetail.name LIKE '] = '%' . $this->request->data['BusDetail']['name'] . '%';
}
if (isset($this->request->data['BusDetail']['email'])) {
$conditions['BusDetail.email LIKE '] = '%' . $this->request->data['BusDetail']['email'] . '%';
}
if (isset($this->request->data['BusDetail']['status'])) {
$conditions['BusDetail.status'] = $this->request->data['BusDetail']['status'];
}
}
$this->Session->write('BusDetailSearch', $this->request->data['BusDetail']);
}
$this->AutoPaginate->setPaginate(array(
'order' => ' BusDetail.id DESC',
'conditions' => $conditions
));
$this->loadModel('BusDetail');
$this->set('busDetails', $this->paginate('BusDetail'));

}

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function view($id = null) {
if (!$this->BusDetail->exists($id)) {
$this->Message->setWarning(__('Invalid bus detail'),array('action'=>'index'));
}
$options = array('conditions' => array('BusDetail.' . $this->BusDetail->primaryKey => $id));
$this->set('busDetail', $this->BusDetail->find('first', $options));
}

/**
* add method
*
* @return void
*/
public function add() {
if ($this->request->is('post')) {
$this->BusDetail->create();
if ($this->BusDetail->save($this->request->data)) {
    $this->Message->setSuccess(__('The bus detail has been saved.'));
    return $this->redirect(array('action' => 'index'));
    } else {
    $this->Message->setWarning(__('The bus detail could not be saved. Please, try again.'));
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
if (!$this->BusDetail->exists($id)) {
$this->Message->setWarning(__('Invalid bus detail'),array('action'=>'index'));
}
if ($this->request->is(array('post', 'put'))) {
if ($this->BusDetail->save($this->request->data)) {
    $this->Message->setSuccess(__('The bus detail has been updated.'));
    return $this->redirect(array('action' => 'index'));
    } else {
    $this->Message->setWarning(__('The bus detail could not be updated. Please, try again.'));
}
} else {
$options = array('conditions' => array('BusDetail.' . $this->BusDetail->primaryKey => $id));
$this->request->data = $this->BusDetail->find('first', $options);
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
$this->BusDetail->id = $id;
if (!$this->BusDetail->exists()) {
$this->Message->setWarning(__('Invalid bus detail'),array('action'=>'index'));
}
if ($this->BusDetail->delete()) {
    $this->Message->setSuccess(__('The bus detail has been deleted.'));
    } else {
    $this->Message->setWarning(__('The bus detail could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}}
