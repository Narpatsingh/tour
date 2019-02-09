<?php
	$this->assign('pagetitle', __('Car Detail Detail').' <small>'.__('Car Details').'</small>');
	$this->Custom->addCrumb(__('Car Details'),array('action'=>'index'));
	$this->Custom->addCrumb(__('Car Detail Detail'));
	$this->start('top_links');
		echo $this->Html->link(__('Delete'), array('action' => 'delete', $carDetail['CarDetail']['id']), array('icon'=>'fa-trash-o','title' => __('Click here to delete this Car Detail'),'class'=>'btn btn-danger','escape'=>false),__('Are you sure? You want to delete this Car Detail?'));
		echo $this->Html->link(__('Edit'), array('action' => 'edit', $carDetail['CarDetail']['id']), array('icon'=>'fa-edit','title' => __('Click here to edit this Car Detail'),'class'=>'btn btn-primary','escape'=>false));
		echo $this->Html->link(__('Add Car Detail'),array('action'=>'add'),array('icon'=>'fa-plus','title' => 'Click here to add Car Detail','class'=>'btn btn-primary','escape'=>false));
		echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
	$this->end();
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="overflow-hide-break">
                <div class="box-body userViewPage">
                    		<div class='col-xs-12 col-sm-9 detailBox'>			<div class='row'>				<div class='col-md-12 col-sm-12 innerBox'>					<div class='dl-horizontal'>						<ul>							<li>								<span class='col-xs-12'>									<div class='row'>										Car Detail Detail									</div>								</span>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Id'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $carDetail['CarDetail']['id']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Customer Id'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $carDetail['CarDetail']['customer_id']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Company Name'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $carDetail['CarDetail']['company_name']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Car No'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $carDetail['CarDetail']['car_no']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Pnr No'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $carDetail['CarDetail']['pnr_no']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Price'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $carDetail['CarDetail']['price']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Source'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $carDetail['CarDetail']['source']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Destination'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $carDetail['CarDetail']['destination']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Created'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $carDetail['CarDetail']['created']; ?>							</li>						</ul>					</div>				</div>			</div>		</div>                </div>
            </div>
        </div>
    </div>
</div>