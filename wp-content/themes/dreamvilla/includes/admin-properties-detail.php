<?php

require_once get_template_directory() . '/inc/backend/package.php';

// Include Script and CSS in speficif page of backend
function dreamvilla_mp_load_custom_wp_admin_script() {
	global $pagenow, $typenow;
	if( empty($typenow) && !empty($_GET['post'] ) ){
		$post = get_post($_GET['post']);
		$typenow = $post->post_type;
	}	
 
 	wp_enqueue_style('dreamvilla-mp-general-css', get_template_directory_uri().'/css/admin/dreamvilla-general.css', '', '', 'all');
 
 	if ( is_admin() && isset($_GET['post_type']) && $_GET['post_type'] =='property' OR $pagenow == 'post.php' && $typenow == 'property' OR $pagenow == 'user-edit.php' OR $pagenow == 'user-new.php' OR is_admin() && isset($_GET['post_type']) && $_GET['post_type'] =='agent' OR $pagenow == 'post.php' && $typenow == 'agent' OR is_admin() && isset($_GET['post_type']) && $_GET['post_type'] =='package' OR $pagenow == 'post.php' && $typenow == 'package' OR is_admin() && $pagenow == 'users.php' OR is_admin() && $pagenow == 'profile.php' ) {
		wp_enqueue_script('dreamvilla-mp-jquery-ui-js', get_template_directory_uri().'/js/jquery-ui.js', '', '', true);
		wp_enqueue_script('dreamvilla-mp-bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', '', '', true);
		wp_enqueue_script('dreamvilla-mp-google-map-api', 'https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places', '', '', true);  
		wp_enqueue_script('dreamvilla-mp-admin', get_template_directory_uri().'/js/dreamvilla-mp-admin.js', '', '', true);
		wp_enqueue_script('dreamvilla-mp-google-map-js', get_template_directory_uri().'/js/dreamvilla-mp-googlemap.js', '', '', true);

		wp_enqueue_style('dreamvilla-mp-jquery-bootstrap', get_template_directory_uri().'/css/bootstrap.min.css', '', '', 'all');
		wp_enqueue_style('dreamvilla-mp-jquery-ui-css', get_template_directory_uri().'/css/jquery-ui.css', '', '', 'all');
		wp_enqueue_style('dreamvilla-mp-custom-css', get_template_directory_uri().'/css/dreamvilla-mp-custom.css', '', '', 'all');
		wp_enqueue_style('dreamvilla-mp-admin-style', get_template_directory_uri().'/css/admin/dreamvilla-admin-style.css', '', '', 'all'); 
 	}

 	if( is_admin() && isset($_GET['post_type']) && $_GET['post_type'] =='agent' OR $pagenow == 'post.php' && $typenow == 'agent' OR is_admin() && isset($_GET['post_type']) && $_GET['post_type'] =='package' OR $pagenow == 'post.php' && $typenow == 'package' ){
 		wp_enqueue_script('dreamvilla-mp-quicktags', includes_url( 'js/quicktags.js' ), '', '', true);
 	}
 	
}

// Include Script in theme-option page of backend
function dreamvilla_mp_admin_custom_js(){
	wp_enqueue_script('jquery');
	wp_enqueue_script('dreamvilla-mp-jquery-ui-js', get_template_directory_uri().'/js/jquery-ui.js', '', '', true);
	wp_enqueue_script('dreamvilla-mp-bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', '', '', true);
	wp_enqueue_script('dreamvilla-mp-jquery-appear', get_template_directory_uri().'/js/jquery.appear.js', '', '', true);
	wp_enqueue_script('dreamvilla-mp-admin', get_template_directory_uri().'/js/dreamvilla-mp-admin.js', '', '', true);
	wp_enqueue_script('dreamvilla-mp-google-map-api', 'https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places', '', '', true);
	wp_enqueue_script('dreamvilla-mp-google-map-js', get_template_directory_uri().'/js/dreamvilla-mp-googlemap.js', '', '', true);
	wp_enqueue_script('dreamvilla-mp-quicktags', includes_url( 'js/quicktags.js' ), '', '', true);
}

// Include Style in theme-option page of backend
function dreamvilla_mp_admin_custom_css(){
	wp_enqueue_style('dreamvilla-mp-jquery-ui-css', get_template_directory_uri().'/css/jquery-ui.css', '', '', 'all');
	wp_enqueue_style('dreamvilla-mp-jquery-bootstrap', get_template_directory_uri().'/css/bootstrap.min.css', '', '', 'all');
	wp_enqueue_style('dreamvilla-mp-custom-css', get_template_directory_uri().'/css/dreamvilla-mp-custom.css', '', '', 'all');
	wp_enqueue_style('dreamvilla-mp-admin-style', get_template_directory_uri().'/css/admin/dreamvilla-admin-style.css', '', '', 'all');
}

