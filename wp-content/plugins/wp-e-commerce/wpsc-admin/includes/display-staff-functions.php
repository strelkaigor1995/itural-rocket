<?php
/**
 * WPSC Product form generation functions
 *
 * @package wp-e-commerce
 * @since 3.7
 */

//$closed_postboxes = (array)get_usermeta( $current_user->ID, 'editproduct');
$variations_processor = new nzshpcrt_variations;


$wpsc_product_defaults =array (
  'id' => '0',
  'name' => '',
  'description' => '',
  'additional_description' => '',
  'price' => '0.00',
  'weight' => '0',
  'weight_unit' => 'pound',
  'pnp' => '0.00',
  'international_pnp' => '0.00',
  'file' => '0',
  'image' => '',
  'category' => '0',
  'brand' => '0',
  'quantity_limited' => '0',
  'quantity' => '0',
  'special' => '0',
  'special_price' => '',
  'display_frontpage' => '0',
  'notax' => '0',
  'publish' => '1',
  'active' => '1',
  'donation' => '0',
  'no_shipping' => '0',
  'thumbnail_image' => '',
  'thumbnail_state' => '1',
  'meta' => 
  array (
    'external_link' => NULL,
    'merchant_notes' => NULL,
    'sku' => NULL,
    'engrave' => '0',
    'can_have_uploaded_image' => '0',
    'table_rate_price' => 
    array (
      'quantity' => 
      array (
        0 => '',
      ),
      'table_price' => 
      array (
        0 => '',
      ),
    ),
  ),
);



function wpsc_display_product_form_staff ($product_id = 0) {
  
  global $wpdb, $wpsc_product_defaults;
  
  $product_id = absint($product_id);
  
	//$variations_processor = new nzshpcrt_variations;
  if($product_id > 0) {

		$sql = "SELECT c_m.maker 		AS maker,
					   c_f.family 		AS family,
					   c_d.name 		AS name, 
					   c_d.id 			AS id,
					   c_d.name 		AS name,  
					   c_d.image 		AS image, 
					   c_d.description 	AS description

		 		FROM compat_devices 	AS c_d,
		 		 	 compat_families 	AS c_f, 
		 		 	 compat_makers 		AS c_m

		 		WHERE c_d.family_id = c_f.id 
		 		AND c_m.id 			= c_f.maker_id	 
		 		AND c_d.active 		= 1
		 		AND c_d.id 	= {$product_id}

				ORDER BY c_m.maker ASC
				LIMIT 1";

		$product_data = $wpdb->get_row($sql, ARRAY_A);
		//$product_data = $wpdb->get_row("SELECT * FROM compat_devices WHERE `id`='{$product_id}' LIMIT 1",ARRAY_A);
		
  } else {
    if(isset($_SESSION['wpsc_failed_product_post_data']) && (count($_SESSION['wpsc_failed_product_post_data']) > 0 )) {
			$product_data = array_merge($wpsc_product_defaults, $_SESSION['wpsc_failed_product_post_data']);
			$_SESSION['wpsc_failed_product_post_data'] = null;
    } else {
			$product_data = $wpsc_product_defaults;
		}
  }
  
	$product_data = apply_filters('wpsc_display_product_form_get', $product_data);
  
	$current_user = wp_get_current_user();
  
  // we put the closed postboxes array into the product data to propagate it to each form without having it global.
  $product_data['closed_postboxes'] = (array)get_usermeta( $current_user->ID, 'closedpostboxes_store_page_wpsc-edit-products');
  $product_data['hidden_postboxes'] = (array)get_usermeta( $current_user->ID, 'metaboxhidden_store_page_wpsc-edit-products');
  
  //exit(var_dump(count($product_data)));
  
  if(count($product_data) > 0) {
		wpsc_product_basic_details_form_staff($product_data);
  }
}
 
function wpsc_product_basic_details_form_staff(&$product_data) {
  global $wpdb,$nzshpcrt_imagesize_info;
	
  ?>
 <h3 class='form_heading'>

 <?php
  if($product_data['id'] > 0) {
		echo __('Edit Product', 'wpsc');
	} else {
		echo __('Add Product', 'wpsc');
	} 
	?>
</h3>

	<div>
    <table class='product_editform' >
    	<tr>
			<td colspan='2' class='itemfirstcol'>  
			<div style='width:470px'>
    			<label for="wpsc_product_name">Наименование:</label>
				<div>
					<p style="font-size: 20px;
    						  font-weight: bold;">
    						  <?php echo $product_data['maker']." ".$product_data['family']." ".$product_data['name']; ?>
    				</p>
				</div>
			</div>
				<div style='clear:both; height: 0px; margin-bottom: 15px;'></div>
			</td>
      </tr>
		<tr>
			<td colspan='2'>
				<label>Описание:</label>
				<div id="<?php /*echo user_can_richedit() ? 'postdivrich' : 'postdiv';*/ echo 'postdiv'; ?>" class="postarea" >
			 <?php
					wpsc_the_editor_staff($product_data['description'], 'content', '', false);
			 ?>
			 </div>
			</td>
		</tr>
		<tr>
			<td colspan='2'>
				<h3>Загрузить картинку:</h3>
					<input type="file" name="my_image_upload" id="my_image_upload"  multiple="false" />
					<input type="hidden" name="post_id" id="post_id" value="<?php echo $product_data['id']; ?>" />
					<?php wp_nonce_field( 'my_image_upload', 'my_image_upload_nonce' ); ?>
			</td>
		</tr>
		<tr>
			<td colspan='2'>
					<?php if(!empty($product_data['image'])): ?>
						<?php $img_staff_path = home_url(). '/wp-content/plugins/wp-e-commerce/images/staff/'; ?>
						<img title='Drag to a new position' src='<?php echo $img_staff_path.$product_data['image']; ?>'
							 alt='<?php echo $product_data['name']; ?>' width='350' height='300' />	 
					<?php endif; ?>	
			</td>
		</tr>
	
		</table>
	</div>

	<input type='hidden' name='product_id' id='product_id' value='<?php echo $product_data['id']; ?>' />	 
	
	<input class='button-primary'	
		   style='float:left;'
		   type='submit' 
		   name='staff_submit' 
		   value='<?php if($product_data['id'] > 0) { 	_e('Update Product', 'wpsc'); } 
		   				else {	_e('Add New Product', 'wpsc');	} ?>' />
	<!-- &nbsp;
	<a class='submitdelete delete_button' title='<?php echo attribute_escape(__('Delete this product')); ?>' href='<?php echo wp_nonce_url("page.php?wpsc_admin_action=delete_product&amp;product={$product_data['id']}", 'delete_product_' . $product_data['id']); ?>' onclick="if ( confirm(' <?php echo js_escape(sprintf( __("You are about to delete this product '%s'\n 'Cancel' to stop, 'OK' to delete."), $product_data['name'] )) ?>') ) { return true;}return false;"><?php _e('Delete') ?></a>
	-->
	<?php
  }


