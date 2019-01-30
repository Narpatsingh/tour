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
                                <input type="text" data-role="none" name="number_of_month" placeholder="Holidays Month" class="mr-3 mb-3" required>
                                <input type="text" data-role="none" name="number_of_guest" placeholder="Number of guest " class="mb-3" required>
                                <input type="text" data-role="none" name="time_of_travel" id="time_of_travel" placeholder="Time Of Travel" class="mr-3 mb-3" required>
                                <input type="text" data-role="none" name="travel_duration" placeholder="Travel Duration" class="mb-3" required>
                                <?php echo $this->Form->input('city_id',array('label' => false,'data-role'=>"none",'class' => 'mr-3 mb-3','style'=>'width: 100%;','empty' => __('Select City'), 'div' => false)); ?>
                                <?php echo $this->Form->input('destination',array('label' => false,'data-role'=>"none",'options'=>$destination,'class' => 'mr-3 mb-3','style'=>'width: 100%;','empty' => __('Select Destination'), 'div' => false)); ?>
                                <textarea data-role="none" name="experience" class=" textarea mt-3" placeholder="Additional Experiences" required></textarea>
                                <textarea data-role="none" name="special_requirements" class=" textarea mt-3" placeholder="Special Requirements" required></textarea>
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

        jQuery('.EnquiryBtn').on('click', function (e) {
                $('#commonModel').modal('show');
        });
        
    // $(document).ready(function(){
    //     $('#EnquiryAddForm').validate({ 
    //         rules: {
    //             'number_of_month': {
    //                 required: true,
    //             },
    //             'number_of_guest': {
    //                 required: true,
    //             },
    //             'time_of_travel': {
    //                 required: true,
    //             },
    //             'travel_duration': {
    //                 required: true,
    //             },
    //             'city_id': {
    //                 required: true,
    //             },
    //             'destination': {
    //                 required: true,
    //             },
    //             'experience': {
    //                 required: true,
    //             },
    //             'special_requirements': {
    //                 required: true,
    //             },
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
    //             'email': {
    //                 required: "Please enter email.",
    //                 email: "Please enter valid email.",
    //             },
    //             'message': {
    //                 required: "Please enter message.",
    //             },
    //         },
    //         submitHandler: function(form) {
    //             form.submit();
    //         }
    //     });     
    // });         
   
    
</script>  
    

</body>
</html>
