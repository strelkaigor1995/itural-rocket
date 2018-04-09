<?php

require_once('../../../wp-load.php');

$result = array('result' => 0, 'error' => '', 'data' => array());

if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'){

	if(empty($_GET)){  // запрос на производителей
		
		// такой же запрос в \wp-content\plugins\wp-e-commerce\wpsc-includes\ajax.functions.php
		
		$result['data']['makers'] = array();
		
		$results = $wpdb->get_results("SELECT m.id, m.maker FROM compat_makers m WHERE active=1 ORDER BY m.maker", ARRAY_A);
		
		if(!empty($results)){
			
			$result['result'] = 1;
		
			foreach($results as $row){
				$result['data']['makers'][] = array('id' => (int)$row['id'], 'name' => $row['maker']);
			}
			
		}  else $result['error'] = 'Не могу выполнить запрос на производителей';
		
	} else {
		
		if(isset($_GET['maker_id'])){ // запрос на серии
		
			$result['data']['families'] = array();		
			
			//$maker_id = preg_replace('/[^0-9]/i','',$_GET['maker_id']);
			
			if(ctype_digit($_GET['maker_id'])){
				
				// такой же запрос в \wp-content\plugins\wp-e-commerce\wpsc-includes\ajax.functions.php
				
				$results = $wpdb->get_results("SELECT f.id, f.family FROM compat_families f LEFT JOIN compat_makers m ON f.maker_id=m.id WHERE m.id={$_GET['maker_id']} AND f.active=1 ORDER BY f.family", ARRAY_A);
				
				if(!empty($results)){
					
					$result['result'] = 1;
				
					foreach($results as $row){
						$family = empty($row['family'])?'<Без серии>':$row['family'];
						$result['data']['families'][] = array('id' => (int)$row['id'], 'name' => $family);
					}
					
				}  else $result['error'] = 'Не могу выполнить запрос на серии';
				
			} else $result['error'] = 'Идентификатор производителя не является целочисленным числом больше нуля';
			
		} elseif(isset($_GET['family_id'])){ // запрос на аппараты
		
			$result['data']['devices'] = array();

			//$family_id = preg_replace('/[^0-9]/i','',$_GET['family_id']);
			
			if(ctype_digit($_GET['family_id'])){
				
				// такой же запрос в \wp-content\plugins\wp-e-commerce\wpsc-includes\ajax.functions.php
				
				$results = $wpdb->get_results("SELECT d.id, d.name, CAST(d.name AS UNSIGNED) AS c, IF(LEFT(d.name, 1) > 0, 0, 1) AS isfl, LEFT(d.name, 1) AS fl,LENGTH(d.name) AS l FROM compat_devices d LEFT JOIN compat_families f ON d.family_id=f.id WHERE f.id={$_GET['family_id']} AND d.active=1 ORDER BY isfl ASC, c ASC, fl ASC, l ASC, d.name ASC", ARRAY_A);
				
				if(!empty($results)){
					
					$result['result'] = 1;
				
					foreach($results as $row){
						$result['data']['devices'][] = array('id' => (int)$row['id'], 'name' => $row['name']);
					}
					
				}  else $result['error'] = 'Не могу выполнить запрос на аппараты';
				
			} else $result['error'] = 'Идентификатор серии не является целочисленным числом больше нуля';
		
		} else $result['error'] = 'Неизвестная команда';
		
	}
	
} else $result['error'] = 'Доступ только по HTTPS';

if($result['result'] == 0 && $result['error'] == '') $result['error'] = 'Неизвестная ошибка';

header('Content-type:application/json;charset=utf-8');
echo json_encode($result);

exit();

?>