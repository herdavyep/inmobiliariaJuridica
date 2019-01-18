<?php
/*
 * Property Search Options
 */
$opt_name;
Redux::setSection( $opt_name, array(
    'title' => esc_html__('Property Search','dreamvilla-multiple-property'),
    'id'    => 'property-search-section',    
    'desc'  => esc_html__('This section contains options for property search.','dreamvilla-multiple-property'),
    'fields'=> array(

        array(
            'id'       => 'dreamvilla_search_page_list_variation',
            'type'     => 'select',
            'title'    => esc_html__( 'Search Page Layout', 'dreamvilla-multiple-property' ),
            'options'  => array(
                'list1_layout_full_width'     => esc_html__( 'List Layout Variation 1 - Full Width', 'dreamvilla-multiple-property' ),
                'list2_layout_full_width'     => esc_html__( 'List Layout Variation 2 - Full Width', 'dreamvilla-multiple-property' ),
                'grid1_Layout_Full_width'     => esc_html__( 'Grid Layout Variation 1 - Full Width', 'dreamvilla-multiple-property' ),
                'grid2_Layout_Full_width'     => esc_html__( 'Grid Layout Variation 2 - Full Width', 'dreamvilla-multiple-property' ),
            ),
            'default'  => 'list1_layout_full_Width',          
        ),

        array(
            'id'        => 'dreamvilla_search_page_list_variation',
            'type'      => 'image_select',
            'title'     => esc_html__( 'Search Page Layout', 'dreamvilla-multiple-property'),
            'subtitle'  => esc_html__( 'Select the design variation that you want to use for property search page.', 'dreamvilla-multiple-property'),
            'options'   => array(
                'list1_layout_full_width' => array(
                    'title' => esc_html__('List Layout Variation 1 - Full Width', 'dreamvilla-multiple-property'),
                    'img' => get_template_directory_uri() . '/images/list1_layout_full_width.png',
                ),
                'list2_layout_full_width' => array(
                    'title' => esc_html__('List Layout Variation 2 - Full Width', 'dreamvilla-multiple-property'),
                    'img' => get_template_directory_uri() . '/images/list2_layout_full_width.png',
                ),
                'grid1_Layout_Full_width' => array(
                    'title' => esc_html__('Grid Layout Variation 1 - Full Width', 'dreamvilla-multiple-property'),
                    'img' => get_template_directory_uri() . '/images/grid1_Layout_Full_width.png',
                ),
                'grid2_Layout_Full_width' => array(
                    'title' => esc_html__('Grid Layout Variation 2 - Full Width', 'dreamvilla-multiple-property'),
                    'img' => get_template_directory_uri() . '/images/grid2_Layout_Full_width.png',
                ),
            ),
            'default'   => 'list1_layout_full_width',
        ),

        array(
            'id'        => 'dreamvilla_search_number_property',
            'type'      => 'select',
            'title'     => esc_html__( 'Number Of Properties On Search Page','dreamvilla-multiple-property'),
            'options'   => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10'),
            'default'   => '5'
        ),

    )   ) 
);
