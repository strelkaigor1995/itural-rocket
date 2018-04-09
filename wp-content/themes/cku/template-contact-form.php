<?php
/*
Template Name: Вопрос, заявка
*/
?>

<?php get_header(); ?>

<div id="container" class="clearfix">
<div id="content" class="section">

<div class="page hentry clearfix single-post">
	<?php //arras_above_content() ?>

	<h1 class="entry-title"><?php the_title(); ?></h1>
	<div class="entry-content">
	<p>Вы можете заполнить только те поля, которые считаете нужными.</p>

	<?php echo do_shortcode('[contact-form-7 id="1681" title="main-contact"]'); ?>

</div><!-- entry-content -->

<?php //arras_below_content() ?>
</div><!-- #page -->
</div><!-- #content -->
<?php arras_get_pluso(); ?>
</div><!-- #container -->

<?php get_sidebar('cku'); ?>
<?php //wp_reset_query();?>


<?php get_footer(); ?>
