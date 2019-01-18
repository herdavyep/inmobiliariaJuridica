<?php 
/*
Plugin Name: Dreamvilla Multiple Property
Plugin URI: http://fortune-creations.com/
Description: Dreamvilla plugin provides property post type, agent post type, what people say you post type, gallery post type and slider post type with related functionality.
Author: Fortune Creations
Version: 1.0
Author URI: http://fortune-creations.com/
*/

// Register property type custom post
add_action( 'init', 'dreamvilla_mp_estate_property' );
function dreamvilla_mp_estate_property() {
	$labels = array(
		'name'               => esc_html__( 'Property', 'post type general name', 'dreamvilla-multiple-property' ),
		'singular_name'      => esc_html__( 'Property', 'post type singular name', 'dreamvilla-multiple-property' ),
		'menu_name'          => esc_html__( 'Property', 'admin menu', 'dreamvilla-multiple-property' ),
		'name_admin_bar'     => esc_html__( 'Property', 'add new on admin bar', 'dreamvilla-multiple-property' ),
		'add_new'            => esc_html__( 'Add New', 'Property', 'dreamvilla-multiple-property' ),
		'add_new_item'       => esc_html__( 'Add New Property', 'dreamvilla-multiple-property' ),
		'new_item'           => esc_html__( 'New Property', 'dreamvilla-multiple-property' ),
		'edit_item'          => esc_html__( 'Edit Property', 'dreamvilla-multiple-property' ),
		'view_item'          => esc_html__( 'View Property', 'dreamvilla-multiple-property' ),
		'all_items'          => esc_html__( 'All Properties', 'dreamvilla-multiple-property' ),
		'search_items'       => esc_html__( 'Search Property', 'dreamvilla-multiple-property' ),
		'parent_item_colon'  => esc_html__( 'Parent Property:', 'dreamvilla-multiple-property' ),
		'not_found'          => esc_html__( 'No Properties found.', 'dreamvilla-multiple-property' ),
		'not_found_in_trash' => esc_html__( 'No Properties found in Trash.', 'dreamvilla-multiple-property' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'property' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'			 => 'dashicons-admin-home',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'property', $args );
}

// Register Photo Gallery type custom post
add_action( 'init', 'dreamvilla_mp_estate_photo_gallery' );
function dreamvilla_mp_estate_photo_gallery() {
	$labels = array(
		'name'               => esc_html__( 'Photo Gallery', 'post type general name', 'dreamvilla-multiple-property' ),
		'singular_name'      => esc_html__( 'Photo Gallery', 'post type singular name', 'dreamvilla-multiple-property' ),
		'menu_name'          => esc_html__( 'Photo Gallery', 'admin menu', 'dreamvilla-multiple-property' ),
		'name_admin_bar'     => esc_html__( 'Photo Gallery', 'add new on admin bar', 'dreamvilla-multiple-property' ),
		'add_new'            => esc_html__( 'Add New', 'Photo', 'dreamvilla-multiple-property' ),
		'add_new_item'       => esc_html__( 'Add New Photo', 'dreamvilla-multiple-property' ),
		'new_item'           => esc_html__( 'New Photo', 'dreamvilla-multiple-property' ),
		'edit_item'          => esc_html__( 'Edit Photo', 'dreamvilla-multiple-property' ),
		'view_item'          => esc_html__( 'View Photo', 'dreamvilla-multiple-property' ),
		'all_items'          => esc_html__( 'All Photos', 'dreamvilla-multiple-property' ),
		'search_items'       => esc_html__( 'Search Photo', 'dreamvilla-multiple-property' ),
		'parent_item_colon'  => esc_html__( 'Parent Photo:', 'dreamvilla-multiple-property' ),
		'not_found'          => esc_html__( 'No Photos found.', 'dreamvilla-multiple-property' ),
		'not_found_in_trash' => esc_html__( 'No Photos found in Trash.', 'dreamvilla-multiple-property' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'photo_gallery' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'			 => 'dashicons-images-alt2',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'photo_gallery', $args );
}

// Register What people say type custom post
add_action( 'init', 'dreamvilla_mp_estate_what_people_say' );
function dreamvilla_mp_estate_what_people_say() {
	$labels = array(
		'name'               => esc_html__( 'What people say', 'post type general name', 'dreamvilla-multiple-property' ),
		'singular_name'      => esc_html__( 'What people say', 'post type singular name', 'dreamvilla-multiple-property' ),
		'menu_name'          => esc_html__( 'What people say', 'admin menu', 'dreamvilla-multiple-property' ),
		'name_admin_bar'     => esc_html__( 'What people say', 'add new on admin bar', 'dreamvilla-multiple-property' ),
		'add_new'            => esc_html__( 'Add New', 'What people say', 'dreamvilla-multiple-property' ),
		'add_new_item'       => esc_html__( 'Add New What people say', 'dreamvilla-multiple-property' ),
		'new_item'           => esc_html__( 'New What people say', 'dreamvilla-multiple-property' ),
		'edit_item'          => esc_html__( 'Edit What people say', 'dreamvilla-multiple-property' ),
		'view_item'          => esc_html__( 'View What people say', 'dreamvilla-multiple-property' ),
		'all_items'          => esc_html__( 'All What people say', 'dreamvilla-multiple-property' ),
		'search_items'       => esc_html__( 'Search What people say', 'dreamvilla-multiple-property' ),
		'parent_item_colon'  => esc_html__( 'Parent What people say:', 'dreamvilla-multiple-property' ),
		'not_found'          => esc_html__( 'No What people say found.', 'dreamvilla-multiple-property' ),
		'not_found_in_trash' => esc_html__( 'No What people say found in Trash.', 'dreamvilla-multiple-property' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'what_people_say' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'			 => 'dashicons-groups',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'what_people_say', $args );
}

// Register package type custom post
add_action( 'init', 'dreamvilla_mp_package' );
function dreamvilla_mp_package() {
	$labels = array(
		'name'               => esc_html__( 'Package', 'post type general name', 'dreamvilla-multiple-property' ),
		'singular_name'      => esc_html__( 'Package', 'post type singular name', 'dreamvilla-multiple-property' ),
		'menu_name'          => esc_html__( 'Package', 'admin menu', 'dreamvilla-multiple-property' ),
		'name_admin_bar'     => esc_html__( 'Package', 'add new on admin bar', 'dreamvilla-multiple-property' ),
		'add_new'            => esc_html__( 'Add New', 'Package', 'dreamvilla-multiple-property' ),
		'add_new_item'       => esc_html__( 'Add New Package', 'dreamvilla-multiple-property' ),
		'new_item'           => esc_html__( 'New Package', 'dreamvilla-multiple-property' ),
		'edit_item'          => esc_html__( 'Edit Package', 'dreamvilla-multiple-property' ),
		'view_item'          => esc_html__( 'View Package', 'dreamvilla-multiple-property' ),
		'all_items'          => esc_html__( 'All Packages', 'dreamvilla-multiple-property' ),
		'search_items'       => esc_html__( 'Search Package', 'dreamvilla-multiple-property' ),
		'parent_item_colon'  => esc_html__( 'Parent Package:', 'dreamvilla-multiple-property' ),
		'not_found'          => esc_html__( 'No Packages found.', 'dreamvilla-multiple-property' ),
		'not_found_in_trash' => esc_html__( 'No Packages found in Trash.', 'dreamvilla-multiple-property' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'package' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'			 => 'dashicons-media-spreadsheet',
		'supports'           => array( 'title', 'thumbnail' )
	);

	register_post_type( 'package', $args );
}

add_action( 'init', 'dreamvilla_mp_photo_gallery_category' );
function dreamvilla_mp_photo_gallery_category() {
	register_taxonomy(
		'gallery_category',
		'photo_gallery',
		array(
			'label' => esc_html__( 'Gallery Category', 'dreamvilla-multiple-property' ),
			'rewrite' => array( 'slug' => 'gallery_category' ),
			'hierarchical' => true,
		)
	);

	register_taxonomy(
		'property_category',
		'property',
		array(
			'label' => esc_html__( 'Category', 'dreamvilla-multiple-property' ),
			'rewrite' => array( 'slug' => 'property_category' ),
			'hierarchical' => true,
		)
	);

	register_taxonomy(
		'property_status',
		'property',
		array(
			'label' => esc_html__( 'Status', 'dreamvilla-multiple-property' ),
			'rewrite' => array( 'slug' => 'property_status' ),
			'hierarchical' => true,
		)
	);

	register_taxonomy(
		'location',
		'property',
		array(
			'label' => esc_html__( 'Location', 'dreamvilla-multiple-property' ),
			'rewrite' => array( 'slug' => 'location' ),
			'hierarchical' => true,
		)
	);

	register_taxonomy(
		'features',
		'property',
		array(
			'label' => esc_html__( 'Features', 'dreamvilla-multiple-property' ),
			'rewrite' => array( 'slug' => 'features' ),
			'hierarchical' => true,
		)
	);
}

add_action( 'plugins_loaded', 'shortcodes_init' );
function shortcodes_init() {
	foreach( glob( plugin_dir_path( __FILE__ ) . '/visualcomposer/shortcodes/*.php' ) as $filename ) {
		require_once $filename;
	}
}

require_once ( plugin_dir_path( __FILE__ ) . 'lib/admin-shortcodes.php' );
?>