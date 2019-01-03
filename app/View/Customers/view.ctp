<?php
	$this->assign('pagetitle', __('Customer Detail').' <small>'.__('Customers').'</small>');
	$this->Custom->addCrumb(__('Customers'),array('action'=>'index'));
	$this->Custom->addCrumb(__('Customer Detail'));
	$this->start('top_links');
		echo $this->Html->link(__('Delete'), array('action' => 'delete', $customer['Customer']['id']), array('icon'=>'fa-trash-o','title' => __('Click here to delete this Customer'),'class'=>'btn btn-danger','escape'=>false),__('Are you sure? You want to delete this Customer?'));
		echo $this->Html->link(__('Edit'), array('action' => 'edit', $customer['Customer']['id']), array('icon'=>'fa-edit','title' => __('Click here to edit this Customer'),'class'=>'btn btn-primary','escape'=>false));
		echo $this->Html->link(__('Add Customer'),array('action'=>'add'),array('icon'=>'fa-plus','title' => 'Click here to add Customer','class'=>'btn btn-primary','escape'=>false));
		echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
	$this->end();
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="overflow-hide-break">
                <div class="box-body userViewPage">
                    		<div class='col-xs-12 col-sm-9 detailBox'>			<div class='row'>				<div class='col-md-12 col-sm-12 innerBox'>					<div class='dl-horizontal'>						<ul>							<li>								<span class='col-xs-12'>									<div class='row'>										Customer Detail									</div>								</span>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Id'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $customer['Customer']['id']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Name'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $customer['Customer']['name']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Mobile'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $customer['Customer']['mobile']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Address'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $customer['Customer']['address']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Dob'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $customer['Customer']['dob']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Member'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $customer['Customer']['member']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Emergency Mobile'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $customer['Customer']['emergency_mobile']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Dob Proof'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $customer['Customer']['dob_proof']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Created'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $customer['Customer']['created']; ?>							</li>						</ul>					</div>				</div>			</div>		</div>                </div>
            </div>
        </div>
    </div>
</div>