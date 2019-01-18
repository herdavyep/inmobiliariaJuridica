<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage DreamVilla
 * @since DreamVilla 1.0
 */
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

$blog_page_id = get_option( "page_for_posts" ); 
wp_enqueue_script('dreamvilla-mp-masonary', get_template_directory_uri().'/js/masonary.js', '', '', true);
wp_enqueue_style('dreamvilla-mp-main-style', get_template_directory_uri().'/css/dreamvilla-mp-main.css', '', '', 'all');
?>
<script>
jQuery(document).ready(function(){
	"use strict";
	var grid= jQuery("#grid_mas_test");
	grid.masonry({
	  itemSelector: '.grid_item_mas',
	  columnWidth: '.blog-thumbnail'
	});
});
</script>
<?php

if( $title_bar_meta == 1 ) { ?>
	<header>
		<div class="inner-page-header-area <?php if( !empty($dreamvilla_options['dreamvilla_header_variation']) && $dreamvilla_options['dreamvilla_header_variation'] == 2 ) { echo "v1"; } ?>">
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
			       		<h2><span><?php esc_html_e('Blog','dreamvilla-multiple-property'); ?></span></h2>
	     				<?php if( $breadcrumb_title_bar_meta == 1 ){ ?><h5><span><a href="<?php echo esc_url( home_url( '/' )); ?>"><?php esc_html_e('Home','dreamvilla-multiple-property'); ?></a> > <?php esc_html_e('Blog','dreamvilla-multiple-property'); ?></span></h5><?php } ?>
					</div>
				</div>
			</div>
		</div>
	</header><?php
} ?>
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
					<div class="row grid_mas" id="grid_mas_test">
						<?php 
						$args = array(
										'post_type' => 'post',
										'post_status' => 'publish',
										'posts_per_page' => 4,
										'orderby' => 'post_date',
										'order' => 'DESC' 
									);
						$post_query = new WP_Query( $args );
						if( $post_query->post_count > 0 ){
							while ( $post_query->have_posts() ) {
								$post_query->the_post();
								$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_query->post->ID ),"full");
						?>
						<div class="col-md-6 blog-thumbnail grid_item_mas col-xs-12 col-sm-12">
							<?php if(is_sticky($post_query->post->ID)){ ?>
								<div class="sticky-image"></div>
							<?php } ?>
							<?php if(has_post_thumbnail( $post_query->post->ID )){ ?>
								<div class="blogimage text-center">
									<?php $full_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_query->post->ID ), "full" );
									if( $full_image ){ ?>
										<img src='<?php echo esc_url($full_image[0]); ?>' alt="Post Feature Image">
									<?php } ?>
								</div>
							<?php } ?>
							<div class="blog_info">
								<div class="blogimagedescription">
									<h3><a href="<?php echo esc_url(get_permalink($post_query->post->ID)); ?>"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$post_query->post->post_title); ?></a></h3>
									<p class="discription">
										<?php printf( esc_html__('%s','dreamvilla-multiple-property'),wp_trim_words( $post_query->post->post_excerpt, 20 )); ?>
									</p>
									<p class="detail">
										<span>
											<?php 
												$archive_year  = get_the_time('Y',$post_query->post->ID); 
												$archive_month = get_the_time('m',$post_query->post->ID); 
												$archive_day   = get_the_time('d',$post_query->post->ID);
											?>
											<a href="<?php echo esc_url(get_day_link( $archive_year, $archive_month, $archive_day)); ?>">
												<?php 
													$post_date = strtotime( $post_query->post->post_date ); 
													echo date_i18n( "F d,Y", $post_date ); 
												?>												
											</a>
										</span>
										<span>
											<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>">
												<?php 
												$fname = get_the_author_meta( 'first_name', $post_query->post->post_author);
												$lname = get_the_author_meta( 'last_name', $post_query->post->post_author);
												printf( esc_html__('%s','dreamvilla-multiple-property'),$fname." ".$lname);
												?>
											</a>
										</span>
									</p>
								</div>
							</div>
						</div>
						<?php
							}
						}
						?> 			
					</div>

					<div class="ajax_load" style="display:none;">
						<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/ajax_load.gif" alt="ajax_load" class="img-responsive">
					</div>
					<?php
					$args = array(
									'post_type' => 'post',
									'post_status' => 'publish',
									'posts_per_page' => -1						
								);				
					$count_post_query = new WP_Query( $args );					
					if( $count_post_query->post_count > 1 ){ ?>
					<div class="row load_more text-center">
						<button class="load_more_btn"><?php esc_html_e('Load more','dreamvilla-multiple-property'); ?></button>
						<input type="hidden" name="current_post" class="current_post" value="1">
					</div>
					<?php } ?>
				<?php
                if( $have_sidebar ){
					echo "</article></section>";
				} ?>				
				<?php
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
<script type="text/javascript">
	var page = 1;
    var posts_per_page = 4;

	jQuery(".load_more_btn").click(function(){
		
		jQuery(".ajax_load").css("display","block");

		var ajaxurl = "<?php echo esc_js(admin_url('admin-ajax.php')); ?>";
	    jQuery.ajax({
	    url:ajaxurl,
	      data: {
	          'action'  		: 'dreamvilla_mp_ajax_load_more_blog_post',
	          'offset'			: (page * posts_per_page),
	          'posts_per_page'	: posts_per_page
	      },
	    }).done(function(data){
	      	data = jQuery.parseJSON( data );
	      	
	      	page++;
	      	
	      	jQuery("#grid_mas_test").append(data.html);
	      	jQuery("#grid_mas_test").masonry( 'reloadItems' );
			jQuery("#grid_mas_test").masonry( 'layout' );
			jQuery("#grid_mas_test").on( 'layoutComplete', function( event, items ) {
				if(jQuery("#grid_mas_test").prop('scrollHeight') > jQuery("#grid_mas_test").height() ){
					jQuery("#grid_mas_test").height(jQuery("#grid_mas_test").prop('scrollHeight'));
				}
			});
	      	if( data.total_post == "no" ){
	      		jQuery(".load_more_btn").remove();
	      	} else {
	      		jQuery(".current_post").attr("value",data.total_post);
	      	}
	      	jQuery(".ajax_load").css("display","none");
	    });
	});
</script>
<?php get_footer(); ?>