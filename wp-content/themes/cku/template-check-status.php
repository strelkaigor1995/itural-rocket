<?php
/*
Template Name: Проверить статус заявки
*/
?>

<?php get_header(); ?>

<div id="container" class="clearfix">
<div id="content" class="section">

<div class="page hentry clearfix single-post">

<?php //arras_above_content() ?>

 <h1 class="entry-title"><?php the_title(); ?></h1>
 <div class="entry-content">
  <form onsubmit="<?php echo get_permalink() . '#check-status-form'; ?>" method="post" id="check-status-form">
   Введите номер вашей заявки и нажмите кнопку &laquo;Проверить&raquo;:
   <div>
    <input type="text" name="serid" value=<?php if(isset($_POST['mode'])) {echo '"'.$_POST['serid'].'"';} else {echo '""';}?> size="20">
    <input type="submit" id="check-status-submit" value="Проверить">
    <input type="hidden" name="mode" value="exe">
   </div>
  </form>

<?php

if (isset($_POST['mode'])) {
 echo '<div class="check-status">';
 if(isset($_POST['serid'])) { $ser_id = preg_replace('/[^0-9]/i','',$_POST['serid']); }
 if($ser_id === '') { echo '<div class="error">Неверно указан номер заявки.</div>'; }
 else {
  $link = @mssql_connect(MY_MSSQL_ADDRESS, MY_MSSQL_USER, MY_MSSQL_PASSWORD);
  if(!$link ) { echo '<div class="error">Сожалеем, но информация о статусе заявок сейчас недоступна.</div>'; }
  else {
   if (!mssql_select_db(MY_MSSQL_DB, $link)) { echo '<div class="error">Сожалеем, но при проверке статуса заявки возникла неизвестная ошибка. Попробуйте повторить запрос позже.</div>'; }
   else {
	   
	// такой же запрос в \wp-content\api\v1\getServiceCallStatus.php
    $query = 'SELECT SER_ID,CONVERT(varchar,DATEADD(hour,6,HSC_CREATED),120),CONVERT(text,HSC_NEWVALUE) as HSC_NEWVALUE from dbo.ITSM_SERVICECALLS,dbo.ITSM_HISTORYLINES_SERVICECALL,dbo.ITSM_HIST_INFO_SERVICECALL where SER_ID = CAST ('.$ser_id.' AS decimal(18,0)) and HSC_SER_OID=SER_OID and HSC_VALUEATR_OID=662896684 and HIS_HSC_OID=HSC_OID ORDER BY HSC_CREATED';
	
    $query_result = mssql_query($query);
    if(!mssql_num_rows($query_result)) { echo '<div class="error">Заявка с указанным номером не найдена.</div>'; }
    else {
     echo '<table class="check-status-table">';
     echo '<tr><td>Дата и время</td><td>Статус</td></tr>';
     while($row = mssql_fetch_array($query_result, MSSQL_NUM)) {
      echo '<tr><td>'.date_format(date_create($row[1]),'d.m.y, H:i').'</td><td>'.iconv('windows-1251','utf-8',$row[2]).'</td></tr>';
     }
     echo '</table>';
    }
    mssql_free_result($query_result);
   }
   mssql_close($link);
  }
 }
 echo '</div>';
}
?>

</div><!-- entry-content -->

<?php //arras_below_content() ?>

</div><!-- #page -->
</div><!-- #content -->
<?php arras_get_pluso(); ?>
</div><!-- #container -->

<?php get_sidebar('cku'); ?>


<?php get_footer(); ?>
