<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage DreamVilla
 * @since DreamVilla 1.0
 */
wp_enqueue_style('dreamvilla-mp-main-style', get_template_directory_uri().'/css/dreamvilla-mp-main.css', '', '', 'all');
get_header(); ?>
<section>
	<div class="inner-page-search">
		<div class="container">
			<div class="row">
				<?php if ( have_posts() ) : ?>

					<header class="page-header">
						<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s','dreamvilla-multiple-property'), get_search_query() ); ?></h1>
					</header><!-- .page-header -->

					<?php
					// Start the loop.
					while ( have_posts() ) : the_post(); ?>

						<?php
						/*
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'content', 'search' );

					// End the loop.
					endwhile;

					// Previous/next page navigation.
					the_posts_pagination( array(
						'prev_text'          => esc_html__( 'Previous page','dreamvilla-multiple-property'),
						'next_text'          => esc_html__( 'Next page','dreamvilla-multiple-property'),
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page','dreamvilla-multiple-property') . ' </span>',
					) );

				// If no content, include the "No posts found" template.
				else :
					get_template_part( 'content', 'none' );

				endif;
				?>				
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
