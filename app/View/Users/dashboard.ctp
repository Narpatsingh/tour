<body id="page-top">
    <!--Preload-->
    <div class="preloader">
        <?php echo $this->element('loader/loader') ?>  
    </div>
    <!--End Preload-->
    <!-- <div class="top-header">
        <div class="row">
            <div class="col-md-12">
                <div class="top-contact">
                    <span class="call"> Call <span class="number">+91 2358745824</span></span>
                </div>
            </div>
        </div>
    </div> -->
    
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container full_width" style="margin-left: 0px">
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
                        </a>    
                        <!-- <p class="site_name">Silshine Trip</p> -->
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="navbar">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="active">
                                <a class="page-scroll" href="#home">Home</a>
                            </li>

                                <li class="dropdown mega-dropdown india">
                                    <a href="#" target="_blank" class="dropdown-toggle page-scroll" data-toggle="dropdown">India <span class="caret"></span></a>              
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
                                    <a class="page-scroll" href="#contact">Contact Us</a>
                                </li>
                                <?php if($this->Session->read('Auth.User.id')){ 
                                    $logUserName = $this->Session->read('Auth.User.name');
                                ?>
                                
                                <li>
                                  <div class="navbar-right" style="margin-top: 0px;">
                                    <ul class="nav navbar-nav">
                                        <li class="dropdown user user-menu">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <?php
                                                  echo $this->Html->image(getUserPhoto($this->Session->read('Auth.User.id'),$this->Session->read('Auth.User.photo'), false, false), array('class' => 'img-circle'));
                                                ?>
                                                <span><?php echo $logUserName ?><i class="caret"></i></span>
                                            </a>
                                            <ul class="dropdown-menu" style="min-width: 220px;padding: 0px">
                                                <!-- Admin image -->
                                                <li class="user-header bg-danger">
                                                    <?php
                                                      echo $this->Html->image(getUserPhoto($this->Session->read('Auth.User.id'),$this->Session->read('Auth.User.photo'), false, false), array('class' => 'img-circle'));
                                                    ?>
                                                    <p><?php echo $logUserName ?><small></small>
                                                    </p>
                                                </li>
                                                <!-- Menu Body -->
                                                <li class="user-body">
                                                    <div class="col-xs-12 text-center">
                                                        <a href="/users/change_password" class="no-hover-text-decoration">Change Password</a>
                                                    </div>
                                                </li>
                                                <!-- Menu Footer-->
                                                <li class="user-footer">
                                                    <div class="pull-left">
                                                        <a href="/users/profile" class="btn btn-default btn-flat">Profile</a>
                                                    </div>
                                                    <div class="pull-right">
                                                        <a href="/users/logout" class="btn btn-default btn-flat">Log out</a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                  </div>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>

                        <!-- /.navbar-collapse -->
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        <!-- /.container -->
    </nav>
<!-- Banner Section -->
    <section id="home"> 
        <div id="banner" class="carousel slide carousel-fade" data-ride="carousel" data-pause="false">
            <ol class="carousel-indicators">
                <li data-target="#banner" data-slide-to="0" class="active"></li>
                <li data-target="#banner" data-slide-to="1"></li>
                <li data-target="#banner" data-slide-to="2"></li>
                <li data-target="#banner" data-slide-to="3"></li>
                <li data-target="#banner" data-slide-to="4"></li>
                <li data-target="#banner" data-slide-to="5"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php $i=0;foreach ($sliders as $key => $slider) { 
                    if($i == 0){$i++; ?>
                <div class="item active" style="background-image:url(<?php echo $slider['Tour']['img']; ?>);">
                    <div class="carousel-caption">
                        <h2><?php echo $slider['Slider']['title'];?> </h2>
                        <h4><?php echo $slider['Slider']['description']; ?></h4>
                        <h4>full tour package only &#x20b9;<?php echo $slider['Tour']['price']; ?></h4>
                        <a href="tours/details/<?php echo $slider['Tour']['id']; ?>" >View Package <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                <?php }else{ ?>
                <div class="item" style="background-image:url(<?php echo $slider['Tour']['img']; ?>);">
                    <div class="carousel-caption">
                        <h2><?php echo $slider['Slider']['title'];?> </h2>
                        <h4><?php echo $slider['Slider']['description']; ?></h4>
                        <h4>full tour package only &#x20b9;<?php echo $slider['Tour']['price']; ?></h4>
                        <a href="tours/details/<?php echo $slider['Tour']['id']; ?>" >View Package <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                <?php } ?>    
            <?php } ?>
            </div><!--end carousel-inner-->
            <!-- Controls -->
            <a class="control left" href="#banner" data-slide="prev"><i class="fa fa-long-arrow-left"></i></a>
            <a class="right control" href="#banner" data-slide="next"><i class="fa fa-long-arrow-right"></i></a>
        </div>      
    </section>
    <!--end Banner-->
    <section id="packages" class="inverse">
        <!-- <hr> -->
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section-title text-center">
                        <h1 class="visible-title">Special Packages</h1>
                    </div>
                </div>
            </div>
            <div id="package" class="carousel slide carousel-fade mb-2" data-ride="carousel">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="owl-carousel" id="packages-carousel">
                            <?php foreach ($specials as $key => $special){ ?>
                            <div class="tour-item">
                                <div class="thumb">
                                    <img src="<?php echo $special['Tour']['img']; ?>" alt="" />
                                </div>
                                <div class="discount-info">
                                    <h3 class="text-white"><?php echo $special['City']['name']; ?></h3>
                                    <a class="" href="tours/details/<?php echo $special['Tour']['id']; ?>">View Details <i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                            <?php } ?> 
                        </div>  
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    <section class="parallax1">
    </section>
    <!-- end Packages -->
    <!-- Hot Deals Section -->
    <section id="hot-deals" class="padding inverse">
        <!-- <hr> -->
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section-title text-center">
                        <h1 class="visible-title">Hot Deals</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <?php $i=0; ?>
            <div class="row">
            <?php foreach ($hots as $key => $hot) { ?>
                    <?php if($i == 0){
                        $i++; ?>
                    <div class="col-md-8 my-3">
                        <a href="tours/details/<?php echo $hot['Tour']['id']; ?>">
                            <div class="hotdeal">
                                <div class="deal-pic">
                                    <img src="<?php echo $hot['Tour']['img']; ?>" alt="">
                                </div>
                                <div class="deal-content">
                                   <label class="hotdeal-label">Starts from &#x20b9;<?php echo $hot['Tour']['price']; ?></label>
                                   <h2 class="hotdeal-name"><?php echo $hot['Tour']['place']; ?></h2>
                                   <span class="hotdeal-days"><?php echo $hot['Tour']['days']; ?> Days</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php }else if($i == 1){ 
                        $i++;?>
                    <div class="col-md-4 my-3">
                        <div class="hotdeal">
                            <a href="tours/details/<?php echo $hot['Tour']['id']; ?>">
                                <div class="deal-pic">
                                    <img src="<?php echo $hot['Tour']['img']; ?>" alt="">
                                </div>
                                <div class="deal-content">
                                   <label class="hotdeal-label">Starts from &#x20b9;<?php echo $hot['Tour']['price']; ?></label>
                                   <h2 class="hotdeal-name"><?php echo $hot['Tour']['place']; ?></h2>
                                   <span class="hotdeal-days"><?php echo $hot['Tour']['days']; ?> Days</span>
                                </div>
                            </a>    
                        </div>
                    </div>
                    <?php }else if($i == 2){ 
                        $i++;?>
                    <div class="col-md-4 my-3">
                        <div class="hotdeal">
                            <a href="tours/details/<?php echo $hot['Tour']['id']; ?>">
                                <div class="deal-pic">
                                    <img src="<?php echo $hot['Tour']['img']; ?>" alt="">
                                </div>
                                <div class="deal-content">
                                   <label class="hotdeal-label">Starts from &#x20b9;<?php echo $hot['Tour']['price']; ?></label>
                                   <h2 class="hotdeal-name"><?php echo $hot['Tour']['place']; ?></h2>
                                   <span class="hotdeal-days"><?php echo $hot['Tour']['days']; ?> Days</span>
                                </div>
                            </a>   
                        </div>
                    </div>
                    <?php }else if($i == 3){ 
                        $i = 0;?>
                    <div class="col-md-8 my-3">
                        <div class="hotdeal">
                            <a href="tours/details/<?php echo $hot['Tour']['id']; ?>">
                                <div class="deal-pic">
                                    <img src="<?php echo $hot['Tour']['img']; ?>" alt="">
                                </div>
                                <div class="deal-content">
                                   <label class="hotdeal-label">Starts from &#x20b9;<?php echo $hot['Tour']['price']; ?></label>
                                   <h2 class="hotdeal-name"><?php echo $hot['Tour']['place']; ?></h2>
                                   <span class="hotdeal-days"><?php echo $hot['Tour']['days']; ?> Days</span>
                                </div>
                            </a>    
                        </div>
                    </div>
                    <?php } ?>
            <?php } ?>     
            </div>
        </div>        
        
    </section>
    <!--end hot-deals-->
    <section class="parallax2">
    </section>
    <!-- Deals and Discounts -->
    <section id="deals-discounts" class="inverse">
        <!-- <hr> -->
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section-title text-center">
                        <h1 class="visible-title">Deals and Discounts</h1>
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
    <section id="image_cards">
        <ul id="elImageList">
            <li class="item">
                <a class="link">
                    <img class="img" src="https://images.unsplash.com/photo-1547809526-d641162a6d7a?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=500&amp;q=60"/>
                </a>
            </li>
            <li class="item">
                <a class="link">
                    <img class="img" src="https://images.unsplash.com/photo-1547809397-e2c7eea071fa?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=500&amp;q=60"/>
                </a>
            </li>
            <li class="item">
                <a class="link">
                    <img class="img" src="https://images.unsplash.com/photo-1547808343-a2b9ca4bdba1?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=500&amp;q=60"/>
                </a>
            </li>
            <li class="item">
                <a class="link">
                    <img class="img" src="https://images.unsplash.com/photo-1547712407-657b35c945a9?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=500&amp;q=60"/>
                </a>
            </li>
            <li class="item">
                <a class="link">
                    <img class="img" src="https://images.unsplash.com/photo-1547192906-cbe9ea846725?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=500&amp;q=60"/>
                </a>
            </li>
            <li class="item">
                <a class="link">
                    <img class="img" src="https://images.unsplash.com/photo-1546840207-3d1d487ef205?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=500&amp;q=60"/>
                </a>
            </li>
            <li class="item">
                <a class="link">
                    <img class="img" src="https://images.unsplash.com/photo-1546234709-19651142a0f2?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=500&amp;q=60"/>
                </a>
            </li>
            <li class="item">
                <a class="link">
                    <img class="img" src="https://images.unsplash.com/photo-1545631421-43aabd0ee071?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=500&amp;q=60"/>
                </a>
            </li>
            <li class="item">
                <a class="link">
                    <img class="img" src="https://images.unsplash.com/photo-1545463488-ed7b4513bb80?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=500&amp;q=60"/>
                </a>
            </li>
            <li class="item">
                <a class="link">
                    <img class="img" src="https://images.unsplash.com/photo-1545804571-2cac41b26118?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=500&amp;q=60"/>
                </a>
            </li>
        </ul>
    </section>
    <!-- Count Section-->
    <section class="count-section parallax" data-stellar-background-ratio="0.5" style="background-image: url(img/bg/1.jpg);">
        <!-- <hr> -->
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
        <div class="container mb-2">
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
            <div class="row" style="overflow: hidden;">
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
                    <?php for ($x = 1; $x <= 2; $x++) { ?>
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
                    <?php for ($x = 1; $x <= 2; $x++) { ?>
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
            </div>   
        </div>     
        
    </section>
    <!-- end gallery-->
    <section class="parallax3">
    </section>
    <!-- Blog Section -->
    <section id="blog" class="inverse">
        <!-- <hr> -->
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section-title text-center">
                        <h1 class="visible-title">Recent Posts</h1>
                    </div>
                </div>
            </div>
            
            <div id="blog" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="row">
                    <div class="col-xs-12" style="padding: 0px 0px 10px 0px;">
                        <div class="owl-carousel" id="blogs-carousel">
                            <?php foreach ($blogs as $key => $blog){ ?>
                            <div class="tour-item">
                                <div class="thumb">
                                    <img src="<?php echo $blog['Tour']['img']; ?>" alt="" />
                                </div>
                                <div class="discount-info">
                                    <h3 class="text-white"><?php echo $blog['City']['name']; ?></h3>
                                    <a class="" href="tours/details/<?php echo $blog['Tour']['id']; ?>">View Details <i class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                            <?php } ?> 
                        </div>  
                    </div>
                </div>
            </div>
        </div>
        <!-- <hr> -->
    </section>
    <!--end blog-->
    
    <!-- Testimonials Section -->
    <section id="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section-title text-center">
                        <h1>Feedback</h1>
                    </div>
                </div>
            </div>
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
    <section id="contact" style="padding: 0px">
        <div class="contact-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 col-sm-offset-4">
                        <div class="contact-text">
                            <h3>Contact</h3>
                            <address>
                                E-mail: promo@party.com<br>
                                Phone: +1 (123) 456 7890<br>
                                Fax: +1 (123) 456 7891
                            </address>
                        </div>
                        <div class="contact-address">
                            <h3>Contact</h3>
                            <address>
                                Unit C2, St.Vincent's Trading Est.,<br>
                                Feeder Road,<br>
                                Bristol, BS2 0UY<br>
                                United Kingdom
                            </address>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div id="contact-section">
                            <h3>Send a message</h3>
                            <div class="status alert alert-success" style="display: none"></div>
                            <?php echo $this->Form->create('Contact',array('controller'=>'contacts','action'=>'add')); ?>
                            <!-- <form id="main-contact-form" class="contact-form" name="contact-form" method="post" action="#"> -->
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" required="required" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" required="required" placeholder="Email ID">
                                </div>
                                <div class="form-group">
                                    <textarea name="message" id="message" required="required" class="form-control" rows="4" placeholder="Enter your message"></textarea>
                                </div>                        
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary pull-right">Send</button>
                                </div>
                            </form>        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div  class="no-padding" style="width:100%;margin-bottom: -5px;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3720.510408257974!2d72.86946061432718!3d21.171873685921003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04fc305aa1c03%3A0xdafdc4ff76d283e6!2sRaghunandan+Row+House!5e0!3m2!1sen!2sin!4v1544246768635" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </section>

 
<script type="text/javascript">
  //   $(".carousel-inner").swiperight(function() {  
  //   $(this).parent().carousel('prev');  
  // });  
  // $(".carousel-inner").swipeleft(function() {  
  //   $(this).parent().carousel('next');  
  // });
  const imgContent = document.querySelectorAll('.img-content-hover');

function showImgContent(e) {
  for(var i = 0; i < imgContent.length; i++) {
    imgContent[i].style.left = e.pageX + 'px';
    imgContent[i].style.top = e.pageY + 'px';
  }
};

document.addEventListener('mousemove', showImgContent);

  $(document).ready(function(){
    $('#ContactAddForm').validate({ 
        rules: {
            'name': {
                required: true,
            },
            'email': {
                required: true,
                email : true
            },
            'message': {
                required: true,
            }
        },
        messages: {
            'first_name': {
                required: "Please enter name.",
            },
            'email': {
                required: "Please enter email.",
                email: "Please enter valid email.",
            },
            'message': {
                required: "Please enter message.",
            },
        },
        submitHandler: function(form) {
            form.submit();
        }
    });     
  });

</script>    