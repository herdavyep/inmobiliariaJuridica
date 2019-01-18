<?php
/*
 * Header Options
 */
$opt_name;
Redux::setSection( $opt_name, array(
    'title' => esc_html__('Social Option','dreamvilla-multiple-property'),
    'id'    => 'social-section',
    'icon'  => 'el-icon-tags',
    'desc'  => esc_html__('This section contains options for social.','dreamvilla-multiple-property'),
    'fields'=> array(

        array(
            'id'        => 'dreamvilla_facebook',
            'type'      => 'text',
            'title'     => esc_html__( 'Facebook','dreamvilla-multiple-property'),
            'default'   => 'https://www.facebook.com'
        ),

        array(
            'id'        => 'dreamvilla_twitter',
            'type'      => 'text',
            'title'     => esc_html__( 'Twitter','dreamvilla-multiple-property'),
            'default'   => 'https://twitter.com'           
        ),

        array(
            'id'        => 'dreamvilla_google_plus',
            'type'      => 'text',
            'title'     => esc_html__( 'Google plus','dreamvilla-multiple-property'),
            'default'   => 'https://plus.google.com'        
        ),

        array(
            'id'        => 'dreamvilla_pinterest',
            'type'      => 'text',
            'title'     => esc_html__( 'Pinterest','dreamvilla-multiple-property'),
            'default'   => 'https://in.pinterest.com'        
        ),

        array(
            'id'        => 'dreamvilla_youtube',
            'type'      => 'text',
            'title'     => esc_html__( 'Youtube','dreamvilla-multiple-property'),
            'default'   => 'https://www.youtube.com/?gl=IN'
        ),

    )   ) 
);
