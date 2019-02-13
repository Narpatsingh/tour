
<title>Detail page</title>
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
<section id="page-title" class="detail_page_image"  style="background-image: url(<?php echo $this->webroot.$tour['Tour']['img']; ?>);">
   <div class="title-info">
      <div class="container">
         <div class="row">
            <div class="col-xs-12">
               <div class="page-title text-center" id="">
                  <h1><?php echo $tour['Tour']['name'];?></h1>
                  <h2><?php echo "City: ".$tour['City']['name'];?></h2>
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
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <div class="container">
         <div class="collapse navbar-collapse mb-2 remove_add" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
               <li class="nav-item">
                  <a class="single-page-scroll" href="#Overview">Overview</a>
               </li>
               <li class="nav-item">
                  <a class="single-page-scroll" href="#Itinerary">Itinerary</a>
               </li>
               <li class="nav-item">
                  <a class="single-page-scroll" href="#Highlights">Highlights</a>
               </li>
               <li class="nav-item">
                  <a class="single-page-scroll" href="#special_package">Hotel Information</a>
               </li>
               <li class="nav-item">
                  <a class="single-page-scroll" href="#DatePrice">Date Price</a>
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
         <!-- <div class="col-lg-4 mx-auto">
            <div class="overview_enquiry px-3 py-3 ">
               <p class="font-bold">Tell us more about your holiday plans</p>
               <form action="function.php" method="post" accept-charset="utf-8">
               <div class="holiday_Guest mt-3 mb-3">
                  <input type="text" name="month" placeholder="Holidays Month" class="mr-3 mb-3">
                  <input type="text" name="guest" placeholder="Number of guest " class="mb-3">
                  <textarea name="experiences" class=" textarea mt-3" placeholder="Additional Experiences"></textarea>
               </div>
               <div class="contact_detail mt-3 mb-3">
                  <p class="font-bold">Your Contact Detail</p>
                  <input type="text" name="firstname" placeholder="First Name" class="mr-3 mb-3">
                  <input type="text" name="lastname" placeholder="Last name" class="mb-3">
                  <input type="number" name="mobile" placeholder="Mobile Number" class="mr-3 mb-3">
                  <input type="email" name="email" placeholder="Email" class=" mb-3">
               </div>
               <div class="send_enquiry mt-3 mb-3">
                  <button type="submit" class="btn btn-primary btn-sm">Send Enquiry</button>
               </div>
            </div>
         </div> -->
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
                      <h5 style="color: chocolate;"> <?php echo __('No Itinerary found.') ?> </h5>
                  </div>
               <?php } else { ?>
                  <?php foreach ($tour['Itinerary'] as $itinerary) { ?>
                  <div class="col-md-12 col-sm-12">
                      <div class="desc">
                          <h3 style="font-weight: bold;color: #343030;">Day <?php echo $itinerary['day']; ?></h3>
                          <h3 style="font-weight: bold;color: #343030;">Title : <?php echo $itinerary['title'].get_itinerary_detail($itinerary['km'],$itinerary['hour']); ?></h3>
                          <p style="padding-right: 60px;font-size: 18px"><b>Description : </b><?php echo $itinerary['description']; ?></p>
                      </div>
                  </div>
               <?php }
               } ?>   
            </div> 
         </div>
      </div>
   </div>
