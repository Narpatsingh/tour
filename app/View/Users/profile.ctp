<?php

$this->assign('pagetitle', __('My Profile'));
$this->Custom->addCrumb(__('My Profile'));
$this->start('top_links');
if (!empty($this->request->data['User'])) {
    echo $this->Html->link(__('Change Password'), array('controller' => $this->params['controller'], 'action' => 'change_password'), array('icon' => 'fa-lock', 'class' => 'btn btn-sm btn-primary', 'escape' => false, 'title' => __('Click here to change password')));
    echo $this->Html->link(__('Edit My Profile'), 'javascript:void(0)', array('icon' => 'fa-edit', 'class' => 'edit-profile btn btn-sm btn-sm btn-primary', 'escape' => false, 'title' => __('Click here to edit my profile')));
}
echo $this->Html->link(__('My Profile'), 'javascript:void(0)', array('icon' => 'fa-user', 'class' => 'profile hidden btn btn-sm btn-primary', 'escape' => false, 'title' => __('Click here to edit my profile')));

$this->end();

?>
<div class="box box-primary">
    <?php echo $this->Form->create('User', array('id' => 'UserEditProfileForm', 'url' => array('controller' => 'users', 'action' => 'profile'), 'type' => 'file', 'inputDefaults' => array('dir' => 'ltl', 'class' => 'form-control', 'div' => array('class' => 'form-group')))); ?>
    <div class="box-body box-content overflow-hide-break">
        <div class="userProfilePage userViewPage profile <?php echo isset($validationErrors) ? 'hidden' : '' ?>">
            <?php if (empty($this->request->data['User'])) { ?>
                <?php echo $this->Html->showInfo(__('Invalid User.'), array('type' => 'warning')) ?>
            <?php } else { ?>

                <?php
                $leftTitle = __('User Information');
                $first_name_lbl = __('User');
                $sec_name_lbl = __('');
                if (empty($user['User']['parent_id'])) {
                    $leftTitle = __('User Information');
                    $first_name_lbl = __('User Name');
                    $sec_name_lbl = __('Contact Name');
                }

                ?>
                <?php if (empty($user['User']['parent_id'])): ?>
                    <div class="col-xs-12 col-sm-3">
                        <?php echo $this->Html->image(getUserPhoto($user['User']['id'], $user['User']['photo'], false, 200), array('class' => 'thumbnail img-responsive')) ?>
                    </div>
                <?php endif; ?>
                <div class="col-xs-12 col-sm-<?php echo empty($user['User']['parent_id']) ? '9' : '12' ?> detailBox">
                    <div class="col-sm-6 innerBox innderBoxLeft">
                        <ul>
                            <li class="LeftTitle">
                                <?php echo $leftTitle; ?>
                            </li>
                            <li class="firstName">
                                <?php echo $user['User']['first_name']." ". $user['User']['last_name']; ?>
                            </li>
                            <?php if (empty($user['User']['parent_id'])): ?>
                                <li class="emailAddress">
                                    <?php echo $user['User']['email']; ?>
                                </li>
                                <li class="phoneNo">
                                    <?php echo showPhoneNo($user['User']['phone_no']); ?>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty($user['User']['parent_id'])): ?>
                                <li class="userType">
                                    <?php echo getLoginRole($user['User']['role'], $user['User']['user_type']); ?>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>

                </div>
            <?php } ?>
        </div>
        <div class="edit-profile <?php echo isset($validationErrors) ? '' : 'hidden' ?>">
            <div class="col-md-6 col-sm-6 no-padding">
                <?php
                echo $this->Form->input('id', array('type' => 'hidden'));

                echo $this->Form->input('first_name', array('required' => true, 'label' => __('First name'), 'placeholder' => __('First name')));


                echo $this->Form->input('last_name', array('required' => true, 'label' => __('Last name'), 'placeholder' => __('Last name')));

                echo $this->Form->input('email', array('required' => true, 'placeholder' => __('Email')));

                echo $this->Form->input('phone_no', array(
                    'placeholder' => 'Phone Number',
                    'class' => 'form-control phoneNumber phoneno',
                    'label' => __('Phone No'),
                    'type' => 'text',
                    'div' => array('class' => 'required form-group')));

                ?>
            </div>
            <div class="col-md-6 col-sm-6 no-rightpadding">

                <?php if (isDisplayFields()): ?>
                    <label class="form-group" style="margin-bottom: 10px">
                        <?php

                        echo __('Profile Picture');


                        ?>
                    </label>
                    <div class="form-group row">
                        <?php
                        if (empty($this->request->data['User']['id'])) {
                            $this->request->data['User']['id'] = 0;
                        }
                        if (empty($this->request->data['User']['photo'])) {
                            $this->request->data['User']['photo'] = '';
                        }
                        echo "<div id='UserProfileImageId' class='col-md-4'>" . $this->Html->image(getUserPhoto($this->request->data['User']['id'], $this->request->data['User']['photo']), array('class' => 'thumbnail img-responsive', 'style' => 'max-width: 250px')) . "</div>";
                        echo $this->Form->input('photo', array('class' => '', 'required' => false, 'label' => false, 'type' => 'file', 'before' => '<label for="UserPhoto" class=""><i class="">&nbsp;</i>' . __('Browse Photo') . '</label>', 'div' => array('class' => 'col-md-10 form-group')));

                        ?>
                        <div for="userProfileImage" generated="true" class="error" style="display: none">
                            <span class="errorDV"> </span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="edit-profile <?php echo isset($validationErrors) ? '' : 'hidden' ?>">
                <?php
                echo $this->Form->submit(__('Save'), array('class' => 'btn btn-primary margin-right10', 'div' => false));
                echo $this->Html->link('Cancel', array('controller' => $this->params['controller'], 'action' => 'profile'), array('icon' => 'cancel', 'class' => 'btn btn-default'));

                ?>
            </div>
        </div>
    </div>

    <?php
    echo $this->Form->setValidation(array(
        'Rules' => array(
            'email' => array(
                'required' => 1,
                'email' => 1
            ),
            'first_name' => array(
                'minlength' => 2,
                'maxlength' => 50,
                'required' => 1
            ),
            'last_name' => array(
                'minlength' => 2,
                'maxlength' => 50
            ),
            'photo' => array(
                'accept' => "jpg|jpeg|gif|png",
            ),
            'address' => array(
                'required' => 1,
                'minlength' => 2,
                'maxlength' => 500
            ),
            'country_id' => array(
                'required' => 1
            ),
            'state_id' => array(
                'required' => 1
            ),
            'city_id' => array(
                'required' => 1
            ),
            'pincode' => array(
                'maxlength' => 5,
                'required' => 1,
                'matchNumber' => 5
            ),
            'phone_no' => array(
                'required' => 1,
            )
        ),
        'Messages' => array(
            'email' => array(
                'required' => __("Please enter Email Address"),
                'email' => __("Please enter valid Email Address"),
            ),
            'first_name' => array(
                'minlength' => __('Please enter first name with minimum 2 characters.'),
                'maxlength' => __('Please enter first name with maximum 2 characters.'),
                'required' => __('Please enter first name.')
            ),
            'last_name' => array(
                'minlength' => __('Please enter last name with minimum 2 characters.'),
                'maxlength' => __('Please enter last name with maximum 2 characters.')
            ),
            'photo' => array(
                'accept' => __('Please select valid photo with "jpg|jpeg|gif|png" extension'),
            ),
            'address' => array(
                'required' => __('Please enter address.'),
                'minlength' => __('Please enter address having minimum 2 characters.'),
                'maxlength' => __('Please enter address having maximum 500 characters.')
            ),
            'country_id' => array(
                'required' => __('Please select country')
            ),
            'state_id' => array(
                'required' => __('Please select state')
            ),
            'city_id' => array(
                'required' => __('Please select city')
            ),
            'pincode' => array(
                'maxlength' => __('Please enter valid zip code'),
                'required' => __('Please enter zip code'),
                'matchNumber' => __('Please enter valid zip code')
            ),
            'phone_no' => array(
                'required' => __('Please enter Mobile number'),
            )
        )
    ));

    ?>
    <?php echo $this->Form->end(); ?>
</div>
<script type='text/javascript'>
    jQuery(document).ready(function () {
        jQuery('a.profile').on('click', function () {
            jQuery('.edit-profile').addClass('hidden');
            jQuery('.profile,a.edit-profile').removeClass('hidden');
            jQuery(this).addClass('hidden');
        });
        jQuery('a.edit-profile').on('click', function () {
            jQuery('.profile').addClass('hidden');
            jQuery('a.profile').removeClass('hidden');
            jQuery('.edit-profile').removeClass('hidden');
            jQuery(this).addClass('hidden');
        });
    });
</script>