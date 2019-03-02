<?php
	$this->assign('pagetitle', __('Gst Parameters'));
	$this->Custom->addCrumb(__('Gst Parameters'));
	$this->start('top_links');
		echo $this->Html->link(__('Add Gst Parameter'),array('action'=>'add'),array('icon'=>'fa-plus','title'=>__('Add Gst Parameter'),'class'=>'btn btn-primary','escape'=>false));
	$this->end();
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body row">
                <div class="col-md-12">
                    			<?php echo $this->Form->create('GstParameter', array('autocomplete' => 'off', 'novalidate' => 'novalidate'));
			 echo $this->Form->input('name', array('label' => __('Name'), 'placeholder' => __('name'), 'required' => false, 'class' => 'form-control', 'div' => array('class' => 'col-md-3')));
?>

                    <label>&nbsp</label>
                    <div class="col-md-9 form-group">
                        		<?php echo $this->Form->submit(__('Search'), array('class' => 'btn btn-primary margin-right10', 'div' => false));		echo $this->Html->link(__('Reset Search'), array('action' => 'index', 'all'), array('title' => __('reset search'), 'class' => 'btn btn-default')); ?>
                    </div>
                    
	<?php echo $this->Form->end();?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="box box-primary">           
    <div class="box-footer clearfix">
        <?php echo $this->element('paginationtop'); ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                                                                                                                                                                <th><?php echo $this->Paginator->sort('name'); ?></th>
                                                                                                                        <th><?php echo $this->Paginator->sort('value'); ?></th>
                                                                                                                        <th><?php echo $this->Paginator->sort('created'); ?></th>
                                                                                                                        <th><?php echo $this->Paginator->sort('updated'); ?></th>
                                                                                        <th class="actions text-center"><?php echo __('Actions'); ?></th>
                </tr>			
            </thead>		
            <tbody>
                <?php if(empty($gstParameters)){?>
								<tr>
					<td colspan='6' class='text-warning'><?php echo __('No Gst Parameter found.')?></td>
								</tr>
<?php }else{?>

<?php foreach ($gstParameters as $gstParameter): ?>
	<tr>
		<td><?php echo h($gstParameter['GstParameter']['name']); ?>&nbsp;</td>
		<td><?php echo h($gstParameter['GstParameter']['value']); ?>&nbsp;</td>
		<td><?php echo h($gstParameter['GstParameter']['created']); ?>&nbsp;</td>
		<td><?php echo h($gstParameter['GstParameter']['updated']); ?>&nbsp;</td>
		<td class="actions text-center">
			<?php //echo $this->Html->link(__(''), array('action' => 'view', $gstParameter['GstParameter']['id']), array('icon'=>'view','title' => __('Click here to view this Gst Parameter'))); ?>
			<?php echo $this->Html->link(__(''), array('action' => 'edit', $gstParameter['GstParameter']['id']), array('icon'=>'edit','title' => __('Click here to edit this Gst Parameter'))); ?>
			<?php //echo $this->Html->link(__(''), array('action' => 'delete', $gstParameter['GstParameter']['id']), array('icon'=>'delete','title' => __('Click here to delete this Gst Parameter')), __('Are you sure you want to delete Gst Parameter?')); ?>
		</td>
	</tr>
<?php endforeach; ?>
<?php }?>			
            </tbody>
        </table>
    </div>
    <div class="box-footer clearfix">
        <?php echo $this->element('pagination'); ?>
    </div>
</div>