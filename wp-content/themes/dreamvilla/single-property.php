<?php

	get_header();

	global $post;
	$article_classes;
	wp_enqueue_style('dreamvilla-mp-main-style', get_template_directory_uri().'/css/dreamvilla-mp-main.css', '', '', 'all');

	$dreamvilla_options = get_option('dreamvilla_options');

if ( have_posts() ):
	while ( have_posts() ):
    	the_post(); ?>

<?php if ( !empty($dreamvilla_options['property_detail_page_variation'] ) && $dreamvilla_options['property_detail_page_variation'] == 1 ) { ?>
<div class="inner-page-property-details-header-area">
	<div class="property-detail-banner">
		<div class="header_slider_container">
			<?php
			$PropertyGallery = get_post_meta( $post->ID, 'propertygallery', true );
			if( $PropertyGallery ){
				$i=0;
				foreach ($PropertyGallery as $key => $value) {
					$i++;
					if( $PropertyGallery[$key]['pgallery'] ){ ?>
						<img alt="banner-image" class="img-responsive image_header <?php if($i==1) { echo "active_image"; } ?>" src="<?php echo esc_url($PropertyGallery[$key]['pgallery']); ?>"><?php
					} /* End of if for banner image*/
				} /* End of for each loop*/
			} /*End of property gallery condition*/
			if( $PropertyGallery ){ ?>
				<button class="previous_image_btn" type="button">
					<span class="glyphicon glyphicon-menu-left"> </span>
				</button>
				<button class="next_image_btn" type="button">
					<span class="glyphicon glyphicon-menu-right"> </span>
				</button>
			<?php } ?> <!-- End of property gallery condition -->
			<div class="shadow"> </div>
		</div>
		<div class="property-detail-info">
			<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<?php $PropertyFetured = get_post_meta( $post->ID, 'pfetured', true);
							if( $PropertyFetured == "yes" ){ ?>
							<div class="featuredcontent">
								<span class="featured-property-icon" href="javascript:void(0)"><i class="fa fa-star"></i> <span class="textfeatured">Destacado </span> </span>
							</div><?php
							} ?>
							<div id="featureheart">
						<?php
							if($post->post_title && $post->post_title != "") { ?>
								<h1 class="property-detail-info-title"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$post->post_title); ?></h1><?php
							} ?>
							<label class="property_type">
								<?php
								$property_status = get_post_meta( $post->ID, 'pstatus', true );
								if ( $property_status == "sale" ){
									printf( esc_html__('Venta','dreamvilla-multiple-property'));
								} else {
									printf( esc_html__('Alquiler','dreamvilla-multiple-property'));
								} ?>
							</label>
							<?php $property_status_list = wp_get_post_terms($post->ID, 'property_status' );

							if( !empty($property_status_list[0]->term_id) && $property_status_list[0]->slug != "normal" ){ ?>
								<span class="featured-proeprty-label"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$property_status_list[0]->name ); ?></span><?php
							} ?>

								<?php echo dreamvilla_mp_agent_favorites_property_icon($post->ID); ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-xs-12 col-md-8 col-lg-8">
							<?php if(get_post_meta( $post->ID, 'pcountry', true ) != "" || get_post_meta( $post->ID, 'pstate', true )) { ?>
								<p class="property-detail-address"><i class="fa fa-map-marker"> </i>
									<?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $post->ID, 'pcountry', true )); ?> /
									<?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $post->ID, 'pstate', true )); ?>
								</p>
							<?php } ?>
						<div class="row property-detail-facility">
							<?php $property_price = get_post_meta( $post->ID, 'pprice', true );
								if($property_price[0] && $property_price[0] !="" ){
							?>
							<div class="col-xs-12 col-sm-3 col-md-3">
								<?php if( $property_price[0] ){ ?>
								<label class="property-detail-price">
									<?php
									if( $property_status == "sale" ){
										printf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
									} else {
										printf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
										echo '<span class="price-label">';
											printf( esc_html__(' / %s','dreamvilla-multiple-property'),strtoupper($property_price[1]));
										echo '</span>';
									} ?>
								</label>
								<?php } ?>
							</div>
							<?php }?>
							<?php if(dreamvilla_mp_number_of_bathroom($post->ID) != "" && dreamvilla_mp_number_of_bathroom($post->ID) > 0){ ?>
								<div class="col-xs-12 col-sm-3 col-md-3 property-detail-facility-icon">
									<img src="<?php echo get_template_directory_uri(); ?>/images/recent_bath_white.png" alt="Recent Bath" />
									<label><?php esc_html_e('Baños','dreamvilla-multiple-property'); ?></label><span><?php printf( esc_html__('%s','dreamvilla-multiple-property'),dreamvilla_mp_number_of_bathroom($post->ID)); ?></span></div>
							<?php } if(dreamvilla_mp_number_of_bedroom($post->ID) != "" && dreamvilla_mp_number_of_bedroom($post->ID) > 0){ ?>
								<div class="col-xs-12 col-sm-3 col-md-3 property-detail-facility-icon">
									<img src="<?php echo get_template_directory_uri(); ?>/images/recent_bed_white.png" alt="Recent Bed" />
									<label><?php esc_html_e('Habitaciones','dreamvilla-multiple-property'); ?></label><span><?php printf( esc_html__('%s','dreamvilla-multiple-property'),dreamvilla_mp_number_of_bedroom($post->ID)); ?></span></div>
							<?php } if(get_post_meta( $post->ID, 'pnoofgarage', true) != "" && get_post_meta( $post->ID, 'pnoofgarage', true) > 0){ ?>
								<div class="col-xs-12 col-sm-3 col-md-3 property-detail-facility-icon">
									<img src="<?php echo get_template_directory_uri(); ?>/images/recent_garage_white.png" alt="Recent Garage" />
									<label><?php esc_html_e('Garajes','dreamvilla-multiple-property'); ?></label><span><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $post->ID, 'pnoofgarage', true)); ?></span></div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<section>
	<div class="property-detail">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-8 property-detail-inner">
					<?php if(!empty($dreamvilla_options['displaydescription']) && $dreamvilla_options["displaydescription"] == "yes"){ ?>
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<h4 class="property-description">
								<?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options["descriptiontitle"]);?>
								<a class="print-document" href="javascript:window.print()">
									<img src="<?php echo get_template_directory_uri(); ?>/images/print.png" alt="Print This Page" />
									<?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options["printtitle"]); ?>
								</a>
							</h4>
							<p><?php the_content(); ?></p>
						</div>
					</div><?php
					}

					$PropertyEssential = get_post_meta( $post->ID, 'essentialinformation', true );
					if( ( !empty($dreamvilla_options['displayessentialinformation']) && $dreamvilla_options["displayessentialinformation"] == "yes" && !empty($PropertyEssential) ) || ( !empty($dreamvilla_options['displayamenities']) && $dreamvilla_options["displayamenities"] == "yes" ) ){ ?>
					<div class="row"><?php
						if(!empty($dreamvilla_options['displayessentialinformation']) && $dreamvilla_options['displayessentialinformation'] == "yes" && !empty($PropertyEssential)){ ?>
							<div class="col-lg-6 col-md-6">
								<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options["essentialinformationtitle"]);?></h4>
								<div class="row"><?php
									if( $PropertyEssential ){
										foreach ($PropertyEssential as $key => $value) { ?>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-label"><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$PropertyEssential[$key]['essentialtitle']); ?></div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-value"><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$PropertyEssential[$key]['essentialvalue']); ?></div><?php
										}
									} ?>
								</div>
							</div><?php
						}

						$PropertyAmenities = get_post_meta( $post->ID, 'propertyamenities', true );
						if(!empty($dreamvilla_options['displayamenities']) && $dreamvilla_options["displayamenities"] == "yes" && !empty($PropertyAmenities)) { ?>
						<div class="col-lg-6 col-md-6">
							<?php
							if( $PropertyAmenities ){ ?>
								<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'), $dreamvilla_options["amenitiestitle"]); ?></h4>
								<div class="row amenities-info"><?php
									foreach ( $PropertyAmenities as $key => $value ) { ?>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="information-label"><img src="<?php echo esc_url($PropertyAmenities[$key]['pamenitiesphoto']); ?>" alt="amenities-icon"/></div>
											<div class="information-value"><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$PropertyAmenities[$key]['pamenities']); ?></div>
										</div><?php
									} ?>
								</div><?php
							} ?>
						</div>
						<?php } ?>
					</div>
					<?php }
					$PropertyInterior = get_post_meta( $post->ID, 'pinteriorarray', true ); ?>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<?php
							if(!empty($dreamvilla_options['displayinterior']) && $dreamvilla_options['displayinterior'] == "yes" && !empty($PropertyInterior)){ ?>
								<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'), $dreamvilla_options["interiortitle"]);?></h4>
								<div class="row"><?php
									if( $PropertyInterior ){
										foreach ($PropertyInterior as $key => $value) { ?>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-label"><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$PropertyInterior[$key]['interiortitle']); ?></div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-value"><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$PropertyInterior[$key]['interiordescription']); ?></div><?php
										}
									} ?>
								</div><?php
							}

							$PropertyExterior = get_post_meta( $post->ID, 'pexteriorarray', true );
							if(!empty($dreamvilla_options['displayexterior']) && $dreamvilla_options["displayexterior"]=="yes" && !empty($PropertyExterior)){ ?>
								<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options["exteriortitle"]);?></h4>
								<div class="row"><?php
									if( $PropertyExterior ){
										foreach ($PropertyExterior as $key => $value) { ?>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-label"><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$PropertyExterior[$key]['exteriortitle']); ?></div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-value"><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$PropertyExterior[$key]['exteriordescription']); ?></div><?php
										}
									} ?>
								</div><?php
							}
							$PropertyFlooring = get_post_meta( $post->ID, 'pflooring', true);
							if( !empty($dreamvilla_options['displayflooring']) && $dreamvilla_options["displayflooring"] == "yes" && $PropertyFlooring && !empty($PropertyFlooring)){ ?>
								<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'), $dreamvilla_options["flooringtitle"]);?></h4>
								<div class="row">
									<div class="col-lg-12 col-md-12">
										<p><?php printf(esc_html__("%s","dreamvilla-multiple-property"),$PropertyFlooring)?></p>
									</div>
								</div>
							<?php } ?>
						</div>
						<div class="col-lg-12 col-md-12">
							<?php
							$RoomDetails 			= get_post_meta( $post->ID, 'propertyroom', true );
							$KitchenDetails 		= get_post_meta( $post->ID, 'propertykitchen', true );
							$BathroomDetails 		= get_post_meta( $post->ID, 'propertybathroom', true );
							$GymDetails 			= get_post_meta( $post->ID, 'propertygym', true );
							$SwimmingPoolDetails 	= get_post_meta( $post->ID, 'propertyswimmingpool', true );

							if(!empty($dreamvilla_options['displayroomdimensions']) && $dreamvilla_options["displayroomdimensions"] == "yes" && ( !empty($RoomDetails) || !empty($KitchenDetails) || !empty($BathroomDetails) || !empty($GymDetails) || !empty($SwimmingPoolDetails) )) {?>
								<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'), $dreamvilla_options["roomdimensionstitle"]); ?></h4>
								<div class="row">
									<?php

									$RoomType 		= dreamvilla_mp_get_room_type();
									$BedroomCounter = 0;

									if( empty($KitchenDetails) ){
								    	$KitchenDetails[0]['pkitchensize'] = '';
								    }

								    if( empty($BathroomDetails) ){
								    	$BathroomDetails[0]['pbathroomsize'] = '';
								    }

								    if( empty($GymDetails) ){
								    	$GymDetails[0]['pgymsize'] = '';
								    }

								    if( empty($SwimmingPoolDetails) ){
								    	$SwimmingPoolDetails[0]['pswimmingpoolsize'] = '';
								    }

								    if( $RoomDetails ){
										foreach ($RoomDetails as $key => $value) {

											if( $value['proomtype'] == 'Bedroom' ){ $BedroomCounter++; ?>
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-label"><?php esc_html_e('Habitación','dreamvilla-multiple-property'); echo ' '.$BedroomCounter; ?></div>
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-value"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$value['proomsize']); ?> </div><?php
											}

											if( $value['proomtype'] != 'Bedroom' && isset($RoomType[$value['proomtype']]) ){
												if( $RoomType[$value['proomtype']] == 'Habitación principal' ){ ?>
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-label"><?php esc_html_e('Habitación principal','dreamvilla-multiple-property'); ?></div><?php
												}

												if( $RoomType[$value['proomtype']] == 'Sala de estar' ){ ?>
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-label"><?php esc_html_e('Sala','dreamvilla-multiple-property'); ?></div><?php
												}

												if( $RoomType[$value['proomtype']] == 'Comedor' ){ ?>
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-label"><?php esc_html_e('Comedor','dreamvilla-multiple-property'); ?></div><?php
												} ?>

												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-value"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$value['proomsize']); ?> </div><?php
											}
										}
									}
									if( $KitchenDetails[0]['pkitchensize'] ) { ?>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-label"><?php esc_html_e('Cocina','dreamvilla-multiple-property'); ?> </div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-value"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$KitchenDetails[0]['pkitchensize']); ?> </div><?php
									}

									/*if( $BathroomDetails[0]['pbathroomsize'] ) { ?>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-label"><?php esc_html_e('Bathroom','dreamvilla-multiple-property'); ?> </div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-value"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$BathroomDetails[0]['pbathroomsize']); ?></div><?php
									}*/

									if( $BathroomDetails) {
										foreach($BathroomDetails as $key => $value) {?>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-label"><?php esc_html_e('Baño','dreamvilla-multiple-property'); ?> </div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-value"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$BathroomDetails[$key]['pbathroomsize']); ?></div><?php
										}
									}

									if( $GymDetails[0]['pgymsize'] ) { ?>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-label"><?php esc_html_e('Gimnasio','dreamvilla-multiple-property'); ?> </div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-value"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$GymDetails[0]['pgymsize']); ?></div><?php
									}

									if( $SwimmingPoolDetails[0]['pswimmingpoolsize'] ) { ?>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-label"><?php esc_html_e('Piscina','dreamvilla-multiple-property'); ?> </div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-value"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$SwimmingPoolDetails[0]['pswimmingpoolsize']); ?></div><?php
									} ?>
								</div><?php
							}

							$PropertyGoodsIncluded = get_post_meta( $post->ID, 'pgoodsincluded', true);

							if(!empty($dreamvilla_options['displaygoodsinclude']) && $dreamvilla_options["displaygoodsinclude"]=="yes" && !empty($PropertyGoodsIncluded)){

								if($PropertyGoodsIncluded && $PropertyGoodsIncluded!=''){ ?>

									<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'), $dreamvilla_options["goodsincludetitle"]);?></h4>
									<div class="row">
										<div class="col-lg-12 col-md-12">
											<p><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$PropertyGoodsIncluded); ?></p>
										</div>
									</div><?php
								}
							} ?>
						</div>
					</div>
					<?php
					$PropertyFloors = get_post_meta( $post->ID, 'propertyfloors', true );
					if(!empty($dreamvilla_options['displayfloorplan']) && $dreamvilla_options["displayfloorplan"] == "yes" && !empty($PropertyFloors)) { ?>
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options["floorplantitle"]);?></h4>

							<?php
							$floor_counter = 0;
							if( $PropertyFloors ){
								foreach ($PropertyFloors as $key => $value) { ?>
									<div class="inner-page-gallery-two-columns-dimension-btn show-hide-btn">
										<?php if( $floor_counter == 0 ){ ?>
											<a class="active" data-id="<?php echo esc_attr($key); ?>"><?php echo esc_html($PropertyFloors[$key]['floortitle']); ?></a>
										<?php } else { ?>
											<a data-id="<?php echo esc_attr($key); ?>"><?php echo esc_html($PropertyFloors[$key]['floortitle']); ?></a>
										<?php }
										$floor_counter++; ?>
									</div>
								<?php }
								foreach ($PropertyFloors as $key => $value) { ?>
									<div id="<?php echo esc_attr($key); ?>" class="<?php echo esc_attr($key); ?> inner-page-gallery-two-columns-dimension-detail show-hide-detail">
										<img class="theme_favicon_icon" width="25%" alt="Floor Plan" src="<?php echo esc_attr($PropertyFloors[$key]['floorplanimage']); ?>">
										<div class="floorplan_options">
											<span><?php echo esc_html($PropertyFloors[$key]['floorsqrt']); ?> sq/ft</span>
											<span><?php echo esc_html($PropertyFloors[$key]['floorbedrooms']); esc_html_e(' Habitaciones','dreamvilla-multiple-property'); ?></span>
											<span><?php echo esc_html($PropertyFloors[$key]['floorbathrooms']); esc_html_e(' Baños','dreamvilla-multiple-property'); ?> </span>
											<span class="floor-plan-price"><?php echo esc_html($PropertyFloors[$key]['floorprice']); ?></span>
										</div>
										<p class="description"><?php echo esc_html($PropertyFloors[$key]['floordetail']); ?></p>
									</div>
								<?php }
							} ?>
						</div>
					</div>
					<?php }

					$DocumentsStatus = get_post_meta( $post->ID, 'pdocumentsstatus', true );
					$Documents = get_post_meta( $post->ID, 'pdocuments', true );

					if(!empty($DocumentsStatus) && $DocumentsStatus['pdocumentsstatus'] == "yes" ) { ?>
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$DocumentsStatus['pdocumentstitle']);?></h4>
							<div class="row"><?php
								if( !empty($Documents) ){ ?>
									<div class="property-documents-area">
										<ul><?php
										foreach ($Documents as $Documentskey => $Documentsvalue) { ?>
											<li><a target="_blank" href="<?php if( !empty($Documents[$Documentskey]['pdocumentslink']) ){ echo esc_attr($Documents[$Documentskey]['pdocumentslink']); } ?>"><span><?php if( !empty($Documents[$Documentskey]['pdocumentslabel']) ){ echo esc_attr($Documents[$Documentskey]['pdocumentslabel']); } ?></span><i class="fa fa-cloud-download"></i></a></li><?php
										} ?>
										</ul>
									</div><?php
								} ?>
							</div>
						</div>
					</div>
					<?php }

					$property_lat_lon = get_post_meta( $post->ID, 'platlon', true );
					$google_place = get_post_meta( $post->ID, 'google_near_by_place', true );
					$google_custom_place = get_post_meta( $post->ID, 'google_near_by_custom_place', true );

					if(!empty($dreamvilla_options['displaynearbyplaces']) && $dreamvilla_options["displaynearbyplaces"] == "yes" && (!empty($google_place) || !empty($google_custom_place)) && !empty($property_lat_lon)) { ?>
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options["nearybyplacestitle"]);?></h4>
							<div class="row">
								<div class="col-md-6 col-sm-12 col-xs-12" id="near-by-place-detail"> </div>
								<div class="col-md-6 col-sm-12 col-xs-12 near-location-map">
									<div class="near-location-map">
										<div id="googleMapNearestPlaces" style="width:100%;height:100%;"> </div>
									</div>
								</div>
								<?php
								if(isset($post)){
									$property_lat_lon = get_post_meta( $post->ID, 'platlon', true );
								}
								$map_radius = $dreamvilla_options["map_radius"];

								if( empty($map_radius) ){
									$map_radius = 5000;
								}

								$distancenearbyplaces = $dreamvilla_options['distancenearbyplaces'];

								$PlaceArray = $PlacePlaceArray = $PlaceLabelArray = $PlaceIconArray = '';

								$google_place = get_post_meta( $post->ID, 'google_near_by_place', true );
								if( $google_place != "" ){
									foreach ($google_place as $key => $value) {
										$PlaceArray 		.= "'".$google_place[$key]['google_near_by_place_type']."', ";
										$PlacePlaceArray 	.= $google_place[$key]['google_near_by_place_type'].",";
										$PlaceLabelArray 	.= $google_place[$key]['google_near_by_place_label'].",";
										$PlaceIconArray 	.= $google_place[$key]['google_near_by_place_icon'].",";
									}
								}

								$google_custom_place = get_post_meta( $post->ID, 'google_near_by_custom_place', true );

								$CustomPlaceLabelArray = $CustomPlaceDetailArray = $CustomPlaceLatitudeArray = $CustomPlaceLongitudeArray = $CustomPlaceIconArray = '';

								if($google_custom_place) {
									foreach ($google_custom_place as $key => $value) {
										$CustomPlaceLabelArray 		.= $google_custom_place[$key]['google_near_by_custom_place_label'].",";
										$CustomPlaceDetailArray 	.= $google_custom_place[$key]['google_near_by_custom_place_detail'].",";
										$CustomPlaceLatitudeArray 	.= $google_custom_place[$key]['google_near_by_custom_place_latitude'].",";
										$CustomPlaceLongitudeArray 	.= $google_custom_place[$key]['google_near_by_custom_place_longitude'].",";
										$CustomPlaceIconArray 		.= $google_custom_place[$key]['google_near_by_custom_place_icon'].",";
									}
								} ?>
								<script>
									jQuery(document).ready(function(){
										var image_src = "<?php echo esc_js(get_template_directory_uri()); ?>";
										var map;
										var infowindow;
										var bounds = new google.maps.LatLngBounds();

										var PlaceArray 		= [ <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$PlaceArray); ?> ];
										var PlacePlaceArray = '<?php echo esc_js($PlacePlaceArray); ?>'.split(',');
										var PlaceLabelArray = '<?php echo esc_js($PlaceLabelArray); ?>'.split(',');
										var PlaceIconArray 	= '<?php echo esc_js($PlaceIconArray); ?>'.split(',');
										var PlaceCounter 	= 0;

										var CustomPlaceLabelArray = '';
										var CustomPlaceDetailArray = '';
										var CustomPlaceLatitudeArray = '';
										var CustomPlaceLongitudeArray = '';
										var CustomPlaceIconArray = '';

										CustomPlaceLabelArray 		= '<?php echo esc_js($CustomPlaceLabelArray); ?>'.split(',');
										CustomPlaceDetailArray 		= '<?php echo esc_js($CustomPlaceDetailArray); ?>'.split(',');
										CustomPlaceLatitudeArray 	= '<?php echo esc_js($CustomPlaceLatitudeArray); ?>'.split(',');
										CustomPlaceLongitudeArray 	= '<?php echo esc_js($CustomPlaceLongitudeArray); ?>'.split(',');
										CustomPlaceIconArray 		= '<?php echo esc_js($CustomPlaceIconArray); ?>'.split(',');

										var PlaceDetail = [];
									    for (var n = 0; n < PlacePlaceArray.length; n++) {
									        PlaceDetail[PlacePlaceArray[n]] = [PlaceLabelArray[n],PlaceIconArray[n]];
									    }

										function initialize() {
											"use strict";
											var pyrmont = new google.maps.LatLng("<?php echo esc_js($property_lat_lon[0]); ?>","<?php echo esc_js($property_lat_lon[1]); ?>");

											map = new google.maps.Map(document.getElementById('googleMapNearestPlaces'), {
												center: pyrmont,
												zoom: 14,
												icon:'<?php echo esc_js(get_template_directory_uri()); ?>/images/map_marker.png',
												scrollwheel: false,
												rankby: 'distance',
												styles: <?php echo $dreamvilla_options["dreamvilla_map_style"]; ?>
											});

											var marker=new google.maps.Marker({position:pyrmont,icon:'<?php echo esc_js(get_template_directory_uri()); ?>/images/map_marker.png'});
											marker.setMap(map);
											var request = {
												location: pyrmont,
												radius: '<?php echo esc_js($map_radius); ?>',
												types: [ <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$PlaceArray); ?> ],
											};

											infowindow = new google.maps.InfoWindow();
											var service = new google.maps.places.PlacesService(map);
											service.nearbySearch(request, dreamvilla_mp_callback);

											// Display multiple markers on a map
								   		 	var infoWindow = new google.maps.InfoWindow(), marker, i;

										    // Loop through our array of markers & place each one on the map
										    for( i = 0; i < CustomPlaceLabelArray.length; i++ ) {
										    	if(CustomPlaceLatitudeArray[i]  && CustomPlaceLatitudeArray[i]!=""){

										    		var Distance = dreamvilla_mp_distance(CustomPlaceLatitudeArray[i],CustomPlaceLongitudeArray[i]);

										    		jQuery("#near-by-place-detail").append("<div class='near-location-info'><ul><li class='right'>"+CustomPlaceLabelArray[i]+"</li><li class='left'>"+Distance+" "+distance_in+"</li></ul><span>"+CustomPlaceDetailArray[i]+"</span></div>");

											        var position = new google.maps.LatLng(CustomPlaceLatitudeArray[i], CustomPlaceLongitudeArray[i]);
											        bounds.extend(position);
											        marker = new google.maps.Marker({
											            position: position,
											            map: map,
											            title: CustomPlaceLabelArray[i],
														icon:CustomPlaceIconArray[i]
											        });

											        // Allow each marker to have an info window
											        google.maps.event.addListener(marker, 'click', (function(marker, i) {
											            return function() {
											                infoWindow.setContent(CustomPlaceDetailArray[i]);
											                infoWindow.open(map, marker);
											            }
											        })(marker, i));

											        // Automatically center the map fitting all markers on the screen
											        map.fitBounds(bounds);
												}
										    }
										}

										function dreamvilla_mp_callback(results, status) {
											"use strict";
											if (status == google.maps.places.PlacesServiceStatus.OK) {
												for (var i = 0; i < results.length; i++) {
													dreamvilla_mp_createMarker(results[i]);
												}
											}
										}

										var distance_in = "<?php echo esc_js($distancenearbyplaces); ?>";
										var Place_Counter = 0;
										function dreamvilla_mp_createMarker(place) {
											"use strict";

											var PlaceType 	= "";
											jQuery.each( place.types, function( key, value ) {
											  if( jQuery.inArray( value, PlaceArray ) != -1 ){
											  		PlaceType = value;
											  }
											});

											if(PlaceType==""){
												return;
											}

											PlaceArray = jQuery.grep(PlaceArray, function(value) {
											  return value != PlaceType;
											});

											Place_Counter ++;

											var Distance = dreamvilla_mp_distance(place.geometry.location.lat(),place.geometry.location.lng());

											var place_label = PlaceDetail[PlaceType][0];
											var place_icon 	= PlaceDetail[PlaceType][1];

											jQuery("#near-by-place-detail").append("<div class='near-location-info'><ul><li class='right'>"+place_label+"</li><li class='left'>"+Distance+" "+distance_in+"</li></ul><span>"+place.name+"</span></div>");

											var placeLoc = place.geometry.location;
											var marker = new google.maps.Marker({
												map: map,
												position: place.geometry.location,
												icon:place_icon,
											});

											google.maps.event.addListener(marker, 'click', function() {
												infowindow.setContent(place.name);
												infowindow.open(map, this);
											});

											bounds.extend(marker.position);

											//now fit the map to the newly inclusive bounds
											map.fitBounds(bounds);

											//(optional) restore the zoom level after the map is done scaling
											var listener = google.maps.event.addListener(map, "idle", function () {
											    map.setZoom(12);
											    google.maps.event.removeListener(listener);
											});

										}
										google.maps.event.addDomListener(window, 'load', initialize);

										function dreamvilla_mp_distance(latitude2, longitude2) {
											var lat1 = "<?php echo esc_js($property_lat_lon[0]); ?>";
											var lon1 = "<?php echo esc_js($property_lat_lon[1]); ?>";
											var lat2 = latitude2;
    										var lon2 = longitude2;

											var radlat1 = Math.PI * lat1/180;
											var radlat2 = Math.PI * lat2/180;
											var radlon1 = Math.PI * lon1/180;
											var radlon2 = Math.PI * lon2/180;
											var theta = lon1-lon2;
											var radtheta = Math.PI * theta/180;
											var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
											dist = Math.acos(dist);
											dist = dist * 180/Math.PI;
											dist = dist * 60 * 1.1515;

											if( distance_in == "km" ){
												dist = dist * 1.609344;
											}

											return Math.round( dist * 100 )/100;
										}
									});
								</script>
							</div>
						</div>
					</div>
					<?php }
					$property_lat_lon = get_post_meta( $post->ID, 'platlon', true );
					if(!empty($dreamvilla_options['displaygetdirections']) && $dreamvilla_options["displaygetdirections"] == "yes" && !empty($property_lat_lon)) { ?>
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="get-direction">
								<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'), $dreamvilla_options["getdirectionstitle"]);?></h4>
								<div id="GoogleMapGetDirections" style="width:100%;height:285px;"></div>
								<form>
									<input type="text" id="GetDirectionsAddress" placeholder="<?php esc_html_e("Dirección","dreamvilla-multiple-property"); ?>" />
									<button type="button" id="GetDirections"><?php printf(esc_html__("%s","dreamvilla-multiple-property"), $dreamvilla_options["getdirectionstitle"]); ?></button>
								</form>
							</div>
							<?php if(isset($post)){
								$property_lat_lon = get_post_meta( $post->ID, 'platlon', true );
							} ?>
							<script>
								jQuery(document).ready(function(){
									// Location detail area load map
									var myCenter = new google.maps.LatLng("<?php echo esc_js($property_lat_lon[0]); ?>","<?php echo esc_js($property_lat_lon[1]); ?>");
									function initialize() {
										var mapProp = {
											center : myCenter,
											zoom : 11,
											mapTypeId : google.maps.MapTypeId.ROADMAP,
											scrollwheel: false,
											styles: <?php echo $dreamvilla_options["dreamvilla_map_style"]; ?>
										};
										var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
										var marker = new google.maps.Marker({
											position : myCenter,
											icon : '<?php echo esc_js(get_template_directory_uri()); ?>/images/map_marker.png',
										});
										marker.setMap(map);
									}

									if(document.getElementById('googleMap') != null ){
										google.maps.event.addDomListener(window, 'load', initialize);
									}

									// Proprty detail page get direction
									function initAutocomplete() {

									    var directionsService = new google.maps.DirectionsService;
									    var directionsDisplay = new google.maps.DirectionsRenderer;

									    var map = new google.maps.Map(document.getElementById('GoogleMapGetDirections'), {
									        center: myCenter,
									        zoom: 11,
									        mapTypeId : google.maps.MapTypeId.ROADMAP,
									        scrollwheel: false,
									        styles: <?php echo $dreamvilla_options["dreamvilla_map_style"]; ?>
									    });

									    var marker = new google.maps.Marker({
									        position : myCenter,
									        icon : '<?php echo esc_js(get_template_directory_uri()); ?>/images/map_marker.png',
									    });
									    marker.setMap(map);

									    directionsDisplay.setMap(map);

									    var onChangeHandler = function() {
									        dreamvilla_mp_calculateAndDisplayRoute(directionsService, directionsDisplay, marker);
									    };

									    document.getElementById('GetDirections').addEventListener('click', onChangeHandler);

									    autocomplete = new google.maps.places.Autocomplete((document.getElementById('GetDirectionsAddress')),{types: ['geocode']});
									}

									function dreamvilla_mp_calculateAndDisplayRoute(directionsService, directionsDisplay, marker) {
									    directionsService.route({
									        origin: myCenter,
									        destination: document.getElementById('GetDirectionsAddress').value,

									        travelMode: google.maps.TravelMode.DRIVING
									        }, function(response, status) {
									        if (status === google.maps.DirectionsStatus.OK) {
									            marker.setVisible(false);
									            directionsDisplay.setDirections(response);
									        } else {
									            window.alert('Directions request failed due to ' + status);
									        }
									    });
									}
									if(document.getElementById('GetDirectionsAddress') != null ){
										google.maps.event.addDomListener(window, 'load', initAutocomplete);
									}
								});
							</script>
						</div>
					</div>
					<?php }

					$property_streetview_lat = get_post_meta( $post->ID, 'streetviewlat', true );
					$property_streetview_lon = get_post_meta( $post->ID, 'streetviewlng', true );

					if(!empty($dreamvilla_options['displaystreeviewmap']) && $dreamvilla_options["displaystreeviewmap"] == "yes" && !empty($property_streetview_lat) && !empty($property_streetview_lon)) { ?>

					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div>
								<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'), $dreamvilla_options["propertystreetviewtitle"]);?></h4>
								<div id="street_view" style="width:100%;height:285px;"></div>
							</div>
							<script>

								jQuery(document).ready(function(){

									function initialize() {

										var fenway = {lat: <?php echo esc_js($property_streetview_lat); ?>, lng: <?php echo esc_js($property_streetview_lon); ?>};

								        var map = new google.maps.Map(document.getElementById('street_view'), {
								        	center: fenway,
								          	zoom: 14,
								        });

								        var panorama = new google.maps.StreetViewPanorama(
								        	document.getElementById('street_view'), {
								            	position: fenway,
								              	pov: {
								                	heading: 34,
								                	pitch: 10
								              	}
								            });
								        map.setStreetView(panorama);
								   	}

								   	if(document.getElementById('street_view') != null ){
										google.maps.event.addDomListener(window, 'load', initialize);
									}
								});
							</script>
						</div>
					</div>
					<?php } ?>

					<?php
					if( $dreamvilla_options['sharepropertystatus'] == "yes" ) {

					// Get current page URL
					$crunchifyURL = get_permalink();

					// Get current page title
					$crunchifyTitle = str_replace( ' ', '%20', get_the_title());

					// Get Post Thumbnail for pinterest
					$crunchifyThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

					// Construct sharing URL without using any script
					$twitterURL = 'https://twitter.com/intent/tweet?text='.$crunchifyTitle.'&amp;url='.$crunchifyURL;
					$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$crunchifyURL;
					$googleURL = 'https://plus.google.com/share?url='.$crunchifyURL;
					$pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$crunchifyURL.'&amp;media='.$crunchifyThumbnail[0].'&amp;description='.$crunchifyTitle;
			 		$bufferURL = 'https://bufferapp.com/add?url='.$crunchifyURL.'&amp;text='.$crunchifyTitle; ?>

					<div class="row">
						<div class="col-lg-12 col-md-12">
							<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['sharepropertylabel']);?></h4>
							<div class="row">
								<ul class="share-property-on-social-media">
									<li><a href="<?php echo $facebookURL; ?>" target="_blank"><i class="fa fa-facebook"></i><?php echo esc_html__('Share on Facebook','dreamvilla-multiple-property'); ?></a></li>
									<li><a href="<?php echo $twitterURL; ?>" target="_blank"><i class="fa fa-twitter"></i><?php echo esc_html__('Share on Twitter','dreamvilla-multiple-property'); ?></a></li>
									<li><a href="<?php echo $googleURL; ?>" target="_blank"><i class="fa fa-google-plus"></i><?php echo esc_html__('Share on Google','dreamvilla-multiple-property'); ?></a></li>
									<li><a href="<?php echo $pinterestURL; ?>" target="_blank"><i class="fa  fa-pinterest-p"></i><?php echo esc_html__('Share on Pinterest','dreamvilla-multiple-property'); ?></a></li>
								</ul>
							</div>
						</div>
					</div>
					<?php }

					$Sub_Property = get_post_meta( $post->ID, 'psubproperty', true );

					if( !empty($Sub_Property) && $dreamvilla_options['displaysubproperty'] == "yes" ) {
						$args = array(
								'post_type'			=> 'property',
								'posts_per_page' 	=> -1,
								'include'			=> $Sub_Property,
								'suppress_filters' 	=> 0
						);

						$i = 0;
						$SubProperty = get_posts($args); ?>
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="agent-recent-properties sub-property">
									<h4><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['subpropertytitle']); ?></h4>
									<div id="property-listing" class="carousel slide property-listing" data-ride="carousel" data-interval="false">
										<div class="carousel-inner" role="listbox"><?php
										foreach ($SubProperty as $key => $value) {
											if( $i % 2 == 0 ){ ?>
											<div class="item <?php if( $i == 0 ){ echo "active"; } ?>">
											<?php } ?>
												<div class="col-xs-12 col-sm-6 col-md-6 no-padding">
													<div class="image-with-label">
														<img <?php echo dreamvilla_mp_get_device_image( $value->ID ); ?> alt="agent-properties" class="img-responsive">
														<label><?php
														$property_status = get_post_meta( $value->ID, 'pstatus', true );
														if ( $property_status == "sale" ){
															printf( esc_html__('Venta','dreamvilla-multiple-property'));
														} else {
															printf( esc_html__('Alquiler','dreamvilla-multiple-property'));
														} ?>
														</label>
													</div>

													<a href="<?php echo esc_url(get_permalink ($value->ID)); ?>"><h6><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$value->post_title); ?></h6></a>

													<?php if( get_post_meta( $value->ID, 'pcountry', true ) || get_post_meta( $value->ID, 'pstate', true ) ){ ?>
														<span class="recent-properties-address"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $value->ID, 'pcountry', true )); if( get_post_meta( $value->ID, 'pcountry', true ) && get_post_meta( $value->ID, 'pstate', true ) ){ echo " / "; } printf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $value->ID, 'pstate', true )); ?></span>
													<?php } ?>

													<p class="recent-properties-price">
														<?php
														$property_price = get_post_meta( $value->ID, 'pprice', true );
														if( $property_price[0] ){
															if( $property_status == "sale" ){
																printf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
															} else {
																printf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
																echo '<span class="price-label">';
																	if( !empty($property_price[1]) ){
																		printf( esc_html__(' / %s','dreamvilla-multiple-property'),strtoupper($property_price[1]));
																	}
																echo '</span>';
															}
														} ?>
													</p>
												</div><?php
												$i++;
												if( $i % 2 == 0 && $i != 1 ){ ?>
											</div><?php
											}
										}
										if( $i % 2 == 1 || $i == 1 ){
											echo "</div>";
										} ?>

										</div>
										<?php if( $i > 2 ){ ?>
										<div class="left-right-arrow">
											<a class="left carousel-control" href="#myCarousel0" role="button" data-slide="prev"></a>
										  	<a class="right carousel-control" href="#myCarousel0" role="button" data-slide="next"></a>
										</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div><?php
					} ?>

				</div>

				<?php if( ( !empty($dreamvilla_options['displaypropertyfilter']) && $dreamvilla_options["displaypropertyfilter"] == "yes") || (!empty($dreamvilla_options['displayagentinfo']) && $dreamvilla_options["displayagentinfo"]=="yes") || ( !empty($dreamvilla_options['displaycontactform']) && $dreamvilla_options["displaycontactform"] == "yes") || (!empty($dreamvilla_options['displayadvertisement']) && $dreamvilla_options["displayadvertisement"] == "yes") || (!empty($dreamvilla_options['displaypropertyvideo']) && $dreamvilla_options["displaypropertyvideo"] == "yes") || (!empty($dreamvilla_options['displaysimilarproperty']) && $dreamvilla_options["displaysimilarproperty"]=="yes") ) { ?>
				<div class="col-lg-4 col-md-4">
					<?php
					if(!empty($dreamvilla_options['displaypropertyfilter']) && $dreamvilla_options["displaypropertyfilter"] == "yes") {
						echo '<div class="property-detail-filter">';
							the_widget( 'Dreamvilla_MP_PropertyFilter', 'title='.$dreamvilla_options['titlepropertyfilter'] );
						echo '</div>';
					}

					$Property_Agent = get_post_meta( $post->ID, 'pagent', true ); ?>
					<div class="agent-contact-sidebar">
						<?php if(!empty($dreamvilla_options['displayagentinfo']) && $dreamvilla_options["displayagentinfo"]=="yes" && $Property_Agent && !empty($Property_Agent)){ ?>
						<div class="agent-profile-sidebar">
							<img src="<?php echo esc_url( wp_get_attachment_url( get_the_author_meta( 'profile_image_id', $Property_Agent ) ) ); ?>" alt="<?php echo esc_attr(get_the_author_meta( 'fullname', $Property_Agent ));?>" />
							<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'),get_the_author_meta( 'fullname', $Property_Agent )); ?></h4>
							<p><?php printf( esc_html__("%s","dreamvilla-multiple-property"), $dreamvilla_options["agentofpropertytitle"]) ?></p>
						</div>
						<div class="agent-contact-detail-sidebar">
							<p><i class="fa fa-phone"> </i> <?php printf(esc_html__('%s','dreamvilla-multiple-property'),get_the_author_meta( 'phone', $Property_Agent )); ?></p>
							<?php $User_Detail = get_userdata( $Property_Agent ); ?>
							<p><i class="fa fa-envelope-o"></i><a href="mailto:<?php echo antispambot(sanitize_email($User_Detail->user_email),1); ?>"><?php printf(esc_html__('%s','dreamvilla-multiple-property'), $User_Detail->user_email); ?></a></p>
						</div>
						<?php }
						if(!empty($dreamvilla_options['displaycontactform']) && $dreamvilla_options["displaycontactform"] == "yes"){

							if( !empty($dreamvilla_options['show_google_recaptcha'] ) ){
								$show_google_recaptcha = $dreamvilla_options['show_google_recaptcha'];
							}
							if( !empty($dreamvilla_options['google_recaptcha_site_key'] ) ){
								$google_recaptcha_site_key = $dreamvilla_options['google_recaptcha_site_key'];
							}

							if( !empty($google_recaptcha_site_key) && $show_google_recaptcha == "yes" ){
								$google_recaptcha = '<div id="single-property"></div>';
							} else {
								$google_recaptcha = '';
							} ?>

						<div class="agent-contact-form-sidebar">
							<h5><?php printf(esc_html__('%s','dreamvilla-multiple-property'), $dreamvilla_options["contactformtitledetail"]);?></h5>
							<div class="inner-page-shortcodes" id="propety-agent-contact-area" style="margin:0;"><div class="message_area_bottom"></div></div>
							<form id="single-propety-agnet-send-message" name="contact_form" method="POST" >
								<input type="text" id="fname" name="full_name" class="full_name" placeholder="<?php esc_html_e("Nombre completo","dreamvilla-multiple-property"); ?>" required />
								<input type="text" id="pnumber" name="p_number" class="p_number" placeholder="<?php esc_html_e("Numero de telefono","dreamvilla-multiple-property"); ?>" required />
								<input type="email" id="emailid" name="email_address" class="email_address" placeholder="<?php esc_html_e("Correo electronico","dreamvilla-multiple-property"); ?>" required />
								<textarea placeholder="<?php esc_html_e("Mensaje","dreamvilla-multiple-property"); ?>" name="message" class="message" required></textarea>
								<?php printf( esc_html__('%s','dreamvilla-multiple-property'),$google_recaptcha); ?>
								<?php $User_Detail = get_userdata( $Property_Agent ); ?>
								<input type="hidden" name="agent_email_address" class="agent_email_address" value="<?php echo esc_attr($User_Detail->user_email); ?>" >
								<input type="submit" name="sendmessage" class="multiple-send-message" value="<?php if( !empty($dreamvilla_options['submitrequesttitle']) ){  printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['submitrequesttitle'] ); } else { esc_html_e('Enviar Ahora','dreamvilla-multiple-property'); } ?>" />
							</form>
						</div>
						<?php } ?>
					</div>

					<?php if ( !empty($dreamvilla_options['displaysidebar']) && $dreamvilla_options['displaysidebar'] == 'yes' ) { ?>
						<?php if ( is_active_sidebar( 'property_detail_sidebar' ) ) : ?>
							<div class="blog_page_information">
								<div id="primary-sidebar " class="primary-sidebar widget-area" role="complementary">
									<?php dynamic_sidebar( 'property_detail_sidebar' ); ?>
								</div><!-- #primary-sidebar -->
							</div>
						<?php endif; ?>
					<?php } ?>
					<?php
					if(!empty($dreamvilla_options['displayadvertisement']) && $dreamvilla_options["displayadvertisement"] == "yes") {
						$PropertyAdvertisement = get_post_meta( $post->ID, 'padvertisement',true); ?>
					<div class="advertisement-sidebar">
						<?php printf( esc_html__('%s','dreamvilla-multiple-property'),$PropertyAdvertisement); ?>
					</div>
					<?php } ?>

					<?php if(!empty($dreamvilla_options['displaypropertyvideo']) && $dreamvilla_options["displaypropertyvideo"] == "yes") { ?>
					<div class="property-video-sidebar">
						<h4 class="similar-properties"><?php printf(esc_html__('%s','dreamvilla-multiple-property'), $dreamvilla_options["propertyvideotitle"]);?></h4>
						<iframe width="560" height="315" src="<?php echo esc_url(get_post_meta($post->pvideourl)); ?>"
						frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
						</iframe>
					</div>
					<?php } ?>

					<?php if(!empty($dreamvilla_options['displaysimilarproperty']) && $dreamvilla_options["displaysimilarproperty"]=="yes") { ?>
					<div class="recent-proeprties-sidebar">
						<h4 class="similar-properties"><?php printf(esc_html__('%s','dreamvilla-multiple-property'), $dreamvilla_options["similarpropertytitle"]);?></h4>
						<?php
						$args = array(
										'post_type'			=> 'property',
										'posts_per_page' 	=> -1,
										'exclude' 			=> array( $post->ID ),
										'tax_query' 		=> array(
																	    array(
																	      'taxonomy' 	=> 'property_category',
																	      'field' 		=> 'slug',
																	      'terms' 		=> wp_get_post_terms($post->ID, 'property_category', array("fields" => "names"))
																	    ),
																	'suppress_filters' 	=> 0
										  						)
								);

						$recent_property_list = get_posts($args);
						if( $recent_property_list ){ ?>
						<div id="myCarousel1" class="carousel slide" data-ride="carousel" data-interval="false">
							<div class="carousel-inner" role="listbox"><?php
								$i = 0;
								foreach( $recent_property_list as $property ){
									if( $i % 2 == 0 ){ ?>
										<div class="multiple-recent-properties item <?php if($i==0) echo "active"; ?>">
									<?php } ?>
										<div class="multiple-recent-properties-item">
											<div class="image-with-label">
												<img class="img-responsive" alt="recent-properties-1" <?php echo dreamvilla_mp_get_device_image( $property->ID ); ?>>
												<label>
													<?php
													$property_status = get_post_meta( $property->ID, 'pstatus', true );
													if ( $property_status == "sale" ){
														printf( esc_html__('Venta','dreamvilla-multiple-property'));
													} else {
														printf( esc_html__('Alquiler','dreamvilla-multiple-property'));
													} ?>
												</label>
											</div>
											<a href="<?php echo esc_url(get_permalink($property->ID)); ?>"><h6><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$property->post_title); ?></h6></a>
											<span class="recent-properties-address"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $property->ID, 'pcountry', true )); if( get_post_meta( $property->ID, 'pcountry', true ) && get_post_meta( $property->ID, 'pstate', true ) ){ echo " / "; } printf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $property->ID, 'pstate', true )); ?></span>
											<p class="recent-properties-price">
												<?php
												$property_price = get_post_meta( $property->ID, 'pprice', true );
												if( $property_price[0] ){
													if( $property_status == "sale" ){
														printf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
													} else {
														printf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
														echo '<span class="price-label">';
															printf( esc_html__(' / %s','dreamvilla-multiple-property'),strtoupper($property_price[1]));
														echo '</span>';
													}
												} ?>
											</p>
										</div>
									<?php  if( $i % 2 == 1 ) { ?>
										</div>
								<?php }
									$i++;
								}
								if( $i % 2 == 1 ) { echo "</div>"; } ?>
							</div>

							<div class="left-right-arrow">
							  <a class="left carousel-control" href="#myCarousel1" role="button" data-slide="prev">
							  	<img class="pull-left" alt="arrow left" src="<?php echo esc_url(get_template_directory_uri());?>/images/left-arrow.png">
							  </a>
							  <a class="right carousel-control" href="#myCarousel1" role="button" data-slide="next">
							    <img class="pull-right" alt="arrow right" src="<?php echo esc_url(get_template_directory_uri());?>/images/right-arrow.png">
							  </a>
							</div>
						</div>
						<?php } ?>
					</div>
					<?php } ?>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
