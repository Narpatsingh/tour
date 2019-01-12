<?php
	$this->assign('pagetitle', __('Enquiry Detail').' <small>'.__('Enquiries').'</small>');
	$this->Custom->addCrumb(__('Enquiries'),array('action'=>'index'));
	$this->Custom->addCrumb(__('Enquiry Detail'));
	$this->start('top_links');
		echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
	$this->end();
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="overflow-hide-break">
                <div class="box-body EnquiryViewPage">
                    <h3>Enquiry Details</h3><hr>
                    <?php if (empty($enquiries)) { ?>
                        <div class="col-md-12 col-sm-12">
                            <h5 style="color: chocolate;"> <?php echo __('No Enquiry found.') ?> </h5>
                        </div>
                    <?php } else { $enquiry=$enquiries;?>

                            <ul>
                                 <li><label>Customer Name</label> <b>:</b><?php echo $enquiry['Customer']['name']; ?></li>
                                 <li><label>Customer Email</label> <b>:</b><?php echo $enquiry['Customer']['email']; ?></li>
                                 <li><label>Customer Mobile</label> <b>:</b><?php echo $enquiry['Customer']['mobile']; ?></li>
                                 <li><label>Customer Address</label> <b>:</b><?php echo $enquiry['Customer']['address']; ?></li>
                                 <li><label>Customer DOB</label> <b>:</b><?php echo $enquiry['Customer']['dob']; ?></li>
                                 <li><label>Total Members</label> <b>:</b><?php echo $enquiry['Enquiry']['number_of_guest']; ?></li>
                                 <li><label>Customer Emergency Contact</label> <b>:</b><?php echo $enquiry['Customer']['emergency_mobile']; ?></li>
                                 <li><label>Customer Proof</label> <b>:</b><?php echo $enquiry['Customer']['dob_proof']; ?></li>
                                 <li><label>Number Of Month</label> <b>:</b><?php echo $enquiry['Enquiry']['number_of_month']; ?></li>
                                 <li><label>Customer Experience</label> <b>:</b><?php echo $enquiry['Enquiry']['experience']; ?></li>
                            </ul>
                    <?php 
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
                <div class="box-body EnquiryViewPage">
                    <h3>Package Details</h3><hr>
                    <div class="row">
                    <?php if (empty($package)) { ?>
                        <div class="col-md-12 col-sm-12">
                            <h5 style="color: chocolate;"> <?php echo __('No Package found.') ?> </h5>
                        </div>
                    <?php } else  { ?>

                            <ul>
                                 <li><label>Package Name</label> <b>:</b><?php echo $package['Tour']['name']; ?></li>
                                 <li><label>Package Type</label> <b>:</b><?php echo $package['Tour']['type']; ?></li>
                                 <li><label>Package City</label> <b>:</b><?php echo $package['City']['name']; ?></li>
                                 <li><label>Package State</label> <b>:</b><?php echo $package['State']['name']; ?></li>
                                 <li><label>Package Place</label> <b>:</b><?php echo $package['Tour']['place']; ?></li>
                                 <li><label>Package Cost</label> <b>:</b><?php echo $package['Tour']['price']; ?></li>
                                 <li><label>Package Discount</label> <b>:</b><?php echo empty($package['Tour']['discount'])?'N\A':$package['Tour']['discount']; ?></li>
                                 <li><label>Package Description</label> <b>:</b><?php echo $package['Tour']['description']; ?></li>
                                 <li><label>Total Days</label> <b>:</b><?php echo $package['Tour']['days']; ?></li>
                                 <li><label>Total Nights</label> <b>:</b><?php echo $package['Tour']['nights']; ?></li>
                            </ul>
                    <?php
                    } ?>   
                    </div>    
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
                    <h3>Highlight Details</h3><hr>
                    <?php if (empty($package['Highlight'])) { ?>
                        <div class="col-md-12 col-sm-12">
                            <h5 style="color: chocolate;"> <?php echo __('No Highlights found.') ?> </h5>
                        </div>
                    <?php } else { ?>
                        <?php foreach ($package['Highlight'] as $highlight) { ?>
                            <ul>
                                <li><?php echo $highlight['title']; ?></li>
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
                    <?php if (empty($package['Itinerary'])) { ?>
                        <div class="col-md-12 col-sm-12">
                            <h5 style="color: chocolate;"> <?php echo __('No Itinerary found.') ?> </h5>
                        </div>
                    <?php } else { ?>
                        <?php foreach ($package['Itinerary'] as $itinerary) { ?>
                        <div class="col-md-12 col-sm-12">
                            <div class="desc">
                                <h3>Day <?php echo $itinerary['day']; ?>
                                </h3>
                                <h4>Title : <?php echo $itinerary['title']."(".$itinerary['km']."kms / ".$itinerary['hour']."hrs)"; ?></h4>
                                <p style="padding-right: 60px;"><b>Description : </b><?php echo $itinerary['description']; ?></p>
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