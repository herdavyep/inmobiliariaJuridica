<?php
/*
 * Page Options
 */
$opt_name;
Redux::setSection( $opt_name, array(
    'title' => esc_html__('Page','dreamvilla-multiple-property'),
    'id'    => 'page-section',
    'icon'  => 'el-icon-file',
    'desc'  => esc_html__('This section contains options for page.','dreamvilla-multiple-property'),
    'fields'=> array(

        array(
                'id'       => 'Theme_Page_Footer_Page',
                'type'     => 'select',
                'title'    => esc_html__('Footer','dreamvilla-multiple-property'), 
                'options'  => dreamvilla_mp_get_theme_page(),                
        ),

        array(
                'id'       => 'Theme_Page_Property_Listing_List',
                'type'     => 'select',
                'title'    => esc_html__('Property Listing List','dreamvilla-multiple-property'), 
                'options'  => dreamvilla_mp_get_theme_page(),                
        ),

        array(
                'id'       => 'Theme_Page_Property_Listing_Grid',
                'type'     => 'select',
                'title'    => esc_html__('Property Listing Grid','dreamvilla-multiple-property'), 
                'options'  => dreamvilla_mp_get_theme_page(),                
        ),

        array(
                'id'       => 'Theme_Page_Property_Listing_Map',
                'type'     => 'select',
                'title'    => esc_html__('Property Listing Map','dreamvilla-multiple-property'), 
                'options'  => dreamvilla_mp_get_theme_page(),                
        ), 

        array(
                'id'       => 'Theme_Page_Property_Listing_Search',
                'type'     => 'select',
                'title'    => esc_html__('Property Listing Search','dreamvilla-multiple-property'), 
                'options'  => dreamvilla_mp_get_theme_page(),                
        ),       

    )   ) 
);
