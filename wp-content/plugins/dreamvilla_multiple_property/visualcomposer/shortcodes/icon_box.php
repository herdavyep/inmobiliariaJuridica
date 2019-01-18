<?php

function dreamvilla_iconbox($atts, $content = null) {

	extract(shortcode_atts(array(
		'type'               => '0',
		'icon_title'         => '',
		'icon_data' 		 => '',
		'icon_image'         => '',
		'icon_size'          => '30px',
		'icon_color'         => '',
		'icon_bg_color'      => '',
		'icon_name'          => '',
	), $atts));

	if(is_numeric($icon_image)){
		$icon_html = '<div class="services-we-offer-background-none"><img src="'.wp_get_attachment_url( $icon_image ).'" alt="Icon" /></div>';
	}
	if(!empty($icon_name) && $icon_name != "none" && $type == '0') {
		$icon_html = '<div class="services-we-offer-background">'.do_shortcode(  "[icon name='$icon_name' size='$icon_size' color='$icon_color']" ).'</div>';
	}
	if(!empty($icon_name) && $icon_name != "none" && $type == '1') {
		$icon_html = '<div class="services-we-offer-variation">'.do_shortcode(  "[icon name='$icon_name' size='$icon_size' color='$icon_color']" ).'</div>';
	}
	if(!empty($icon_name) && $icon_name != "none" && $type == '2') {
		$icon_html = do_shortcode(  "[icon name='$icon_name' size='$icon_size' color='$icon_color']" );
	}

	if( $type == '0' ){

		$result = '
			<div class="dreamvilla_iconbox services-we-offer">
			<div class="services-we-offer-part">
					'.$icon_html.'
				<h4>'.$icon_title.'</h4>
				<p>'.$icon_data.'</p>
			</div>
			</div>';
	}

	if( $type == '1' ){

		$result = '
			<div class="dreamvilla_iconbox_variation_1 services-we-offer">
			<div class="services-we-offer-part">
					'.$icon_html.'
				<h4 class="services-we-offer-variation">'.$icon_title.'</h4>
				<p>'.$icon_data.'</p>
			</div>
			</div>';
	}

	if( $type == '2' ){

		$result = '
		<div class="dreamvilla_iconbox_variation_2 services-we-offer">
		<div class="services-we-offer-part">
			<div class="second-row-service-we-offer">
				<div class="row">
					<div class="col-xs-4 col-sm-4 col-md-4 img-background">
						'.$icon_html.'
					</div>
					<div class="col-xs-8 col-sm-8 col-md-8">
						<h4 class="service-heading">'.$icon_title.'</h4>
						<p></p>
						<p>'.$icon_data.'</p>
						<p></p>
					</div>
				</div>
			</div>
		</div>
		</div>';
	}

	if( $type == '3' ){

		$result = '
		<div class="dreamvilla_iconbox_variation_3 inner-page-features-villa">
			<div class="inner-feature-villa">
				'.$icon_html.'
				<h4>'.$icon_title.'</h4>
				<p>'.$icon_data.'</p>
				<p> </p>
			</div>
		</div>
		';

	}

	if( $type == '4' ){

		$result = '
		<div class="dreamvilla_iconbox_variation_4 inner-page-features">
		<ul>
			<li>
				<div class="featureicon pull-left">
					'.$icon_html.'
				</div>
				<div>
					<h3>'.$icon_title.'</h3>
					<p>'.$icon_data.'</p>
				</div>
			</li>
		</ul>
		</div>';

	}

	return $result;
	
}
add_shortcode('iconbox','dreamvilla_iconbox');
?>