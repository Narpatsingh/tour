<?php
	$this->assign('pagetitle', __('Flight Detail Detail').' <small>'.__('Flight Details').'</small>');
	$this->Custom->addCrumb(__('Flight Details'),array('action'=>'index'));
	$this->Custom->addCrumb(__('Flight Detail Detail'));
	$this->start('top_links');
		echo $this->Html->link(__('Delete'), array('action' => 'delete', $flightDetail['FlightDetail']['id']), array('icon'=>'fa-trash-o','title' => __('Click here to delete this Flight Detail'),'class'=>'btn btn-danger','escape'=>false),__('Are you sure? You want to delete this Flight Detail?'));
		echo $this->Html->link(__('Edit'), array('action' => 'edit', $flightDetail['FlightDetail']['id']), array('icon'=>'fa-edit','title' => __('Click here to edit this Flight Detail'),'class'=>'btn btn-primary','escape'=>false));
		echo $this->Html->link(__('Add Flight Detail'),array('action'=>'add'),array('icon'=>'fa-plus','title' => 'Click here to add Flight Detail','class'=>'btn btn-primary','escape'=>false));
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
                                        <td><p><?php echo $flightDetail['FlightDetail']['company_name']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('Flight No'); ?></th>
                                        <td><p><?php echo $flightDetail['FlightDetail']['flight_no']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('Source'); ?></th>
                                        <td><p><?php echo $flightDetail['FlightDetail']['source']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('Destination'); ?></th>
                                        <td><p><?php echo $flightDetail['FlightDetail']['destination']; ?></p></td>
                                    </tr>
                                   	<tr>
                                        <th><?php echo __('Price'); ?></th>
                                        <td><p><?php echo $flightDetail['FlightDetail']['price']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('Pnr No'); ?></th>
                                        <td><p><?php echo $flightDetail['FlightDetail']['pnr_no']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th> <?php echo __('Created'); ?></th>
                                        <td><p><?php echo $flightDetail['FlightDetail']['created']; ?></p></t>
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