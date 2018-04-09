<?php

require_once('../../../wp-load.php');

$result = array(
	'result' => 0, 
	'error' => '', 
	'data' => array(
		'status_history' => array()
	)
);

if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'){

	//if(isset($_GET['id'])){
		
		//$id = preg_replace('/[^0-9]/i','',$_GET['id']);
		
		if(ctype_digit($_GET['id'])){
			
			//$result['data']['serviceCall_id'] = $id;
			
			$link = @mssql_connect(MY_MSSQL_ADDRESS, MY_MSSQL_USER, MY_MSSQL_PASSWORD);
			
			if($link !== false){
				
				if(mssql_select_db(MY_MSSQL_DB, $link)){
					
					// такой же запрос в \wp-content\themes\cku\template-check-status.php
					$query = "SELECT CONVERT(varchar,DATEADD(hour,6,HSC_CREATED),120) as HSC_CREATED,CONVERT(text,HSC_NEWVALUE) as HSC_NEWVALUE from dbo.ITSM_SERVICECALLS,dbo.ITSM_HISTORYLINES_SERVICECALL,dbo.ITSM_HIST_INFO_SERVICECALL where SER_ID = CAST ({$_GET['id']} AS decimal(18,0)) and HSC_SER_OID=SER_OID and HSC_VALUEATR_OID=662896684 and HIS_HSC_OID=HSC_OID ORDER BY HSC_CREATED";
					
					$query_result = mssql_query($query);
					
					if($query_result !== false){
						
						if(mssql_num_rows($query_result)){
						
							$result['result'] = 1;
						
							while($row = mssql_fetch_array($query_result, MSSQL_ASSOC)) {
								$result['data']['status_history'][] = array('created' => $row['HSC_CREATED'], 'status' => mb_convert_encoding($row['HSC_NEWVALUE'], 'UTF-8', 'Windows-1251'));
							}
							
						} else $result['error'] = 'Нет заявки с указанным идентификатором';
						
						mssql_free_result($query_result);
						
					} else $result['error'] = 'Не могу выполнить запрос к базе данных';
					
				} else $result['error'] = 'Не могу выбрать базу данных';
				
				mssql_close($link);
				
			} else $result['error'] = 'Не могу подключиться к серверу баз данных';
			
		} else $result['error'] = 'Идентификатор заявки не указан или не является целочисленным числом больше нуля';
		
	//} else $result['error'] = 'Не передан идентификатор заявки';

} else $result['error'] = 'Доступ только по HTTPS';

if($result['result'] == 0 && $result['error'] == '') $result['error'] = 'Неизвестная ошибка';

header('Content-type:application/json;charset=utf-8');
echo json_encode($result);

exit();

?>