<?php
$formParamter = '';
$this->assign('pagetitle', __('Manage User'));
$this->Custom->addCrumb(__('Manage User'));
$this->start('top_links');
echo $this->Html->link(__('Add User'), array('controller' => $this->params['controller'], 'action' => 'add'),
    array('icon' => 'add', 'title' => __('Add User'), 'class' => 'btn btn-primary', 'escape' => false));


$this->end();
//generate search panel
$nameLabel = __('Name');
$emailLabel = __('Email');

$searchPanelArray = array(
    'name' => 'User',
    'options' => array(
        'id' => 'UserSearchForm',
        'url' => $this->Html->url(array('controller' => $this->params['controller'], 'action' => 'index', '', ''),
            true),
        'autocomplete' => 'off',
        'novalidate' => 'novalidate',
        'inputDefaults' => array(
            'dir' => 'ltl',
            'class' => 'form-control',
            'required' => false,
            'div' => array(
                'class' => 'form-group col-md-2'
            )
        )
    ),
    'searchDivClass' => 'col-md-6',
    'search' => array(
        'title' => 'Search User',
        'options' => array(
            'id' => 'UserSearchBtn',
            'class' => 'btn btn-primary margin-right10',
            'title' => 'Search User',
            'div' => false
        )
    ),
    'reset' => $this->Html->link(__('Reset Search'),
        array('controller' => $this->params['controller'], 'action' => 'index', 'all', '', ''),
        array('escape' => false, 'title' => __('Display the all the Users'), 'class' => 'btn btn-default')),
    'fields' => array(
        array(
            'name' => 'name',
            'options' => array(
                'label' => $nameLabel,
                'type' => 'text',
                'placeholder' => __('Enter name')
            )
        ),
        array(
            'name' => 'email',
            'options' => array(
                'label' => $emailLabel,
                'type' => 'text',
                'placeholder' => __('Enter email address')
            )
        ),
        array(
            'name' => 'status',
            'options' => array(
                'type' => 'select',
                'options' => array('active' => __('Active'), 'inactive' => __('Inactive')),
                'empty' => __('Select status')
            )
        )
    )
);


echo $this->CustomForm->setSearchPanel($searchPanelArray);

?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-footer clearfix">

                <?php echo $this->element('paginationtop'); ?>
            </div>
            <?php echo $this->Form->create('User', array(
                'class' => 'deleteAllForm',
                'url' => array('controller' => $this->params['controller'], 'action' => 'delete'),
                'id' => 'UserEditProfileForm',
                'data-confirm' => __('Are you sure you want to delete selected User ?')
            )); ?>
            <div class="box-body table-responsive no-padding">
                <?php
                $startNo = (int)$this->Paginator->counter('{:start}');

                ?>
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <?php $fieldCount = 9; ?>

                        <th width="5%"> <?php echo __('Sr.'); ?> </th>
                        <th><?php echo $this->Paginator->sort('User.name', __('Name')); ?></th>
                        <th><?php echo $this->Paginator->sort('User.email', __('Email')); ?></th>
                        <th><?php echo $this->Paginator->sort('User.phone_no', __('Phone No.')); ?></th>
                        <th><?php echo $this->Paginator->sort('Group.name', __('Group')); ?></th>
                        <th><?php echo $this->Paginator->sort('User.role', __('Role')); ?></th>
                        <th width="5%"><?php echo $this->Paginator->sort('User.status', __('Status')); ?></th>
                        <th><?php echo $this->Paginator->sort('User.created', __('Added On')); ?></th>
                        <th><?php echo __('Actions'); ?></th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($users)) { ?>
                        <tr>
                            <td colspan='<?php echo $fieldCount; ?>'
                                class='text-warning'><?php echo __('No User found.') ?>
							</td>
                        </tr>
                    <?php } else { ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td> <?php echo $startNo++; ?> </td>
                                <td> <?php echo isset($user['User']['name']) ? $user['User']['name'] : ''; ?> </td>
                                <td> <?php echo isset($user['User']['email']) ? $user['User']['email'] : ''; ?> </td>
                                <td> <?php echo isset($user['User']['phone_no']) ? $user['User']['phone_no'] : ''; ?> </td>
                                <td> <?php echo isset($user['Group']['name']) ? $user['Group']['name'] : ''; ?> </td>
                                <td> <?php echo isset($user['User']['role']) ? ucfirst($user['User']['role']) : ''; ?> </td>
                                <td class="text-center">
                                    <?php
                                    echo $this->Custom->getToggleButton(isset($user['User']['status']) ? $user['User']['status'] : '',
                                        'userStatusChange', array(
                                            'data-uid' => $user['User']['id'],
                                            'data-id' => 'userStatus_' . $user['User']['id']
                                        ), array('active', 'inactive'));
                                    //                                    echo isset($user['User']['status']) ? $user['User']['status'] : '';
                                    ?>
                                </td>
                                <td> <?php echo isset($user['User']['created']) ? showdatetime($user['User']['created']) : ''; ?> </td>
                                <td class="actions text-center">
                                <span class='text-left'>
                                    <?php
                                    echo $this->Html->link(__(''), array('action' => 'dashboard', $user['User']['id']),
                                        array(
                                            'icon' => 'fa-dashboard',
                                            'class' => 'no-hover-text-decoration',
                                            'title' => __('Dashboard')
                                        ));
                                    echo $this->Html->link(__(''), array('action' => 'edit', $user['User']['id']),
                                        array(
                                            'icon' => 'edit',
                                            'class' => 'no-hover-text-decoration',
                                            'title' => __('Edit User')
                                        ));
                                    echo $this->Html->link(__(''), array('action' => 'delete', $user['User']['id']),
                                        array(
                                            'icon' => 'delete',
                                            'class' => 'no-hover-text-decoration',
                                            'title' => __('Delete User')
                                        ), __('Are you sure you want to delete selected user?'));
                                    echo $this->Html->link(__(''), array('action' => 'password_reset', $user['User']['id']),
                                        array(
                                            'icon' => 'fa-key',
                                            'class' => 'no-hover-text-decoration',
                                            'title' => __('Reset password')
                                        ));
                                    ?>
                                </span>
                                </td>


                            </tr>
                        <?php endforeach; ?>
                    <?php } ?>
                    </tbody>
                </table>

            </div>
            <div class="box-footer clearfix">
                <?php echo $this->element('pagination'); ?>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('.userStatusChange').on('click', function () {
            var status = ($(this).hasClass('off')) ? 'active' : 'inactive';
            var $this = jQuery(this);
            var msg = ''
            if (status == 'inactive') {
                msg = 'Are you sure you want to deactivate the account?';
            }
            if (status == 'active') {
                msg = 'Are you sure you want to activate the account?';
            }
            if (confirm(msg)) {

                var uId = $(this).data('uid');
                jQuery.ajax({
                    url: BaseUrl + '<?php echo $this->params['controller']; ?>/change_status/' + uId + "/" + status,
                    type: 'post',
                    dataType: 'json',
                    success: function (response) {

                        if (response.status == 'success') {
                            $this.toggleClass('off');
                            if (status == 'active' && !$this.hasClass('btn-success')) {
                                $this.removeClass('btn-danger');
                                $this.addClass('btn-success');
                            } else {
                                $this.removeClass('btn-success');
                                $this.addClass('btn-danger');
                            }
                        }
//                        alert(response.message);
                    },
                    error: function (e) {

                    }
                });
            }
        });

    });
</script>