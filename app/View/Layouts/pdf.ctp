<?php
//header("Content-type: application/pdf");
echo $this->Html->script(
        array(
            'backend/jquery-2.1.0.min',
            'receipt/jspdf.min',
            'receipt/canvas.min',
        ), array('inline' => false)
    );
echo $this->fetch('script');
echo $this->fetch('content'); 
?>
