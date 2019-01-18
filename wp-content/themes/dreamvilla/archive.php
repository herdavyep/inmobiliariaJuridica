<?php
get_header();

$blog_page_id = get_option('page_for_posts');

$title_bar_meta = null;
$breadcrumb_title_bar_meta = null;
$banner_bg_img_meta = null;
$sidebar_pos 	= null;
$sidebar_type 	= null;
$have_sidebar 	= null;

$title_bar_meta						= get_post_meta( $blog_page_id, 'dreamvilla_page_title_bar_meta', true );
$breadcrumb_title_bar_meta			= get_post_meta( $blog_page_id, 'dreamvilla_breadcrumb_title_bar_meta', true );
$banner_bg_img_meta					= get_post_meta( $blog_page_id, 'dreamvilla_banner_bg_img_meta', true );
$sidebar_pos 						= get_post_meta( $blog_page_id, 'dreamvilla_sidebar_position_meta', true );
$sidebar_type						= get_post_meta( $blog_page_id, 'dreamvilla_sidebar', true );
$have_sidebar						= $sidebar_pos ? true : false;

global $post;

wp_enqueue_script('dreamvilla-mp-Masonary', get_template_directory_uri().'/js/masonary.js', '', '', true);
wp_enqueue_style('dreamvilla-mp-main-style', get_template_directory_uri().'/css/dreamvilla-mp-main.css', '', '', 'all');
?>
<script>
jQuery(document).ready(function(){
	jQuery('#grid_mas').masonry({
	  // options...
	  itemSelector: '.grid_item_mas',
	  columnWidth: '.blog-thumbnail'
	});	
});
</script>
<?php
if( $title_bar_meta == 1 ) { ?>
	<header>
		<div class="inner-page-header-area <?php if( !empty($dreamvilla_options['dreamvilla_header_variation']) && $dreamvilla_options['dreamvilla_header_variation'] == 2 ) { echo "v1"; } ?>" >
			<?php 
			if( !empty($banner_bg_img_meta) ) { 
				$full_image = wp_get_attachment_image_src( $banner_bg_img_meta, "full" ); ?>				
				<img src="<?php echo esc_url($full_image[0]); ?>" alt="banner-image"><?php				
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
			       		<?php
			       		if( is_author()){ 
			       			$author; ?>
			       			<h2><span><?php printf( esc_html__('%s','dreamvilla-multiple-property'),the_author()); ?></span></h2>
							<?php if( $breadcrumb_title_bar_meta == 1 ){ ?>
							<h5><span>
				       			<a href="<?php echo esc_url( home_url( '/' )); ?>"><?php esc_html_e('Home','dreamvilla-multiple-property'); ?></a> > <?php esc_html_e('Author','dreamvilla-multiple-property'); ?> > <?php $user_info = get_userdata($author); printf( esc_html__('%s','dreamvilla-multiple-property'),$user_info->first_name) .' '. printf( esc_html__('%s','dreamvilla-multiple-property'),$user_info->last_name);  ?>
				       		</span></h5><?php
				       		}
			       		} else if ( is_day() ) { ?>
					      	<h2><span><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_the_time('Y') . ' '. get_the_time('F') . ' '. get_the_time('d')); ?></span></h2>
							<?php if( $breadcrumb_title_bar_meta == 1 ){ ?>
							<h5><span>
				       			<a href="<?php echo esc_url( home_url( '/' )); ?>"><?php esc_html_e('Home','dreamvilla-multiple-property'); ?></a> > 
				       			<a href="<?php echo esc_url(get_year_link(get_the_time('Y'))); ?>"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_the_time('Y')); ?></a> >
				       			<a href="<?php echo esc_url(get_month_link(get_the_time('Y'),get_the_time('m'))); ?>"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_the_time('F')); ?></a> >
				       			<?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_the_time('d')); ?>
				       		</span></h5><?php
				       		}			 
					    } else if ( is_month() ) { ?>
					      	<h2><span><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_the_time('Y') . ' '. get_the_time('F')); ?></span></h2>
							<?php if( $breadcrumb_title_bar_meta == 1 ){ ?>
							<h5><span>
				       			<a href="<?php echo esc_url(home_url( '/' )); ?>"><?php esc_html_e('Home','dreamvilla-multiple-property'); ?></a> > 
				       			<a href="<?php echo esc_url(get_year_link(get_the_time('Y'))); ?>"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_the_time('Y')); ?></a> >
				       			<?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_the_time('F')); ?>
				       		</span></h5><?php
				       		}			 
					    } else if ( is_year() ) { ?>
					      	<h2><span><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_the_time('Y')); ?></span></h2>
							<?php if( $breadcrumb_title_bar_meta == 1 ){ ?>
							<h5><span>
			       				<a href="<?php echo esc_url( home_url( '/' )); ?>"><?php esc_html_e('Home','dreamvilla-multiple-property'); ?></a> > 
			       				<?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_the_time('Y')); ?>
			       			</span></h5><?php
			       			}
			       		}  else if ( is_category() ) { ?>
						    <h2><span><?php printf( esc_html__('%s','dreamvilla-multiple-property'),single_cat_title('', false)); ?></span></h2>
							<?php if( $breadcrumb_title_bar_meta == 1 ){ ?>
							<h5><span>
			       				<a href="<?php echo esc_url( home_url( '/' )); ?>"><?php esc_html_e('Home','dreamvilla-multiple-property'); ?></a> > 
			       				<?php printf( esc_html__('%s','dreamvilla-multiple-property'),single_cat_title('', false)); ?>
			       			</span></h5><?php
			       			}
						}  else if ( is_tag() ) { ?>
						    <h2><span><?php printf( esc_html__('%s','dreamvilla-multiple-property'),single_tag_title('', false)); ?></span></h2>
							<?php if( $breadcrumb_title_bar_meta == 1 ){ ?>
							<h5><span>
			       				<a href="<?php echo esc_url( home_url( '/' )); ?>"><?php esc_html_e('Home','dreamvilla-multiple-property'); ?></a> > 
			       				<?php printf( esc_html__('%s','dreamvilla-multiple-property'),single_tag_title('', false)); ?>
			       			</span></h5>
			       			<?php }
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</header>
<?php } ?>
<section>
	<div id="blog_page_information" class="blog_page_information">
		<div class="container">
			<div class="row">
				<?php
                // LEFT SIDEBAR
				if( ('left' == $sidebar_pos) ) { ?>
					<div class="col-md-4 col-sm-12 col-xs-12">						
						<?php if ( is_active_sidebar( $sidebar_type ) ) : ?>
							<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
								<?php dynamic_sidebar( $sidebar_type ); ?>
							</div><!-- #primary-sidebar -->
						<?php endif; ?>						
					</div>			
				<?php }

				if( $have_sidebar ) { ?>
				<section class="col-md-8">
					<article><?php 
				} ?> 

					<div class="row grid_mas" id="grid_mas">
						<?php 
						if( have_posts() ){
							while ( have_posts() ) {
								the_post();
								$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ));
						?> 
						<div class="col-md-6 blog-thumbnail grid_item_mas col-xs-12 col-sm-12">
							<?php if(is_sticky($post->ID)){ ?>
								<div class="sticky-image"></div>
							<?php } ?>
							<?php if(has_post_thumbnail( $post->ID )){ ?>
								<div class="blogimage text-center">
									<?php $full_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "full" );
									if( $full_image ){ ?>
										<img src='<?php echo esc_attr($full_image[0]); ?>' alt="Post Feature Image">
									<?php } ?>
								</div>
							<?php } ?>
							<div class="blog_info">
								<div class="blogimagedescription">
									<h3><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$post->post_title); ?></a></h3>
									<p class="discription">
										<?php printf( esc_html__('%s','dreamvilla-multiple-property'),wp_trim_words( $post->post_excerpt, 20 )); ?>
									</p>
									<p class="detail">
										<span>
											<?php 
												$archive_year  = get_the_time('Y',$post->ID); 
												$archive_month = get_the_time('m',$post->ID); 
												$archive_day   = get_the_time('d',$post->ID); 
											?>
											<a href="<?php echo esc_url(get_day_link( $archive_year, $archive_month, $archive_day)); ?>">
												<?php
													$post_date 	= strtotime( $post->post_date );
													echo date_i18n( "F d,Y", $post_date );
												?>
											</a>
										</span>
										<span>
											<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>">
												<?php 
													$fname = get_the_author_meta( 'first_name', $post->post_author);
													$lname = get_the_author_meta( 'last_name', $post->post_author);
													printf( esc_html__('%s','dreamvilla-multiple-property'),$fname);
													echo " ";
													printf( esc_html__('%s','dreamvilla-multiple-property'),$lname);
												?> 
											</a>
										</span>
									</p>
								</div>
							</div>
						</div><?php
							}
						} ?> 						
					</div>
				<?php
                if( $have_sidebar ){
					echo "</article></section>";
				}
														
				if( ('right' == $sidebar_pos) ){ ?>
				<div class="col-md-4 col-sm-12 col-xs-12">
					<?php if ( is_active_sidebar( $sidebar_type ) ) : ?>
						<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
							<?php dynamic_sidebar( $sidebar_type ); ?>
						</div>
					<?php endif; ?>					
				</div>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>