<?php
function dreamvilla_mp_ajax_invoice_init(){ 
    
    wp_register_script('dreamvilla-invoice', get_template_directory_uri() . '/inc/frontend/js/invoice.js', array('jquery') );
    wp_enqueue_script('dreamvilla-invoice');

    wp_localize_script( 'dreamvilla-invoice', 'invoice_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'loadingmessage' => __('Please wait...') ));

    add_action( 'wp_ajax_dreamvilla_mp_ajax_invoice', 'dreamvilla_mp_ajax_invoice' );
}

// Execute the action only if the user isn't logged in
if( is_user_logged_in() ) {
    add_action('init', 'dreamvilla_mp_ajax_invoice_init');
}

function dreamvilla_mp_ajax_invoice(){

    // Get user info
    global $current_user;
    get_currentuserinfo();

    $payment_fromdate 	= $_POST['payment_fromdate'];
    $payment_todate   	= $_POST['payment_todate'];
    $package_name  		= $_POST['package_name'];
    $payment_status   	= $_POST['payment_status'];

    global $wpdb;
	$table_name = $wpdb->prefix . 'invoices';
	$Filter_Invoice = '';

    if( !empty($payment_fromdate) || !empty($payment_todate) || !empty($package_name) || !empty($payment_status) ){	    

		$newquery = "SELECT * FROM $table_name WHERE ";

		$flag = false;

		if($payment_fromdate){
			$newquery = $newquery."user_id = '$current_user->ID'";
			$flag = true;
		}

		if($payment_fromdate){
			if($flag){
				$newquery = $newquery." AND ";
			}
			$newquery = $newquery."payment_date >= '$payment_fromdate'";
			$flag = true;
		}

		if($payment_todate){
			if($flag){
				$newquery = $newquery." AND ";
			}
			$newquery = $newquery." payment_date <= '$payment_todate'";
			$flag = true;
		}

		if($package_name){
			if($flag){
				$newquery = $newquery." AND ";
			}
			$newquery = $newquery." package_name = '$package_name'";
			$flag = true;
		}

		if($payment_status){
			if($flag){
				$newquery = $newquery." AND ";
			}
			$newquery = $newquery." payment_status = '$payment_status'";
			$flag = true;
		}

		if($flag){
			$newquery = $newquery." AND ";
		}
		$newquery = $newquery." user_id = '$current_user->ID'";	
		
	} else {
		$newquery = "SELECT * FROM $table_name WHERE user_id = '$current_user->ID'";
	}
 		
 	$invoice_list = $wpdb->get_results( $newquery );

 	if ($invoice_list){
 		foreach ($invoice_list as $key => $value) {
			$Filter_Invoice .='
			<tr>
				<td>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$key+1).'</td>
				<td>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$value->transaction_id).'</td>
				<td>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$value->payment_date).'</td>
				<td>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$value->payer_email).'</td>
				<td>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$value->full_name).'</td>
				<td>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$value->package_name).'</td>
				<td>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$value->payment_status).'</td>
				<td>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$value->payment_gross).'</td>
			</tr>';
		}					
		$response = array( 'success' => true, 'invoice' => $Filter_Invoice );
	} else {
		$response = array( 'success' => false );
	}	

    echo json_encode( $response );
    die; 
}