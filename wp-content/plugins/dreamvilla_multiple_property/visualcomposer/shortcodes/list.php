<?php

function dreamvilla_list( $atts, $content = null ) {
 	
 	extract(shortcode_atts(array(
 		'type' => '',
 		'text_color' => '',
 	), $atts));

 	return '<ul class="dreamvilla-list '. $type . '" style="color:'.$text_color.'">' . do_shortcode($content) . '</ul>'; 	
}
add_shortcode('ul', 'dreamvilla_list');

function dreamvilla_list_item( $atts, $content = null ) {
 	
 	extract(shortcode_atts(array(
 		'type' => '', 		
 	), $atts));

	return '<li class="'. $type .'">' . do_shortcode($content) . '</li>';
}
add_shortcode('li', 'dreamvilla_list_item');

?>