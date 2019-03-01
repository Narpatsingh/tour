<?php
App::uses('AppController', 'Controller');
/**
 * Galleries Controller
 *
 * @property Gallery $Gallery
 * @property PaginatorComponent $Paginator
 */
class GalleriesController extends AppController {

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
        $this->Session->write('GallerySearch', '');
    }

    if (empty($this->request->data['Gallery']) && $this->Session->read('GallerySearch')) {
        $this->request->data['Gallery'] = $this->Session->read('GallerySearch');
    }
    if (!empty($this->request->data['Gallery'])) {
        $this->request->data['Gallery'] = array_filter($this->request->data['Gallery']);
        $this->request->data['Gallery'] = array_map('trim', $this->request->data['Gallery']);
        if (!empty($this->request->data)) {
            if (isset($this->request->data['Gallery']['first_name'])) {
                $conditions['Gallery.first_name LIKE '] = '%' . $this->request->data['Gallery']['first_name'] . '%';
            }
            if (isset($this->request->data['Gallery']['last_name'])) {
                $conditions['Gallery.last_name LIKE '] = '%' . $this->request->data['Gallery']['last_name'] . '%';
            }
            if (isset($this->request->data['Gallery']['name'])) {
                $conditions['Gallery.name LIKE '] = '%' . $this->request->data['Gallery']['name'] . '%';
            }
            if (isset($this->request->data['Gallery']['email'])) {
                $conditions['Gallery.email LIKE '] = '%' . $this->request->data['Gallery']['email'] . '%';
            }
            if (isset($this->request->data['Gallery']['status'])) {
                $conditions['Gallery.status'] = $this->request->data['Gallery']['status'];
            }
        }
        $this->Session->write('GallerySearch', $this->request->data['Gallery']);
    }
    $this->AutoPaginate->setPaginate(array(
        'order' => ' Gallery.id DESC',
        'conditions' => $conditions
    ));
    $this->loadModel('Gallery');
    $this->set('galleries', $this->paginate('Gallery'));

}

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function view($id = null) {
    if (!$this->Gallery->exists($id)) {
        $this->Message->setWarning(__('Invalid gallery'),array('action'=>'index'));
    }
    $options = array('conditions' => array('Gallery.' . $this->Gallery->primaryKey => $id));
    $this->set('gallery', $this->Gallery->find('first', $options));
}

/**
* add method
*
* @return void
*/
// public function add() {
//     if ($this->request->is('post')) {
//         $this->Gallery->create();
//         if ($this->Gallery->save($this->request->data)) {
//             $this->Message->setSuccess(__('The gallery has been saved.'));
//             return $this->redirect(array('action' => 'index'));
//         } else {
//             $this->Message->setWarning(__('The gallery could not be saved. Please, try again.'));
//         }
//     }
//     $gallery_types = $this->Gallery->GalleryType->find('list');
//     $this->set('gallery_types', $gallery_types);
// }

/**
* edit method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function edit($id = null) {
    if (!$this->Gallery->exists($id)) {
        $this->Message->setWarning(__('Invalid gallery'),array('action'=>'index'));
    }
    if ($this->request->is(array('post', 'put'))) {
        if ($this->Gallery->save($this->request->data)) {
            $this->Message->setSuccess(__('The gallery has been updated.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Message->setWarning(__('The gallery could not be updated. Please, try again.'));
        }
    } else {
        $options = array('conditions' => array('Gallery.' . $this->Gallery->primaryKey => $id));
        $this->request->data = $this->Gallery->find('first', $options);
    }
    $gallery_types = $this->Gallery->GalleryType->find('list');
    $this->set('gallery_types', $gallery_types);
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
    $this->Gallery->id = $id;
    if (!$this->Gallery->exists()) {
        $this->Message->setWarning(__('Invalid gallery'),array('action'=>'index'));
    }
    if ($this->Gallery->delete()) {
        $this->Message->setSuccess(__('The gallery has been deleted.'));
    } else {
        $this->Message->setWarning(__('The gallery could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}

/**
* types method
*
* @return void
*/
public function types($all = null) {
    $this->AutoPaginate->setPaginate(array(
        'order' => ' GalleryType.id DESC',
    ));
    $this->loadModel('GalleryType');
    $this->set('gallerytypes', $this->paginate('GalleryType'));

}

/**
* editTypes method
*
* @return void
*/
public function editTypes($id = null) {
    $this->loadModel('GalleryType');
    if (!$this->GalleryType->exists($id)) {
        $this->Message->setWarning(__('Invalid Gallery Type'),array('action'=>'types'));
    }
    if ($this->request->is(array('post', 'put'))) {
        if ($this->GalleryType->save($this->request->data)) {
            $this->Message->setSuccess(__('The Gallery Type has been updated.'));
            return $this->redirect(array('action' => 'types'));
        } else {
            $this->Message->setWarning(__('The Gallery Type could not be updated. Please, try again.'));
        }
    } else {
        $options = array('conditions' => array('GalleryType.id' => $id));
        $this->request->data = $this->GalleryType->find('first', $options);
    }
    $this->set('edit',1);

}


}
