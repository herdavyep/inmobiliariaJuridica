<?php
/*
	Template Name: Agent Page
*/	

	get_header();

wp_enqueue_style('dreamvilla-mp-main-style', get_template_directory_uri().'/css/dreamvilla-mp-main.css', '', '', 'all');
	
$post;

$title_bar_meta = null;
$sidebar_pos 	= null;
$sidebar_type 	= null;
$have_sidebar 	= null;

$title_bar_meta						= rwmb_meta( 'dreamvilla_page_title_bar_meta' );
$sidebar_pos 						= rwmb_meta( 'dreamvilla_sidebar_position_meta' );
$sidebar_type						= rwmb_meta( 'dreamvilla_sidebar' );
$have_sidebar						= $sidebar_pos ? true : false;

if( isset($_GET['id']) ){
	$agent_id = $_GET['id'];
}

$dreamvilla_options = get_option('dreamvilla_options');

if(function_exists('dreamvilla_mp_the_breadcrumbs')) dreamvilla_mp_the_breadcrumbs($dreamvilla_options['Theme_Page_Agent_Page']); ?>
<section>
	<div class="inner-page-left-sidebar">
		<div class="container">
			<div class="row">
				<?php
				// LEFT SIDEBAR
				if( ('left' == $sidebar_pos) ) { ?>
					<div class="col-md-4 col-lg-4">						
						<div class="blog_page_information agent-detail-sidebar">
						<?php if ( is_active_sidebar( $sidebar_type ) ) : ?>
							<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
								<?php dynamic_sidebar( $sidebar_type ); ?>
							</div><!-- #primary-sidebar -->						
						<?php endif; ?>
						</div>
					</div>					
				<?php }

				if( $have_sidebar ) {
					echo '<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">';
				} else {
					echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
				}
					if( isset($agent_id) ){
						$dreamvilla_options = get_option('dreamvilla_options');

						$User_Detail            		= get_userdata( $agent_id );
						$Current_User_Detail    		= get_user_meta( $agent_id );

						if( isset($Current_User_Detail['fullname'][0]) )
							$Property_Agent_Name = $Current_User_Detail['fullname'][0];

						if( isset($Current_User_Detail['aboutme'][0]) )
							$Property_Agent_About = $Current_User_Detail['aboutme'][0];
						
						if( isset($Current_User_Detail['phone'][0]) )
							$Property_Agent_Contact_Number = $Current_User_Detail['phone'][0];
						
						if( isset($User_Detail->user_email) )
							$Property_Agent_Email_ID = $User_Detail->user_email; 
						
						if( isset($Current_User_Detail['profile_image_id'][0]) )
							$Property_Agent_Photo = $Current_User_Detail['profile_image_id'][0];
						?>

						<div class="agent-detail-container">
							<div class="continer-fluid">
								<div class="row text-center photo-social-section">
									<div class="col-xs-12 col-sm-4 col-md-4 text-right left-social-outer">
										<span class="social-left">
											<?php if( isset($Current_User_Detail['twitterurl'][0]) ){ ?>
												<a href="<?php echo esc_url($Current_User_Detail['twitterurl'][0]); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
											<?php } else { ?>
												<i class="fa fa-twitter"></i>
											<?php } ?>
										</span>
										<span class="social-right">
											<?php if( isset($Current_User_Detail['facebookurl'][0]) ){ ?>
												<a href="<?php echo esc_url($Current_User_Detail['facebookurl'][0]); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
											<?php } else { ?>
												<i class="fa fa-facebook"></i>
											<?php } ?>										
										</span>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4 text-center agent-profile-image"><?php 
										if( isset( $Current_User_Detail['profile_image_id'] ) ) {
		                                    $profile_image_id = intval( $Current_User_Detail['profile_image_id'][0] );
		                                    if ( $profile_image_id ) {
		                                        echo wp_get_attachment_image( $profile_image_id, 'full', false, array( 'class' => 'img-responsive' ) );		                                        
		                                    }
		                                } ?>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4 text-left right-social-outer">
										<span class="social-left">
											<?php if( isset($Current_User_Detail['pinteresturl'][0]) ){ ?>
												<a href="<?php echo esc_url($Current_User_Detail['pinteresturl'][0]); ?>" target="_blank"><i class="fa fa-pinterest"></i></a>
											<?php } else { ?>
												<a href="#"><i class="fa fa-pinterest"></i></a>
											<?php } ?>
										</span>
										<span class="social-right">
											<?php if( isset($Current_User_Detail['linkedinurl'][0]) ){ ?>
												<a href="<?php echo esc_url($Current_User_Detail['linkedinurl'][0]); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
											<?php } else { ?>
												<i class="fa fa-linkedin"></i>
											<?php } ?>										
										</span>
									</div>
								</div>
							</div>
							<div class="agent-detail-info">
								<h2><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$Property_Agent_Name); ?></h2>
								<?php dreamvilla_mp_agent_public_property($agent_id); ?>
								<p><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$Property_Agent_About); ?></p>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="agent-detail-contact-info container-fluid">
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-6 text-center list-item">
									<span class="contact_agent_icon"><i class="fa fa-phone"></i></span><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$Property_Agent_Contact_Number); ?>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6 text-center list-item">
									<?php if( !empty($Property_Agent_Email_ID) ){ ?>
										<span class="contact_agent_icon"><i class="fa fa-envelope"></i></span> <a href="mailto:<?php echo antispambot( sanitize_email($Property_Agent_Email_ID ),1); ?>"> <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$Property_Agent_Email_ID); ?> </a>
									<?php } else { ?>
										<span class="contact_agent_icon"><i class="fa fa-envelope"></i></span>
									<?php } ?>								
								</div>
							</div>
						</div>
						<div class="agent-detail-contact-form">
							<?php
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
							<h2><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['agent_detail_contact_label']); ?></h2>
							<div class="inner-page-shortcodes" id="agent-contact-area" style="margin:0;"><div class="message_area"></div></div>
							<form class="agent_contact_form" name="agent_contact_form" method="post" >
								<div class="col-xs-12 col-sm-6 col-md-6 no-padding padding-right">
									<input type="text" name="first_name" class="first_name" placeholder="<?php esc_html_e("First Name*","dreamvilla-multiple-property"); ?>" required>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6 no-padding padding-left">
									<input type="text" name="last_name" class="last_name" placeholder="<?php esc_html_e("Last Name*","dreamvilla-multiple-property"); ?>" required>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6 no-padding padding-right">
									<input type="text" name="email" class="email" placeholder="<?php esc_html_e("Email*","dreamvilla-multiple-property"); ?>" required>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6 no-padding padding-left">
									<input type="text" name="phone" class="phone" placeholder="<?php esc_html_e("Phone*","dreamvilla-multiple-property"); ?>" required>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 no-padding">
									<textarea name="comment" class="comment" placeholder="<?php esc_html_e("Comment*","dreamvilla-multiple-property"); ?>" required></textarea>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 no-padding">
									<?php printf( esc_html__('%s','dreamvilla-multiple-property'),$google_recaptcha); ?>
								</div>	
								<div class="col-xs-12 col-sm-12 col-md-12 no-padding	">
									<input type="hidden" name="agent_email_address" class="agent_email_address" value="<?php echo esc_attr($Property_Agent_Email_ID); ?>" >
									<input type="submit" class="submit-btn" value="<?php if( !empty($dreamvilla_options['submitnowbuttontitle']) !="" ){  printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['submitnowbuttontitle'] ); } else { esc_html_e('Sunmit Now','dreamvilla-multiple-property'); } ?>">
								</div>
							</form>
						</div>
						
						<?php

						if( isset($Current_User_Detail['pagentproperty'][0]) ){		
							$Property_Agent_Properties = get_user_meta( $agent_id, 'pagentproperty', true );
							if( !empty($Property_Agent_Properties) ){
								$Agent_Public_Properties = array();
								foreach($Property_Agent_Properties as $key => $value){
									if( get_post_status( $value ) == 'publish' ){
										$Agent_Public_Properties[] = $value;
									}
								}			
							}		
						}
						
						if( !empty($Property_Agent_Properties) && count($Agent_Public_Properties) > 0 ) {
							$args = array(
									'post_type'			=> 'property',
									'posts_per_page' 	=> -1,
									'include'			=> $Property_Agent_Properties,
									'suppress_filters' 	=> 0
							);

							$i = 0;
							$Agent_Property = get_posts($args); ?>
							<div class="agent-recent-properties">
								<h2><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['agent_detail_listing_label']); ?></h2>
								<div id="property-listing" class="carousel slide property-listing" data-ride="carousel" data-interval="false">
									<div class="carousel-inner" role="listbox"><?php
									if( $Agent_Property ){
										foreach($Agent_Property as $key => $value) { ?>
										
											<div class="col-xs-12 col-sm-6 col-md-6 no-padding">
												<div class="image-with-label">
													<img <?php echo dreamvilla_mp_get_device_image( $value->ID ); ?> alt="agent-properties" class="img-responsive">
													<label><?php 
													$property_status = get_post_meta( $value->ID, 'pstatus', true );
													if ( $property_status == "sale" ){
														printf( esc_html__('On Sale','dreamvilla-multiple-property') );
													} else {
														printf( esc_html__('On Rent','dreamvilla-multiple-property') );
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
										}
									} ?>
									</div>
								</div>
							</div><?php
						} 
					} ?>
				</div><?php				
				if( ('right' == $sidebar_pos) ){ ?>
					<div class="col-md-4 col-lg-4">
						<div class="blog_page_information agent-detail-sidebar">
						<?php if ( is_active_sidebar( $sidebar_type ) ) : ?>
							<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
								<?php dynamic_sidebar( $sidebar_type ); ?>
							</div><!-- #primary-sidebar -->
						<?php endif; ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
<?php 
$dreamvilla_options = get_option('dreamvilla_options'); 
$show_google_recaptcha = $dreamvilla_options['show_google_recaptcha'];
$google_recaptcha_site_key = $dreamvilla_options['google_recaptcha_site_key'];
?>
<script type="text/javascript">
jQuery(".agent_contact_form").submit(function(event){
 		
	event.preventDefault();

	var show_google_recaptcha = "<?php echo esc_js($show_google_recaptcha); ?>";
	var google_recaptcha_site_key = "<?php echo esc_js($google_recaptcha_site_key); ?>";
	
	if( show_google_recaptcha == "yes" && google_recaptcha_site_key != "" && grecaptcha.getResponse(single_property_recaptcha_id) == "" ) {
	    alert("Please fill recaptcha!");
	} else {

	    var ajaxurl = "<?php echo esc_js(admin_url('admin-ajax.php')); ?>";
		
		var first_name 			= jQuery('.first_name').val();
	 	var last_name 			= jQuery('.last_name').val();
		var phone				= jQuery('.phone').val();
		var comment 			= jQuery('.comment').val();
		var agent_email_address = jQuery('.agent_email_address').val();

		jQuery.ajax({
		    url:ajaxurl,
		    dataType: "json",
		    data: {
				'action'				: 'dreamvilla_mp_send_agent_comment',
				'first_name' 			: first_name,
				'last_name' 			: last_name,
				'phone' 				: phone,
				'comment' 				: comment,
				'agent_email_address' 	: agent_email_address
	      	},
	    }).done(function(data){
	      	jQuery(".message_area .alert").remove();
	        if( data.mail_info == "success" ){
	        	jQuery("#agent-contact-area .message_area").append("<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok'></i> <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['sendinquirysuccessmessage']); ?> </div>");
	        } else {
	        	jQuery("#agent-contact-area .message_area").append("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-remove'></i> <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['sendinquiryfailedmessage']); ?> </div>");
	        }       
	    });		
	}
});
</script>
<?php
	get_footer();
?>