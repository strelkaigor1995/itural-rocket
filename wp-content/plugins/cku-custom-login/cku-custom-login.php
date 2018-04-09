<?php
/*
Plugin Name: CKU Custom Login
Plugin URI:
Description: Специально для &laquo;ИТ Сервис&raquo;
Author: ]aka[
Version: 0.1
Author URI:
*/ 

function change_wp_login_url() {

    echo site_url();
	
}

function change_wp_login_title() {

    echo 'ИТ Сервис, центр компьютерных услуг';
	
}

function empty_string() {

    echo '';
	
}

add_filter('login_headerurl', 'change_wp_login_url');
add_filter('login_headertitle', 'change_wp_login_title');
add_filter('admin_footer_text', 'empty_string');

?>