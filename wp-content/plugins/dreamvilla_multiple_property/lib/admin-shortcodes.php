<?php

add_shortcode('description', 'dreamvilla_mp_add_description');
function dreamvilla_mp_add_description($atts, $content = null){
	return '<p class="description div_discription">'.$content.'</p>';
}

add_shortcode('near_by_place_info_part', 'dreamvilla_mp_add_near_by_place_info_part');
function dreamvilla_mp_add_near_by_place_info_part($atts, $content = null){
	return '
	<div class="col-md-5 col-sm-5">
		<ul class="near-by-place-detail">
			'.do_shortcode($content).'
		</ul>
	</div>';
}

add_shortcode('near_place_info', 'dreamvilla_mp_add_near_place_info');
function dreamvilla_mp_add_near_place_info($atts, $content = null){
	
	extract(shortcode_atts(array(
		'main_title' => '',
		'sub_title' => '',
		'title' => '',
		'description' => '',
		'icon_scr' => ''
	), $atts));

	if( $main_title ){
		$html = '<li>
					<h2><span>'.$main_title.'</span> '.$sub_title.'</h2>
					<p class="near-place-description">'.$description.'</p>
				</li>';
	} else {
		$html = '<li>
					<div class="nearicon pull-left">
						<img src="'.$icon_scr.'"  alt="icon" />
					</div>
					<div>
						<h3>'.$title.'</h3>
						<p>'.$description.'</p>
					</div>
				</li>';
	}
	return $html;
}

add_shortcode('image', 'dreamvilla_mp_add_image');
function dreamvilla_mp_add_image($atts, $content = null){
	
	extract(shortcode_atts(array(
		'src' => '',
		'width' => '100%',
		'height' => '100%',
		'alt' => 'alt-img'		
	), $atts));
	
	if($width!="")
	{
		$width_string='width="'.$width.'"';
	}
	if($height!="")
	{
		$height_string='height="'.$height.'"';
	}
	return '<img src='.$src.' '.$width_string.' '.$height_string.' alt="'.$alt.'" class="img-responsive" />';
}

// Room dimensions page shortcode
add_shortcode('is_room_dimensions', 'dreamvilla_mp_add_is_room_dimensions');
function dreamvilla_mp_add_is_room_dimensions($atts, $content = null){
	return '<div class="row">'.do_shortcode($content).'</div>';
}

add_shortcode('is_tab_area', 'dreamvilla_mp_add_is_tab_area');
function dreamvilla_mp_add_is_tab_area($atts, $content = null){
	return 
	'<div class="dimension-btn show-hide-btn">
		'.do_shortcode($content).'
	</div>';
}

add_shortcode('tab_detail', 'dreamvilla_mp_add_tab_detail');
function dreamvilla_mp_add_tab_detail($atts, $content = null){
	
	extract(shortcode_atts(array(
		'tab_name' => '',
		'data_id' => ''		
	), $atts));

	return '<a href="javascript:void(0)" data-id="'.$data_id.'">'.$tab_name.'</a>';
}

add_shortcode('tab_content_part', 'dreamvilla_mp_add_tab_content_part');
function dreamvilla_mp_add_tab_content_part($atts, $content = null){

	extract(shortcode_atts(array(
		'id' => ''
	), $atts));

	return 
	'<div class="Dimension-detail show-hide-detail" id="'.$id.'">
		'.do_shortcode($content).'
	</div>';
}

add_shortcode('tab_left_part', 'dreamvilla_mp_add_tab_left_part');
function dreamvilla_mp_add_tab_left_part($atts, $content = null){
	return 
	'<div class="col-lg-6 col-md-6 col-sm-12">
		<div class="slider_div carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
			</ol>
			<div class="carousel-inner" role="listbox">
				'.do_shortcode($content).'
			</div>
		</div>
	</div>';
}

add_shortcode('tab_left_part_image', 'dreamvilla_mp_add_tab_left_part_image');
function dreamvilla_mp_add_tab_left_part_image($atts, $content = null){

	extract(shortcode_atts(array(
		'src' => '',
		'dimensions_label' => 'Dimension',
		'dimensions' => ''
	), $atts));

	if( $src ){
		return
		'<div class="item">
			<img src="'.$src.'" alt="house-image">
			<div class="label-dimension">
				<p class="size-name">'.$dimensions_label.'</p>
				<p class="size">'.$dimensions.'</p>
			</div>
		</div>';
	} else {
		return '';
	}
}

add_shortcode('tab_right_part', 'dreamvilla_mp_add_tab_right_part');
function dreamvilla_mp_add_tab_right_part($atts, $content = null){
	return 
	'<div class="col-lg-6 col-md-6 col-sm-12">
		'.do_shortcode($content).'
	</div>';
}

add_shortcode('tab_right_part_header', 'dreamvilla_mp_add_tab_right_part_header');
function dreamvilla_mp_add_tab_right_part_header($atts, $content = null){
	
	extract(shortcode_atts(array(
		'title' => '',
		'description' => ''
	), $atts));

	return 
	'<h2>'.$title.'</h2>
	<p class="room-dimension-detail-p">'.$description.'</p>
	<ul class="room-dimension-detail">
		'.do_shortcode($content).'
	</ul>';
}

add_shortcode('tab_right_part_content', 'dreamvilla_mp_add_tab_right_part_content');
function dreamvilla_mp_add_tab_right_part_content($atts, $content = null){
	
	extract(shortcode_atts(array(
		'title' => '',
		'description' => '',
		'icon_src' => ''
	), $atts));

	return 
	'<li>
		<div class="featureicon pull-left">
			<img src="'.$icon_src.'" alt="icon"/>			
		</div>
		<div>
			<h3>'.$title.'</h3>
			<p>'.$description.'</p>
		</div>
	</li>';
}

