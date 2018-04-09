<?php
/*
 * Plugin Name: Google XML Sitemaps WPeC
 * Version: 1.0
 * Description: ***** НЕ ОБНОВЛЯТЬ ***** Adds categories and products to XML sitemap, using date_modified meta.
 * Author: Lee Willis & ]aka[, специально для «ИТ Сервис»
 */

function ses_wpsc_generate_category_entries () {

	global $wpdb, /*$wp_rewrite,*/ $table_prefix;

	/*if (!defined('WPSC_VERSION') || WPSC_VERSION < 3.7) {
		$product_list_table =  "{$table_prefix}product_list";
		$item_category_assoc_table = "{$table_prefix}item_category_associations";
		$product_categories_table = "{$table_prefix}product_categories";
		$date_sql = " NULL AS dt ";
		$pwhere_sql = "";
	} else {*/
		$product_list_table = WPSC_TABLE_PRODUCT_LIST;
		$item_category_assoc_table = WPSC_TABLE_ITEM_CATEGORY_ASSOC;
		$product_categories_table = WPSC_TABLE_PRODUCT_CATEGORIES;
		//$date_sql = " UNIX_TIMESTAMP(MAX(p.date_added)) as dt ";
		$date_sql = " UNIX_TIMESTAMP(MAX(m.meta_value)) as dt ";
		//$pwhere_sql = " AND p.publish = 1 ";
		$pwhere_sql = "";
	//}

	//$wp_rewrite->flush_rules();

	$generatorObject = &GoogleSitemapGenerator::GetInstance(); //Please note the "&" sign!

	if($generatorObject!=null) {

		/*$sql = $wpdb->prepare("SELECT c.id,
		                              $date_sql
		                         FROM $product_categories_table c,
		                              $item_category_assoc_table cp,
			                      $product_list_table p
		                        WHERE c.id = cp.category_id
		                          AND cp.product_id = p.id
		                          AND c.active = 1
		                          AND p.active = 1
		                          $pwhere_sql
		                     GROUP BY c.id");*/
		
		/*$sql = $wpdb->prepare("	SELECT c.id, $date_sql
								FROM $product_categories_table c, $item_category_assoc_table cp, $product_list_table p, wp_wpsc_productmeta m
		                        WHERE c.id = cp.category_id
		                          AND cp.product_id = p.id
		                          AND c.active = 1
		                          AND p.active = 1
		                          $pwhere_sql
								  AND p.id=m.product_id
								  AND meta_key='date_modified'
								GROUP BY c.id");*/
		
		// jakal, since WP 3.5 there is two args for prepare
		$sql = "SELECT c.id, UNIX_TIMESTAMP(MAX(m.meta_value)) as dt FROM wp_wpsc_product_categories c, wp_wpsc_item_category_assoc cp, wp_wpsc_product_list p, wp_wpsc_productmeta m WHERE c.id = cp.category_id AND cp.product_id = p.id AND c.active = '1' AND p.active = '1' AND p.publish='1' AND p.id=m.product_id AND meta_key='date_modified' GROUP BY c.id";
		
		$results = $wpdb->get_results($sql);

		foreach ($results as $category) {
			// generatorObject will escape & to &amp; etc. Unfortunately WPSC has already done that - so un-encode it first
			$generatorObject->AddUrl(html_entity_decode(wpsc_category_url($category->id)), $category->dt, "weekly", 0.4);
		}

	}

}

