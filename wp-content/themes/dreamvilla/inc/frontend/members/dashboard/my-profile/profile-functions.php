<?php
function dreamvilla_mp_ajax_edit_profile_init(){ 
    
    wp_register_script('dreamvilla-edit-profile', get_template_directory_uri() . '/inc/frontend/js/my-profile.js', array('jquery') );
    wp_enqueue_script('dreamvilla-edit-profile');

    wp_localize_script( 'dreamvilla-edit-profile', 'edit_profile_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'loadingmessage' => __('Sending user info, please wait...') ));

    add_action( 'wp_ajax_dreamvilla_mp_ajax_edit_profile', 'dreamvilla_mp_ajax_edit_profile' );

    add_action( 'wp_ajax_dreamvilla_mp_ajax_change_password', 'dreamvilla_mp_ajax_change_password' );
}

// Execute the action only if the user isn't logged in
if( is_user_logged_in() ) {
    add_action('init', 'dreamvilla_mp_ajax_edit_profile_init');
}

function dreamvilla_mp_ajax_edit_profile(){

    // Get user info
    global $current_user;
    get_currentuserinfo();

    // Array for errors
    $errors_info = array();

    if( wp_verify_nonce( $_POST['security'], 'dreamvilla-ajax-edit-profile-nonce' ) ) {

        // Update profile image
        if ( !empty( $_POST['profile_image'] ) ) {
            $profile_image = intval( $_POST['profile_image'] );
            update_user_meta( $current_user->ID, 'profile_image_id', $profile_image );
        } else {
            delete_user_meta( $current_user->ID, 'profile_image_id' );
        }

        // Update full name
        if( !empty( $_POST['fullname'] ) ){
            $fullname = sanitize_text_field( $_POST['fullname'] );
            update_user_meta( $current_user->ID, 'fullname', $fullname );
        } else {
            delete_user_meta( $current_user->ID, 'fullname' );
        }

        // Update user email
        if( !empty( $_POST['user_email'] ) ){
            $user_email = is_email( sanitize_email($_POST['user_email']) );
            if(!$user_email) {
                $errors_info[] = esc_html__( 'Provided email address is invalid.', 'dreamvilla-multiple-property' );
            } else {
                $email_exists = email_exists( $user_email );    // email_exists returns a user id if a user exists against it
                if( $email_exists ) {
                    if( $email_exists != $current_user->ID ){
                        $errors_info[] = esc_html__('Provided email is already in use by another user. Try a different one.', 'dreamvilla-multiple-property');
                    }
                } else {
                    $return = wp_update_user( array ('ID' => $current_user->ID, 'user_email' => $user_email ) );
                    if(is_wp_error( $return ) ){
                        $errors_info[] = $return->get_error_message();
                    }
                }
            }
        }

        // Update phone
        if( !empty( $_POST['phone'] ) ){
            $phone = sanitize_text_field( $_POST['phone'] );
            update_user_meta( $current_user->ID, 'phone', $phone );
        } else {
            delete_user_meta( $current_user->ID, 'phone' );
        }        

        // Update mobile
        if( !empty( $_POST['mobile'] ) ){
            $mobile = sanitize_text_field( $_POST['mobile'] );
            update_user_meta( $current_user->ID, 'mobile', $mobile );
        } else {
            delete_user_meta( $current_user->ID, 'mobile' );
        }

        // Update skype
        if( !empty( $_POST['skype'] ) ){
            $skype = sanitize_text_field( $_POST['skype'] );
            update_user_meta( $current_user->ID, 'skype', $skype );
        } else {
            delete_user_meta( $current_user->ID, 'skype' );
        }        

        // Update facebook url
        if( !empty( $_POST['facebookurl'] ) ){
            $facebookurl = sanitize_text_field( $_POST['facebookurl'] );
            update_user_meta( $current_user->ID, 'facebookurl', $facebookurl );
        } else {
            delete_user_meta( $current_user->ID, 'facebookurl' );
        }

        // Update twitter url
        if( !empty( $_POST['twitterurl'] ) ){
            $twitterurl = sanitize_text_field( $_POST['twitterurl'] );
            update_user_meta( $current_user->ID, 'twitterurl', $twitterurl );
        } else {
            delete_user_meta( $current_user->ID, 'twitterurl' );
        }

        // Update linkedin url
        if( !empty( $_POST['linkedinurl'] ) ){
            $linkedinurl = sanitize_text_field( $_POST['linkedinurl'] );
            update_user_meta( $current_user->ID, 'linkedinurl', $linkedinurl );
        } else {
            delete_user_meta( $current_user->ID, 'linkedinurl' );
        }

        // Update pinterest url
        if( !empty( $_POST['pinteresturl'] ) ){
            $pinteresturl = sanitize_text_field( $_POST['pinteresturl'] );
            update_user_meta( $current_user->ID, 'pinteresturl', $pinteresturl );
        } else {
            delete_user_meta( $current_user->ID, 'pinteresturl' );
        }

         // Update website url
        if( !empty( $_POST['websiteurl'] ) ){
            $websiteurl = sanitize_text_field( $_POST['websiteurl'] );
            update_user_meta( $current_user->ID, 'websiteurl', $websiteurl );
        } else {
            delete_user_meta( $current_user->ID, 'websiteurl' );
        }

        // Update title/position
        if( !empty( $_POST['titleposition'] ) ){
            $titleposition = sanitize_text_field( $_POST['titleposition'] );
            update_user_meta( $current_user->ID, 'titleposition', $titleposition );
        } else {
            delete_user_meta( $current_user->ID, 'titleposition' );
        }

        // Update about me
        if( !empty( $_POST['aboutme'] ) ){
            $aboutme = sanitize_text_field( $_POST['aboutme'] );
            update_user_meta( $current_user->ID, 'aboutme', $aboutme );
        } else {
            delete_user_meta( $current_user->ID, 'aboutme' );
        }        

        if( count($errors_info) == 0 ){
            
            $response = array(
                'success' => true,
                'message' => esc_html__( 'Profile information is updated successfully!', 'dreamvilla-multiple-property' ),
            );
            echo json_encode( $response );
            die;
        } else {
            $response = array(
                'success' => false,
                'errors' => $errors_info
            );
            echo json_encode( $response );
            die;
        }
    } else {
        $errors_info[] = esc_html__('Security check failed!', 'dreamvilla-multiple-property');
        $response = array(
            'success' => false,
            'errors' => $errors_info
        );
        echo json_encode( $response );
        die;
    }
}

function dreamvilla_mp_ajax_change_password(){

    // Get user info
    global $current_user;
    get_currentuserinfo();

    // Array for errors
    $errors_info = array();

    if( wp_verify_nonce( $_POST['security'], 'dreamvilla-ajax-change-password-nonce' ) ){

        // Change password
        if( !empty($_POST['oldpassword']) && !empty($_POST['newpassword']) && !empty($_POST['cpassword']) ){

            if( wp_check_password( $_POST['oldpassword'], $current_user->data->user_pass, $current_user->ID) ){

                if( $_POST['newpassword'] == $_POST['cpassword'] ){
                    
                    $pass_return = wp_update_user( array(
                        'ID' => $current_user->ID,
                        'user_pass' => $_POST['newpassword']
                    ) );

                    if( is_wp_error( $pass_return ) ){
                        $errors_info[] = $pass_return->get_error_message();
                    }

                } else {
                    $errors_info[] = esc_html__('The passwords you entered do not match. Your password is not updated.', 'dreamvilla-multiple-property');
                }

            } else {
                $errors_info[] = esc_html__('The old password you entered do not correct. Your password is not updated.', 'dreamvilla-multiple-property');
            }
        } 

        if( count($errors_info) == 0 ){
            
            $response = array(
                'success' => true,
                'message' => esc_html__( 'Password is changed successfully!', 'dreamvilla-multiple-property' ),
            );
            echo json_encode( $response );
            die;
        } else {
            $response = array(
                'success' => false,
                'errors' => $errors_info
            );
            echo json_encode( $response );
            die;
        }
    } else {
        $errors_info[] = esc_html__('Security check failed!', 'dreamvilla-multiple-property');
        $response = array(
            'success' => false,
            'errors' => $errors_info
        );
        echo json_encode( $response );
        die;
    }
}

function dreamvilla_mp_user_profile_image_upload(){

    $submitted_file = $_FILES['dreamvilla_mp_upload_file'];
    $uploaded_image = wp_handle_upload( $submitted_file, array( 'test_form' => false ) );   //Handle PHP uploads in WordPress, sanitizing file names, checking extensions for mime type, and moving the file to the appropriate directory within the uploads directory.

    if( isset( $uploaded_image['file'] ) ){
        
        $file_name          =   basename( $submitted_file['name'] );
        $file_type          =   wp_check_filetype( $uploaded_image['file'] );   // Retrieve the file type from the file name

        // Prepare an array of post data for the attachment
        $image_attachment_details = array(
            'guid'           => $uploaded_image['url'],
            'post_mime_type' => $file_type['type'],
            'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $file_name ) ),
            'post_content'   => '',
            'post_status'    => 'inherit'
        );

        $image_attach_id      =   wp_insert_attachment( $image_attachment_details, $uploaded_image['file'] );       // This function inserts an attachment into the media library
        $image_attach_data    =   wp_generate_attachment_metadata( $image_attach_id, $uploaded_image['file'] );     // This function generates metadata for an image attachment. It also creates a thumbnail and other intermediate sizes of the image attachment based on the sizes defined
        
        wp_update_attachment_metadata( $image_attach_id, $image_attach_data );                                      // Update metadata for an attachment.

        $thumbnail_url = wp_get_attachment_thumb_url( $image_attach_id ); // returns escaped url

        $ajax_response = array( 'success' => true, 'url' => $thumbnail_url, 'attachment_id' => $image_attach_id );
        
        echo json_encode( $ajax_response );
        die;

    } else {
        $ajax_response = array( 'success' => false, 'reason' => __( 'Image upload failed!', 'dreamvilla-multiple-property' ) );
        
        echo json_encode( $ajax_response );
        die;
    }
}
add_action( 'wp_ajax_user_profile_image_upload', 'dreamvilla_mp_user_profile_image_upload' );

// Add custom user profile picture
function dreamvilla_mp_shr_add_admin_scripts(){ 
    wp_enqueue_media();   
}
add_action('admin_enqueue_scripts', 'dreamvilla_mp_shr_add_admin_scripts');

add_action( 'show_user_profile', 'dreamvilla_mp_add_custom_user_profile_fields' );
add_action( 'edit_user_profile', 'dreamvilla_mp_add_custom_user_profile_fields' );
add_action( 'user_new_form', 'dreamvilla_mp_add_custom_user_profile_fields' );

function dreamvilla_mp_add_custom_user_profile_fields( $user ) {

    if( isset($user->ID) ){
        $Profile_Pic_ID = ($user!=='add-new-user') ? get_user_meta($user->ID, 'profile_image_id', true): false;
     
        if( !empty($Profile_Pic_ID) ){
            $Profile_Image_URL = wp_get_attachment_image_src( $Profile_Pic_ID, 'thumbnail' ); 
        } 

        $Agent_Logo_ID = get_the_author_meta( 'logo_image_id', $user->ID );
        if( !empty($Agent_Logo_ID) ){
            $Agent_Logo_URL = wp_get_attachment_image_src( $Agent_Logo_ID, 'thumbnail' ); 
        } 
    ?>

    <h3><?php esc_html_e('Extra Profile Information', 'dreamvilla-multiple-property'); ?></h3>
    
    <table class="form-table">
        <tr>
            <th>
                <label for="image"><?php esc_html_e('Main Profile Image',"dreamvilla-multiple-property"); ?></label>
            </th> 
            <td>
                <input type="button" data-id="profile_image_id" data-src="agent-img" class="button agent-image" name="profile_image_id" id="agent-image" value="<?php esc_html_e("Upload","dreamvilla-multiple-property"); ?>" />
                <input type="hidden" class="button" name="profile_image_id" id="profile_image_id" value="<?php echo !empty($Profile_Pic_ID) ? esc_attr($Profile_Pic_ID) : ''; ?>" />
                <img id="agent-img" src="<?php echo !empty($Profile_Pic_ID) ? esc_url($Profile_Image_URL[0]) : ''; ?>" style="<?php echo  empty($Profile_Pic_ID) ? 'display:none;' :'' ?> max-width: 100px; max-height: 100px;" alt="profile-pic"/>
            </td>
        </tr>
        <tr>
            <th>
                <label for="fullname"><?php esc_html_e('Full Name', 'dreamvilla-multiple-property'); ?>
            </label></th>
            <td>
                <input type="text" name="fullname" id="fullname" value="<?php if( isset($user->ID) ){ echo esc_attr( get_the_author_meta( 'fullname', $user->ID ) ); } ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e('Please enter your fullname.', 'dreamvilla-multiple-property'); ?></span>
            </td>
        </tr>
        <tr>
            <th>
                <label for="titleposition"><?php esc_html_e('Title/Position', 'dreamvilla-multiple-property'); ?>
            </label></th>
            <td>
                <input type="text" name="titleposition" id="titleposition" value="<?php if( isset($user->ID) ){ echo esc_attr( get_the_author_meta( 'titleposition', $user->ID ) ); } ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e('Please enter your title/position.', 'dreamvilla-multiple-property'); ?></span>
            </td>
        </tr>
        <tr>
            <th>
                <label for="aboutme"><?php esc_html_e('About Me', 'dreamvilla-multiple-property'); ?></label>
            </th>
            <td>
                <textarea id="aboutme" rows="5" name="aboutme" placeholder="<?php esc_html_e("About Me","dreamvilla-multiple-property"); ?>"><?php if( isset($user->ID) ){ echo esc_attr( get_the_author_meta( 'aboutme', $user->ID ) ); } ?></textarea>
                <span class="description"><?php esc_html_e('Please enter your about me.', 'dreamvilla-multiple-property'); ?></span>
            </td>
        </tr>
        <tr>
            <th>
                <label for="certificate"><?php esc_html_e('Certificate Name', 'dreamvilla-multiple-property'); ?>
            </label></th>
            <td>
                <input type="text" name="certificate" id="certificate" value="<?php if( isset($user->ID) ){ echo esc_attr( get_the_author_meta( 'certificate', $user->ID ) ); } ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e('Please enter your certificate name.', 'dreamvilla-multiple-property'); ?></span>
            </td>
        </tr>
        <tr>
            <th>
                <label for="image"><?php esc_html_e('Agent Logo',"dreamvilla-multiple-property"); ?></label>
            </th> 
            <td>
                <input type="button" data-id="logo_image_id" data-src="agent-logo-img" class="button agent-logo-image" name="logo_image_id" id="agent-logo-image" value="<?php esc_html_e("Upload","dreamvilla-multiple-property"); ?>" />
                <input type="hidden" class="button" name="logo_image_id" id="logo_image_id" value="<?php echo !empty($Agent_Logo_ID) ? esc_attr($Agent_Logo_ID) : ''; ?>" />
                <img id="agent-logo-img" src="<?php echo !empty($Agent_Logo_ID) ? esc_url($Agent_Logo_URL[0]) : ''; ?>" style="<?php echo  empty($Agent_Logo_ID) ? 'display:none;' :'' ?> max-width: 100px; max-height: 100px;" alt="logo-pic"/>
            </td>
        </tr>
        <tr>
            <th>
                <label for="phone"><?php esc_html_e('Phone', 'dreamvilla-multiple-property'); ?>
            </label></th>
            <td>
                <input type="text" name="phone" id="phone" value="<?php if( isset($user->ID) ){ echo esc_attr( get_the_author_meta( 'phone', $user->ID ) ); } ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e('Please enter your phone.', 'dreamvilla-multiple-property'); ?></span>
            </td>
        </tr>
        <tr>
            <th>
                <label for="address"><?php esc_html_e('Mobile', 'dreamvilla-multiple-property'); ?>
            </label></th>
            <td>
                <input type="text" name="mobile" id="mobile" value="<?php if( isset($user->ID) ){ echo esc_attr( get_the_author_meta( 'mobile', $user->ID ) ); } ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e('Please enter your mobile.', 'dreamvilla-multiple-property'); ?></span>
            </td>
        </tr>
        <tr>
            <th>
                <label for="skype"><?php esc_html_e('Skype', 'dreamvilla-multiple-property'); ?>
            </label></th>
            <td>
                <input type="text" name="skype" id="skype" value="<?php if( isset($user->ID) ){ echo esc_attr( get_the_author_meta( 'skype', $user->ID ) ); } ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e('Please enter your skype.', 'dreamvilla-multiple-property'); ?></span>
            </td>
        </tr>
        <tr>
            <th>
                <label for="facebookurl"><?php esc_html_e('Facebook URL', 'dreamvilla-multiple-property'); ?>
            </label></th>
            <td>
                <input type="text" name="facebookurl" id="facebookurl" value="<?php if( isset($user->ID) ){ echo esc_attr( get_the_author_meta( 'facebookurl', $user->ID ) ); } ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e('Please enter your facebook url.', 'dreamvilla-multiple-property'); ?></span>
            </td>
        </tr>
        <tr>
            <th>
                <label for="twitterurl"><?php esc_html_e('Twitter URL', 'dreamvilla-multiple-property'); ?>
            </label></th>
            <td>
                <input type="text" name="twitterurl" id="twitterurl" value="<?php if( isset($user->ID) ){ echo esc_attr( get_the_author_meta( 'twitterurl', $user->ID ) ); } ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e('Please enter your twitter url.', 'dreamvilla-multiple-property'); ?></span>
            </td>
        </tr>
        <tr>
            <th>
                <label for="linkedinurl"><?php esc_html_e('Linkedin URL', 'dreamvilla-multiple-property'); ?>
            </label></th>
            <td>
                <input type="text" name="linkedinurl" id="linkedinurl" value="<?php if( isset($user->ID) ){ echo esc_attr( get_the_author_meta( 'linkedinurl', $user->ID ) ); } ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e('Please enter your linkedin url.', 'dreamvilla-multiple-property'); ?></span>
            </td>
        </tr>
        <tr>
            <th>
                <label for="pinteresturl"><?php esc_html_e('Pinterest URL', 'dreamvilla-multiple-property'); ?>
            </label></th>
            <td>
                <input type="text" name="pinteresturl" id="pinteresturl" value="<?php if( isset($user->ID) ){ echo esc_attr( get_the_author_meta( 'pinteresturl', $user->ID ) ); } ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e('Please enter your pinterest url.', 'dreamvilla-multiple-property'); ?></span>
            </td>
        </tr>
        <tr>
            <th>
                <label for="websiteurl"><?php esc_html_e('Website URL', 'dreamvilla-multiple-property'); ?>
            </label></th>
            <td>
                <input type="text" name="websiteurl" id="websiteurl" value="<?php if( isset($user->ID) ){ echo esc_attr( get_the_author_meta( 'websiteurl', $user->ID ) ); } ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e('Please enter your website url.', 'dreamvilla-multiple-property'); ?></span>
            </td>
        </tr>        
    </table><?php
    }
}

add_action( 'personal_options_update', 'dreamvilla_mp_save_custom_user_profile_fields' );
add_action( 'edit_user_profile_update', 'dreamvilla_mp_save_custom_user_profile_fields' );
function dreamvilla_mp_save_custom_user_profile_fields( $user_id ) {

    if ( !current_user_can( 'edit_user', $user_id ) )
        return FALSE;
    
    $Profile_Pic = empty($_POST['profile_image_id']) ? '' : $_POST['profile_image_id'];
    $Profile_Pic = sanitize_text_field($Profile_Pic);
    update_user_meta( $user_id, 'profile_image_id', $Profile_Pic );

    $Logo_Pic = empty($_POST['logo_image_id']) ? '' : $_POST['logo_image_id'];
    $Logo_Pic = sanitize_text_field($Logo_Pic);
    update_user_meta( $user_id, 'logo_image_id', $Logo_Pic );
    
    update_usermeta( $user_id, 'fullname', $_POST['fullname'] );
    update_usermeta( $user_id, 'titleposition', $_POST['titleposition'] );
    update_usermeta( $user_id, 'aboutme', $_POST['aboutme'] );
    update_usermeta( $user_id, 'certificate', $_POST['certificate'] );
    update_usermeta( $user_id, 'phone', $_POST['phone'] );
    update_usermeta( $user_id, 'mobile', $_POST['mobile'] );
    update_usermeta( $user_id, 'skype', $_POST['skype'] );
    update_usermeta( $user_id, 'facebookurl', $_POST['facebookurl'] );
    update_usermeta( $user_id, 'twitterurl', $_POST['twitterurl'] );
    update_usermeta( $user_id, 'linkedinurl', $_POST['linkedinurl'] );
    update_usermeta( $user_id, 'pinteresturl', $_POST['pinteresturl'] );
    update_usermeta( $user_id, 'websiteurl', $_POST['websiteurl'] );
}


?>