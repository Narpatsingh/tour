<?php
	$this->assign('pagetitle', __('Hotel Detail').' <small>'.__('Hotels').'</small>');
	$this->Custom->addCrumb(__('Hotels'),array('action'=>'index'));
	$this->Custom->addCrumb(__('Hotel Detail'));
	$this->start('top_links');
		echo $this->Html->link(__('Delete'), array('action' => 'delete', $hotel['Hotel']['id']), array('icon'=>'fa-trash-o','title' => __('Click here to delete this Hotel'),'class'=>'btn btn-danger','escape'=>false),__('Are you sure? You want to delete this Hotel?'));
		echo $this->Html->link(__('Edit'), array('action' => 'edit', $hotel['Hotel']['id']), array('icon'=>'fa-edit','title' => __('Click here to edit this Hotel'),'class'=>'btn btn-primary','escape'=>false));
		echo $this->Html->link(__('Add Hotel'),array('action'=>'add'),array('icon'=>'fa-plus','title' => 'Click here to add Hotel','class'=>'btn btn-primary','escape'=>false));
		echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
	$this->end();
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="overflow-hide-break">
                <div class="box-body userViewPage">
                    <div class="col-md-9">
                        <div class="table-responsive-lg table-responsive-sm table-responsive-md table-responsive">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th><?php echo __('Name'); ?></th>
                                        <td><p><?php echo $hotel['Hotel']['name']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('Price'); ?></th>
                                        <td><p><?php echo $hotel['Hotel']['price']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('Address'); ?></th>
                                        <td><p><?php echo $hotel['Hotel']['address']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('Type'); ?></th>
                                        <td><p><?php echo $hotel['Hotel']['type']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('Meal Plan'); ?></th>
                                        <td><p><?php echo $hotel['Hotel']['meal_plan']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th> <?php echo __('Created'); ?></th>
                                        <td><p><?php echo $hotel['Hotel']['created']; ?></p></t>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>