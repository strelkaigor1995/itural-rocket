<?php
/*
Template Name: Купон-скидка
*/
?>

<?php setcookie('rnc',rand(100000,999999),time()+32400,'/'); ?>

<?php get_header(); ?>

<?php
 global $current_user,$user_ID;
 $youname = '';
 if ( is_user_logged_in() ) {
  get_currentuserinfo();
  $youname = my_get_lastfirstname();
 }
 if (isset($_POST['mode'])) {
  $youname = $_POST['youname'];
 }
?>

<div id="container" class="clearfix">
<div id="content" class="section">

<div class="page hentry clearfix single-post">

<?php //arras_above_content() ?>

<h1 class="entry-title"><?php the_title(); ?></h1>
<div class="entry-content">

 <p>Наша компания предоставляет посетителям сайта скидки на все услуги компьютерной помощи и сервисного центра. Чтобы воспользоваться скидкой, вам необходимо указать свою фамилию и имя, распечатать купон-скидку, предъявить купон при оплате. Обращаем ваше внимание на то, что скидка действует <span style="font-weight:bold;">только на оказанные услуги или выполненные работы</span> и не распространяется на компьютерную технику, расходные материалы, программное обеспечение.</p>
 <p>
  <form onsubmit=<?php echo '"'.get_permalink().'#coupon-form"'; ?> method="post" id="coupon-form">
   Ваши фамилия и имя:<br />
   <input type="text" size="40" maxlength="28" name="youname" value=<?php echo '"'.$youname.'"' ?> >
   <input type="submit" id="coupon-submit" value="Получить скидку 5%">
   <input type="hidden" name="mode" value="exe">
  </form>
 </p>

<?php
 if(isset($_POST['mode'])) {
  if( $youname == '' ) { ?>
   <div class="error">Пожалуйста, укажите ваше имя.</div>
  <?php } else { ?>

  <script language="javascript">
   function pCoupon() {
    var w = window.open('/wp-content/themes/cku/template-coupon-image.php?youname=<?php echo urlencode($youname) ?>','Kupon','width=390,height=234'); <!-- ' -->
    w.onload = function(event) {
     w.print();
    }
   }
  </script>

<?php
  echo '<div style="margin-top: 20px"><img class="aligncenter" alt="Здесь должен быть купон на скидку." src="/wp-content/themes/cku/template-coupon-image.php?youname='. urlencode($youname) . '" /></div>';
  echo '<div style="margin: 20px 0" class="textcenter"><a target="_blank" onclick="pCoupon();return false" href="/wp-content/themes/cku/template-coupon-image.php?youname='. urlencode($youname) . '">Печатать купон</a></div>';
 }}
?>

</div><!-- entry-content -->
<?php //arras_below_content() ?>

</div><!-- #page -->
</div><!-- #content -->
<?php arras_get_pluso(); ?>
</div><!-- #container -->

<?php get_sidebar('cku'); ?>


<?php get_footer(); ?>
