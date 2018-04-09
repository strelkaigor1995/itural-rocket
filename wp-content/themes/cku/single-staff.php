<?php get_header(); ?>

<div id="container" class="clearfix">
<div id="content" class="section">

<?php //if ( arras_get_option('single_meta_pos') == 'bottom' ) add_filter('arras_postfooter', 'arras_postmeta') else add_filter('arras_postheader', 'arras_postmeta'); ?>


<?php if (have_posts()) { while (have_posts()) { the_post(); ?>

    <div id="post-<?php the_ID() ?>" <?php arras_single_post_class() ?>>
	
        <?php arras_postheader(); ?>
        
        <div class="entry-content clearfix">
			<?php the_content( __('<p>Read the rest of this entry &raquo;</p>', 'arras') ); ?>  
    		<?php wp_link_pages(array('before' => __('<p><strong>Pages:</strong> ', 'arras'), 'after' => '</p>', 'next_or_number' => 'number')); ?>
		</div>
        
		<?php //arras_postfooter(); ?>

        <?php /*if ( arras_get_option('display_author') ) { ?>
    	    <div class="about-author clearfix">
				<h4><?php _e('About the Author', 'arras') ?></h4>
				<?php echo get_avatar(get_the_author_id(), 48); ?>
				<?php the_author_description(); ?>
    	    </div>
        <?php } */ ?>

	<?php //arras_below_post() ?>
	<?php //comments_template('',true); ?>
	<?php //arras_below_comments() ?>

    </div>
    
    <?php arras_posttags(); ?>
	
<?php }  } else { ?>

<?php arras_post_notfound() ?>

<?php } ?>

<?php //arras_below_content() ?>

</div><!-- #content -->

<?php arras_get_pluso(); ?>

</div><!-- #container -->

<?php get_sidebar('cku'); ?>

<?php get_footer(); ?>
