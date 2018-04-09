<?php

//add custom column in admin post type "staff"
// Колонка миниатюры в списке записей админки

if(strpos($_SERVER['REQUEST_URI'], 'post_type=staff')){
   function posts_columns($defaults){  
      $defaults_id = array('post_page_id' => 'Миниатюра');
      $defaults = array_slice( $defaults, 0, 1, true ) + $defaults_id + array_slice( $defaults, 1, NULL, true );
      return $defaults;
   }
           
   function posts_custom_columns($column_name, $id){
      if($column_name === 'post_page_id'){
         $id = get_the_ID();
         $img = get_field('image_app', $id);
         $url_img = str_replace("http://www.itural.ru", "http://itural-website", $img['url']);
         echo "<img src=". $url_img ." width='50' height='50'>";
      }
   }

   add_filter('manage_posts_columns', 'posts_columns', 5);
   add_filter('manage_posts_custom_column', 'posts_custom_columns', 5, 2);

   add_filter("manage_edit-staff_columns", 'posts_columns', 5);
   add_action("manage_staff_custom_column", 'posts_custom_columns', 10, 3);
}

function wph_css_for_thumbs() {
   echo '<style>
           .column-post_page_id {
            width: 15%;
           } 
         </style>';
}
add_action('admin_head', 'wph_css_for_thumbs');


// дев-дебаг дефайны в \wp-content\plugins\wp-e-commerce\wp-shopping-cart.php
// чтобы грузились до темы

define('MY_PHONE', '(343) 302-02-00');
define('MY_PHONE_URI', '+73433020200');
define('MY_PHONE_OLD', '(343) 359-84-88, 319-14-88');
define('MY_PHONE_OLD_URI', '+73433598488');
define('MY_MSSQL_DB', 'hpovsd');
define('MY_MSSQL_USER', 'itural');
define('MY_MSSQL_PASSWORD', 'a0p0oh');
define('MY_MIDDAY', 13); // seredina dnya, +1 den' posle etogo 4asa na dostavku
define('MY_SUPPLIERS_LAST_WEEKDAY', 5); // postavshik rabotaet c pn po pt
define('MY_DELIVERY_LAST_WEEKDAY', 5); // dostavka rabotaet c pn po pt
define('MY_OFFICE_LAST_WEEKDAY', 7); // ofis rabotaet c pn po vs
define('MY_DAYS_TO_STOCK', 4); // elsi ddays < etogo, to vyvodim 'sklad'
define('DEVICE_DELIVERY_PRODUCT_ID', 66611177); // kod poducta vyezda za apparatom
define('TK_DELIVERY_PRODUCT_ID', 66609178); // dostavka do transportnoy
define('CS_FORM_GOODS_BUTTON_TITLE', 'Найти картриджи');
define('CS_FORM_SERVICE_BUTTON_TITLE', 'Заправить картриджи');
define('MY_NEW_PRODUCT_DAYS', 180);
define('MY_STORE_ADDRESS', 'г. Екатеринбург, ул. 8 Марта, д. 14, 1 этаж');
define('MY_SHORT_STORE_ADDRESS', 'ул. 8 Марта, д. 14');

global 	$my_ru_months, 
		$my_wh, 
		$my_suppliers_holidays,
		$my_delivery_holidays,
		$my_office_holidays;
		
$my_ru_months = array(1=>'января',2=>'февраля',3=>'марта',4=>'апреля',5=>'мая',6=>'июня',7=>'июля',8=>'августа',9=>'сентября',10=>'октября',11=>'ноября',12=>'декабря');

$my_wh = array(
	1 => array(1=>9, 2=>19),
	2 => array(1=>9, 2=>19),
	3 => array(1=>9, 2=>19),
	4 => array(1=>9, 2=>19),
	5 => array(1=>9, 2=>19),
	6 => array(1=>11, 2=>18),
	7 => array(1=>11, 2=>18)
); // grafik raboty ofisa

$my_office_holidays = array(
	'2017-12-31' => array(1=>9, 2=>15),
	'2018-01-01' => null,
	'2018-01-02' => null,
	'2018-01-03' => null,
	'2018-01-04' => array(1=>11, 2=>18),
	'2018-01-05' => array(1=>11, 2=>18),
	'2018-01-07' => null,
	'2018-01-08' => array(1=>11, 2=>18),
	'2018-02-23' => null,
	'2018-03-08' => null,
	'2018-03-09' => array(1=>11, 2=>18),
	'2018-05-01' => null,
	'2018-05-09' => null,
	'2018-06-12' => null,
	'2018-11-04' => null
); // график работы офиса по датам, если он не совпадает с недельным графиком

$my_suppliers_holidays = array(
	'2018-01-01' => null,
	'2018-01-02' => null,
	'2018-01-03' => null,
	'2018-01-04' => null,
	'2018-01-05' => null,
	'2018-01-06' => null,
	'2018-01-07' => null,
	'2018-01-08' => null,
	'2018-02-23' => null,
	'2018-03-08' => null,
	'2018-05-01' => null,
	'2018-05-09' => null,
	'2018-06-12' => null,
	'2018-11-04' => null
); // prazdniki postavshikov

$my_delivery_holidays = array(
	'2018-01-01' => null,
	'2018-01-02' => null,
	'2018-01-03' => null,
	'2018-01-04' => null,
	'2018-01-06' => null,
	'2018-01-07' => null,
	'2018-02-23' => null,
	'2018-03-08' => null,
	'2018-05-01' => null,
	'2018-05-09' => null,
	'2018-06-12' => null,
	'2018-11-04' => null
); // prazdniki dostavki

remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'wp_shortlink_wp_head');


