<?php
global $wpsc_query, $wpdb;

// custom e-commerce SEO
require_once ARRAS_DIR . '/seo.php';

/*
 * Most functions called in this page can be found in the wpsc_query.php file
 */
 
 //echo "<pre>";debug_print_backtrace();echo "</pre>";
 //echo "<pre>";print_r($wpsc_query);echo "</pre>";
 
?>

<div class="wpsc_sidebar">
<?php
	my_wpsc_sidebar_cats();
	echo '<div style="min-height:20px;"></div>';
	my_wpsc_sidebar_cs();
	echo '<div style="min-height:20px;"></div>';
	my_wpsc_sidebar_featured_cats();				
?>
</div>
	
<div id='products_page_container' class="wrap wpsc_container">
	
	<h1><?php echo wpsc_category_name($wpsc_query->category); ?><span class="category_count"><?php echo wpsc_gmcpc($wpsc_query->category); ?></span></h1>
	<?php if(wpsc_list_subcategories($wpsc_query->category)) { ?>
		<div class='wpsc_categories_table'>
			<div class='wpsc_categories_row'>
				<?php wpsc_start_category_query(array('parent_category_id' => $wpsc_query->category, 'delimiter'=>array('count'=>'3','text'=>'</div><div class="wpsc_categories_row">'), 'no_subcategories'=>'yes')); ?>
				<div class="wpsc_categories_cell">
					<a class="wpsc_categories_a" href="[wpsc_category_url]">[wpsc_category_name]</a>
					<div class="wpsc_categories_pr_count">[wpsc_category_products_count_long]</div>
				</div>
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
		}  else {
			$wpsc_query = new WPSC_Query('top_products_in_category=' . $wpsc_query->category);
			if(wpsc_product_count() > 0){
				echo '<h2>Хиты продаж</h2>';
				my_wpsc_product_list('bestsellers');
			}
		}
	?>
	
	<?php echo fancy_notifications(); ?>
	
	<?php /*arras_get_pluso();*/ ?>	
	<?php /*wpsc_page_featured_products();*/ ?>
	
	<?php echo retail_rocket_categorypage($wpsc_query->category); ?>
	
</div> <!-- products_page_container -->

<div class="clearfix"></div>
<?php echo my_get_featured_products_home(); ?>	
<?php //echo my_get_delivery_info(); ?>
<?php arras_get_pluso(); ?>
