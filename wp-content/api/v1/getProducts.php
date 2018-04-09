<?php

require_once('../../../wp-load.php');

$result = array(
	'result' => 0, 
	'error' => '', 
	'data' => array(
		'device_name' => '', 
		'device_url' => '', 
		'products' => array()
	)
);

if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'){

	//if(isset($_GET['device_id'])){
		
		//$device_id = preg_replace('/[^0-9]/i','',$_GET['device_id']);
		
		if(ctype_digit($_GET['device_id'])){
			
			$device_id = $_GET['device_id'];
			
			if($wpdb->get_var("select id from compat_devices where id = {$device_id}") !== null){
			
				//$result['data']['device_id'] = $device_id;
				
				$result['data']['device_name'] = cs_get_device_name($device_id);
				$result['data']['device_url'] = cs_get_device_url($device_id);

				$wpsc_query = new WPSC_Query(array('device_id' => $device_id, 'sort_order' => 'ASC'));
				
				while (wpsc_have_products()) {  
				
					wpsc_the_product(); 
					wpsc_the_product_thumbnail();
					
					$p_id = wpsc_the_product_id();
					
					$deliverydays = get_product_meta($p_id,'deliverydays',true);
					$usluga = get_product_meta($p_id,'usluga',true);
					
					$picture = wpsc_the_product_image();
				
					$result['data']['products'][] = array(
						'id' => (int)$p_id, 
						'name' => wpsc_the_product_title(), 
						'stock' => my_get_stock_str($usluga, $deliverydays), 
						'price' => (float)calculate_product_price($p_id), 
						'is_service' => (int)$usluga,
						'picture' => ($picture !== false)?$picture:'', 
						'thumbnail' => ($picture !== false)?wpsc_the_product_thumbnail():'',
						'url' => wpsc_the_product_permalink($wpsc_query->product['category_id'])
					);
				
				}
				
				$result['result'] = 1;
				
			} else $result['error'] = 'Нет аппарата с указанным идентификатором';
			
		} else $result['error'] = 'Идентификатор аппарата не указан или не является целочисленным числом больше нуля';
		
	//} else $result['error'] = 'Не передан идентификатор аппарата';
	
} else $result['error'] = 'Доступ только по HTTPS';

if($result['result'] == 0 && $result['error'] == '') $result['error'] = 'Неизвестная ошибка';

header('Content-type:application/json;charset=utf-8');
echo json_encode($result);

exit();

?>