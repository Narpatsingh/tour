jQuery(document).ready(function () {
    $('.phoneNumber').inputmask("999999999999")
	 $('.hascalendar').datepicker({
		format: "yyyy-mm-dd",
		autoclose: true
	});
	jQuery('input').on('itemAdded', function(event) {		
		setTagInputCount(this);
	});
	jQuery('input').on('itemRemoved', function(event) {		
		setTagInputCount(this);
	});
	jQuery('.add-more-button').on('click', function(event) {		
		height = jQuery(this).parents('.field-container').height();
		if(height<70){		
			jQuery(this).parents('.field-container').css("padding-bottom","60px");			
		}else{	
			height = height-34;
			jQuery(this).parents('.field-container').css("padding-bottom","");
			jQuery(this).css("top",height);			
		}
	}).trigger("click");
	jQuery('[readonly="readonly"]').attr("tabindex","-1");
	/*tcount = 0;
	ocount = 0;
	icount = 0;*/

	// $('label[for=SocialMediaDetailTwitter]').next().andSelf().wrapAll('<div class="col-md-3">');
	// $('.twitterLink').append("<div class='addmore-item-twitter'><div class='col-sm-2 editInnercls11'><label class='mob-show-label'>VVIP ID / Name</label><input type='text' name='Monitoring[twitter]["+tcount+"][field1]' value='' class='form-control'><i class='fa fa-remove' onclick='return removeItem(this,&#39;twitter&#39;);' data-id=''></i></div><div class='col-sm-2'><label class='mob-show-label'>Fake Account Name</label><input type='text' name='Monitoring[twitter]["+tcount+"][field2]' value='' class='form-control'><i class='fa fa-remove' onclick='return removeItem(this,&#39;twitter&#39;);' data-id=''></i></div><div class='col-sm-2'><label class='mob-show-label'>Fake Account Url</label><input type='text' name='Monitoring[twitter]["+tcount+"][field3]' value='' class='form-control'><i class='fa fa-remove' onclick='return removeItem(this,&#39;twitter&#39;);' data-id=''></i></div><div class='col-sm-2 editInnercls12'><div class='removeLink'><label class='mob-show-label'>Fake Account Status</label><input type='text' name='Monitoring[twitter]["+tcount+"][field4]' value='' class='form-control'><i class='fa fa-remove' onclick='return removeItem(this,&#39;twitter&#39;);' data-id=''></i></div></div></div>");
	
	// $('label[for=SocialMediaDetailInstagram]').next().andSelf().wrapAll('<div class="col-md-3">');
	// $('.instagramLink').append("<div class='addmore-item-instagram'><div class='col-sm-2 editInnercls11'><label class='mob-show-label'>VVIP ID / Name</label><input type='text' name='Monitoring[instagram]["+icount+"][field1]' value='' class='form-control'><i class='fa fa-remove' onclick='return removeItem(this,&#39;instagram&#39;);' data-id=''></i></div><div class='col-sm-2'><label class='mob-show-label'>Fake Account Name</label><input type='text' name='Monitoring[instagram]["+icount+"][field2]' value='' class='form-control'><i class='fa fa-remove' onclick='return removeItem(this,&#39;instagram&#39;);' data-id=''></i></div><div class='col-sm-2'><label class='mob-show-label'>Fake Account Url</label><input type='text' name='Monitoring[instagram]["+icount+"][field3]' value='' class='form-control'><i class='fa fa-remove' onclick='return removeItem(this,&#39;instagram&#39;);' data-id=''></i></div><div class='col-sm-2 editInnercls12'><div class='removeLink'><label class='mob-show-label'>Fake Account Status</label><input type='text' name='Monitoring[instagram]["+icount+"][field4]' value='' class='form-control'><i class='fa fa-remove' onclick='return removeItem(this,&#39;instagram&#39;);' data-id=''></i></div></div></div>");
	
	// $('label[for=SocialMediaDetailOther]').next().andSelf().wrapAll('<div class="col-md-3">');
	// $('.otherLink').append("<div class='addmore-item-other'><div class='col-sm-2 editInnercls11'><label class='mob-show-label'>VVIP ID / Name</label><input type='text' name='Monitoring[other]["+ocount+"][field1]' value='' class='form-control'><i class='fa fa-remove' onclick='return removeItem(this,&#39;other&#39;);' data-id=''></i></div><div class='col-sm-2'><label class='mob-show-label'>Fake Account Name</label><input type='text' name='Monitoring[other]["+ocount+"][field2]' value='' class='form-control'><i class='fa fa-remove' onclick='return removeItem(this,&#39;other&#39;);' data-id=''></i></div><div class='col-sm-2'><label class='mob-show-label'>Fake Account Url</label><input type='text' name='Monitoring[other]["+ocount+"][field3]' value='' class='form-control'><i class='fa fa-remove' onclick='return removeItem(this,&#39;other&#39;);' data-id=''></i></div><div class='col-sm-2 editInnercls12'><div class='removeLink'><label class='mob-show-label'>Fake Account Status</label><input type='text' name='Monitoring[other]["+ocount+"][field4]' value='' class='form-control'><i class='fa fa-remove' onclick='return removeItem(this,&#39;other&#39;);' data-id=''></i></div></div></div>");

	// $('.twitterLink').append('<a class = "pull-right btn btn-default twitterLinks">Add More <i class="fa fa-plus twitterFa"></i></a>');
	// $('.instagramLink').append('<a class = "pull-right btn btn-default instagramLinks">Add More <i class="fa fa-plus instagramFa"></i></a>');
	// $('.otherLink').append('<a class = "pull-right btn btn-default otherLinks">Add More <i class="fa fa-plus otherFa"></i></a>');
	
});

