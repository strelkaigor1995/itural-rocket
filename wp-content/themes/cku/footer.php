	</div><!-- #main -->

	<?php wp_reset_query(); if(is_home()){ ?>
		<div class="home_text_wrapper entry-content clearfix">
			<?php
			query_posts('page_id=4506');
			while (have_posts()) : the_post();
				the_content();
			endwhile;
			?>
		</div>
	<?php } ?>
	
    <div id="footer" class="clearfix">	
		<div class="footer_contacts clearfix">
			<div>Центр компьютерных услуг &laquo;ИТ Сервис&raquo;</div>
			<div>
				<ul>
					<li>Адрес: <a href="http://maps.yandex.ru/?um=AHvF03fGgtB1Zv6eB4zqTnPT-UMsh20t&l=map" title="Посмотреть на карте"><?php echo my_get_store_address(); ?></a></li>
					<li>Телефоны: <?php echo do_shortcode("[store_phone old='yes']"); ?></li>
					<li>Электронная почта: <a href="mailto:mail@itural.ru" title="Написать нам письмо">mail@itural.ru</a></li>
				</ul>
			</div>
			<div>
				<a style="display:inline-block;vertical-align:top;" href="http://vk.com/itural_ru"><img src="/wp-content/themes/cku/images/social_vkontakte_icon.png" /></a>
				<!-- <a style="display:inline-block;margin-left:10px;" href="http://clck.yandex.ru/redir/dtype=stred/pid=47/cid=2508/*http://market.yandex.ru/shop/51997/reviews"><img src="http://clck.yandex.ru/redir/dtype=stred/pid=47/cid=2506/*http://grade.market.yandex.ru/?id=51997&action=image&size=1" border="0" width="120" height="110" alt="Читайте отзывы покупателей и оценивайте качество магазина на Яндекс.Маркете" /></a> -->
			</div>
		</div>
		<!--<div class="footer_prices">
			<a title="Цены на заправку картриджей, услуги сервисного центра, установку программ, восстановление данных, настройку сети" href="/wp-content/uploads/it_price_list.xls">Скачать наш прайс-лист в формате Microsoft Excel</a>
		</div>-->
		<div class="footer_links"><a title="Заправка катриджей в Екатеринбруге" href="/">Заправка катриджей в Екатеринбруге</a> | <a title="Политика конфиденциальности" href="https://docs.google.com/document/d/1dOprb4VHEhxGmL8WdWx1xAjvqYH91gZI0oyeZSi2syI/edit?usp=sharing">Политика конфиденциальности</a></div>
	</div>

	<?php echo my_copy_alert(); ?>
	
</div><!-- #wrapper -->

<?php echo my_jivosite(); ?>
<?php echo my_get_callback_html(); ?>
<?php echo retail_rocket_allpage(); ?>

<!-- Начало кода счетчика UralWeb --><div style="display:none;"><img border="0" src="https://hc.uralweb.ru/hc/itural?js=0" width="88" height="31" alt="Рейтинг UralWeb" /></div><!-- конец кода счетчика UralWeb --> 

<?php wp_footer(); // Fire the 'wp_footer' action ?>

</body>

</html>