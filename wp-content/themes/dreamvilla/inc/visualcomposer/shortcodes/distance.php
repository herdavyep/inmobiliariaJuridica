<?php

vc_map( array(
        'name' 			=> 'Distance',
        'base' 			=> 'distance',
		"description" 	=> esc_html__( 'Vertical Space', 'dreamvilla'),
        'category' 		=> esc_html__( 'Dreamvilla Shortcodes', 'dreamvilla' ),
        "icon" 			=> "dreamvilla_distance",
		'params' => array(
			array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Type', 'dreamvilla' ),
					'param_name' 	=> 'type',
					'value' => array(
						
						'Distance 1' => '1',
						'Distance 2' => '2',
						'Distance 3' => '3',
						'Distance 4' => '4',
						'Distance 5' => '5',
					),
					'admin_label'  	=> true,
					'description' 	=> wp_kses( __( 'How much empty space would you like to add?<br><br>Distance 1 => height: 20px<br>Distance 2 => height: 40px<br>Distance 3 => height: 60px<br>Distance 4 => height: 80px<br>Distance 5 => height: 100px', 'dreamvilla'), array( 'br' => array() ) )
			),
		)
        
    ) 
);

?>