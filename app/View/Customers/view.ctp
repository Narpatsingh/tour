<?php
	$this->assign('pagetitle', __('Customer Detail').' <small>'.__('Customers').'</small>');
	$this->Custom->addCrumb(__('Customers'),array('action'=>'index'));
	$this->Custom->addCrumb(__('Customer Detail'));
	$this->start('top_links');
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
                                        <td><p><?php echo $customer['Customer']['name']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('Mobile'); ?></th>
                                        <td><p><?php echo $customer['Customer']['mobile']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('Address'); ?></th>
                                        <td><p><?php echo $customer['Customer']['address']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('Dob'); ?></th>
                                        <td><p><?php echo $customer['Customer']['dob']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('Member'); ?></th>
                                        <td><p><?php echo $customer['Customer']['member']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('Emergency Mobile'); ?></th>
                                        <td><p><?php echo $customer['Customer']['emergency_mobile']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th> <?php echo __('Created'); ?></th>
                                        <td><p><?php echo $customer['Customer']['created']; ?></p></t>
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