function removeItem(this1) {
    if (confirm("Are you sure you want to remove this?")) {
		setToId = jQuery(this1).parents('.field-container').data('settoid');
		selector = jQuery(this1).parents('.field-container').data('selector');
        jQuery(this1).closest('.addmore_item').remove();		
		setRowCount(setToId,selector);
    }
}
function setTagInputCount(curr){
	countId = jQuery(curr).data('id');	
	if(countId !=null){
		if(jQuery(curr).val()==0){
			jQuery("#"+countId).val(0);			
		}else{
			jQuery("#"+countId).val(jQuery(curr).val().split(",").length);
		}
	}
}
function setRowCount(setToId,selector,selectorType){
	//if(selectorType=='name'){
		selector = "[name='"+selector+"']";
	//}
	jQuery("#"+setToId).val(jQuery(selector).length);;	
	if(jQuery("#"+setToId).val()<1){
		jQuery("#"+setToId).parents('.field-container').find(".record-container").hide();
		jQuery("#"+setToId).parents('.field-container').find(".add-more-button").html("Click here to Add Record");
	}else{
		jQuery("#"+setToId).parents('.field-container').find(".record-container").show();
		jQuery("#"+setToId).parents('.field-container').find(".add-more-button").html("Add More");
	}

}
function statusCount(){
	arrStatus = {'reported':0,"shutdown":0,"blocked":0}
	jQuery(".offending-domains-status").each(function(index){
		currStatus = jQuery(this).val();
		arrStatus[currStatus] = arrStatus[currStatus]+1;
	});	
	jQuery("#OffendingDomainReported").val(arrStatus['reported']);
	jQuery("#OffendingDomainShutdown").val(arrStatus['shutdown']);
	jQuery("#OffendingDomainBlocked").val(arrStatus['blocked']);
	jQuery("#OffendingDomainTotal").val(arrStatus['reported']+arrStatus['shutdown']+arrStatus['blocked']);		
	if(jQuery("#OffendingDomainTotal").val()>0){
		jQuery(".offending-domain-label").show();
	}else{
		jQuery(".offending-domain-label").hide();
	}
}
function socialStatusCount(){
	arrStatus = {'reported':0,"shutdown":0}
	jQuery(".social-status").each(function(index){
		currStatus = jQuery(this).val();
		arrStatus[currStatus] = arrStatus[currStatus]+1;
	});	
	jQuery("#SocialMediaDetailReported").val(arrStatus['reported']);
	jQuery("#SocialMediaDetailShutdown").val(arrStatus['shutdown']);
}
