<?php
/** 
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи, язык WordPress и ABSPATH. Дополнительную информацию можно найти
 * на странице {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется сценарием создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения.
 *
 * @package WordPress
 */

// This sets the admin panel to 512M because admin_memory_limit is set to whatever value is in WP_MAX_MEMORY_LIMIT in wp-admin/admin.php
define('WP_MEMORY_LIMIT', '256M');
define('WP_MAX_MEMORY_LIMIT', '512M'); 
 
// ** Настройки MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
define('DB_NAME', 'wp_new');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль пользователя MySQL */
define('DB_PASSWORD', 'pogba');

/** Адрес сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных при создании таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи для аутентификации.
 *
 * Смените значение каждого ключа на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется снова авторизоваться.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',        'JY|%QPKrEBQA-XW6R0+B?p,8l%1M|3x|.J$m+-%{s4oSiK|1N?`65(j[xjrRHFQ~');
define('SECURE_AUTH_KEY', 'U~~g|*Gg*lT.3-M@* Lf,D2}!cWs}JKi[+Bl[R#Zb]W{T>eE=AQy7[=I}aUX.VPY');
define('LOGGED_IN_KEY',   ']@(:d?hVojSuM+aL AwjH==5L.n5I{D|~a@ojlV5K+VS+YQBAe-!-NRc4O,UasXj');
define('NONCE_KEY',       ';jgl.[21{F7#/Sf5rc-8SUqnxgD`*(,d<^ o(0g81,ds=- Hjt)Q!*DH1AdNEvy$');
/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько блогов в одну базу данных, если вы будете использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Язык локализации WordPress, по умолчанию английский.
 *
 * Измените этот параметр, чтобы настроить локализацию. Соответствующий MO-файл
 * для выбранного языка должен быть установлен в wp-content/languages.
 */
 define ('WPLANG', 'ru_RU');
define('WP_DEBUG', false);

/* reduce revisions */
define('AUTOSAVE_INTERVAL', 180 ); // Default value is 60 seconds.
define('WP_POST_REVISIONS', 5); // Number of revisions to save.

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');

?>
