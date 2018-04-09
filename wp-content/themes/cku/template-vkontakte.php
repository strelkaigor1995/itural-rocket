<?php
/*
Template Name: ВКонтакте
*/
?>

<?php get_header(); ?>

<div id="container" class="clearfix">
<div id="content" class="section">

<div class="page hentry clearfix single-post">
	<?php //arras_above_content() ?>

	<h1 class="entry-title"><?php the_title(); ?></h1>
	<div class="entry-content">
	<p>Всем участникам нашей группы ВКонтакте предоставляется скидка 5% на услуги сервисного центра. Сообщите менеджеру, что вы состоите в группе до оплаты услуг.</p>
	<p>Обращаем ваше внимание на то, что скидка действует <span style="font-weight:bold;">только на оказанные услуги или выполненные работы</span> и не распространяется на компьютерную технику, расходные материалы, программное обеспечение.</p>
	
	<!-- VK Widget -->
	<div style="margin:20px auto 0;" id="vk_groups_single"></div>
	<script type="text/javascript">
	VK.Widgets.Group("vk_groups_single", {mode: 0, width: "580", height: "400", color1: 'FFFFFF', color2: '2B587A', color3: '5B7FA6'}, 45628338);
	</script>

 </div><!-- entry-content -->

<?php //arras_below_content() ?>
</div><!-- #page -->
</div><!-- #content -->
<?php arras_get_pluso(); ?>
</div><!-- #container -->

<?php get_sidebar('cku'); ?>
<?php //wp_reset_query();?>


<?php get_footer(); ?>
