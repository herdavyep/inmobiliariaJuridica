<?php
function dreamvilla_blox_shortcode($attributes, $content){
    
    extract(
        shortcode_atts(
            array(
                "img" => '',
                'padding_top'  => 0,
                'padding_bottom'  => 0,
				'bg_attachment' =>'false',
				'bg_position' =>'center center',
				'bgcover'=>'true',
				'repeat'=>'no-repeat',
				'class'=>'',
				'bgcolor'=>'',
				'id'=>''
            ),
        $attributes)
    );		
	
	if(is_numeric($img)){
		$img = wp_get_attachment_url( $img );		
	}   
	
	$fixed = ($bg_attachment == 'true')? 'fixed' : '';
	$background_style = !empty($img)?" background: url('{$img}') {$repeat} {$fixed}; background-position: {$bg_position};":'';
	$background_size = 	($bgcover=='true')? 'background-size: cover;':'';
	
	$padding_top = ltrim ($padding_top);
	$padding_top = (substr($padding_top,-2,2)=="px")? $padding_top : $padding_top.'px';

	$padding_bottom = ltrim ($padding_bottom);
	$padding_bottom = (substr($padding_bottom,-2,2)=="px")? $padding_bottom : $padding_bottom.'px';
	
	$padding_style= " padding-top:{$padding_top}; padding-bottom:{$padding_bottom}; ";
	
	if(!empty($bgcolor))
		$bgcolor = ' background-color:' . $bgcolor . ';';
    
	if(!empty($id))
    $out = '</div></div></div><div id="'.$id.'" class="blox high-z-index '.$class.' " style="'.$padding_style.$background_style.$background_size.$bgcolor.'"><div class="max-overlay" ></div><div class="wpb_row vc_row-fluid full-row"><div class="container">';
	else
    $out = '</div></div></div><div class="blox high-z-index '.$class.'" style="'.$padding_style.$background_style.$background_size.$bgcolor.'"><div class="max-overlay"></div><div class="wpb_row vc_row-fluid full-row"><div class="container">';
    $out .= do_shortcode($content); 
    $out .= '</div></div></div><div class="container"><div class="row-wrapper-x">';
	
    return $out;
}
add_shortcode("blox", 'dreamvilla_blox_shortcode');