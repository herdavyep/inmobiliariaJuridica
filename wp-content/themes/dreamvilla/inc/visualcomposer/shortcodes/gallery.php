<?php

vc_map( 
	array(
		"name" 			=> esc_html__("Dreamvilla Gallery", 'dreamvilla'),
		"base" 			=> "dreamvilla_gallery",		
		'description' 	=> esc_html__('Gallery', 'dreamvilla'),
		'category' 		=> esc_html__( 'Dreamvilla Shortcodes', 'dreamvilla' ),
		"icon" 			=> 'dreamvilla_gallery',
		"params" => array(
		   	
			array(
			   "type" 			=> "textfield",
			   "holder" 		=> "div",
			   "class" 			=> "",
			   "heading" 		=> esc_html__('Posts In One Row', 'dreamvilla' ),
			   "param_name" 	=> "row_number",
			   "description" 	=> esc_html__('Enter The Number of gallery posts to Show in one row.', 'dreamvilla' )
			),

			array(
			   "type" 			=> "textfield",
			   "holder" 		=> "div",
			   "class" 			=> "",
			   "heading" 		=> esc_html__('Number', 'dreamvilla' ),
			   "param_name" 	=> "number",
			   "description" 	=> esc_html__('Enter The Number of gallery posts to Show.', 'dreamvilla' )
			),			

			array(
			   "type" 			=> "textfield",
			   "holder" 		=> "div",
			   "class" 			=> "",
			   "heading" 		=> esc_html__('Included Category IDs', 'dreamvilla' ),
			   "param_name" 	=> "include_cats",
			   "description" 	=> esc_html__('Enter included cats ids to add.', 'dreamvilla' )
			),

			array(
			   "type" 			=> "dropdown",
			   "holder" 		=> "div",
			   "class" 			=> "",
			   "heading" 		=> esc_html__("Order By", 'dreamvilla'),
			   "param_name" 	=> "sort",
			   'value' 			=> array_flip( array('date' => esc_html__('Date', 'dreamvilla'),'title' => esc_html__('Title', 'dreamvilla') ,'name' => esc_html__('Name', 'dreamvilla') ,'author' => esc_html__('Author', 'dreamvilla'),'comment_count' => esc_html__('Comment Count', 'dreamvilla'),'random' => esc_html__('Random', 'dreamvilla') ) ),			
			   "description" 	=> esc_html__("Enter the sorting order.", 'dreamvilla')
			),

			array(
			   "type" 			=> "dropdown",
			   "holder" 		=> "div",
			   "class" 			=> "",
			   "heading" 		=> esc_html__("Order", 'dreamvilla'),
			   "param_name" 	=> "order",
			   'value' 			=> array_flip(array('ASC' => esc_html__('Ascending', 'dreamvilla'),'DESC' => esc_html__('Descending', 'dreamvilla') ) ),			
			   "description" 	=> esc_html__("Enter the sorting order.", 'dreamvilla')
			),	
		)
	)
);

?>