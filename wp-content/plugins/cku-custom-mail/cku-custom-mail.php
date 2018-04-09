<?php
/*
Plugin Name: CKU Custom Mail
Plugin URI:
Description: Для форума. Специально для &laquo;ИТ Сервис&raquo;
Author: ]aka[
Version: 0.1
Author URI:
*/ 

function change_wp_mail_from() {
    return 'noreply@itural.ru';
}

function change_wp_mail_from_name() {
    return 'ИТ Сервис, сайт';
}

add_filter('wp_mail_from','change_wp_mail_from',0);
add_filter('wp_mail_from_name','change_wp_mail_from_name',0);

?>
