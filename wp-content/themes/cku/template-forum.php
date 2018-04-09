<?php
/*
Template Name: Форум
*/
?>

<?php get_header(); ?>

<div id="container" class="clearfix">
<div id="content" class="section">

<div class="page hentry clearfix single-post">
<?php //arras_above_content() ?>

<?php
	if (have_posts()) {
		while (have_posts()){
			the_post();
			//arras_postheader();
			the_content();
		}
	} else {arras_post_notfound();}
?>

<?php //arras_below_content() ?>
</div><!-- #page -->
</div><!-- #content -->
<?php arras_get_pluso(); ?>
</div><!-- #container -->

<?php get_sidebar('cku'); ?>
<?php wp_reset_query();?>


<?php get_footer(); ?>
