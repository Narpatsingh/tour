<?php
$type = empty($edit) ? 'Add' : 'Edit';
$this->assign('pagetitle', __('%s Email Templete', $type));
$this->Custom->addCrumb('Email Template', array('controller' => 'EmailTemplates', 'action' => 'index'));
$this->Custom->addCrumb(__('%s Email Templete', $type));
$this->start('top_links');
echo $this->Html->link(__('Back'), array('controller' => 'EmailTemplates', 'action' => 'index'), array('icon' => 'fa-angle-double-left', 'class' => 'btn btn-default', 'escape' => false));
$this->end();
echo $this->Html->script(
    array(
        'lib/ckeditor/ckeditor.js'
    ), array('inline' => false)
);
echo $this->fetch('script');
?>
<div class="row">
    <?php echo $this->Form->create('EmailTemplate', array('class' => 'form-validate', 'enctype' => "multipart/form-data", 'id' => 'EmailTemplateAdminAddForm')); ?>
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="overflow-hide-break">
                <div class="box-body">
                    <?php
                    echo $this->Form->input('name', array('label' => __('Template Name'), 'placeholder' => __('Template Name'), 'class' => 'form-control', 'div' => array('class' => 'form-group required')));
                    echo $this->Form->input('subject', array('label' => __('Email Subject'), 'placeholder' => __('Email Subject'), 'class' => 'form-control', 'div' => array('class' => 'form-group required')));
                    echo $this->Form->input('body', array('label' => __('Email Body'), 'placeholder' => 'Email Body', 'row' => 10, 'class' => 'editor form-control', 'div' => array('class' => 'form-group required')));

                    ?>
                    <div class='form-action pull-right'>
                        <?php
                        if (!empty($drip_mail_id)) {
                            echo $this->Form->submit(__('Next', true), array('class' => 'btn btn-success', 'div' => false));
                            echo '&nbsp;&nbsp;';
                            echo $this->Form->button(__('Skip'), array('class' => 'btn btn-info', 'div' => false, 'onclick' => "javascript:addDripemails($drip_mail_id);"));
                        } else {
                            echo $this->Form->submit(__('Save'), array('class' => 'btn btn-primary', 'div' => false));
                            echo '&nbsp;&nbsp;';
                            echo $this->Html->link(__('Cancel'), array('controller' => $this->params['controller'], 'action' => 'index'), array('class' => 'btn btn-default'));
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    echo $this->Form->setValidation(array(
        'Rules' => array(
            'name' => array(
                'required' => 1
            ),
            'subject' => array(
                'required' => 1
            )
        ),
        'Messages' => array(
            'name' => array(
                'required' => __("Please enter a Template name.")
            ),
            'subject' => array(
                'required' => __("Please enter a Email Subject.")
            )
        )
    ));

    ?>
    <?php echo $this->Form->end(); ?>
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><?php echo __('Email Snippets'); ?></h3>
            </div>
            <div class="box-body">
                <?php
                //$arrReplacementVariable = array('FIRST_NAME', 'COMPAPNY_NAME', 'EMAIL', 'SITE_NAME', 'SITE_URL', 'SITE_SUPPORT_EMAIL','ACC_TYPE','USER_NAME','USER_PWD');
                $arrReplacementVariable = array('COMPAPNY_NAME', 'PNR_NO', 'TYPE', 'SITE_URL', 'SITE_NAME');
                foreach ($arrReplacementVariable as $k => $variable) {
                    echo $this->Form->input('', array('onclick' => 'javascript:select();', 'value' => '{' . $variable . '}', 'readonly' => 'readonly', 'class' => 'snippetvar'));
                }

                ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function () {
        CKEDITOR.replace('EmailTemplateBody');
    });
</script>
<?php if (0) { ?>
    <?php echo $this->Form->create('EmailTemplate', array('class' => 'form-validate', 'enctype' => "multipart/form-data", 'id' => 'EmailTemplateAdminAddForm')); ?>
    <table class="withPanel" style="width:870px;">
        <tr>
            <td class="rightPanel">
                <div class="box popup round contentWizard">
                    <div class="heading_content">
                        <h1>
                            <?php echo $this->Html->image('icons/mail.png', array('alt' => "")); ?>
                            Add Email Template
                        </h1>
                        <p>
                            <?php
                            if (!empty($drip_mail_id)) {
                                echo $this->Form->button(__('Skip'), array('class' => 'btn btn-info btn-small', 'div' => false, 'onclick' => "javascript:addDripemails($drip_mail_id);"));
                            }

                            ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                        </p>
                        <div class="c"></div>
                    </div>
                    <?php
                    if (empty($category)) {
                        echo $this->Form->type('mail_cate', array('value' => '13', 'type' => 'hidden'));
                    } else {

                        ?>
                        <div class="field">
                            <label>Email Category<font class="mandatory">*</font> </label>
                            <?php echo $this->Form->input('mail_cate', array('label' => false, 'options' => array('' => 'Select Category') + $category, 'class' => "in medium", "div" => false)); ?>
                        </div>
                    <?php } ?>
                    <div class="buttonContainer">
                        <?php ?>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <?php echo $this->Form->end(); ?>
    <?php
}?>