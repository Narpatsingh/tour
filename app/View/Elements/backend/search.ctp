<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body row">
                <div class="col-md-12">
					<?php echo $this->Form->create($model, array('autocomplete' => 'off', 'novalidate' => 'novalidate'));?>
					<?php 
					echo $this->Form->input('user', array('label' => __('User'),'empty'=>__("Select User"), 'required' => false, 'class' => 'form-control', 'div' => array('class' => 'col-md-3')));
					echo $this->Form->input('date', array('label' => __('Date'),'type'=>'text', 'required' => false, 'class' => 'form-control hascalendar', 'div' => array('class' => 'col-md-3')));
					?>
                    <label>&nbsp;</label>
                    <div class="col-md-6 form-group">
						<?php echo $this->Form->submit(__('Search'), array('class' => 'btn btn-primary margin-right10', 'div' => false));		echo $this->Html->link(__('Reset Search'), array('action' => 'index', 'all'), array('title' => __('reset search'), 'class' => 'btn btn-default')); ?>
                    </div>                    
					<?php echo $this->Form->end();?>
                </div>
            </div>
        </div>
    </div>
</div>