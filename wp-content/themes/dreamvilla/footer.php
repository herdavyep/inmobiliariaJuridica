<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage DreamVilla
 * @since DreamVilla 1.0
 */

wp_reset_query();

global $post;
	
$footer_show = null;
$footer_show = rwmb_meta( 'dreamvilla_footer_show' );

$dreamvilla_options = get_option('dreamvilla_options');

if( $footer_show == 1 ){
	$dreamvilla_options = get_option('dreamvilla_options');
	$Footer_Page = new WP_Query( array( 'page_id' => $dreamvilla_options["Theme_Page_Footer_Page"], 'post_type' => 'page' ) );
	if( $Footer_Page->have_posts() ) {
		while ($Footer_Page->have_posts()) : $Footer_Page->the_post(); ?>
	  		<?php printf( esc_html__('%s','dreamvilla-multiple-property'),the_content());
		endwhile;
		wp_reset_query();
	}
} ?>
<script type="text/javascript">
	jQuery(".form-search-custom").parent().css("background", "none");
	jQuery(".form-search-custom").parent().attr("style", "padding: 0 !important");
	jQuery(".form-search-custom").parent().find(".blogimagedescription").remove();
</script>
<div class="modal fade" id="image_lightbox" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title image_lightbox_label"><?php esc_html_e('Title','dreamvilla-multiple-property'); ?></h4>
			</div>
			<div class="modal-body">
				<img src="javascript:void(0)" alt="propertyimg" class="img-responsive">
				<button type="button" class="previous_image_btn"><span class="glyphicon glyphicon-menu-left"></span></button>
				<button type="button" class="next_image_btn"><span class="glyphicon glyphicon-menu-right"></span></button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="login-register-model" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content" id="model-login-register">
			<!-- <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>				
			</div> -->
			<div class="modal-body">
				<div class="login-forms-container login-register-form-model">
					<div class="login-form-window">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>	
						<?php get_template_part('inc/frontend/members/login/login-form'); ?>
						<?php get_template_part('inc/frontend/members/register/register-form'); ?>
						<?php get_template_part('inc/frontend/members/reset-password/reset-password'); ?>
					</div>
				</div>
				<p>&nbsp;</p>						
			</div>
		</div>
	</div>
</div>
<?php

if( !empty( $dreamvilla_options['homepage_with_slider_map']) && $dreamvilla_options['homepage_with_slider_map'] == "homepage_with_map" ){ ?>
	<script>
		jQuery(document).ready(function(){				
			jQuery(".property-type li a").click(function(){
				"use strict";
				var id = "all-proeprty";
				var ajaxurl = "<?php echo esc_js(admin_url('admin-ajax.php')); ?>";
				var i = 0;
				var markers;
			    jQuery.ajax({
			    url:ajaxurl,
			      data: {
			          'action'  : 'dreamvilla_mp_ajax_load_map_property',
			          'id'		: id,
			      },
			    }).done(function(data){
			      	data = jQuery.parseJSON( data );
					function dreamvilla_mp_property_listing_map_reinitialize() {
						var map;
					    var bounds = new google.maps.LatLngBounds();
					    var mapOptions = {
					        mapTypeId: 'roadmap',
					        scrollwheel: false,
							styles: <?php echo $dreamvilla_options["dreamvilla_map_style"]; ?>
					    };
					                    
					    // Display a map on the page
					    map = new google.maps.Map(document.getElementById("property-listing-map"), mapOptions);
					    map.setTilt(45);
					    // Multiple Markers
					    markers = data.markers;
					    var infoWindowContent = data.infoWindowContent;
					    // Display multiple markers on a map
					    var infoWindow = new google.maps.InfoWindow({Width: 365,Height: 350}), marker, i;
					    
					    // Loop through our array of markers & place each one on the map  
					    var data_markers = [];
						for( i = 0; i < markers.length; i++ ) {
					        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
					        bounds.extend(position);
					        
					        var marker = new google.maps.Marker({ 
								position: position,
								map: map,
					            title: markers[i][0],
					            icon : '<?php echo esc_url(get_template_directory_uri()); ?>/images/map_marker.png'
							});
							data_markers.push(marker);						
					        
					        // Allow each marker to have an info window    
					        google.maps.event.addListener(marker, 'click', (function(marker, i) {
					            return function() {                
					                infoWindow.setContent(infoWindowContent[i]);
					                infoWindow.open(map, marker);
					            }
					        })(marker, i));
					
					        // Automatically center the map fitting all markers on the screen
					        map.fitBounds(bounds);
					    }
					    
					    var clusterStyles = [{ textColor: 'white', textSize: '15', url: '<?php echo esc_url(get_template_directory_uri()); ?>/images/google-culster-icon.png', width: 60, height: 63 }];
					    var mcOptions = { styles: clusterStyles };
					    var markerCluster = new MarkerClusterer(map, data_markers, mcOptions);
					
					    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
					    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
					        google.maps.event.removeListener(boundsListener);
					    });
					}
					if(document.getElementById('property-listing-map') != null ){
						google.maps.event.addDomListener(window, 'load', dreamvilla_mp_property_listing_map_reinitialize);
						dreamvilla_mp_property_listing_map_reinitialize();
					}	
				});
			});
		});
	</script><?php
}

if( !empty($dreamvilla_options['google_recaptcha_site_key']) )
	$google_recaptcha_site_key = $dreamvilla_options['google_recaptcha_site_key'];
else
	$google_recaptcha_site_key = '';

if( !empty($dreamvilla_options['google_recaptcha_site_key'] ) ){
	$google_recaptcha_site_key = $dreamvilla_options['google_recaptcha_site_key'];
}

