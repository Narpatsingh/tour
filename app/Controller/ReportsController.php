<?php
App::uses('AppController', 'Controller');

/**
 * Reports Controller
 *
 * @property Report $Report
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ReportsController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    public $uses = array('Report','AuditLog');

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
    public function index($all = null)
    {
        $this->AutoPaginate->setPaginate(array(
            'order' => ' Report.id DESC',
            'conditions' => $this->getSearchCondition('Report',$all)
        ));

        $this->set('reports', $this->paginate('Report'));

    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        if (!$this->Report->exists($id)) {
            $this->Message->setWarning(__('Invalid report'), array('action' => 'index'));
        }
        $options = array('conditions' => array('Report.' . $this->Report->primaryKey => $id));
        $this->set('report', $this->Report->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Report->create();
            if ($this->Report->save($this->request->data)) {
                $this->Message->setSuccess(__('The report has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Message->setWarning(__('The report could not be saved. Please, try again.'));
            }
        }
        $users = $this->Report->User->getOnlyUserList();
        $this->set(compact('users'));
        $this->render('/Reports/add');
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        if (!$this->Report->exists($id)) {
            $this->Message->setWarning(__('Invalid report'), array('action' => 'index'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Report->save($this->request->data)) {
                $this->Message->setSuccess(__('The report has been updated.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Message->setWarning(__('The report could not be updated. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Report.' . $this->Report->primaryKey => $id));
            $this->request->data = $this->Report->find('first', $options);
        }
        $this->set('edit', 1);
        $this->render('add');
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        $this->Report->id = $id;
        if (!$this->Report->exists()) {
            $this->Message->setWarning(__('Invalid report'), array('action' => 'index'));
        }
        if ($this->Report->delete()) {
            $this->Message->setSuccess(__('The report has been deleted.'));
        } else {
            $this->Message->setWarning(__('The report could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function download($id = null)
    {
        $file = $this->Report->findById($id);
        $path = getFilePath($id, 'report/name', $file['Report']['name'], false);

        $this->response->file($path, array(
            'download' => true,
        ));
        return $this->response;
    }
     public function audit_log($all = null)
    {
        $this->loadModel('AuditLog');
        $conditions = array();

        if ($all == "all") {
            $this->Session->write('AuditLog.Search', '');
        }
        if (empty($this->request->data['AuditLog']) && $this->Session->read('AuditLog.Search')) {
            $this->request->data['AuditLog'] = $this->Session->read('AuditLog.Search');
        }

        if (!empty($this->request->data['AuditLog'])) {
            $this->request->data['AuditLog'] = array_filter($this->request->data['AuditLog']);
            $this->request->data['AuditLog'] = array_map('trim', $this->request->data['AuditLog']);
            if (!empty($this->request->data)) {
//                debug($this->request->data);exit;
                if (isset($this->request->data['AuditLog']['name'])) {
                    $conditions['User.first_name LIKE '] = '%' . $this->request->data['AuditLog']['name'] . '%';
                }
                if (isset($this->request->data['AuditLog']['type'])) {
                    $conditions['AuditLog.type'] = $this->request->data['AuditLog']['type'];
                }
                if (isset($this->request->data['AuditLog']['created'])) {
                    $conditions['date(AuditLog.created)'] = $this->request->data['AuditLog']['created'];
                }
            }
            $this->Session->write('AuditLog.Search', $this->request->data['AuditLog']);
        }


        $this->AutoPaginate->setPaginate(array(
            'order' => 'AuditLog.id DESC',
            'conditions' => $conditions,
        ));

        $this->Session->write('Export.auditLogConditions', $conditions);

        $this->loadModel('AuditLog');
        $this->loadModel('User');

        $names = $this->User->find('list', array(
            'conditions' => array(
                'role !=' => 'admin',
                'status' => 'active'
            ),
            'fields' => 'first_name, name'
        ));

        $this->set(compact('names'));
        $this->set('types', $this->AuditLog->getAuditLogStatusList());
        $this->set('auditlogs', $this->paginate('AuditLog'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view1($id = null)
    {
        $this->loadModel('AuditLog');
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->autoRender = false;

            if (!$this->AuditLog->exists($id)) {
                throw new NotFoundException(__('Invalid audit log'));
            }


            $conditions = array(
                'AuditLog.id' => $id
            );
            $auditLogs = $this->AuditLog->find('first', array(
                    'conditions' => $conditions,
                    'contain' => array('User')
                )
            );
            $this->set(compact('auditLogs'));
			
            $renderData = $this->render()->body();
            echo $renderData;
            exit;
        }
    }
}
