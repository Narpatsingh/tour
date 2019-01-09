<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <?php echo $this->Html->meta('favicon.ico', 'img/favicon.ico', array('type' => 'icon')); ?>
        <title>Silshine Tour Admin</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php
        echo $this->Html->css(
                array(
            'backend/style',
                ), array('inline' => false)
        );
        echo $this->Html->script(
                array(
            'backend/jquery-2.1.0.min',
            'backend/bootstrap.min',
            'lib/jquery.validate',
                ), array('inline' => false)
        );
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body class="loginBody">
        <div class="form-box">
            <?php echo $this->Session->flash(); ?>
            <?php
            $message = $this->Session->flash('auth');
            if (!empty($message)) {
                ?>
                <div class="alert alert-warning alert-dismissible" role="alert" style="margin-left:0px;padding-left:10px;">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <?php echo $message; ?>
                </div>
            <?php } ?>
        </div>
    <center class="margin-bottom20">
        <h2 style="color: #fff;"> Silshine Trip </h2>
        <?php //echo $this->Html->link($this->Html->image(getLogo(),array('style'=>'max-width:200px !important')), '/', array('escape' => false, 'class' => 'logo')) ?>
    </center>
    <?php echo $this->fetch('content'); ?>	
</body>
</html>
