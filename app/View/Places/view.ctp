<?php
	$this->assign('pagetitle', __('Place Detail').' <small>'.__('Places').'</small>');
	$this->Custom->addCrumb(__('Places'),array('action'=>'index'));
	$this->Custom->addCrumb(__('Place Detail'));
	$this->start('top_links');
		echo $this->Html->link(__('Delete'), array('action' => 'delete', $place['Place']['id']), array('icon'=>'fa-trash-o','title' => __('Click here to delete this Place'),'class'=>'btn btn-danger','escape'=>false),__('Are you sure? You want to delete this Place?'));
		echo $this->Html->link(__('Edit'), array('action' => 'edit', $place['Place']['id']), array('icon'=>'fa-edit','title' => __('Click here to edit this Place'),'class'=>'btn btn-primary','escape'=>false));
		echo $this->Html->link(__('Add Place'),array('action'=>'add'),array('icon'=>'fa-plus','title' => 'Click here to add Place','class'=>'btn btn-primary','escape'=>false));
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
                                        <td><p><?php echo $place['Place']['name']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('City'); ?></th>
                                        <td><p><?php echo $place['City']['name']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('State'); ?></th>
                                        <td><p><?php echo $place['State']['name']; ?></p></td>
                                    </tr>
                                	<tr>
                                        <th> <?php echo __('Created'); ?></th>
                                        <td><p><?php echo $place['Place']['created']; ?></p></t>
                                    </tr>
                                    <tr>
                                        <th> <?php echo __('Created'); ?></th>
                                        <td><p><?php echo $place['Place']['created']; ?></p></t>
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