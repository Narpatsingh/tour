<div class="modal-header">
    <h4 class="modal-title titlemain">Account History</h4>
</div>
<div class="modal-body overflow">
    <?php if(empty($account_histories)): ?>
    <?php echo "No History Found."; ?>
    <?php else: ?>    
    <?php foreach ($account_histories as $account_history): ?>

    <table class="table table-hover table-bordered">
        <tbody>
            <tr>
                <th><?php echo 'Date'; ?></th>
                <td><?php echo date('d-M-Y',strtotime($account_history['AccountHistory']['created'])); ?></td>

                <?php if(empty( $account_history['AccountHistory']['reason'] )): ?>
                <th><?php echo 'Total Payment'; ?></th>
                <td><?php echo $account_history['Account']['total_payment_with_gst']; ?></td>
                <?php else: ?>
                <th><?php echo 'Payment Recieved'; ?></th>
                <td><?php echo $account_history['AccountHistory']['payment_recieved']; ?></td>
                <th><?php echo 'Reason'; ?></th>
                <td><?php echo $account_history['AccountHistory']['reason']; ?></td>
                <?php endif; ?>
            </tr>
        </tbody>          
    </table>
    <?php endforeach; ?>
    <?php endif; ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary closeButton" data-dismiss="modal">Close</button>
</div>
