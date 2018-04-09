
function my_refresh_cart_link(){
	jQuery.ajax({
		type:'GET',
		url:'/?wpsc_ajax_action=get_cart_class',
		contentType:'application/json; charset=utf-8',
		dataType:'json',
		success:function(data){
			//console.log(data);
			jQuery('.cart_link_js').html(data['link_text']);
			var cc =data['cart_class'];
			if(cc != ''){
				if(!jQuery('.cart_link_js').hasClass(cc)){
					jQuery('.cart_link_js').addClass(cc);
				}
			} else {
				jQuery('.cart_link_js').removeClass(cc);
			}
		},
		complete:function(foo,status){
			//console.log(status);
		}
	});
}

jQuery(function($) {

	$(document).click(function() {	
		$(".top-level-menuitem").removeClass("dropdown-open");
		$(".dropdown-menu").hide();
		$(".dropdown_usermenu").hide();
		$(".dropdown_destmenu").hide();
		$("#fancy_notification").hide();
	});

	$("#fancy_notification").click(function(event) {
		return false;
	});

	$(".ttip_stock_js").hover(function(){
		var qwas = $(this).parent();
		$(".ttip_stock", qwas).show();
	},function(){
		$('.ttip_stock').hide();
	});

	$(".product_image_js").hover(function(){
		var qwas = $(this).parent();
		$(".ttip_image", qwas).show();
	},function(){
		$('.ttip_image').hide();
	});

	$(".usermenu_js").click(function(event) {
		$(".top-level-menuitem").removeClass("dropdown-open");
		$(".dropdown-menu").hide();
		$(".dropdown_destmenu").hide();
		$(".dropdown_usermenu").toggle();
		$("#fancy_notification").hide();
		return false;
	});

	$(".destmenu_js").click(function(event) {
		$(".top-level-menuitem").removeClass("dropdown-open");
		$(".dropdown-menu").hide();
		$(".dropdown_usermenu").hide();
		$(".dropdown_destmenu").toggle();
		$("#fancy_notification").hide();
		return false;
	});

	$(".dropdown_usermenu a").click(function(event) {
		window.location = this.href;
		return false;
	});

	$(".dropdown_usermenu").click(function(event) {
		return false;
	});

	$(".dropdown_destmenu a").click(function(event) {
		window.location = this.href;
		return false;
	});

	$(".dropdown_destmenu").click(function(event) {
		return false;
	});

	$(".top-level-menuitem a").click(function(event) {
		//alert("top-level-menuitem a");
		window.location = this.href;
		return false;
	});

	$(".top-level-menuitem").click(function(event) {
		//alert("top-level-menuitem");
		return false;
	});
	
	$(".top-level-link").click(function(event) {
		//alert("top-level-link");
		var qwas = $(this).parent();
		if(qwas.hasClass("dropdown-open")){
			qwas.removeClass("dropdown-open");
			$("div.dropdown-menu:first",qwas).hide();
		} else {
			$("#fancy_notification").hide();
			$(".dropdown_usermenu").hide();
			$(".dropdown_destmenu").hide();
			$(".top-level-menuitem").removeClass("dropdown-open");
			$(".dropdown-menu").hide();
			qwas.addClass("dropdown-open");
			$("div.dropdown-menu:first",qwas).show();
		}
		return false;
	});
	
	$(".fb_ask_a_quest_link").click(function(){
		var t0 = Math.max(20, $(window).scrollTop() + ($(window).height() - $('#ask_a_question_box').outerHeight())/2);	
		$("#ask_a_question_box").css("top", t0 + "px");
		$(".fb_overlay").show();	
		$("#ask_a_question_box").show();
		return false;
	});

	$(".fb_vyzov_link").click(function(){
		var t0 = Math.max(20, $(window).scrollTop() + ($(window).height() - $('#fb_vyzov').outerHeight())/2);	
		$("#fb_vyzov").css("top", t0 + "px");
		$(".fb_overlay").show();	
		$("#fb_vyzov").show();
		return false;
	});

	$("#metro-link").click(function(){
		var t0 = $(window).height()/2-$("#metro_map").height()/3*2;
		if(t0<10){t0=10;}
		$(".fb_overlay").show();	
		$("#metro_map").css("top",t0+"px");
		$("#metro_map").show();
		return false;
	});

	$(".cdsl_show_js").click(function(event) {
		$(".cdsr_hidden").css("display", "table-row");
		$(".cdsl_show_js").css("display", "none");
		$(".cdsl_hide_js").css("display", "inline-block");
		return false;
	});

	$(".cdsl_hide_js").click(function(event) {
		$(".cdsr_hidden").css("display", "none");
		$(".cdsl_hide_js").css("display", "none");
		$(".cdsl_show_js").css("display", "inline-block");
		return false;
	});
	
	function reset_fb_errors(){
		$(".fb_error_js").css("border-color","#bbb");
		$(".fb_sent_error_js").html("");
		$(".fb_sent_success").hide();
		$(".fb_sent_fail").hide();
		$(".fb_sent_error_js").hide();
	}

	function reset_fb_box(){
		reset_fb_errors();
		$(".fb_overlay").hide();
		$(".fb_wrapper").hide();
		$(".fb_button_close").hide();
		$(".fb_js_content").show();
	}
	
	$(".fb_js_box_close").click(function() {
		reset_fb_box();
		return false;
	});

	$("#ask_a_question_submit").click(function() {
		
		var is_error = false;
		
		reset_fb_errors();
		
		if($("#ask_a_question_box #fb_ask_contact").val() == ""){
			is_error = true;
			$("#ask_a_question_box .fb_sent_error_js").html("Укажите контактные данные.");
			$("#ask_a_question_box .fb_sent_error_js").show(200);
			$("#ask_a_question_box #fb_ask_contact").css("border-color","orangered");
		}
		
		if(!is_error){
			
			$("#ask_a_question_box .fb_wait_gif_js").show();
			
			$.ajax({
				type: "POST",
				url: ajax_object.ajax_url,
				data: { 
					'action': 'sendMessage',
					'type': 'askQuestion',
					'parameters': {
						'name': $("#fb_ask_name").val(),
						'message': $("#fb_ask_message").val(),
						'contact': $("#fb_ask_contact").val()
					}
				},
				success: function(response) {
					if (response == 1) {
						$("#ask_a_question_box .fb_sent_success").show(200);
						//$("#ask_a_question_box .fb_textarea").val("");
						//$("#ask_a_question_box .fb_str").val("");
						yaCounter145402.reachGoal('zadat_vopros'); // цель для Маркета
					}
					else { 
						$("#ask_a_question_box .fb_sent_fail").show(200);
					}
				}, 
				error: function() {
					$("#ask_a_question_box .fb_sent_fail").show(200);
				}, 
				complete:function(){
					$("#ask_a_question_box .fb_wait_gif_js").hide();
					$("#ask_a_question_box .fb_js_content").hide(200);
					$("#ask_a_question_box .fb_button_close").show();
				}
			});
			
		}
		
		return false;
		
	});

	$("#fb_vyzov_submit").click(function() {
		
		var is_error = false;
		
		reset_fb_errors();
		
		if($("#fb_vyzov #fb_vyzov_address").val() == ""){
			is_error = true;
			$("#fb_vyzov .fb_sent_error_js").html("Укажите адрес, куда приедет курьер.");
			$("#fb_vyzov .fb_sent_error_js").show(200);
			$("#fb_vyzov #fb_vyzov_address").css("border-color","orangered");
		} else if($("#fb_vyzov #fb_vyzov_contact").val() == ""){
			is_error = true;
			$("#fb_vyzov .fb_sent_error_js").html("Укажите контактные данные.");
			$("#fb_vyzov .fb_sent_error_js").show(200);
			$("#fb_vyzov #fb_vyzov_contact").css("border-color","orangered");
		}

		if(!is_error){
			
			$("#fb_vyzov .fb_wait_gif_js").show();
			
			$.ajax({
				type: "POST",
				url: ajax_object.ajax_url,
				data: { 
					'action': 'sendMessage',
					'type': 'getСourier',
					'parameters': {
						'name': $("#fb_vyzov_name").val(),
						'goods': $("#fb_vyzov_cart").val(),
						'address': $("#fb_vyzov_address").val(),
						'contact': $("#fb_vyzov_contact").val()
					}
				},
				success: function(response) {
					if (response == 1) {
						$("#fb_vyzov .fb_sent_success").show(200);
						//$("#fb_vyzov .fb_str").val("");
						yaCounter145402.reachGoal('vyzov_kuriera'); // цель для Маркета
					}
					else { 
						$("#fb_vyzov .fb_sent_fail").show(200);
					}
				}, 
				error: function() {
					$("#fb_vyzov .fb_sent_fail").show(200);
				},
				complete:function(){
					$("#fb_vyzov .fb_wait_gif_js").hide();
					$("#fb_vyzov .fb_js_content").hide(200);
					$("#fb_vyzov .fb_button_close").show();
				}
			});

		}
		
		return false;
		
	});
	
	$(".fb_vyzov_address_js").suggestions({
        serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
        token: "06d110ec5168bc840a8a62f26689f91a73fe7292",
        type: "ADDRESS",
        count: 5,
        onSelect: function(suggestion) {
			jQuery(".fb_vyzov_address_js").val(suggestion.value);
        }
    });

	$(".fb_vyzov_name_js, .fb_ask_name_js").suggestions({
        serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
        token: "06d110ec5168bc840a8a62f26689f91a73fe7292",
        type: "NAME",
        count: 5,
        onSelect: function(suggestion) {
			jQuery(".fb_vyzov_name_js").val(suggestion.value);
        }
    });

});