<?php } else { ?>
<header>
	<div class="inner-page-header-area <?php if( !empty($dreamvilla_options['dreamvilla_header_variation']) && $dreamvilla_options['dreamvilla_header_variation'] == 2 ) { echo "v1"; } ?>">
		<?php
		$PropertyBanner = get_post_meta( $post->ID, 'propertybannerimage', true );
		if( isset($PropertyBanner) && !empty($PropertyBanner) ){ ?>
	  		<img src="<?php echo esc_attr($PropertyBanner); ?>" alt="Banner Image"><?php
	  	}

	  	$dreamvilla_options = get_option('dreamvilla_options');

	  	$class = $class2 = "";
		if( !empty($dreamvilla_options['dreamvilla_header_variation']) && $dreamvilla_options['dreamvilla_header_variation'] == 2 ) {
			$class = "inner_slider_text_2";
		} else {
			$class2 = "property_info_header";
		} ?>
		<div class="container">
	     	<div class="inner_slider_text <?php echo $class; ?>">
	      		<div class="<?php echo $class2; ?>">
		       		<h2><span><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$post->post_title); ?></span></h2>
     				<h5><span><a href="<?php echo esc_url( home_url( '/' )); ?>"><?php esc_html_e('Home','dreamvilla-multiple-property'); ?></a> >
		       			<?php printf( esc_html__('%s','dreamvilla-multiple-property'),$post->post_title); ?></span></h5>
				</div>
			</div>
		</div>
	</div>
