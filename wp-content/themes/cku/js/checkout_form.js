
function select_payment_methods(is_delivery){
	
	var is_person = jQuery("input[name='collected_data[25]']:checked").val() == "person" ? true : false;
	var is_prepayment = jQuery("input[name='is_prepayment']").val() == "yes" ? true : false;
	var own_delivery = jQuery('.cf_address_js').data('own-delivery') == "1" ? true : false;
	
	jQuery("input[value='cash_on_delivery']").parent().hide();
	jQuery("input[value='online']").parent().hide();
	jQuery("input[value='invoice']").parent().hide();
	jQuery("input[value='cash_in_store']").parent().hide();
	jQuery("input[value='card_in_store']").parent().hide();
	jQuery("input[value='sberbank']").parent().hide();
	
	if(!is_delivery && !is_person){
		jQuery("input[value='invoice']").parent().show();
	}
	
	if(!is_delivery && is_person){
		jQuery("input[value='online']").parent().show();
		jQuery("input[value='invoice']").parent().show();
		jQuery("input[value='cash_in_store']").parent().show();
		jQuery("input[value='card_in_store']").parent().show();
		jQuery("input[value='sberbank']").parent().show();
	}

	if(is_delivery && !is_person){
		jQuery("input[value='invoice']").parent().show();
	}

	if(is_delivery && is_person){
		if(!is_prepayment && own_delivery) jQuery("input[value='cash_on_delivery']").parent().show();
		jQuery("input[value='online']").parent().show();
		jQuery("input[value='invoice']").parent().show();
		jQuery("input[value='sberbank']").parent().show();
	}
	
	var parent = jQuery("input[name='collected_data[32]']:checked").parent();
	
	if(!parent.is(':visible')){
		(jQuery("input[name='collected_data[32]']").parent()).each(function(){
			if(jQuery(this).is(':visible')){
				jQuery(this).children().prop("checked", true);
			}
		});
	}

}

/*function getDestinations(){
	jQuery('.cf_destination_js').empty();
	jQuery('.cf_destination_js').append('<option>Загрузка...</option>');
	jQuery.ajax({
		type:'POST',
		url:'/?wpsc_ajax_action=shipping_api&action=getDestinations',
		contentType:'application/json; charset=utf-8',
		dataType:'json',
		success:function(data){
			jQuery('.cf_destination_js').empty();
			jQuery.each(data,function(i,item){
				if(data[i].selected == 1){
					jQuery('.cf_destination_js').append('<option selected value="'+data[i].id+'">'+data[i].name+'</option>');
				} else {
					jQuery('.cf_destination_js').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
				}
			});
		},
		complete:function(){			
		}
	});
}*/

