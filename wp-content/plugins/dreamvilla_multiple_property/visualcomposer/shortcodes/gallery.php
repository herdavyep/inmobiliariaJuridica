<?php 

function dreamvilla_gallery($atts, $content = null) {
   
   	extract(shortcode_atts(array(
        'cat' => '',
        'row_number' => '2',
        'number' => -1,
        'include_cats' => '',        
        'sort' => '',
        'order' => '',   
    ), $atts));
	
	$html = '';
	
	$html .='<div>
		<div class="photogallery">
			<ul>';
				
				if( function_exists('icl_object_id') )			
					$current_wpml_language = ICL_LANGUAGE_CODE;
				else
					$current_wpml_language = '';

				$args = array('post_type' => 'photo_gallery', 'showposts' => $number, 'orderby' => $sort, 'order' => $order );
				$include_array = explode(",",$include_cats);
				
				if($include_cats)					
					$args['tax_query'] = array(array('taxonomy' => 'gallery_category','field' => 'id','terms' => $include_array,'operator' => 'IN'));
				
				$query = new WP_Query($args);

				$number_of_photo_row = $row_number;
				
				if($number_of_photo_row){
					$photoWidth = 100/$number_of_photo_row."%";
				} else {
					$photoWidth = "20%";
				}

				if( $query ){
					while( $query->have_posts() ): $query->the_post();
						global  $post;
						if( function_exists('icl_object_id') ){
							if( langcode_post_id($post->ID) == $current_wpml_language ){
							$html .='<li style="width:'.$photoWidth.'" >
								<img '.dreamvilla_get_device_image( $post->ID ).' alt="'.esc_attr($post->post_title).'" class="img-responsive">
								<div class="image_description text-center" data-toggle="modal" data-target="#image_lightbox">
									<div class="icon"><img src="'.esc_url(get_template_directory_uri()).'/images/gallary_image_hover_icon.png" alt="+"></div>
									<p class="text-center">'.sprintf( esc_html__('%s','dreamvilla'),$post->post_title).'</p>
								</div>
							</li>';
							}
						} else {
						$html .='<li style="width:'.$photoWidth.'" >
							<img '.dreamvilla_get_device_image( $post->ID ).' alt="'.esc_attr($post->post_title).'" class="img-responsive">
							<div class="image_description text-center" data-toggle="modal" data-target="#image_lightbox">
								<div class="icon"><img src="'.esc_url(get_template_directory_uri()).'/images/gallary_image_hover_icon.png" alt="+"></div>
								<p class="text-center">'.sprintf( esc_html__('%s','dreamvilla'),$post->post_title).'</p>
							</div>
						</li>';
						}
					endwhile;
					wp_reset_query();									
				}
			$html .='</ul>
		</div>
	</div>';

	return $html;

}
add_shortcode( 'dreamvilla_gallery', 'dreamvilla_gallery' );