<?php 
	$disabled = '';
	$readonly = '';
	$hascalendar = 'hascalendar';
	if(!empty($edit)){
		$disabled = 'disabled=>disabled';
		$readonly = 'readonly';
		$hascalendar = '';
	}
	
	echo $this->Form->input('user_id',array('class' => 'form-control', $disabled,'id'=>'SocialMediaDetailUserId', 'div' => array('class' => 'col-md-6 margin-bottom10')));
	echo $this->Form->input('date',array('class' => 'form-control '.$hascalendar, $readonly, 'type'=>'text','id'=>'SocialMediaDetailDate', 'div' => array('class' => 'col-md-6 margin-bottom10')));
?>
<script>	
	jQuery(document).ready(function () {
		jQuery("#SocialMediaDetailDate,#SocialMediaDetailUserId").on("change",function(){
			SocialMediaDetailUserId = jQuery("#SocialMediaDetailUserId").val();
			SocialMediaDetailDate = jQuery("#SocialMediaDetailDate").val();
			this1= this;
			if(jQuery(this1).attr('id')=='SocialMediaDetailUserId'){
				window.location = "<?php echo Router::url(array('action'=>'add'))?>/"+SocialMediaDetailUserId;
			}
			if( SocialMediaDetailDate !="" && SocialMediaDetailUserId !=""){
				jQuery.ajax({
					url: '<?php echo Router::url(array('action'=>'checkExist'))?>/'+SocialMediaDetailUserId+'/'+SocialMediaDetailDate,
					type: 'post',
					success: function (response) {
						if(response==0){
							getVvip(SocialMediaDetailUserId);
							jQuery("#formContainer").removeClass('hidden');
						}else{
							window.location = "<?php echo Router::url(array('action'=>'edit'))?>/"+response;
						}
					},
					error: function (e) {

					}
				});				
			}
		});
	});
	function getVvip(user_id)
	{
		jQuery.ajax({
			url: '<?php echo Router::url(array('controller'=>'SocialMediaDetails','action'=>'getVvipList'))?>/'+user_id,
			type: 'post',
			success: function (response) {
				$('select.vvip_id').html('');
				var obj = jQuery.parseJSON( response );
				 $.each(obj,function(key,value){
		            $('select.vvip_id').append('<option value="'+key+'" >'+value+'</option>');
		        });
			},
			error: function (e) {

			}
		});	
	}
</script>