// Features of will page shortcode
add_shortcode('is_features_of_villa', 'dreamvilla_mp_add_is_features_of_villa');
function dreamvilla_mp_add_is_features_of_villa($atts, $content = null){
	if( is_page_template( 'page-templates/homepage-variation.php' ) ){
	  return '<div class="row">'.do_shortcode($content).'</div>';
	}
}

add_shortcode('features_of_villa_left_part', 'dreamvilla_mp_add_features_of_villa_left_part');
function dreamvilla_mp_add_features_of_villa_left_part($atts, $content = null){
	return 
	'<div class="col-lg-6">
		<div class="slider_div carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
			</ol>
			<div class="carousel-inner" role="listbox">
				'.do_shortcode($content).'
			</div>			
		</div>
	</div>';
}

add_shortcode('left_part_image', 'dreamvilla_mp_add_left_part_image');
function dreamvilla_mp_add_left_part_image($atts, $content = null){
	extract(shortcode_atts(array(
		'src' => ''
	), $atts));

	return 
	'<div class="item">
		<img src="'.$src.'" alt="house-image">
	</div>';
}

add_shortcode('features_of_villa_right_part', 'dreamvilla_mp_add_features_of_villa_right_part');
function dreamvilla_mp_add_features_of_villa_right_part($atts, $content = null){
	return 
	'<div class="col-lg-6">
		<ul>
			'.do_shortcode($content).'
		</ul>
	</div>';
}

add_shortcode('villa_facility', 'dreamvilla_mp_add_villa_facility');
function dreamvilla_mp_add_villa_facility($atts, $content = null){
	extract(shortcode_atts(array(
		'title' => '',
		'description' => '',
		'icon_src' => ''
	), $atts));

	return 
	'<li>
		<div class="featureicon pull-left">
			<img src="'.$icon_src.'" alt="features vill image">
		</div>
		<div>
			<h3>'.$title.'</h3>
			<p>'.$description.'</p>
		</div>
	</li>';
}

// About dreamvilla page shortcode
add_shortcode('is_about_us', 'dreamvilla_mp_add_is_about_us');
function dreamvilla_mp_add_is_about_us($atts, $content = null){
	return '<section>'.do_shortcode($content).'</section>';
}

add_shortcode('heading', 'dreamvilla_mp_add_heading');
function dreamvilla_mp_add_heading($atts, $content = null){
	return '<h2 class="small-heading">'.$content.'</h2>';	
}

add_shortcode('about_description', 'dreamvilla_mp_add_about_description');
function dreamvilla_mp_add_about_description($atts, $content = null){
	return '<p class="div_discription">'.$content.'</p>';	
}

add_shortcode('about_property', 'dreamvilla_mp_add_about_property');
function dreamvilla_mp_add_about_property($atts, $content = null){
	return
	'<section>
		<div class="about-city-estate">
			<div class="container">
				<div class="row">'.do_shortcode($content).'</div>
			</div>
		</div>
	</section>';
}

add_shortcode('about_property_left_part', 'dreamvilla_mp_about_property_left_part');
function dreamvilla_mp_about_property_left_part($atts, $content = null){
	extract(shortcode_atts(array(
		'title' => '',		
		'description' => '',		
	), $atts));

	return 
	'<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<h3 class="section-heading">'.$title.'</h3>
		'.$description.'
	</div>';
}

add_shortcode('about_property_right_part', 'dreamvilla_mp_about_property_right_part');
function dreamvilla_mp_about_property_right_part($atts, $content = null){
	extract(shortcode_atts(array(
		'video_title' => 'Property Video',
		'video_image_src' => '',		
		'video_src' => '',
	), $atts));

	return 
	'<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<a href="#" data-toggle="modal" data-target="#property-video-model"><img src="'.$video_image_src.'" alt="about video" class="img-responsive"></a>
	</div>
	<div id="property-video-model" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						&times;
					</button>
					<h4 class="modal-title">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$video_title).'</h4>
				</div>
				<div class="modal-body">
					<video controls>
						<source src="'.$video_src.'" type="video/mp4">
						Your browser does not support HTML5 video.
					</video>
				</div>
			</div>
		</div>
	</div>';
}

add_shortcode('about_us_amenities', 'dreamvilla_mp_add_about_us_amenities');
function dreamvilla_mp_add_about_us_amenities($atts, $content = null){
	extract(shortcode_atts(array(
		'title' => '',
		'description' => '',
		'img_src' => '',
	), $atts));

	return
	'<div class="amenities">
		<div class="container-fluid">
			<div class="row">
				<div id="amenities-img" class="col-md-5 col-sm-5 col-xs-12">
					<img src="'.$img_src.'" alt="amenities image">
				</div>
				<div id="amenities-content" class="col-md-7 col-sm-7 col-xs-12">
					<h2>'.$title.'</h2>
					'.$description.'
					<div class="amenities-marker">
						'.do_shortcode($content).'
					</div>
				</div>
			</div>
		</div>
	</div>';
}

add_shortcode('amenities_point', 'dreamvilla_mp_add_amenities_point');
function dreamvilla_mp_add_amenities_point($atts, $content = null){
	return '<p><img src="'.get_template_directory_uri().'/images/map-marker.jpg" alt="map-marker"/>'.$content.'</p>';
}

