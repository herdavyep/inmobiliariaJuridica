<?php
/*
 *  Template Name:Proepty Listing Map
 */

get_header();

$dreamvilla_options = get_option('dreamvilla_options');
?>
<div>
	<div class="property-listing multiple-recent-properties property-listing-map-parent <?php if( !empty($dreamvilla_options['dreamvilla_header_variation']) && $dreamvilla_options['dreamvilla_header_variation'] == 2 ) { echo "property-listing-map-parent-padding"; } ?>" >
		<div class="container">
			<div class="row">
				<div class="col-md-9 property-type-menu">
					<ul class="property-type">
						<li><a data-id="all-proeprty" class="active" href="javascript:void(0);"><?php esc_html_e('All','dreamvilla-multiple-property'); ?></a></li>
						<?php
						$category=get_terms( 'property_category', array( 'taxonomy' => 'property_category' ) );
						if($category){
							$flag=0;
							foreach($category as $cat){?>
								<li><a href="javascript:void(0);" data-id="<?php echo esc_attr($cat->term_id);?>"><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$cat->name);?></a></li>
							<?php $flag=1; }
						} ?>
					</ul>
				</div>
				<div>
				</div>
			</div>
			<div class="row property-list-area property-list-map-area">
				<div class="property-list-map">
					<div id="property-listing-map" class="multiple-location-map" style="width:100%;height:1050px;"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	jQuery(document).ready(function(){
		jQuery(".property-type li a").click(function(){
			"use strict";
			var id=jQuery(this).attr("data-id");
			var ajaxurl = "<?php echo esc_js(admin_url('admin-ajax.php')); ?>";
			var i=0;
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
</script>
<?php
	get_footer();
?>
