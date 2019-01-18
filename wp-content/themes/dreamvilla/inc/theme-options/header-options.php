<?php
/*
 * Header Options
 */
$opt_name;
Redux::setSection( $opt_name, array(
    'title' => esc_html__('Header','dreamvilla-multiple-property'),
    'id'    => 'header-section',    
    'desc'  => esc_html__('This section contains options for header.','dreamvilla-multiple-property'),
    'fields'=> array(

        array(
            'id'        => 'dreamvilla_header_variation',
            'type'      => 'image_select',
            'title'     => esc_html__( 'Header Design Variation', 'dreamvilla-multiple-property'),
            'subtitle'  => esc_html__( 'Select the design variation that you want to use for site header.', 'dreamvilla-multiple-property'),
            'options'   => array(
                '1' => array(
                    'title' => esc_html__('1st Variation', 'dreamvilla-multiple-property'),
                    'img' => get_template_directory_uri() . '/images/header_one.png',
                ),
                '2' => array(
                    'title' => esc_html__('2nd Variation', 'dreamvilla-multiple-property'),
                    'img' => get_template_directory_uri() . '/images/header_second.png',
                ),
            ),
            'default'   => '1',
        ),

        array(
            'id'       => 'dreamvilla_logo',            
            'type'     => 'media',
            'url'      => false,
            'title'    => esc_html__( 'Logo','dreamvilla-multiple-property','dreamvilla-multiple-property'),
            'subtitle' => esc_html__( 'Upload logo image for your Website. Otherwise site title will be displayed in place of logo.','dreamvilla-multiple-property'),
        ),

        array(
            'id'       => 'dreamvilla_fevicon',
            'type'     => 'media',
            'url'      => false,
            'title'    => esc_html__( 'Fevicon','dreamvilla-multiple-property'),
            'subtitle' => esc_html__( 'Upload logo image for your Website. Otherwise site title will be displayed in place of logo.','dreamvilla-multiple-property'),
        ),

        array(
            'id'        => 'dreamvilla_tag_line',
            'type'      => 'text',
            'title'     => esc_html__( 'Tag line','dreamvilla-multiple-property'),
            'default'   => 'real estate solution for Agents and small companies'
        ),

        array(
            'id'        => 'dreamvilla_contact_number_label',
            'type'      => 'text',
            'title'     => esc_html__( 'Contact number label','dreamvilla-multiple-property'),
            'default'   => 'call us now'
        ),

        array(
            'id'        => 'dreamvilla_contact_number',
            'type'      => 'text',
            'title'     => esc_html__( 'Contact number','dreamvilla-multiple-property'),
            'default'   => '215-123-4567'
        ),

    )   ) 
);
