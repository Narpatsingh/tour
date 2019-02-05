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
                    <div class="col-md-9">
                        <div class="table-responsive-lg table-responsive-sm table-responsive-md table-responsive">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th><?php echo __('Package'); ?></th>
                                        <td><p><?php echo $slider['Tour']['name']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('Title'); ?></th>
                                        <td><p><?php echo $slider['Slider']['title']; ?></p></td>
                                    </tr>
                                    <tr>
                                        <th> <?php echo __('Created'); ?></th>
                                        <td><p><?php echo $slider['Slider']['created']; ?></p></t>
                                    </tr>
                                    <tr>
                                        <th> <?php echo __('Updated'); ?></th>
                                        <td><p><?php echo $slider['Slider']['updated']; ?></p></t>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>