</header>
<section>
	<div class="property-detail">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-8 property-detail-inner">
					<div class="inner-page-property-details-header-area property-detail2">
						<div class="property-detail-banner">
							<div class="header_slider_container">
								<div id="bannerCarousel" class="carousel slide" data-ride="carousel">
									<div class="carousel-inner" role="listbox">
										<?php
										$PropertyGallery = get_post_meta( $post->ID, 'propertygallery', true );
										if( $PropertyGallery ){
											$i=0;
											foreach ($PropertyGallery as $key => $value) {
												$i++;
												if( $PropertyGallery[$key]['pgallery'] ){ ?>
													<div class="item <?php if($i==1) { echo "active"; } ?>">
														<img alt="banner-image" class="img-responsive image_header" src="<?php echo esc_url($PropertyGallery[$key]['pgallery']); ?>">
													</div><?php
												} /* End of if for banner image*/
											} /* End of for each loop*/
										} /*End of property gallery condition*/ ?>
									</div>

									<?php if( $PropertyGallery ){ ?>

											<?php $PropertyFetured = get_post_meta( $post->ID, 'pfetured', true);
												if( $PropertyFetured == "yes" ){ ?>
													<span class="featured-property-icon" href="javascript:void(0)"><i class="fa fa-star"></i>
														<span class="textfeatured">Destacado</span>
													</span>
											<?php
												}?>

											<ol class="carousel-indicators"> </ol>
									<?php } ?> <!-- End of property gallery condition -->
								</div>
							</div>
							<div class="property-detail-info v1">
								<div class="">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-12"><?php
												if($post->post_title && $post->post_title != "") { ?>
													<h1 class="property-detail-info-title"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$post->post_title); ?></h1><?php
												} ?>
												<label class="property_type">
													<?php
													$property_status = get_post_meta( $post->ID, 'pstatus', true );
													if ( $property_status == "sale" ){
														printf( esc_html__('Venta','dreamvilla-multiple-property'));
													} else {
														printf( esc_html__('Alquiler','dreamvilla-multiple-property'));
													} ?>
												</label>	<?php

												$property_status_list = wp_get_post_terms($post->ID, 'property_status' );
												if( !empty($property_status_list[0]->term_id) && $property_status_list[0]->slug != "normal" ){ ?>
													<span class="featured-proeprty-label"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$property_status_list[0]->name ); ?></span><?php
												}?>


													<?php echo dreamvilla_mp_agent_favorites_property_icon($post->ID); ?>

											</div>
										</div>
										<div class="row">
											<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
											<?php if(get_post_meta( $post->ID, 'pcountry', true ) != "" || get_post_meta( $post->ID, 'pstate', true )) { ?>
											<p class="property-detail-address"><i class="fa fa-map-marker"> </i><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $post->ID, 'pcountry', true )); ?> / <?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $post->ID, 'pstate', true )); ?></p>
											<?php } ?>
											<div class="row property-detail-facility">
												<?php $property_price = get_post_meta( $post->ID, 'pprice', true );
													if($property_price[0] && $property_price[0] !="" ){
												?>
												<div class="col-xs-12 col-sm-3 col-md-3">
													<?php if( $property_price[0] ){ ?>
													<label class="property-detail-price">
														<?php
														if( $property_status == "sale" ){
															printf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
														} else {
															printf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
															echo '<span class="price-label">';
																printf( esc_html__(' / %s','dreamvilla-multiple-property'),strtoupper($property_price[1]));
															echo '</span>';
														} ?>
													</label>
													<?php } ?>
												</div>
												<?php }?>
												<?php if(dreamvilla_mp_number_of_bathroom($post->ID) != "" && dreamvilla_mp_number_of_bathroom($post->ID) > 0){ ?>
													<div class="col-xs-12 col-sm-3 col-md-3 property-detail-facility-icon">
														<img src="<?php echo get_template_directory_uri(); ?>/images/recent_bath.png" alt="Recent Bath" />
														<label><?php esc_html_e('Baños','dreamvilla-multiple-property'); ?></label><span><?php printf( esc_html__('%s','dreamvilla-multiple-property'),dreamvilla_mp_number_of_bathroom($post->ID)); ?></span></div>
												<?php } if(dreamvilla_mp_number_of_bedroom($post->ID) != "" && dreamvilla_mp_number_of_bedroom($post->ID) > 0){ ?>
													<div class="col-xs-12 col-sm-3 col-md-3 property-detail-facility-icon">
														<img src="<?php echo get_template_directory_uri(); ?>/images/recent_bed.png" alt="Recent Bed" />
														<label><?php esc_html_e('Habitaciones','dreamvilla-multiple-property'); ?></label><span><?php printf( esc_html__('%s','dreamvilla-multiple-property'),dreamvilla_mp_number_of_bedroom($post->ID)); ?></span></div>
												<?php } if(get_post_meta( $post->ID, 'pnoofgarage', true) != "" && get_post_meta( $post->ID, 'pnoofgarage', true) > 0){ ?>
													<div class="col-xs-12 col-sm-3 col-md-3 property-detail-facility-icon">
														<img src="<?php echo get_template_directory_uri(); ?>/images/recent_garage.png" alt="Recent Garage" />
														<label><?php esc_html_e('Garajes','dreamvilla-multiple-property'); ?></label><span><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $post->ID, 'pnoofgarage', true)); ?></span></div>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php if(!empty($dreamvilla_options['displaydescription']) && $dreamvilla_options["displaydescription"] == "yes"){ ?>
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<h4 class="property-description">
								<?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options["descriptiontitle"]);?>
								<a class="print-document" href="javascript:window.print()">
									<img src="<?php echo get_template_directory_uri(); ?>/images/print.png" alt="Print This Page" />
									<?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options["printtitle"]); ?>
								</a>
							</h4>
							<p><?php the_content(); ?></p>
						</div>
					</div><?php
					}

					$PropertyEssential = get_post_meta( $post->ID, 'essentialinformation', true );
					if( ( !empty($dreamvilla_options['displayessentialinformation']) && $dreamvilla_options["displayessentialinformation"] == "yes" && !empty($PropertyEssential) ) || ( !empty($dreamvilla_options['displayamenities']) && $dreamvilla_options["displayamenities"] == "yes" ) ){ ?>
					<div class="row"><?php
						if(!empty($dreamvilla_options['displayessentialinformation']) && $dreamvilla_options['displayessentialinformation'] == "yes" && !empty($PropertyEssential)){ ?>
							<div class="col-lg-6 col-md-6">
								<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options["essentialinformationtitle"]);?></h4>
								<div class="row"><?php
									if( $PropertyEssential ){
										foreach ($PropertyEssential as $key => $value) { ?>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-label"><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$PropertyEssential[$key]['essentialtitle']); ?></div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-value"><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$PropertyEssential[$key]['essentialvalue']); ?></div><?php
										}
									} ?>
								</div>
							</div><?php
						}
						if(!empty($dreamvilla_options['displayamenities']) && $dreamvilla_options["displayamenities"] == "yes") { ?>
						<div class="col-lg-6 col-md-6">
							<?php
							$PropertyAmenities = get_post_meta( $post->ID, 'propertyamenities', true );
							if( $PropertyAmenities ){ ?>
								<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'), $dreamvilla_options["amenitiestitle"]); ?></h4>
								<div class="row amenities-info"><?php
									foreach ( $PropertyAmenities as $key => $value ) { ?>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="information-label"><img src="<?php echo esc_url($PropertyAmenities[$key]['pamenitiesphoto']); ?>" alt="amenities-icon"/></div>
											<div class="information-value"><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$PropertyAmenities[$key]['pamenities']); ?></div>
										</div><?php
									} ?>
								</div><?php
							} ?>
						</div>
						<?php } ?>
					</div>
					<?php } ?>
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<?php
							$PropertyInterior = get_post_meta( $post->ID, 'pinteriorarray', true );
							if(!empty($dreamvilla_options['displayinterior']) && $dreamvilla_options['displayinterior']=="yes" && !empty($PropertyInterior)){ ?>
								<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'), $dreamvilla_options["interiortitle"]);?></h4>
								<div class="row"><?php
									if( $PropertyInterior ){
										foreach ($PropertyInterior as $key => $value) { ?>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-label"><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$PropertyInterior[$key]['interiortitle']); ?></div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-value"><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$PropertyInterior[$key]['interiordescription']); ?></div><?php
										}
									} ?>
								</div><?php
							}

							$PropertyExterior = get_post_meta( $post->ID, 'pexteriorarray', true );
							if(!empty($dreamvilla_options['displayexterior']) && $dreamvilla_options["displayexterior"]=="yes" && !empty($PropertyExterior)){ ?>
								<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options["exteriortitle"]);?></h4>
								<div class="row"><?php
									if( $PropertyExterior ){
										foreach ($PropertyExterior as $key => $value) { ?>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-label"><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$PropertyExterior[$key]['exteriortitle']); ?></div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-value"><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$PropertyExterior[$key]['exteriordescription']); ?></div><?php
										}
									} ?>
								</div><?php
							}

							$PropertyFlooring = get_post_meta( $post->ID, 'pflooring', true);
							if( !empty($dreamvilla_options['displayflooring']) && $dreamvilla_options["displayflooring"] == "yes" && $PropertyFlooring && !empty($PropertyFlooring)){ ?>
								<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'), $dreamvilla_options["flooringtitle"]);?></h4>
								<div class="row">
									<div class="col-lg-12 col-md-12">
										<p><?php printf(esc_html__("%s","dreamvilla-multiple-property"),$PropertyFlooring)?></p>
									</div>
								</div>
							<?php } ?>
						</div>
						<div class="col-lg-6 col-md-6">
							<?php
							$RoomDetails 			= get_post_meta( $post->ID, 'propertyroom', true );
							$KitchenDetails 		= get_post_meta( $post->ID, 'propertykitchen', true );
							$BathroomDetails 		= get_post_meta( $post->ID, 'propertybathroom', true );
							$GymDetails 			= get_post_meta( $post->ID, 'propertygym', true );
							$SwimmingPoolDetails 	= get_post_meta( $post->ID, 'propertyswimmingpool', true );

							if(!empty($dreamvilla_options['displayroomdimensions']) && $dreamvilla_options["displayroomdimensions"] == "yes" && ( !empty($RoomDetails) || !empty($KitchenDetails) || !empty($BathroomDetails) || !empty($GymDetails) || !empty($SwimmingPoolDetails) )) {?>
								<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'), $dreamvilla_options["roomdimensionstitle"]); ?></h4>
								<div class="row">
									<?php
									$RoomType 		= dreamvilla_mp_get_room_type();
									$BedroomCounter = 0;

									if( empty($KitchenDetails) ){
								    	$KitchenDetails[0]['pkitchensize'] = '';
								    }

								    if( empty($BathroomDetails) ){
								    	$BathroomDetails[0]['pbathroomsize'] = '';
								    }

								    if( empty($GymDetails) ){
								    	$GymDetails[0]['pgymsize'] = '';
								    }

								    if( empty($SwimmingPoolDetails) ){
								    	$SwimmingPoolDetails[0]['pswimmingpoolsize'] = '';
								    }

									if( $RoomDetails ){
										foreach ($RoomDetails as $key => $value) {

											if( $value['proomtype'] == 'Bedroom' ){ $BedroomCounter++; ?>
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-label"><?php esc_html_e('Habitación','dreamvilla-multiple-property'); echo ' '.$BedroomCounter; ?></div>
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-value"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$value['proomsize']); ?> </div><?php
											}

											if( $value['proomtype'] != 'Bedroom'){
												if( $RoomType[$value['proomtype']] == 'Master Bedroom' ){ ?>
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-label"><?php esc_html_e('Habitación principal','dreamvilla-multiple-property'); ?></div><?php
												}

												if( $RoomType[$value['proomtype']] == 'Living Room' ){ ?>
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-label"><?php esc_html_e('Sala','dreamvilla-multiple-property'); ?></div><?php
												}

												if( $RoomType[$value['proomtype']] == 'Dining Room' ){ ?>
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-label"><?php esc_html_e('Comedor','dreamvilla-multiple-property'); ?></div><?php
												} ?>

												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-value"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$value['proomsize']); ?> </div><?php
											}
										}
									}
									if( $KitchenDetails[0]['pkitchensize'] ) { ?>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-label"><?php esc_html_e('Cocina','dreamvilla-multiple-property'); ?> </div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-value"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$KitchenDetails[0]['pkitchensize']); ?> </div><?php
									}

									/*if( $BathroomDetails[0]['pbathroomsize'] ) { ?>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-label"><?php esc_html_e('Bathroom','dreamvilla-multiple-property'); ?> </div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-value"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$BathroomDetails[0]['pbathroomsize']); ?></div><?php
									}*/

									if( $BathroomDetails) {
										foreach($BathroomDetails as $key => $value) {?>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-label"><?php esc_html_e('Baño','dreamvilla-multiple-property'); ?> </div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-value"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$BathroomDetails[$key]['pbathroomsize']); ?></div><?php
										}
									}

									if( $GymDetails[0]['pgymsize'] ) { ?>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-label"><?php esc_html_e('Gimnasio','dreamvilla-multiple-property'); ?> </div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-value"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$GymDetails[0]['pgymsize']); ?></div><?php
									}

									if( $SwimmingPoolDetails[0]['pswimmingpoolsize'] ) { ?>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-label"><?php esc_html_e('Piscina','dreamvilla-multiple-property'); ?> </div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 information-value"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$SwimmingPoolDetails[0]['pswimmingpoolsize']); ?></div><?php
									} ?>
								</div><?php
							}

							$PropertyGoodsIncluded = get_post_meta( $post->ID, 'pgoodsincluded', true);
							if(!empty($dreamvilla_options['displaygoodsinclude']) && $dreamvilla_options["displaygoodsinclude"]=="yes" && !empty($PropertyGoodsIncluded)){

								if($PropertyGoodsIncluded && $PropertyGoodsIncluded!=''){ ?>

									<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'), $dreamvilla_options["goodsincludetitle"]);?></h4>
									<div class="row">
										<div class="col-lg-12 col-md-12">
											<p><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$PropertyGoodsIncluded); ?></p>
										</div>
									</div><?php
								}
							} ?>
						</div>
					</div>
					<?php
					$PropertyFloors = get_post_meta( $post->ID, 'propertyfloors', true );
					if(!empty($dreamvilla_options['displayfloorplan']) && $dreamvilla_options["displayfloorplan"] == "yes" && !empty($PropertyFloors)) { ?>
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options["floorplantitle"]);?></h4>

							<?php
							$floor_counter = 0;
							if( $PropertyFloors ){
								foreach ($PropertyFloors as $key => $value) { ?>
									<div class="inner-page-gallery-two-columns-dimension-btn show-hide-btn">
										<?php if( $floor_counter == 0 ){ ?>
											<a class="active" data-id="<?php echo esc_attr($key); ?>"><?php echo esc_html($PropertyFloors[$key]['floortitle']); ?></a>
										<?php } else { ?>
											<a data-id="<?php echo esc_attr($key); ?>"><?php echo esc_html($PropertyFloors[$key]['floortitle']); ?></a>
										<?php }
										$floor_counter++; ?>
									</div>
								<?php }
								foreach ($PropertyFloors as $key => $value) { ?>
									<div id="<?php echo esc_attr($key); ?>" class="<?php echo esc_attr($key); ?> inner-page-gallery-two-columns-dimension-detail show-hide-detail">
										<img class="theme_favicon_icon" width="25%" alt="Floor Plan" src="<?php echo esc_attr($PropertyFloors[$key]['floorplanimage']); ?>">
										<div class="floorplan_options">
											<span><?php echo esc_html($PropertyFloors[$key]['floorsqrt']); ?> sq/ft</span>
											<span><?php echo esc_html($PropertyFloors[$key]['floorbedrooms']); esc_html_e(' Habitaciones','dreamvilla-multiple-property'); ?></span>
											<span><?php echo esc_html($PropertyFloors[$key]['floorbathrooms']); esc_html_e(' Baños','dreamvilla-multiple-property'); ?> </span>
											<span class="floor-plan-price"><?php echo esc_html($PropertyFloors[$key]['floorprice']); ?></span>
										</div>
										<p class="description"><?php echo esc_html($PropertyFloors[$key]['floordetail']); ?></p>
									</div>
								<?php }
							} ?>
						</div>
					</div>
					<?php }

					$DocumentsStatus = get_post_meta( $post->ID, 'pdocumentsstatus', true );
					$Documents = get_post_meta( $post->ID, 'pdocuments', true );

					if(!empty($DocumentsStatus) && $DocumentsStatus['pdocumentsstatus'] == "yes" ) { ?>
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$DocumentsStatus['pdocumentstitle']);?></h4>
							<div class="row"><?php
								if( !empty($Documents) ){ ?>
									<div class="property-documents-area">
										<ul><?php
										foreach ($Documents as $Documentskey => $Documentsvalue) { ?>
											<li><a target="_blank" href="<?php if( !empty($Documents[$Documentskey]['pdocumentslink']) ){ echo esc_attr($Documents[$Documentskey]['pdocumentslink']); } ?>"><span><?php if( !empty($Documents[$Documentskey]['pdocumentslabel']) ){ echo esc_attr($Documents[$Documentskey]['pdocumentslabel']); } ?></span><i class="fa fa-cloud-download"></i></a></li><?php
										} ?>
										</ul>
									</div><?php
								} ?>
							</div>
						</div>
					</div>
					<?php }

					$property_lat_lon = get_post_meta( $post->ID, 'platlon', true );
					$google_place = get_post_meta( $post->ID, 'google_near_by_place', true );
					$google_custom_place = get_post_meta( $post->ID, 'google_near_by_custom_place', true );

					if(!empty($dreamvilla_options['displaynearbyplaces']) && $dreamvilla_options["displaynearbyplaces"] == "yes" && !empty($property_lat_lon) && (!empty($google_place) || !empty($google_custom_place)) ) { ?>
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options["nearybyplacestitle"]);?></h4>
							<div class="row">
								<div class="col-md-6 col-sm-12 col-xs-12" id="near-by-place-detail"> </div>
								<div class="col-md-6 col-sm-12 col-xs-12 near-location-map">
									<div class="near-location-map">
										<div id="googleMapNearestPlaces" style="width:100%;height:100%;"> </div>
									</div>
								</div>
								<?php
								if(isset($post)){
									$property_lat_lon = get_post_meta( $post->ID, 'platlon', true );
								}
								$map_radius = $dreamvilla_options["map_radius"];

								if( empty($map_radius) ){
									$map_radius = 5000;
								}

								$distancenearbyplaces = $dreamvilla_options['distancenearbyplaces'];

								$PlaceArray = $PlacePlaceArray = $PlaceLabelArray = $PlaceIconArray = '';

								$google_place = get_post_meta( $post->ID, 'google_near_by_place', true );
								if( $google_place != "" ){
									foreach ($google_place as $key => $value) {
										$PlaceArray 		.= "'".$google_place[$key]['google_near_by_place_type']."', ";
										$PlacePlaceArray 	.= $google_place[$key]['google_near_by_place_type'].",";
										$PlaceLabelArray 	.= $google_place[$key]['google_near_by_place_label'].",";
										$PlaceIconArray 	.= $google_place[$key]['google_near_by_place_icon'].",";
									}
								}

								$google_custom_place = get_post_meta( $post->ID, 'google_near_by_custom_place', true );

								$CustomPlaceLabelArray = $CustomPlaceDetailArray = $CustomPlaceLatitudeArray = $CustomPlaceLongitudeArray = $CustomPlaceIconArray = '';

								if($google_custom_place) {
									foreach ($google_custom_place as $key => $value) {
										$CustomPlaceLabelArray 		.= $google_custom_place[$key]['google_near_by_custom_place_label'].",";
										$CustomPlaceDetailArray 	.= $google_custom_place[$key]['google_near_by_custom_place_detail'].",";
										$CustomPlaceLatitudeArray 	.= $google_custom_place[$key]['google_near_by_custom_place_latitude'].",";
										$CustomPlaceLongitudeArray 	.= $google_custom_place[$key]['google_near_by_custom_place_longitude'].",";
										$CustomPlaceIconArray 		.= $google_custom_place[$key]['google_near_by_custom_place_icon'].",";
									}
								} ?>
								<script>
									jQuery(document).ready(function(){
										var image_src = "<?php echo esc_js(get_template_directory_uri()); ?>";
										var map;
										var infowindow;
										var bounds = new google.maps.LatLngBounds();

										var PlaceArray 		= [ <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$PlaceArray); ?> ];
										var PlacePlaceArray = '<?php echo esc_js($PlacePlaceArray); ?>'.split(',');
										var PlaceLabelArray = '<?php echo esc_js($PlaceLabelArray); ?>'.split(',');
										var PlaceIconArray 	= '<?php echo esc_js($PlaceIconArray); ?>'.split(',');
										var PlaceCounter 	= 0;

										var CustomPlaceLabelArray = '';
										var CustomPlaceDetailArray = '';
										var CustomPlaceLatitudeArray = '';
										var CustomPlaceLongitudeArray = '';
										var CustomPlaceIconArray = '';

										CustomPlaceLabelArray 		= '<?php echo esc_js($CustomPlaceLabelArray); ?>'.split(',');
										CustomPlaceDetailArray 		= '<?php echo esc_js($CustomPlaceDetailArray); ?>'.split(',');
										CustomPlaceLatitudeArray 	= '<?php echo esc_js($CustomPlaceLatitudeArray); ?>'.split(',');
										CustomPlaceLongitudeArray 	= '<?php echo esc_js($CustomPlaceLongitudeArray); ?>'.split(',');
										CustomPlaceIconArray 		= '<?php echo esc_js($CustomPlaceIconArray); ?>'.split(',');

										var PlaceDetail = [];
									    for (var n = 0; n < PlacePlaceArray.length; n++) {
									        PlaceDetail[PlacePlaceArray[n]] = [PlaceLabelArray[n],PlaceIconArray[n]];
									    }

										function initialize() {
											"use strict";
											var pyrmont = new google.maps.LatLng("<?php echo esc_js($property_lat_lon[0]); ?>","<?php echo esc_js($property_lat_lon[1]); ?>");

											map = new google.maps.Map(document.getElementById('googleMapNearestPlaces'), {
												center: pyrmont,
												zoom: 14,
												icon:'<?php echo esc_js(get_template_directory_uri()); ?>/images/map_marker.png',
												scrollwheel: false,
												rankby: 'distance',
												styles: <?php echo $dreamvilla_options["dreamvilla_map_style"]; ?>
											});

											var marker=new google.maps.Marker({position:pyrmont,icon:'<?php echo esc_js(get_template_directory_uri()); ?>/images/map_marker.png'});
											marker.setMap(map);
											var request = {
												location: pyrmont,
												radius: '<?php echo esc_js($map_radius); ?>',
												types: [ <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$PlaceArray); ?> ],
											};

											infowindow = new google.maps.InfoWindow();
											var service = new google.maps.places.PlacesService(map);
											service.nearbySearch(request, dreamvilla_mp_callback);

											// Display multiple markers on a map
								   		 	var infoWindow = new google.maps.InfoWindow(), marker, i;

										    // Loop through our array of markers & place each one on the map
										    for( i = 0; i < CustomPlaceLabelArray.length; i++ ) {
										    	if(CustomPlaceLatitudeArray[i]  && CustomPlaceLatitudeArray[i]!=""){

										    		var Distance = dreamvilla_mp_distance(CustomPlaceLatitudeArray[i],CustomPlaceLongitudeArray[i]);

										    		jQuery("#near-by-place-detail").append("<div class='near-location-info'><ul><li class='right'>"+CustomPlaceLabelArray[i]+"</li><li class='left'>"+Distance+" "+distance_in+"</li></ul><span>"+CustomPlaceDetailArray[i]+"</span></div>");

											        var position = new google.maps.LatLng(CustomPlaceLatitudeArray[i], CustomPlaceLongitudeArray[i]);
											        bounds.extend(position);
											        marker = new google.maps.Marker({
											            position: position,
											            map: map,
											            title: CustomPlaceLabelArray[i],
														icon:CustomPlaceIconArray[i]
											        });

											        // Allow each marker to have an info window
											        google.maps.event.addListener(marker, 'click', (function(marker, i) {
											            return function() {
											                infoWindow.setContent(CustomPlaceDetailArray[i]);
											                infoWindow.open(map, marker);
											            }
											        })(marker, i));

											        // Automatically center the map fitting all markers on the screen
											        map.fitBounds(bounds);
												}
										    }
										}

										function dreamvilla_mp_callback(results, status) {
											"use strict";
											if (status == google.maps.places.PlacesServiceStatus.OK) {
												for (var i = 0; i < results.length; i++) {
													dreamvilla_mp_createMarker(results[i]);
												}
											}
										}

										var distance_in = "<?php echo esc_js($distancenearbyplaces); ?>";
										var Place_Counter = 0;
										function dreamvilla_mp_createMarker(place) {
											"use strict";

											var PlaceType 	= "";
											jQuery.each( place.types, function( key, value ) {
											  if( jQuery.inArray( value, PlaceArray ) != -1 ){
											  		PlaceType = value;
											  }
											});

											if(PlaceType==""){
												return;
											}

											PlaceArray = jQuery.grep(PlaceArray, function(value) {
											  return value != PlaceType;
											});

											Place_Counter ++;

											var Distance = dreamvilla_mp_distance(place.geometry.location.lat(),place.geometry.location.lng());

											var place_label = PlaceDetail[PlaceType][0];
											var place_icon 	= PlaceDetail[PlaceType][1];

											jQuery("#near-by-place-detail").append("<div class='near-location-info'><ul><li class='right'>"+place_label+"</li><li class='left'>"+Distance+" "+distance_in+"</li></ul><span>"+place.name+"</span></div>");

											var placeLoc = place.geometry.location;
											var marker = new google.maps.Marker({
												map: map,
												position: place.geometry.location,
												icon:place_icon,
											});

											google.maps.event.addListener(marker, 'click', function() {
												infowindow.setContent(place.name);
												infowindow.open(map, this);
											});

											bounds.extend(marker.position);

											//now fit the map to the newly inclusive bounds
											map.fitBounds(bounds);

											//(optional) restore the zoom level after the map is done scaling
											var listener = google.maps.event.addListener(map, "idle", function () {
											    map.setZoom(12);
											    google.maps.event.removeListener(listener);
											});

										}
										google.maps.event.addDomListener(window, 'load', initialize);

										function dreamvilla_mp_distance(latitude2, longitude2) {
											var lat1 = "<?php echo esc_js($property_lat_lon[0]); ?>";
											var lon1 = "<?php echo esc_js($property_lat_lon[1]); ?>";
											var lat2 = latitude2;
    										var lon2 = longitude2;

											var radlat1 = Math.PI * lat1/180;
											var radlat2 = Math.PI * lat2/180;
											var radlon1 = Math.PI * lon1/180;
											var radlon2 = Math.PI * lon2/180;
											var theta = lon1-lon2;
											var radtheta = Math.PI * theta/180;
											var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
											dist = Math.acos(dist);
											dist = dist * 180/Math.PI;
											dist = dist * 60 * 1.1515;

											if( distance_in == "km" ){
												dist = dist * 1.609344;
											}

											return Math.round( dist * 100 )/100;
										}
									});
								</script>
							</div>
						</div>
					</div>
					<?php }
					$property_lat_lon = get_post_meta( $post->ID, 'platlon', true );
					if(!empty($dreamvilla_options['displaygetdirections']) && $dreamvilla_options["displaygetdirections"] == "yes" && !empty($property_lat_lon)) { ?>
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="get-direction">
								<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'), $dreamvilla_options["getdirectionstitle"]);?></h4>
								<div id="GoogleMapGetDirections" style="width:100%;height:285px;"></div>
								<form>
									<input type="text" id="GetDirectionsAddress" placeholder="<?php esc_html_e("Dirección","dreamvilla-multiple-property"); ?>" />
									<button type="button" id="GetDirections"><?php printf(esc_html__("%s","dreamvilla-multiple-property"), $dreamvilla_options["getdirectionstitle"]); ?></button>
								</form>
							</div>
							<?php if(isset($post)){
								$property_lat_lon = get_post_meta( $post->ID, 'platlon', true );
							} ?>
							<script>
								jQuery(document).ready(function(){
									// Location detail area load map
									var myCenter = new google.maps.LatLng("<?php echo esc_js($property_lat_lon[0]); ?>","<?php echo esc_js($property_lat_lon[1]); ?>");
									function initialize() {
										var mapProp = {
											center : myCenter,
											zoom : 11,
											mapTypeId : google.maps.MapTypeId.ROADMAP,
											scrollwheel: false,
											styles: <?php echo $dreamvilla_options["dreamvilla_map_style"]; ?>
										};
										var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
										var marker = new google.maps.Marker({
											position : myCenter,
											icon : '<?php echo esc_js(get_template_directory_uri()); ?>/images/map_marker.png',
										});
										marker.setMap(map);
									}

									if(document.getElementById('googleMap') != null ){
										google.maps.event.addDomListener(window, 'load', initialize);
									}

									// Proprty detail page get direction
									function initAutocomplete() {

									    var directionsService = new google.maps.DirectionsService;
									    var directionsDisplay = new google.maps.DirectionsRenderer;

									    var map = new google.maps.Map(document.getElementById('GoogleMapGetDirections'), {
									        center: myCenter,
									        zoom: 11,
									        mapTypeId : google.maps.MapTypeId.ROADMAP,
									        scrollwheel: false,
									        styles: <?php echo $dreamvilla_options["dreamvilla_map_style"]; ?>
									    });

									    var marker = new google.maps.Marker({
									        position : myCenter,
									        icon : '<?php echo esc_js(get_template_directory_uri()); ?>/images/map_marker.png',
									    });
									    marker.setMap(map);

									    directionsDisplay.setMap(map);

									    var onChangeHandler = function() {
									        dreamvilla_mp_calculateAndDisplayRoute(directionsService, directionsDisplay, marker);
									    };

									    document.getElementById('GetDirections').addEventListener('click', onChangeHandler);

									    autocomplete = new google.maps.places.Autocomplete((document.getElementById('GetDirectionsAddress')),{types: ['geocode']});
									}

									function dreamvilla_mp_calculateAndDisplayRoute(directionsService, directionsDisplay, marker) {
									    directionsService.route({
									        origin: myCenter,
									        destination: document.getElementById('GetDirectionsAddress').value,

									        travelMode: google.maps.TravelMode.DRIVING
									        }, function(response, status) {
									        if (status === google.maps.DirectionsStatus.OK) {
									            marker.setVisible(false);
									            directionsDisplay.setDirections(response);
									        } else {
									            window.alert('Directions request failed due to ' + status);
									        }
									    });
									}
									if(document.getElementById('GetDirectionsAddress') != null ){
										google.maps.event.addDomListener(window, 'load', initAutocomplete);
									}
								});
							</script>
						</div>
					</div>
					<?php }

					$property_streetview_lat = get_post_meta( $post->ID, 'streetviewlat', true );
					$property_streetview_lon = get_post_meta( $post->ID, 'streetviewlng', true );

					if(!empty($dreamvilla_options['displaystreeviewmap']) && $dreamvilla_options["displaystreeviewmap"] == "yes" && !empty($property_streetview_lat) && !empty($property_streetview_lon)) { ?>

					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div>
								<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'), $dreamvilla_options["propertystreetviewtitle"]);?></h4>
								<div id="street_view" style="width:100%;height:285px;"></div>
							</div>
							<script>

								jQuery(document).ready(function(){

									function initialize() {

										var fenway = {lat: <?php echo esc_js($property_streetview_lat); ?>, lng: <?php echo esc_js($property_streetview_lon); ?>};

								        var map = new google.maps.Map(document.getElementById('street_view'), {
								        	center: fenway,
								          	zoom: 14,
								        });

								        var panorama = new google.maps.StreetViewPanorama(
								        	document.getElementById('street_view'), {
								            	position: fenway,
								              	pov: {
								                	heading: 34,
								                	pitch: 10
								              	}
								            });
								        map.setStreetView(panorama);
								   	}

								   	if(document.getElementById('street_view') != null ){
										google.maps.event.addDomListener(window, 'load', initialize);
									}
								});
							</script>
						</div>
					</div>
					<?php } ?>

					<?php
					if( $dreamvilla_options['sharepropertystatus'] == "yes" ) {

					// Get current page URL
					$crunchifyURL = get_permalink();

					// Get current page title
					$crunchifyTitle = str_replace( ' ', '%20', get_the_title());

					// Get Post Thumbnail for pinterest
					$crunchifyThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

					// Construct sharing URL without using any script
					$twitterURL = 'https://twitter.com/intent/tweet?text='.$crunchifyTitle.'&amp;url='.$crunchifyURL;
					$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$crunchifyURL;
					$googleURL = 'https://plus.google.com/share?url='.$crunchifyURL;
					$pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$crunchifyURL.'&amp;media='.$crunchifyThumbnail[0].'&amp;description='.$crunchifyTitle;
			 		$bufferURL = 'https://bufferapp.com/add?url='.$crunchifyURL.'&amp;text='.$crunchifyTitle; ?>

					<div class="row">
						<div class="col-lg-12 col-md-12">
							<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['sharepropertylabel']);?></h4>
							<div class="row">
								<ul class="share-property-on-social-media">
									<li><a href="<?php echo $facebookURL; ?>" target="_blank"><i class="fa fa-facebook"></i><?php echo esc_html__('Share on Facebook','dreamvilla-multiple-property'); ?></a></li>
									<li><a href="<?php echo $twitterURL; ?>" target="_blank"><i class="fa fa-twitter"></i><?php echo esc_html__('Share on Twitter','dreamvilla-multiple-property'); ?></a></li>
									<li><a href="<?php echo $googleURL; ?>" target="_blank"><i class="fa fa-google-plus"></i><?php echo esc_html__('Share on Google','dreamvilla-multiple-property'); ?></a></li>
									<li><a href="<?php echo $pinterestURL; ?>" target="_blank"><i class="fa  fa-pinterest-p"></i><?php echo esc_html__('Share on Pinterest','dreamvilla-multiple-property'); ?></a></li>
								</ul>
							</div>
						</div>
					</div>
					<?php }
					$Sub_Property = get_post_meta( $post->ID, 'psubproperty', true );

					if( !empty($Sub_Property) && $dreamvilla_options['displaysubproperty'] == "yes" ) {
						$args = array(
								'post_type'			=> 'property',
								'posts_per_page' 	=> -1,
								'include'			=> $Sub_Property,
								'suppress_filters' 	=> 0
						);

						$i = 0;
						$SubProperty = get_posts($args); ?>
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="agent-recent-properties sub-property">
									<h4><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['subpropertytitle']); ?></h4>
									<div id="property-listing" class="carousel slide property-listing" data-ride="carousel" data-interval="false">
										<div class="carousel-inner" role="listbox"><?php
										foreach ($SubProperty as $key => $value) {
											if( $i % 2 == 0 ){ ?>
											<div class="item <?php if( $i == 0 ){ echo "active"; } ?>">
											<?php } ?>
												<div class="col-xs-12 col-sm-6 col-md-6 no-padding">
													<div class="image-with-label">
														<img <?php echo dreamvilla_mp_get_device_image( $value->ID ); ?> alt="agent-properties" class="img-responsive">
														<label><?php
														$property_status = get_post_meta( $value->ID, 'pstatus', true );
														if ( $property_status == "sale" ){
															printf( esc_html__('Venta','dreamvilla-multiple-property'));
														} else {
															printf( esc_html__('Alquiler','dreamvilla-multiple-property'));
														} ?>
														</label>
													</div>

													<a href="<?php echo esc_url(get_permalink ($value->ID)); ?>"><h6><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$value->post_title); ?></h6></a>

													<?php if( get_post_meta( $value->ID, 'pcountry', true ) || get_post_meta( $value->ID, 'pstate', true ) ){ ?>
														<span class="recent-properties-address"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $value->ID, 'pcountry', true )); if( get_post_meta( $value->ID, 'pcountry', true ) && get_post_meta( $value->ID, 'pstate', true ) ){ echo " / "; } printf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $value->ID, 'pstate', true )); ?></span>
													<?php } ?>

													<p class="recent-properties-price">
														<?php
														$property_price = get_post_meta( $value->ID, 'pprice', true );
														if( $property_price[0] ){
															if( $property_status == "sale" ){
																printf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
															} else {
																printf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
																echo '<span class="price-label">';
																	printf( esc_html__(' / %s','dreamvilla-multiple-property'),strtoupper($property_price[1]));
																echo '</span>';
															}
														} ?>
													</p>
												</div><?php
												$i++;
												if( $i % 2 == 0 && $i != 1 ){ ?>
											</div><?php
											}
										}
										if( $i % 2 == 1 || $i == 1 ){
											echo "</div>";
										} ?>

										</div>
										<?php if( $i > 2 ){ ?>
										<div class="left-right-arrow">
											<a class="left carousel-control" href="#myCarousel1" role="button" data-slide="prev"></a>
										  	<a class="right carousel-control" href="#myCarousel1" role="button" data-slide="next"></a>
										</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div><?php
					} ?>
				</div>

				<?php if( (!empty($dreamvilla_options['displaypropertyfilter']) && $dreamvilla_options["displaypropertyfilter"] == "yes") || (!empty($dreamvilla_options['displayagentinfo']) && $dreamvilla_options["displayagentinfo"]=="yes") || ( !empty($dreamvilla_options['displaycontactform']) && $dreamvilla_options["displaycontactform"] == "yes") || (!empty($dreamvilla_options['displayadvertisement']) && $dreamvilla_options["displayadvertisement"] == "yes") || (!empty($dreamvilla_options['displaypropertyvideo']) && $dreamvilla_options["displaypropertyvideo"] == "yes") || (!empty($dreamvilla_options['displaysimilarproperty']) && $dreamvilla_options["displaysimilarproperty"]=="yes") ) { ?>
				<div class="col-lg-4 col-md-4">
					<?php
					if(!empty($dreamvilla_options['displaypropertyfilter']) && $dreamvilla_options["displaypropertyfilter"] == "yes") {
						echo '<div class="property-detail-filter">';
							the_widget( 'Dreamvilla_MP_PropertyFilter', 'title='.$dreamvilla_options['titlepropertyfilter'] );
						echo '</div>';
					}

					$Property_Agent = get_post_meta( $post->ID, 'pagent', true ); ?>
					<div class="agent-contact-sidebar">
						<?php if(!empty($dreamvilla_options['displayagentinfo']) && $dreamvilla_options["displayagentinfo"]=="yes" && $Property_Agent && !empty($Property_Agent)){ ?>
						<div class="agent-profile-sidebar">
							<img src="<?php echo esc_url( wp_get_attachment_url( get_the_author_meta( 'profile_image_id', $Property_Agent ) ) );?>" alt="<?php echo esc_attr(get_the_author_meta( 'fullname', $Property_Agent ));?>" />
							<h4><?php printf(esc_html__('%s','dreamvilla-multiple-property'),get_the_author_meta( 'fullname', $Property_Agent )); ?></h4>
							<p><?php printf( esc_html__("%s","dreamvilla-multiple-property"), $dreamvilla_options["agentofpropertytitle"]) ?></p>
						</div>
						<div class="agent-contact-detail-sidebar">
							<p><i class="fa fa-phone"> </i> <?php printf(esc_html__('%s','dreamvilla-multiple-property'),get_the_author_meta( 'phone', $Property_Agent )); ?></p>
							<?php $User_Detail = get_userdata( $Property_Agent ); ?>
							<p><i class="fa fa-envelope-o"></i><a href="mailto:<?php echo antispambot(sanitize_email($User_Detail->user_email),1); ?>"><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$User_Detail->user_email); ?></a></p>
						</div>
						<?php }
						if(!empty($dreamvilla_options['displaycontactform']) && $dreamvilla_options["displaycontactform"] == "yes"){

							if( !empty($dreamvilla_options['show_google_recaptcha'] ) ){
								$show_google_recaptcha = $dreamvilla_options['show_google_recaptcha'];
							}
							if( !empty($dreamvilla_options['google_recaptcha_site_key'] ) ){
								$google_recaptcha_site_key = $dreamvilla_options['google_recaptcha_site_key'];
							}

							if( !empty($google_recaptcha_site_key) && $show_google_recaptcha == "yes" ){
								$google_recaptcha = '<div id="single-property"></div>';
							} else {
								$google_recaptcha = '';
							} ?>

						<div class="agent-contact-form-sidebar">
							<h5><?php printf(esc_html__('%s','dreamvilla-multiple-property'), $dreamvilla_options["contactformtitledetail"]);?></h5>
							<div class="inner-page-shortcodes" id="propety-agent-contact-area" style="margin:0;"><div class="message_area_bottom"></div></div>
							<form id="single-propety-agnet-send-message" name="contact_form" method="POST" >
								<input type="text" id="fname" name="full_name" class="full_name" placeholder="<?php esc_html_e("Nombre completo","dreamvilla-multiple-property"); ?>" required />
								<input type="text" id="pnumber" name="p_number" class="p_number" placeholder="<?php esc_html_e("Numero de telefono","dreamvilla-multiple-property"); ?>" required />
								<input type="email" id="emailid" name="email_address" class="email_address" placeholder="<?php esc_html_e("Correo electronico","dreamvilla-multiple-property"); ?>" required />
								<textarea placeholder="<?php esc_html_e("Mensaje","dreamvilla-multiple-property"); ?>" name="message" class="message" required></textarea>
								<?php printf( esc_html__('%s','dreamvilla-multiple-property'),$google_recaptcha); ?>
								 <?php $User_Detail = get_userdata( $Property_Agent ); ?>
								 <input type="hidden" name="agent_email_address" class="agent_email_address" value="<?php echo esc_attr($User_Detail->user_email); ?>" >
								<input type="submit" name="sendmessage" class="multiple-send-message" value="<?php if( !empty($dreamvilla_options['submitrequesttitle']) ){  printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['submitrequesttitle'] ); } else { esc_html_e('Enviar ahora','dreamvilla-multiple-property'); } ?>" />
							</form>
						</div>
						<?php } ?>
					</div>

					<?php if ( !empty($dreamvilla_options['displaysidebar']) && $dreamvilla_options['displaysidebar'] == 'yes' ) { ?>
						<?php if ( is_active_sidebar( 'property_detail_sidebar' ) ) : ?>
							<div class="blog_page_information">
								<div id="primary-sidebar " class="primary-sidebar widget-area" role="complementary">
									<?php dynamic_sidebar( 'property_detail_sidebar' ); ?>
								</div><!-- #primary-sidebar -->
							</div>
						<?php endif; ?>
					<?php } ?>

					<?php
					if(!empty($dreamvilla_options['displayadvertisement']) && $dreamvilla_options["displayadvertisement"] == "yes") {
						$PropertyAdvertisement = get_post_meta( $post->ID, 'padvertisement',true); ?>
					<div class="advertisement-sidebar">
						<?php printf( esc_html__('%s','dreamvilla-multiple-property'),$PropertyAdvertisement); ?>
					</div>
					<?php } ?>

					<?php if(!empty($dreamvilla_options['displaypropertyvideo']) && $dreamvilla_options["displaypropertyvideo"] == "yes") { ?>
					<div class="property-video-sidebar">
						<h4 class="similar-properties"><?php printf(esc_html__('%s','dreamvilla-multiple-property'), $dreamvilla_options["propertyvideotitle"]);?></h4>
						<a href="#" data-toggle="modal" data-target="#property-video-model"><img class="img-responsive" alt="about video" src="<?php echo esc_url(get_post_meta($post->ID,"pvideoplaceholder",true)); ?>"></a>
					</div>
					<?php } ?>

					<?php if(!empty($dreamvilla_options['displaysimilarproperty']) && $dreamvilla_options["displaysimilarproperty"]=="yes") { ?>
					<div class="recent-proeprties-sidebar">
						<h4 class="similar-properties"><?php printf(esc_html__('%s','dreamvilla-multiple-property'), $dreamvilla_options["similarpropertytitle"]);?></h4>
						<?php
						$args = array(
										'post_type'			=> 'property',
										'posts_per_page' 	=> -1,
										'exclude' 			=> array( $post->ID ),
										'tax_query' 		=> array(
																	    array(
																	      'taxonomy' 	=> 'property_category',
																	      'field' 		=> 'slug',
																	      'terms' 		=> wp_get_post_terms($post->ID, 'property_category', array("fields" => "names"))
																	    ),
																	'suppress_filters' 	=> 0
										  						)
								);

						$recent_property_list = get_posts($args);
						if( $recent_property_list ){ ?>
						<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
							<div class="carousel-inner" role="listbox"><?php
								$i = 0;
								foreach( $recent_property_list as $property ){
									if( $i % 2 == 0 ){ ?>
										<div class="multiple-recent-properties item <?php if($i==0) echo "active"; ?>">
									<?php } ?>
										<div class="multiple-recent-properties-item">
											<div class="image-with-label">
												<img class="img-responsive" alt="recent-properties-1" <?php echo dreamvilla_mp_get_device_image( $property->ID ); ?>>
												<label>
													<?php
													$property_status = get_post_meta( $property->ID, 'pstatus', true );
													if ( $property_status == "sale" ){
														printf( esc_html__('Venta','dreamvilla-multiple-property') );
													} else {
														printf( esc_html__('Alquiler','dreamvilla-multiple-property') );
													} ?>
												</label>
											</div>
											<a href="<?php echo esc_url(get_permalink($property->ID)); ?>"><h6><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$property->post_title); ?></h6></a>
											<span class="recent-properties-address"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $property->ID, 'pcountry', true )); if( get_post_meta( $property->ID, 'pcountry', true ) && get_post_meta( $property->ID, 'pstate', true ) ){ echo " / "; } printf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $property->ID, 'pstate', true )); ?></span>
											<p class="recent-properties-price">
												<?php
												$property_price = get_post_meta( $property->ID, 'pprice', true );
												if( $property_price[0] ){
													if( $property_status == "sale" ){
														printf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
													} else {
														printf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
														echo '<span class="price-label">';
															printf( esc_html__(' / %s','dreamvilla-multiple-property'),strtoupper($property_price[1]));
														echo '</span>';
													}
												} ?>
											</p>
										</div>
									<?php  if( $i % 2 == 1 ) { ?>
										</div>
								<?php }
									$i++;
								}
								if( $i % 2 == 1 ) { echo "</div>"; } ?>
							</div>

							<div class="left-right-arrow">
							  <a class="left carousel-control" href="#myCarousel1" role="button" data-slide="prev">
							  	<img class="pull-left" alt="arrow left" src="<?php echo esc_url(get_template_directory_uri());?>/images/left-arrow.png">
							  </a>
							  <a class="right carousel-control" href="#myCarousel1" role="button" data-slide="next">
							    <img class="pull-right" alt="arrow right" src="<?php echo esc_url(get_template_directory_uri());?>/images/right-arrow.png">
							  </a>
							</div>
						</div>
						<?php } ?>
					</div>
					<?php } ?>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
