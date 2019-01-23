<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage DreamVilla
 * @since DreamVilla 1.0
 */
get_header();

$title_bar_meta = null;
$sidebar_pos 	= null;
$sidebar_type 	= null;
$have_sidebar 	= null;

$title_bar_meta						= rwmb_meta( 'dreamvilla_page_title_bar_meta' );
$sidebar_pos 						= rwmb_meta( 'dreamvilla_sidebar_position_meta' );
$sidebar_type						= rwmb_meta( 'dreamvilla_sidebar' );
$have_sidebar						= $sidebar_pos ? true : false;

wp_enqueue_style('dreamvilla-mp-main-style', get_template_directory_uri().'/css/dreamvilla-mp-main.css', '', '', 'all');
global $post;

//if(function_exists('dreamvilla_mp_the_breadcrumbs') && $title_bar_meta == 1 ) dreamvilla_mp_the_breadcrumbs(); ?>

<section class="">
	<div id="main-content" class="container sliderdirection">
		<?php
		// LEFT SIDEBAR
		if( ('left' == $sidebar_pos) ) { ?>
			<aside class="col-md-4 sidebar leftside">
				<div class="blog_page_information">
					<?php if ( is_active_sidebar( $sidebar_type ) ) : ?>
						<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
							<?php dynamic_sidebar( $sidebar_type ); ?>
						</div><!-- #primary-sidebar -->
					<?php endif; ?>
				</div>						
			</aside>
		<?php }

		if( $have_sidebar ) { ?>
		<div class="col-md-8">
			<article class="default-page-article"><?php 
		} else { ?>
			<div class="col-md-12">
			<article class="default-page-article"><?php 
		}
			
		echo '<div class="row-wrapper-x">';
			  if( have_posts() ): while( have_posts() ): the_post();
				the_content();
			  endwhile;
			  endif;
		echo '</div>';

		wp_link_pages();

		if (comments_open() || get_comments_number() ){
			if ('0' != get_comments_number() ) { ?>
				<div class="display_blog_reply">
					<h3><?php esc_html_e("Comments","dreamvilla-multiple-property"); ?></h3>
					<ul class="reply_list reply_list_quter"><?php
						$args = array(
							'post_id' => $post->ID, // use post_id, not post_ID
						);
						
						$comments = get_comments($args);
						
						wp_list_comments( array(
												'style' => 'ul',
												'type'	=>	'comment',
												'callback' => 'dreamvilla_mp_mytheme_comment',
												'max_depth' => 2,
												),
											$comments);
						?>
					</ul>
				</div>
				<?php } ?>
				<?php if(comments_open()) {?>
				<div class="comment_form_block comment_form_block_quter" id="blog_comments">
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
				<?php 
			}
		} ?>
					
			</article>
		</div><?php

		if( ('right' == $sidebar_pos) ){ ?>

			<aside class="col-md-4 sidebar">
				<div class="blog_page_information">
					<?php if ( is_active_sidebar( $sidebar_type ) ) : ?>
						<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
							<?php dynamic_sidebar( $sidebar_type ); ?>
						</div><!-- #primary-sidebar -->
					<?php endif; ?>
				</div>
			</aside>

		<?php } ?>			
		</div>
	</div>
</section>
<?php get_footer(); ?>
