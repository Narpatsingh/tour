<?php echo $this->Form->create('User', array('inputDefaults' => array('dir' => 'ltl', 'class' => 'form-control', 'div' => array('class' => 'form-group')))); ?>
<div class="form-box" id="login-box" style="margin-top: 0">
    <div class="header bg-danger fontBold"><?php echo __("Sign In") ?></div>
    <div class="body bg-gray">
        <?php
        echo $this->Form->input('email', array('placeholder' => 'E-mail Address', 'label' => false));
        echo $this->Form->input('password', array('placeholder' => 'Password', 'label' => false));

        echo '<div class="login-captcha">';
        //echo $this->Html->image(array('controller' => 'users', 'action' => 'getCaptcha'), array('id' => 'captcha_image'));
        //echo $this->Html->link('', 'javascript:void(0);', array('id' => 'reload', 'class' => 'captch-signin fa fa-refresh fa-2x', 'style' => ' margin-left: 30px;margin-top: 10px;position: absolute;'));
        //echo $this->Form->input('captcha', array('label' => false, 'autocomplete' => 'off', 'placeholder' => 'Captcha', 'value' => '', 'div' => false));
        echo '</div>';
        ?>


    </div>
    <div class="footer text-center bg-gray">
        <?php
        echo $this->Form->submit(' Sign in ', array('class' => 'btn bg-danger btn-block btn-primary', 'escape' => false, 'div' => false));
        ?>
    </div>
</div>
<?php
echo $this->Form->setValidation(array(
    'Rules' => array(
        'email' => array(
            'required' => 1,
            'email' => 1
        ),
        'password' => array(
            'required' => 1
        ),
        'captcha' => array(
            'required' => 1,
        ),
    ),
    'Messages' => array(
        'email' => array(
            'required' => __("Please enter Email Address"),
            'email' => __("Please enter valid Email Address"),
        ),
        'password' => array(
            'required' => __("Please enter password")
        ),
        'captcha' => array(
            'required' => __("Please enter captcha")
        )
    ),
));
?>
<?php echo $this->Form->end(); ?>

<script type="text/javascript">
    $(document).on('ready', function () {
        jQuery('#reload').click(function () {
            var captcha = jQuery("#captcha_image");
            captcha.attr('src', captcha.attr('src') + '?' + Math.random());
            return false;
        });
    });
</script>
