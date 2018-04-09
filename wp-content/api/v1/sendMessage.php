<?php

require_once('../../../wp-load.php');

$result = array(
	'result' => 0, 
	'error' => '',
	/* debug */ 'input' => array(),
	'data' => array(
		'message_id' => null
	)
);

if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'){

	if(isset($_GET['action'])){
		
		$db_message = '';
		
		switch($_GET['action']){

			case 'question': // application/json
				
				$input = json_decode(file_get_contents('php://input'), true);
				/* debug */$result['input'] = $input;

				if(is_array($input)){
					
					$name = is_string($input['name'])?$input['name']:'';
					$message = is_string($input['message'])?$input['message']:'';
					$contact = is_string($input['contact'])?$input['contact']:'';
					
					$db_message = "Событие: Вопрос с сайта\r\nИмя клиента: {$name}\r\nСообщение: {$message}\r\nКонтакты: {$contact}";
					
					$mail_body = "Имя клиента: {$name}\r\nСообщение: {$message}\r\nКогда и как связаться: {$contact}";
					$mail_subject = 'Вопрос с сайта';
					
				} else $result['error'] = 'Параметры не переданы или имеют неверный формат';
				
				break;
				
			case 'courier': // application/json

				$input = json_decode(file_get_contents('php://input'), true);
				/* debug */$result['input'] = $input;

				if(is_array($input)){
					
					$name = is_string($input['name'])?$input['name']:'';
					$goods = is_string($input['goods'])?$input['goods']:'';
					$address = is_string($input['address'])?$input['address']:'';
					$contact = is_string($input['contact'])?$input['contact']:'';

					$db_message = "Событие: Вызов курьера\r\nИмя клиента: {$name}\r\nЧто забрать: {$goods}\r\nАдрес: {$address}\r\nКонтакты: {$contact}";
					
					$mail_body = "Имя клиента: {$name}\r\nЧто забрать: {$goods}\r\nАдрес: {$address}\r\nКогда и как с связаться: {$contact}";
					$mail_subject = 'Вызов курьера';
					
				} else $result['error'] = 'Параметры не переданы или имеют неверный формат';
				
				break;
					
			case 'photo': // multipart/form-data
			
				$is_uploaded = false;
				
				if(isset($_FILES["file"])){
				
					$imageFileType = strtolower(pathinfo(basename($_FILES["file"]["name"]), PATHINFO_EXTENSION));
					
					if($imageFileType == 'jpg') {
						
						$check = getimagesize($_FILES['file']['tmp_name']);
						
						if($check !== false) {
							
							$max_size = 7000000;
							
							if ($_FILES['file']['size'] <= $max_size) {
								
								$upload_dir_arr = wp_upload_dir();
								$filename = '/api-images/' . time() . '.' . $imageFileType;
								$target_file = $upload_dir_arr['basedir'] . $filename;
								
								if(move_uploaded_file($_FILES['file']['tmp_name'], $target_file)){
									$is_uploaded = true;
								} else $result['error'] = 'Неизвестная ошибка при загрузке файла';
								
							} else $result['error'] = "Превышен допустимый размер файла: {$max_size} байт";

						} else $result['error'] = 'Файл не является изображением';
						
					} else $result['error'] = 'Загружать изображения можно только в формате jpg';
				
				}  else $result['error'] = 'Файл не передан';
				
				if($is_uploaded){
			
					$input = $_POST;
					/* debug */$result['input'] = $input;
					
					$result['data']['file_url'] = $upload_dir_arr['baseurl'] . $filename;

					if(is_array($input)){
						
						$name = is_string($input['name'])?$input['name']:'';
						$contact = is_string($input['contact'])?$input['contact']:'';
						
						$db_message = "Событие: Определить принтер по фотографии\r\nИмя клиента: {$name}\r\nКонтакты: {$contact}\r\nИзображение: {$result['data']['file_url']}";
						
						$mail_body = "Имя клиента: {$name}\r\nКогда и как с связаться: {$contact}\r\nИзображение: {$result['data']['file_url']}";
						$mail_subject = 'Определить принтер по фотографии';
					
					} else $result['error'] = 'Параметры не переданы или имеют неверный формат';
					
				}
				
				break;

			default:
				$result['error'] = 'Неизвестная команда';
				
		}
		
		if($db_message != '') {
			
			$db_message .= "\r\nИсточник: API";
			
			// debug // $insert_id = my_save_questions_log($db_message);
			/* debug */ $insert_id = mt_rand(1000,9990);
		
			if($insert_id !== false){
				
				$result['data']['message_id'] = $insert_id;
				$result['result'] = 1;
				
			} else $result['error'] = 'Не могу записать сообщение в базу данных';

			/*
			$to = MY_FEEDBACK_EMAIL;
			$headers = "Content-type: text/plain; charset=UTF-8"."\r\n";
			$headers .= "From: \"ИТ Сервис, сайт\" <noreply@itural.ru>"."\r\n";

			wp_mail($to, $mail_subject, $mail_body, $headers);
			*/
			
		}
		
	} else $result['error'] = 'Не передана команда';

} else $result['error'] = 'Доступ только по HTTPS';	

if($result['result'] == 0 && $result['error'] == '') $result['error'] = 'Неизвестная ошибка';

header('Content-type:application/json;charset=utf-8');
echo json_encode($result);

exit();

?>