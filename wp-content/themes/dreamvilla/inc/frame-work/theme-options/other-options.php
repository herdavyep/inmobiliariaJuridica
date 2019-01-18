<?php
/*
 * Other Options
 */

$opt_name;
Redux::setSection( $opt_name, array(
    'title' => esc_html__('Other','dreamvilla'),
    'id'    => 'other-section',
    'icon'  => 'el-icon-list',    
    'desc'  => esc_html__('This section contains options for other.','dreamvilla'),
    'fields'=> array(        

        array(
            'id'        => 'dreamvilla_display_high_images',
            'type'      => 'button_set',
            'title'     => esc_html__( 'Display High Resolution Images','dreamvilla'),
            'options'   => array(
                                '1' => 'Yes',
                                '2' => 'No'
                            ),
            'default'   => '1'
        ),

        array(
            'id'        => 'dreamvilla_map_radius',
            'type'      => 'text',
            'title'     => esc_html__( 'Map Radius (in Meters)','dreamvilla'),
            'default'   => '5000'
        ),

        array(
            'id'        => 'dreamvilla_near_by_places_distance',
            'type'      => 'select',
            'title'     => esc_html__('Near By Places Distance In', 'dreamvilla'), 
            'options'   => array(
                                'km'   => 'Kilometer',
                                'mile' => 'Miles',               
                            ),
            'default'   => 'km',
        ),

        array(
            'id'        => 'dreamvilla_google_map_api',
            'type'      => 'text',
            'title'     => esc_html__( 'Google Map API key','dreamvilla'),
        ),    

        array(
            'id'            => 'dreamvilla_launch_date',
            'type'          => 'date',
            'title'         => esc_html__( 'Under Construction Page Launch Date','dreamvilla'),
            'placeholder'   => '03/22/2016'
        ),        

    )   ) 
);