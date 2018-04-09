<?php
class my_shipping {
	
	var $internal_name, $name, $product_id;
	
	function my_shipping() {
		$this->internal_name = "my_shipping";
		$this->name = "My Shipping";
		$this->is_external = false;
		$this->product_id = null;
		return true;
	}
	
	function getId() {
	}
	
	function setId($id) {
	}
	
	function getName() {
		return $this->name;
	}
	
	function getInternalName() {
		return $this->internal_name;
	}
	
	function getForm() {
	}
	
	function submit_form() {
	}
	
	function makeQuery($cart_total, $destination_id){
		
		global $wpdb;

		$sql = $wpdb->prepare("
			SELECT IFNULL(p.price, rg.shipping_cost) as shipping_cost, rg.shipping_cost_product_id, m.name as shipping_method_name
			FROM shipping_des_met_rat dmr
			LEFT JOIN shipping_rate_groups rg ON dmr.rate_group = rg.`group`
			LEFT JOIN shipping_methods m ON dmr.method = m.id
			LEFT JOIN shipping_destinations d ON dmr.destination = d.id
			LEFT JOIN wp_wpsc_product_list p ON rg.shipping_cost_product_id = p.id
			WHERE dmr.destination = %d AND rg.cart_total <= %f
			ORDER BY rg.cart_total DESC
			LIMIT 1
			", 
			$destination_id,
			$cart_total			
		);
		
		$result = $wpdb->get_row($sql, ARRAY_A);
		
		if($wpdb->num_rows == 0) {
			$result = null;
		}

		return $result;
		
	}
	
	function getQuotes($cart_total, $destination_id) {
		
		//global $wpsc_cart;
		
		/*
		if(is_object($wpsc_cart)) {			
			$cart_total = wpsc_cart_subtotal(false);
		} else {
			$cart_total = 0;
		}
		*/
		
		//$result_arr = $this->makeQuery($cart_total, $wpsc_cart->my_shipping_destination['id']);
		$result_arr = $this->makeQuery($cart_total, $destination_id);
		
		if($result_arr === null) {
			$shipping_cost = null;
			$this->product_id = null;
		} else {
			$shipping_cost = $result_arr['shipping_cost'];
			$this->product_id = $result_arr['shipping_cost_product_id'];
		}
		
		return array('pickup' => 0, 'delivery' => $shipping_cost); // можно возвращать несколько option
		
	}

	function getQuote($cart_total, $destination_id) {
		return $this->getQuotes($cart_total, $destination_id);
	}
	
	function get_item_shipping( &$cart_item ) {
		return 0;
	}
	
	function getPriceQuote($cart_total, $destination_id){

		//global $wpsc_cart;
	
		//$result_arr = $this->makeQuery($cart_total, $wpsc_cart->my_shipping_destination['id']);
		$result_arr = $this->makeQuery($cart_total, $destination_id);
		
		if($result_arr === null) {
			$result = null;
		} else {
			$result = $result_arr['shipping_cost'];
		}
		
		return $result;
		
	}	

	function getPriceMethodQuote($cart_total, $destination_id){
		return $this->makeQuery($cart_total, $destination_id);	// array или null
	}

	function getShippingMethods($destination_id){
		
		global $wpdb;
		
		$result_arr = $wpdb->get_row($wpdb->prepare("SELECT m.name, m.internal_service FROM shipping_methods m LEFT JOIN shipping_des_met_rat dmr ON m.id = dmr.method WHERE dmr.destination = %d LIMIT 1", $destination_id), ARRAY_A);
			
		if($wpdb->num_rows == 0){
			return null;
		} else {
			return $result_arr;
		}
		
	}

	function getMinCartForDelivery($destination_id){
		
		global $wpdb;
		
		$result = $wpdb->get_var(
			$wpdb->prepare(
				"
				SELECT rg.cart_total
				FROM shipping_des_met_rat dmr
				LEFT JOIN shipping_rate_groups rg ON dmr.rate_group = rg.`group`
				LEFT JOIN shipping_methods m ON dmr.method = m.id
				LEFT JOIN shipping_destinations d ON dmr.destination = d.id
				WHERE dmr.destination = %d
				ORDER BY rg.cart_total ASC
				LIMIT 1
				", 
				$destination_id
			)
		);
			
		return (float)$result;		
			
	}
	
	function getMinCartForFreeDelivery($destination_id){
		
		global $wpdb;
		
		$result = $wpdb->get_var(
			$wpdb->prepare(
				"
				SELECT rg.cart_total
				FROM shipping_des_met_rat dmr
				LEFT JOIN shipping_rate_groups rg ON dmr.rate_group = rg.`group`
				LEFT JOIN shipping_methods m ON dmr.method = m.id
				LEFT JOIN shipping_destinations d ON dmr.destination = d.id
				WHERE dmr.destination = %d AND rg.shipping_cost = 0
				ORDER BY rg.cart_total DESC
				LIMIT 1
				", 
				$destination_id
			)
		);
			
		return (float)$result;		
			
	}
	
}

$my_shipping = new my_shipping();
$wpsc_shipping_modules[$my_shipping->getInternalName()] = $my_shipping;

?>