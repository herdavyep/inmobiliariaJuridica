<?php

/*
	Template Name:Stripe Charge Per Package
*/

require_once( get_template_directory() . '/inc/frame-work/stripe-php/init.php' );

$allowed_html = array();

global $dreamvilla_options;

$stripe_secret_key 		= $dreamvilla_options['stripe_secret_key'];
$stripe_publishable_key = $dreamvilla_options['stripe_publishable_key'];
$submission_currency 	= $dreamvilla_options['dreamvilla_mp_paypal_currency_code'];

$stripe = array(
    "secret_key"      => $stripe_secret_key,
    "publishable_key" => $stripe_publishable_key
);
\Stripe\Stripe::setApiKey($stripe['secret_key']);


// Retrieve the request's body and parse it as JSON
$input = @file_get_contents("php://input");


if( is_email($_POST['stripeEmail']) ) {  // done
    $stripeEmail=  wp_kses ( esc_html($_POST['stripeEmail']) ,$allowed_html );
} else {
    wp_die('None Mail');
}

if( isset($_POST['submission_pay']) && $_POST['submission_pay'] == 1 ){

	try {
        $token  = wp_kses ( $_POST['stripeToken'] ,$allowed_html);

        $customer = \Stripe\Customer::create(array(
            "email" => $stripeEmail,
            "source" => $token // obtained with Stripe.js
        ));

        $userId      = intval( $_POST['userID'] );
        $listing_id  = intval( $_POST['propID'] );
        $pay_ammout  = intval( $_POST['pay_ammout'] );
        
        $charge = \Stripe\Charge::create(array(
            "amount" => $pay_ammout,
            'customer' => $customer->id,
            "currency" => $submission_currency,            
        ));

        $time = time();
        $date = date('Y-m-d',$time);

        $current_user = wp_get_current_user();
		$userID       = $current_user->ID;
		$user_email   = $current_user->user_email;
		$username     = $current_user->user_login;

		if ( isset( $charge->id ) && ( !empty( $charge->id ) ) ) {
			$Transaction_ID = $charge->id;
		}

		$Payment_Date = $date;
		
		if ( isset( $stripeEmail ) && ( !empty( $stripeEmail ) ) ) {
			$Payer_Email = $stripeEmail;
		}

		if ( isset( $charge->source['name'] ) && ( !empty( $charge->source['name'] ) ) ) {
			$Full_Name = $charge->source['name'];				
		}

		if ( isset( $charge->status ) && ( !empty( $charge->status ) ) ) {
			$Payment_Status = $charge->status;
		}

		if( $Payment_Status == "succeeded" ){
			$Payment_Status = "Completed";
		} else {
			$Payment_Status = ucfirst($charge->status);
		}

		$Package_Detail = get_post( $listing_id );
		$Package_ID 	= $Package_Detail->ID;
		$User_ID 		= $userID;

		$pay_ammout = $pay_ammout / 100;
		$pay_ammout = number_format((float)$pay_ammout, 2, '.', '');
		
		global $wpdb;
		$table_name = $wpdb->prefix . 'invoices';
		$wpdb->insert( $table_name, array( 'user_id' => $User_ID, 'transaction_id' => $Transaction_ID, 'payment_date' => $Payment_Date, 'payer_email' => $Payer_Email, 'full_name' => $Full_Name, 'package_name' => $Package_Detail->post_title, 'payment_status' => $Payment_Status, 'payment_gross' => $pay_ammout ), array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ) );

		if( $Payment_Status == "Completed" ){
			
			$Package_Time_Day  	= get_post_meta( $Package_ID, 'packagetimeday', true );
	        $Package_List      	= get_post_meta( $Package_ID, 'packagelist', true );
			$Package_Featured  	= get_post_meta( $Package_ID, 'packagefeatured', true );
			
			if( !empty($Package_Time_Day) && $Package_Time_Day != 0 )
				$Expiry_Date = date('Y-m-d', strtotime( $Package_Time_Day.' days'));
			else
				$Expiry_Date = '';
			
			if( $Package_List == 0 )
				$Package_List  = '';				
			
			if( $Package_Featured == 0 )
				$Package_Featured  = '';		

			update_user_meta( $User_ID, 'package_detail', array( "id" => $Package_ID, 'expiry_date' => $Expiry_Date, "list_item_remain" => $Package_List, "featured_item_remain" => $Package_Featured, 'status' => "active" ) );
			update_user_meta( $User_ID, 'membership_expiry_date', $Expiry_Date );
			update_user_meta( $User_ID, 'package_notification_status', "active" );
			
			// Send mail to user
			$headers = 'From: No Reply <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";
		    
		    $message  = esc_html__('Hi there,','dreamvilla-multiple-property') . "\r\n\r\n";
		    $message .= sprintf( esc_html__("Your new membership on %s is activated! You should go check it out.",'dreamvilla-multiple-property'), get_option('blogname')) . "\r\n\r\n";

		    $user = get_user_by( 'id', $User_ID );			    
		    $user_email=$user->user_email;

		    wp_mail($user_email, sprintf(esc_html__('[%s] Membership Activated','dreamvilla-multiple-property'), get_option('blogname')), $message, $headers);		    
		}
        
        $redirect = get_permalink($dreamvilla_options['user_dashboard_package']);
        wp_redirect($redirect);

    } catch (Exception $e){
        $error = '<div class="alert alert-danger">
                <strong>Error!</strong> '.$e->getMessage().'
                </div>';
        print $error;
    }

    exit();
}

?>