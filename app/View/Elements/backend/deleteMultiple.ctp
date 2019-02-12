<div class="deleteMultiple">
    <?php
    echo '<div class="select_text">'.$this->Html->image('arrow_ltr.png') .__(' With selected ');
    echo $this->Form->submit(__('Delete'), array('icon' => 'fa-trash', 'class' => 'btn btn-danger btn-xs disabled', 'disabled','id' => 'DeleteBtn'));
    echo '</div>';
    echo $this->Form->end();
    ?>
</div>