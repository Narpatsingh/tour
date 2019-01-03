<?php
/**
 * Bake Template for Controller action generation.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.actions
 * @since         CakePHP(tm) v 1.3
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>

/**
* <?php echo $admin ?>beforefilter method
*
* @return void
*/
<?php if (empty($admin)): ?>
    public function beforeFilter()
    {
    parent::beforeFilter();
    $this->_checkLogin();
    }
<?php endif; ?>

/**
* <?php echo $admin ?>index method
*
* @return void
*/
public function <?php echo $admin ?>index($all = null) {
$conditions = array();
if ($all == "all") {
$this->Session->write('<?php echo $currentModelName ?>Search', '');
}

if (empty($this->request->data['<?php echo $currentModelName ?>']) && $this->Session->read('<?php echo $currentModelName ?>Search')) {
$this->request->data['<?php echo $currentModelName ?>'] = $this->Session->read('<?php echo $currentModelName ?>Search');
}
if (!empty($this->request->data['<?php echo $currentModelName ?>'])) {
$this->request->data['<?php echo $currentModelName ?>'] = array_filter($this->request->data['<?php echo $currentModelName ?>']);
$this->request->data['<?php echo $currentModelName ?>'] = array_map('trim', $this->request->data['<?php echo $currentModelName ?>']);
if (!empty($this->request->data)) {
if (isset($this->request->data['<?php echo $currentModelName ?>']['first_name'])) {
$conditions['<?php echo $currentModelName ?>.first_name LIKE '] = '%' . $this->request->data['<?php echo $currentModelName ?>']['first_name'] . '%';
}
if (isset($this->request->data['<?php echo $currentModelName ?>']['last_name'])) {
$conditions['<?php echo $currentModelName ?>.last_name LIKE '] = '%' . $this->request->data['<?php echo $currentModelName ?>']['last_name'] . '%';
}
if (isset($this->request->data['<?php echo $currentModelName ?>']['name'])) {
$conditions['<?php echo $currentModelName ?>.name LIKE '] = '%' . $this->request->data['<?php echo $currentModelName ?>']['name'] . '%';
}
if (isset($this->request->data['<?php echo $currentModelName ?>']['email'])) {
$conditions['<?php echo $currentModelName ?>.email LIKE '] = '%' . $this->request->data['<?php echo $currentModelName ?>']['email'] . '%';
}
if (isset($this->request->data['<?php echo $currentModelName ?>']['status'])) {
$conditions['<?php echo $currentModelName ?>.status'] = $this->request->data['<?php echo $currentModelName ?>']['status'];
}
}
$this->Session->write('<?php echo $currentModelName ?>Search', $this->request->data['<?php echo $currentModelName ?>']);
}
$this->AutoPaginate->setPaginate(array(
'order' => ' <?php echo $currentModelName ?>.id DESC',
'conditions' => $conditions
));
$this->loadModel('<?php echo $currentModelName ?>');
$this->set('<?php echo $pluralName ?>', $this->paginate('<?php echo $currentModelName ?>'));

}

