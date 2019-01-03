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
                    		<div class='col-xs-12 col-sm-9 detailBox'>			<div class='row'>				<div class='col-md-12 col-sm-12 innerBox'>					<div class='dl-horizontal'>						<ul>							<li>								<span class='col-xs-12'>									<div class='row'>										Train Detail Detail									</div>								</span>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Id'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $trainDetail['TrainDetail']['id']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Customer Id'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $trainDetail['TrainDetail']['customer_id']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Train No'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $trainDetail['TrainDetail']['train_no']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Pnr No'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $trainDetail['TrainDetail']['pnr_no']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Created'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $trainDetail['TrainDetail']['created']; ?>							</li>						</ul>					</div>				</div>			</div>		</div>                </div>
            </div>
        </div>
    </div>
</div>