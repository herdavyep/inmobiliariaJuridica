<?php
$output = $el_class = '';
extract(shortcode_atts(array(
	'row_type' => '0',
    'row_id' => '',
    'row_class' => '',
    'modal_title' => '',
    'noclosebutton' => '',
    'bg_color' => '',
    'bg_image' => '',
    'bg_attachment' => 'false',
    'bg_position' => 'center center',
    'bg_cover' => '',
    'bg_repeat' => 'no-repeat',
    'row_padding_top' => '',
    'row_padding_bottom' => '',
    'full_container' => '',
    'responsive_bg_none' => ''
), $atts));

wp_enqueue_style('js_composer_front');
wp_enqueue_script('wpb_composer_front_js');
wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);
$row_id_s = (!empty($row_id))?'id="'.$row_id.'"':'';
$row_class_s = (!empty($row_class))?'class="'.$row_class.'"':'';

switch($row_type){

	case 1:	
		$output .= '<section '.$row_id_s.' class="' . $row_class . ' full-row" >';
		$output .= wpb_js_remove_wpautop($content);
		$output .= '</section>';
	break;
	
	case 2: 
		$output = wpb_js_remove_wpautop("[blox id='$row_id' bgcolor='$bg_color' img='{$bg_image}' padding_top='{$row_padding_top}' padding_bottom='{$row_padding_bottom}' bg_attachment='{$bg_attachment}' bg_position='{$bg_position}' bgcover='{$bg_cover}' repeat='{$bg_repeat}' class='{$full_container} {$responsive_bg_none} {$row_class}']" . $content . "[/blox]");
	break;

	case 3:
		$output = wpb_js_remove_wpautop("[modal_box row_class='$row_class' noclosebutton='$noclosebutton' modal_title='$modal_title' row_id='$row_id' bg_row='$bg_color']" . $content . '[/modal_box]');
	break;

	case 4:
		$output = do_shortcode( $content );
	break;
	
	default:		
		if(!empty($row_id))
			$output .= '<section id="'.$row_id.'" class="' . $row_class . '"><div class="vc_special_dreamvilla">';
		else
			$output .= '<section class="' . $row_class . '"><div class="vc_special_dreamvilla">';
		$output .= wpb_js_remove_wpautop($content);
		$output .= '</div></section>'.$this->endBlockComment('row');
		
	break;
}

echo wpb_js_remove_wpautop($output);