
<title>Detail page</title>
<body id="details-page">
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
               <li>
                <?php echo $this->Html->link('About Us', array('controller' => 'users', 'action' => 'dashboard'),array('class'=>'page-scroll'));
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
<section id="page-title" class="detail_page_image" style="background-image: url(<?php echo $this->webroot.$tour['Tour']['img']; ?>);">
   <div class="title-info">
      <div class="container">
         <div class="row">
            <div class="col-xs-12">
               <div class="page-title text-center" id="">
                  <h1><?php echo $tour['Tour']['name'];?></h1>
                  <h2><?php echo "City: ".$this->Text->truncate($tour['City']['name'],'50',array(
                                                                                      'ending' => '...', 
                                                                                      'exact' => true));?></h2>
                  <h2><?php echo "Price: ".$tour['Tour']['price'];?></h2>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--end title-info-->
</section>
<!-- Navigation -->
<section class="detail_inner_nav pt-1 pb-1 parallax" >
   <nav class="navbar navbar-expand-lg fixed-top" id="mainNav">
      <div class="container">
         <div class="collapse navbar-collapse remove_add" id="navbarResponsive">
            <ul class="nav navbar-nav">
               <li class="nav-item active">
                  <a class="single-page-scroll" href="#Overview">Overview</a>
               </li>
               <li class="nav-item">
                  <a class="single-page-scroll" href="#Highlights">Highlights</a>
               </li>
               <li class="nav-item">
                  <a class="single-page-scroll" href="#Itinerary">Itinerary</a>
               </li>
               <li class="nav-item">
                  <a class="single-page-scroll" style="width: 150px;" href="#special_package">Hotel Information</a>
               </li>
               <li class="nav-item">
                  <a class="single-page-scroll" style="width: 100px;" href="#DatePrice">Date Price</a>
               </li>
            </ul>
         </div>
      </div>
   </nav>
</section>
<section id="Overview" class="pt-1">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <h2>Overview</h2>
        <p class="lead">
          <?php echo $tour['Tour']['description'];?>
        </p>
      </div>
    </div>
  </div>
</section>
<section id="Highlights">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 mx-auto">
            <h2 class="innerpage-heading">Highlights</h2>
              <ul class="list-unstyled">
              <?php if(!empty($tour['Highlight'])){
                foreach ($tour['Highlight'] as $highlight) { ?>
                  <li><?php echo $highlight['title']; ?></li>
                <?php } 
              } ?>
              </ul>
         </div>
      </div>
   </div>
</section>
<section id="Itinerary" class="bg-light">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 mx-auto">
            <h2>Itinerary</h2>
            <div class="row">
               <?php if (empty($tour['Itinerary'])) { ?>
                  <div class="col-md-12 col-sm-12">
                    <h4 style="color: chocolate;"> <?php echo __('No Itinerary found.') ?> </h4>
                  </div>
               <?php } else { ?>
                  <div class="col-md-12 col-sm-12">
                    <div class="tour_head1 l-info-pack-days days">
                      <h3></h3>
                        <ul>
                        <?php foreach ($tour['Itinerary'] as $itinerary) { ?>
                          <li class="l-info-pack-plac"> <i class="fa fa-clock-o" aria-hidden="true"></i>
                            <h4>Day : <?php echo $itinerary['day']; ?></h4>
                            <h4>Title : <?php echo $itinerary['title'].get_itinerary_detail($itinerary['km'],$itinerary['hour']); ?></h4>
                            <p><?php echo $itinerary['description']; ?></p>
                          </li>
                        <?php } ?>
                        </ul>
                      </div>
                    </div>
                  </div>
              <?php } ?>   
            </div> 
         </div>
      </div>
   </div>
