<?php

// Footer
function dreamvilla_footer_shortcode( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'agent_info_type'	 		=> '1',
		'footer_bk_image'			=> '',
		'location_heading'			=> '',
		'show_address'	 			=> 'disable',
		'dreamvilla_address'		=> '',
		'show_phone'	 			=> 'disable',
		'dreamvilla_phone_label'	=> '',
		'dreamvilla_phone'		 	=> '',
		'show_email'		     	=> 'disable',
		'dreamvilla_email_label'	=> '',
		'dreamvilla_email'		    => '',
		'show_opening_hours'		=> '',
		'opening_hours_label'		=> 'disable',
		'opening_hours'		        => '',
		'show_button'		        => 'disable',
		'footer_btn_content'		=> '',
		'footer_url'		        => '',
		'footer_target'		        => '',
		'show_agent_info'		    => 'disable',
		'agent_heading'		        => '',
		'agent_photo'		        => '',
		'agent_name'		        => '',
		'agent_certificate'		    => '',
		'agent_phone'		        => '',
		'agent_email'		        => '',
		'show_google_map'		    => 'disable',
		'latitude'		         	=> '',
		'longitude'		         	=> '',
		'google_width'				=> '100%',
		'google_height'				=> '100%',
		'show_contact_form'		    => 'disable',
		'contact_form_heading'		=> '',
		'contact_form'		        => '',
		'show_copyright_text'		=> '',
		'copyright_text'			=> '',
	), $atts ) );

	$out = '';

	$footer_bk_image = wp_get_attachment_url($footer_bk_image, "full");

	if( $agent_info_type == 1 ){

		$dreamvilla_options = get_option('dreamvilla_options'); ?>
		<div>
			<div class="multiple-location-detail">
				<img src="<?php echo esc_url($footer_bk_image); ?>" class="footer_background_image" alt="Footer background image">
				<?php

				$left_side_show 	= false;
				$right_side_show 	= false;

				$map_class = '';
				$location_detail_class = '';

				if( ($show_address == "enable" || $show_phone == "enable" || $show_email == "enable" || $show_opening_hours == "enable" || $show_button == "enable") && ( $show_google_map == "enable" ) ){
					$map_class = "col-md-6 col-sm-6 col-xs-12";
					$location_detail_class = "col-md-6 col-sm-6 col-xs-12 multiple-time-detail";
					$left_side_show = true;
				} else if( ($show_address == "disable" && $show_phone == "disable" && $show_email == "disable" && $show_opening_hours == "disable" && $show_button == "disable" ) && ( $show_google_map == "enable" ) ){
					$map_class = "col-md-12 col-sm-12 col-xs-12";
					$location_detail_class = "";
					$left_side_show = true;
				} else if( ($show_address == "enable" || $show_phone == "enable" || $show_email == "enable" || $show_opening_hours == "enable" || $show_button == "enable") && ( $show_google_map == "disable" ) ){
					$map_class = "";
					$location_detail_class = "col-md-12 col-sm-12 col-xs-12 multiple-time-detail";
					$left_side_show = true;
				}

				$left_side_class = '';
				$right_side_class = '';

				if( $show_contact_form == "enable" ){
					$right_side_class = "col-md-4 col-sm-5 col-xs-12";
					$right_side_show = true;
				}

				if( $left_side_show ){
					$left_side_class = "col-md-8 col-sm-7 col-xs-12 multiple-locations";
					$left_side_show = true;
				}

				if( $right_side_show && $left_side_class ){
					$right_side_class = "col-md-4 col-sm-5 col-xs-12";
					$left_side_class = "col-md-8 col-sm-7 col-xs-12 multiple-locations";
				} else if( $right_side_show && !$left_side_class){
					$right_side_class = "col-md-12 col-sm-12 col-xs-12";
					$left_side_class = "";
				} else if( !$right_side_show && $left_side_class){
					$right_side_class = "";
					$left_side_class = "col-md-12 col-sm-12 col-xs-12 multiple-locations";
				}

				$google_map_id = uniqid(); ?>

				<div class="multiple-location-detail-inner">
					<div class="container">
						<div class="row">
							<div class="<?php echo esc_attr($left_side_class); ?>">
						  		<h3 class="multiple-location-title"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$location_heading); ?></h3>
								<?php if( $show_google_map == "enable" ){ ?>
								<div class="<?php echo esc_attr($map_class); ?>">
									<div class="multiple-location-map">
										<div id="googleMap" style="width:'<?php echo $google_width; ?>';height:<?php echo $google_height; ?>;"></div>
									</div>
									<script type="text/javascript">
										jQuery(document).ready(function(){
											function initialize(){
												var myCenter = new google.maps.LatLng("<?php echo esc_js($latitude); ?>","<?php echo esc_js($longitude); ?>");
												var mapProp = {
												center:myCenter,
												zoom:11,
												mapTypeId:google.maps.MapTypeId.ROADMAP,
												scrollwheel: false,
												styles: <?php echo $dreamvilla_options["dreamvilla_map_style"]; ?>
												};

												var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
												var marker=new google.maps.Marker({position:myCenter,icon:'<?php echo esc_js(get_template_directory_uri()); ?>/images/map_marker.png'});
												marker.setMap(map);
											}
											google.maps.event.addDomListener(window,'load',initialize);
										});
							        </script>
								</div>
								<?php } ?>
								<div class="<?php echo esc_attr($location_detail_class); ?>">
									<?php if( $show_address == "enable" ){ ?>
										<div class="multiple-address">
											<p><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_address); ?></p>
										</div>
									<?php }

									if( $show_phone == "enable" || $show_email == "enable"){ ?>
										<div class="multiple-contact-detail"><?php
										if( $show_phone == "enable" ){ ?>
											<p><span><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_phone_label); ?></span><a href="tel:'<?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_phone); ?>'"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_phone); ?></a></p><?php
										}
										if( $show_email == "enable" ){ ?>
											<p><span><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_email_label); ?></span><a href="mailto:'<?php antispambot( sanitize_email($dreamvilla_email),1); ?>'"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_email); ?></a></p><?php
										} ?>
										</div><?php
									}

									if( $show_opening_hours == "enable" ){ ?>
										<div class="multiple-timetable-detail">
											<h6><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$opening_hours_label); ?></h6>
											<p><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$opening_hours); ?></p>
										</div><?php
									}

									if( $show_button == "enable" ){ ?>
										<div class="multiple-schedule_visit" style="background-color: #33BD6D !important;">
											<a href="<?php echo esc_url($footer_url); ?>"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$footer_btn_content); ?></a>
										</div><?php
									} ?>

								</div>
							</div><?php

							if( !empty($dreamvilla_options['show_google_recaptcha'] ) ){
								$show_google_recaptcha = $dreamvilla_options['show_google_recaptcha'];
							}
							if( !empty($dreamvilla_options['google_recaptcha_site_key'] ) ){
								$google_recaptcha_site_key = $dreamvilla_options['google_recaptcha_site_key'];
							}
							if( !empty($google_recaptcha_site_key) && $show_google_recaptcha == "yes" ){
								$google_recaptcha = '<div id="location-version1"></div>';
							} else {
								$google_recaptcha = '';
							}

							if( $show_contact_form == "enable" ){ ?>
							<div class="<?php echo esc_attr($right_side_class); ?>" id="multiple-contact-part">
								<div class="multiple-contact-agent">
									<div class="multiple-agent-form">
										<h3 class="multiple-location-title form-title"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$contact_form_heading); ?></h3>
										<div class="inner-page-shortcodes" id="agent-contact-area" style="margin:0;"><div class="message_area_bottom"></div></div>
										<form id="agnet-send-message" name="contact_form" method="post" >
