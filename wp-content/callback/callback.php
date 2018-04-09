<?php 

use PAMI\Client\Impl\ClientImpl;
use PAMI\Message\Action\OriginateAction;

function my_ajax_callback(){
	
	require_once('vendor/autoload.php');
		
	//setlocale(LC_ALL, "en_US.utf8");
	//setlocale(LC_NUMERIC, "en_US.utf8"); // Для json_encode, чтобы не преврашал точку в зяпятую
	//date_default_timezone_set('Asia/Yekaterinburg');
	//error_reporting(E_ALL ^ E_NOTICE);

	$headers = 'From: "ИТ Сервис, сайт" <noreply@itural.ru>'."\n";
	$headers .= "Content-Type: text/plain;charset=UTF-8\n";
	$headers .= "Mime-Version: 1.0\n";

	$actionid = '';

	global $wpsc_cart;
	$city = empty($wpsc_cart->my_location['city_with_type'])?'Неизвестно':$wpsc_cart->my_location['city_with_type'];
	
	$result = array(
		'result' => 0,
		'error' => ''
	);
	
	if(isset($_POST['exec'])){
		
		$phone = isset($_POST['phone'])?$_POST['phone']:'';
		
		if($_POST['exec'] == 'call'){
			
			if($phone != ''){
				
				if(preg_match('/^[7][0-6,8,9][0-9]{9}$/', $phone)){
									
					$options = array(  
						'host' => MY_AST_ADDRESS,
						'scheme' => 'tcp://',
						'port' => 5038,
						'username' => 'callback',
						'secret' => '7ecd21fdfdbcaa94a12731d6c97b39ac',
						'connect_timeout' => 10,
						'read_timeout' => 30000
					);  
					
					try {
						
						$originateMsg = new OriginateAction(MY_AST_DID);
						$originateMsg->setContext('my-site-callback');
						$originateMsg->setPriority('1');
						$originateMsg->setExtension($phone);
						$originateMsg->setCallerId("$phone");
						//$originateMsg->setTimeout(300);
						$originateMsg->setAsync(false);

						$client = new ClientImpl($options);   
						$client->open();
						
						$r_message = $client->send($originateMsg);

						if($r_message->getKey('response') == 'Success'){
							
							$actionid = $r_message->getKey('actionid');
							
							$result['result'] = 1;
							$result['id'] = $actionid;
							
							$subject = "Обратный звонок с сайта на номер $phone";
							$message = "Был совершен обратный звонок с сайта на номер $phone.\n\nМестоположение: $city [${_SERVER['REMOTE_ADDR']}]\n\nСтраница звонка: ${_POST['source_call']}\nСтраница входа: ${_POST['source_enter']}\nИсточник перехода: ${_POST['source_referer']}\n\nСлужебный идентификатор: $actionid";
									
						} else {		

							$subject = "Не получилось позвонить с сайта на номер $phone";
							$message = "Была совершена неудачная попытка звонка с сайта на номер $phone.\n\nМестоположение: $city [${_SERVER['REMOTE_ADDR']}]\n\nСтраница звонка: ${_POST['source_call']}\nСтраница входа: ${_POST['source_enter']}\nИсточник перехода: ${_POST['source_referer']}\n\nСлужебный идентификатор: <нет>";

							//$result['error'] = "OriginateAction ".$r_message->getKey('response');
							$result['error'] = "Произошла неизвестная ошибка. Повторите попытку позже.";
							
							// здесь не пишем в 1С, т.к. будет событие на неотвеченный входящий
							
						}

						$client->close();
											
						$_SESSION['callback_phone'] = $phone; // сохраняем через сессию, чтобы взять в репорте и оценке
						
						wp_mail(MY_CALLBACK_EMAIL, $subject, $message, $headers);
						
					} catch (Exception $e) {
						$result['error'] = $e->getMessage();
					}

				} else {
					$result['error'] = "Неправильный формат номера: {$phone}.";
				}
				
			} else {
				$result['error'] = "Номер не указан.";
			}
		} elseif($_POST['exec'] == 'call-delayed') { // не используется	
			$result['result'] = 1;
			
		} elseif($_POST['exec'] == 'report') {
			
			$suff = empty($_SESSION['callback_phone'])?"":" на номер {$_SESSION['callback_phone']}";
			
			$subject = "Не дозвонились с сайта$suff";
			$message = "Клиент сообщает, что мы не дозвонились ему с сайта$suff.\n\nМестоположение: $city [${_SERVER['REMOTE_ADDR']}]\n\nСтраница звонка: ${_POST['source_call']}\nСтраница входа: ${_POST['source_enter']}\nИсточник перехода: ${_POST['source_referer']}\n\nСлужебный идентификатор: ${_POST['call_id']}";

			wp_mail(MY_CALLBACK_EMAIL, $subject, $message, $headers);
			my_save_questions_log("Событие: Клиент сообщает, что мы не дозвонились ему с сайта$suff"); // в 1С
			
			$result['result'] = 1;
		
		} elseif($_POST['exec'] == 'event') { // не используется			
			$result['result'] = 1;
			
		} elseif($_POST['exec'] == 'rating') {
			
			$suff = empty($_SESSION['callback_phone'])?"":" на номер {$_SESSION['callback_phone']}";
			
			$subject = "Оценка звонка с сайта$suff";
			$message = "Клиент оценил разговор на ${_POST['rating']} из 5.\n\nМестоположение: $city [${_SERVER['REMOTE_ADDR']}]\n\nСтраница звонка: ${_POST['source_call']}\nСтраница входа: ${_POST['source_enter']}\nИсточник перехода: ${_POST['source_referer']}\n\nСлужебный идентификатор: ${_POST['call_id']}";

			wp_mail(MY_CALLBACK_EMAIL, $subject, $message, $headers);
			
			$result['result'] = 1;
		
		} else {
			$result['error'] = "Неизвестная команда: {$_POST['exec']}.";
		}
		
	} else {
		$result['error'] = "Команда не указана.";
	}

	if($result['result'] == 0 && $result['error'] == '') $result['error'] = 'Неизвестная ошибка.';
	
	if($result['result'] == 0){	
		
		$to = 'report@itural.ru';
		$subject = "Не удалось выполнить команду Callback API";
		$message = "Ошибка: {$result['error']}";
		
		wp_mail($to, $subject, $message, $headers);
		
	}
	
	header('Content-type:application/json;charset=utf-8');
	echo json_encode($result);

	wp_die();
	
}

add_action('wp_ajax_nopriv_callback', 'my_ajax_callback');
add_action('wp_ajax_callback', 'my_ajax_callback');

?>