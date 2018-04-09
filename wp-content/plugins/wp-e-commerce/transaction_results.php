<div id='products_page_container' class="wrap wpsc_result_container">
<?php
global $wpdb, $sessionid, $cart_log_id, $wpsc_cart;

//echo "<pre>";print_r($_GET);print_r($_SESSION);print_r($_REQUEST);echo "</pre>";

do_action('wpsc_transaction_results');
$sessionid = $_GET['sessionid'];

if(!isset($_GET['sessionid']) && isset($_GET['ms']) ){
	$sessionid = $_GET['ms'];
}elseif(isset($_GET['ssl_result_message']) && $_GET['ssl_result_message']== 'APPROVAL' ){
	$sessionid = $_SESSION['wpsc_sessionid'];
	if(get_option('permalink_structure') != '') {
		$seperator = "?";
	} else {
		$seperator = "&";
	}
	//unset($_SESSION['wpsc_sessionid']);
	//header('Location: '.get_option('transact_url').$seperator.'sessionid='.$sessionid);
}
if($_GET['gateway'] == 'google'){
	wpsc_google_checkout_submit();
	unset($_SESSION['wpsc_sessionid']);
}elseif($_GET['gateway'] == 'noca'){
	wpsc_submit_checkout();
}
if($_SESSION['wpsc_previous_selected_gateway']== 'dps') {
		$sessionid = decrypt_dps_response();
}
$errorcode = '';
$transactid = '';
if($_REQUEST['eway']=='1') {
	$sessionid = $_GET['result'];
}elseif($_REQUEST['eway']=='0'){
	echo $_SESSION['eway_message'];
}elseif ($_REQUEST['payflow']=='1') {	
	echo $_SESSION['payflow_message'];
	$_SESSION['payflow_message']='';
}
if($_SESSION['wpsc_previous_selected_gateway'] == 'paypal_certified' && $_SESSION['paypalExpressMessage'] != 'Completed'){
	echo $_SESSION['paypalExpressMessage'];
	$sessionid = $_SESSION['paypalexpresssessionid'];

}elseif($sessionid == ''){
	_e('Sorry your transaction was not accepted.<br /><a href='.get_option("shopping_cart_url").'>Click here to go back to checkout page.</a>');

}else{
	transaction_results($sessionid, true, null, $wpsc_cart);
}

$cart_log_id = $wpdb->get_var( "SELECT `id` FROM `" . WPSC_TABLE_PURCHASE_LOGS . "` WHERE `sessionid`= " . $sessionid . " LIMIT 1" );

?>
</div>

<div class="clearfix"></div>
<?php echo my_get_featured_products_home(); ?>	
<?php //echo my_get_delivery_info(); ?>
<?php arras_get_pluso(); ?>
