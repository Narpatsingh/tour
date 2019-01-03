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
                    		<div class='col-xs-12 col-sm-9 detailBox'>			<div class='row'>				<div class='col-md-12 col-sm-12 innerBox'>					<div class='dl-horizontal'>						<ul>							<li>								<span class='col-xs-12'>									<div class='row'>										Flight Detail Detail									</div>								</span>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Id'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $flightDetail['FlightDetail']['id']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Company Name'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $flightDetail['FlightDetail']['company_name']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Flight No'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $flightDetail['FlightDetail']['flight_no']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Pnr No'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $flightDetail['FlightDetail']['pnr_no']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Price'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $flightDetail['FlightDetail']['price']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Created'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $flightDetail['FlightDetail']['created']; ?>							</li>						</ul>					</div>				</div>			</div>		</div>                </div>
            </div>
        </div>
    </div>
</div>