<?php
function dreamvilla_mp_ajax_register_init(){
    
    wp_register_script('dreamvilla-login-register', get_template_directory_uri() . '/inc/frontend/js/login-register.js', array('jquery') );
    wp_enqueue_script('dreamvilla-login-register');

    wp_localize_script( 'dreamvilla-login-register', 'ajax_auth_register', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'redirecturl' => home_url(), 'loadingmessage' => __('Sending user info, please wait...') ) );

    // Enable the user with no privileges to run dreamvilla_ajax_register() in AJAX
    add_action( 'wp_ajax_nopriv_dreamvilla_mp_ajax_register', 'dreamvilla_ajax_register' );
}

// Execute the action only if the user isn't logged in
if (!is_user_logged_in()) {
    add_action('init', 'dreamvilla_mp_ajax_register_init');
}

function dreamvilla_ajax_register(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'dreamvilla-ajax-register-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_nicename']  = $info['nickname'] = $info['display_name'] = $info['first_name'] = $info['user_login'] = sanitize_user($_POST['username']) ;
    $info['user_pass']      = sanitize_text_field($_POST['password']);
    $info['user_email']     = sanitize_email( $_POST['email']);

    // Register the user
    $user_register = wp_insert_user( $info );

    if($user_register > 0 ){
        dreamvilla_mp_new_user_notification($user_register);
    }

    if ( is_wp_error($user_register) ){ 
        $error  = $user_register->get_error_codes() ;

        if(in_array('empty_user_login', $error))
            echo json_encode( array( 'loggedin' => false, 'message'=> esc_html__($user_register->get_error_message('empty_user_login'), 'dreamvilla-multiple-property') ) );
        
        else if( in_array('existing_user_login',$error) )
            echo json_encode( array( 'loggedin' => false, 'message'=> esc_html__('This username is already registered.', 'dreamvilla-multiple-property') ) );
        
        else if( in_array('existing_user_email',$error) )
            echo json_encode( array( 'loggedin' => false, 'message'=> esc_html__('This email address is already registered.', 'dreamvilla-multiple-property') ) );
    } else {
        echo json_encode( array( 'loggedin' => true, 'message' => esc_html__('Registration is complete. Check your email for details!', 'dreamvilla-multiple-property') ) );
    }

    die();
}

function dreamvilla_mp_new_user_notification( $UserID ) {

    $dreamvilla_options = get_option('dreamvilla_options');

    $user = get_userdata( $UserID );
    $blogname   = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );

    if( $dreamvilla_options['new_user_send_admin'] == "yes" ){
        // Send Admin Email
        $headers = 'From: No Reply <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";

        $AdminMessage  = sprintf( esc_html__( 'New user registration on your site %s:', 'dreamvilla-multiple-property' ), $blogname ) . "\r\n\r\n";
        $AdminMessage .= sprintf( esc_html__( 'Username: %s', 'dreamvilla-multiple-property' ), $user->user_login ) . "\r\n\r\n";
        $AdminMessage .= sprintf( esc_html__( 'Email: %s', 'dreamvilla-multiple-property' ), $user->user_email ) . "\r\n";

        wp_mail( get_option( 'admin_email' ), sprintf( esc_html__( '[%s] New User Registration', 'dreamvilla-multiple-property' ), $blogname ), $AdminMessage, $headers );
    }
    
    if( $dreamvilla_options['new_user_send_user'] == "yes" ){

        // New Register User Email
        $headers = 'From: No Reply <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";

        $UserMessage  = sprintf( esc_html__( 'Welcome to %s', 'dreamvilla-multiple-property' ), $blogname ) . "\r\n\r\n";
        $UserMessage .= sprintf( esc_html__( 'Your username is: %s', 'dreamvilla-multiple-property' ), $user->user_login ) . "\r\n\r\n";
        $UserMessage .= sprintf( esc_html__( 'Your Email ID is: %s', 'dreamvilla-multiple-property' ), $user->user_email ) . "\r\n\r\n";
        $UserMessage .= esc_html__( 'For more details visit:', 'dreamvilla-multiple-property' ) . ' ' . home_url( '/' ) . "\r\n";

        wp_mail( $user->user_email, sprintf( __( 'Welcome to %s', 'dreamvilla-multiple-property' ), $blogname ), $UserMessage, $headers );
    }
}

?>