function wpsc_product_category_and_tag_forms_staff($product_data=''){

	return ''; // we don't need categories in admin panel, we'll get it from 1C :)

	global $closed_postboxes, $wpdb, $variations_processor;
	
	$output = '';
	if ($product_data == 'empty') {
		$display = "style='visibility:hidden;'";
	}
	$output .= "<div id='wpsc_product_category_and_tag_forms' class=' postbox ".((array_search('wpsc_product_category_and_tag_forms', $product_data['closed_postboxes']) !== false) ? 'closed' : '')."' ".((array_search('wpsc_product_category_and_tag_forms', $product_data['hidden_postboxes']) !== false) ? 'style="display: none;"' : '')." >";

    if (IS_WP27) {
        $output .= "<h3 class='hndle'>";
    } else {
        $output .= "<h3>
	    <a class='togbox'>+</a>";
    }
    $output .= __('Categories and Tags', 'wpsc');
    if ($product_data != '') {
			if(function_exists('wp_insert_term')) {
				$term_relationships = $wpdb->get_results("SELECT * FROM `{$wpdb->term_relationships}` WHERE object_id = '{$product_data['id']}'", ARRAY_A);
				//exit('HERE><pre>'.print_r($term_relationships,true).'</pre>');
				foreach ((array)$term_relationships as $term_relationship) {
					$tt_ids[] = $term_relationship['term_taxonomy_id'];
				}
				foreach ((array)$tt_ids as $tt_id) {
					$term_ids[] = $wpdb->get_var("SELECT `term_id` FROM `{$wpdb->term_taxonomy}` WHERE `term_taxonomy_id` = '{$tt_id}' AND `taxonomy` = 'product_tag' LIMIT 1");
				}
				foreach ((array)$term_ids as $term_id ) {
					if ($term_id != NULL){
						$tags[] = $wpdb->get_var("SELECT `name` FROM `{$wpdb->terms}` WHERE `term_id`='{$term_id}' LIMIT 1");
					}
				}
				$imtags = '';
				if ($tags != NULL){ 
					$imtags = implode(',', $tags);
				}
				//exit('HERE<pre>'.print_r($imtags,true).'</pre>');
			}
  	}
    $output .= "
	</h3>
    <div class='inside'>
    <table>";
    $output .= "
      <tr>
      <td class='itemfirstcol'>
				<span class='howto'>".__('Categories', 'wpsc')." </span>
				<div id='categorydiv' >";
					$search_sql = apply_filters('wpsc_product_category_and_tag_forms_group_search_sql', '');
					$categorisation_groups =  $wpdb->get_results("SELECT * FROM `".WPSC_TABLE_CATEGORISATION_GROUPS."` WHERE `active` IN ('1')".$search_sql, ARRAY_A);
					//exit('<pre>'.print_r($categorisation_groups, true).'</pre>');
						foreach((array)$categorisation_groups as $categorisation_group){
							$category_count = $wpdb->get_var("SELECT COUNT(*) FROM `".WPSC_TABLE_PRODUCT_CATEGORIES."` WHERE `group_id` IN ('{$categorisation_group['id']}')");
							if($category_count > 0) {
								$output .= "<p>";
								$category_group_name = str_replace("[categorisation]", $categorisation_group['name'], __('Select &quot;[categorisation]&quot;', 'wpsc'));
								$output .= "".$category_group_name.":<br />";
								$output .= "</p>";
								if ($product_data == '')
									$output .= wpsc_category_list_staff($categorisation_group['id'], false, 'add_', null, 0, 'name' );
								else 
									$output .= wpsc_category_list_staff($categorisation_group['id'], $product_data['id'], 'edit_', null, 0, 'name' );
								
							}
						}

     $output .= "
			</div>
     </td>
     <td class='itemfirstcol product_tags'>
				<span class='howto'> ".__('Product Tags', 'wpsc')."</span><br />
				<p id='jaxtag'>
					<label for='tags-input' class='hidden'>".__('Product Tags', 'wpsc')."</label>
					<input type='text' value='".$imtags."' tabindex='3' size='20' id='tags-input' class='tags-input' name='product_tags'/>
				<span class='howto'>".__('Separate tags with commas')."</span>
				</p>
				<div id='tagchecklist' onload='tag_update_quickclicks();'></div>

      </td>
      
    </tr>";
    
//				<p class='hide-if-no-js' id='tagcloud-link'><a href='#'>Choose from the most popular tags</a></p>
//       
//         <input type='text' class='text wpsc_tag greytext' value='Add new tag' name='product_tags' id='product_tag'>   
//         <input class='button' type='submit' value='Add' name='wpsc_add_new_tag' />
//         <br /><span class='small_italic greytext'>".__("Separate tags with commas")."</span><br />
//      
//         <p>".$imtags."</p>
//       	<input type='hidden' value='".$imtags."' name='wpsc_existing_tags' />
$output .= "
  </table>
 </div>
</div>";
$output = apply_filters('wpsc_product_category_and_tag_forms_output', $output);

return $output;

}
function wpsc_product_price_and_stock_forms_staff($product_data=''){

		return ''; // we don't need this
		
		global $closed_postboxes, $wpdb, $variations_processor;
		$table_rate_price = get_product_meta($product_data['id'], 'table_rate_price');
		$custom_tax = get_product_meta($product_data['id'], 'custom_tax');
		
		if ($product_data == 'empty') {
			$display = "style='visibility:hidden;'";
		}
		echo "<div id='wpsc_product_price_and_stock_forms' class='wpsc_product_price_and_stock_forms postbox ".((array_search('wpsc_product_price_and_stock_forms', $product_data['closed_postboxes']) !== false) ? 'closed' : '')."' ".((array_search('wpsc_product_price_and_stock_forms', $product_data['hidden_postboxes']) !== false) ? 'style="display: none;"' : '')." >";

		echo "<h3 class='hndle'>";

    echo __('Price and Stock Control', 'wpsc');
    echo "
	</h3>
    <div class='inside'>
    <table>
    ";
    
    echo "
    <tr>
       <td>
          <input id='add_form_tax' type='checkbox' name='notax' value='yes' ".(($product_data['notax'] == 1) ? 'checked="checked"' : '')."/>&nbsp;<label for='add_form_tax'>".sprintf(__('Do not include tax (tax is set in <a href="%s"/wp-admin/admin.php?page=wpsc-settings">shop config</a>)', 'wpsc'), get_option("siteurl"))."</label>
       </td>
    </tr>";
    echo "
    <tr>

       <td>
          <input id='add_form_donation' type='checkbox' name='donation' value='yes' ".(($product_data['donation'] == 1) ? 'checked="checked"' : '')." />&nbsp;<label for='add_form_donation'>".__('This is a donation, checking this box populates the donations widget.', 'wpsc')."</label>
       </td>
    </tr>";
    ?>
     <tr>
      <td>
        <input type='checkbox' value='1' name='table_rate_price' id='table_rate_price'  <?php echo ((count($table_rate_price['quantity']) > 0) ? 'checked=\'checked\'' : ''); ?> <?php echo ((wpsc_product_has_variations($product_data['id'])) ? 'disabled=\'disabled\'' : ''); ?> />
        <label for='table_rate_price'><?php echo __('Table Rate Price', 'wpsc'); ?></label>
        <div style='display:<?php echo ((($table_rate_price != '') &&  !wpsc_product_has_variations($product_data['id'])) ? 'block' : 'none'); ?>;' id='table_rate'>
          <a class='add_level' style='cursor:pointer;'>+ Add level</a><br />
          <table>
						<tr>
							<td><?php echo __('Quantity In Cart', 'wpsc'); ?></td>
							<td><?php echo __('Discounted Price', 'wpsc'); ?></td>
						</tr>
						<?php
						if(count($table_rate_price) > 0 ) {
							foreach((array)$table_rate_price['quantity'] as $key => $qty) {
								if($qty != '') {
									?>
									<tr>
										<td>
											<input type="text" size="10" value="<?php echo $qty; ?>" name="productmeta_values[table_rate_price][quantity][]"/> and above
										</td>
										<td>
											<input type="text" size="10" value="<?php echo $table_rate_price['table_price'][$key]; ?>" name="productmeta_values[table_rate_price][table_price][]" />
										</td>
										<td><img src="<?php echo WPSC_URL; ?>/images/cross.png" class="remove_line" /></td>
									</tr>
									<?php
								}
							}
						}
						?>						
						<tr>
							<td><input type='text' size='10' value='' name='productmeta_values[table_rate_price][quantity][]'/> and above</td>
							<td><input type='text' size='10' value='' name='productmeta_values[table_rate_price][table_price][]'/></td>
						</tr>
          </table>
        </div>
      </td>
    </tr>


    
     <tr>
      <td>
        <input type='checkbox' value='1' name='custom_tax' id='custom_tax_checkbox'  <?php echo ((is_numeric($custom_tax) > 0) ? 'checked=\'checked\'' : ''); ?>  />
        <label for='custom_tax_checkbox'><?php echo _e("Custom Tax Rate",'wpsc'); ?></label>
        <div style='display:<?php echo ((is_numeric($custom_tax)) ? 'block' : 'none'); ?>;' id='custom_tax'>
					<input type='text' size='10' value='<?php echo $custom_tax; ?>' name='productmeta_values[custom_tax]'/>
        </div>
      </td>
    </tr>


    
    <?php
    echo "
    <tr>
      <td style='width:430px;'>
      <input class='limited_stock_checkbox' id='add_form_quantity_limited' type='checkbox' value='yes' ".(($product_data['quantity_limited'] == 1) ? 'checked="checked"' : '')." name='quantity_limited'/>"; //onclick='hideelement(\"add_stock\")'
		echo "&nbsp;<label for='add_form_quantity_limited' class='small'>".__('I have a limited number of this item in stock. If the stock runs out, this product will not be available on the shop unless you untick this box or add more stock.', 'wpsc')."</label>";
	
		if ($product_data['id'] > 0){
				$variations_output = $variations_processor->variations_grid_view($product_data['id']); 
				
				if(wpsc_product_has_variations($product_data['id'])) {
						switch($product_data['quantity_limited']) {
							case 1:
							echo "            <div class='edit_stock' style='display: block;'>\n\r";
							break;
							
							default:
							echo "            <div class='edit_stock' style='display: none;'>\n\r";
							break;
						}						
						
						echo "<input class='stock_limit_quantity' name='quantity' style='display:none;' value='".$product_data['quantity']."' />";
						echo "<div style='font-size:9px; padding:5px;'><input type='checkbox' " . $unpublish_oos . " class='inform_when_oos' name='inform_when_oos' /> " . __('If this product runs out of stock set status to Unpublished & email site owner', 'wpsc') . "</div>";
						echo "</div>\n\r";
					} else {
						switch($product_data['quantity_limited']) {
							case 1:
							echo "            <div class='edit_stock' style='display: block;'>\n\r";
							break;
							
							default:
							echo "            <div class='edit_stock' style='display: none;'>\n\r";
							break;
						}
						echo "<p><strong class='wpsc_error'>" .__('Note: If you are using variations please ensure you populate the stock under "Variation Control"', 'wpsc')."</strong></p>";
						echo __('Stock Qty', 'wpsc') . " <input type='text' class='stock_limit_quantity' name='quantity' size='10' value='".$product_data['quantity']."' />";
						echo "<div style='font-size:9px; padding:5px;'><input type='checkbox' " . $unpublish_oos . " class='inform_when_oos' name='inform_when_oos' /> " . __('If this product runs out of stock set status to Unpublished & email site owner', 'wpsc') . "</div>";
						echo "              </div>\n\r";
					}
		} else {
						echo "
					<div style='display: none;' class='edit_stock'>
						"; 
						echo "<p><strong class='wpsc_error'>" .__('Note: If you are using variations please ensure you populate the stock under "Variation Control"', 'wpsc')."</strong></p>";
						echo __('Stock Qty', 'wpsc') . " <input type='text' name='quantity' value='0' size='10' />";
						echo "<div style='font-size:9px; padding:5px;'><input type='checkbox' class='inform_when_oos' name='inform_when_oos' /> " . __('If this product runs out of stock set status to Unpublished & email site owner', 'wpsc') . "</div>";
					echo "</div>";  
			}
	echo "
				
				</td>
			</tr>";
	echo "
		</table>
	</div>
