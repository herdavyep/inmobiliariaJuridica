<?php

	vc_map(
			array(
				"name" 			=> "Advertise Box",
				"base" 			=> "advertisementbox",
				"description" 	=> esc_html__( "Advertisement Box", 'dreamvilla' ),
				"category" 		=> esc_html__( 'Dreamvilla Shortcodes', 'dreamvilla' ),
				"icon" 			=> "icon-wpb-maxtitle",
				"params" => array(

					array(
						"heading"      => esc_html__("Advertisement Images", "dreamvilla"),
						"description"  => esc_html__("Select Images From Media Library.", "dreamvilla"),
						"type"         => "attach_images",
						"param_name"   => "advertisement_images",
						"value"        => "",
						
					),
					array(
						"heading" 		=> esc_html__( "Advertisement Title", 'dreamvilla' ),
						"description" 	=> esc_html__( "Enter The Title", 'dreamvilla'),
						"type" 			=> "textfield",
						"param_name" 	=> "advertisement_title",
					),
					array(
						"heading" 		=> esc_html__( "Advertisement Tagline", 'dreamvilla' ),
						"description" 	=> esc_html__( "Enter The Tagline", 'dreamvilla'),
						"type" 			=> "textarea",
						"param_name" 	=> "advertisement_tagline",
					),
					array(
						"heading" 		=> esc_html__( "Show Call Us Now Block", 'dreamvilla' ),
						"description" 	=> esc_html__( "If Show Or Hide Call Us Block", 'dreamvilla'),
						"type" 			=> "dropdown",
						"param_name" 	=> "advertisement_callus",
						"value" 		=> array(
											"Yes" => "yes",
											"No" => "no",
										),
					),
					array(
						"heading" 		=> esc_html__( "Call Us Now Text", 'dreamvilla' ),
						"description" 	=> esc_html__( "Enter Your Text", 'dreamvilla'),
						"type" 			=> "textfield",
						"param_name" 	=> "call_us_title",						
					),
					array(
						"heading" 		=> esc_html__( "Call Us Now Telephone Number", 'dreamvilla' ),
						"description" 	=> esc_html__( "Enter Your Contact Telephone Number", 'dreamvilla'),
						"type" 			=> "textfield",
						"param_name" 	=> "callus_telephone",
					),
					array(
						"heading" 		=> esc_html__( "Touch Button Text", 'dreamvilla' ),
						"description" 	=> esc_html__( "Enter Button Text", 'dreamvilla'),
						"type" 			=> "textfield",
						"param_name" 	=> "touch_text",
						"value"         => "",
					),
					array(
						"heading" 		=> esc_html__( "Touch Button Url", 'dreamvilla' ),
						"description" 	=> esc_html__( "Enter Button Url", 'dreamvilla'),
						"type" 			=> "textfield",
						"param_name" 	=> "touch_url",
					),

				),
			)
	);

?>