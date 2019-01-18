<?php
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'dreamvilla_mp_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function dreamvilla_mp_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        array(
            'name'      => esc_html__('Dreamvilla Multiple Property', 'dreamvilla' ),
            'slug'      => 'dreamvilla_multiple_property',
            'source'    => get_template_directory() . '/inc/tgm/plugins/dreamvilla_multiple_property.zip',
            'required'  => true,
        ),

        array(
            'name'      => esc_html__('Redux Framework', 'dreamvilla' ),
            'slug'      => 'redux-framework',
            'required'  => true
        ),

        array(
            'name'      => esc_html__( 'Visual Composer', 'dreamvilla' ),
            'slug'      => 'js_composer',
            'source'    => get_template_directory() . '/inc/tgm/plugins/js_composer.zip',
            'required'  => true,
        ),

        array(
            'name'      => esc_html__( 'Slider Revolution', 'dreamvilla' ),
            'slug'      => 'revslider',
            'source'    => get_template_directory() . '/inc/tgm/plugins/revslider.zip',
            'required'  => true,
        ),        
        
        array(
            'name'      => esc_html__('Responsive Mortgage Calculator', 'dreamvilla' ),
            'slug'      => 'responsive-mortgage-calculator',
            'required'  => false
        ),

        array(
            'name'      => esc_html__('WordPress Social Login', 'dreamvilla' ),
            'slug'      => 'wordpress-social-login',
            'source'    => get_template_directory() . '/inc/tgm/plugins/wordpress-social-login.zip',
            'required'  => true
        ),

        array(
            'name'      => esc_html__('PayPal IPN for WordPress', 'dreamvilla' ),
            'slug'      => 'paypal-ipn',
            'required'  => true
        ),        
                
    );

    /*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );

    tgmpa( $plugins, $config );

}
