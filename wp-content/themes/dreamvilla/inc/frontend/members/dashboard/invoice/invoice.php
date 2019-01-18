<?php
$dreamvilla_options = get_option('dreamvilla_options');
$User_ID 	= get_current_user_id();

/*global $wpdb;
$table_name = $wpdb->prefix . 'invoices';
$wpdb->insert( $table_name, array( 'user_id' => '1', 'transaction_id' => '9PV05562VX616563L', 'payment_date' => '2016-04-19', 'payer_email' => 'dreamvilla-buyer@outlook.com', 'full_name' => 'Buyer Buyer', 'package_name' => 'GOLD', 'payment_status' => 'Processed', 'payment_gross' => '14.99' ), array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ) );
$wpdb->insert( $table_name, array( 'user_id' => '1', 'transaction_id' => '0VY31613SE753960X', 'payment_date' => '2016-04-19', 'payer_email' => 'dreamvilla-buyer@outlook.com', 'full_name' => 'Buyer Buyer', 'package_name' => 'STANDARD', 'payment_status' => 'Completed', 'payment_gross' => '4.99' ), array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ) );
$wpdb->insert( $table_name, array( 'user_id' => '1', 'transaction_id' => '8RV65084UB9133139', 'payment_date' => '2016-04-15', 'payer_email' => 'dreamvilla-buyer@outlook.com', 'full_name' => 'Buyer Buyer', 'package_name' => 'GOLD', 'payment_status' => 'Canceled_Reversal', 'payment_gross' => '14.99' ), array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ) );
$wpdb->insert( $table_name, array( 'user_id' => '1', 'transaction_id' => '9BJ24595N03813041', 'payment_date' => '2016-04-10', 'payer_email' => 'dreamvilla-buyer@outlook.com', 'full_name' => 'Buyer Buyer', 'package_name' => 'STANDARD', 'payment_status' => 'Pending', 'payment_gross' => '4.99' ), array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ) );
$wpdb->insert( $table_name, array( 'user_id' => '1', 'transaction_id' => '24R10459MA392783A', 'payment_date' => '2016-04-01', 'payer_email' => 'dreamvilla-buyer@outlook.com', 'full_name' => 'Buyer Buyer', 'package_name' => 'GOLD', 'payment_status' => 'Denied', 'payment_gross' => '14.99' ), array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ) );
$wpdb->insert( $table_name, array( 'user_id' => '1', 'transaction_id' => '0VY31613SE753960X', 'payment_date' => '2016-03-25', 'payer_email' => 'dreamvilla-buyer@outlook.com', 'full_name' => 'Buyer Buyer', 'package_name' => 'GOLD', 'payment_status' => 'Expired', 'payment_gross' => '14.99' ), array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ) );
$wpdb->insert( $table_name, array( 'user_id' => '1', 'transaction_id' => '8RV65084UB9133139', 'payment_date' => '2016-03-20', 'payer_email' => 'dreamvilla-buyer@outlook.com', 'full_name' => 'Buyer Buyer', 'package_name' => 'PREMIUM', 'payment_status' => 'Completed', 'payment_gross' => '7.99' ), array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ) );
$wpdb->insert( $table_name, array( 'user_id' => '1', 'transaction_id' => '9BJ24595N03813041', 'payment_date' => '2016-03-09', 'payer_email' => 'dreamvilla-buyer@outlook.com', 'full_name' => 'Buyer Buyer', 'package_name' => 'STANDARD', 'payment_status' => 'Completed', 'payment_gross' => '4.99' ), array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ) );
$wpdb->insert( $table_name, array( 'user_id' => '1', 'transaction_id' => '9PV05562VX616563L', 'payment_date' => '2016-03-07', 'payer_email' => 'dreamvilla-buyer@outlook.com', 'full_name' => 'Buyer Buyer', 'package_name' => 'PREMIUM', 'payment_status' => 'Pending', 'payment_gross' => '7.99' ), array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ) );
$wpdb->insert( $table_name, array( 'user_id' => '1', 'transaction_id' => '24R10459MA392783A', 'payment_date' => '2016-02-11', 'payer_email' => 'dreamvilla-buyer@outlook.com', 'full_name' => 'Buyer Buyer', 'package_name' => 'GOLD', 'payment_status' => 'Completed', 'payment_gross' => '14.99' ), array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ) );
$wpdb->insert( $table_name, array( 'user_id' => '1', 'transaction_id' => '8RV65084UB9133139', 'payment_date' => '2016-01-22', 'payer_email' => 'dreamvilla-buyer@outlook.com', 'full_name' => 'Buyer Buyer', 'package_name' => 'STANDARD', 'payment_status' => 'Completed', 'payment_gross' => '4.99' ), array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ) );
$wpdb->insert( $table_name, array( 'user_id' => '1', 'transaction_id' => '0VY31613SE753960X', 'payment_date' => '2016-01-21', 'payer_email' => 'dreamvilla-buyer@outlook.com', 'full_name' => 'Buyer Buyer', 'package_name' => 'PREMIUM', 'payment_status' => 'Denied', 'payment_gross' => '7.99' ), array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ) );
$wpdb->insert( $table_name, array( 'user_id' => '1', 'transaction_id' => '8RV65084UB9133139', 'payment_date' => '2016-01-10', 'payer_email' => 'dreamvilla-buyer@outlook.com', 'full_name' => 'Buyer Buyer', 'package_name' => 'GOLD', 'payment_status' => 'Completed', 'payment_gross' => '14.99' ), array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ) );
$wpdb->insert( $table_name, array( 'user_id' => '1', 'transaction_id' => '9BJ24595N03813041', 'payment_date' => '2015-12-21', 'payer_email' => 'dreamvilla-buyer@outlook.com', 'full_name' => 'Buyer Buyer', 'package_name' => 'STANDARD', 'payment_status' => 'Completed', 'payment_gross' => '4.99' ), array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ) );
$wpdb->insert( $table_name, array( 'user_id' => '1', 'transaction_id' => '24R10459MA392783A', 'payment_date' => '2015-12-19', 'payer_email' => 'dreamvilla-buyer@outlook.com', 'full_name' => 'Buyer Buyer', 'package_name' => 'PREMIUM', 'payment_status' => 'Completed', 'payment_gross' => '7.99' ), array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ) );*/
?>
<div class="view-invoices inner-page-gallery-two-columns-dimension-detail">
	<div class="invoice-filter">
		<form class="invoice_form" name="invoice_form" method="post">

			<input type="text" name="payment_fromdate" id="payment_fromdate" placeholder="from date"></input>
			<input type="text" name="payment_todate" id="payment_todate" placeholder="to date"></input>
			
			<select name="package_name" id="package_name">
				<option value=""><?php esc_html_e('Any','dreamvilla-multiple-property'); ?></option>
				<?php
				$args = array(
	                'post_type'      => 'package',
	                'posts_per_page' => -1,
	                'order'          => 'ASC'                  
	            );
	            $package_list = new WP_Query( $args );

	            if($package_list->have_posts()){
	                while($package_list->have_posts()):$package_list->the_post(); ?>
						<option value="<?php echo strtoupper($package_list->post->post_title); ?>"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$package_list->post->post_title); ?></option><?php
	                endwhile;
	            } ?>
			</select>

			<select name="payment_status" id="payment_status">
				<option value=""><?php esc_html_e('Any','dreamvilla-multiple-property'); ?></option>
				<option value="Canceled_Reversal"><?php esc_html_e('Canceled_Reversal','dreamvilla-multiple-property'); ?></option>
				<option value="Completed"><?php esc_html_e('Completed','dreamvilla-multiple-property'); ?></option>
				<option value="Created"><?php esc_html_e('Created','dreamvilla-multiple-property'); ?></option>
				<option value="Denied"><?php esc_html_e('Denied','dreamvilla-multiple-property'); ?></option>
				<option value="Expired"><?php esc_html_e('Expired','dreamvilla-multiple-property'); ?></option>
				<option value="Failed"><?php esc_html_e('Failed','dreamvilla-multiple-property'); ?></option>
				<option value="Pending"><?php esc_html_e('Pending','dreamvilla-multiple-property'); ?></option>
				<option value="Refunded"><?php esc_html_e('Refunded','dreamvilla-multiple-property'); ?></option>
				<option value="Reversed"><?php esc_html_e('Reversed','dreamvilla-multiple-property'); ?></option>
				<option value="Processed"><?php esc_html_e('Processed','dreamvilla-multiple-property'); ?></option>
				<option value="Voided"><?php esc_html_e('Voided','dreamvilla-multiple-property'); ?></option>
			</select>
			
			<input type="submit" name="filterinvoice" class="filter-invoice" value="Filter" />
			<p class="status"></p>
		</form>		
	</div>
		
	<p><?php esc_html_e('Total Invoices:','dreamvilla-multiple-property'); ?> 
		<span class="total-invoice"><?php 
			printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['dreamvilla_mp_paypal_currency_code']);
			
			global $wpdb;
			$table_name = $wpdb->prefix . 'invoices';
			$newquery = "SELECT ROUND(SUM(payment_gross), 2) FROM $table_name WHERE user_id = $User_ID";
			$invoice_list = $wpdb->get_var( $newquery );

			printf( esc_html__(' %s','dreamvilla-multiple-property'),$invoice_list); ?>
		</span>
	</p>
	<table class="table table-striped invoice-table">
		<thead>
			<tr>
				<th><?php esc_html_e('No','dreamvilla-multiple-property'); ?></th>
				<th><?php esc_html_e('Transaction ID','dreamvilla-multiple-property'); ?></th>
				<th><?php esc_html_e('Date','dreamvilla-multiple-property'); ?></th>
				<th><?php esc_html_e('Payer Email','dreamvilla-multiple-property'); ?></th>
				<th><?php esc_html_e('Full Name','dreamvilla-multiple-property'); ?></th>
				<th><?php esc_html_e('Package','dreamvilla-multiple-property'); ?></th>
				<th><?php esc_html_e('Status','dreamvilla-multiple-property'); ?></th>
				<th><?php esc_html_e('Price','dreamvilla-multiple-property'); ?></th>
			</tr>
		</thead>
		<tbody><?php				
			
			global $wpdb;
			$table_name = $wpdb->prefix . 'invoices';				
			$querystr = "SELECT * FROM $table_name WHERE user_id = $User_ID ORDER BY $table_name.payment_date DESC";
		 	$invoice_list = $wpdb->get_results($querystr, OBJECT);

		 	if ($invoice_list){ 
		 		foreach ($invoice_list as $key => $value) { ?>
					<tr>
						<td><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$key+1); ?></td>
						<td><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$value->transaction_id); ?></td>
						<td><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$value->payment_date); ?></td>
						<td><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$value->payer_email); ?></td>
						<td><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$value->full_name); ?></td>
						<td><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$value->package_name); ?></td>
						<td><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$value->payment_status); ?></td>
						<td><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$value->payment_gross); ?></td>
					</tr><?php
				}					
			} ?>								
		</tbody>
	</table>	
</div>