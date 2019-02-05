<?php
	$this->assign('pagetitle', __('Bus Detail Detail').' <small>'.__('Bus Details').'</small>');
	$this->Custom->addCrumb(__('Bus Details'),array('action'=>'index'));
	$this->Custom->addCrumb(__('Bus Detail Detail'));
	$this->start('top_links');
		echo $this->Html->link(__('Delete'), array('action' => 'delete', $busDetail['BusDetail']['id']), array('icon'=>'fa-trash-o','title' => __('Click here to delete this Bus Detail'),'class'=>'btn btn-danger','escape'=>false),__('Are you sure? You want to delete this Bus Detail?'));
		echo $this->Html->link(__('Edit'), array('action' => 'edit', $busDetail['BusDetail']['id']), array('icon'=>'fa-edit','title' => __('Click here to edit this Bus Detail'),'class'=>'btn btn-primary','escape'=>false));
		echo $this->Html->link(__('Add Bus Detail'),array('action'=>'add'),array('icon'=>'fa-plus','title' => 'Click here to add Bus Detail','class'=>'btn btn-primary','escape'=>false));
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
                                        <th><?php echo __('Company Name'); ?></th>
                                        <td><p><?php echo $busDetail['BusDetail']['company_name']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('Bus No'); ?></th>
                                        <td><p><?php echo $busDetail['BusDetail']['bus_no']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('Source'); ?></th>
                                        <td><p><?php echo $busDetail['BusDetail']['source']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('Destination'); ?></th>
                                        <td><p><?php echo $busDetail['BusDetail']['destination']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('City Name'); ?></th>
                                        <td><p><?php echo $busDetail['BusDetail']['city_name']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('Price'); ?></th>
                                        <td><p><?php echo $busDetail['BusDetail']['price']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('Pnr No'); ?></th>
                                        <td><p><?php echo $busDetail['BusDetail']['pnr_no']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th> <?php echo __('Created'); ?></th>
                                        <td><p><?php echo $busDetail['BusDetail']['created']; ?></p></t>
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