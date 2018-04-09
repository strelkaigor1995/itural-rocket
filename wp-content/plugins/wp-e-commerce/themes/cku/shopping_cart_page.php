<?php
global $wpsc_cart, $wpdb, $user_ID, $wpsc_checkout, $wpsc_shipping_modules;

$wpsc_checkout = new wpsc_checkout();

//global $wpsc_checkout, $wpsc_gateway, $wpsc_coupons,;
//$wpsc_gateway = new wpsc_gateways();
//$wpsc_coupons = new wpsc_coupons($_SESSION['coupon_numbers']);

$is_prepayment = 0;

//$wpsc_cart->my_reset_shipping();
//$wpsc_cart->get_shipping_method();

//$wpsc_cart->selected_shipping_method = null;
//$wpsc_cart->selected_shipping_option = null;

//echo wpsc_uses_shipping();
//echo $_SESSION['wpsc_cart'];

//$options = $wpsc_checkout->get_checkout_options(25);
//print_r($options);
//$values = array_values($options);
//$keys = array_keys($options);
//echo $values[0];
//echo "<pre>".print_r($wpsc_checkout, true)."</pre>";
//echo "<pre>".debug_print_backtrace()."</pre>";
//echo "<pre>".print_r($wpsc_shipping_modules[$wpsc_cart->selected_shipping_method], true)."</pre>";
//echo "<pre>".print_r($wpsc_shipping_modules['my_shipping']->getQuote($wpsc_cart->calculate_subtotal(), $wpsc_cart->my_shipping_destination['id']), true)."</pre>";
//echo "<pre>".print_r($wpsc_shipping_modules, true)."</pre>";


//wpsc_update_shipping_multiple_methods();
//$wpsc_cart->update_shipping($wpsc_cart->selected_shipping_method, 'pickup');
//echo "!".wpsc_cart_subtotal()."!".wpsc_cart_shipping()."!".wpsc_cart_total();
//$wpsc_cart->update_shipping($wpsc_cart->selected_shipping_method, 'delivery');
//echo "!".wpsc_cart_subtotal()."!".wpsc_cart_shipping()."!".wpsc_cart_total();
//echo "<pre>".print_r($wpsc_cart, true)."</pre>";
//echo "<pre>".print_r($wpsc_cart->my_shipping_destination, true)."</pre>";
//echo "<pre>".print_r(my_get_destinations(), true)."</pre>";
//echo $user_ID;
 