// Include Script And CSS
add_action( 'admin_enqueue_scripts', 'dreamvilla_mp_load_custom_wp_admin_script' );
function dreamvilla_mp_load_dreamvilla_js_css(){
	wp_enqueue_script('jquery');
	wp_enqueue_script('dreamvilla-mp-jquery-ui-js', get_template_directory_uri().'/js/jquery-ui.js', '', '', true);
	wp_enqueue_script('dreamvilla-mp-jquery-timepicker', get_template_directory_uri().'/js/jquery.timepicker.min.js', '', '', true);
	wp_enqueue_script('dreamvilla-mp-bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', '', '', true);
	wp_enqueue_script('dreamvilla-mp-bootstrap-select', get_template_directory_uri().'/js/bootstrap-select.min.js', '', '', true);
	
	if( !is_page_template( 'page-templates/dashboard-submit-property.php' ) ) {
    	wp_enqueue_script('dreamvilla-mp-selectpicker', get_template_directory_uri().'/js/dreamvilla-mp-selectpicker.js', '', '', true);
	}
	
	wp_enqueue_script('dreamvilla-mp-jquery-appear', get_template_directory_uri().'/js/jquery.appear.js', '', '', true);
	wp_enqueue_script('dreamvilla-mp-jquery-menu', get_template_directory_uri().'/js/jquery.mmenu.min.all.js', '', '', true);
	wp_enqueue_script('dreamvilla-mp-image-light-box', get_template_directory_uri().'/js/dreamvilla-mp-image-light-box.js', '', '', true);
	wp_enqueue_script('dreamvilla-mp-slider', get_template_directory_uri().'/js/dreamvilla-mp-slider.js', '', '', true);
	wp_enqueue_script('dreamvilla-mp-tab-navigation', get_template_directory_uri().'/js/dreamvilla-mp-tab-navigation.js', '', '', true);
	wp_enqueue_script('dreamvilla-mp-svg-inlinesvg', get_template_directory_uri().'/js/dreamvilla-mp-svg-inlinesvg.js', '', '', true);
	wp_enqueue_script('dreamvilla-mp-markerclusterer', get_template_directory_uri().'/js/markerclusterer.js', '', '', true);
	wp_enqueue_script('dreamvilla-mp-custom', get_template_directory_uri().'/js/dreamvilla-mp-custom.js', '', '', true);
	wp_enqueue_script('dreamvilla-validate-script', get_template_directory_uri() . '/js/jquery.validate.js', array('jquery') );

	wp_enqueue_script( 'plupload' );
	wp_enqueue_script( 'jquery-ui-sortable' );
	
	
	$dreamvilla_options = get_option('dreamvilla_options');

	if( !empty($dreamvilla_options['dreamvilla_google_map_api']) )
		$google_map = 'https://maps.googleapis.com/maps/api/js?key='.$dreamvilla_options['dreamvilla_google_map_api'].'&signed_in=true&libraries=places';
	else
		$google_map = 'https://maps.googleapis.com/maps/api/js?signed_in=true&libraries=places';

	wp_enqueue_script('google-map-api', $google_map, '', '', true);
		
	wp_enqueue_style('dreamvilla-mp-jquery-ui-css', get_template_directory_uri().'/css/jquery-ui.css', '', '', 'all');
	wp_enqueue_style('dreamvilla-mp-jquery-timepicker-css', get_template_directory_uri().'/css/jquery.timepicker.css', '', '', 'all');
	wp_enqueue_style('dreamvilla-mp-jquery-bootstrap', get_template_directory_uri().'/css/bootstrap.min.css', '', '', 'all');
	wp_enqueue_style('dreamvilla-mp-jquery-bootstrap-select', get_template_directory_uri().'/css/bootstrap-select.min.css', '', '', 'all');
	wp_enqueue_style('dreamvilla-mp-jquery-mmenu-css', get_template_directory_uri().'/css/jquery.mmenu.all.css', '', '', 'all');
	wp_enqueue_style('dreamvilla-mp-font-awesome', get_template_directory_uri().'/css/font-awesome.min.css', '', '', 'all');
	wp_enqueue_style('dreamvilla-mp-style', get_template_directory_uri().'/css/dreamvilla-mp-style.css', '', '', 'all');

	if( !(empty($dreamvilla_options['dreamvillamultiple_rtl_css'])) && $dreamvilla_options['dreamvillamultiple_rtl_css'] =="1" ){
		wp_enqueue_style('dreamvilla-mp-rtl-style', get_template_directory_uri().'/css/rtl.css', '', '', 'all');		
	}

}
add_action( 'wp_enqueue_scripts', 'dreamvilla_mp_load_dreamvilla_js_css' );

// Add custom fields in Property, Agent and What people say custom post type
add_action( 'add_meta_boxes', 'dreamvilla_mp_add_properties_metaboxes' );
function dreamvilla_mp_add_properties_metaboxes() {
	add_meta_box('property_detial','Property details','dreamvilla_mp_property_detail_fields','property');
	add_meta_box('add_what_people_say', 'People Detail', 'dreamvilla_mp_add_what_people_say', 'what_people_say' );
}

