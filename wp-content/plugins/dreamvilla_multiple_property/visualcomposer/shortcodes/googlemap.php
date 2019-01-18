<?php

// Google Map
function dreamvilla_google_map($atts, $content = null) {
	extract(shortcode_atts(array(
		"latitude" => 0,
		"longitude" => 0,
		"maptype" => 'ROADMAP',
		"map_style" => '',
		"zoom" => 11,
		"marker" => 'enable',
		"marker_img" => '',		
		"scrollwheel" => '',
		"width" => '250px',
		"height" => '250px'
	), $atts));
	
	//echo get_template_directory_uri().'/images/map_marker.png';

	$width 	= ( $width && is_numeric($width) )? 'width:'.$width.'px;' : '';
	$height = ( $height && is_numeric($height) )? 'height:'.$height.'px;' : '';	
	$id 	= rand(100,1000);
	ob_start(); ?>
	
	<div class="location-map">
		<div id="googleMap<?php echo esc_attr($id); ?>" style="<?php echo esc_attr($width) ?><?php echo esc_attr($height) ?>"></div>
	</div>
	<?php
	$property_lat_lon = array($latitude,$longitude);

	if( !empty($marker_img) )
		$marker_icon = wp_get_attachment_url($marker_img, "full");
	else
		$marker_icon = get_template_directory_uri().'/images/map_marker.png'; ?>

	<script type="text/javascript">
		jQuery(document).ready(function(){
			function initialize(){
				var myCenter = new google.maps.LatLng("<?php echo esc_js($property_lat_lon[0]); ?>","<?php echo esc_js($property_lat_lon[1]); ?>");
				var mapProp = {
								center:myCenter,
								zoom:<?php echo $zoom ?>,	
								mapTypeId:google.maps.MapTypeId.<?php echo $maptype; ?>,
								scrollwheel: <?php echo $scrollwheel == 'enable' ? 'true' : 'false' ?>,
								<?php if( !empty($map_style) ) { ?>
									styles: <?php echo rawurldecode( base64_decode( strip_tags( $map_style ) ) );
								} ?>
							};
				var map = new google.maps.Map(document.getElementById("googleMap<?php echo esc_js($id); ?>"),mapProp);
				
				<?php if($marker == 'enable'): ?>
					var marker = new google.maps.Marker({position:myCenter,icon:'<?php echo esc_js($marker_icon); ?>'});
					marker.setMap(map);
				<?php endif ?>
			}

			google.maps.event.addDomListener(window,'load',initialize);
		});							
	</script><?php
	$out = ob_get_contents();
	ob_end_clean();
	$out = str_replace('<p></p>','',$out);
	
	return $out;
}
add_shortcode('google_map','dreamvilla_google_map');

?>