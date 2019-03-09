<?php 
$type = empty($edit) ? 'Add' : 'Edit';
$action = empty($edit) ? 'add' : 'edit';
$dsbl = empty($edit) ? '' : 'readonly';
echo $this->Form->create('Itinerary', array('action'=>$action, 'class' => 'form-validate multiple_save')); ?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title"><?=$type?> Itinerary</h4>
</div>
<div class="modal-body">
  <table class="table table-hover table-bordered">
    <tbody>
      <div class="historty">
          <?php
          echo $this->Form->hidden('tour_id',array('value'=>$tour_id));  
          echo $this->Form->input('day',array('class' => 'form-control','label'=>'Day','placeholder'=>'Enter Day', 'div' => array('class' => 'form-group required'))); 
          echo $this->Form->input('title',array('class' => 'form-control','label'=>'Title','placeholder'=>'Enter Title', 'div' => array('class' => 'form-group required'))); 
          echo $this->Form->input('km',array('class' => 'form-control','label'=>'Kilometer','placeholder'=>'Enter Kilometer', 'div' => array('class' => 'form-group'))); 
          echo $this->Form->input('hour',array('class' => 'form-control','label'=>'Hour','placeholder'=>'Enter Hour', 'div' => array('class' => 'form-group'))); 
          echo $this->Form->input('description',array('class' => 'form-control','label'=>'Description','placeholder'=>'Enter Description','div' => array('class' => 'form-group required')));                  
          ?>
      </div>
  <?php
      $arrValidation = array(
          'Rules' => array(
              'day' => array(
                  'required' => 1,
                  'minlength' => 1,
                  'maxlength' => 2,
                  'number'=>'true'
              ),
              'title' => array(
                  'required' => 1,
              ),
              'description' => array(
                  'required' => 1,
              ),
          ),
          'Messages' => array(
              'day' => array(
                  'required' => "Day field is required.",
                  'number' => 'Enter number only.'
              ),
              'title' => array(
                  'required' => "Title field is required.",
             ),
              'description' => array(
                  'required' => "Description field is required.",
              ),
          )
      );
      echo $this->Form->setValidation($arrValidation);
  ?>

    </tbody>
  </table>
</div>
<div class="modal-footer">
  <div class="form-group pull-right">
    <?php
      if(empty($edit)){
        echo $this->Form->submit(__('Save'), array('class' => 'btn btn-primary btn_dsbl','id' => 'add_itinerary', 'div' => false)); 
      }else{
        echo $this->Form->submit(__('Save'), array('class' => 'btn btn-primary', 'div' => false)); 
      } ?>
      <button type="button" id="close" class="btn btn-info" data-dismiss="modal">Close</button>
  </div>
</div>
<?php echo $this->Form->end(); ?>

       
    
     