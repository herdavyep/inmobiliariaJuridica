<?php

// Add custom fields in Property, Agent and What people say custom post type
add_action( 'add_meta_boxes', 'dreamvilla_mp_add_package_metaboxes' );
function dreamvilla_mp_add_package_metaboxes() {
	add_meta_box('add_property_package', 'Package Detail', 'dreamvilla_mp_add_property_package', 'package' );	
}

// Add custom field in property package custom post type
function dreamvilla_mp_add_property_package( $post ) {
	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'property_package_meta_box', 'property_package_meta_box_nonce' );

	$Package_Type			= get_post_meta( $post->ID, 'packagetype', true );

	$Package_Price_Label	= get_post_meta( $post->ID, 'packagepricelabel', true );
	$Package_Price 			= get_post_meta( $post->ID, 'packageprice', true );
	
	$Package_Time_Label 	= get_post_meta( $post->ID, 'packagetimelabel', true );
	$Package_Time_Day		= get_post_meta( $post->ID, 'packagetimeday', true );
	
	$Package_List_Label		= get_post_meta( $post->ID, 'packagelistlabel', true );
	$Package_List 			= get_post_meta( $post->ID, 'packagelist', true );
	
	$Package_Featured_Label	= get_post_meta( $post->ID, 'packagefeaturedlabel', true );
	$Package_Featured 		= get_post_meta( $post->ID, 'packagefeatured', true );

	$Package_Free			= get_post_meta( $post->ID, 'packagefree', true ); ?>

	<table class="admin-property-detail">
		<tr>
			<td><label for="packagetype"><?php esc_html_e("Package Typr","dreamvilla-multiple-property"); ?>:</label></td>
			<td>
				<select name="packagetype">
					<option value="membership" selected=selected>Membership</option>
					<option value="per_listing" <?php if( $Package_Type == "per_listing" ){ echo "selected=selected"; } ?> >Per Listing</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><label for="packagepricelabel"><?php esc_html_e("Price Label","dreamvilla-multiple-property"); ?>:</label></td>
			<td><input type="text" name="packagepricelabel" id="packagepricelabel" value="<?php echo esc_attr($Package_Price_Label); ?>"/>
				<p class="description">Ex. USD 10.00</p>
			</td>
		</tr>
		<tr>
			<td><label for="packageprice"><?php esc_html_e("Price","dreamvilla-multiple-property"); ?>:</label></td>
			<td><input type="text" name="packageprice" id="packageprice" value="<?php echo esc_attr($Package_Price); ?>"/>
				<p class="description">Ex. 10, 99.99</p>
			</td>
		</tr>		
		<tr>
			<td><label for="packagetimelabel"><?php esc_html_e("Time Label","dreamvilla-multiple-property"); ?>:</label></td>
			<td><input type="text" name="packagetimelabel" id="packagetimelabel" value="<?php echo esc_attr($Package_Time_Label); ?>"/>
				<p class="description">Ex. Time Period: 15 Days, 2 Weeks, 3 Months, 1 Years</p>
			</td>
		</tr>
		<tr>
			<td><label for="packagetimeday"><?php esc_html_e("Time In Day","dreamvilla-multiple-property"); ?>:</label></td>
			<td><input type="text" name="packagetimeday" id="packagetimeday" value="<?php echo esc_attr($Package_Time_Day); ?>"/>
				<p class="description">Leave blank or 0 for unlimited time period</p>
			</td>
		</tr>
		<tr>
			<td><label for="packagelistlabel"><?php esc_html_e("Property Listing Label","dreamvilla-multiple-property"); ?>:</label></td>
			<td><input type="text" name="packagelistlabel" id="packagelistlabel" value="<?php echo esc_attr($Package_List_Label); ?>"/>
				<p class="description">Ex. 2 Listings, Unlimited Listings</p>
			</td>
		</tr>
		<tr>
			<td><label for="packagelist"><?php esc_html_e("No Of Property Listing","dreamvilla-multiple-property"); ?>:</label></td>
			<td><input type="text" name="packagelist" id="packagelist" value="<?php echo esc_attr($Package_List); ?>"/>
				<p class="description">Leave blank or 0 for unlimited property lisgings</p>
			</td>
		</tr>
		<tr>
			<td><label for="packagefeaturedlabel"><?php esc_html_e("Featured Property Label ","dreamvilla-multiple-property"); ?>:</label></td>
			<td><input type="text" name="packagefeaturedlabel" id="packagefeaturedlabel" value="<?php echo esc_attr($Package_Featured_Label); ?>"/>
				<p class="description">Ex. 2 Featured, 100 Featured</p>
			</td>
		</tr>
		<tr>
			<td><label for="packagefeatured"><?php esc_html_e("No Of Featured Property","dreamvilla-multiple-property"); ?>:</label></td>
			<td><input type="text" name="packagefeatured" id="packagefeatured" value="<?php echo esc_attr($Package_Featured); ?>"/>
				<p class="description">Leave blank or 0 for unlimited featured property</p>
			</td>
		</tr>
		<tr>
			<td><label for="packagefree"><?php esc_html_e("Make Free Package","dreamvilla-multiple-property"); ?>:</label></td>
			<td><input type="checkbox" name="packagefree" id="packagefree" value="yes" <?php if( $Package_Free == "yes" ){ echo "checked='checked'"; } ?> />
				<p class="description">Make free package</p>
			</td>
		</tr>
	</table>
	<?php	
}

// Save custom field value of property package
add_action( 'save_post', 'dreamvilla_mp_wp_property_package_save' );
function dreamvilla_mp_wp_property_package_save( $post_id ) {

	// Check if our nonce is set.
	if ( ! isset( $_POST['property_package_meta_box_nonce'] ) ) return;

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['property_package_meta_box_nonce'], 'property_package_meta_box' ) ) return;

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) return;
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	}	
	
	// Sanitize user input.
	$packagetype			= sanitize_text_field( $_POST['packagetype'] );
	$packagepricelabel		= sanitize_text_field( $_POST['packagepricelabel'] );
	$packageprice 			= sanitize_text_field( $_POST['packageprice'] );
	$packagetimelabel 		= sanitize_text_field( $_POST['packagetimelabel'] );
	$packagetimeday 		= sanitize_text_field( $_POST['packagetimeday'] );
	$packagelistlabel 		= sanitize_text_field( $_POST['packagelistlabel'] );
	$packagelist 			= sanitize_text_field( $_POST['packagelist'] );
	$packagefeaturedlabel 	= sanitize_text_field( $_POST['packagefeaturedlabel'] );
	$packagefeatured 		= sanitize_text_field( $_POST['packagefeatured'] );
	$packagefree 			= sanitize_text_field( $_POST['packagefree'] );
	
	// Update the meta field in the database.
	update_post_meta( $post_id, 'packagetype', $packagetype );
	update_post_meta( $post_id, 'packagepricelabel', $packagepricelabel );
	update_post_meta( $post_id, 'packageprice', $packageprice );
	update_post_meta( $post_id, 'packagetimelabel', $packagetimelabel );
	update_post_meta( $post_id, 'packagetimeday', $packagetimeday );
	update_post_meta( $post_id, 'packagelistlabel', $packagelistlabel );
	update_post_meta( $post_id, 'packagelist', $packagelist );
	update_post_meta( $post_id, 'packagefeaturedlabel', $packagefeaturedlabel );
	update_post_meta( $post_id, 'packagefeatured', $packagefeatured );
	update_post_meta( $post_id, 'packagefree', $packagefree );
}

?>