<?php

function dreamvilla_mp_single_payment($Package_Type,$Package_Price,$User_ID){
	
	global $dreamvilla_options;
	
	if( $Package_Type == 1 ){
		$Paypal_Package_Type = "Single_Property";
	} else {
		$Paypal_Package_Type = "Single_Property_Featured_Type";
	}
	$Paypal_Payment_Amount  = $Package_Price;
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
                    data-name="<?php echo $Paypal_Package_Type; ?>"
                    data-number="<?php echo $User_ID; ?>",
                    data-return="<?php echo get_permalink($dreamvilla_options['user_dashboard_submit_property']); ?>"
                    data-button="buynow"
            ></script><?php
        }
    }
}

function dreamvilla_mp_completed_single( $posted ) {

	global $dreamvilla_options;
	
	$Paypal_Merchant_ID = $dreamvilla_options[ 'dreamvilla_mp_paypal_merchant_id' ];	

	if( $posted['business'] == $Paypal_Merchant_ID && ( $posted['item_name'] == "Single_Property" || $posted['item_name'] == "Single_Property_Featured_Type") ) {

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

			if( isset($posted['item_name']) && !empty($posted['item_name']) ) {
				if( $posted['item_name'] == "Single_Property" )
					$Paypal_Package_Type = "Normal Single Property";
				else
					$Paypal_Package_Type = "Single Property With Featured Type";
			}

			$User_ID = $posted['item_number'];

			$Full_Name = $First_Name.' '.$Last_Name;

			global $wpdb;
			$table_name = $wpdb->prefix . 'invoices';
			$wpdb->insert( $table_name, array( 'user_id' => $User_ID, 'transaction_id' => $Transaction_ID, 'payment_date' => $Payment_Date, 'payer_email' => $Payer_Email, 'full_name' => $Full_Name, 'package_name' => $Paypal_Package_Type, 'payment_status' => $Payment_Status, 'payment_gross' => $Payment_Gross ), array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ) );

			if($Payment_Status == "Completed"){
				
				$add_single_property = array();

				if( isset($posted['item_name']) && !empty($posted['item_name']) ) {
					if( $posted['item_name'] == "Single_Property" ){
						$add_single_property[1] = 1;
					} else {
						$add_single_property[1] = 2;
					}					
				}
				
				$add_single_property[0] = 1;

				update_user_meta( $User_ID, 'add_single_property', $add_single_property );
			
				// Send mail to user
				$headers = 'From: No Reply <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";
			    
			    $message  = esc_html__('Hi there,','dreamvilla-multiple-property') . "\r\n\r\n";
			    $message .= sprintf( esc_html__("Your submit single property on %s is activated! You should go check it out.",'dreamvilla-multiple-property'), get_option('blogname')) . "\r\n\r\n";

			    $user = get_user_by( 'id', $User_ID );			    
			    $user_email = $user->user_email;

			    wp_mail($user_email, sprintf(esc_html__('[%s] Single Property Payment','dreamvilla-multiple-property'), get_option('blogname')), $message, $headers);
			}
		}
	}
}
add_action( 'paypal_ipn_for_wordpress_payment_status_completed', 'dreamvilla_mp_completed_single' );

// Stripe Form
if( !function_exists('dreamvilla_show_stripe_per') ) {
    function dreamvilla_show_stripe_per($Package_Type,$Package_Price,$User_ID) {

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

        $price_submission 	= $Package_Price * 100;

        $processor_link = get_permalink($dreamvilla_options['Theme_Page_Per_Stripe_Charge']);

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
	            data-label="' . esc_html__('<i class="fa fa-credit-card"></i>Pay with Credit Card', 'dreamvilla-multiple-property') . '"
	            data-description="' . esc_html__('Submission Payment', 'dreamvilla-multiple-property') . '">
	            </script>
	        </div>
	        <input type="hidden" id="Package_Type" name="Package_Type" value="'.$Package_Type.'">
	        <input type="hidden" id="submission_pay" name="submission_pay" value="1">
	        <input type="hidden" name="userID" value="' . $userID . '">
	        <input type="hidden" id="pay_ammout" name="pay_ammout" value="' . $price_submission . '">
	    </form>';    
    }
}

?>