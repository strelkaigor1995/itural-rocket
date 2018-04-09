<?php

require_once('../../../wp-load.php');

$result = array('result' => 0, 'error' => '', 'data' => array('order_id' => null));
$input = json_decode(file_get_contents('php://input'), true);

if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'){

	if(is_array($input)){
		
		if(is_int($input['is_delivery'])){
			
			$cart = new wpsc_cart();
			
			if($input['is_delivery'] == 1){

				if(is_int($input['form_fields'][42])){ // это код региона
					
					$cart->update_location($input['form_fields'][42]);
					$cart->update_shipping($cart->selected_shipping_method, 'delivery');
					
				} else $result['error'] = 'Код региона не указан или имеет неверный формат';
				
				if(!is_string($input['form_fields'][4]) || trim($input['form_fields'][4]) == '') // адрес доставки
					$result['error'] = 'Адрес доставки не указан';
				
			} else {
				$cart->update_shipping($cart->selected_shipping_method, 'pickup');
			}
			
			if((!is_string($input['form_fields'][8]) || trim($input['form_fields'][8]) == '') && (!is_string($input['form_fields'][17]) || trim($input['form_fields'][17]) == ''))
				$result['error'] = 'Не указаны контактные данные'; // телефон и почта
			
			if($result['error'] == ''){
				
				if(is_array($input['products'])){
				
					$parms['variation_values'] = null;
					$parms['provided_price'] = null;
					$parms['comment'] = null;
					$parms['time_requested']= null;
					$parms['custom_message'] = null;
					$parms['file_data'] = null;
					$parms['is_customisable'] = false;
					$parms['meta'] = null;

					foreach($input['products'] as $product){
						
						if(!is_int($product['quantity'])) $result['error'] = 'Количество товара не указано или имеет неверный формат';
						if(!is_int($product['id'])) $result['error'] = 'Код товара не указан или имеет неверный формат';
						
						if($result['error'] == ''){
							
							if($product['quantity'] > 0){
								$parms['quantity'] = $product['quantity'];
								if(!$cart->set_item($product['id'], $parms)) $result['error'] = 'Неизвестная ошибка при сохранении товара';
							}

						}

					}
					
					if($cart->calculate_subtotal() < $cart->my_shipping_destination['min_cart_for_delivery'])
						$result['error'] = 'Сумма заказа меньше, чем минимальная сумма заказа для доставки по региону';
					
					if($result['error'] == ''){
						
						$sessionid = (mt_rand(100,999).time());
						$submitted_gateway = 'api'; // чтобы видеть, что заказ оформлен через API

						// debug // $purchase_log_id = my_purchase_log_save_to_db($cart, $sessionid, $submitted_gateway);
						/* debug */ $purchase_log_id = mt_rand(1000,9990);

						if($purchase_log_id !== null){
							
							// debug // $cart->save_to_db($purchase_log_id);
							
							$checkout = new wpsc_checkout();
							// debug // $checkout->save_forms_to_db($purchase_log_id, $input['form_fields']);
							
							// debug // transaction_results($sessionid, false, null, $cart);
							
							$result['data']['order_id'] = $purchase_log_id;
							$result['result'] = 1;
							
						}  else $result['error'] = 'Неизвестная ошибка при сохранении заказа';
						
					}
					
				} else $result['error'] = 'Список товаров не указан или имеет неверный формат';
				
			}
		
		} else $result['error'] = 'Признак доставки не указан или имеет неверный формат';
		
	} else $result['error'] = 'Параметры не переданы или имеют неверный формат';
	
} else $result['error'] = 'Доступ только по HTTPS';	

if($result['result'] == 0 && $result['error'] == '') $result['error'] = 'Неизвестная ошибка';

header('Content-type:application/json;charset=utf-8');
echo json_encode($result);

exit();

?>