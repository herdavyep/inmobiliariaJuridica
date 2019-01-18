<?php

    function dreamvilla_ourclientsbox_shortcode( $atts, $content = null ){

        extract(shortcode_atts(array(
            'type'         => '1',
            'client_images'=> '',
        ), $atts));

        $client_images_url = '';
        if(!empty($client_images))
        {
            $images_id_array = array();
            $images_id_array =explode(',',$client_images);
            $i=1;
            foreach($images_id_array as $id)
            {
                @$link = get_post($id)->post_excerpt;
                $alt_text = get_post_meta($id, '_wp_attachment_image_alt', true);
                $client_images_url .= '<img alt="logo'.$i.'" src="' .wp_get_attachment_url( $id ) . '"/>';
                $i++;
            }
        }

        $out = '';
        $out .= '<div class="multiple-valuable-clients-area">';
        $out .= '<div id="multiple-valuable-clients-img-area">';
        $out .= $client_images_url;
        $out .= '</div></div>';
 
        return $out;
    }
    add_shortcode("ourclientsbox", "dreamvilla_ourclientsbox_shortcode");
?>