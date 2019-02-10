<body id="page-top">
    <?php echo $this->Session->flash(); ?>
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
                                        $state_count = count($states);
                                        if (!count($states)) { ?>   
                                            <h3 class='text-warning'><?php echo __('No record found.')?></h3>
                                        <?php }else {
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
                                                if($state_count == 1){
                                                    echo '</li>';
                                                    echo '</ul>';
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
                                                if($state_count == 2){
                                                    echo '</li>';
                                                    echo '</ul>';
                                                }
                                                $count++;
                                            }
                                            } 
                                        }   ?>
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
                <?php $i=0;
                if (!count($sliders)) { ?>   
                    <h3 class='text-warning'><?php echo __('No record found.')?></h3>
                <?php }else {
                foreach ($sliders as $key => $slider) { 
                        if($i == 0){$i++; ?>
                    <div class="item active" >
                        <img src="<?php echo  $slider['Tour']['img']; ?>" alt="" />
                        <div class="carousel-caption">
                            <h2><?php echo $slider['Slider']['title'];?> </h2>
                            <h4><?php echo $slider['Slider']['description']; ?></h4>
                            <h4>full tour package only &#x20b9;<?php echo $slider['Tour']['price']; ?></h4>
                            <a href="tours/details/<?php echo $slider['Tour']['id']; ?>" >View Package <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                    <?php }else{ ?>
                    <div class="item">
                        <img src="<?php echo  $slider['Tour']['img']; ?>" alt="" />
                        <div class="carousel-caption">
                            <h2><?php echo $slider['Slider']['title'];?> </h2>
                            <h4><?php echo $slider['Slider']['description']; ?></h4>
                            <h4>full tour package only &#x20b9;<?php echo $slider['Tour']['price']; ?></h4>
                            <a href="tours/details/<?php echo $slider['Tour']['id']; ?>" >View Package <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                    <?php } ?>    
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
                            <?php if (!count($specials)) { ?>   
                            <h3 class='text-warning'><?php echo __('No record found.')?></h3>
                            <?php } else {
                                foreach ($specials as $key => $special){ ?>
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
            <?php if (!count($hots)) { ?>   
                <h3 class='text-warning'><?php echo __('No record found.')?></h3>
                <?php } else {
                foreach ($hots as $key => $hot) { ?>
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
                        <?php if (!count($discounts)) { ?>   
                        <h3 class='text-warning'><?php echo __('No record found.')?></h3>
                        <?php } else {
                            foreach ($discounts as $key => $discount) {  ?>
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
                        <?php } ?>
                    </div>  
                </div>
            </div>
            
        </div>
        
    </section>
    <!--end deals-discounts-->
    <!-- <section id="image_cards">
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
    </section> -->
    <!-- Count Section-->
    <section class="count-section parallax" data-stellar-background-ratio="0.5" style="background-image: url(img/bg/1.jpg);">
        <!-- <hr> -->
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="remove_list_style">
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
                            <?php if (!count($blogs)) { ?>   
                            <h3 class='text-warning'><?php echo __('No record found.')?></h3>
                            <?php } else { 
                                foreach ($blogs as $key => $blog){ ?>
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
                            <?php } ?>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
        <!-- <hr> -->
    </section>
    <!--end blog-->
    <section id="testimonials" class="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="customers-testimonials" class="owl-carousel">
                        <!--TESTIMONIAL 1 -->
                        <div class="item">
                            <div class="shadow-effect">
                                <img class="img-circle img" src="http://themes.audemedia.com/html/goodgrowth/images/testimonial3.jpg" alt="">
                                <p>
                                    The telephone Customer service team was very
                                    supportive. Special mention about raj , who was
                                    very helpful and patient in handling all queries
                                    and all bookings were done professionally by
                                    him.
                                </p>
                            </div>
                            <div class="testimonial-name">Helpful Support</div>
                        </div>
                        <!--END OF TESTIMONIAL 1 -->
                        <!--TESTIMONIAL 2 -->
                        <div class="item">
                            <div class="shadow-effect">
                                <img class="img-circle img" src="http://themes.audemedia.com/html/goodgrowth/images/testimonial3.jpg" alt="">
                                <p>
                                    Many Thanks for your effort with me. Be sure for
                                    my coming trips it will be with you as i was very
                                    pleased with your professionalization. Once
                                    again thank you personally and thanks silshine
                                    Trip.
                                </p>
                            </div>
                            <div class="testimonial-name">Great Efforts</div>
                        </div>
                        <!--END OF TESTIMONIAL 2 -->
                        <!--TESTIMONIAL 3 -->
                        <div class="item">
                            <div class="shadow-effect">
                                <img class="img-circle img" src="http://themes.audemedia.com/html/goodgrowth/images/testimonial3.jpg" alt="">
                                <p>
                                    What ends well is well done. Thanks again for all
                                    the help.Looking forward for further
                                    engagements.
                                </p>
                            </div>
                            <div class="testimonial-name">Great Help</div>
                        </div>
                        <!--END OF TESTIMONIAL 3 -->
                        <!--TESTIMONIAL 4 -->
                        <div class="item">
                            <div class="shadow-effect">
                                <img class="img-circle img" src="http://themes.audemedia.com/html/goodgrowth/images/testimonial3.jpg" alt="">
                                <p>
                                    We are back from one of the most amazing
                                    vacations we've been on lately! It was indeed a
                                    great experience- right from the interactions with
                                    bhavsar at SST, which were always informative
                                    and usefull
                                </p>
                            </div>
                            <div class="testimonial-name">Amazing Vacations</div>
                        </div>
                        <!--END OF TESTIMONIAL 4 -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end testimonials-->
    <!-- <section id="contact" style="padding: 0px">
        <div class="contact-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-area">
                            <div class="contact">
                                <main>
                                    <section>
                                        <div class="content">
                                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/256492/_mLIxaKY_400x400.jpg" alt="Profile Image">

                                            <aside>
                                                <h1>Riccardo Cavallo</h1>
                                                <p>Hi, I'm Riccardo Cavallo and I'm a Graphic and Visual Designer.</p>
                                            </aside>
                                  
                                            <button type="button" data-toggle="modal" data-target="#myModal">
                                                <span>Contact Me</span>
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"> <g class="nc-icon-wrapper" fill="#444444"> <path d="M14.83 30.83L24 21.66l9.17 9.17L36 28 24 16 12 28z"></path> </g> </svg>
                                            </button>
                                         </div>
                                    </section>
                                </main>
                            </div>
                        </div>
                    </div>
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content" style="border-radius: 12px;">
                            <button type="button" class="close" data-dismiss="modal" style="padding: 10px;">×</button>
                                <div class="modal-header Enquiry_header">
                                    <h3 class="modal-title" style="color:#ffff;">Contact Detail</h3>
                                </div>
                                <div class="modal-body">
                                    <div class="contact-text">
                                        <h2 class="visible-title">Contact</h2>
                                        <address>
                                            E-mail : silshinetrip@gmail.com<br>
                                            Contact No : 8733897945<br>
                                            Contact No : 8758368590
                                        </address>
                                    </div>
                                    <div class="contact-address">
                                        <h2 class="visible-title">Address</h2>
                                        <address>
                                            501/6,Bhakti dharm,<br>
                                            Township Palanpur,<br>
                                            Canal Road,<br>
                                            Jahangirabad Surat.
                                        </address>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>    
                    <!-- <div class="col-sm-3 col-sm-offset-4">
                        <div class="contact-text">
                            <h3>Contact</h3>
                            <address>
                                E-mail : silshinetrip@gmail.com<br>
                                Contact No : 8733897945<br>
                                Contact No : 8758368590
                            </address>
                        </div>
                        <div class="contact-address">
                            <h3>Address</h3>
                            <address>
                                501/6,Bhakti dharm,<br>
                                Township Palanpur,<br>
                                Canal Road,<br>
                                Jahangirabad Surat.
                            </address>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="contact-section">
                            <h3 style="color:white;">Send a message</h3>
                            <div class="status alert alert-success" style="display: none"></div>
                            <?php //echo $this->Form->create('Contact',array('controller'=>'contacts','action'=>'add')); ?>
                            
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
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7438.906951197761!2d72.77224493252278!3d21.21385909032098!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04c41f49e790b%3A0xc794ddaa38573360!2sBhakti+Dharm+Township!5e0!3m2!1sen!2sin!4v1549383934402" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </section> -->

    <section id="contact" style="padding: 0px">
        <div class="contact-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 col-sm-offset-4">
                        <div class="contact-text">
                            <h3>Contact</h3>
                            <address>
                                E-mail : silshinetrip@gmail.com<br>
                                Contact No : 8733897945<br>
                                Contact No : 8758368590
                            </address>
                        </div>
                        <div class="contact-address">
                            <h3>Address</h3>
                            <address>
                                501/6,Bhakti dharm,<br>
                                Township Palanpur,<br>
                                Canal Road,<br>
                                Jahangirabad Surat.
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
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7438.906951197761!2d72.77224493252278!3d21.21385909032098!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04c41f49e790b%3A0xc794ddaa38573360!2sBhakti+Dharm+Township!5e0!3m2!1sen!2sin!4v1549383934402" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </section>    
 
<script type="text/javascript">

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

  jQuery(document).ready(function($) {
            "use strict";
            //  TESTIMONIALS CAROUSEL HOOK
        $('#customers-testimonials').owlCarousel({
            loop: true,
            center: true,
            margin:10,
            autoplay: true,
            nav:true,
            responsiveClass: true,
            responsive: {
              0: {
                items: 1
              },
              768: {
                items: 2
              },
              1170: {
                items: 3
              }
            }
        });
    });

</script>    