// грузим скрипты и стили
function my_arras_enqueue_script(){
	
	wp_enqueue_style('cku5', get_template_directory_uri() . '/css/styles/cku5.css');
	wp_enqueue_style('suggestions', get_template_directory_uri() . '/css/suggestions.css');
	
	wp_enqueue_script('vk-openapi', get_template_directory_uri() . '/js/openapi.js');	
	wp_enqueue_script('jquery.suggestions.min', get_template_directory_uri() . '/js/jquery.suggestions.min.js');
	wp_enqueue_script('jquery.maskedinput.min.js', get_template_directory_uri() . '/js/jquery.maskedinput.min.js');
	
	wp_enqueue_script('my', get_template_directory_uri() . '/js/my.js', array('jquery'));
	wp_localize_script('my', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
	
	wp_enqueue_script('iLoad', get_template_directory_uri() . '/js/iload/iLoad.js');
	wp_enqueue_script('compat-search', get_template_directory_uri() . '/js/compat-search.js');
	
}

add_action('wp_enqueue_scripts', 'my_arras_enqueue_script');



// Translate Arras.Theme, if possible
if (class_exists('xili_language')) {
	define('THEME_TEXTDOMAIN', 'arras');
	define('THEME_LANGS_FOLDER', '/language');
} else {
	load_theme_textdomain('arras', get_template_directory() . '/language');
}

// Remove filter on theme options if qTranslate is enabled
if (function_exists('qtrans_init')) {
	remove_filter('option_arras_options', 'qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage', 0);	
}

$theme_data = get_theme( get_current_theme() );
//exit(var_dump($theme_data));
define( ARRAS_CHILD, (boolean)($theme_data['Parent Theme'] == 'Arras Theme') );

$parent_data = get_theme('Arras Theme');
//exit(var_dump($parent_data));

// Define post meta fields
define( ARRAS_POST_THUMBNAIL, 'thumb' );
define( ARRAS_REVIEW_SCORE, 'score' );
define( ARRAS_REVIEW_PROS, 'pros' );
define( ARRAS_REVIEW_CONS, 'cons' );

// Define thumbnail width and height
define( ARRAS_2COL_MINI_WIDTH, '190' );
define( ARRAS_2COL_MINI_HEIGHT, '100' );

define( ARRAS_2COL_FULL_WIDTH, '650' );
define( ARRAS_2COL_FULL_HEIGHT, '250' );

define( ARRAS_3COL_MINI_WIDTH, '220' );
define( ARRAS_3COL_MINI_HEIGHT, '100' );

define( ARRAS_3COL_FULL_WIDTH, '480' );
define( ARRAS_3COL_FULL_HEIGHT, '225' );

// Define PHP file constants
define( ARRAS_DIR, TEMPLATEPATH );
define( ARRAS_LIB, ARRAS_DIR . '/library' );
define( ARRAS_VERSION, $parent_data['Version'] );

// Thumbnail generator
define( ARRAS_THUMB, 'timthumb' );

// Load library files
require_once ARRAS_LIB . '/actions.php';
require_once ARRAS_LIB . '/filters.php';
require_once ARRAS_LIB . '/template.php';
require_once ARRAS_LIB . '/styles.php';

require_once ARRAS_LIB . '/widgets-legacy.php';

require_once ARRAS_LIB . '/admin/options.php';

arras_flush_options();

if ( is_admin() ) require_once ARRAS_LIB . '/admin/admin.php';

require_once ARRAS_LIB . '/launcher.php';

show_admin_bar(false);

// ]aka[ shortcodes
function arras_get_wpsc_category_url($atts){
 extract( shortcode_atts( array(
		'id' => 0,
	), $atts ) );
 return wpsc_category_url($id);
}

function arras_get_wpsc_category_count($atts){
 extract( shortcode_atts( array(
		'id' => 0,
	), $atts ) );
 return '<span class="category_count">'.wpsc_gmcpc($id).'</span>';
}

function arras_get_wpsc_category_link($atts){
 extract( shortcode_atts( array(
		'id' => 0,
	), $atts ) );
 return '<a href="'.wpsc_category_url($id).'" title="'.wpsc_category_name($id).'">'.wpsc_category_name($id).'</a><span class="category_count"> '.wpsc_gmcpc($id).'</span>';
}

add_shortcode('wpsc_category_url', 'arras_get_wpsc_category_url');
add_shortcode('wpsc_category_count', 'arras_get_wpsc_category_count');
add_shortcode('wpsc_category_link', 'arras_get_wpsc_category_link');

function arras_get_wpsc_product_url($atts){
 extract( shortcode_atts( array(
		'id' => 0,
	), $atts ) );
 return wpsc_product_url($id);
}

function arras_get_wpsc_product_link($atts){
	extract( shortcode_atts( array(
			'id' => 0,
	), $atts ) );
	$my_wpsc_query = new WPSC_Query('product_id='.$id);
	if($my_wpsc_query->product_count == 1){
		$output = '<a href="'.wpsc_product_url($id).'" title="'.$my_wpsc_query->product['name'].'">'.$my_wpsc_query->product['name'].'</a>';
	} else { $output = ''; }
	return $output;
}

function arras_get_wpsc_product_title($atts){
	extract( shortcode_atts( array(
			'id' => 0,
	), $atts ) );
	$my_wpsc_query = new WPSC_Query('product_id='.$id);
	if($my_wpsc_query->product_count == 1){
		$output = $my_wpsc_query->product['name'];
	} else { $output = ''; }
	return $output;
}

function arras_get_wpsc_product_price($atts){
	extract( shortcode_atts( array(
			'id' => 0,
	), $atts ) );
	$my_wpsc_query = new WPSC_Query('product_id='.$id);
	if($my_wpsc_query->product_count == 1){
		//$output = $my_wpsc_query->product['price'];
		$output = nzshpcrt_currency_display($my_wpsc_query->product['price'], $my_wpsc_query->product['notax'], true);
	} else { $output = ''; }
	return $output;
}

function arras_cs_get_form_content($atts){
	extract(shortcode_atts(array('maker_id' => 0, 'type' => 'service'), $atts));
	$output =  '
		<div class="cs_content">
			<div class="cs_title_content">Выберите ваш принтер:</div>
			<div class="cs_notice clearfix">Не нашли принтер? <span class="fb_ask_a_quest_link cs_notice_link">Напишите нам</span>.</div>
			<form action="'.get_option('product_list_url').'" method="get" class="cs_form_content">
				<select class="cs_makers cs_makers_js" maker_id="'.$maker_id.'"></select>
				<select class="cs_families cs_families_js"></select>	
				<select name="device_id" class="cs_devices cs_devices_js"></select>
				<button sub_count="" type="submit" name="type" value="'.$type.'" class="cs_button cs_button_js">Найти</button>
			</form>
		</div>
	';
	return $output;
}

function my_get_wpsc_device_delivery_cost(){
	return number_format(arras_get_wpsc_product_price(array('id'=>DEVICE_DELIVERY_PRODUCT_ID)), 0, ',', ' ');
}

function my_format_form_data($foo){
	return htmlentities(stripslashes($foo), ENT_QUOTES, 'UTF-8');
}

function my_get_wpsc_tk_delivery_cost(){
	return number_format(arras_get_wpsc_product_price(array('id'=>TK_DELIVERY_PRODUCT_ID)), 0, ',', ' ');
}

function my_get_store_address(){
	return MY_STORE_ADDRESS;
}

function my_get_short_store_address(){
	return MY_SHORT_STORE_ADDRESS;
}

function arras_get_wpsc_product_price_no_zero($atts){
	extract( shortcode_atts( array(
			'id' => 0,
	), $atts ) );
	return number_format(arras_get_wpsc_product_price(array('id'=>$id)), 0, ',', ' ');
}

function my_get_store_phone($atts){
	extract( shortcode_atts( array(
			'class' => '',
			'old' => 'no'
	), $atts ) );
	return '<a href="tel:' . (($old == 'no') ? MY_PHONE_URI : MY_PHONE_OLD_URI) . '"' . (empty($class) ? '' : ' class="' . $class . '"') . '>' . (($old == 'no') ? MY_PHONE : MY_PHONE_OLD) . '</a>';	
}

add_shortcode('wpsc_product_url', 'arras_get_wpsc_product_url');
add_shortcode('wpsc_product_link', 'arras_get_wpsc_product_link');
add_shortcode('wpsc_product_title', 'arras_get_wpsc_product_title');
add_shortcode('wpsc_product_price', 'arras_get_wpsc_product_price');
add_shortcode('wpsc_product_price_no_zero', 'arras_get_wpsc_product_price_no_zero');
add_shortcode('cs_get_form_content', 'arras_cs_get_form_content');
add_shortcode('wpsc_device_delivery_cost', 'my_get_wpsc_device_delivery_cost');
add_shortcode('wpsc_tk_delivery_cost', 'my_get_wpsc_tk_delivery_cost');
add_shortcode('store_address', 'my_get_store_address');
add_shortcode('store_short_address', 'my_get_short_store_address');
add_shortcode('store_phone', 'my_get_store_phone');

add_editor_style('css/styles/cku5.css');

function my_tiny_mce_before_init( $init_array ) {
    $init_array['body_class'] = 'entry-content';
    return $init_array;
}
add_filter('tiny_mce_before_init', 'my_tiny_mce_before_init');


function numberof($numberof, $value, $suffix)
{
    $keys = array(2, 0, 1, 1, 1, 2);
    $mod = $numberof % 100;
    $suffix_key = $mod > 4 && $mod < 20 ? 2 : $keys[min($mod%10, 5)]; 
    return $value . $suffix[$suffix_key];
}

function my_get_lastfirstname(){
	global $current_user,$user_ID;
	$lastfirstname = "";
	if(is_user_logged_in()){
		$meta_data = get_usermeta($user_ID, 'wpshpcrt_usr_profile');
		get_currentuserinfo();
		$lastfirstname = $meta_data[2]; // last and first names
		if($lastfirstname == ""){
			if($current_user->user_lastname!=""){$lastfirstname = $current_user->user_lastname." ";}
			if($current_user->user_firstname!=""){$lastfirstname .= $current_user->user_firstname;}
		}
		if($lastfirstname == ""){$lastfirstname = $current_user->display_name;}		  
	}	
	return esc_html($lastfirstname);
}

function my_get_contacts(){
	global $current_user,$user_ID;
	$contacttext = "";
	if(is_user_logged_in()){
		$meta_data = get_usermeta($user_ID, 'wpshpcrt_usr_profile');
		get_currentuserinfo();
		$contacttext = $meta_data[8]; // email
		if($contacttext == ""){
			if($current_user->user_email !=""){$contacttext = $current_user->user_email;}
		}
		if($meta_data[17] != ""){ // phone
			if($contacttext !=""){ $contacttext .= " ".$meta_data[17]; } else { $contacttext = $meta_data[17]; }
		}
	}
	return esc_html($contacttext);
}

function my_get_phone(){
	global $current_user,$user_ID;
	$contacttext = "";
	if(is_user_logged_in()){
		$meta_data = get_usermeta($user_ID, 'wpshpcrt_usr_profile');
		$contacttext = $meta_data[17]; // phone
	}
	return esc_html($contacttext);
}

function my_get_mail(){
	global $current_user,$user_ID;
	$contacttext = "";
	if(is_user_logged_in()){
		$meta_data = get_usermeta($user_ID, 'wpshpcrt_usr_profile');
		get_currentuserinfo();
		$contacttext = $meta_data[8]; // email
		if($contacttext == ""){
			if($current_user->user_email !=""){$contacttext = $current_user->user_email;}
		}
	}
	return esc_html($contacttext);
}

function my_get_address(){
	global $current_user,$user_ID;
	$addresstext = "";
	if(is_user_logged_in()){
		$meta_data = get_usermeta($user_ID, 'wpshpcrt_usr_profile');
		$addresstext = $meta_data[4];
	}
	return esc_html($addresstext);
}


function my_office_hour($date, $mode) {
	
	global $my_wh, $my_office_holidays;
	
	if(array_key_exists($date->format('Y-m-d'), $my_office_holidays)) { // v spiske vyhodnyh
		if(isset($my_office_holidays[$date->format('Y-m-d')])) { // est' grafik raboty
			$result = $my_office_holidays[$date->format('Y-m-d')][$mode];
		} else {
			$result = -1; // ne zadany 4asy raboty
		}
	} else { // smotrim po nedel'nomu spisku
		$weekday = (int)$date->format('N');
		$result = $my_wh[$weekday][$mode];
	}
	
	return $result;
	
}

function my_is_holiday($date, $holidays) {
	if(array_key_exists($date->format('Y-m-d'), $holidays)) { // v spiske vyhodnyh
		if(!isset($holidays[$date->format('Y-m-d')])) { // net grafika raboty - vyhodnoy
			return true;
		}
	}
	return false;
}

function my_next_workday($ddays, $last_workday, $holidays){

	if($ddays < 0) { return null; }

	$date = new DateTime();
	
	while($ddays > 0){
		
		$date->add(new DateInterval('P1D'));
		
		if(my_is_holiday($date, $holidays)) { continue; } 
		
		$weekday = (int)$date->format('N');
		if($weekday > $last_workday) { continue; } // esli vyhodnoy
		
		$ddays--;
		
	}
	
	return $date;	
	
}

function my_onstock_date_v2($ddays){

	global $my_suppliers_holidays;
	
	if($ddays < 0) { return null; }
	
	if($ddays > 0) $date = my_next_workday($ddays, MY_SUPPLIERS_LAST_WEEKDAY, $my_suppliers_holidays); // pod zakaz - po grafiku postavshika
	else { // $ddays = 0, tovar v nali4ii
		$date = new DateTime();
	}

	return $date;	
	
}

function my_delivery_date_v2($ddays){
	
	global $my_suppliers_holidays, $my_delivery_holidays;
	
	if($ddays < 0) { return null; }
	
	if($ddays > 0) $date = my_next_workday($ddays, MY_SUPPLIERS_LAST_WEEKDAY, $my_suppliers_holidays); // pod zakaz - po grafiku postavshika
	else { // $ddays = 0, tovar v nali4ii
		
		$date = new DateTime();
		$weekday = (int)$date->format('N');
		
		if( ((int)$date->format('G') >= MY_MIDDAY) || // proveryaem posle obeda
			(my_is_holiday($date, $my_delivery_holidays)) || // esli prazdnik
			($weekday > MY_DELIVERY_LAST_WEEKDAY) // esli vyhodnoy
		){ 
			$date = my_next_workday(1, MY_DELIVERY_LAST_WEEKDAY, $my_delivery_holidays);
		}

	}
	
	return $date;	
	
}

function my_samovyvoz_date_v2($ddays){
	
	global $my_wh, $my_suppliers_holidays, $my_office_holidays;
	
	if($ddays < 0) { return null; }
	
	if($ddays > 0) $date = my_next_workday($ddays, MY_SUPPLIERS_LAST_WEEKDAY, $my_suppliers_holidays); // pod zakaz - po grafiku postavshika
	else { // $ddays = 0, tovar v nali4ii
		
		$date = new DateTime();
		
		if((int)$date->format('G') >= my_office_hour($date, 2)){
			$date = my_next_workday(1, MY_OFFICE_LAST_WEEKDAY, $my_office_holidays);
		}
		
	}
	
	return $date;	
	
}

function my_get_date_str($date, $predlog=''){
	global $my_ru_months;
	$today = new DateTime();
	$ddiff = $today->diff($date);
	$output = '';
	switch((int)$ddiff->format('%a')){
		case 0:
			$output = ' сегодня';
			break;
		case 1:
			$output = ' завтра';
			break;
		//case 2:
			//$output = ' послезавтра';
			//break;
		default:
			$output = $predlog.' '.$date->format('j').' '.$my_ru_months[$date->format('n')];
			break;
	}
	return $output;
}

// устарело из-за изменения формата $my_wh + $my_office_holidays
/*function my_get_wh_str($date){
	global $my_wh;
	$today = new DateTime();
	$ddiff = $today->diff($date);
	$weekday = $date->format('N');
	$hour = $date->format('G');
	if((int)$ddiff->format('%a') == 0){ // esli ne segodnya, to vyvodim ot i do
		if($hour >= $my_wh[$weekday][1] && $hour < $my_wh[$weekday][2]){
			$output = 'до '.$my_wh[$weekday][2].':00';
		} else {
			$output = 'с '.$my_wh[$weekday][1].':00 до '.$my_wh[$weekday][2].':00';
		}
	} else {
		$output = 'с '.$my_wh[$weekday][1].':00 до '.$my_wh[$weekday][2].':00';
	}
	return $output;
}*/

// v spiske tovarov v tablice
function my_get_stock_str($usluga, $ddays){
	if((int)$usluga == 1) {
		$output = 'услуга';
	} else {
		if($ddays==-2){
			$output='заказ';
		} elseif($ddays==-1){
			$output='запрос';
		} elseif($ddays==0){
			$output='магазин';
		} else {
			$stock_date = my_onstock_date_v2($ddays);
			$interval = $stock_date->diff(new DateTime('now'));
			$output = $interval->format('%a') . ' ' . numberof($interval->format('%a'), 'д', array('ень', 'ня', 'ней'));
		}
		/*} elseif($ddays<MY_DAYS_TO_STOCK){
			$output='склад';
		} else {
			$output='транзит';
		}*/
	}
	return $output;
}

// stranica tovara
function my_get_stock_str_single($usluga, $ddays){
	
	if((int)$usluga == 1) {
		$output = 'Услуга';
	} else {
		if($ddays==-2){
			$output='Под заказ';
		} elseif($ddays==-1){
			$output='По запросу';
		} elseif($ddays==0){
			$output='В магазине';
		} else {
			$stock_date = my_onstock_date_v2($ddays);
			$interval = $stock_date->diff(new DateTime('now'));
			$output = 'Срок поставки: ' . $interval->format('%a') . ' ' . numberof($interval->format('%a'), 'д', array('ень', 'ня', 'ней'));
		}
		/*} elseif($ddays<){
			$output='На складе';
		} else {
			$output='В пути';
		}*/
	}
	return $output;
}

// v spiske tovarov tooltip
function my_get_stock_title($usluga, $ddays, $predoplata){
	global $wpsc_cart;
	$output = '';
	if((int)$usluga == 1) {
		$output = 'Услуга оказывается только в&nbsp;нашем сервисном центре.';
		if($wpsc_cart->my_shipping_destination['internal_service'] == 1){
			$output .= ' Вы&nbspможете вызвать курьера за&nbsp;вашими картриджами или&nbsp;техникой.';
		}
	} else {
		if((int)$ddays != 0 && $predoplata == 1){ $output = 'Для оформления заказа необходима предоплата. '; }
		if((int)$ddays >= 0) {
			$samo_date = my_samovyvoz_date_v2($ddays);
			$del_date = my_delivery_date_v2($ddays);
			//$output .= 'Самовывоз из&nbsp;магазина'.my_get_date_str($samo_date).' '.my_get_wh_str($samo_date).', доставим'.my_get_date_str($del_date,$predlog).'.';
			$output .= 'Самовывоз из&nbsp;магазина' . my_get_date_str($samo_date);
			$output .= ', ' . mb_strtolower($wpsc_cart->my_shipping_destination['public_name']) . ' ' . my_get_date_str($del_date,$predlog) . '.';
		} elseif((int)$ddays == -1) { 
			$output .= 'Наличие уточнять у менеджеров.';
		} elseif((int)$ddays == -2) { 
			$output .= 'Срок поставки уточнять у менеджеров.';
		}		
	}
	return $output;
}

function cs_get_device_name($device_id) {
	
	global $wpdb;
	
	$device_id = preg_replace('/[^0-9]/', '', $device_id);
	
	if((int)$device_id > 0) { 
		$device_name = $wpdb->get_row("SELECT m.maker, f.family, d.name FROM compat_devices d LEFT JOIN compat_families f ON (d.family_id=f.id) LEFT JOIN compat_makers m ON (m.id=f.maker_id) WHERE d.id={$device_id} AND d.active=1");
		if($device_name !== null){
			$family_name = ($device_name->family=='')?'':' '.$device_name->family;
			$output = $device_name->maker.$family_name.' '.$device_name->name;
		} else {
			$output = "Нет_В_Базе";
		}
	} else { $output = "Неверный_Идентификатор"; }
	
	return $output;
	
}

function cs_get_family_id($device_id){

	global $wpdb;
	
	$output = 0;
	
	if($device_id > 0) {
		$family_id = $wpdb->get_var("SELECT f.id FROM compat_devices d LEFT JOIN compat_families f ON d.family_id=f.id WHERE d.id={$device_id} AND f.active=1 AND d.active=1");
		if($family_id !== null) { $output = $family_id; }
	}	
	
	return $output;
	
}

function cs_get_maker_id($device_id){

	global $wpdb;
	
	$output = 0;
	
	if($device_id > 0) {
		$maker_id = $wpdb->get_var("SELECT m.id FROM compat_devices d LEFT JOIN compat_families f ON (d.family_id=f.id) LEFT JOIN compat_makers m ON (m.id=f.maker_id) WHERE d.id={$device_id} AND m.active=1 AND f.active=1 AND d.active=1");
		if($maker_id !== null) { $output = $maker_id; }
	}	
	
	return $output;
	
}

function cs_get_maker_name($device_id){

	global $wpdb;
	
	$output = '';
	
	if($device_id > 0) {
		$maker_name = $wpdb->get_var($wpdb->prepare("SELECT m.maker FROM compat_devices d LEFT JOIN compat_families f ON (d.family_id=f.id) LEFT JOIN compat_makers m ON (m.id=f.maker_id) WHERE d.id=%d AND m.active=1 AND f.active=1 AND d.active=1", $device_id));
		if($maker_name !== null) { $output = $maker_name; }
	}	
	
	return $output;
	
}

function my_get_cart_link_text(){

	global $wpsc_cart;

	if($wpsc_cart->cart_item_count > 0){
		$result = $wpsc_cart->cart_item_count.' '.numberof($wpsc_cart->cart_item_count, 'товар', array('', 'а', 'ов')).' в корзине';
	} else {
		$result = 'Корзина';
	}
	
	return $result;
	
}

function my_get_cart_class(){
	
	global $wpsc_cart;

	if($wpsc_cart->cart_item_count>0){
		$result = 'cart_not_empty';
	} else 
	{
		$result = '';
	}
	
	return $result;
}


function delivery_date_str_checkout($product_id, $is_delivery = true){

	$deliverydays = get_product_meta($product_id,'deliverydays',true);	
	$usluga = get_product_meta($product_id,'usluga',true);
	
	$ddate_str = '';
	if((int)$usluga == 1){ $ddate_str = 'услуга'; }
	elseif((int)$deliverydays == -2){ $ddate_str = 'заказ'; }
	elseif((int)$deliverydays == -1){ $ddate_str = 'запрос'; }
	elseif((int)$deliverydays >= 0){
		if($is_delivery){
			$ddate = my_delivery_date_v2($deliverydays);
		} else {
			$ddate = my_samovyvoz_date_v2($deliverydays);
		}
		$ddate_str = $ddate->format('d.m.y');
	}			
	
	return $ddate_str;
	
}


function my_the_product_thumbnail($thumbnail_image) {
	
	global $wpdb;
	
	$image_file_name = null;
	
	if($thumbnail_image != null && is_numeric($thumbnail_image)){
		$image_file_name = $wpdb->get_var("SELECT `image` FROM `" . WPSC_TABLE_PRODUCT_IMAGES . "` WHERE `id`= '$thumbnail_image' LIMIT 1");
	}
	
	$image_path = null;
	
	if($image_file_name != null ){
		$image_path = WPSC_THUMBNAIL_URL . $image_file_name;
		if ( is_ssl() ) {
			$image_path = str_replace("http://", "https://", $image_path);
		}
	}
	
	return $image_path;
	
}


function my_get_callback_html(){

	$output = '';

	if(MY_CALLBACK){
	
		global $wpsc_cart;
		
		$callback_code = '<script crossorigin="anonymous" async type="text/javascript" src="' . content_url() . '/callback/callback_opts.js" id="check-code-pozvonim" charset="UTF-8"></script>';
	
		$today = new DateTime();
		$weekday = (int)$today->format('N');
		$hour = (int)$today->format('G');
		
		if(defined('DEVELOPMENT')){
			$output = $callback_code;
		} else {
		
			if($hour >= my_office_hour($today, 1) && $hour < my_office_hour($today, 2)){
			
				if(
					$wpsc_cart->my_location['region_fias_id'] == '92b30014-4d52-4e2e-892d-928142b924bf' || // Свердловская обл
					$wpsc_cart->my_location['region_fias_id'] == 'd66e5325-3a25-4d29-ba86-4ca351d9704b' || // Ханты-Мансийский Автономный округ - Югра
					$wpsc_cart->my_location['region_fias_id'] == '826fa834-3ee8-404f-bdbc-13a5221cfb6e' // Ямало-Ненецкий АО
				){ 
					$output = $callback_code;
				}
				
			}
		
		}
		
	}
	
	return $output;
	
}

function cs_get_cluster_name($cluster_id) {
	
	global $wpdb;
	
	$cluster_id = preg_replace('/[^0-9]/', '', $cluster_id);
	
	if((int)$cluster_id > 0) { 
		$cluster_name = $wpdb->get_row("SELECT name, model, maker_model FROM compat_clusters WHERE id={$cluster_id} AND active=1");
		if($cluster_name !== null){
			$output = $cluster_name->name;
			if(strpos($output, $cluster_name->model) === false) $output .= ' '.$cluster_name->model;
			if(strpos($output, $cluster_name->maker_model) === false) $output .= ' '.$cluster_name->maker_model;
		} else {
			$output = "Нет_В_Базе";
		}
	} else { $output = "Неверный_Идентификатор"; }
	
	return $output;
	
}

// how to use
// $rustart = getrusage();
// do something
// $ru = getrusage();		
// echo "utime: " . rutime($ru, $rustart, "utime") . " ms, stime: " . rutime($ru, $rustart, "stime") . " ms";
function rutime($ru, $rus, $index) {
    return ($ru["ru_$index.tv_sec"]*1000 + intval($ru["ru_$index.tv_usec"]/1000))
     -  ($rus["ru_$index.tv_sec"]*1000 + intval($rus["ru_$index.tv_usec"]/1000));
}

function compat_search_log($device_id, $type, $result) {
	
	global $wpdb, $user_ID, $wpsc_query;
	
	$wpdb->query(
		$wpdb->prepare(
			"INSERT INTO compat_search_log (
				datetime, 
				device_id, 
				device_name, 
				type, 
				result, 
				ip, 
				http_referer, 
				user_id, 
				user_agent
			) VALUES (
				%s,
				%d,
				%s,
				%s,
				%d,
				%s,
				%s,
				%d,
				%s
			)",
			date("Y-m-d H:i:s"),
			$device_id,
			$wpsc_query->device_name,
			$type,
			$result,
			$_SERVER['REMOTE_ADDR'],
			$_SESSION['first_referer'],
			$user_ID,
			$_SERVER['HTTP_USER_AGENT']
		)
	);
	
}

