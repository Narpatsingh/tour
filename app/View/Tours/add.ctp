<?php
/**
 * @var $this view
 */
$formParamter = '';
$this->assign('pagetitle', __('%s Tour', $dbOpration));
$this->Custom->addCrumb(__('%s Tour', $dbOpration));

$this->start('top_links');
echo $this->Html->link(__('Back'), array('action' => 'index'), array('icon' => 'back', 'class' => 'btn btn-default', 'escape' => false));
$this->end();
echo $this->Html->script(
    array(
        'backend/ckeditor/ckeditor.js'
    ), array('inline' => false)
);
echo $this->fetch('script');

$photo = '';
if (isset($this->request->data['Tour']['id'])) {
    $id = $this->request->data['Tour']['id'];
    $photo = isset($this->request->data['Tour']['img']) ? $this->request->data['Tour']['img'] : '';
}


?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $this->Form->create('Tour', array('id' => 'UserEditProfileForm', 'type' => 'file', 'class'=>'multiple_save','inputDefaults' => array('dir' => 'ltl', 'class' => 'form-control', 'div' => array('class' => 'form-group')))); ?>
                <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
                <div class="row no-margin">
                    <div class="col-md-6">
                        <?php
                        echo $this->Form->input('type',array('class' => 'form-control','options'=>array('1'=>'Special Package','2'=>'Hot Package','3'=>'Deals & Discounts'),'empty' => __('Select Type'), 'div' => array('class' => 'form-group required')));
                        echo $this->Form->input('name',array('class' => 'form-control','placeholder' => __('Title'),'label'=>'Title', 'div' => array('class' => 'form-group required')));
                        echo $this->Form->input('state_id',array('label' => __('State'), 'class' => 'form-control','multiple' => true,'options'=>$states, 'div' => array('class' => 'form-group')));
                        echo $this->Form->input('city_id',array('label' => __('City'), 'class' => 'form-control','multiple' => true, 'div' => array('class' => 'form-group')));
                        echo $this->Form->input('place_id', array('tabindex' => 3,'placeholder' => __('Place'),'multiple' => true,'div' => array('class' => 'form-group')));
                        echo $this->Form->input('description',array('type'=>'textarea','class' => 'form-control','placeholder' => __('Enter Description'), 'div' => array('class' => 'editor form-group required')));
                        echo $this->Form->input('date_price',array('type'=>'textarea','class' => 'form-control','placeholder' => __('Enter Date Price'), 'div' => array('class' => 'editor form-group required')));
                        ?> 
                    </div>
                    <div class="col-md-6">
                        <?php
                        echo $this->Form->input('price', array('tabindex' => 1,'placeholder' => __('Price'), 'label' => __('Price'),'div' => array('class' => 'form-group required')));
                        echo $this->Form->input('days', array('tabindex' => 1,'placeholder' => __('Days'), 'label' => __('Days'),'div' => array('class' => 'form-group required')));
                        echo $this->Form->input('nights', array('tabindex' => 3,'placeholder' => __('Nights'), 'label' => __('Nights'),'div' => array('class' => 'form-group required')));
                        echo $this->Form->input('discount', array('tabindex' => 3,'placeholder' => __('Discount'), 'label' => __('Discount'),'div' => array('class' => 'form-group')));
                        echo $this->Form->input('hotel_id',array('class' => 'form-control','multiple' => true, 'div' => array('class' => 'form-group')));
                        if(!empty($photo)){
                            echo $this->element('backend/logoDiv', array('id' => $id, 'photo' => $photo, 'logoTitle' => __('Tour Picture')));
                        }else { ?>
                            <label class="form-group clearBoth col-md-12 no-padding" style="margin-bottom: 10px">
                            <?php echo __('Tour Picture');  ?>
                        </label>
                          <?php  echo $this->Form->input('img', array('label' => false, 'type' => 'file', 'placeholder' => 'Photo', 'required' => false, 'class' => ''));
                        }
                        ?> 
                    </div>
                    <?php
                        if($dbOpration == 'Add'){
                        
                        echo '<div class="col-md-10">';
                        echo $this->Form->input('Highlight.title',array('name'=>'data[Highlight][name][new][]', 'type'=>'text','label'=>'Highlights', 'class' => 'form-control','placeholder'=>'Enter Highlight','div' => array('class' => 'form-group required')));
                        ?>
                        </div>

                        <a id="AddMoreOptions" href="#" class="btn btn-primary" style="float: right;margin-right: 76px;margin-top: 23px;">+ Add More</a>
                        
                        <?php echo "<div id='appendTagName'></div>"; 
                        } else{
                            if(empty($highlight_data)){
                                echo '<div class="col-md-10">';
                                echo $this->Form->input('Highlight.title',array('name'=>'data[Highlight][name][new][]', 'type'=>'text','label'=>'Highlight Title', 'class' => 'form-control','placeholder'=>'Enter Highlight Title','div' => array('class' => 'form-group required')));
                                ?>
                                </div>

                                <a id="AddMoreOptions" href="#" class="btn btn-primary" style="float: right;margin-right: 76px;margin-top: 23px;">+ Add More</a>
                            
                            <?php echo "<div id='appendTagName'></div>";  
                            }
                             $flag=0;
                            
                            foreach ($highlight_data as $key => $tag) {
                                $flag++;
                                if($flag==1){
                                    echo '<div class="col-md-10">';
                                    echo $this->Form->input('Highlight.title',array('name'=>'data[Highlight][name][old]['.$key.']', 'value'=>$tag ,'type'=>'text','label'=>'Highlight Title', 'class' => 'form-control', 'div' => array('class' => 'form-group required')));    
                                    echo '</div>';
                                    echo '<a id="AddMoreOptions" href="#" class="btn btn-primary" style="float: right;margin-right: 76px;margin-top: 23px;">+ Add More</a>';

                                }else{
                                    ?>
                                    <div class="removeclass"><div class="col-md-10"><input name="data[Highlight][name][old][<?=$key?>]" value="<?php echo $tag; ?>" class="form-control col-md-12 SurveyOption" dir="ltr" maxlength="250" type="text"></div>  <div class="col-md-1"  style="margin-bottom: 5px;">  <button type="button" style="margin-left: -3px;float:left;"
                                    value="<?=$key?>" onclick="return removeOptionItem(this); " class="btn btn-danger">x</button><br></div></div>
                                <?php }
                            }
                            ?>
                            
                            <div id='appendTagName'></div>
                        <?php } ?>
                    </div>   
                </div>
                <div class="form-action">
                    <?php
                    echo $this->Form->submit(__('Save'), array('class' => 'btn btn-primary margin-right10 btn_dsbl', 'div' => false));
                    echo $this->Html->link('Cancel', array('action' => 'index'), array('class' => 'btn btn-default', 'icon' => 'cancel'));
                    ?>
                </div>
                <?php
                $arrValidation = array(
                    'Rules' => array(
                        'type' => array(
                            'required' => 1
                        ),
                        'title' => array(
                            'required' => 1,'alphabates'=> true
                        ),
                        'name' => array(
                            'required' => 1,'alphabates'=> true
                        ),
                        'city_id' => array(
                            'required' => 1,
                        ),
                        'state_id' => array(
                            'required' => 1,
                        ),
                        'place' => array(
                            'required' => 1,
                        ),
                        'description' => array(
                            'required' => 1,
                        ),
                        'price' => array(
                            'required' => 1,
                            'number'=>true
                        ),
                        'days' => array(
                            'required' => 1,
                            'number'=>true
                        ),
                        'nights' => array(
                            'required' => 1,
                            'number'=>true
                        ),
                        'hotel_id' => array(
                            'required' => 1,
                        ),
                        'img' => array(
                            'required' => 1,
                            'accept' => 'jpg|jpeg|png|bmp|gif'
                        ),
                        
                    ),
                    'Messages' => array(
                        'type' => array(
                            'required' => __('Please select type.'),
                        ),
                        'title' => array(
                            'required' => __('Please enter title.'),
                        ),
                        'name' => array(
                            'required' => __('Please enter title.'),
                        ),

                        'description' => array(
                            'required' => __('Please enter description.'),
                        ),
                        'city_id' => array(
                            'required' => __('Please select city.'),
                        ),
                        'state_id' => array(
                            'required' => __('Please select state.'),
                        ),
                        'place' => array(
                            'required' => __('Please select place.'),
                        ),
                        'price' => array(
                            'required' => __('Please enter price.'),
                            'number'=> __('Please enter number only.'),
                        ),
                        'days' => array(
                            'required' => __('Please enter days.'),
                            'number'=> __('Please enter number only.'),
                        ),
                        'nights' => array(
                            'required' => __('Please enter nights.'),
                            'number'=> __('Please enter number only.'),
                        ),
                        'hotel_id' => array(
                            'required' => __('Please select hotel.'),
                        ),
                        'img' => array(
                            'required' => __('Please select tour photo.'),
                            'accept' => __('Please choose files having jpg, jpeg, png, bmp, gif extension.')
                        ),
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

        $("#TourStateId").trigger('change');

        jQuery('#AddMoreOptions').on('click', function(e) {

                e.preventDefault();
                var highlights ='<div class="removeclass"><div class="col-md-10"><input name="data[Highlight][name][new][]" class="form-control col-md-12 SurveyOption" placeholder="Enter Highlight Title" dir="ltr" maxlength="250" type="text"></div>  <div class="col-md-1"  style="margin-bottom: 5px;">  <button type="button" style="margin-left: -3px;float:left;" onclick="return removeOptionItem(this); " class="btn btn-danger">x</button><br></div></div>';
                jQuery('#appendTagName').append(highlights);
            });
        $('#TourStateId').multiselect();   
        $('#TourCityId').multiselect();   
        $('#TourPlaceId').multiselect();   
        $('#TourHotelId').multiselect();   

    });
    function removeOptionItem(this1){
        if(confirm("Are you sure you want to remove this?")){
            ID = this1.value;
            if(ID != ''){
              jQuery.ajax({
                url: BaseUrl + 'Tours/delete_highlight/'+ID,
                type: 'post',
                success: function (response) { 

                },
                error: function (e) { }
              });  
            }

            jQuery(this1).closest('.removeclass').remove();
        } 
        return false;
    }

    $("#TourStateId").on('change',function() {
        var id = $(this).val();
        var selected_id = '<?php echo empty($this->request->data["Tour"]["city_id"])?"[]":json_encode( $this->request->data["Tour"]["city_id"] ); ?>';

        jQuery.ajax({
            url: BaseUrl + 'states/get_city/' + id,
            type: 'post',
            dataType: 'json',
            success: function (html) {
                $('#TourCityId').multiselect('destroy');
                $("#TourCityId option").remove();
                var append_city = '';
                $.each(html, function(optkey, optvalue) {    
                    append_city += '<optgroup label="'+optkey+'">';
                $.each(optvalue, function(key, value) {

                    if (jQuery.inArray(key, jQuery.parseJSON(selected_id)) != -1){
                    append_city += '<option value='+key+' selected="selected">'+value+'</option>';
                    }else{
                    append_city += '<option value='+key+'>'+value+'</option>';    
                    }

                });
                    append_city += '</optgroup>';
                });

                $("#TourCityId").html(append_city);
                $('#TourCityId').multiselect();
                $("#TourCityId").trigger('change');
            },
            error: function (e) {

            }
        });
    });

    $("#TourCityId").on('change',function() {
        var id = $(this).val();
        var place_selected_id = '<?php echo empty($this->request->data["Tour"]["place_id"])?"[]":json_encode( $this->request->data["Tour"]["place_id"] ); ?>';
        var hotel_selected_id = '<?php echo empty($this->request->data["Tour"]["hotel_id"])?"[]":json_encode( $this->request->data["Tour"]["hotel_id"] ); ?>';
        jQuery.ajax({
            url: BaseUrl + 'places/get_place_data/' + id,
            type: 'post',
            dataType: 'json',
            success: function (html) {
                $('#TourPlaceId').multiselect('destroy');
                $("#TourPlaceId option").remove();
                var append_place = '';
                $.each(html, function(optkey, optvalue) {    
                    append_place += '<optgroup label="'+optkey+'">';
                $.each(optvalue, function(key, value) {
                    if (jQuery.inArray(key, jQuery.parseJSON(place_selected_id)) != -1){
                    append_place += '<option value='+key+' selected="selected">'+value+'</option>';
                    }else{
                    append_place += '<option value='+key+'>'+value+'</option>';    
                    }
                });
                    append_place += '</optgroup>';
                });
                $("#TourPlaceId").html(append_place);
                $('#TourPlaceId').multiselect();
            },
            error: function (e) {

            }
        });

        jQuery.ajax({
            url: BaseUrl + 'hotels/get_hotel_data/' + id,
            type: 'post',
            dataType: 'json',
            success: function (html) {
                $('#TourHotelId').multiselect('destroy');
                $("#TourHotelId option").remove();
                var append_hotel = '';
                $.each(html, function(optkey, optvalue) {    
                    append_hotel += '<optgroup label="'+optkey+'">';
                $.each(optvalue, function(key, value) {
                    if (jQuery.inArray(key, jQuery.parseJSON(hotel_selected_id)) != -1){
                    append_hotel += '<option value='+key+' selected="selected">'+value+'</option>';
                    }else{
                    append_hotel += '<option value='+key+'>'+value+'</option>';    
                    }
                });
                    append_hotel += '</optgroup>';
                });
                $("#TourHotelId").html(append_hotel);
                $('#TourHotelId').multiselect();
            },
            error: function (e) {

            }
        });        
    });

    jQuery(document).ready(function () {
        CKEDITOR.replace('TourDescription');
        CKEDITOR.replace('TourDatePrice');
    });


</script>
