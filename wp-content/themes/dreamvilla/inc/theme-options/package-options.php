<?php
/*
 * Payment Options
 */
$opt_name;
Redux::setSection( $opt_name, array(
    'title' => esc_html__('Package','dreamvilla-multiple-property'),
    'id'    => 'package-section',    
    'desc'  => esc_html__('This section contains options for package search.','dreamvilla-multiple-property'),
    'fields'=> array(

        array(
            'id'       => 'dreamvilla_mp_single_payment',
            'type'     => 'switch',
            'title'    => esc_html__( 'Submit Single Property', 'dreamvilla-multiple-property' ),
            'subtitle' => esc_html__( 'Enable Submit Single Property ?', 'dreamvilla-multiple-property' ),
            'default'  => 'off',
            'on'       => esc_html__( 'Enable', 'dreamvilla-multiple-property' ),
            'off'      => esc_html__( 'Disable', 'dreamvilla-multiple-property' ),
        ),

        array(
            'id'       => 'dreamvilla_mp_simple_price',
            'type'     => 'text',
            'title'    => esc_html__( 'Property Submit Price', 'dreamvilla-multiple-property' ),
            'desc'     => esc_html__( 'Price for single property submit without featured type', 'dreamvilla-multiple-property' ),
            'required' => array( 'dreamvilla_mp_single_payment', '=', 1 ),
        ),

        array(
            'id'       => 'dreamvilla_mp_featured_price',
            'type'     => 'text',
            'title'    => esc_html__( 'Featured Property Submit Price', 'dreamvilla-multiple-property' ),
            'desc'     => esc_html__( 'Price for single property submit with featured type', 'dreamvilla-multiple-property' ),
            'required' => array( 'dreamvilla_mp_single_payment', '=', 1 ),
        ),

        array(
            'id'       => 'dreamvilla_mp_si_pr_dis',
            'type'     => 'text',
            'title'    => esc_html__( 'Simple Property Button Label', 'dreamvilla-multiple-property' ),
            'desc'     => esc_html__( 'This Label/price is show in selection button of add simple property', 'dreamvilla-multiple-property' ),
            'required' => array( 'dreamvilla_mp_single_payment', '=', 1 ),
        ),

        array(
            'id'       => 'dreamvilla_mp_fe_pr_dis',
            'type'     => 'text',
            'title'    => esc_html__( 'Featured Property Button Label', 'dreamvilla-multiple-property' ),
            'desc'     => esc_html__( 'This Label/price is show in selection button of property add with featured type', 'dreamvilla-multiple-property' ),
            'required' => array( 'dreamvilla_mp_single_payment', '=', 1 ),
        ),

        array(
                'id'       => 'Theme_Page_Per_Stripe_Charge',
                'type'     => 'select',
                'required' => array( 'dreamvilla_mp_single_payment', '=', '1' ),
                'title'    => esc_html__('Stripe Charge Page For Per Listing','dreamvilla-multiple-property'),
                'options'  => dreamvilla_mp_get_theme_page(),                
        ),

    )   )
);
