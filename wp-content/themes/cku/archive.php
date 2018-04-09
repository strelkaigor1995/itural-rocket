
<?php get_header(); ?>

<div id="container" class="clearfix">
<div id="content" class="section">

<div class="page hentry clearfix single-post">

<?php //arras_above_content(); ?> 

<?php is_tag(); if ( have_posts() ) : ?>
	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

	<?php if ( is_day() ) : ?>
    	    <h1 class="entry-title"><?php printf( 'Все новости &mdash; %s г.', get_the_time( __('d.m.Y', 'arras') ) ) ?></h1>
	<?php elseif ( is_month() ) : ?>
    	    <h1 class="entry-title"><?php printf( 'Все новости &mdash; %s г.', get_the_time( __('F Y', 'arras'))  ) ?></h1>
	<?php elseif ( is_year() ) : ?>
    	    <h1 class="entry-title"><?php printf( 'Все новости &mdash; %s г.', get_the_time( __('Y', 'arras') ) ) ?></h1>
	<?php elseif ( is_tag() ) : ?>
    	    <h1 class="entry-title"><?php printf( 'Все страницы &mdash; меткa: %s', single_tag_title("",false)) ?></h1>
	<?php else : ?>
    	    <h1 class="entry-title">Все новости</h1>
	<?php endif; ?>
	
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
</div><!-- #container -->

<?php get_sidebar('cku'); ?>


<?php get_footer(); ?>
