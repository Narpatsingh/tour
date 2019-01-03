<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <title>Tour Management </title>

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
                    'style',
                ), array('inline' => false)
        );
        echo $this->fetch('css');
    ?>    

</head>

    