add_shortcode('about_us_feature', 'dreamvilla_mp_add_about_us_feature');
function dreamvilla_mp_add_about_us_feature($atts, $content = null){
	
	extract(shortcode_atts(array(
		'title' => '',
		'description' => ''		
	), $atts));	

	return
	'<section>
		<div class="inner-page-features-villa">
			<div class="container">
				<h2 class="header_with_icon">'.$title.'</h2>				
				<p class="description">'.$description.'</p>
				'.do_shortcode($content).'
			</div>
		</div>
	</section>';
}

add_shortcode('about_us_feature_contnet_row', 'dreamvilla_mp_add_about_us_feature_contnet_row');
function dreamvilla_mp_add_about_us_feature_contnet_row($atts, $content = null){
	return '<div class="row inner-feature-villa">'.do_shortcode($content).'</div>';
}

add_shortcode('about_us_feature_contnet', 'dreamvilla_mp_add_about_us_feature_contnet');
function dreamvilla_mp_add_about_us_feature_contnet($atts, $content = null){
	extract(shortcode_atts(array(
		'title' => '',
		'description' => '',
		'img_scr' => ''
	), $atts));

	return 
	'<div class="col-md-4 col-sm-4 col-xs-12">
		<img src="'.$img_scr.'" alt="image">
		<h4>'.$title.'</h4>
		'.$description.'
	</div>';
}

add_shortcode('about_us_feature_with_image', 'dreamvilla_mp_add_about_us_feature_with_image');
function dreamvilla_mp_add_about_us_feature_with_image($atts, $content = null){
	
	extract(shortcode_atts(array(
		'title' => '',
		'description' => ''		
	), $atts));	

	return
	'<section>
		<div class="inner-page-features">
			<div class="container">
				<h2 class="header_with_icon">'.$title.'</h2>				
				<p class="description">'.$description.'</p>
				'.do_shortcode($content).'
			</div>
		</div>
	</section>';
}

add_shortcode('about_us_valuable_clients', 'dreamvilla_mp_about_us_valuable_clients');
function dreamvilla_mp_about_us_valuable_clients($atts, $content = null){
	
	extract(shortcode_atts(array(
		'title' => 'Valuable Clients',		
	), $atts));	

	return
	'<section>
		<div class="multiple-valuable-clients-area">
			<div class="container">
				<h2 class="header_with_icon">'.$title.'</h2>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-lg-12" id="multiple-valuable-clients-img-area">
						'.do_shortcode($content).'
					</div>
				</div>
			</div>												
		</div>
	</section>';
}

add_shortcode('add_image', 'dreamvilla_mp_add_add_image');
function dreamvilla_mp_add_add_image($atts, $content = null){
	
	extract(shortcode_atts(array(
		'alt' => 'valuable clients',
		'src' => '',
	), $atts));

	return '<img src="'.$src.'" alt="'.$alt.'" >';
}


add_shortcode('video_iframe', 'dreamvilla_mp_add_video_iframe');
function dreamvilla_mp_add_video_iframe($atts, $content = null){
	extract(shortcode_atts(array(
		'width' => '',
		'height' => '687',
		'video_src' => ''
	), $atts));
	$width_string="";
	if($width!="")
	{
		$width_string= 'width="'.$width.'"';
	}
	return 
	'<section>
		<div class="inner-tour-video">
			<div class="container">
				<div class="row">
					<iframe '.$width_string.' height="'.$height.'" src="'.$video_src.'">
					</iframe>
				</div>
			</div>
		</div>
	</section>';
}

// Take a tour page shortcode
add_shortcode('tour_feature', 'dreamvilla_mp_add_tour_feature');
function dreamvilla_mp_add_tour_feature($atts, $content = null){
	
	extract(shortcode_atts(array(
		'title' => '',
		'description' => ''		
	), $atts));	

	return
	'<section>
		<div class="inner-features-villa">
			<div class="container">
				<h1 class="header_with_icon">'.$title.'</h1>
				<p class="description">'.$description.'</p>
				'.do_shortcode($content).'
			</div>
		</div>
	</section>';
}

add_shortcode('tour_feature_contnet_row', 'dreamvilla_mp_add_tour_feature_contnet_row');
function dreamvilla_mp_add_tour_feature_contnet_row($atts, $content = null){
	return '<div class="row feature-villa">'.do_shortcode($content).'</div>';
}

add_shortcode('tour_feature_contnet', 'dreamvilla_mp_add_tour_feature_contnet');
function dreamvilla_mp_add_tour_feature_contnet($atts, $content = null){
	extract(shortcode_atts(array(
		'title' => '',
		'description' => '',
		'img_scr' => ''
	), $atts));

	return 
	'<div class="col-md-4 col-sm-4 col-xs-12">
		<img src="'.$img_scr.'" alt="image">
		<h3>'.$title.'</h3>
		'.$description.'
	</div>';
}

// Shortcode page shortcode
add_shortcode('is_shortcodes', 'dreamvilla_mp_add_is_shortcodes');
function dreamvilla_mp_add_is_shortcodes($atts, $content = null){
	return 
	'<section class="inner-page-shortcodes-section">
		<div class="container">
			<div class="row">
				<div id="inner-page-shortcodes-full-width" class="inner-page-shortcodes">
					'.do_shortcode($content).'
				</div>
			</div>
		</div>
	</section>';
}

// Shortcode page shortcode
add_shortcode('is_full_width', 'dreamvilla_mp_add_is_full_width');
function dreamvilla_mp_add_is_full_width($atts, $content = null){
	return '<div class="col-md-12 col-sm-12 col-xs-12">'.$content.'</div>';
}

add_shortcode('is_one_haif', 'dreamvilla_mp_add_is_one_haif');
function dreamvilla_mp_add_is_one_haif($atts, $content = null){
	return '<div class="col-md-6 col-sm-6 col-xs-12">'.$content.'</div>';
}

