<?php
vc_map( 
	array(
	    'name' 			=> 'Contact Form',
	    'base' 			=> 'contact_form',
		'description' 	=> esc_html__('Contact Form', 'dreamvilla'),
	    'icon' 			=> 'dreamvilla_contact_form',
		'category' 		=> esc_html__( 'Dreamvilla Shortcodes', 'dreamvilla' ),
	    'params' => array(				
				
				array(
					"heading" 		=> esc_html__( "Email Address", 'dreamvilla' ),
					"description" 	=> esc_html__( "Enter the Email Address to send the email.", 'dreamvilla'),
					"type" 			=> "textfield",
					"param_name" 	=> "contact_email",
				),	            
				
			),	        
	)
);
?>