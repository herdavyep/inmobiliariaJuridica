<?php

// Max Title
function dreamvilla_modalbox_shortcode( $atts, $content = null ) {
	//exit;

	extract( shortcode_atts( array(
		'modalbox_id'			=> '',
		'modalbox_images'		=> '',
		'modalbox_title'		=> '',
		'modalbox_button'		=> 'yes',
	), $atts ) );

	$modalbox_images = wp_get_attachment_url($modalbox_images, "large");
	if($modalbox_button == "yes"){
		$modalbox_button = '<button class="close" data-dismiss="modal" type="button"> × </button>';
	}else{
		$modalbox_button = '';
	}
	$content = wpb_js_remove_wpautop($content);
	$out = '
	<div class="dreamvilla-Modalbox">
	<a data-target="#'.$modalbox_id.'" data-toggle="modal" href="javascript:void(0);">
		<img class="img-responsive" alt="about modal" src="'.$modalbox_images.'">
	</a>
	<div id="'.$modalbox_id.'" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					'.$modalbox_button.'
					<h4 class="modal-title">'.$modalbox_title.'</h4>
				</div>
				<div class="modal-body">
					'.$content.'
				</div>
			</div>
		</div>
	</div>
	</div>';

	return $out;
}
add_shortcode('modalbox','dreamvilla_modalbox_shortcode');

?>