<?php
/**
 * WP eCommerce display functions
 *
 * These are functions for the wp-eCommerce theme engine, template tags and shortcodes
 *
 * @package wp-e-commerce
 * @since 3.7
*/




/**
* wpsc buy now button code products function
* Sorry about the ugly code, this is just to get the functionality back, buy now will soon be overhauled, and this function will then be completely different
* @return string - html displaying one or more products
*/
function wpsc_buy_now_button($product_id, $replaced_shortcode = false) {
  global $wpdb, $wpsc_query, $wpsc_cart;
  $temp_wpsc_query = new WPSC_query(array('product_id' =>$product_id));
  list($wpsc_query, $temp_wpsc_query) = array($temp_wpsc_query, $wpsc_query); // swap the wpsc_query objects
//  exit('<pre>'.print_r($temp_wpsc_query, true).'</pre>');
  $selected_gateways = get_option('custom_gateway_options');
  if (in_array('google', (array)$selected_gateways)) {
		$output .= google_buynow($product['id']);
	} else if (in_array('paypal_multiple', (array)$selected_gateways)) {
		if ($product_id > 0){
				//$output .= "<pre>".print_r($wpsc_query,true)."</pre>";
			while (wpsc_have_products()) :
				wpsc_the_product();
				$price =  calculate_product_price($wpsc_query->product['id'], $wpsc_query->first_variations); 
				$shipping = $wpsc_query->product['pnp'];
				if(wpsc_uses_shipping()){$handling = get_option('base_local_shipping');}else{$handling = $shipping;}

				$output .= "<form onsubmit='log_paypal_buynow(this)' target='paypal' action='".get_option('paypal_multiple_url')."' method='post' />
					<input type='hidden' name='business' value='".get_option('paypal_multiple_business')."' />
					<input type='hidden' name='cmd' value='_xclick' />
					<input type='hidden' name='item_name' value='".wpsc_the_product_title()."' />
					<input type='hidden' id='item_number' name='item_number' value='".wpsc_the_product_id()."' />
					<input type='hidden' id='amount' name='amount' value='".($price+$pnp)."' />
					<input type='hidden' id='unit' name='unit' value='".$price."' />
					<input type='hidden' id='shipping' name='ship11' value='".$shipping."' />
					<input type='hidden' name='handling' value='".$handling."' />
					<input type='hidden' name='currency_code' value='".get_option('paypal_curcode')."' />";
				if(get_option('multi_add') == 1){
					$output .="<label for='quantity'>".__('Quantity','wpsc')."</label>";
					$output .="<input type='text' size='4' id='quantity' name='quantity' value='' /><br />";
				}else{
					$output .="<input type='hidden' name='undefined_quantity' value='0' />";
				}
					$output .="<input type='image' name='submit' border='0' src='https://www.paypal.com/en_US/i/btn/btn_buynow_LG.gif' alt='PayPal - The safer, easier way to pay online' />
					<img alt='' border='0' width='1' height='1' src='https://www.paypal.com/en_US/i/scr/pixel.gif' />
				</form>\n\r";
			endwhile;
		}
	}
	
	list($temp_wpsc_query, $wpsc_query) = array($wpsc_query, $temp_wpsc_query); // swap the wpsc_query objects back
	if($replaced_shortcode == true) {
		return $output;
	} else {
		echo $output;
  }
}



