<?php
/*
 * Styles Options
 */
$opt_name;
Redux::setSection( $opt_name, array(
    'title' => esc_html__('Styles','dreamvilla'),
    'id'    => 'styles-section',
    'icon'  => 'el-icon-list',    
    'desc'  => esc_html__('This section contains options for styles.','dreamvilla'),
    'fields'=> array(

    	array(
            'id'        => 'dreamvilla_change_font',
            'type'      => 'switch',
            'title'     => esc_html__( 'Do you want to change fonts?', 'dreamvilla' ),
            'default'   => '0',
            'on'    	=> esc_html__( 'Yes', 'dreamvilla' ),
            'off'   	=> esc_html__( 'No', 'dreamvilla' )
    	),

		array(
            'id'        => 'Fonts1',
            'type'      => 'typography',
            'title'     => esc_html__( 'Headings Font', 'dreamvilla' ),
            'subtitle'  => esc_html__( 'Select the font for headings.', 'dreamvilla' ),
            'desc'      => esc_html__( 'Montserrat is default font.', 'dreamvilla' ),
            'required'  => array( 'dreamvilla_change_font', '=', '1' ),
            'google'    => true,
            'font-style'    => false,
            'font-weight'   => false,
            'font-size'     => false,
            'line-height'   => false,
            'color'         => false,
            'text-align'    => false,
            'default'       => array(
                'font-family' => 'Montserrat',
                'google'      => true
            )
        ),

		array(
            'id'        => 'Fonts2',
            'type'      => 'typography',
            'title'     => esc_html__( 'Text Font', 'dreamvilla' ),
            'subtitle'  => esc_html__( 'Select the font for text.', 'dreamvilla' ),
            'desc'      => esc_html__( 'Lato is default font.', 'dreamvilla' ),
            'required'  => array( 'dreamvilla_change_font', '=', '1' ),
            'google'    => true,
            'font-style'    => false,
            'font-weight'   => false,
            'font-size'     => false,
            'line-height'   => false,
            'color'         => false,
            'text-align'    => false,
            'default'       => array(
                'font-family' => 'Lato',
                'google'      => true
            )
        ),

		array(
            'id'        	=> 'dreamvilla_text_color_1',
            'type'      	=> 'color',
            'title'     	=> esc_html__('Text Color 1', 'dreamvilla'),
            'default'   	=> '#435061',
            'validate'  	=> 'color',
            'transparent' 	=> false,
            'desc'  		=> 'default: #435061',
        ),

        array(
            'id'            => 'dreamvilla_text_color_2',
            'type'          => 'color',
            'title'         => esc_html__('Text Color 2', 'dreamvilla'),
            'default'       => '#7e8c99',
            'validate'      => 'color',
            'transparent'   => false,
            'desc'          => 'default: #7e8c99',
        ),

        array(
            'id'            => 'dreamvilla_text_color_3',
            'type'          => 'color',
            'title'         => esc_html__('Text Color 3', 'dreamvilla'),
            'default'       => '#ffffff',
            'validate'      => 'color',
            'transparent'   => false,
            'desc'          => 'default: #ffffff',
        ),

        array(
            'id'            => 'dreamvilla_text_color_4',
            'type'          => 'color',
            'title'         => esc_html__('Text Color 4', 'dreamvilla'),
            'default'       => '#0e90d9',
            'validate'      => 'color',
            'transparent'   => false,
            'desc'          => 'default: #0e90d9',
        ),

        array(
            'id'            => 'dreamvilla_text_color_4',
            'type'          => 'color',
            'title'         => esc_html__('Text Color 4', 'dreamvilla'),
            'default'       => '#0e90d9',
            'validate'      => 'color',
            'transparent'   => false,
            'desc'          => 'default: #0e90d9',
        ),

        array(
            'id'            => 'dreamvilla_color_1',
            'type'          => 'color',
            'title'         => esc_html__('Color 1', 'dreamvilla'),
            'default'       => '#31a2e1',
            'validate'      => 'color',
            'transparent'   => false,
            'desc'          => 'default: #31a2e1',
        ),

        array(
            'id'            => 'dreamvilla_color_2',
            'type'          => 'color',
            'title'         => esc_html__('Color 2', 'dreamvilla'),
            'default'       => '#ff551a',
            'validate'      => 'color',
            'transparent'   => false,
            'desc'          => 'default: #ff551a',
        ),

        array(
            'id'            => 'dreamvilla_color_3',
            'type'          => 'color',
            'title'         => esc_html__('Color 3', 'dreamvilla'),
            'default'       => '#ffffff',
            'validate'      => 'color',
            'transparent'   => false,
            'desc'          => 'default: #ffffff',
        ),

        array(
            'id'            => 'dreamvilla_color_4',
            'type'          => 'color',
            'title'         => esc_html__('Color 4', 'dreamvilla'),
            'default'       => '#435060',
            'validate'      => 'color',
            'transparent'   => false,
            'desc'          => 'default: #435060',
        ),

        array(
            'id'            => 'dreamvilla_color_5',
            'type'          => 'color',
            'title'         => esc_html__('Color 5', 'dreamvilla'),
            'default'       => '#eaf0f3',
            'validate'      => 'color',
            'transparent'   => false,
            'desc'          => 'default: #eaf0f3',
        ),

        array(
            'id'            => 'dreamvilla_color_6',
            'type'          => 'color',
            'title'         => esc_html__('Color 6', 'dreamvilla'),
            'default'       => '#0e90d9',
            'validate'      => 'color',
            'transparent'   => false,
            'desc'          => 'default: #0e90d9',
        ),

        array(
            'id'            => 'dreamvilla_color_7',
            'type'          => 'color',
            'title'         => esc_html__('Color 7', 'dreamvilla'),
            'default'       => '#3d4a5b',
            'validate'      => 'color',
            'transparent'   => false,
            'desc'          => 'default: #3d4a5b',
        ),      

        array(
            'id'        => 'dreamvilla_map_style',
            'type'      => 'text',
            'title'     => esc_html__( 'Map Style','dreamvilla'),            
            'default'   => '[{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]}]'
        ),
        
    )   ) 
);