</section>
<section id="Highlights">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 mx-auto">
            <h2>Highlights</h2>
            <p class="lead">
               <?php if(!empty($tour['Highlight'])){
               foreach ($tour['Highlight'] as $highlight) { ?>
                <ul>
                    <li><?php echo $highlight['title']; ?></li>
                </ul>
            <?php } 
            } ?>
            </p>
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
              <h3 class='text-warning'><?php echo __('No record found.')?></h3>
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
<section id="blog" class="inverse">
   <div class="container">
      <div class="row">
         <div class="col-xs-12">
            <div class="section-title text-center">
               <h1>Tour Information</h1>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-xs-6 col-md-6 mx-auto">
            <h2>Inclusions</h2>
            <ul>
               <li>1) Meals: Breakfast , Dinner (set Menu) as mentioned in the itinerary</li>
               <li>2) Return transfers by Shared Vehicle to the airport</li>
               <li>3) 03 Nights accommodation at Kyriad hotel or similar category hotel</li>
               <li>4) One half day sightseeing of Goa by shared coach on scheduled days</li>
               <li>5) Boat cruise (subject to weather conditions)</li>
            </ul>
            <h2 class="mt-3">Exclusions</h2>
            <ul>
               <li>1) Meals: Breakfast , Dinner (set Menu) as mentioned in the itinerary</li>
               <li>2) Return transfers by Shared Vehicle to the airport</li>
               <li>3) 03 Nights accommodation at Kyriad hotel or similar category hotel</li>
               <li>4) One half day sightseeing of Goa by shared coach on scheduled days</li>
               <li>5) Boat cruise (subject to weather conditions)</li>
            </ul>
            <h2 class="mt-3">Remarks</h2>
            <ul>
               <li>1) Meals: Breakfast , Dinner (set Menu) as mentioned in the itinerary</li>
               <li>2) Return transfers by Shared Vehicle to the airport</li>
               <li>3) 03 Nights accommodation at Kyriad hotel or similar category hotel</li>
               <li>4) One half day sightseeing of Goa by shared coach on scheduled days</li>
               <li>5) Boat cruise (subject to weather conditions)</li>
            </ul>
            <h2 class="mt-3">Cancellation Policy</h2>
            <ul>
               <li>1) Meals: Breakfast , Dinner (set Menu) as mentioned in the itinerary</li>
               <li>2) Return transfers by Shared Vehicle to the airport</li>
               <li>3) 03 Nights accommodation at Kyriad hotel or similar category hotel</li>
               <li>4) One half day sightseeing of Goa by shared coach on scheduled days</li>
               <li>5) Boat cruise (subject to weather conditions)</li>
            </ul>
         </div>
         <div class="col-xs-6 col-md-6 mx-auto">
            <h2 class="mt-3">Payment policy</h2>
            <table class="table table-bordered">
               <tbody>
                  <tr>
                     <th>Sector</th>
                     <th>Booking Payment Schedule</th>
                     <th>Payment policy</th>
                  </tr>
                  <tr>
                     <td>India &amp; World</td>
                     <td>Package Price less than
                        INR 25,000 (Per Person)
                     </td>
                     <td>Full Payment</td>
                  </tr>
                  <tr>
                     <td>India</td>
                     <td>Package Price more than
                        INR 25,000 (per person)
                     </td>
                     <td>INR 25,000 (Registration Amount Per Person)</td>
                  </tr>
                  <tr>
                     <td></td>
                     <td>45 Days Prior to Departure</td>
                     <td>Full Payment</td>
                  </tr>
                  <tr>
                     <td>World</td>
                     <td>Package Price less than INR 50,000 (Per Person)</td>
                     <td>INR 25000 (Registration Amount Per Person)</td>
                  </tr>
                  <tr>
                     <td></td>
                     <td>Package Price more than INR 50,000 (Per Person)</td>
                     <td>INR 50,000 (Registration Amount Per Person)</td>
                  </tr>
                  <tr>
                     <td></td>
                     <td>45 Days Prior to Departure</td>
                     <td>Full Payment</td>
                  </tr>
                  <tr class="bg-light">
                     <td colspan="3"><strong>Last Minute Booking – Booking received 45 days prior to departure</strong></td>
                  </tr>
                  <tr>
                     <td></td>
                     <td>Registration Amount Equal to Package Price</td>
                     <td>Full Payment</td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</section>
<!-- Deals and Discounts -->
<section id="blog" class="inverse">
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
                  <h3><?php echo $blog['State']['name'];?></h3>
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
<script type="text/javascript">
  /*START PACKAGE JS*/  
    $("#package-slider").owlCarousel({
        loop: true,
        nav: false,
        pagination:true,
        navigation:false,
        slideSpeed:1000,
        autoplay: true,
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
    /*END PACKAGE JS*/
</script>
<style type="text/css" media="screen">
.owl-stage-outer{
  height: 260px;
}  
.nav-item.active{
    border-bottom: 1px solid #800080;
    padding-bottom: 4px;
  }
</style>
