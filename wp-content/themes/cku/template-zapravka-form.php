<?php
/*
Template Name: Заявка на заправку
*/
?>

<?php get_header(); ?>

<div id="container" class="clearfix">
<div id="content" class="section">

<div class="page hentry clearfix single-post">
	<?php //arras_above_content() ?>

	<h1 class="entry-title"><?php the_title(); ?></h1>
	<div class="entry-content">
	<p>Мы готовы сделать вам индивидуальное предложение по заправке картриджей. Чтобы получить его, заполните несколько полей ниже. Укажите модели принтеров или МФУ, которыми вы пользуетесь и примерную периодичность заправки картриджей. Не забудьте оставить свои контактные данные. Спасибо!</p>
	
	<?php echo do_shortcode('[contact-form-7 id="4168" title="zapravka-form"]'); ?>
	
 </div><!-- entry-content -->

<?php //arras_below_content() ?>
</div><!-- #page -->
</div><!-- #content -->
<?php arras_get_pluso(); ?>
</div><!-- #container -->

<?php get_sidebar('cku'); ?>
<?php //wp_reset_query();?>


<?php get_footer(); ?>