add_shortcode('is_one_third', 'dreamvilla_mp_add_is_one_third');
function dreamvilla_mp_add_is_one_third($atts, $content = null){
	return '<div class="col-md-4 col-sm-4 col-xs-12">'.$content.'</div>';
}

add_shortcode('is_one_fourth', 'dreamvilla_mp_add_is_one_fourth');
function dreamvilla_mp_add_is_one_fourth($atts, $content = null){
	return '<div class="col-md-3 col-sm-3 col-xs-12">'.$content.'</div>';
}

add_shortcode('is_three_fourth', 'dreamvilla_mp_add_is_three_fourth');
function dreamvilla_mp_add_is_three_fourth($atts, $content = null){
	return '<div class="col-md-9 col-sm-9 col-xs-12">'.$content.'</div>';
}

add_shortcode('is_title', 'dreamvilla_mp_add_title');
function dreamvilla_mp_add_title($atts, $content = null){
	return '<h2 class="header_with_icon">'.$content.'</h2>';
}

add_shortcode('is_description', 'dreamvilla_mp_add_is_description');
function dreamvilla_mp_add_is_description($atts, $content = null){
	return '<p class="header_description">'.$content.'</p>';
}

add_shortcode('success_message', 'dreamvilla_mp_add_success_message');
function dreamvilla_mp_add_success_message($atts, $content = null){
	
	extract(shortcode_atts(array(
		'icon' => 'glyphicon glyphicon-ok'		
	), $atts));

	return 
	'<div class="alert alert-success" role="alert">
		<i class="'.$icon.'"></i>
		'.$content.'
	</div>';
}

add_shortcode('info_message', 'dreamvilla_mp_add_info_message');
function dreamvilla_mp_add_info_message($atts, $content = null){
	
	extract(shortcode_atts(array(
		'icon' => 'fa fa-arrow-right'		
	), $atts));

	return 
	'<div class="alert alert-info" role="alert">
		<i class="'.$icon.'"></i>
		'.$content.'
	</div>';
}

add_shortcode('warning_message', 'dreamvilla_mp_add_warning_message');
function dreamvilla_mp_add_warning_message($atts, $content = null){
	
	extract(shortcode_atts(array(
		'icon' => 'fa fa-exclamation'		
	), $atts));

	return 
	'<div class="alert alert-warning" role="alert">
		<i class="'.$icon.'"></i>
		'.$content.'
	</div>';
}

add_shortcode('danger_message', 'dreamvilla_mp_add_danger_message');
function dreamvilla_mp_add_danger_message($atts, $content = null){
	
	extract(shortcode_atts(array(
		'icon' => 'glyphicon glyphicon-remove'		
	), $atts));

	return 
	'<div class="alert alert-danger" role="alert">
		<i class="'.$icon.'"></i>
		'.$content.'
	</div>';
}

add_shortcode('bullete_point_column', 'dreamvilla_mp_add_bullete_point_column');
function dreamvilla_mp_add_bullete_point_column($atts, $content = null){
	
	extract(shortcode_atts(array(
		'icon' => 'glyphicon glyphicon-remove'		
	), $atts));

	return 
	'<div class="col-md-4 col-sm-4 col-xs-12">
		'.do_shortcode($content).'
	</div>';
}

add_shortcode('bullete_point', 'dreamvilla_mp_add_bullete_point');
function dreamvilla_mp_add_bullete_point($atts, $content = null){
	
	extract(shortcode_atts(array(
		'icon' => 'map-marker-black'
	), $atts));

	return 
	'<p class="'.$icon.'">'.$content.'</p>';
}

add_shortcode('is_table', 'dreamvilla_mp_add_is_table');
function dreamvilla_mp_add_is_table($atts, $content = null){
	
	return
	'<div id="inner-page-shortcodes-table-data" class="inner-page-shortcodes">
		<div class="table-responsive">    
			<table class="table">
				'.do_shortcode($content).'
			</table>
		</div>
	</div>';	
}

add_shortcode('is_table_thead', 'dreamvilla_mp_add_is_table_thead');
function dreamvilla_mp_add_is_table_thead($atts, $content = null){	
	return '<thead><tr>'.do_shortcode($content).'</tr></thead>';	
}

add_shortcode('table_heading', 'dreamvilla_mp_add_table_heading');
function dreamvilla_mp_add_table_heading($atts, $content = null){	
	return '<th>'.do_shortcode($content).'</th>';	
}

add_shortcode('is_table_body', 'dreamvilla_mp_add_is_table_body');
function dreamvilla_mp_add_is_table_body($atts, $content = null){	
	return '<tbody>'.do_shortcode($content).'</tbody>';	
}

add_shortcode('table_row', 'dreamvilla_mp_add_table_column');
function dreamvilla_mp_add_table_column($atts, $content = null){	
	return '<tr>'.do_shortcode($content).'</tr>';
}

add_shortcode('table_cell', 'dreamvilla_mp_add_table_cell');
function dreamvilla_mp_add_table_cell($atts, $content = null){	
	return '<td>'.do_shortcode($content).'</td>';
}

// FQA page shortcode
add_shortcode('is_faq', 'dreamvilla_mp_add_is_faq');
function dreamvilla_mp_add_is_faq($atts, $content = null){	
	return do_shortcode($content);
}

add_shortcode('faq_title', 'dreamvilla_mp_add_faq_title');
function dreamvilla_mp_add_faq_title($atts, $content = null){	
	return '<h1>'.do_shortcode($content).'</h1>';
}

