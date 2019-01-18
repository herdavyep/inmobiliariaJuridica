<?php
// Login user functions
require_once get_template_directory() . '/inc/frontend/members/login/login-functions.php';

// Register user functions
require_once get_template_directory() . '/inc/frontend/members/register/register-functions.php';

// Reset password functions
require_once get_template_directory() . '/inc/frontend/members/reset-password/reset-functions.php';

// User Profile functions
require_once get_template_directory() . '/inc/frontend/members/dashboard/my-profile/profile-functions.php';

// User Submit Property functions
require_once get_template_directory() . '/inc/frontend/members/dashboard/submit-property/submit-property-functions.php';

// User Property List functions
require_once get_template_directory() . '/inc/frontend/members/dashboard/my-property-list/my-property-list-functions.php';

// User Favorites Property functions
require_once get_template_directory() . '/inc/frontend/members/dashboard/favorites-property/favorites-property-functions.php';

// User Saved Searches functions
require_once get_template_directory() . '/inc/frontend/members/dashboard/saved-searches/saved-searches-functions.php';

// User Invoice functions
require_once get_template_directory() . '/inc/frontend/members/dashboard/invoice/invoice-functions.php';

// User Package functions
require_once get_template_directory() . '/inc/frontend/members/dashboard/package/package-functions.php';

// User Single Property functions
require_once get_template_directory() . '/inc/frontend/members/dashboard/single-property/single-property-function.php';

// Membership expired email notification
if (! wp_next_scheduled ( 'dreamvilla_multiple_daily_call' ) ) {
    wp_schedule_event(time(), 'daily', 'dreamvilla_multiple_daily_call');    
}

// Membership expired email notification
add_action( 'dreamvilla_multiple_daily_call', 'dreamvilla_multiple_do_daily' );
function dreamvilla_multiple_do_daily() {
    global $dreamvilla_options;
    
    $Day_Ago = $dreamvilla_options['notify_membership_expired'];
    $Day_Ago = $Day_Ago;

    $Today_Date = date('Y-m-d');
    $Expiry_Date = date('Y-m-d', strtotime( $Day_Ago.' days'));
    
    // Package Expired Notification Mail
    /*$args = array(
        'meta_query' => array(            
            'relation' => 'AND',
            array(
                'key'     => 'membership_expiry_date',
                'value'   => array($Today_Date,$Expiry_Date),
                'type'    => 'DATE',
                'compare' => 'BETWEEN'
            ),
            array(
                'key'     => 'package_notification_status',
                'value'   => "active",
                'compare' => '='
            )
        )
    );

    $user_query = new WP_User_Query( $args );

    // Get the results
    $user_detail = $user_query->get_results();

    // Check for results
    if( !empty($user_detail) ){
        foreach ($user_detail as $users){
            $User_ID    = $users->ID;
            $user       = get_userdata( $User_ID );
            $Email_ID   = $users->user_email;     

            $Package_Expired  = get_user_meta( $User_ID, 'membership_expiry_date' );            

            $UserMessage  = '';
            $UserMessage .= sprintf( esc_html__( 'Your Username is : %s', 'dreamvilla-multiple-property' ), $user->user_login ) . "\r\n\r\n";
            $UserMessage .= sprintf( esc_html__( 'Your Email ID is : %s', 'dreamvilla-multiple-property' ), $user->user_email ) . "\r\n\r\n";
            $UserMessage .= sprintf( esc_html__( 'Your Package Expired On : %s', 'dreamvilla-multiple-property' ), $Package_Expired[0] ) . "\r\n";

            wp_mail( $user->user_email, sprintf( esc_html__( 'Your Package Expired On %s', 'dreamvilla-multiple-property' ), $Package_Expired[0] ), $UserMessage );
        }
    }

    wp_reset_query();*/

    // Check Package And Expired Package
    $args = array(
        'meta_query' => array(                
            'relation' => 'AND',
            array(
                'key'     => 'membership_expiry_date',
                'value'   => $Today_Date,
                'type'    => 'DATE',
                'compare' => '<='
            ),
            array(
                'key'     => 'package_notification_status',
                'value'   => "active",
                'compare' => '='
            )
        )
    );

    $user_query = new WP_User_Query( $args );

    // Get the results
    $user_detail = $user_query->get_results();

    // Check for results
    if( !empty($user_detail) ){
        foreach ($user_detail as $users){
            
            $User_ID    = $users->ID;
            $user       = get_userdata( $User_ID );
            $Email_ID   = $users->user_email;

            $active_package_detail  = get_user_meta( $User_ID, 'package_detail' );
            
            update_user_meta( $User_ID, 'package_detail', array( "id" => $active_package_detail[0]['id'], 'expiry_date' => $active_package_detail[0]['expiry_date'], "list_item_remain" => "done", "featured_item_remain" => "done", 'status' => "deactive" ) );
            update_user_meta( $User_ID, 'package_notification_status', "deactive" );

            $headers = 'From: No Reply <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";

            $UserMessage  = '';           
            $UserMessage  = esc_html__('Membership Cancelled,','dreamvilla-multiple-property') . "\r\n\r\n";
            $UserMessage .= sprintf( esc_html__("Your subscription on %s was cancelled because it expired. Thank you. ",'dreamvilla-multiple-property'), get_option('blogname')) . "\r\n\r\n";

            wp_mail( $user->user_email, sprintf(esc_html__('[%s] Membership Cancelled','dreamvilla-multiple-property'), get_option('blogname')), $UserMessage, $headers );
        }
    }
}