</section>
<section id="special_package" class="special_package section-padding">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="section-title mx-auto">
               <h2>Hotel Information</h2>
               <span></span>
            </div>
         </div>
         <!-- END COL -->
      </div>
      <!-- END ROW -->  
      <div class="row text-center">
         <div class="col-md-12" data-aos="fade-up">
              <?php if (!count($hotels)) { ?>   
              <h4 style="color: chocolate;text-align: left"> <?php echo __('No Hotel found.') ?> </h4>
              <?php } else { ?>
            <div id="package-slider" class="owl-carousel">
              <?php foreach ($hotels as $key => $hotel){ ?>
              <div class="single_package">
                <img class="img-fluid" src="<?php echo $this->webroot.$hotel['Hotel']['photo']; ?>" alt="" style="height: 250px;">
                <h5 class="package-name"><?php echo $hotel['City']['name'];?></h5>
                <div class="package-hover">
                   <h5><?php echo $hotel['City']['name'];?></h5>
                   <span>Name : <?php echo $hotel['Hotel']['name'];?></span>
                   <p><?php echo $hotel['Hotel']['address'];?></p>
                   <?php for ($i=0; $i < $hotel['Hotel']['type']; $i++) { ?>
                      <i class="fa fa-star"></i>
                   <?php } ?>
                   <!-- <span class="time_zone">5 days 4 night</span> -->
                </div>
              </div>
              <?php } ?>
            </div>
            <?php } ?>
              <!-- END SINGLE PACKAGE -->
         </div>
         <!-- END COL -->
      </div>
      <!-- END ROW -->
   </div>
   <!-- END CONTAINER -->
</section>
<section id="DatePrice">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 mx-auto">
            <h2>Date Price</h2>
            <p class="lead">
              <?php echo $tour['Tour']['date_price'];?>
            </p>
         </div>
      </div>
   </div>
</section>
<section id="blog">
   <div class="container">
      <div class="row">
         <div class="col-xs-12">
            <div class="section-title text-center">
               <h1 class="visible-title">Tour Information</h1>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-xs-12 col-md-9 mx-auto">
            <h2 class="innerpage-heading">Package Cost Includes</h2>
            <ul class="list-unstyled">
              <li>Accommodation on twin sharing basis in above mentioned or similar category hotels, will be confirm at the time of booking.</li>
              <li>Meals: Daily buffet breakfast & Dinner in hotels restaurant as per meal plan.</li>
              <li>Complimentary use of the hotels any recreation facility as per hotels terms & conditions. (subject to availability)</li>
              <li>Surface transportation from pick up till drop as per Itinerary for round trip and local sightseeing as per the itinerary by individual Vehicle as per family and in group tour vehicle will be provided as per group.</li>
              <li>Vehicle cost is including all fuel charges, Driver allowance, Border tax and Toll Tax, Parking and entry charges which is applicable as on day of quotation.</li>
              <li>Child below 5 Years is complimentary without extra bed with same meal plan in parent's room.(Child Policy is vary as per hotel policy)</li>
              <li>Charges for Extra adult and child are including with extra bed and same meal plan with parents room.</li>
              <li>Maximum 1 Extra bed can be accommodating in each room.</li>
              <li>All presently applicable hotel & transportation taxes, (Goods & service tax will be extra as applicable)</li>
            </ul>
            <h2 class="mt-3 innerpage-heading">Package Cost Does Not Includes</h2>
            <ul class="list-unstyled">
              <li>Any Airfare / Train fare is not included in the package cost.</li>
              <li>Any expenses of personal nature like tips, phone calls, fax, internet, games, sauna, and steam, Jacuzzi, laundry, extra vehicle hire, bar, room heaters, discotheque or any other.</li>
              <li>Pony/horse rides, boat rides, safaris, rafting charges, skiing/skating, and cable car/ropeway rides etc.</li>
              <li>Extra food or beverages ordered or taken in hotel restaurant or room except buffet meal plan.</li>
              <li>Entrance fees at any monument and guide charges, wherever applicable.</li>
              <li>Additional sightseeing tours and excursions. All major sightseeing will be cover once during sightseeing.</li>
              <li>Vehicle will be allowed up to parking points & last possible points. (Subject to road & Gov. conditions).</li>
              <li>Any service not specifically mentioned in the "Package Cost Includes” column.</li>
              <li>Goods & Service Tax (GST) will be extra on total billing as applicable.</li>
            </ul>
            <h2 class="mt-3 innerpage-heading">Cancellation Policy</h2>
            <ul class="list-unstyled">
              <li>Cancellation before 30 days of start date of tour will be charged processing fee minimum 3500/- p.p (Advance Booking Amount)</li>
              <li>Cancellations between 20 days to 30 days before start date, 25% of tour cost would be charged as retention;</li>
              <li>Cancellations between 15 days to 20 days before start date, 50% of tour cost would be charged as retention;</li>
              <li>Cancellations made within 15 days of start date, entire tour cost shall be charged as retention;</li>
              <li>Above policy may vary during peak season</li>
            </ul>
            <h2 class="mt-3 innerpage-heading">What to know before you book</h2>
            <ul class="list-unstyled">
              <li>Hotels are subject to availability.</li>
              <li>It is mandatory for guests to present valid photo identification at the time of check-in.</li>
              <li>The identification proofs accepted are Driving License, Voters Card, Passport, Ration Card. Without valid ID the guest will not be allowed to check in. Note- PAN Cards will not be accepted as a valid ID card.</li>
              <li>All transfers and sightseeing are as per the Itinerary/package and in case of Air Conditioned vehicles, It will be switched off in the hills.</li>
              <li>The inclusion of extra bed with a booking is facilitated with a folding cot or a mattress as an extra bed.</li>
              <li>Early check-in or late check-out is subject to availability and may be chargable by the hotel. The standard check-in time is 12:00 PM and the standard check-out time is 10:00 AM.</li>
              <li>Any kind of personal expenses (Laundry, room service etc..) or optional tours/ extra meals are not inclusive in the package cost.</li>
              <li>The hotel reserves the right of admission. Accommodation can be denied to guests posing as a couple if suitable proof of identification is not presented at check-in. Vatsalya Holidays will not be responsible for any check-in denied by the hotel due to the aforesaid reason.</li>
              <li>In case of non-availability of above mentioned hotels similar category hotel will be provided.</li>
            </ul>
         </div>
      </div>
   </div>
