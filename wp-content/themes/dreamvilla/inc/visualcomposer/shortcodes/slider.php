<?php

vc_map(
	array(
		"name" 			=> "Slider",
		"base" 			=> "dreamvilla_slider",
		"description" 	=> esc_html__( "Dreamvilla Slider", 'dreamvilla'),
		"category" 		=> esc_html__( 'Dreamvilla Shortcodes', 'dreamvilla' ),
		"icon" 			=> "icon-wpb-maxtitle",
		"params" => array(

			array(
				"type"        => "exploded_textarea",
				"holder"      => "",
				"heading"     => esc_html__("Title for each Dimension", 'dreamvilla'),
				"param_name"  => "dimension_title",
				"value"       => esc_html__("Dimension,Dimension,Dimension", 'dreamvilla'),
				"description" => esc_html__("Enter title for each dimension here. Divide each with linebreaks (Enter).", 'dreamvilla')
			),

			array(
				"type"        => "exploded_textarea",
				"holder"      => "",
				"heading"     => esc_html__("Dimension for each Area", 'dreamvilla'),
				"param_name"  => "dimension",
				"value"       => esc_html__("25X25,20X60,10X12", 'dreamvilla'),
				"description" => esc_html__("Enter dimension for each area here. Divide each with linebreaks (Enter).", 'dreamvilla')
			),			

			array(
				"type"        => "attach_images",
				"heading"     => esc_html__("Area Images", "dreamvilla"),
				"param_name"  => "images",
				"value"       => "",
				"description" => esc_html__("Select images from media library.", "dreamvilla")
			),

			array(
				'heading'		=> esc_html__( 'Caption Color', 'dreamvilla' ),
				'type'			=> 'colorpicker',
				'param_name'	=> 'caption_color',
				'value'			=> '',
			),

			array(
				'heading'		=> esc_html__( 'Caption Background Color', 'dreamvilla' ),
				'type'			=> 'colorpicker',
				'param_name'	=> 'caption_bk_color',
				'value'			=> '',
			),

			array(
				'type'			=> 'checkbox',
				'heading'		=> esc_html__( 'Show Slider border?', 'dreamvilla' ),
				'param_name'	=> 'slider_border',
				'value'			=> array( esc_html__( 'Yes', 'dreamvilla' ) => 'slider-image-border' )
			),

			array(
                "type" 			=> "dropdown",
                "heading" 		=> esc_html__( "Caption Position", 'dreamvilla' ),
                "param_name" 	=> "caption_position",
                "value" 		=> array(
										"Top Left" 		=> 'top-left',
										"Top Right" 	=> 'top-right',
										"Bottom Left" 	=> 'bottom-left',
										"Bottom Right" 	=> 'bottom-right'
								   ),
                "description" => esc_html__( "You can choose among these pre-position types.", 'dreamvilla')
            ),

		),
	) 
);

?>