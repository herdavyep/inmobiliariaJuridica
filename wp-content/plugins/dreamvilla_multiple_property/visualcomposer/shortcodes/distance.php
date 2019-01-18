<?php

function dreamvilla_distance($atts, $content = null) {

	extract(shortcode_atts(array(
		'type' => '1'
	), $atts));
	return ($type > 0 )? '<div class="dreamvilla-vertical-space'.$type.'"></div>': '<div class="null"></div>';
}
add_shortcode('distance','dreamvilla_distance');

?>