function search_log($device_count = 0) {

	global $wpdb, $wpsc_query, $user_ID;

	$wpdb->query(
		$wpdb->prepare(
			"INSERT INTO search_log (
				datetime, 
				query, 
				products, 
				devices, 
				ip, 
				http_referer, 
				user_id, 
				user_agent,
				url
			) VALUES (
				%s,
				%s,
				%d,
				%d,
				%s,
				%s,
				%d,
				%s,
				%s
			)",
			date("Y-m-d H:i:s"),
			$_GET['product_search'],
			$wpsc_query->total_product_count,
			$device_count,
			$_SERVER['REMOTE_ADDR'],
			$_SESSION['first_referer'],
			$user_ID,
			$_SERVER['HTTP_USER_AGENT'],
			$_SERVER['REQUEST_URI']
		)
	);

}

function my_get_search_string() {
	return preg_split("/[\/\s-(),.]/ ", $_GET['product_search'], NULL, PREG_SPLIT_NO_EMPTY);
}

// moved to display.functions.php
/*function cs_get_device_url($device_id) {
	$url = get_option("product_list_url")."?device_id=".$device_id;
	if ( is_ssl() ) {
		$url = str_replace("http://", "https://", $url);
	}
	return $url;
}*/

function my_get_delivery_info() {
	return '';
}

