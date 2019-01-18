<?php

	vc_map(
			array(
				"name" 			=> "Testimonial",
				"base" 			=> "testimonialbox",
				"description" 	=> esc_html__( "Testimonials", 'dreamvilla' ),
				"category" 		=> esc_html__( 'Dreamvilla Shortcodes', 'dreamvilla' ),
				"icon" 			=> "icon-wpb-maxtitle",
				"params" => array(

					array(
		                "type" 			=> "dropdown",
		                "heading" 		=> esc_html__( "Type", 'dreamvilla' ),
		                "param_name" 	=> "type",
		                "value" 		=> array(
												"Type 0" => '0',
												"Type 1" => '1',
										   ),
		                "description" => esc_html__( "You can choose among these pre-designed types.", 'dreamvilla')
		            ),
		            					
				),
			)
	);

?>