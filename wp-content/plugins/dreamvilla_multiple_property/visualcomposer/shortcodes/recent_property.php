<?php

// Recent Property
function dreamvilla_recent_property_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
		'type'					=> '1',
		'heading'				=> '1',
		'position'				=> 'left',
		'maxtitle_content'		=> '',
		'title_marker'			=> 'enable',
		'title_style'			=> 'none',
		'title_icon_postion'	=> 'after',
		'title_icon_alignment'	=> 'left',
		'recent_type'			=> '1',
		'property_type'			=> 'property_category',
		'number'				=> '7',
	), $atts ) );

	$out = '';

	if( $recent_type == 1 ){
		$out .= '		
		<div class="multiple-recent-properties">				
			<div class="row">
				<div class="multiple-featured-col col-md-3">
					<div class="max-title max-title' . $type . '">
						<h' . $heading . ' class="text-'.$position.'"><span class="'.$title_style.' '.$title_icon_postion.' '.$title_icon_alignment.'">'. $maxtitle_content .'</span></h' . $heading.'>
					</div>
				</div>
				<div class="col-md-9">
					<ul class="property-type text-right">';
						
						$category = get_terms( $property_type, 'hide_empty=0' );

						if( $category ){
							$flag=0;
							foreach( $category as $cat ) {
								
								$active_class = '';										
								if( $flag == 0 )
									$active_class = 'class="active"';

								$out .= '<li><a href="javascript:void(0);" '.$active_class.' data-id="'.esc_attr($cat->term_id).'">'.sprintf( esc_html__( '%s','dreamvilla-multiple-property'), $cat->name ).'</a></li>';
								
								$flag=1;
							}
						}
					$out .= '
					</ul>	
				</div>
			</div>
			<div class="row">';
				if( $category ){
				$flag=0;
				
				foreach( $category as $cat ){
					
					$active_class = '';							
					if($flag==0)
						$active_class =  'active';

				$out .= '
				<div data-target="'.esc_attr($cat->term_id).'" class="'.$active_class.' carousel slide carousel-slide-recent-property" data-ride="carousel" data-interval="false">
					<div class="carousel-inner" role="listbox">';
						
						$args=array(
									'post_type'			=> 'property',
									'posts_per_page' 	=> $number,
									'tax_query' 		=> array(
															    array(
																		'taxonomy' 	=> $property_type,
																		'field' 	=> 'id',
																		'terms' 	=> intval(function_exists('icl_object_id')?icl_object_id($cat->term_id,$property_type,false):$cat->term_id)
															    	)
															  	),
									'suppress_filters' 	=> 0
							);							
						$recent_property_list = get_posts($args);								 
						if( $recent_property_list ){
							$innerFlag=0;
							$i=0;
							foreach( $recent_property_list as $post ){

								$active_con = '';
								$active_con_class = '';
								
								if( $innerFlag == 0 ){ 
									$active_con_class = 'active';
									$innerFlag = 1;
								}

								if( $i % 6 == 0 ){
									$active_con = '<div class="item '.$active_con_class.'">';
								}

							$out .= $active_con;

							$out .= '
							<div class="col-sm-6 col-md-4 col-lg-4 recent-property-v1">
								<div class="image-with-label">
									<a href="'.esc_url(get_permalink($post->ID)).'"><img '.dreamvilla_mp_get_device_image( $post->ID ).' alt="recent-properties-1" class="img-responsive"></a>
									<label>';
										$property_status = get_post_meta( $post->ID, 'pstatus', true );
										if ( $property_status == "sale" ){
											$out .= sprintf( esc_html__('On Sale','dreamvilla-multiple-property'));
										} else {
											$out .= sprintf( esc_html__('On Rent','dreamvilla-multiple-property'));
										}
									$out .= '
									</label>';
									$property_status_list = wp_get_post_terms($post->ID, 'property_status' );
									if( !empty($property_status_list[0]->term_id) && $property_status_list[0]->slug != "normal" ){
										$out .= '<span class="featured-proeprty-label">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$property_status_list[0]->name ).'</span>';
									}
									$PropertyFetured = get_post_meta( $post->ID, 'pfetured', true);
									if( $PropertyFetured == "yes" ){
										$out .= '<span class="featured-property-icon" href="javascript:void(0)"> <span class="featuredtext">'.esc_html__('Featured','dreamvilla-multiple-property').'</span> <i class="fa fa-star"></i></span>';
									}
								$out .= '
								</div>
								<a href="'.esc_url(get_permalink($post->ID)).'"><h6>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$post->post_title).'</h6></a>
								<span class="recent-properties-address">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $post->ID, 'pcountry', true ));
								if( get_post_meta( $post->ID, 'pcountry', true ) && get_post_meta( $post->ID, 'pstate', true ) ){ 
									$out .= " / "; 
								} 
								$out .= sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $post->ID, 'pstate', true )).'</span>
								<p class="recent-properties-price">';
									
									$property_price = get_post_meta( $post->ID, 'pprice', true );
									if( $property_price[0] ){
										if( $property_status == "sale" ){
											$out .= sprintf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
										} else {
											$out .= sprintf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
											$out .= '<span class="price-label">';
											$out .= sprintf( esc_html__(' / %s','dreamvilla-multiple-property'),strtoupper($property_price[1]));
											$out .= '</span>';
										}
									}
								$out .= '
								</p>
								<div class="recent_property_v1">
									'.dreamvilla_mp_agent_favorites_property_icon($post->ID).'
								</div>
							</div>';
						if( $i % 6 == 5 ) {
							$out .= '</div>';
							}
							$i++;
						}
						$innerFlag = 1;
					}
					$i--;
					if( $i % 6 != 5 ) {
						$out .= '</div>';
					}
				$out .= '
				</div>
				<ol class="carousel-indicators"></ol>
			</div>';
					$flag=1;	 		
					}
				}
			$out .= '				
		</div>';
	} else {
		$out.= '		
		<div class="multiple-recent-properties">				
			<div class="row">
				<div class="multiple-featured-col col-md-3">
					<div class="max-title max-title' . $type . '">
						<h' . $heading . ' class="text-'.$position.'"><span class="'.$title_style.' '.$title_icon_postion.' '.$title_icon_alignment.'">'. $maxtitle_content .'</span></h' . $heading.'>
					</div>
				</div>
				<div class="col-md-9">
					<ul class="property-type text-right">';
						
						$category = get_terms( $property_type, 'hide_empty=0' );
						if( $category ){
							$flag=0;
							foreach( $category as $cat ) {
								
								$active_class = '';
								if( $flag == 0 )										
									$active_class = 'class="active"';

								$out .= '<li><a href="javascript:void(0);" '.$active_class.' data-id="'.esc_attr($cat->term_id).'">'.sprintf( esc_html__( '%s','dreamvilla-multiple-property'), $cat->name ).'</a></li>';
								$flag=1;
							}
						}
					$out .= '
					</ul>
				</div>
			</div>
			<div class="row">';
				
				if( $category ){
				$flag=0;
				foreach( $category as $cat ){
					
					$active_class = '';
					if($flag==0)
						$active_class = 'active';

				$out .= '
				<div id="myCarousel1" data-target="'.esc_attr($cat->term_id).'" class="'.$active_class.' carousel slide carousel-slide-recent-property" data-ride="carousel" data-interval="false">
					<div class="carousel-inner" role="listbox">';
						
						$args=array(
									'post_type'			=> 'property',
									'posts_per_page' 	=> $number,
									'tax_query' 		=> array(
															    array(
																		'taxonomy' 	=> $property_type,
																		'field' 	=> 'id',
																		'terms' 	=> intval(function_exists('icl_object_id')?icl_object_id($cat->term_id,$property_type,false):$cat->term_id)
															    	)
															  	),
									'suppress_filters' 	=> 0
							);							
						$recent_property_list = get_posts($args);								 
						if( $recent_property_list ){
							$innerFlag=0;
							$i=0;
							foreach( $recent_property_list as $post ){
								
								$active_con = '';
								$active_con_class = '';
								
								if( $innerFlag == 0 ){ 
									$active_con_class = 'active';
									$innerFlag = 1;
								}

								if( $i % 6 == 0 ){
									$active_con = '<div class="item '.$active_con_class.'">';
								}

							$out .= $active_con;

							$out .= '
							<div class="col-sm-6 col-md-4 col-lg-4 recent-property-v1">
								<div class="image-with-label">
									<a href="'.esc_url(get_permalink($post->ID)).'"><img '.dreamvilla_mp_get_device_image( $post->ID ).' alt="recent-properties-1" class="img-responsive"></a>
									<label class="label-top-left">';
										
										$property_status = get_post_meta( $post->ID, 'pstatus', true );
										if ( $property_status == "sale" ){
											$out .= sprintf( esc_html__('On Sale','dreamvilla-multiple-property'));
										} else {
											$out .= sprintf( esc_html__('On Rent','dreamvilla-multiple-property'));
										}
									$out .= '
									</label>';
									$property_status_list = wp_get_post_terms($post->ID, 'property_status' );
									if( !empty($property_status_list[0]->term_id) && $property_status_list[0]->slug != "normal" ){
										$out .= '<span class="featured-proeprty-label">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$property_status_list[0]->name ).'</span>';
									}
									$PropertyFetured = get_post_meta( $post->ID, 'pfetured', true);
									if( $PropertyFetured == "yes" ){
										$out .= '<span class="featured-property-icon" href="javascript:void(0)"> <span class="featuredtext">'.esc_html__('Featured','dreamvilla-multiple-property').'</span> <i class="fa fa-star"></i></span>';
									}
								$out .= '
								</div>
								<div class="image_description_recent_property v1">
									<div class="row">
										<div class="col-md-8">
											<a href="'.esc_url(get_permalink($post->ID)).'"><h6>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$post->post_title).'</h6></a>
											<span class="recent-properties-address">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $post->ID, 'pcountry', true ));
											if( get_post_meta( $post->ID, 'pcountry', true ) && get_post_meta( $post->ID, 'pstate', true ) ){ 
												$out .= " / "; 
											}
											$out .= sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $post->ID, 'pstate', true )).'</span>
										</div>
										<div class="col-md-4 padding_left_none text-right">
											<p class="recent-properties-price vertical-middle">';
												
												$property_price = get_post_meta( $post->ID, 'pprice', true );
												if( $property_price[0] ){
													if( $property_status == "sale" ){
														$out .= sprintf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
													} else {
														$out .= sprintf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
														$out .= '<span class="price-label">';
														$out .= sprintf( esc_html__(' / %s','dreamvilla-multiple-property'),strtoupper($property_price[1]));
														$out .= '</span>';
													}															
												}
											$out .= '
											</p>
											<div class="recnet-property-home-special-v2">
												'.dreamvilla_mp_agent_favorites_property_icon($post->ID).'
											</div>
										</div>	
									</div>
									<ul class="property-features">
										<li>
											<img src="'.get_template_directory_uri().'/images/recent_bath.png" alt="Recent Bath" />
											'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),dreamvilla_mp_number_of_bathroom($post->ID));
										$out .= '
										</li>
										<li>
											<img src="'.get_template_directory_uri().'/images/recent_bed.png" alt="Recent Bed" />
											'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),dreamvilla_mp_number_of_bedroom($post->ID));
										 $out .= '
										 </li>
										<li>
											<img src="'.get_template_directory_uri().'/images/recent_garage.png" alt="Recent Garage" />
											'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $post->ID, 'pnoofgarage', true));
										$out .= '
										</li>
										<li>
											<img src="'.get_template_directory_uri().'/images/recent_area.png" alt="Recent Area" />';
											$area_detail = get_post_meta( $post->ID, 'psbuilduparea', true );
											$out .= sprintf( esc_html__('%s','dreamvilla-multiple-property'), $area_detail[0] );
										$out .= '
										</li>
									</ul>
								</div>
							</div>';
						if( $i % 6 == 5 ) {
							$out .= '</div>';
							}
							$i++;
						}
						$innerFlag = 1;
					}
					$i--;
					if( $i % 6 != 5 ) {
						$out .= '
						</div>';
					}
				$out .= '
				</div>
				<ol class="carousel-indicators"></ol>
			</div>';
				$flag=1;	 		
				}
			}
			$out .= '
		</div>';		
	}

	return $out;
}
add_shortcode('recent_property','dreamvilla_recent_property_shortcode');

?>