</div>";

//return $output;

}

function wpsc_product_variation_forms_staff($product_data=''){

	return ''; // we don't need this

	global $closed_postboxes, $variations_processor;
	$siteurl = get_option('siteurl');
	$output='';
	if ($product_data == 'empty') {
		$display = "style='display:none;'";
	}
	?>
	
	<div id='wpsc_product_variation_forms' class='postbox <?php echo ((array_search('wpsc_product_variation_forms', $product_data['closed_postboxes']) !== false) ? 'closed' : '');	?>' <?php echo ((array_search('wpsc_product_variation_forms', $product_data['hidden_postboxes']) !== false) ? 'style="display: none;"' : ''); ?>>
		<h3 class='hndle'><?php echo __('Variation Control', 'wpsc'); ?></h3>
		
		<div class='inside'>
			<strong><?php echo __('Add Variation Set', 'wpsc'); ?></strong>
			<h4 class='product_action_link'><a target='_blank' href='admin.php?page=wpsc-edit-variations'><?php echo __('+ Add New Variations', 'wpsc'); ?></a></h4>
			<br />
			
			<?php 
			if ($product_data['id'] > 0) { ?>
				<div id='edit_product_variations'>
					<?php echo $variations_processor->list_variations($product_data['id']); ?>
				</div>
				<div id='edit_variations_container'>
					<?php echo $variations_processor->variations_grid_view($product_data['id']); ?>
				</div>
			<?php } else { ?>
					<div id='add_product_variations'>
						<?php echo $variations_processor->list_variations($product_data['id']); ?>
					</div>
					<div id='edit_variations_container'>
					</div>
			<?php
			} ?>
		</div>
	</div>
	<?php 
}

