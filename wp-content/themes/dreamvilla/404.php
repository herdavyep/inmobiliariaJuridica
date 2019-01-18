<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage DreamVilla
 * @since DreamVilla 1.0
 */

get_header(); ?>

<section>
	<div class="inner-page-search">
		<div class="container">
			<div class="row">
				<section class="error-404 not-found default-404-inner-page">
					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.','dreamvilla-multiple-property'); ?></h1>
					</header><!-- .page-header -->

					<div class="page-content">
						<p><?php esc_html_e('It looks like nothing was found at this location. Maybe try a search?','dreamvilla-multiple-property'); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .page-content -->
				</section><!-- .error-404 -->
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