function my_get_featured_products_home() {
	
	global $wpsc_query;
	
	$result = '';

	$title_lenght = 110;
	$wpsc_query = new WPSC_Query('featured=1');
	
	if(wpsc_product_count() > 0) {
		
		$result = '<div class="wpsc_featured_products clearfix">';
		$result .= '<h3>Специальные предложения нашего магазина</h3>';

		while(wpsc_have_products()) {
			
			wpsc_the_product();
			
			$result .= '<div class="fp_row">';
			if(wpsc_the_product_thumbnail()) {
				$result .= '<div class="fp_row_thumb"><img class="product_image" id="product_image_'.wpsc_the_product_id().'" src="'.wpsc_the_product_thumbnail().'" /></div>';
			} else {
				$result .= '<div class="fp_row_thumb fp_row_thumb_no_image"></div>';
			}
			$product_name = (mb_strlen(wpsc_the_product_title())<$title_lenght)?wpsc_the_product_title():mb_substr(wpsc_the_product_title(),0,$title_lenght).'...';
			$result .= '<ul>';
			$result .= '<li><a title="'.wpsc_the_product_title().'" href="'.wpsc_the_product_permalink().'">'.$product_name.'</a>'.wpsc_edit_the_product_link('Ред.').'</li>';
			$result .= '<li><span class="featured_price">'.wpsc_the_product_price(get_option('wpsc_hide_decimals')).' руб.</span></li>';
			$result .= '</ul>';
			$result .= '</div>';

		}
		
		$result .= '</div>';
	}

	return $result;
	
}

