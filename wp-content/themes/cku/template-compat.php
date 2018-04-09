<?php
/*
Template Name: Подбор по аппарату
*/
?>

<?php get_header(); ?>

<div id='products_page_container' class="wrap wpsc_container">
	
	<h1 class="entry-title"><?php the_title(); ?></h1>
	
	<div class="entry-content">
	  
	  <form action="<?php echo get_permalink(); ?>" method="post" id="compat-form">
	  <!-- <form action="/katalog/" method="post" id="compat-form"> -->
		
		<select name="maker" id="compat-makers-select"></select>
		<select name="family" id="compat-families-select"></select>
		<select name="device" id="compat-devices-select"></select>
		
		<input type="checkbox" name="service-only" value="1">Только заправка

		<input type="submit" id="compat-button-search" value="Найти">
		<input type="hidden" name="mode" value="exe">
		
		<br>
		<input type="text" name="search_query" id="compat_search" value="">
		<ul id="compat_search_result"></ul>
	  
	  </form>
	  
	</div><!-- entry-content -->
 
<?php

global $wpsc_query, $wpdb;

if (isset($_POST['mode'])) {
	$wpsc_query = new WPSC_Query('compat_device='.$_POST['device'].'&compat_service_only='.$_POST['service-only']);
	//exit('<pre>'.print_r($_GET, true).print_r($_POST, true).print_r($_SESSION, true).print_r($wpsc_query, true).'</pre>');
?>

	
		

		<?php if(wpsc_product_count()>0) { ?>
		
		<?php //wpsc_page_navigation(); ?>
		
		<?php //gold_shpcrt_view_form(); ?>
		<?php 
			if(isset($_POST['device'])) {
				$device_id = preg_replace('/[^0-9]/', '', $_POST['device']);
				$res = $wpdb->get_results("SELECT m.maker, f.family, d.name FROM compat_devices d LEFT JOIN compat_families f ON (d.family_id=f.id) LEFT JOIN compat_makers m ON (m.id=f.maker_id) WHERE d.id={$device_id}", ARRAY_A);
		?>
		<p>Товары и услуги для аппарата <?php echo($res[0]['maker'].' '.$res[0]['family'].' '.$res[0]['name']); ?>:</p>
		<?php } ?>
		
		<table class="list_productdisplay <?php echo wpsc_category_class(); ?>">
			<?php /** start the product loop here */?>
			<?php $alt = 0; ?>
			    <tr>
				    <td class="id title"><span class="product_id">&nbsp;</span></td>
					<td class="name title"><span class='wpsc_category_boundary'>Наименование</span></td>
				    <td class="unity title"><span title='Наличие'>Наличие</span></td>
				    <td class="price title"><span>Цена, руб.</span></td>
				    <td class="form title">&nbsp;</td>
			    </tr>
			<?php while (wpsc_have_products()) {  wpsc_the_product(); ?>
				<?php
				//$alt++;
				//if ($alt %2 != 1) { $alt_class = ' alt'; } else { $alt_class = ''; }
				
				$deliverydays = get_product_meta(wpsc_the_product_id(),'deliverydays',true);
				$usluga = get_product_meta(wpsc_the_product_id(),'usluga',true);
				if ($deliverydays == 0 && (int)$usluga == 0) { $alt_class = ' alt'; } else { $alt_class = ''; } ?>
				
				<tr class="product_view_<?php echo wpsc_the_product_id(); ?>">
					
					<td class="id">
					    <?php if(wpsc_the_product_thumbnail()) { ?>
						    <img class="product_image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="<?php echo wpsc_the_product_title(); ?>" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo wpsc_the_product_thumbnail(); ?>"/>
					    <?php } ?>
					</td>
					
					<td class="name">
						
						<?php if(get_product_meta(wpsc_the_product_id(),'bu')==1) { ?>
							<a class="wpsc_product_title" href="<?php echo wpsc_the_product_permalink(); ?>"><?php echo mb_strstr(wpsc_the_product_title(),' (б/у)',true); ?></a>
							<span class="tovar_bu" title="Товар был в употреблении. Прошел тестирование. Гарантия 1 мес.">б/у</span>
						<?php } else { ?>
							<a class="wpsc_product_title" href="<?php echo wpsc_the_product_permalink(); ?>"><?php echo wpsc_the_product_title(); ?></a>
						<?php } ?>
						
						<?php if(get_product_meta(wpsc_the_product_id(),'verified')==1) { ?> <a class="test_ok" href="/testirovanie-zapravki/" title="Программа тестирования заправленных картриджей &laquo;Тест ОК!&raquo;">&nbsp;Тест&nbsp;ОК!&nbsp;</a><?php } ?>

						<?php echo wpsc_edit_the_product_link('Ред.'); ?>
						
					</td>
					
					<td class="unity <?php echo $alt_class; ?>">
						<?php echo '<span style="cursor:help;" title="'.my_get_stock_title($usluga,$deliverydays).'">'.my_get_stock_str($usluga,$deliverydays).'</span>'; ?>
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
						
						<form class='product_form'  enctype="multipart/form-data" action="<?php echo $action; ?>" method="post" name="product_<?php echo wpsc_the_product_id(); ?>" id="product_<?php echo wpsc_the_product_id(); ?>" >
							<input type="hidden" value="add_to_cart" name="wpsc_ajax_action"/>
							<input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="product_id"/>
							<div class='wpsc_buy_button_container'>
								<input type="submit" value="" name="Buy" class="wpsc_buy_button2" id="product_<?php echo wpsc_the_product_id(); ?>_submit_button" title="Добавить в корзину" />
							</div>
						</form>
					
					</td>
				
				</tr>

			<?php } ?>
			<?php /** end the product loop here */?>
		</table>
		
		<?php //wpsc_page_navigation(); ?>
		<?php if(function_exists('fancy_notifications')){ echo fancy_notifications(); } ?>
		
		<?php } else { ?>

			<?php if(wpsc_product_count() < 1 && $is_search_page===true) { ?>
				<p>Ничего не найдено.</p>
			<?php } ?>
			
		<?php } ?>
		
		
		
		
<?php } //isset($_POST['mode']) ?>		

</div> <!-- products_page_container -->

<?php get_footer(); ?>
