<?php
	$this->assign('pagetitle', __('Account Detail').' <small>'.__('Accounts').'</small>');
	$this->Custom->addCrumb(__('Accounts'),array('action'=>'index'));
	$this->Custom->addCrumb(__('Account Detail'));
	$this->start('top_links');
		echo $this->Html->link(__('Delete'), array('action' => 'delete', $account['Account']['id']), array('icon'=>'fa-trash-o','title' => __('Click here to delete this Account'),'class'=>'btn btn-danger','escape'=>false),__('Are you sure? You want to delete this Account?'));
		echo $this->Html->link(__('Edit'), array('action' => 'edit', $account['Account']['id']), array('icon'=>'fa-edit','title' => __('Click here to edit this Account'),'class'=>'btn btn-primary','escape'=>false));
		echo $this->Html->link(__('Add Account'),array('action'=>'add'),array('icon'=>'fa-plus','title' => 'Click here to add Account','class'=>'btn btn-primary','escape'=>false));
		echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
	$this->end();
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="overflow-hide-break">
                <div class="box-body userViewPage">
                    		<div class='col-xs-12 col-sm-9 detailBox'>			<div class='row'>				<div class='col-md-12 col-sm-12 innerBox'>					<div class='dl-horizontal'>						<ul>							<li>								<span class='col-xs-12'>									<div class='row'>										Account Detail									</div>								</span>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Id'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $account['Account']['id']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Voucher'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $this->Html->link($account['Voucher']['id'], array('controller' => 'vouchers', 'action' => 'view', $account['Voucher']['id'])); ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Payment Amount'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $account['Account']['payment_amount']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Total Payment With Gst'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $account['Account']['total_payment_with_gst']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Payment Recieved'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $account['Account']['payment_recieved']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Payment Receivable'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $account['Account']['payment_receivable']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Created'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $account['Account']['created']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Updated'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $account['Account']['updated']; ?>							</li>						</ul>					</div>				</div>			</div>		</div>                </div>
            </div>
        </div>
    </div>
</div>