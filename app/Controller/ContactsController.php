<?php
App::uses('AppController', 'Controller');
/**
 * Contacts Controller
 *
 * @property Contact $Contact
 * @property PaginatorComponent $Paginator
 */
class ContactsController extends AppController {

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
    $this->Auth->allow();
}

/**
* index method
*
* @return void
*/
public function index($all = null) {
    $conditions = array();
    if ($all == "all") {
        $this->Session->write('ContactSearch', '');
    }

    if (empty($this->request->data['Contact']) && $this->Session->read('ContactSearch')) {
        $this->request->data['Contact'] = $this->Session->read('ContactSearch');
    }
    if (!empty($this->request->data['Contact'])) {
        $this->request->data['Contact'] = array_filter($this->request->data['Contact']);
        $this->request->data['Contact'] = array_map('trim', $this->request->data['Contact']);
        if (!empty($this->request->data)) {
            if (isset($this->request->data['Contact']['first_name'])) {
                $conditions['Contact.first_name LIKE '] = '%' . $this->request->data['Contact']['first_name'] . '%';
            }
            if (isset($this->request->data['Contact']['last_name'])) {
                $conditions['Contact.last_name LIKE '] = '%' . $this->request->data['Contact']['last_name'] . '%';
            }
            if (isset($this->request->data['Contact']['name'])) {
                $conditions['Contact.name LIKE '] = '%' . $this->request->data['Contact']['name'] . '%';
            }
            if (isset($this->request->data['Contact']['email'])) {
                $conditions['Contact.email LIKE '] = '%' . $this->request->data['Contact']['email'] . '%';
            }
            if (isset($this->request->data['Contact']['status'])) {
                $conditions['Contact.status'] = $this->request->data['Contact']['status'];
            }
        }
        $this->Session->write('ContactSearch', $this->request->data['Contact']);
    }
    $this->AutoPaginate->setPaginate(array(
        'order' => ' Contact.id DESC',
        'conditions' => $conditions
    ));
    $this->loadModel('Contact');
    $this->set('contacts', $this->paginate('Contact'));

}

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function view($id = null) {
    if (!$this->Contact->exists($id)) {
        $this->Message->setWarning(__('Invalid contact'),array('action'=>'index'));
    }
    $options = array('conditions' => array('Contact.' . $this->Contact->primaryKey => $id));
    $this->set('contact', $this->Contact->find('first', $options));
}

/**
* add method
*
* @return void
*/
public function add() {
    if ($this->request->is('post')) {
        $this->Contact->create();
        if ($this->Contact->save($this->request->data)) {
            $this->Message->setSuccess(__('The contact has been saved.'));
            return $this->redirect(array('controller'=>'users','action' => 'dashboard'));
        } else {
            $this->Message->setWarning(__('The contact could not be saved. Please, try again.'));
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
    if (!$this->Contact->exists($id)) {
        $this->Message->setWarning(__('Invalid contact'),array('action'=>'index'));
    }
    if ($this->request->is(array('post', 'put'))) {
        if ($this->Contact->save($this->request->data)) {
            $this->Message->setSuccess(__('The contact has been updated.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The contact could not be updated. Please, try again.'));
        }
    } else {
        $options = array('conditions' => array('Contact.' . $this->Contact->primaryKey => $id));
        $this->request->data = $this->Contact->find('first', $options);
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
    $this->Contact->id = $id;
    if (!$this->Contact->exists()) {
        $this->Message->setWarning(__('Invalid contact'),array('action'=>'index'));
    }
    if ($this->Contact->delete()) {
        $this->Message->setSuccess(__('The contact has been deleted.'));
    } else {
        $this->Message->setWarning(__('The contact could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}}
