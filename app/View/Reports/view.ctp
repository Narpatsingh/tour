<?php
	$this->assign('pagetitle', __('Report Detail').' <small>'.__('Reports').'</small>');
	$this->Custom->addCrumb(__('Reports'),array('action'=>'index'));
	$this->Custom->addCrumb(__('Report Detail'));
	$this->start('top_links');
		echo $this->Html->link(__('Delete'), array('action' => 'delete', $report['Report']['id']), array('icon'=>'fa-trash-o','title' => __('Click here to delete this Report'),'class'=>'btn btn-danger','escape'=>false),__('Are you sure? You want to delete this Report?'));
		echo $this->Html->link(__('Edit'), array('action' => 'edit', $report['Report']['id']), array('icon'=>'fa-edit','title' => __('Click here to edit this Report'),'class'=>'btn btn-primary','escape'=>false));
		echo $this->Html->link(__('Add Report'),array('action'=>'add'),array('icon'=>'fa-plus','title' => 'Click here to add Report','class'=>'btn btn-primary','escape'=>false));
		echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
	$this->end();
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="overflow-hide-break">
                <div class="box-body userViewPage">
                    		<div class='col-xs-12 col-sm-9 detailBox'>			<div class='row'>				<div class='col-md-12 col-sm-12 innerBox'>					<div class='dl-horizontal'>						<ul>							<li>								<span class='col-xs-12'>									<div class='row'>										Report Detail									</div>								</span>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Id'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $report['Report']['id']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('User Id'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $report['Report']['user_id']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Name'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $report['Report']['name']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Created'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $report['Report']['created']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Updated'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $report['Report']['updated']; ?>							</li>						</ul>					</div>				</div>			</div>		</div>                </div>
            </div>
        </div>
    </div>
</div>