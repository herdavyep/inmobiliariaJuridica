<?php
vc_map( 
	array(
	    'name' 			=> 'Footer Section',
	    'base' 			=> 'footer',
		'description' 	=> esc_html__('Address,Time,Map And Agent Info', 'dreamvilla'),
	    'icon' 			=> 'dreamvilla_map',
		'category' 		=> esc_html__( 'Dreamvilla Shortcodes', 'dreamvilla' ),
	    'params'=> array(

				array(
	                "type" 			=> "dropdown",
	                "heading" 		=> esc_html__( "Type", 'dreamvilla' ),
	                "param_name" 	=> "agent_info_type",
	                "value" 		=> array(
											"Type 1" => '1',
											"Type 2" => '2'											
									   ),
	                "description" => esc_html__( "You can choose among these pre-designed types.", 'dreamvilla')
	            ),

				array(
	                "type" 			=> "attach_image",
	                "heading" 		=> esc_html__( "Section Backgorund Image", 'dreamvilla' ),
	                "param_name" 	=> "footer_bk_image",
	                'value'			=> '',
	                "description" 	=> esc_html__( "Select Backgorund Image Of Footer Section.", 'dreamvilla' ),
	                'dependency'	=> array(
										'element' => 'agent_info_type',
										'value'   => '1'
									),
	            ),

	            array(
					"heading" 		=> esc_html__( "Location Heading", 'dreamvilla' ),
					"description" 	=> esc_html__( "Enter the Location Section Heading", 'dreamvilla'),
					"type" 			=> "textfield",
					"param_name" 	=> "location_heading",
					'dependency'	=> array(
										'element' => 'agent_info_type',
										'value'   => '1'
									),				
				),

				array(
					'heading' 		=> esc_html__('Show Google Map', 'dreamvilla') ,
					'description' 	=> wp_kses( __('Enable an google map showing.<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ),
					'param_name' 	=> 'show_google_map',
					'value' 		=> array( esc_html__( 'Enable', 'dreamvilla' ) => 'enable'),
					'type' 			=> 'checkbox',
					'std' 			=> 'disable',					
				),

				array(
					'heading' 		=> esc_html__('Latitude', 'dreamvilla') ,
					'description' 	=> wp_kses( __('Enther the Latitude of address.<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ),
					'param_name' 	=> 'latitude',
					'type' 			=> 'textfield',
					'dependency'	=> array(
											'element' => 'show_google_map',
											'value'   => 'enable'
										),
				),

				array(
					'heading' 		=> esc_html__('Longitude', 'dreamvilla') ,
					'description' 	=> wp_kses( __('Enther the Longitude of address.<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ),
					'param_name' 	=> 'longitude',
					'type' 			=> 'textfield',
					'dependency'	=> array(
											'element' => 'show_google_map',
											'value'   => 'enable'
										),
				),

				array(
					'heading' 		=> esc_html__('Width', 'dreamvilla') ,
					'description' 	=> wp_kses( __('Enther the Google Map Width.<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ),
					'param_name' 	=> 'google_width',
					'type' 			=> 'textfield',
					'dependency'	=> array(
											'element' => 'show_google_map',
											'value'   => 'enable'
										),
				),

				array(
					'heading' 		=> esc_html__('Height', 'dreamvilla') ,
					'description' 	=> wp_kses( __('Enther the Google Map Height.<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ),
					'param_name' 	=> 'google_height',
					'type' 			=> 'textfield',
					'dependency'	=> array(
											'element' => 'show_google_map',
											'value'   => 'enable'
										),
				),

				array(
					'heading' 		=> esc_html__('Show Address', 'dreamvilla') ,
					'description' 	=> wp_kses( __('Enable an address showing at the address area.<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ),
					'param_name' 	=> 'show_address',
					'value' 		=> array( esc_html__( 'Enable', 'dreamvilla' ) => 'enable'),
					'type' 			=> 'checkbox',
					'std' 			=> 'disable',
				),

				array(
					'heading' 		=> esc_html__('Address', 'dreamvilla') ,
					'description' 	=> wp_kses( __('Address of property or agent<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ),
					'param_name' 	=> 'dreamvilla_address',
					'type' 			=> 'textarea',
					'dependency'	=> array(
										'element' => 'show_address',
										'value'   => 'enable'
									),
				),

				array(
					'heading' 		=> esc_html__('Show Phone Number', 'dreamvilla') ,
					'description' 	=> wp_kses( __('Enable an phone number showing at the address area.<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ),
					'param_name' 	=> 'show_phone',
					'value' 		=> array( esc_html__( 'Enable', 'dreamvilla' ) => 'enable'),
					'type' 			=> 'checkbox',
					'std' 			=> 'disable',
				),

				array(
					'heading' 		=> esc_html__('Phone Number Label', 'dreamvilla') ,
					'description' 	=> wp_kses( __('Enter the Phone Number label<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ),
					'param_name' 	=> 'dreamvilla_phone_label',
					'type' 			=> 'textfield',
					'dependency'	=> array(
										'element' => 'show_phone',
										'value'   => 'enable'
									),
				),

				array(
					'heading' 		=> esc_html__('Phone Number ', 'dreamvilla') ,
					'description' 	=> wp_kses( __('Enter the Phone Number<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ),
					'param_name' 	=> 'dreamvilla_phone',
					'type' 			=> 'textfield',
					'dependency'	=> array(
										'element' => 'show_phone',
										'value'   => 'enable'
									),
				),

				array(
					'heading' 		=> esc_html__('Show Email Address', 'dreamvilla') ,
					'description' 	=> wp_kses( __('Enable an email Address showing at the address area.<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ),
					'param_name' 	=> 'show_email',
					'value' 		=> array( esc_html__( 'Enable', 'dreamvilla' ) => 'enable'),
					'type' 			=> 'checkbox',
					'std' 			=> 'disable',
				),

				array(
					'heading' 		=> esc_html__('Email Address Label', 'dreamvilla') ,
					'description' 	=> wp_kses( __('Enter the Email Address label<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ),
					'param_name' 	=> 'dreamvilla_email_label',
					'type' 			=> 'textfield',
					'dependency'	=> array(
										'element' => 'show_email',
										'value'   => 'enable'
									),
				),

				array(
					'heading' 		=> esc_html__('Email Address ', 'dreamvilla') ,
					'description' 	=> wp_kses( __('Enter the Email Address<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ),
					'param_name' 	=> 'dreamvilla_email',
					'type' 			=> 'textfield',
					'dependency'	=> array(
										'element' => 'show_email',
										'value'   => 'enable'
									),
				),

				array(
					'heading' 		=> esc_html__('Show Opening Hours', 'dreamvilla') ,
					'description' 	=> wp_kses( __('Enable an opening hours showing at the address area.<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ),
					'param_name' 	=> 'show_opening_hours',
					'value' 		=> array( esc_html__( 'Enable', 'dreamvilla' ) => 'enable'),
					'type' 			=> 'checkbox',
					'std' 			=> 'disable',
				),

				array(
					'heading' 		=> esc_html__('Opening Hours Label', 'dreamvilla') ,
					'description' 	=> wp_kses( __('Enter the Opening Hours label<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ),
					'param_name' 	=> 'opening_hours_label',
					'type' 			=> 'textfield',
					'dependency'	=> array(
										'element' => 'show_opening_hours',
										'value'   => 'enable'
									),
				),

				array(
					'heading' 		=> esc_html__('Opening Hours ', 'dreamvilla') ,
					'description' 	=> wp_kses( __('Enter the Opening Hours<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ),
					'param_name' 	=> 'opening_hours',
					'type' 			=> 'textarea',
					'dependency'	=> array(
										'element' => 'show_opening_hours',
										'value'   => 'enable'
									),
				),

				array(
					'heading' 		=> esc_html__('Show Button', 'dreamvilla') ,
					'description' 	=> wp_kses( __('Enable an button showing at the address area.<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ),
					'param_name' 	=> 'show_button',
					'value' 		=> array( esc_html__( 'Enable', 'dreamvilla' ) => 'enable'),
					'type' 			=> 'checkbox',
					'std' 			=> 'disable',
				),

				array(
					"type" 			=> "textfield",
					"heading" 		=> esc_html__( "Text", 'dreamvilla' ),
					"param_name" 	=> "footer_btn_content",
					"value"			=> '',
					"description" 	=> esc_html__( "Button Text Content", 'dreamvilla'),
					"dependency" 	=> array(
										'element' => 'show_button',
										'value'   => 'enable',
									),
				),
				
				array(
					"type" 			=> "textfield",
					"heading" 		=> esc_html__( "URL", 'dreamvilla' ),
					"param_name" 	=> "footer_url",
					"value"			=> '#',
					"description" 	=> esc_html__( "Button URL Link", 'dreamvilla'),
					"dependency" 	=> array(
										'element' => 'show_button',
										'value'   => 'enable',										
									),
				),
										
				array(
					"type" 			=> "dropdown",
					"heading" 		=> esc_html__( "Target", 'dreamvilla' ),
					"param_name" 	=> "footer_target",
					"description" 	=> esc_html__( "Button URL Target", 'dreamvilla'),
					"value" 		=> array(
											"Self"		=> "_self",
											"Blank"		=> "_blank",
											"Parent"	=> "_parent",
											"Top"		=> "_top",
										),
					"dependency" 	=> array(
											'element' => 'show_button',
											'value'   => 'enable',											
										),

				),				

				array(
					'heading' 		=> esc_html__('Show Agent Info', 'dreamvilla') ,
					'description' 	=> wp_kses( __('Enable an photo showing at the agent detail area.<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ),
					'param_name' 	=> 'show_agent_info',
					'value' 		=> array( esc_html__( 'Enable', 'dreamvilla' ) => 'enable'),
					'type' 			=> 'checkbox',
					'std' 			=> 'disable',
					"dependency" 	=> array(
										'element' => 'agent_info_type',
										'value'   => '2',
									),
				),

				array(
					"heading" 		=> esc_html__( "Agent Heading", 'dreamvilla' ),
					"description" 	=> esc_html__( "Enter the Agent Section Heading", 'dreamvilla'),
					"type" 			=> "textfield",
					"param_name" 	=> "agent_heading",
					'dependency'	=> array(
											'element' => 'agent_info_type',
											'value'   => '2',
											'element' => 'show_agent_info',
											'value'   => 'enable'
										),
				),

				array(
	                "type" 			=> "attach_image",
	                "heading" 		=> esc_html__( "Agent Photo", 'dreamvilla' ),
	                "param_name" 	=> "agent_photo",
	                'value'			=> '',
	                "description" 	=> esc_html__( "Select Agent Photo.", 'dreamvilla' ),
	                'dependency'	=> array(
										'element' => 'agent_info_type',
										'value'   => '2',
										'element' => 'show_agent_info',
										'value'   => 'enable'
									),
	            ),

	            array(
					"heading" 		=> esc_html__( "Agent Name", 'dreamvilla' ),
					"description" 	=> esc_html__( "Enter the Agent Name", 'dreamvilla'),
					"type" 			=> "textfield",
					"param_name" 	=> "agent_name",
					'dependency'	=> array(
											'element' => 'agent_info_type',
											'value'   => '2',
											'element' => 'show_agent_info',
											'value'   => 'enable'
										),
				),

				array(
					"heading" 		=> esc_html__( "Agent Certificate", 'dreamvilla' ),
					"description" 	=> esc_html__( "Enter the Agent Certificate", 'dreamvilla'),
					"type" 			=> "textfield",
					"param_name" 	=> "agent_certificate",
					'dependency'	=> array(
											'element' => 'agent_info_type',
											'value'   => '2',
											'element' => 'show_agent_info',
											'value'   => 'enable'
										),
				),

				array(
					"heading" 		=> esc_html__( "Agent Phone", 'dreamvilla' ),
					"description" 	=> esc_html__( "Enter the Agent Phone", 'dreamvilla'),
					"type" 			=> "textfield",
					"param_name" 	=> "agent_phone",
					'dependency'	=> array(
											'element' => 'agent_info_type',
											'value'   => '2',
											'element' => 'show_agent_info',
											'value'   => 'enable'
										),
				),

				array(
					"heading" 		=> esc_html__( "Agent Email", 'dreamvilla' ),
					"description" 	=> esc_html__( "Enter the Agent Email", 'dreamvilla'),
					"type" 			=> "textfield",
					"param_name" 	=> "agent_email",
					'dependency'	=> array(
											'element' => 'agent_info_type',
											'value'   => '2',
											'element' => 'show_agent_info',
											'value'   => 'enable'
										),
				),				
								
				array(
					'heading' 		=> esc_html__('Show Contact Form', 'dreamvilla') ,
					'description' 	=> wp_kses( __('Enable an Show contact form.<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ),
					'param_name' 	=> 'show_contact_form',
					'value' 		=> array( esc_html__( 'Enable', 'dreamvilla' ) => 'enable'),
					'type' 			=> 'checkbox',
					'std' 			=> 'disable',										
				),

				array(
					'heading' 		=> esc_html__('Contact Form Heading', 'dreamvilla') ,
					'description' 	=> wp_kses( __('Enter Contact Form Heading Title.<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ),
					'param_name' 	=> 'contact_form_heading',
					'type' 			=> 'textfield',
					'dependency'	=> array(
											'element' => 'show_contact_form',
											'value'   => 'enable'
										),
				),

				array(
					'heading' 		=> esc_html__('Contact Email', 'dreamvilla') ,
					'description' 	=> wp_kses( __('Enter the Contact Email To Send Mail.<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ),
					'param_name' 	=> 'contact_form',
					'type' 			=> 'textfield',
					'dependency'	=> array(
											'element' => 'show_contact_form',
											'value'   => 'enable'
										),
				),

				array(
					'heading' 		=> esc_html__('Show Copyright Text', 'dreamvilla') ,
					'description' 	=> wp_kses( __('Enable an Show Copyright Text.<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ),
					'param_name' 	=> 'show_copyright_text',
					'value' 		=> array( esc_html__( 'Enable', 'dreamvilla' ) => 'enable'),
					'type' 			=> 'checkbox',
					'std' 			=> 'disable',
					'dependency'	=> array(
											'element' => 'agent_info_type',
											'value'   => '1',											
										),										
				),

				array(
					'heading' 		=> esc_html__('Copyright Text', 'dreamvilla') ,
					'description' 	=> wp_kses( __('Enter Copyright Text Of Site.<br/><br/>', 'dreamvilla'), array( 'br' => array() ) ),
					'param_name' 	=> 'copyright_text',
					'type' 			=> 'textfield',
					'dependency'	=> array(
											'element' => 'show_copyright_text',
											'value'   => 'enable'
										),
				),
			),			  
	)
);

?>