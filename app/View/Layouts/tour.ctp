<?php 
if(Configure::read("Site.Status") == 'true'){ 
  if($this->Session->read('Auth.User.id')){
    echo $this->element('tour_header');  
    $tour_detail=array();
    echo $this->fetch('content'); 
    echo $this->element('tour_footer'); 
  }else{?>
  <!doctype html>
  <title>Site Maintenance</title>
  <style>
    body { text-align: center;background: #1B7B98; }
    h1 { font-size: 50px;color: gold; }
    body { font: 20px Helvetica, sans-serif; color: #333; }
    article { display: block; text-align: left; width: 650px; margin: 0 auto; }
    a { color: #dc8100; text-decoration: none; }
    a:hover { color: #333; text-decoration: none; }
    p {color: gold;}
  </style>

  <article>
      <h1>We&rsquo;ll be back soon!</h1>
      <div>
          <p>Sorry for the inconvenience but we&rsquo;re performing some maintenance at the moment. If you need to you can always contact us, otherwise we&rsquo;ll be back online shortly!</p>
          <p>&mdash; The Team</p>
      </div>
  </article>
  <?php }
} else {
  	echo $this->element('tour_header');  
    $tour_detail=array();
    echo $this->fetch('content');	
    echo $this->element('tour_footer'); 
} ?>
