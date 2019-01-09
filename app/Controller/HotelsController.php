<?php
App::uses('AppController', 'Controller');
/**
 * Hotels Controller
 *
 * @property Hotel $Hotel
 * @property PaginatorComponent $Paginator
 */
class HotelsController extends AppController {

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
$this->Session->write('HotelSearch', '');
}

if (empty($this->request->data['Hotel']) && $this->Session->read('HotelSearch')) {
$this->request->data['Hotel'] = $this->Session->read('HotelSearch');
}
if (!empty($this->request->data['Hotel'])) {
$this->request->data['Hotel'] = array_filter($this->request->data['Hotel']);
$this->request->data['Hotel'] = array_map('trim', $this->request->data['Hotel']);
if (!empty($this->request->data)) {

if (isset($this->request->data['Hotel']['name'])) {
$conditions['Hotel.name LIKE '] = '%' . $this->request->data['Hotel']['name'] . '%';
}
}
$this->Session->write('HotelSearch', $this->request->data['Hotel']);
}
$this->AutoPaginate->setPaginate(array(
'order' => ' Hotel.id DESC',
'conditions' => $conditions
));
$this->loadModel('Hotel');
$this->set('hotels', $this->paginate('Hotel'));

}

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function view($id = null) {
if (!$this->Hotel->exists($id)) {
$this->Message->setWarning(__('Invalid hotel'),array('action'=>'index'));
}
$options = array('conditions' => array('Hotel.' . $this->Hotel->primaryKey => $id));
$this->set('hotel', $this->Hotel->find('first', $options));
}

/**
* add method
*
* @return void
*/
public function add() {
    if ($this->request->is('post')) {
        $this->Hotel->create();
        if (!empty($this->request->data['Hotel']['photo']['name'])){
            $filename = WWW_ROOT. DS . 'images'.DS. 'hotels' .DS.time().$this->data['Hotel']['photo']['name']; 
            move_uploaded_file($this->data['Hotel']['photo']['tmp_name'],$filename);
            $this->request->data['Hotel']['photo'] = 'images/hotels/'.time().$this->request->data['Hotel']['photo']['name'];
        }
        if ($this->Hotel->save($this->request->data)) {
            $this->Message->setSuccess(__('The hotel has been saved.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The hotel could not be saved. Please, try again.'));
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
        if (!$this->Hotel->exists($id)) {
        $this->Message->setWarning(__('Invalid hotel'),array('action'=>'index'));
        }
        $options = array('conditions' => array('Hotel.' . $this->Hotel->primaryKey => $id));
        $hotel_data = $this->Hotel->find('first', $options);
        if ($this->request->is(array('post', 'put'))) {
            if (!empty($this->request->data['Hotel']['photo']['name'])){
                $filename = WWW_ROOT. DS . 'images'.DS. 'hotels' .DS.time().$this->data['Hotel']['photo']['name']; 
                move_uploaded_file($this->data['Hotel']['photo']['tmp_name'],$filename);
                $this->request->data['Hotel']['photo'] = 'images/hotels/'.time().$this->request->data['Hotel']['photo']['name'];
            }
            else{
                $this->request->data['Hotel']['photo'] = $hotel_data['Hotel']['photo'];
            }

            if ($this->Hotel->save($this->request->data)) {
                $this->Message->setSuccess(__('The hotel has been updated.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Message->setWarning(__('The hotel could not be updated. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Hotel.' . $this->Hotel->primaryKey => $id));
            $this->request->data = $hotel_data;
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
$this->Hotel->id = $id;
if (!$this->Hotel->exists()) {
$this->Message->setWarning(__('Invalid hotel'),array('action'=>'index'));
}
if ($this->Hotel->delete()) {
    $this->Message->setSuccess(__('The hotel has been deleted.'));
    } else {
    $this->Message->setWarning(__('The hotel could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}}
