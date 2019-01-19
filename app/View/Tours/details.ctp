
<title>Detail page</title>
<body id="page-top details-page">
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
               <a class="navbar-brand page-scroll TourLogo" href="index.php">
                  <h1>Silshine Trip</h1>
               </a>
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
            </ul>
          </div>
            <!-- /.navbar-collapse -->
         </div>
      </div>
   </div>
   <!-- /.container -->
</nav>
<section id="page-title" class="parallax" data-stellar-background-ratio="0.5" style="background-image: url(<?php echo $this->webroot.$tour['Tour']['img']; ?>);">
   <div class="title-info">
      <div class="container">
         <div class="row">
            <div class="col-xs-12">
               <div class="page-title text-center" id="Overview">
                  <h1>Details Single Page</h1>
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
                  <a class="nav-link js-scroll-trigger" href="#Overview">Overview</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="#Itinerary">Itinerary</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="#Highlights">Highlights</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="#Informaion">Informaion</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="#DatePrice">Date Price</a>
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
         <div class="col-lg-4 mx-auto">
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
                      <h5 style="color: chocolate;"> <?php echo __('No Itinerary found.') ?> </h5>
                  </div>
               <?php } else { ?>
                  <?php foreach ($tour['Itinerary'] as $itinerary) { ?>
                  <div class="col-md-12 col-sm-12">
                      <div class="desc">
                          <h3>Day <?php echo $itinerary['day']; ?></h3>
                          <h3>Title : <?php echo $itinerary['title']."(".$itinerary['km']."kms / ".$itinerary['hour']."hrs)"; ?></h3>
                          <p style="padding-right: 60px;"><b>Description : </b><?php echo $itinerary['description']; ?></p>
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
<section id="Informaion">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 mx-auto">
            <h2>Information</h2>
            <p class="lead">
               Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero odio fugiat voluptatem dolor, provident officiis, id iusto! Obcaecati incidunt, qui nihil beatae magnam et repudiandae ipsa exercitationem, in, quo totam.
            </p>
         </div>
      </div>
   </div>
</section>
<section id="DatePrice">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 mx-auto">
            <h2>Date Price</h2>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero odio fugiat voluptatem dolor, provident officiis, id iusto! Obcaecati incidunt, qui nihil beatae magnam et repudiandae ipsa exercitationem, in, quo totam.</p>
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
               <h1>Other Trips</h1>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-xs-6 col-md-4">
            <div class="post wow fadeInUp">
               <div class="post-thumb">
                  <a href="details.php">
                     <img src="<?php echo $this->webroot;?>img/blog/1.jpg" alt="" />
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
            </div>
            <!--end post-->
         </div>
         <div class="col-xs-6 col-md-4">
            <div class="post wow fadeInUp">
               <div class="post-thumb">
                  <a href="details.php">
                     <img src="<?php echo $this->webroot;?>img/blog/2.jpg" alt="" />
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
            </div>
            <!--end post-->
         </div>
         <div class="col-xs-6 col-md-4">
            <div class="post wow fadeInUp">
               <div class="post-thumb">
                  <a href="details.php">
                     <img src="<?php echo $this->webroot;?>img/blog/3.jpg" alt="" />
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
            </div>
            <!--end post-->
         </div>
         <div class="col-xs-6 col-md-4">
            <div class="post wow fadeInUp">
               <div class="post-thumb">
                  <a href="details.php">
                     <img src="<?php echo $this->webroot;?>img/blog/4.jpg" alt="" />
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
            </div>
            <!--end post-->
         </div>
         <div class="col-xs-6 col-md-4">
            <div class="post wow fadeInUp">
               <div class="post-thumb">
                  <a href="details.php">
                     <img src="<?php echo $this->webroot;?>img/blog/5.jpg" alt="" />
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
            </div>
            <!--end post-->
         </div>
         <div class="col-xs-6 col-md-4">
            <div class="post wow fadeInUp">
               <div class="post-thumb">
                  <a href="details.php">
                     <img src="<?php echo $this->webroot;?>img/blog/6.jpg" alt="" />
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
            </div>
            <!--end post-->
         </div>
      </div>
   </div>
</section>
