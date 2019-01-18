<?php
/*
 * Page Options
 */


$args = array(
    'role' => 'subscriber',
    'orderby' => 'user_nicename',
    'order' => 'ASC'
);

$agent_list = get_users($args);

$agent_array = array();
if( $agent_list ){
    foreach ($agent_list as $user) {
        $agent_array[$user->ID] = get_the_author_meta( 'display_name', $user->ID );        
    }
}

$opt_name;
Redux::setSection( $opt_name, array(
    'title' => esc_html__('Agent','dreamvilla-multiple-property'),
    'id'    => 'agent-section',
    'icon'  => 'el-icon-user',
    'desc'  => esc_html__('This section contains options for agent.','dreamvilla-multiple-property'),
    'fields'=> array(

        array(
                'id'       => 'Theme_Page_Agent_Page',
                'type'     => 'select',
                'title'    => esc_html__('Agent Page','dreamvilla-multiple-property'), 
                'options'  => dreamvilla_mp_get_theme_page(),                
        ),

        array(
                'id'       => 'property_main_agent',
                'type'     => 'select',
                'title'    => esc_html__('Main Agent','dreamvilla-multiple-property'), 
                'options'  => $agent_array,                
        ), 

         array(
                'id'       => 'agent_detail_contact_label',
                'type'     => 'text',
                'title'    => esc_html__('Agent Page Contact Form Label','dreamvilla-multiple-property'), 
                'default'   => 'Contact Me'
        ), 

         array(
                'id'       => 'agent_detail_listing_label',
                'type'     => 'text',
                'title'    => esc_html__('Agent Page Listing Property Label','dreamvilla-multiple-property'), 
                'default'   => 'Our Listing'
        ),   

    )   ) 
);
