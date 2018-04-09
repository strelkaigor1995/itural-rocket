<!DOCTYPE html>
<html>
<head>

<title><?php arras_document_title(); ?></title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" />

<?php
	// стили и скрипты грузятся через my_arras_enqueue_script() в functions.php
?>

<?php

wp_head(); // = do_action('wp_head') / The wp_head action hook is triggered within the <head></head> section of the user's template.

global $wpsc_cart, $wp;
$current_url = home_url(add_query_arg(array(), $wp->request));

?>

<!-- Google Analytics -->
<script async>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,'script','//www.google-analytics.com/analytics.js','ga');  ga('create', 'UA-7839366-3', 'itural.ru'); ga('send', 'pageview');</script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter145402 = new Ya.Metrika({ id:145402, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/145402" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

</head>


<body onload="L.create()">

<div class="fb_overlay"></div>

<?php
	$lastfirstname = my_get_lastfirstname();
	$contacttext = my_get_contacts();
	$addresstext = my_get_address();
?>

<div id="ask_a_question_box" class="fb_wrapper">
	<div class="fb_box">
		<div class="fb_box_close fb_js_box_close"></div>
		<div class="fb_box_inner">
			<h1>Напишите нам</h1>
			<div class="fb_js_content">
				<div class="fb_line">
					<div>Ваше имя:</div>
					<input id="fb_ask_name" name="name" class="fb_str fb_ask_name_js" type="text" value="<?php echo $lastfirstname; ?>">
				</div>
				<div class="fb_line">
					<div>Сообщение:</div>
					<textarea id="fb_ask_message" name="message" cols="20" class="fb_textarea" rows="3"></textarea>
				</div>
				<div class="fb_line">
					<div>Когда и как с вами связаться:</div>
					<input id="fb_ask_contact" name="contact" class="fb_str fb_error_js" type="text" value="<?php echo $contacttext; ?>">
				</div>
				<div class="fb_line">
					<div class="fb_sent_error fb_sent_error_js"></div>
				</div>
				<div style="position:relative;">
					<input id="ask_a_question_submit" name="fb_submit" class="fb_submit" type="submit" value="Отправить">
					<img src="/wp-content/themes/cku/js/iload/wait.gif" class="fb_wait_gif fb_wait_gif_js">
					<a class="contact_link" href="/vash-vopros-zayavka" title="Перейти на страницу с полной формой заявки">Полная форма заявки</a>
				</div>
			</div>			
			<div class="fb_line">
				<div id="fb_ask_success" class="fb_sent_success">Ваше сообщение успешно отправлено.</div>
			</div>
			<div class="fb_line">
				<div id="fb_ask_fail" class="fb_sent_fail">Во время отправки сообщения произошла ошибка. Повторите попытку позже.</div>
			</div>
			<input class="fb_button_close fb_js_box_close" type="submit" value="Закрыть">
		</div>
	</div>			
</div>

<div id="fb_vyzov" class="fb_wrapper">
	<div class="fb_box">
		<div class="fb_box_close fb_js_box_close"></div>
		<div class="fb_box_inner">
			<h1>Вызвать курьера</h1>
			<div class="fb_js_content">
				<div class="fb_line" style="font-size:12px;">Курьер выезжает только по г. Екатеринбургу, Березовскому и Верхней&nbsp;Пышме в рабочие дни с 9:00 до 18:00. Стоимость и условия на странице <a href="/oplata-i-dostavka/" title="Перейти на страницу с информацией об оплате и доставке">оплаты и доставки</a>.</div>
				<div class="fb_line">
					<div>Ваше имя:</div>
					<input id="fb_vyzov_name" name="name" class="fb_str fb_vyzov_name_js" type="text" value="<?php echo $lastfirstname; ?>">
				</div>
				<div class="fb_line">
					<div>Что у вас забрать:</div>
					<input id="fb_vyzov_cart" name="cart" class="fb_str" type="text" value="" placeholder="кроме струйных картриджей и принтеров">
				</div>
				<div class="fb_line">
					<div>Адрес:</div>
					<input id="fb_vyzov_address" name="address" class="fb_str fb_vyzov_address_js fb_error_js" type="text" value="<?php echo $addresstext; ?>">
				</div>
				<div class="fb_line">
					<div>Как с вами связаться:</div>
					<input id="fb_vyzov_contact" name="contact" class="fb_str fb_error_js" type="text" value="<?php echo $contacttext; ?>">
				</div>
				<div class="fb_line">
					<div class="fb_sent_error fb_sent_error_js"></div>
				</div>
				<div style="position:relative;">
					<input id="fb_vyzov_submit" name="fb_submit" class="fb_submit" type="submit" value="Отправить">
					<img src="/wp-content/themes/cku/js/iload/wait.gif" class="fb_wait_gif fb_wait_gif_js">
				</div>
			</div>
			<div class="fb_line">
				<div id="fb_vyzov_success" class="fb_sent_success">Ваше сообщение успешно отправлено.</div>
			</div>
			<div class="fb_line">
				<div id="fb_vyzov_fail" class="fb_sent_fail">Во время отправки сообщения произошла ошибка. Повторите попытку позже.</div>
			</div>
			<input class="fb_button_close fb_js_box_close" type="submit" value="Закрыть">
		</div>
	</div>			
</div>

<div id="metro_map" class="fb_wrapper">
	<div class="fb_box metro_box">
		<div class="fb_box_close fb_js_box_close"></div>
		<div class="fb_box_inner">
			<h1>Как пройти от метро</h1>
			<div class="fb_line"><img src="/wp-content/themes/cku/images/metro_map.png" width="599" height="178" /></div>
			<div class="fb_line">
				Наш адрес: <a class="t_blank" target="_blank" href="http://maps.yandex.ru/?um=AHvF03fGgtB1Zv6eB4zqTnPT-UMsh20t&l=map" title="Посмотреть на карте"><?php echo my_get_store_address(); ?></a>, перед охраной направо
			</div>
			<div class="fb_line">
				<a href="/wp-content/themes/cku/images/gallery/enter2/01.jpg" rel="iLoad|Вход в офис"><img src="/wp-content/themes/cku/images/gallery/enter2/01_tn.jpg" /></a>
				<a href="/wp-content/themes/cku/images/gallery/enter2/02.jpg" rel="iLoad|Вход в офис"><img src="/wp-content/themes/cku/images/gallery/enter2/02_tn.jpg" /></a>
				<a href="/wp-content/themes/cku/images/gallery/enter2/03.jpg" rel="iLoad|Вход в офис"><img src="/wp-content/themes/cku/images/gallery/enter2/03_tn.jpg" /></a>
				<a href="/wp-content/themes/cku/images/gallery/enter2/04.jpg" rel="iLoad|Вход в офис"><img src="/wp-content/themes/cku/images/gallery/enter2/04_tn.jpg" /></a>
				<a href="/wp-content/themes/cku/images/gallery/enter2/05.jpg" rel="iLoad|Вход в офис"><img src="/wp-content/themes/cku/images/gallery/enter2/05_tn.jpg" /></a>
			</div>
			<div class="fb_line"><a title="Перейти на страницу с контактной информацией" href="/kontaktnaya-informaciya">Контактная информация</a></div>
		</div>
	</div>			
</div>

<div id="wrapper">

	<?php echo my_copy_alert(); ?>

    <div id="header">
		
     	<div class="branding clearfix">			
			<ul class="header-ul">
				<li><a class="logo-link" title="Перейти на главную" href="/" title="Перейти на главную страницу"></a></li>
				<li>
					<?php
						echo '<span title="Выбрать город / регион доставки" class="loginbar_link arrow-down destmenu_js">' . mb_substr($wpsc_cart->my_shipping_destination['name'], 0, 33) . '</span>';
						$dest_arr = my_get_destinations();
						echo '<ul class="dropdown_destmenu">';
						foreach($dest_arr as $dest){
							echo '<li' . (empty($dest['fias_id'])?' style="margin-top:10px;"':'') . '>';
							if($dest['id'] == $wpsc_cart->my_shipping_destination['id']){
								echo '<span>' . $dest['name'] . '</span>';
							} else {
								$arr_params = array('my_update_destination' => 'true', 'my_destination' => $dest['id']);
								echo '<a href="' . esc_url(add_query_arg($arr_params)) . '">' . $dest['name'] . '</a>';
							}							
							echo'</li>';
						}
						echo '</ul>';
					?>
				</li>
				<li><?php echo do_shortcode("[store_phone class='loginbar_link']"); ?></li>
				<li class="header-wh">пн-пт: с 9:00 до 19:00; сб, вс: с 11:00 до 18:00</li>
				<!--<li><a style="font-size:12px;text-decoration:underline;" href="/grafik-raboty-prazdniki/">график работы в праздники</a></li>-->
				<li class="metro-li"><img width="16" height="15" src="/wp-content/themes/cku/images/icon-metro.png" /><span id="metro-link" class="header-link" title="Посмотреть как пройти от метро">Площадь 1905 года</span></li>
			</ul>
        </div><!-- #branding -->
		
		<div class="branding clearfix" style="margin-top:15px;">
			<ul class="header_2_row_ul_l">
				<li><a title="Перейти на главную страницу каталога" class="katalog_a" href="<?php echo get_option('product_list_url'); ?>">Каталог товаров</a></li>
				<li><?php gold_shpcrt_search_form_sidebar(); ?></li>
			</ul>
			<ul class="header_2_row_ul_r">
				<li>
					<?php 									
					if ( is_user_logged_in() ) { ?>
						<span class="loginbar_link usermenu_js arrow-down">Профиль</span>					
						<ul class="dropdown_usermenu">
							<li><a title='Изменить контактную информацию и адрес доставки' href='<?php echo get_option('user_account_url'); ?>?edit_profile=true'>Мои данные</a></li>							
							<li><a title='Посмотреть историю покупок' href='<?php echo get_option('user_account_url')?>'>Мои заказы</a></li>
							<li style="margin-top:10px;"><a href="<?php echo wp_logout_url($current_url) ?>">Выйти</a></li>
						</ul>
					<?php } else { ?>
						<a class="loginbar_link" href="<?php echo site_url('wp-login.php?redirect_to='.$current_url) ?>" title="Авторизоваться или зарегистрироваться на сайте">Войти</a>
					<?php } ?>				
				</li>
				<li><a class="cart_link_js loginbar_link cart_link <?php echo my_get_cart_class(); ?>" href="<?php echo get_option('shopping_cart_url'); ?>"><?php echo my_get_cart_link_text(); ?></a></li>
			</ul>
		</div>
		
		<div class="branding clearfix">
			<ul class="header_3_row_ul">
				<li><span class="fb_vyzov_link header-link" title="Вызвать курьера, чтобы забрать ваши картриджи на заправку или технику в ремонт">Вызвать курьера</span></li>
				<li><span class="fb_ask_a_quest_link header-link" title="Задать вопрос нашим специалистам">Задать вопрос</span></li>
				<li><a title="Узнать статус готовности вашего заказа по номеру" class="status_remota_a" href="/check/">Статус ремонта</a></li>
			</ul>
		</div>		
		
    </div><!-- #header -->

    <div id="nav">

    	<div id="nav-content" class="clearfix">
			
			<!-- <div class="header-market-rating"><a class="flamp-widget" href="http://ekaterinburg.flamp.ru/firm/it_servis_ooo-1267165676520373"  data-flamp-widget-type="small" data-flamp-widget-color="yellow" data-flamp-widget-text-color="black" data-flamp-widget-id="1267165676520373">Отзывы</a><script>!function(d,s){var js,fjs=d.getElementsByTagName(s)[0];js=d.createElement(s);js.async=1;js.src="//widget.flamp.ru/loader.js";fjs.parentNode.insertBefore(js,fjs);}(document,"script");</script></div> -->
			
			<!-- <div class="header-market-rating"><a href="http://clck.yandex.ru/redir/dtype=stred/pid=47/cid=2508/*http://market.yandex.ru/shop/51997/reviews"><img src="http://clck.yandex.ru/redir/dtype=stred/pid=47/cid=2505/*http://grade.market.yandex.ru/?id=51997&action=image&size=0" border="0" width="88" height="31" alt="Читайте отзывы покупателей и оценивайте качество магазина на Яндекс.Маркете" /></a></div> -->
			
			<ul class="top-level-menubar">
				<!--<li class="top-level-menuitem dropdown"><a class="home-link" href="/" title="Перейти на главную страницу"></a></li>-->
				<li class="top-level-menuitem dropdown">
					<span class="top-level-link arrow-down">Услуги</span>
					<div class="dropdown-menu uslugi">
							<div class="grid-unit list-of-links">
								<div class="heading">Информация</div>
								<ul>
									<li><a href="/zapravka-kartridzhej/">Заправка картриджей</a></li>
									<li><a href="/testirovanie-zapravki/">Программа &laquo;Тест ОК!&raquo;</a></li>
									<!-- <li><a class="net_takoy_stranicy" href="/">Ремонт печатающей техники</a></li> -->
								</ul>
								<ul>
									<li><a href="/remont-printerov/">Ремонт принтеров и МФУ</a></li>
								</ul>
								<!--<ul>
									<li><a href="/proshivka-printerov/">Прошивка принтеров</a></li>
								</ul>-->
							</div>					

							<div class="grid-unit list-of-links">
								<div class="heading">Цены на заправку картриджей</div>
								<ul>
									<li><a href="/zapravka-kartridzhej-hp-hewlett-packard/">Заправка картриджей HP</a></li>
									<li><a href="/zapravka-kartridzhej-xerox/">Заправка картриджей Xerox</a></li>
									<li><a href="/zapravka-kartridzhej-samsung/">Заправка картриджей Samsung</a></li>
									<li><a href="/zapravka-kartridzhej-canon/">Заправка картриджей Canon</a></li>
									<li><a href="/zapravka-kartridzhej-brother/">Заправка картриджей Brother</a></li>
									<li><a href="/zapravka-kartridzhej-epson/">Заправка картриджей Epson</a></li>
									<li><a href="/zapravka-kartridzhej-kyocera/">Заправка картриджей Kyocera</a></li>
								</ul>						
								<ul>
									<li><a href="<?php echo wpsc_category_url(85); ?>">Заправка всех лазерных картриджей</a><span> <?php echo wpsc_gmcpc(85); ?></span></li>
									<li><a href="<?php echo wpsc_category_url(66607027); ?>">Заправка струйных картриджей</a><span> <?php echo wpsc_gmcpc(66607027); ?></span></li>
								</ul>
							</div>
							
							<div class="grid-unit list-of-links">
								<div class="heading">Цены на ремонт техники</div>
								<ul>
									<li><a href="<?php echo wpsc_category_url(66600414); ?>">Ремонт лазерных принтеров и МФУ</a><span> <?php echo wpsc_gmcpc(66600414); ?></span></li>
									<li><a href="<?php echo wpsc_category_url(66607227); ?>">Ремонт струйных принтеров и МФУ</a><span> <?php echo wpsc_gmcpc(66607227); ?></span></li>
								</ul>
								<!--<ul>
									<li><a href="<?php echo wpsc_category_url(66607358); ?>">Прошивка и обновление принтеров</a><span> <?php echo wpsc_gmcpc(66607358); ?></span></li>
								</ul>-->
								<div class="heading"><a href="<?php echo wpsc_category_url(66600020); ?>">Все услуги</a><span> <?php echo wpsc_gmcpc(66600020); ?></span></div>
							</div>
						
					</div>
				</li>
				
				<li class="top-level-menuitem dropdown">
					<span class="top-level-link arrow-down">Магазин</span>
					<div class="dropdown-menu magazin">
						<div class="grid-unit list-of-links">
							<div class="heading">Информация</div>
							<ul>
								<li><a href="/oplata-i-dostavka/">Оплата и доставка</a></li>
								<li><a href="/obmen-i-vozvrat-tovara/">Обмен и возврат товара</a></li>
							</ul>
							<ul>
								<li><a href="/kartridzhi/">Картриджи для печатающей техники</a></li>
								<li><a href="/snpch/">Системы непрерывной подачи чернил</a></li>
								<!-- <li><a class="net_takoy_stranicy" href="/">Перезаправляемые картриджи</a></li> -->
								<!-- <li><a class="net_takoy_stranicy" href="/">Чернила</a></li> -->
							</ul>
							<ul>
								<li><a href="/pokupka-skupka-poderzhannyx-bu-printerov/" style="color:orangered;">Скупка б/у лазерных принтеров</a></li>
								<!-- <li><a href="/forum/?mingleforumaction=viewforum&f=5.0">Форум по б/у технике</a></li> -->
							</ul>
						</div>	
						<div class="grid-unit list-of-links">
							<div class="heading">Цены на товары</div>
							<ul>
								<li><a href="<?php echo wpsc_category_url(66600122); ?>">Картриджи для лазерных принтеров</a><span> <?php echo wpsc_gmcpc(66600122); ?></span></li>
							</ul>
							<ul>
								<li><a href="<?php echo wpsc_category_url(66600125); ?>">Картриджи для струйных принтеров</a><span> <?php echo wpsc_gmcpc(66600125); ?></span></li>
								<li><a href="<?php echo wpsc_category_url(66602704); ?>">Системы непрерывной подачи чернил (СНПЧ)</a><span> <?php echo wpsc_gmcpc(66602704); ?></span></li>
								<li><a href="<?php echo wpsc_category_url(66611056); ?>">Перезаправляемые картриджи (ПЗК)</a><span> <?php echo wpsc_gmcpc(66611056); ?></span></li>
								<li><a href="<?php echo wpsc_category_url(66601072); ?>">Чернила</a><span> <?php echo wpsc_gmcpc(66601072); ?></span></li>
							</ul>
							<ul>
								<li><a href="<?php echo wpsc_category_url(140); ?>">Расходные материалы</a><span> <?php echo wpsc_gmcpc(140); ?></span></li>
							</ul>
							<ul>
								<li><a href="<?php echo wpsc_category_url(66600118); ?>">Лазерные МФУ и принтеры</a><span> <?php echo wpsc_gmcpc(66600118); ?></span></li>
							</ul>
						</div>	
						<div class="grid-unit list-of-links">
							<div class="heading">&nbsp;</div>
							<ul>
								<!-- <li><a class="net_takoy_stranicy" href="/">Каталог б/у компьютерной техники</a><span class="net_takoy_stranicy"> <?php echo wpsc_gmcpc(66600010); ?></span></li> -->
								<li><a href="<?php echo wpsc_category_url(66600030); ?>">Программное обеспечение</a><span> <?php echo wpsc_gmcpc(66600030); ?></span></li>
							</ul>
							<!--<ul>
								<li><a href="<?php echo wpsc_category_url(66606786); ?>">Паяльные станции ACHI, Fundar</a><span> <?php echo wpsc_gmcpc(66606786); ?></span></li>
							</ul>-->
							<div class="heading"><a href="/katalog/">Весь каталог</a><span> <?php echo wpsc_gmcpc(66600030)+wpsc_gmcpc(66600010)+wpsc_gmcpc(66600020); ?></span></div>
							<div class="heading"><a href="/korzina/">Корзина</a><?php global $wpsc_cart; if($wpsc_cart->cart_item_count>0) { ?><span class="category_count">&nbsp;<?php echo $wpsc_cart->cart_item_count; ?></span><?php } ?></div>
						</div>
					</div>
				</li>
				
				<li class="top-level-menuitem dropdown">
					<a class="top-level-link-single" href="/oplata-i-dostavka/">Оплата и доставка</a>
				</li>
				
				<li class="top-level-menuitem dropdown">
					<span class="top-level-link arrow-down">Организациям</span>
					<div class="dropdown-menu statji">
						<div class="grid-unit list-of-links">
							<ul>
								<li><a href="/zapravka-kartridzhej-dlya-organizacij/" style="color:orangered;">Заправка картриджей для организаций</a></li>
								<li><a href="/poluchit-predlozhenie-na-zapravku-kartridzhej/">Получить предложение на заправку картриджей</a></li>
							</ul>
						</div>
					</div>
				</li>

				<li class="top-level-menuitem dropdown">
					<span class="top-level-link arrow-down">Статьи</span>
					<div class="dropdown-menu statji">
						<div class="grid-unit list-of-links">
							<!-- <div class="heading">Последние статьи</div> -->
							<ul>
								<li><a href="/pochemu-ne-pechataet-kartridzh-posle-zapravki/">Почему не печатает картридж после заправки</a></li>
								<li><a href="/pochemu-kartridzh-bledno-pechataet-posle-zapravki/">Почему картридж бледно печатает после заправки</a></li>
								<li><a href="/otlichiya-sovmestimyx-i-originalnyx-kartridzhej/">Отличия совместимых и оригинальных картриджей</a></li>
								<li><a href="/chto-takoe-resurs-lazernogo-kartridzha/">Что такое ресурс лазерного картриджа?</a></li>
								<li><a href="/volnistye-linii-i-fon-pri-lazernoj-pechati/">Волнистые линии и фон при лазерной печати</a></li>
							</ul>
							<ul>
								<li><a href="/primenenie-sovmestimyx-rasxodnyx-materialov-v-mfu-panasonic/">Применение совместимых расходных материалов в МФУ Panasonic</a></li>
							</ul>
							<ul>
								<li><a href="/zamena-kartridzha-u-xerox-phaser-3100mfps/">Замена картриджа у Xerox Phaser 3100MFP/S</a></li>
							</ul>
							<ul>
								<li><a href="/zapravka-kartridzhej-dlya-xerox-phaser-60006010-workcentre-6015/">Заправка картриджей для Xerox Phaser 6000/6010, WC 6015</a></li>
								<li><a href="/zapravka-kartridzhej-kyocera-tk-1110-tk-1120/">Заправка картриджей Kyocera TK-1110, TK-1120</a></li>
							</ul>
						</div>
						<div class="grid-unit list-of-links">
							<ul>
								<li><a href="/sbros-schetchika-stranic-na-printerax-samsung-i-xerox/">Сброс счетчика страниц на принтерах Samsung и Xerox</a></li>
							</ul>
							<ul>
								<li><a href="/sbros-schetchika-tonera-ricoh-aficio-sp-100sf/">Сброс счетчика тонера Ricoh Aficio SP 100SF</a></li>
							</ul>
							<ul>
								<li><a href="/zapravka-startovyx-kartridzhej-brother-tn-20902275/">Заправка стартовых картриджей Brother TN-2090/2275</a></li>
								<li><a href="/sbros-schetchika-tonera-dlya-kartridzhej-brother/">Сброс счетчика для картриджей Brother TN-2080/2090/2275</a></li>
								<li><a href="/sbros-schetchika-na-printerax-brother-s-kartridzhem-tn-1075/">Сброс счетчика тонера для картриджа Brother TN-1075</a></li>
							</ul>
							<ul>
								<li><a href="/vybiraem-ekonomichnyj-lazernyj-printer/" style="color:orangered;">Выбираем экономичный лазерный принтер</a></li>
								<li><a href="/vybiraem-strujnyj-printer/">Выбираем струйный принтер</a></li>
							</ul>
							<div class="heading"><a href="/vse-stati/">Все статьи</a></div>
						</div>
					</div>
				</li>
				
				<li class="top-level-menuitem dropdown">
					<span class="top-level-link arrow-down">Компания</span>
					<div class="dropdown-menu kompaniya">
						<div class="grid-unit list-of-links">
							<ul>
								<li><a href="/otzyvy-o-nas/">Отзывы о нас</a></li>
							</ul>
							<ul>
								<li><a href="/vash-vopros-zayavka/">Задать вопрос, оставить заявку</a></li>
								<li><a href="#" class="fb_vyzov_link" title="Вызвать курьера в офис или домой">Вызвать курьера</a></li>
							</ul>
						</div>
						<div class="grid-unit list-of-links">
							<ul>
								<li><a href="/check/">Проверить статус заявки по номеру</a></li>
							</ul>
							<ul>
								<li><a href="/vstupi-v-gruppu-vkontakte-poluchi-skidku/">Вступи в группу ВКонтакте - получи скидку</a></li>
								<li><a href="/raspechataj-kupon-poluchi-skidku/">Купон-скидка 5% на услуги</a></li>
							</ul>
							<!--<div class="heading">Обсуждения</div>
							<ul>
								<li><a href="/forum/">Форум</a></li>
								<li><a href="/forum/?mingleforumaction=viewforum&f=5.0">Cкупка и оценка б/у техники</a></li>
							</ul>
							-->
						</div>
						<div class="grid-unit list-of-links">
							<ul>
								<li><a href="/vakansii/" style="color:orangered;">Есть вакансии!</a></li>
								<!-- <li><a href="/o-kompanii/">О компании</a></li> -->
							</ul>
							<ul>
								<li><a href="/vse-novosti/">Все новости</a></li>
							</ul>
						</div>
					</div>
				</li>

				<li class="top-level-menuitem dropdown">
					<a class="top-level-link-single" href="/kontaktnaya-informaciya/">Контакты</a>
					<!--<span class="top-level-link">Контакты</span>
					<div class="dropdown-menu kontakty">
						<div class="grid-unit list-of-links">
							<ul>
								<li><a href="/kontaktnaya-informaciya/">Контактная информация</a></li>
								<li><a class="t_blank" target="_blank" rel="nofollow" href="/wp-content/themes/cku/images/kontakty_dlya_pechati.jpg">Версия для печати</a></li>
							</ul>
							<ul>
								<li><a href="/vash-vopros-zayavka/">Задать вопрос, оставить заявку</a></li>
								<li><a href="#" class="fb_vyzov_link" title="Вызвать курьера, чтобы забрать ваши картриджы на заправку">Вызвать курьера</a></li>
							</ul>
							<div class="heading">Обсуждения</div>
							<ul>
								<li><a href="/forum/">Форум</a></li>
								<li><a href="/forum/?mingleforumaction=viewforum&f=5.0">Cкупка и оценка б/у техники</a></li>
							</ul>
						</div>
						<div class="grid-unit list-of-links">
							<div class="heading">Наш адрес:</div>
							<ul>
								<li><a href="http://maps.yandex.ru/?um=AHvF03fGgtB1Zv6eB4zqTnPT-UMsh20t&l=map" title="Посмотреть на карте" class="t_blank" target="_blank">ул. 8 Марта, д. 14</a></li>
								<li>1 этаж, перед охраной направо</li>
								<li>г. Екатеринбург</li>
							</ul>				
							<div class="heading">Телефоны:</div>
							<ul>
								<li><здесь должны быть телефоны></li>
								<li><a href="skype:+73433598488?call" title="Позвонить нам через Skype" class="t_blank" target="_blank">позвонить через Skype</a></li>
							</ul>
							<div class="heading">Электронная почта:</div>
							<ul><li><a href="mailto:mail@itural.ru" title="Написать нам письмо" class="t_blank" target="_blank">mail@itural.ru</a></li></ul>
						</div>
						<div class="grid-unit list-of-links">
							<img src="http://static-maps.yandex.ru/1.x/?lang=ru-RU&ll=60.59907179496759%2C56.83336857715743&size=301%2C310&z=17&l=map&pt=60.599940830688325%2C56.83294510225957%2Cpm2dbl" alt="Карта"/>
						</div>
					</div> -->
				</li>

			</ul>
		

		

		</div><!-- #nav-content -->

    </div><!-- #nav -->
	
	<!-- <div class="nav-line"></div> -->

   

	<div id="main">

    
