<?php
$formParamter = '';
$this->assign('pagetitle', __('Manage Enquiry'));
$this->Custom->addCrumb(__('Manage Enquiry'));
$this->start('top_links');
echo $this->Html->link(__('Add Enquiry'), '#',
    array('icon' => 'add', 'title' => __('Add Enquiry'), 'class' => 'btn btn-primary','data-toggle'=>'modal','data-target'=>"#commonModel",'escape' => false));


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
                        <?php $fieldCount = 15; ?>

                        <th width="5%"> <?php echo __('Sr.'); ?> </th>
                        <th><?php echo $this->Paginator->sort('Customer.name', __('Name')); ?></th>
                        <th><?php echo $this->Paginator->sort('Customer.email', __('Email')); ?></th>
                        <th><?php echo $this->Paginator->sort('Customer.mobile', __('Mobile')); ?></th>
                        <th><?php echo $this->Paginator->sort('Customer.dob', __('DOB')); ?></th>
                        <th><?php echo $this->Paginator->sort('Customer.member', __('Member')); ?></th>
                        <th><?php echo $this->Paginator->sort('Enquiry.number_of_month', __('Month')); ?></th>
                        <th><?php echo $this->Paginator->sort('Enquiry.number_of_guest', __('Guest')); ?></th>
                        <th><?php echo $this->Paginator->sort('Enquiry.experience', __('Experience')); ?></th>
                        <th><?php echo $this->Paginator->sort('Enquiry.time_of_travel', __('Time Of Travel')); ?></th>
                        <th><?php echo $this->Paginator->sort('Enquiry.travel_duration', __('Travel Duration')); ?></th>
                        <th><?php echo $this->Paginator->sort('Enquiry.destination', __('Destination')); ?></th>
                        <th><?php echo $this->Paginator->sort('Enquiry.special_requirements', __('Special Requirements')); ?></th>
                        <th><?php echo $this->Paginator->sort('Enquiry.created', __('Added On')); ?></th>
                        <th><?php echo __('Actions'); ?></th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($enquiries)) { ?>
                        <tr>
                            <td colspan='<?php echo $fieldCount; ?>'
                                class='text-warning'><?php echo __('No record found.') ?>
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
                                <td> <?php echo isset($enquiry['Enquiry']['time_of_travel']) ? $enquiry['Enquiry']['time_of_travel'] : ''; ?> </td>
                                <td> <?php echo isset($enquiry['Enquiry']['travel_duration']) ? $enquiry['Enquiry']['travel_duration'] : ''; ?> </td>
                                <td> <?php echo isset($enquiry['City']['name']) ? $enquiry['City']['name'] : ''; ?> </td>
                                <td> <?php echo isset($enquiry['Enquiry']['special_requirements']) ? $enquiry['Enquiry']['special_requirements'] : ''; ?> </td>
                                
                                <td> <?php echo isset($enquiry['Enquiry']['created']) ? showdatetime($enquiry['Enquiry']['created']) : ''; ?> </td>
                                <td class="actions text-center">
                                <span class='text-left'>
                                    <?php
                                    echo $this->Html->link(__(''), array('action' => 'view', $enquiry['Enquiry']['id']),
                                        array(
                                            'icon' => 'view',
                                            'class' => 'no-hover-text-decoration',
                                            'title' => __('View Enquiry')
                                        ));

                                    echo $this->Html->link(__(''), array('action' => 'delete', $enquiry['Enquiry']['id']), array('icon'=>'delete','title' => __('Click here to delete this Enquiry Detail')), __('Are you sure you want to delete Enquiry Detail?'));
                                    
                                    if(empty($enquiry['Customer']['package_id'])){
                                    echo $this->Html->link(__(''), array('controller' => 'customers','action' => 'edit', $enquiry['Customer']['id']),
                                        array(
                                            'icon' => 'fa-user',
                                            'class' => 'no-hover-text-decoration',
                                            'title' => __('Update Customer Details')
                                        ));
                                    }

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
                                    /*if(!empty($enquiry['Enquiry']['is_approved']) && $enquiry['Enquiry']['is_approved']=='Yes'):
                                    echo $this->Html->link(__(''), array('controller'=>'files','action' => 'pdf', $enquiry['Enquiry']['id'],'file.pdf'),
                                        array(
                                            'icon' => 'fa-file',
                                            'target'=>'_blank',
                                            'class' => 'no-hover-text-decoration',
                                            'title' => __('View Invoice')
                                        ));
                                    echo $this->Html->link(__(''), array('controller'=>'files','action' => 'receipt', $enquiry['Enquiry']['id'],'file.pdf'),
                                        array(
                                            'icon' => 'fa-file-text-o',
                                            'target'=>'_blank',
                                            'class' => 'no-hover-text-decoration',
                                            'title' => __('View Receipt')
                                        ));
                                    endif;*/
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
<div class="modal fade commonModel" id="commonModel" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" style="padding: 10px;">&times;</button>
            <div class="modal-header Enquiry_header">
                <h3 class="modal-title">Add Enquiry</h3>
            </div>
            <div class="modal-body audit-scroll">
                <?php echo $this->Form->create('Enquiry',array('controller'=>'enquiries','action'=>'add/popup')); ?>
            
                <div class="holiday_Guest mt-3 mb-3 px-3 py-3">
                    <input type="text" data-role="none" name="travel_date"  id="travel_date" placeholder="Travel Date" class="mr-3 mb-3">
                    <input type="text" data-role="none" name="number_of_guest" placeholder="Number of guest " class="mb-3">
                    <input type="text" data-role="none" name="travel_duration" placeholder="Travel Duration" class="mr-3 mb-3">
                    <!-- <input type="text" data-role="none" name="time_of_travel" id="time_of_travel" placeholder="Time Of Travel" class="mb-3"> -->
                    <?php echo $this->Form->input('city_id',array('label' => false,'data-role'=>"none",'class' => 'mr-3 mb-3','style'=>'width: 100%;','empty' => __('Select City'), 'div' => false)); ?>
                    <?php echo $this->Form->input('destination',array('label' => false,'type'=>'select','data-role'=>"none",'class' => 'mr-3 mb-3','style'=>'width: 100%;','empty' => __('Select Package'), 'div' => false)); ?>
                    <textarea data-role="none" name="special_requirements" class=" textarea mt-3" placeholder="Special Requirements"></textarea>
                </div>
                <div class="contact_detail mt-3 mb-3 px-3 py-3">
                    <p class="font-bold">Your Contact Detail</p>
                    <input type="text" data-role="none" name="firstname" placeholder="First Name" class="mr-3 mb-3" required>
                    <input type="text" data-role="none" name="lastname" placeholder="Last name" class="mb-3" required>
                    <input type="number" data-role="none" name="mobile" placeholder="Mobile Number" class="mr-3 mb-3" required>
                    <input type="email" data-role="none" name="email" placeholder="Email" class=" mb-3" required>
                </div>  
                
            </div>     
            <div class="modal-footer">
                 <div class="send_enquiry">
                    <?php echo $this->Form->submit(__('Save'), array('class' => 'btn btn-primary', 'div' => false)); ?>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>                
            </div>
        </div>       
        <?php echo $this->Form->end(); ?> 
    </div>
</div>
<style type="text/css">
    input::-webkit-input-placeholder,
    textarea::-webkit-input-placeholder {
        font-size: 15px;
        line-height: 3;
    }
</style>
<script type="text/javascript">
    jQuery(document).ready(function () {
        var BaseUrl = '<?php echo $this->Html->url('/', true) ?>';
        $("#EnquiryCityId").on('change',function() {
            var id = $(this).val();
            jQuery.ajax({
                url: BaseUrl + 'citys/get_tours/' + id,
                type: 'post',
                dataType: 'json',
                success: function (html) {
                    $("#EnquiryDestination option").remove();
                    $('#EnquiryDestination').append($("<option></option>").attr("value","").text("Select Package"));
                    $.each(html, function(key, value) {
                        $('<option>').val('').text('select');
                        $('<option>').val(key).text(value).appendTo($("#EnquiryDestination"));
                    });
                },
                error: function (e) {

                }
            });
        });
        $("#travel_date").datepicker( {
            format: "yyyy-M-dd",
        });
    });
</script>