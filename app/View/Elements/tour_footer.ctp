    <div class="Enquiry">
        <div class="EnquiryClick ">
            <button class="EnquiryBtn"><i class="fa fa-pencil mr-2" ></i> Enquiry</button>
        </div>
    </div>
    <div class="overview_enquiry_popup  ">
        <div class="Enquiry_header">
            <span>Quick Enquiry </span>
            <span class="close_enquiry">x</span>
            
        </div>
            <div class="inner_enquiry_section">
                <form action="function.php" method="post" accept-charset="utf-8">
                <div class="holiday_Guest mt-3 mb-3 px-3 py-3">
                    <input type="text" name="month" placeholder="Holidays Month" class="mr-3 mb-3" required>
                    <input type="text" name="guest" placeholder="Number of guest " class="mb-3" required>
                    <textarea name="experiences" class=" textarea mt-3" placeholder="Additional Experiences" required></textarea>
                </div>
                <div class="contact_detail mt-3 mb-3 px-3 py-3">
                    <p class="font-bold">Your Contact Detail</p>
                    <input type="text" name="firstname" placeholder="First Name" class="mr-3 mb-3" required>
                    <input type="text" name="lastname" placeholder="Last name" class="mb-3" required>
                    <input type="number" name="mobile" placeholder="Mobile Number" class="mr-3 mb-3" required>
                    <input type="email" name="email" placeholder="Email" class=" mb-3" required>
                </div>  
            </div>
          
         <div class="send_enquiry mt-3 mb-3 px-3 py-3">
            <button type="submit" class="btn btn-primary btn-sm">Send Enuiry</button>
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
            'jquery.counterup',
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
    

</body>
</html>
