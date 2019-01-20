<?php $analyticParams = isset($this->params['named']['type']) ? 'type:' . $this->params['named']['type'] : ''; ?>

<?php
$sideBarCheck = isset($_COOKIE['sidebar']) ? $_COOKIE['sidebar'] : 0;
?>
<aside class="left-side sidebar-offcanvas <?php echo !empty($sideBarCheck) ? 'collapse-left' : '' ?>">
    <section class="sidebar">
<div class="user-panel">
        <ul class="sidebar-menu">
            <?php if ($this->Session->read("Auth.User.role") == 'admin'): ?>                				
				<li class="<?php echo $this->Html->getActiveOpenClass(array('states')) ?>">
                    <?php echo $this->Html->link(__('State Management'),array('controller' => 'states', 'action' => 'index'), array('icon' => 'fa fa-building ')) ?>
                </li>
                <li class="<?php echo $this->Html->getActiveOpenClass(array('citys')) ?>">
                    <?php echo $this->Html->link(__('City Management'),array('controller' => 'citys', 'action' => 'index'), array('icon' => 'fa fa-building ')) ?>
                </li>
                <li class="<?php echo $this->Html->getActiveOpenClass(array('hotels')) ?>">
                    <?php echo $this->Html->link(__('Hotel Management'),array('controller' => 'hotels', 'action' => 'index'), array('icon' => 'fas fa-hotel ')) ?>
                </li>
                <li class="<?php echo $this->Html->getActiveOpenClass(array('tours')) ?>">
                    <?php echo $this->Html->link(__('Tour Management'),array('controller' => 'tours', 'action' => 'index'), array('icon' => 'fa fa-plane ')) ?>
                </li>
                <li class="<?php echo $this->Html->getActiveOpenClass(array('customers')) ?>">
                    <?php echo $this->Html->link(__('Customer Management'),array('controller' => 'customers', 'action' => 'index'), array('icon' => 'fa-user ')) ?>
                </li>
                <li class="treeview <?php echo $this->Html->getActiveClass(array('bus_details','train_details','flight_details'),array('index','add','edit','view'), 'all') ?>">
                    <?php echo $this->Html->link('Travel Management', 'javascript:void(0)',array('hasSubMenu' => true, 'span' => true, 'icon' => 'fa fa-plane')); ?>
                    <ul class="treeview-menu">
                        <li class="<?php echo $this->Html->getActiveClass(array('bus_details'), array('index','add','edit','view')) ?>">
                            <?php echo $this->Html->link(__('Bus Details'),array('controller' => 'bus_details', 'action' => 'index'),array('icon' => 'fa fa-bus')); ?>
                        </li>
                        <li class="<?php echo $this->Html->getActiveClass(array('train_details'),array('index','add','edit','view')) ?>">
                            <?php echo $this->Html->link(__('Train Details'),array('controller' => 'train_details', 'action' => 'index'),array('icon' => 'fa fa-train')); ?>
                        </li>
                        <li class="<?php echo $this->Html->getActiveClass(array('flight_details'),array('index','add','edit','view')) ?>">
                            <?php echo $this->Html->link(__('Flight Details'),array('controller' => 'flight_details', 'action' => 'index'),array('icon' => 'fa fa-fighter-jet')); ?>
                        </li>                                               
                    </ul>
                </li> 
                <li class="<?php echo $this->Html->getActiveOpenClass(array('enquiries')) ?>">
                    <?php echo $this->Html->link(__('Enquiries Management'),array('controller' => 'enquiries', 'action' => 'index'), array('icon' => 'fa-pencil ')) ?>
                </li>  
                <li class="<?php echo $this->Html->getActiveOpenClass(array('bookings')) ?>">
                    <?php echo $this->Html->link(__('Booking Management'),array('controller' => 'bookings', 'action' => 'index'), array('icon' => 'fa-file ')) ?>
                </li>                 
				<li class="<?php echo $this->Html->getActiveOpenClass(array('')) ?>">
					<?php echo $this->Html->link(__('Audit Log'),array('controller' => 'reports', 'action' => 'audit_log'), array('icon' => 'fa-book ')) ?>
				</li>				
            <?php endif; ?>    

            <li class="<?php echo $this->Html->getActiveClass(array('users'), 'logout') ?>">
                <?php echo $this->Html->link(__('Logout'),
                    array('controller' => 'users', 'action' => 'logout'),
                    array('icon' => 'fa fa-sign-out')); ?>
            </li>
        </ul>
    </section>
</aside>