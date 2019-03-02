<?php
App::uses('AppController', 'Controller');
/**
 * GstParameters Controller
 *
 * @property GstParameter $GstParameter
 * @property PaginatorComponent $Paginator
 */
class GstParametersController extends AppController {

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
$this->Session->write('GstParameterSearch', '');
}

if (empty($this->request->data['GstParameter']) && $this->Session->read('GstParameterSearch')) {
$this->request->data['GstParameter'] = $this->Session->read('GstParameterSearch');
}
if (!empty($this->request->data['GstParameter'])) {
$this->request->data['GstParameter'] = array_filter($this->request->data['GstParameter']);
$this->request->data['GstParameter'] = array_map('trim', $this->request->data['GstParameter']);
if (!empty($this->request->data)) {
if (isset($this->request->data['GstParameter']['first_name'])) {
$conditions['GstParameter.first_name LIKE '] = '%' . $this->request->data['GstParameter']['first_name'] . '%';
}
if (isset($this->request->data['GstParameter']['last_name'])) {
$conditions['GstParameter.last_name LIKE '] = '%' . $this->request->data['GstParameter']['last_name'] . '%';
}
if (isset($this->request->data['GstParameter']['name'])) {
$conditions['GstParameter.name LIKE '] = '%' . $this->request->data['GstParameter']['name'] . '%';
}
if (isset($this->request->data['GstParameter']['email'])) {
$conditions['GstParameter.email LIKE '] = '%' . $this->request->data['GstParameter']['email'] . '%';
}
if (isset($this->request->data['GstParameter']['status'])) {
$conditions['GstParameter.status'] = $this->request->data['GstParameter']['status'];
}
}
$this->Session->write('GstParameterSearch', $this->request->data['GstParameter']);
}
$this->AutoPaginate->setPaginate(array(
'order' => ' GstParameter.id DESC',
'conditions' => $conditions
));
$this->loadModel('GstParameter');
$this->set('gstParameters', $this->paginate('GstParameter'));

}

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function view($id = null) {
if (!$this->GstParameter->exists($id)) {
$this->Message->setWarning(__('Invalid gst parameter'),array('action'=>'index'));
}
$options = array('conditions' => array('GstParameter.' . $this->GstParameter->primaryKey => $id));
$this->set('gstParameter', $this->GstParameter->find('first', $options));
}

/**
* add method
*
* @return void
*/
public function add() {
if ($this->request->is('post')) {
$this->GstParameter->create();
if ($this->GstParameter->save($this->request->data)) {
    $this->Message->setSuccess(__('The gst parameter has been saved.'));
    return $this->redirect(array('action' => 'index'));
    } else {
    $this->Message->setWarning(__('The gst parameter could not be saved. Please, try again.'));
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
if (!$this->GstParameter->exists($id)) {
$this->Message->setWarning(__('Invalid gst parameter'),array('action'=>'index'));
}
if ($this->request->is(array('post', 'put'))) {
if ($this->GstParameter->save($this->request->data)) {
    $this->Message->setSuccess(__('The gst parameter has been updated.'));
    return $this->redirect(array('action' => 'index'));
    } else {
    $this->Message->setWarning(__('The gst parameter could not be updated. Please, try again.'));
}
} else {
$options = array('conditions' => array('GstParameter.' . $this->GstParameter->primaryKey => $id));
$this->request->data = $this->GstParameter->find('first', $options);
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
$this->GstParameter->id = $id;
if (!$this->GstParameter->exists()) {
$this->Message->setWarning(__('Invalid gst parameter'),array('action'=>'index'));
}
if ($this->GstParameter->delete()) {
    $this->Message->setSuccess(__('The gst parameter has been deleted.'));
    } else {
    $this->Message->setWarning(__('The gst parameter could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}}
