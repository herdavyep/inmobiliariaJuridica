<?php
// Manage property listing page
add_filter('manage_edit-property_columns', 'dreamvilla_mp_property_list_page');
function dreamvilla_mp_property_list_page( $columns ) {
    $date = $columns['date'];
    
    unset($columns['author']);
    unset($columns['comments']);
    unset($columns['date']);

    $columns['photo'] = 'Photo';
    $columns['price'] = 'Price';
    $columns['type'] = 'Type';
    $columns['property_status'] = 'Listed In';
    $columns['location'] = 'Location';
    $columns['date'] = $date;

    return $columns;
 }
 

add_action( 'manage_property_posts_custom_column', 'dreamvilla_mp_property_table_content', 10, 2 );
function dreamvilla_mp_property_table_content( $column_name, $post_id ) {
    
    if ($column_name == 'photo') { ?>
        <img <?php echo dreamvilla_mp_get_device_image( $post_id ); ?> alt="featured-properties-1" class="img-responsive"><?php
    }

    if ($column_name == 'price') {
        $property_price = get_post_meta( $post_id, 'pprice', true );
        $property_status = get_post_meta( $post_id, 'pstatus', true );
        if( $property_price[0] ){
            if( $property_status == "sale" ){
                printf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
            } else {
                printf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
                echo '<span class="price-label">';
                    printf( esc_html__(' / %s','dreamvilla-multiple-property'),strtoupper($property_price[1]));
                echo '</span>';
            }
            
        }
    }

    if($column_name == 'type') {
        $terms = get_the_terms( $post_id, 'property_category' );
        if ( !empty( $terms ) ) {
            $out = array();
            foreach ( $terms as $term ) {
                $out[] = sprintf( '<a href="%s">%s</a>',
                    esc_url( add_query_arg( array( 'post_type' => "property", 'property_category' => $term->slug ), 'edit.php' ) ),
                    esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'property_category', 'display' ) )
                );
            }
            echo join( ', ', $out );
        }
    }

    if($column_name == 'property_status') {
        $terms = get_the_terms( $post_id, 'property_status' );
        if ( !empty( $terms ) ) {
            $out = array();
            foreach ( $terms as $term ) {
                $out[] = sprintf( '<a href="%s">%s</a>',
                    esc_url( add_query_arg( array( 'post_type' => "property", 'property_status' => $term->slug ), 'edit.php' ) ),
                    esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'property_status', 'display' ) )
                );
            }
            echo join( ', ', $out );
        }
    }

    if($column_name == 'location') {
        $terms = get_the_terms( $post_id, 'location' );
        if ( !empty( $terms ) ) {
            $out = array();
            foreach ( $terms as $term ) {
                $out[] = sprintf( '<a href="%s">%s</a>',
                    esc_url( add_query_arg( array( 'post_type' => "property", 'location' => $term->slug ), 'edit.php' ) ),
                    esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'location', 'display' ) )
                );
            }
            echo join( ', ', $out );
        }
    }
}

// Manage services listing page
add_filter('manage_edit-services_columns', 'dreamvilla_mp_services_list_page');
function dreamvilla_mp_services_list_page( $columns ) {
    $date = $columns['date'];
    
    unset($columns['author']);
    unset($columns['comments']);
    unset($columns['date']);

    $columns['logo'] = 'Icon/Logo';
    $columns['date'] = $date;

    return $columns;
}
 
add_action( 'manage_services_posts_custom_column', 'dreamvilla_mp_services_table_content', 10, 2 );
function dreamvilla_mp_services_table_content( $column_name, $post_id ) {
    
    if ($column_name == 'logo') { ?>
        <img <?php echo dreamvilla_mp_get_device_image( $post_id ); ?> alt="services" class="img-responsive"><?php
    }
}

// Manage photo gallery listing page
add_filter('manage_edit-photo_gallery_columns', 'dreamvilla_mp_photo_gallery_list_page');
function dreamvilla_mp_photo_gallery_list_page( $columns ) {
    $date = $columns['date'];
    
    unset($columns['author']);
    unset($columns['comments']);
    unset($columns['date']);

    $columns['photo'] = 'Photo';
    $columns['category'] = 'Category';
    $columns['date'] = $date;

    return $columns;
}
 
add_action( 'manage_photo_gallery_posts_custom_column', 'dreamvilla_mp_photo_gallery_table_content', 10, 2 );
function dreamvilla_mp_photo_gallery_table_content( $column_name, $post_id ) {
    
    if ($column_name == 'photo') { ?>
        <img <?php echo dreamvilla_mp_get_device_image( $post_id ); ?> alt="photo-gallery" class="img-responsive" width="200" ><?php
    }

    if($column_name == 'category') {
        $terms = get_the_terms( $post_id, 'gallery_category' );
        if ( !empty( $terms ) ) {
            $out = array();
            foreach ( $terms as $term ) {
                $out[] = sprintf( '<a href="%s">%s</a>',
                    esc_url( add_query_arg( array( 'post_type' => "photo_gallery", 'gallery_category' => $term->slug ), 'edit.php' ) ),
                    esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'gallery_category', 'display' ) )
                );
            }
            echo join( ', ', $out );
        }
    }    
}

// Manage people to say listing page
add_filter('manage_edit-what_people_say_columns', 'dreamvilla_mp_what_people_say_list_page');
function dreamvilla_mp_what_people_say_list_page( $columns ) {
    $date = $columns['date'];
    
    unset($columns['author']);
    unset($columns['comments']);
    unset($columns['date']);

    $columns['photo'] = 'Photo';
    $columns['position'] = 'Position';    
    $columns['date'] = $date;

    return $columns;
}
 
add_action( 'manage_what_people_say_posts_custom_column', 'dreamvilla_mp_what_people_say_table_content', 10, 2 );
function dreamvilla_mp_what_people_say_table_content( $column_name, $post_id ) {
    
    if ($column_name == 'photo') { ?>
        <img <?php echo dreamvilla_mp_get_device_image( $post_id ); ?> alt="photo-gallery" class="img-responsive" width="150" ><?php
    }

    if ($column_name == 'position') {
        printf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $post_id, 'People_Position', true ));
    }    
}
?>