// retrieves the attachment ID from the file URL
function dreamvilla_mp_get_image_id($image_url) {
    global $wpdb;
    $attachment = $wpdb->get_col($wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ) );
    if( isset($attachment[0]) ){
        return $attachment[0];
    } else {
        return '';
    }
}

function dreamvilla_mp_agent_favorites_property(){
    $User_ID                = get_current_user_id();
    $User_Detail            = get_userdata( $User_ID );
    $Current_User_Detail    = get_user_meta( $User_ID );

    $Property_Agent_Favorites = array();

    if( isset($Current_User_Detail['favorites_property'][0]) ){
                                
        $Agent_Favorites_Property = get_user_meta( $User_ID, 'favorites_property' );
        $Property_Agent_Favorites = array();
        
        foreach ($Agent_Favorites_Property[0] as $key => $value) {
            $Property_Agent_Favorites[$key] = $Agent_Favorites_Property[0][$key];
        }                           
    }

    return $Property_Agent_Favorites;
}

function dreamvilla_mp_agent_favorites_property_icon($Property_ID){
    global $dreamvilla_options;
    if(!(empty($dreamvilla_options['show_front_end'])) && $dreamvilla_options['show_front_end']=="yes") {
        $User_ID                = get_current_user_id();
        $User_Detail            = get_userdata( $User_ID );
        $Current_User_Detail    = get_user_meta( $User_ID );

        $Property_Agent_Favorites = array();

        if( isset($Current_User_Detail['favorites_property'][0]) ){
                                    
            $Agent_Favorites_Property = get_user_meta( $User_ID, 'favorites_property' );
            $Property_Agent_Favorites = array();
            if( !empty($Agent_Favorites_Property[0] ) ){
                foreach ($Agent_Favorites_Property[0] as $key => $value) {
                    $Property_Agent_Favorites[$key] = $Agent_Favorites_Property[0][$key];
                }
            }                           
        }

        if( !empty($Property_Agent_Favorites) && in_array($Property_ID, $Property_Agent_Favorites) ){
            return '<a href="javascript:void(0)" class="delete-favorites-property" property-id="'.$Property_ID.'"><i class="fa fa-heart"></i></a>';
        } else {
            if( $User_ID > 0 ){
                return '<a href="javascript:void(0)" class="add-favorites-property" property-id="'.$Property_ID.'"><i class="fa fa-heart-o"></i></a>';
            } else {
                return '<a href="javascript:void(0)" class="open-login-regster-model" property-id="'.$Property_ID.'"><i class="fa fa-heart-o"></i></a>';
            }
        }
    }
}

function dreamvilla_mp_get_taxonomy_name_by_id($Cat_ID,$Taxonomy_Name){
    
    if( !empty($Cat_ID) && !empty($Taxonomy_Name) ){
        $Taxonomy_Detail = get_term( $Cat_ID, $Taxonomy_Name );
        
        if( $Taxonomy_Detail->name )
            return $Taxonomy_Detail->name;
        else
            return '';
    } else {
        return '';
    }
}

?>