/**
* <?php echo $admin ?>view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function <?php echo $admin ?>view($id = null) {
if (!$this-><?php echo $currentModelName; ?>->exists($id)) {
$this->Message->setWarning(__('Invalid <?php echo strtolower($singularHumanName); ?>'),array('action'=>'index'));
}
$options = array('conditions' => array('<?php echo $currentModelName; ?>.' . $this-><?php echo $currentModelName; ?>->primaryKey => $id));
$this->set('<?php echo $singularName; ?>', $this-><?php echo $currentModelName; ?>->find('first', $options));
}

<?php $compact = array(); ?>
/**
* <?php echo $admin ?>add method
*
* @return void
*/
public function <?php echo $admin ?>add() {
if ($this->request->is('post')) {
$this-><?php echo $currentModelName; ?>->create();
if ($this-><?php echo $currentModelName; ?>->save($this->request->data)) {
<?php if ($wannaUseSession): ?>
    $this->Message->setSuccess(__('The <?php echo strtolower($singularHumanName); ?> has been saved.'));
    return $this->redirect(array('action' => 'index'));
    } else {
    $this->Message->setWarning(__('The <?php echo strtolower($singularHumanName); ?> could not be saved. Please, try again.'));
<?php else: ?>
    return $this->Message->setSuccess(__('The <?php echo strtolower($singularHumanName); ?> has been saved.'), array('action' => 'index'));
<?php endif; ?>
}
}
<?php
foreach (array('belongsTo', 'hasAndBelongsToMany', 'hasMany') as $assoc):
    foreach ($modelObj->{$assoc} as $associationName => $relation):
        if (!empty($associationName)):
            $otherModelName = $this->_modelName($associationName);
            $otherPluralName = $this->_pluralName($associationName);
            echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
            $compact[] = "'{$otherPluralName}'";
        endif;
    endforeach;
endforeach;
if (!empty($compact)):
    echo "\t\t\$this->set(compact(" . join(', ', $compact) . "));\n";
endif;

?>
}

<?php $compact = array(); ?>
/**
* <?php echo $admin ?>edit method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function <?php echo $admin; ?>edit($id = null) {
if (!$this-><?php echo $currentModelName; ?>->exists($id)) {
$this->Message->setWarning(__('Invalid <?php echo strtolower($singularHumanName); ?>'),array('action'=>'index'));
}
if ($this->request->is(array('post', 'put'))) {
if ($this-><?php echo $currentModelName; ?>->save($this->request->data)) {
<?php if ($wannaUseSession): ?>
    $this->Message->setSuccess(__('The <?php echo strtolower($singularHumanName); ?> has been updated.'));
    return $this->redirect(array('action' => 'index'));
    } else {
    $this->Message->setWarning(__('The <?php echo strtolower($singularHumanName); ?> could not be updated. Please, try again.'));
<?php else: ?>
    return $this->Message->setSuccess(__('The <?php echo strtolower($singularHumanName); ?> has been updated.'), array('action' => 'index'));
<?php endif; ?>
}
} else {
$options = array('conditions' => array('<?php echo $currentModelName; ?>.' . $this-><?php echo $currentModelName; ?>->primaryKey => $id));
$this->request->data = $this-><?php echo $currentModelName; ?>->find('first', $options);
}
<?php
foreach (array('belongsTo', 'hasAndBelongsToMany', 'hasMany') as $assoc):
    foreach ($modelObj->{$assoc} as $associationName => $relation):
        if (!empty($associationName)):
            $otherModelName = $this->_modelName($associationName);
            $otherPluralName = $this->_pluralName($associationName);
            echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
            $compact[] = "'{$otherPluralName}'";
        endif;
    endforeach;
endforeach;
if (!empty($compact)):
    echo "\t\t\$this->set(compact(" . join(', ', $compact) . "));\n";
endif;
echo "\t\t\$this->set('edit',1);\n";
echo "\t\t\$this->render('{$admin}add');\n";

?>
}

/**
* <?php echo $admin ?>delete method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function <?php echo $admin; ?>delete($id = null) {
$this-><?php echo $currentModelName; ?>->id = $id;
if (!$this-><?php echo $currentModelName; ?>->exists()) {
$this->Message->setWarning(__('Invalid <?php echo strtolower($singularHumanName); ?>'),array('action'=>'index'));
}
if ($this-><?php echo $currentModelName; ?>->delete()) {
<?php if ($wannaUseSession): ?>
    $this->Message->setSuccess(__('The <?php echo strtolower($singularHumanName); ?> has been deleted.'));
    } else {
    $this->Message->setWarning(__('The <?php echo strtolower($singularHumanName); ?> could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
<?php else: ?>
    return $this->Message->setSuccess(__('The <?php echo strtolower($singularHumanName); ?> has been deleted.'), array('action' => 'index'));
    } else {
    return $this->Message->setWarning(__('The <?php echo strtolower($singularHumanName); ?> could not be deleted. Please, try again.'), array('action' => 'index'));
    }
<?php endif; ?>
}
