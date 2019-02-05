<?php
	$this->assign('pagetitle', __('Train Detail Detail').' <small>'.__('Train Details').'</small>');
	$this->Custom->addCrumb(__('Train Details'),array('action'=>'index'));
	$this->Custom->addCrumb(__('Train Detail Detail'));
	$this->start('top_links');
		echo $this->Html->link(__('Delete'), array('action' => 'delete', $trainDetail['TrainDetail']['id']), array('icon'=>'fa-trash-o','title' => __('Click here to delete this Train Detail'),'class'=>'btn btn-danger','escape'=>false),__('Are you sure? You want to delete this Train Detail?'));
		echo $this->Html->link(__('Edit'), array('action' => 'edit', $trainDetail['TrainDetail']['id']), array('icon'=>'fa-edit','title' => __('Click here to edit this Train Detail'),'class'=>'btn btn-primary','escape'=>false));
		echo $this->Html->link(__('Add Train Detail'),array('action'=>'add'),array('icon'=>'fa-plus','title' => 'Click here to add Train Detail','class'=>'btn btn-primary','escape'=>false));
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
                                        <th><?php echo __('Train No'); ?></th>
                                        <td><p><?php echo $trainDetail['TrainDetail']['train_no']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('Source'); ?></th>
                                        <td><p><?php echo $trainDetail['TrainDetail']['source']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('Destination'); ?></th>
                                        <td><p><?php echo $trainDetail['TrainDetail']['destination']; ?></p></td>
                                    </tr>
                                    <!-- <tr>
                                        <th><?php echo __('Price'); ?></th>
                                        <td><p><?php echo $trainDetail['TrainDetail']['price']; ?></p></td>
                                    </tr> -->
                                    <tr>
                                        <th><?php echo __('Pnr No'); ?></th>
                                        <td><p><?php echo $trainDetail['TrainDetail']['pnr_no']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th> <?php echo __('Created'); ?></th>
                                        <td><p><?php echo $trainDetail['TrainDetail']['created']; ?></p></t>
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