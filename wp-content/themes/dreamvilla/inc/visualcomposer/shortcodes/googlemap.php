<?php
vc_map( 
	array(
	    'name' 			=> 'Dreamvilla GoogleMap',
	    'base' 			=> 'google_map',
		'description' 	=> esc_html__('Google map', 'dreamvilla'),
	    'icon' 			=> 'dreamvilla_map',
		'category' 		=> esc_html__( 'Dreamvilla Shortcodes', 'dreamvilla' ),
	    'params'=> array(

				array(
					'heading' 		=> esc_html__('Latitude', 'dreamvilla') ,
					'description' 	=> wp_kses( __('This option is not necessary if an address is set.<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ),
					'param_name' 	=> 'latitude',
					'type' 			=> 'textfield',
				),

				array(
					'heading' 		=> esc_html__('Longitude', 'dreamvilla') ,
					'description' 	=> wp_kses( __('This option is not necessary if an address is set.<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ),
					'param_name' 	=> 'longitude',
					'type' 			=> 'textfield',
				),

				array(
					'heading' 		=> esc_html__('MapType', 'dreamvilla') ,
					'param_name' 	=> 'maptype',
					'description' 	=> '<br/>',
					'std' 			=> 'ROADMAP',
					"value" 		=> array(
											"Default road map"					=> 'ROADMAP',
											"Google Earth satellite"			=> 'SATELLITE',
											"Mixture of normal and satellite"	=> 'HYBRID',
											"Physical map"						=> 'TERRAIN',
										),
					'type' 			=> 'dropdown',
				),

				array(
					'heading' 		=> esc_html__('Map Style', 'dreamvilla') ,
					'description' => sprintf(wp_kses( __('Change the map style. Please refer to the <a href="%s" title="Google Maps Change Style">Google Map Style</a> for details.<br/><br/>', 'easyweb'), array( 'a' => array( 'href' => array(), 'title' => array() ), 'br' => array() ) ), 'https://snazzymaps.com/'),
					'param_name' 	=> 'map_style',
					'type' 			=> 'textarea_raw_html',
				),

				array(
					'heading' 		=> esc_html__('Zoom', 'dreamvilla') ,
					'description' 	=> wp_kses( __('Default map zoom level. (1-19)<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ),
					'param_name' 	=> 'zoom',
					'std' 			=> '17',
					'type' 			=> 'textfield'
				),

				array(
					'heading' 		=> esc_html__('Marker', 'dreamvilla') ,
					'description' 	=> wp_kses( __('Enable an arrow pointing at the address.<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ),
					'param_name' 	=> 'marker',
					'value' 		=> array( esc_html__( 'Enable', 'dreamvilla' ) => 'enable'),
					'type' 			=> 'checkbox',
					'std' 			=> 'enable',
				),

				array(
	                "type" 			=> "attach_image",
	                "heading" 		=> esc_html__( "Marker Image", 'dreamvilla' ),
	                "param_name" 	=> "marker_img",
	                'value'			=> '',
	                "description" 	=> esc_html__( "Select Marker Image instead of Default Marker Image.", 'dreamvilla' ),
	                'dependency'	=> array(
										'element' => 'marker',
										'value'   => 'enable'
									),
	            ),
				
				array(
					'heading' 		=> esc_html__('Scrollwheel', 'dreamvilla') ,
					'param_name' 	=> 'scrollwheel',
					'description' 	=> '<br/>',
					'value' 		=> array( esc_html__( 'Enable', 'dreamvilla' ) => 'enable' ),
					'type' 			=> 'checkbox'
				),				

				array(
					'heading' 		=> esc_html__('Width (optional)', 'dreamvilla') ,
					'description' 	=> wp_kses( __('Default is 250. Set to 0 is the full width. (0-960)<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ) ,
					'param_name' 	=> 'width',
					'std' 			=> '0',
					'type' 			=> 'textfield'
				),	
				
				array(
					'heading' 		=> esc_html__('Height', 'dreamvilla') ,
					'description' 	=> wp_kses( __('Default is 250.<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ) ,
					'param_name' 	=> 'height',
					'std' 			=> '400',
					'type' 			=> 'textfield'				
				),
			),	        
	)
);

?>