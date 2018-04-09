
// This is the wp-e-commerce front end javascript "library"

// this function is for binding actions to events and rebinding them after they are replaced by AJAX
// these functions are bound to events on elements when the page is fully loaded.
jQuery(document).ready(function () {
  	
	// Submit the product form using AJAX
	jQuery("form.product_form").submit(function() {
	 			
		form_values = jQuery(this).serialize();
		
		// Sometimes jQuery returns an object instead of null, using length tells us how many elements are in the object, which is more reliable than comparing the object to null
		if(jQuery('#fancy_notification').length == 0) {
			jQuery('div.wpsc_loading_animation',this).css('visibility', 'visible');
		}
		
		jQuery.post('index.php?ajax=true', form_values, function(returned_data) {
			
			eval(returned_data);

			//jQuery('div.wpsc_loading_animation').css('visibility', 'hidden');
			
			if(jQuery('#fancy_notification') != null) {
				jQuery('#loading_animation').css("display", 'none');
				//jQuery('#fancy_notificationimage').css("display", 'none');
			}
			//jQuery("#dragdrop_spinner").css('display', 'none');
		
			// jakal, refresh cart link
			my_refresh_cart_link();

		});
		
		wpsc_fancy_notification(this);		
		
		return false;
			
	});

});

// submit the fancy notifications forms.
function wpsc_fancy_notification(parent_form){
	
	if(typeof(WPSC_SHOW_FANCY_NOTIFICATION) == 'undefined'){
		WPSC_SHOW_FANCY_NOTIFICATION = true;
	}
	
	if((WPSC_SHOW_FANCY_NOTIFICATION == true) && (jQuery('#fancy_notification') != null)){
		
		var options = {
		  margin: 1 ,
		  border: 1 ,
		  padding: 1 ,
		  scroll: 1 
		};

		form_button_id = jQuery(parent_form).attr('id') + "_submit_button";
		
		//console.log(form_button_id);
		
		button_offset = jQuery('#'+form_button_id).offset();
		main_offset = jQuery('#main').offset();
		notification_width = jQuery('#fancy_notification').width();
		
		ppc_offset = jQuery('#products_page_container').offset();
		ppc_width = jQuery('#products_page_container').width()
		
		not_left = button_offset['left'] - notification_width / 2 + jQuery('#'+form_button_id).width() / 2;
		not_top = button_offset['top'] + 30;
		
		if(not_left < ppc_offset['left']){
			not_left = ppc_offset['left'] + 10;
		} 
		
		if(not_left + notification_width > ppc_offset['left'] + ppc_width){
			not_left = ppc_offset['left'] + ppc_width - notification_width - 10;
		} 

		//console.log(not_left);
		
		jQuery('#fancy_notification').css("display", 'block');
		jQuery('#loading_animation').css("display", 'block');
		jQuery('#fancy_notification_content').css("display", 'none');  
		
		jQuery('#fancy_notification').offset({top:not_top,left:not_left});
	}
	
}