add_shortcode('faq', 'dreamvilla_mp_add_faq');
function dreamvilla_mp_add_faq($atts, $content = null){
	
	extract(shortcode_atts(array(
		'id' => '',
		'question' => '',
		'answer' => '',		
	), $atts));

	return 
	'<div class="inner-faq-area">
		<div class="inner-faq-panel-heading">
			<div class="inner-faq-panel-title">
				<img src="'.get_template_directory_uri().'/images/plus-mark.png" class="inner-faq-img-marker" alt="map-marker"/>
				<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#'.$id.'" aria-expanded="false">
					'.$question.'
				</a>
			</div>
		</div>
		<div id="'.$id.'" class="collapse" role="tabpanel" aria-labelledby="'.$id.'">
			<div class="inner-faq-panel-body">
				'.$answer.'
			</div>
		</div>
	</div>';
}

// Page shortcode
add_shortcode('is_page', 'dreamvilla_mp_add_is_page');
function dreamvilla_mp_add_is_page($atts, $content = null){
	return '<div id="inner-page-sidebar-content-area">'.do_shortcode($content).'</div>';
}

add_shortcode('banner_text', 'dreamvilla_mp_add_banner_text');
function dreamvilla_mp_add_banner_text($atts, $content = null){
	return '<div class="inner-page-banner-paragraph"><p>'.do_shortcode($content).'</p></div>';
}

add_shortcode('left_part', 'dreamvilla_mp_add_left_part');
function dreamvilla_mp_add_left_part($atts, $content = null){
	return '<div class="row"><div class="inner-page-side-part col-md-6 col-sm-6 col-xs-12">'.do_shortcode($content).'</div>';
}

add_shortcode('right_part', 'dreamvilla_mp_add_right_part');
function dreamvilla_mp_add_right_part($atts, $content = null){
	return '<div class="inner-page-side-part col-md-6 col-sm-6 col-xs-12">'.do_shortcode($content).'</div></div>';
}

add_shortcode('ul_part', 'dreamvilla_mp_add_ul_part');
function dreamvilla_mp_add_ul_part($atts, $content = null){
	
	return '<ul class="row single_page">'.do_shortcode($content).'</ul>';
}

add_shortcode('li_part', 'dreamvilla_mp_add_li_part');
function dreamvilla_mp_add_li_part($atts, $content = null){

	extract(shortcode_atts(array(
		'column' => '1',
	), $atts));

	if( $column == 1 ){
		return '<li class="col-sm-12">'.$content.'</li>';
	} else if( $column == 2 ){
		return '<li class="col-sm-6">'.$content.'</li>';
	}  else if( $column == 3 ){
		return '<li class="col-sm-4">'.$content.'</li>';
	}  else if( $column == 4 ){
		return '<li class="col-sm-3">'.$content.'</li>';
	}  else {
		return '<li class="col-sm-12">'.$content.'</li>';
	}
}

// Feature of page shortcode
add_shortcode('is_features_of_dreamvilla', 'dreamvilla_mp_add_is_features_of_dreamvilla');
function dreamvilla_mp_add_is_features_of_dreamvilla($atts, $content = null){
	if( is_page_template( 'page-templates/one-page-site.php' ) ) {
	  return do_shortcode($content);
	 }	
}

add_shortcode('dreamvilla_description', 'dreamvilla_mp_add_dreamvilla_description');
function dreamvilla_mp_add_dreamvilla_description($atts, $content = null){
	
	return '<p class="div_discription">'.do_shortcode($content).'</p>';
}

add_shortcode('is_area_size_area', 'dreamvilla_mp_add_is_area_size_area');
function dreamvilla_mp_add_is_area_size_area($atts, $content = null){
	
	return 
	'<div class="area_size_list">
   		<div class="row">
			'.do_shortcode($content).'
		</div>
	</div>';
}

add_shortcode('is_area_size', 'dreamvilla_mp_add_is_area_size');
function dreamvilla_mp_add_is_area_size($atts, $content = null){
	
	return 
	'<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		'.do_shortcode($content).'
	</div>';
}

add_shortcode('area_size', 'dreamvilla_mp_add_area_size');
function dreamvilla_mp_add_area_size($atts, $content = null){
	
	extract(shortcode_atts(array(
		'area_size' => '',
		'area_name' => ''		
	), $atts));

	return '<p>'.$area_size.':'.$area_name.'</p>';
}

add_shortcode('is_features_list', 'dreamvilla_mp_add_is_features_list');
function dreamvilla_mp_add_is_features_list($atts, $content = null){
	
	return 
	'<ul class="features_list row pull-left">
		'.do_shortcode($content).'
	</ul>';
}

add_shortcode('features_item', 'dreamvilla_mp_add_features_item');
function dreamvilla_mp_add_features_item($atts, $content = null){
	
	extract(shortcode_atts(array(
		'title' => '',
		'description' => '',
		'icon_src' => ''
	), $atts));

	return 
	'<li class="col-lg-6 padding_left_none">
		<div class="featureicon pull-left">
			<img src="'.$icon_src.'" alt="neighbourhood">
		</div>
		<div>
			<h2>'.$title.'</h2>
			<p>'.$description.'</p>
		</div>
	</li>';
}

add_shortcode('schedule_visit', 'dreamvilla_mp_add_schedule_visit');
function dreamvilla_mp_add_schedule_visit($atts, $content = null){
	
	extract(shortcode_atts(array(
		'label' => 'Schedule visit'
	), $atts));

	return 
	'<div class="buttons">
		<a class="schedule_visit_href_btn" href="javascript:void(0);" data-toggle="modal" data-target="#contact_our_agent">'.$label.'</a>
	</div>';
}

