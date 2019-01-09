<?php
App::uses('AppController', 'Controller');
/**
 * Customers Controller
 *
 * @property Customer $Customer
 * @property PaginatorComponent $Paginator
 */
class CustomersController extends AppController {

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
    if ($all == "all")
    {
        $this->Session->write('CustomerSearch', '');
    }

    if (empty($this->request->data['Customer']) && $this->Session->read('CustomerSearch'))
    {
        $this->request->data['Customer'] = $this->Session->read('CustomerSearch');
    }

    if (!empty($this->request->data['Customer']))
        {
        $this->request->data['Customer'] = array_filter($this->request->data['Customer']);
        $this->request->data['Customer'] = array_map('trim', $this->request->data['Customer']);
        if (!empty($this->request->data))
        {
            if (isset($this->request->data['Customer']['first_name']))
            {
                $conditions['Customer.first_name LIKE '] = '%' . $this->request->data['Customer']['first_name'] . '%';
            }

            if (isset($this->request->data['Customer']['last_name']))
            {
                $conditions['Customer.last_name LIKE '] = '%' . $this->request->data['Customer']['last_name'] . '%';
            }

            if (isset($this->request->data['Customer']['name']))
            {
                $conditions['Customer.name LIKE '] = '%' . $this->request->data['Customer']['name'] . '%';
            }

            if (isset($this->request->data['Customer']['email']))
            {
                $conditions['Customer.email LIKE '] = '%' . $this->request->data['Customer']['email'] . '%';
            }

            if (isset($this->request->data['Customer']['status']))
            {
                $conditions['Customer.status'] = $this->request->data['Customer']['status'];
            }
        }

        $this->Session->write('CustomerSearch', $this->request->data['Customer']);
    }

    $this->AutoPaginate->setPaginate(array(
        'order' => ' Customer.id DESC',
        'conditions' => $conditions
    ));
    $this->loadModel('Customer');
    $this->set('customers', $this->paginate('Customer'));

}

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function view($id = null) {
    if (!$this->Customer->exists($id))
    {
        $this->Message->setWarning(__('Invalid customer') , array(
            'action' => 'index'
        ));
    }

    $options = array(
        'conditions' => array(
            'Customer.' . $this->Customer->primaryKey => $id
        )
    );
    $this->set('customer', $this->Customer->find('first', $options));
}

/**
* add method
*
* @return void
*/
public function add() {
    if ($this->request->is('post')) {
        $this->Customer->create();
        if ($this->Customer->save($this->request->data)) {
            $this->Message->setSuccess(__('The customer has been saved.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The customer could not be saved. Please, try again.'));
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

    if (!$this->Customer->exists($id)) {
        $this->Message->setWarning(__('Invalid customer'),array('action'=>'index'));
    }
    if ($this->request->is(array('post', 'put'))) {
        if ($this->Customer->save($this->request->data)) {
            $this->Message->setSuccess(__('The customer has been updated.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The customer could not be updated. Please, try again.'));
        }
    } else {
        $options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $id));
        $this->request->data = $this->Customer->find('first', $options);
    }
    $this->loadModel("Tour");
    $tour_list = $this->Tour->get_list();
    $this->set('packages',$tour_list);
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
    $this->Customer->id = $id;
    if (!$this->Customer->exists()) {
        $this->Message->setWarning(__('Invalid customer'),array('action'=>'index'));
    }
    if ($this->Customer->delete()) {
        $this->Message->setSuccess(__('The customer has been deleted.'));
    } else {
        $this->Message->setWarning(__('The customer could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}

}
