<?php

require_once('../../../wp-load.php');

$result = array(
	'result' => 0, 
	'error' => '', 
	'data' => array(
		'shipping' => array(
			'is_available' => null,
			'cost' => null, 
			'name' => '', 
			'string' => '',
			'order_for_delivery' => null,
			'order_for_free_delivery' => null
		)
	)
);

if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'){

	//if(isset($_GET['cart_total']) && isset($_GET['destination_id'])){
		
		if(is_numeric($_GET['cart_total']) && ctype_digit($_GET['destination_id'])){
			
			$cart_total = $_GET['cart_total'];
			$destination_id = $_GET['destination_id'];

			$ship = new my_shipping();
			
			if(my_get_destinations($destination_id) !== null){
			
				$result['data']['shipping']['order_for_delivery'] = $ship->getMinCartForDelivery($destination_id);
				$result['data']['shipping']['order_for_free_delivery'] = $ship->getMinCartForFreeDelivery($destination_id);
				
				$results = $ship->getPriceMethodQuote((float)$cart_total, $destination_id);
				
				if($results !== null){
				
					$result['data']['shipping']['is_available'] = 1;
					$result['data']['shipping']['cost'] = (float)$results['shipping_cost'];
					$result['data']['shipping']['name'] = $results['shipping_method_name'];
					$result['data']['shipping']['string'] = my_get_shipping_string((float)$results['shipping_cost'], $results['shipping_method_name']);
					
				} else $result['data']['shipping']['is_available'] = 0;
				
				$result['result'] = 1;
				
			} else $result['error'] = 'Указанный регион не существует';
			
		} else $result['error'] = 'Параметры не переданы или не являются числами';
		
	//} else $result['error'] = 'Не переданы необходимые параметры';
	
} else $result['error'] = 'Доступ только по HTTPS';

if($result['result'] == 0 && $result['error'] == '') $result['error'] = 'Неизвестная ошибка';

header('Content-type:application/json;charset=utf-8');
echo json_encode($result);

exit();

?>