function wpsc_also_bought($product_id) {
  /*
   * Displays products that were bought aling with the product defined by $product_id
   * most of it scarcely needs describing
   */
  global $wpdb;
  $siteurl = get_option('siteurl');
  
  if(get_option('wpsc_also_bought') == 0) {
    //returns nothing if this is off
    return '';
	}
  
  // to be made customiseable in a future release
  $also_bought_limit = 3;
  $element_widths = 96; 
  $image_display_height = 96; 
  $image_display_width = 96; 
  
  $also_bought = $wpdb->get_results("SELECT `".WPSC_TABLE_PRODUCT_LIST."`.* FROM `".WPSC_TABLE_ALSO_BOUGHT."`, `".WPSC_TABLE_PRODUCT_LIST."` WHERE `selected_product`='".$product_id."' AND `".WPSC_TABLE_ALSO_BOUGHT."`.`associated_product` = `".WPSC_TABLE_PRODUCT_LIST."`.`id` AND `".WPSC_TABLE_PRODUCT_LIST."`.`active` IN('1') AND `".WPSC_TABLE_PRODUCT_LIST."`.`publish` IN ('1')ORDER BY `".WPSC_TABLE_ALSO_BOUGHT."`.`quantity` DESC LIMIT $also_bought_limit",ARRAY_A);
  if(count($also_bought) > 0) {
    $output = "<h2 class='prodtitles wpsc_also_bought' >".__('People who bought this item also bought', 'wpsc')."</h2>";
    $output .= "<div class='wpsc_also_bought'>";
    foreach((array)$also_bought as $also_bought_data) {
      $output .= "<div class='wpsc_also_bought_item' style='width: ".$element_widths."px;'>";
      
      if(get_option('show_thumbnails') == 1) {
        if($also_bought_data['image'] !=null) {

          $output .= "<a href='".wpsc_product_url($also_bought_data['id'])."' class='preview_link'  rel='".str_replace(" ", "_",$also_bought_data['name'])."'>";
					$image_path = "index.php?productid=" . $also_bought_data['id'] . "&amp;width=" . $image_display_width."&amp;height=" . $image_display_height. "";
          
          $output .= "<img src='$image_path' id='product_image_".$also_bought_data['id']."' class='product_image' style='margin-top: ".$margin_top."px'/>";
          $output .= "</a>";
				} else {
          if(get_option('product_image_width') != '') {
            $output .= "<img src='".WPSC_URL."/images/no-image-uploaded.gif' title='".$also_bought_data['name']."' alt='".$also_bought_data['name']."' width='$image_display_height' height='$image_display_height' id='product_image_".$also_bought_data['id']."' class='product_image' />";
					} else {
            $output .= "<img src='".WPSC_URL."/images/no-image-uploaded.gif' title='".$also_bought_data['name']."' alt='".htmlentities(stripslashes($product['name']), ENT_QUOTES, 'UTF-8')."' id='product_image_".$also_bought_data['id']."' class='product_image' />";
					}
				}
			}

			$variations_processor = new nzshpcrt_variations;
			$variations_output = $variations_processor->display_product_variations($also_bought_data['id'],true, false, true);
			//$output .= $variations_output[0];
			if($variations_output[1] !== null) {
				$also_bought_data['price'] = $variations_output[1];
				$also_bought_data['special_price'] = 0;
			}
		
      $output .= "<a class='wpsc_product_name' href='".wpsc_product_url($also_bought_data['id'])."'>".$also_bought_data['name']."</a>";
			$output .= nzshpcrt_currency_display(($also_bought_data['price'] - $also_bought_data['special_price']), $also_bought_data['notax'],false,$also_bought_data['id']);
      //$output .= "<a href='".wpsc_product_url($also_bought_data['id'])."'>".$also_bought_data['name']."</a>";
      $output .= "</div>";
		}
    $output .= "</div>";
    $output .= "<br clear='all' />";
	}
  return $output;
}  


function fancy_notifications() {
  global $wpdb;
  if(get_option('fancy_notifications') == 1) {
    $output = "";
    $output .= "<div id='fancy_notification'>";
    $output .= "  <div id='loading_animation'>";
    //$output .= '<img width="16" height="16" id="fancy_notificationimage" src="'.WPSC_URL.'/images/indicator.gif" />'."<span>Обновление корзины...</span>";
	$output .= '<img width="20" height="20" id="fancy_notificationimage" src="' . get_template_directory_uri() . '/js/iload/wait.gif" />'."<span>Обновление корзины...</span>";
    $output .= "  </div>";
    $output .= "  <div id='fancy_notification_content'>";
    $output .= "  </div>";
    $output .= "</div>";
	}
  return $output;
}

