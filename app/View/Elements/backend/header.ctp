<?php $logUserName = $this->Session->read('Auth.User.name');?>
<header class="header">
    <div class="setCenterText">
        <?php echo Configure::read("Site.Name");?>
    </div>

    <?php
    echo $this->Html->link($this->Html->image(getLogo(), array('class' => 'img-responsive img-display')), "/",array('escape' => false, 'class' => 'logo'));
    ?>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <?php
                        echo $this->Html->image(getUserPhoto($this->Session->read('Auth.User.id'),$this->Session->read('Auth.User.photo'), false, false), array('class' => 'img-circle'));
                        ?>
                        <span><?php echo $logUserName ?> <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- Admin image -->
                        <li class="user-header bg-danger">
                            <?php
                            echo $this->Html->image(getUserPhoto($this->Session->read('Auth.User.id'),$this->Session->read('Auth.User.photo'), false, false), array('class' => 'img-circle'));
                            ?>
                            <p>
                                <?php echo $logUserName; ?>
                                <small>
                                    <?php
                                    $lastLoginDate = str_replace('k', 'sup',
                                        showdatetime($this->Session->read('Auth.User.last_login_time'), 'N/A',
                                            'd<k>S</k>M,Y H:i:s'));
                                    ?>
                                    <?php //echo ($lastLoginDate == 'N/A') ? __('First Time Login') : __('Last login: ') . $lastLoginDate ?>
                                </small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-12 text-center">
                                <?php echo $this->Html->link('Change Password',
                                    array('controller' => 'users', 'action' => 'change_password'),
                                    array('class' => 'no-hover-text-decoration')); ?>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?php echo $this->Html->link('Profile',
                                    array('controller' => 'users', 'action' => 'profile'),
                                    array('class' => 'btn btn-default btn-flat')); ?>
                            </div>
                            <div class="pull-right">
                                <?php echo $this->Html->link('Log out',
                                    array('controller' => 'users', 'action' => 'logout'),
                                    array('class' => 'btn btn-default btn-flat')) ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>