function Makers(){
	jQuery('.cs_makers_js').empty();
	jQuery('.cs_makers_js').append('<option>Загрузка...</option>');
	var maker_id = jQuery('.cs_makers_js').attr('maker_id');
	jQuery.ajax({
		type:'GET',
		url:'/?wpsc_ajax_action=compat_get_makers',
		contentType:'application/json; charset=utf-8',
		dataType:'json',
		success:function(data){
			jQuery('.cs_makers_js').empty();
			jQuery('.cs_makers_js').append('<option value="0">Выберите производителя...</option>');
			jQuery.each(data,function(i,item){
				if(data[i].id == maker_id){
					jQuery('.cs_makers_js').append('<option selected value="'+data[i].id+'">'+data[i].maker+'</option>');
				} else {
					jQuery('.cs_makers_js').append('<option value="'+data[i].id+'">'+data[i].maker+'</option>');
				}
			});
		},
		complete:function(){
			jQuery('.cs_makers_js').prop('disabled', false);
			if(maker_id != undefined && maker_id != 0) { Families(maker_id); }
		}
	});
}

function Families(maker_id){
	jQuery('.cs_families_js').append('<option>Загрузка...</option>');
	var family_id = jQuery('.cs_families_js').attr('family_id');
	jQuery.ajax({
		type:'GET',
		url:'/?wpsc_ajax_action=compat_get_families&maker_id=' + maker_id,
		contentType:'application/json; charset=utf-8',
		dataType:'json',
		success:function(data){
			jQuery('.cs_families_js').empty();
			jQuery('.cs_families_js').append('<option value="0">Выберите серию...</option>');
			jQuery.each(data,function(i,item){
				var family_name = data[i].family == "" ? "<Без серии>" : data[i].family;
				if(data[i].id == family_id){
					jQuery('.cs_families_js').append('<option selected value="'+data[i].id+'">'+family_name+'</option>');
				} else {
					jQuery('.cs_families_js').append('<option value="'+data[i].id+'">'+family_name+'</option>');
				}
			});
		},
		complete:function(){
			jQuery('.cs_families_js').prop('disabled', false);
			if(family_id != undefined && family_id != 0) { Devices(family_id); }
		}
	});
}

function Devices(family_id){
	jQuery('.cs_devices_js').append('<option>Загрузка...</option>');
	var device_id = jQuery('.cs_devices_js').attr('device_id');
	jQuery.ajax({
		type:'GET',
		url:'/?wpsc_ajax_action=compat_get_devices&family_id=' + family_id,
		contentType:'application/json; charset=utf-8',
		dataType:'json',
		success:function(data){
			jQuery('.cs_devices_js').empty();
			jQuery('.cs_devices_js').append('<option value="0">Выберите модель...</option>');
			jQuery.each(data,function(i,item){
				if(data[i].id == device_id){
					jQuery('.cs_devices_js').append('<option selected value="'+data[i].id+'">'+data[i].device+'</option>');
				} else {
					jQuery('.cs_devices_js').append('<option value="'+data[i].id+'">'+data[i].device+'</option>');
				}
			});
		},
		complete:function(){
			jQuery('.cs_devices_js').prop('disabled', false);
			if(device_id != undefined && device_id != 0) { RowsCount(device_id); }
		}
	});
}

function RowsCount(device_id){
	/*jQuery.ajax({
		type:'POST',
		url:'/wp-content/themes/cku/compat-getRowsCount.php?device_id=' + device_id + '&type=goods',
		contentType:'text/plain; charset=utf-8',
		dataType:'text',
		success:function(data){
			jQuery("button[value='goods']").attr('sub_count', ' ' + data);
		}
	});
	jQuery.ajax({
		type:'POST',
		url:'/wp-content/themes/cku/compat-getRowsCount.php?device_id=' + device_id + '&type=service',
		contentType:'text/plain; charset=utf-8',
		dataType:'text',
		success:function(data){
			jQuery("button[value='service']").attr('sub_count', ' ' + data);
		}
	});*/
}

jQuery(document).ready(function(){
	jQuery('.cs_makers_js').prop('disabled', true);
	jQuery('.cs_families_js').prop('disabled', true);
	jQuery('.cs_devices_js').prop('disabled', true);
	Makers();
	jQuery('.cs_button_js').click(function(evt){
		var device_id = jQuery('.cs_devices_js').val();
		if(device_id == null || device_id == 0) {
			yaCounter145402.reachGoal('podbor_po_apparatu_fail'); // цель для Маркета
			return false;
		}
		yaCounter145402.reachGoal('podbor_po_apparatu'); // цель для Маркета
	});
	jQuery('.cs_makers_js').change(function(){
		var maker_id = jQuery('.cs_makers_js').val();
		jQuery('.cs_families_js').prop('disabled', true);
		jQuery('.cs_families_js').empty();
		jQuery('.cs_devices_js').prop('disabled', true);
		jQuery('.cs_devices_js').empty();
		//jQuery('.cs_button_js').attr('sub_count', ' ?');
		if(maker_id != 0) Families(maker_id);
	});
	jQuery('.cs_families_js').change(function(){
		var family_id = jQuery('.cs_families_js').val();
		jQuery('.cs_devices_js').prop('disabled', true);
		jQuery('.cs_devices_js').empty();
		//jQuery('.cs_button_js').attr('sub_count', ' ?');
		if(family_id != 0) Devices(family_id);
	});	
	jQuery('.cs_devices_js').change(function(){
		var device_id = jQuery(this).val();
		if(device_id != 0) RowsCount(device_id);
	});
});
