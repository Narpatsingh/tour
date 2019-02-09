<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="img/logo2.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <title>SilShine Trip</title>

    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
    <!--Owl Carousel-->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300italic,400italic,700' rel='stylesheet' type='text/css'>

    <link href='https://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' type='text/css'>
    <?php
        echo $this->Html->css(
                array(
                    'bootstrap.min',
                    'slider',
                    'datepicker',
                    'animate',
                    'jquery.fancybox',
                    'owl.carousel',
                    'new_css/main.css',
                    'new_css/animate.css',
                    'new_css/responsive.css',
                    'style.css?'.time(),
                    'new_css/font-awesome.min.css',
                ), array('inline' => false)
        );
        echo $this->fetch('css');
    ?>

    <?php echo $this->Html->script(
                array(
            'jquery',
            'bootstrap.min',
            'lib/jquery-ui-1.11.4',
            'lib/jquery.validate',
            'jquery.easing.min',
            'wow',
            'jquery.mixitup.min',
            'jquery.fancybox.pack',
            'waypoints.min',
            'jquery.counterup.min',
            'owl.carousel.min',
            'jquery.stellar.min',
            'bootstrap-datepicker',
            'script',
            'scrolling-nav',
            'bootstrap-slider',
            'jquery.slimscroll',
            'custom.js?'.time(),
                ), array('inline' => false)
        );

        echo $this->fetch('script');    

    ?>    

</head>

    