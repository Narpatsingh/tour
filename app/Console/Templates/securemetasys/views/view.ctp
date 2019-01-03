<?php
echo "<?php\n";
echo "\t\$this->assign('pagetitle', __('{$singularHumanName} Detail').' <small>'.__('{$pluralHumanName}').'</small>');\n";
echo "\t\$this->Custom->addCrumb(__('{$pluralHumanName}'),array('action'=>'index'));\n";
echo "\t\$this->Custom->addCrumb(__('{$singularHumanName} Detail'));\n";
echo "\t\$this->start('top_links');\n";
echo "\t\techo \$this->Html->link(__('Delete'), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('icon'=>'fa-trash-o','title' => __('Click here to delete this {$singularHumanName}'),'class'=>'btn btn-danger','escape'=>false),__('Are you sure? You want to delete this {$singularHumanName}?'));\n";
echo "\t\techo \$this->Html->link(__('Edit'), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('icon'=>'fa-edit','title' => __('Click here to edit this {$singularHumanName}'),'class'=>'btn btn-primary','escape'=>false));\n";
echo "\t\techo \$this->Html->link(__('Add {$singularHumanName}'),array('action'=>'add'),array('icon'=>'fa-plus','title' => 'Click here to add {$singularHumanName}','class'=>'btn btn-primary','escape'=>false));\n";
echo "\t\techo \$this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));\n";
echo "\t\$this->end();\n";
echo "?>\n";

?>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="overflow-hide-break">
                <div class="box-body userViewPage">
                    <?php
                    foreach ($fields as $key => $field) {
                        if (in_array($field, array('photo', 'image', 'profile_photo'))) {
                            echo "\t\t<div class='col-xs-12 col-sm-3'>";
                            echo "\t\t\t <?php echo \$this->Html->image(getUserPhoto(\${$singularVar}['{$modelClass}']['id'],\${$singularVar}['{$modelClass}']['{$field}'],false,false), array('class' => 'thumbnail img-responsive'))?>";
                            echo "\t\t</div>";
                            unset($fields[$key]);
                        }
                    }
                    echo "\t\t<div class='col-xs-12 col-sm-9 detailBox'>";
                    echo "\t\t\t<div class='row'>";
                    echo "\t\t\t\t<div class='col-md-12 col-sm-12 innerBox'>";
                    echo "\t\t\t\t\t<div class='dl-horizontal'>";
                    echo "\t\t\t\t\t\t<ul>";
                    echo "\t\t\t\t\t\t\t<li>";
                    echo "\t\t\t\t\t\t\t\t<span class='col-xs-12'>";
                    echo "\t\t\t\t\t\t\t\t\t<div class='row'>";
                    echo "\t\t\t\t\t\t\t\t\t\t$singularHumanName Detail";
                    echo "\t\t\t\t\t\t\t\t\t</div>";
                    echo "\t\t\t\t\t\t\t\t</span>";
                    echo "\t\t\t\t\t\t\t</li>";
                    echo "\t\t\t\t\t\t</ul>";
                    foreach ($fields as $field) {
                        $isKey = false;
                        if (!empty($associations['belongsTo'])) {
                            foreach ($associations['belongsTo'] as $alias => $details) {
                                if ($field === $details['foreignKey']) {
                                    $isKey = true;
                                    echo "\t\t\t\t\t\t<ul>";
                                    echo "\t\t\t\t\t\t\t<li class='innreicons'>";
                                    echo "\t\t\t\t\t\t\t\t<?php //echo __('" . Inflector::humanize(Inflector::underscore($alias)) . "'); ?><i class='fa fa-hand-o-right'>";
                                    echo "\t\t\t\t\t\t\t\t</i>";
                                    echo "\t\t\t\t\t\t\t</li><li>";
                                    echo "\t\t\t\t\t\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>";
                                    echo "\t\t\t\t\t\t\t</li>";
                                    echo "\t\t\t\t\t\t</ul>";
                                    break;
                                }
                            }
                        }
                        if ($isKey !== true) {
                            echo "\t\t\t\t\t\t<ul>";
                            echo "\t\t\t\t\t\t\t<li class='innreicons'>";
                            echo "\t\t\t\t\t\t\t\t<?php //echo __('" . Inflector::humanize($field) . "'); ?><i class='fa fa-hand-o-right'>";
                            echo "\t\t\t\t\t\t\t\t</i>";
                            echo "\t\t\t\t\t\t\t</li><li>";
                            echo "\t\t\t\t\t\t\t\t<?php echo \${$singularVar}['{$modelClass}']['{$field}']; ?>";
                            echo "\t\t\t\t\t\t\t</li>";
                            echo "\t\t\t\t\t\t</ul>";
                        }
                    }

                    echo "\t\t\t\t\t</div>";
                    echo "\t\t\t\t</div>";
                    echo "\t\t\t</div>";
                    echo "\t\t</div>";

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>