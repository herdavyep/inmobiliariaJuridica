<?php

function dreamvilla_slider( $atts, $content = null ) {
 	
	$atts = vc_map_get_attributes( 'dreamvilla_slider', $atts );
	extract( $atts );

	$Destimonial_Image 	= explode(',', $images);
	$Dimension_Title 	= explode(',', $dimension_title );
	$Dimension 			= explode(',', $dimension );

	//$caption_color
	//$caption_bk_color
	//$slider_border
	//$caption_position

	$html = '';

	if( !empty($Destimonial_Image) ){
		$html .= 
		'<div class="slider_div carousel slide" data-ride="carousel">
			<ol class="carousel-indicators"></ol><div class="carousel-inner  carousel-dynemic" role="listbox">';	
				foreach ( $Destimonial_Image as $key => $value ) {
					if( !empty($Destimonial_Image[$key]) ){
						$html .= '<div class="item"> <img src="'. wp_get_attachment_url($Destimonial_Image[$key]) .'" alt="house-image">';
					}

					if( !empty($Dimension_Title[$key]) || !empty($Dimension[$key]) ){
						/*$html .= '<div class="label-dimension" style="color:'.$caption_color.';background-color:'.$caption_bk_color.'">';

						if( !empty($Dimension_Title[$key]) ){
							$html .= '<p class="size-name">'.$Dimension_Title[$key].'</p>';
						}

						if( !empty($Dimension[$key]) ){
							$html .= '<p class="size">'.$Dimension[$key].'</p>';
						}

						$html .= '</div>';*/

					}		
					$html .="</div>";
				}
			$html .= 
		'</div></div>';
	}
	
	return $html;
}
add_shortcode('dreamvilla_slider', 'dreamvilla_slider');

?>