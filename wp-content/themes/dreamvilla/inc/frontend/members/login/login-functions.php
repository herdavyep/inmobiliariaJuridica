<?php
function dreamvilla_mp_ajax_login_init(){
    
    wp_register_script('dreamvilla-login-register', get_template_directory_uri() . '/inc/frontend/js/login-register.js', array('jquery') );
    
    wp_enqueue_script('dreamvilla-login-register');

    $dreamvilla_options = get_option('dreamvilla_options');
    if( isset($dreamvilla_options['member_after_login_link']) ){
        $Login_Redirect_URL = get_permalink($dreamvilla_options['member_after_login_link']);
    } else {
        $Login_Redirect_URL = home_url();
    }    

    wp_localize_script( 'dreamvilla-login-register', 'ajax_auth_login', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'redirecturl' => $Login_Redirect_URL, 'loadingmessage' => __('Sending user info, please wait...') ) );

    // Enable the user with no privileges to run dreamvilla_mp_ajax_login() in AJAX
    add_action( 'wp_ajax_nopriv_dreamvilla_mp_ajax_login', 'dreamvilla_mp_ajax_login' );
}

// Execute the action only if the user isn't logged in
if (!is_user_logged_in()) {
    add_action('init', 'dreamvilla_mp_ajax_login_init');
}

function dreamvilla_mp_ajax_login(){

    check_ajax_referer( 'dreamvilla-ajax-login-nonce', 'security' );
    dreamvilla_mp_auth_user_login($_POST['username'], $_POST['password'], 'Login'); 
    
    die();
}

function dreamvilla_mp_auth_user_login($user_login, $password, $login){
    
    $Login_info = array();
    
    $Login_info['user_login']     = $user_login;
    $Login_info['user_password']  = $password;
    $Login_info['remember']       = true;
    
    $User_Signon = wp_signon( $Login_info, false );

    if ( is_wp_error($User_Signon) ){
        echo json_encode( array( 'loggedin' => false, 'message' => esc_html__('Wrong username or password.', 'dreamvilla-multiple-property') ) );
    } else {
        wp_set_current_user($User_Signon->ID); 
        echo json_encode( array( 'loggedin' => true, 'message' => esc_html__($login.' Successful, redirecting...', 'dreamvilla-multiple-property') ) );
    }   
    die();
}

?>