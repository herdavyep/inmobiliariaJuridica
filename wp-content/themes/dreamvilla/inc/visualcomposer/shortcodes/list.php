<?php

vc_map( 
	array(
        'name' 			=>'Dreamvilla List',
        'base' 			=> 'ul',
		"description" 	=> esc_html__( "List + custom style", 'dreamvilla'),
        'category' 		=> esc_html__( 'Dreamvilla Shortcodes', 'dreamvilla' ),
        "icon" 			=> "dreamvilla_list",
        'params' => array(
						
						array(
							'type' 			=> 'dropdown',
							'heading' 		=> esc_html__( 'List Type', 'dreamvilla' ),
							'param_name' 	=> 'type',
							'value' 		=> array(
													'None' 		=> 'none',
													'Plus' 		=> 'plus',
													'Minus'		=> 'minus',
													'Star'		=> 'star',
													'Arrow'		=> 'arrow',
													'Arrow 2'	=> 'arrow2',
													'Square'	=> 'square',
													'Circle'	=> 'circle',
													'Cross'		=> 'cross',
													'Check'		=> 'check',
													'Check 2'	=> 'check2',
													"Map Pin"	=> 'mappin',
																		
												),
							'description' 	=> esc_html__( 'Select the List Items type', 'dreamvilla')
						),

						array(
							"type"			=> 'colorpicker',
							"heading"		=> esc_html__('Text color (leave blank for default color)', 'dreamvilla'),
							"param_name"	=> "text_color",
							"value"			=> "",
							"description" 	=> esc_html__( "Select text color", 'dreamvilla')
						),
						
						array(
							'type' 			=> 'textarea_html',
							'heading' 		=> esc_html__( 'Items', 'dreamvilla' ),
							'param_name' 	=> 'content',
							'value' 		=> '[li color=""]First Item[/li][li]Second Item[/li]',
							'description' 	=> esc_html__( 'Enter list items, you can use [li]SomeText[/li]', 'dreamvilla')
						),
        ),
    ) 
);

?>