jQuery(document).ready(function(){
	
	//getDestinations();
	//console.log(jQuery(".cf_address_js").data("fias-id"));
		
	jQuery(".cf_selfaddress_js").click(function(event){
		jQuery(".cs_selfaddress_map_js").toggle();
	});
	
	jQuery(".make_purchase_js").click(function(event){
		
		jQuery(".cf_err_js").hide();
		jQuery("input[name='collected_data[4]']").css("border-color","#bbb");
		jQuery("input[name='collected_data[8]']").css("border-color","#bbb");
		jQuery("input[name='collected_data[17]']").css("border-color","#bbb");
		jQuery("input[name='collected_data[8]']").css("border-color","#bbb");
		
		var is_error = false;
		
		if(jQuery("input[name='collected_data[17]']").attr("value") == "" && jQuery("input[name='collected_data[8]']").attr("value") == ""){
			is_error = true;
			jQuery(".cf_err_1_js").show(200);
			if(jQuery("input[name='collected_data[17]']").attr("value") == ""){
				jQuery("input[name='collected_data[17]']").css("border-color","orangered");
			}
			if(jQuery("input[name='collected_data[8]']").attr("value") == ""){
				jQuery("input[name='collected_data[8]']").css("border-color","orangered");
			}
		}
		
		var is_delivery = jQuery(".dest_pickup_js").hasClass("dest_delivery_active") ? false : true;
		if(!is_error && is_delivery && jQuery("input[name='collected_data[4]']").attr("value") == ""){
			is_error = true;
			jQuery(".cf_err_2_js").show(200);
			jQuery("input[name='collected_data[4]']").css("border-color","orangered");
		}
		if(!is_error && is_delivery && jQuery("input[name='collected_data[41]']").attr("value") == ""){
			is_error = true;
			jQuery(".cf_err_6_js").show(200);
			jQuery("input[name='collected_data[41]']").css("border-color","orangered");
		}
		
		if(!is_error && jQuery("input[name='collected_data[8]']").attr("value") == "" && jQuery("input[name='collected_data[32]']:checked").attr("value") == "online"){
			is_error = true;
			jQuery(".cf_err_3_js").show(200);
			jQuery("input[name='collected_data[8]']").css("border-color","orangered");
		}
		
		if(!is_error && jQuery("input[name='collected_data[8]']").attr("value") == "" && jQuery("input[name='collected_data[32]']:checked").attr("value") == "invoice"){
			is_error = true;
			jQuery(".cf_err_4_js").show(200);
			jQuery("input[name='collected_data[8]']").css("border-color","orangered");
		}
		
		if(!is_error && jQuery("input[name='collected_data[8]']").attr("value") == "" && jQuery("input[name='collected_data[32]']:checked").attr("value") == "sberbank"){
			is_error = true;
			jQuery(".cf_err_5_js").show(200);
			jQuery("input[name='collected_data[8]']").css("border-color","orangered");
		}

		if(is_error == true){
			event.preventDefault();
		}

	});

	jQuery(".dest_delivery_js").click(function(evt){
		
		var CartTotal;
		var is_delivery;
		//var DestinationUnknown;
		
		if(jQuery(".dest_delivery_js").hasClass("dest_delivery_active")){
			return;
		}

		jQuery(".dest_delivery_wait_gif_js").show();
		
		jQuery.ajax({
			type:'POST',
			url:'/?wpsc_ajax_action=shipping_api&action=setShippingOptionDelivery',
			contentType:'application/json; charset=utf-8',
			dataType:'json',
			success:function(data){
				CartTotal = data.CartTotal;
				is_delivery = data.ShippingOption == 'delivery' ? true : false;
				//DestinationUnknown = data.DestinationUnknown;
			},
			complete:function(){			
				
				jQuery('.cs_shipping_total_js').html(" с доставкой");
				jQuery('.cart_total_js').html(CartTotal);
				
				/*if(DestinationUnknown == 1){
					jQuery(".cf_delivery_city_js").show(500);
				}*/
				jQuery(".cf_delivery_js").show(500);
				
				select_payment_methods(is_delivery);
				
				jQuery(".dest_delivery_wait_gif_js").hide();
				jQuery(".dest_pickup_js").removeClass("dest_delivery_active");		
				jQuery(".dest_delivery_js").addClass("dest_delivery_active");
				
			}
		});
		
		jQuery(".self_title_js").hide();					
		jQuery(".deli_title_js").show();
		jQuery(".ddate_total_self_js").hide();
		jQuery(".ddate_total_deli_js").show();

		jQuery('.cf_address_title_js').html("Адрес для доставки");

		jQuery(".cf_selfservice_js").hide();						
		
	});

	jQuery(".dest_pickup_js").click(function(evt){
		
		var CartTotal;
		var is_delivery;
		
		if(jQuery(".dest_pickup_js").hasClass("dest_delivery_active")){
			return;
		}
		
		jQuery(".dest_pickup_wait_gif_js").show();
		
		jQuery.ajax({
			type:'POST',
			url:'/?wpsc_ajax_action=shipping_api&action=setShippingOptionPickup',
			contentType:'application/json; charset=utf-8',
			dataType:'json',
			success:function(data){
				CartTotal = data.CartTotal;
				is_delivery = data.ShippingOption == 'delivery' ? true : false;
			},
			complete:function(){			
				
				jQuery('.cs_shipping_total_js').html("");
				jQuery('.cart_total_js').html(CartTotal);
				
				select_payment_methods(is_delivery);
				
				jQuery(".dest_pickup_wait_gif_js").hide();
				jQuery(".dest_delivery_js").removeClass("dest_delivery_active");
				jQuery(".dest_pickup_js").addClass("dest_delivery_active");
				
			}
		});
		
		jQuery(".deli_title_js").hide();					
		jQuery(".self_title_js").show();
		jQuery(".ddate_total_deli_js").hide();
		jQuery(".ddate_total_self_js").show();
		
		jQuery('.cf_address_title_js').html("Пункт выдачи");

		jQuery(".cf_delivery_js").hide();
		//jQuery(".cf_delivery_city_js").hide();
		jQuery(".cf_selfservice_js").show(500);
		
	});

	jQuery("input[name='collected_data[25]']").click(function(evt){

		if(jQuery(this).prop("value") == "organization"){
			jQuery(".cf_org_wr_js").show(500);
		} else {
			jQuery(".cf_org_wr_js").hide(500);
			jQuery(".cf_org_js").val("");
		}
		
		var is_delivery = jQuery(".dest_pickup_js").hasClass("dest_delivery_active") ? false : true;
		select_payment_methods(is_delivery);
		
	});
	
	jQuery(".cf_org_name_js, .cf_org_inn_js").suggestions({
        serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
        token: "06d110ec5168bc840a8a62f26689f91a73fe7292",
        type: "PARTY",
        count: 5,
        onSelect: function(suggestion) {
			jQuery("input[name='collected_data[27]']").val(suggestion.value);
			jQuery("input[name='collected_data[28]']").val(suggestion.data.address.value);
			jQuery("input[name='collected_data[29]']").val(suggestion.data.inn);
			jQuery("input[name='collected_data[30]']").val(suggestion.data.kpp);
			jQuery("input[name='collected_data[31]']").val(suggestion.data.ogrn);
        }
    });	

	jQuery(".cf_org_bank_js, .cf_org_bik_js").suggestions({
        serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
        token: "06d110ec5168bc840a8a62f26689f91a73fe7292",
        type: "BANK",
        count: 5,
        onSelect: function(suggestion) {
			jQuery("input[name='collected_data[38]']").val(suggestion.value);
			jQuery("input[name='collected_data[39]']").val(suggestion.data.bic);
        }
    });	

	jQuery(".cf_fio_js").suggestions({
        serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
        token: "06d110ec5168bc840a8a62f26689f91a73fe7292",
        type: "NAME",
        count: 5,
        onSelect: function(suggestion) {
			jQuery("input[name='collected_data[2]']").val(suggestion.value);
        }
    });	

	jQuery(".cf_email_js").suggestions({
        serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
        token: "06d110ec5168bc840a8a62f26689f91a73fe7292",
        type: "EMAIL",
        count: 5,
        onSelect: function(suggestion) {
			jQuery("input[name='collected_data[8]']").val(suggestion.value);
        }
    });

	var fias_type = jQuery(".cf_address_js").data("fias-type");
	var fias_id = jQuery(".cf_address_js").data("fias-id");
	
	var params = {
        serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
        token: "06d110ec5168bc840a8a62f26689f91a73fe7292",
        type: "ADDRESS",
        count: 5,
		constraints: {
			//label: "",
			locations: {},
			//deletable: true
		},
		//restrict_value: true,
		onSelect: function(suggestion) {
			jQuery("input[name='collected_data[4]']").val(suggestion.value);
        }
    };
	
	params['constraints']['locations'][fias_type] = fias_id;

	jQuery(".cf_address_js").suggestions(params);	

});