<?php
$type = empty($edit) ? 'Add' : 'Edit';
$this->assign('pagetitle', __('%s Report', $type));
$this->Custom->addCrumb(__('Reports'), array('action' => 'index'));
$this->Custom->addCrumb(__('%s Report', $type));
$this->start('top_links');
echo $this->Html->link(__('Back'), array('action' => 'index'), array('icon' => 'fa-angle-double-left', 'class' => 'btn btn-default', 'escape' => false));
$this->end();
?>
<div class="box box-primary">
    <div class="overflow-hide-break">
        <?php echo $this->Form->create('Report', array('class' => 'form-validate', 'type' => 'file')); ?>
        <div class="box-body box-content">
            <?php
            echo $this->Form->input('id', array('type' => 'hidden'));
            //            echo $this->element("backend/entry_selector");
            echo $this->Form->input('user_id', array('class' => 'form-control', 'empty'=>'select user','id' => 'ReportUserID', 'div' => array('class' => 'col-md-4 margin-bottom10')));
            echo $this->Form->input('date', array('class' => 'form-control hascalendar', 'type' => 'text', 'id' => 'ReportUserDate', 'div' => array('class' => 'col-md-4 margin-bottom10')));
            echo $this->Form->input('name', array('class' => 'form-control', 'type' => 'file', 'id' => 'ReportFile', 'div' => array('class' => 'col-md-4 margin-bottom10')));
            //            echo $this->Form->input('user_id', array('class' => 'form-control', 'div' => array('class' => 'form-group')));
            //            echo $this->Form->input('name', array('class' => 'form-control', 'div' => array('class' => 'form-group')));
            ?>
        </div>
        <div class="form-action">
            <?php echo $this->Form->submit(__('Save'), array('div' => false, 'class' => 'btn btn-primary')); ?>
            &nbsp;&nbsp;
            <?php echo $this->Html->link(__('Cancel'), array('action' => 'index'), array('class' => 'btn btn-default')); ?>
        </div>

        <?php $arrValidation = array(
            'Rules' => array(
                'user_id' => array('required' => 1),
                'name' => array('required' => 1,
                    'accept' => 'pdf,pptx,doc,xls'),

            ),
            'Messages' => array(
                'user_id' => array('required' => __('Please select user')),
                'name' => array(
                    'required' => __('Please select file'),
                    'accept' => __('Please choose files having pdf, pptx, doc, xls extension.')
                ),));


        echo $this->Form->setValidation($arrValidation); ?>

        <?php echo $this->Form->end(); ?>
    </div>
</div>
