<?php
function dreamvilla_mp_ajax_package_init(){ 
    
    wp_register_script('dreamvilla-package', get_template_directory_uri() . '/inc/frontend/js/package.js', array('jquery') );
    wp_enqueue_script('dreamvilla-package');

    wp_localize_script( 'dreamvilla-package', 'package_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'loadingmessage' => __('Sending user info, please wait...') ) );

    add_action( 'wp_ajax_dreamvilla_mp_ajax_package_select', 'dreamvilla_mp_ajax_package_select' );
}

// Execute the action only if the user isn't logged in
if( is_user_logged_in() ) {
    add_action('init', 'dreamvilla_mp_ajax_package_init');
}

function dreamvilla_mp_ajax_package_select(){

    // Get user info
    global $current_user;
    get_currentuserinfo();
	
	$User_ID 	= get_current_user_id();
    $Package_ID = $_POST['Package_ID'];
    
    $Package_Time_Day  	= get_post_meta( $Package_ID, 'packagetimeday', true );
    $Package_List      	= get_post_meta( $Package_ID, 'packagelist', true );
	$Package_Featured  	= get_post_meta( $Package_ID, 'packagefeatured', true );
	$Package_Free  		= get_user_meta( $User_ID, 'free_package_detail', true );	
	
	if( isset($Package_Free) && empty($Package_Free) ){
		
		if( !empty($Package_Time_Day) && $Package_Time_Day != 0 )
			$Expiry_Date = date('Y-m-d', strtotime( $Package_Time_Day.' days'));
		else
			$Expiry_Date = '';
		
		if( $Package_List == 0 )
			$Package_List  = '';				
		
		if( $Package_Featured == 0 )
			$Package_Featured  = '';		

		update_user_meta( $User_ID, 'package_detail', array( "id" => $Package_ID, 'expiry_date' => $Expiry_Date, "list_item_remain" =>$Package_List, "featured_item_remain" => $Package_Featured, 'status' => "active" ) );
		update_user_meta( $User_ID, 'membership_expiry_date', $Expiry_Date );
		update_user_meta( $User_ID, 'free_package_detail', $Package_ID );
		update_user_meta( $User_ID, 'package_notification_status', "active" );
	    
	    if( empty($Package_List) || $Package_List == 0 ){
	        $Package_List = "Unlimited listings";
	    }
	    
	    if( empty($Package_Featured) || $Package_Featured == 0 )
	        $Package_Featured = "Unlimited Featured";
	   
	    $message = '
	    <div class="alert alert-success">
			<strong>Success!</strong> Successfully Subscribe '.get_the_title($Package_ID).' Package!
		</div>';

		$response = array( 'success' => true, 'message' => $message, 'Package_List' => $Package_List, 'Package_Featured' => $Package_Featured );

	} else {
		
		$message = '
	    <div class="alert alert-danger">
			<strong>Sorry!</strong> You already used '.get_the_title($Package_ID).' Package!
		</div>';

		$response = array( 'success' => true, 'message' => $message );

	}

    echo json_encode( $response );
    die; 
}

// Paypal Form
function dreamvilla_mp_payment_button($Package_ID,$User_ID){
	
	global $dreamvilla_options;
	
	$Paypal_Payment_Amount  = get_post_meta($Package_ID, 'packageprice', true);
	$Paypal_Payment_Enabled = $dreamvilla_options['dreamvilla_mp_paypal_payment'];
    $Paypal_IPN_URL         = $dreamvilla_options['dreamvilla_mp_paypal_ipn'];
    $Paypal_Merchant_ID     = $dreamvilla_options['dreamvilla_mp_paypal_merchant_id'];
    $Paypal_Sandbox         = $dreamvilla_options['dreamvilla_mp_paypal_sandbox'];
    $Paypal_Currency_Code   = $dreamvilla_options['dreamvilla_mp_paypal_currency_code'];
    
    if ( class_exists( 'AngellEYE_Paypal_Ipn_For_Wordpress' ) ) {

        if( ( $Paypal_Payment_Enabled ) && ( !empty( $Paypal_IPN_URL ) ) && ( !empty( $Paypal_Merchant_ID ) ) && ( !empty( $Paypal_Currency_Code ) ) && ( !empty( $Paypal_Payment_Amount ) ) ) {

            $paypal_button_script = get_template_directory_uri() . "/js/paypal-button.min.js"; ?>
            
            <script src= "<?php echo esc_url( add_query_arg( array( 'merchant' => $Paypal_Merchant_ID ), $paypal_button_script ) ); ?>"
                    <?php if( $Paypal_Sandbox ){ ?>data-env="sandbox"<?php } ?>
                    data-callback="<?php echo esc_url( $Paypal_IPN_URL ); ?>"
                    data-tax="0"
                    data-shipping="0"
                    data-currency="<?php echo esc_attr( $Paypal_Currency_Code ); ?>"
                    data-amount="<?php echo esc_attr( $Paypal_Payment_Amount ); ?>"
                    data-quantity="1"
                    data-name="<?php echo get_the_title($Package_ID); ?>"
                    data-number="<?php echo $User_ID; ?>",
                    data-return="<?php echo get_permalink($dreamvilla_options['user_dashboard_package']); ?>"
                    data-button="buynow"
            ></script><?php
        }
    }
}

function dreamvilla_mp_completed_payment( $posted ){

	global $dreamvilla_options;
	
	$Paypal_Merchant_ID = $dreamvilla_options[ 'dreamvilla_mp_paypal_merchant_id' ];

	if( $posted['business'] == $Paypal_Merchant_ID && $posted['item_name'] != "Single_Property" && $posted['item_name'] != "Single_Property_Featured_Type" ) {

		if( isset( $posted['item_number'] ) && ( !empty( $posted['item_number'] ) ) ) {

			if ( isset( $posted['txn_id'] ) && ( !empty( $posted['txn_id'] ) ) ) {
				$Transaction_ID = $posted['txn_id'];
			}

			if ( isset( $posted['payment_date'] ) && ( !empty( $posted['payment_date'] ) ) ) {
				$Payment_Date = date( "Y-m-d", strtotime($posted['payment_date']) );
			}

			if ( isset( $posted['payer_email'] ) && ( !empty( $posted['payer_email'] ) ) ) {
				$Payer_Email = $posted['payer_email'];
			}

			if ( isset( $posted['first_name'] ) && ( !empty( $posted['first_name'] ) ) ) {
				$First_Name = $posted['first_name'];				
			}

			if ( isset( $posted['last_name'] ) && ( !empty( $posted['last_name'] ) ) ) {
				$Last_Name = $posted['last_name'];				
			}

			if ( isset( $posted['payment_status'] ) && ( !empty( $posted['payment_status'] ) ) ) {
				$Payment_Status = $posted['payment_status'];
			}

			if ( isset( $posted['payment_gross'] ) && ( !empty( $posted['payment_gross'] ) ) ) {
				$Payment_Gross = $posted['payment_gross'];				
			}

			$Package_Detail = get_page_by_title($posted['item_name'], OBJECT, 'package' );
			$Package_ID 	= $Package_Detail->ID;
			$User_ID 		= $posted['item_number'];

			$Full_Name = $First_Name.' '.$Last_Name;

			global $wpdb;
			$table_name = $wpdb->prefix . 'invoices';
			$wpdb->insert( $table_name, array( 'user_id' => $User_ID, 'transaction_id' => $Transaction_ID, 'payment_date' => $Payment_Date, 'payer_email' => $Payer_Email, 'full_name' => $Full_Name, 'package_name' => $posted['item_name'], 'payment_status' => $Payment_Status, 'payment_gross' => $Payment_Gross ), array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ) );

			if($Payment_Status == "Completed"){
				
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
		}
	}
}
add_action( 'paypal_ipn_for_wordpress_payment_status_completed', 'dreamvilla_mp_completed_payment' );

// Stripe Form
if( !function_exists('dreamvilla_show_stripe_form') ) {
    function dreamvilla_show_stripe_form( $postID, $User_ID ) {

        require_once( get_template_directory() . '/inc/frame-work/stripe-php/init.php' );
        
        global $dreamvilla_options;

		$stripe_secret_key 		= $dreamvilla_options['stripe_secret_key'];
        $stripe_publishable_key = $dreamvilla_options['stripe_publishable_key'];
        $Paypal_Currency_Code   = $dreamvilla_options['dreamvilla_mp_paypal_currency_code'];

        $stripe = array(
            "secret_key" => $stripe_secret_key,
            "publishable_key" => $stripe_publishable_key
        );

        \Stripe\Stripe::setApiKey($stripe['secret_key']);
        
        $submission_currency = $Paypal_Currency_Code;
        $current_user = wp_get_current_user();
        $userID = $current_user->ID;
        $user_email = $current_user->user_email;

        $price_submission  	= get_post_meta($postID, 'packageprice', true);
        $price_submission 	= $price_submission * 100;

        $processor_link = get_permalink($dreamvilla_options['Theme_Page_Stripe_Charge']);

        print '
	    <form action="'.$processor_link.'" method="post" id="stripe_form_simple_listing">
	        <div class="dreamvilla_stripe_simple">
	            <script src="https://checkout.stripe.com/checkout.js"
	            class="stripe-button"
	            data-key="' . $stripe_publishable_key . '"
	            data-amount="' . $price_submission . '"
	            data-email="' . $user_email . '"
	            data-zip-code="true"
	            data-currency="' . $submission_currency . '"
	            data-label="' . esc_html__('Pay with Credit Card', 'dreamvilla-multiple-property') . '"
	            data-description="' . esc_html__('Submission Payment', 'dreamvilla-multiple-property') . '">
	            </script>
	        </div>
	        <input type="hidden" id="propID" name="propID" value="' . $postID . '">
	        <input type="hidden" id="submission_pay" name="submission_pay" value="1">
	        <input type="hidden" name="userID" value="' . $userID . '">
	        <input type="hidden" id="pay_ammout" name="pay_ammout" value="' . $price_submission . '">
	    </form>';    
    }
}

?>