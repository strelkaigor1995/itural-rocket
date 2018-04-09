<?php
/*
Template Name: Каталог
*/
?>

<?php function my_wpsc_sidebar_cats() { ?>
	<?php global $wpsc_query; ?>
	<div class="wpsc_sidebar_title">Категории</div>							
	<ul>
		<?php 
			wpsc_start_category_sidebar_query();
		?>
		<li>
			<a href="[wpsc_category_url]" class="[wpsc_current_category]">[wpsc_category_name]</a><span class="category_count">[wpsc_category_products_count]</span>
			<ul>[wpsc_subcategory]</ul>
		</li>
		<?php
			//wpsc_end_category_sidebar_query($wpsc_query->category);
			wpsc_end_category_sidebar_short_query($wpsc_query->category);
		?>
	</ul>	
<?php } ?>

<?php function my_wpsc_sidebar_cs() { ?>
	<?php global $is_single_page, $wpsc_query; ?>
	<div class="cs_wpsc_sidebar<?php if(!$is_single_page){ echo " cs_wpsc_sidebar_bg"; } ?>">
		<div class="cs_title_wpsc_sidebar">Выберите ваш принтер:</div>
		<form action="<?php echo get_option('product_list_url'); ?>" method="get" class="cs_form_wpsc_sidebar">
			<select class="cs_makers_js" maker_id="<?php echo cs_get_maker_id($wpsc_query->query_vars['device_id']); ?>"></select>
			<select class="cs_families_js" family_id="<?php echo cs_get_family_id($wpsc_query->query_vars['device_id']); ?>"></select>	
			<select name="device_id" class="cs_devices_js" device_id="<?php echo $wpsc_query->query_vars['device_id']; ?>"></select>
			<button sub_count="" type="submit" name="type" value="goods" class="cs_button_js"><?php echo CS_FORM_GOODS_BUTTON_TITLE; ?></button>
			<button sub_count="" type="submit" name="type" value="service" class="cs_button_js"><?php echo CS_FORM_SERVICE_BUTTON_TITLE; ?></button>
		</form>
		<div class="cs_notice">Не нашли принтер? <span class="fb_ask_a_quest_link cs_notice_link">Напишите нам</span>.</div>
	</div>
<?php } ?>

<?php function my_wpsc_sidebar_featured_cats() { ?>
	<div class="wpsc_sidebar_title">Популярные категории</div>
	<div class="wpsc_sidebar_featured_cats">
		<?php wpsc_start_featured_category_query(); ?>
		<a href="[wpsc_category_url]">
			<span class="wpsc_sfc_parent_name">[wpsc_parent_name]</span><span class="wpsc_sfc_name">[wpsc_category_name]</span><span class="category_count">[wpsc_category_products_count]</span>
		</a>
		<?php wpsc_end_featured_category_query(array('limit'=>'6', 'parent_name_length'=>'30')); ?>
	</div>
<?php } ?>

<?php 
global $wpsc_cart, $wpsc_query, $is_search_page, $is_category_page, $is_home_page, $is_single_page, $is_compat_search, $is_cluster_search, $wpsc_title_data, $wpsc_currency_data;

//global $wp_rewrite;
//exit(print_r($wp_rewrite->rules)); 

$is_search_page=false; $is_category_page=false; $is_home_page=false; $is_single_page=false;
$is_cart_page=false; $is_trans_page=false; $is_profile_page=false; $is_compat_search=false; $is_cluster_search=false;

$page_url = get_permalink($wp_query->post->ID);

if($wpsc_query->is_search){$is_search_page=true;}
if($wpsc_query->is_single){$is_single_page=true;}
if($wpsc_query->is_category) {$is_category_page=true;}
if(get_option('shopping_cart_url')==$page_url){$is_cart_page=true;}
if(get_option('transact_url')==$page_url){$is_trans_page=true;}
if(get_option('user_account_url')==$page_url){$is_profile_page=true;}
//if(isset($_POST['form']) && $_POST['form']=='compat_search'){$is_compat_search=true;}
//if($_GET['device_id']!=''){$is_compat_search=true;}
//if($_GET['cluster_id']!=''){$is_cluster_search=true;}
if($wpsc_query->is_device){$is_compat_search=true;}
if($wpsc_query->is_cluster){$is_cluster_search=true;}
if($wpsc_query->is_home){$is_home_page=true;}
//$is_home_page=!($is_search_page||$is_single_page||$is_category_page||$is_cart_page||$is_trans_page||$is_profile_page||$is_compat_search||$is_cluster_search);
$is_cart_empty = (wpsc_cart_item_count() == 0)?true:false;

get_header();

//echo "is_search_page:$is_search_page is_category_page:$is_category_page is_home_page:$is_home_page is_single_page:$is_single_page is_cart_page:$is_cart_page is_trans_page:$is_trans_page is_profile_page:$is_profile_page is_compat_search:$is_compat_search is_cluster_search:$is_cluster_search is_search_in_category:{$wpsc_query->is_search_in_category}";
//echo "is_search_page:{$wpsc_query->is_search} is_category_page:{$wpsc_query->is_category} is_home_page:{$wpsc_query->is_home} is_single_page:{$wpsc_query->is_single} is_cart_page:$is_cart_page is_trans_page:$is_trans_page is_profile_page:$is_profile_page is_compat_search:{$wpsc_query->is_device} is_cluster_search:{$wpsc_query->is_cluster}";
//echo "<pre>";debug_print_backtrace();echo "</pre>";
//echo "<pre>";print_r($_GET);echo "</pre>";
//echo "<pre>";print_r($_POST);echo "</pre>";
//echo "<pre>";print_r($_SESSION);echo "</pre>";

global $wp_query;
//echo "<pre>";print_r($wp_query->query_vars);echo "</pre>";
//echo "<pre>";print_r($wpsc_query->query_vars);echo "</pre>";
//echo "<pre>";print_r($wpsc_title_data);echo "</pre>";
//echo "<pre>";print_r($wpsc_cart->my_shipping_destination);echo "</pre>";
//echo "<pre>";print_r($wpsc_cart->my_location);echo "</pre>";
//echo "<pre>";print_r($wpsc_cart);echo "</pre>";
//echo get_option('shopping_cart_url');
//echo "<pre>";print_r($wpsc_currency_data);echo "</pre>";
//echo "<pre>";print_r(my_get_destinations());echo "</pre>";
//global $wpsc_shipping_modules;
//echo "<pre>";print_r($wpsc_shipping_modules);echo "</pre>";

?>

<?php wpsc_page_breadcrumbs($is_single_page); ?>

<?php 

$separator = '<div style="min-height:20px;"></div>';

if($is_compat_search || $is_cluster_search){
	echo '<div class="wpsc_sidebar">';
	my_wpsc_sidebar_cs();
	echo $separator;
	my_wpsc_sidebar_featured_cats();
	//echo $separator;
	//my_wpsc_sidebar_cats();
	echo '</div>';
} 

if($is_single_page){
	echo '<div class="wpsc_sidebar">';
	my_wpsc_sidebar_cats();
	echo $separator;
	my_wpsc_sidebar_cs();
	echo $separator;
	my_wpsc_sidebar_featured_cats();				
	echo '</div>';
} 

?>

<?php
	if (have_posts()) {
		while (have_posts()){
			the_post();
			//arras_postheader();
			the_content();
		}
	}
?>

<?php get_footer(); ?>