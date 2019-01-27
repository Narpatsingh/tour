<?php
//header("Content-type: application/pdf");
echo $this->Html->script(
        array(
            'receipt/jspdf.min',
        ), array('inline' => false)
    );
echo $this->fetch('script');
echo $this->fetch('content'); 
?>