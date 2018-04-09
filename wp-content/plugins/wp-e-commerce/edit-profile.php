<?php

global $wpsc_checkout, $user_ID, $wpsc_cart;

$any_bad_inputs = false;
$changes_saved = false;

$_SESSION['collected_data'] = null;

//print_r($_POST['collected_data']);

if($_POST['collected_data'] != null) {

	$meta_data = array();

	foreach((array)$_POST['collected_data'] as $value_id => $value) {
		$meta_data[$value_id] = $value;
	}
	
	//echo "<pre>".print_r($_POST, true)."</pre>";
	//echo "<pre>".print_r($meta_data, true)."</pre>";
	
	//$new_meta_data = serialize($meta_data);

	update_user_meta($user_ID, 'wpshpcrt_usr_profile', $meta_data);
  
	// при изменении региона сразу же меням текущий в корзине
	// через my_submitwpcheckout_profile в функциях

	$changes_saved = true;
  
} 

?>

<?php wp_enqueue_script('checkout_form', get_template_directory_uri() . '/js/checkout_form.js'); ?>

<?php

$meta_data = null;
$meta_data = get_usermeta($user_ID, 'wpshpcrt_usr_profile');

$form_sql = "SELECT * FROM `".WPSC_TABLE_CHECKOUT_FORMS."` WHERE `active` = '1'";
$form_data = $wpdb->get_results($form_sql, OBJECT_K);

$wpsc_checkout = new wpsc_checkout();

//$payment_options = $wpsc_checkout->get_checkout_options(32);

isset($meta_data[25])?:$meta_data[25]="person";
$is_person = my_format_form_data($meta_data[25]) == "person" ? true : false;

//if(!isset($meta_data[32])) $meta_data[32]="online";	

//$is_delivery = my_format_form_data($meta_data[23]) == "yes" ? false : true;

?>
	
<form method='post' action='' style="margin-top:20px;">
	
	<?php if($changes_saved == true) {
		echo "<div class='cart_section_right_row' style='background:#a5e283;padding: 5px 10px;'>Изменения сохранены.</div>";
	} ?>
	
	<div class="cart_section clearfix">
		<div class="cart_section_right_row">
			<div class="cart_section_right_title"><?php echo $form_data[2]->name; // Имя ?></div>
			<div><?php echo "<input type='text' value='".my_get_lastfirstname()."' name='collected_data[2]'>"; ?></div>
		</div>
		<div class="cart_section_right_row">
			<div class="cart_section_right_title"><?php echo $form_data[17]->name; // Телефон ?></div>
			<div><?php echo "<input type='text' value='".my_format_form_data($meta_data[17])."' name='collected_data[17]'>"; ?></div>
		</div>
		<div class="cart_section_right_row">
			<div class="cart_section_right_title"><?php echo $form_data[8]->name; // Электронная почта ?></div>
			<div><?php echo "<input type='text' value='".my_get_mail()."' name='collected_data[8]'>"; ?></div>
		</div>
	</div>
			
	<div class="cart_section clearfix">
		<div class='cart_section_right_row'>
			<div class="cart_section_right_title">Город / район</div>
			<div>
				<select name="collected_data[42]">
					<?php
						$dest_arr = my_get_destinations();	
						foreach($dest_arr as $dest){
							echo '<option' . (my_format_form_data($meta_data[42]) == $dest['id']?' selected':'') . ' value="' . $dest['id'] . '">' . $dest['name'] . '</option>';
						}
					?>				
				</select>
			</div>
		</div>
	</div>

	<div class="cart_section clearfix">
		<div class='cart_section_right_row'>
			<div class="cart_section_right_title"><?php echo $form_data[4]->name; // Адрес доставки ?></div>
			<div><?php echo "<input type='text' value='".my_format_form_data($meta_data[4])."' name='collected_data[4]'>"; ?></div>
		</div>
	</div>
			
	<div class="cart_section clearfix">
		<div class="cart_section_right_row">
			<div class="cart_section_right_title"><?php echo $form_data[25]->name; // Плательщик ?></div>
			<ul class="cf_who_will_pay">
				<?php
					// Плательщик
					$options = $wpsc_checkout->get_checkout_options(25);
					foreach((array)$options as $label => $value){
						echo "<li><input type='radio' value='$value' name='collected_data[25]'".(my_format_form_data($meta_data[25]) == "$value"?" checked":"").">$label</li>";
					}
				?>
			</ul>
		</div>
		<div class='cf_org_wr_js' style='<?php echo ($is_person ? "display:none;" : "") ?>'>
			<div class="cart_section_right_row">
				<div class="cart_section_right_title"><?php echo $form_data[27]->name; // Организация ?></div>
				<div>
					<?php echo "<input class='cf_org_name_js cf_org_js' type='text' value='".my_format_form_data($meta_data[27])."' name='collected_data[27]'>"; ?>
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
				<div><?php echo "<input class='cf_org_bank_js cf_org_js' type='text' value='".my_format_form_data($meta_data[38])."' name='collected_data[38]'>"; ?></div>
			</div>
			<div class="cart_section_right_row">
				<div class="cart_section_right_title"><?php echo $form_data[39]->name; // БИК ?></div>
				<div><?php echo "<input class='cf_org_bik_js cf_org_js' type='text' value='".my_format_form_data($meta_data[39])."' name='collected_data[39]'>"; ?></div>
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
	
	<div class="cart_section clearfix">
		<div class="cart_section_right_row">
			<div class="cart_section_right_title"><?php echo $form_data[21]->name; // Комментарий ?></div>
			<?php echo "<textarea name='collected_data[21]'>".my_format_form_data($meta_data[21])."</textarea>"; ?>
		</div>
	</div>

    <?php //if(isset($gateway_checkout_form_fields)) { echo $gateway_checkout_form_fields; } ?>
	
    <input type='hidden' value='true' name='submitwpcheckout_profile' />
    <input type='submit' value='Сохранить данные' name='submit' />
	  
</form>



