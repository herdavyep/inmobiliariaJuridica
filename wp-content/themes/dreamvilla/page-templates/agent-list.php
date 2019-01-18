<?php
	
/*
	Template Name:Agent List
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

if(function_exists('dreamvilla_mp_the_breadcrumbs')) dreamvilla_mp_the_breadcrumbs(); ?>

<section>
	<div id="blog_page_information" class="blog_page_information">
		<div class="container">
			<div class="row">
				<?php
				// LEFT SIDEBAR
				if( ('left' == $sidebar_pos) ) { ?>
					<div class="col-md-4 col-lg-4">						
						<?php if ( is_active_sidebar( $sidebar_type ) ) : ?>
							<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
								<?php dynamic_sidebar( $sidebar_type ); ?>
							</div><!-- #primary-sidebar -->						
						<?php endif; ?>						
					</div>					
				<?php }

				if( $have_sidebar ) {
					echo '<div class="col-md-8 col-lg-8">';
				} else {
					echo '<div class="col-md-12 col-lg-12">';
				} ?>
				
					<div class="container-fluid"> 
						<div class="row agent-list"><?php
							
							$args = array(
							    'role' 		=> 'subscriber',
							    'number' 	=> 5,
							    'orderby' 	=> 'user_nicename',
							    'order' 	=> 'ASC'
							);

							$post_query = get_users($args);

							$counter = 0;

							if( isset($post_query) ){
								foreach ($post_query as $user) {
									$counter++;
									
									$User_Detail            		= get_userdata( $user->ID );
									$Current_User_Detail    		= get_user_meta( $user->ID );

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

									if( isset($Current_User_Detail['twitterurl'][0]) )
										$Property_Agent_Social_Twitter = $Current_User_Detail['twitterurl'][0];
									
									if( isset($Current_User_Detail['facebookurl'][0]) )
										$Property_Agent_Social_Facebook = $Current_User_Detail['facebookurl'][0];
									
									if( isset($Current_User_Detail['pinteresturl'][0]) )
										$Property_Agent_Social_Pinteresturl_Plus = $Current_User_Detail['pinteresturl'][0];
									
									if( isset($Current_User_Detail['linkedinurl'][0]) )
										$Property_Agent_Social_Linkedin = $Current_User_Detail['linkedinurl'][0]; ?>
									
									<div class="col-xs-12 col-sm-4 col-md-4 agent-photo-row"><?php 
										if( isset( $Current_User_Detail['profile_image_id'] ) ) {
		                                    $profile_image_id = intval( $Current_User_Detail['profile_image_id'][0] );
		                                    if ( $profile_image_id ) {
		                                        echo wp_get_attachment_image( $profile_image_id, 'full', false, array( 'class' => 'img-responsive' ) );		                                        
		                                    } 
		                                } ?>
										<div class="agent-social-area">	
											<a class="agent-contact-social collapsed" href="javascript:void(0);"></a>
											<div id="agent<?php echo $user->ID; ?>" class="collapse agent-social" aria-labelledby="heading14" role="tabpanel">
												<?php if( !empty($Property_Agent_Social_Facebook) ){ ?>
													<a href="<?php echo esc_url($Property_Agent_Social_Facebook); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
												<?php } else { ?>
													<a href="#"><i class="fa fa-facebook"></i></a>
												<?php } ?>

												<?php if( !empty($Property_Agent_Social_Twitter) ){ ?>
													<a href="<?php echo esc_url($Property_Agent_Social_Twitter); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
												<?php } else { ?>
													<a href="#"><i class="fa fa-twitter"></i></a>
												<?php } ?>

												<?php if( !empty($Property_Agent_Social_Pinteresturl_Plus) ){ ?>
													<a href="<?php echo esc_url($Property_Agent_Social_Pinteresturl_Plus); ?>" target="_blank"><i class="fa fa-pinterest"></i></a>
												<?php } else { ?>
													<a href="#"><i class="fa fa-pinterest"></i></a>
												<?php } ?>

												<?php if( !empty($Property_Agent_Social_Linkedin) ){ ?>
													<a href="<?php echo esc_url($Property_Agent_Social_Linkedin); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
												<?php } else { ?>
													<a href="#"><i class="fa fa-linkedin"></i></a>
												<?php } ?>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-8 col-md-8 agent-info-row">
										<div class="agent-list-info">
											<div class="top-header">
												<?php $dreamvilla_options = get_option('dreamvilla_options'); ?>
												<a href="<?php echo esc_url( get_permalink( $dreamvilla_options['Theme_Page_Agent_Page'] ).'?id='.$user->ID ); ?>"><h2><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$Property_Agent_Name); ?></h2></a>
												<?php dreamvilla_mp_agent_public_property($user->ID); ?>
											</div>
											<p class="agent-excerpt"><?php 
											if( !empty($Property_Agent_About) ){
												printf( esc_html__('%s','dreamvilla-multiple-property'), wp_trim_words( $Property_Agent_About, $num_words = 25, $more = '… ' ) ); 
											} ?>
											</p>
											<ul class="agnet-list-contact-info">
												<li> 
													<?php if( !empty($Property_Agent_Contact_Number) ) { ?>
															<i class="fa fa-phone"></i><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$Property_Agent_Contact_Number); ?>
													<?php } ?>
												</li>
												<li><?php if( !empty($Property_Agent_Email_ID) ){ ?>
														<i class="fa fa-envelope"></i> <a href="mailto:<?php echo antispambot( sanitize_email($Property_Agent_Email_ID ),1); ?>"> <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$Property_Agent_Email_ID); ?> </a>
													<?php } else { ?>
														<i class="fa fa-envelope"></i>
													<?php } ?>
												</li>											
											</ul>
										</div>	
									</div><?php
								}
							} ?>
						</div>			
					</div>		
					<div class="ajax_load" style="display:none;">
						<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/ajax_load.gif" alt="ajax_load" class="img-responsive">
					</div>
					<?php
					$args = array(
					    'role' 		=> 'subscriber',
					    'orderby' 	=> 'user_nicename',
					    'order' 	=> 'ASC'
					);

					$count_post_query = get_users($args);
					if( count($count_post_query) > 5 ){ ?>
						<div class="row load_more text-center">
							<button class="load_more_btn"><?php esc_html_e('Load more','dreamvilla-multiple-property'); ?></button>
							<input type="hidden" name="current_post" class="current_post" value="1">
						</div>
					<?php } ?>
				</div><?php
				if( ('right' == $sidebar_pos) ){ ?>
					<div class="col-md-4 col-lg-4">
						<?php if ( is_active_sidebar( $sidebar_type ) ) : ?>
							<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
								<?php dynamic_sidebar( $sidebar_type ); ?>
							</div><!-- #primary-sidebar -->
						<?php endif; ?>						
					</div>
				<?php } ?>				
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	var page = 1;
    var posts_per_page = 5;

	jQuery(".load_more_btn").click(function(){
		
		jQuery(".ajax_load").css("display","block");

		var ajaxurl = "<?php echo esc_js(admin_url('admin-ajax.php')); ?>";
	    jQuery.ajax({
	    url:ajaxurl,
	      data: {
	          'action'  		: 'dreamvilla_mp_ajax_load_more_agent',
	          'offset'			: (page * posts_per_page),
	          'posts_per_page'	: posts_per_page
	      },
	    }).done(function(data){
	      	data = jQuery.parseJSON( data );
	      	
	      	page++;
	      	
	      	jQuery(".agent-list").append(data.html);
	      	
	      	if( data.total_post == "no" ){
	      		jQuery(".load_more_btn").remove();
	      	} else {
	      		jQuery(".current_post").attr("value",data.total_post);
	      	}
	      	jQuery(".ajax_load").css("display","none");
	    });
	});

	jQuery(document).on("click",".agent-contact-social",function(){
		jQuery(this).toggleClass("collapsed");
		jQuery(this).parent().find(".agent-social").toggleClass("in");
	});
</script>
<?php
	get_footer();
?>