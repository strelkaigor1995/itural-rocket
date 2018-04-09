
<?php get_header(); ?>

<div class="cs_wrapper_home">
	<div class="cs_home">
		<div class="cs_title">Выберите ваш принтер:</div>
		<form action="<?php echo get_option('product_list_url'); ?>" method="get" class="cs_form_home">
			<div>
				<select class="cs_makers_js"></select>
				<select class="cs_families_js"></select>	
				<select name="device_id" class="cs_devices_js"></select>
			</div>
			<div>
				<button sub_count="" type="submit" name="type" value="goods" class="cs_button_js"><?php echo CS_FORM_GOODS_BUTTON_TITLE; ?></button>
				<button sub_count="" type="submit" name="type" value="service" class="cs_button_js"><?php echo CS_FORM_SERVICE_BUTTON_TITLE; ?></button>
			</div>
		</form>
		<div class="cs_notice">Не нашли принтер? <span class="fb_ask_a_quest_link cs_notice_link">Напишите нам</span>.</div>
	</div>
</div>

<div class="metro_wrapper clearfix">

	<ul class="clearfix">
		<li style="background:#623dbd;"><div style="margin: 25px auto 0;width: 174px;"><a href="/testirovanie-zapravki/" style="font-size:24px;">Мы тестируем более 90% картриджей после заправки</a></div></li>
		<li style="background:#ba141a;"><div style="margin: 33px auto 0;width: 170px;"><a href="/zapravka-kartridzhej/" style="font-size:20px;">Срочная заправка картриджей у&nbsp;нас в&nbsp;офисе<br />за&nbsp;15 минут</a></div></li>
		<!--<li>
			<ul>
				<li style="background:#353535;"><div style="margin: 33px auto 0;width: 156px;"><a href="/proshivka-printerov/" style="font-size:16px;">Прошивка принтеров</a></div></li>
				<li style="background:#00a31a;"><div style="margin: 22px auto 0;width: 153px;"><a href="/kartridzhi/" style="font-size:30px;">Картриджи</a></div></li>
			</ul>
		</li>-->
		<li style="background:#00a31a;"><div style="margin: 66px auto 0;width: 153px;"><a href="/kartridzhi/" style="font-size:33px;">Картриджи</a></div></li>
		<!--<li>
			<ul>
				<li style="background:#2b4081;"><div style="margin: 29px auto 0;width: 160px;"><a href="/servisnyj-centr/" style="font-size:20px;">Ремонт ноутбуков</a></div></li>
				<li style="background:#aeb70c;"><div style="margin: 18px auto 0;width: 156px;"><a href="/vosstanovlenie-dannyx/" style="font-size:18px;">Восстановление данных</a></div></li>
			</ul>
		</li>-->
		<li style="background:#aeb70c;"><div style="margin: 51px auto 0;width: 160px;"><a href="/zapravka-kartridzhej-dlya-organizacij/"><span style="font-size:39px;">Заправка</span><br><span style="font-size:21px;">для организаций</span></a></div></li>
	</ul>
	<ul style="margin-top:10px;">
		<li style="background:#de7303;"><div style="margin: 30px auto 0;width: 120px;"><a href="/katalog/" style="font-size:30px;">Каталог товаров и&nbsp;услуг</a><span>&nbsp;<?php echo wpsc_gmcpc(66600030)+wpsc_gmcpc(66600010)+wpsc_gmcpc(66600020); ?></span></div></li>
		<li>
			<ul>
				<li style="background:#2c89ee;"><div style="margin: 18px auto 0;width: 161px;"><a href="<?php echo wpsc_category_url(85); ?>" style="font-size:18px;">Заправка лазерных картриджей</a><span> <?php echo wpsc_gmcpc(85); ?></span></div></li>
				<li style="background:#00a31a;"><div style="margin: 13px auto 0;width: 159px;"><a href="<?php echo wpsc_category_url(66600122); ?>" style="font-size:16px;">Картриджи для лазерных принтеров и МФУ</a><span> <?php echo wpsc_gmcpc(66600122); ?></span></div></li>
			</ul>
		</li>
		<li style="background:#ecb22c;"><div style="margin: 30px auto 0;width: 150px;"><a href="/remont-printerov/" style="font-size:30px;">Ремонт принтеров и&nbsp;МФУ</a></div></li>
		<li style="background:#5B7FA6;"><div style="margin: 28px auto 0;width: 165px;"><a href="/vstupi-v-gruppu-vkontakte-poluchi-skidku/" style="font-size:24px;">Вступи в группу ВКонтакте - получи скидку 5% на услуги</a></div></li>
	</ul>

</div>


<div class="under_metro_wrapper clearfix">

<?php
	global $wp_query;
    query_posts('cat=183&showposts=16&orderby=date&order=DESC&caller_get_posts=1');
	if($wp_query->have_posts()){
?>
	<div class="news_wrapper">
		<h3>Последние новости</h3>
		<ul>
		<?php while ($wp_query->have_posts()) : $wp_query->the_post() ?>
			<li>
				<!--<span class="entry-cat">
					<?php the_time(get_option('date_format')); ?>
				</span>-->
				<a class="entry-title" href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a>
			</li>
		<?php endwhile; ?>
			<li style="margin-top: 40px;"><a class="entry-title" title="Перейти на страницу со всеми новостями компании" href="/vse-novosti/">Все новости</a></li>
		</ul>
	</div>
<?php } ?>


<div class="featured_products">
<?php
global $wpsc_query;
$title_lenght = 110;
$wpsc_query = new WPSC_Query('featured=1');
if(wpsc_product_count() > 0) { ?>
	<h3>Специальные предложения</h3>
	<?php while(wpsc_have_products()) {
		wpsc_the_product(); ?>
		<div class="fp_row clearfix">
			<?php if(wpsc_the_product_thumbnail()) { ?>
				<div class="fp_row_thumb">					
					<img class="product_image" id="product_image_<?php echo wpsc_the_product_id(); ?>" src="<?php echo wpsc_the_product_thumbnail(); ?>"/>
				</div>
			<?php } else { ?>
				<div class="fp_row_thumb fp_row_thumb_no_image"></div>
			<?php } ?>
			<ul>
				<li><a title="<?php echo wpsc_the_product_title(); ?>" href="<?php echo wpsc_the_product_permalink(); ?>"><?php if(mb_strlen(wpsc_the_product_title())<$title_lenght) {echo wpsc_the_product_title();} else {echo mb_substr(wpsc_the_product_title(),0,$title_lenght).'...';}?></a><?php echo wpsc_edit_the_product_link('Ред.'); ?></li>
				<li><span class="featured_price"><?php echo wpsc_the_product_price(get_option('wpsc_hide_decimals')); ?> руб.</span></li>
			</ul>
		</div><?php
	}
}
?>
<div class="fp_row clearfix"><a href="/katalog/" title="Перейти в каталог">Весь каталог</a><span> <?php echo wpsc_gmcpc(66600030)+wpsc_gmcpc(66600010)+wpsc_gmcpc(66600020); ?></span></div>
</div> <!-- featured_products -->

</div> <!-- under_metro_wrapper -->

<div class="pluso_wrapper clearfix"><?php arras_get_pluso(true); ?></div>

<?php get_footer(); ?>