<<<<<<< HEAD
											<input type="text" id="fname" name="full_name" class="full_name" placeholder="<?php esc_html_e("Nombre completo","dreamvilla-multiple-property"); ?>" required />
											<input type="text" id="pnumber" name="p_number" class="p_number" placeholder="<?php esc_html_e("Numero de telefono","dreamvilla-multiple-property"); ?>" required />
											<input type="email" id="emailid" name="email_address" class="email_address" placeholder="<?php esc_html_e("Correo electronico","dreamvilla-multiple-property"); ?>" required />
											<textarea placeholder="<?php esc_html_e("Mensaje","dreamvilla-multiple-property"); ?>" name="message" class="message" required></textarea>
											<?php printf( esc_html__('%s','dreamvilla-multiple-property'),$google_recaptcha); ?>
											<?php $Property_Agent_Email_ID = $dreamvilla_email; ?>
											<input type="hidden" name="agent_email_address" class="agent_email_address" value="<?php echo esc_attr($Property_Agent_Email_ID); ?>" >
											<input type="submit" name="sendmessage" class="multiple-send-message" value="<?php if( !empty($dreamvilla_options['submitnowbuttontitle']) !="" ){  printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['submitnowbuttontitle'] ); } else { esc_html_e('ENVIAR AHORA','dreamvilla-multiple-property'); } ?>" />
