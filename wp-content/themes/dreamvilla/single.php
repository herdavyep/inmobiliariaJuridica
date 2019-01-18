<?php
/*
 * Header
 */

get_header();

$title_bar_meta = null;
$breadcrumb_title_bar_meta = null;
$banner_bg_img_meta = null;
$sidebar_pos 	= null;
$sidebar_type 	= null;
$have_sidebar 	= null;

$title_bar_meta						= rwmb_meta( 'dreamvilla_page_title_bar_meta' );
$breadcrumb_title_bar_meta			= rwmb_meta( 'dreamvilla_breadcrumb_title_bar_meta' );
$banner_bg_img_meta					= rwmb_meta( 'dreamvilla_banner_bg_img_meta' );
$sidebar_pos 						= rwmb_meta( 'dreamvilla_sidebar_position_meta' );
$sidebar_type						= rwmb_meta( 'dreamvilla_sidebar' );
$have_sidebar						= $sidebar_pos ? true : false;

wp_enqueue_style('dreamvilla-mp-main-style', get_template_directory_uri().'/css/dreamvilla-mp-main.css', '', '', 'all');
global $post;

$article_classes = '';
dreamvilla_mp_most_post_views_count($post->ID);

if( $title_bar_meta == 1 ) { ?>
	<header>
		<div class="inner-page-header-area <?php if( !empty($dreamvilla_options['dreamvilla_header_variation']) && $dreamvilla_options['dreamvilla_header_variation'] == 2 ) { echo "v1"; } ?>">
			<?php 
			if( !empty($banner_bg_img_meta) ) { 
				foreach ( $banner_bg_img_meta as $image ) { ?>
					<img src="<?php echo esc_url($image['full_url']); ?>" alt="banner-image"><?php
				}
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
			       		<?php if( $breadcrumb_title_bar_meta == 1 ){ ?>
			       		<h5><span>
			       			<a href="<?php echo esc_url( home_url( '/' )); ?>"><?php esc_html_e('Home','dreamvilla-multiple-property'); ?></a> > 
			       			<a href="<?php echo esc_url(get_permalink( get_option('page_for_posts') )); ?>"><?php esc_html_e('Blog','dreamvilla-multiple-property'); ?></a> >
			       			<?php printf( esc_html__('%s','dreamvilla-multiple-property'),$post->post_title); ?>
			       		</span></h5>
			       		<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</header><?php
} ?>
<section>
    <div id="blog_post_page_information" class="blog_page_information inner-page-shortcodes">
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
					<div class="blog_post_page">
                    <main id="main">
                        <?php

                        if ( have_posts() ):
                        	while ( have_posts() ):
                            	the_post(); ?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class( $article_classes ); ?> >
                                    <header class="">
                                        <?php
                                        // title
                                        if ( is_single() || is_page() ):
                                            ?><h1 class="single_post_title"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),the_title()); ?></h1><?php
                                        else:
                                            ?><h2 class="entry-title"><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),the_title()); ?></a></h2><?php
                                        endif;

                                        // meta
                                        ?>
                                        <p class="detail">
											<span>
												<?php 
													$archive_year  = get_the_time('Y',$post->ID); 
													$archive_month = get_the_time('m',$post->ID); 
													$archive_day   = get_the_time('d',$post->ID); 
												?>
												<a href="<?php echo esc_url(get_day_link( $archive_year, $archive_month, $archive_day)); ?>">
													<?php
														$post_date = strtotime( $post->post_date ); 
														echo date_i18n( "F d,Y", $post_date ); 															
													?>
												</a>
											</span>
											<span>
												<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID',$post->post_author))); ?>">
													<?php 
														$fname = get_the_author_meta( 'first_name', $post->post_author);
														$lname = get_the_author_meta( 'last_name', $post->post_author);
														printf( esc_html__('%s','dreamvilla-multiple-property'),$fname." ".$lname);
													?> 
												</a>
											</span>
											<span><a href="#blog_comments"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$post->comment_count); esc_html_e('comments','dreamvilla-multiple-property'); ?></a></span>
										</p>
                                    </header>

                                    	<?php the_content(); ?>
                                        <?php
                                        wp_link_pages( array(
                                            'before' => '<div class="page-links">' . esc_html__( 'Pages:','dreamvilla-multiple-property'),
                                            'after'  => '</div>',
                                        ) );
                                        ?>
                                    

                                    <footer class="entry-footer">
                                        <?php the_tags( '<span class="tag-links">', '', '</span>' ); ?>
                                    </footer>

                                </article>

                                <?php
                                // comments
                                if ( '0' != get_comments_number() ) {
									?>
				                        <div class="display_blog_reply">
											<h3><?php esc_html_e("Comments","dreamvilla-multiple-property"); ?></h3>
											<ul class="reply_list">
												<?php
													$args = array(
														'post_id' => $post->ID, // use post_id, not post_ID
													);
													$comments = get_comments($args);
													wp_list_comments( array(
														'style' => 'ul',
														'type'	=>	'comment',
														'callback' => 'dreamvilla_mp_mytheme_comment',
														'max_depth' => 2,
													),$comments);
												?>
							               </ul>
										</div>
									<?php } ?>
					<?php if(is_single() && comments_open()) {?> 
					<div class="comment_form_block" id="blog_comments">
						<h3><?php esc_html_e("Comment","dreamvilla-multiple-property"); ?></h3>
						<?php
							$auther_string="";
							$email_string="";
							$url_string="";
							$aria_req_string="";
							if(isset($commenter))
							{
								$auther_string=$commenter['comment_author'];
								$email_string=$commenter['comment_author_email'];
								$url_string=$commenter['comment_author_url'];
							}
							if(isset($aria_req))
							{
								$aria_req_string=$aria_req;	
							}
							$fields =  array(
							  'author' =>
							    '<div class="col-sm-6 padding_left_none comment_half_inputbox">' .
							    ( isset($req) ? '<span class="required">*</span>' : '' ) .
							    '<input id="author" name="author" type="text" required placeholder="'.esc_html__("Full Name*","dreamvilla-multiple-property").'" value="' . esc_attr( $auther_string ) .
							    '" size="30"' . $aria_req_string . ' /></div>',
							
							  'email' =>
							    '<div class="col-sm-6 padding_right_none comment_half_inputbox">' .
							    ( isset($req) ? '<span class="required">*</span>' : '' ) .
							    '<input id="email" name="email" type="text" required placeholder="'.esc_html__("Email Address*","dreamvilla-multiple-property").'" value="' . esc_attr( $email_string  ) .
							    '" size="30"' . $aria_req_string . ' /></div>',
							
							  'url' =>
							    '' .
							    '<input id="url" name="url" type="text" placeholder="'.esc_html__("Website","dreamvilla-multiple-property").'" value="' . esc_attr( $url_string ) .
							    '" size="30" />',
							);
							
							$comments_args = array(
							  'id_form'           => esc_html__('commentform','dreamvilla-multiple-property'),
							  'id_submit'         => esc_html__('submit','dreamvilla-multiple-property'),
							  'class_submit'      => esc_html__('submit blog_comment_submit_btn','dreamvilla-multiple-property'),
							  'name_submit'       => esc_html__('submit','dreamvilla-multiple-property'),
							  'title_reply'       =>  '',
							  'title_reply_to'    =>  '' ,
							  'cancel_reply_link' => esc_html__('Cancel Reply','dreamvilla-multiple-property'),
							  'label_submit'      => esc_html__('SUBMIT NOW','dreamvilla-multiple-property'),
							  'format'            => esc_html__('xhtml','dreamvilla-multiple-property'),
							  'comment_field' =>  
							    '<textarea id="comment" placeholder="'.esc_html__("Message*","dreamvilla-multiple-property").'" name="comment" cols="45" rows="8" required>' .
							    '</textarea>',
							
							  'must_log_in' => '<p class="must-log-in">' .
							    sprintf(
							     '  <a href="%s">'.esc_html__('logged in ','dreamvilla-multiple-property').'</a> '.esc_html__('to post a comment.','dreamvilla-multiple-property'),
							      wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
							    ). '</p>',
							
							  'logged_in_as' => '<p class="logged-in-as">' .
							      sprintf(
							      esc_html__('Logged in as ','dreamvilla-multiple-property').'<a href="%1$s">%2$s</a>. <a href="%3$s" title="'.esc_html__("Log out of this account","dreamvilla-multiple-property").'">'.esc_html__("Log out?","dreamvilla-multiple-property").'</a>',
							      admin_url( 'profile.php' ),
							      $user_identity,
							      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
							    ). '</p>',
							
							  'comment_notes_before' => '<p class="comment-notes">' .
							     ''  . ( isset($req) ? $required_text : '' ) .
							    '</p>',
							
							  'comment_notes_after' => '',
							
							  'fields' => apply_filters( 'comment_form_default_fields', $fields ),
							);
							comment_form($comments_args);
						 ?>
					</div>
                              <?php  }
                                
                            endwhile;

                        endif;
                        ?>

                    </main>
                    <!-- .site-main -->
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
</section>
<?php
/*
 * Footer
 */
get_footer();