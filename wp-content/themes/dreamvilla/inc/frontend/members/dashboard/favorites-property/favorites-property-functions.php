<?php
function dreamvilla_mp_ajax_favorites_property_init(){ 
    
    wp_register_script('dreamvilla-favorites-property', get_template_directory_uri() . '/inc/frontend/js/favorites-property.js', array('jquery') );
    wp_enqueue_script('dreamvilla-favorites-property');

    wp_localize_script( 'dreamvilla-favorites-property', 'favorites_property_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

    // Add Favorites Property
    add_action( 'wp_ajax_dreamvilla_mp_ajax_add_favorites_property', 'dreamvilla_mp_ajax_add_favorites_property' );    

    // Delete Favorites Property
    add_action( 'wp_ajax_dreamvilla_mp_ajax_delete_favorites_property', 'dreamvilla_mp_ajax_delete_favorites_property' );
}

// Execute the action only if the user isn't logged in
add_action('init', 'dreamvilla_mp_ajax_favorites_property_init');

function dreamvilla_mp_ajax_add_favorites_property() {

    // Get user info
    global $current_user;
    get_currentuserinfo();

    $Agent_ID       = $current_user->ID;
    $Property_ID    = $_POST['Property_ID'];

     if( $Agent_ID > 0 ){

        $Agent_Favorites_Property = get_user_meta( $Agent_ID, 'favorites_property', true );
        
        if( !empty($Agent_Favorites_Property) && ( !in_array( $Property_ID, $Agent_Favorites_Property ) ) ) {
            array_push( $Agent_Favorites_Property, $Property_ID );
            
        } else {
            $Agent_Favorites_Property = array( $Property_ID );
        }

        update_user_meta( $Agent_ID, 'favorites_property', $Agent_Favorites_Property );

        $ajax_response = array( 'success' => true );        
    } else {
        $ajax_response = array( 'failed' => true );
    }

    echo json_encode( $ajax_response );
    die;
}

function dreamvilla_mp_ajax_delete_favorites_property() {

    // Get user info
    global $current_user;
    get_currentuserinfo();

    $Agent_ID       = $current_user->ID;
    $Property_ID    = $_POST['Property_ID'];

    $Agent_Favorites_Property = get_user_meta( $Agent_ID, 'favorites_property', true );
    
    if( !empty($Agent_Favorites_Property) && ( $key = array_search( $Property_ID, $Agent_Favorites_Property ) ) !== false ) {
        unset($Agent_Favorites_Property[$key]);
        update_user_meta( $Agent_ID, 'favorites_property', $Agent_Favorites_Property );
    }

    $ajax_response = array( 'success' => true );

    echo json_encode( $ajax_response );
    die;
}

?>