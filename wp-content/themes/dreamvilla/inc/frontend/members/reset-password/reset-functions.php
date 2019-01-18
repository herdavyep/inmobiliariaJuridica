<?php
function dreamvilla_mp_ajax_reset_init(){
    
    wp_register_script('dreamvilla-login-register', get_template_directory_uri() . '/inc/frontend/js/login-register.js', array('jquery') );
    wp_enqueue_script('dreamvilla-login-register');

    wp_localize_script( 'dreamvilla-login-register', 'ajax_auth_reset', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'redirecturl' => home_url(), 'loadingmessage' => __('Sending user info, please wait...') ) );

    // Enable the user with no privileges to request ajax password reset
    add_action( 'wp_ajax_nopriv_dreamvilla_mp_ajax_reset_password', 'dreamvilla_mp_ajax_reset_password' );
}

// Execute the action only if the user isn't logged in
if (!is_user_logged_in()) {
    add_action('init', 'dreamvilla_mp_ajax_reset_init');
}

function dreamvilla_mp_ajax_reset_password(){

    check_ajax_referer( 'dreamvilla-ajax-reset-password-nonce', 'security' );

    $reset_account = $_POST['username'];
    $error = "";
    $UserInfo = "";

    if ( empty( $reset_account ) ) {
        $error = esc_html__( 'Provide a valid username or email address!', 'dreamvilla-multiple-property' );
    } else {
        if ( is_email( $reset_account ) ) {
            
            if ( email_exists( $reset_account ) )
                $UserInfo = 'email';
            else
                $error = esc_html__( 'No user found for given email!', 'dreamvilla-multiple-property' );

        } elseif ( validate_username ( $reset_account ) ) {
            
            if ( username_exists ( $reset_account ) )
                $UserInfo = 'login';
            else
                $error = esc_html__( 'No user found for given username!', 'dreamvilla-multiple-property' );

        } else {
            $error = esc_html__( 'Invalid username or email!', 'dreamvilla-multiple-property' );
        }
    }

    if ( empty ( $error ) ) {

        $RandomPassword = wp_generate_password();

        $reset_user = get_user_by( $UserInfo, $reset_account );

        $new_update_user = wp_update_user( array (
            'ID' => $reset_user->ID,
            'user_pass' => $RandomPassword
        ) );

        if ( $new_update_user ) {

            $from = get_option( 'admin_email' );

            if ( !isset( $from ) || !is_email( $from ) ) {
                $site_name = strtolower( $_SERVER['SERVER_NAME'] );
                if ( substr( $site_name, 0, 4 ) == 'www.' ) {
                    $site_name = substr( $site_name, 4 );
                }
                $from = 'admin@' . $site_name;
            }

            $to = $reset_user->user_email;
            $website_name = get_bloginfo( 'name' );
            $subject = sprintf( __('Your New Password For %s', 'dreamvilla-multiple-property'), $website_name );
            $message = wpautop( sprintf( esc_html__( 'Your new password is: %s', 'dreamvilla-multiple-property' ), $RandomPassword ) );

            $headers = array();
            $headers[] = "Reply-To: $website_name <$from>";
            $headers[] = "Content-Type: text/html; charset=UTF-8";
            $headers = apply_filters( "dreamvilla_mp_password_reset_header", $headers );    // just in case if you want to modify the header in child theme

            $mail = wp_mail( $to, $subject, $message, $headers );

            if ( $mail )
                $success = esc_html__( 'Check your email for new password', 'dreamvilla-multiple-property' );
            else
                $error = esc_html__( 'Failed to send you new password email!', 'dreamvilla-multiple-property' );
        
        } else {
            $error = esc_html__( 'Oops! Something went wrong while resetting your password!', 'dreamvilla-multiple-property' );
        }
    }

    if( ! empty( $error ) )
        echo json_encode( array ( 'success' => false, 'message' => $error ) );
    else if ( ! empty( $success ) )
        echo json_encode( array ( 'success' => true, 'message' => $success ) );
    
    die();
}

?>