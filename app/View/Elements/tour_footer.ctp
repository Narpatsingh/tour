    <div class="Enquiry">
        <div class="EnquiryClick ">
            <button class="EnquiryBtn"><i class="fa fa-pencil mr-2" ></i> Enquiry</button>
        </div>
    </div>

   <div class="modal fade commonModel" id="commonModel" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-header Enquiry_header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Quick Enquiry</h4>
            </div>
            <div class="modal-body bg-white">
                    <?php echo $this->Form->create('Enquiry',array('controller'=>'enquiries','action'=>'add')); ?>

                            <div class="holiday_Guest mt-3 mb-3 px-3 py-3">
                                <input type="text" name="number_of_month" placeholder="Holidays Month" class="mr-3 mb-3" required>
                                <input type="text" name="number_of_guest" placeholder="Number of guest " class="mb-3" required>
                                <input type="text" name="time_of_travel" id="time_of_travel" placeholder="Time Of Travel" class="mr-3 mb-3" required>
                                <input type="text" name="travel_duration" placeholder="Travel Duration" class="mr-3 mb-3" required>
                                <?php echo $this->Form->input('city_id',array('label' => false, 'class' => 'mr-3 mb-3','empty' => __('Select City'), 'div' => false)); ?>
                                <input type="text" name="destination" placeholder="Destination" class="mr-3 mb-3" required>
                                <textarea name="experience" class=" textarea mt-3" placeholder="Additional Experiences" required></textarea>
                                <textarea name="special_requirements" class=" textarea mt-3" placeholder="Special Requirements" required></textarea>
                            </div>
                            <div class="contact_detail mt-3 mb-3 px-3 py-3">
                                <p class="font-bold">Your Contact Detail</p>
                                <input type="text" name="firstname" placeholder="First Name" class="mr-3 mb-3" required>
                                <input type="text" name="lastname" placeholder="Last name" class="mb-3" required>
                                <input type="number" name="mobile" placeholder="Mobile Number" class="mr-3 mb-3" required>
                                <input type="email" name="email" placeholder="Email" class=" mb-3" required>
                            </div>  
                
             </div>     
             <div class="modal-footer bg-white">
                 <div class="send_enquiry mt-3 mb-3 px-3 py-3">
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
                    <div class="text-right">
                        <p>&copy; Copyright <?php echo date('Y'); ?>. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <?php echo $this->Html->script(
                array(
            'jquery',
            'bootstrap.min',
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
            'custom',
            'scrolling-nav',
            'bootstrap-slider',
                ), array('inline' => false)
        );

        echo $this->fetch('script');    

    ?>
<script type="text/javascript">
       $("#time_of_travel").datepicker( {
        format: "MM-yyyy",
        viewMode: "months", 
        minViewMode: "months"
        });

        jQuery('.EnquiryBtn').on('click', function (e) {
                $('#commonModel').modal('show');
          });
        
         
   
    
</script>  
    

</body>
</html>