// Custom field of property custom post type
function dreamvilla_mp_property_detail_fields($post){
	// Add a nonce field so we can check for it later.
	add_filter('media_upload_tabs', 'remove_media_library_tab');

	wp_nonce_field( 'property_details_meta_box', 'property_details_meta_box_nonce' );	
	
	$PropertyBanner				= get_post_meta( $post->ID, 'propertybannerimage', true );
	$PropertyStatus				= get_post_meta( $post->ID, 'pstatus', true );
	$PropertyPrice				= get_post_meta( $post->ID, 'pprice', true );
	$PropertySBuilupArea		= get_post_meta( $post->ID, 'psbuilduparea', true );
	$PropertyBuiltupYear		= get_post_meta( $post->ID, 'pbuiltupyear', true );
	$PropertyFacing 			= get_post_meta( $post->ID, 'pfacing', true );	
	$PropertyNoOfParking		= get_post_meta( $post->ID, 'pnoofparking', true );
	$PropertyNoOfFloor 			= get_post_meta( $post->ID, 'pnooffloor', true );
	$PropertyNoOfGarage			= get_post_meta( $post->ID, 'pnoofgarage', true );
	$PropertyWaterFlow 			= get_post_meta( $post->ID, 'pwaterflow', true );
	$PropertyWstorageCapacity 	= get_post_meta( $post->ID, 'pwstoragecapacity', true );
	$PropertyNoOfAirCondition 	= get_post_meta( $post->ID, 'pnoofaircondition', true );
	$PropertyParking 			= get_post_meta( $post->ID, 'pparking', true );
	$PropertyFencing 			= get_post_meta( $post->ID, 'pfencing', true );
	$PropertySolar  			= get_post_meta( $post->ID, 'psolar', true );
	$PropertyGarden  			= get_post_meta( $post->ID, 'pgarden', true );
	$PropertySecurity 			= get_post_meta( $post->ID, 'psecurity', true );
	$PropertyCCTV 				= get_post_meta( $post->ID, 'pcctv', true );
	$PropertyFireExting			= get_post_meta( $post->ID, 'pfireexting', true );	
	$PropertyChildrenPlayground	= get_post_meta( $post->ID, 'pchildrenplayground', true );
	$PropertyPhoneNumer  		= get_post_meta( $post->ID, 'pphobenumber', true );
	$PropertyEmailID  			= get_post_meta( $post->ID, 'pemailid', true );
	$PropertyTime 	 			= get_post_meta( $post->ID, 'ptime', true );
	$PropertyHeating			= get_post_meta( $post->ID, 'pheating', true);
	$PropertyBasement			= get_post_meta( $post->ID, 'pbasement', true);
	$PropertyBasementType		= get_post_meta( $post->ID, 'pbasementtype', true);
	$PropertyExterior			= get_post_meta( $post->ID, 'pexterior', true);
	$PropertyRoof				= get_post_meta( $post->ID, 'proof', true);
	$PropertyConstruction		= get_post_meta( $post->ID, 'pconstruction', true);
	$PropertyFoundation			= get_post_meta( $post->ID, 'pfoundation', true);
	$PropertyFruntExposure		= get_post_meta( $post->ID, 'pfruntexposure', true);
	$PropertyFrontageMeter		= get_post_meta( $post->ID, 'pfrontagemeter', true);
	$PropertyFlooring			= get_post_meta( $post->ID, 'pflooring', true);
	$PropertyGoodsIncluded		= get_post_meta( $post->ID, 'pgoodsincluded', true);
	$Property_Address 			= get_post_meta( $post->ID, 'paddress', true );
	$Property_Pincode 			= get_post_meta( $post->ID, 'ppincode', true );
	$Property_Country 			= get_post_meta( $post->ID, 'pcountry', true );
	$Property_State 			= get_post_meta( $post->ID, 'pstate', true );
	$Property_City 				= get_post_meta( $post->ID, 'pcity', true );
	$Property_LatLon 			= get_post_meta( $post->ID, 'platlon', true );
	$PropertyFetured			= get_post_meta( $post->ID, 'pfetured', true);
	//$PropertyVideo				= get_post_meta( $post->ID, 'pvideo', true);
	$PropertyAdvertisement		= get_post_meta( $post->ID, 'padvertisement', true);	
	$PropertyVideoPlaceholder	= get_post_meta( $post->ID, 'pvideoplaceholder', true);
	/*our custom code*/
	$PropertyVideoHeight	    = get_post_meta( $post->ID, 'pvideoheight', true);
	$PropertyVideoWidth		    = get_post_meta( $post->ID, 'pvideowidth', true);	
	$PropertyVideoUrl	        = get_post_meta( $post->ID, 'pvideourl', true);
	$Propertystreetviewlat      = get_post_meta( $post->ID, 'streetviewlat', true);
	$Propertystreetviewlng      = get_post_meta( $post->ID, 'streetviewlng', true);
	
	if( !$Property_LatLon ){
		$Property_LatLon[0] = '';
		$Property_LatLon[1] = '';	
	}
	
	if( !$PropertyPrice ){
		$PropertyPrice[0] = '';
		$PropertyPrice[1] = '';
	}
	if( !$PropertySBuilupArea ){
		$PropertySBuilupArea[0] = '';
		$PropertySBuilupArea[1] = '';
	}	
	if( !$PropertyFencing ){
		$PropertyFencing[0] = '';
		$PropertyFencing[1] = '';
	}
	if( !$PropertyParking ){
		$PropertyParking[0] = '';
		$PropertyParking[1] = '';
	}
	if( !$PropertySolar ){
		$PropertySolar[0] = '';
		$PropertySolar[1] = '';
	}
	if( !$PropertyTime ){
		$PropertyTime[0] = '';
		$PropertyTime[1] = '';
		$PropertyTime[2] = '';
		$PropertyTime[3] = '';
	} ?>	
	
	<!-- STart extra from here to remove  if requiered -->
	<style>
	.ui-tabs-vertical { width: 55em; }
	.ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 12em; }
	.ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0; }
	.ui-tabs-vertical .ui-tabs-nav li a { display:block; }
	.ui-tabs-vertical .ui-tabs-nav li.ui-tabs-active { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; }
	.ui-tabs-vertical .ui-tabs-panel { padding: 1em; float: right; width: 40em;}
	</style>
	<div id="tabs">
		<ul style="border:none;">
			<li><a href="#tabs-1"><?php esc_html_e('Detalles básicos','dreamvilla-multiple-property'); ?></a></li>
			
			<li><a href="#tabs-5"><?php esc_html_e('Detalles propiedad','dreamvilla-multiple-property'); ?></a></li>
			<li><a href="#tabs-6" id="property_address" ><?php esc_html_e('Dirección','dreamvilla-multiple-property'); ?></a></li>
			<li><a href="#tabs-8"><?php esc_html_e('Galeria','dreamvilla-multiple-property'); ?></a></li>
						
			<li><a href="#tabs-10"><?php esc_html_e('Video & Ads','dreamvilla-multiple-property'); ?></a></li> 
			<li><a href="#tabs-12"><?php esc_html_e('Otros','dreamvilla-multiple-property'); ?></a></li>
			
		</ul>
		<div class="theme_option_form">
			
			<?php require_once get_template_directory() . '/inc/backend/property-backend/basic-details.php'; ?>

			

			<?php require_once get_template_directory() . '/inc/backend/property-backend/dimensions.php'; ?>

			<?php require_once get_template_directory() . '/inc/backend/property-backend/address.php'; ?>

			
			<?php require_once get_template_directory() . '/inc/backend/property-backend/gallery.php'; ?>			

			<?php require_once get_template_directory() . '/inc/backend/property-backend/video-ads.php'; ?>


			<?php require_once get_template_directory() . '/inc/backend/property-backend/other.php'; ?>

			
										
			</div>
		</div>
	</div>
	<?php
}

