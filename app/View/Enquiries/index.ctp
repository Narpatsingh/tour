<?php
$formParamter = '';
$this->assign('pagetitle', __('Manage Enquiry'));
$this->Custom->addCrumb(__('Manage Enquiry'));
$this->start('top_links');
echo $this->Html->link(__('Add Enquiry'), array('controller' => $this->params['controller'], 'action' => 'add'),
    array('icon' => 'add', 'title' => __('Add Enquiry'), 'class' => 'btn btn-primary', 'escape' => false));


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


//echo $this->CustomForm->setSearchPanel($searchPanelArray);

?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-footer clearfix">

                <?php echo $this->element('paginationtop'); ?>
            </div>
            <div class="box-body table-responsive no-padding">
                <?php
                $startNo = (int)$this->Paginator->counter('{:start}');

                ?>
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <?php $fieldCount = 9; ?>

                        <th width="5%"> <?php echo __('Sr.'); ?> </th>
                        <th><?php echo $this->Paginator->sort('Customer.name', __('Name')); ?></th>
                        <th><?php echo $this->Paginator->sort('Customer.email', __('Email')); ?></th>
                        <th><?php echo $this->Paginator->sort('Customer.mobile', __('Mobile')); ?></th>
                        <th><?php echo $this->Paginator->sort('Customer.dob', __('DOB')); ?></th>
                        <th><?php echo $this->Paginator->sort('Customer.member', __('Member')); ?></th>
                        <th><?php echo $this->Paginator->sort('Enquiry.number_of_month', __('Month')); ?></th>
                        <th><?php echo $this->Paginator->sort('Enquiry.number_of_guest', __('Guest')); ?></th>
                        <th><?php echo $this->Paginator->sort('Enquiry.experience', __('Experience')); ?></th>
                        <th><?php echo $this->Paginator->sort('Enquiry.created', __('Added On')); ?></th>
                        <th><?php echo __('Actions'); ?></th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($enquiries)) { ?>
                        <tr>
                            <td colspan='<?php echo $fieldCount; ?>'
                                class='text-warning'><?php echo __('No User found.') ?>
							</td>
                        </tr>
                    <?php } else { ?>
                        <?php foreach ($enquiries as $enquiry): ?>
                            <tr>
                                <td> <?php echo $startNo++; ?> </td>
                                <td> <?php echo isset($enquiry['Customer']['name']) ? $enquiry['Customer']['name'] : ''; ?> </td>
                                <td> <?php echo isset($enquiry['Customer']['email']) ? $enquiry['Customer']['email'] : ''; ?> </td>
                                <td> <?php echo isset($enquiry['Customer']['mobile']) ? $enquiry['Customer']['mobile'] : ''; ?> </td>
                                <td> <?php echo isset($enquiry['Customer']['dob']) ? $enquiry['Customer']['dob'] : ''; ?> </td>
                                <td> <?php echo isset($enquiry['Customer']['member']) ? $enquiry['Customer']['member'] : ''; ?> </td>
                                <td> <?php echo isset($enquiry['Enquiry']['number_of_month']) ? $enquiry['Enquiry']['number_of_month'] : ''; ?> </td>
                                <td> <?php echo isset($enquiry['Enquiry']['number_of_guest']) ? $enquiry['Enquiry']['number_of_guest'] : ''; ?> </td>
                                <td> <?php echo isset($enquiry['Enquiry']['experience']) ? $enquiry['Enquiry']['experience'] : ''; ?> </td>
                                <td> <?php echo isset($enquiry['Enquiry']['created']) ? showdatetime($enquiry['Enquiry']['created']) : ''; ?> </td>
                                <td class="actions text-center">
                                <span class='text-left'>
                                    <?php
                                    echo $this->Html->link(__(''), array('action' => 'view', $enquiry['Enquiry']['id']),
                                        array(
                                            'icon' => 'view',
                                            'class' => 'no-hover-text-decoration',
                                            'title' => __('View Customer')
                                        ));
                                    if(!empty($enquiry['Customer']['package_id']) && empty($enquiry['Enquiry']['is_approved'])):
                                    echo $this->Html->link(__(''), array('action' => 'approve', $enquiry['Enquiry']['id']),
                                        array(
                                            'icon' => 'fa-check',
                                            'class' => 'no-hover-text-decoration',
                                            'title' => __('Approve Customer')
                                        ), __('Are you sure you want to approve selected Enquiry?'));
                                    echo $this->Html->link(__(''), array('action' => 'reject', $enquiry['Enquiry']['id']),
                                        array(
                                            'icon' => 'fa-close',
                                            'class' => 'no-hover-text-decoration',
                                            'title' => __('Reject Customer')
                                        ), __('Are you sure you want to reject selected Enquiry?'));                                    
                                    endif;
                                    if(!empty($enquiry['Enquiry']['is_approved']) && $enquiry['Enquiry']['is_approved']=='Yes'):
                                    echo $this->Html->link(__(''), array('controller'=>'files','action' => 'pdf', $enquiry['Enquiry']['id'],'file.pdf'),
                                        array(
                                            'icon' => 'fa-file',
                                            'target'=>'_blank',
                                            'class' => 'no-hover-text-decoration',
                                            'title' => __('View File')
                                        ));
                                    endif;
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

    });
</script>