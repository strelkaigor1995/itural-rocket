<?php
global $wpsc_query, $wpdb;

//echo "<pre>";debug_print_backtrace();echo "</pre>";
//echo "<pre>";print_r($wpsc_query);echo "</pre>";
 
$device_list = ""; $num_rows = 0;

$search_string_tokens = my_get_search_string();

if(!empty($search_string_tokens) && !$wpsc_query->is_search_in_category) {

	$sql_likes_compat = array();
	
	foreach($search_string_tokens as $search_token){
		//$sql_likes_compat[] = "CONCAT_WS(' ', m.maker, f.family, d.name) LIKE '%".$wpdb->escape($search_token)."%'";
		$sql_likes_compat[] = "CONCAT(m.maker, f.family, d.name) LIKE '%".$wpdb->escape($search_token)."%'";
	}
	
	$sql_condition_compat = implode(" AND ", $sql_likes_compat);

	$sql = "SELECT d.id FROM compat_devices d LEFT JOIN compat_families f ON d.family_id=f.id LEFT JOIN compat_makers m ON f.maker_id=m.id WHERE $sql_condition_compat AND d.active=1 ORDER BY m.maker, f.family, d.name";
	
	//exit($sql);
	
	$result = $wpdb->get_results($sql, ARRAY_A);
	$num_rows = $wpdb->num_rows;

	if($result) {
		
		$device_list .= '<h1>Принтеры и МФУ<span class="category_count">'.$num_rows.'</span></h1>';
		$device_list .= '<div class="c_device_search_table">';
		$device_list .= '<div class="c_device_search_row">';
		
		$i = 0;
		$max_devices = 12;
		
		foreach($result as $row) {				
			$i++;
			$device_list .= '<a class="c_device_search_cell" href="'.cs_get_device_url($row['id']).'">'.cs_get_device_name($row['id']).'</a>';
			if($i % 4 == 0){ 
				if($i > ($max_devices - 1))
					$device_list .= '</div><div class="c_device_search_row cdsr_hidden">';
				else
					$device_list .= '</div><div class="c_device_search_row">';
			}
			
		}
		$device_list .= '</div>';
		$device_list .= '</div>';
		if($num_rows > $max_devices) {
			$device_list .= '<a href="javascript:" class="c_device_search_link cdsl_show_js">Показать еще '.($num_rows - $max_devices).' '.numberof($num_rows - $max_devices, 'принтер', array('', 'а', 'ов')).'<i class="chevron chevron_down"></i></a>'; 
			$device_list .= '<a href="javascript:" class="c_device_search_link cdsl_hide_js" style="display:none;">Скрыть</a>';
		}
		
	}	
	
}

?>

<div class="search_page">

	<?php echo $device_list; ?>

	<?php if(wpsc_product_count() > 0) { ?>
		
		<h1>Товары и услуги<span class="category_count"><?php echo $wpsc_query->total_product_count; ?></span></h1>
		
		<div class="clearfix">

			<div class="wpsc_sidebar_search">
				<div class="wpsc_sidebar_title_search">Категории поиска</div>
				<?php if($wpsc_query->is_search_in_category) { echo '<a href="'.add_query_arg('product_search', $_GET['product_search'], get_option('product_list_url')).'" class="wpsc_sidebar_any_cat">< Любая категория</a>'; } ?>
				<ul>
					<?php wpsc_start_category_search_query(); ?>
						[wpsc_category]
					<?php wpsc_end_category_search_query();	?>
				</ul>
			</div>
				
			<div id='products_page_container' class="wrap wpsc_container">
				
				<div class="nav_view_form_wrapper">
					<?php wpsc_page_navigation();  ?>
					<?php gold_shpcrt_view_form(); ?>
				</div>
				
				<?php my_wpsc_product_list(); ?>
				
				<div class="nav_view_form_wrapper">
					<?php wpsc_page_navigation(); ?>
				</div>
				
				<?php echo fancy_notifications(); ?>
				
			</div> <!-- products_page_container -->
			
		</div>
		
	<?php } ?>

	<?php if(wpsc_product_count() < 1 && $num_rows < 1) { ?>
		<div class="found_nothing_title">По вашему запросу ничего не найдено</div>
		<div class="found_nothing">Попробуйте сократить запрос или задать его по-другому. Убедитесь, что название бренда и модели написано правильно.<br>Или обратитесь к нашим менеджерам за помощью.</div>
		
		<?php my_cs_form_home(); ?>
		<?php my_featured_cats_home(); ?>
		
		<div class="search_page_all_cats"><a href="<?php echo get_option('product_list_url'); ?>">Все категории</a><span class="category_count">&nbsp;<?php echo wpsc_gmcpc(66600030)+wpsc_gmcpc(66600010)+wpsc_gmcpc(66600020); ?></span></div>
		
	<?php } ?>
	
	<?php search_log($num_rows); // запишем поисковый запрос в БД ?>
	
	<?php echo my_get_featured_products_home(); ?>
	
	<?php //echo my_get_delivery_info(); ?>
	
	<?php arras_get_pluso(); ?>

</div> <!-- search_page -->
