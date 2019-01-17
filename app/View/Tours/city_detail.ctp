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
<section id="page-title" class="parallax" data-stellar-background-ratio="0.5" style="background-image: url(img/blog/1.jpg);">
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
  </div><!--end title-info-->
</section>
<!-- Navigation -->



  <!-- Deals and Discounts -->
  
  <div class="container-1">
    <div class="row">
      <div class="col-xs-12">
       <div class="section-title text-center">
          <h1 class="visible-title">India</h1>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="col-md-9">
        <div class="row">

          <div class="col-xs-12">
            <?php foreach ($tour as $key => $value) {  ?>
              <div class="col-xs-6 col-sm-4 col-md-4">
                <div class="tour-item">
                    <div class="thumb">
                      <?php echo $this->Html->image($value['Tour']['img']); ?>
                    </div>
                    <div class="discount-info">
                        <div class="price-info">
                            <span class="sale-price">&#x20b9;<?php echo $value['Tour']['price']; ?></span>
                        </div>
                        <h3><?php echo $value['City']['name']; ?></h3>
                        <p><?php echo $value['Tour']['description']; ?></p>
                       <?php echo $this->Html->link(__('View Details'.'<i class="fa fa-long-arrow-right"></i>'), array('controller' => 'tours', 'action' => 'details',$value['Tour']['id']),array('escape' => false)); ?>
                    </div>
                </div>
              </div>
            <?php } ?> 
          </div>
        </div>
      </div>
      <div class="col-md-3">
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
      </div>
    </div>
  </div>
</div>


