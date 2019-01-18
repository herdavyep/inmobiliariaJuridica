<?php
/*
 * Page Options
 */

$opt_name;
Redux::setSection( $opt_name, array(
    'title' => esc_html__('Slider Section','dreamvilla-multiple-property'),
    'id'    => 'slider-section',    
    'icon'  => 'el-icon-home-alt',
    'desc'  => esc_html__('This section contains options for Slider.','dreamvilla-multiple-property'),
    'fields'=> array(

        array(
            'id'        => 'homepage_with_slider_map',
            'type'      => 'select',
            'title'     => esc_html__( 'Homepage With Slider Or Map','dreamvilla-multiple-property'),
            'options'   => array(
                'homepage_with_slider'  => 'Homepage With Slider',
                'homepage_with_map'     => 'Homepage With Map',
            ),
            'default'   => 'homepage_with_slider'       
        ),        

    )   ) 
);
