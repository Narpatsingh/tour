<?php
    $type = empty($edit) ? 'Add' : 'Edit';
    $this->assign('pagetitle', __('%s Account',$type));
    $this->Custom->addCrumb(__('Accounts'),array('action'=>'index'));
    $this->Custom->addCrumb(__('%s Account',$type));
    $this->start('top_links');
    echo $this->Html->link(__('Back'),array('action'=>'index'),array('icon'=>'fa-angle-double-left','class'=>'btn btn-default','escape'=>false));
    $this->end();
    ?>
    <div class="box box-primary">
    	<div class="overflow-hide-break">
    		<?php echo $this->Form->create('Account', array('class' => 'form-validate','type'=>'file')); ?>
    		<div class="box-body box-content">
                <?php if($this->request->data['Account']['ac_type']=='tour'): ?>
    			<table>
    				<tr>
                        <th>Customer Name</th>
                        <td class="cus_value">: <?php echo $this->request->data['Account']['customer_name'] ?></td>
                        <th>Contact Number</th>
                        <td class="cus_value">: <?php echo $this->request->data['Voucher']['customer_contact_no'] ?></td>
                        <th>Tour Name</th>
                        <td class="cus_value">: <?php echo $this->request->data['Voucher']['customer_tour_name'] ?></td>
                        <th>Tour Date</th>
                        <td class="cus_value">: <?php echo $this->request->data['Voucher']['customer_tour_date'] ?></td>
    					<th>Payment Type</th>
    					<td class="cus_value">: <?php echo $this->request->data['Voucher']['payment_type'] ?></td>
    				</tr>
    			</table>
                <?php endif; ?>
                <br>
                <br>
                
                <div class="form-group col-md-6">
                    <label for="AccountPaymentAmount">Payment Amount</label>
                    <span class="form-control" disabled="disabled"> <?php echo $this->request->data['Account']['payment_amount'] ?> </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="TotalPaymentAmount">Total Payment With Gst</label>
                    <span class="form-control" disabled="disabled"> <?php echo $this->request->data['Account']['total_payment_with_gst'] ?> </span>
                </div>
                <?php
                echo $this->Form->input('id',array('type'=>'hidden'));
                echo $this->Form->input('ac_type',array('type'=>'hidden'));
                //echo $this->Form->input('payment_amount',array('class' => 'form-control', 'div' => array('class' => 'form-group'))); 
                //echo $this->Form->input('total_payment_with_gst',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
                echo $this->Form->input('payment_recieved',array('class' => 'form-control', 'div' => array('class' => 'form-group col-md-6')));
                //echo $this->Form->input('payment_receivable',array('class' => 'form-control', 'div' => array('class' => 'form-group')));
                ?>
                <div class="form-group col-md-6">
                    <label for="ReceivablePaymentAmount">Amount Remaining</label>
                    <span class="form-control" disabled="disabled" id="ReceivablePaymentAmount"> <?php echo $this->request->data['Account']['payment_receivable'] ?> </span>
                </div>
                <div class="form-group col-md-6">
                <?php echo $this->Form->input('generate_receipt',array('type'=>'checkbox')); ?>
                </div>
    		</div>
    		<div class="form-action">
    			<?php echo $this->Form->submit(__('Save'), array('div' => false,'class' => 'btn btn-primary'));?>
    			&nbsp;&nbsp;
    			<?php echo $this->Html->link(__('Cancel'), array('action' => 'index'), array('class' => 'btn btn-default'));?>
    		</div>

    		<?php $arrValidation = array(
    			'Rules' => array(
    				'voucher_id' => array('required' => 1),
    				'payment_amount' => array('required' => 1),
    				'total_payment_with_gst' => array('required' => 1),
    				'payment_recieved' => array('required' => 1),
    				'payment_receivable' => array('required' => 1),

    			),
    			'Messages' => array(
    				'voucher_id' => array('required' => __('Please enter Voucher Id')),
    				'payment_amount' => array('required' => __('Please enter Payment Amount')),
    				'total_payment_with_gst' => array('required' => __('Please enter Total Payment With Gst')),
    				'payment_recieved' => array('required' => __('Please enter Payment Recieved')),
    				'payment_receivable' => array('required' => __('Please enter Payment Receivable')),));



    				echo $this->Form->setValidation($arrValidation); ?>

    				<?php echo $this->Form->end(); ?>
    			</div>
    		</div>
<script type="text/javascript">
$( document ).on('keyup','#AccountPaymentRecieved', function(e) {
  
    var payment = <?=$this->request->data['Account']['total_payment_with_gst']?>;
    var receivable = <?=$this->request->data['Account']['payment_receivable']?>;
    var recieved = $("#AccountPaymentRecieved").val();

    if(recieved<0 || recieved>payment){
        alert("Please Enter a valid Amount.");
        $("#AccountPaymentRecieved").val(0);
    }
    else if(payment==recieved){
        var r = confirm("Are you sure to make full Payment Amount ?");
        if (r == true) {
          $("#ReceivablePaymentAmount").html(payment-recieved);  
          return true;
        } else {
          $("#AccountPaymentRecieved").val(0);
        }
    }else{
         $("#ReceivablePaymentAmount").html(payment-recieved);
    }

});  
</script>