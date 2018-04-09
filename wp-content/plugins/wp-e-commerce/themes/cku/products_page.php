<?php
global $wpsc_query, $wpdb, $is_category_page, $is_home_page, $is_compat_search, $is_cluster_search;

// custom e-commerce SEO
require_once ARRAS_DIR . '/seo.php';

/*
 * Most functions called in this page can be found in the wpsc_query.php file
 */
 
 //echo "<pre>";debug_print_backtrace();echo "</pre>";
 //echo "<pre>";print_r($wpsc_query);echo "</pre>";
 
?>

<?php if($is_home_page) { ?> <!-- homepage -->

	<?php my_cs_form_home(); ?>
	<?php my_featured_cats_home(); ?>
	
	<div class="wpsc_home_featured_cats_title">Все категории</div>
	<div class="wpsc_home clearfix">
		<ul>
			<?php //wpsc_start_category_query(array('parent_category_id' => $wpsc_query->category, 'category_group'=>get_option('wpsc_default_category'), 'show_thumbnails'=> get_option('show_category_thumbnails')));
			wpsc_start_category_query();
			?>
      <li>
        <li>111</li>
				<a href="<?php wpsc_print_category_url(); ?>"><?php wpsc_print_category_name(); ?></a>
				<?php wpsc_print_category_products_count('<span class="category_count">','</span>') ?>
				<?php wpsc_print_subcategory("<ul>","</ul>"); ?>
			</li>
			<?php wpsc_end_category_query(); ?>
		</ul>
	</div>
	
<?php } else { ?> <!-- end of homepage --> <!-- !homepage -->
	
<div id='products_page_container' class="wrap wpsc_container">

	<?php if($is_category_page) { ?>
		<h1><?php echo wpsc_category_name($wpsc_query->category); ?><span class="category_count"><?php echo wpsc_gmcpc($wpsc_query->category); ?></span></h1>
	<?php } ?>
	
	<?php if($is_compat_search) { ?>
	
		<h1>
			<?php 
				switch($wpsc_query->query_vars['type']){
					case 'goods':
						$prefix = 'Картриджи для ';
						break;
					case 'service':
						$prefix = 'Заправка картриджей для ';
						break;
					default:
						$prefix = '';
				}
				echo $prefix . $wpsc_query->device_name; 
			?>
			<span class="category_count"><?php echo $wpsc_query->total_product_count; ?></span>
		</h1>
		<?php if(wpsc_product_count() < 1) {
				if($wpsc_query->query_vars['type'] == 'service'){
					echo '<p>Для вашего аппарата услуг по заправке картриджей не найдено.</p><p>Но, возможно, мы сможем заправить ваш картридж &mdash; обратитесь к нашим менеджерам за дополнительной информацией.</p><p>Вот <a style="text-decoration:underline;" href="'.cs_get_device_url($wpsc_query->query_vars['device_id'], 'goods').'">новые картриджи для '.$wpsc_query->device_name.'</a>. Или вы можете воспользоваться поиском по модели (номеру) картриджа вверху страницы.</p>';
				} elseif($wpsc_query->query_vars['type'] == 'goods'){
					echo '<p>Для вашего аппарата новых картриджей не найдено.</p><p>Вот <a style="text-decoration:underline;" href="'.cs_get_device_url($wpsc_query->query_vars['device_id'], 'service').'">заправка картриджей для '.$wpsc_query->device_name.'</a>. Или вы можете воспользоваться поиском по модели (номеру) картриджа вверху страницы.</p>';
				} else {
					echo '<p>Для вашего аппарата ничего не найдено.</p><p>Попробуйте воспользоваться поиском (вверху) или обратитесь к нашим менеджерам за дополнительной информацией.</p>';
				}
			}			
		} ?>

	<?php if($is_cluster_search) { ?>
		<h1><?php echo cs_get_cluster_name($wpsc_query->query_vars['cluster_id']); ?><span class="category_count"><?php echo $wpsc_query->total_product_count; ?></span></h1>
		<?php if(wpsc_product_count() < 1) { echo '<p>Ничего не найдено. Попробуйте воспользоваться поиском (вверху) или обратитесь к нашим менеджерам за дополнительной информацией.</p>'; } ?>
	<?php } ?>

    <?php if($is_category_page) { ?>
		<?php if(wpsc_list_subcategories($wpsc_query->category)) { ?>
			<div class='wpsc_categories_table'>
				<div class='wpsc_categories_row'>
					<?php wpsc_start_category_query(array('parent_category_id' => $wpsc_query->category, 'delimiter'=>array('count'=>'3','text'=>'</div><div class="wpsc_categories_row">'), 'no_subcategories'=>'yes')); ?>
					<a class="wpsc_categories_cell" href="[wpsc_category_url]">
						[wpsc_category_name]<span class="category_count">[wpsc_category_products_count]</span>
					</a>
					<?php wpsc_end_category_query(); ?>
				</div>
			</div>
		<?php } ?>
		
		<?php
			if(wpsc_product_count() > 0) { ?>

				<div class="nav_view_form_wrapper">
					<?php wpsc_page_navigation();  ?>
					<?php gold_shpcrt_view_form(); ?>
				</div>
				
				<?php my_wpsc_product_list(); ?>
				
				<div class="nav_view_form_wrapper">
					<?php wpsc_page_navigation(); ?>
				</div>			
			
			<?php
			} else {
				$wpsc_query = new WPSC_Query('top_products_in_category=' . $wpsc_query->category);
				if(wpsc_product_count() > 0){
					echo '<h2>Хиты продаж</h2>';
					my_wpsc_product_list('bestsellers');
				}
			}
		?>
		
	<?php } ?>

	<?php if($is_compat_search || $is_cluster_search) { ?>
		
		<?php if(wpsc_product_count() > 0) { ?>
		
			<?php
				if($is_compat_search){
					switch($wpsc_query->query_vars['type']){
						case 'goods':
							$prefix = 'картриджи';
							break;
						case 'service':
							$prefix = 'услуги по заправке картриджей';
							break;
						default:
							$prefix = 'товары и услуги';
					}
					echo '<div style="margin-top: 5px;">Следующие ' . $prefix . ' гарантировано подойдут для вашего принтера ' . $wpsc_query->device_name . '.</div>';
				}
			?>
		
			<div class="nav_view_form_wrapper">
				<?php wpsc_page_navigation();  ?>
				<?php gold_shpcrt_view_form(); ?>
			</div>
			
			<?php my_wpsc_product_list(); ?>
			
			<div class="nav_view_form_wrapper">
				<?php wpsc_page_navigation(); ?>
			</div>
		<?php } ?>
		
	<?php if(isset($seo_text)) echo '<div class="wpsc_custom_description">'.$seo_text.'</div>'; ?>
	
	<?php } ?>
	
	<?php echo fancy_notifications(); ?>
	
	<?php /*arras_get_pluso();*/ ?>	
	<?php /*wpsc_page_featured_products();*/ ?>
	
	<?php if($is_category_page){ echo retail_rocket_categorypage($wpsc_query->category); } ?>
	
</div> <!-- products_page_container -->

<?php } ?> <!-- end of !homepage -->

<div class="clearfix"></div>
<?php echo my_get_featured_products_home(); ?>	
<?php //echo my_get_delivery_info(); ?>
<?php arras_get_pluso(); ?>