<?php }

$dreamvilla_options = get_option('dreamvilla_options');
$show_google_recaptcha = $dreamvilla_options['show_google_recaptcha'];
$google_recaptcha_site_key = $dreamvilla_options['google_recaptcha_site_key'];
?>
<script type="text/javascript">

jQuery("#single-propety-agnet-send-message").submit(function(event){

	event.preventDefault();

	var show_google_recaptcha = "<?php echo esc_js($show_google_recaptcha); ?>";
	var google_recaptcha_site_key = "<?php echo esc_js($google_recaptcha_site_key); ?>";

	if(!(document.getElementById("single-property") === null ) && typeof single_property_recaptcha_id !== "undefined" && grecaptcha.getResponse(single_property_recaptcha_id) == "") {
	    alert("Please fill recaptcha!");
	} else {

		var dreamvilla_mp_data;

		var ajaxurl = "<?php echo esc_js(admin_url('admin-ajax.php')); ?>";

		var full_name 			= jQuery('.full_name').val();
	 	var p_number 			= jQuery('.p_number').val();
		var email_address		= jQuery('.email_address').val();
		var message 			= jQuery('.message').val();
		var agent_email_address = jQuery('.agent_email_address').val();

		jQuery.ajax({
		    url:ajaxurl,
		    dataType: "json",
		    data: {
				'action'				: 'dreamvilla_mp_propety_send_visiter_message',
				'full_name' 			: full_name,
				'phone_number' 			: p_number,
				'email_address' 		: email_address,
				'message' 				: message,
				'agent_email_address' 	: agent_email_address
	      	},
	    }).done(function(data){
	      	jQuery(".message_area_bottom .alert").remove();
			if( data.mail_info == "success" ){
	        	jQuery("#propety-agent-contact-area .message_area_bottom").append("<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok'></i> <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['sendinquirysuccessmessage']); ?> </div>");
	        } else {
	        	jQuery("#propety-agent-contact-area .message_area_bottom").append("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-remove'></i> <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['sendinquiryfailedmessage']); ?> </div>");
	        }
	    });
	}
});

