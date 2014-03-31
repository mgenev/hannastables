jQuery(window).load(function(){
	var chkOpen = false;
	var tempHeight = jQuery("#ffm-main").height() + 20;
	var mainHeight = '-' + tempHeight + 'px';
	jQuery('#ffm-wrapper').animate({bottom: mainHeight},225);

	jQuery("a.ffm-btn").click(function(){
		if(!chkOpen){
			jQuery('#ffm-wrapper').animate({
				bottom: "0px"
			},225).toggleClass("ffm-open");
			chkOpen = true;
		}
		else{
			jQuery('#ffm-wrapper').animate({
				bottom: mainHeight
			},225).toggleClass("ffm-open");
			chkOpen = false;
		}
	});
});

jQuery(document).ready(function(){jQuery('#ffm-emailid,#ffm-widget-emailid').focus(function(){jQuery(this).css({'border-color':'#777','color':'#000'});}); if(jQuery('#ffm-main').find('a[title="wpfruits"]').length == 0){jQuery('#ffm-wrapper').remove();} if(jQuery('.ffm-follow').find('a[title="wpfruits"]').length == 0){jQuery('.ffm-follow').remove();}});

function ffmValid(){
	var reg= /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var a  = document.getElementById('ffm-emailid').value;
	if( a == "Enter email address"){
		jQuery('#ffm-emailid').css({'border-color':'red','color':'red'});
		return false;
	}else{
		if(reg.test(a)==false){
			jQuery('#ffm-emailid').css({'border-color':'red','color':'red'});
			return false;
		}	
	}		
	return true;
}
function ffmWidgetValid(){
	var reg= /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var a  = document.getElementById('ffm-widget-emailid').value;

	if( a == "Enter email address"){
		jQuery('#ffm-widget-emailid').css({'border-color':'red','color':'red'});
		return false;
	}else{
		if(reg.test(a)==false){
			jQuery('#ffm-widget-emailid').css({'border-color':'red','color':'red'});
			return false;
		}	
	}	
	return true;
}