add_shortcode('contact_area', 'dreamvilla_mp_add_contact_area');
function dreamvilla_mp_add_contact_area($atts, $content = null){
	return '<div class="row" id="inner-contact-address">'.do_shortcode($content).'</div>';
}

add_shortcode('contact_address', 'dreamvilla_mp_add_contact_address');
function dreamvilla_mp_add_contact_address($atts, $content = null){
	return '<div class="col-md-6 col-sm-6 col-xs-12 inner-contact-border">'.do_shortcode($content).'</div>';	
}

add_shortcode('contact_number', 'dreamvilla_mp_add_contact_number');
function dreamvilla_mp_add_contact_number($atts, $content = null){
	return '<div class="col-md-6 col-sm-6 col-xs-12">'.do_shortcode($content).'</div>';	
}

add_shortcode('about_city_estate', 'dreamvilla_mp_add_about_city_estate');
function dreamvilla_mp_add_about_city_estate($atts, $content = null){
	return 
	'<div class="about-city-estate">
		<div class="container">
			<div class="row">
				'.do_shortcode($content).'				
			</div>
		</div>
	</div>';	
}

add_shortcode('about_city_estate_left_part', 'dreamvilla_mp_add_about_city_estate_left_part');
function dreamvilla_mp_add_about_city_estate_left_part($atts, $content = null){
	
	extract(shortcode_atts(array(
		'title' => '',		
	), $atts));

	return 
	'<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<h3 class="section-heading">'.$title.'</h3>
		'.do_shortcode($content).'
	</div>';
}

add_shortcode('about_city_estate_right_part', 'dreamvilla_mp_add_about_city_estate_right_part');
function dreamvilla_mp_add_about_city_estate_right_part($atts, $content = null){
	
	extract(shortcode_atts(array(
		'title' => '',
		'video_title' => 'Property Video',
		'video_src' => '',
		'video_image_src' => '',
	), $atts));

	return 
	'<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<h3 class="section-heading">'.$title.'</h3>
		<div class="round-members-logo">
			'.do_shortcode($content).'
		</div>
		<a href="#" data-toggle="modal" data-target="#property-video-model"><img src="'.$video_image_src.'" alt="about video" class="img-responsive"></a>
	</div>
	<div id="property-video-model" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						&times;
					</button>
					<h4 class="modal-title">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$video_title).'</h4>
				</div>
				<div class="modal-body">
					<video controls>
						<source src="'.$video_src.'" type="video/mp4">
						Your browser does not support HTML5 video.
					</video>
				</div>
			</div>
		</div>
	</div>';
}

add_shortcode('banner', 'dreamvilla_mp_add_banner');
function dreamvilla_mp_add_banner($atts, $content = null){
	return '<p class="banner">'.$content.'</p>';
}

add_shortcode('get_in_touch', 'dreamvilla_mp_add_get_in_touch');
function dreamvilla_mp_add_get_in_touch($atts, $content = null){
	extract(shortcode_atts(array(
		'title' => '',
		'description' => '',		
	), $atts));

	return 
	'<div class="row">
		<div class="col-md-7 col-sm-12 multiple-get-in-touch-description">
			<h3>'.$title.'</h3>
			<p>'.$description.'</p>
		</div>
		'.do_shortcode($content).'
	</div>';
}

add_shortcode('get_in_touch_contact_detail', 'dreamvilla_mp_add_get_in_touch_contact_detail');
function dreamvilla_mp_add_get_in_touch_contact_detail($atts, $content = null){
	extract(shortcode_atts(array(
		'call_title' => 'call us now',
		'call_number' => '',
		'get_in_touch_label' => 'GET IN TOUCH',
		'get_in_touch_url' => '',
	), $atts));

	return 
	'<div class="col-md-5 col-sm-12">
		<div class="row">
			<div class="col-md-6 col-sm-8 multiple-get-in-touch-contact">
				<div class="contact_detial">
					<div class="phone_icon">
						<i class="fa fa-phone"> </i>
					</div>
					<div class="phone_number">
						<h5>'.$call_title.'</h5>
						<h2 class="phone_number_h2">'.$call_number.'</h2>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-4 multiple-get-in-touch-button">
				<a href="'.$get_in_touch_url.'">'.$get_in_touch_label.'</a>
			</div>
		</div>
	</div>';
}

add_shortcode('people_to_say', 'dreamvilla_mp_add_people_to_say');
function dreamvilla_mp_add_people_to_say($atts, $content = null){
	extract(shortcode_atts(array(
		'name' => '',
		'position' => '',
		'what_you_say' => '',
		'image_src' => '',
	), $atts));

	return 
	'<div class="col-sm-6 col-md-4 col-lg-4">
		<div class="people-message">
			<div class="div-quote-img">
				<img src="'.esc_attr(get_template_directory_uri()).'/images/quote.png" alt="quote">
			</div>
			<p>'.$what_you_say.'</p>
		</div>
		<div>
			<img src="'.$image_src.'" alt="people-1">
			<span class="people-name">'.$name.'</span>
			<span class="people-position">'.$position.'</span>							
		</div>	
	</div>';
}
add_shortcode('location_details', 'dreamvilla_mp_add_location_details');
function dreamvilla_mp_add_location_details($atts, $content = null){
	extract(shortcode_atts(array(
		'latitude' => '',
		'longitude' => '',
	), $atts));

	$dreamvilla_options = get_option('dreamvilla_options'); 

	$html = 
	'<div class="multiple-location-map">
		<div id="googleMap" style="width:100%;height:100%;"></div>
	</div>
	<div class="row">'.do_shortcode($content).'</div>'; ?>

	<script type="text/javascript">
		jQuery(document).ready(function(){
			function initialize(){
				var myCenter = new google.maps.LatLng("<?php echo esc_js($latitude); ?>","<?php echo esc_js($longitude); ?>");
				var mapProp = {
								center:myCenter,
								zoom:11,
								mapTypeId:google.maps.MapTypeId.ROADMAP,
								scrollwheel: false,
								styles: <?php echo $dreamvilla_options["dreamvilla_map_style"]; ?>
							};

				var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
				var marker = new google.maps.Marker({position:myCenter,icon:'<?php echo esc_js( get_template_directory_uri()); ?>/images/map_marker.png'});
				marker.setMap(map);
			}
			if(document.getElementById('googleMap') != null ){
				//google.maps.event.addDomListener(window,'load',initialize);
			}
		});							
	</script><?php

	return $html;
}

