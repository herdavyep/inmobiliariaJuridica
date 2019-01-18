<?php

// Max Title
function dreamvilla_advertisementbox_shortcode( $atts, $content = null ) {
	//exit;

	extract( shortcode_atts( array(
		'advertisement_images'	 => '',
		'advertisement_title'	 => '',
		'advertisement_tagline'	 => '',
		'advertisement_callus'	 => 'yes',
		'call_us_title'			 => '',
		'callus_telephone'		 => '',
		'touch_text'		     => '',
		'touch_url'		         => '',
	), $atts ) );

	$advertisement_images = wp_get_attachment_url($advertisement_images, "large");
	if($advertisement_callus == "yes"){
		if($callus_telephone){
			$callus_telephoneimage = '<div class="phone_icon">
											<i class="fa fa-phone"> </i>
										</div>';
		}else{
			$callus_telephoneimage = '';
		}
		$advertisement_callus = '<div class="contact_detial">
									'.$callus_telephoneimage.'
									<div class="phone_number">
										<h5>'.$call_us_title.'</h5>
										<h2 class="phone_number_h2">'.$callus_telephone.'</h2>
									</div>
								</div>';
	}else{
		$advertisement_callus = '';
	}

	$out = '
	<div class="main-get-in-touch">
		<div class="">
			<div class="multiple-get-in-touch">
				<div class="multiple-get-in-touch-inner">
					<img alt="Get in touch" srcset="'.$advertisement_images.'" src="'.$advertisement_images.'">
					<div class="row">
						<div class="col-md-7 col-sm-12 multiple-get-in-touch-description">
							<h3>'.$advertisement_title.'</h3>
							<p>'.$advertisement_tagline.'</p>
						</div>
						<div class="col-md-5 col-sm-12">
							<div class="row">
								<div class="col-md-6 col-sm-8 multiple-get-in-touch-contact">
									'.$advertisement_callus .'
								</div>
								<div class="col-md-6 col-sm-4 multiple-get-in-touch-button">
									<a href="'.$touch_url.'">'.$touch_text.'</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>';

	return $out;
}
add_shortcode('advertisementbox','dreamvilla_advertisementbox_shortcode');

?>