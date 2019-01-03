<?php
echo "<?php\n";
echo "\t\$this->assign('pagetitle', __('{$pluralHumanName}'));\n";
echo "\t\$this->Custom->addCrumb(__('{$pluralHumanName}'));\n";
echo "\t\$this->start('top_links');\n";
echo "\t\techo \$this->Html->link(__('Add {$singularHumanName}'),array('action'=>'add'),array('icon'=>'fa-plus','title'=>__('Add {$singularHumanName}'),'class'=>'btn btn-primary','escape'=>false));\n";
echo "\t\$this->end();\n";
echo "?>\n";

?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body row">
                <div class="col-md-12">
                    <?php
                    echo "\t\t\t<?php echo \$this->Form->create('{$modelClass}', array('autocomplete' => 'off', 'novalidate' => 'novalidate'));";
                    $count = 0;
                    foreach($fields as $field):
                        if(in_array($field, array('first_name','last_name','email','status','name'))):
                            $count = $count + 3;
                            $fieldTitle = ucfirst($field);
                            if($field == 'status'):                                
                                echo "\n\t\t\t echo \$this->Form->input('{$field}', array('label' => __('{$fieldTitle}'), 'required' => false, 'empty' => __('Select status '), 'options' => array('active' => __('Active'), 'inactive' => __('Inactive')), 'class' => 'form-control', 'div' => array('class' => 'col-md-3'))); ";
                            else:    
                                echo "\n\t\t\t echo \$this->Form->input('{$field}', array('label' => __('{$fieldTitle}'), 'placeholder' => __('{$field}'), 'required' => false, 'class' => 'form-control', 'div' => array('class' => 'col-md-3')));";
                            endif;
                        endif;
                    endforeach;                    
                    echo "\n?>\n\n";
                    ?>
                    <label>&nbsp</label>
                    <div class="col-md-<?php echo (12-$count)?> form-group">
                        <?php
                        echo "\t\t<?php echo \$this->Form->submit(__('Search'), array('class' => 'btn btn-primary margin-right10', 'div' => false));";
                        echo "\t\techo \$this->Html->link(__('Reset Search'), array('action' => 'index', 'all'), array('title' => __('reset search'), 'class' => 'btn btn-default')); ?>\n";

                        ?>
                    </div>
                    <?php
                    echo "\n\t<?php echo \$this->Form->end();?>\n";

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="box box-primary">           
    <div class="box-footer clearfix">
        <?php echo "<?php echo \$this->element('paginationtop'); ?>\n"; ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <?php $fieldCount = 1 ?>
                    <?php foreach ($fields as $field): ?>
                        <?php if($field != 'id'): ?>
                            <?php echo "<th><?php echo \$this->Paginator->sort('{$field}'); ?></th>\n"; ?>
                        <?php endif; ?>
                        <?php $fieldCount++; ?>
                    <?php endforeach; ?>
                    <th class="actions text-center"><?php echo "<?php echo __('Actions'); ?>"; ?></th>
                </tr>			
            </thead>		
            <tbody>
                <?php
                echo "<?php if(empty(\${$pluralVar})){?>\n";
                echo "\t\t\t\t\t\t\t\t<tr>\n";
                echo "\t\t\t\t\t<td colspan='{$fieldCount}' class='text-warning'><?php echo __('No {$singularHumanName} found.')?></td>\n";
                echo "\t\t\t\t\t\t\t\t</tr>\n";
                echo "<?php }else{?>\n";
                echo "\n<?php foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
                echo "\t<tr>\n";
                foreach ($fields as $field) {
                    $isKey = false;
                    if (!empty($associations['belongsTo'])) {
                        foreach ($associations['belongsTo'] as $alias => $details) {
                            if ($field === $details['foreignKey']) {
                                $isKey = true;
                                echo "\t\t<td>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t</td>\n";
                                break;
                            }
                        }
                    }
                    $isKey1 = false;
                    $fieldName = substr($field, 0, strpos($field, '_id'));
                    $fieldName = Inflector::pluralize($fieldName);
                    if (!empty($associations['hasMany'])) {
                        foreach ($associations['hasMany'] as $alias => $details) {
                            if ($singularVar."_id" === $details['foreignKey'] && $details['controller'] == $fieldName) {
                                $isKey1 = true;
                                echo "\t\t<td>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t</td>\n";
                                break;
                            }
                        }
                    }
                    if (in_array($field, array('photo', 'image')) && $isKey !== true) {
                        echo "\t\t<td class=\"photo\"><?php echo \$this->Html->image(getPhoto(\${$singularVar}['{$modelClass}']['id'],\${$singularVar}['{$modelClass}']['{$field}']," . strtoupper($modelClass) . "_IMAGE, false,true))?></td>";
                    } else if ($isKey !== true) {
                        if($isKey1!== true && ($field != 'id')):
                            echo "\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>\n";
                        endif;
                    }
                }

                echo "\t\t<td class=\"actions text-center\">\n";
                
                echo "\t\t\t<?php echo \$this->Html->link(__(''), array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('icon'=>'view','title' => __('Click here to view this {$singularHumanName}'))); ?>\n";
                echo "\t\t\t<?php echo \$this->Html->link(__(''), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('icon'=>'edit','title' => __('Click here to edit this {$singularHumanName}'))); ?>\n";
                echo "\t\t\t<?php echo \$this->Html->link(__(''), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('icon'=>'delete','title' => __('Click here to delete this {$singularHumanName}')), __('Are you sure you want to delete {$singularHumanName}?')); ?>\n";
                
                echo "\t\t</td>\n";
                echo "\t</tr>\n";
                echo "<?php endforeach; ?>\n";
                echo "<?php }?>";

                ?>			
            </tbody>
        </table>
    </div>
    <div class="box-footer clearfix">
        <?php echo "<?php echo \$this->element('pagination'); ?>\n"; ?>
    </div>
</div>