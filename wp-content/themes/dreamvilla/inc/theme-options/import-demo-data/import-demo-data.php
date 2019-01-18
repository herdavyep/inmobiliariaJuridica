<?php

// Replace {$redux_opt_name} with your opt_name.
// Also be sure to change this function name!

if(!function_exists('redux_register_custom_extension_loader')) :
    function redux_register_custom_extension_loader($ReduxFramework) {
        $path = dirname( __FILE__ ) . '/extensions/';
        $folders = scandir( $path, 1 );        
        foreach($folders as $folder) {
            if ($folder === '.' or $folder === '..' or !is_dir($path . $folder) ) {
                continue;
            } 
            $extension_class = 'ReduxFramework_Extension_' . $folder;
            if( !class_exists( $extension_class ) ) {
                // In case you wanted override your override, hah.
                $class_file = $path . $folder . '/extension_' . $folder . '.php';
                $class_file = apply_filters( 'redux/extension/'.$ReduxFramework->args['opt_name'].'/'.$folder, $class_file );
                if( $class_file ) {
                    require_once( $class_file );
                    $extension = new $extension_class( $ReduxFramework );
                }
            }
        }
    }
    // Modify {$redux_opt_name} to match your opt_name
    add_action("redux/extensions/dreamvilla_options/before", 'redux_register_custom_extension_loader', 0);
endif;

