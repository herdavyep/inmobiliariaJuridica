<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage DreamVilla
 * @since DreamVilla 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">	
	
    <?php
	$dreamvilla_options = get_option('dreamvilla_options');
	if ( ! function_exists( 'wp_site_icon' ) || ! wp_site_icon() ) {
		if( !empty($dreamvilla_options['dreamvilla_fevicon']['url'] ) ) { ?>
			<link rel="shortcut icon" href="<?php echo esc_url($dreamvilla_options['dreamvilla_fevicon']['url']); ?>" /><?php 
		}
	}

	wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>

<?php
if(!empty($dreamvilla_options['menu_style']) && $dreamvilla_options['menu_style']=="sticky") { ?>
	<div id="main-menu"><?php
		$menu_name = 'primary';
		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
			$menu = wp_get_nav_menu_object( $locations[ $menu_name ] ); ?>

			<?php wp_nav_menu(
				array( 
					'menu' => $menu, 
					'container' => false, 
					'theme_location' => 'primary-menu', 
					'show_home' => '1')); 
		}	?>
	</div><?php
}

get_template_part("contact","model"); ?>

<header>
	<?php 

	$topbar_show = null;
	$topbar_show = rwmb_meta( 'dreamvilla_topbar_show' );

	if( $topbar_show == 1 ){

	if( !empty($dreamvilla_options['dreamvilla_header_variation']) && $dreamvilla_options['dreamvilla_header_variation'] == 2 ) { ?>
		<div class="homepage-varaiton2-welcome-header">
	<?php } ?>
	<div class="welcome_header <?php if( !empty($dreamvilla_options['dreamvilla_header_variation']) && $dreamvilla_options['dreamvilla_header_variation'] == 2 ) { echo 'welcome-header-homepage-variation-2'; } ?>">
		<div class="container">
			<div class="welcome-tab-line">
				<h6><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['dreamvilla_tag_line'] ); ?></h6>
			</div>				
			<div class="pull-right welcome_social_links">
				<?php if( !empty($dreamvilla_options['dreamvilla_contact_number_label']) || !empty($dreamvilla_options['dreamvilla_contact_number'] )){ ?>
					<div class="phone_icon">
						<i class="fa fa-phone"> </i>
					</div>
					<div class="phone_number">
						<span><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['dreamvilla_contact_number_label']); ?></span>
						<span class="phone_number_h2"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['dreamvilla_contact_number']); ?></span>
					</div>
				<?php } ?>
				<ul class="welcome_header_menu">
					<?php if( function_exists('icl_object_id') ) { ?><li><?php do_action('wpml_add_language_selector'); ?></li><?php } ?>
					<?php if( !empty($dreamvilla_options['dreamvilla_facebook'] )) { ?><li class="facebook_icon"><a href="<?php echo esc_url($dreamvilla_options['dreamvilla_facebook']); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php } ?>
					<?php if( !empty($dreamvilla_options['dreamvilla_twitter'] )) { ?><li class="twitter_icon"><a href="<?php echo esc_url($dreamvilla_options['dreamvilla_twitter']); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php } ?>
					<?php if( !empty($dreamvilla_options['dreamvilla_google_plus'] )) { ?><li class="google_plus_icon"><a href="<?php echo esc_url($dreamvilla_options['dreamvilla_google_plus']); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li><?php } ?>
					<?php if( !empty($dreamvilla_options['dreamvilla_pinterest'] )) { ?><li class="pinterest_icon"><a href="<?php echo esc_url($dreamvilla_options['dreamvilla_pinterest']); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li><?php } ?>
					<?php if( !empty($dreamvilla_options['dreamvilla_youtube'] )) { ?><li class="youtube_icon"><a href="<?php echo esc_url($dreamvilla_options['dreamvilla_youtube']); ?>" target="_blank"><i class="fa fa-youtube-play"></i></a></li><?php } ?>
				</ul>				
			</div>
		</div>
	</div>
	<?php } ?>
	<?php if( !empty($dreamvilla_options['dreamvilla_header_variation']) && $dreamvilla_options['dreamvilla_header_variation'] == 2 ) { ?>
	<div class="welcome_header_menu <?php if( !empty($dreamvilla_options['dreamvilla_header_variation']) && $dreamvilla_options['dreamvilla_header_variation'] == 2 ) { echo 'welcome-header-homepage-variation-2'; } ?>">
	<?php } 

	$header_show = null;
	$header_show = rwmb_meta( 'dreamvilla_header_show' );

	if( $header_show == 1 ){ ?>
	<div class="container">
		<div class="menu">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<?php if(!empty($dreamvilla_options['menu_style']) && $dreamvilla_options['menu_style']=="normal") { ?>
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
								<span class="sr-only"><?php esc_html_e('Toggle navigation','dreamvilla-multiple-property'); ?></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						<?php } else { ?>
							<a href="#main-menu" class="navbar-toggle collapsed">
								<span class="sr-only"><?php esc_html_e('Toggle navigation','dreamvilla-multiple-property'); ?></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</a>
						<?php } ?>
						<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' )); ?>">
						<?php if( !empty($dreamvilla_options["dreamvilla_logo"]['url'] )){ ?>
							<img src="<?php echo esc_attr($dreamvilla_options["dreamvilla_logo"]['url']); ?>" alt="logo">
						<?php } else { ?>
							<img src="<?php echo esc_attr(get_template_directory_uri()); ?>/images/logo.png" alt="logo">
						<?php } ?>
						</a>
					</div>
					<?php 
					$menu_name = 'primary';

					if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
						$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

					if( $menu )
						$menu_items = wp_get_nav_menu_items($menu->term_id);
					else
						$menu_items = ''; ?>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<?php wp_nav_menu(
							array( 
								'menu' => $menu, 
								'menu_class' => 'nav navbar-nav nav_link pull-right', 
								'menu_id' => 'navigation', 
								'container' => false, 
								'theme_location' => 'primary-menu', 
								'show_home' => '1')); 
						?>
					</div><!-- /.navbar-collapse -->
					<?php } ?>
				</div><!-- /.container-fluid -->
			</nav>
		</div><?php
		if(!empty($dreamvilla_options['show_front_end']) && $dreamvilla_options['show_front_end']=="yes") {
			if( !is_user_logged_in() ){ ?>
				<a href="javascript:void(0);" class="login-button"><?php esc_html_e('Submit Property','dreamvilla-multiple-property'); ?></a><?php
				dreamvilla_mp_login_register_form();
			} else {
				dreamvilla_mp_dashboard_menu();
			} 
		} else { ?>
			<div class="contact_info">
				<?php if( !empty($dreamvilla_options['dreamvilla_contact_number_label']) || !empty($dreamvilla_options['dreamvilla_contact_number'] )){ ?>
				<div class="contact_detial">
					<div class="phone_icon">
						<i class="fa fa-phone"></i>
					</div>
					<div class="phone_number">
						<h5><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['dreamvilla_contact_number_label']); ?></h5>
						<h2 class="phone_number_h2"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['dreamvilla_contact_number']); ?></h2>
					</div>
				</div>    
				<?php } ?>
			</div>
		<?php } ?>
	</div>
	<?php
	} if( !empty($dreamvilla_options['dreamvilla_header_variation']) && $dreamvilla_options['dreamvilla_header_variation'] == 2 ) { ?>
	</div>
	</div>
	<?php }

	if( isset( $dreamvilla_options['homepage_with_slider_map'] ) && $dreamvilla_options['homepage_with_slider_map'] == "homepage_with_map" && is_front_page() ){
		if( !empty($dreamvilla_options['dreamvilla_header_variation']) && $dreamvilla_options['dreamvilla_header_variation'] == 2 ){ ?>
			<div class="header variation-two-slider-map"><?php
		} else { ?>
			<div class="header"><?php
		} ?>
			<div id="property-listing-map" class="multiple-location-map" style="width:100%;height:800px;"></div>		
		</div><?php
	} ?>
</header>
