<?php

defined('ABSPATH') or die("...");

/**
 * This file creates the plugin settings page
 *
 * @package Lidd's Mortgage Calculator
 * @since 2.0.0
 */

// Create a settings page.
add_action( 'admin_menu', 'lidd_mc_add_settings_page' );

/**
 * Callback function to register the settings page and menu option.
 */
function lidd_mc_add_settings_page() {
	add_options_page( 'Responsive Mortgage Calculator', __( 'Resp Mortgage Calculator', 'responsive-mortgage-calculator' ), 'manage_options', LIDD_MC_OPTIONS, 'lidd_mc_settings_page' );
}

// Register the specific sections and settings on the settings page.
add_action( 'admin_init', 'lidd_mc_admin_init' );

/**
 * Callback function to register the specific sections and settings on the settings page.
 */
function lidd_mc_admin_init() {
	
	// Register the settings
	register_setting( LIDD_MC_OPTIONS, LIDD_MC_OPTIONS, 'lidd_mc_validate_options' );
	
	// Create a new options object in order to validate and store options
	global $lidd_mc_options_object;
	$lidd_mc_options_object = new LiddMCOptions();
	
	
	// Create settings page sections
	// --------------------------------------------
	// Default values
	add_settings_section( 'lidd_mc_defaultvalues', __( 'Default Values', 'responsive-mortgage-calculator' ), 'lidd_mc_defaultvalues_text', LIDD_MC_OPTIONS );
	// Set a default interest rate
	add_settings_field( 'lidd_mc_total_amount_value', __( 'Total Amount', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_total_amount_value', LIDD_MC_OPTIONS, 'lidd_mc_defaultvalues' );
	// Set a default interest rate
	add_settings_field( 'lidd_mc_down_payment_value', __( 'Down Payment', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_down_payment_value', LIDD_MC_OPTIONS, 'lidd_mc_defaultvalues' );
	// Set a default interest rate
	add_settings_field( 'lidd_mc_interest_rate_value', __( 'Interest Rate', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_interest_rate_value', LIDD_MC_OPTIONS, 'lidd_mc_defaultvalues' );
	// Set a default interest rate
	add_settings_field( 'lidd_mc_amortization_period_value', __( 'Interest Rate', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_amortization_period_value', LIDD_MC_OPTIONS, 'lidd_mc_defaultvalues' );

	// Calculator settings
	add_settings_section( 'lidd_mc_calcsettings', __( 'Calculator Settings', 'responsive-mortgage-calculator' ), 'lidd_mc_options_calcsettings_text', LIDD_MC_OPTIONS );
	// Compounding period
	add_settings_field( 'lidd_mc_compounding_period', __( 'Compounding Period', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_compounding_period', LIDD_MC_OPTIONS, 'lidd_mc_calcsettings' );
	// Currency symbol
	add_settings_field( 'lidd_mc_currency', __( 'Currency Symbol', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_currency', LIDD_MC_OPTIONS, 'lidd_mc_calcsettings' );
	// Currency code
	add_settings_field( 'lidd_mc_currency_code', __( 'Currency Code', 'responsive-mortgage-calculator' ) . ' &ndash; <a href="http://www.currency-iso.org/">ISO 4217</a>', 'lidd_mc_settings_currency_code', LIDD_MC_OPTIONS, 'lidd_mc_calcsettings' );
	// Currency format
	add_settings_field( 'lidd_mc_currency_format', __( 'Currency Format', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_currency_format', LIDD_MC_OPTIONS, 'lidd_mc_calcsettings' );
	// Number format
	add_settings_field( 'lidd_mc_number_format', __( 'Number Format', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_number_format', LIDD_MC_OPTIONS, 'lidd_mc_calcsettings' );
	// Set a minimum loan amount
	add_settings_field( 'lidd_mc_minimum_total_amount', __( 'Minimum Total Amount', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_minimum_total_amount', LIDD_MC_OPTIONS, 'lidd_mc_calcsettings' );
	// Include Down Payment field
	add_settings_field( 'lidd_mc_down_payment_visible', __( 'Down Payment', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_down_payment_visible', LIDD_MC_OPTIONS, 'lidd_mc_calcsettings' );
    // Allow for 0% interest
    add_settings_field( 'lidd_mc_zero_percent_interest', __( '0% Interest', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_zero_percent_interest', LIDD_MC_OPTIONS, 'lidd_mc_calcsettings' );
	// Set the base for the amortization period
	add_settings_field( 'lidd_mc_amortization_period_units', __( 'Amortization Period Units', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_amortization_period_units', LIDD_MC_OPTIONS, 'lidd_mc_calcsettings' );
    
    // ***** Payment Period Options
    
    // Create a new section for payment period
	add_settings_section( 'lidd_mc_payment_period_settings', __( 'Payment Period Settings', 'responsive-mortgage-calculator' ), 'lidd_mc_options_payment_period_settings_text', LIDD_MC_OPTIONS );

	// Set a fixed Payment Period (creates a hidden input with a set payment period)
	add_settings_field( 'lidd_mc_fixed_payment_period', __( 'Fixed Payment Period', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_fixed_payment_period', LIDD_MC_OPTIONS, 'lidd_mc_payment_period_settings' );
    
    // Annual
	add_settings_field( 'lidd_mc_payment_period_1', __( 'Annual Payment Period', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_payment_period_1', LIDD_MC_OPTIONS, 'lidd_mc_payment_period_settings' );
    
    // Semi-annual
	add_settings_field( 'lidd_mc_payment_period_2', __( 'Semi-Annual Payment Period', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_payment_period_2', LIDD_MC_OPTIONS, 'lidd_mc_payment_period_settings' );
    
    // Quarterly
	add_settings_field( 'lidd_mc_payment_period_4', __( 'Quarterly Payment Period', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_payment_period_4', LIDD_MC_OPTIONS, 'lidd_mc_payment_period_settings' );
    
    // Monthly
	add_settings_field( 'lidd_mc_payment_period_12', __( 'Monthly Payment Period', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_payment_period_12', LIDD_MC_OPTIONS, 'lidd_mc_payment_period_settings' );
    
    // Bi-Weekly
	add_settings_field( 'lidd_mc_payment_period_26', __( 'Bi-Weekly Payment Period', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_payment_period_26', LIDD_MC_OPTIONS, 'lidd_mc_payment_period_settings' );
    
    // Weekly
	add_settings_field( 'lidd_mc_payment_period_52', __( 'Weekly Payment Period', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_payment_period_52', LIDD_MC_OPTIONS, 'lidd_mc_payment_period_settings' );
    

	// --------------------------------------------
	// General styling
	add_settings_section( 'lidd_mc_css', __( 'Layout and Styling (CSS)', 'responsive-mortgage-calculator' ), 'lidd_mc_options_css_text', LIDD_MC_OPTIONS );
	// Theme (light, dark, none)
	add_settings_field( 'lidd_mc_theme', __( 'Theme', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_theme', LIDD_MC_OPTIONS, 'lidd_mc_css' );
	// Include fancy payment period styles
	add_settings_field( 'lidd_mc_select_style', __( 'Payment Period', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_select_style', LIDD_MC_OPTIONS, 'lidd_mc_css' );
	// Fancy payment period down arrow position
	add_settings_field( 'lidd_mc_select_pointer', __( 'Payment Period Adjustment', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_select_pointer', LIDD_MC_OPTIONS, 'lidd_mc_css' );
	// Include responsive styles
	add_settings_field( 'lidd_mc_css_layout', __( 'Responsiveness', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_css_layout', LIDD_MC_OPTIONS, 'lidd_mc_css' );

	// --------------------------------------------
	// Results
	add_settings_section( 'lidd_mc_results', __( 'Results', 'responsive-mortgage-calculator' ), 'lidd_mc_options_results_text', LIDD_MC_OPTIONS );
/*
	// Additional information panel (0 = hide, 1 = toggle, 2 = always show)
	add_settings_field( 'lidd_mc_summary', __( 'Results Summary Visibility', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_summary', LIDD_MC_OPTIONS, 'lidd_mc_results' );
*/

	// Additional information panel (0 = hide, 1 = toggle, 2 = always show)
	add_settings_field( 'lidd_mc_popup', __( 'Results Popup Behaviour', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_popup', LIDD_MC_OPTIONS, 'lidd_mc_results' );
	// Show the total with interest (0 = hide, 1 = show)
	add_settings_field( 'lidd_mc_summary_interest', __( 'Total Amount with Interest', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_summary_interest', LIDD_MC_OPTIONS, 'lidd_mc_results' );
	// Show the total with down payment (0 = hide, 1 = show)
	add_settings_field( 'lidd_mc_summary_downpayment', __( 'Total with Down Payment', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_summary_downpayment', LIDD_MC_OPTIONS, 'lidd_mc_results' );

	// --------------------------------------------
	// Labels
	add_settings_section( 'lidd_mc_labels', __( 'Input Labels', 'responsive-mortgage-calculator' ), 'lidd_mc_options_labels_text', LIDD_MC_OPTIONS );
	// Total Amount label
	add_settings_field( 'lidd_mc_total_amount_label', __( 'Total Amount label', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_total_amount_label', LIDD_MC_OPTIONS, 'lidd_mc_labels' );
	// Down Payment label
	add_settings_field( 'lidd_mc_down_payment_label', __( 'Down Payment label', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_down_payment_label', LIDD_MC_OPTIONS, 'lidd_mc_labels' );
	// Interest Rate label
	add_settings_field( 'lidd_mc_interest_rate_label', __( 'Interest Rate label', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_interest_rate_label', LIDD_MC_OPTIONS, 'lidd_mc_labels' );
	// Amortization Period label
	add_settings_field( 'lidd_mc_amortization_period_label', 'Amortization Period label', 'lidd_mc_settings_amortization_period_label', LIDD_MC_OPTIONS, 'lidd_mc_labels' );
	// Payment Period label
	add_settings_field( 'lidd_mc_payment_period_label', __( 'Payment Period label', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_payment_period_label', LIDD_MC_OPTIONS, 'lidd_mc_labels' );
	// Submit label
	add_settings_field( 'lidd_mc_submit_label', __( 'Submit button label', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_submit_label', LIDD_MC_OPTIONS, 'lidd_mc_labels' );

	// --------------------------------------------
	// Classes
	add_settings_section( 'lidd_mc_classes', __( 'Input Classes', 'responsive-mortgage-calculator' ), 'lidd_mc_options_classes_text', LIDD_MC_OPTIONS );
	// Total Amount class
	add_settings_field( 'lidd_mc_total_amount_class', __( 'Total Amount class', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_total_amount_class', LIDD_MC_OPTIONS, 'lidd_mc_classes' );
	// Down Payment class
	add_settings_field( 'lidd_mc_down_payment_class', __( 'Down Payment class', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_down_payment_class', LIDD_MC_OPTIONS, 'lidd_mc_classes' );
	// Interest Rate class
	add_settings_field( 'lidd_mc_interest_rate_class', __( 'Interest Rate class', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_interest_rate_class', LIDD_MC_OPTIONS, 'lidd_mc_classes' );
	// Amortization Period class
	add_settings_field( 'lidd_mc_amortization_period_class', __( 'Amortization Period class', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_amortization_period_class', LIDD_MC_OPTIONS, 'lidd_mc_classes' );
	// Payment Period class
	add_settings_field( 'lidd_mc_payment_period_class', __( 'Payment Period class', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_payment_period_class', LIDD_MC_OPTIONS, 'lidd_mc_classes' );
	// Submit class
	add_settings_field( 'lidd_mc_submit_class', __( 'Submit button class', 'responsive-mortgage-calculator' ), 'lidd_mc_settings_submit_class', LIDD_MC_OPTIONS, 'lidd_mc_classes' );
	
}

// --------------------------------------------
// Settings section text functions.
function lidd_mc_options_calcsettings_text() {
	echo '<p>' . __( 'Change the basic functioning and parameters for the calculator.', 'responsive-mortgage-calculator' ) . '</p>';
}
function lidd_mc_defaultvalues_text() {
	echo '<p>' . __( 'Default values for the mortgage calculator form.', 'responsive-mortgage-calculator' ) . '</p>';
}

function lidd_mc_options_payment_period_settings_text() {
	echo '<p>' . __( 'Set available payment periods or set a fixed payment period.', 'responsive-mortgage-calculator' ) . '</p>';
}
function lidd_mc_options_css_text() {
	echo '<p>' . __( 'Toggle layout and styling. Remove styling to prevent CSS from loading (but it won\'t be responsive any more).', 'responsive-mortgage-calculator' ) . '</p>';
}
function lidd_mc_options_results_text() {
	echo '<p>' . __( 'Change the additional information panel settings.', 'responsive-mortgage-calculator' ) . '</p>';
}
function lidd_mc_options_labels_text() {
	echo '<p>' . __( 'Set your own labels for the inputs.', 'responsive-mortgage-calculator' ) . '</p>';
}
function lidd_mc_options_classes_text() {
	echo '<p>' . __( 'Add CSS classes to override styles or to hook into your theme\'s styling.', 'responsive-mortgage-calculator' ) . '</p>';
}


// --------------------------------------------
// Settings input functions

/**
 * Generic function to create a text input on the settings page.
 */
function lidd_mc_settings_text_input( $key ) {
	// Get the option.
	global $lidd_mc_options_object;
	$value = $lidd_mc_options_object->getOption( $key );
	// Display the input.
	echo '<input type="text" id="' . $key . '" name="' . LIDD_MC_OPTIONS . '[' . $key . ']" value="' . esc_attr( $value ) . '" />';
}
/**
 * Generic function to create a checkbox on the settings page.
 */
function lidd_mc_settings_checkbox( $key, $label ) {
	// Get the option.
	global $lidd_mc_options_object;
	$value = $lidd_mc_options_object->getOption( $key );
	// Display the input.
	echo '<input type="checkbox" id="' . $key . '" name="' . LIDD_MC_OPTIONS . '[' . $key . ']" ' . checked( $value, 1, false ) . '/> <label for="' . $key . '">' . $label . '</label>';
}
/**
 * Generic function to create a select box on the settings page.
 */
function lidd_mc_settings_selectbox( $key, $options ) {
	// Get the option.
	global $lidd_mc_options_object;
	$value = $lidd_mc_options_object->getOption( $key );
	// Display the input.
	$select = '
		<select name="' . LIDD_MC_OPTIONS . '[' . esc_attr( $key ) . ']">';
	foreach ( $options as $k => $v ) {
		$select .= '
			<option value="' . $k . '" ' . selected( $value, $k, false ) . '>' . esc_html( $v ) . '</option>';
	}
	$select .= '
		</select>';
	echo $select;
}

// Specific functions
/**
 * Function to create compounding period settings input.
 */
function lidd_mc_settings_compounding_period() {
	$options = array(
		1 => __( 'Annually', 'responsive-mortgage-calculator' ),
		2 => __( 'Semi-Annually', 'responsive-mortgage-calculator' ), 
		4 => __( 'Quarterly', 'responsive-mortgage-calculator' ),
		12 => __( 'Monthly', 'responsive-mortgage-calculator' )
	);
	lidd_mc_settings_selectbox( 'compounding_period', $options );
    echo ' <p class="description">Set the interest rate compounding period for your region.</p>';
}
/**
 * Function to create currency settings input.
 */
function lidd_mc_settings_currency() {
	lidd_mc_settings_text_input( 'currency' );
}
/**
 * Function to create currency code settings input.
 */
function lidd_mc_settings_currency_code() {
	lidd_mc_settings_text_input( 'currency_code' );
}
/**
 * Function to create currency code settings input.
 */
function lidd_mc_settings_currency_format() {
	lidd_mc_settings_text_input( 'currency_format' );
    echo ' <p class="description">Use the tags {currency}, {amount} and {code} to structure how currency is displayed in the results. Spaces are allowed.</p>';
}
/**
 * Function to create number formatsettings input.
 */
function lidd_mc_settings_number_format() {
	$options = array(
		1 => 'X XXX - space separator, no decimal places, eg. 123 456',
		2 => 'X XXX.XX - space separator, two decimal places, eg. 123 456.00',
		3 => 'X XXX.XXX - space separator, three decimal places, eg. 123 456.000',
		4 => 'X,XXX - comma separator, no decimal places, eg. 123,456',
		5 => 'XX,XX,XXX - comma separator (Indian system), no decimal places, eg. 1,23,456',
		6 => 'X,XXX.XX - comma separator, two decimal places, eg. 123,456.00',
		7 => 'X,XXX.XXX - comma separator, three decimal places, eg. 123,456.000',
		8 => 'X.XXX - dot separator, no decimal places, eg. 123.456',
		9 => 'X.XXX,XX - dot separator, two decimal places with comma, eg. 123.456,00',
		10 => 'X.XXX,XXX - dot separator, three decimal places with comma, eg. 123.456,000',
		11 => 'X\'XXX.XX - apostrophe separator, two decimal places, eg. 123\'456.00'
	);
	lidd_mc_settings_selectbox( 'number_format', $options );
    echo ' <p class="description">Select the number format with which to display the currency.</p>';
}
/**
 * Function to create interest rate default value settings input.
 */
function lidd_mc_settings_minimum_total_amount() {
	lidd_mc_settings_text_input( 'minimum_total_amount' );
    echo ' <p class="description">Set a minimum total amount, like 25000. Any value below this amount will trigger an error.</p>';
}
/**
 * Function to create down payment visibility settings input.
 */
function lidd_mc_settings_down_payment_visible() {
    $label = 'Allow users to add a down payment to their calculation.';
	lidd_mc_settings_checkbox( 'down_payment_visible', $label );
}
/**
 * Function to create interest rate default value settings input.
 */
function lidd_mc_settings_interest_rate_value() {
	lidd_mc_settings_text_input( 'interest_rate_value' );
	echo " %";
    echo ' <p class="description">You can set a default interest rate, like 5.00, and it will automatically be filled in to the calculator. Or leave it blank.</p>';
}
/**
 * Function to create total amount default value settings input.
 */
function lidd_mc_settings_total_amount_value() {
	lidd_mc_settings_text_input( 'total_amount_value' );
	echo " $";
    echo ' <p class="description">You can set a default total amount, like 300,000.00, and it will automatically be filled in to the calculator. Or leave it blank.</p>';
}
/**
 * Function to create down payment default value settings input.
 */
function lidd_mc_settings_down_payment_value() {
	lidd_mc_settings_text_input( 'down_payment_value' );
	echo " $";
    echo ' <p class="description">You can set a default down payment, like 60,000.00, and it will automatically be filled in to the calculator. Or leave it blank.</p>';
}
/**
 * Function to create amortization period default value settings input.
 */
function lidd_mc_settings_amortization_period_value() {
	lidd_mc_settings_text_input( 'amortization_period_value' );
	echo " years/months";
    echo ' <p class="description">You can set a default amortization period, like 30, and it will automatically be filled in to the calculator. Or leave it blank.</p>';
}
/**
 * Callback to create 0% interest field
 */
function lidd_mc_settings_zero_percent_interest() {
    lidd_mc_settings_checkbox( 'zero_percent_interest', 'Allow 0% interest.' );
}
/**
 * Function to create amortization period units settings input.
 */
function lidd_mc_settings_amortization_period_units() {
	$options = array(
		'0' => __( 'Years', 'responsive-mortgage-calculator' ),
		'1' => __( 'Months', 'responsive-mortgage-calculator' )
	);
	lidd_mc_settings_selectbox( 'amortization_period_units', $options );
    echo ' <p class="description">Set whether the amortization period is calculated in years or months.</p>';
}

// ***** Payment Period settings inputs

/**
 * Function to create fixed payment period settings input.
 */
function lidd_mc_settings_fixed_payment_period() {
	$options = array(
		'0'  => __( 'Allow user selection', 'responsive-mortgage-calculator' ),
		'1'  => __( 'Annual', 'responsive-mortgage-calculator' ),
		'2'  => __( 'Semi-Annual', 'responsive-mortgage-calculator' ),
		'4'  => __( 'Quarterly', 'responsive-mortgage-calculator' ),
		'12' => __( 'Monthly', 'responsive-mortgage-calculator' ),
		'26' => __( 'Bi-Weekly', 'responsive-mortgage-calculator' ),
		'52' => __( 'Weekly', 'responsive-mortgage-calculator' )
	);
	lidd_mc_settings_selectbox( 'payment_period', $options );
    echo ' <p class="description">You can set a specific payment period. This hides the select box.</p>';
}
/**
 * Function for creating the annual payment period input
 */
function lidd_mc_settings_payment_period_1() {
    $label = __( 'Allow users to select <b>Annual</b> payment period.', 'responsive-mortgage-calculator' );
    lidd_mc_settings_checkbox( 'payment_period_option_1', $label );
}
/**
 * Function for creating the annual payment period input
 */
function lidd_mc_settings_payment_period_2() {
    $label = __( 'Allow users to select <b>Semi-Annual</b> payment period.', 'responsive-mortgage-calculator' );
    lidd_mc_settings_checkbox( 'payment_period_option_2', $label );
}
/**
 * Function for creating the annual payment period input
 */
function lidd_mc_settings_payment_period_4() {
    $label = __( 'Allow users to select <b>Quarterly</b> payment period.', 'responsive-mortgage-calculator' );
    lidd_mc_settings_checkbox( 'payment_period_option_4', $label );
}
/**
 * Function for creating the annual payment period input
 */
function lidd_mc_settings_payment_period_12() {
    $label = __( 'Allow users to select <b>Monthly</b> payment period.', 'responsive-mortgage-calculator' );
    lidd_mc_settings_checkbox( 'payment_period_option_12', $label );
}
/**
 * Function for creating the annual payment period input
 */
function lidd_mc_settings_payment_period_26() {
    $label = __( 'Allow users to select <b>Bi-Weekly</b> payment period.', 'responsive-mortgage-calculator' );
    lidd_mc_settings_checkbox( 'payment_period_option_26', $label );
}
/**
 * Function for creating the annual payment period input
 */
function lidd_mc_settings_payment_period_52() {
    $label = __( 'Allow users to select <b>Weekly</b> payment period.', 'responsive-mortgage-calculator' );
    lidd_mc_settings_checkbox( 'payment_period_option_52', $label );
}


/**
 * Function to create theme settings input.
 */
function lidd_mc_settings_theme() {
	$options = array(
		'light' => __( 'Light', 'responsive-mortgage-calculator' ), 
		'dark' => __( 'Dark', 'responsive-mortgage-calculator' ),
		'none' => __( 'Use my theme\'s default styling', 'responsive-mortgage-calculator' )
	);
	lidd_mc_settings_selectbox( 'theme', $options );
    echo ' <p class="description">Set the general color of the theme. Or set it to none and create your own.</p>';
}
/**
 * Function to create select box styling settings input.
 */
function lidd_mc_settings_select_style() {
    $label = 'Add fancy styling to the Payment Period select box.';
	lidd_mc_settings_checkbox( 'select_style', $label );
}
/**
 * Function to create select box down arrow settings input.
 */
function lidd_mc_settings_select_pointer() {
	//lidd_mc_settings_text_input( 'select_pointer' );
	$options = array(
		'dot5' => '.5em',
		'dot65' => '.65em',
		'dot75' => '.75em',
		'dot85' => '.85em',
		'1' => '1em'
	);
	lidd_mc_settings_selectbox( 'select_pointer', $options );
    echo ' <p class="description">Adjust the vertical position of the down arrow on the fancy select box.</p>';
}
/**
 * Function to create CSS layout/responsive settings input.
 */
function lidd_mc_settings_css_layout() {
    $label = 'Make it responsive!';
	lidd_mc_settings_checkbox( 'css_layout', $label );
}
/**
 * Function to create result summary settings input.
 */
function lidd_mc_settings_summary() {
	$options = array(
		0 => __( 'Don\'t include the summary', 'responsive-mortgage-calculator' ), 
		1 => __( 'Hide the summary, but show the toggle icon', 'responsive-mortgage-calculator' ),
		2 => __( 'Show the summary (no toggle)', 'responsive-mortgage-calculator' )
	);
	lidd_mc_settings_selectbox( 'summary', $options );
	
}
/**
 * Function to create result summary settings input.
 */
function lidd_mc_settings_popup() {
	$options = array(
		0 => __( 'Show the summary popup immediately', 'responsive-mortgage-calculator' ), 
		1 => __( 'Show the monthly payment and the toggle button', 'responsive-mortgage-calculator' ),
		2 => __( 'Show the monthly payment, textual summary and the toggle button', 'responsive-mortgage-calculator' )
	);
	lidd_mc_settings_selectbox( 'popup', $options );
	
}
/**
 * Function to create result summary interest settings input.
 */
function lidd_mc_settings_summary_interest() {
    $label = 'Show the total amount with interest in the results.';
	lidd_mc_settings_checkbox( 'summary_interest', $label );
}
/**
 * Function to create result summary down payment settings input.
 */
function lidd_mc_settings_summary_downpayment() {
    $label = 'Show the total amount with down payment in the results. This includes interest.';
	lidd_mc_settings_checkbox( 'summary_downpayment', $label );
}
/**
 * Function to create total amount label settings input.
 */
function lidd_mc_settings_total_amount_label() {
	lidd_mc_settings_text_input( 'total_amount_label' );
}
/**
 * Function to create down payment label settings input.
 */
function lidd_mc_settings_down_payment_label() {
	lidd_mc_settings_text_input( 'down_payment_label' );
}
/**
 * Function to create interest rate label settings input.
 */
function lidd_mc_settings_interest_rate_label() {
	lidd_mc_settings_text_input( 'interest_rate_label' );
}
/**
 * Function to create amortization period label settings input.
 */
function lidd_mc_settings_amortization_period_label() {
	lidd_mc_settings_text_input( 'amortization_period_label' );
}
/**
 * Function to create payment period label settings input.
 */
function lidd_mc_settings_payment_period_label() {
	lidd_mc_settings_text_input( 'payment_period_label' );
}
/**
 * Function to create submit button value settings input.
 */
function lidd_mc_settings_submit_label() {
	lidd_mc_settings_text_input( 'submit_label' );
}
/**
 * Function to create total amount class settings input.
 */
function lidd_mc_settings_total_amount_class() {
	lidd_mc_settings_text_input( 'total_amount_class' );
}
/**
 * Function to create down payment class settings input.
 */
function lidd_mc_settings_down_payment_class() {
	lidd_mc_settings_text_input( 'down_payment_class' );
}
/**
 * Function to create interest rate class settings input.
 */
function lidd_mc_settings_interest_rate_class() {
	lidd_mc_settings_text_input( 'interest_rate_class' );
}
/**
 * Function to create amortization period class settings input.
 */
function lidd_mc_settings_amortization_period_class() {
	lidd_mc_settings_text_input( 'amortization_period_class' );
}
/**
 * Function to create payment period class settings input.
 */
function lidd_mc_settings_payment_period_class() {
	lidd_mc_settings_text_input( 'payment_period_class' );
}
/**
 * Function to create submit button class settings input.
 */
function lidd_mc_settings_submit_class() {
	lidd_mc_settings_text_input( 'submit_class' );
}


// --------------------------------------------
// Validation

/**
 * Generic function for validating classes.
 */
function lidd_mc_clean_text( $text ) {
	return preg_replace( '/[^a-z0-9 _-]/i', '', $text );
}

/**
 * Generic function for validating labels.
 */
function lidd_mc_clean_label( $text ) {
	return sanitize_text_field( $text );
}

/**
 * Generic function for validating number.
 */
function lidd_mc_clean_number( $number ) {
	$number = preg_replace( '/[^0-9.]/', '', $number ); // Remove everything that isn't a digit or decimal
	if ( substr_count( $number, '.' ) > 1 ) { // Remove extra decimals
		$int = strstr( $number, '.', true );
		$decimal = str_replace( '.', '', strstr( $number, '.' ) );
		$number = $int . '.' . $decimal;
	}
	return number_format( $number, 2, '.', '' );
}

/**
 * Generic function for setting errors.
 */
function lidd_mc_settings_error( $key, $type ) {
	add_settings_error(
		'lidd_mc_' . $key,
		'lidd_mc_' . $key . '_error',
		'The ' . $type . ' can contain only letters, numbers, spaces, hyphens and the underscore.',
		'error'
	);
}

/**
 * Callback function to validate options.
 */
function lidd_mc_validate_options( $input ) {
	$valid = array();

	// Calculator settings
	$valid['compounding_period'] = ( isset( $input['compounding_period'] ) && in_array( $input['compounding_period'], array( 1, 2, 4, 12 ) ) ) ? absint( $input['compounding_period'] ) : 2;
	
	// Currency
	if ( isset( $input['currency'] ) ) {
        $valid['currency'] = sanitize_text_field( $input['currency'] );
	} else {
		$valid['currency'] = null;
	}
	
	// Currency code
	if ( isset( $input['currency_code'] ) ) {
		$valid['currency_code'] = strtoupper( preg_replace( '/[^a-z]/i', '', $input['currency_code'] ) );
		$valid['currency_code'] = substr( $valid['currency_code'], 0, 3 );
	} else {
		$valid['currency_code'] = null;
	}
    
    // Currency format
    if ( isset( $input['currency_format'] ) ) {
        $regex = '![^(\{currency\})|(\{amount\})|(\{code\})| ]!';
        $valid['currency_format'] = strtolower( trim( $input['currency_format'] ) );
        $valid['currency_format'] = preg_replace( $regex, '', $valid['currency_format'] );
        if ( $valid['currency_format'] == '' ) {
            $valid['currency_format'] = '{currency}{amount} {code}';
        }
        else if ( substr_count( $valid['currency_format'], '{amount}' ) == 0 ) {
            $valid['currency_format'] .= '{amount}';
        }
    } else {
        $valid['currency_format'] = '{currency}{amount} {code}';
    }
    
    // Number format
    if ( isset( $input['number_format'] ) ) {
        $valid['number_format'] = preg_replace( '![^0-9]!', '', $input['number_format'] );
        if ( $valid['number_format'] == '' || $valid['number_format'] < 1 || $valid['number_format'] > 11 ) {
            $valid['number_format'] = 6;
        }
    } else {
        $valid['number_format'] = 6;
    }
	
	// Minimum total amount field
	if ( !empty( $input['minimum_total_amount'] ) ) {
		$valid['minimum_total_amount'] = floor( lidd_mc_clean_number( $input['minimum_total_amount'] ) );
	} else {
		$valid['minimum_total_amount'] = null;
	}
    
	// Down payment field
	$valid['down_payment_visible'] = ( isset( $input['down_payment_visible'] ) ) ? 1 : 0;
	
	// Interest rate field
	if ( !empty( $input['interest_rate_value'] ) ) {
		$valid['interest_rate_value'] = lidd_mc_clean_number( $input['interest_rate_value'] );
	} else {
		$valid['interest_rate_value'] = null;
	}

	// Total amount field
	if ( !empty( $input['total_amount_value'] ) ) {
		$valid['total_amount_value'] = lidd_mc_clean_number( $input['total_amount_value'] );
	} else {
		$valid['total_amount_value'] = null;
	}

	// Down payment field
	if ( !empty( $input['down_payment_value'] ) ) {
		$valid['down_payment_value'] = lidd_mc_clean_number( $input['down_payment_value'] );
	} else {
		$valid['down_payment_value'] = null;
	}

	// Down payment field
	if ( !empty( $input['amortization_period_value'] ) ) {
		$valid['amortization_period_value'] = (int) ( $input['amortization_period_value'] );
	} else {
		$valid['amortization_period_value'] = null;
	}
    
    // 0% Interest field
	$valid['zero_percent_interest'] = ( isset( $input['zero_percent_interest'] ) ) ? 1 : 0;
    
    // Amortization period units
    if ( isset( $input['amortization_period_units'] ) ) {
        switch ( $input['amortization_period_units'] ) {
    		case '1':
    			$valid['amortization_period_units'] = 1;
    			break;
    		case '0':
    		default:
    			$valid['amortization_period_units'] = 0;
    			break;
        }
    } else {
        $valid['amortization_period_units'] = 0;
    }
	
	// Fixed payment period
	if ( isset( $input['payment_period'] ) ) {
		switch ( $input['payment_period'] ) {
			case '52':
				$valid['payment_period'] = 52;
				break;
			case '26':
				$valid['payment_period'] = 26;
				break;
			case '12':
				$valid['payment_period'] = 12;
				break;
			case '4':
				$valid['payment_period'] = 4;
				break;
            case '2':
                $valid['payment_period'] = 2;
                break;
			case '1':
				$valid['payment_period'] = 1;
				break;
			case '0':
			default:
				$valid['payment_period'] = 0;
				break;
		}
	} else {
		$valid['payment_period'] = 0;
	}
    
    // Allowed payment periods
	$valid['payment_period_option_1']  = ( isset( $input['payment_period_option_1'] ) ) ? 1 : 0;
	$valid['payment_period_option_2']  = ( isset( $input['payment_period_option_2'] ) ) ? 1 : 0;
	$valid['payment_period_option_4']  = ( isset( $input['payment_period_option_4'] ) ) ? 1 : 0;
	$valid['payment_period_option_12'] = ( isset( $input['payment_period_option_12'] ) ) ? 1 : 0;
	$valid['payment_period_option_26'] = ( isset( $input['payment_period_option_26'] ) ) ? 1 : 0;
	$valid['payment_period_option_52'] = ( isset( $input['payment_period_option_52'] ) ) ? 1 : 0;
	
	// Layout and styling
	if ( isset( $input['theme'] ) ) {
		switch ( $input['theme'] ) {
			case 'dark':
				$valid['theme'] = 'dark';
				break;
			case 'none':
				$valid['theme'] = 'none';
				break;
			case 'light':
			default:
				$valid['theme'] = 'light';
				break;
		}
	} else {
		$valid['theme'] = 'light';
	}
	$valid['select_style'] = ( isset( $input['select_style'] ) ) ? 1 : 0;
	$valid['select_pointer'] = ( isset( $input['select_pointer'] ) ) ? lidd_mc_clean_text( $input['select_pointer'] ) : null;
	$valid['css_layout'] = ( isset( $input['css_layout'] ) ) ? 1 : 0;
	
	// Results
	if ( isset( $input['popup'] ) ) {
		switch ( $input['popup'] ) {
			case 0:
				$valid['popup'] = 0;
				break;
			case 2:
				$valid['popup'] = 2;
				break;
			case 1:
			default:
				$valid['popup'] = 1;
				break;
		}
	} else {
		$valid['popup'] = 1;
	}
	if ( isset( $input['summary'] ) ) {
		switch ( $input['summary'] ) {
			case 0:
				$valid['summary'] = 0;
				break;
			case 2:
				$valid['summary'] = 2;
				break;
			case 1:
			default:
				$valid['summary'] = 1;
				break;
		}
	} else {
		$valid['summary'] = 1;
	}
	$valid['summary_interest'] = ( isset( $input['summary_interest'] ) ) ? 1 : 0;
	$valid['summary_downpayment'] = ( isset( $input['summary_downpayment'] ) ) ? 1 : 0;
	if ( isset( $input['popup'] ) ) {
		switch ( $input['popup'] ) {
			case 0:
				$valid['popup'] = 0;
				break;
			case 2:
				$valid['popup'] = 2;
				break;
			case 1:
			default:
				$valid['popup'] = 1;
				break;
		}
	} else {
		$valid['popup'] = 1;
	}
	
	// Define an array of label and class names
	$names = array(
		'total_amount',
		'down_payment',
		'interest_rate',
		'amortization_period',
		'payment_period',
		'submit'
	);
	
	// Clean the labels and register errors
	foreach ( $names as $name ) {
		$valid[$name . '_label'] = lidd_mc_clean_label( $input[$name . '_label'] );
		$valid[$name . '_class'] = lidd_mc_clean_text( $input[$name . '_class'] );
		if ( $valid[$name . '_label'] != $input[$name . '_label'] ) lidd_mc_settings_error( $name . '_label', 'label' );
		if ( $valid[$name . '_class'] != $input[$name . '_class'] ) lidd_mc_settings_error( $name . '_class', 'class' );
	}
	
	return $valid;
}


// --------------------------------------------
/**
 * Callback function to display the settings page.
 */
function lidd_mc_settings_page() {
	?>
	<div class="wrap">
		<h2><?php esc_html_e('Responsive Mortgage Calculator', 'responsive-mortgage-calculator' ); ?></h2>
        
		<p><?php
			
		printf(
			__('Add the calculator widget from the Widgets page, or add it to a page or post using the shortcode %1$s or %2$s.', 'responsive-mortgage-calculator'),
			'[mortgagecalculator]',
			'[rmc]'
		);
		
		?></p>
        
		
		<form action="options.php" method="post">
			<?php settings_fields( LIDD_MC_OPTIONS ); ?>
			<?php do_settings_sections( LIDD_MC_OPTIONS ); ?>
			<input name="submit" type="submit" value="<?php esc_attr_e( 'Save Changes', 'responsive-mortgage-calculator' ); ?>" class="button button-primary" />
		</form>
	</div>
	<?php
}