function fancy_notification_content($cart_messages) {
  global $wpdb;
  $title_lenght=108;
  //$siteurl = get_option('siteurl');
  $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
	foreach((array)$cart_messages as $cart_message) {
		if(mb_strlen($cart_message)>$title_lenght) {$cart_message=mb_substr($cart_message,0,$title_lenght).'...';}
		$output .= "<div>".$cart_message."</div>";
	}
	$output .= "<a href='".get_option('shopping_cart_url')."' onclick='window.location = this.href; return false;' class='go_to_checkout go_to_checkout_js'>Оформить заказ</a>";
	$output .= "<a href='#' onclick='jQuery(\"#fancy_notification\").hide(); return false;' class='continue_shopping'>Продолжить покупки</a>";
	//$output .= "<a href='".$uri_parts[0]."' class='continue_shopping'>Продолжить покупки</a>";
  return $output;
}


function wpsc_product_url($product_id, $category_id = null, $escape = true) {
  global $wpdb, $wp_rewrite, $wp_query;
  
  if(!is_numeric($category_id) || ($category_id < 1)) {
		if(is_numeric($wp_query->query_vars['product_category'])) {
		  $category_id = $wp_query->query_vars['product_category'];
		} else {
			$category_list = $wpdb->get_row("SELECT `".WPSC_TABLE_PRODUCT_CATEGORIES."`.`id`, IF((`".WPSC_TABLE_PRODUCT_CATEGORIES."`.`id` = '".get_option('wpsc_default_category')."'), 0, 1) AS `order_state` FROM `".WPSC_TABLE_ITEM_CATEGORY_ASSOC."` , `".WPSC_TABLE_PRODUCT_CATEGORIES."` WHERE `".WPSC_TABLE_ITEM_CATEGORY_ASSOC."`.`product_id` IN ('".$product_id."') AND `".WPSC_TABLE_ITEM_CATEGORY_ASSOC."`.`category_id` = `".WPSC_TABLE_PRODUCT_CATEGORIES."`.`id` AND `".WPSC_TABLE_PRODUCT_CATEGORIES."`.`active` IN('1') LIMIT 1",ARRAY_A);
			$category_id = $category_list['id'];		
		}
  }
  

//  exit('<pre>'.print_r($wp_query, true).'</pre>');
  if((($wp_rewrite->rules != null) && ($wp_rewrite != null)) || (get_option('rewrite_rules') != null)) {
    
	/*
	$url_name = get_product_meta($product_id, 'url_name', true);
    $url_name = htmlentities(stripslashes($url_name), ENT_QUOTES, 'UTF-8');
	$product_url = wpsc_category_url($category_id).$url_name."/";
	*/
	
	// у нас урл продукта = коду продукта
	$product_url = wpsc_category_url($category_id) . $product_id . "/";
	
	//die($product_url);
	
  } else {    
    if(!stristr(get_option('product_list_url'), "?")) {
      $initial_seperator = "?";
    } else {
      $initial_seperator = ($escape) ? "&amp;" : "&";
    }
    if(is_numeric($category_id) && ($category_id > 0)) {
      $product_url = get_option('product_list_url').$initial_seperator."category=".$category_id.(($escape) ? "&amp;" : "&")."product_id=".$product_id;
    } else {
      $product_url = get_option('product_list_url').$initial_seperator."product_id=".$product_id;
    }
  }
  return $product_url;
}


