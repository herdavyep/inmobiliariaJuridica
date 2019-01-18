<?php
/*
 * Property Filter Options
 */

$opt_name;
Redux::setSection( $opt_name, array(
    'title' => esc_html__('Property Filter Section','dreamvilla-multiple-property'),
    'id'    => 'filter-section',    
    'icon'  => 'el-icon-home-alt',
    'desc'  => esc_html__('This section contains options for property filter.','dreamvilla-multiple-property'),
    'fields'=> array(

        array(
            'id'        => 'dreamvilla_search_form_title',
            'type'      => 'text',
            'title'     => esc_html__( 'Search Form Title','dreamvilla-multiple-property'),
            'default'   => 'Find Your Dream Home'
        ),

        array(
            'id'        => 'dreamvilla_search_button_title',
            'type'      => 'text',
            'title'     => esc_html__( 'Search Button Title','dreamvilla-multiple-property'),
            'default'   => 'Search Now'
        ),

        array(
            'id'      => 'filter_manager',
            'type'    => 'sorter',
            'title'   => 'Filter Element',
            'desc'    => 'Organize how you want the layout to appear on the filter section',
            'options' => array(
                'enabled'  => array(
                    'keyword'       => 'Keyword',
                    'category'      => 'Category',
                    'status'        => 'Status',
                    'location'      => 'Location',
                    'bedrooms'      => 'Bedrooms',
                    'bathrooms'     => 'Bathrooms',
                    'garages'       => 'Garages',
                    'price'         => 'Price',
                    'more_filter'   => 'More Filter',
                ),
                'disabled' => array(                                      
                )
            ),
        ),

        array(
            'id'      => 'widget_filter_manager',
            'type'    => 'sorter',
            'title'   => 'Widget Filter Element',
            'desc'    => 'Organize how you want the layout to appear on the widget filter section',
            'options' => array(
                'enabled'  => array(
                    'keyword'       => 'Keyword',
                    'category'      => 'Category',
                    'status'        => 'Status',
                    'location'      => 'Location',
                    'bedrooms'      => 'Bedrooms',
                    'bathrooms'     => 'Bathrooms',
                    'garages'       => 'Garages',
                    'price'         => 'Price',                    
                ),
                'disabled' => array(                                      
                )
            ),
        ),       
        
    )   ) 
);