// Save custom field value of property custom post type
add_action( 'save_post', 'dreamvilla_mp_wp_save_property_details' );
function dreamvilla_mp_wp_save_property_details( $post_id ) {

	// Check if our nonce is set.
	if ( ! isset( $_POST['property_details_meta_box_nonce'] ) ) return;

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['property_details_meta_box_nonce'], 'property_details_meta_box' ) ) return;

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) return;
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	}

	$proomsize = $_POST['proomsize'];
	$proomtype = $_POST['proomtype'];	
	$proom = array();
	if( $proomsize ){
		foreach ($proomsize as $key => $value) {
			if( $value || $proomtype[$key] ){
				$proom[$key] = array( 'proomsize' => $value, 'proomtype' => $proomtype[$key] );
			}		
		}
	}
	update_post_meta( $post_id, 'propertyroom', $proom );

	$Count_Bedroom = 0;
	foreach ($proom as $key => $value) {
		if( in_array( $proom[$key]['proomtype'], dreamvilla_mp_get_bedroom_type() )  ){
			$Count_Bedroom++;
		}
	}
	if( $Count_Bedroom > 0 ){
		update_post_meta( $post_id, 'propertytotalroom', $Count_Bedroom );
	} else {
		update_post_meta( $post_id, 'propertytotalroom', '' );
	}

	$pbathroomsize = $_POST['pbathroomsize'];	
	$pbathroom = array();
	if( $pbathroomsize ){
		foreach ($pbathroomsize as $key => $value) {
			if( $value ){
				$pbathroom[$key] = array( 'pbathroomsize' => $value );
			}		
		}
	}
	update_post_meta( $post_id, 'propertybathroom', $pbathroom );

	$total_bathroom = count($pbathroom);
	if( $total_bathroom > 0 ){
		update_post_meta( $post_id, 'propertytotalbathroom', $total_bathroom );	
	} else {
		update_post_meta( $post_id, 'propertytotalbathroom', '' );	
	}

	$pkitchensize = $_POST['pkitchensize'];	
	$pkitchen = array();
	if( $pkitchensize ){
		foreach ($pkitchensize as $key => $value) {
			if( $value ){
				$pkitchen[$key] = array( 'pkitchensize' => $value );
			}		
		}
	}
	update_post_meta( $post_id, 'propertykitchen', $pkitchen );

	$pswimmingpoolsize = $_POST['pswimmingpoolsize'];	
	$pkitchen = array();
	if( $pswimmingpoolsize ){
		foreach ($pswimmingpoolsize as $key => $value) {
			if( $value ){
				$pkitchen[$key] = array( 'pswimmingpoolsize' => $value );
			}		
		}
	}
	update_post_meta( $post_id, 'propertyswimmingpool', $pkitchen );

	$pgymsize = $_POST['pgymsize'];	
	$pgym = array();
	if( $pgymsize ){
		foreach ($pgymsize as $key => $value) {
			if( $value ){
				$pgym[$key] = array( 'pgymsize' => $value );
			}		
		}
	}
	update_post_meta( $post_id, 'propertygym', $pgym );
	
	$essentialtitle=$_POST['essentialtitle'];
	$essentialvalue=$_POST['essentialvalue'];
	
	if( $essentialtitle ){
		foreach ($essentialtitle as $key => $value) {
			if( $value ){
				$essentialarray[$key] = array( 'essentialtitle' => $value, 'essentialvalue' => $essentialvalue[$key] );
			}		
		}
	}
	update_post_meta( $post_id, 'essentialinformation', $essentialarray );

	$pamenities = $_POST['pamenities'];
	$pamenitiesphoto = $_POST['pamenitiesphoto'];	
	
	$pamenitiesarray = array();
	if( $pamenities ){
		foreach ($pamenities as $key => $value) {
			if( $value ){
				$pamenitiesarray[$key] = array( 'pamenities' => $value, 'pamenitiesphoto' => $pamenitiesphoto[$key] );
			}		
		}
	}
	update_post_meta( $post_id, 'propertyamenities', $pamenitiesarray );
	
	$interiortitle=$_POST['interiortitle'];
	$interiordescription=$_POST['interiordescription'];
	
	if( $interiortitle ){
		foreach ($interiortitle as $key => $value) {
			if( $value ){
				$pinteriorarray[$key] = array( 'interiortitle' => $value, 'interiordescription' => $interiordescription[$key] );
			}		
		}
	}
	update_post_meta( $post_id, 'pinteriorarray', $pinteriorarray );
	
	$exteriortitle=$_POST['exteriortitle'];
	$exteriordescription=$_POST['exteriordescription'];
	
	if( $exteriortitle ){
		foreach ($exteriortitle as $key => $value) {
			if( $value ){
				$pexteriorarray[$key] = array( 'exteriortitle' => $value, 'exteriordescription' => $exteriordescription[$key] );
			}		
		}
	}
	update_post_meta( $post_id, 'pexteriorarray', $pexteriorarray );	
	
	$pgallery = $_POST['pgallery'];	
	
	$pgalleryarray = array();
	if( $pgallery ){
		foreach ($pgallery as $key => $value) {
			if( $value ){
				$pgalleryarray[$key] = array( 'pgallery' => $value );
			}		
		}
	}
	update_post_meta( $post_id, 'propertygallery', $pgalleryarray );

	$floortitle 	= $_POST['floortitle'];
	$floorprice 	= $_POST['floorprice'];
	$floorsqrt 		= $_POST['floorsqrt'];
	$floorbedrooms 	= $_POST['floorbedrooms'];
	$floorbathrooms = $_POST['floorbathrooms'];
	$floordetail 	= $_POST['floordetail'];
	$floorplanimage = $_POST['floorplanimage'];

	$propertyfloorsarray = array();

	if($floortitle) {
		foreach ( $floortitle as $key => $value ) {
			if( $value ) {
				$propertyfloorsarray[$key] = array( 'floortitle' => $value, 'floorprice' => $floorprice[$key], 'floorsqrt' => $floorsqrt[$key], 'floorbedrooms' => $floorbedrooms[$key], 'floorbathrooms' => $floorbathrooms[$key], 'floordetail' => $floordetail[$key], 'floorplanimage' => $floorplanimage[$key], );
			}
		}
	}
	update_post_meta( $post_id, 'propertyfloors', $propertyfloorsarray );

	// Sanitize user input.
	$propertybannerimage	= sanitize_text_field( $_POST['propertybannerimage'] );
	$pstatus 				= sanitize_text_field( $_POST['pstatus'] );
	$pprice 				= sanitize_text_field( $_POST['pprice'] );
	$ppricetype				= sanitize_text_field( $_POST['ppricetype'] );
	$psbuilduparea 			= sanitize_text_field( $_POST['psbuilduparea'] );
	$psbuildupareamessure 	= sanitize_text_field( $_POST['psbuildupareamessure'] );
	$pbuiltupyear			= sanitize_text_field( $_POST['pbuiltupyear'] );
	$pfacing 				= sanitize_text_field( $_POST['pfacing'] );
	$pnoofparking 			= sanitize_text_field( $_POST['pnoofparking'] );
	$pnooffloor 			= sanitize_text_field( $_POST['pnooffloor'] );
	$pnoofgarage 			= sanitize_text_field( $_POST['pnoofgarage'] );
	$pwaterflow 			= sanitize_text_field( $_POST['pwaterflow'] );
	$pwstoragecapacity 		= sanitize_text_field( $_POST['pwstoragecapacity'] );
	$pnoofaircondition 		= sanitize_text_field( $_POST['pnoofaircondition'] );
	$pparking 				= sanitize_text_field( $_POST['pparking'] );
	$pparkingcapacity 		= sanitize_text_field( $_POST['pparkingcapacity'] );
	$pfencing 				= sanitize_text_field( $_POST['pfencing'] );	
	$psolar 				= sanitize_text_field( $_POST['psolar'] );
	$psolarcapacity 		= sanitize_text_field( $_POST['psolarcapacity'] );
	$pgarden 				= sanitize_text_field( $_POST['pgarden'] );
	$psecurity				= sanitize_text_field( $_POST['psecurity'] );
	$pcctv 					= sanitize_text_field( $_POST['pcctv'] );
	$pfireexting 			= sanitize_text_field( $_POST['pfireexting'] );
	$pfireexting1 			= sanitize_text_field( $_POST['pfireexting1'] );
	$pchildrenplayground	= sanitize_text_field( $_POST['pchildrenplayground'] );
	$pphobenumber 			= sanitize_text_field( $_POST['pphobenumber'] );
	$pemailid 				= sanitize_text_field( $_POST['pemailid'] );
	$pstime1 				= sanitize_text_field( $_POST['pstime1'] );
	$petime1 				= sanitize_text_field( $_POST['petime1'] );
	$pstime2 				= sanitize_text_field( $_POST['pstime2'] );
	$petime2 				= sanitize_text_field( $_POST['petime2'] );
	$pheating				= sanitize_text_field( $_POST['pheating']);
	$pbasement				= sanitize_text_field( $_POST['pbasement']);
	$pbasementtype			= sanitize_text_field( $_POST['pbasementtype']);
	$pexterior				= sanitize_text_field( $_POST['pexterior']);
	$proof					= sanitize_text_field( $_POST['proof']);
	$pconstruction			= sanitize_text_field( $_POST['pconstruction']);
	$pfoundation			= sanitize_text_field( $_POST['pfoundation']);
	$pfruntexposure			= sanitize_text_field( $_POST['pfruntexposure']);
	$pfrontagemeter			= sanitize_text_field( $_POST['pfrontagemeter']);
	$pflooring				= sanitize_text_field( $_POST['pflooring']);
	$pgoodsincluded			= sanitize_text_field( $_POST['pgoodsincluded']);
	$pfetured				= sanitize_text_field( $_POST['pfetured']);
	//$pvideo					= sanitize_text_field( $_POST['pvideo']);
	$padvertisement			= $_POST['padvertisement'];
	$pvideoplaceholder		= $_POST['pvideoplaceholder'];
	/*our custom code*/
	$PropertyVideoHeight	= $_POST['pvideoheight'];
	$PropertyVideoWidth		= $_POST['pvideowidth'];	
	$PropertyVideoUrl	    = sanitize_text_field( $_POST['pvideourl']);
	$Propertystreetviewlat  = sanitize_text_field( $_POST['streetviewlat']);
	$Propertystreetviewlng  = sanitize_text_field( $_POST['streetviewlng']);
	
	// Sanitize user input.
	$paddress 	= sanitize_text_field( $_POST['paddress'] );
	$ppincode 	= sanitize_text_field( $_POST['ppincode'] );
	$pcountry 	= sanitize_text_field( $_POST['pcountry'] );
	$pstate 	= sanitize_text_field( $_POST['pstate'] );
	$pcity 		= sanitize_text_field( $_POST['pcity'] );
	$platitude 	= sanitize_text_field( $_POST['platitude'] );
	$plongitude = sanitize_text_field( $_POST['plongitude'] );	
	$pagent 	= sanitize_text_field( $_POST['pagent'] );
	
	$price = filter_var($pprice, FILTER_SANITIZE_NUMBER_INT);
	update_post_meta( $post_id, 'price', $price );

	// Update the meta field in the database.
	update_post_meta( $post_id, 'propertybannerimage', $propertybannerimage );
	update_post_meta( $post_id, 'pstatus', $pstatus );
	update_post_meta( $post_id, 'pprice', array( $pprice, $ppricetype ) );		
	update_post_meta( $post_id, 'psbuilduparea', array( $psbuilduparea ) );	
	update_post_meta( $post_id, 'pbuiltupyear', $pbuiltupyear );
	update_post_meta( $post_id, 'pavailablefrom', $pavailablefrom );
	update_post_meta( $post_id, 'pfacing', $pfacing );
	update_post_meta( $post_id, 'pnooffloor', $pnooffloor );
	update_post_meta( $post_id, 'pnoofparking', $pnoofparking );	
	update_post_meta( $post_id, 'pnoofgarage', $pnoofgarage );	
	update_post_meta( $post_id, 'pwaterflow', $pwaterflow );
	update_post_meta( $post_id, 'pwstoragecapacity', $pwstoragecapacity );	
	update_post_meta( $post_id, 'pnoofaircondition', $pnoofaircondition );
	update_post_meta( $post_id, 'pparking', array( $pparking, $pparkingcapacity ) );	
	update_post_meta( $post_id, 'pfencing', array( $pfencing ) );
	update_post_meta( $post_id, 'psolar', array( $psolar, $psolarcapacity ) );	
	update_post_meta( $post_id, 'pgarden', $pgarden );
	update_post_meta( $post_id, 'psecurity', $psecurity);
	update_post_meta( $post_id, 'pcctv', $pcctv );
	update_post_meta( $post_id, 'pfireexting', $pfireexting );
	update_post_meta( $post_id, 'pchildrenplayground', $pchildrenplayground );
	update_post_meta( $post_id, 'pphobenumber', $pphobenumber );
	update_post_meta( $post_id, 'pemailid', $pemailid );	
	update_post_meta( $post_id, 'ptime', array( $pstime1, $petime1, $pstime2, $petime2 ) );
	update_post_meta( $post_id, 'pheating', $pheating);
	update_post_meta( $post_id, 'pbasement', $pbasement);
	update_post_meta( $post_id, 'pbasementtype', $pbasementtype);
	update_post_meta( $post_id, 'pexterior', $pexterior);
	update_post_meta( $post_id, 'proof', $proof);
	update_post_meta( $post_id, 'pconstruction', $pconstruction);
	update_post_meta( $post_id, 'pfoundation', $pfoundation);
	update_post_meta( $post_id, 'pfruntexposure', $pfruntexposure);
	update_post_meta( $post_id, 'pfrontagemeter', $pfrontagemeter);
	update_post_meta( $post_id, 'pflooring', $pflooring);
	update_post_meta( $post_id, 'pgoodsincluded', $pgoodsincluded);
	update_post_meta( $post_id, 'pfetured', $pfetured);
	//update_post_meta( $post_id, 'pvideo', $pvideo);
	update_post_meta( $post_id, 'padvertisement', $padvertisement);
	/*our custom code*/
	update_post_meta( $post_id, 'pvideoheight', $PropertyVideoHeight);
	update_post_meta( $post_id, 'pvideowidth', $PropertyVideoWidth);
	update_post_meta( $post_id, 'pvideourl', $PropertyVideoUrl);
	update_post_meta( $post_id, 'streetviewlat', $Propertystreetviewlat);
	update_post_meta( $post_id, 'streetviewlng', $Propertystreetviewlng);

	// Update the meta field in the database.
	update_post_meta( $post_id, 'paddress', $paddress );
	update_post_meta( $post_id, 'ppincode', $ppincode );
	update_post_meta( $post_id, 'pcountry', $pcountry );
	update_post_meta( $post_id, 'pstate', $pstate );
	update_post_meta( $post_id, 'pcity', $pcity );
	update_post_meta( $post_id, 'platlon', array( $platitude, $plongitude ) );	
	
	update_post_meta( $post_id, 'pvideoplaceholder', $pvideoplaceholder);

	$pdocumentsstatus 	= $_POST['pdocumentsstatus'];
	$pdocumentstitle 	= $_POST['pdocumentstitle'];

	update_post_meta( $post_id, 'pdocumentsstatus', array( 'pdocumentsstatus' => $pdocumentsstatus, 'pdocumentstitle' => $pdocumentstitle ) );

	$pdocumentslabel 	= $_POST['pdocumentslabel'];
	$pdocumentslink 	= $_POST['pdocumentslink'];
	$pdocuments = array();

	if( $pdocumentslabel ){
		foreach ($pdocumentslabel as $key => $value) {
			if( $value ){
				$pdocuments[$key] = array( 'pdocumentslabel' => $value, 'pdocumentslink' => $pdocumentslink[$key] );
			}		
		}
	}
	update_post_meta( $post_id, 'pdocuments', $pdocuments );

	$google_near_by_place_type 	= $_POST['google_near_by_place_type'];
	$google_near_by_place_label = $_POST['google_near_by_place_label'];
	$google_near_by_place_icon 	= $_POST['google_near_by_place_icon'];

	// Update near by map location of property
	$google_near_by_place_array = array();
	if( $google_near_by_place_type ){
		foreach ($google_near_by_place_type as $key => $value) {
			if( $google_near_by_place_type[$key] ){
				if( empty($google_near_by_place_label[$key]) ){
					$google_near_by_place_label[$key] = $google_near_by_place_type[$key];
				}
				if( empty($google_near_by_place_icon[$key]) ){
					$google_near_by_place_icon[$key] = get_template_directory_uri().'/images/map_marker.png';
				}
				if( $value ){
					$google_near_by_place_array[$key] = array( 'google_near_by_place_type' => $value, 'google_near_by_place_label' => $google_near_by_place_label[$key], 'google_near_by_place_icon' => $google_near_by_place_icon[$key] );
				}
			}	
		}
	}
	update_post_meta( $post_id, 'google_near_by_place', $google_near_by_place_array );

	$google_near_by_custom_place_label 		= $_POST['google_near_by_custom_place_label'];
	$google_near_by_custom_place_detail 	= $_POST['google_near_by_custom_place_detail'];
	$google_near_by_custom_place_latitude 	= $_POST['google_near_by_custom_place_latitude'];
	$google_near_by_custom_place_longitude 	= $_POST['google_near_by_custom_place_longitude'];
	$google_near_by_custom_place_icon 		= $_POST['google_near_by_custom_place_icon'];
			
	$google_near_by_custom_place_array = array();
	if( $google_near_by_custom_place_label ){
		foreach ($google_near_by_custom_place_label as $key => $value) {
			if( $google_near_by_custom_place_label[$key] ){
				if( empty($google_near_by_custom_place_detail[$key]) ){
					$google_near_by_custom_place_detail[$key] = $google_near_by_custom_place_detail[$key];
				}
				if( empty($google_near_by_custom_place_latitude[$key]) ){
					$google_near_by_custom_place_latitude[$key] = $google_near_by_custom_place_latitude[$key];
				}
				if( empty($google_near_by_custom_place_longitude[$key]) ){
					$google_near_by_custom_place_longitude[$key] = $google_near_by_custom_place_longitude[$key];
				}
				if( empty($google_near_by_custom_place_longitude[$key]) ){
					$google_near_by_custom_place_icon[$key] = get_template_directory_uri().'/images/map_marker.png';
				}
				if( $value ){
					$google_near_by_custom_place_array[$key] = array( 'google_near_by_custom_place_label' => $value,'google_near_by_custom_place_detail' => $google_near_by_custom_place_detail[$key], 'google_near_by_custom_place_latitude' => $google_near_by_custom_place_latitude[$key], 'google_near_by_custom_place_longitude' => $google_near_by_custom_place_longitude[$key], 'google_near_by_custom_place_icon' => $google_near_by_custom_place_icon[$key] );
				}
			}	
		}
	}
	update_post_meta( $post_id, 'google_near_by_custom_place', $google_near_by_custom_place_array );	

	// Update the meta field in the database.
	$old_agent = get_post_meta( $post_id, 'pagent', true );
	update_post_meta( $post_id, 'pagent', $pagent );

	if( !empty($old_agent) && !empty($pagent) && $old_agent != $pagent ){

		$old_agent_property = get_user_meta( $old_agent, 'pagentproperty', true );

		if( !empty($old_agent_property) ){
			$position = array_search($post_id, $old_agent_property);
			unset($old_agent_property[$position]);
			update_user_meta( $old_agent, 'pagentproperty', $old_agent_property );
		}
	}

	$Agent_Property_List = get_user_meta( $pagent, 'pagentproperty', true );

	if( !empty($pagent) ){
		if( empty($Agent_Property_List) ){
			$Agent_Property_List = array( $post_id );
			update_user_meta( $pagent, 'pagentproperty', $Agent_Property_List );			
		} else {
			if( !in_array($post_id, $Agent_Property_List) ){
				array_push($Agent_Property_List, $post_id);				
				update_user_meta( $pagent, 'pagentproperty', $Agent_Property_List );
			}
		}
	} else {
		if( !empty($Agent_Property_List) ){
			$position = array_search($post_id, $Agent_Property_List);
			unset($Agent_Property_List[$position]);
			update_user_meta( $pagent, 'pagentproperty', $Agent_Property_List );
		}		
	}

	$psubproperty = $_POST['psubproperty'];
	update_post_meta( $post_id, 'psubproperty', $psubproperty );
}

