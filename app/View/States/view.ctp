<?php
	$this->assign('pagetitle', __('State Detail').' <small>'.__('States').'</small>');
	$this->Custom->addCrumb(__('States'),array('action'=>'index'));
	$this->Custom->addCrumb(__('State Detail'));
	$this->start('top_links');
		echo $this->Html->link(__('Add State'),array('action'=>'add'),array('icon'=>'fa-plus','title' => 'Click here to add state','class'=>'btn btn-primary','escape'=>false));
		echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
	$this->end();
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="overflow-hide-break">
                <div class="box-body userViewPage">
                    <div class="box box-primary col-md-9">
                        <div class="table-responsive-lg table-responsive-sm table-responsive-md table-responsive">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th><?php echo __('Name'); ?></th>
                                        <td><p> <?php echo $State['State']['name']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th> <?php echo __('Created'); ?></th>
                                        <td><p><?php echo $State['State']['created']; ?></p></t>
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