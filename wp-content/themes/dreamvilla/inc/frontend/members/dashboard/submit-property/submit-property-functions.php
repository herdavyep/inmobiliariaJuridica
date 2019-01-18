<?php
$Redirect_URL  = "";
function dreamvilla_mp_ajax_submit_property_init(){ 
    
    wp_register_script('dreamvilla-submit-property', get_template_directory_uri() . '/inc/frontend/js/submit-property.js', array('jquery') );
    wp_enqueue_script('dreamvilla-submit-property');

    wp_localize_script( 'dreamvilla-submit-property', 'submit_property_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'loadingmessage' => __('Sending Proprety info, please wait...') ) );

    add_action( 'wp_ajax_dreamvilla_mp_ajax_submit_property', 'dreamvilla_mp_ajax_submit_property' );
}

// Execute the action only if the user isn't logged in
if( is_user_logged_in() ) {
    add_action('init', 'dreamvilla_mp_ajax_submit_property_init');
}

function dreamvilla_mp_ajax_submit_property(){

    global $dreamvilla_options;

    // Get user info
    global $current_user;
    get_currentuserinfo();

    // Get property action
    $action = $_POST['property_action'];
    $property_id = 0;
    
    $single_property_detail = get_user_meta( $current_user->ID, 'add_single_property', true );

    // Array for errors
    $errors_info = array();

    if( wp_verify_nonce( $_POST['submit-property-security'], 'dreamvilla-ajax-submit-property-nonce' ) ){

        // Start with basic array
        $new_property = array(
            'post_type'     =>  'property'
        );

        // Property Title
        if( isset ( $_POST['ptitle'] ) && ! empty ( $_POST['ptitle'] ) ) {
            $new_property['post_title'] = sanitize_text_field( $_POST['ptitle'] );
        }

        // Property Description
        if( isset ( $_POST['pdescription'] ) && ! empty ( $_POST['pdescription'] ) ) {
            $new_property['post_content'] = wp_kses_post( $_POST['pdescription'] );
        }

        // Property Author
        $new_property['post_author'] = $current_user->ID;

        if( $action == "submit" ){

            // Property Status
            $property_submit_status = $dreamvilla_options[ 'default_submit_status' ];
            if ( !empty( $property_submit_status ) ) {
                $new_property['post_status'] = $property_submit_status;
            } else {
                $new_property['post_status'] = 'pending';
            }            

            // Create Property
            $property_id = wp_insert_post( $new_property );
            update_user_meta( $current_user->ID, 'add_single_property', '' );

            if( !empty($single_property_detail) && $single_property_detail[1] == 2 )
                update_post_meta( $property_id, 'pfetured', "yes" );

        } else {
            $new_property['ID'] = intval( $_POST['property_id'] );
            $property_id = wp_update_post( $new_property );
            if( $property_id > 0 ){
                $updated_notification = true;
            }
        }

        if( $property_id > 0 ) {            
            
            if( $action == "submit" && empty($single_property_detail) ){
                $active_package_detail  = get_user_meta( $current_user->ID, 'package_detail' );

                $list_item_remain = $active_package_detail[0]['list_item_remain'];
                
                if( $list_item_remain != "" && $list_item_remain != "0" ){

                    $list_item_remain = $list_item_remain - 1;
                    
                    if( $list_item_remain == 0 ){
                        
                        $list_item_remain = "done";
                        $package_status = "deactive";

                        $headers = 'From: No Reply <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";

                        $UserMessage  = esc_html__('Account Downgraded,','dreamvilla-multiple-property') . "\r\n\r\n";
                        $UserMessage .= sprintf( esc_html__("Hello, You downgraded your subscription on %s. Because your listings number was greater than what the actual package offers, we set the status of all your listings to \"expired\". You will need to choose which listings you want live and send them again for approval. Thank you!",'dreamvilla-multiple-property'), get_option('blogname')) . "\r\n\r\n";

                        wp_mail($current_user->user_email, sprintf(esc_html__('[%s] Account Downgraded','dreamvilla-multiple-property'), get_option('blogname')), $UserMessage, $headers);

                    } else {
                        $package_status = $active_package_detail[0]['status'];
                    }

                    update_user_meta( $current_user->ID, 'package_detail', array( "id" => $active_package_detail[0]['id'], 'expiry_date' => $active_package_detail[0]['expiry_date'], "list_item_remain" => $list_item_remain, "featured_item_remain" => $active_package_detail[0]['featured_item_remain'], 'status' => $package_status ) );
                }
            }

            // Add Property Price Post Meta
            if( isset ( $_POST['pprice'] ) && !empty ( $_POST['pprice'] ) ) {
                update_post_meta( $property_id, 'price', $_POST['pprice'] );
            }

            // Add Property Price And Property Type Post Meta
            if( isset ( $_POST['pprice'] ) && !empty ( $_POST['pprice'] ) ) {
                update_post_meta( $property_id, 'pprice', array( $_POST['pprice'], $_POST['ppricetype'] ) );
            }

            // Add Property Featured Image Post Meta
            if( isset($_POST['featured_image_id']) ){
                update_post_meta ( $property_id, '_thumbnail_id', $_POST['featured_image_id'] );
            }

            // Add Property Gallery Post Meta
            if( isset($_POST['property_gallery']) ){
                $pgallery = $_POST['property_gallery'];
                $pgalleryarray = array();
                if( $pgallery ){
                    foreach ($pgallery as $key => $value) {
                        if( isset($_POST['featured_image_id']) ){
                            if( isset($value) && $_POST['featured_image_id'] != $value ){
                                $feat_image_url = wp_get_attachment_url( $value );
                                $pgalleryarray[$key] = array( 'pgallery' => $feat_image_url );
                            }
                        } else {
                            $feat_image_url = wp_get_attachment_url( $value );
                            $pgalleryarray[$key] = array( 'pgallery' => $feat_image_url );
                        }
                    }
                }
                update_post_meta( $property_id, 'propertygallery', $pgalleryarray );
            }

            // Add Property Address Post Meta
            if( isset ( $_POST['paddress'] ) && !empty ( $_POST['paddress'] ) ) {
                update_post_meta( $property_id, 'paddress', $_POST['paddress'] );
            }

            // Add Property City Post Meta
            if( isset ( $_POST['pcity'] ) && !empty ( $_POST['pcity'] ) ) {
                update_post_meta( $property_id, 'pcity', $_POST['pcity'] );
            }

            // Add Property State Post Meta
            if( isset ( $_POST['pstate'] ) && !empty ( $_POST['pstate'] ) ) {
                update_post_meta( $property_id, 'pstate', $_POST['pstate'] );
            }

            // Add Property Country Post Meta
            if( isset ( $_POST['pcountry'] ) && !empty ( $_POST['pcountry'] ) ) {
                update_post_meta( $property_id, 'pcountry', $_POST['pcountry'] );
            }

            // Add Property Pincode Post Meta
            if( isset ( $_POST['ppincode'] ) && !empty ( $_POST['ppincode'] ) ) {
                update_post_meta( $property_id, 'ppincode', $_POST['ppincode'] );
            }

            // Add Property Latitude Longitude Post Meta
            if( isset ( $_POST['platitude'] ) ||  isset ( $_POST['plongitude'] ) ) {
                update_post_meta( $property_id, 'platlon', array( $_POST['platitude'], $_POST['plongitude'] ) );
            }            

            // Add Property Banner Image Post Meta
            if( isset($_POST['propertybannerimage']) ){
                $propertybannerimage = $_POST['propertybannerimage'];
                $propertybannerimage_url = wp_get_attachment_url( $propertybannerimage );
                update_post_meta( $property_id, 'propertybannerimage', $propertybannerimage_url );
            }

            // Add Property Essential Post Meta
            if( isset($_POST['essentialtitle']) ){
                $essentialtitle = $_POST['essentialtitle'];
                $essentialvalue = $_POST['essentialvalue'];
                $essentialarray = array();
                if( $essentialtitle ){
                    foreach ($essentialtitle as $key => $value) {
                        if( $value ){
                            $essentialarray[$key] = array( 'essentialtitle' => $value, 'essentialvalue' => $essentialvalue[$key] );
                        }       
                    }
                    update_post_meta( $property_id, 'essentialinformation', $essentialarray );
                }
            }

            // Add Property Amenities Post Meta
            if( isset($_POST['pamenities']) ){
                $pamenities = $_POST['pamenities'];
                $pamenitiesphoto = $_POST['pamenitiesphoto'];
                
                $pamenitiesarray = array();
                if( $pamenities ){
                    foreach ($pamenities as $key => $value) {
                        if( $value ){
                            $amenities_photo_url = wp_get_attachment_url( $pamenitiesphoto[$key] );
                            $pamenitiesarray[$key] = array( 'pamenities' => $value, 'pamenitiesphoto' => $amenities_photo_url );                                                        
                        }       
                    }
                    update_post_meta( $property_id, 'propertyamenities', $pamenitiesarray );
                }
            }
            

            // Add Property Interior Post Meta
            if( isset($_POST['interiortitle']) ){
                $interiortitle = $_POST['interiortitle'];
                $interiordescription = $_POST['interiordescription'];
                $pinteriorarray = array();
                if( $interiortitle ){
                    foreach ($interiortitle as $key => $value) {
                        if( $value ){
                            $pinteriorarray[$key] = array( 'interiortitle' => $value, 'interiordescription' => $interiordescription[$key] );
                        }       
                    }
                    update_post_meta( $property_id, 'pinteriorarray', $pinteriorarray );
                }
            }            
            
            // Add Property Exterior Post Meta
            if( isset($_POST['exteriortitle']) ){
                $exteriortitle = $_POST['exteriortitle'];
                $exteriordescription = $_POST['exteriordescription'];
                $pexteriorarray = array();
                if( $exteriortitle ){
                    foreach ($exteriortitle as $key => $value) {
                        if( $value ){
                            $pexteriorarray[$key] = array( 'exteriortitle' => $value, 'exteriordescription' => $exteriordescription[$key] );
                        }       
                    }
                    update_post_meta( $property_id, 'pexteriorarray', $pexteriorarray );
                }
            }           

            // Add Property Room Dimensions Post Meta
            if( isset($_POST['proomsize']) ){
                $proomsize = $_POST['proomsize'];
                $proomtype = $_POST['proomtype'];   
                $proom = array();
                if( $proomsize ){
                    foreach ($proomsize as $key => $value) {
                        if( $value || $proomtype[$key] ){
                            $proom[$key] = array( 'proomsize' => $value, 'proomtype' => $proomtype[$key] );
                        }       
                    }
                }
                update_post_meta( $property_id, 'propertyroom', $proom );
            }

            // Add Property Number Of Rooms Post Meta
            $Count_Bedroom = 0;
            if( !empty($proom) ){
                foreach ($proom as $key => $value) {
                    if( in_array( $proom[$key]['proomtype'], dreamvilla_mp_get_bedroom_type() )  ){
                        $Count_Bedroom++;
                    }
                }
                if( $Count_Bedroom > 0 ){
                    update_post_meta( $property_id, 'propertytotalroom', $Count_Bedroom );
                } else {
                    update_post_meta( $property_id, 'propertytotalroom', '' );
                }
            }

            // Add Property Bathroom Dimensions Post Meta
            if( isset($_POST['pbathroomsize']) ){
                $pbathroomsize = $_POST['pbathroomsize'];   
                $pbathroom = array();
                if( $pbathroomsize ){
                    foreach ($pbathroomsize as $key => $value) {
                        if( $value ){
                            $pbathroom[$key] = array( 'pbathroomsize' => $value );
                        }       
                    }
                    update_post_meta( $property_id, 'propertybathroom', $pbathroom );
                }
            }            

            // Add Property Number Of Bathroom Post Meta
            if( !empty($pbathroom) ){
                $total_bathroom = count($pbathroom);
                if( $total_bathroom > 0 ){
                    update_post_meta( $property_id, 'propertytotalbathroom', $total_bathroom ); 
                } else {
                    update_post_meta( $property_id, 'propertytotalbathroom', '' );  
                }
            }

            // Add Property Kitchen Dimensions Post Meta
            if( $_POST['pkitchensize'] ){
                $pkitchensize = $_POST['pkitchensize']; 
                $pkitchen = array();
                if( $pkitchensize ){
                    foreach ($pkitchensize as $key => $value) {
                        if( $value ){
                            $pkitchen[$key] = array( 'pkitchensize' => $value );
                        }       
                    }
                    update_post_meta( $property_id, 'propertykitchen', $pkitchen );
                }
            }            

            // Add Property Swimmingpool Dimensions Post Meta
            if( $_POST['pswimmingpoolsize'] ){
                $pswimmingpoolsize = $_POST['pswimmingpoolsize'];   
                $pkitchen = array();
                if( $pswimmingpoolsize ){
                    foreach ($pswimmingpoolsize as $key => $value) {
                        if( $value ){
                            $pkitchen[$key] = array( 'pswimmingpoolsize' => $value );
                        }       
                    }
                    update_post_meta( $property_id, 'propertyswimmingpool', $pkitchen );
                }
            }            

            // Add Property Gym Dimensions Post Meta
            if( isset($_POST['pgymsize']) ){
                $pgymsize = $_POST['pgymsize']; 
                $pgym = array();
                if( $pgymsize ){
                    foreach ($pgymsize as $key => $value) {
                        if( $value ){
                            $pgym[$key] = array( 'pgymsize' => $value );
                        }       
                    }
                    update_post_meta( $property_id, 'propertygym', $pgym );
                }
            }            

            // Add Property Floor Post Meta
            if( isset($_POST['floortitle']) ){
                $floortitle     = $_POST['floortitle'];
                $floorprice     = $_POST['floorprice'];
                $floorsqrt      = $_POST['floorsqrt'];
                $floorbedrooms  = $_POST['floorbedrooms'];
                $floorbathrooms = $_POST['floorbathrooms'];
                $floordetail    = $_POST['floordetail'];
                $floorplanimage = $_POST['floorplanimage'];

                $propertyfloorsarray = array();

                if($floortitle) {
                    foreach ( $floortitle as $key => $value ) {
                        if( $value ) {
                            $floor_photo_url = wp_get_attachment_url( $floorplanimage[$key] );
                            $propertyfloorsarray[$key] = array( 'floortitle' => $value, 'floorprice' => $floorprice[$key], 'floorsqrt' => $floorsqrt[$key], 'floorbedrooms' => $floorbedrooms[$key], 'floorbathrooms' => $floorbathrooms[$key], 'floordetail' => $floordetail[$key], 'floorplanimage' => $floor_photo_url );                            
                        }
                    }
                    update_post_meta( $property_id, 'propertyfloors', $propertyfloorsarray );
                }
            }            

            // Add Property Documents Post Meta
            if( isset($_POST['pdocumentslabel']) ){
                $pdocumentslabel    = $_POST['pdocumentslabel'];
                $pdocumentslink     = $_POST['pdocumentslink'];
                $pdocuments = array();

                if( $pdocumentslabel ){
                    foreach ($pdocumentslabel as $key => $value) {
                        if( $value ){
                            $pdocuments[$key] = array( 'pdocumentslabel' => $value, 'pdocumentslink' => $pdocumentslink[$key] );
                        }       
                    }
                    update_post_meta( $property_id, 'pdocuments', $pdocuments );
                }
            }            

            // Add Property Near By Place Post Meta
            if( isset($_POST['google_near_by_place_type']) ){
                $google_near_by_place_type  = $_POST['google_near_by_place_type'];
                $google_near_by_place_label = $_POST['google_near_by_place_label'];
                $google_near_by_place_icon  = $_POST['google_near_by_place_icon'];

                // Update near by map location of property
                $google_near_by_place_array = array();
                if( $google_near_by_place_type ){
                    foreach ($google_near_by_place_type as $key => $value) {
                        if( $google_near_by_place_type[$key] ){
                            if( empty($google_near_by_place_label[$key]) ){
                                $google_near_by_place_label[$key] = $google_near_by_place_type[$key];
                            }
                            if( empty($google_near_by_place_icon[$key]) ){
                                $google_near_by_place_icon[$key] = get_template_directory_uri().'/images/map_marker.png';
                            }
                            if( $value ){
                                $near_icon_url = wp_get_attachment_url( $google_near_by_place_icon[$key] );
                                $google_near_by_place_array[$key] = array( 'google_near_by_place_type' => $value, 'google_near_by_place_label' => $google_near_by_place_label[$key], 'google_near_by_place_icon' => $near_icon_url );                                
                            }
                        }   
                    }
                    update_post_meta( $property_id, 'google_near_by_place', $google_near_by_place_array );
                }
            }            

            // Add Property Custom Near By Place Post Meta
            if( isset($_POST['google_near_by_custom_place_label']) ){
                $google_near_by_custom_place_label      = $_POST['google_near_by_custom_place_label'];
                $google_near_by_custom_place_detail     = $_POST['google_near_by_custom_place_detail'];
                $google_near_by_custom_place_latitude   = $_POST['google_near_by_custom_place_latitude'];
                $google_near_by_custom_place_longitude  = $_POST['google_near_by_custom_place_longitude'];
                $google_near_by_custom_place_icon       = $_POST['google_near_by_custom_place_icon'];
                        
                $google_near_by_custom_place_array = array();
                if( $google_near_by_custom_place_label ){
                    foreach ($google_near_by_custom_place_label as $key => $value) {
                        if( $google_near_by_custom_place_label[$key] ){
                            if( empty($google_near_by_custom_place_detail[$key]) ){
                                $google_near_by_custom_place_detail[$key] = $google_near_by_custom_place_detail[$key];
                            }
                            if( empty($google_near_by_custom_place_latitude[$key]) ){
                                $google_near_by_custom_place_latitude[$key] = $google_near_by_custom_place_latitude[$key];
                            }
                            if( empty($google_near_by_custom_place_longitude[$key]) ){
                                $google_near_by_custom_place_longitude[$key] = $google_near_by_custom_place_longitude[$key];
                            }
                            if( empty($google_near_by_custom_place_longitude[$key]) ){
                                $google_near_by_custom_place_icon[$key] = get_template_directory_uri().'/images/map_marker.png';
                            }
                            if( $value ){
                                $near_icon_url = wp_get_attachment_url( $google_near_by_custom_place_icon[$key] );
                                $google_near_by_custom_place_array[$key] = array( 'google_near_by_custom_place_label' => $value,'google_near_by_custom_place_detail' => $google_near_by_custom_place_detail[$key], 'google_near_by_custom_place_latitude' => $google_near_by_custom_place_latitude[$key], 'google_near_by_custom_place_longitude' => $google_near_by_custom_place_longitude[$key], 'google_near_by_custom_place_icon' => $near_icon_url );                                
                            }
                        }   
                    }
                    update_post_meta( $property_id, 'google_near_by_custom_place', $google_near_by_custom_place_array );
                }   
            }         

            // Add Property Agent Post Meta
            update_post_meta( $property_id, 'pagent', $current_user->ID );            

            $Agent_Property_List = get_user_meta( $current_user->ID, 'pagentproperty', true );

            if( !empty($current_user->ID) ){
                if( empty($Agent_Property_List) ){
                    $Agent_Property_List = array( $property_id );
                    update_user_meta( $current_user->ID, 'pagentproperty', $Agent_Property_List );            
                } else {
                    if( !in_array($property_id, $Agent_Property_List) ){
                        array_push($Agent_Property_List, $property_id);             
                        update_user_meta( $current_user->ID, 'pagentproperty', $Agent_Property_List );
                    }
                }
            } else {
                if( !empty($Agent_Property_List) ){
                    $position = array_search($property_id, $Agent_Property_List);
                    unset($Agent_Property_List[$position]);
                    update_user_meta( $current_user->ID, 'pagentproperty', $Agent_Property_List );
                }       
            }            
            
            // Add Property Flooring Post Meta
            if( isset ( $_POST['pflooring'] ) && !empty ( $_POST['pflooring'] ) ) {
                update_post_meta( $property_id, 'pflooring', $_POST['pflooring'] );
            }

            // Add Property Goodsincluded Post Meta
            if( isset ( $_POST['pgoodsincluded'] ) && !empty ( $_POST['pgoodsincluded'] ) ) {
                update_post_meta( $property_id, 'pgoodsincluded', $_POST['pgoodsincluded'] );
            }

            // Add Property Featured Post Meta
            if( isset( $_POST['featured_property'] ) && $action == "submit" ) {
                
                update_post_meta( $property_id, 'pfetured', $_POST['featured_property'] );

                if( empty($single_property_detail) ){
                    $active_package_detail  = get_user_meta( $current_user->ID, 'package_detail' );

                    $featured_item_remain = $active_package_detail[0]['featured_item_remain'];

                    if( $featured_item_remain != "" && $featured_item_remain != "0" ){

                        $featured_item_remain = $featured_item_remain - 1;

                        if( $featured_item_remain == 0 ){
                            $featured_item_remain = "done";
                        }

                        update_user_meta( $current_user->ID, 'package_detail', array( "id" => $active_package_detail[0]['id'], 'expiry_date' => $active_package_detail[0]['expiry_date'], "list_item_remain" => $active_package_detail[0]['list_item_remain'], "featured_item_remain" => $featured_item_remain, 'status' => $active_package_detail[0]['status'] ) );
                    }
                }
            }

            // Add Property Type Category
            if( isset( $_POST['property_type'] ) && ( $_POST['property_type'] != "" ) ) {
                wp_set_object_terms( $property_id, intval( $_POST['property_type'] ), 'property_category' );
            }
            
            // Add Property Location Category
            if( isset( $_POST['property_location'] ) && ( $_POST['property_location'] != "" ) ) {
                wp_set_object_terms( $property_id, intval( $_POST['property_location'] ), 'location' );
            }

            // Add Property Listed Post Meta
            if( isset ( $_POST['property_listed'] ) && !empty ( $_POST['property_listed'] ) ) {
                update_post_meta( $property_id, 'pstatus', $_POST['property_listed'] );
            }

            // Add Property Status Category
            if( isset( $_POST['property_status'] ) && ( $_POST['property_status'] != "" ) ) {
                wp_set_object_terms( $property_id, intval( $_POST['property_status'] ), 'property_status' );
            }
            
            // Add Property Featured Category
            if( isset( $_POST['property_features'] ) ) {
                if( ! empty( $_POST['property_features'] ) && is_array( $_POST['property_features'] ) ) {
                    $property_features = array();
                    foreach( $_POST['property_features'] as $property_feature_id ) {
                        $property_features[] = intval( $property_feature_id );
                    }
                    wp_set_object_terms( $property_id , $property_features, 'features' );
                }
            }
            
            // Add Property Video URL Post Meta
            /*if( isset ( $_POST['video_url'] ) && !empty ( $_POST['video_url'] ) ) {
                update_post_meta( $property_id, 'pvideo', $_POST['video_url'] );
            }*/

            // Add Property Video Placeholder Post Meta
            if( isset ( $_POST['video_placeholder'] ) && !empty ( $_POST['video_placeholder'] ) ) {
                $video_image_url = wp_get_attachment_url( $_POST['video_placeholder'] );
                update_post_meta( $property_id, 'pvideoplaceholder', $video_image_url );                
            }

            // Add Property Advertisement Post Meta
            if( isset ( $_POST['advertisement_code'] ) && !empty ( $_POST['advertisement_code'] ) ) {
                update_post_meta( $property_id, 'padvertisement', $_POST['advertisement_code'] );
            }

            /* our code */
            // Add Property Video URL Post Meta
            if( isset ( $_POST['provideourl'] ) && !empty ( $_POST['provideourl'] ) ) {
                update_post_meta( $property_id, 'pvideourl', $_POST['provideourl'] );
            }
            // Add Property Video Height
            if( isset ( $_POST['provideoheight'] ) && !empty ( $_POST['provideoheight'] ) ) {
                update_post_meta( $property_id, 'pvideoheight', $_POST['provideoheight'] );
            }
            // Add Property Video Width
            if( isset ( $_POST['provideowidth'] ) && !empty ( $_POST['provideowidth'] ) ) {
                update_post_meta( $property_id, 'pvideowidth', $_POST['provideowidth'] );
            }
            // Add Property Street view latitude
            if( isset ( $_POST['prostreetviewlat'] ) && !empty ( $_POST['prostreetviewlat'] ) ) {
                update_post_meta( $property_id, 'streetviewlat', $_POST['prostreetviewlat'] );
            }
            // Add Property Street view longitude
            if( isset ( $_POST['prostreetviewlng'] ) && !empty ( $_POST['prostreetviewlng'] ) ) {
                update_post_meta( $property_id, 'streetviewlng', $_POST['prostreetviewlng'] );
            }
            /* end code*/

            // Redirect to my properties page
            global $dreamvilla_options;
            if( !empty( $dreamvilla_options[ 'user_dashboard_property_list' ]  ) ) {
                
                $Properties_List_URL = get_permalink( $dreamvilla_options[ 'user_dashboard_property_list' ] );
                
                if ( !empty( $Properties_List_URL ) ) {
                    
                    if( $action == "submit" ){
                        $parameter = "?property-submited=true";
                    } else {
                        $parameter = "?property-updated=true";
                    }
                    
                    $Redirect_URL = $Properties_List_URL . $parameter;
                }
            }

            $response = array( 'success' => true, "redirect_url" => $Redirect_URL );
            
        }           
        
    } else {
        $errors_info[] = esc_html__('Security check failed!', 'dreamvilla-multiple-property');
        $response = array( 'success' => false, 'errors' => $errors_info );
    }
    
    echo json_encode( $response );
    die;
}

function dreamvilla_mp_remove_gallery_image() {

    $post_meta_removed = false;
    $attachment_removed = false;

    if( isset( $_POST['attachment_id'] ) ) {
        $attachment_id = intval( $_POST['attachment_id'] );
        if ( $attachment_id > 0 ) {
            $attachment_removed = wp_delete_attachment( $attachment_id );
        } else if ( $attachment_id > 0 ) {
            if( false === wp_delete_attachment( $attachment_id ) ){
                $attachment_removed = false;
            } else {
                $attachment_removed = true;
            }
        }
    }

    $ajax_response = array(
        'post_meta_removed' => $post_meta_removed,
        'attachment_removed' => $attachment_removed,
    );

    echo json_encode( $ajax_response );
    die;

}
add_action( 'wp_ajax_remove_gallery_image', 'dreamvilla_mp_remove_gallery_image' );
?>