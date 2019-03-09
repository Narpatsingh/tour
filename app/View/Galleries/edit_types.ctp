<?php
$type = empty($edit) ? 'Add' : 'Edit';
$this->assign('pagetitle', __('%s Gallery Type',$type));
$this->Custom->addCrumb(__('Gallery Type'),array('action'=>'types'));
$this->Custom->addCrumb(__('%s Gallery Type',$type));
$this->start('top_links');
echo $this->Html->link(__('Back'),array('action'=>'types'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
$this->end();

?>
<div class="box box-primary">
    <div class="overflow-hide-break">
        <?php echo $this->Form->create('GalleryType', array('class' => 'form-validate multiple_save','type'=>'file')); ?>
        <div class="box-body box-content">
            <?php
                echo $this->Form->input('id',array('type'=>'hidden'));
                echo $this->Form->input('title',array('class' => 'form-control','label'=>'Type Name','div' => array('class' => 'form-group')));
            ?>
            </div>
        <div class="form-action">
        <?php echo $this->Form->submit(__('Save'), array('div' => false,'class' => 'btn btn-primary btn_dsbl'));?>
        &nbsp;&nbsp;
        <?php echo $this->Html->link(__('Cancel'), array('action' => 'index'), array('class' => 'btn btn-default'));?>
        </div>

        <?php $arrValidation = array(
            'Rules' => array(
                'title' => array('required' => 1,'alphabates'=> true),
            ),
            'Messages' => array(
                'title' => array('required' => __('Please enter Type Name.')),
            ));
        echo $this->Form->setValidation($arrValidation); ?>
        <?php echo $this->Form->end(); ?>
    </div>
</div>