=======
											<input style="color: #7e8c99 !important;" type="text" id="fname" name="full_name" class="full_name" placeholder="<?php esc_html_e("Full Name","dreamvilla-multiple-property"); ?>" required />
											<input style="color: #7e8c99 !important;" type="text" id="pnumber" name="p_number" class="p_number" placeholder="<?php esc_html_e("Phone Number","dreamvilla-multiple-property"); ?>" required />
											<input style="color: #7e8c99 !important;" type="email" id="emailid" name="email_address" class="email_address" placeholder="<?php esc_html_e("Email Address","dreamvilla-multiple-property"); ?>" required />
											<textarea placeholder="<?php esc_html_e("Message","dreamvilla-multiple-property"); ?>" name="message" class="message" required></textarea>
											<?php printf( esc_html__('%s','dreamvilla-multiple-property'),$google_recaptcha); ?>
											<?php $Property_Agent_Email_ID = $dreamvilla_email; ?>
											<input style="color: #7e8c99 !important;" type="hidden" name="agent_email_address" class="agent_email_address" value="<?php echo esc_attr($Property_Agent_Email_ID); ?>" >
											<input style="color: #7e8c99 !important;" type="submit" name="sendmessage" class="multiple-send-message" value="<?php if( !empty($dreamvilla_options['submitnowbuttontitle']) !="" ){  printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['submitnowbuttontitle'] ); } else { esc_html_e('SUBMIT NOW','dreamvilla-multiple-property'); } ?>" />
