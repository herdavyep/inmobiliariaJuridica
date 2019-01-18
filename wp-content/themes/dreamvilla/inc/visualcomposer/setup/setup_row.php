<?php

if ( class_exists( 'WPBakeryVisualComposerAbstract') ) {
	
	if(!function_exists('dreamvilla_setup_vc_row')){
		
		function dreamvilla_setup_vc_row(){
			
			vc_remove_param('vc_row', 'full_width');
			vc_remove_param('vc_row', 'gap');
			vc_remove_param('vc_row', 'full_height');
			vc_remove_param('vc_row', 'columns_placement');
			vc_remove_param('vc_row', 'equal_height');
			vc_remove_param('vc_row', 'content_placement');
			vc_remove_param('vc_row', 'video_bg');
			vc_remove_param('vc_row', 'video_bg_url');
			vc_remove_param('vc_row', 'video_bg_parallax');
			vc_remove_param('vc_row', 'parallax');
			vc_remove_param('vc_row', 'parallax_image');
			vc_remove_param('vc_row', 'parallax_speed_video');
			vc_remove_param('vc_row', 'parallax_speed_bg');
			vc_remove_param('vc_row', 'el_id');
			vc_remove_param('vc_row', 'el_class');
			vc_remove_param('vc_row', 'css');
			
			$attributes = array(
								"type" 			=> "dropdown",
								"heading" 		=> esc_html__("Select Row Type", "dreamvilla"),
								"param_name" 	=> "row_type",
								"description" 	=> esc_html__("Select row types available in theme, [row,blox,blox_dark,parallax,video background] are available", "dreamvilla"),
								"value"			=> array(
														"Default" 		=> "0",
														"FullWidth Row"	=> "1",
														"Blox"			=> "2",
														"Modal Box"		=> "3",
														"Footer"		=> "4",
													)
   						 );			
			vc_add_param('vc_row',$attributes);			
			
			$attributes = array(
								"type" 			=> "textfield",
								"heading" 		=> esc_html__("Row ID", "dreamvilla"),
								"param_name" 	=> "row_id",
								"description" 	=> esc_html__("Enter the row ID", "dreamvilla"),
								"value"=>''
   						 );			
			vc_add_param('vc_row',$attributes);

			$attributes = array(
								"type" 			=> "textfield",
								"heading" 		=> esc_html__("Extra Class", "dreamvilla"),
								"param_name" 	=> "row_class",
								"description" 	=> esc_html__("Enter the row Class", "dreamvilla"),
								"value"			=> ""								  
							   );			
			vc_add_param('vc_row',$attributes);

			$attributes = array(
								"type" 			=> "checkbox",
								"heading" 		=> esc_html__("Hide close button", "dreamvilla"),
								"param_name" 	=> "noclosebutton",
								"description" 	=> esc_html__("Specify the Modal Box entry", "dreamvilla"),
								'value' 		=> array( esc_html__( 'Yes', 'dreamvilla' ) => 'yes' ),
								"dependency"	=> array(
														'element'	=> 'row_type',
														'value'		=> array('3')
													)
			);
			vc_add_param('vc_row',$attributes);

			$attributes = array(
								"type" 			=> "textfield",
								"heading" 		=> esc_html__("Modal Title", "dreamvilla"),
								"param_name" 	=> "modal_title",
								"description" 	=> esc_html__("Enter the Modal Title", "dreamvilla"),
								"value"			=> '',
								"dependency"	=> array(
														'element'	=> 'row_type',
														'value'		=> array('3')
													)
   						 );			
			vc_add_param('vc_row',$attributes);


			$attributes = array(
							"type"			=> 'colorpicker',
							"heading"		=> esc_html__('Background color', 'dreamvilla'),
							"param_name"	=> "bg_color",
							"value"			=> '',
							"description" 	=> esc_html__( "Select background Color", 'dreamvilla'),
							"dependency"	=> array(
														'element'	=> 'row_type',
														'value'		=> array('2')
													)
				
			);
			vc_add_param('vc_row',$attributes);

			$attributes = array(
								"type" 			=> "attach_image",
								"heading" 		=> esc_html__("Background Image", "dreamvilla"),
								"param_name" 	=> "bg_image",
								"description" 	=> esc_html__("Select background image URL", "dreamvilla"),
								"value"			=> "",
								"dependency"	=> array(
														'element'	=> 'row_type',
														'value'		=> array('2')
													)					  
							   );			
			vc_add_param('vc_row',$attributes);
			
			$attributes = array(
								"type" 			=> "dropdown",
								"heading" 		=> esc_html__("Background Attachment", "dreamvilla"),
								"param_name" 	=> "bg_attachment",
								"description" 	=> esc_html__("Select Background Attachment?", "dreamvilla"),
								"value"			=> array( 
														'Scroll'	=> 'false',
														'Fixed'		=> 'true'
													),
								"dependency"	=> array(
														'element'	=> 'row_type',
														'value'		=> array('2')
													)
							   );			
			vc_add_param('vc_row',$attributes);

			$attributes = array(
								"type" 			=> "dropdown",
								"heading" 		=> esc_html__("Background Position", "dreamvilla"),
								"param_name" 	=> "bg_position",
								"description" 	=> esc_html__("The background-position property sets the starting position of a background image.", "dreamvilla"),
								'value'			=> array(
														'Left Top'			=> 'left top',
														'Left Center'		=> 'left center',
														'Left Bottom'		=> 'left bottom',
														'Center Top'		=> 'center top',
														'Center Center'		=> 'center center',
														'Center Bottom'		=> 'center bottom',
														'Right Top'			=> 'right top',
														'Right Center'		=> 'right center',
														'Right Bottom'		=> 'right bottom',
													),
								  'std' 		=> 'center center',
								  "dependency"	=> array(
														'element'	=> 'row_type',
														'value'		=> array('2')
													)
							   );			
			vc_add_param('vc_row',$attributes);
						
			$attributes = array(
						      "type" 		=> "dropdown",
						      "heading" 	=> esc_html__("Background Cover?", "dreamvilla"),
						      "param_name" 	=> "bg_cover",
						      "description" => esc_html__("Row has cover background?", "dreamvilla"),
							  "value" 		=> array(
						  							'True'=>'true',
						  							'False'=>'false'
						  						),
							  "dependency"	=> array(
														'element'	=> 'row_type',
														'value'		=> array('2')
													)
							   );			
			vc_add_param('vc_row',$attributes);
				
			$attributes = array(
							     "type" 		=> "dropdown",
							      "heading" 	=> esc_html__("Background Repeat?", "dreamvilla"),
							      "param_name" 	=> "bg_repeat",
							      "description" => esc_html__("Is Background image repeated?", "dreamvilla"),
								  "value"		=> array( 
								  						'No Repeat' => 'no-repeat',
								  						'Repeat'	=> 'repeat'
								  					),
								  "dependency"	=> array(
														'element'	=> 'row_type',
														'value'		=> array('2')
													)
							   );			
			vc_add_param('vc_row',$attributes);

			$attributes = array(
								"type" 			=> "textfield",
								"heading" 		=> esc_html__("Padding Top", "dreamvilla"),
								"param_name" 	=> "row_padding_top",
								"description" 	=> esc_html__("Row Top Padding in px format", "dreamvilla"),
								"value"			=> '',
								"dependency"	=> array(
														'element'	=> 'row_type',
														'value'		=> array('2')
													)							  
							   );			
			vc_add_param('vc_row',$attributes);
						
			$attributes = array(
								"type" 			=> "textfield",
								"heading" 		=> esc_html__("Padding Bottom", "dreamvilla"),
								"param_name" 	=> "row_padding_bottom",
								"description" 	=> esc_html__("Row Bottom Padding in px format", "dreamvilla"),
								"value"			=> '',
								"dependency"	=> array(
														'element'	=> 'row_type',
														'value'		=> array('2')
													)
							   );			
			vc_add_param('vc_row',$attributes);

			$attributes = array(
								"type" 			=> "checkbox",
								"heading" 		=> esc_html__("Full Width Container", "dreamvilla"),
								"param_name" 	=> "full_container",
								'value' 		=> array( 
														esc_html__( 'Yes', 'js_composer' ) => 'full-container' 
													),
								"dependency"	=> array(
														'element'=>'row_type',
														'value'=>array('2')
													)
							);			
			vc_add_param('vc_row',$attributes);	
			
			$attributes = array(
								"type" 			=> "checkbox",
								"heading" 		=> esc_html__("Background Image None in Mobile Size", "dreamvilla"),
								"param_name" 	=> "responsive_bg_none",
								'value' 		=> array( 
														esc_html__( 'Yes', 'js_composer' ) => 'respo-bg-none' 
													),
								"dependency"	=> array(
														'element'=>'row_type',
														'value'=>array('2')
													),
							);			
			vc_add_param('vc_row',$attributes);
		}		
	}
	
	add_action('admin_init', 'dreamvilla_setup_vc_row');
	
} // End of if statement

function dreamvilla_setup_assets(){
	wp_deregister_style('js_composer_front');
	wp_dequeue_style('js_composer_front');
	wp_deregister_style('js_composer_custom_css');
	wp_dequeue_style('js_composer_custom_css');
}
add_action('wp_enqueue_scripts', 'dreamvilla_setup_assets');

function dreamvilla_setup_admin_assets(){
	wp_deregister_style('font-awesome');
	wp_enqueue_style( 'font-awesome' );	
}
add_action('admin_enqueue_scripts','dreamvilla_setup_admin_assets');

?>