function wpsc_product_shipping_forms_staff($product_data=''){

	return ''; // we don't need this

	global $closed_postboxes;
	if ($product_data == 'empty') {
		$display = "style='display:none;'";
	}
	$output .= "<div class='postbox ".((array_search('wpsc_product_shipping_forms', $product_data['closed_postboxes']) !== false) ? 'closed' : '')."' ".((array_search('wpsc_product_shipping_forms', $product_data['hidden_postboxes']) !== false) ? 'style="display: none;"' : '')." id='wpsc_product_shipping_forms'>";

    	if (IS_WP27) {
    		$output .= "<h3 class='hndle'>";
    	} else {
    		$output .= "<h3>
			<a class='togbox'>+</a>";
    	}
		$output .= __('Shipping Details', 'wpsc');
		$output .= "
		</h3>
      <div class='inside'>
  <table>

  	  <!--USPS shipping changes-->
	<tr>
		<td>
			".__('Weight', 'wpsc')."
		</td>
		<td>
			<input type='text' size='5' name='weight' value='".$product_data['weight']."' />
			<select name='weight_unit'>
				<option value='pound' ". (($product_data['weight_unit'] == 'pound') ? 'selected="selected"' : '') .">Pounds</option>
				<option value='ounce' ". ((preg_match("/o(u)?nce/",$product_data['weight_unit'])) ? 'selected="selected"' : '') .">Ounces</option>
				<option value='gram' ". (($product_data['weight_unit'] == 'gram') ? 'selected="selected"' : '') .">Grams</option>
				<option value='kilogram' ". (($product_data['weight_unit'] == 'kilogram') ? 'selected="selected"' : '') .">Kilograms</option>
			</select>
		</td>
    </tr>
      <!--dimension-->
    <tr>
		<td>
			".__('Height', 'wpsc')."
		</td>
		<td>
			<input type='text' size='5' name='productmeta_values[dimensions][height]' value='".$product_data['meta']['dimensions']['height']."'>
			<select name='productmeta_values[dimensions][height_unit]'>
				<option value='in' ". (($product_data['meta']['dimensions']['height_unit'] == 'in') ? 'selected' : '') .">inches</option>
				<option value='cm' ". (($product_data['meta']['dimensions']['height_unit'] == 'cm') ? 'selected' : '') .">cm</option>
				<option value='meter' ". (($product_data['meta']['dimensions']['height_unit'] == 'meter') ? 'selected' : '') .">meter</option>			</select>
			</td>
			</tr>
			<tr>
		<td>
			".__('Width', 'wpsc')."
		</td>
		<td>
		<input type='text' size='5' name='productmeta_values[dimensions][width]' value='".$product_data['meta']['dimensions']['width']."'>
		<select name='productmeta_values[dimensions][width_unit]'>
				<option value='in' ". (($product_data['meta']['dimensions']['width_unit'] == 'in') ? 'selected' : '') .">inches</option>
				<option value='cm' ". (($product_data['meta']['dimensions']['width_unit'] == 'cm') ? 'selected' : '') .">cm</option>
				<option value='meter' ". (($product_data['meta']['dimensions']['width_unit'] == 'meter') ? 'selected' : '') .">meter</option>
			</select>
			</td>
			</tr>
			<tr>
		<td>
			".__('Length', 'wpsc')."
		</td>
		<td>
			<input type='text' size='5' name='productmeta_values[dimensions][length]' value='".$product_data['meta']['dimensions']['length']."'>
			<select name='productmeta_values[dimensions][length_unit]'>
				<option value='in' ". (($product_data['meta']['dimensions']['length_unit'] == 'in') ? 'selected' : '') .">inches</option>
				<option value='cm' ". (($product_data['meta']['dimensions']['length_unit'] == 'cm') ? 'selected' : '') .">cm</option>
				<option value='meter' ". (($product_data['meta']['dimensions']['length_unit'] == 'meter') ? 'selected' : '') .">meter</option>

			</select>
			</td>
			</tr>

    <!--//dimension-->


    <!--USPS shipping changes ends-->


    <!--USPS shipping changes ends-->

 
    <tr>
      <td colspan='2'>
      <strong>".__('Flat Rate Settings', 'wpsc')."</strong> 
      </td>
    </tr>
    <tr>
      <td>
      ".__('Local Shipping Fee', 'wpsc')." 
      </td>
      <td>
        <input type='text' size='10' name='pnp' value='".$product_data['pnp']."' />
      </td>
    </tr>
  
    <tr>
      <td>
      ".__('International Shipping Fee', 'wpsc')."
      </td>
      <td>
        <input type='text' size='10' name='international_pnp' value='".$product_data['international_pnp']."' />
      </td>
    </tr>
    <tr>
   		<td>
   		<br />
          <input id='add_form_no_shipping' type='checkbox' name='no_shipping' value='yes' ".(($product_data['no_shipping'] == 1) ? 'checked="checked"' : '')."/>&nbsp;<label for='add_form_no_shipping'>".__('Disregard Shipping for this product', 'wpsc')."</label>
       </td>
    </tr>
    </table></div></div>";
    
    return $output;
}


