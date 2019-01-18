<?php

vc_map( array(
        "name" 			=> "Icon Box",
        "base" 			=> "iconbox",
        "description" 	=> esc_html__( "Icon + Text Article", 'dreamvilla'),
		"icon" 			=> "dreamvilla_iconbox",
        "category" 		=> esc_html__( 'Dreamvilla Shortcodes', 'dreamvilla' ),
        "params" => array(

        	array(
                "type" 			=> "dropdown",
                "heading" 		=> esc_html__( "Type", 'dreamvilla' ),
                "param_name" 	=> "type",
                "value" 		=> array(
										"Type 0" => '0',
										"Type 1" => '1',
										"Type 2" => '2',
										"Type 3" => '3',
										"Type 4" => '4',
								   ),
                "description" => esc_html__( "You can choose among these pre-designed types.", 'dreamvilla')
            ),

			array(
				"type"			=> 'textarea',
				"heading"		=> esc_html__('Title', 'dreamvilla'),
				"param_name"	=> "icon_title",
				"value"			=> "",
				"description" 	=> esc_html__( "IconBox Title", 'dreamvilla')
			),

			array(
				"type" 			=> "textarea",
				"heading" 		=> esc_html__( "Text", 'dreamvilla' ),
				"param_name" 	=> "icon_data",				
				"description" 	=> esc_html__( "Enter the taglines", 'dreamvilla'),
				'dependency'	=> array(
										'element' => 'type',
										'value'   => array('0','1','2','3','4'),
									),
			),

			array(
                "type" 			=> "attach_image",
                "heading" 		=> esc_html__( "Image", 'dreamvilla' ),
                "param_name" 	=> "icon_image",
                'value'			=> '',
                "description" 	=> wp_kses( __( "Select Image instead of Icons.<br>Note: If you have another Icon that not is here. You can put PNG image of that instead of these Icons.", 'dreamvilla'), array( 'br' => array() ) ),
                'dependency'	=> array(
										'element' => 'type',
										'value'   => array('0','2','3','4'),
									),
            ),
			
            array(
				"type"			=> 'textfield',
				"heading"		=> esc_html__('Icon Size (leave blank for default size)', 'dreamvilla'),
				"param_name"	=> "icon_size",
				"value"			=> "",
				"description" 	=> esc_html__( "Icon size in px format, Example: 30px", 'dreamvilla'),
				'dependency'	=> array(
										'element' => 'type',
										'value'   => array('0','1','2'),
									),
				
			),

			array(
				"type"			=> 'colorpicker',
				"heading"		=> esc_html__('Icon color (leave blank for default color)', 'dreamvilla'),
				"param_name"	=> "icon_color",
				"value"			=> "",
				"description" 	=> esc_html__( "Select icon color", 'dreamvilla'),
				'dependency'	=> array(
										'element' => 'type',
										'value'   => array('0','1','2'),
									),		
			),

			array(
				"type"			=> 'colorpicker',
				"heading"		=> esc_html__('Icon background color (leave blank for default background color)', 'dreamvilla'),
				"param_name"	=> "icon_bg_color",
				"value"			=> "",
				"description" 	=> esc_html__( "Select icon background color", 'dreamvilla'),
				'dependency'	=> array(
										'element' => 'type',
										'value'   => array('0','2'),
									),
			),

			array(
                "type" 			=> "iconfonts",
                "heading" 		=> esc_html__( "Icon", 'dreamvilla' ),
                "param_name" 	=> "icon_name",
                'value'			=> '',
                "description" 	=> esc_html__( "Select Icon", 'dreamvilla'),
                'dependency'	=> array(
										'element' => 'type',
										'value'   => array('0','1','2'),
									),
            ),            

        ),
    ) 
);

?>