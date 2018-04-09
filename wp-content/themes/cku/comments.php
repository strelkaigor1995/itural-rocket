<?php
if ( !empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) )
	die( __('Please do not load this page directly. Thanks!', 'arras') );
if ( post_password_required() ) {
	_e('<p class="nocomments">This post is password protected. Enter the password to view comments.</p>', 'arras');
	return;
}
?>
<?php if ( have_comments() ) : ?>
	<?php if ( !empty($comments_by_type['comment']) ) : ?>  
		<h4 class="commentary-title"><?php print(__('Comments','arras') . ' (' . get_comments_number() . ')' ); ?></h4>
		<ol id="commentlist" class="clearfix">
			<?php wp_list_comments('type=comment&callback=arras_list_comments'); ?>
		</ol>
		<?php $prev_link = get_previous_comments_link(); $next_link = get_next_comments_link();
		if ( $prev_link != '' || $next_link != '' ) { ?>
		<div class="navigation clearfix">
		    <div class="floatleft"><?php echo $prev_link; ?></div>
		    <div class="floatright"><?php echo $next_link; ?></div>
		</div>
		<?php }
	      endif; ?>
	
<?php else: ?>
		<?php if ('open' == $post->comment_status) : ?>
		<h4 class="commentary-title"><?php _e('No Comments', 'arras') ?></h4>
		<?php endif ?>
<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>
 <?php if ( is_user_logged_in() ) : ?>
  <div id="respond">
   <div id="commentsform">
    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
     <?php comment_id_fields(); ?>
     <div>
      <?php printf( __('Logged in as <a href="%1$s" title="Logged in as %2$s">%3$s</a>.', 'arras'), get_option('siteurl') . '/wp-admin', $user_identity, $user_identity) ?>(<a href="<?php echo wp_logout_url(get_permalink()) ?> " title="<?php _e('Log out of this account', 'arras') ?>"><?php _e('Logout', 'arras')?></a>)
     </div>
     <div>
      <textarea name="comment" id="s4" cols="50" rows="10" tabindex="4" class="required"></textarea>
     </div>
     <?php if(function_exists('show_subscription_checkbox')) : ?>
      <div><?php show_subscription_checkbox() ?></div>
     <?php endif; ?>
     <div>
      <input name="submit" type="submit" id="sbutt" tabindex="5" value="<?php _e('Submit Comment', 'arras') ?>" />
      <?php cancel_comment_reply_link( __('Cancel Reply', 'arras') ) ?>
     </div>
     <?php do_action('comment_form', $post->ID); ?>
    </form>
    <?php if(function_exists('show_manual_subscription_form')) { show_manual_subscription_form(); } ?>
   </div><!-- end #commentsform -->
  </div>
 <?php else : ?>
  <div class="auth-text">Только авторизованные пользователи могут оставлять комментарии. <a href="<?php get_option('site_url'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>" title="Авторизоваться на сайте">Авторизуйтесь</a>, пожалуйста.</div>
 <?php endif; ?>
<?php endif; ?>