function wpsc_product_download_forms_staff($product_data='') {

	return ''; // we don't need this

	global $wpdb, $closed_postboxes;
	if ($product_data == 'empty') {
		$display = "style='display:none;'";
	}

	$output ='';
 	$upload_max = wpsc_get_max_upload_size();
 	$output .= "<div id='wpsc_product_download_forms' class='postbox ".((array_search('wpsc_product_download_forms', $product_data['closed_postboxes']) !== false) ? 'closed' : '')."' ".((array_search('wpsc_product_download_forms', $product_data['hidden_postboxes']) !== false) ? 'style="display: none;"' : '').">";
 	
	$output .= "<h3 class='hndle'>".__('Product Download', 'wpsc')."</h3>";
	$output .= "<div class='inside'>";
	
	$output .= "<h4>".__('Upload File', 'wpsc').":</h4>";
	$output .= "<input type='file' name='file' value='' /><br />".__('Max Upload Size', 'wpsc')." : <span>".$upload_max."</span><br /><br />";
	$output .= wpsc_select_product_file($product_data['id'])."<br />";
    
	if($product_data['file'] > 0) {
    	$output .= __('Preview File', 'wpsc').": ";
    	
    	$output .= "<a class='admin_download' href='index.php?admin_preview=true&product_id=".$product_data['id']."' ><img align='absmiddle' src='".WPSC_URL."/images/download.gif' alt='' title='' /><span>".__('Click to download', 'wpsc')."</span></a>";
		
    	$file_data = $wpdb->get_row("SELECT * FROM `".WPSC_TABLE_PRODUCT_FILES."` WHERE `id`='".$product_data['file']."' LIMIT 1",ARRAY_A);
    	if(($file_data != null) && (function_exists('listen_button'))) {
    	  $output .= "".listen_button($file_data['idhash'], $file_data['id'])."<br style='clear: both;' /><br />";
    	}
    }
	if(function_exists("make_mp3_preview") || function_exists("wpsc_media_player")) {    
    $output .="<h4>".__("Select an MP3 file to upload as a preview")."</h4>";
	
		$output .= "<input type='file' name='preview_file' value='' /><br />";
		$output .= "<br />";
	}
	$output .="</div></div>";
	return $output;
}