function google_buynow($product_id) {
	global $wpdb;
	$output = "";
	if ($product_id > 0){
		$product_sql = "SELECT * FROM ".WPSC_TABLE_PRODUCT_LIST." WHERE id = ".$product_id." LIMIT 1";
		$product_info = $wpdb->get_results($product_sql, ARRAY_A);
		$variation_sql = "SELECT * FROM ".WPSC_TABLE_VARIATION_PROPERTIES." WHERE product_id = ".$product_id;
		$variation_info = $wpdb->get_results($variation_sql, ARRAY_A);
		if (count($variation_info) > 0) {
			$variation = 1;
			$price = $variation_info[0]['price'];
		}
		if (get_option('google_server_type')=='production') {
			$action_target = "https://checkout.google.com/cws/v2/Merchant/".get_option('google_id')."/checkoutForm";
		} else {
			$action_target = "https://sandbox.google.com/checkout/cws/v2/Merchant/".get_option('google_id')."/checkoutForm";
		}

	
		$product_info = $product_info[0];
		$output .= "<form id='BB_BuyButtonForm".$product_id."' onsubmit='log_buynow(this);return true;' action= '".$action_target."' method='post' name='BB_BuyButtonForm".$product_id."'>";
		$output .= "<input name='product_id' type='hidden' value='".$product_id."'>";
		$output .= "<input name='item_name_1' type='hidden' value='".$product_info['name']."'>";
		$output .= "<input name='item_description_1' type='hidden' value='".$product_info['description']."'>";
		$output .= "<input name='item_quantity_1' type='hidden' value='1'>";
		if ($variation == 1) {
			$output .= "<input id='item_price' name='item_price_1' type='hidden' value='".$price."'>";
		} else {
			if ($product_info['special']=='0') {
				$output .= "<input id='item_price' name='item_price_1' type='hidden' value='".$product_info['price']."'>";
			} else {
				$output .= "<input name='item_price_1' type='hidden' value='".$product_info['special_price']."'>";
			}
		}
		$output .= "<input name='item_currency_1' type='hidden' value='".get_option('google_cur')."'>";
		$output .= "<input type='hidden' name='checkout-flow-support.merchant-checkout-flow-support.continue-shopping-url' value='".get_option('product_list_url')."'>";
		$output .= "<input type='hidden' name='checkout-flow-support.merchant-checkout-flow-support.edit-cart-url' value='".get_option('shopping_cart_url')."'>";
		$output .= "<input alt='' src=' https://checkout.google.com/buttons/buy.gif?merchant_id=".get_option('google_id')."&w=117&h=48&style=trans&variant=text&loc=en_US' type='image'/>";
		$output .="</form>";
	}
	return $output;
}

function external_link($product_id) { 
	global $wpdb;
	$link = get_product_meta($product_id,'external_link',true);
	if (!stristr($link,'http://')) {
		$link = 'http://'.$link;
	}
	$output .= "<input type='button' value='".__('Buy Now', 'wpsc')."' onclick='gotoexternallink(\"$link\")'>";
	return $output;
}


// displays error messages if the category setup is odd in some way
// needs to be in a function because there are at least three places where this code must be used.
function wpsc_odd_category_setup() {
	get_currentuserinfo();
  global $userdata;  
  $output = '';
  if(($userdata->wp_capabilities['administrator'] ==1) || ($userdata->user_level >=9)) {
    if(get_option('wpsc_default_category') == 1) {
			$output = "<p>".__('You are using the example product group as your default group and it has no products in it, you should set the default group to something else, you can do so from your Shop Settings page.', 'wpsc')."</p>";
		} else {
		  $output = "<p>".__('This group is set as your default product group, you should either add some items to it or switch your default product group to one that does contain items.', 'wpsc')."</p>";
		}
  }
  return $output;
}


