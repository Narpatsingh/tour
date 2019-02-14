<?php echo $this->Html->script(
                array(
            'jquery',
            'bootstrap.min',
            // 'lib/jquery-ui-1.11.4',
            'lib/jquery.validate',
            'jquery.easing.min',
            'wow',
            'jquery.mixitup.min',
            'jquery.fancybox.pack',
            'waypoints.min',
            'jquery.counterup.min',
            'owl.carousel.min',
            'jquery.stellar.min',
            'bootstrap-datepicker',
            'script',
            'scrolling-nav',
            'bootstrap-slider',
            'jquery.slimscroll',
            'custom.js?'.time(),
                ), array('inline' => false)
        );

        echo $this->fetch('script');    

    ?>    
    <div class="Enquiry">
        <div class="EnquiryClick ">
            <button class="EnquiryBtn"><i class="fa fa-pencil mr-2" ></i> Enquiry</button>
        </div>
    </div>

   <div class="modal fade commonModel" id="commonModel" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <button type="button" class="close" data-dismiss="modal" style="padding: 10px;">&times;</button>
            <div class="modal-header Enquiry_header">
              <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
              <h4 class="modal-title">Quick Enquiry</h4>
              <h5 class="modal-title">Can't find what you are looking for? Send us an enquiry and we will get in touch with you in 1 day.</h5>
            </div>
            <div class="modal-body bg-white audit-scroll">
                    <?php echo $this->Form->create('Enquiry',array('controller'=>'enquiries','action'=>'add')); ?>

                            <div class="holiday_Guest mt-3 mb-3 px-3 py-3">
                                <input type="text" data-role="none" name="date"  id="travel_date" placeholder="Date" class="mr-3 mb-3">
                                <input type="text" data-role="none" name="number_of_guest" placeholder="Number of guest " class="mb-3">
                                <input type="text" data-role="none" name="travel_duration" placeholder="Travel Duration" class="mr-3 mb-3">
                                <input type="text" data-role="none" name="time_of_travel" id="time_of_travel" placeholder="Time Of Travel" class="mb-3">
                                <?php echo $this->Form->input('city_id',array('label' => false,'data-role'=>"none",'class' => 'mr-3 mb-3','style'=>'width: 100%;','empty' => __('Select City'), 'div' => false)); ?>
                                <?php echo $this->Form->input('package_id',array('label' => false,'data-role'=>"none",'class' => 'mr-3 mb-3','style'=>'width: 100%;','empty' => __('Select Package'), 'div' => false)); ?>
                                <textarea data-role="none" name="special_requirements" class=" textarea mt-3" placeholder="Special Requirements"></textarea>
                            </div>
                            <div class="contact_detail mt-3 mb-3 px-3 py-3">
                                <p class="font-bold">Your Contact Detail</p>
                                <input type="text" data-role="none" name="firstname" placeholder="First Name" class="mr-3 mb-3" required>
                                <input type="text" data-role="none" name="lastname" placeholder="Last name" class="mb-3" required>
                                <input type="number" data-role="none" name="mobile" placeholder="Mobile Number" class="mr-3 mb-3" required>
                                <input type="email" data-role="none" name="email" placeholder="Email" class=" mb-3" required>
                            </div>  
                
             </div>     
             <div class="modal-footer bg-white">
                 <div class="send_enquiry">
                    <?php echo $this->Form->submit(__('Send Enuiry'), array('class' => 'btn btn-primary btn-sm', 'div' => false)); ?>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>                
             </div>       
                <?php echo $this->Form->end(); ?> 
        </div>
    </div>

    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-5">
                    <div class="text-left">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-7">
                    <div>
                        <p>&copy; Copyright <?php echo date('Y'); ?>. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

<script type="text/javascript">
       $("#time_of_travel").datepicker( {
        format: "MM-yyyy",
        viewMode: "months", 
        minViewMode: "months"
        });

       $("#travel_date").datepicker( {
            format: "dd-MM-yyyy",
        });

        jQuery('.EnquiryBtn').on('click', function (e) {
                $('#commonModel').modal('show');
        });
        
    // $(document).ready(function(){
    //     $('#EnquiryAddForm').validate({ 
    //         rules: {
    //             'firstname': {
    //                 required: true,
    //             },
    //             'lastname': {
    //                 required: true,
    //             },
    //             'mobile': {
    //                 required: true,
    //                 number: true
    //             },
    //             'email': {
    //                 required: true,
    //                 email: true,
    //             },
    //         },
    //         messages: {
    //             'firstname': {
    //                 required: "Please enter first name.",
    //             },
    //             'lastname': {
    //                 required: "Please enter last name.",
    //             },
    //             'email': {
    //                 required: "Please enter email.",
    //                 email: "Please enter valid email.",
    //             },
    //             'mobile': {
    //                 required: "Please enter mobile number.",
    //             },
    //         },
    //         submitHandler: function(form) {
    //             form.submit();
    //         }
    //     });     
    // });         
   
    
</script>  
<style type="text/css">
    /*div.error{
        margin-right: 15px;
        float:left;
        position: relative;
        min-height: 1px;
        padding-right: 15px;
        padding-left: 15px;
    }*/
</style>    

</body>
</html>
