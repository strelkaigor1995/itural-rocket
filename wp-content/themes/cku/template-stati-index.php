<?php
/*
Template Name: Все статьи
*/
?>

<?php get_header(); ?>

<div id="container" class="clearfix">
<div id="content" class="section">

<div class="page hentry clearfix single-post">
<?php //arras_above_content() ?>

<?php 
    query_posts('cat=182&showposts=30&orderby=date&order=DESC&caller_get_posts=1&paged='.$paged);
?>

<?php is_tag(); if ( have_posts() ) : ?>
	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
	
        <h1 class="entry-title"><?php the_title(); ?></h1>
    
	<?php arras_get_posts('archive') ?>

	<?php if(function_exists('wp_pagenavi')) wp_pagenavi(); else { ?>
	<div class="navigation clearfix">
	    <div class="floatleft"><?php next_posts_link( __('Older Entries', 'arras') ) ?></div>
	    <div class="floatright"><?php previous_posts_link( __('Newer Entries', 'arras') ) ?></div>
	</div>

    <?php } ?>  
<?php else : ?>
	<?php 
	    arras_post_notfound();
	?>
<?php endif; ?>

<?php //arras_below_content() ?>
</div><!-- #page -->
</div><!-- #content -->
<?php arras_get_pluso(); ?>
</div><!-- #container -->

<?php get_sidebar('cku'); ?>
<?php wp_reset_query(); ?>


<?php get_footer(); ?>
