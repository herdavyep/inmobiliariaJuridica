<?php

vc_map(
	array(
		"name" 			=> "Max Title",
		"base" 			=> "maxtitle",
		"description" 	=> esc_html__( "MaxTitle", 'dreamvilla' ),
		"category" 		=> esc_html__( 'Dreamvilla Shortcodes', 'dreamvilla' ),
		"icon" 			=> "icon-wpb-maxtitle",
		"params" => array(

			array(
				"heading" 		=> esc_html__( "Type", 'dreamvilla' ),
				"description" 	=> esc_html__( "Title Type", 'dreamvilla'),
				"type" 			=> "dropdown",
				"param_name" 	=> "type",
				"value" => array(
								"Maxtitle 1" => "1",
								"Maxtitle 2" => "2",
								"Maxtitle 3" => "3",
								"Maxtitle 4" => "4",
								"Maxtitle 5" => "5",
								"Maxtitle 6" => "6",
							),
			),

			array(
				"heading" 		=> esc_html__( "Heading", 'dreamvilla' ),
				"description" 	=> wp_kses( __( "Just for SEO<br>Note: it doesn\'t change the size of the max title in the page.", 'dreamvilla'), array( 'br' => array() ) ),
				"type" 			=> "dropdown",
				"param_name" 	=> "heading",
				"value" => array(
								"h1" => '1',
								"h2" => '2',
								"h3" => '3',
								"h4" => '4',
								"h5" => '5',
								"h6" => '6',
							),
				"std" => '2',
			),

			array(
				"heading" 		=> esc_html__( "Position", 'dreamvilla' ),
				"description" 	=> wp_kses( __( "Position of the title text.", 'dreamvilla'), array( 'br' => array() ) ),
				"type" 			=> "dropdown",
				"param_name" 	=> "position",
				"value" => array(
								"Left" =>  'left',
								"Center" => 'center',
								"Right" => 'right',
							),
			),

			array(
				"heading" 		=> esc_html__( "Title", 'dreamvilla' ),
				"description" 	=> esc_html__( "Enter the title", 'dreamvilla'),
				"type" 			=> "textfield",
				"param_name" 	=> "maxtitle_content",
			),

			array(
				'heading'		=> esc_html__( 'Title Text Color', 'dreamvilla' ),
				'type'			=> 'colorpicker',
				'param_name'	=> 'maxtitle_color',
				'value'			=> '',
			),

			array(
				'heading' 		=> esc_html__('Show Title Icon/Link After/Before', 'dreamvilla') ,
				'description' 	=> esc_html__('Enable an Icon/Link pointing at the title.', 'dreamvilla'),
				'param_name' 	=> 'title_marker',
				'value' 		=> array( esc_html__( 'Enable', 'dreamvilla' ) => 'enable'),
				'type' 			=> 'checkbox'				
			),

			array(
				'heading' 		=> esc_html__('Select Style', 'dreamvilla') ,
				'param_name' 	=> 'title_style',
				'description' 	=> '<br/>',				
				"value" 		=> array(
										"None" 				=> 'none',
										"Title With Line" 	=> 'title_with_line',
										"Title With Icon" 	=> 'title_with_icon',
									),
				'type' 			=> 'dropdown',
				'dependency'	=> array(
										'element' => 'title_marker',
										'value'   => 'enable'
									),
			),

            array(
				'heading' 		=> esc_html__('Line Postion', 'dreamvilla') ,
				'param_name' 	=> 'title_icon_postion',
				'description' 	=> '<br/>',				
				"value" 		=> array(
										"After" => 'after',
										"Before" => 'before'
									),
				'type' 			=> 'dropdown',
				'dependency'	=> array(
										'element' => 'title_style',
										'value'   => array('title_with_line')
									),
			),

			array(
				'heading' 		=> esc_html__('Line Alignment', 'dreamvilla') ,
				'param_name' 	=> 'title_icon_alignment',
				'description' 	=> '<br/>',				
				"value" 		=> array(
										"Left" => "left",
										"Center" => "center",
										"Right" => "right",
									),
				'type' 			=> 'dropdown',
				'dependency'	=> array(
										'element' => 'title_style',
										'value'   => array('title_with_line')
									),
			),
		),
	) 
);

?>