function wpsc_product_image_html($image_name, $product_id) {
  global $wpdb, $wp_query;
	if(is_numeric($wp_query->query_vars['product_category'])) {
    $category_id = (int)$wp_query->query_vars['product_category'];
	} else if (is_numeric($_GET['category'])) {
    $category_id = (int)$_GET['category'];
	} else {
    $category_id = (int)get_option('wpsc_default_category');
	}
	
	$product['height'] = get_product_meta($id, 'thumbnail_height');	
	$product['width']  = get_product_meta($id, 'thumbnail_width');
	
	
	$use_thumbnail_image = 'false';
	if(($product['height'] > $category['height']) || ($product['width'] > $category['width'])) {
		$use_thumbnail_image = 'true';
	}
	
	//list($category['height'], $category['width']) =
if($category_id > 0) {
	$category = $wpdb->get_row("SELECT `image_height` AS `height`, `image_width` AS `width` FROM `".WPSC_TABLE_PRODUCT_CATEGORIES."` WHERE `id` IN ('{$category_id}') LIMIT 1", ARRAY_A);
	}
	// if there is a height, width, and imagePNG function
	if(($category['height'] != null) && ($category['width'] != null) && (function_exists('ImagePNG'))) {
		$image_path = "index.php?productid=".$product_id."&amp;thumbnail=".$use_thumbnail_image."&amp;width=".$category['width']."&amp;height=".$category['height']."";
	} else {
		$image_path = WPSC_THUMBNAIL_URL.$image_name;
		if(is_ssl()) {
			$image_path = str_replace("http://", "https://", $image_path);
		}
	}
  return $image_path;
}


/* 19-02-09
 * add cart button function used for php template tags and shortcodes
*/
function wpsc_add_to_cart_button($product_id, $replaced_shortcode = false) {
	global $wpdb;
	if ($product_id > 0){
		if(function_exists('wpsc_theme_html')) {
			$product = $wpdb->get_row("SELECT * FROM ".WPSC_TABLE_PRODUCT_LIST." WHERE id = ".$product_id." LIMIT 1", ARRAY_A);
			//this needs the results from the product_list table passed to it, does not take just an ID
			$wpsc_theme = wpsc_theme_html($product);
		}
		
		// grab the variation form fields here
		$variations_processor = new nzshpcrt_variations;         
		$variations_output = $variations_processor->display_product_variations($product_id,false, false, false);

		$output .= "<form onsubmit='submitform(this);return false;'  action='' method='post'>";
		if($variations_output != '') { //will always be set, may sometimes be an empty string 
			$output .= "           <p>".$variations_output."</p>";
		}	
		$output .= "<input type='hidden' name='wpsc_ajax_action' value='add_to_cart' />";
		$output .= "<input type='hidden' name='product_id' value='".$product_id."' />";
		$output .= "<input type='hidden' name='item' value='".$product_id."' />";
		if(isset($wpsc_theme) && is_array($wpsc_theme) && ($wpsc_theme['html'] !='')) {
				$output .= $wpsc_theme['html'];
		} else {
			$output .= "<input type='submit' id='product_".$product['id']."_submit_button' class='wpsc_buy_button' name='Buy' value='".__('Add To Cart', 'wpsc')."'  />";
		}
		$output .= '</form>';
		if($replaced_shortcode == true) {
			return $output;
		} else {
			echo $output;
	 	}
	} 
}


  
function wpsc_refresh_page_urls($content) {
 global $wpdb;
 $wpsc_pageurl_option['product_list_url'] = '[productspage]';
 $wpsc_pageurl_option['shopping_cart_url'] = '[shoppingcart]';
 $check_chekout = $wpdb->get_var("SELECT `guid` FROM `{$wpdb->posts}` WHERE `post_content` LIKE '%[checkout]%' AND `post_type` NOT IN('revision','nav_menu_item') AND `post_type`='page' LIMIT 1");
 if($check_chekout != null) {
   $wpsc_pageurl_option['checkout_url'] = '[checkout]';
   } else {
   $wpsc_pageurl_option['checkout_url'] = '[checkout]';
   }
 $wpsc_pageurl_option['transact_url'] = '[transactionresults]';
 $wpsc_pageurl_option['user_account_url'] = '[userlog]';
 $changes_made = false;
 foreach($wpsc_pageurl_option as $option_key => $page_string) {
   $post_id = $wpdb->get_var("SELECT `ID` FROM `{$wpdb->posts}` WHERE `post_type` IN('page','post') AND `post_content` LIKE '%$page_string%' AND `post_type` NOT IN('revision') LIMIT 1");
   $the_new_link = get_permalink($post_id);
   if(stristr(get_option($option_key), "https://")) {
     $the_new_link = str_replace('http://', "https://",$the_new_link);
   }    
   update_option($option_key, $the_new_link);
  }
 return $content;
}

