    <?php
    $type = empty($edit) ? 'Add' : 'Edit';
    $this->assign('pagetitle', __('%s Slider',$type));
    $this->Custom->addCrumb(__('Sliders'),array('action'=>'index'));
    $this->Custom->addCrumb(__('%s Slider',$type));
    $this->start('top_links');
    echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
    $this->end();
    ?>
    <div class="box box-primary">
        <div class="overflow-hide-break">
            <?php echo $this->Form->create('Slider', array('class' => 'form-validate','type'=>'file')); ?>
            <div class="box-body box-content">
               <?php
               echo $this->Form->input('id',array('type'=>'hidden'));
               echo $this->Form->input('tour_id',array('class' => 'form-control','options'=>$tour_id,'empty'=>'Select Package','div' => array('class' => 'form-group')));
               echo $this->Form->input('title',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
               echo $this->Form->input('description',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
               ?>
           </div>
           <div class="form-action">
            <?php echo $this->Form->submit(__('Save'), array('div' => false,'class' => 'btn btn-primary'));?>
            &nbsp;&nbsp;
            <?php echo $this->Html->link(__('Cancel'), array('action' => 'index'), array('class' => 'btn btn-default'));?>
        </div>

        <?php $arrValidation = array(
          'Rules' => array(
            'tour_id' => array('required' => 1),
            'title' => array('required' => 1),
            'description' => array('required' => 1),

        ),
          'Messages' => array(
            'tour_id' => array('required' => __('Please select Tour.')),
            'title' => array('required' => __('Please enter Title.')),
            'description' => array('required' => __('Please enter Description.')),));
        echo $this->Form->setValidation($arrValidation); ?>

            <?php echo $this->Form->end(); ?>
        </div>
    </div>