function my_update_destination() {
	
	global $wpsc_cart;
	
	$my_destination = 1;
	
	if(isset($_REQUEST['my_destination']) && is_numeric($_REQUEST['my_destination'])){
		$my_destination = $_REQUEST['my_destination'];
	}
	
	$wpsc_cart->update_location($my_destination);
	
}
  
// execute on POST and GET
if(isset($_REQUEST['my_update_destination']) && $_REQUEST['my_update_destination'] == 'true') { // from shopping_cart_page.php
	add_action('init', 'my_update_destination');
}

function my_set_destination_on_login($user_login, $user){
	// код дублируется в конструкторе wpsc_cart
	global /*$current_user,*/ $wpsc_cart;
	//get_currentuserinfo();
	$meta_data = get_user_meta($user->ID, 'wpshpcrt_usr_profile', true);
	if(!empty($meta_data)){
		if(isset($meta_data[42]) && is_numeric($meta_data[42])){ // my_destination_id (скрытый параметр)
			$wpsc_cart->update_location($meta_data[42]);
		}
	}
}
add_action('wp_login', 'my_set_destination_on_login', 10, 2);

function my_submitwpcheckout_profile() {
	
	global $wpsc_cart;
	
	if(isset($_POST['collected_data'][42]) && is_numeric($_POST['collected_data'][42])){ // my_destination_id (скрытый параметр)
		$wpsc_cart->update_location($_POST['collected_data'][42]);
	}
	
} 
if(isset($_REQUEST['submitwpcheckout_profile']) && $_REQUEST['submitwpcheckout_profile'] == 'true') { // from edit-profile.php
	add_action('init', 'my_submitwpcheckout_profile');
}

function my_save_questions_log($message){
	
	global $wpdb;
	
	$sql = $wpdb->prepare("INSERT INTO questions_log (`datetime`, `text`) VALUES (%s, %s)", date("Y-m-d H:i:s"), $message);
	
	if($wpdb->query($sql) !== false){ // возвращает целое число, соответствующее количеству затронутых/выбранных строк. При ошибке возвращает FALSE.
		$result = $wpdb->insert_id;
	} else $result = false;
	
	return $result; // false - ошибка, либо insert_id
	
}

function my_wpcf7_submit($wpcf7){
	
	$mail_template = $wpcf7->setup_mail_template($wpcf7->mail);
	$message = $string = preg_replace('~\R~u', "\r\n", $wpcf7->replace_mail_tags($mail_template['body']));
	
	my_save_questions_log("Событие: " . $wpcf7->mail['subject'] . "\r\n\r\n" . $message);

}

add_action('wpcf7_submit', 'my_wpcf7_submit');


function my_wpcf7_before_send_mail($wpcf7){
	$wpcf7->mail['recipient'] = MY_FEEDBACK_EMAIL;
}

add_action('wpcf7_before_send_mail', 'my_wpcf7_before_send_mail');


function my_copy_alert(){
	$result = '';
	if(MY_COPY_ALERT){
		$result = '<div style="text-align:center;background:lightcoral;"> ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ Копия! Копия! Копия! ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ </div>';
	}
	return $result;
}

function my_jivosite(){
	$result = '';
	if(MY_JIVOSITE){
		$result = "
			<script type='text/javascript' async>
			(function(){ var widget_id = 'gPR0cvAgsK';
			var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/geo-widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);})();</script>
		";
	}
	return $result;
}


