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
                <?php echo $this->Form->create('Tour', array('id' => 'UserEditProfileForm', 'type' => 'file', 'inputDefaults' => array('dir' => 'ltl', 'class' => 'form-control', 'div' => array('class' => 'form-group')))); ?>
                <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
                <div class="row no-margin">
                    <div class="col-md-6">
                        <?php
                        echo $this->Form->input('type',array('class' => 'form-control','options'=>array('1'=>'Special Package','2'=>'Hot Package','3'=>'Deals & Discounts'),'empty' => __('Select Type'), 'div' => array('class' => 'form-group required')));
                        echo $this->Form->input('city', array('tabindex' => 1,'placeholder' => __('City'), 'label' => __('City'),'div' => array('class' => 'form-group required')));
                        echo $this->Form->input('place', array('tabindex' => 3,'placeholder' => __('Place'), 'label' => __('Place'),'div' => array('class' => 'form-group required')));
                        echo $this->Form->input('description',array('type'=>'textarea','class' => 'form-control','placeholder' => __('Enter Description'), 'div' => array('class' => 'form-group required')));
                        ?> 
                    </div>
                    <div class="col-md-6">
                        <?php
                        echo $this->Form->input('price', array('tabindex' => 1,'placeholder' => __('Price'), 'label' => __('Price'),'div' => array('class' => 'form-group required')));
                        echo $this->Form->input('days', array('tabindex' => 1,'placeholder' => __('Days'), 'label' => __('Days'),'div' => array('class' => 'form-group required')));
                        echo $this->Form->input('nights', array('tabindex' => 3,'placeholder' => __('Nights'), 'label' => __('Nights'),'div' => array('class' => 'form-group required')));
                        if(!empty($photo)){
                            echo $this->element('backend/logoDiv', array('id' => $id, 'photo' => $photo, 'logoTitle' => __('Tour Picture')));
                        }else { ?>
                            <label class="form-group clearBoth col-md-12 no-padding" style="margin-bottom: 10px">
                            <?php echo __('Tour Picture');  ?>
                        </label>
                          <?php  echo $this->Form->input('photo', array('label' => false, 'type' => 'file', 'placeholder' => 'Photo', 'required' => false, 'class' => ''));
                        }
                        ?> 
                    </div>
                    <?php
                        if($dbOpration == 'Add'){
                        
                        echo '<div class="col-md-10">';
                        echo $this->Form->input('Highlight.title',array('name'=>'data[Highlight][name][new][]', 'type'=>'text','label'=>'Highlight Title', 'class' => 'form-control','placeholder'=>'Enter Highlight Title','div' => array('class' => 'form-group required')));
                        ?>
                        </div>

                        <a id="AddMoreOptions" href="#" class="btn btn-primary" style="float: right;margin-right: 76px;margin-top: 23px;">+ Add More</a>
                        
                        <?php echo "<div id='appendTagName'></div>"; 
                        } else{
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
                                    <div class="removeclass"><div class="col-md-10"><input name="data[Highlight][name][old][<?=$key?>]" value="<?php echo $tag; ?>" class="form-control col-md-11 SurveyOption" dir="ltr" maxlength="250" type="text"></div>  <div class="col-md-1"  style="margin-bottom: 5px;">  <button type="button" style="margin-left: -3px;float:left;" onclick="return removeOptionItem(this); " class="btn btn-danger">x</button><br></div></div>
                                <?php }
                            }
                            ?>
                            
                            <div id='appendTagName'></div>
                        <?php } ?>
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
                        'type' => array(
                            'required' => 1
                        ),
                        'title' => array(
                            'required' => 1
                        ),
                        'city' => array(
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
                        // 'photo' => array(
                        //     'required' => 1,
                        //     'accept' => 'jpg|jpeg|png'
                        // ),
                        
                    ),
                    'Messages' => array(
                        'type' => array(
                            'required' => __('Please select type.'),
                        ),
                        'title' => array(
                            'required' => __('Please enter title.'),
                        ),
                        'description' => array(
                            'required' => __('Please enter description.'),
                        ),
                        'city' => array(
                            'required' => __('Please select city.'),
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
                        // 'photo' => array(
                        //     'required' =>  __('Please choose file.'),
                        //     'accept' => __('Please choose files having jpg, jpeg, png extension.')
                        // ),
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
        jQuery('#AddMoreOptions').on('click', function(e) {
                e.preventDefault();
                var highlights ='<div class="removeclass"><div class="col-md-10"><input name="data[Highlight][name][new][]" class="form-control col-md-11 SurveyOption" placeholder="Enter Highlight Title" dir="ltr" maxlength="250" type="text"></div>  <div class="col-md-1"  style="margin-bottom: 5px;">  <button type="button" style="margin-left: -3px;float:left;" onclick="return removeOptionItem(this); " class="btn btn-danger">x</button><br></div></div>';
                jQuery('#appendTagName').append(highlights);
            });
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
</script>
