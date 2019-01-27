<?php
$this->assign('pagetitle', __('Slider Detail').' <small>'.__('Sliders').'</small>');
$this->Custom->addCrumb(__('Sliders'),array('action'=>'index'));
$this->Custom->addCrumb(__('Slider Detail'));
$this->start('top_links');
echo $this->Html->link(__('Edit'), array('action' => 'edit', $slider['Slider']['id']), array('icon'=>'fa-edit','title' => __('Click here to edit this Slider'),'class'=>'btn btn-primary','escape'=>false));
echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
$this->end();
?>

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<div class="overflow-hide-break">
				<div class="box-body userViewPage">
					<div class='col-xs-12 col-sm-9 detailBox'>
						<div class='row'>
							<div class='col-md-12 col-sm-12 innerBox'>
								<div class='dl-horizontal'>
									<ul>
										<li>
											<span class='col-xs-12'>
												<div class='row'>Slider Detail</div>
											</span>
										</li>
									</ul>
									<ul>
										<li class='innreicons'>	<?php echo __('Package'); ?><i class='fa fa-hand-o-right'>								</i>							</li>
										<li><?php echo $slider['Tour']['name']; ?></li>
									</ul>
									<ul>
										<li class='innreicons'><?php echo __('Title'); ?><i class='fa fa-hand-o-right'>								</i>							</li>
										<li><?php echo $slider['Slider']['title']; ?></li>
									</ul>
									<ul>
										<li class='innreicons'><?php echo __('Created'); ?><i class='fa fa-hand-o-right'>								</i>							</li>
										<li><?php echo $slider['Slider']['created']; ?></li>
									</ul>
									<ul>
										<li class='innreicons'><?php echo __('Updated'); ?><i class='fa fa-hand-o-right'>								</i>							</li>
										<li><?php echo $slider['Slider']['updated']; ?></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>