<?php
function dreamvilla_mp_ajax_saved_searches_init(){ 
    
    wp_register_script('dreamvilla-saved-searches', get_template_directory_uri() . '/inc/frontend/js/saved-searches.js', array('jquery') );
    wp_enqueue_script('dreamvilla-saved-searches');

    wp_localize_script( 'dreamvilla-saved-searches', 'saved_searches_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'loadingmessage' => __('Sending Data, please wait...') ) );

    // Add Saved Searches
    add_action( 'wp_ajax_dreamvilla_mp_ajax_add_saved_searches', 'dreamvilla_mp_ajax_add_saved_searches' );

    // Delete Saved Searches
    add_action( 'wp_ajax_dreamvilla_mp_ajax_delete_saved_searches', 'dreamvilla_mp_ajax_delete_saved_searches' );
}

// Execute the action only if the user isn't logged in
if( is_user_logged_in() ) {
    add_action('init', 'dreamvilla_mp_ajax_saved_searches_init');
}

function dreamvilla_mp_ajax_add_saved_searches() {

    // Get user info
    global $current_user;
    get_currentuserinfo();

    $Agent_ID = $current_user->ID;

    $Agent_Saved_Searches = get_user_meta( $Agent_ID, 'saved_searches', true );
    
    if(isset($_POST['saved_searches_title']) )
        $saved_searches_title = $_POST['saved_searches_title'];
    else
        $saved_searches_title = '';

    if(isset($_POST['sprice']) )
        $sprice = $_POST['sprice'];
    else
        $sprice = '';

    if(isset($_POST['eprice']) )
        $eprice = $_POST['eprice'];
    else
        $eprice = '';

    if(isset($_POST['keyword']) )
        $keyword = $_POST['keyword'];
    else
        $keyword = '';

    if(isset($_POST['type']) )
        $type = $_POST['type'];
    else
        $type = '';

    if(isset($_POST['status']) )
        $status = $_POST['status'];
    else
        $status = '';

    if(isset($_POST['location']) )
        $location = $_POST['location'];
    else
        $location = '';

    if(isset($_POST['bedroom']) )
        $bedroom = $_POST['bedroom'];
    else
        $bedroom = '';

    if(isset($_POST['bathroom']) )
        $bathroom = $_POST['bathroom'];
    else
        $bathroom = '';

    if(isset($_POST['garage']) )
        $garage = $_POST['garage'];
    else
        $garage = '';

    if(isset($_POST['features']) )
        $features = $_POST['features'];
    else
        $features = '';

    $New_Searches = array();

    $New_Searches[] = array( "title" => $saved_searches_title, "sprice" => $sprice, "eprice" => $eprice, "keyword" => $keyword, "type" => $type, "status" => $status, "location" => $location, "bedroom" => $bedroom, "bathroom" => $bathroom, "garage" => $garage , "features" => $features );
        
    if( !empty($Agent_Saved_Searches) ) {
        array_push( $Agent_Saved_Searches, $New_Searches );        
    } else {
        $Agent_Saved_Searches = array( $New_Searches );
    }

    update_user_meta( $Agent_ID, 'saved_searches', $Agent_Saved_Searches );

    $ajax_response = array( 'success' => true );

    echo json_encode( $ajax_response );
    die;
}

function dreamvilla_mp_ajax_delete_saved_searches() {

    // Get user info
    global $current_user;
    get_currentuserinfo();

    $Agent_ID = $current_user->ID;

    $Data_ID = $_POST['Data_ID'];

    $Agent_Saved_Searches = get_user_meta( $Agent_ID, 'saved_searches', true );
    
    if( !empty($Agent_Saved_Searches) && ( !empty($Data_ID) || $Data_ID == 0 ) ) {
        unset($Agent_Saved_Searches[$Data_ID]);
        update_user_meta( $Agent_ID, 'saved_searches', $Agent_Saved_Searches );
    }

    $ajax_response = array( 'success' => true );

    echo json_encode( $ajax_response );
    die;
}

?>