<?php
/*
Template Name: Обратный звонок
*/
?>

<?php get_header(); ?>

<div id="container" class="clearfix">
<div id="content" class="section">

<div class="page hentry clearfix single-post">

<script type='text/javascript' >
	jQuery(document).ready(function($) {
		$('#callback_phone_js').mask('+7 (999) 999-99-99');
		$('#callback_submit_button_js').click(function() {
			$(".callback_message_success_js").hide();
			$(".callback_message_error_js").html('');
			$(".callback_message_error_js").hide();
			$(".callback_wait_js").show();
			$.ajax({
				type: 'POST',
				url: '<?php echo admin_url('admin-ajax.php'); ?>',
				data: { 
					'action': 'callback',
					'exec': 'call',
					'phone': $('#callback_phone_js').val().replace(/[^0-9]/g, '')
				},
				success: function(response) {
					if(response['result'] == 1){
						$(".callback_message_success_js").show(200);
					} else {
						$(".callback_message_error_js").html(response['error']);
						$(".callback_message_error_js").show(200);
					}
				}, 
				error: function() {}, 
				complete:function(){
					$(".callback_wait_js").hide();
				}
			});			
			return false;
		});
	});
</script>
	
<h1 class="entry-title"><?php the_title(); ?></h1>
<div class="entry-content">

<?php

	$is_working = false;

	$today = new DateTime();
	$weekday = (int)$today->format('N');
	$hour = (int)$today->format('G');
	
	if(defined('DEVELOPMENT')){
		$is_working = true;
	} else {
		if($hour >= my_office_hour($today, 1) && $hour < my_office_hour($today, 2)){
			$is_working = true;
		}
	}

?>

<?php if($is_working){ ?>
	<form action="" method="post" id="">
		<div>Введите номер телефона и мы перезвоним вам за 35 секунд:</div>
		<div class="callback_form">
			<input type="text" name="phone" value="" size="20" id="callback_phone_js">
			<input type="submit" id="callback_submit_button_js" class="callback_submit_button" value="Позвонить">
			<img src="/wp-content/themes/cku/js/iload/wait.gif" class="callback_wait_js">
		</div>
	</form>
	<div class="callback_message error callback_message_error_js"></div>
	<div class="callback_message success callback_message_success_js">Мы вам звоним...</div>
<?php } else { ?>
	<div>Мы не можем позвонить вам прямо сейчас, потому что мы не работаем.</div>
<?php } ?>

</div><!-- entry-content -->

</div><!-- #page -->
</div><!-- #content -->
<?php arras_get_pluso(); ?>
</div><!-- #container -->

<?php get_sidebar('cku'); ?>

<?php get_footer(); ?>
