<?php

function _cleanInputs($data) {
	$clean_input = Array();
	if (is_array($data)) {
		foreach ($data as $k => $v) {
			$clean_input[$k] = _cleanInputs($v);
		}
	} else {
		$clean_input = trim(strip_tags($data));
	}
	return $clean_input;
}

define('API_ERROR_STATUS', 'ERR');
define('API_OK_STATUS', 'OK');
define('API_ENDPOINT_URI_LEVEL', 5); // уровень вложенности ресурса по URI сайта /wp-content/themes/cku/api/v1/

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);
$request = array_slice(explode('/', trim($_SERVER['REQUEST_URI'], '/')), API_ENDPOINT_URI_LEVEL);

//var_dump($method);
//var_dump($request);
//var_dump($input);

$endpoint = array_shift($request);

/*$verb = null;
if(array_key_exists(0, $request) && !is_numeric($request[0])) {
    $verb = array_shift($request);
}*/

/*switch($method){
	case 'POST':
		$args = _cleanInputs($_POST);
		break;
	case 'GET':
		$args = _cleanInputs($_POST);
		break;
	default:
		$args = null;
		$result['error']['message'] = "Указан неизвестный тип HTTP запроса: {$method}";
}*/

var_dump($endpoint);
//var_dump($verb);
var_dump($method);
var_dump($args);

$result = array(
	'status' => API_ERROR_STATUS, 
	'error' => array(
		'code' => '',
		'message' => ''
	), 
	'data' => ''
);

if($endpoint != null){

	switch($endpoint){
		
		case 'serviceCall':
		
			$action = array_shift($request);
			
			if($action != null){
			
				switch($action){
					case 'history':
						break;
					default:
						$result['error']['message'] = "Указан неизвестный ресурс: {$endpoint}";
				}
				
			} else $result['error']['message'] = 'serviceCall: не указан ресурс';
		
			//$result['data'] = 'serviceCall';
			
			break;
			
		default:
			$result['error']['message'] = "Указан неизвестный ресурс: {$endpoint}";
	}

	
} else $result['error']['message'] = 'Не указан ресурс';

header('Content-type:application/json;charset=utf-8');
echo json_encode($result);

?>