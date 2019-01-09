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
                    		<div class='col-xs-12 col-sm-3'>			 <?php echo $this->Html->image(getUserPhoto($hotel['Hotel']['id'],$hotel['Hotel']['photo'],false,false), array('class' => 'thumbnail img-responsive'))?>		</div>		<div class='col-xs-12 col-sm-9 detailBox'>			<div class='row'>				<div class='col-md-12 col-sm-12 innerBox'>					<div class='dl-horizontal'>						<ul>							<li>								<span class='col-xs-12'>									<div class='row'>										Hotel Detail									</div>								</span>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Id'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $hotel['Hotel']['id']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Name'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $hotel['Hotel']['name']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Price'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $hotel['Hotel']['price']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Address'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $hotel['Hotel']['address']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Type'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $hotel['Hotel']['type']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Meal Plan'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $hotel['Hotel']['meal_plan']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Created'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $hotel['Hotel']['created']; ?>							</li>						</ul>					</div>				</div>			</div>		</div>                </div>
            </div>
        </div>
    </div>
</div>