<body id="page-top details-page">
  <!--Preload-->
    <div class="preloader">
      <?php echo $this->element('loader/loader') ?>
    </div>
    <!--End Preload-->
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
                <?php echo $this->Html->link('Home', array('controller' => 'users', 'action' => 'dashboard'),array('class'=>'page-scroll'));
                ?>
              </li>

              <li>
                <?php echo $this->Html->link('Packages', array('controller' => 'users', 'action' => 'dashboard'),array('class'=>'page-scroll'));
                ?>
              </li>
              <li>
                <?php echo $this->Html->link('Hot Deals', array('controller' => 'users', 'action' => 'dashboard'),array('class'=>'page-scroll'));
                ?>
              </li>

              <li>
                <?php echo $this->Html->link('Deals and Discounts', array('controller' => 'users', 'action' => 'dashboard'),array('class'=>'page-scroll'));
                ?>
              </li>
              <li>
                <?php echo $this->Html->link('Gallery', array('controller' => 'users', 'action' => 'dashboard'),array('class'=>'page-scroll'));
                ?>
              </li>
              <li>
                <?php echo $this->Html->link('Blog', array('controller' => 'users', 'action' => 'dashboard'),array('class'=>'page-scroll'));
                ?>
              </li>
              <li>
                <?php echo $this->Html->link('Feedback', array('controller' => 'users', 'action' => 'dashboard'),array('class'=>'page-scroll'));
                ?>
              </li>
              <li>
                <?php echo $this->Html->link('Contact Us', array('controller' => 'users', 'action' => 'dashboard'),array('class'=>'page-scroll'));
                ?>
              </li>
              <?php if($this->Session->read('Auth.User.id')){ 
                  $logUserName = $this->Session->read('Auth.User.name');
              ?>
              <li>
                <div class="navbar-right" style="margin-top: 0px;">
                  <ul class="nav navbar-nav">
                      <li class="dropdown user user-menu">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                              <img src="/tour_management/files/user/photo/1/22.jpg" class="img-circle" alt="">
                              <span>Admin User<i class="caret"></i></span>
                          </a>
                          <ul class="dropdown-menu" style="min-width: 220px;">
                              <!-- Admin image -->
                              <li class="user-header bg-danger">
                                  <img src="/tour_management/files/user/photo/1/22.jpg" class="img-circle" alt="">
                                  <p>Admin User<small></small>
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
   <!-- /.container -->
</nav>
<section id="page-title" class="detail_page_image" style="background-image: url(<?php echo $this->webroot.$tour[0]['Tour']['img']; ?>);">
  <div class="title-info">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <div class="page-title text-center" id="Overview">
            <h1 class=""><?php echo "State: ".$this->Text->truncate($state_name,'50',array(
                                                                                      'ending' => '...', 
                                                                                      'exact' => true));?></h1>
          </div>
        </div>
      </div>
    </div>
  </div><!--end title-info-->
</section>
<!-- Navigation -->



  <!-- Deals and Discounts -->
  
  <div class="container-1">
    <div class="row">
      <div class="col-xs-12">
       <div class="section-title text-center">
          <h1 class="visible-title" style="margin-top: 15px;">India</h1>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="col-md-12">
        <div class="row">
          <div class="col-xs-12">
            <?php foreach ($tour as $key => $value) {  ?>
              <div class="col-xs-6 col-sm-4 col-md-4">
                <div class="tour-item">
                    <div class="thumb">
                      <img src="/<?php echo $value['Tour']['img']; ?>" alt="" />
                      </div>
                    <div class="discount-info">
                        <div class="price-info">
                            <span class="sale-price">&#x20b9;<?php echo $value['Tour']['price']; ?></span>
                        </div>
                        <h3><?php echo $value['City']['name']; ?></h3>
                        <p><?php echo $value['Tour']['name']; ?></p>
                       <?php echo $this->Html->link(__('View Details'.'<i class="fa fa-long-arrow-right"></i>'), array('controller' => 'tours', 'action' => 'details',$value['Tour']['id']),array('escape' => false)); ?>
                    </div>
                </div>
              </div>
            <?php } ?> 
          </div>
        </div>
      </div>
      <!-- <div class="col-md-3">
        <div class="filter">
          <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="row">
              <div class="col-md-6 pull-left">
               <span> Filter your search</span>
              </div>
              <div class="col-md-6 pull-right">
                <div>Reset All</div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="mt-2">
                  <label>Package Type</label>
                  <br>
                  <select class="selectbox">
                  <option>Special</option>
                  <option>Hot Deals</option>
                  <option>Deals And Discount</option>
                  </select> 
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="mt-2">
                  <label>Tour Duration</label>
                  <br>
                  <input id="ex1" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="14"/>
                </div>
              </div>
            </div>
        </div>
      </div> -->
    </div>
  </div>
</div>
<style type="text/css" media="screen">
  
.tour-item .thumb {
    float: left;
    position: relative;
    -webkit-border-radius: 5px 5px 0 0;
    -moz-border-radius: 5px 5px 0 0;
    border-radius: 5px 5px 0 0;
}
</style>


