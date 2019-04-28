    <?php
    $type = empty($edit) ? 'Add' : 'Edit';
    $this->assign('pagetitle', __('%s Hotel',$type));
    $this->Custom->addCrumb(__('Hotels'),array('action'=>'index'));
    $this->Custom->addCrumb(__('%s Hotel',$type));
    $this->start('top_links');
    echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
    $this->end();
    $photo = '';
    if (isset($this->request->data['Hotel']['id'])) {
        $photo = isset($this->request->data['Hotel']['photo']) ? $this->request->data['Hotel']['photo'] : '';
    }
    ?>
    <div class="box box-primary">
    	<div class="overflow-hide-break">
    		<?php echo $this->Form->create('Hotel', array('class' => 'form-validate multiple_save','type'=>'file')); ?>
    		<div class="box-body box-content">
                <div class="row no-margin">
                    <div class="col-md-6">
        			<?php
        			echo $this->Form->input('id',array('type'=>'hidden'));
        			echo $this->Form->input('state_id',array('label' => __('State'), 'class' => 'form-control','options'=>$states,'empty' => __('Select State'), 'div' => array('class' => 'form-group required')));
                    echo $this->Form->input('city_id',array('label' => __('City'), 'class' => 'form-control','options'=>$city,'empty' => __('Select City'), 'div' => array('class' => 'form-group required')));
        			echo $this->Form->input('name',array('class' => 'form-control', 'div' => array('class' => 'form-group')));?>
<?php 
                    echo $this->Form->input('contact_no', array(
                        'placeholder' => 'Contact Number',
                        'class' => 'form-control',
                        'label' => __('Contact Number'),
                        'type' => 'text',
                        'div' => array('class' => 'required form-group')));
?>                    
                    <label class="form-group" style="margin-bottom: 10px">Hotel Photo</label>
                        <div class="form-group row">
                            <div id='photoId' class='col-md-6'>
                                <?php if(!empty($photo)){
                                    echo $this->Html->image('../'.$photo, array('class' => 'thumbnail img-responsive', 'style' => 'width: 300px;height: 220px;'));
                                }else{
                                    echo $this->Html->image(NO_IMAGE, array('class' => 'thumbnail img-responsive', 'style' => 'max-width: 250px'));
                                }?>
                            </div>
                            <?php echo $this->Form->input('photo', array('required' => false, 'label' => false, 'type' => 'file', /*'before' => '<label for="PlacePhoto" class="btn btn-info"><i class="fa fa-upload">&nbsp;</i>' . __('Select Photo') . '</label>', 'after' => '<span id="photo-name" style="margin-left: 15px"></span>', 'class' => 'hidden photo',*/ 'div' => array('class' => 'col-md-10'))) ?>
                            <div for='PlacePhoto' generated='true' class='error' style='display: none'>
                                <span class="errorDV"> </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <?php
        			echo $this->Form->input('address',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
        			echo $this->Form->input('type',array('label' => __('Type'), 'class' => 'form-control','options'=>$types,'empty' => __('Select Star'), 'div' => array('class' => 'form-group required')));
                    echo $this->Form->input('meal_plan',array('type'=>'text','class' => 'form-control', 'div' => array('class' => 'form-group')));
                    echo $this->Form->input('room_type',array('class' => 'form-control', 'div' => array('class' => 'form-group required')));
                    echo $this->Form->input('price',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
                    ?>
                    </div>
                 </div>   
    		</div>
    		<div class="form-action">
    			<?php echo $this->Form->submit(__('Save'), array('div' => false,'class' => 'btn btn-primary btn_dsbl'));?>
    			&nbsp;&nbsp;
    			<?php echo $this->Html->link(__('Cancel'), array('action' => 'index'), array('class' => 'btn btn-default'));?>
    		</div>

    		<?php $arrValidation = array(
    			'Rules' => array(
    				'name' => array('required' => 1,'alphabates'=> true),
    				'price' => array('required' => 1),
                    'state_id' => array('required' => 1),
                    'city_id' => array('required' => 1),
    				'address' => array('required' => 1),
                    'contact_no' => array('required' => 1),
    				'type' => array('required' => 1),
    				'meal_plan' => array('required' => 1),
                    'room_type' => array('required' => 1),
                    'photo' => array(
                        'accept' => 'jpg|jpeg|png|bmp|gif'
                    ),

    			),
    			'Messages' => array(
    				'name' => array('required' => __('Please enter Name')),
    				'price' => array('required' => __('Please enter Price')),
                    'state_id' => array('required' => __('Please select State')),
                    'city_id' => array('required' => __('Please select City')),
    				'address' => array('required' => __('Please enter Address')),
                    'contact_no' => array('required' => __('Please Contact No')),
    				'type' => array('required' => __('Please enter Type')),
                    'room_type' => array('required' => __('Please enter Room Type.')),
                    'photo' => array(
                        'accept' => __('Please choose files having jpg, jpeg, png, bmp, gif extension.')
                    ),
    				'meal_plan' => array('required' => __('Please enter Meal Plan')),));



    				echo $this->Form->setValidation($arrValidation); ?>

    				<?php echo $this->Form->end(); ?>
    			</div>
    		</div>
<script type="text/javascript">
     $("#HotelStateId").on('change',function() {
        var id = $(this).val();
        jQuery.ajax({
            url: BaseUrl + 'citys/get_city/' + id,
            type: 'post',
            dataType: 'json',
            success: function (html) {
                $("#HotelCityId option").remove();
                $('#HotelCityId').append($("<option></option>").attr("value","").text("Select City"));
                $.each(html, function(key, value) {
                    $('<option>').val('').text('select');
                    $('<option>').val(key).text(value).appendTo($("#HotelCityId"));
                });
            },
            error: function (e) {

            }
        });
    });
</script>