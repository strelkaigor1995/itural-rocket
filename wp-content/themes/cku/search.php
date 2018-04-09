<?php get_header(); ?>

<div id="container" class="clearfix">
<div id="content" class="section">

search.php

<div class="page hentry clearfix single-post">
<?php arras_above_content() ?>

<?php if (have_posts()) : ?>
    <h2 class="entry-title"><?php _e('Search Results', 'arras') ?></h2>    
    <div class="searchbar-page"><?php include (TEMPLATEPATH . '/searchform-page.php'); ?></div>

<?php arras_get_posts('archive') ?>

<?php if(function_exists('wp_pagenavi')) wp_pagenavi(); else { ?>
    <div class="navigation clearfix">
		<div class="floatleft"><?php next_posts_link( __('Older Entries', 'arras') ) ?></div>
		<div class="floatright"><?php previous_posts_link( __('Newer Entries', 'arras') ) ?></div>
    </div>
<?php } ?>

<?php else: ?>

    <h2 class="entry-title"><?php _e('Search Results', 'arras') ?></h2>
    <div class="clearfix">
	<p><?php _e('<strong>Sorry, we couldn\'t find any results based on your search query.</strong>', 'arras') ?></p>
	<div class="searchbar-page"><?php include (TEMPLATEPATH . '/searchform-page.php'); ?></div>
    </div>

<br />
<h2 class="entry-title"><?php _e('Blog Archive', 'arras') ?></h2>
<?php query_posts('showposts=10&orderby=date&order=DESC&caller_get_posts=1&paged='.$paged); ?>
<?php arras_get_posts('archive') ?>
    
<?php if(function_exists('wp_pagenavi')) wp_pagenavi(); else { ?>
    <div class="navigation clearfix">
		<div class="floatleft"><?php next_posts_link( __('Older Entries', 'arras') ) ?></div>
		<div class="floatright"><?php previous_posts_link( __('Newer Entries', 'arras') ) ?></div>
    </div>
<?php } ?>  
<?php endif; ?>

<?php arras_below_content() ?>
</div><!-- #page -->
</div><!-- #content -->
</div><!-- #container -->

<?php get_sidebar(); ?>


<?php get_footer(); ?>