function wpsc_product_label_forms_staff() {
	global $closed_postboxes;
	?>
	<div id='wpsc_product_label_forms' class='postbox <?php echo ((array_search('wpsc_product_label_forms', $product_data['closed_postboxes']) !== false) ? 'closed' : ''); ?>'>
		<?php
    	if (function_exists('add_object_page')) {
    		echo "<h3 class='hndle'>";
    	} else {
    		echo "<h3>
		<a class='togbox'>+</a>";
    	}
    ?> 
		<?php echo __('Label Control', 'wpsc'); ?>
	</h3>
	<div class='inside'>
    <table>
    <tr>
      <td colspan='2'>
        <?php echo __('Add Label', 'wpsc'); ?> :
      	<a id='add_label'><?php echo __('Add Label', 'wpsc'); ?></a>
      </td>
    </tr> 
    <tr>
      <td colspan='2'>
      <div id="labels">
        <table>
        	<tr>
        		<td><?=__('Label', 'wpsc')?> :</td>
        		<td><input type="text" name="productmeta_values[labels][]"></td>
        	</tr>
        	<tr>
        		<td><?=__('Label Description', 'wpsc')?> :</td>
        		<td><textarea name="productmeta_values[labels_desc][]"></textarea></td>
        	</tr>
        	<tr>
        		<td><?=__('Life Number', 'wpsc')?> :</td>
        		<td><input type="text" name="productmeta_values[life_number][]"></td>
        	</tr>
        	<tr>
        		<td><?=__('Item Number', 'wpsc')?> :</td>
        		<td><input type="text" name="productmeta_values[item_number][]"></td>
        	</tr>
        	<tr>
        		<td><?=__('Product Code', 'wpsc')?> :</td>
        		<td><input type="text" name="productmeta_values[product_code][]"></td>
        	</tr>
        	<tr>
        		<td><?=__('PDF', 'wpsc')?> :</td>
        		<td><input type="file" name="pdf[]"></td>
        	</tr>
        </table>
        </div>
      </td>
    </tr> 
	</table></div></div>
	<?php
}


function edit_multiple_image_gallery_staff($product_data) {
	global $wpdb;
	$siteurl = get_option('siteurl');
	if($product_data['id'] > 0) {
		$main_image = $wpdb->get_row("SELECT `images`.* FROM `".WPSC_TABLE_PRODUCT_IMAGES."` AS `images` JOIN `".WPSC_TABLE_PRODUCT_LIST."` AS `product` ON `product`.`image` = `images`.`id`  WHERE `product`.`id` = '{$product_data['id']}' LIMIT 1", ARRAY_A);
	}
	$timestamp = time();
	?>
	<ul id="gallery_list" class="ui-sortable" style="position: relative;">
		<li class='first gallery_image' id='product_image_<?php echo $main_image['id']; ?>'>
			<input type='hidden' name='gallery_product_id[]' class='image-id' value='<?php echo $main_image['id']; ?>' />
			<div class='previewimage' id='gallery_image_<?php echo $main_image['id']; ?>'>
				<?php if ($main_image['image'] != '') { ?>
					<?php
					$image_data = getimagesize(WPSC_THUMBNAIL_DIR.$main_image['image']);
					?>
					<a id='extra_preview_link_0' href=''  title='' rel='product_extra_image_0'  >
					  <img class='previewimage' onclick='return false;' src='<?php echo WPSC_THUMBNAIL_URL.$main_image['image']; ?>' alt='<?php echo __('Preview', 'wpsc'); ?>' title='<?php echo __('Preview', 'wpsc'); ?>' />
					</a>
				<?php } ?>
				<?php
				echo wpsc_main_product_image_menu_staff($product_data['id']);
				?>
			</div>
		</li>
	<?php
	$num = 0;
	if(function_exists('gold_shpcrt_display_gallery') && ($product_data['id'] > 0)) {
    $values = $wpdb->get_results("SELECT * FROM `".WPSC_TABLE_PRODUCT_IMAGES."` WHERE `product_id` = '{$product_data['id']}' AND `id` NOT IN ('{$main_image['id']}') ORDER BY image_order ASC",ARRAY_A);
    
    //echo "<pre>".print_r($values,true)."</pre>";
    
    if($values != null) {
      foreach($values as $image) {
        if(function_exists("getimagesize")) {
          if($image['image'] != '') {
            $num++;
            $imagepath = WPSC_IMAGE_DIR . $image['image'];
						$image_data = @getimagesize(WPSC_IMAGE_DIR.$image['image']);
            ?>
            <li id="product_image_<?php echo $image['id']; ?>" class='gallery_image'>
							<input type='hidden' class='image-id'  name='gallery_image_id[]' value='<?php echo $image['id']; ?>' />
							<div class='previewimage' id='gallery_image_<?php echo $image['id']; ?>'>
							  <a id='extra_preview_link_<?php echo $image['id']; ?>' onclick='return false;' href='' rel='product_extra_image_<?php echo $image['id']; ?>' >
							    <img class='previewimage' src='<?php echo WPSC_IMAGE_URL.$image['image']; ?>' alt='<?php echo __('Preview', 'wpsc'); ?>' title='<?php echo __('Preview', 'wpsc'); ?>' />
							  </a>
								<img alt='-' class='deleteButton' src='<?php echo WPSC_URL; ?>/images/cross.png' />
							</div>
            </li>
            
					<?php
          }
        }
      }
    }
  }
  ?>
	</ul>
	<?php
  //return $output;
}


