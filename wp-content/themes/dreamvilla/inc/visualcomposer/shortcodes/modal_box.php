<?php

	vc_map(
			array(
				"name" 			=> "Modal Box",
				"base" 			=> "modalbox",
				"description" 	=> esc_html__( "Modal + Popup", 'dreamvilla' ),
				"category" 		=> esc_html__( 'Dreamvilla Shortcodes', 'dreamvilla' ),
				"icon" 			=> "icon-wpb-maxtitle",
				"params" => array(

					array(
						"heading" 		=> esc_html__( "Modal Box Id", 'dreamvilla' ),
						"description" 	=> esc_html__( "Enter Box Id To Open Modalbox / Popup", 'dreamvilla'),
						"type" 			=> "textfield",
						"param_name" 	=> "modalbox_id",
					),
					array(
						"heading"      => esc_html__("Modal Box Images", "dreamvilla"),
						"description"  => esc_html__("This Image Display In Your Page / Post. Select Images From Media Library.", "dreamvilla"),
						"type"         => "attach_images",
						"param_name"   => "modalbox_images",
						"value"        => "",
					),
					array(
						"heading" 		=> esc_html__( "Modal Box Title", 'dreamvilla' ),
						"description" 	=> esc_html__( "Enter The Title", 'dreamvilla'),
						"type" 			=> "textfield",
						"param_name" 	=> "modalbox_title",
					),
					array(
			            "type" => "textarea_html",
			            "holder" => "div",
			            "class" => "",
			            "heading" => __( "Content", "my-text-domain" ),
			            "param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
			            "value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "my-text-domain" ),
			            "description" => __( "Enter your content.", "my-text-domain" )
			         ),
					array(
						"heading" 		=> esc_html__( "Modal Box Close Button", 'dreamvilla' ),
						"description" 	=> esc_html__( "If Show Or Hide Close Button", 'dreamvilla'),
						"type" 			=> "dropdown",
						"param_name" 	=> "modalbox_button",
						"value" 		=> array(
											"Yes" => "yes",
											"No" => "no",
										),
					),

				),
			)
	);

?>