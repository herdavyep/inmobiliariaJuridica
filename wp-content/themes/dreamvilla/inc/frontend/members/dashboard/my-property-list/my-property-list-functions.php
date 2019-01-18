<?php
function dreamvilla_mp_ajax_property_list_init(){ 
    
    wp_register_script('dreamvilla-property-list', get_template_directory_uri() . '/inc/frontend/js/property-list.js', array('jquery') );
    wp_enqueue_script('dreamvilla-property-list');

    global $dreamvilla_options;

    $Redirect_URL  = "";
    
    // User Redirect To Properties List Page
    if( !empty( $dreamvilla_options[ 'user_dashboard_property_list' ]  ) ) {
        $Properties_List_URL = get_permalink( $dreamvilla_options[ 'user_dashboard_property_list' ] );
        if ( !empty( $Properties_List_URL ) ) {
            $URL_Separator = ( parse_url( $Properties_List_URL, PHP_URL_QUERY ) == NULL ) ? '?' : '&';
            $URL_Parameter = 'property-deleted=true';
            $Redirect_URL = $Properties_List_URL . $URL_Separator . $URL_Parameter;            
        }
    }
    
    wp_localize_script( 'dreamvilla-property-list', 'delete_property_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'redirect_url' => $Redirect_URL ) );

    add_action( 'wp_ajax_dreamvilla_mp_ajax_delete_property', 'dreamvilla_mp_ajax_delete_property' );
}

// Execute the action only if the user isn't logged in
if( is_user_logged_in() ) {
    add_action('init', 'dreamvilla_mp_ajax_property_list_init');
}

function dreamvilla_mp_ajax_delete_property() {

    $Agent_ID       = $_POST['Agent_ID'];
    $Property_ID    = $_POST['Property_ID'];

    $Agent_Property_List = get_user_meta( $Agent_ID, 'pagentproperty', true );
    
    if( isset($Agent_Property_List) && ( $key = array_search( $Property_ID, $Agent_Property_List ) ) !== false ) {
        unset($Agent_Property_List[$key]);
        update_user_meta( $Agent_ID, 'pagentproperty', $Agent_Property_List );
    }
    
    $PropertyGallery = get_post_meta( $Property_ID, 'propertygallery', true );
    if( $PropertyGallery ){
        foreach ($PropertyGallery as $key => $value) {
            $Attachment_ID = dreamvilla_mp_get_image_id($PropertyGallery[$key]['pgallery']);
            if( isset($Attachment_ID) ){
                $Attachment_ID = intval( $Attachment_ID );
                wp_delete_attachment( $Attachment_ID );
            }
        }
    }

    $Attachment_ID = get_post_thumbnail_id( $Property_ID );
    if( $Attachment_ID ){
        $Attachment_ID = intval( $Attachment_ID );
        wp_delete_attachment( $Attachment_ID );
    }

    wp_delete_post( $Property_ID );

    $ajax_response = array( 'success' => true, "Agent_ID" => $Agent_ID, "Property_ID" => $Property_ID );

    echo json_encode( $ajax_response );
    die;
}

?>