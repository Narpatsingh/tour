<?php
	$this->assign('pagetitle', __('City Detail').' <small>'.__('Citys').'</small>');
	$this->Custom->addCrumb(__('Citys'),array('action'=>'index'));
	$this->Custom->addCrumb(__('City Detail'));
	$this->start('top_links');
		echo $this->Html->link(__('Add City'),array('action'=>'add'),array('icon'=>'fa-plus','title' => 'Click here to add City','class'=>'btn btn-primary','escape'=>false));
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
                                        <th><?php echo __('City Name'); ?></th>
                                        <td><p> <?php echo $City['City']['name']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('State Name'); ?></th>
                                        <td><p> <?php echo $City['State']['name']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th> <?php echo __('Created'); ?></th>
                                        <td><p><?php echo $City['City']['created']; ?></p></t>
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