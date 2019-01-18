<?php
/*
 * Property List Options
 */
$opt_name;
Redux::setSection( $opt_name, array(
    'title' => esc_html__('Property List','dreamvilla-multiple-property'),
    'id'    => 'property-list-section',    
    'desc'  => esc_html__('This section contains options for property list.','dreamvilla-multiple-property'),
    'fields'=> array(

        array(
            'id'        => 'dreamvilla_property_list_list_variation',
            'type'      => 'image_select',
            'title'     => esc_html__( 'Property Listing List Variation', 'dreamvilla-multiple-property'),
            'subtitle'  => esc_html__( 'Select the design variation that you want to use for property listing list.', 'dreamvilla-multiple-property'),
            'options'   => array(
                'list1_layout_full_width' => array(
                    'title' => esc_html__('List Layout Variation 1 - Full Width', 'dreamvilla-multiple-property'),
                    'img' => get_template_directory_uri() . '/images/list1_layout_full_width.png',
                ),
                'list2_layout_full_width' => array(
                    'title' => esc_html__('List Layout Variation 2 - Full Width', 'dreamvilla-multiple-property'),
                    'img' => get_template_directory_uri() . '/images/list2_layout_full_width.png',
                ),
            ),
            'default'   => 'list1_layout_full_width',
        ),

        array(
            'id'        => 'dreamvilla_number_list_page',
            'type'      => 'select',
            'title'     => esc_html__( 'Number Of Properties To Display In List Layout','dreamvilla-multiple-property'),
            'options'   => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'),
            'default'   => '4'
        ),        

        array(
            'id'        => 'dreamvilla_property_list_grid_variation',
            'type'      => 'image_select',
            'title'     => esc_html__( 'Property Listing Grid Variation', 'dreamvilla-multiple-property'),
            'subtitle'  => esc_html__( 'Select the design variation that you want to use for property listing grid.', 'dreamvilla-multiple-property'),
            'options'   => array(
                'grid1_layout_full_width' => array(
                    'title' => esc_html__('Grid Layout Variation 1 - Full Width', 'dreamvilla-multiple-property'),
                    'img' => get_template_directory_uri() . '/images/grid1_Layout_Full_width.png',
                ),
                'grid2_layout_full_width' => array(
                    'title' => esc_html__('Grid Layout Variation 2 - Full Width', 'dreamvilla-multiple-property'),
                    'img' => get_template_directory_uri() . '/images/grid2_Layout_Full_width.png',
                ),
            ),
            'default'   => 'grid1_layout_full_width',
        ),

        array(
            'id'        => 'dreamvilla_number_grid_page',
            'type'      => 'select',
            'title'     => esc_html__( 'Number Of Properties To Display In Grid Layput','dreamvilla-multiple-property'),
            'options'   => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'),
            'default'   => '6'
        ),        

    )   ) 
);
