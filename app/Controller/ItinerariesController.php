<?php
App::uses('AppController', 'Controller');
/**
 * Itineraries Controller
 *
 * @property Itinerary $Itinerary
 * @property PaginatorComponent $Paginator
 */
class ItinerariesController extends AppController {

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
            $this->Session->write('Itinerariesearch', '');
        }

        if (empty($this->request->data['Itinerary']) && $this->Session->read('Itinerariesearch')) {
            $this->request->data['Itinerary'] = $this->Session->read('Itinerariesearch');
        }
        if (!empty($this->request->data['Itinerary'])) {
            $this->request->data['Itinerary'] = array_filter($this->request->data['Itinerary']);
            $this->request->data['Itinerary'] = array_map('trim', $this->request->data['Itinerary']);
            if (!empty($this->request->data)) {
                if (isset($this->request->data['Itinerary']['Itinerary_name'])) {
                    $conditions['Itinerary.name LIKE '] = '%' . $this->request->data['Itinerary']['Itinerary_name'] . '%';
                }
                if (isset($this->request->data['Itinerary']['status'])) {
                    $conditions['Itinerary.status'] = $this->request->data['Itinerary']['status'];
                }
            }
            $this->Session->write('Itinerariesearch', $this->request->data['Itinerary']);
        }
        $this->AutoPaginate->setPaginate(array(
            'order' => ' Itinerary.id DESC',
            'conditions' => $conditions,
            'recursive'=>'1'
        ));
        $this->set('Itineraries', $this->paginate('Itinerary'));
    }

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
    public function view($id = null) {
        if (!$this->Itinerary->exists($id)) {
            $this->Message->setWarning(__('Invalid Itinerary'),array('action'=>'index'));
        }
        $options = array('conditions' => array('Itinerary.' . $this->Itinerary->primaryKey => $id));
        $this->set('Itinerary', $this->Itinerary->find('first', $options));
    }

/**
* add method
*
* @return void
*/
    public function add() {

        if ($this->request->is('post')) {
            $tour_id = $this->request->data['Itinerary']['tour_id'];
            $this->Itinerary->create();
            if ($this->Itinerary->save($this->request->data)) {  
                $this->Message->setSuccess(__('The Itinerary has been saved.'));
            }else {
                $this->Message->setWarning(__('The Itinerary could not be saved. Please, select Itinerary type.'));
            }
            return $this->redirect(array('controller'=>'tours','action' => 'view', $tour_id));
        }
        $this->set('edit',1);
    }


    public function addItenraryPopup($id = null,$itenerary_id = null)
    {
        if(!empty($itenerary_id)){  
            $options = array('conditions' => array('Itinerary.' . $this->Itinerary->primaryKey => $itenerary_id));
            $this->request->data = $this->Itinerary->find('first', $options);
            $this->set('edit',1);
        }   
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->set('tour_id',$id);
            $this->autoRender = false;
            $this->autoLayout = false;
            $renderData = $this->render('/Itineraries/add_itenrrary_poup')->body();
            echo $renderData;
            exit;
        }else{
            return $this->redirect('index');
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
        $this->Itinerary->id = $id;
        if ($this->request->is(array('post', 'put'))) {
            $tour_id = $this->request->data['Itinerary']['tour_id'];
            if ($this->Itinerary->save($this->request->data)) {
                $this->Message->setSuccess(__('The Itinerary has been updated.'));
            } else {
                $this->Message->setWarning(__('The Itinerary could not be updated. Please, try again.'));
            }
            return $this->redirect(array('controller'=>'tours','action' => 'view',$tour_id));
        }
    }

/**
* delete method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
    public function delete($id = null) {
        $this->Itinerary->id = $id;
        $options = array('conditions' => array('Itinerary.' . $this->Itinerary->primaryKey => $id));
        $data = $this->Itinerary->find('first', $options);
        if ($this->Itinerary->delete()) {
            $this->Message->setSuccess(__('The Itinerary has been deleted.'));
        } else {
            $this->Message->setWarning(__('The Itinerary could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('controller'=>'tours','action' => 'view',$data['Itinerary']['tour_id']));
    }

}