$show_google_recaptcha = $dreamvilla_options['show_google_recaptcha'];
$google_recaptcha_site_key = $dreamvilla_options['google_recaptcha_site_key'];

if( ( isset($_POST['sprice']) && !empty($_POST['sprice']) ) || ( isset($_POST['eprice']) && !empty($_POST['eprice']) ) ){
	
	if( !empty($_POST['sprice']) )
		$select_pricestart = $_POST['sprice'];
	else
		$select_pricestart = $dreamvilla_options['pricestart'];

	if( !empty($_POST['eprice']) )
		$select_priceend = $_POST['eprice'];
	else
		$select_priceend = $dreamvilla_options['priceend'];

	if( empty($select_pricestart) )		
		$select_pricestart = "0";

	if( empty($select_priceend) )		
		$select_priceend = "1000000";
}

if( !empty($dreamvilla_options['pricestart'] ))
	$pricestart = $dreamvilla_options['pricestart'];
else
	$pricestart = "0";

if( !empty($dreamvilla_options['priceend'] ))
	$priceend = $dreamvilla_options['priceend'];
else
	$priceend = "1000000";

if( empty($select_pricestart) ){
	$select_pricestart = $pricestart;
}

if( empty($select_priceend) ){
	$select_priceend = $priceend;
} ?>
<script src="https://www.google.com/recaptcha/api.js?onload=myCallBack&render=explicit" async defer></script>
<script>
	var single_property_recaptcha_id;
	var location_v1_recaptcha_id;

	var show_google_recaptcha = "<?php echo esc_js($show_google_recaptcha); ?>";
	var google_recaptcha_site_key = "<?php echo esc_js($google_recaptcha_site_key); ?>";

	if( show_google_recaptcha == "yes" && google_recaptcha_site_key != "" ){
		var myCallBack = function() {
			
			if( !(document.getElementById("single-property") === null) ){
				single_property_recaptcha_id = grecaptcha.render('single-property', {
					'sitekey' : '<?php echo $google_recaptcha_site_key; ?>'
				});
			}	

			if( !(document.getElementById("location-version1") === null) ){
				location_v1_recaptcha_id = grecaptcha.render('location-version1', {
					'sitekey' : '<?php echo $google_recaptcha_site_key; ?>'
				});
			}
		};
	}
	
	jQuery(document).ready(function(){
		"use strict";

		jQuery('.selectpicker').selectpicker();

		jQuery( "#property-price-range" ).slider({
			range: true,
			min: <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$pricestart); ?>,
			max: <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$priceend); ?>,
			values: [ "<?php echo esc_js($select_pricestart); ?>", "<?php echo esc_js($select_priceend); ?>" ],
			slide: function( event, ui ) {
				jQuery( "#amount" ).val( "<?php echo esc_js($dreamvilla_options['currencysymbol']); ?>" + ui.values[ 0 ] + " - <?php echo esc_js($dreamvilla_options['currencysymbol']); ?>" + ui.values[ 1 ] );
				jQuery( "#sprice" ).val( ui.values[ 0 ] );
				jQuery( "#eprice" ).val( ui.values[ 1 ] );
			}
		});
		
		jQuery( "#amount" ).val( "<?php echo esc_js($dreamvilla_options['currencysymbol']); ?>" + jQuery( "#property-price-range" ).slider( "values", 0 ) + " - <?php echo esc_js($dreamvilla_options['currencysymbol']); ?>" + jQuery( "#property-price-range" ).slider( "values", 1 ) );

	});
</script>
<?php
$dreamvilla_options = get_option('dreamvilla_options'); 
$show_google_recaptcha = $dreamvilla_options['show_google_recaptcha'];
$google_recaptcha_site_key = $dreamvilla_options['google_recaptcha_site_key']; ?>

<script type="text/javascript">
jQuery(".plugin-agnet-contact-form-contact-page").submit(function(event){
 		
	event.preventDefault();

	var show_google_recaptcha = "<?php echo esc_js($show_google_recaptcha); ?>";
	var google_recaptcha_site_key = "<?php echo esc_js($google_recaptcha_site_key); ?>";
	
	if( show_google_recaptcha == "yes" && google_recaptcha_site_key != "" && grecaptcha.getResponse(single_property_recaptcha_id) == "" ) {
	    alert("Please fill recaptcha!");
	} else {
		var ajaxurl = "<?php echo esc_js(admin_url('admin-ajax.php')); ?>";
		
		var full_name 			= jQuery('.full_name').val();
	 	var p_number 			= jQuery('.p_number').val();
		var email_address		= jQuery('.email_address').val();
		var message 			= jQuery('.message').val();
		var agent_email_address = jQuery('.agent_email_address').val();

		jQuery.ajax({
		    url:ajaxurl,
		    dataType: "json",
		    data: {
				'action'				: 'dreamvilla_mp_send_visiter_message',
				'full_name' 			: full_name,
				'phone_number' 			: p_number,
				'email_address' 		: email_address,
				'message' 				: message,
				'agent_email_address' 	: agent_email_address
	      	},
	    }).done(function(data){
	      	jQuery("#agent-contact-area .special-contact-form-div .message_area_bottom .alert").remove();
	        if( data.mail_info == "success" ){
	        	jQuery("#agent-contact-area .special-contact-form-div .message_area_bottom").append("<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok'></i> <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['sendinquirysuccessmessage']); ?> </div>");
	        } else {
	        	jQuery("#agent-contact-area .special-contact-form-div .message_area_bottom").append("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-remove'></i> <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['sendinquiryfailedmessage']); ?> </div>");
	        }        
	    });		
	}
});
</script>
<?php wp_footer(); ?>
</body>
</html>
