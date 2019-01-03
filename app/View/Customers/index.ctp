<?php
	$this->assign('pagetitle', __('Customers'));
	$this->Custom->addCrumb(__('Customers'));
	$this->start('top_links');
		echo $this->Html->link(__('Add Customer'),array('action'=>'add'),array('icon'=>'fa-plus','title'=>__('Add Customer'),'class'=>'btn btn-primary','escape'=>false));
	$this->end();
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body row">
                <div class="col-md-12">
                    			<?php echo $this->Form->create('Customer', array('autocomplete' => 'off', 'novalidate' => 'novalidate'));
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
                    <th><?php echo $this->Paginator->sort('mobile'); ?></th>
                    <th><?php echo $this->Paginator->sort('address'); ?></th>
                    <th><?php echo $this->Paginator->sort('dob'); ?></th>
                    <th><?php echo $this->Paginator->sort('member'); ?></th>
                    <th><?php echo $this->Paginator->sort('emergency_mobile'); ?></th>
                    <th><?php echo $this->Paginator->sort('dob_proof'); ?></th>
                    <th><?php echo $this->Paginator->sort('created'); ?></th>
                    <th class="actions text-center"><?php echo __('Actions'); ?></th>
                </tr>			
            </thead>		
            <tbody>
                <?php if(empty($customers)){?>
								<tr>
					<td colspan='10' class='text-warning'><?php echo __('No Customer found.')?></td>
								</tr>
<?php }else{?>

<?php foreach ($customers as $customer): ?>
	<tr>
		<td><?php echo h($customer['Customer']['name']); ?>&nbsp;</td>
		<td><?php echo h($customer['Customer']['mobile']); ?>&nbsp;</td>
		<td><?php echo h($customer['Customer']['address']); ?>&nbsp;</td>
		<td><?php echo h($customer['Customer']['dob']); ?>&nbsp;</td>
		<td><?php echo h($customer['Customer']['member']); ?>&nbsp;</td>
		<td><?php echo h($customer['Customer']['emergency_mobile']); ?>&nbsp;</td>
		<td><?php echo h($customer['Customer']['dob_proof']); ?>&nbsp;</td>
		<td><?php echo h($customer['Customer']['created']); ?>&nbsp;</td>
		<td class="actions text-center">
			<?php echo $this->Html->link(__(''), array('action' => 'view', $customer['Customer']['id']), array('icon'=>'view','title' => __('Click here to view this Customer'))); ?>
			<?php echo $this->Html->link(__(''), array('action' => 'edit', $customer['Customer']['id']), array('icon'=>'edit','title' => __('Click here to edit this Customer'))); ?>
			<?php echo $this->Html->link(__(''), array('action' => 'delete', $customer['Customer']['id']), array('icon'=>'delete','title' => __('Click here to delete this Customer')), __('Are you sure you want to delete Customer?')); ?>
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