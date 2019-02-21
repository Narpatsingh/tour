<?php
App::uses('AppController', 'Controller');
/**
 * HotelBookings Controller
 *
 * @property HotelBooking $HotelBooking
 * @property PaginatorComponent $Paginator
 */
class HotelBookingsController extends AppController {

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
        $this->Session->write('HotelBookingSearch', '');
    }

    if (empty($this->request->data['HotelBooking']) && $this->Session->read('HotelBookingSearch')) {
        $this->request->data['HotelBooking'] = $this->Session->read('HotelBookingSearch');
    }
    if (!empty($this->request->data['HotelBooking'])) {
        $this->request->data['HotelBooking'] = array_filter($this->request->data['HotelBooking']);
        $this->request->data['HotelBooking'] = array_map('trim', $this->request->data['HotelBooking']);
        if (!empty($this->request->data)) {
            if (isset($this->request->data['HotelBooking']['first_name'])) {
                $conditions['HotelBooking.first_name LIKE '] = '%' . $this->request->data['HotelBooking']['first_name'] . '%';
            }
            if (isset($this->request->data['HotelBooking']['last_name'])) {
                $conditions['HotelBooking.last_name LIKE '] = '%' . $this->request->data['HotelBooking']['last_name'] . '%';
            }
            if (isset($this->request->data['HotelBooking']['name'])) {
                $conditions['HotelBooking.name LIKE '] = '%' . $this->request->data['HotelBooking']['name'] . '%';
            }
            if (isset($this->request->data['HotelBooking']['email'])) {
                $conditions['HotelBooking.email LIKE '] = '%' . $this->request->data['HotelBooking']['email'] . '%';
            }
            if (isset($this->request->data['HotelBooking']['status'])) {
                $conditions['HotelBooking.status'] = $this->request->data['HotelBooking']['status'];
            }
        }
        $this->Session->write('HotelBookingSearch', $this->request->data['HotelBooking']);
    }
    $this->AutoPaginate->setPaginate(array(
        'order' => ' HotelBooking.id DESC',
        'conditions' => $conditions
    ));
    $this->loadModel('HotelBooking');
    $this->set('hotelBookings', $this->paginate('HotelBooking'));

}

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function view($id = null) {
    if (!$this->HotelBooking->exists($id)) {
        $this->Message->setWarning(__('Invalid hotel booking'),array('action'=>'index'));
    }
    $options = array('conditions' => array('HotelBooking.' . $this->HotelBooking->primaryKey => $id));
    $this->set('hotelBooking', $this->HotelBooking->find('first', $options));
}

/**
* add method
*
* @return void
*/
public function add() {
    if ($this->request->is('post')) {
        $this->HotelBooking->create();
        if ($this->HotelBooking->save($this->request->data)) {
            $this->Message->setSuccess(__('The hotel booking has been saved.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The hotel booking could not be saved. Please, try again.'));
        }
    }
    $states = $this->HotelBooking->State->find('list');
    $cities = [];
    $hotels = [];
    $customers = $this->HotelBooking->Customer->find('list');
    $this->set(compact('cities', 'states', 'hotels', 'customers'));
}

/**
* edit method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function edit($id = null) {
    if (!$this->HotelBooking->exists($id)) {
        $this->Message->setWarning(__('Invalid hotel booking'),array('action'=>'index'));
    }
    if ($this->request->is(array('post', 'put'))) {
        if ($this->HotelBooking->save($this->request->data)) {
            $this->Message->setSuccess(__('The hotel booking has been updated.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The hotel booking could not be updated. Please, try again.'));
        }
    } else {
        $options = array('conditions' => array('HotelBooking.' . $this->HotelBooking->primaryKey => $id));
        $this->request->data = $this->HotelBooking->find('first', $options);
    }
    $states = $this->HotelBooking->State->find('list');
    $cities = $this->HotelBooking->City->find('list',array('conditions'=>array('City.state_id' => $this->request->data['HotelBooking']['state_id']))); 
    $hotels = $this->HotelBooking->Hotel->find('list',array('conditions'=>array('Hotel.city_id' => $this->request->data['HotelBooking']['city_id']))); 
    $customers = $this->HotelBooking->Customer->find('list');
    $this->set(compact('cities', 'states', 'hotels', 'customers'));
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
    $this->HotelBooking->id = $id;
    if (!$this->HotelBooking->exists()) {
        $this->Message->setWarning(__('Invalid hotel booking'),array('action'=>'index'));
    }
    if ($this->HotelBooking->delete()) {
        $this->Message->setSuccess(__('The hotel booking has been deleted.'));
    } else {
        $this->Message->setWarning(__('The hotel booking could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}}