/*
    Set Front page, Blog page, Menu, Users, Comments
*/
if ( !function_exists( 'dreamvilla_importer_after_import_settings' ) ) {
    function dreamvilla_importer_after_import_settings( $demo_active_import , $demo_directory_path ) {
        reset( $demo_active_import );

        wp_delete_post(1);
        wp_delete_post(2);
        
        $userdata = array(
           'user_login'  =>  'cameron',
           'user_pass' => NULL,
           'user_nicename'    =>  'cameron',
           'user_email'   =>  'cameron_dreamvilla@gmail.com',
           'user_url'    =>  'http://cameron',
           'user_registered'    =>  '2015-08-21 08:19:50',
           'user_status'    =>  '0',
           'display_name'    =>  'cameron diaz',
           'roles'    =>  'subscriber',
           'groups'    =>  '',
           'nickname'    =>  'cameron',
           'first_name'    =>  'Cameron',
           'last_name'    =>  'Diaz',
           'description'    =>  '',
           'rich_editing'    =>  'true',
           'comment_shortcuts'    =>  'false',
           'admin_color'    =>  'fresh',
           'use_ssl'    =>  '0',
           'show_admin_bar_front'    =>  'true',
           'wp_capabilities'    =>  'subscriber|1',
           'wp_user_level'    =>  '0',
           'dismissed_wp_pointers'    =>  ''
        );
        $user_id = wp_insert_user( $userdata );
        update_user_meta( $user_id, 'shr_pic', 115 );
        update_user_meta( $user_id, 'profile_image_id', 280 );
        update_user_meta( $user_id, 'logo_image_id', 63 );
        update_user_meta( $user_id, 'fullname', 'Cameron Diaz' );
        update_user_meta( $user_id, 'titleposition', 'CEO' );
        update_user_meta( $user_id, 'aboutme', "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen." );
        update_user_meta( $user_id, 'certificate', "Remax Certified Agent" );
        update_user_meta( $user_id, 'phone', "027821234" );
        update_user_meta( $user_id, 'mobile', "1245786598" );
        update_user_meta( $user_id, 'skype', "cameron.diaz" );
        update_user_meta( $user_id, 'facebookurl', "http://www.facebook.com" );
        update_user_meta( $user_id, 'twitterurl', "http://www.twitter.com" );
        update_user_meta( $user_id, 'linkedinurl', "http://www.linkedin.com" );
        update_user_meta( $user_id, 'pinteresturl', "http://www.pinterest.com" );
        update_user_meta( $user_id, 'websiteurl', "http://www.website.com" );
        update_user_meta( $user_id, 'pagentproperty', array( 167, 161, 157, 153 ) );


        $userdata = array(
           'user_login'  =>  'johnathon',
           'user_pass' => NULL,
           'user_nicename'    =>  'johnathon',
           'user_email'   =>  'johnathon_dreamvilla@gmail.com',
           'user_url'    =>  'http://johnathon',
           'user_registered'    =>  '2015-08-21 08:15:45',
           'user_status'    =>  '0',
           'display_name'    =>  'johnathon doe',
           'roles'    =>  'subscriber',
           'groups'    =>  '',
           'nickname'    =>  'johnathon',
           'first_name'    =>  'Johnathon',
           'last_name'    =>  'Doe',
           'description'    =>  '',
           'rich_editing'    =>  'true',
           'comment_shortcuts'    =>  'false',
           'admin_color'    =>  'fresh',
           'use_ssl'    =>  '0',
           'show_admin_bar_front'    =>  'true',
           'wp_capabilities'    =>  'subscriber|1',
           'wp_user_level'    =>  '0',
           'dismissed_wp_pointers'    =>  ''
        );
        $user_id = wp_insert_user( $userdata );
        update_user_meta( $user_id, 'shr_pic', 117 );
        update_user_meta( $user_id, 'profile_image_id', 285 );
        update_user_meta( $user_id, 'logo_image_id', 62 );
        update_user_meta( $user_id, 'fullname', 'Johnathan Doe' );
        update_user_meta( $user_id, 'titleposition', 'CEO' );
        update_user_meta( $user_id, 'aboutme', "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen." );
        update_user_meta( $user_id, 'certificate', "Remax Certified Agent" );
        update_user_meta( $user_id, 'phone', "604-786-4440" );
        update_user_meta( $user_id, 'mobile', "6047864440" );
        update_user_meta( $user_id, 'skype', "johnathan.doe" );
        update_user_meta( $user_id, 'facebookurl', "http://www.facebook.com" );
        update_user_meta( $user_id, 'twitterurl', "http://www.twitter.com" );
        update_user_meta( $user_id, 'linkedinurl', "http://www.linkedin.com" );
        update_user_meta( $user_id, 'pinteresturl', "http://www.pinterest.com" );
        update_user_meta( $user_id, 'websiteurl', "http://www.website.com" );
        update_user_meta( $user_id, 'pagentproperty', array( 166, 160, 156 ) );

        $userdata = array(
           'user_login'  =>  'mathew',
           'user_pass' => NULL,
           'user_nicename'    =>  'mathew',
           'user_email'   =>  'mathew_dreamvilla@gmail.com',
           'user_url'    =>  'http://mathew',
           'user_registered'    =>  '2015-08-21 08:14:06',
           'user_status'    =>  '0',
           'display_name'    =>  'Mathew Root',
           'roles'    =>  'subscriber',
           'groups'    =>  '',
           'nickname'    =>  'mathew',
           'first_name'    =>  'Mathew',
           'last_name'    =>  'Root',
           'description'    =>  '',
           'rich_editing'    =>  'true',
           'comment_shortcuts'    =>  'false',
           'admin_color'    =>  'fresh',
           'use_ssl'    =>  '0',
           'show_admin_bar_front'    =>  'true',
           'wp_capabilities'    =>  'subscriber|1',
           'wp_user_level'    =>  '0',
           'dismissed_wp_pointers'    =>  ''
        );
        $user_id = wp_insert_user( $userdata );
        update_user_meta( $user_id, 'shr_pic', 119 );
        update_user_meta( $user_id, 'profile_image_id', 291 );
        update_user_meta( $user_id, 'logo_image_id', 61 );
        update_user_meta( $user_id, 'fullname', 'Mathew Root' );
        update_user_meta( $user_id, 'titleposition', 'CEO' );
        update_user_meta( $user_id, 'aboutme', "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen." );
        update_user_meta( $user_id, 'certificate', "Remax Certified Agent" );
        update_user_meta( $user_id, 'phone', "365-123-1254" );
        update_user_meta( $user_id, 'mobile', "3651231254" );
        update_user_meta( $user_id, 'skype', "mathew.root" );
        update_user_meta( $user_id, 'facebookurl', "http://www.facebook.com" );
        update_user_meta( $user_id, 'twitterurl', "http://www.twitter.com" );
        update_user_meta( $user_id, 'linkedinurl', "http://www.linkedin.com" );
        update_user_meta( $user_id, 'pinteresturl', "http://www.pinterest.com" );
        update_user_meta( $user_id, 'websiteurl', "http://www.website.com" );
        update_user_meta( $user_id, 'pagentproperty', array( 165, 159 ) );

        $userdata = array(
           'user_login'  =>  'micheal',
           'user_pass' => NULL,
           'user_nicename'    =>  'micheal',
           'user_email'   =>  'micheal_dreamvilla@gmail.com',
           'user_url'    =>  'http://micheal',
           'user_registered'    =>  '2015-08-21 08:16:59',
           'user_status'    =>  '0',
           'display_name'    =>  'micheal anderson',
           'roles'    =>  'subscriber',
           'groups'    =>  '',
           'nickname'    =>  'micheal',
           'first_name'    =>  'Micheal',
           'last_name'    =>  'Anderson',
           'description'    =>  '',
           'rich_editing'    =>  'true',
           'comment_shortcuts'    =>  'false',
           'admin_color'    =>  'fresh',
           'use_ssl'    =>  '0',
           'show_admin_bar_front'    =>  'true',
           'wp_capabilities'    =>  'subscriber|1',
           'wp_user_level'    =>  '0',
           'dismissed_wp_pointers'    =>  ''  
        );
        $user_id = wp_insert_user( $userdata );
        update_user_meta( $user_id, 'shr_pic', 121 );
        update_user_meta( $user_id, 'profile_image_id', 293 );
        update_user_meta( $user_id, 'logo_image_id', 60 );
        update_user_meta( $user_id, 'fullname', 'Micheal Anderson' );
        update_user_meta( $user_id, 'titleposition', 'CEO' );
        update_user_meta( $user_id, 'aboutme', "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen." );
        update_user_meta( $user_id, 'certificate', "Remax Certified Agent" );
        update_user_meta( $user_id, 'phone', "123-654-789" );
        update_user_meta( $user_id, 'mobile', "1245786598" );
        update_user_meta( $user_id, 'skype', "micheal.anderson" );
        update_user_meta( $user_id, 'facebookurl', "http://www.facebook.com" );
        update_user_meta( $user_id, 'twitterurl', "http://www.twitter.com" );
        update_user_meta( $user_id, 'linkedinurl', "http://www.linkedin.com" );
        update_user_meta( $user_id, 'pinteresturl', "http://www.pinterest.com" );
        update_user_meta( $user_id, 'websiteurl', "http://www.website.com" );
        update_user_meta( $user_id, 'pagentproperty', array( 164, 158 ) );

        $userdata = array(
           'user_login'  =>  'raissa',
           'user_pass' => NULL,
           'user_nicename'    =>  'raissa',
           'user_email'   =>  'raissa_dreamvilla@gmail.com',
           'user_url'    =>  'http://raissa',
           'user_registered'    =>  '2015-08-21 08:16:59',
           'user_status'    =>  '0',
           'display_name'    =>  'raissa finch',
           'roles'    =>  'subscriber',
           'groups'    =>  '',
           'nickname'    =>  'raissa',
           'first_name'    =>  'Raissa',
           'last_name'    =>  'Finch',
           'description'    =>  '',
           'rich_editing'    =>  'true',
           'comment_shortcuts'    =>  'false',
           'admin_color'    =>  'fresh',
           'use_ssl'    =>  '0',
           'show_admin_bar_front'    =>  'true',
           'wp_capabilities'    =>  'subscriber|1',
           'wp_user_level'    =>  '0',
           'dismissed_wp_pointers'    =>  ''  
        );
        $user_id = wp_insert_user( $userdata );        
        update_user_meta( $user_id, 'profile_image_id', 292 );
        update_user_meta( $user_id, 'logo_image_id', 59 );
        update_user_meta( $user_id, 'fullname', 'Raissa Finch' );
        update_user_meta( $user_id, 'titleposition', 'CEO' );
        update_user_meta( $user_id, 'aboutme', "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen." );
        update_user_meta( $user_id, 'certificate', "Remax Certified Agent" );
        update_user_meta( $user_id, 'phone', "365-123-1254" );
        update_user_meta( $user_id, 'mobile', "6047864440" );
        update_user_meta( $user_id, 'skype', "raissa.finch" );
        update_user_meta( $user_id, 'facebookurl', "http://www.facebook.com" );
        update_user_meta( $user_id, 'twitterurl', "http://www.twitter.com" );
        update_user_meta( $user_id, 'linkedinurl', "http://www.linkedin.com" );
        update_user_meta( $user_id, 'pinteresturl', "http://www.pinterest.com" );
        update_user_meta( $user_id, 'websiteurl', "http://www.website.com" );
        update_user_meta( $user_id, 'pagentproperty', array( 163 ) );

        update_option("theme_mods_dreamvilla",array( 'nav_menu_locations' => array( 'primary' => 47 ) ) );
        update_option("show_on_front","page");
        update_option("page_on_front","78");
        update_option("page_for_posts","65");
        update_option("wsl_settings_Twitter_enabled","0");        

        $commentarr = array();
        $commentarr['comment_ID'] = 2;
        $commentarr['user_id'] = 2;
        wp_update_comment( $commentarr );

        $commentarr = array();
        $commentarr['comment_ID'] = 3;
        $commentarr['user_id'] = 3;
        wp_update_comment( $commentarr );

        $commentarr = array();
        $commentarr['comment_ID'] = 4;
        $commentarr['user_id'] = 4;
        wp_update_comment( $commentarr );

        $commentarr = array();
        $commentarr['comment_ID'] = 5;
        $commentarr['user_id'] = 5;
        wp_update_comment( $commentarr );
    }
    add_action( 'wbc_importer_after_content_import', 'dreamvilla_importer_after_import_settings', 10, 2 );
}