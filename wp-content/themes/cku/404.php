
<?php get_header(); ?>

<div class="search_page">

	<div class="found_nothing_title">Ошибка 404 &mdash; страница не найдена</div>
	<div class="found_nothing">Вы перешли по неправильной ссылке или страница была удалена. Вы можете воспользоваться поиском по сайту<br/>или обратиться к нашим менеджерам за помощью.</div>
	
	<?php my_cs_form_home(); ?>
	<?php my_featured_cats_home(); ?>
	
	<div class="search_page_all_cats"><a href="<?php echo get_option('product_list_url'); ?>">Все категории</a><span class="category_count">&nbsp;<?php echo wpsc_gmcpc(66600030)+wpsc_gmcpc(66600010)+wpsc_gmcpc(66600020); ?></span></div>
		
	<?php echo my_get_featured_products_home(); ?>
	
	<?php //echo my_get_delivery_info(); ?>
	
	<?php arras_get_pluso(); ?>

</div> <!-- search_page -->

<?php get_footer(); ?>