function retail_rocket_allpage(){
	$result = '';
	if(MY_RETAIL_ROCKET){	
		$result = '
			<script type="text/javascript">
				   var rrPartnerId = "543bd4801e9944047c7ac344";       
				   var rrApi = {}; 
				   var rrApiOnReady = rrApiOnReady || [];
				   rrApi.addToBasket = rrApi.order = rrApi.categoryView = rrApi.view = 
					   rrApi.recomMouseDown = rrApi.recomAddToCart = function() {};
				   (function(d) {
					   var ref = d.getElementsByTagName(\'script\')[0];
					   var apiJs, apiJsId = \'rrApi-jssdk\';
					   if (d.getElementById(apiJsId)) return;
					   apiJs = d.createElement(\'script\');
					   apiJs.id = apiJsId;
					   apiJs.async = true;
					   apiJs.src = "//cdn.retailrocket.ru/content/javascript/tracking.js";
					   ref.parentNode.insertBefore(apiJs, ref);
				   }(document));
			</script>
		';
	}
	return $result;
}

function retail_rocket_singlepage($product_id){
	$result = '';
	if(MY_RETAIL_ROCKET){	
		$result = '
			<script type="text/javascript">
				(window["rrApiOnReady"] = window["rrApiOnReady"] || []).push(function() {
					try{ rrApi.view(' . $product_id . '); } catch(e) {}
				})
			</script>
		';
	}
	return $result;	
}

function retail_rocket_categorypage($category_id){
	$result = '';
	if(MY_RETAIL_ROCKET){	
		$result = '
			<script type="text/javascript">
				(window["rrApiOnReady"] = window["rrApiOnReady"] || []).push(function() {
					try { rrApi.categoryView(' . $category_id . '); } catch(e) {}
				})
			</script>
		';
	}
	return $result;	
}

function retail_rocket_addtobasket($product_id){
	$result = '';
	if(MY_RETAIL_ROCKET){	
		$result = 'try { rrApi.addToBasket(' . $product_id . ') } catch(e) {}';
	}
	return $result;	
}

function retail_rocket_result($id, $cart_arr){
	$result = '';
	if(MY_RETAIL_ROCKET){
		$cart_str = '';		
		foreach($cart_arr as $cart){
			$cart_str .= "{id: {$cart['prodid']}, qnt: {$cart['quantity']},  price: " . number_format($cart['price'], 0, ',', '') . "},";
		}
		$cart_str = trim($cart_str, ',');
		$result = '
			<script type="text/javascript">
			(window["rrApiOnReady"] = window["rrApiOnReady"] || []).push(function() {
				try {
					rrApi.order({
						transaction: ' . $id . ',
						items: [' . $cart_str . ']
					});
				} catch(e) {}
			})
			</script>
		';
		//$result .= '<script type="text/javascript">(window["rrApiOnReady"] = window["rrApiOnReady"] || []).push(function() { rrApi.setEmail("");	});</script>';
	}
	return $result;	
}

function cs_get_product_model($product_id){
	global $wpdb;
	return $wpdb->get_col($wpdb->prepare("SELECT cc.model FROM compat_clusters cc LEFT JOIN compat_products_clusters cpc ON cpc.cluster_id=cc.id where product_id = %d and cpc.active=1", $product_id));
}

function cs_get_product_maker_model($product_id){
	global $wpdb;
	return $wpdb->get_col($wpdb->prepare("SELECT cc.maker_model FROM compat_clusters cc LEFT JOIN compat_products_clusters cpc ON cpc.cluster_id=cc.id where product_id = %d and cpc.active=1", $product_id));
}

function my_get_shipping_string($shipping_cost, $shipping_name){
	return ($shipping_cost == 0)?"Бесплатная " . mb_strtolower($shipping_name):"{$shipping_name} за " . nzshpcrt_currency_display($shipping_cost, 0, true, false, false, 0) . " руб.";
}

function my_ajax_sendMessage(){
	
	//exit(var_dump($_POST));
	
	$result = 0;
	
	if(isset($_POST['type']) && !empty($_POST['type'])){
		
		$to = MY_FEEDBACK_EMAIL;
		$headers = "Content-type: text/plain; charset=UTF-8"."\r\n";
		$headers .= "From: \"ИТ Сервис, сайт\" <noreply@itural.ru>"."\r\n";
		
		switch($_POST['type']){
			
			case 'askQuestion':
				
				$name = stripslashes($_POST['parameters']['name']);
				$message = stripslashes($_POST['parameters']['message']);
				$contact = stripslashes($_POST['parameters']['contact']);
				
				$subject = "Вопрос с сайта";
				$content = "Имя клиента: {$name}\r\nСообщение: {$message}\r\nКогда и как связаться: {$contact}";

				wp_mail($to, $subject, $content, $headers);

				$content = "Событие: Вопрос с сайта\r\nИмя клиента: {$name}\r\nСообщение: {$message}\r\nКонтакты: {$contact}";

				if(my_save_questions_log($content) !== false){
					$result = 1;
				}
				
			break;
			
			case 'getСourier':
				
				$name = stripslashes($_POST['parameters']['name']);
				$goods = stripslashes($_POST['parameters']['goods']);
				$address = stripslashes($_POST['parameters']['address']);
				$contact = stripslashes($_POST['parameters']['contact']);
				
				$subject = "Вызов курьера";
				$content = "Имя клиента: {$name}\r\nЧто забрать: {$goods}\r\nАдрес: {$address}\r\nКогда и как с связаться: {$contact}";

				wp_mail($to, $subject, $content, $headers);

				$content = "Событие: Вызов курьера\r\nИмя клиента: {$name}\r\nЧто забрать: {$goods}\r\nАдрес: {$address}\r\nКонтакты: {$contact}";

				if(my_save_questions_log($content) !== false){
					$result = 1;
				} 
				
			break;
			
		}
		
	}
	
	header('Content-type:text/plain;charset=utf-8');
	echo $result;
	
	wp_die();

}

add_action('wp_ajax_nopriv_sendMessage', 'my_ajax_sendMessage');
add_action('wp_ajax_sendMessage', 'my_ajax_sendMessage');

// обратный звонок
require_once(WP_CONTENT_DIR . '/callback/callback.php');

?>
<?php
function arras_get_pluso($center=false){ ?>
	<div class="pluso_center" <?php if($center){ ?>style="margin:0 auto;"<?php } ?>>
		<div class="pluso_title">Поделиться ссылкой на эту страницу:</div>
		<script async type="text/javascript">(function(w,doc) {
		if (!w.__utlWdgt ) {
			w.__utlWdgt = true;
			var d = doc, s = d.createElement('script'), g = 'getElementsByTagName';
			s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
			s.src = ('https:' == w.location.protocol ? 'https' : 'http')  + '://w.uptolike.com/widgets/v1/uptolike.js';
			var h=d[g]('body')[0];
			h.appendChild(s);
		}})(window,document);
		</script>
		<div data-background-alpha="0.0" data-buttons-color="#ffffff" data-counter-background-color="#ffffff" data-share-counter-size="12" data-top-button="false" data-share-counter-type="common" data-share-style="1" data-mode="share" data-like-text-enable="false" data-mobile-view="false" data-icon-color="#ffffff" data-orientation="horizontal" data-text-color="#000000" data-share-shape="round" data-sn-ids="fb.vk.tw.ok.gp." data-share-size="20" data-background-color="#ffffff" data-preview-mobile="false" data-mobile-sn-ids="fb.vk.tw.wh.ok.gp." data-pid="1421913" data-counter-background-alpha="1.0" data-following-enable="false" data-exclude-show-more="false" data-selection-enable="false" class="uptolike-buttons" ></div>
	</div>
<?php } ?>
<?php function my_get_uptolike_single(){ ?>
<script async type="text/javascript">(function(w,doc) {
if (!w.__utlWdgt ) {
    w.__utlWdgt = true;
    var d = doc, s = d.createElement('script'), g = 'getElementsByTagName';
    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
    s.src = ('https:' == w.location.protocol ? 'https' : 'http')  + '://w.uptolike.com/widgets/v1/uptolike.js';
    var h=d[g]('body')[0];
    h.appendChild(s);
}})(window,document);
</script>
<div data-background-alpha="0.0" data-buttons-color="#aaaaaa" data-counter-background-color="#ffffff" data-share-counter-size="12" data-top-button="false" data-share-counter-type="common" data-share-style="0" data-mode="share" data-like-text-enable="false" data-hover-effect="rotate-cw" data-mobile-view="false" data-icon-color="#ffffff" data-orientation="horizontal" data-text-color="#000000" data-share-shape="round-rectangle" data-sn-ids="fb.vk.tw.ok." data-share-size="20" data-background-color="#ffffff" data-preview-mobile="false" data-mobile-sn-ids="fb.vk.tw.wh.ok.gp." data-pid="1421913" data-counter-background-alpha="1.0" data-following-enable="false" data-exclude-show-more="true" data-selection-enable="false" class="uptolike-buttons" ></div>
<?php } ?>
<?php function wpsc_page_breadcrumbs($single=false) {
	global $is_search_page, $wpsc_query, $is_compat_search, $is_cluster_search, $is_category_page;
	$home_title = 'Все категории';
	$breadcrumb_separator = '&nbsp;<span style="color:#bbb;">></span>&nbsp;';
	//echo "<pre>";print_r($wpsc_query);echo "</pre>";
    if(wpsc_has_breadcrumbs()) { ?>
		<div class='breadcrumb'>
			<a title="Перейти на главную страницу каталога" href="<?php echo get_option('product_list_url'); ?>"><?php echo $home_title; ?></a>
			<?php while (wpsc_have_breadcrumbs()) { wpsc_the_breadcrumb(); ?>
				<?php /*print_r($wpsc_query->breadcrumbs[$wpsc_query->current_breadcrumb]['id']);*/ ?>
				<?php if(wpsc_breadcrumb_url()) {
					echo $breadcrumb_separator . '<a href="' . wpsc_breadcrumb_url() . '">' . wpsc_breadcrumb_name() . '</a>';
				} else {
						if($is_search_page){
							//echo $breadcrumb_separator . '<a href="' . wpsc_category_url($wpsc_query->breadcrumbs[$wpsc_query->current_breadcrumb]['id']) . '">' . wpsc_breadcrumb_name() . '</a>' . $breadcrumb_separator . '<span>Результаты поиска &laquo;' . stripslashes($_GET['product_search']) . '&raquo;</span>';
							echo $breadcrumb_separator . '<a href="' . wpsc_category_url($wpsc_query->breadcrumbs[$wpsc_query->current_breadcrumb]['id']) . '">' . wpsc_breadcrumb_name() . '</a>';
						} elseif(!$single) {
							echo $breadcrumb_separator . '<span>' . wpsc_breadcrumb_name() . '</span>';
						} ?>
				<?php } ?> 
			<?php } ?>
			<?php
				//if($is_category_page && !$is_search_page){
				if($is_category_page || $wpsc_query->is_search_in_category){
					echo $breadcrumb_separator;
					echo '<form class="breadcrumb_search_form" action="'.wpsc_category_url($wpsc_query->category).'" method="GET" id="breadcrumb_product_search">';
					echo '<input class="breadcrumb_search_form_input" title="Введите запрос для поиска в этой категории" type="text" value="'.stripslashes($_GET['product_search']).'" name="product_search" placeholder="Поиск в этой категории" />';
					echo '<a onclick="document.getElementById(\'breadcrumb_product_search\').submit(); return false;" title="Искать в этой категории" class="breadcrumb_search_form_submit" href="javascript:{}"></a>';
					echo '</form>';
				}
			?>
		</div>
    <?php } elseif($is_search_page) {
		echo '<div class="breadcrumb"><a title="Перейти на главную страницу каталога" href="'.get_option('product_list_url').'">'.$home_title.'</a>' . $breadcrumb_separator . '<span>Результаты поиска &laquo;'.stripslashes($_GET['product_search']).'&raquo;</span></div>';
	} elseif($is_compat_search){
		$device_name = $wpsc_query->device_name;
		switch($wpsc_query->query_vars['type']){			
			case 'goods':
				echo '<div class="breadcrumb clearfix"><div class="breadcrumb_cs"><a title="Перейти на главную страницу каталога" href="' . get_option('product_list_url') . '">' . $home_title . '</a>' . $breadcrumb_separator . '<span>Картриджи ' . $device_name . '</span></div><div class="breadcrumb_cs_link"><a title="Перейти на страницу с ценами заправки картриджей для ' . $device_name . '" href="' . cs_get_device_url($wpsc_query->query_vars['device_id'], 'service') . '">Заправка картриджей ' . $device_name . '</a></div></div>';
				break;
			case 'service':
				echo '<div class="breadcrumb clearfix"><div class="breadcrumb_cs"><a title="Перейти на главную страницу каталога" href="' . get_option('product_list_url') . '">' . $home_title . '</a>' . $breadcrumb_separator . '<span>Заправка картриджей ' . $device_name . '</span></div><div class="breadcrumb_cs_link"><a title="Перейти на страницу с ценами новых картриджей для ' . $device_name . '" href="' . cs_get_device_url($wpsc_query->query_vars['device_id'], 'goods') . '">Новые картриджи ' . $device_name . '</a></div></div>';
				break;
			default:
				echo '<div class="breadcrumb clearfix"><a title="Перейти на главную страницу каталога" href="' . get_option('product_list_url') . '">' . $home_title . '</a>' . $breadcrumb_separator . '<span>' . $device_name . '</span></div>';
		}
	} elseif($is_cluster_search){
		echo '<div class="breadcrumb"><a title="Перейти на главную страницу каталога" href="'.get_option('product_list_url').'">'.$home_title.'</a>' . $breadcrumb_separator . '<span>' . $wpsc_query->cluster_name . '</span></div>';
	}
} ?>
<?php function wpsc_page_featured_products() { 
	global $wpsc_query;
	$title_lenght = 160; 
	$wpsc_query = new WPSC_Query('featured=1');
	if(wpsc_product_count() > 0) { ?>
		<div class="wpsc_page_featured_products clearfix">
			<h3>Специальные предложения</h3>
			<?php while(wpsc_have_products()) {
				wpsc_the_product(); ?>
				<div class="fp_row clearfix">
					<?php if(wpsc_the_product_thumbnail()) { ?>
						<div class="fp_row_thumb">						
							<img width="50" height="50" class="product_image" id="product_image_<?php echo wpsc_the_product_id(); ?>" src="<?php echo wpsc_the_product_thumbnail(); ?>"/>
						</div>
					<?php } else { ?>
						<div class="fp_row_thumb fp_row_thumb_no_image"></div>
					<?php } ?>
					<ul>
						<li><a title="<?php echo wpsc_the_product_title(); ?>" href="<?php echo wpsc_the_product_permalink(); ?>"><?php if(mb_strlen(wpsc_the_product_title())<$title_lenght) {echo wpsc_the_product_title();} else {echo mb_substr(wpsc_the_product_title(),0,$title_lenght).'...';}?></a><?php echo wpsc_edit_the_product_link('Ред.'); ?></li>
						<li><span class="featured_price"><?php echo wpsc_the_product_price(get_option('wpsc_hide_decimals')); ?> руб.</span></li>
					</ul>
				</div>
			<?php } ?>
		</div>
	<?php }
} ?>
<?php function wpsc_page_navigation() {
	if(wpsc_has_pages()) { ?>
		<div class="wpsc_page_numbers">
			<?php echo wpsc_pagination(); ?>
		</div>
	<?php } 
} ?>
<?php function my_wpsc_product_list($form_id = 'list') { ?>
	<?php global $wpsc_query; ?>
	<table class="list_productdisplay <?php echo wpsc_category_class(); ?>">
		<tr>
			<td class="id title"><span class="product_id">&nbsp;</span></td>
			<td class="name title"><span class='wpsc_category_boundary'>Наименование</span></td>
			<td class="unity title"><span title='Наличие'>Наличие</span></td>
			<td class="price title"><span>Цена, руб.</span></td>
			<td class="form title">&nbsp;</td>
		</tr>
		<?php $today = new DateTime(); ?>
		<?php while (wpsc_have_products()) {  wpsc_the_product(); ?>
			<?php
			$deliverydays = get_product_meta(wpsc_the_product_id(),'deliverydays',true);
			$usluga = get_product_meta(wpsc_the_product_id(),'usluga',true);
			if ($deliverydays == 0 && (int)$usluga == 0) { $alt_class = ' alt'; } else { $alt_class = ''; } ?>
			
			<tr class="product_view_<?php echo wpsc_the_product_id(); ?>">
				
				<td class="id">
					<?php $ddiff = $today->diff(new DateTime(wpsc_product_creation_time()));
						if((int)$ddiff->format('%a') <= MY_NEW_PRODUCT_DAYS){ ?>
							<div class="wpsc_new_product" title="Новый товар, недавно поступил в продажу"></div>
					<?php }	?>						
					<?php if(wpsc_the_product_thumbnail()) { ?>
						<a class="product_image_js" href="<?php echo wpsc_the_product_permalink($wpsc_query->product['category_id']); ?>"><img class="product_image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="<?php echo wpsc_the_product_title(); ?>" width="50" height="50" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo wpsc_the_product_thumbnail(); ?>"/></a>
						<div class="ttip_image"><img width="230" height="230" src="<?php echo "/index.php?productid=".wpsc_the_product_id()."&width=230&height=230"; ?>"/></div>
					<?php } ?>
				</td>
				
				<td class="name">
					
					<?php if(get_product_meta(wpsc_the_product_id(),'bu')==1) { ?>
						<a class="wpsc_product_title" href="<?php echo wpsc_the_product_permalink($wpsc_query->product['category_id']); ?>"><?php echo mb_strstr(wpsc_the_product_title(),' (б/у)',true); ?></a>
						<span class="tovar_bu" title="Товар был в употреблении. Прошел тестирование. Гарантия 1 мес.">б/у</span>
					<?php } else { ?>
						<a class="wpsc_product_title" href="<?php echo wpsc_the_product_permalink($wpsc_query->product['category_id']); ?>"><?php echo wpsc_the_product_title(); ?></a>
					<?php } ?>
					
					<?php if(get_product_meta(wpsc_the_product_id(),'verified')==1) { ?> <a class="test_ok" href="/testirovanie-zapravki/" title="Программа тестирования заправленных картриджей &laquo;Тест ОК!&raquo;">Тест&nbsp;ОК!</a><?php } ?>
					
					<?php $meta_orders = round((float)get_product_meta(wpsc_the_product_id(), 'orders')); 
						if($meta_orders > 0){ ?>
						<span class="wpsc_orders_list"><?php echo $meta_orders . " " . numberof($meta_orders, 'заказ', array('', 'а', 'ов')); ?></span>
					<?php }	?>	

					<?php
						if(my_is_editor()){
							echo '<span class="wpsc_creation_time">'.wpsc_product_creation_time('d.m.Y').'</span>';
						}						
					?>

					<?php echo wpsc_edit_the_product_link('Ред.'); ?>
					
					<?php 
						//print_r($wpsc_query->product); 
						if($wpsc_query->category != $wpsc_query->product['category_id']){
							echo '<div class="product_category">&raquo;&nbsp;' . htmlentities(wpsc_category_name($wpsc_query->product['category_id']), ENT_QUOTES, 'UTF-8') . '</div>';
						}
					?>
					
				</td>
				
				<td class="unity">
					<span class="stock_text ttip_stock_js<?php echo $alt_class; ?>"><?php echo my_get_stock_str($usluga, $deliverydays); ?></span>
					<div class="ttip_stock"><span class="ttip_stock_text"><?php echo my_get_stock_title($usluga, $deliverydays, get_product_meta(wpsc_the_product_id(),'predoplata',true)); ?></span></div>
				</td>
				
				<td class="price">
					<span id="product_price_<?php echo wpsc_the_product_id(); ?>"><?php echo wpsc_the_product_price(get_option('wpsc_hide_decimals')); ?></span>
				</td>
				
				<td class="form">
					
					<?php if(wpsc_product_external_link(wpsc_the_product_id()) != '') { ?>
						<?php	$action =  wpsc_product_external_link(wpsc_the_product_id()); ?>
					<?php } else { ?>
						<?php	$action =  wpsc_this_page_url(); ?>						
					<?php } ?>
					
					<form class='product_form'  enctype="multipart/form-data" action="<?php echo $action; ?>" method="post" name="product_<?php echo wpsc_the_product_id(); ?>" id="<?php echo $form_id; ?>_product_<?php echo wpsc_the_product_id(); ?>" >
						<input type="hidden" value="add_to_cart" name="wpsc_ajax_action"/>
						<input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="product_id"/>
						<div class='wpsc_buy_button_container'>
							<input type="submit" value="" name="Buy" class="wpsc_buy_button2" id="<?php echo $form_id; ?>_product_<?php echo wpsc_the_product_id(); ?>_submit_button" title="Добавить в корзину" onmousedown="<?php echo retail_rocket_addtobasket(wpsc_the_product_id()); ?>" />
						</div>
					</form>
				
				</td>
			
			</tr>

		<?php } ?>
	</table>
<?php } ?>
<?php function my_cs_form_home() { ?>
	<div class="cs_wpsc_home">
		<div class="cs_title_wpsc_home">Выберите ваш принтер:</div>
		<form action="<?php echo get_option('product_list_url'); ?>" method="get" class="cs_form_wpsc_home">
			<div>			
				<select class="cs_makers_js"></select>
				<select class="cs_families_js"></select>	
				<select name="device_id" class="cs_devices_js"></select>
			</div>
			<div>
				<button sub_count="" type="submit" name="type" value="goods" class="cs_button_js"><?php echo CS_FORM_GOODS_BUTTON_TITLE; ?></button>
				<button sub_count="" type="submit" name="type" value="service" class="cs_button_js"><?php echo CS_FORM_SERVICE_BUTTON_TITLE; ?></button>
			</div>
		</form>
		<div class="cs_notice">Не нашли принтер? <span class="fb_ask_a_quest_link cs_notice_link">Напишите нам</span>.</div>
	</div>
<?php } ?>
<?php function my_featured_cats_home() { ?>
	<div class="wpsc_home_featured_cats_title">Популярные категории</div>
	<div class="wpsc_home_featured_cats_table clearfix">
		<div class="wpsc_home_featured_cats_row">
			<?php
				wpsc_start_featured_category_query();
			?>
			<a href="[wpsc_category_url]" class="wpsc_home_featured_cats_cell">
				<span class="wpsc_hfcc_parent_name">[wpsc_parent_name]</span><span class="wpsc_hfcc_name">[wpsc_category_name]</span><span class="category_count">[wpsc_category_products_count]</span>
			</a>
			<?php wpsc_end_featured_category_query(array('delimiter'=>array('count'=>'3','text'=>'</div><div class="wpsc_home_featured_cats_row">'))); ?>
		</div>
	</div>
<?php } ?>

<?php

/***************************
 * скрывет меню в админке
 **************************/
add_action( 'admin_init', 'my_remove_menu_pages' );
function my_remove_menu_pages() {
   global $user_ID;
   if ( current_user_can( 'subscriber' ) ) {
      remove_menu_page( 'edit.php?post_type=staff' );
   }
}

