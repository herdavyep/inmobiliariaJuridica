<?php

// Max Title
function dreamvilla_maxtitle_shortcode( $atts, $content = null ) {
	//exit;

	extract( shortcode_atts( array(
		'type'					=> '1',
		'heading'				=> '1',
		'maxtitle_content'		=> '',
		'maxtitle_color'		=> '',
		'title_marker'			=> 'enable',
		'title_style'			=> 'none',
		'title_icon'			=> '',
		'icon_name'				=> '',
		'title_icon_postion'	=> 'after',
		'title_icon_alignment'	=> 'left',
		'position'				=> 'left',
	), $atts ) );

	$maxtitle_color = $maxtitle_color ? ' style="color: ' . $maxtitle_color . ';"' : '';

	$out = '
	<div class="max-title max-title' . $type . '">
		<h' . $heading. $maxtitle_color . ' class="text-'.$position.'"><span class="'.$title_style.' '.$title_icon_postion.' '.$title_icon_alignment.'">'. $maxtitle_content .'</span></h' . $heading.'>
	</div>';

	return $out;
}
add_shortcode('maxtitle','dreamvilla_maxtitle_shortcode');

?>