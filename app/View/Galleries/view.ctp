<?php
	$this->assign('pagetitle', __('Gallery Detail').' <small>'.__('Galleries').'</small>');
	$this->Custom->addCrumb(__('Galleries'),array('action'=>'index'));
	$this->Custom->addCrumb(__('Gallery Detail'));
	$this->start('top_links');
		echo $this->Html->link(__('Delete'), array('action' => 'delete', $gallery['Gallery']['id']), array('icon'=>'fa-trash-o','title' => __('Click here to delete this Gallery'),'class'=>'btn btn-danger','escape'=>false),__('Are you sure? You want to delete this Gallery?'));
		echo $this->Html->link(__('Edit'), array('action' => 'edit', $gallery['Gallery']['id']), array('icon'=>'fa-edit','title' => __('Click here to edit this Gallery'),'class'=>'btn btn-primary','escape'=>false));
		echo $this->Html->link(__('Add Gallery'),array('action'=>'add'),array('icon'=>'fa-plus','title' => 'Click here to add Gallery','class'=>'btn btn-primary','escape'=>false));
		echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
	$this->end();
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="overflow-hide-break">
                <div class="box-body userViewPage">
                    		<div class='col-xs-12 col-sm-3'>			 <?php echo $this->Html->image(getUserPhoto($gallery['Gallery']['id'],$gallery['Gallery']['photo'],false,false), array('class' => 'thumbnail img-responsive'))?>		</div>		<div class='col-xs-12 col-sm-9 detailBox'>			<div class='row'>				<div class='col-md-12 col-sm-12 innerBox'>					<div class='dl-horizontal'>						<ul>							<li>								<span class='col-xs-12'>									<div class='row'>										Gallery Detail									</div>								</span>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Id'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $gallery['Gallery']['id']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Title'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $gallery['Gallery']['title']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Description'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $gallery['Gallery']['description']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Created'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $gallery['Gallery']['created']; ?>							</li>						</ul>						<ul>							<li class='innreicons'>								<?php //echo __('Updated'); ?><i class='fa fa-hand-o-right'>								</i>							</li><li>								<?php echo $gallery['Gallery']['updated']; ?>							</li>						</ul>					</div>				</div>			</div>		</div>                </div>
            </div>
        </div>
    </div>
</div>