// получаем УРЛ вида: kartridzhi/HP-Color-LaserJet-CP1515/
function cs_get_device_rewrite_url($type, $url){
	switch($type){
		case 'goods':
			$prefix = 'kartridzhi/';
			break;
		case 'service':
			$prefix = 'zapravka-kartridzhey/';
			break;
		default:
			$prefix = '';
	}
	return $prefix . $url . '/';
}

function cs_get_device_url($device_id, $type = '', $page = 0){
	
	global $wpdb;	
	
	$url = $wpdb->get_var($wpdb->prepare('select url from compat_devices where id = %d and active = 1', $device_id));
	
	if($url != '' && $type != ''){
		$device_url = site_url() . '/' . cs_get_device_rewrite_url($type, $url) . ($page == 0 ? '' : "page/$page/");
	} else {
		$device_url = get_option('product_list_url') . ($page == 0 ? '' : "page/$page/");
		$device_url = add_query_arg('device_id', $device_id, $device_url);
		if($type != '') $device_url = add_query_arg('type', $type, $device_url);		
	}
	
	/*if ( is_ssl() ) {
		$device_url = str_replace('http://', 'https://', $device_url);
	}*/

	return esc_url($device_url);

}

function cs_get_cluster_url($cluster_id, $page = 0){
	$url = get_option('product_list_url') . ($page == 0 ? '' : "page/$page/");
	return esc_url(add_query_arg('cluster_id', $cluster_id, $url));
}
  