>>>>>>> 981e08235b95abc83c5f66542f097f24ce1d70b8
										</form>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div><?php

				if( $show_copyright_text == "enable" ){ ?>
					<div class="container">
						<div class="row multiple-copyright-area">
							<div class="col-sm-12">
								<p class="multiple-copyright-text">
									<?php printf( esc_html__('%s','dreamvilla-multiple-property'),$copyright_text); ?>
								</p>
							</div>
						</div>
					</div><?php
				} ?>
			</div>
		</div>
		<?php
		$dreamvilla_options = get_option('dreamvilla_options');
		$show_google_recaptcha = $dreamvilla_options['show_google_recaptcha'];
		$google_recaptcha_site_key = $dreamvilla_options['google_recaptcha_site_key'];
		?>
		<script type="text/javascript">
		jQuery("#agnet-send-message").submit(function(event){

			event.preventDefault();

			var show_google_recaptcha = "<?php echo esc_js($show_google_recaptcha); ?>";
			var google_recaptcha_site_key = "<?php echo esc_js($google_recaptcha_site_key); ?>";

			if( show_google_recaptcha == "yes" && google_recaptcha_site_key != "" && grecaptcha.getResponse(location_v1_recaptcha_id) == "" ) {
			    alert("Please fill recaptcha!");
			} else {
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
						'action'				: 'dreamvilla_mp_send_visiter_message',
						'full_name' 			: full_name,
						'phone_number' 			: p_number,
						'email_address' 		: email_address,
						'message' 				: message,
						'agent_email_address' 	: agent_email_address
			      	},
			    }).done(function(data){
			      	jQuery(".message_area_bottom .alert").remove();
					if( data.mail_info == "success" ){
			        	jQuery("#agent-contact-area .message_area_bottom").append("<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok'></i> <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['sendinquirysuccessmessage']); ?> </div>");
			        } else {
			        	jQuery("#agent-contact-area .message_area_bottom").append("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-remove'></i> <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['sendinquiryfailedmessage']); ?> </div>");
			        }
			    });
			}
		});
		</script><?php
	} else {
		$dreamvilla_options = get_option('dreamvilla_options');

		if( $show_google_map == "enable" || $show_contact_form == "enable" ){ ?>
			<div>
				<div class="location-map-contact-form">
					<div class="container">
						<div class="row"><?php
							$google_map_class = '';
							$contact_form_class = '';

							if( $show_google_map == "enable" && $show_contact_form == "enable" ){
								$google_map_class = "col-md-5";
								$contact_form_class = "col-md-7";
							} else {
								if( $show_google_map == "enable" && $show_contact_form != "enable" ){
									$google_map_class = "col-md-12";
									$contact_form_class = "";
								}
								if( $show_google_map != "enable" && $show_contact_form == "enable" ){
									$google_map_class = "";
									$contact_form_class = "12";
								}
							} ?>

							<?php if( $show_google_map == "enable"){ ?>
							<div class="<?php echo $google_map_class; ?>">
								<div class="multiple-location-map">
										<div id="googleMap" style="width:'<?php echo $google_width; ?>';height:<?php echo $google_height; ?>;"></div>
									</div>
								<script type="text/javascript">
									jQuery(document).ready(function(){
										function initialize(){
											var myCenter = new google.maps.LatLng("<?php echo esc_js($latitude); ?>","<?php echo esc_js($longitude); ?>");
											var mapProp = {
												center:myCenter,
												zoom:11,
												mapTypeId:google.maps.MapTypeId.ROADMAP,
												scrollwheel: false,
												styles: <?php echo $dreamvilla_options["dreamvilla_map_style"]; ?>
											};

											var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
											var marker=new google.maps.Marker({position:myCenter,icon:'<?php echo esc_js(get_template_directory_uri()); ?>/images/map_marker.png'});
											marker.setMap(map);
										}
										google.maps.event.addDomListener(window,'load',initialize);
									});
								</script>
							</div>
							<?php }

							if( $show_contact_form == "enable"){ ?>

							<div class="<?php echo $contact_form_class; ?>">
								<?php
								if( !empty($dreamvilla_options['show_google_recaptcha'] ) ){
									$show_google_recaptcha = $dreamvilla_options['show_google_recaptcha'];
								}

								if( !empty($dreamvilla_options['google_recaptcha_site_key'] ) ){
									$google_recaptcha_site_key = $dreamvilla_options['google_recaptcha_site_key'];
								}

								if( !empty($google_recaptcha_site_key) && $show_google_recaptcha == "yes" ){
									$google_recaptcha = '<div id="location-version1"></div>';
									$textarea_style = '';
								} else {
									$google_recaptcha = '';
									$textarea_style = 'style=height:160px;';
								} ?>
								<form id="location-v1-agnet-send-message" method="post" class="homepage-varation2-contactform">
									<div class="row">
										<div class='col-xs-12 col-sm-12 col-md-12'>
											<h3 class="multiple-location-title-homepage2"><?php printf( esc_html__('%s','dreamvilla-multiple-property'), $contact_form_heading); ?></h3>
											<div class="inner-page-shortcodes" id="agent-contact-area" style="margin:0;"><div class="message_area_bottom"></div></div>
										</div>
										<div class="col-xs-6 col-sm-6 col-md-6">
											<input type="text" id="fname" name="full_name" class="full_name" placeholder="<?php esc_html_e("Full Name","dreamvilla-multiple-property"); ?>" required />
											<input type="text" id="pnumber" name="p_number" class="p_number" placeholder="<?php esc_html_e("Phone Number","dreamvilla-multiple-property"); ?>" required />
											<input type="email" id="emailid" name="email_address" class="email_address" placeholder="<?php esc_html_e("Email Address","dreamvilla-multiple-property"); ?>" required />
										</div>
										<div class="col-xs-6 col-sm-6 col-md-6">
											<textarea placeholder="<?php esc_html_e("Message","dreamvilla-multiple-property"); ?>" <?php echo $textarea_style; ?> name="message" class="message" required></textarea>
											<?php $Property_Agent_Email_ID = $dreamvilla_email; ?>
											<input type="hidden" name="agent_email_address" class="agent_email_address" value="<?php echo esc_attr($Property_Agent_Email_ID); ?>" >
											<?php printf( esc_html__('%s','dreamvilla-multiple-property'),$google_recaptcha); ?>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12">
											<input type="submit" name="sendmessage" class="multiple-send-message" value="<?php if( !empty($dreamvilla_options['submitnowbuttontitle']) ){  printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['submitnowbuttontitle'] ); } else { esc_html_e('SUBMIT NOW','dreamvilla-multiple-property'); } ?>" />
										</div>
									</div>
								</form>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div><?php
		}

		$show_first_part = false;
		$first_part_class = "";
		if( $show_address == "enable" || $show_phone == "enable" || $show_email == "enable" ){
			$show_first_part = true;
		}

		$show_second_part = false;
		$second_part_class = "";
		if( $show_opening_hours == "enable" || $show_button == "enable" ){
			$show_second_part = true;
		}

		$show_third_part = false;
		$third_part_class = "";
		if( $show_agent_info == "enable" ){
			$show_third_part = true;
		}

		if( $show_first_part && $show_second_part && $show_third_part ){
			$first_part_class = "col-xs-12 col-sm-4 col-md-4 multiple-address-area";
			$second_part_class = "col-xs-12 col-sm-4 col-md-4 multiple-time-detail";
			$third_part_class = "col-xs-12 col-sm-4 col-md-4 multiple-agent-detail";
		} else if( !$show_first_part && $show_second_part && $show_third_part ){
			$first_part_class = "";
			$second_part_class = "col-xs-12 col-sm-6 col-md-6 multiple-time-detail";
			$third_part_class = "col-xs-12 col-sm-6 col-md-6 multiple-agent-detail";
		} else if( $show_first_part && !$show_second_part && $show_third_part ){
			$first_part_class = "col-xs-12 col-sm-6 col-md-6 multiple-address-area";
			$second_part_class = "";
			$third_part_class = "col-xs-12 col-sm-6 col-md-6 multiple-agent-detail";
		} else if( $show_first_part && $show_second_part && !$show_third_part ){
			$first_part_class = "col-xs-12 col-sm-6 col-md-6 multiple-address-area";
			$second_part_class = "col-xs-12 col-sm-6 col-md-6 multiple-time-detail";
			$third_part_class = "";
		} else if( $show_first_part && !$show_second_part && !$show_third_part ){
			$first_part_class = "col-xs-12 col-sm-12 col-md-12 multiple-address-area";
			$second_part_class = "";
			$third_part_class = "";
		} else if( !$show_first_part && $show_second_part && !$show_third_part ){
			$first_part_class = "";
			$second_part_class = "col-xs-12 col-sm-12 col-md-12 multiple-time-detail";
			$third_part_class = "";
		} else if( !$show_first_part && !$show_second_part && $show_third_part ){
			$first_part_class = "";
			$second_part_class = "";
			$third_part_class = "col-xs-12 col-sm-12 col-md-12 multiple-agent-detail";
		}

		if( $show_first_part || $show_second_part || $show_third_part ){ ?>
			<div>
				<div class="contact-us-detail">
					<div class="container">
						<div class="<?php echo $first_part_class; ?>">
							<?php if( $show_address == "enable" ){ ?>
								<div class="multiple-address">
							        <p><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_address); ?></p>
								</div>
							<?php }
							if( $show_phone == "enable" || $show_email == "enable" ){ ?>
								<div class="multiple-contact-detail">
									<?php if( $show_phone == "enable" ){?>
										<p><span><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_phone_label); ?></span><a href="tel:<?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_phone);?>"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_phone);?></a></p>
									<?php } if( $show_email == "enable" ){ ?>
										<p><span><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_email_label); ?></span><a href="mailto:<?php echo antispambot(sanitize_email($dreamvilla_email),1); ?>"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_email);?></a></p>
									<?php } ?>
								</div>
							<?php } ?>
						</div>

						<?php if( $show_opening_hours == "enable" || $show_button == "enable" ){ ?>
							<div class="<?php echo $second_part_class; ?>"><?php
								if( $show_opening_hours == "enable" ){ ?>
									<h6><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$opening_hours_label); ?></h6>
									<p><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$opening_hours); ?></p><?php
								}

								if( $show_button == "enable" ){ ?>
									<div class="multiple-schedule_visit" style="background-color: #33BD6D !important;">
										<a href="<?php echo esc_url($footer_url); ?>" target="<?php echo esc_attr($footer_target); ?>"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$footer_btn_content); ?></a>
									</div>
								<?php } ?>
							</div>
						<?php }

						if( $show_agent_info == "enable" ){ ?>
							<div class="<?php echo $third_part_class; ?>">
								<h3><?php printf( esc_html__('%s','dreamvilla-multiple-property'), $contact_form_heading); ?></h3>
								<div class="container-fluid">
									<div class="row"><?php
										$agent_photo_class = "";
										if( !empty($agent_photo) && ( $agent_name || $agent_certificate || $agent_phone || $agent_email ) ){
											$agent_photo_class = "col-xs-12 col-sm-4 col-md-4 no-padding";
											$agent_info_class = "col-xs-12 col-sm-8 col-md-8";
										} else {
											if( empty($agent_photo) && ( $agent_name || $agent_certificate || $agent_phone || $agent_email ) ){
												$agent_photo_class = "";
												$agent_info_class = "col-xs-12 col-sm-12 col-md-12";
											}
											if( !empty($agent_photo) && ( !$agent_name && !$agent_certificate && !$agent_phone && !$agent_email ) ){
												$agent_photo_class = "col-xs-12 col-sm-12 col-md-12";
												$agent_info_class = "";
											}
										}

										if( !empty($agent_photo) ){
											$agent_photo = wp_get_attachment_url($agent_photo, "full"); ?>
											<div class="<?php echo esc_attr($agent_photo_class); ?>">
												<img src="<?php echo esc_url($agent_photo); ?>" class="img-responsive" alt="agent-photo">
											</div>
										<?php }

										if( !empty($agent_info_class) ){ ?>
											<div class="<?php echo esc_attr($agent_info_class); ?>">
												<?php if( !empty($agent_name) ){ ?><h4><?php printf( esc_html__('%s','dreamvilla-multiple-property'), $agent_name); ?></h4><?php } ?>
												<?php if( !empty($agent_certificate) ){ ?><span class="agent-certificate-name"><?php printf( esc_html__('%s','dreamvilla-multiple-property'), $agent_certificate); ?></span><?php } ?>
												<?php if( !empty($agent_phone) ){ ?><span class="agent-contact-information"><i class="fa fa-phone"></i> <?php printf( esc_html__('%s','dreamvilla-multiple-property'), $agent_phone); ?></span><?php } ?>
												<?php if( !empty($agent_email) ){ ?><span class="agent-contact-information"><i class="fa fa-envelope"></i><a href="mailto:<?php echo antispambot(sanitize_email($agent_email),1); ?>" ><?php printf( esc_html__('%s','dreamvilla-multiple-property'), $agent_email); ?></a></span><?php } ?>
											</div><?php
										} ?>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div><?php
		}

		$dreamvilla_options 		= get_option('dreamvilla_options');
		$show_google_recaptcha 		= $dreamvilla_options['show_google_recaptcha'];
		$google_recaptcha_site_key 	= $dreamvilla_options['google_recaptcha_site_key'];

		?>
		<script type="text/javascript">
		jQuery("#location-v1-agnet-send-message").submit(function(event){

			event.preventDefault();

			var show_google_recaptcha = "<?php echo esc_js($show_google_recaptcha); ?>";
			var google_recaptcha_site_key = "<?php echo esc_js($google_recaptcha_site_key); ?>";

			if( show_google_recaptcha == "yes" && google_recaptcha_site_key != "" && grecaptcha.getResponse(location_v1_recaptcha_id) == "" ) {
			    alert("Please fill recaptcha!");
			} else {
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
						'action'				: 'dreamvilla_mp_send_visiter_message',
						'full_name' 			: full_name,
						'phone_number' 			: p_number,
						'email_address' 		: email_address,
						'message' 				: message,
						'agent_email_address' 	: agent_email_address
			      	},
			    }).done(function(data){
			      	jQuery(".message_area_bottom .alert").remove();
					if( data.mail_info == "success" ){
			        	jQuery("#agent-contact-area .message_area_bottom").append("<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok'></i> <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['sendinquirysuccessmessage']); ?> </div>");
			        } else {
			        	jQuery("#agent-contact-area .message_area_bottom").append("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-remove'></i> <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['sendinquiryfailedmessage']); ?> </div>");
			        }
			    });
			}
		});
		</script><?php
	}
	return $out;
}
add_shortcode('footer','dreamvilla_footer_shortcode');

?>
