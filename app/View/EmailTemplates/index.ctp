<?php
$this->assign('pagetitle', __('Email Template'));
$this->Custom->addCrumb(__('Email Template'));

?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary col-md-12">
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
                        <th>
                            <?php
                            echo __('Sr. No.');

                            ?>
                        </th>
                        <th><?php echo $this->Paginator->sort('name'); ?></th>
                        <th><?php echo $this->Paginator->sort('subject'); ?></th>
                        <th><?php echo $this->Paginator->sort('updated', __('Last Updated')); ?></th>
                        <th class="actions text-center"><?php echo 'Actions'; ?></th>
                    </tr>
                    </thead>
                    <?php if (empty($EmailTemplates)) { ?>
                        <tr>
                            <td colspan="6">
                                <?php echo __("No Email Template added yet!"); ?>
                            </td>
                        </tr>
                    <?php } else { ?>
                        <?php foreach ($EmailTemplates as $EmailTemplate) { ?>
                            <tr>
                                <td>
                                    <?php echo $startNo++; ?>
                                </td>
                                <td><?php echo $EmailTemplate['EmailTemplate']['name']; ?></td>
                                <td><?php echo $EmailTemplate['EmailTemplate']['subject']; ?></td>
                                <td><?php echo $EmailTemplate['EmailTemplate']['updated']; ?></td>
                                <td class="actions text-center">
                                    <?php
                                    echo $this->Html->link('', array(
                                        'controller' => 'EmailTemplates',
                                        'action' => 'view',
                                        $EmailTemplate['EmailTemplate']['id']
                                    ), array(
                                        'icon' => 'view',
                                        'title' => 'Click here to view this email template',
                                        'class' => 'action'
                                    ));
                                    echo $this->Html->link('', array(
                                        'controller' => 'EmailTemplates',
                                        'action' => 'edit',
                                        $EmailTemplate['EmailTemplate']['id']
                                    ), array(
                                        'icon' => 'edit',
                                        'title' => 'Click here to edit this email_template',
                                        'class' => 'action'
                                    ));

                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                    }

                    ?>
                </table>
            </div>
            <div class="box-footer clearfix">
                <?php echo $this->element('pagination'); ?>
            </div>
        </div>
    </div>
</div>