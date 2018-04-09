<?php	



/**
 * wpsc pagination
 * It is intended to move some of this functionality to a paging class
 * so that paging functionality can easily be created for multiple uses.
 */



/**
 * wpsc current_page
 * @return (int) The current page number
 */
function wpsc_current_page() {
	
	global $wpsc_query;
	
	$current_page = 1;
	
	if ( $wpsc_query->query_vars['page'] > 1) {
		$current_page = $wpsc_query->query_vars['page'];
	}
	
	return $current_page;
	
}

/**
 * wpsc showing products
 * Displays the number of page showing in the form "10 to 20".
 * If only on page is being display it will return the total amount of products showing.
 * @return (string) Number of products showing
 */
function wpsc_showing_products() {
	
	global $wpsc_query;
				
	// If we are using pages...
	if ( ( get_option( 'use_pagination' ) == 1 ) ) {
		$products_per_page = $wpsc_query->query_vars['number_per_page'];
		if ( $wpsc_query->query_vars['page'] > 0 ) {
			$startnum = ( $wpsc_query->query_vars['page'] - 1 ) * $products_per_page;
		} else {
			$startnum = 0;
		}
		return ( $startnum + 1 ) . ' to ' . ( $startnum + wpsc_product_count() );
	}
	
	return wpsc_total_product_count();
	
}

/**
 * wpsc showing products page
 * Displays the number of page showing in the form "5 of 10".
 * @return (string) Number of pages showing.
 */
function wpsc_showing_products_page() {
	
	global $wpsc_query;
	
	$output = $wpsc_query->page_count;
	$current_page = wpsc_current_page();
	
	return $current_page . ' of ' . $output;
	
}


function my_get_page_url($page_number){

	global $wpsc_query;

	if($wpsc_query->is_category){
		$page_url = wpsc_category_url($wpsc_query->category).'page/'.$page_number.'/';
	}
	
	if($wpsc_query->is_search){
		$page_url = wpsc_category_url($wpsc_query->category).'page/'.$page_number.'/';
		$page_url = wpsc_product_search_url($page_url);
	}

	if($wpsc_query->is_device){
		$page_url = cs_get_device_url($wpsc_query->query['device_id'], $wpsc_query->query['type'], $page_number);
	}

	if($wpsc_query->is_cluster){
		$page_url = cs_get_cluster_url($wpsc_query->query['cluster_id'], $page_number);
	}

	return $page_url;
	
}

/**
 * wpsc pagination
 * Page numbers as links - limit by passing the $show parameter.
 * @param $show (int) Number of pages to show, -1 shows all. Zero will be used to show default setting in a future release.
 * @return (string) Linked page numbers.
 */
function wpsc_pagination() {
	
	global $wpsc_query;
	
	$html = '';
	
	$current_page = wpsc_current_page();
	$last   = $wpsc_query->page_count;
	
	$neig_links = 1; // how many pages besides current
	
	$start = ($current_page - $neig_links > 0) ? $current_page - $neig_links : 1;
	$end = ($current_page + $neig_links < $last) ? $current_page + $neig_links : $last;

	if($current_page == 1){
		//$html .= '<span><</span>';
	} else {
		$html .= '<a href="' . my_get_page_url($current_page - 1) . '"><</a>';
	}
	
    if ( $start > 1 ) {
        $html .= '<a href="' . my_get_page_url(1) . '">1</a>';
        if($start > 2) $html .= '<span>...</span>';
    }
	
	for ( $i = $start ; $i <= $end; $i++ ) {		
		if ($current_page == $i) {
			$html .= '<span class="selected">' . $i . '</span> ';
		} else {
			$html .= '<a href="' . my_get_page_url($i) . '">' . $i . '</a> ';
		}
	}

    if ( $end < $last ) {
        if($last - $end > 1) $html .= '<span>...</span>';
        $html .= '<a href="' . my_get_page_url($last) . '">' . $last . '</a> ';
    }	
	
	if($current_page == $last){
		//$html .= '<span>></span>';
	} else {
		$html .= '<a href="' . my_get_page_url($current_page + 1) . '">></a>';
	}
	
	return $html;
	
}

/**
 * wpsc product search url
 * Add product_search parameter if required.
 * @param $url (string) URL.
 * @return (string) URL.
 */