function wpsc_product_permalinks($rewrite_rules) {
	
	global $wpdb, $wp_rewrite;

	$page_details = $wpdb->get_row("SELECT * FROM `".$wpdb->posts."` WHERE `post_content` LIKE '%[productspage]%' AND `post_type`= 'page' LIMIT 1", ARRAY_A);
	
	$is_index = false;
	
	if((get_option('page_on_front') == $page_details['ID']) && (get_option('show_on_front') == 'page')) {
		$is_index = true;
	}

	$first_post_name = $page_details['post_name'];
	$page_name_array[] = $page_details['post_name'];
	if($page_details['post_parent'] > 0) {
		$count = 0;
		while(($page_details['post_parent'] > 0) && ($count <= 20)) {
			$page_details = $wpdb->get_row("SELECT * FROM `".$wpdb->posts."` WHERE `ID` IN('{$page_details['post_parent']}') AND `post_type` NOT IN('revision') LIMIT 1", ARRAY_A);
			$page_name_array[] = $page_details['post_name'];
			$count ++;
		}
	}

	$page_name_array = array_reverse($page_name_array);
	$page_name = implode("/",$page_name_array);
		
	if(!function_exists('wpsc_rewrite_categories')) {	 // to stop this function from being declared multiple times
		  /*
		   * This is the function for making the e-commerce rewrite rules, it is recursive
		  */
		function wpsc_rewrite_categories($page_name, $id = null, $level = 0, $parent_categories = array(), $is_index = false) {
			
			global $wpdb, $category_data;
			
			if($is_index == true) {
				$rewrite_page_name = '';
			} else {
				$rewrite_page_name = $page_name.'/';
			}

			if(is_numeric($id)) {
				$category_sql = "SELECT * FROM `".WPSC_TABLE_PRODUCT_CATEGORIES."` WHERE `active`='1' AND `category_parent` = '".$id."' ORDER BY `id`";
				$category_list = $wpdb->get_results($category_sql,ARRAY_A);
			}	else {
				$category_sql = "SELECT * FROM `".WPSC_TABLE_PRODUCT_CATEGORIES."` WHERE `active`='1' AND `category_parent` = '0' ORDER BY `id`";
				$category_list = $wpdb->get_results($category_sql,ARRAY_A);
			}
			
			if($category_list != null)	{
				foreach($category_list as $category) {
					if($level === 0) {
						$parent_categories = array();
					}
					$parent_categories[] = $category['nice-name'];
					
					$new_rules[($rewrite_page_name.implode($parent_categories,"/").'/?$')] = 'index.php?pagename='.$page_name.'&category_id='.$category['id'];
					
					//$new_rules[($rewrite_page_name.implode($parent_categories,"/").'/(.+?)/?$')] = 'index.php?pagename='.$page_name.'&category_id='.$category['id'].'&product_url_name=$matches[1]';
					
					//$new_rules[($rewrite_page_name.implode($parent_categories,"/").'/([0-9]+)/?$')] = 'index.php?pagename='.$page_name.'&category_id='.$category['id'].'&product_url_name=$matches[1]';
					
					// make each product personal rewrite rule
					$products_list=$wpdb->get_results("select `product_id` from `wp_wpsc_product_order` where `category_id`=".$category['id'],ARRAY_A);
					foreach($products_list as $product){
						$new_rules[($rewrite_page_name.implode($parent_categories,"/").'/'.$product['product_id'].'/?$')] = 'index.php?pagename='.$page_name.'&category_id='.$category['id'].'&product_url_name='.$product['product_id'];
					}
					
					$new_rules[($rewrite_page_name.implode($parent_categories,"/").'/page/([0-9]+)/?$')] = 'index.php?pagename='.$page_name.'&category_id='.$category['id'].'&wpsc_page=$matches[1]';
					
					// recurses here
					$sub_rules = wpsc_rewrite_categories($page_name, $category['id'], ($level+1), $parent_categories, $is_index);
					array_pop($parent_categories);
					$new_rules = array_merge((array)$new_rules, (array)$sub_rules);
				}
			}
			return $new_rules;
		}
	}
	
	$new_rules = wpsc_rewrite_categories($page_name, null, 0, null, $is_index);
	$new_rules = array_reverse((array)$new_rules);
	
	// а понял, если в корне есть товары, то они постраничные и еще постраничный поиск во всем каталоге
	// и все страницы с гет параметрами тоже, типа /katalog/page/2/?cluster_id=1234
	$new_rules[($first_post_name.'/page/([0-9]+)/?$')] = 'index.php?pagename='.$page_name.'&wpsc_page=$matches[1]';
	//$new_rules[$page_name.'/tag/([A-Za-z0-9\-]+)?$'] = 'index.php?pagename='.$page_name.'&ptag=$matches[1]';
	
	// урл аппаратов
	//$new_rules['kartridzhi/HP-LaserJet-1010/?$'] = 'index.php?pagename='.$page_name.'&device_id=2542&type=goods';
	//$new_rules['zapravka-kartridzhey/HP-LaserJet-1010/?$'] = 'index.php?pagename='.$page_name.'&device_id=2542&type=service';
	
	$results = $wpdb->get_results("select id, url from compat_devices where active = 1 and url <> ''", ARRAY_A);
	foreach($results as $result){
		$new_rules[cs_get_device_rewrite_url('goods', $result['url']) . '?$'] = 'index.php?pagename=' . $page_name . '&device_id=' . $result['id'] . '&type=goods';
		$new_rules[cs_get_device_rewrite_url('goods', $result['url']) . 'page/([0-9]+)/?$'] = 'index.php?pagename=' . $page_name . '&device_id=' . $result['id'] . '&type=goods&wpsc_page=$matches[1]';
		$new_rules[cs_get_device_rewrite_url('service', $result['url']) . '?$'] = 'index.php?pagename=' . $page_name . '&device_id=' . $result['id'] . '&type=service';
		$new_rules[cs_get_device_rewrite_url('service', $result['url']) . 'page/([0-9]+)/?$'] = 'index.php?pagename=' . $page_name . '&device_id=' . $result['id'] . '&type=service&wpsc_page=$matches[1]';
	}
	
	$new_rewrite_rules = array_merge((array)$new_rules,(array)$rewrite_rules);
	
	return $new_rewrite_rules;
}