// Add custom field in What people say custom post type
function dreamvilla_mp_add_what_people_say( $post ) {
	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'what_people_say_meta_box', 'what_people_say_meta_box_nonce' );

	$People_Position = get_post_meta( $post->ID, 'People_Position', true ); ?>
	<table class="admin-property-detail">
		<tr>
			<td><label for="People_Position"><?php esc_html_e("People Position","dreamvilla-multiple-property"); ?>:</label></td>
			<td><input type="text" name="People_Position" id="People_Position" value="<?php echo esc_attr($People_Position); ?>"/></td>
		</tr>		
	</table>
	<?php	
}

// Save custom field value of What people say custom post type
add_action( 'save_post', 'dreamvilla_mp_wp_what_people_say' );
function dreamvilla_mp_wp_what_people_say( $post_id ) {

	// Check if our nonce is set.
	if ( ! isset( $_POST['what_people_say_meta_box_nonce'] ) ) return;

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['what_people_say_meta_box_nonce'], 'what_people_say_meta_box' ) ) return;

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) return;
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	}	
	
	// Sanitize user input.
	$People_Position = sanitize_text_field( $_POST['People_Position'] );
	
	// Update the meta field in the database.
	update_post_meta( $post_id, 'People_Position', $People_Position );
}

/**
 * 	si en algun momento se quiere volver a poner las demas partes del formulario de crear propiedad
 * 
  *			<li><a href="#tabs-2"><?php esc_html_e('Comodidades','dreamvilla-multiple-property'); ?></a></li>
 	*		<li><a href="#tabs-3"><?php esc_html_e('Interior','dreamvilla-multiple-property'); ?></a></li>
 	*		<li><a href="#tabs-4"><?php esc_html_e('Exterior','dreamvilla-multiple-property'); ?></a></li>
  	*		<li><a href="#tabs-7"><?php esc_html_e('Agente','dreamvilla-multiple-property'); ?></a></li>
 	*		<li><a href="#tabs-13"><?php esc_html_e('Planta baja','dreamvilla-multiple-property'); ?></a></li>
 	*		<li><a href="#tabs-14"><?php esc_html_e('Documentos','dreamvilla-multiple-property'); ?></a></li>
 	*		<li><a href="#tabs-15"><?php esc_html_e('Sub Propiedad','dreamvilla-multiple-property'); ?></a></li>
 	*		<li><a href="#tabs-11"><?php esc_html_e('Cerca de ','dreamvilla-multiple-property'); ?></a></li>
 *
 *			<?php require_once get_template_directory() . '/inc/backend/property-backend/amenities.php'; ?>

*			<?php require_once get_template_directory() . '/inc/backend/property-backend/interior.php'; ?>

*			<?php require_once get_template_directory() . '/inc/backend/property-backend/exterior.php'; ?>
  
 * 			<?php require_once get_template_directory() . '/inc/backend/property-backend/agent.php'; ?>

  *			<?php require_once get_template_directory() . '/inc/backend/property-backend/near-by-place.php'; ?>

  *         <?php require_once get_template_directory() . '/inc/backend/property-backend/foor-plan.php'; ?>

*			<?php require_once get_template_directory() . '/inc/backend/property-backend/documents.php'; ?>

*			<?php require_once get_template_directory() . '/inc/backend/property-backend/sub-property.php'; ?>
 * 
 * 
 */


?>