add_shortcode('is_cms_page', 'dreamvilla_mp_add_is_cms_page');
function dreamvilla_mp_add_is_cms_page($atts, $content = null){
	return '<div class="container">'.do_shortcode($content).'</div>';
}

add_shortcode('is_dreamvilla_about', 'dreamvilla_mp_is_dreamvilla_about');
function dreamvilla_mp_is_dreamvilla_about($atts, $content = null){
	if( is_page_template( 'page-templates/home.php' ) ){
		return '<p class="description">'.do_shortcode($content).'</p>';
	} else if( is_page_template( 'page-templates/homepage-variation.php' ) ){
		return '<p>'.do_shortcode($content).'</p>';
	}
}

add_shortcode('is_dreamvilla_about_one_page', 'dreamvilla_mp_is_dreamvilla_about_one_page');
function dreamvilla_mp_is_dreamvilla_about_one_page($atts, $content = null){
	if( is_page_template( 'page-templates/one-page-site.php' ) ){
		return do_shortcode($content);
	}
}

add_shortcode('service_we_offer', 'dreamvilla_mp_is_service_we_offer');
function dreamvilla_mp_is_service_we_offer($atts, $content = null){
	extract(shortcode_atts(array(
		'name' => '',
		'detail' => '',
		'image_src' => '',
	), $atts));

	return 
	'<div class="col-sm-6 col-md-3 col-lg-3">
		<img src="'.$image_src.'" alt="Services">
		<h4>'.$name.'</h4>
		<p>'.$detail.'</p>
		</div>
		<div>
	</div>';
}

// Contact Us page shortcode
add_shortcode('is_contact_us', 'dreamvilla_mp_add_is_contact_us');
function dreamvilla_mp_add_is_contact_us($atts, $content = null){
	if( is_page_template( 'page-templates/one-page-site.php' ) ){
	  	return '<p class="contact_discription">'.$content.'</p>';
	}
}

add_shortcode('contact_us', 'dreamvilla_mp_add_contact_us');
function dreamvilla_mp_add_contact_us($atts, $content = null){
	if( is_page_template( 'page-templates/contact-us.php' ) ){
	  	return '<p class="description">'.do_shortcode($content).'</p>';
	}
}

add_shortcode('contact_us_address_area', 'dreamvilla_mp_add_contact_us_address_area');
function dreamvilla_mp_add_contact_us_address_area($atts, $content = null){
	
	return '<div class="row" id="inner-contact-address">'.do_shortcode($content).'</div>';
}

add_shortcode('contact_us_address_detail', 'dreamvilla_mp_add_contact_us_address_detail');
function dreamvilla_mp_add_contact_us_address_detail($atts, $content = null){
	
	extract(shortcode_atts(array(
		'title' => '',
	), $atts));

	return 
	'<div class="col-md-6 col-sm-6 col-xs-12">
		<h2>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$title).'</h2>
		<div class="row">
			'.do_shortcode($content).'
		</div>
	</div>';
}

add_shortcode('contact_us_address', 'dreamvilla_mp_add_contact_us_address');
function dreamvilla_mp_add_contact_us_address($atts, $content = null){
	
	return 
	'<div class="col-md-6 col-sm-6 col-xs-12 inner-contact-border">
	   '.$content.'
	</div>';
}

add_shortcode('contact_detail', 'dreamvilla_mp_add_contact_detail');
function dreamvilla_mp_add_contact_detail($atts, $content = null){
	
	return 
	'<div class="col-md-6 col-sm-6 col-xs-12">
		'.$content.'
	</div>';
}

add_shortcode('fresh_approch', 'dreamvilla_mp_add_fresh_approch');
function dreamvilla_mp_add_fresh_approch($atts, $content = null){	
	return do_shortcode($content);
}

add_shortcode('fresh_approch_left', 'dreamvilla_mp_add_fresh_approch_left');
function dreamvilla_mp_add_fresh_approch_left($atts, $content = null){	
	return '<div class="col-xs-6 col-sm-6 col-md-6">'.$content.'</div>';
}

add_shortcode('fresh_approch_right', 'dreamvilla_mp_add_fresh_approch_right');
function dreamvilla_mp_add_fresh_approch_right($atts, $content = null){	
	return '<div class="col-xs-6 col-sm-6 col-md-6 first-time-buyer">'.$content.'</div>';
}	


