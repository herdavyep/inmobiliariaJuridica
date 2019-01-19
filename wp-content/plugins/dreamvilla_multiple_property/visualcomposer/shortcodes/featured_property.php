<?php

// Featured Property
function dreamvilla_featured_property_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
		'type'					=> '1',
		'heading'				=> '1',
		'position'				=> 'left',
		'maxtitle_content'		=> '',
		'title_marker'			=> 'enable',
		'title_style'			=> 'none',
		'title_icon_postion'	=> 'after',
		'title_icon_alignment'	=> 'left',
		'featured_type'			=> '1',		
		'number'				=> '7',		
	), $atts ) );

	$out = '';

	if( $featured_type == 1 ){
		$out .= '
		<div>
			<div class="multiple-featured-properties">
				<div>
					<div class="row">
						<div class="multiple-featured-col col-md-6">
							<div class="max-title max-title' . $type . '">
								<h' . $heading . ' class="text-'.$position.'"><span class="'.$title_style.' '.$title_icon_postion.' '.$title_icon_alignment.'">'. $maxtitle_content .'</span></h' . $heading.'>
							</div>
						</div>
					</div>';
					
					$args = array(
								'post_type'			=> 'property',
								'posts_per_page' 	=> -1,
								'meta_query'		=> array(
																array(
																	'key' 	=> 'pfetured',
																	'value'	=> 'yes',
																)
														),
								'suppress_filters' 	=> 0
							);

							$fetured_property_list = get_posts( $args );
							if( $fetured_property_list ){
								$i=0;
					$out .= '
					<div id="myCarousel0" class="carousel slide" data-ride="carousel" data-interval="false">
						<div class="carousel-inner" role="listbox">';

						foreach( $fetured_property_list as $post ){
								
							$active_class = '';
							if( $i == 0 ){
								$active_class = "active";
							}						

							if( $i % 3 == 0 ){
								$out .= '
								<div class="item '.$active_class.'">
									<div class="row">';
							}

							$out .= '<div class="col-sm-6 col-md-4 col-lg-4">
										<div class="image-with-label">
											<a href="'.esc_url(get_permalink ($post->ID)).'"><img '.dreamvilla_mp_get_device_image( $post->ID ).' alt="featured-properties-1" class="img-responsive"></a>
											<label>';
												
												$property_status = get_post_meta( $post->ID, 'pstatus', true );
												if ( $property_status == "sale" ){
													$out .= sprintf( esc_html__('Venta','dreamvilla-multiple-property'));
												} else {
													$out .= sprintf( esc_html__('Alquiler','dreamvilla-multiple-property'));
												}
											$out .='
											</label>';

											$property_status_list = wp_get_post_terms($post->ID, 'property_status' );
											if( !empty($property_status_list[0]->term_id) && $property_status_list[0]->slug != "normal" ){
												$out .= '<span class="featured-proeprty-label">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$property_status_list[0]->name ).'</span>';
											}
											$PropertyFetured = get_post_meta( $post->ID, 'pfetured', true);
											if( $PropertyFetured == "yes" ){
												$out .= '<span class="featured-property-icon" href="javascript:void(0)"> <span class="featuredtext">'.esc_html__('Destacados','dreamvilla-multiple-property').'</span> <i class="fa fa-star"></i></span>';
											}
										$out .= '
										</div>
										<div class="featured-properties-detail">
											<a href="'.esc_url(get_permalink ($post->ID)).'"><h6>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$post->post_title).'</h6></a>
											<p class="featured-properties-price">';
												
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
											</p>';

											if( dreamvilla_mp_number_of_bathroom($post->ID) != "-" ){
												$out .= '
												<ul>
													<li class="left">
														<img src="'.get_template_directory_uri().'/images/recent_bath.png" alt="Recent Bath" />
														'.esc_html__('Baños','dreamvilla-multiple-property').'
													</li>
													<li class="right"><span>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),dreamvilla_mp_number_of_bathroom($post->ID)).'</span></li>
												</ul>'; 
											}

											if( dreamvilla_mp_number_of_bedroom($post->ID) != "-" ){										
												$out .= '
												<ul>
													<li class="left">
														<img src="'.get_template_directory_uri().'/images/recent_bed.png" alt="Recent Bed" />
														'.sprintf( esc_html__('Habitaciones','dreamvilla-multiple-property')).'
													</li>
													<li class="right"><span>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),dreamvilla_mp_number_of_bedroom($post->ID)).'</span></li>
												</ul>';
											}

											if( get_post_meta( $post->ID, 'pnoofgarage', true) ){
												$out .= '
												<ul>
													<li class="left">
														<img src="'.get_template_directory_uri().'/images/recent_garage.png" alt="Recent Garage" />
														'.sprintf( esc_html__('Garaje','dreamvilla-multiple-property')).'
													</li>
													<li class="right"><span>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $post->ID, 'pnoofgarage', true)).'</span></li>
												</ul>';
											}
										$out .= '
										</div>
										<div class="featured-properties-address-div">';
											if( get_post_meta( $post->ID, 'pcountry', true ) || get_post_meta( $post->ID, 'pstate', true ) ){
												
												$out .= '<p class="featured-properties-address"><i class="fa fa-map-marker fa-lg"> </i>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $post->ID, 'pcountry', true ));
												
												if( get_post_meta( $post->ID, 'pcountry', true ) && get_post_meta( $post->ID, 'pstate', true ) ){ 
													$out .= ' / '; 
												} 
												
												$out .= sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $post->ID, 'pstate', true )).'</p>';
											}					
											$out .= dreamvilla_mp_agent_favorites_property_icon($post->ID);
										$out .= '
										</div>
									</div>';
							if( $i % 3 == 2 ){
								$out .= '
								</div>
							</div>';
							}
							$i++;
						}
						$i--;
						
						if( $i % 3 != 2 ){
							$out .= '
								</div>
							</div>';
						}

						$out .= '
						</div>
						<div class="left-right-arrow">
							<a class="left carousel-control" href="#myCarousel0" role="button" data-slide="prev">
						    	<img src="'.esc_attr(get_template_directory_uri()).'/images/arrow-left.png" alt="arrow left" class="pull-left">
						  	</a>
						  	<a class="right carousel-control" href="#myCarousel0" role="button" data-slide="next">
						    	<img src="'.esc_attr(get_template_directory_uri()).'/images/arrow-right.png" alt="arrow right" class="pull-right">
						 	</a>
						</div>
					</div>';
					}
				$out .= '
				</div>
			</div>
		</div>';
	} else {
		$out .= '
		<div>
			<div class="multiple-featured-properties">
				<div>
					<div class="row">
						<div class="multiple-featured-col col-md-6">
							<div class="max-title max-title' . $type . '">
								<h' . $heading . ' class="text-'.$position.'"><span class="'.$title_style.' '.$title_icon_postion.' '.$title_icon_alignment.'">'. $maxtitle_content .'</span></h' . $heading.'>
							</div>
						</div>
					</div>';
					
					$args = array(
								'post_type'			=> 'property',
								'posts_per_page' 	=> -1,
								'meta_query'		=> array(
																array(
																	'key' 	=> 'pfetured',
																	'value'	=> 'yes',
																)
														),
								'suppress_filters' 	=> 0
							);
					$fetured_property_list = get_posts( $args );

					if( $fetured_property_list ){
						$i=0; 
					
					$out .= '
					<div id="myCarousel0" class="carousel slide" data-ride="carousel" data-interval="false">
						<div class="carousel-inner" role="listbox">';
							
							foreach ( $fetured_property_list as $post ) {
								
								$active_class = '';
								if( $i == 0 ){
									$active_class = "active";
								}

								if( $i % 4 == 0 ){
									$out .='
									<div class="item '.$active_class.'">
										<div class="row">';
								}

							$out .= '							
									<div class="col-sm-12 col-md-6 col-lg-6 feature_property_list_item">
										<div class="featured_property_image v1 clear">
											<div class="image-with-label">
												<a href="'.esc_url(get_permalink($post->ID)).'"><img '.dreamvilla_mp_get_device_image( $post->ID ).' alt="featured-properties-1" class="featured-property-list-v2-special img-responsive"></a>
												<label class="label-top-left">';

													$property_status = get_post_meta( $post->ID, 'pstatus', true );
													if ( $property_status == "sale" ){
														$out .= sprintf( esc_html__('Venta','dreamvilla-multiple-property'));
													} else {
														$out .= sprintf( esc_html__('Alquiler','dreamvilla-multiple-property'));
													}
												$out .= '</label>';
												
												$property_status_list = wp_get_post_terms($post->ID, 'property_status' );
												if( !empty($property_status_list[0]->term_id) && $property_status_list[0]->slug != "normal" ){
													$out .= '<span class="featured-proeprty-label">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$property_status_list[0]->name ).'</span>';
												}
												$PropertyFetured = get_post_meta( $post->ID, 'pfetured', true);
												if( $PropertyFetured == "yes" ){
													$out .= '<span class="featured-property-icon" href="javascript:void(0)"> <span class="featuredtext">'.esc_html__('Destacados','dreamvilla-multiple-property').'</span> <i class="fa fa-star"></i></span>';
												}
											$out .= '
											</div>
										</div>
										<div class="featured_property_description">
											<a href="'.esc_url(get_permalink ($post->ID)).'"><h6>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$post->post_title).'</h6></a>
											<p class="featured-properties-price">';
												
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
											
											<ul class="property-features">
												<li>
													<img src="'.get_template_directory_uri().'/images/recent_bath.png" alt="Recent Bath" />';
													$out .= sprintf( esc_html__('%s','dreamvilla-multiple-property'),dreamvilla_mp_number_of_bathroom($post->ID));
												$out .= '
												</li>
												<li>
													<img src="'.get_template_directory_uri().'/images/recent_bed.png" alt="Recent Bed" />';
													$out .= sprintf( esc_html__('%s','dreamvilla-multiple-property'),dreamvilla_mp_number_of_bedroom($post->ID));
												 
												$out .= '
												</li>
												<li>
													<img src="'.get_template_directory_uri().'/images/recent_garage.png" alt="Recent Garage" />';
													$out .= sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $post->ID, 'pnoofgarage', true));
												$out .= '
												</li>
												<li>
													<img src="'.get_template_directory_uri().'/images/recent_area.png" alt="Recent Bed" />';
													$area_detail = get_post_meta( $post->ID, 'psbuilduparea', true );
													$out .= sprintf( esc_html__('%s','dreamvilla-multiple-property'), $area_detail[0] );
												$out .= '
												</li>
											</ul>
											
											<div class="featured-properties-address-div v1 padding_none">';
												if( get_post_meta( $post->ID, 'pcountry', true ) || get_post_meta( $post->ID, 'pstate', true ) ){
													$out .= '<p class="featured-properties-address padding_none"><i class="fa fa-map-marker fa-lg"> </i>';
													$out .= sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $post->ID, 'pcountry', true ));
													if( get_post_meta( $post->ID, 'pcountry', true ) && get_post_meta( $post->ID, 'pstate', true ) ){ 
														$out .= " / ";
													}
													$out .= sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $post->ID, 'pstate', true ));
													$out .= '</p>';
												}
												$out .= dreamvilla_mp_agent_favorites_property_icon($post->ID);
											$out .= '
											</div>											
										</div>
									</div>';
							if( $i % 4 == 3 ){
								$out .= '
									</div>
								</div>';
							}
							$i++;
						}
						$i--;
						if( $i % 4 != 3) { 
							$out .= '</div></div>';
						}
						$out .= '
						</div>
						<div class="left-right-arrow blue-white">
							<a class="left carousel-control" href="#myCarousel0" role="button" data-slide="prev">
						    	<img src="'.esc_url(get_template_directory_uri()).'/images/arrow-left.png" alt="arrow right" class="pull-right">
						  	</a>
						  	<a class="right carousel-control" href="#myCarousel0" role="button" data-slide="next">
						    	<img src="'.esc_url(get_template_directory_uri()).'/images/arrow-right.png" alt="arrow right" class="pull-right">
						 	</a>
						</div>
					</div>';
					}
				$out .= '
				</div>
			</div>
		</div>';
	}

	return $out;
}
add_shortcode('featured_property','dreamvilla_featured_property_shortcode');

?>