function ses_wpsc_generate_product_entries (){

	global $wpdb, /*$wp_rewrite,*/ $table_prefix;
	
	/*if (!defined('WPSC_VERSION') || WPSC_VERSION < 3.7) {
		$product_list_table =  "{$table_prefix}product_list";
		$product_rating_table = "{$table_prefix}product_rating";
		$date_sql = " NULL AS dt ";
	} else {*/
		$product_list_table = WPSC_TABLE_PRODUCT_LIST;
		//$product_rating_table = WPSC_TABLE_PRODUCT_RATING;
		$product_meta_table = WPSC_TABLE_PRODUCTMETA;
		/*$date_sql = " IF ( MAX(r.time) IS NULL OR UNIX_TIMESTAMP(date_added) > MAX(r.time),
	                                   UNIX_TIMESTAMP(date_added),
					   MAX(r.time)) AS dt ";*/
		$date_sql = " UNIX_TIMESTAMP(m.meta_value) AS dt ";
	    //$where_sql = " AND publish = 1 ";
		$where_sql = "";
	//}

	//$wp_rewrite->flush_rules();

	$generatorObject = &GoogleSitemapGenerator::GetInstance(); //Please note the "&" sign!

	if($generatorObject!=null) {

		/*$sql = $wpdb->prepare("SELECT p.id,
		                              $date_sql
		                         FROM $product_list_table p
		                    LEFT JOIN $product_rating_table r
		                           ON p.id = r.productid
		                        WHERE active = 1
		                              $where_sql
		                     GROUP BY p.id");*/
		
		/*$sql = $wpdb->prepare("	SELECT p.id, $date_sql
		                        FROM $product_list_table p, $product_meta_table m
		                        WHERE p.active = 1 and p.id=m.product_id and meta_key='date_modified' $where_sql
								GROUP BY p.id");*/
								
		// jakal, since WP 3.5 there is two args for prepare
		$sql = "SELECT p.id, UNIX_TIMESTAMP(m.meta_value) AS dt FROM wp_wpsc_product_list p, wp_wpsc_productmeta m WHERE p.active ='1' AND p.publish='1' AND p.id=m.product_id AND meta_key='date_modified' GROUP BY p.id";

		$results = $wpdb->get_results($sql);

		foreach ($results as $product) {
			// generatorObject will escape & to &amp; etc. Unfortunately WPSC has already done that - so un-encode it first
			$generatorObject->AddUrl(html_entity_decode(wpsc_product_url($product->id)), $product->dt, "weekly", 0.4);
		}

	}

}

/*function ses_wpsc_rebuild_sitemap ($id) {
	do_action('sm_rebuild');
}*/

// jakal, disable sitemap generation on edit product
//add_action('wpsc_edit_product', 'ses_wpsc_rebuild_sitemap');
//add_action('wpsc_rate_product', 'ses_wpsc_rebuild_sitemap');

function my_wpsc_generate_device_entries(){
	global $wpdb;
	$generatorObject = &GoogleSitemapGenerator::GetInstance();
	if($generatorObject!=null) {
		$results = $wpdb->get_results("
			SELECT cd.id, UNIX_TIMESTAMP(MAX(pm.meta_value)) dt
			FROM compat_devices cd
			LEFT JOIN compat_products_devices cpd ON cpd.device_id = cd.id
			LEFT JOIN wp_wpsc_productmeta pm ON (pm.product_id = cpd.product_id AND pm.meta_key = 'date_modified')
			WHERE cd.active = 1
			GROUP BY cd.id
			", ARRAY_A);
		foreach($results as $result){			
			$dt = ($result['dt'] == '')?'1493890677':$result['dt']; // если нет времени изменения по привязанным товарам, то ставим константную дату 05/04/2017 @ 9:37am (UTC)
			$generatorObject->AddUrl(html_entity_decode(cs_get_device_url($result['id'], 'goods')), $dt, "weekly", 0.4);
			$generatorObject->AddUrl(html_entity_decode(cs_get_device_url($result['id'], 'service')), $dt, "weekly", 0.4);
		}
	}	
}

add_action('sm_buildmap', 'my_wpsc_generate_device_entries');
add_action('sm_buildmap', 'ses_wpsc_generate_product_entries');
add_action('sm_buildmap', 'ses_wpsc_generate_category_entries');

//do_action('sm_rebuild');

?>
