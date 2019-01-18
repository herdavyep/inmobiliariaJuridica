<?php
/*
 * Template Name: DSIDXPress Template
 */
get_header();

$post;
$dreamvilla_mp_article_classes = '';
?>
<header>
    <div class="inner-page-header-area <?php if( !empty($dreamvilla_options['dreamvilla_header_variation']) && $dreamvilla_options['dreamvilla_header_variation'] == 2 ) { echo "v1"; } ?>">
        <?php if( dreamvilla_mp_get_device_image( get_option('page_for_posts') ) ){ ?>
            <img <?php echo dreamvilla_mp_get_device_image( get_option('page_for_posts') ); ?> alt="Banner Image"><?php
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
                    <h5><span>
                        <a href="<?php echo esc_url( home_url( '/' )); ?>"><?php esc_html_e('Home','dreamvilla-multiple-property'); ?></a> >                        
                        <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$post->post_title); ?>
                    </span></h5>
                </div>
            </div>
        </div>
    </div>
</header>
<section class="dsidxpress_section">
    <div id="blog_post_page_information" class="blog_page_information inner-page-shortcodes">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-8">
                    <div class="blog_post_page">
                        <main id="main"><?php
                            if ( have_posts() ):
                                while ( have_posts() ): the_post(); ?>
                                    <article id="post-<?php the_ID(); ?>" <?php post_class( $dreamvilla_mp_article_classes ); ?> >
                                        <header class="">
                                            <?php
                                            if ( is_single() || is_page() ):
                                                ?><h1 class="single_post_title"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),the_title()); ?></h1><?php
                                            else:
                                                ?><h2 class="entry-title"><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),the_title()); ?></a></h2><?php
                                            endif;
                                            ?>                                            
                                        </header>

                                        <?php the_content();

                                        wp_link_pages( array(
                                            'before' => '<div class="page-links">' . esc_html__( 'Pages:','dreamvilla-multiple-property'),
                                            'after'  => '</div>',
                                        ) ); ?>                                        

                                        <footer class="entry-footer">
                                            <?php the_tags( '<span class="tag-links">', '', '</span>' ); ?>
                                        </footer>
                                    </article><?php 
                                endwhile;
                            endif; ?>
                        </main>     
                    </div>
                </div>                  
                <div class="col-md-4 col-lg-4">
                    <?php if ( is_active_sidebar( 'dsidxpress_sidebar' ) ) : ?>
                    <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
                        <?php dynamic_sidebar( 'dsidxpress_sidebar' ); ?>
                    </div><!-- #primary-sidebar -->
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>