function wpsc_main_product_image_menu_staff($product_id) {
  global $wpdb;
  $thumbnail_state = 0;
	if($product_id > 0) {
		$main_image = $wpdb->get_row("SELECT `images`.*,  `product`.`thumbnail_state` FROM `".WPSC_TABLE_PRODUCT_IMAGES."` AS `images` JOIN `".WPSC_TABLE_PRODUCT_LIST."` AS `product` ON `product`.`image` = `images`.`id`  WHERE `product`.`id` = '{$product_id}' LIMIT 1", ARRAY_A);
		$thumbnail_state = $main_image['thumbnail_state'];
	} else {
		$thumbnail_state = 1;
	}
	$sendback = wp_get_referer();
	$presentation_link = add_query_arg('page','wpsc-settings', $sendback);
	$presentation_link = add_query_arg('tab','presentation#thumb_settings', $presentation_link);
	$thumbnail_image_height = get_product_meta($product_id, 'thumbnail_height');
	$thumbnail_image_width = get_product_meta($product_id, 'thumbnail_width');


	
// 	echo $thumbnail_image_height;
// 	echo "|";
// 	echo $thumbnail_image_width;
	ob_start();
	?>
	<div class='image_settings_box'>
		<div class='upper_settings_box'>
			<div class='upper_image'><img src='<?php echo WPSC_URL; ?>/images/pencil.png' alt='' /></div>
			<div class='upper_txt'><?php _e('Thumbnail Settings'); ?><a class='closeimagesettings'>X</a></div>
		</div>

		<div class='lower_settings_box'>
			<input type='hidden' id='current_thumbnail_image' name='current_thumbnail_image' value='S' />
			<ul>		

				<!--<li>
					<input type='radio' name='gallery_resize' value='1' id='gallery_resize1' class='image_resize' onclick='image_resize_extra_forms(this)' /> <label for='gallery_resize1'><?php echo __('use default size', 'wpsc'); ?>&nbsp;(<a href='<?php echo $presentation_link; ?>' title='<?php echo __('This is set on the Settings Page', 'wpsc'); ?>'><?php echo get_option('product_image_height'); ?>&times;<?php echo get_option('product_image_width'); ?>px</a>)
					</label>

				</li>-->
				
				<li>
					<input type='radio' <?php echo (($thumbnail_state != 2) ? "checked='checked'" : "") ;?> name='gallery_resize' value='0' id='gallery_resize0' class='image_resize' onclick='image_resize_extra_forms(this)' /> <label for='gallery_resize0'> <?php echo __('do not resize thumbnail image', 'wpsc'); ?></label><br />
				</li>
				
				<!--<li>
					<input type='radio' <?php echo (($thumbnail_state == 2) ? "checked='checked'" : "") ;?>  name='gallery_resize' value='2' id='gallery_resize2' class='image_resize' onclick='image_resize_extra_forms(this)' /> <label for='gallery_resize2'><?php echo __('use specific size', 'wpsc'); ?> </label>
					<div class='heightWidth image_resize_extra_forms' <?php echo (($thumbnail_state == 2) ? "style='display: block;'" : "") ;?>>
						<input id='gallery_image_width' type='text' size='4' name='gallery_width' value='<?php echo $thumbnail_image_width; ?>' /><label for='gallery_image_width'><?php echo __('px width', 'wpsc'); ?></label>
						<input id='gallery_image_height' type='text' size='4' name='gallery_height' value='<?php echo $thumbnail_image_height; ?>' /><label for='gallery_image_height'><?php echo __('px height', 'wpsc'); ?> </label>
					</div>
				</li>-->

				<!--<li>
					<input type='radio'  name='gallery_resize' value='3' id='gallery_resize3' class='image_resize'  onclick='image_resize_extra_forms(this)' /> <label for='gallery_resize3'> <?php echo __('use separate thumbnail', 'wpsc'); ?></label><br />
					<div class='browseThumb image_resize_extra_forms'>
						<input type='file' name='gallery_thumbnailImage' size='15' value='' />
					</div>
				</li>-->
				
				<!--<li>
					<a href='<?php echo htmlentities("admin.php?wpsc_admin_action=crop_image&imagename=".$main_image['image']."&imgheight=".$image_data[1]."&imgwidth=".$image_data[0]."&width=630&height=500&product_id=".$product_id); ?>' title='Crop Image' class='thickbox'>Crop This Image Using jCrop</a>

				</li>-->
				
				<li>
					<input type='submit' class='button-primary closeimagesettings' onclick='return false;' value='Закрыть' />
					<a href='#' class='delete_primary_image delete_button'>Удалить</a>
				</li>
				

			</ul>
		</div>
	</div>
	<a class='editButton'>Edit   <img src='<?php echo WPSC_URL; ?>/images/pencil.png' alt='' /></a>
	<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

  /**
	* Displays the category forms for adding and editing products
	* Recurses to generate the branched view for subcategories
	*/
function wpsc_category_list_staff($group_id, $product_id = '', $unique_id = '', $category_id = null, $iteration = 0, $orderby = 'id' ) {
  global $wpdb;
  if(is_numeric($category_id)) {
    $values = $wpdb->get_results("SELECT * FROM `".WPSC_TABLE_PRODUCT_CATEGORIES."` WHERE `group_id` IN ('$group_id') AND  `active`='1' AND `category_parent` = '$category_id'  ORDER BY `$orderby` ASC",ARRAY_A);
  } else {
    $values = $wpdb->get_results("SELECT * FROM `".WPSC_TABLE_PRODUCT_CATEGORIES."` WHERE `group_id` IN ('$group_id') AND  `active`='1' AND `category_parent` = '0'  ORDER BY `$orderby` ASC",ARRAY_A);
	}
	
	if($category_id < 1) {
		$output .= "<ul class='list:category categorychecklist form-no-clear'>\n\r";
	} elseif((count($values) >0) ){
		$output .= "<ul class='children'>\n\r";
	}
		
		
  foreach((array)$values as $option) {
    if(is_numeric($product_id) && ($product_id > 0)) {
      $category_assoc = $wpdb->get_row("SELECT * FROM `".WPSC_TABLE_ITEM_CATEGORY_ASSOC."` WHERE `product_id` IN('".$product_id."') AND `category_id` IN('".$option['id']."')  LIMIT 1",ARRAY_A); 
      //echo "<pre>".print_r($category_assoc,true)."</pre>";
      if(is_numeric($category_assoc['id']) && ($category_assoc['id'] > 0)) {
        $selected = "checked='checked'";
			}
		}
		
		$output .= "  <li id='category-".$option['id']."'>\n\r";
    $output .= "    <label class='selectit'><input  id='".$unique_id."category_form_".$option['id']."' type='checkbox' $selected name='category[]' value='".$option['id']."' /></label><label for='".$unique_id."category_form_".$option['id']."' class='greytext' >".stripslashes($option['name'])."</label>";
    $output .= wpsc_category_list_staff($group_id, $product_id, $unique_id, $option['id'], $iteration+1);
    
		$output .= "  </li>\n\r";
    
    $selected = "";
	}
	if((count($values) >0) ){
		$output .= "</ul>\n\r";
	}
  return $output;
}

/**
 * Slightly modified copy of the Wordpress the_editor function
 *
 *  We have to use a modified version because the wordpress one calls javascript that uses document.write
 *  When this javascript runs after being loaded through AJAX, it replaces the whole page.
 *
 * The amount of rows the text area will have for the content has to be between
 * 3 and 100 or will default at 12. There is only one option used for all users,
 * named 'default_post_edit_rows'.
 *
 * If the user can not use the rich editor (TinyMCE), then the switch button
 * will not be displayed.
 *
 * @since 3.7
 *
 * @param string $content Textarea content.
 * @param string $id HTML ID attribute value.
 * @param string $prev_id HTML ID name for switching back and forth between visual editors.
 * @param bool $media_buttons Optional, default is true. Whether to display media buttons.
 * @param int $tab_index Optional, default is 2. Tabindex for textarea element.
 */
function wpsc_the_editor_staff($content, $id = 'content', $prev_id = 'title', $media_buttons = true, $tab_index = 2) {
	
	$rows = get_option('default_post_edit_rows');
	
	
	
	if (($rows < 3) || ($rows > 100))
		$rows = 12;

	//exit(var_dump($rows)); // 12
	
	//if ( !current_user_can( 'upload_files' ) )
		$media_buttons = false; // disable buttons, вся эта куйня не работает
	
	//exit(var_dump($media_buttons)); // false

	//$richedit =  user_can_richedit();
	$richedit = false; // disable richedit, вся эта куйня не работает
	$class = '';
	
	//exit(var_dump($richedit)); // true

	if ( $richedit || $media_buttons ) { ?>
	<div id="editor-toolbar">
<?php
	if ( $richedit ) {
		$wp_default_editor = wp_default_editor(); ?>
		<div class="zerosize"><input accesskey="e" type="button" onclick="switchEditors.go('<?php echo $id; ?>')" /></div>
<?php	if ( 'html' == $wp_default_editor ) {
			add_filter('the_editor_content', 'wp_htmledit_pre'); ?>
			<a id="edButtonHTML" class="active hide-if-no-js" onclick="switchEditors.go('<?php echo $id; ?>', 'html');"><?php _e('HTML'); ?></a>
			<a id="edButtonPreview" class="hide-if-no-js" onclick="switchEditors.go('<?php echo $id; ?>', 'tinymce');"><?php _e('Visual'); ?></a>
<?php	} else {
			$class = " class='theEditor'";
			add_filter('the_editor_content', 'wp_richedit_pre'); ?>
			<a id="edButtonHTML" class="hide-if-no-js" onclick="switchEditors.go('<?php echo $id; ?>', 'html');"><?php _e('HTML'); ?></a>
			<a id="edButtonPreview" class="active hide-if-no-js" onclick="switchEditors.go('<?php echo $id; ?>', 'tinymce');"><?php _e('Visual'); ?></a>
<?php	}
	}

	if ( $media_buttons ) { ?>
		<div id="media-buttons" class="hide-if-no-js">
<?php	do_action( 'media_buttons' ); ?>
		</div>
<?php
	} ?>
	</div>
<?php
	}
?>
	<!--
	<div id="quicktags"><?php wp_print_scripts( 'quicktags' ); ?>
	  <div id="ed_toolbar">
		</div>
		<script type="text/javascript">wpsc_edToolbar()</script>
	</div>
	-->

<?php
	$the_editor = apply_filters('the_editor', "<div id='editorcontainer'><textarea rows='$rows'$class cols='40' name='$id' tabindex='$tab_index' id='$id'>%s</textarea></div>\n");
	$the_editor_content = apply_filters('the_editor_content', $content);

	printf($the_editor, $the_editor_content);

?>
	<!--
	<script type="text/javascript">
		edCanvas = document.getElementById('<?php echo $id; ?>');
	</script>
	-->
	
<?php
}
