<?php
/**
 * @var $this view
 */
$formParamter = '';
$this->assign('pagetitle', __('%s State', $dbOpration));
$this->Custom->addCrumb(__('%s State', $dbOpration));

$this->start('top_links');

echo $this->Html->link(__('Back'), array('action' => 'index'), array('icon' => 'back', 'class' => 'btn btn-default', 'escape' => false));
$this->end();


?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-body">
                <?php echo $this->Form->create('State', array('id' => 'UserEditProfileForm','class'=>'multiple_save','type' => 'file', 'inputDefaults' => array('dir' => 'ltl', 'class' => 'form-control', 'div' => array('class' => 'form-group')))); ?>
                <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
                <div class="row no-margin">
                    <div class="col-md-6">
                        <?php
                            echo $this->Form->input('name', array('tabindex' => 1,'placeholder' => __('Enter State'), 'label' => __('State'),'div' => array('class' => 'form-group required')));
                        ?> 
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
                        'name' => array(
                            'required' => 1,
                            'alphabates'=> true
                        ),
                    ),
                    'Messages' => array(
                        'name' => array(
                            'required' => __('Please enter state name.'),
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