jQuery(function(){
    jQuery('.close').click(function(){
        jQuery('.special_iframe').attr('src', jQuery('.special_iframe').attr('src'));
    });
});

</script>
<?php if(!empty($dreamvilla_options['displaypropertyvideo']) && $dreamvilla_options["displaypropertyvideo"] == "yes") { ?>
<!-- Property video -->
<div id="property-video-model" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					&times;
				</button>
				<h4 class="modal-title"><?php printf(esc_html__('%s','dreamvilla-multiple-property'), $dreamvilla_options["propertyvideotitle"]);?></h4>
			</div>
			<div class="modal-body" id="yt-player">
				<?php
				$videoHeight 	= esc_attr( get_post_meta( $post->ID,"pvideoheight",true ) );
				$videoWidth 	= esc_attr( get_post_meta( $post->ID,"pvideowidth",true ) );
				$videoUrl 		= esc_url( get_post_meta( $post->ID,"pvideourl",true ) );

				if( $videoHeight ){
					$videoHeight = $videoHeight;
				} else {
					$videoHeight = '400';
				}

				if( $videoWidth ){
					$videoWidth = $videoWidth;
				} else {
					$videoWidth = '100%';
				}

				if( $videoUrl ){
			    	echo '<iframe class="special_iframe" width="100%" height="'.$videoHeight.'" src="'.$videoUrl.'" frameborder="0" allowfullscreen></iframe>';
			    } else {
			    	echo '<p>Your browser does not support This video.</p>';
			    } ?>
			</div>
		</div>
	</div>
</div><?php
	}
    endwhile;
endif;
?>
<?php
/*
 * Footer
 */
get_footer();
