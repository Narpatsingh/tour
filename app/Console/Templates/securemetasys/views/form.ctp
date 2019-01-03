<?php if ($action != 'edit'): ?>
    <?php echo "<?php\n"; ?>
    $type = empty($edit) ? 'Add' : 'Edit';
    <?php
    //echo "<?php\n";
    //echo "\techo $type = empty($edit) ? 'Add' : 'Edit';\n";
    echo "\t\$this->assign('pagetitle', __('%s {$singularHumanName}',"

    ?>$type<?php
    echo "));\n";
    echo "\t\$this->Custom->addCrumb(__('{$pluralHumanName}'),array('action'=>'index'));\n";
    echo "\t\$this->Custom->addCrumb(__('%s {$singularHumanName}',"

    ?>$type<?php
    echo "));\n";
    echo "\t\$this->start('top_links');\n";
    echo "\t\techo \$this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));\n";
    echo "\t\$this->end();\n";
    echo "?>\n";

    ?>
    <div class="box box-primary">
        <div class="overflow-hide-break">
            <?php echo "<?php echo \$this->Form->create('{$modelClass}', array('class' => 'form-validate','type'=>'file')); ?>\n"; ?>
            <div class="box-body box-content">
                <?php
                echo "\t<?php\n";
                echo "\t\techo \$this->Form->input('id',array('type'=>'hidden'));\n";
                foreach ($fields as $field) {
                    if (strpos($action, 'add') !== false && $field == $primaryKey) {
                        continue;
                    } elseif (!in_array($field, array('created', 'modified', 'updated'))) {
                        $capitalName = ucfirst($modelClass);
                        $capitalField = ucfirst($field);
                        if ($field == 'status') {
                            echo '?><div class="form-group"><div class="required">';
                            echo '<label for="' . ucfirst($modelClass) . 'Status">';
                            echo 'Select Status of ' . $modelClass;
                            echo '</label></div>';
                            echo '<div class="btn-group btn-block" data-toggle="buttons" id="' . ucfirst($modelClass) . 'Status" >';
                            echo '<label class="btn btn-primary active">';
                            echo '<input type="radio" name="data[' . $modelClass . '][status]" value="active" checked required>';
                            echo __('Active');
                            echo '</label>';
                            echo '<label class="btn btn-primary">';
                            echo '<input type="radio" name="data[' . $modelClass . '][status]" value="inactive" >';
                            echo __('Inactive');
                            echo '</label>';
                            echo '</div></div>';
                            echo '<?php';
                        } else if (in_array($field, array('photo', 'image'))) {
                            echo '?><label class="form-group" style="margin-bottom: 10px">' . $capitalName . '</label>';
                            echo '<div class="form-group row">';
                            echo "<div id='photoId' class='col-md-4'>";
                            $imageUrl = "NO_IMAGE";
                            if ($action == 'edit') {
                                $imageUrl = "getPhoto(\$this->request->data['{$modelClass}']['id'], \$this->request->data['{$modelClass}']['{$field}'], " . strtoupper($modelClass) . "_IMAGE, false)";
                            }
                            echo "<?php echo \$this->Html->image({$imageUrl}, array('class' => 'thumbnail img-responsive', 'style' => 'max-width: 250px')) ?>";
                            echo "</div><?php \t\techo \$this->Form->input('{$field}', array('required' => false, 'label' => false, 'type' => 'file', 'before' => '<label for=\"{$capitalName}{$capitalField}\" class=\"btn btn-info\"><i class=\"fa fa-upload\">&nbsp;</i>' . __('Select {$capitalField}') . '</label>', 'after' => '<span id=\"photo-name\" style=\"margin-left: 15px\"></span>', 'class' => 'hidden photo', 'div' => array('class' => 'col-md-10'))) ?>";
                            echo "<div for='{$capitalName}{$capitalField}' generated='true' class='error' style='display: none'>";
                            echo '<span class="errorDV"> </span></div></div>';
                            echo '<?php';
                        } else {
                            echo "\t\techo \$this->Form->input('{$field}',array('class' => 'form-control', 'div' => array('class' => 'form-group')));\n";
                        }
                    }
                }
                if (!empty($associations['hasAndBelongsToMany'])) {
                    foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
                        echo "\t\techo \$this->Form->input('{$assocName}',array('placeholder'=>{$field},'class' => 'form-control', 'div' => array('class' => 'form-group'));\n";
                    }
                }
                echo "\t?>\n";

                ?>
            </div>
            <div class="form-action">
                <?php echo "<?php echo \$this->Form->submit(__('Save'), array('div' => false,'class' => 'btn btn-primary'));?>\n" ?>
                &nbsp;&nbsp;
                <?php echo "<?php echo \$this->Html->link(__('Cancel'), array('action' => 'index'), array('class' => 'btn btn-default'));?>\n"; ?>
            </div>
            <?php
            $flag = 0;
            foreach ($fields as $field):
                if (!in_array($field, array('created', 'updated', 'id'))):
                    if ($flag):
                        echo "\n\t\t\t '$field' => array('required' => 1),";
                    else:
                        echo "\n\t\t\t<?php \$arrValidation = array(\n\t\t'Rules' => array(\n'$field' => array('required' => 1),";
                    endif;
                    $flag = 1;
                endif;
            endforeach;
            if ($flag):
                echo "\n\n\t\t),";
                $flag = 0;
                foreach ($fields as $field):
                    $fieldTitle = Inflector::humanize($field);
                    if (!in_array($field, array('created', 'updated', 'id'))):
                        if ($flag):
                            echo "\n\t\t\t '$field' => array('required' => __('Please enter {$fieldTitle}')),";
                        else:
                            
                            echo "\n\t\t\t\t\t 'Messages' => array(\n'$field' => array('required' => __('Please enter {$fieldTitle}')),";
                        endif;
                        $flag = 1;
                    endif;
                endforeach;
                echo "));\n\n";
                echo "\n\n echo \$this->Form->setValidation(\$arrValidation); ?>\n\n";
            endif;

            ?>
            <?php echo "<?php echo \$this->Form->end(); ?>\n"; ?>
        </div>
    </div>
<?php endif; ?>