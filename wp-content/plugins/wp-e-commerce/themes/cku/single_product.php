<?php
global $wpsc_query, $wpdb, $my_ru_months, $current_user, $table_prefix, $wpsc_cart, $wpsc_shipping_modules;

$image_width = get_option('single_view_image_width');
$image_height = get_option('single_view_image_height');

wpsc_the_product();
$product_id = wpsc_the_product_id();

$shipping_cost = $wpsc_shipping_modules[$wpsc_cart->selected_shipping_method]->getPriceQuote(calculate_product_price($product_id), $wpsc_cart->my_shipping_destination['id']);
$wpsc_shipping_method_name = $wpsc_cart->my_shipping_destination['public_name'];
$min_cart_for_delivery = $wpsc_cart->my_shipping_destination['min_cart_for_delivery'];
$shipping_cost_min_cart = $wpsc_shipping_modules[$wpsc_cart->selected_shipping_method]->getPriceQuote($min_cart_for_delivery, $wpsc_cart->my_shipping_destination['id']);

?>

<div id='products_page_container' class="wrap wpsc_container">
	
	<?php /*wpsc_page_breadcrumbs(true);*/ ?>
	
	<div class="single_product_display product_view_<?php echo $product_id; ?> clearfix">
		
		<h1><?php echo wpsc_the_product_title(); ?><?php echo wpsc_edit_the_product_link('Ред.'); ?></h1>
		
		<div class="under_the_title clearfix">
			<div class="articl">Артикул: <?php echo $product_id; ?></div>
			<div class="uptolike_single"><div class="uptolike_single_title">Поделиться:</div><?php my_get_uptolike_single(); ?></div>
		</div>
	
		<div class="product_form_single clearfix">

			<?php $today = new DateTime();
				$ddiff = $today->diff(new DateTime(wpsc_product_creation_time()));
				if((int)$ddiff->format('%a') <= MY_NEW_PRODUCT_DAYS){ ?>
					<div class="wpsc_new_product" title="Новый товар, недавно поступил в продажу"></div>
			<?php }	?>	

			<form class='product_form' enctype="multipart/form-data" action="<?php echo wpsc_this_page_url(); ?>" method="post" name="1" id="product_<?php echo $product_id; ?>">
		
				<div class="product_form_single_div">
					
					<div id="product_price_<?php echo $product_id; ?>" class="pricedisplay"><?php echo wpsc_the_product_price(); ?><span style="font-size:14px;"> руб.</span></div>
					
					<?php if(wpsc_the_product_publish()) { // forma zakaza tol'ko dlya opublikovannyx ?>
						<div>
							<input type="text" id='wpsc_quantity_update_single' name="wpsc_quantity_update[<?php echo $product_id; ?>]" size="2" value="1"/>
							<input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>"/>
							<input type="hidden" name="wpsc_update_quantity" value="true"/>
							<input type="submit" value="В корзину" name="Buy" class="wpsc_buy_button_single2" id="product_<?php echo $product_id; ?>_submit_button" onmousedown="<?php echo retail_rocket_addtobasket($product_id); ?>" />
						</div>
					<?php } ?>
					
				</div>

				<div class="product_form_single_div product_form_single_div_stock">
				
				<?php if(wpsc_the_product_publish()) { ?>

					<?php							
						$usluga = get_product_meta($product_id,'usluga',true);
						$deliverydays = get_product_meta($product_id,'deliverydays',true);
						$predoplata = get_product_meta($product_id,'predoplata',true); ?>
						
						<div style="font-size:18px;">
							<?php echo my_get_stock_str_single($usluga, $deliverydays); ?>
						</div>
						
						<?php if((int)$usluga == 1) { // additional description usluga
							echo '<div class="product_form_single_div_add">Работы выполняются только в нашем сервисном центре.</div>';
							if($wpsc_cart->my_shipping_destination['internal_service'] == 1){
								echo '<div>Вы можете <a class="fb_vyzov_link" style="cursor: pointer;text-decoration: none;border-bottom: 1px dotted;" title="Вызвать курьера, чтобы забрать ваши картриджи на заправку или технику в ремонт">вызвать курьера</a>, чтобы забрать ваши картриджи на заправку или технику в ремонт.</div>';
							}
						} else { // additional description tovar
							if((int)$deliverydays != 0 && $predoplata == 1){ echo '<div class="product_form_single_div_add">Для оформления заказа <span style="font-weight:bold;">необходима предоплата</span>.</div>'; }
							if((int)$deliverydays >= 0) {
								$samo_date = my_samovyvoz_date_v2($deliverydays);
								$del_date = my_delivery_date_v2($deliverydays);
								$predlog = '';
								//echo '<div>Самовывоз из магазина '.my_get_date_str($samo_date).' '.my_get_wh_str($samo_date).'.</div>';
								echo '<div class="product_form_single_div_add">Самовывоз из магазина '.my_get_date_str($samo_date).'.</div>';
								//echo '<div>Доставим'.my_get_date_str($del_date).'.</div>';
								//echo '<div>' . $wpsc_cart->my_shipping_destination['public_name'] . my_get_date_str($del_date) . '.</div>';
								
								
								if($shipping_cost === null) {
									echo "<div>$wpsc_shipping_method_name " . my_get_date_str($del_date) . " за " . nzshpcrt_currency_display($shipping_cost_min_cart, 0, true, false, false, 0) . " руб. (при заказе от " . nzshpcrt_currency_display($min_cart_for_delivery, 0, true, false, false, 0) . " руб.)</div>";
								} else {
									echo '<div>' . ($shipping_cost == 0?"Бесплатная " . mb_strtolower($wpsc_shipping_method_name) . my_get_date_str($del_date):"$wpsc_shipping_method_name " . my_get_date_str($del_date) . " за " . nzshpcrt_currency_display($shipping_cost, 0, true, false, false, 0) . " руб") . ".</div>";
								}
								
								
							} elseif((int)$deliverydays == -1) {
								echo '<div class="product_form_single_div_add">Наличие уточнять у менеджеров.</div>';
							} elseif((int)$deliverydays == -2) {
								echo '<div class="product_form_single_div_add">Срок поставки уточнять у менеджеров.</div>';
							}
						}
					?>
					
					<input type="hidden" value="add_to_cart" name="wpsc_ajax_action"/>
					<input type="hidden" value="<?php echo $product_id; ?>" name="product_id"/>
					
				<?php } else { // tovar not publish
					$l_date = new DateTime(get_product_meta($product_id,'date_modified',true)); ?>
					<div style="font-size:18px;">Нет в продаже</div>
					<div>Последний раз этот товар был в продаже <?php echo $l_date->format('j'); ?>&nbsp;<?php echo $my_ru_months[$l_date->format('n')]; ?>&nbsp;<?php echo $l_date->format('Y'); ?>&nbsp;г.</div>
				<?php } ?>
				
				<?php if(get_product_meta($product_id,'bu',true)==1){ ?><div class="product_form_single_div_add">Товар был в употреблении, прошел тестирование.</div><div>Гарантия 1 месяц.</div><?php } ?>
				
				<?php if(get_product_meta($product_id,'verified',true)==1){ ?> <div class="product_form_single_div_add"><a href="/testirovanie-zapravki/" title="Программа тестирования заправленных картриджей &laquo;Тест ОК!&raquo;">Картридж тестируется</a> до и после заправки.</div><?php } ?>
				
				</div>
				
				<?php $meta_orders = round((float)get_product_meta($product_id, 'orders',true)); 
					if($meta_orders > 0){ ?>
					<div class="wpsc_orders_single"><?php echo $meta_orders . " " . numberof($meta_orders, 'заказ', array('', 'а', 'ов')); ?></div>
				<?php }	?>	
				
			</form>
			
		</div> <!-- product_form_single -->
			
		<?php // compatibily list here
			$c_devices_sql = "SELECT d.id device_id, m.maker, f.family, d.name, CAST(d.name AS UNSIGNED) c, IF(LEFT(d.name, 1) > 0, 0, 1) isfl, LEFT(d.name, 1) fl, LENGTH(d.name) l FROM compat_products_devices pd LEFT JOIN compat_devices d ON pd.device_id=d.id LEFT JOIN compat_families f ON d.family_id=f.id LEFT JOIN compat_makers m ON m.id=f.maker_id WHERE pd.product_id=$product_id AND pd.active=1 AND d.active=1 ORDER BY m.maker ASC, f.family ASC, isfl ASC, c ASC, fl ASC, l ASC, d.name ASC";
			$c_devices = $wpdb->get_results($c_devices_sql);
			if($c_devices){
				if((int)$usluga == 1){
					$a_title = 'Заправка картриджей';
					$a_type = 'service';
				} else {
					$a_title = 'Картриджи';
					$a_type = 'goods';				
				}
				echo "<div class='compat_devices_single'><h2>Гарантировано подойдет к этим принтерам и МФУ</h2>";
				echo "<div class='compat_devices_single_list'>";
				foreach($c_devices as $c_device){
					$device_name = cs_get_device_name($c_device->device_id);
					echo '<a class="compat_devices_single_a" title="' . $a_title . ' для ' . $device_name . '" href="' . cs_get_device_url($c_device->device_id, $a_type) . '">' . $device_name . '</a>';
				}
				echo "</div>"; // compat_devices_single_list
				
				// cluster list here
				get_currentuserinfo();
				if($current_user->{$table_prefix . 'capabilities'}['administrator'] == 1 || $current_user->{$table_prefix . 'capabilities'}['editor'] == 1) {
					$c_devices_sql = "SELECT pc.cluster_id FROM compat_products_clusters pc LEFT JOIN compat_clusters c ON pc.cluster_id=c.id WHERE pc.product_id=$product_id AND pc.active=1 AND c.active=1";
					$c_devices = $wpdb->get_results($c_devices_sql);
					if($c_devices){
						echo "<div class='compat_cluster_single'>Кластеры:";
						foreach($c_devices as $c_device){
							echo '<a class="compat_cluster_single_a" href="' . cs_get_cluster_url($c_device->cluster_id) . '">' . cs_get_cluster_name($c_device->cluster_id) . '</a>';
						}
						echo "</div>";
					}
				}

				echo "</div>"; // compat_devices_single
				
			}
		?>
	
		<?php //if(get_option('show_thumbnails')) { ?>
			<?php if(wpsc_the_product_thumbnail())  { ?>
				<a rel="iLoad|<?php echo wpsc_the_product_title(); ?>" class="thumbnail" href="<?php echo wpsc_the_product_image(); ?>">
					<img title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo wpsc_the_product_image($image_width, $image_height); ?>" />
				</a>
			<?php } ?> 
		<?php //} ?>
		
		<?php //do_action('wpsc_product_before_description', $product_id, $wpsc_query->product); ?>

		<?php
		$wpsc_description=wpsc_the_product_description();
		if($wpsc_description!=null) { ?>
			<div class="wpsc_description clearfix"><?php echo do_shortcode($wpsc_description); ?></div>
		<?php } ?>
		
		<?php
		  //echo get_product_meta($product_id, 'test',true);
		 ?>

		<?php //do_action('wpsc_product_addons', $product_id); ?>
	
		<?php //do_action('wpsc_product_addon_after_descr', $product_id); ?>

		<?php echo gold_shpcrt_display_gallery($product_id); ?>

	</div>
			
	<!-- schema.org -->
	<?php
		
		$availability_text = "http://schema.org/OutOfStock";
		if(wpsc_the_product_publish()) {
			if($deliverydays == 0){ $availability_text = "http://schema.org/InStock"; }
			elseif ($deliverydays > 0) { $availability_text = "http://schema.org/PreOrder"; }
			elseif ($deliverydays == -2) { $availability_text = "http://schema.org/PreOrder"; }
		}
		
		$schema_category_arr = array();
		while (wpsc_have_breadcrumbs()) { 
			wpsc_the_breadcrumb();
			$schema_category_arr[] = wpsc_breadcrumb_name(); // . "&gt;" . $schema_category;
		}
		array_pop($schema_category_arr);
		
		$schema_color_arr = get_product_meta($product_id, 'color');
		if(!is_array($schema_color_arr)){
			$schema_color_arr = array();
		}
		
		$schema_description = wpsc_set_aioseop_description('');
		if(empty($schema_description)){
			$schema_description = wpsc_the_product_title();
		}
		
	?>
	<div itemscope itemtype="http://schema.org/Product">
	  <meta itemprop="name" content="<?php echo mb_substr(wpsc_the_product_title(), 0, 150, 'UTF-8'); ?>" />
	  <meta itemprop="description" content="<?php echo $schema_description; ?>" />
	  <meta itemprop="brand" content="<?php echo get_product_meta($product_id, 'vendor', true); ?>" />
	  <meta itemprop="model" content="<?php echo implode(" ", cs_get_product_model($product_id)); ?>" />
	  <meta itemprop="mpn" content="<?php echo implode(" ", cs_get_product_maker_model($product_id)); ?>" />
	  <meta itemprop="image" content="<?php echo wpsc_the_product_image(); ?>" />
	  
	  <?php
		foreach($schema_color_arr as $schema_color){
			echo '<meta itemprop="color" content="' . $schema_color . '" />';
		}		
	  ?>
	  
	  <meta itemprop="category" content="<?php echo implode('&gt;', $schema_category_arr); ?>" />
	  <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
		<meta itemprop="price" content="<?php echo $wpsc_query->product['price']; ?>" />
		<meta itemprop="priceCurrency" content="RUB" />
		<meta itemprop="availability" content="<?php echo $availability_text; ?>" />
		<meta itemprop="itemCondition" content="<?php echo (get_product_meta($product_id, 'bu', true)=="1")?"http://schema.org/UsedCondition":"http://schema.org/NewCondition"; ?>" />
	  </div>
	</div>		
	<!-- schema.org -->
	
	<!-- Analog Products -->
	<?php $wpsc_query = new WPSC_Query('analog_products='.$product_id); ?>
	<?php if(wpsc_product_count()>0){ ?>
		<div class="wpsc_analog_products clearfix">
			<h3>Похожие товары</h3>
			<?php my_wpsc_product_list('analog'); ?>
		</div>
	<?php } ?>
	<!-- Analog Products -->
	
	<!-- Related Products -->
	<?php //$wpsc_query = new WPSC_Query('related_products='.$product_id); ?>
	<?php $wpsc_query = new WPSC_Query('recommended_products='.$product_id); ?>
	<?php if(wpsc_product_count()>0){ ?>
		<div class="wpsc_related_products clearfix">
			<h3>С этим товаром покупают</h3>
			<?php my_wpsc_product_list('related'); ?>
		</div>
	<?php } ?>
	<!-- Related Products -->
	
	<?php echo fancy_notifications(); ?>
	
	<?php /* box style related products */ /*wpsc_the_related_products();*/ ?>

	<?php /*wpsc_page_featured_products();*/ ?>
	
	<?php echo retail_rocket_singlepage($product_id); ?>
	
</div>

<div class="clearfix"></div>
<?php echo my_get_featured_products_home(); ?>	
<?php //echo my_get_delivery_info(); ?>
<?php arras_get_pluso(); ?>