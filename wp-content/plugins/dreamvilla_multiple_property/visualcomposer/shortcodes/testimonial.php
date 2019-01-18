<?php

// Max Title
function dreamvilla_testimonial_shortcode( $atts, $content = null ) {
	//exit;

	extract( shortcode_atts( array(
		'type' => '0'		
	), $atts ) );	

	$out = '';

	if( $type == '0' ){
		$out .= '
		<div class="multiple-people-to-say">			
			<div class="row">';
				$args=array(
					'post_type'			=> 'what_people_say',
					'posts_per_page' 	=> -1,
					'suppress_filters' 	=> 0
				);
				$People_To_Say = get_posts($args);
				if ( $People_To_Say ) {
					foreach ($People_To_Say as $key => $value) {
						$out .= '
						<div class="col-sm-6 col-md-4 col-lg-4">
							<div class="people-message">
								<div class="div-quote-img">
									<img src="'.esc_url(get_template_directory_uri()).'/images/quote.png" alt="quote">
								</div>
								<p>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$value->post_content).'</p>
							</div>	
							<div>
								<div class="people-say-image">
									<img '.dreamvilla_mp_get_device_image( $value->ID ).' alt="People img">
								</div>
								<span class="people-name">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$value->post_title).',</span>
								<span class="people-position">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $value->ID, "People_Position", true )).'</span>
							</div>
						</div>';
					}
				}
			$out .= '
			</div>			
		</div>';

		/*
		$out .= '
		<div class="dreamvilla-testimonial-variation-1 multiple-people-to-say">				
			<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
				<div class="carousel-inner" role="listbox">';
				
					$args=array(
						'post_type'			=> 'what_people_say',
						'posts_per_page' 	=> -1,
						'suppress_filters' 	=> 0
					);
					$People_To_Say = get_posts($args);
					if ( $People_To_Say ) {
						$innerFlag=0;
						$i=0;
						foreach ($People_To_Say as $key => $value) {
							$active_class = '';
							$row_div = '';
							if( $i % 2 == 0 ) {							
								if( $innerFlag == 0 ){ 
									$active_class = 'active'; 
									$innerFlag = 1;									
								}
								$row_div .= '<div class="item people-say-item '.$active_class.'">';
								$row_div .= '<div class="row">';
							}
							$out .= '							
								'.$row_div.'
									<div class="col-md-6 col-sm-12 people-say-group">
										<div class="people-say">
											<img src="'.esc_url(get_template_directory_uri()).'/images/qote.png" alt="q">
											<p>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$value->post_content).'</p>
											<h5>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$value->post_title).', <span>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $value->ID, "People_Position", true )).'</span></h5>
										</div>
										<div class="people-say-photo">
											<img '.dreamvilla_mp_get_device_image( $value->ID ).' alt="People img">
										</div>
									</div>';										
							if( $i % 2 == 1 ) {
								$out .='
								</div>
							</div>';
							}
							$i++;			
						$innerFlag = 1;
						}
						$i--;
						if( $i % 2 != 1 ) {
							$out .='</div>';
						}
					}
			$out .='
			</div>
			<ol class="carousel-indicators"></ol>
		</div>';
		*/
	}

	if($type == '1'){
		$out .= '
		<div class="dreamvilla-testimonial-variation-1 multiple-people-to-say">
			<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
				<div class="carousel-inner" role="listbox">';
				
					$args = array(
						'post_type'			=> 'what_people_say',
						'posts_per_page' 	=> -1,
						'suppress_filters' 	=> 0
					);
					$People_To_Say = get_posts($args);
					if ( $People_To_Say ) {
						$innerFlag = 0;
						$i = 0;
						foreach ($People_To_Say as $key => $value) {
							
							$active_con = '';
							$active_con_class = '';								
							
							if( $innerFlag == 0 ){ 
								$active_con_class = 'active';
								$innerFlag = 1;
							}

							if( $i % 2 == 0 ){
								$active_con = '<div class="item people-say-item '.$active_con_class.'"><div class="row">';
							}

							$out .= $active_con;

							$out .= '								
									<div class="col-md-6 col-sm-12 people-say-group">
										<div class="people-say">
											<img src="'.esc_url(get_template_directory_uri()).'/images/qote.png" alt="q">
											<p>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$value->post_content).'</p>
											<h5>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$value->post_title).', <span>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $value->ID, "People_Position", true )).'</span></h5>
										</div>
										<div class="people-say-photo">
											<img '.dreamvilla_mp_get_device_image( $value->ID ).' alt="People img">
										</div>
									</div>';
							if( $i % 2 == 1 ) {
								$out .= '</div></div>';								
							}
						$i++;
						}
						$innerFlag = 1;
					}
					$i--;
					if( $i % 2 != 1 ) {
						$out .= '</div></div>';						
					}
				$out .= '
				</div>
			<ol class="carousel-indicators"></ol>
		</div></div>';
	}

	return $out;

}
add_shortcode('testimonialbox','dreamvilla_testimonial_shortcode');
?>