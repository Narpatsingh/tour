<?php
$type = empty($edit) ? 'Add' : 'Edit';
$this->assign('pagetitle', __('%s Gallery',$type));
$this->Custom->addCrumb(__('Galleries'),array('action'=>'index'));
$this->Custom->addCrumb(__('%s Gallery',$type));
$this->start('top_links');
echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
$this->end();
$photo = '';
if (isset($this->request->data['Gallery']['id'])) {
    $id = $this->request->data['Gallery']['id'];
    $photo = isset($this->request->data['Gallery']['photo']) ? $this->request->data['Gallery']['photo'] : '';
}

?>
<div class="box box-primary">
    <div class="overflow-hide-break">
        <?php echo $this->Form->create('Gallery', array('class' => 'form-validate','type'=>'file')); ?>
        <div class="box-body box-content">
            <?php
            echo $this->Form->input('id',array('type'=>'hidden'));
            echo $this->Form->input('title',array('class' => 'form-control','options'=>array('hotels'=>'Hotel','tours'=>'Tour','cruises'=>'Cruise'), 'div' => array('class' => 'form-group')));
            echo $this->Form->input('description',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
            ?>
            <label class="form-group" style="margin-bottom: 10px">Gallery Photo</label>
            <div class="form-group row">
                <div id='photoId' class='col-md-4'>
                    <?php if(!empty($photo)){
                        echo $this->Html->image(GALLERY_IMAGE.$id.'/'.$photo, array('class' => 'thumbnail img-responsive', 'style' => 'width: 300px;height: 220px;'));
                    }else{
                        echo $this->Html->image(NO_IMAGE, array('class' => 'thumbnail img-responsive', 'style' => 'max-width: 250px'));
                    }?>
                </div>
                <?php echo $this->Form->input('photo', array('required' => false, 'label' => false, 'type' => 'file', /*'before' => '<label for="PlacePhoto" class="btn btn-info"><i class="fa fa-upload">&nbsp;</i>' . __('Select Photo') . '</label>', 'after' => '<span id="photo-name" style="margin-left: 15px"></span>', 'class' => 'hidden photo',*/ 'div' => array('class' => 'col-md-10'))) ?>
                <div for='PlacePhoto' generated='true' class='error' style='display: none'>
                    <span class="errorDV"> </span>
                </div>
            </div>
        </div>
        <div class="form-action">
        <?php echo $this->Form->submit(__('Save'), array('div' => false,'class' => 'btn btn-primary'));?>
        &nbsp;&nbsp;
        <?php echo $this->Html->link(__('Cancel'), array('action' => 'index'), array('class' => 'btn btn-default'));?>
        </div>

        <?php $arrValidation = array(
            'Rules' => array(
                'title' => array('required' => 1),
                'description' => array('required' => 1),

            ),
            'Messages' => array(
                'title' => array('required' => __('Please enter Title')),
                'description' => array('required' => __('Please enter Description')),
            ));
        echo $this->Form->setValidation($arrValidation); ?>
        <?php echo $this->Form->end(); ?>
    </div>
</div>
