<?php
	$this->assign('pagetitle', __('Tour Detail').' <small>'.__('Tours').'</small>');
	$this->Custom->addCrumb(__('Tours'),array('action'=>'index'));
	$this->Custom->addCrumb(__('Tour Detail'));
	$this->start('top_links');
		echo $this->Html->link(__('Add Itinerary'),array('controller'=>'Itineraries','action'=>'addItenraryPopup',$tour['Tour']['id']),array('icon'=>'fa-plus','title' => 'Click here to add Iteration','class'=>'btn btn-primary Itinerary','escape'=>false));
		echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
	$this->end();
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="overflow-hide-break">
                <div class="box-body userViewPage">
                    <h3>Highlight Details</h3><hr>
                    <?php if (empty($Highlight_data)) { ?>
                        <div class="col-md-12 col-sm-12">
                            <h5 style="color: chocolate;"> <?php echo __('No Highlights found.') ?> </h5>
                        </div>
                    <?php } else { ?>
                        <?php foreach ($Highlight_data as $highlight) { ?>
                            <ul>
                                <li><?php echo $highlight['Highlight']['title']; ?></li>
                            </ul>
                    <?php }
                    } ?>     
                </div>
            </div>
        </div>
    </div>
</div>                     
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="overflow-hide-break">
                <div class="box-body userViewPage">
                    <h3>Itinerary Details</h3><hr>
                    <div class="row">
                    <?php if (empty($Itinerary_datas)) { ?>
                        <div class="col-md-12 col-sm-12">
                            <h5 style="color: chocolate;"> <?php echo __('No Itinerary found.') ?> </h5>
                        </div>
                    <?php } else { ?>
                        <?php foreach ($Itinerary_datas as $itinerary) { ?>
                        <div class="col-md-12 col-sm-12">
                            <div class="desc">
                                <h3>Day <?php echo $itinerary['Itinerary']['day'];
                                    
                                    echo $this->Html->link(__(''), array('controller'=>'Itineraries','action' => 'delete', $itinerary['Itinerary']['id']),
                                        array(
                                            'icon' => 'delete',
                                            'class' => 'no-hover-text-decoration pull-right',
                                            'style' => 'color: #d43f3a;',
                                            'title' => __('Delete Itinerary')
                                        ), __('Are you sure you want to delete selected Itinerary?'));
                                    echo $this->Html->link(__(''), array('controller'=>'Itineraries','action'=>'addItenraryPopup',$tour['Tour']['id'],$itinerary['Itinerary']['id']),
                                        array(
                                            'icon' => 'edit',
                                            'style' => 'color: #222d32;',
                                            'class' => 'Itinerary no-hover-text-decoration pull-right',
                                            'title' => __('Edit Itinerary')
                                        ));
                                    ?>
                                </h3>
                                <h4>Title : <?php echo $itinerary['Itinerary']['title']."(".$itinerary['Itinerary']['km']."kms / ".$itinerary['Itinerary']['hour']."hrs)"; ?></h4>
                                <p style="padding-right: 60px;"><b>Description : </b><?php echo $itinerary['Itinerary']['description']; ?></p>
                            </div>
                        </div>
                    <?php }
                    } ?>   
                    </div>    
                </div>    
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
        jQuery('.Itinerary').on('click', function (e) {
          e.preventDefault();
          var title = $(this).data('reqtitle');
          var Url = $(this).attr("href");
              jQuery.ajax({
                  url: Url,
                  type: 'post',
                  success: function (response) {
                      jQuery('#appendModelContent').html('');
                      jQuery('#appendModelContent').append(response);
                      $('#commonModel').modal('show');
                  },
                  error: function (e) {
                  }
              });
          });
</script>  
