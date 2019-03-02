<?php
	$this->assign('pagetitle', __('Gst Parameter Detail').' <small>'.__('Gst Parameters').'</small>');
	$this->Custom->addCrumb(__('Gst Parameters'),array('action'=>'index'));
	$this->Custom->addCrumb(__('Gst Parameter Detail'));
	$this->start('top_links');
		echo $this->Html->link(__('Delete'), array('action' => 'delete', $gstParameter['GstParameter']['id']), array('icon'=>'fa-trash-o','title' => __('Click here to delete this Gst Parameter'),'class'=>'btn btn-danger','escape'=>false),__('Are you sure? You want to delete this Gst Parameter?'));
		echo $this->Html->link(__('Edit'), array('action' => 'edit', $gstParameter['GstParameter']['id']), array('icon'=>'fa-edit','title' => __('Click here to edit this Gst Parameter'),'class'=>'btn btn-primary','escape'=>false));
		echo $this->Html->link(__('Add Gst Parameter'),array('action'=>'add'),array('icon'=>'fa-plus','title' => 'Click here to add Gst Parameter','class'=>'btn btn-primary','escape'=>false));
		echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
	$this->end();
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="overflow-hide-break">
                <div class="box-body userViewPage">
                    		<div class='col-xs-12 col-sm-9 detailBox'>			<div class='row'>				<div class='col-md-12 col-sm-12 innerBox'>					<div class='dl-horizontal'>						<ul>							<li>								<span class='col-xs-12'>									<div class='row'>										Gst Parameter Detail									</div>								</span>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Id'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $gstParameter['GstParameter']['id']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Name'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $gstParameter['GstParameter']['name']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Value'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $gstParameter['GstParameter']['value']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Created'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $gstParameter['GstParameter']['created']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Updated'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $gstParameter['GstParameter']['updated']; ?>							</li>						</ul>					</div>				</div>			</div>		</div>                </div>
            </div>
        </div>
    </div>
</div>