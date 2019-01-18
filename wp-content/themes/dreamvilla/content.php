<?php
	get_header();
?>
<?php if(function_exists('dreamvilla_mp_the_breadcrumbs')) dreamvilla_mp_the_breadcrumbs(); ?>
<section>
	<div id="blog_page_information" class="blog_page_information">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-lg-8">
					<div class="row">
						<?php 
						$args = array(
										'post_type' => 'post',
										'post_status' => 'publish',
										'posts_per_page' => 2,
										'orderby' => 'post_date',
										'order' => 'DESC'
									);
						$post_query = new WP_Query( $args );
						if( $post_query->post_count > 0 ){
							while ( $post_query->have_posts() ) {
								$post_query->the_post();
								$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_query->post->ID ));
						?>
						<div class="col-md-6 blog-thumbnail">
							<div class="blogimage text-center">
								<img <?php echo dreamvilla_mp_get_device_image( $post_query->post->ID ); ?> alt="blog1 image">
							</div>
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
													$post_date 	= strtotime( $post_query->post->post_date );
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
									'post_status' => 'publish'									
								);					
					$count_post_query = new WP_Query( $args );					
					if( $count_post_query->post_count > 1 ){ ?>
					<div class="row load_more text-center">
						<button class="load_more_btn"><?php esc_html_e('Load more','dreamvilla-multiple-property'); ?></button>
						<input type="hidden" name="current_post" class="current_post" value="1">
					</div>
					<?php } ?>
				</div>
				<div class="col-md-4 col-lg-4">
					<?php if ( is_active_sidebar( 'right_sidebar' ) ) : ?>
						<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
							<?php dynamic_sidebar( 'right_sidebar' ); ?>
						</div><!-- #primary-sidebar -->
					<?php endif; ?>					
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	var page = 1;
    var posts_per_page = 2;

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
	      	var lastDiv = $('body').find('.col-md-6.blog-thumbnail').last();
	      	lastDiv.after(data.html);
	      	
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