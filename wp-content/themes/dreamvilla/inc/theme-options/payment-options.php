<?php
/*
 * Payment Options
 */
$opt_name;
Redux::setSection( $opt_name, array(
    'title' => esc_html__('Payment','dreamvilla-multiple-property'),
    'id'    => 'payment-section',    
    'desc'  => esc_html__('This section contains options for payment search.','dreamvilla-multiple-property'),
    'fields'=> array(

        array(
            'id'       => 'currency_section',
            'type'     => 'section',            
            'title'    => esc_html__( 'Currency Type & Model', 'dreamvilla-multiple-property' ),
            'indent'   => true,
        ),

        array(
            'id'       => 'dreamvilla_mp_paypal_currency_code',
            'type'     => 'text',
            'title'    => esc_html__( 'Currency Code', 'dreamvilla-multiple-property' ),
            'desc'     => esc_html__( 'Provide the currency code that you want to use. Ex. USD', 'dreamvilla-multiple-property' ),
            'default'  => 'USD',
            'required' => array( 'dreamvilla_mp_paypal_payment', '=', 1 ),
        ),

        array(
            'id'       => 'paypal_section',
            'type'     => 'section',            
            'title'    => esc_html__( 'Paypal Setting', 'dreamvilla-multiple-property' ),
            'indent'   => true,
        ),

        array(
            'id'       => 'dreamvilla_mp_paypal_payment',
            'type'     => 'switch',
            'title'    => esc_html__( 'PayPal Payments', 'dreamvilla-multiple-property' ),
            'subtitle' => esc_html__( 'Enable payment via PayPal ?', 'dreamvilla-multiple-property' ),
            'default'  => 1,
            'on'       => esc_html__( 'Enable', 'dreamvilla-multiple-property' ),
            'off'      => esc_html__( 'Disable', 'dreamvilla-multiple-property' ),
        ),

        array(
            'id'       => 'dreamvilla_mp_paypal_ipn',
            'type'     => 'text',
            'title'    => esc_html__( 'PayPal IPN URL', 'dreamvilla-multiple-property' ),
            'subtitle' => esc_html__( 'It is a must', 'dreamvilla-multiple-property' ),
            'desc'     => esc_html__( 'Install "PayPal IPN for WordPress" plugin and get IPN URL from Settings > PayPal IPN.', 'dreamvilla-multiple-property' ),
            'validate' => 'url',
            'required' => array( 'dreamvilla_mp_paypal_payment', '=', 1 ),
        ),

        array(
            'id'       => 'dreamvilla_mp_paypal_merchant_id',
            'type'     => 'text',
            'title'    => esc_html__( 'PayPal Merchant Account ID or Email', 'dreamvilla-multiple-property' ),
            'required' => array( 'dreamvilla_mp_paypal_payment', '=', 1 ),
        ),

        array(
            'id'       => 'dreamvilla_mp_paypal_sandbox',
            'type'     => 'switch',
            'title'    => esc_html__( 'PayPal Sandbox', 'dreamvilla-multiple-property' ),
            'subtitle' => esc_html__( 'Enable PayPal sandbox for testing', 'dreamvilla-multiple-property' ),
            'default'  => 0,
            'on'       => esc_html__( 'Enable', 'dreamvilla-multiple-property' ),
            'off'      => esc_html__( 'Disable', 'dreamvilla-multiple-property' ),
            'required' => array( 'dreamvilla_mp_paypal_payment', '=', 1 ),
        ),        

        array(
            'id'       => 'stripe_section',
            'type'     => 'section',            
            'title'    => esc_html__( 'Stripe Setting', 'dreamvilla-multiple-property' ),
            'indent'   => true,
        ),

        array(
            'id'       => 'enable_stripe',
            'type'     => 'switch',
            'title'    => esc_html__( 'Enable Stripe', 'dreamvilla-multiple-property' ),
            'on'       => esc_html__( 'Enabled', 'dreamvilla-multiple-property' ),
            'off'      => esc_html__( 'Disabled', 'dreamvilla-multiple-property' ),
        ),

        array(
            'id'       => 'stripe_secret_key',
            'type'     => 'text',
            'required' => array( 'enable_stripe', '=', '1' ),
            'title'    => esc_html__( 'Stripe Secret Key', 'dreamvilla-multiple-property' ),
            'subtitle' => esc_html__( 'Info is taken from your account at https://dashboard.stripe.com/login', 'dreamvilla-multiple-property' ),
        ),

        array(
            'id'       => 'stripe_publishable_key',
            'type'     => 'text',
            'required' => array( 'enable_stripe', '=', '1' ),
            'title'    => esc_html__( 'Stripe Publishable Key', 'dreamvilla-multiple-property' ),
            'subtitle' => esc_html__( 'Info is taken from your account at https://dashboard.stripe.com/login', 'dreamvilla-multiple-property' ),
        ),

        array(
                'id'       => 'Theme_Page_Stripe_Charge',
                'type'     => 'select',
                'required' => array( 'enable_stripe', '=', '1' ),
                'title'    => esc_html__('Stripe Charge Page','dreamvilla-multiple-property'), 
                'options'  => dreamvilla_mp_get_theme_page(),                
        ),

    )   )
);