?>
<div id='products_page_container' class="wrap shopping_cart">

		<?php if(wpsc_cart_item_count() > 0) { ?>

		<?php

			$meta_data = get_user_meta($user_ID, 'wpshpcrt_usr_profile', true);
			if(empty($meta_data)){
				$meta_data = array();
			}
			
			//echo "<pre>".print_r($meta_data, true)."</pre>";
			
			/*if(!(isset($_REQUEST['my_update_destination']) && $_REQUEST['my_update_destination'] == 'true')){
				if(isset($meta_data[42])){ // my_destination_id
					$wpsc_cart->update_location($meta_data[42]);
				}				
			}*/
			
			if($wpsc_cart->shipping_quotes['delivery'] == null){
				$wpsc_cart->update_shipping($wpsc_cart->selected_shipping_method, 'pickup');
				$no_shipping = true;
			} else {
				$no_shipping = false;
			}
			
			$is_delivery = ($wpsc_cart->selected_shipping_option == "delivery")?true:false;
			
			$form_sql = "SELECT * FROM `".WPSC_TABLE_CHECKOUT_FORMS."` WHERE `active` = '1'";
			$form_data = $wpdb->get_results($form_sql, OBJECT_K);
			
			$wpsc_checkout = new wpsc_checkout();

			isset($meta_data[25])?:$meta_data[25]="person"; // Плательщик
			$is_person = my_format_form_data($meta_data[25]) == "person" ? true : false; // Плательщик
			
			$payment_options = $wpsc_checkout->get_checkout_options(32); // Способ оплаты

			if(!isset($meta_data[32])) $meta_data[32]="sberbank"; // Способ оплаты
			
			if($is_prepayment && $meta_data[32]="cash_on_delivery") $meta_data[32]="sberbank"; // Способ оплаты
			
			$wpsc_cart_shipping = $wpsc_cart->process_as_currency($wpsc_cart->shipping_quotes['delivery']);
			$wpsc_cart_total = wpsc_cart_total(true);
			$wpsc_cart_subtotal = wpsc_cart_subtotal(true);
			
			//$wpsc_shipping_method_name = $wpsc_shipping_modules[$wpsc_cart->selected_shipping_method]->public_name;
			$wpsc_shipping_method_name = $wpsc_cart->my_shipping_destination['public_name'];
			//$min_cart_for_free_delivery = $wpsc_cart->process_as_currency($wpsc_shipping_modules[$wpsc_cart->selected_shipping_method]->min_cart_for_free_delivery);
			$min_cart_for_free_delivery = $wpsc_cart->my_shipping_destination['min_cart_for_free_delivery'];
			//$min_cart_for_delivery = $wpsc_cart->process_as_currency($wpsc_shipping_modules[$wpsc_cart->selected_shipping_method]->min_cart_for_delivery);
			$min_cart_for_delivery = $wpsc_cart->my_shipping_destination['min_cart_for_delivery'];
			
			$own_delivery = ($wpsc_cart->my_shipping_destination['internal_service'] == 1) ? 1 : 0;
			//$own_delivery = ($wpsc_cart->my_shipping_destination['fias_id'] == "") ? 0 : 1;
			
			//echo "<pre>".print_r($wpsc_shipping_modules['my_shipping'], true)."</pre>";
			
		?>
		
		<h1>Корзина</h1>
		
		<div class="cart_section clearfix">
			<div class="cart_section_left">
				<div class="cart_section_left_title">Проверка заказа</div>
				Проверьте, пожалуйста, еще раз ваш заказ. При необходимости измените его.
			</div>
			<div class="cart_section_right">
				<table class="list_productdisplay">
					<tr class="firstrow">
						<td class="id title"><span class="product_id">Изобр.</span></td>
						<td class="name title"><span>Наименование</span></td>
						<td class="delivery title"><span class="deli_title_js" style='<?php echo ($is_delivery ? "" : "display:none;"); ?>'>Доставка</span><span class="self_title_js" style='<?php echo ($is_delivery ? "display:none;" : ""); ?>'>Самовывоз</span></td>
						<td class="quantity title">Кол-во</td>
						<td class="price title"><span>Сумма, руб.</span></td>
						<td class="remove title">&nbsp;</td>
					</tr>
					<?php while (wpsc_have_cart_items()) { 
						
						wpsc_the_cart_item();
						$product_id = wpsc_cart_item_product_id();
						
						$deliverydays = get_product_meta($product_id,'deliverydays',true);
						$predoplata = (int)get_product_meta($product_id,'predoplata',true);
						
						$is_prepayment += $predoplata;
						
						?>
					
						<tr>
							<td class="id">
							<?php 
								$image_path = my_the_product_thumbnail($wpsc_cart->cart_item->thumbnail_image);
								if($image_path != null) { ?>
									<img class="product_image" id="product_image_<?php echo $product_id; ?>" alt="<?php echo wpsc_cart_item_name(); ?>" title="<?php echo wpsc_cart_item_name(); ?>" src="<?php echo $image_path; ?>"/>
							<?php } ?>
							</td>
							
							<td class="name">
								<a class="wpsc_product_title" href="<?php echo wpsc_cart_item_url(); ?>"><?php echo wpsc_cart_item_name(); ?></a>
								<?php if((int)$deliverydays != 0 && $predoplata == 1){ echo '<span style="color:#f57c00;">[требуется предоплата]</span>'; } ?>
							</td>
							
							<?php
								$ddate_deli_str = delivery_date_str_checkout($product_id, true);
								$ddate_self_str = delivery_date_str_checkout($product_id, false);
							?>
							
							<td class="delivery"><span class="ddate_total_deli_js" style='<?php echo ($is_delivery ? "" : "display:none;"); ?>'><?php echo $ddate_deli_str; ?></span><span class="ddate_total_self_js" style='<?php echo ($is_delivery ? "display:none;" : ""); ?>'><?php echo $ddate_self_str; ?></span></td>
							<td class="quantity">
								<form action="<?php echo get_option('shopping_cart_url'); ?>" method="post" class="adjustform">
									<input id="wpsc_quantity_update" size="2" type="text" name="quantity" value="<?php echo wpsc_cart_item_quantity(); ?>" />
									<input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>" />
									<input type="hidden" name="wpsc_update_quantity" value="true" />
									<input type="submit" value="" name="submit" />
								</form>
							</td>
							<td class="price"><span class="pricedisplay"><?php echo wpsc_cart_item_price(); ?></span>
							
							<td class="remove">
								<form action="<?php echo get_option('shopping_cart_url'); ?>" method="post" class="adjustform">
									<input type="hidden" name="quantity" value="0" />
									<input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>" />
									<input type="hidden" name="wpsc_update_quantity" value="true" />
									<input class="wpsc_buy_button_del" type="submit" value="" />
								</form>
							</td>
						</tr>
					<?php } ?>
				</table> <!-- list_productdisplay -->
				<div class="cart_subtotal">Итого в корзине: <span style="font-weight:bold;"><?php echo $wpsc_cart_subtotal; ?></span> руб.</div>
			</div>
		</div>

		<?php wp_enqueue_script('checkout_form', get_template_directory_uri() . '/js/checkout_form.js'); ?>
		
		<div class="cart_section clearfix">
			<div class="cart_section_left">
				<div class="cart_section_left_title">Доставка</div>
				<?php echo !empty($min_cart_for_free_delivery)?"Бесплатная доставка при заказе от&nbsp;".nzshpcrt_currency_display($min_cart_for_free_delivery, 0, true, false, false, 0)."&nbsp;руб.":""; ?>
			</div>
			<div class="cart_section_right">
				<div class='cart_section_right_row'>
					<div class="cart_section_right_title">Город / район</div>
					<div style="position:relative;">
						<form action="<?php echo get_option('shopping_cart_url'); ?>" method="post">
							<select onchange="jQuery('.destination_wait_gif_js').show();this.form.submit()" name="my_destination">
								<?php
									$dest_arr = my_get_destinations();	
									foreach($dest_arr as $dest){
										echo '<option' . ($wpsc_cart->my_shipping_destination['id'] == $dest['id']?' selected':'') . ' value="' . $dest['id'] . '">' . $dest['name'] . '</option>';
									}
								?>
							</select>
							<input type="hidden" name="my_update_destination" value="true" />
						</form>
						<img src="/wp-content/themes/cku/js/iload/wait.gif" class="destination_wait_gif_js destination_wait_gif">
					</div>
				</div>
				<div class="cart_section_right_row">
					<ul class="dest_delivery_ul clearfix">
						<li class="dest_pickup_js <?php echo ($is_delivery)?"":"dest_delivery_active"; ?>">
							<span>Бесплатный самовывоз</span>
							<img src="/wp-content/themes/cku/js/iload/wait.gif" class="dest_pickup_wait_gif_js dest_wait_gif">
						</li>
						<?php 
							if($no_shipping){
								echo "<div>Доставка при заказе от " . nzshpcrt_currency_display($min_cart_for_delivery, 0, true, false, false, 0) . " руб.</div>";
							} else { ?>
								<li class="dest_delivery_js <?php echo ($is_delivery)?"dest_delivery_active":""; ?>">
									<span>
										<?php echo my_get_shipping_string($wpsc_cart_shipping, $wpsc_shipping_method_name); ?>
									<span>
									<img src="/wp-content/themes/cku/js/iload/wait.gif" class="dest_delivery_wait_gif_js dest_wait_gif">
								</li>
							<?php }
						?>
					</ul>					
				</div>
				<div class='cart_section_right_row'>					
					<div class="cs_shipping_total">Итого<span class="cs_shipping_total_js"><?php echo ($is_delivery)?" с доставкой":""; ?></span>: <span class="cart_total_js" style="font-weight:bold;"><?php echo $wpsc_cart_total; ?></span> руб.</div>
				</div>
			</div>
		</div>
		
		<form name='wpsc_checkout_forms' class='wpsc_checkout_forms' action='' method='post' enctype="multipart/form-data">		
		
			<div class="cart_section clearfix">
				<div class="cart_section_left">
					<div class="cart_section_left_title"><span class="cf_address_title_js"><?php echo ($is_delivery)?"Адрес для доставки":"Пункт выдачи"; ?></span></div>
				</div>
				<div class="cart_section_right">	
					<div class='cart_section_right_row cf_delivery_js' style='<?php echo ($is_delivery ? "" : "display:none;"); ?>'>						
						<div>
							<?php echo "<input style='width:100%;' class='cf_address_js' type='text' value='".my_format_form_data($meta_data[4])."' name='collected_data[4]' data-fias-type='" . $wpsc_cart->my_shipping_destination['fias_type'] . "' data-fias-id='" . $wpsc_cart->my_shipping_destination['fias_id'] . "' data-own-delivery='" . $own_delivery . "'>"; ?>
						</div>
						<div class="cs_self_workhours">c понедельника по пятницу с 9:00 до 18:00</div>
					</div>
					<div class='cart_section_right_row cf_selfservice_js' style='<?php echo ($is_delivery ? "display:none;" : ""); ?>'>
						<div class="cs_self_address cf_selfaddress_js"><?php echo my_get_store_address(); ?></div>
						<div class="cs_self_workhours">c понедельника по пятницу с 9:00 до 19:00; субботу и воскресенье с 11:00 до 18:00</div>
						<div class="cs_selfaddress_map_js" style="margin-top:20px;display:none;">
							<script charset="utf-8" src="https://widgets.2gis.com/js/DGWidgetLoader.js"></script><script charset="utf-8">new DGWidgetLoader({"width":720,"height":720,"borderColor":"#a3a3a3","pos":{"lat":56.833421092667415,"lon":60.60002803802491,"zoom":15},"opt":{"city":"ekaterinburg"},"org":[{"id":"1267165676520373"}]});</script>
						</div>
					</div>
				</div>
			</div>			
			
			<div class="cart_section clearfix">
				<div class="cart_section_left">
					<div class="cart_section_left_title">Покупатель</div>
					Представьтесь и укажите удобный для вас способ связи.
				</div>
				<div class="cart_section_right">
					<div class="cart_section_right_row">
						<div class="cart_section_right_title"><?php echo $form_data[2]->name; // Имя ?></div>
						<div><?php echo "<input class='cf_fio_js' type='text' value='".my_get_lastfirstname()."' name='collected_data[2]'>"; ?></div>
					</div>
					<div class="cart_section_right_row">
						<div class="cart_section_right_title"><?php echo $form_data[17]->name; // Телефон ?></div>
						<div><?php echo "<input type='text' value='".my_format_form_data($meta_data[17])."' name='collected_data[17]'>"; ?><span class="cs_notify"> &mdash; на этот номер мы позвоним для уточнения деталей заказа, если потребуется.</span></div>
					</div>
					<div class="cart_section_right_row">
						<div class="cart_section_right_title"><?php echo $form_data[8]->name; // Электронная почта ?></div>
						<div><?php echo "<input class='cf_email_js' type='text' value='".my_get_mail()."' name='collected_data[8]'>"; ?><span class="cs_notify"> &mdash; сюда придет подтверждение заказа, и, может быть, информация для оплаты.</span></div>
					</div>
				</div>
			</div>
										
			<div class="cart_section clearfix">
				<div class="cart_section_left">
					<div class="cart_section_left_title"><?php echo $form_data[25]->name; // Плательщик ?></div>
				</div>
				<div class="cart_section_right">
					<ul class="cf_who_will_pay">
						<?php
							// Плательщик
							$options = $wpsc_checkout->get_checkout_options(25);
							foreach((array)$options as $label => $value){
								echo "<li><input type='radio' value='$value' name='collected_data[25]'".(my_format_form_data($meta_data[25]) == "$value"?" checked":"").">$label</li>";
							}
						?>
					</ul>
					<div class='cf_org_wr_js' style='<?php echo ($is_person ? "display:none;" : "") ?>'>
						<div class="cart_section_right_row">
							<div class="cart_section_right_title"><?php echo $form_data[27]->name; // Организация ?></div>
							<div>
								<?php echo "<input class='cf_org_name_js cf_org_js' type='text' value='".my_format_form_data($meta_data[27])."' name='collected_data[27]'>"; ?>
								<span class="cs_notify_org"> &mdash; начните вводить название организации.</span>
							</div>
						</div>
						<div class="cart_section_right_row">
							<div class="cart_section_right_title"><?php echo $form_data[28]->name; // Юридический адрес ?></div>
							<div><?php echo "<input class='cf_org_js' type='text' value='".my_format_form_data($meta_data[28])."' name='collected_data[28]'>"; ?></div>
						</div>
						<div class="cart_section_right_row">
							<div class="cart_section_right_title"><?php echo $form_data[29]->name; // ИНН ?></div>
							<div>
								<?php echo "<input class='cf_org_inn_js cf_org_js' type='text' value='".my_format_form_data($meta_data[29])."' name='collected_data[29]'>"; ?>
								<span class="cs_notify_org"> &mdash; начните вводить ИНН организации.</span>
							</div>
						</div>
						<div class="cart_section_right_row">
							<div class="cart_section_right_title"><?php echo $form_data[30]->name; // КПП ?></div>
							<div><?php echo "<input class='cf_org_js' type='text' value='".my_format_form_data($meta_data[30])."' name='collected_data[30]'>"; ?></div>
						</div>
						<div class="cart_section_right_row">
							<div class="cart_section_right_title"><?php echo $form_data[31]->name; // ОГРН ?></div>
							<div><?php echo "<input class='cf_org_js' type='text' value='".my_format_form_data($meta_data[31])."' name='collected_data[31]'>"; ?></div>
						</div>
						<div class="cart_section_right_row">
							<div class="cart_section_right_title"><?php echo $form_data[38]->name; // Наименование банка ?></div>
							<div>
								<?php echo "<input class='cf_org_bank_js cf_org_js' type='text' value='".my_format_form_data($meta_data[38])."' name='collected_data[38]'>"; ?>
								<span class="cs_notify_org"> &mdash; начните вводить наименование банка.</span>
							</div>
						</div>
						<div class="cart_section_right_row">
							<div class="cart_section_right_title"><?php echo $form_data[39]->name; // БИК ?></div>
							<div>
								<?php echo "<input class='cf_org_bik_js cf_org_js' type='text' value='".my_format_form_data($meta_data[39])."' name='collected_data[39]'>"; ?>
								<span class="cs_notify_org"> &mdash; начните вводить БИК.</span>
							</div>
						</div>
						<div class="cart_section_right_row">
							<div class="cart_section_right_title"><?php echo $form_data[40]->name; // Расчетный счет ?></div>
							<div><?php echo "<input class='cf_org_js' type='text' value='".my_format_form_data($meta_data[40])."' name='collected_data[40]'>"; ?></div>
						</div>
						<div class="cart_section_right_row">
							<div style="font-size: 16px;"><?php echo "<input class='cf_org_js' type='checkbox' value='yes' name='collected_data[37]'".(my_format_form_data($meta_data[37]) == "yes"?" checked":"").">"; ?><?php echo $form_data[37]->name; // Работаем с НДС ?></div>
						</div>
					</div>
				</div>
			</div>
			<div class="cart_section clearfix">
				<div class="cart_section_left">
					<div class="cart_section_left_title"><?php echo $form_data[32]->name; // Способ оплаты ?></div>
					Выберите удобный для вас способ оплаты.
				</div>
				<div class="cart_section_right">
					<?php if($is_prepayment > 0){ echo '<div style="color: #f57c00;margin-bottom: 15px;margin-left: 6px;font-size: 16px;width: 90%;">В корзине есть товары, требующие внесения предоплаты для оформления заказа.</div>'; } ?>
					<ul class="cf_what_pay">
						<?php 
						
							$first_option = 1;
							
							// Вид оплаты
							foreach((array)$payment_options as $label => $value){
								
								$no_display = "display:none;";
								$commentary = "";
								
								switch($value){
									case "cash_on_delivery":
										if($is_delivery && $is_person && !$is_prepayment && $own_delivery) $no_display="";
										$commentary = "Курьер обязательно привезет ваш кассовый и товарный чеки.";
										break;
									case "online":
										if($is_person) $no_display="";
										$commentary = "Мы отправим вам ссылку для оплаты по электронной почте.";
										break;
									case "invoice":
										$no_display="";
										$commentary = "Мы подготовим и вышлем вам счет по электронной почте.";
										break;
									case "cash_in_store":
										if(!$is_delivery && $is_person) $no_display="";
										if($is_prepayment) $commentary = "Требуется посещение пункта выдачи для внесения предоплаты.";
										break;
									case "card_in_store":
										if(!$is_delivery && $is_person) $no_display="";
										if($is_prepayment) $commentary = "Требуется посещение пункта выдачи для внесения предоплаты.";
										break;
									case "sberbank":
										if($is_person) $no_display="";
										$commentary = "Мы отправим вам номер карты для оплаты по электронной почте.";
										break;
								}
								
								$is_first_and_visible = (($no_display == "") ? 1 : 0) || ($first_option == 1);
								$first_option++;
								
								//echo "<li style='$no_display'><input type='radio' value='$value' name='collected_data[32]'".(my_format_form_data($meta_data[32]) == "$value"?" checked":"").">$label<div class='cf_what_pay_comment'>$commentary</div></li>";
								echo "<li style='$no_display'><input type='radio' value='$value' name='collected_data[32]'".(($is_first_and_visible)?" checked":"").">$label<div class='cf_what_pay_comment'>$commentary</div></li>";
							}
						?>
					</ul>
				</div>
			</div>
			
			<div class="cart_section clearfix">
				<div class="cart_section_left">
					<div class="cart_section_left_title"><?php echo $form_data[21]->name; // Комментарий ?></div>
				</div>
				<div class="cart_section_right">		
					<div class="cart_section_right_row"><?php echo "<textarea name='collected_data[21]'>".my_format_form_data($meta_data[21])."</textarea>"; ?></div>
				</div>
			</div>
			
			<div class="clearfix">
				<div class="cart_section_left"></div>
				<div class="cart_section_right">		
					<div class="cf_err_1_js cf_err_js cart_error" style="display:none;">Укажите телефон или электронную почту, чтобы мы могли связаться с вами в случае необходимости.</div>
					<div class="cf_err_2_js cf_err_js cart_error" style="display:none;">Укажите адрес для доставки заказа.</div>
					<div class="cf_err_3_js cf_err_js cart_error" style="display:none;">Укажите электронную почту, чтобы получить ссылку для оплаты заказа.</div>
					<div class="cf_err_4_js cf_err_js cart_error" style="display:none;">Укажите электронную почту, чтобы получить счет для оплаты заказа.</div>
					<div class="cf_err_5_js cf_err_js cart_error" style="display:none;">Укажите электронную почту, чтобы получить номер карты для оплаты заказа.</div>
					<div class="cf_err_6_js cf_err_js cart_error" style="display:none;">Укажите город для доставки заказа.</div>
				</div>
			</div>

			<div class="cart_section clearfix">
				<div class="cart_section_left"></div>
				<div class="cart_section_right">		
					
					<input type='hidden' value='<?php echo ($is_prepayment) ? "yes" : ""; ?>' name='is_prepayment'>

					<input name="custom_gateway" value="testmode" type="hidden">	
					<input type='hidden' value='submit_checkout' name='wpsc_action'>
					
					<input type='hidden' value='<?php echo $wpsc_cart->my_shipping_destination['id']; ?>' name='collected_data[42]'>
					
					<input type='submit' value='Купить' name='submit' class='make_purchase make_purchase_js'>
					
					
				</div>
			</div>
			

		</form> <!-- wpsc_checkout_forms -->

		<div class="shopping_cart_notification entry-content">
			<div><h2 style="width:200px;display:inline-block;">Обратите внимание</h2><div style="display:inline-block;">(подробные <a href="/oplata-i-dostavka/" title="Перейти на страницу с информацией об оплате и доставке">условия оплаты и доставки</a>)</div></div>
			<p>1. Обработка заказов производится в рабочие дни с 9:00 до 19:00, в субботу и воскресенье с 11:00 до 18:00.</p>
			<p>2. Доставка выполняется в рабочие дни с понедельника по пятницу с 9:00 до 18:00. Кроме того, вы можете забрать свой заказ самостоятельно из <a href="/kontaktnaya-informaciya/" title="Перейти на страницу с контактной информацией">нашего магазина</a> с понедельника по пятницу с 9:00 до 19:00, в субботу и воскресенье с 11:00 до 18:00.</p>
			<p>3. Мы можем отправить ваш заказ транспортной компанией в другой город или регион России. Предоплата 100%. Стоимость доставки до транспортной компании <?php echo my_get_wpsc_tk_delivery_cost(); ?> руб. При оформлении укажите в комментарии, что хотите получить ваш заказ через такую-то транспортную компанию.</p>
			<p>4. В случае оплаты безналичным способом, ваш заказ будет доставлен (или вы сможете забрать его самостоятельно) после поступления оплаты. Отсрочка платежа только для клиентов работающих с нами по договору.</p>
			<p>5. Вы можете зарегистрироваться на нашем сайте, тогда данные, введенные вами при оформлении заказа, будут сохранены и при следующей покупке форма заказа будет заполнена автоматически.</p>
			<p>Любые вопросы можете задать нам по телефону <?php echo do_shortcode("[store_phone]"); ?> и электронной почте <a href="mailto:mail@itural.ru">mail@itural.ru</a> или <a href="/vash-vopros-zayavka/" title="Задать вопрос, используя форму на сайте">воспользуйтесь формой обратной связи</a> на нашем сайте.</p>
		</div>
	
	<?php } else { // wpsc_cart_item_count() > 0 ?> 

		<?php /*echo "<p style='margin-top: 20px;'>" . "Ваша корзина пуста. Чтобы выбрать товары, " . " <a href=".get_option("product_list_url").">" . "перейдите в каталог" . "</a>.</p>";
		wpsc_page_featured_products();*/ ?>
		
		<div class="found_nothing_title_cart">Ваша корзина пуста</div>
		<div class="found_nothing_cart">Чтобы оформить заказ, добавьте товары в корзину. Обратитесь к нашим менеджерам за помощью в случае каких-либо затруднений.</div>
		
		<?php my_cs_form_home(); ?>
		<?php my_featured_cats_home(); ?>
		
		<div class="shopping_cart_all_cats"><a href="<?php echo get_option('product_list_url'); ?>">Все категории</a><span class="category_count">&nbsp;<?php echo wpsc_gmcpc(66600030)+wpsc_gmcpc(66600010)+wpsc_gmcpc(66600020); ?></span></div>
		
		<?php echo my_get_featured_products_home(); ?>
		<?php echo my_get_delivery_info(); ?>
		
		<?php arras_get_pluso(); ?>
		
	<?php } ?>


	
</div> <!-- products_page_container -->

<?php //echo "<pre>".print_r($wpsc_cart, true)."</pre>"; ?>
