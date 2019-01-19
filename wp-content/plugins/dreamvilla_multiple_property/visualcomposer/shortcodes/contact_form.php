<?php

function dreamvilla_contact_form($atts, $content = null) {
	
	extract(shortcode_atts(array(
		"contact_email" => '',		
	), $atts));

	$dreamvilla_options = get_option('dreamvilla_options');

	if( !empty($dreamvilla_options['submitnowbuttontitle']) ){
		$submit_label = $dreamvilla_options['submitnowbuttontitle'];
	} else {
		$submit_label = 'SUBMIT NOW';	
	}		
	
	$office_email = $contact_email;
	
	if( !empty($dreamvilla_options['show_google_recaptcha'] ) ){
		$show_google_recaptcha = $dreamvilla_options['show_google_recaptcha'];
	}
	if( !empty($dreamvilla_options['google_recaptcha_site_key'] ) ){
		$google_recaptcha_site_key = $dreamvilla_options['google_recaptcha_site_key'];
	}

	if( !empty($google_recaptcha_site_key) && $show_google_recaptcha == "yes" ){
		$google_recaptcha = '<div id="single-property" class="contact-from-captcha-special"></div>';
		$textarea_style = '';
	} else {
		$google_recaptcha = '';
		$textarea_style = 'style=height:195px;';
	}

	$agent_contact_form =
	'<div class="inner-page-shortcodes" id="agent-contact-area" style="margin:0;"><div class="special-contact-form-div"><div class="message_area_bottom"></div></div></div>
	<form class="plugin-agnet-contact-form-contact-page" name="send-agent-mail" method="post">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" name="full_name" class="full_name" placeholder="'.esc_html__('Nombre completo','dreamvilla-multiple-property').'" required>
				<input type="text" name="p_number" class="p_number" placeholder="'.esc_html__('Numero de telefono','dreamvilla-multiple-property').'" required>
				<input type="email" name="email_address" class="email_address" placeholder="'.esc_html__('Correo electronico','dreamvilla-multiple-property').'" required>
				<input type="hidden" name="agent_email_address" class="agent_email_address" value="'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$office_email).'" >
				'.$google_recaptcha.'
				<input type="submit" name="sendmessage" class="send-message" value="'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$submit_label ).'" />
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<textarea name="message" class="message" '.$textarea_style.' placeholder="'.esc_html__('Mensaje','dreamvilla-multiple-property').'" required></textarea>					
			</div>
		</div>
	</form>';

	if( $agent_contact_form){
		return 
		'<div class="inner-contact-agent-area">				
			'.$agent_contact_form.'		
		</div>';
	} else {
		return '';
	}
}
add_shortcode('contact_form','dreamvilla_contact_form');
?>