</section>
<!-- Deals and Discounts -->
<section id="blog">
   <div class="container">
      <div class="row">
         <div class="col-xs-12">
            <div class="section-title text-center">
               <h1 class="visible-title">Other Trips</h1>
            </div>
         </div>
      </div>
      <div class="row">
        <?php if (!count($blogs)) { ?>   
        <h3 class='text-warning'><?php echo __('No record found.')?></h3>
        <?php } else { 
        foreach ($blogs as $key => $blog){ ?>
         <div class="col-xs-6 col-md-4">
            <div class="post wow fadeInUp">
               <div class="post-thumb">
                  <a href="<?php echo $this->webroot.'tours/details/'.$blog['Tour']['id']; ?>">
                     <img src="<?php echo $this->webroot.$blog['Tour']['img'];?>" alt="" style="height: 250px;">
                     <div class="post-overlay">
                        <i class="fa fa-link"></i>
                     </div>
                  </a>
               </div>
                <div class="post-bottom">
                  <h3><?php echo $this->Text->truncate($blog['State']['name'],'20',array(
                                                                                      'ending' => '...', 
                                                                                      'exact' => true));?></h3>
                  <p><?php echo $blog['Tour']['name'];?></p>
                </div>
            </div>
            <!--end post-->
         </div>
          <?php } ?>
        <?php } ?>
         
      </div>
   </div>
</section>

<style type="text/css" media="screen">

<?php if (count($hotels)) { if(count($hotels)==1){?>
  @media only screen and (max-width:500px) { 
    .single_package {margin-bottom:40px;width:306px;}
  }
<?php }}?>

.owl-stage-outer{
  height: 260px;
}  
.nav-item.active{
  border-bottom: 1px solid #800080;
  padding-bottom: 4px;
}

.nav>li>a:focus, .nav>li>a:hover {
    text-decoration: none;
    background-color: #fffs;
}
</style>
