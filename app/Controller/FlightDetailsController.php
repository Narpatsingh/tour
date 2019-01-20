<?php
App::uses('AppController', 'Controller');
/**
 * FlightDetails Controller
 *
 * @property FlightDetail $FlightDetail
 * @property PaginatorComponent $Paginator
 */
class FlightDetailsController extends AppController {

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
$this->Session->write('FlightDetailSearch', '');
}

if (empty($this->request->data['FlightDetail']) && $this->Session->read('FlightDetailSearch')) {
$this->request->data['FlightDetail'] = $this->Session->read('FlightDetailSearch');
}
if (!empty($this->request->data['FlightDetail'])) {
$this->request->data['FlightDetail'] = array_filter($this->request->data['FlightDetail']);
$this->request->data['FlightDetail'] = array_map('trim', $this->request->data['FlightDetail']);
if (!empty($this->request->data)) {
if (isset($this->request->data['FlightDetail']['first_name'])) {
$conditions['FlightDetail.first_name LIKE '] = '%' . $this->request->data['FlightDetail']['first_name'] . '%';
}
if (isset($this->request->data['FlightDetail']['last_name'])) {
$conditions['FlightDetail.last_name LIKE '] = '%' . $this->request->data['FlightDetail']['last_name'] . '%';
}
if (isset($this->request->data['FlightDetail']['name'])) {
$conditions['FlightDetail.name LIKE '] = '%' . $this->request->data['FlightDetail']['name'] . '%';
}
if (isset($this->request->data['FlightDetail']['email'])) {
$conditions['FlightDetail.email LIKE '] = '%' . $this->request->data['FlightDetail']['email'] . '%';
}
if (isset($this->request->data['FlightDetail']['status'])) {
$conditions['FlightDetail.status'] = $this->request->data['FlightDetail']['status'];
}
}
$this->Session->write('FlightDetailSearch', $this->request->data['FlightDetail']);
}
$this->AutoPaginate->setPaginate(array(
'order' => ' FlightDetail.id DESC',
'conditions' => $conditions
));
$this->loadModel('FlightDetail');
$this->set('flightDetails', $this->paginate('FlightDetail'));

}

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function view($id = null) {
if (!$this->FlightDetail->exists($id)) {
$this->Message->setWarning(__('Invalid flight detail'),array('action'=>'index'));
}
$options = array('conditions' => array('FlightDetail.' . $this->FlightDetail->primaryKey => $id));
$this->set('flightDetail', $this->FlightDetail->find('first', $options));
}

/**
* add method
*
* @return void
*/
public function add() {
if ($this->request->is('post')) {
$this->FlightDetail->create();
if ($this->FlightDetail->save($this->request->data)) {
    $this->Message->setSuccess(__('The flight detail has been saved.'));
    return $this->redirect(array('action' => 'index'));
    } else {
    $this->Message->setWarning(__('The flight detail could not be saved. Please, try again.'));
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
if (!$this->FlightDetail->exists($id)) {
$this->Message->setWarning(__('Invalid flight detail'),array('action'=>'index'));
}
if ($this->request->is(array('post', 'put'))) {
if ($this->FlightDetail->save($this->request->data)) {
    $this->Message->setSuccess(__('The flight detail has been updated.'));
    return $this->redirect(array('action' => 'index'));
    } else {
    $this->Message->setWarning(__('The flight detail could not be updated. Please, try again.'));
}
} else {
$options = array('conditions' => array('FlightDetail.' . $this->FlightDetail->primaryKey => $id));
$this->request->data = $this->FlightDetail->find('first', $options);
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
$this->FlightDetail->id = $id;
if (!$this->FlightDetail->exists()) {
$this->Message->setWarning(__('Invalid flight detail'),array('action'=>'index'));
}
if ($this->FlightDetail->delete()) {
    $this->Message->setSuccess(__('The flight detail has been deleted.'));
    } else {
    $this->Message->setWarning(__('The flight detail could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}}