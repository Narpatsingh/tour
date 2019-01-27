<?php
App::uses('AppController', 'Controller');
/**
 * Sliders Controller
 *
 * @property Slider $Slider
 * @property PaginatorComponent $Paginator
 */
class SlidersController extends AppController {

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
        $this->Session->write('SliderSearch', '');
    }

    if (empty($this->request->data['Slider']) && $this->Session->read('SliderSearch')) {
        $this->request->data['Slider'] = $this->Session->read('SliderSearch');
    }
    if (!empty($this->request->data['Slider'])) {
        $this->request->data['Slider'] = array_filter($this->request->data['Slider']);
        $this->request->data['Slider'] = array_map('trim', $this->request->data['Slider']);
        if (!empty($this->request->data)) {
            if (isset($this->request->data['Slider']['first_name'])) {
                $conditions['Slider.first_name LIKE '] = '%' . $this->request->data['Slider']['first_name'] . '%';
            }
        }
        $this->Session->write('SliderSearch', $this->request->data['Slider']);
    }
    $this->AutoPaginate->setPaginate(array(
        'order' => ' Slider.id DESC',
        'conditions' => $conditions
    ));
    $this->loadModel('Slider');
    $this->set('sliders', $this->paginate('Slider'));

}

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function view($id = null) {
    if (!$this->Slider->exists($id)) {
        $this->Message->setWarning(__('Invalid slider'),array('action'=>'index'));
    }
    $options = array('conditions' => array('Slider.' . $this->Slider->primaryKey => $id));
    $this->set('slider', $this->Slider->find('first', $options));
}

/**
* add method
*
* @return void
*/
public function add() {
    if ($this->request->is('post')) {
        $this->Slider->create();
        if ($this->Slider->save($this->request->data)) {
            $this->Message->setSuccess(__('The slider has been saved.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The slider could not be saved. Please, try again.'));
        }
    }
    $this->loadModel("Tour");
    $tour_list = $this->Tour->get_list();
    $this->set('tour_id',$tour_list);
}

/**
* edit method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function edit($id = null) {
    if (!$this->Slider->exists($id)) {
        $this->Message->setWarning(__('Invalid slider'),array('action'=>'index'));
    }
    if ($this->request->is(array('post', 'put'))) {
        if ($this->Slider->save($this->request->data)) {
            $this->Message->setSuccess(__('The slider has been updated.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The slider could not be updated. Please, try again.'));
        }
    } else {
        $options = array('conditions' => array('Slider.' . $this->Slider->primaryKey => $id));
        $this->request->data = $this->Slider->find('first', $options);
    }
    $this->loadModel("Tour");
    $tour_list = $this->Tour->get_list();
    $this->set('tour_id',$tour_list);
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
    $this->Slider->id = $id;
    if (!$this->Slider->exists()) {
        $this->Message->setWarning(__('Invalid slider'),array('action'=>'index'));
    }
    if ($this->Slider->delete()) {
        $this->Message->setSuccess(__('The slider has been deleted.'));
    } else {
        $this->Message->setWarning(__('The slider could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}}