add_shortcode('agent_contact', 'dreamvilla_mp_add_agent_contact');
function dreamvilla_mp_add_agent_contact($atts, $content = null){
	
	extract(shortcode_atts(array(
		'title' => '',
	), $atts));

	if( is_page_template( 'page-templates/contact-us.php' ) ){

		$dreamvilla_options = get_option('dreamvilla_options');

		if( !empty($dreamvilla_options['submitnowbuttontitle']) ){
			$submit_label = $dreamvilla_options['submitnowbuttontitle'];
		} else {
			$submit_label = 'SUBMIT NOW';	
		}		
		
		if( !empty($dreamvilla_options['office_email'] ) ){
			$office_email = $dreamvilla_options['office_email'];
		}
		
		if( !empty($dreamvilla_options['show_google_recaptcha'] ) ){
			$show_google_recaptcha = $dreamvilla_options['show_google_recaptcha'];
		}
		if( !empty($dreamvilla_options['google_recaptcha_site_key'] ) ){
			$google_recaptcha_site_key = $dreamvilla_options['google_recaptcha_site_key'];
		}

		if( !empty($google_recaptcha_site_key) && $show_google_recaptcha == "yes" ){
			$google_recaptcha = '<div id="single-property"></div>';
			$textarea_style = '';
		} else {
			$google_recaptcha = '';
			$textarea_style = 'style=height:195px;';
		}

		$agent_contact_form =
		'<div class="inner-page-shortcodes" id="agent-contact-area" style="margin:0;"><div class="special-contact-form-div"><div class="message_area_bottom"></div></div></div>
		<form class="plugin-agnet-contact-form-contact-page" name="send-agent-mail" method="post">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="text" name="full_name" class="full_name" placeholder="'.esc_html__('Full Name','dreamvilla-multiple-property').'" required>
					<input type="text" name="p_number" class="p_number" placeholder="'.esc_html__('Phone Number','dreamvilla-multiple-property').'" required>
					<input type="email" name="email_address" class="email_address" placeholder="'.esc_html__('Email Address','dreamvilla-multiple-property').'" required>
					<input type="hidden" name="agent_email_address" class="agent_email_address" value="'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$office_email).'" >
					'.$google_recaptcha.'
					<input type="submit" name="sendmessage" class="send-message" value="'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$submit_label ).'" />
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<textarea name="message" class="message" '.$textarea_style.' placeholder="'.esc_html__('Message','dreamvilla-multiple-property').'" required></textarea>					
				</div>
			</div>
		</form>';
		if( $agent_contact_form){
			return 
			'<div class="inner-contact-agent-area">				
				<h2>'.$title.'</h2>
				'.$agent_contact_form.'		
			</div>';
		} else {
			return '';
		}
	}		
}

add_shortcode('contact_property_map', 'dreamvilla_mp_add_contact_property_map');
function dreamvilla_mp_add_contact_property_map($atts, $content = null){

	extract(shortcode_atts(array(
		'latitude' => '',
		'longitude' => ''
	), $atts));

	$dreamvilla_options = get_option('dreamvilla_options'); 

	$property_lat_lon = array( $latitude, $longitude ); ?>

	<script type="text/javascript">
		jQuery(document).ready(function(){
			function initialize(){
				var myCenter=new google.maps.LatLng("<?php echo esc_js($property_lat_lon[0]); ?>","<?php echo esc_js($property_lat_lon[1]); ?>");
				var mapProp={
								center:myCenter,
								zoom:11,
								mapTypeId:google.maps.MapTypeId.ROADMAP,
								scrollwheel: false,
								styles: <?php echo $dreamvilla_options["dreamvilla_map_style"]; ?>
							};

				var map=new google.maps.Map(document.getElementById("googleMapContact"),mapProp);
				var marker=new google.maps.Marker({position:myCenter,icon:'<?php echo esc_js( get_template_directory_uri()); ?>/images/map_marker.png'});
				marker.setMap(map);
			}

			google.maps.event.addDomListener(window,'load',initialize);
		});							
	</script><?php
	
	return
	'<div class="inner-contact-location-map">
		<div id="googleMapContact" style="width:100%;height:100%;"></div>
	</div>';
}






add_shortcode('about_city_estate_variation', 'dreamvilla_mp_about_city_estate_variation');
function dreamvilla_mp_about_city_estate_variation($atts, $content = null){
	return 
	'<div class="about-city-estate">
		<div class="container">
			<div class="row">
				'.do_shortcode($content).'				
			</div>
		</div>
	</div>';	
}

add_shortcode('about_city_estate_left_part_variation', 'dreamvilla_mp_add_about_city_estate_left_part_variation');
function dreamvilla_mp_add_about_city_estate_left_part_variation($atts, $content = null){
	
	extract(shortcode_atts(array(
		'title' => '',		
	), $atts));

	return 
	'
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<h3 class="section-heading">'.$title.'</h3>
		'.do_shortcode($content).'
	</div>';
}

add_shortcode('about_city_estate_right_part_variation', 'dreamvilla_mp_add_about_city_estate_right_part_variation');
function dreamvilla_mp_add_about_city_estate_right_part_variation($atts, $content = null){
	
	extract(shortcode_atts(array(
		'title' => '',
		'video_title' => 'Property Video',
		'video_src' => '',
		'video_image_src' => '',
	), $atts));

	return
	'<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<h3 class="section-heading">'.$title.'</h3>
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-4 padding_right_none">
				<a href="#" data-toggle="modal" data-target="#property-video-model"><img src="'.$video_image_src.'" alt="about video" class="img-responsive"></a>
			</div>
			<div class="col-xs-12 col-sm-8 col-md-8">
				'.do_shortcode($content).'
			</div>
		</div>
	</div>
	<div id="property-video-model" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						&times;
					</button>
					<h4 class="modal-title">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$video_title).'</h4>
				</div>
				<div class="modal-body">
					<video controls>
						<source src="'.$video_src.'" type="video/mp4">
						Your browser does not support HTML5 video.
					</video>
				</div>
			</div>
		</div>
	</div>';
}
?>