function wpsc_query_vars($vars) {
	//   $vars[] = "product_category";
	//   $vars[] = "product_name";
  $vars[] = "category_id";
  $vars[] = "product_url_name";
  $vars[] = "wpsc_page";
  $vars[] = "device_id";
  $vars[] = "cluster_id";
  $vars[] = "type";
  return $vars;
  }

add_filter('query_vars', 'wpsc_query_vars');

// using page_rewrite_rules makes it so that odd permalink structures like /%category%/%postname%.htm do not override the plugin permalinks.
add_filter('page_rewrite_rules', 'wpsc_product_permalinks');




/**
* wpsc_obtain_the_title function, for replaacing the page title with the category or product
* @return string - the new page title
*/
function wpsc_obtain_the_title() {

	global $wpsc_query, $wpdb, $wp_query, $wpsc_title_data, $is_compat_search, $is_cluster_search, $is_category_page, $is_single_page, $is_search_page, $is_home_page;
	
	$output = "";
		
	if($is_single_page) {
		$output = wpsc_the_product_title();
	} elseif($is_category_page) {
		if($is_search_page){
			$output = wpsc_category_name($wpsc_query->category);
			$output .= ": результаты поиска &laquo;".stripslashes($_GET['product_search'])."&raquo;";
		} else {
			$output = wpsc_category_name($wpsc_query->category);
		}		
	} elseif($is_search_page) {
		$output = "Результаты поиска &laquo;".stripslashes($_GET['product_search'])."&raquo;";
	} elseif($is_home_page) {
		$output = ""; // заголовок из админки
	} elseif($is_compat_search) {
		switch($wpsc_query->query_vars['type']){
			case 'goods':
				$output = 'Картриджи ';
				break;
			case 'service':
				$output = 'Заправка картриджей ';
				break;
			default:
				$output = '';
		}
		$output .= $wpsc_query->device_name;
	} elseif($is_cluster_search) {
		$output = $wpsc_query->cluster_name;
	}
	
	//return htmlentities(stripslashes($output), ENT_QUOTES, 'UTF-8');
	return $output;
	
}

// see wpsc_set_aioseop_description in misc.functions.php 
/*function wpsc_obtain_the_description() {
	return '';
}*/

function wpsc_replace_the_title($input) {
  global $wpdb, $wp_query;
	$output = wpsc_obtain_the_title();
	if($output != null) {
		$backtrace = debug_backtrace();
		if($backtrace[3]['function'] == 'get_the_title') {
			return $output;
		}
	}
	return $input;
}

function wpsc_replace_wp_title($input) {
  global $wpdb, $wp_query;
	$output = wpsc_obtain_the_title();
	if($output != null) {
		return $output;
	}
	return $input;
}

function wpsc_replace_bloginfo_title($input, $show) {
  global $wpdb, $wp_query;
  if($show == 'description') {
		$output = wpsc_obtain_the_title();
		if($output != null) {
			return $output;
		}
	}
	return $input;
}

if(get_option('wpsc_replace_page_title') == 1) {
  add_filter('the_title', 'wpsc_replace_the_title', 10, 2);
  add_filter('wp_title', 'wpsc_replace_wp_title', 10, 2);
	//add_filter('bloginfo', 'wpsc_replace_bloginfo_title', 10, 2);
}

?>