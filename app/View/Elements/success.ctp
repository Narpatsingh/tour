<div role="alert" class="alert alert-success alert-dismissible notification-message">
    <i class="fa fa-check"></i>
    <button data-dismiss="alert" class="close" type="button">
        <span aria-hidden="true">×</span><span class="sr-only">Close</span>
    </button>
    <?php echo $message;?>
</div>

<script type="text/javascript">
    jQuery(document).ready(function(){
        setTimeout(function() {
            jQuery('.notification-message').slideUp('fast');
        }, 10000);
    });
</script>