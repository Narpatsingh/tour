<?php
	$this->assign('pagetitle', __('Contact Detail').' <small>'.__('Contacts').'</small>');
	$this->Custom->addCrumb(__('Contacts'),array('action'=>'index'));
	$this->Custom->addCrumb(__('Contact Detail'));
	$this->start('top_links');
	echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
	$this->end();
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="overflow-hide-break">
                <div class="box-body userViewPage">
                	<div class='col-xs-12 col-sm-9 detailBox'>			<div class='row'>				<div class='col-md-12 col-sm-12 innerBox'>					<div class='dl-horizontal'>						<ul>							<li>								<span class='col-xs-12'>									<div class='row'>										Contact Detail									</div>								</span>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Id'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $contact['Contact']['id']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Name'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $contact['Contact']['name']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Email'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $contact['Contact']['email']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Message'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $contact['Contact']['message']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Created'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $contact['Contact']['created']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Updated'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $contact['Contact']['updated']; ?>							</li>						</ul>					</div>				</div>			</div>		</div>                </div>
            </div>
        </div>
    </div>
</div>