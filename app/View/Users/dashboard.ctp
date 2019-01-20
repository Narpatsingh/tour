
<body id="page-top">
    <!--Preload-->
    <div class="preloader">
        <div class="preloader_image"></div>
    </div>
    
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="navbar-header page-scroll">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand page-scroll TourLogo" href="/">
                            <?php
                                echo $this->Html->image(getLogo(), array('class' => 'img-responsive img-display silshine_logo'));
                            ?>
                            <p class="site_name">Silshine Trip</p>
                        </a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="navbar">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="active">
                                <a class="page-scroll" href="#home">Home</a>
                            </li>
                            <li class="dropdown mega-dropdown india">
                                <a href="Citypackage.php" target="_blank" class="dropdown-toggle" data-toggle="dropdown">India <span class="caret"></span></a>              
                                <ul class="dropdown-menu mega-dropdown-menu">
                                  <?php  $count = 0;
                                    foreach ($states as $key => $value) {
                                        if($count == 0){
                                            echo '<li class="col-sm-12 col-sm-12 col-md-3 col-lg-2">';
                                            echo '<ul>';
                                            echo '<li class="dropdown-header">';
                                            echo $this->Html->link($value['State']['name'], array('controller' => 'tours', 'action' => 'state_detail',$value['State']['id']),array('class'=>'dropdown-header'));
                                            echo '</li>';
                                            foreach ($value['City'] as $key1 => $name) {
                                                echo '<li>';
                                                echo $this->Html->link($name['name'], array('controller' => 'tours', 'action' => 'city_detail',$name['id']));
                                                echo '</li>';
                                            }
                                            $count++;   
                                        }elseif($count == 2){
                                            echo '<li class="dropdown-header">';
                                            echo $this->Html->link($value['State']['name'], array('controller' => 'tours', 'action' => 'state_detail',$value['State']['id']),array('class'=>'dropdown-header'));
                                            echo '</li>';
                                            foreach ($value['City'] as $key1 => $name) {
                                                echo '<li>';
                                                echo $this->Html->link($name['name'], array('controller' => 'tours', 'action' => 'city_detail',$name['id']));
                                                echo '</li>';     
                                            }
                                            echo '</li>';
                                            echo '</ul>';
                                            $count = 0;
                                        }elseif($count < 2){
                                            echo '<li class="dropdown-header">';
                                            echo $this->Html->link($value['State']['name'], array('controller' => 'tours', 'action' => 'state_detail',$value['State']['id']),array('class'=>'dropdown-header'));
                                            echo '</li>';
                                            foreach ($value['City'] as $key1 => $name) {
                                                echo '<li>';
                                                echo $this->Html->link($name['name'], array('controller' => 'tours', 'action' => 'city_detail',$name['id']));
                                                echo '</li>';       
                                            }
                                            $count++;
                                        }
                                    } ?>
                                </ul>
                            </li>
                            <li>
                                <a class="page-scroll" href="#packages">Packages</a>
                            </li>
                            <li>
                                <a class="page-scroll" href="#hot-deals">Hot Deals</a>
                            </li>
                            
                            <li>
                                <a class="page-scroll" href="#deals-discounts">Deals and Discounts</a>
                            </li>
                            <li>
                                <a class="page-scroll" href="#gallery">Gallery</a>
                            </li>
                            <li>
                                <a class="page-scroll" href="#blog">Blog</a>
                            </li>
                            <li>
                                <a class="page-scroll" href="#testimonials">Feedback</a>
                            </li>
                            <li>
                                <a class="page-scroll" href="#map">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
            </div>
            
        </div>
        <!-- /.container -->
    </nav>
