<?php
add_filter( 'rwmb_meta_boxes', 'dreamvilla_meta_boxes' );
function dreamvilla_meta_boxes( $meta_boxes ) {	

	// Page, Post
	$meta_boxes[] = array(
		'title'			=> esc_attr__( 'Dreamvilla Page Options', 'dreamvilla' ),
		'post_types'	=> array('page','post'),
		'fields'		=> array(
			array(
				'id'	=> 'dreamvilla_page_title_bar_meta',
				'name'	=> esc_attr__( 'Show Page Title:', 'dreamvilla' ),
				'type'	=> 'switcher',
				'std'	=> 0,
			),
			array(
				'id'	=> 'dreamvilla_breadcrumb_title_bar_meta',
				'name'	=> esc_attr__( 'Show Breadcrumb:', 'dreamvilla' ),
				'type'	=> 'switcher',
				'std'	=> 0,
			),
			array(
				'id'	=> 'dreamvilla_banner_bg_img_meta',
				'name'	=> esc_attr__( 'Banner Background Image:', 'dreamvilla' ),
				'type'	=> 'image_advanced',
			),			
			array(
				'type'	=>'divider',
			),
			array(
				'id'	=> 'dreamvilla_sidebar_position_meta',
				'name'	=> esc_attr__( 'Sidebar Position:', 'dreamvilla' ),
				'type'	=> 'select',
				'options'	=> array(
					''		=> esc_attr__( 'None', 'dreamvilla' ),
					'right'	=> esc_attr__( 'Right', 'dreamvilla' ),
					'left'	=> esc_attr__( 'Left', 'dreamvilla' ),					
				),
				'placeholder'	=> esc_attr__( 'Select an Sidebar Position', 'dreamvilla' ),
			),
			array(
				'id'			=> 'dreamvilla_sidebar',
				'name'			=> esc_attr__( 'Sidebar :', 'dreamvilla' ),
				'type'			=> 'select',
				'options'		=> array(
										''							=> esc_attr__( 'None', 'dreamvilla' ),
										'sidebar-1'					=> esc_attr__( 'Widget Area', 'dreamvilla' ),
										'right_sidebar'				=> esc_attr__( 'Right Sidebar', 'dreamvilla' ),
										'left_sidebar'				=> esc_attr__( 'Left Sidebar', 'dreamvilla' ),
										'property_list_sidebar'		=> esc_attr__( 'Property List Sidebar', 'dreamvilla' ),
										'property_detail_sidebar'	=> esc_attr__( 'Property Detail Sidebar', 'dreamvilla' ),
										'dsidxpress_sidebar'		=> esc_attr__( 'dsIDXpress Sidebar', 'dreamvilla' ),
										
									),
				'placeholder'	=> esc_attr__( 'Select an Sidebar', 'dreamvilla' ),
			),
			array(
				'type'	=>'divider',
			),
			array(
				'id'	=> 'dreamvilla_topbar_show',
				'name'	=> esc_attr__( 'Show Topbar:', 'dreamvilla' ),
				'type'	=> 'switcher',
				'std'	=> 0,
			),
			array(
				'id'	=> 'dreamvilla_header_show',
				'name'	=> esc_attr__( 'Show Header:', 'dreamvilla' ),
				'type'	=> 'switcher',
				'std'	=> 0,
			),
			array(
				'id'	=> 'dreamvilla_footer_show',
				'name'	=> esc_attr__( 'Show Footer:', 'dreamvilla' ),
				'type'	=> 'switcher',
				'std'	=> 0,
			),
			array(
				'type'	=>'divider',
			),					
		),
	);

	// Property
	$meta_boxes[] = array(
		'title'			=> esc_attr__( 'Dreamvilla Property Options', 'dreamvilla' ),
		'post_types'	=> array('property'),
		'fields'		=> array(			
			array(
				'id'	=> 'dreamvilla_topbar_show',
				'name'	=> esc_attr__( 'Show Topbar:', 'dreamvilla' ),
				'type'	=> 'switcher',
				'std'	=> 0,
			),
			array(
				'id'	=> 'dreamvilla_header_show',
				'name'	=> esc_attr__( 'Show Header:', 'dreamvilla' ),
				'type'	=> 'switcher',
				'std'	=> 0,
			),
			array(
				'id'	=> 'dreamvilla_footer_show',
				'name'	=> esc_attr__( 'Show Footer:', 'dreamvilla' ),
				'type'	=> 'switcher',
				'std'	=> 0,
			),
			array(
				'type'	=>'divider',
			),					
		),
	);
	
	return $meta_boxes;
}