<?php
/*
 * Other Options
 */

$opt_name;
Redux::setSection( $opt_name, array(
    'title' => esc_html__('Other','dreamvilla-multiple-property'),
    'id'    => 'other-section',
    'desc'  => esc_html__('This section contains options for other.','dreamvilla-multiple-property'),
    'fields'=> array(

        array(
                'id'       => 'menu_style',
                'type'     => 'button_set',
                'title'    => esc_html__('Menu Style','dreamvilla-multiple-property'), 
                'options'  => array(
                                'normal' => 'Normal',
                                'sticky' => 'Sticky'
                            ),
                'default'   => 'normal'
        ),
        
        array(
            'id'        => 'dreamvilla_google_map_api',
            'type'      => 'text',
            'title'     => esc_html__( 'Google Map API key','dreamvilla-multiple-property'),
        ),

        array(
                'id'       => 'show_google_recaptcha',
                'type'     => 'button_set',
                'title'    => esc_html__('Display recaptcha in contact form','dreamvilla-multiple-property'), 
                'options'  => array(
                                'yes' => 'Yes',
                                'no' => 'No'
                            ),
                'default'   => 'no'
        ),

        array(
            'id'        => 'google_recaptcha_site_key',
            'type'      => 'text',
            'title'     => esc_html__( 'Google recaptcha site key','dreamvilla-multiple-property'),
            'default'   => '00000000'
        ),

        array(
            'id'        => 'contactformtitle',
            'type'      => 'text',
            'title'     => esc_html__( 'Title for contact form','dreamvilla-multiple-property'),
            'default'   => 'Contact our agent'
        ),

        array(
            'id'        => 'submitrequesttitle',
            'type'      => 'text',
            'title'     => esc_html__( 'Submit request button title','dreamvilla-multiple-property'),
            'default'   => 'SUBMIT REQUEST'
        ),

        array(
            'id'        => 'sendinquirysuccessmessage',
            'type'      => 'text',
            'title'     => esc_html__( 'Send Inquiry Success Message','dreamvilla-multiple-property'),
            'default'   => 'Your message successfully sent to agent!'
        ),

        array(
            'id'        => 'sendinquiryfailedmessage',
            'type'      => 'text',
            'title'     => esc_html__( 'Send Inquiry Failed Message','dreamvilla-multiple-property'),
            'default'   => 'Sorry,Your message was not send to agent,please try again!'
        ),

        array(
            'id'        => 'pricestart',
            'type'      => 'text',
            'title'     => esc_html__( 'Price start','dreamvilla-multiple-property'),
            'default'   => '0'
        ),

        array(
            'id'        => 'priceend',
            'type'      => 'text',
            'title'     => esc_html__( 'Price end','dreamvilla-multiple-property'),
            'default'   => '1000000'
        ),

        array(
            'id'        => 'currencysymbol',
            'type'      => 'text',
            'title'     => esc_html__( 'Currency symbol','dreamvilla-multiple-property'),
            'default'   => '$'
        ),

        array(
                'id'       => 'show_front_end',
                'type'     => 'button_set',
                'title'    => esc_html__('Want front end login and property manage functionality?','dreamvilla-multiple-property'), 
                'options'  => array(
                                'yes' => 'Yes',
                                'no' => 'No'
                            ),
                'default'   => 'yes'
        ),

        array(
            'id'        => 'dreamvillamultiple_rtl_css',
            'type'      => 'button_set',
            'title'     => esc_html__( 'RTL CSS Load','dreamvilla'),
            'options'   => array(
                                '1' => 'Yes',
                                '2' => 'No'
                            ),
            'default'   => '2'
        ),

    )   ) 
);
