<?php
/*
 * Members Options
 */

$opt_name;
Redux::setSection( $opt_name, array(
    'title' => esc_html__('Members','dreamvilla-multiple-property'),
    'id'    => 'members-section',
    'desc'  => esc_html__('This section contains options for Members.','dreamvilla-multiple-property'),
    'fields'=> array(

        array(
                'id'       => 'new_user_send_admin',
                'type'     => 'button_set',
                'title'    => esc_html__('Notify Admin For New User Registration','dreamvilla-multiple-property'), 
                'options'  => array(
                                'yes' => 'Yes',
                                'no'  => 'No'
                            ),
                'default'   => 'yes'
        ),

        array(
                'id'       => 'new_user_send_user',
                'type'     => 'button_set',
                'title'    => esc_html__('Notify User For Your Registration','dreamvilla-multiple-property'), 
                'options'  => array(
                                'yes' => 'Yes',
                                'no'  => 'No'
                            ),
                'default'   => 'yes'
        ),

        array(
            'id'       => 'user_dashboard_profile',
            'type'     => 'select',
            'title'    => esc_html__('My Profile Page','dreamvilla-multiple-property'),
            'desc'     => esc_html__('Make sure the selected page is using My Profile template.', 'dreamvilla-multiple-property'),
            'options'  => dreamvilla_mp_get_theme_page(),                
        ),

        array(
            'id'       => 'user_dashboard_property_list',
            'type'     => 'select',
            'title'    => esc_html__('My Property List Page','dreamvilla-multiple-property'),
            'desc'     => esc_html__('Make sure the selected page is using My Property List template.', 'dreamvilla-multiple-property'),
            'options'  => dreamvilla_mp_get_theme_page(),                
        ),

        array(
            'id'       => 'user_dashboard_submit_property',
            'type'     => 'select',
            'title'    => esc_html__('Submit Property Page','dreamvilla-multiple-property'),
            'desc'     => esc_html__('Make sure the selected page is using Submit Property template.', 'dreamvilla-multiple-property'),
            'options'  => dreamvilla_mp_get_theme_page(),                
        ),

        array(
            'id'       => 'user_dashboard_favorites',
            'type'     => 'select',
            'title'    => esc_html__('Favorites Property Page','dreamvilla-multiple-property'),
            'desc'     => esc_html__('Make sure the selected page is using Favorite Property List template.', 'dreamvilla-multiple-property'),
            'options'  => dreamvilla_mp_get_theme_page(),                
        ),

        array(
            'id'       => 'user_dashboard_saved_searchs',
            'type'     => 'select',
            'title'    => esc_html__('Saved Searches Page','dreamvilla-multiple-property'),
            'desc'     => esc_html__('Make sure the selected page is using Saved Searches template.', 'dreamvilla-multiple-property'),
            'options'  => dreamvilla_mp_get_theme_page(),                
        ),

        array(
            'id'       => 'user_dashboard_invoices',
            'type'     => 'select',
            'title'    => esc_html__('My Invoices Page','dreamvilla-multiple-property'),
            'desc'     => esc_html__('Make sure the selected page is using My Invoices template.', 'dreamvilla-multiple-property'),
            'options'  => dreamvilla_mp_get_theme_page(),                
        ),

        array(
            'id'       => 'user_dashboard_package',
            'type'     => 'select',
            'title'    => esc_html__('Package Page','dreamvilla-multiple-property'),
            'desc'     => esc_html__('Make sure the selected page is using Package template.', 'dreamvilla-multiple-property'),
            'options'  => dreamvilla_mp_get_theme_page(),                
        ),

        /*array(
            'id'       => 'notify_membership_expired',
            'type'     => 'text',
            'validate' => 'numeric',
            'title'    => esc_html__('Notify User Member Expired','dreamvilla-multiple-property'),
            'desc'     => esc_html__('Make sure the selected page is using Package template.', 'dreamvilla-multiple-property'),
        ),*/

        array(
            'id'       => 'default_submit_status',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Default Status of Submitted Property', 'dreamvilla-multiple-property' ),
            'options'  => array(
                'pending' => esc_html__( 'Pending for Review', 'dreamvilla-multiple-property' ),
                'publish' => esc_html__( 'Publish', 'dreamvilla-multiple-property' ),
            ),
            'default'  => 'pending',
            'required' => array( 'user_dashboard_submit_property', '>', 0 )
        ),      

        array(
                'id'       => 'member_after_login_link',
                'type'     => 'select',
                'title'    => esc_html__('Redirect User After Success Login','dreamvilla-multiple-property'), 
                'options'  => dreamvilla_mp_get_theme_page(),                
        ),

        array(
                'id'       => 'member_after_logout_link',
                'type'     => 'select',
                'title'    => esc_html__('Redirect User After Success Logout','dreamvilla-multiple-property'), 
                'options'  => dreamvilla_mp_get_theme_page(),                
        ),

    )   ) 
);
