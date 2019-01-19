<?php

// Recent Blog
function dreamvilla_recent_blog($atts, $content = null) {    

    extract(shortcode_atts(array(
        'blog_type'             => '1',
        'text_limit'            => '20',
        'number'                => 3,
        'category'              => '',
        'sort'                  => '',
        'order'                 => '',
    ), $atts));

    $args = array(
                    'post_type'         => 'post',
                    'post_status'       => 'publish',
                    'numberposts'       => $number,
                    'category'          => $category,
                    'orderby'           => $sort,
                    'order'             => $order,                       
                    'suppress_filters'  => 0
                );

    $recent_posts = wp_get_recent_posts( $args);
        
    $out = '';

    if( $blog_type == 1 ){
        $out .= '        
        <div class="multiple-recent-posts">                
            <div class="row">';                        
                if( $recent_posts ){
                    foreach( $recent_posts as $recent ){
                        
                        $post_date      = strtotime( $recent["post_date"] );
                        $archive_year   = get_the_time('Y',$recent['ID']); 
                        $archive_month  = get_the_time('m',$recent['ID']); 
                        $archive_day    = get_the_time('d',$recent['ID']); 

                        $fname = get_the_author_meta( 'first_name', $recent["post_author"]);
                        $lname = get_the_author_meta( 'last_name', $recent["post_author"]);
                        
                        $out .= '
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <img '.dreamvilla_mp_get_device_image($recent["ID"]).' alt="blog-1" class="img-responsive">
                            <h6 class="multiple-blog-title">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$recent["post_title"]).'</h6>
                            <a href="'.esc_url(get_day_link($archive_year, $archive_month, $archive_day)).'"><span> '.date_i18n( "F d,Y", $post_date ).' </span></a>
                            <a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'"><span>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$fname).' '. " " . sprintf( esc_html__('%s','dreamvilla-multiple-property'),$lname).'</span></a>
                            <p class="multiple-blog-overview">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),wp_trim_words( $recent["post_excerpt"], 12 )).'</p>
                            <a class="multiple-blog-read-more" href="'.esc_url(get_permalink($recent["ID"])).'">'.esc_html__('Leer más','dreamvilla-multiple-property').'</a><i class="fa fa-long-arrow-right"> </i>
                        </div>';
                    }
                }
            $out .= '                
        </div>
    </div>';
    } else {
        $out .= '
        <div class="multiple-recent-posts multiple-recent-posts-homepage2">
            <div class="row">';
                if( $recent_posts ){
                    foreach( $recent_posts as $recent ){                                
                        
                        $post_date      = strtotime( $recent["post_date"] );
                        $archive_year   = get_the_time('Y',$recent['ID']); 
                        $archive_month  = get_the_time('m',$recent['ID']); 
                        $archive_day    = get_the_time('d',$recent['ID']); 

                        $fname = get_the_author_meta( 'first_name', $recent["post_author"]);
                        $lname = get_the_author_meta( 'last_name', $recent["post_author"]);
                        
                        $out .= '
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <img '.dreamvilla_mp_get_device_image($recent["ID"]).' alt="blog-1" class="img-responsive">
                            <div class="blog-post-description">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 blogpost-avtar-image padding_right_none">
                                        '.get_avatar( get_the_author_meta( $recent["ID"] )).'
                                    </div>
                                    <div class="col-xs-10 col-sm-10 col-md-10">
                                        <h6 class="multiple-blog-title">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$recent["post_title"]).'</h6>
                                        <a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'" class="post-author-name"><span>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$fname).' '. " " . sprintf( esc_html__('%s','dreamvilla-multiple-property'),$lname).'</span></a>
                                        <a href="'.esc_url(get_day_link($archive_year, $archive_month, $archive_day)).'"><span> '.date_i18n( "F d,Y", $post_date ).' </span></a>
                                    </div>
                                </div>
                                <p class="multiple-blog-overview">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),wp_trim_words( $recent["post_excerpt"], 12 )).'</p>
                            </div>
                            <a class="multiple-blog-read-more" href="'.esc_url(get_permalink($recent["ID"])).'">'.esc_html__('Leer más','dreamvilla-multiple-property').'<i class="fa fa-long-arrow-right pull-right"> </i></a>
                        </div>';
                    }
                }
            $out .= '            
            </div>
        </div>';
    }

    return $out;
}
add_shortcode('recent_blog','dreamvilla_recent_blog');