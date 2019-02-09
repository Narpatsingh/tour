<?php
App::uses('AppController', 'Controller');
/**
 * Accounts Controller
 *
 * @property Account $Account
 * @property PaginatorComponent $Paginator
 */
class AccountsController extends AppController {

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
        $this->Session->write('AccountSearch', '');
    }

    if (empty($this->request->data['Account']) && $this->Session->read('AccountSearch')) {
        $this->request->data['Account'] = $this->Session->read('AccountSearch');
    }
    if (!empty($this->request->data['Account'])) {
        $this->request->data['Account'] = array_filter($this->request->data['Account']);
        $this->request->data['Account'] = array_map('trim', $this->request->data['Account']);
        if (!empty($this->request->data)) {
            if (isset($this->request->data['Account']['first_name'])) {
                $conditions['Account.first_name LIKE '] = '%' . $this->request->data['Account']['first_name'] . '%';
            }
            if (isset($this->request->data['Account']['last_name'])) {
                $conditions['Account.last_name LIKE '] = '%' . $this->request->data['Account']['last_name'] . '%';
            }
            if (isset($this->request->data['Account']['name'])) {
                $conditions['Account.name LIKE '] = '%' . $this->request->data['Account']['name'] . '%';
            }
            if (isset($this->request->data['Account']['email'])) {
                $conditions['Account.email LIKE '] = '%' . $this->request->data['Account']['email'] . '%';
            }
            if (isset($this->request->data['Account']['status'])) {
                $conditions['Account.status'] = $this->request->data['Account']['status'];
            }
        }
        $this->Session->write('AccountSearch', $this->request->data['Account']);
    }
    $this->AutoPaginate->setPaginate(array(
        'order' => ' Account.id DESC',
        'conditions' => $conditions
    ));
    $this->loadModel('Account');
    $this->set('accounts', $this->paginate('Account'));

}

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function view($id = null) {
    if (!$this->Account->exists($id)) {
        $this->Message->setWarning(__('Invalid account'),array('action'=>'index'));
    }
    $options = array('conditions' => array('Account.' . $this->Account->primaryKey => $id));
    $this->set('account', $this->Account->find('first', $options));
}

/**
* add method
*
* @return void
*/
public function add() {
    if ($this->request->is('post')) {
        $this->Account->create();
        if ($this->Account->save($this->request->data)) {
            $this->Message->setSuccess(__('The account has been saved.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The account could not be saved. Please, try again.'));
        }
    }
    $vouchers = $this->Account->Voucher->find('list');
    $this->set(compact('vouchers'));
}

/**
* edit method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function edit($id = null) {
    $id = decrypt($id);
    if (!$this->Account->exists($id)) {
        $this->Message->setWarning(__('Invalid account'),array('action'=>'index'));
    }
    if ($this->request->is(array('post', 'put'))) {
        if(!empty($this->request->data['Account']['payment_recieved'])){

            $total_payment_with_gst = $this->Account->get_total_payment_with_gst($id);
            $this->request->data['Account']['payment_receivable'] = $total_payment_with_gst - $this->request->data['Account']['payment_recieved'];
        }

        if ($this->Account->save($this->request->data)) {
            $this->Message->setSuccess(__('The account has been updated.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The account could not be updated. Please, try again.'));
        }
    } else {
        $options = array('conditions' => array('Account.' . $this->Account->primaryKey => $id));
        $this->request->data = $this->Account->find('first', $options);
    }
    $vouchers = $this->Account->Voucher->find('list');
    $this->set(compact('vouchers'));
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
    $this->Account->id = $id;
    if (!$this->Account->exists()) {
        $this->Message->setWarning(__('Invalid account'),array('action'=>'index'));
    }
    if ($this->Account->delete()) {
        $this->Message->setSuccess(__('The account has been deleted.'));
    } else {
        $this->Message->setWarning(__('The account could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}}
