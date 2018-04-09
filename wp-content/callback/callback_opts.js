if(typeof window.PozvonimcomLoader=="undefined"){
	var PozvonimcomWidgetRootConfig={
		"id":1,
		"user_id":1,
		"site_id":1,
		"period":1,
		"logo":"1x1.GIF",
		"status":0,
		"button":1, // скрывает круглую кнопку
		"button_arrow":0, // боковая кнопка
		"button_size":0,
		"button_text":1,
		"button_animation":0, // не работает?
		"button_wawes":0,
		"button_display":1,
		"button_position":"BOTTOM_RIGHT", // CUSTOM
		"button_position_x":0,
		"button_position_y":0,
		"schelude":{
			"monday":{"enable":1,"from":"0:0","to":"24:0"},
			"tuesday":{"enable":1,"from":"0:0","to":"24:0"},
			"wednesday":{"enable":1,"from":"0:0","to":"24:0"},
			"thursday":{"enable":1,"from":"0:0","to":"24:0"},
			"friday":{"enable":1,"from":"0:0","to":"24:0"},
			"saturday":{"enable":1,"from":"0:0","to":"24:0"},
			"sunday":{"enable":1,"from":"0:0","to":"24:0"}
			},
		"schelude_daily":0,
		"schelude_night":0,
		"schelude_delayed":0,
		"schelude_timezone":0,
		"schelude_extended":0,
		"schelude_call_delay":2,
		"timezone":"Asia\/Karachi",
		"timezone_auto":1, // Автоматическое определение часового пояса клиента
		"mobile_enable":1,
		"mobile_button":1,
		"mobile_button_drag":1,
		"mobile_button_size":0,
		"mobile_button_animation":0,
		"mobile_button_wawes":0,
		"mobile_button_position":"BOTTOM_RIGHT",
		"mobile_button_position_y":0,
		"mobile_button_position_x":0,
		"window_text":{
			"enter":{
				"title":"Хотите, бесплатно перезвоним вам за 35 сек?",
				"description":"Мы поможем с поиском на сайте и ответим на все ваши вопросы!"
			},
			"exit":{
				"title":"Вы были у нас на сайте %staytime%!",
				"description":"Не нашли, что искали? Хотите, вам перезвоним за 35 сек?"
			},
			"wait":{
				"title":"Хотите, бесплатно перезвоним вам за 35 сек.?",
				"description":"Мы поможем с поиском на сайте и ответим на все ваши вопросы!"
			},
			"return":{
				"title":"Вы посетили нас %counter% раза. Рады вас видеть снова!",
				"description":"Мы готовы перезвонить за 35 сек. и ответить на все ваши вопросы в любой момент!"
			},
			"click":{
				"title":"Хотите, перезвоним вам за 35 сек.?",
				"description":"Мы поможем с поиском на сайте и ответим на все ваши вопросы!"
			},
			"final":{
				"title":"Мы успели вам позвонить?",
				"success":"Да, успели!",
				"fail":"Нет, не успели!",
				"message":"Будет отправлено SMS руководителю.",
				"send":"Отчет отправлен."
			},
			"offline":{
				"title":"К сожалению, мы сейчас не в офисе :(",
				"description":"Давайте, перезвоним вам %calltime%",
				"final":"Спасибо, мы вам позвоним в указанное время!"
			},
			"region":{
				"select":"Выберите ближайший к вам филиал: %regionselect%"
			},
			"button":{
				"select":"Жду звонка",
				"hover":"Бесплатный\nзвонок\n"
			},
			"days":{
				"sunday":"Воскресенье",
				"monday":"Понедельник",
				"tuesday":"Вторник",
				"wednesday":"Среда",
				"thursday":"Четверг",
				"friday":"Пятница",
				"saturday":"Суббота"
			}
		},
		"window_position":"TOP_RIGHT",
		"window_cover":1,
		"window_style":{
			"widget_background":"rgba(0, 0, 0, 0.8)",
			"widget_color":"#ffffff",
			"button_background":"rgba(68, 187, 110, 0.8)",
			"button_hover_background":"rgba(68, 187, 110, 0.8)",
			"button_color":"#ffffff",
			"button_hover_color":"#ffffff",
			"phone_background":"rgba(0, 0, 0, 0.8)",
			"phone_color":"#ffffff",
			"phone_border":"transparent",
			"opener_text_color":"#ffffff",
			"opener_background":"rgb(68, 187, 110)",
			"opener_hover_background":"rgb(68, 187, 110)",
			"opener_outer_border":"#9abfd3",
			"opener_hover_outer_border":"#9abfd3",
			"opener_inner_border":"#68cafa",
			"opener_hover_inner_border":"#b7de69"
		},
		"call_time":35,
		"phone_prefix":7,
		"algoritms":{
			"onenter":{
				"enable":0,
				"time":30
			},
			"onexit":{
				"enable":1,
				"time":30
			},
			"onwait":{
				"enable":0,
				"time":90
			},
			"onreturn":{
				"enable":0
			}
		},
		"api_enable":0,
		"api_callback":"",
		"api_callback_code":"",
		"api_algoritm_code":"",
		"api_button_selector":"",
		"api_css_code":"",
		"api_js_code":"",
		"tracking_google_target":"callback",
		"tracking_yandex_target":"callback",
		"tracking_google_enable":0,
		"button_drag":1,
		"button_text_show":0,
		"copyright":0,
		"demo":0,
		"tracking_yandex_enable":0,
		"deleted_at":null,
		"lang":{
			"days":{
				"sunday":"Воскресенье",
				"monday":"Понедельник",
				"tuesday":"Вторник",
				"wednesday":"Среда",
				"thursday":"Четверг",
				"friday":"Пятница",
				"saturday":"Суббота"
			}
		},
		"key":"",
		"widget_id":"",
		"manager_region_enable":0,
		"regions":[],
		"widget_date":{
			"utc":"",
			"date":"",
			"hour":"",
			"days":["sunday","monday","tuesday","wednesday","thursday","friday","saturday"],
			"offset":18000,
			"day_of_week":"",
			"day_name":""
		},
		"ip":"",
		"balance":1,
		"working":1,
		"report_analytic":1, // оценка
		"referal_url":"",
		"prefixes":[7,null],
		"apiPath":"/wp-admin/admin-ajax.php",
		"cdnPath":"/wp-content/callback",
		"build":""
	},
	PozvonimcomLoader=function(d,s,u,p){
		"use strict";
		var o=d.createElement(s);
		p=d.getElementsByTagName(s)[0];
		o.async=1;
		o.src=u;
		o.charset="UTF-8";
		p.parentNode.insertBefore(o,p);
	};
	PozvonimcomLoader(document,'script','/wp-content/callback/callback.js');
}