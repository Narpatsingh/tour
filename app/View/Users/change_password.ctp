<?php
$this->assign('pagetitle', __('Change Password'));
$this->Custom->addCrumb(__('My Profile'), array('action' => 'profile'));
$this->Custom->addCrumb(__('Change Password'));
$this->start('top_links');

echo $this->Html->link('Back', array('controller' => $this->params['controller'], 'action' => 'profile'), array('icon' => 'back', 'class' => 'btn btn-default pull-right', 'escape' => false));

$this->end();

?>
<?php
echo $this->Form->create('User', array('id' => 'UserChangePasswordForm', 'class' => 'form-signin', 'inputDefaults' => array('dir' => 'ltl', 'class' => 'form-control', 'div' => array('class' => 'form-group required'))));

?>
<div class='box box-primary'>           
    <div class='box-body pad'>                
        <div class="row">
            <div class="col-md-12">
                <?php
                echo $this->Form->input('old_password', array('type' => 'password', 'placeholder' => 'Old Password'));
                echo $this->Form->input('new_password', array('type' => 'password', 'placeholder' => 'New Password'));
                echo $this->Form->input('confirm_password', array('type' => 'password', 'placeholder' => 'Confirm Password'));

                ?>

            </div>
        </div>
        <div>
            <?php
            echo $this->Form->submit(__('Change Password'), array('class' => 'btn btn-primary margin-right10', 'div' => false));
            echo $this->Html->link('Cancel', array('controller' => $this->params['controller'], 'action' => 'profile'), array('class' => 'btn btn-default', 'icon' => 'cancel'));
            ?>
        </div>
    </div>
</div>
<?php
echo $this->Form->setValidation(array(
    'Rules' => array(
        'old_password' => array(
            'required' => 1
        ),
        'new_password' => array(
            'required' => 1,
            'minlength' => 6,
            'maxlength' => 15
        ),
        'confirm_password' => array(
            'required' => 1,
            'equalTo' => "#UserConfirmPassword"
        )
    ),
    'Messages' => array(
        'old_password' => array(
            'required' => __('Please enter old password.')
        ),
        'new_password' => array(
            'required' => __('Please enter new password.'),
            'minlength' => __('Please enter password at least 6 characters.'),
            'maxlength' => __('Please enter password between 6 to 15 characters.')
        ),
        'confirm_password' => array(
            'required' => __('Please enter confirm password.'),
            'equalTo' => __('Please enter the same password as above.')
        )
    )
));

?>
<?php echo $this->Form->end(); ?>