<?php
/**
 * @var $this view
 */
$formParamter = '';
$this->assign('pagetitle', __('%s User', $dbOpration));
$this->Custom->addCrumb(__('%s User', $dbOpration));

$this->start('top_links');

echo $this->Html->link(__('Back'), array('action' => 'index'), array('icon' => 'back', 'class' => 'btn btn-default', 'escape' => false));
$this->end();


/**
 * set logo title,image
 */


$id = '';
$photo = '';
if (isset($this->request->data['User']['id'])) {
    $id = $this->request->data['User']['id'];
    $photo = isset($this->request->data['User']['photo']) ? $this->request->data['User']['photo'] : '';
}
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $this->Form->create('User', array('id' => 'UserEditProfileForm', 'type' => 'file', 'inputDefaults' => array('dir' => 'ltl', 'class' => 'form-control', 'div' => array('class' => 'form-group')))); ?>
                <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
                <div class="row no-margin">
                    <div class="col-md-4">
                        <?php
                        echo $this->Form->input('first_name', array('tabindex' => 1,'placeholder' => __('First Name'), 'label' => __('First Name')));
                        echo $this->Form->input('email', array('tabindex' => 3,'placeholder' => __('Email'), 'label' => __('Email')));
                        if ($dbOpration == 'Add'):
                            echo $this->Form->input('password', array('tabindex' => 5,'placeholder' => __('Password'), 'label' => __('Password')));
                            echo $this->Form->input('confirm_password', array('tabindex' => 6,'type' => 'password', 'placeholder' => __('Confirm Password'), 'label' => __('Confirm Password')));
                        else :
                            ?>
                            <div class="">
                                <label class="check-in">
                                    <?php echo $this->Form->checkbox('passwordChk', array('id' => 'UserPasswordChk', 'hiddenField' => false, 'checked' => '')) ?>
                                    <?php echo __('I want to change password.') ?>
                                </label>
                            </div>
                            <div class="historty" id="changePassword" style="display: none">
                                <?php
                                //echo $this->Form->input('old_password', array('tabindex' => 5,'type' => 'password', 'placeholder' => 'Old Password'));
                                echo $this->Form->input('password', array('tabindex' => 6,'type' => 'password', 'placeholder' => 'New Password'));
                                echo $this->Form->input('confirm_password', array('tabindex' => 7 , 'type' => 'password', 'placeholder' => 'Confirm Password'));
                                ?>
                            </div>
                        <?php endif;?>

                    </div>
                    <div class="col-md-4">
                        <?php
                        echo $this->Form->input('last_name', array('tabindex' => 2,'required' => false, 'placeholder' => __('Last Name'), 'label' => __('Last Name'), 'div' => array('class' => 'required form-group')));
                        echo $this->Form->input('phone_no', array('tabindex' => 4,'placeholder' => 'Phone No', 'class' => 'form-control phoneNumber phoneno', 'div' => array('class' => 'required')));
//                        echo $this->Form->input('role', array('tabindex' => 6,'type' => 'select','empty' => 'Select User Role', 'class' => 'form-control', 'div' => array('class' => 'required')));
                        echo $this->element('backend/logoDiv', array('id' => $id, 'photo' => $photo, 'logoTitle' => __('Profile Picture')));

                        ?>
                    </div>
                    <div class="col-md-4">
                        <?php
                        echo $this->Form->input('email_config', array('required' => false,'placeholder' => __('Email Config'), 'label' => __('Email Config')));
                        echo $this->Form->label('email_config_label','For ex. your.domain:your.port/imap/ssl',array('style' => 'color:gray;'));
                        echo $this->Form->input('email_address', array('tabindex' => 9,'placeholder' => __('Email address'), 'label' => __('Email Address')));
                        echo $this->Form->input('email_password', array('type' => 'password','value'=>'','tabindex' => 10,'placeholder' => __('Email password'), 'label' => __('Email Password')));
                        ?>
                    </div>
                </div>
                <div class="form-action">
                    <?php
                    echo $this->Form->submit(__('Save'), array('class' => 'btn btn-primary margin-right10', 'div' => false));
                    echo $this->Html->link('Cancel', array('action' => 'index'), array('class' => 'btn btn-default', 'icon' => 'cancel'));

                    ?>
                </div>
                <?php
                $arrValidation = array(
                    'Rules' => array(
                        'first_name' => array(
                            'minlength' => 2,
                            'maxlength' => 50,
                            'required' => 1,
                            'alphabates' => 1
                        ),
                        'last_name' => array(
                            'minlength' => 2,
                            'maxlength' => 50,
                            'required' => 1,
                            'alphabates' => 1
                        ),
                        'email' => array(
                            'required' => 1,
                            'email' => 1
                        ),

                        'address' => array(
                            'maxlength' => 150,
                            'required' => 1
                        ),
                        'photo' => array(
                            'accept' => 'jpg|jpeg|png|bmp|gif'
                        ),
                        'old_password' => array(
                            'required' => 1,
                        ),
                        'password' => array(
                            'required' => 1,
                            'minlength' => 6,
                            'maxlength' => 15
                        ),
                        'confirm_password' => array(
                            'required' => 1,
                            'equalTo' => "#UserPassword"
                        ),
                        'phone_no' => array(
                            'required' => 1
                        ),
//                        'role' => array(
//                            'required' => 1
//                        )
                    ),
                    'Messages' => array(
                        'first_name' => array(
                            'minlength' => __('Please enter first name with minimum 2 character.'),
                            'maxlength' => __('Please enter first name between 2 to 50 character.'),
                            'required' => __('Please enter first name'),
                            'alphabates' => __('Please enter alphabates only')
                        ),
                        'last_name' => array(
                            'minlength' => __('Please enter last name with minimum 2 character.'),
                            'maxlength' => __('Please enter last name between 2 to 50 character.'),
                            'required' => __('Please enter last name'),
                            'alphabates' => __('Please enter alphabates only')
                        ),
                        'email' => array(
                            'required' => __('Please enter email address'),
                            'email' => __('Please enter valid email address')
                        ),

                        'address' => array(
                            'maxlength' => __('Please enter address having maximum 150 characters.'),
                            'required' => __('Please enter address')
                        ),
                        'photo' => array(
                            'accept' => __('Please choose files having jpg, jpeg, png, bmp, gif extension.')
                        ),
                        'old_password' => array(
                            'required' => "Please enter old password"
                        ),
                        'password' => array(
                            'required' => "Please enter password",
                            'minlength' => "Please enter password at least 6 characters.",
                            'maxlength' => "Please enter password between 6 to 15 characters."
                        ),
                        'confirm_password' => array(
                            'required' => "Please enter confirm password",
                            'equalTo' => "Please enter the same password as above."
                        ),
                        'phone_no' => array(
                            'required' => "Please enter phone number",
                        ),
//                        'role' => array(
//                            'required' => "Please select user role",
//                        )
                    )
                );

                echo $this->Form->setValidation($arrValidation);
                echo $this->Form->end();

                ?>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    jQuery(document).ready(function () {
        //remove 'Email Address already Exist.' message
        jQuery('#UserEmail').focusout(function () {
            jQuery('.error-message').remove();
        });

        slider();
        jQuery('#UserPasswordChk').on('click', function () {
            slider();
        });

    });
    function slider() {
        if ($('#UserPasswordChk').is(":checked")) {
            jQuery('#changePassword').slideDown();
        } else {
            jQuery('#changePassword').slideUp();
        }
    }
</script>
