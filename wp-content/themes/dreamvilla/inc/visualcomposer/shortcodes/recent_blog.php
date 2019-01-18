<?php

$categories = array();
$categories = get_categories();

$Category_ID_Array = array('');

foreach($categories as $category){
	$Category_ID_Array[$category->term_id] = $category->name;
}

vc_map( array(
        'name' 			=> 'Recent Blog',
        'base' 			=> 'recent_blog',
		"description" 	=> esc_html__( 'Recent Blog', 'dreamvilla'),
        'category' 		=> esc_html__( 'Dreamvilla Shortcodes', 'dreamvilla' ),
        "icon" 			=> "dreamvilla_recent_blog",
		'params' => array(

			array(
                "type" 			=> "dropdown",
                "heading" 		=> esc_html__( "Select Style", 'dreamvilla' ),
                "param_name" 	=> "blog_type",
                "value" 		=> array(
										"Type 1" => '1',
										"Type 2" => '2'
								   ),
                "description" => esc_html__( "You can choose among these pre-designed types.", 'dreamvilla')
            ),

			array(
			   "type" 			=> "textfield",
			   "holder" 		=> "div",
			   "class" 			=> "",
			   "heading" 		=> esc_html__('Text Limit', 'dreamvilla' ),
			   "param_name" 	=> "text_limit",
			   "description" 	=> esc_html__('Enter Text Limit to Show.', 'dreamvilla' )
			),

			array(
			   "type" 			=> "textfield",
			   "heading" 		=> esc_html__('Number', 'dreamvilla' ),
			   "param_name" 	=> "number",
			   "description" 	=> esc_html__('Enter Number of Blog to Show.', 'dreamvilla' )
			),			

			array(
			   "type" 			=> "dropdown",
			   "heading" 		=> esc_html__( 'Category', 'dreamvilla' ),
			   "param_name" 	=> "category",
			   "value" 			=> $Category_ID_Array,
			   'description' 	=> esc_html__( 'Select specific category, leave blank to show all categories.', 'dreamvilla')
			),			

			array(
			   "type" 			=> "dropdown",
			   "heading" 		=> esc_html__("Order By", 'dreamvilla'),
			   "param_name" 	=> "sort",
			   'value' 			=> array_flip( array('date' => esc_html__('Date', 'dreamvilla'),'title' => esc_html__('Title', 'dreamvilla') ,'name' => esc_html__('Name', 'dreamvilla') ,'author' => esc_html__('Author', 'dreamvilla'),'comment_count' => esc_html__('Comment Count', 'dreamvilla'),'random' => esc_html__('Random', 'dreamvilla') ) ),			
			   "description" 	=> esc_html__("Enter the sorting order.", 'dreamvilla')
			),

			array(
			   "type" 			=> "dropdown",
			   "heading" 		=> esc_html__("Order", 'dreamvilla'),
			   "param_name" 	=> "order",
			   'value' 			=> array_flip(array('ASC' => esc_html__('Ascending', 'dreamvilla'),'DESC' => esc_html__('Descending', 'dreamvilla') ) ),			
			   "description" 	=> esc_html__("Enter the sorting order.", 'dreamvilla')
			),

		)        
    ) 
);

?>