<!-- Banner Section -->
    <section id="home"> 
        <div id="main-slider" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#main-slider" data-slide-to="0" class="active"></li>
                <li data-target="#main-slider" data-slide-to="1"></li>
                <li data-target="#main-slider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="item active">
                    <img class="img-responsive" src="img/slider/1.jpg" alt="slider">                       
                    <div class="carousel-caption">
                        <h2>register for our next event </h2>
                        <h4>full event package only @$199</h4>
                        <a href="#contact">GRAB YOUR TICKETS <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                <div class="item">
                    <img class="img-responsive" src="img/slider/2.jpg" alt="slider">
                    <div class="carousel-caption">
                        <h2>register for our next event </h2>
                        <h4>full event package only @$199</h4>
                        <a href="#contact">GRAB YOUR TICKETS <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                <div class="item">
                    <img class="img-responsive" src="img/slider/3.jpg" alt="slider">
                    <div class="carousel-caption">
                        <h2>register for our next event </h2>
                        <h4>full event package only @$199</h4>
                        <a href="#contact" >GRAB YOUR TICKETS <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>              
            </div>
        </div>      
    </section>
    <!--end Banner-->
    
    
    <!-- Packages Section -->
    <section id="packages" class="inverse">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section-title text-center">
                        <h1 class="visible-title">Special Packages</h1>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <?php foreach ($specials as $key => $special) {?>
                    <div class="col-xs-6 col-sm-6 col-md-4">
                        <div class="package-list wow fadeInUp">
                            <a href="tours/details/<?php echo $special['Tour']['id']; ?>">
                                <div class="package-thumb">
                                    <img src="<?php echo $special['Tour']['img']; ?>" alt="" />
                                    <div class="duration">
                                        <?php echo $special['Tour']['days']; ?> days<br/><?php echo $special['Tour']['nights']; ?> nights
                                    </div>
                                </div>
                                <div class="package-info">
                                    <h3><?php echo $special['City']['name']; ?></h3>
                                    <p><?php echo $special['Tour']['description']; ?></p>
                                    <span class="pull-right price">&#x20b9;<?php echo $special['Tour']['price']; ?></span>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php } ?>      
            </div>
        </div>
    </section>
    <!-- end Packages -->
    
    <!-- Hot Deals Section -->
    <section id="hot-deals" >
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section-title text-center">
                        <h1 class="visible-title">Hot Deals</h1>
                    </div>
                </div>
            </div>
        </div>
        
        <ul class="tour-list">
            <?php foreach ($hots as $key => $hot) { ?>
            <li>
                <div class="tour-thumb">
                    <img src="<?php echo $hot['Tour']['img']; ?>" alt="" />
                    <div class="overlay">
                        <div class="ovelay-inner text-center">
                            <h2><?php echo $hot['City']['name']; ?></h2>
                            <p><em>India, <?php echo $hot['Tour']['nights']; ?> Nights</em></p>
                            <a href="tours/details/<?php echo $hot['Tour']['id']; ?>" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </li>
            <?php } ?>
        </ul>
        
    </section>
    <!--end hot-deals-->
    
    <!-- Deals and Discounts -->
    <section id="deals-discounts" class="inverse" style="background-image: url(images/bg_img/bg4.jpg);background-position: 50% 0; background-size: contain; position: relative;">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section-title text-center">
                        <h1>Deals and Discounts</h1>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12">
                    <div class="owl-carousel" id="deals-discounts-carousel">
                        <?php foreach ($discounts as $key => $discount) {  ?>
                        <div class="tour-item">
                            <div class="thumb">
                                <img src="<?php echo $discount['Tour']['img']; ?>" alt="" />
                            </div>
                            <div class="discount-info">
                                <div class="price-info">
                                    <span class="regular-price">&#x20b9;<?php echo $discount['Tour']['discount']; ?></span>
                                    <span class="sale-price">&#x20b9;<?php echo $discount['Tour']['price']; ?></span>
                                </div>
                                <h3><?php echo $discount['City']['name']; ?></h3>
                                <p><?php echo $discount['Tour']['description']; ?></p>
                                <a href="tours/details/<?php echo $discount['Tour']['id']; ?>">View Details <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                        <?php } ?> 
                    </div>  
                </div>
            </div>
            
        </div>
        
    </section>
    <!--end deals-discounts-->
    
    <!-- Count Section-->
    <section class="count-section parallax" data-stellar-background-ratio="0.5" style="background-image: url(img/bg/1.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul>
                        <li>
                            <i class="fa fa-heart-o"></i>
                            <h2><span class="counter count">2500</span></h2>
                            <h4>Happy Clients</h4>
                        </li>
                        <li>
                            <i class="fa fa-bed"></i>
                            <h2><span class="counter count">350</span></h2>
                            <h4>Popular Hotes</h4>
                        </li>
                        <li>
                            <i class="fa fa-flag-checkered"></i>
                            <h2><span class="counter count">520</span></h2>
                            <h4>Top Destinations</h4>
                        </li>
                        <li>
                            <i class="fa fa-ship"></i>
                            <h2><span class="counter count">120</span></h2>
                            <h4>Cruises</h4>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--end count-section-->
    
    <!-- Gallery Section -->
    <section id="gallery">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section-title text-center">
                        <h1 class="visible-title">Gallery</h1>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-12">
                    <ul id="filter-list">
                        <li class="filter" data-filter="all">ALL</li>
                        <li class="filter" data-filter="tours">tours</li>
                        <li class="filter" data-filter="cruises">cruises</li>
                        <li class="filter" data-filter="hotels">hotels</li>
                    </ul><!-- @end #filter-list -->
                </div>
            </div>
        </div>
        
        <ul class="gallery-item">
            <?php foreach ($hotels as $key => $hotel) {  ?>
            <li class="gallery hotels">
                <div class="thumb">
                    <img src="<?php echo $hotel['Hotel']['photo']; ?>" alt="" />
                    <div class="gallery-overlay">
                        <div class="gallery-overlay-inner">
                            <h2><?php echo $hotel['Hotel']['name']; ?></h2>
                            <a href="<?php echo $hotel['Hotel']['photo']; ?>" class="fancybox"><i class="fa fa-camera"></i></a>
                        </div>
                    </div>
                </div><!--end post thumb-->
            </li>
            <?php } ?> 
            <?php for ($x = 1; $x <= 3; $x++) { ?>
            <li class="gallery tours">
                <div class="thumb">
                    <img src="img/gallery/5.jpg" alt="" />
                    <div class="gallery-overlay">
                        <div class="gallery-overlay-inner">
                            <h2>Gallery <?php echo $x; ?></h2>
                            <a href="img/gallery/8.jpg" class="fancybox"><i class="fa fa-camera"></i></a>
                        </div>
                    </div>
                </div><!--end post thumb-->
            </li>
            <?php } ?>
            <?php for ($x = 1; $x <= 3; $x++) { ?>
            <li class="gallery cruises">
                <div class="thumb">
                    <img src="img/gallery/9.jpg" alt="" />
                    <div class="gallery-overlay">
                        <div class="gallery-overlay-inner">
                            <h2>Gallery <?php echo $x; ?></h2>
                            <a href="img/gallery/9.jpg" class="fancybox"><i class="fa fa-camera"></i></a>
                        </div>
                    </div>
                </div><!--end post thumb-->
            </li>
            <?php } ?>
            
        </ul>
        
    </section>
    <!-- end gallery-->
    
    <!-- Blog Section -->
    <section id="blog" class="inverse" style="background-image: url(images/bg_img/bg5.jpg);background-position: 50% 0; background-size: contain; position: relative;">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section-title text-center">
                        <h1>Recent Posts</h1>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-6 col-md-4">
                    <div class="post wow fadeInUp">
                        <div class="post-thumb">
                            <a href="details.php">
                                <img src="img/blog/1.jpg" alt="" />
                                <div class="post-overlay">
                                    <i class="fa fa-link"></i>
                                </div>
                            </a>
                        </div>
                        <div class="post-bottom">
                            <h3>Tour Place</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typeseatting industry. Lorem Ipsum has been the industry's</p>
                            <div class="pull-left">
                                <span class="post-date"><i class="fa fa-calendar"></i> 16 February 2019</span>
                                
                            </div>
                            
                        </div>
                    </div><!--end post-->
                </div>
                
                <div class="col-xs-6 col-md-4">
                    <div class="post wow fadeInUp">
                        <div class="post-thumb">
                            <a href="details.php">
                                <img src="img/blog/2.jpg" alt="" />
                                <div class="post-overlay">
                                    <i class="fa fa-link"></i>
                                </div>
                            </a>
                        </div>
                        <div class="post-bottom">
                            <h3>Tour Place</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typeseatting industry. Lorem Ipsum has been the industry's</p>
                            <div class="pull-left">
                                <span class="post-date"><i class="fa fa-calendar"></i> 16 February 2019</span>
                                
                            </div>
                            
                        </div>
                    </div><!--end post-->
                </div>
                
                <div class="col-xs-6 col-md-4">
                    <div class="post wow fadeInUp">
                        <div class="post-thumb">
                            <a href="details.php">
                                <img src="img/blog/3.jpg" alt="" />
                                <div class="post-overlay">
                                    <i class="fa fa-link"></i>
                                </div>
                            </a>
                        </div>
                        <div class="post-bottom">
                            <h3>Tour Place</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typeseatting industry. Lorem Ipsum has been the industry's</p>
                            <div class="pull-left">
                                <span class="post-date"><i class="fa fa-calendar"></i> 16 February 2019</span>
                                
                            </div>
                            
                        </div>
                    </div><!--end post-->
                </div>
                
                <div class="col-xs-6 col-md-4">
                    <div class="post wow fadeInUp">
                        <div class="post-thumb">
                            <a href="details.php">
                                <img src="img/blog/4.jpg" alt="" />
                                <div class="post-overlay">
                                    <i class="fa fa-link"></i>
                                </div>
                            </a>
                        </div>
                        <div class="post-bottom">
                            <h3>Tour Place</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typeseatting industry. Lorem Ipsum has been the industry's</p>
                            <div class="pull-left">
                                <span class="post-date"><i class="fa fa-calendar"></i> 16 February 2019</span>
                                
                            </div>
                                
                        </div>
                    </div><!--end post-->
                </div>
                
                <div class="col-xs-6 col-md-4">
                    <div class="post wow fadeInUp">
                        <div class="post-thumb">
                            <a href="details.php">
                                <img src="img/blog/5.jpg" alt="" />
                                <div class="post-overlay">
                                    <i class="fa fa-link"></i>
                                </div>
                            </a>
                        </div>
                        <div class="post-bottom">
                            <h3>Tour Place</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typeseatting industry. Lorem Ipsum has been the industry's</p>
                            <div class="pull-left">
                                <span class="post-date"><i class="fa fa-calendar"></i> 16 February 2019</span>
                                
                            </div>
                            
                        </div>
                    </div><!--end post-->
                </div>
                
                <div class="col-xs-6 col-md-4">
                    <div class="post wow fadeInUp">
                        <div class="post-thumb">
                            <a href="details.php">
                                <img src="img/blog/6.jpg" alt="" />
                                <div class="post-overlay">
                                    <i class="fa fa-link"></i>
                                </div>
                            </a>
                        </div>
                        <div class="post-bottom">
                            <h3>Tour Place</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typeseatting industry. Lorem Ipsum has been the industry's</p>
                            <div class="pull-left">
                                <span class="post-date"><i class="fa fa-calendar"></i> 16 February 2019</span>
                                
                            </div>
                            
                        </div>
                    </div><!--end post-->
                </div>
                
            </div>
        </div>
    </section>
    <!--end blog-->
    
    <!-- Testimonials Section -->
    <section id="testimonials">
        <div class="container">
            <div id="twitter-feed" class="carousel slide" data-interval="false">
                <!-- <div class="twit">
                    <img class="img-responsive" src="images/bg_img/twit.png" alt="twit">
                </div> -->
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="text-center carousel-inner center-block">
                            <div class="item active">
                                <img src="img/no-image.png" alt="">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                <a href="#">http://t.co/yY7s1IfrAb 2 days ago</a>
                            </div>
                            <div class="item">
                                <img src="img/no-image.png" alt="">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                <a href="#">http://t.co/yY7s1IfrAb 2 days ago</a>
                            </div>
                            <div class="item">
                                <img src="img/no-image.png" alt="">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                <a href="#">http://t.co/yY7s1IfrAb 2 days ago</a>
                            </div>
                        </div>
                        <a class="twitter-control-left" href="#twitter-feed" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                        <a class="twitter-control-right" href="#twitter-feed" data-slide="next"><i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>    
    </section>
    <!--end testimonials-->
    <section id="map">
        <div class="conatc_content">
            <div class="col-md-12">
                <div class="row mb-3"  style="background-image: url(images/bg_img/bg1.jpg);background-position: 50% 0; background-size: contain; position: relative;">
                    <div class="section-title text-center" style="padding: 15px;">
                        <h1 class="text-white">CONTACT US</h1>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="add_detail text-center">
                            <i class="fa fa-home"></i>
                            <p class="text-white">Shakti - 2 opp.sudarshan Bunglow  Nr.Europen catalog 
                            Ahmedabad - 380015 </p>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="add_detail text-center">
                            <i class="fa fa-phone"></i>
                            <p class="text-white">+91 9876543210</p>
                            <p class="text-white">+91 9513578520</p>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="add_detail text-center">
                            <i class="fa fa-envelope"></i>
                            <p class="text-white">TestABc@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                
            </div>
        </div>
        
        <div  class="no-padding" style='width:100%'>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3720.510408257974!2d72.86946061432718!3d21.171873685921003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04fc305aa1c03%3A0xdafdc4ff76d283e6!2sRaghunandan+Row+House!5e0!3m2!1sen!2sin!4v1544246768635" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </section>
<!-- <script type="text/javascript">
    $(document).ready(function(){
    $(".dropdown").hover(            
      function() {
        $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideDown("400");
        $(this).toggleClass('open');        
      },
      function() {
        $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideUp("400");
        $(this).toggleClass('open');       
      }
      );
  });
</script> -->