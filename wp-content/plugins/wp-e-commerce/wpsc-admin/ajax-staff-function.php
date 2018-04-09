<?php
/**
 * WPSC Product ajax staff
 *
 * @package wp-e-commerce
 * @since 3.7
 */

$id = $_POST['id'];

function wpsc_admin_producer_dropdown_staff_ajax($id) {
	global $wpdb;

	$table_name = "compat_families";
	$sql = "SELECT * FROM compat_families";
	$values = $wpdb->get_results($sql, ARRAY_A);
	return $id;
}

$res = wpsc_admin_producer_dropdown_staff_ajax($id);

echo json_encode($res);