function wpsc_product_search_url( $url ) {
			
	if ( isset( $_GET['product_search'] ) ) {
		
		// save the product search GET string
		
		if ( strrpos( $url, '?') ) {
			$url .= '&product_search=' . $_GET['product_search'];
		} else {
			$url .= '?product_search=' . $_GET['product_search'];
		}
	}

	if ( isset( $_GET['device_id'] ) ) {
		
		// save the device id GET
		
		if ( strrpos( $url, '?') ) {
			$url .= '&device_id=' . $_GET['device_id'];
		} else {
			$url .= '?device_id=' . $_GET['device_id'];
		}

		if ( isset( $_GET['type'] ) ) {
			if ( strrpos( $url, '?') ) {
				$url .= '&type=' . $_GET['type'];
			} else {
				$url .= '?type=' . $_GET['type'];
			}
		}
	}

	if ( isset( $_GET['cluster_id'] ) ) {
		
		// save the cluster id GET
		
		if ( strrpos( $url, '?') ) {
			$url .= '&cluster_id=' . $_GET['cluster_id'];
		} else {
			$url .= '?cluster_id=' . $_GET['cluster_id'];
		}

		if ( isset( $_GET['type'] ) ) {
			if ( strrpos( $url, '?') ) {
				$url .= '&type=' . $_GET['type'];
			} else {
				$url .= '?type=' . $_GET['type'];
			}
		}
	}

	return $url;

}

/**
 * wpsc adjacent products url
 * URL for the next or previous page of products on a category or group page.
 * @param $n (int) Page number.
 * @return (string) URL for the adjacent products page link.
 */
function wpsc_adjacent_products_url( $n ) {
	
	global $wpsc_query;
	
	$current_page = wpsc_current_page();
	
	$n = $current_page + $n;
	
	if ( $n < 1 || $n > $wpsc_query->page_count ) {
		return;
	}
	
	while ( wpsc_have_pages() ) : wpsc_the_page();
		if ( wpsc_page_number() == $n ) {
			$url = wpsc_page_url();
			$url = wpsc_product_search_url( $url );
			$wpsc_query->rewind_pages();
			return $url;
		}
	endwhile;
	
	$wpsc_query->rewind_pages();
	
	return;
	
}

/**
 * wpsc next products link
 * Links to the next page of products on a category or group page.
 * @param $text (string) Link text.
 * @param $show_disabled (bool) Show unlinked text if last page.
 * @return (string) Next page link or text.
 */
function wpsc_next_products_link( $text = 'Next', $show_disabled = false ) {
	
	$page_url = wpsc_adjacent_products_url( 1 );
	
	if ( $page_url ) {
		return '<a href="' . $page_url . '">' . $text . '</a>';
	}
	
	if ( $show_disabled ) {
		return '<span class="disabled">' . $text . '</span>';
	}
	
	return;
	
}

/**
 * wpsc previous products link
 * Links to the previous page of products on a category or group page.
 * @param $text (string) Link text.
 * @param $show_disabled (bool) Show unlinked text if first page.
 * @return (string) Previous page link or text.
 */
function wpsc_previous_products_link( $text = 'Previous', $show_disabled = false ) {
	
	$page_url = wpsc_adjacent_products_url( -1 );
	
	if ( $page_url ) {
		return '<a href="' . $page_url . '">' . $text . '</a>';
	}
	
	if ( $show_disabled ) {
		return '<span class="disabled">' . $text . '</span>';
	}
	
	return;
	
}

/**
 * wpsc first products link
 * Links to the first page of products on a category or group page.
 * @param $text (string) Link text.
 * @param $show_disabled (bool) Show unlinked text if last page.
 * @return (string) First page link or text.
 */
function wpsc_first_products_link( $text = 'First', $show_disabled = false ) {
	
	global $wpsc_query;
	
	$page_url = '';
	
	while ( wpsc_have_pages() ) : wpsc_the_page();
		$page_url = wpsc_page_url();
		break;
	endwhile;
	
	$wpsc_query->rewind_pages();
	
	$page_url = wpsc_product_search_url( $page_url );
	
	if ( $page_url && wpsc_current_page() > 1 ) {
		return '<a title="Перейти на первую страницу" href="' . $page_url . '">' . $text . '</a>';
	}
	
	if ( $show_disabled ) {
		return '<span>' . $text . '</span>';
	}
	
	return;
	
}

/**
 * wpsc last products link
 * Links to the last page of products on a category or group page.
 * @param $text (string) Link text.
 * @param $show_disabled (bool) Show unlinked text if first page.
 * @return (string) Last page link or text.
 */
function wpsc_last_products_link( $text = 'Last', $show_disabled = false ) {
	
	global $wpsc_query;
	
	$page_url = '';
	
	while ( wpsc_have_pages() ) : wpsc_the_page();
		$page_url = wpsc_page_url();
	endwhile;
	
	$wpsc_query->rewind_pages();
	
	$page_url = wpsc_product_search_url( $page_url );
	
	if ( $page_url && wpsc_current_page() < $wpsc_query->page_count ) {
		return '<a title="Перейти на последнюю страницу" href="' . $page_url . '">' . $text . '</a>';
	}
	
	if ( $show_disabled ) {
		return '<span>' . $text . '</span>';
	}
	
	return;
	
}



?>