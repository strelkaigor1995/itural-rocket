<?php

require_once('../../../wp-load.php');

$result = array(
	'result' => 0, 
	'error' => '', 
	'data' => array(
		'destinations' => array()
	)
);

$results = my_get_destinations();

if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'){

	if(!empty($results)){
		
		foreach($results as $row){
			$result['data']['destinations'][] = array('id' => (int)$row['id'], 'name' => $row['name']);
		}
		
		$result['result'] = 1;

	}  else $result['error'] = 'Не могу получить регионы доставки';

} else $result['error'] = 'Доступ только по HTTPS';

if($result['result'] == 0 && $result['error'] == '') $result['error'] = 'Неизвестная ошибка';

header('Content-type:application/json;charset=utf-8');
echo json_encode($result);

exit();

?>