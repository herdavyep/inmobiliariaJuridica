<?php
function dreamvilla_mp_get_category($term_id,$taxonomy_type,$current_selected){
	$loterms = get_terms($taxonomy_type, array("orderby" => "slug", "parent" => $term_id, 'hide_empty' => 0, ) );
	if($loterms) {
		foreach($loterms as $key => $loterm) : ?>
			<option value="<?php echo esc_attr($loterm->term_id); ?>" <?php if( $current_selected == $loterm->term_id ){ echo "selected=selected"; } ?> ><?php echo esc_html($loterm->name); ?></option><?php
			dreamvilla_mp_get_category($loterm->term_id,$taxonomy_type,$current_selected);
		endforeach;
	}
}

function dreamvilla_mp_get_category_shortcode($term_id,$taxonomy_type,$current_selected){
	$out = '';
	$loterms = get_terms($taxonomy_type, array("orderby" => "slug", "parent" => $term_id, 'hide_empty' => 0, ) );
	if($loterms) {
		foreach($loterms as $key => $loterm) :
			
			$selected = "";
			if( $current_selected == $loterm->term_id )
				$selected .= "selected=selected";

			$out .= '<option value="'.esc_attr($loterm->term_id).'" '.$selected.' >'.esc_html($loterm->name).'</option>';
			dreamvilla_mp_get_category_shortcode($loterm->term_id,$taxonomy_type,$current_selected);

		endforeach;
	}

	return $out;
}

// Load media files needed for Uploader
function dreamvilla_mp_load_wp_media_files() {
  wp_enqueue_media();
}

// Remove auto formating tag in shortcode
function dreamvilla_mp_cleanup_shortcode_fix($content) {
    $array = array('<p>[' => '[', ']</p>' => ']', ']<br />' => ']', ']<br>' => ']');
    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'dreamvilla_mp_cleanup_shortcode_fix');
add_filter('the_content', 'dreamvilla_mp_cleanup_shortcode_fix', 1);

// Property update edit form
function dreamvilla_mp_update_edit_form() {
    echo 'enctype="multipart/form-data"';
}
add_action('post_edit_form_tag', 'dreamvilla_mp_update_edit_form');

// Return price type type of property
function dreamvilla_mp_get_room_type(){
	return array( "MasterBedroom" => "Habitación principal", "Bedroom" => "Habitación", "LivingRoom" => "Sala de estar", "DiningRoom" => "Comedor" );
}

// Return google near by place
function dreamvilla_mp_google_places(){
	return array( "accounting" => "accounting", "airport" => "airport", "amusement_park" => "amusement_park", "aquarium" => "aquarium", "art_gallery" => "art_gallery", "atm" => "atm", "bakery" => "bakery", "bank" => "bank", "bar" => "bar", "beauty_salon" => "beauty_salon", "bicycle_store" => "bicycle_store", "book_store" => "book_store", "bowling_alley" => "bowling_alley", "bus_station" => "bus_station", "cafe" => "cafe", "campground" => "campground", "car_dealer" => "car_dealer", "car_rental" => "car_rental", "car_repair" => "car_repair", "car_wash" => "car_wash", "casino" => "casino", "cemetery" => "cemetery", "church" => "church", "city_hall" => "city_hall", "clothing_store" => "clothing_store", "convenience_store" => "convenience_store", "courthouse" => "courthouse", "dentist" => "dentist", "department_store" => "department_store", "doctor" => "doctor", "electrician" => "electrician", "electronics_store" => "electronics_store", "embassy" => "embassy", "establishment" => "establishment", "finance" => "finance", "fire_station" => "fire_station", "florist" => "florist", "food" => "food", "funeral_home" => "funeral_home", "furniture_store" => "furniture_store", "gas_station" => "gas_station", "general_contractor" => "general_contractor", "grocery_or_supermarket" => "grocery_or_supermarket", "gym" => "gym", "hair_care" => "hair_care", "hardware_store" => "hardware_store", "health" => "health", "hindu_temple" => "hindu_temple", "home_goods_store" => "home_goods_store", "hospital" => "hospital", "insurance_agency" => "insurance_agency", "jewelry_store" => "jewelry_store", "laundry" => "laundry", "lawyer" => "lawyer", "library" => "library", "liquor_store" => "liquor_store", "local_government_office" => "local_government_office", "locksmith" => "locksmith", "lodging" => "lodging", "meal_delivery" => "meal_delivery", "meal_takeaway" => "meal_takeaway", "mosque" => "mosque", "movie_rental" => "movie_rental", "movie_theater" => "movie_theater", "moving_company" => "moving_company", "museum" => "museum", "night_club" => "night_club", "painter" => "painter", "park" => "park", "parking" => "parking", "pet_store" => "pet_store", "pharmacy" => "pharmacy", "physiotherapist" => "physiotherapist", "place_of_worship" => "place_of_worship", "plumber" => "plumber", "police" => "police", "post_office" => "post_office", "real_estate_agency" => "real_estate_agency", "restaurant" => "restaurant", "roofing_contractor" => "roofing_contractor", "rv_park" => "rv_park", "school" => "school", "shoe_store" => "shoe_store", "shopping_mall" => "shopping_mall", "spa" => "spa", "stadium" => "stadium", "storage" => "storage", "store" => "store", "subway_station" => "subway_station", "synagogue" => "synagogue", "taxi_stand" => "taxi_stand", "train_station" => "train_station", "travel_agency" => "travel_agency", "university" => "university", "veterinary_care" => "veterinary_care", "zoo" => "zoo" );
}

// Return price type type of property
function dreamvilla_mp_get_bedroom_type(){
	return array( "MasterBedroom", "Bedroom" );
}

function dreamvilla_mp_FindKeyInArray($SearchValue,$Array) {
    if( $Array ){
	    foreach ($Array as $key => $value){
	        if ($value['proomtype'] == $SearchValue){
	            return $value['proomsize'];
	        }        
	    }
	}
    return false;
}

// Count Bedroom
function dreamvilla_mp_number_of_bedroom($post_id){
	//$get_property = wp_get_recent_posts( array( "post_type" => "property" ) );
	$RoomDetails = get_post_meta( $post_id, 'propertyroom', true );
	if( $RoomDetails ){
		$Count_Bedroom = 0;
		if( $RoomDetails ){
			foreach ($RoomDetails as $key => $value) {
				if( in_array( $RoomDetails[$key]['proomtype'], dreamvilla_mp_get_bedroom_type() )  ){
					$Count_Bedroom++;
				}
			}
		}
		return $Count_Bedroom;
	} else {
		return "-";	
	}
}

// Count Bathroom
function dreamvilla_mp_number_of_bathroom($post_id){
	//$get_property = wp_get_recent_posts( array( "post_type" => "property" ) );
	$BathroomDetails = get_post_meta( $post_id, 'propertybathroom', true );
	if( $BathroomDetails ){
		return count( $BathroomDetails );			
	} else {
		return "-";
	}
}

// Return page of theme
function dreamvilla_mp_get_theme_page(){
	$get_pages = get_posts( array( "post_type" => "page", "posts_per_page" => -1, "order" => "asc", "orderby" => "title", 'suppress_filters' => 0 ) );
	$collect_page = array();
	if( $get_pages ){
		foreach ($get_pages as $key => $value) {
			$collect_page[$value->ID] = $value->post_title; 
		}
	}
	return $collect_page;
}

function dreamvilla_mp_right_widgets_init() {

	register_sidebar( array(
		'name'          => 'Right sidebar',
		'class'         => 'nav-list',
		'id'            => 'right_sidebar',
		'before_widget' => '<div class="blog_info blog-thumbnail">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="blogimagedescription"><h3>',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => 'Left sidebar',
		'class'         => 'nav-list',
		'id'            => 'left_sidebar',
		'before_widget' => '<div class="blog_info blog-thumbnail">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="blogimagedescription"><h3>',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar(array(
        'name'          => 'Property List Sidebar',
		'class'         => 'nav-list',
		'id'            => 'property_list_sidebar',
		'before_widget' => '<div class="blog_info blog-thumbnail">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="blogimagedescription"><h3>',
		'after_title'   => '</h3></div>',   
    ));

	register_sidebar(array(
        'name'          => 'dsIDXpress Sidebar',
		'class'         => 'nav-list',
		'id'            => 'dsidxpress_sidebar',
		'before_widget' => '<div class="blog_info blog-thumbnail">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="blogimagedescription"><h3>',
		'after_title'   => '</h3></div>',    
    ));

    register_sidebar(array(
    	'name'			=> 'Property Detail Sidebar',
    	'class'			=> 'nav-list',
    	'id'            => 'property_detail_sidebar',
		'before_widget' => '<div class="blog_info blog-thumbnail">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="blogimagedescription"><h3>',
		'after_title'   => '</h3></div>',   
    ));
	
}
add_action( 'widgets_init', 'dreamvilla_mp_right_widgets_init' );

function dreamvilla_mp_popular_register_widgets() {
	register_widget( 'Dreamvilla_MP_PopularPostWidget' );
}
add_action( 'widgets_init', 'dreamvilla_mp_popular_register_widgets' );

// Register most popular widget
class Dreamvilla_MP_PopularPostWidget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'populat_post_widget', // Base ID
			esc_html__( 'Popular Post','dreamvilla-multiple-property'), // Name
			array( 'description' => esc_html__( 'Show most popular post','dreamvilla-multiple-property'), )
		);
	}

	function widget( $args, $instance ) {
		printf( esc_html__('%s','dreamvilla-multiple-property'),$args['before_widget']);
		if ( ! empty( $instance['title'] ) ) {
			printf( esc_html__('%s','dreamvilla-multiple-property'),$args['before_title']);
			echo apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		} ?>
		<ul class="archieves"><?php
			if ( ! empty( $instance['post_per_widget'] ) )
				$post_per_widget = $instance['post_per_widget'];
			else 
				$post_per_widget = 3;			

		   	$popularpost = new WP_Query( array( 'posts_per_page' => $post_per_widget, 'meta_key' => 'most_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC', 'ignore_sticky_posts' => 1 ) );
		   	if( $popularpost->found_posts == 0 ){
				$popularpost = new WP_Query ( array( 'posts_per_page' => $post_per_widget, 'post_type' => 'post', 'ignore_sticky_posts' => 1 ) );
		   	}
			while ( $popularpost->have_posts() ) : $popularpost->the_post(); ?>
			<li>
				<?php if(has_post_thumbnail( $popularpost->post->ID )){ ?>
					<div class="col-md-4 padding_none">
						<div class="blogimage_thumbnail">
							<?php if(is_sticky($popularpost->post->ID)){ ?>
								<div class="sticky-image-thumbnail"></div>
							<?php } ?>						
							<?php $img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $popularpost->post->ID )); ?>
							<img src="<?php echo esc_url($img_src[0]); ?>" class="img-responsive" alt="Post Feature Image">
						</div>
					</div>
				<?php } ?>
				<div class="col-md-8">
					<div class="blogimagedescription">
						<h3 class="recentposttitle"><a class="inner-page-blog-sidebar-post-title" href="<?php echo esc_url(get_permalink($popularpost->post->ID)); ?>"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_the_title( $popularpost->post->ID )); ?></a></h3>
						<p class="detail">
							<span><?php 
								$archive_year  = get_the_time('Y',$popularpost->post->ID); 
								$archive_month = get_the_time('m',$popularpost->post->ID); 
								$archive_day   = get_the_time('d',$popularpost->post->ID); ?>
								<a href="<?php echo esc_url(get_day_link( $archive_year, $archive_month, $archive_day)); ?>">
									<?php $post_date = strtotime( $popularpost->post->post_date ); echo date_i18n( "F d,Y", $post_date ); ?>
								</a>
							</span>
							<span>
								<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>"><?php 
									$fname = get_the_author_meta( 'first_name', $popularpost->post->post_author);
									$lname = get_the_author_meta( 'last_name', $popularpost->post->post_author);
									printf( esc_html__('%s','dreamvilla-multiple-property'),$fname)." ".printf( esc_html__('%s','dreamvilla-multiple-property'),$lname); ?>
								</a>
							</span>
						</p>
					</div>
				</div>
			</li><?php
			endwhile;
			wp_reset_query(); ?>					
		</ul>
		<?php printf( esc_html__('%s','dreamvilla-multiple-property'),$args['after_widget']);
	}

	function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title','dreamvilla-multiple-property');
		$post_per_widget = ! empty( $instance['post_per_widget'] ) ? $instance['post_per_widget'] : esc_html__( 'Number of posts to show','dreamvilla-multiple-property'); ?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html_e('Title:',"dreamvilla-multiple-property"); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'post_per_widget' )); ?>"><?php echo esc_html_e('Number of posts to show:',"dreamvilla-multiple-property"); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'post_per_widget' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'post_per_widget' )); ?>" type="number" value="<?php echo esc_attr( $post_per_widget ); ?>" placeholder="3">
		</p><?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['post_per_widget'] = ( ! empty( $new_instance['post_per_widget'] ) ) ? strip_tags( $new_instance['post_per_widget'] ) : '';
		return $instance;
	}
}

function dreamvilla_mp_property_filter_register_widgets() {
	register_widget( 'Dreamvilla_MP_PropertyFilter' );
}
add_action( 'widgets_init', 'dreamvilla_mp_property_filter_register_widgets' );

class Dreamvilla_MP_PropertyFilter extends WP_Widget {
	// widget constructor
	function __construct() {
		parent::__construct(
			'property_filter_widget', // Base ID
			esc_html__( 'Property Filter','dreamvilla-multiple-property'), // Name
			array( 'description' => esc_html__( 'Show filter widget','dreamvilla-multiple-property'), )
		);
	}
	function widget( $args, $instance ) { ?>
		<div class="fliter-widget">
			<div class="filter-header">
				<?php 
					if ( ! empty( $instance['title'] ) ) {
					?> <h3> <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$args['before_title']);
					echo apply_filters( 'widget_title', $instance['title'] ). $args['after_title']; ?> </h3> 
				<?php
					}
				?>
			</div>
			<div class="filter-widget-body">
				<?php $dreamvilla_options = get_option('dreamvilla_options'); ?>
				<form name="property-filter" method="post" class="search-filter-form" action="<?php echo esc_url(get_permalink( $dreamvilla_options['Theme_Page_Property_Listing_Search'] )); ?>" >
					<div class="search-filter-form">
						<div class="row"><?php
						$layout = $dreamvilla_options['widget_filter_manager']['enabled'];
							if ($layout):
	                            foreach ($layout as $key=>$value) {     
	                                switch($key) {
	                                    case 'keyword': ?>
	                                        <div class="col-xs-12 col-sm-12 col-md-12">
												<input type="text" name="keyword" id="keyword" placeholder="<?php esc_html_e("Keyword","dreamvilla-multiple-property"); ?>">
											</div><?php											
	                                    break;

	                                    case 'category': ?>
	                                        <div class="col-xs-12 col-sm-12 col-md-12">
												<select name="type" class="selectpicker" data-width="100%">
													<option value=""><?php esc_html_e('All Type','dreamvilla-multiple-property'); ?></option>
													<?php $property_categories = get_terms("property_category", array("orderby" => "slug", "parent" => 0, 'hide_empty' => 0) );
													if ( ! empty( $property_categories ) && ! is_wp_error( $property_categories ) ){
														foreach ( $property_categories as $term ) { ?>
															<option value="<?php echo esc_attr($term->term_id); ?>" ><?php echo esc_html($term->name); ?></option><?php
															dreamvilla_mp_get_category($term->term_id,'property_category','');
														}									
													} ?>
												</select>
											</div><?php											
	                                    break;

	                                    case 'status': ?>
	                                        <div class="col-xs-12 col-sm-12 col-md-12">
											    <select name="status" class="selectpicker" data-width="100%">
													<option value="" selected><?php esc_html_e('All Status','dreamvilla-multiple-property'); ?></option>
													<option value="sale" ><?php esc_html_e('Venta','dreamvilla-multiple-property'); ?></option>
													<option value="rent" ><?php esc_html_e('Alquiler','dreamvilla-multiple-property'); ?></option>
												</select>
											</div><?php											
	                                    break;

	                                    case 'location': ?>
	                                        <div class="col-xs-12 col-sm-12 col-md-12">
												<select name="location" class="selectpicker" data-width="100%">
													<option value=""><?php esc_html_e('All Location','dreamvilla-multiple-property'); ?></option>
													<?php $property_categories = get_terms("location", array("orderby" => "slug", "parent" => 0, 'hide_empty' => 0) );
													if ( ! empty( $property_categories ) && ! is_wp_error( $property_categories ) ){
														foreach ( $property_categories as $term ) { ?>
															<option value="<?php echo esc_attr($term->term_id); ?>" ><?php echo esc_html($term->name); ?></option><?php
															dreamvilla_mp_get_category($term->term_id,'location','');
														}									
													} ?>
												</select>
											</div><?php											
	                                    break;

	                                    case 'bedrooms': ?>
	                                        <div class="col-xs-12 col-sm-12 col-md-12">
												<select name="bedroom" class="selectpicker" data-width="100%">
													<option value=""><?php esc_html_e('All Bedrooms','dreamvilla-multiple-property'); ?></option>
													<?php for ($i=1; $i <=10; $i++) { ?>
														<option value="<?php echo esc_attr($i); ?>" ><?php echo esc_html($i); ?></option>
													<?php } ?>
												</select>
											</div><?php											
	                                    break;

	                                    case 'bathrooms': ?>
	                                        <div class="col-xs-12 col-sm-12 col-md-12">
												<select name="bathroom" class="selectpicker" data-width="100%">
													<option value=""><?php esc_html_e('All Bathrooms','dreamvilla-multiple-property'); ?></option>
													<?php for ($i=1; $i <=10; $i++) { ?>
														<option value="<?php echo esc_attr($i); ?>" ><?php echo esc_html($i); ?></option>
													<?php } ?>
												</select>
											</div><?php											
	                                    break;

	                                    case 'garages': ?>
	                                        <div class="col-xs-12 col-sm-12 col-md-12">
												<select name="garage" class="selectpicker" data-width="100%">
													<option value=""><?php esc_html_e('All Garages','dreamvilla-multiple-property'); ?></option>
													<?php for ($i=1; $i <=10; $i++) { ?>
														<option value="<?php echo esc_attr($i); ?>" ><?php echo esc_html($i); ?></option>
													<?php } ?>
												</select>
											</div><?php											
	                                    break;

	                                    case 'price': ?>
	                                        <div class="col-xs-12 col-sm-12 col-md-12">
												<div id="property-price-range"></div>
												<input type="text" id="amount" name="price" readonly style="border:0; color:#f6931f; font-weight:bold;">
												<input type="hidden" id="sprice" name="sprice" value="<?php if( isset($_GET["sprice"]) ){ echo $_GET["sprice"]; } ?>">
												<input type="hidden" id="eprice" name="eprice" value="<?php if( isset($_GET["eprice"]) ){ echo $_GET["eprice"]; } ?>">
											</div><?php											
	                                    break;                                        
	                                }
	                            }
	                        endif; ?>
	                    </div>
						<div class="row">										
							<div class="col-xs-6 col-sm-12 col-md-12 pull-right">						
								<button class="submit-filter"><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options["dreamvilla_search_button_title"]); ?></button>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12" id="more-filter-options">
								<div class="row">
									<?php $property_features = get_terms("features", array("orderby" => "name", "parent" => 0, 'hide_empty' => 0) );
									if ( ! empty( $property_features ) && ! is_wp_error( $property_features ) ){
										foreach ( $property_features as $term ) { ?>
											<div class="col-xs-12 col-sm-4 col-md-3 option">
												<input id="<?php echo esc_attr($term->slug); ?>" type="checkbox" name="features[]" value="<?php echo esc_attr($term->term_id); ?>" >
												<label for="<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name . '(' . $term->count . ')'); ?></label>
											</div><?php
										}									
									} ?>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<?php
		//printf( esc_html__('%s','dreamvilla-multiple-property'),$args['after_widget']);
	}
	function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title','dreamvilla-multiple-property');
		$post_per_widget = ! empty( $instance['post_per_widget'] ) ? $instance['post_per_widget'] : esc_html__( 'Number of posts to show','dreamvilla-multiple-property'); ?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html_e('Title:',"dreamvilla-multiple-property"); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p><?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
}

function dreamvilla_mp_featured_property_register_widgets() {
	register_widget( 'Dreamvilla_MP_FeaturedProperty' );
}
add_action( 'widgets_init', 'dreamvilla_mp_featured_property_register_widgets' );

class Dreamvilla_MP_FeaturedProperty extends WP_Widget {
	// widget constructor
	function __construct() {
		parent::__construct(
			'featured_property_widget', // Base ID
			esc_html__( 'Featured Proeprty','dreamvilla-multiple-property'), // Name
			array( 'description' => esc_html__( 'Show featured property','dreamvilla-multiple-property'), )
		);
	}
	function widget( $args, $instance ) { ?>
		<div class="recent-proeprties-sidebar widget-area multiple-featured-properties"><?php 
			if ( ! empty( $instance['title'] ) ) { ?> 
				<h4 class="similar-properties"> <?php echo apply_filters( 'widget_title', $instance['title'] ); ?> </h4><?php
			}

			$args = array(
						'post_type'			=> 'property',
						'posts_per_page' 	=> -1,
						'meta_query'		=> array(
														array(
															'key' 	=>  'pfetured',
															'value'	=> 'yes',
														)
												),
						'suppress_filters' 	=> 0
					);
				$fetured_property_list=get_posts($args);
				if ( $fetured_property_list ) {
					$i=0;
					
				?>
			<div id="featured_carousel" class="carousel" data-ride="carousel" data-interval="false">
				<div class="carousel-inner" role="listbox"><?php
					foreach ( $fetured_property_list as $post ) { ?>
					<div class="item <?php if($i==0){echo "active"; $i=1; } ?>">
						<div class="row">
							<div class="col-sm-12 col-md-12 col-lg-12">
								<div class="image-with-label">
									<a href="<?php echo esc_url(get_permalink ($post->ID)); ?>"><img <?php echo dreamvilla_mp_get_device_image( $post->ID ); ?> alt="featured-properties-1" class="img-responsive"></a>
									<label>
										<?php 
										$property_status = get_post_meta( $post->ID, 'pstatus', true );
										if ( $property_status == "sale" ){
											printf( esc_html__('Venta','dreamvilla-multiple-property'));
										} else {
											printf( esc_html__('Alquiler','dreamvilla-multiple-property'));
										} ?>
									</label>
								</div>
								<div class="featured-properties-detail">
									<a href="<?php echo esc_url(get_permalink ($post->ID)); ?>"><h6><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$post->post_title); ?></h6></a>
									<p class="featured-properties-price">
										<?php
										$property_price = get_post_meta( $post->ID, 'pprice', true );
										if( $property_price[0] ){
											if( $property_status == "sale" ){
												printf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);															
											} else {
												printf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);															
												echo '<span class="price-label">';
													printf( esc_html__(' / %s','dreamvilla-multiple-property'),strtoupper($property_price[1]));
												echo '</span>';
											}
										} ?>
									</p>
									<?php if( dreamvilla_mp_number_of_bathroom($post->ID) != "-" ){ ?>
									<ul>
										<li class="left">
											<img src="<?php echo get_template_directory_uri(); ?>/images/recent_bath.png" alt="Recent Bath" />
											<?php esc_html_e('Bathrooms','dreamvilla-multiple-property'); ?>
										</li>
										<li class="right"><span><?php printf( esc_html__('%s','dreamvilla-multiple-property'),dreamvilla_mp_number_of_bathroom($post->ID)); ?></span></li>
									</ul><?php 
									}
									if( dreamvilla_mp_number_of_bedroom($post->ID) != "-" ){ ?>
									<ul>
										<li class="left">
											<img src="<?php echo get_template_directory_uri(); ?>/images/recent_bed.png" alt="Recent Bed" />
											<?php printf( esc_html_e('Beds','dreamvilla-multiple-property')); ?>
										</li>
										<li class="right"><span><?php printf( esc_html__('%s','dreamvilla-multiple-property'),dreamvilla_mp_number_of_bedroom($post->ID)); ?></span></li>
									</ul><?php 
									}
									if( get_post_meta( $post->ID, 'pnoofgarage', true) ){ ?>
									<ul>
										<li class="left">
											<img src="<?php echo get_template_directory_uri(); ?>/images/recent_garage.png" alt="Recent Garage" />
											<?php printf( esc_html_e('Garages','dreamvilla-multiple-property')); ?>
										</li>
										<li class="right"><span><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $post->ID, 'pnoofgarage', true)); ?></span></li>
									</ul><?php
									} ?>
								</div>
								<div class="featured-properties-address-div">
									<?php if( get_post_meta( $post->ID, 'pcountry', true ) || get_post_meta( $post->ID, 'pstate', true ) ){ ?>
									<p class="featured-properties-address"><i class="fa fa-map-marker fa-lg"> </i><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $post->ID, 'pcountry', true )); if( get_post_meta( $post->ID, 'pcountry', true ) && get_post_meta( $post->ID, 'pstate', true ) ){ echo " / "; } printf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $post->ID, 'pstate', true )); ?></p>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
				</div>
				<div class="left-right-arrow">
					<a class="left carousel-control" href="#myCarousel0" role="button" data-slide="prev">
				    	<img src="<?php echo get_template_directory_uri(); ?>/images/left-arrow.png" alt="arrow left" class="pull-left">
				  	</a>
				  	<a class="right carousel-control" href="#myCarousel0" role="button" data-slide="next">
				    	<img src="<?php echo get_template_directory_uri(); ?>/images/right-arrow.png" alt="arrow right" class="pull-right">
				 	</a>
				</div>
			</div>
			<?php } ?>
		</div>

	<?php }
	function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title','dreamvilla-multiple-property');
		$post_per_widget = ! empty( $instance['post_per_widget'] ) ? $instance['post_per_widget'] : esc_html__( 'Number of posts to show','dreamvilla-multiple-property'); ?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html_e('Title:',"dreamvilla-multiple-property"); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p><?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}	
}

function dreamvilla_mp_most_post_views_count($postID) {
    $count_key = 'most_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if( $count=='' ){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        $count = sanitize_text_field($count);
        update_post_meta($postID, $count_key, $count);
    }
}

function dreamvilla_mp_the_breadcrumbs() {
	
	global $post;

  	$breadcrumb_title_bar_meta = null;
	$banner_bg_img_meta = null;

	$breadcrumb_title_bar_meta	= rwmb_meta( 'dreamvilla_breadcrumb_title_bar_meta' );
	$banner_bg_img_meta			= rwmb_meta( 'dreamvilla_banner_bg_img_meta' );

	if (!is_home()) {
		
		$dreamvilla_options = get_option('dreamvilla_options');
		$class = $class2 = "";
		if( !empty($dreamvilla_options['dreamvilla_header_variation']) && $dreamvilla_options['dreamvilla_header_variation'] == 2 ) {
			$class = "inner_slider_text_2";
		} else {
			$class2 = "property_info_header";
		} ?>
		
		<header>
			<div class="inner-page-header-area <?php if( !empty($dreamvilla_options['dreamvilla_header_variation']) && $dreamvilla_options['dreamvilla_header_variation'] == 2 ) { echo "v1"; } ?>">
				<?php 
				if( !empty($banner_bg_img_meta) ) { 
					foreach ( $banner_bg_img_meta as $image ) { ?>
						<img src="<?php echo esc_url($image['full_url']); ?>" alt="banner-image"><?php
					}
				} ?>
				<div class="container">
					<div class="inner_slider_text <?php echo $class; ?>">
						<div class="<?php echo $class2; ?>"><h2><span>
							<?php printf( esc_html__(' %s ','dreamvilla-multiple-property'),$post->post_title); ?>

							</span></h2>
							<?php if( $breadcrumb_title_bar_meta == 1 ){ ?>
							<h5><span><a href="<?php echo esc_url( home_url( '/' )); ?>">
							<?php esc_html_e("Home","dreamvilla-multiple-property"); ?>
							</a>
							<?php
							if (is_category() || is_single()) {
								echo " > ";
								$cats = get_the_category( $post->ID );

								if( $cats ){
									foreach ( $cats as $cat ){
										printf( esc_html__('%s','dreamvilla-multiple-property'),$cat->cat_name)." > ";										
									}
								}
								if (is_single()) {
									the_title();
								}
							} elseif (is_page()) {

								if($post->post_parent){
									$anc = get_post_ancestors( $post->ID );
									$anc = array_reverse($anc);

									foreach ( $anc as $ancestor ) {
										echo ' > <a href="' . esc_url(get_permalink($ancestor)) . '" title="' . get_the_title($ancestor) . '">';
										printf( esc_html__('%s','dreamvilla-multiple-property'),get_the_title($ancestor));
										echo '</a>';
									}                       
									echo ' > ' . get_the_title();                     
								} else {
									echo ' > ';
									echo  the_title();
								}                 
							} ?>
							
							</span></h5>
							<?php } ?>
						</div>
					</div>					
				</div>				
			</div>
		</header><?php
	}
}

// Detect device and get image
function dreamvilla_mp_get_device_image( $post_id ){

	$thumbnail_image 	= wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), "thumbnail" );
	$medium_image 		= wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), "medium" );
	$full_image 		= wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), "full" );
	if( wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ) ) ){
		//return 'src="'.esc_url($full_image[0]).'" srcset="'.$full_image[0].' 1x,'.$medium_image[0].' 2x,'.$thumbnail_image[0].' 3x"';
		return 'src="'.esc_url($full_image[0]).'"';
	} else {
		return '';
	}
}

//Google fonts enqueue url
function dreamvilla_mp_google_fonts_url() {
    $dreamvilla_google_font_url = '';
    
    /* Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language. */
    
    if ( 'off' !== _x( 'on', 'Google font: on or off','dreamvilla-multiple-property') ) {
        $dreamvilla_google_font_url = add_query_arg( 'family', urlencode( 'Lato|Lato:400,700,900|Montserrat:400,700&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );
    }
    return $dreamvilla_google_font_url;
}
// Google Font Enqueue scripts and styles.
function dreamvilla_mp_google_font_scripts() {
    wp_enqueue_style( 'dreamvilla-mp-fonts', dreamvilla_mp_google_fonts_url(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'dreamvilla_mp_google_font_scripts' );


/*
 * Customize post comment
 * 
 */
 function dreamvilla_mp_mytheme_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>

<<?php printf( esc_html__('%s','dreamvilla-multiple-property'),$tag); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<div class="row">
			<div class="col-sm-2 col-xs-3">
				<?php endif; ?>
				<?php
				$profile_pic = get_user_meta($comment->user_id, 'shr_pic', true);
			 	$image = wp_get_attachment_image_src( $profile_pic, 'thumbnail' );
			 	if( $image ){
			 		echo '<img class="avatar photo" width="32" height="32" src="'.esc_url($image[0]).'" alt="avtar">';
			 	} else {
			 		echo get_avatar( $comment, $args['avatar_size'] );
			 	} ?>
		    </div>
			<div class="col-sm-10 col-xs-9">
				<div class="replyer_name">
					<h4><?php printf( esc_html__( '%s','dreamvilla-multiple-property'), get_comment_author() ); ?></h4>
				</div>
				<!--code for the reply button-->
				<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				
				<span class="pull-right reply_date_time">
					<?php
						/* translators: 1: date, 2: time */
						printf( esc_html__('%1$s','dreamvilla-multiple-property'), get_comment_date(),'');
					?>
				</span>
				<div class="reply_message">
					<?php comment_text(); ?>
				</div>
			</div>
		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
	</div>
	<?php endif;
}

// Get the listing list variation 1 of property
function dreamvilla_mp_listing_full_list_version1($property_ID, $property_sidebar){
	
	$property_status = get_post_meta( $property_ID, 'pstatus', true );
	
	if ( $property_status == "sale" ){
		$property_status = sprintf( esc_html__('Venta','dreamvilla-multiple-property'));
	} else {
		$property_status = sprintf( esc_html__('Alquiler','dreamvilla-multiple-property'));
	}

	$property_image = dreamvilla_mp_get_device_image( $property_ID );
	
	$pcountry = sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $property_ID, 'pcountry', true ));

	$html = "";

	if( $property_sidebar == "with" ){
		
		$property_detail = get_post( $property_ID );

		$property_status_list = wp_get_post_terms($property_ID, 'property_status' );
		if( !empty($property_status_list[0]->term_id) && $property_status_list[0]->slug != "normal" ){
			$featured_proeprty_label = '<span class="featured-proeprty-label">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$property_status_list[0]->name ).'</span>';
		} else {
			$featured_proeprty_label = '';
		}
		
		$PropertyFetured = get_post_meta( $property_ID, 'pfetured', true);
		if( $PropertyFetured == "yes" ){
			$featured_proeprty_label_icon = '<span class="featured-property-icon" href="javascript:void(0)"><i class="fa fa-star"></i> <span class="featuredtext">Destacado</span> </span>';
		} else {
			$featured_proeprty_label_icon = '';
		}

		$html .= 
		'<div class="col-xs-12 col-sm-5 col-md-5 property-list-list-image">
			<img '.$property_image.' alt="recent-properties-1" class="img-responsive">
			'.dreamvilla_mp_agent_favorites_property_icon($property_ID).'
			'.$featured_proeprty_label.'
			'.$featured_proeprty_label_icon.'
		</div>

		<div class="col-xs-12 col-sm-7 col-md-7 property-list-list-info">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<a href="'.esc_url(get_permalink($property_ID)).'"><h5>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_the_title($property_ID)).'</h5></a>
				<span class="recent-properties-address">'.$pcountry;
				if( get_post_meta( $property_ID, 'pcountry', true ) && get_post_meta( $property_ID, 'pstate', true ) ){ 
					$html .= " / ";
				}

				$html .= sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $property_ID, 'pstate', true ));

				$html .= '</span>
				<p class="recent-properties-price">';
					$property_price = get_post_meta( $property_ID, 'pprice', true );
					$property_status = get_post_meta( $property_ID, 'pstatus', true );
					if( $property_price[0] ){
						if( $property_status == "sale" ){
							$html .= sprintf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
						} else {
							$html .= sprintf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
							$html .= '<span class="price-label">';
							$html .= sprintf( esc_html__(' / %s','dreamvilla-multiple-property'),strtoupper($property_price[1]));
							$html .= '</span>';
						}									
					}				
			$html .= '</div>
			<div class="col-xs-12 col-sm-12 col-md-12">';
				$html .= '<p>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),wp_trim_words( $property_detail->post_excerpt, 15 )).'</p>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 property-list-list-facility">';
			if( dreamvilla_mp_number_of_bathroom($property_ID) != "-" ){
				$html .= 
					'<ul>
						<li class="left">
							<img src="'.get_template_directory_uri().'/images/recent_bath.png" alt="Recent Bath" />
							'.esc_html__('Bathrooms','dreamvilla-multiple-property').'
					      </li>
						<li class="right"><span>';
						$html .= sprintf( esc_html__('%s','dreamvilla-multiple-property'),dreamvilla_mp_number_of_bathroom($property_ID));
						$html .= '</span></li>
					</ul>';
				} 
				if( dreamvilla_mp_number_of_bedroom($property_ID) != "-" ){
					$html .= 
					'<ul>
						<li class="left">
							<img src="'.get_template_directory_uri().'/images/recent_bed.png" alt="Recent Bed" />
							'.esc_html__('Beds','dreamvilla-multiple-property').'
						</li>
						<li class="right"><span>';
						$html .= sprintf( esc_html__('%s','dreamvilla-multiple-property'),dreamvilla_mp_number_of_bedroom($property_ID));
						$html .= '</span></li>
					</ul>';
				}
				if( get_post_meta( $property_ID, 'pnoofgarage', true) ){
					$html .=
					'<ul>
						<li class="left">
							<img src="'.get_template_directory_uri().'/images/recent_garage.png" alt="Recent Garage" />
							'.esc_html__('Garages','dreamvilla-multiple-property').'
						</li>
						<li class="right"><span>';
						$html .= sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $property_ID, 'pnoofgarage', true));
						$html .= '</span></li>
					</ul>';
				}
			$html .= '<label class="property-list-list-label">
				'.$property_status.'
			</label>
		</div>';		
	} else {
		
		$property_status_list = wp_get_post_terms($property_ID, 'property_status' );
		if( !empty($property_status_list[0]->term_id) && $property_status_list[0]->slug != "normal" ){
			$featured_proeprty_label = '<span class="featured-proeprty-label">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$property_status_list[0]->name ).'</span>';
		} else {
			$featured_proeprty_label = '';
		}
		
		$PropertyFetured = get_post_meta( $property_ID, 'pfetured', true);
		if( $PropertyFetured == "yes" ){
			$featured_proeprty_label_icon = '<span class="featured-property-icon" href="javascript:void(0)"><i class="fa fa-star"></i> <span class="featuredtext">Destacado</span> </span>';
		} else {
			$featured_proeprty_label_icon = '';
		}

		$html .=
		'<div class="property-list-list property-listing-list-full">
			<div class="col-xs-12 col-sm-4 col-md-4 property-list-list-image">
				<a href='.esc_url(get_permalink($property_ID)).'>
					<img '.$property_image.' alt="recent-properties-1" class="img-responsive">
				</a>
				
				'.$featured_proeprty_label.'
				'.$featured_proeprty_label_icon.'
				'.dreamvilla_mp_agent_favorites_property_icon($property_ID).'
			</div>
			<div class="col-xs-12 col-sm-8 col-md-8 property-list-list-info">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<a href="'.esc_url(get_permalink($property_ID)).'"><h5>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_the_title($property_ID)).'</h5></a>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<label class="property-list-list-label">
						'.$property_status.'
					</label>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">	
					<span class="recent-properties-address">'.$pcountry;
					if( get_post_meta( $property_ID, 'pcountry', true ) && get_post_meta( $property_ID, 'pstate', true ) ){ 
						$html .= " / ";
					}

					$html .= sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $property_ID, 'pstate', true ));

					$html .= '</span>
					<p class="recent-properties-price">';
						$property_price = get_post_meta( $property_ID, 'pprice', true );
						$property_status = get_post_meta( $property_ID, 'pstatus', true );
						if( $property_price[0] ){
							if( $property_status == "sale" ){
								$html .= sprintf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
							} else {
								$html .= sprintf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
								$html .= '<span class="price-label">';
								$html .= sprintf( esc_html__(' / %s','dreamvilla-multiple-property'),strtoupper($property_price[1]));
								$html .= '</span>';
							}									
						}
					
					$property_detail = get_post( $property_ID );
					$html .= '<p>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'), wp_trim_words( $property_detail->post_excerpt, 20) ).'</p>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 property-list-list-facility">';
					if( dreamvilla_mp_number_of_bathroom($property_ID) != "-" ){
					$html .= 
					'<ul>
						<li class="left">
							<img src="'.get_template_directory_uri().'/images/recent_bath.png" alt="Recent Bath" />
							'.esc_html__('Bathrooms','dreamvilla-multiple-property').'
					      </li>
						<li class="right"><span>';
						$html .= sprintf( esc_html__('%s','dreamvilla-multiple-property'),dreamvilla_mp_number_of_bathroom($property_ID));
						$html .= '</span></li>
					</ul>';
					} 
					if( dreamvilla_mp_number_of_bedroom($property_ID) != "-" ){
					$html .= 
					'<ul>
						<li class="left">
							<img src="'.get_template_directory_uri().'/images/recent_bed.png" alt="Recent Bed" />
							'.esc_html__('Beds','dreamvilla-multiple-property').'
						</li>
						<li class="right"><span>';
						$html .= sprintf( esc_html__('%s','dreamvilla-multiple-property'),dreamvilla_mp_number_of_bedroom($property_ID));
						$html .= '</span></li>
					</ul>';
					}
					if( get_post_meta( $property_ID, 'pnoofgarage', true) ){
					$html .=
					'<ul>
						<li class="left">
							<img src="'.get_template_directory_uri().'/images/recent_garage.png" alt="Recent Garage" />
							'.esc_html__('Garages','dreamvilla-multiple-property').'
						</li>
						<li class="right"><span>';
						$html .= sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $property_ID, 'pnoofgarage', true));
						$html .= '</span></li>
					</ul>';
					}							
				$html .=
				'</div>						
			</div>
		</div>';
	}

	return $html;
}

// Get the listing list variation 2 of property
function dreamvilla_mp_listing_full_list_version2($property_ID, $property_sidebar){
	
	$property_status = get_post_meta( $property_ID, 'pstatus', true );
	
	if ( $property_status == "sale" ){
		$property_status = sprintf( esc_html__('Venta','dreamvilla-multiple-property'));
	} else {
		$property_status = sprintf( esc_html__('Alquiler','dreamvilla-multiple-property'));
	}

	$property_image = dreamvilla_mp_get_device_image( $property_ID );
	
	$pcountry = sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $property_ID, 'pcountry', true ));
	
	$area_detail = "";

	$area_detail = get_post_meta( $property_ID, 'psbuilduparea', true );

	$html = "";

	if( $property_sidebar == "with" ){

		$property_status_list = wp_get_post_terms($property_ID, 'property_status' );
		if( !empty($property_status_list[0]->term_id) && $property_status_list[0]->slug != "normal" ){
			$featured_proeprty_label = '<span class="featured-proeprty-label">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$property_status_list[0]->name ).'</span>';
		} else {
			$featured_proeprty_label = '';
		}

		$PropertyFetured = get_post_meta( $property_ID, 'pfetured', true);
		if( $PropertyFetured == "yes" ){
			$featured_proeprty_label_icon = '<span class="featured-property-icon" href="javascript:void(0)"><i class="fa fa-star"></i><span class="featuredtext">Destacado</span></span>';
		} else {
			$featured_proeprty_label_icon = '';
		}

		$html .= '
		<div class="feature_property_list_item">
			<div class="featured_property_image clear">
				<div class="image-with-label">
					<a href="'.esc_url(get_permalink($property_ID)).'"><img '.dreamvilla_mp_get_device_image( $property_ID ).' alt="featured-properties-1" class="img-responsive"></a>
					<label class="label-top-left">';
						$property_status = get_post_meta( $property_ID, 'pstatus', true );
						if ( $property_status == "sale" ){
							$html .= sprintf( esc_html__('Venta','dreamvilla-multiple-property'));
						} else {
							$html .= sprintf( esc_html__('Alquiler','dreamvilla-multiple-property'));
						}
					$html .= '</label>
					
					'.$featured_proeprty_label.'
					'.$featured_proeprty_label_icon.'
					'.dreamvilla_mp_agent_favorites_property_icon($property_ID).'
				</div>
			</div>
			<div class="featured_property_description">
				<a href="'.esc_url(get_permalink($property_ID)).'"><h6>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_the_title($property_ID)).'</h6></a>
				<p class="featured-properties-price">';
					$property_price = get_post_meta( $property_ID, 'pprice', true );
						if( $property_price[0] ){
							if( $property_status == "sale" ){
								$html .=sprintf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
							} else {
								$html .=sprintf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
								$html .='<span class="price-label">';
								$html .=sprintf( esc_html__(' / %s','dreamvilla-multiple-property'),strtoupper($property_price[1]));
								$html .='</span>';
							}
						}
					$html .= '</p>
				
				<ul class="property-features">
					<li>
						<img src="'.get_template_directory_uri().'/images/recent_bath.png" alt="Recent Bath" />
						'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),dreamvilla_mp_number_of_bathroom($property_ID)).'
					</li>
					<li>
						<img src="'.get_template_directory_uri().'/images/recent_bed.png" alt="Recent Bed" />
						'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),dreamvilla_mp_number_of_bedroom($property_ID)).'
					 </li>
					<li>
						<img src="'.get_template_directory_uri().'/images/recent_garage.png" alt="Recent Garage" />
						'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $property_ID, 'pnoofgarage', true)).'
					</li>
					<li>
						<img src="'.get_template_directory_uri().'/images/recent_area.png" alt="Recent Area" />
						'.sprintf( esc_html__('%s','dreamvilla-multiple-property'), $area_detail[0] ).'
					</li>
				</ul>
				
				<div class="featured-properties-address-div padding_none">';
					if( get_post_meta( $property_ID, 'pcountry', true ) && get_post_meta( $property_ID, 'pstate', true ) ){ 
						$property_address = " / "; 
					}
					if( get_post_meta( $property_ID, 'pcountry', true ) || get_post_meta( $property_ID, 'pstate', true ) ){
						$html .= '<p class="featured-properties-address padding_none"><i class="fa fa-map-marker fa-lg"> </i>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $property_ID, 'pcountry', true )).$property_address.sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $property_ID, 'pstate', true )).'</p>';
					}

				$html .= '</div>
			</div>
		</div>';
	} else {
		
		$property_detail = get_post( $property_ID );
		
		$property_status_list = wp_get_post_terms($property_ID, 'property_status' );
		if( !empty($property_status_list[0]->term_id) && $property_status_list[0]->slug != "normal" ){
			$featured_proeprty_label = '<span class="featured-proeprty-label">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$property_status_list[0]->name ).'</span>';
		} else {
			$featured_proeprty_label = '';
		}

		$PropertyFetured = get_post_meta( $property_ID, 'pfetured', true);
		if( $PropertyFetured == "yes" ){
			$featured_proeprty_label_icon = '<span class="featured-property-icon" href="javascript:void(0)"><i class="fa fa-star"></i> <span class="featuredtext">Destacado</span> </span>';
		} else {
			$featured_proeprty_label_icon = '';
		}
		
		$html .= 
		'<div class="property-list-list">
			<div class="col-xs-12 col-sm-4 col-md-4 property-list-list-image v1">
				'.dreamvilla_mp_agent_favorites_property_icon($property_ID).'
				<img '.dreamvilla_mp_get_device_image( $property_ID ).' alt="recent-properties-1" class="img-responsive">
				<label class="property-list-list-label corner">';
					$property_status = get_post_meta( $property_ID, 'pstatus', true );
					if ( $property_status == "sale" ){
						$html .= sprintf( esc_html__('Venta','dreamvilla-multiple-property'));
					} else {
						$html .= sprintf( esc_html__('Alquiler','dreamvilla-multiple-property'));
					}
				$html .= '</label>

				'.$featured_proeprty_label.'
				'.$featured_proeprty_label_icon.'

			</div>
			<div class="col-xs-12 col-sm-8 col-md-8 property-list-list-info v2">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<a href="'.esc_url(get_permalink($property_ID)).'"><h5>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_the_title($property_ID)).'</h5></a>
					<p class="recent-properties-price v2">';
						$property_price = get_post_meta( $property_ID, 'pprice', true );
						if( $property_price[0] ){
							if( $property_status == "sale" ){
								$html .=sprintf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
							} else {
								$html .=sprintf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
								$html .='<span class="price-label">';
								$html .=sprintf( esc_html__(' / %s','dreamvilla-multiple-property'),strtoupper($property_price[1]));
								$html .='</span>';
							}
						}
					$html .= '</p>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12">	
					<p>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),wp_trim_words( $property_detail->post_excerpt, 20 )).'</p>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 property-list-list-facility">
					<div class="row list-v2">
						<ul class="col-xs-12 col-sm-3 col-md-3">
							<li class="left"><img src="'.get_template_directory_uri().'/images/recent_bath.png" alt="Recent Bath" />'.__('Bathrooms','dreamvilla-multiple-property').'</li>
							<li class="right"><span>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),dreamvilla_mp_number_of_bathroom($property_ID)).'</span></li>
						</ul>
						<ul class="col-xs-12 col-sm-3 col-md-3">
							<li class="left"><img src="'.get_template_directory_uri().'/images/recent_bed.png" alt="Recent Bed" />'.__('Beds','dreamvilla-multiple-property').'</li>
							<li class="right"><span>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),dreamvilla_mp_number_of_bedroom($property_ID)).'</span></li>
						</ul>
						<ul class="col-xs-12 col-sm-3 col-md-3">
							<li class="left"><img src="'.get_template_directory_uri().'/images/recent_garage.png" alt="Recent Garage" />'.__('Garages','dreamvilla-multiple-property').'</li>
							<li class="right"><span>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $property_ID, 'pnoofgarage', true)).'</span></li>
						</ul>
						<ul class="col-xs-12 col-sm-3 col-md-3">
							<li class="left"><img src="'.get_template_directory_uri().'/images/recent_area.png" alt="Recent Area" />'.__('Area','dreamvilla-multiple-property').'</li>
							<li class="right"><span>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'), $area_detail[0] ).'</span></li>
						</ul>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12">';
					if( get_post_meta( $property_ID, 'pcountry', true ) && get_post_meta( $property_ID, 'pstate', true ) ){ 
						$property_address = " / "; 
					}
					if( get_post_meta( $property_ID, 'pcountry', true ) || get_post_meta( $property_ID, 'pstate', true ) ){
						$html .= '<span class="recent-properties-address"><i class="fa fa-map-marker fa-lg"> </i>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $property_ID, 'pcountry', true )).$property_address.sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $property_ID, 'pstate', true )).'</span>';
					}

				$html .= '</div>
			</div>
		</div>';
	}

	return $html;
}

// Get the listing grid variation 1 of property
function dreamvilla_mp_listing_full_grid_version1($property_ID, $property_sidebar){
	
	$property_status = get_post_meta( $property_ID, 'pstatus', true );
	
	if ( $property_status == "sale" ){
		$property_status = sprintf( esc_html__('Venta','dreamvilla-multiple-property'));
	} else {
		$property_status = sprintf( esc_html__('Alquiler','dreamvilla-multiple-property'));
	}

	$property_image = dreamvilla_mp_get_device_image( $property_ID );
	
	$pcountry = sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $property_ID, 'pcountry', true ));

	$html = "";

	if( $property_sidebar == "without" ){
		$html .= '<div class="col-sm-6 col-md-4 col-lg-4 property-list-grid-full property-list-grid">';
	} else {
		$html .= '<div class="col-sm-6 col-md-6 col-lg-6 property-list-grid1-sidebar property-list-grid">';
	}

	$property_status_list = wp_get_post_terms($property_ID, 'property_status' );
	if( !empty($property_status_list[0]->term_id) && $property_status_list[0]->slug != "normal" ){
		$featured_proeprty_label = '<span class="featured-proeprty-label">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$property_status_list[0]->name ).'</span>';
	} else {
		$featured_proeprty_label = '';
	}

	$PropertyFetured = get_post_meta( $property_ID, 'pfetured', true);
	if( $PropertyFetured == "yes" ){
		$featured_proeprty_label_icon = '<span class="featured-property-icon" href="javascript:void(0)"><span class="featuredtext">Destacado</span><i class="fa fa-star"></i></span>';
	} else {
		$featured_proeprty_label_icon = '';
	}

	$html .=
		'<div class="image-with-label"><span class="featuredtext">Destacado</span> 
			<a href="'.esc_url(get_permalink($property_ID)).'"><img '.$property_image.' alt="recent-properties-1" class="img-responsive"></a>
			<label>'; 
				$property_status = get_post_meta( $property_ID, 'pstatus', true );
				if ( $property_status == "sale" ){
					$html .= esc_html__('Venta','dreamvilla-multiple-property');
				} else {
					$html .= esc_html__('Alquiler','dreamvilla-multiple-property');
				}
		$html .= '</label>

		'.$featured_proeprty_label.'
		'.$featured_proeprty_label_icon.'

		</div>
		<a href="'.esc_url(get_permalink($property_ID)).'"><h6>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_the_title($property_ID)).'</h6></a>';
		
		$address_space = '';
		if( get_post_meta( $property_ID, 'pcountry', true ) && get_post_meta( $property_ID, 'pstate', true ) ){ $address_space .= " / "; }
		
		$html .= '<span class="recent-properties-address">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $property_ID, 'pcountry', true )).$address_space.sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $property_ID, 'pstate', true )).'</span>
		<p class="recent-properties-price">';						
			$property_price = get_post_meta( $property_ID, 'pprice', true );
			if( $property_price[0] ){
				if( $property_status == "sale" ){
					$html .=sprintf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
				} else {
					$html .=sprintf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
					$html .='<span class="price-label">';
					$html .=sprintf( esc_html__(' / %s','dreamvilla-multiple-property'),strtoupper($property_price[1]));
					$html .='</span>';
				}							
			}
		$html .='</p>

		'.dreamvilla_mp_agent_favorites_property_icon($property_ID).'
		
	</div>';

	return $html;
}

// Get the listing grid variation 2 of property
function dreamvilla_mp_listing_full_grid_version2($property_ID, $property_sidebar){
	
	$property_status = get_post_meta( $property_ID, 'pstatus', true );
	
	if ( $property_status == "sale" ){
		$property_status = sprintf( esc_html__('Venta','dreamvilla-multiple-property'));
	} else {
		$property_status = sprintf( esc_html__('Alquiler','dreamvilla-multiple-property'));
	}

	$property_image = dreamvilla_mp_get_device_image( $property_ID );
	
	$pcountry = sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $property_ID, 'pcountry', true ));

	$area_detail = "";

	$area_detail = get_post_meta( $property_ID, 'psbuilduparea', true );
				
	$html = "";

	if( $property_sidebar == "without" ){
		$html .= '<div class="col-sm-6 col-md-4 col-lg-4 property-list-grid">';
	} else {
		$html .= '<div class="col-sm-6 col-md-6 col-lg-6 property-list-grid2-sidebar property-list-grid">';
	}

	$property_status_list = wp_get_post_terms($property_ID, 'property_status' );
	if( !empty($property_status_list[0]->term_id) && $property_status_list[0]->slug != "normal" ){
		$featured_proeprty_label = '<span class="featured-proeprty-label">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$property_status_list[0]->name ).'</span>';
	} else {
		$featured_proeprty_label = '';
	}

	$PropertyFetured = get_post_meta( $property_ID, 'pfetured', true);
	if( $PropertyFetured == "yes" ){
		$featured_proeprty_label_icon = '<span class="featured-property-icon" href="javascript:void(0)"><i class="fa fa-star"></i> <span class="featuredtext">Destacado</span></span>';
	} else {
		$featured_proeprty_label_icon = '';
	}

	$html .=
		'<div class="image-with-label v1">
			<a href="'.esc_url(get_permalink($property_ID)).'"><img '.$property_image.' alt="recent-properties-1" class="img-responsive"></a>
			<label class="label-top-left">';
				$property_status = get_post_meta( $property_ID, 'pstatus', true );
				if ( $property_status == "sale" ){
					$html .= esc_html__('Venta','dreamvilla-multiple-property');
				} else {
					$html .= esc_html__('Alquiler','dreamvilla-multiple-property');
				}							
			$html .= '</label>
			'.dreamvilla_mp_agent_favorites_property_icon($property_ID).'
			'.$featured_proeprty_label.'
			'.$featured_proeprty_label_icon.'

		</div>
		<div class="image_description_recent_property">
			<div class="row">
				<div class="col-md-8">
					<a href="'.esc_url(get_permalink($property_ID)).'"><h6>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_the_title($property_ID)).'</h6></a>';

					$address_space = '';
					if( get_post_meta( $property_ID, 'pcountry', true ) && get_post_meta( $property_ID, 'pstate', true ) ){ $address_space .= " / "; }

					$html .= '<span class="recent-properties-address">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $property_ID, 'pcountry', true )).$address_space.sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $property_ID, 'pstate', true )).'</span>
				</div>
				<div class="col-md-4 padding_left_none text-right">
					<p class="recent-properties-price vertical-middle">';
						$property_price = get_post_meta( $property_ID, 'pprice', true );
						if( $property_price[0] ){
							if( $property_status == "sale" ){
								$html .=sprintf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
							} else {
								$html .=sprintf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
								$html .='<span class="price-label">';
								$html .=sprintf( esc_html__(' / %s','dreamvilla-multiple-property'),strtoupper($property_price[1]));
								$html .='</span>';
							}							
						}
					$html .= '</p>
				</div>	
			</div>
			<ul class="property-features">
				<li>
					<img src="'.get_template_directory_uri().'/images/recent_bath.png" alt="Recent Bath" />
					'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),dreamvilla_mp_number_of_bathroom($property_ID)).'
				</li>
				<li>
					<img src="'.get_template_directory_uri().'/images/recent_bed.png" alt="Recent Bed" />
					'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),dreamvilla_mp_number_of_bedroom($property_ID)).'
				 </li>
				<li>
					<img src="'.get_template_directory_uri().'/images/recent_garage.png" alt="Recent Garage" />
					'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $property_ID, 'pnoofgarage', true)).'
				</li>
				<li>
					<img src="'.get_template_directory_uri().'/images/recent_area.png" alt="Recent Area" />
					'.sprintf( esc_html__('%s','dreamvilla-multiple-property'), $area_detail[0] ).'
				</li>
			</ul>
		</div>	
	</div>';

	return $html;
}

function property_list_sidebar($sidebar_type){ ?>
	<div class="col-md-4 col-lg-4">
		<div class="blog_page_information">
			<?php if ( is_active_sidebar( $sidebar_type ) ) : ?>
			<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
				<?php dynamic_sidebar( $sidebar_type ); ?>
			</div><!-- #primary-sidebar -->
			<?php endif; ?>
		</div>
	</div><?php
}

function dreamvilla_mp_login_register_form(){ ?>
	<div class="login-forms-container">
		<div class="container">
			<div class="login-form-window">
				<?php get_template_part('inc/frontend/members/login/login-form'); ?>
				<?php get_template_part('inc/frontend/members/register/register-form'); ?>
				<?php get_template_part('inc/frontend/members/reset-password/reset-password'); ?>
			</div>
		</div>
	</div><?php
}

function dreamvilla_mp_dashboard_menu(){ 
	$dreamvilla_options = get_option('dreamvilla_options'); ?>
	<div class="dropdown dashboard-button">
		<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
			<?php global $current_user; printf( esc_html__('%s','dreamvilla-multiple-property'),$current_user->display_name); ?>
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu"><?php
			
			if( !empty($dreamvilla_options['user_dashboard_profile']) ){ ?>
				<li><a href="<?php echo get_permalink($dreamvilla_options['user_dashboard_profile']); ?>"><i class="glyphicon glyphicon-cog"></i><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_the_title($dreamvilla_options['user_dashboard_profile'])); ?></a></li><?php
			}
			
			if( !empty($dreamvilla_options['user_dashboard_property_list']) ){ ?>
				<li><a href="<?php echo get_permalink($dreamvilla_options['user_dashboard_property_list']); ?>"><i class="glyphicon glyphicon-map-marker"></i><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_the_title($dreamvilla_options['user_dashboard_property_list'])); ?></a></li><?php
			}
			
			if( !empty($dreamvilla_options['user_dashboard_submit_property']) ){ ?>
				<li><a href="<?php echo get_permalink($dreamvilla_options['user_dashboard_submit_property']); ?>"><i class="glyphicon glyphicon-plus"></i><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_the_title($dreamvilla_options['user_dashboard_submit_property'])); ?></a></li><?php
			}
			
			if( !empty($dreamvilla_options['user_dashboard_favorites']) ){ ?>
				<li><a href="<?php echo get_permalink($dreamvilla_options['user_dashboard_favorites']); ?>"><i class="glyphicon glyphicon-heart"></i><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_the_title($dreamvilla_options['user_dashboard_favorites'])); ?></a></li><?php
			}
			
			if( !empty($dreamvilla_options['user_dashboard_saved_searchs']) ){ ?>
				<li><a href="<?php echo get_permalink($dreamvilla_options['user_dashboard_saved_searchs']); ?>"><i class="glyphicon glyphicon-search"></i><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_the_title($dreamvilla_options['user_dashboard_saved_searchs'])); ?></a></li><?php
			}
			
			if( !empty($dreamvilla_options['user_dashboard_invoices']) ){ ?>
				<li><a href="<?php echo get_permalink($dreamvilla_options['user_dashboard_invoices']); ?>"><i class="glyphicon glyphicon-file"></i><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_the_title($dreamvilla_options['user_dashboard_invoices'])); ?></a></li><?php
			}
			
			if( !empty($dreamvilla_options['user_dashboard_package']) ){ ?>
				<li><a href="<?php echo get_permalink($dreamvilla_options['user_dashboard_package']); ?>"><i class="glyphicon glyphicon-file"></i><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_the_title($dreamvilla_options['user_dashboard_package'])); ?></a></li><?php
			} 

			$dreamvilla_options = get_option('dreamvilla_options');
		    if( isset($dreamvilla_options['member_after_logout_link']) ){
		        $Logout_Redirect_URL = get_permalink($dreamvilla_options['member_after_logout_link']);
		    } else {
		        $Logout_Redirect_URL = home_url();
		    } ?>
			
			<li><a href="<?php echo wp_logout_url( $Logout_Redirect_URL ); ?>"><i class="glyphicon glyphicon-log-out"></i><?php esc_html_e('Logout','dreamvilla-multiple-property'); ?></a></li>
		</ul>
	</div><?php
}

function dreamvilla_mp_dashboard_inner_menu($active_page){
	$dreamvilla_options = get_option('dreamvilla_options'); ?>
	<div class="inner-page-gallery-two-columns-dimension-btn show-hide-btn"><?php
        if( !empty($dreamvilla_options['user_dashboard_profile']) ){ ?>
            <a href="<?php echo get_permalink($dreamvilla_options['user_dashboard_profile']); ?>" class="<?php if( $active_page == $dreamvilla_options['user_dashboard_profile'] ){ echo "active"; } ?>"><i class="glyphicon glyphicon-cog"></i><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_the_title($dreamvilla_options['user_dashboard_profile'])); ?></a><?php
        }
        
        if( !empty($dreamvilla_options['user_dashboard_property_list']) ){ ?>
            <a href="<?php echo get_permalink($dreamvilla_options['user_dashboard_property_list']); ?>" class="<?php if( $active_page == $dreamvilla_options['user_dashboard_property_list'] ){ echo "active"; } ?>"><i class="glyphicon glyphicon-map-marker"></i><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_the_title($dreamvilla_options['user_dashboard_property_list'])); ?></a><?php
        }
        
        if( !empty($dreamvilla_options['user_dashboard_submit_property']) ){ ?>
            <a href="<?php echo get_permalink($dreamvilla_options['user_dashboard_submit_property']); ?>" class="<?php if( $active_page == $dreamvilla_options['user_dashboard_submit_property'] ){ echo "active"; } ?>"><i class="glyphicon glyphicon-plus"></i><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_the_title($dreamvilla_options['user_dashboard_submit_property'])); ?></a><?php
        }
        
        if( !empty($dreamvilla_options['user_dashboard_favorites']) ){ ?>
            <a href="<?php echo get_permalink($dreamvilla_options['user_dashboard_favorites']); ?>" class="<?php if( $active_page == $dreamvilla_options['user_dashboard_favorites'] ){ echo "active"; } ?>"><i class="glyphicon glyphicon-heart"></i><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_the_title($dreamvilla_options['user_dashboard_favorites'])); ?></a><?php
        }
        
        if( !empty($dreamvilla_options['user_dashboard_saved_searchs']) ){ ?>
            <a href="<?php echo get_permalink($dreamvilla_options['user_dashboard_saved_searchs']); ?>" class="<?php if( $active_page == $dreamvilla_options['user_dashboard_saved_searchs'] ){ echo "active"; } ?>"><i class="glyphicon glyphicon-search"></i><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_the_title($dreamvilla_options['user_dashboard_saved_searchs'])); ?></a><?php
        }
        
        if( !empty($dreamvilla_options['user_dashboard_invoices']) ){ ?>
            <a href="<?php echo get_permalink($dreamvilla_options['user_dashboard_invoices']); ?>" class="<?php if( $active_page == $dreamvilla_options['user_dashboard_invoices'] ){ echo "active"; } ?>"><i class="glyphicon glyphicon-file"></i><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_the_title($dreamvilla_options['user_dashboard_invoices'])); ?></a><?php
        }
        
        if( !empty($dreamvilla_options['user_dashboard_package']) ){ ?>
            <a href="<?php echo get_permalink($dreamvilla_options['user_dashboard_package']); ?>" class="<?php if( $active_page == $dreamvilla_options['user_dashboard_package'] ){ echo "active"; } ?>"><i class="glyphicon glyphicon-file"></i><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_the_title($dreamvilla_options['user_dashboard_package'])); ?></a><?php
        } ?>
    </div><?php
}

// Hide WordPress Social Media Plugin Update
function dreamvilla_filter_plugin_updates( $value ) {
	if( is_plugin_active( 'wordpress-social-login/wp-social-login.php' ) && isset($value->no_update['wordpress-social-login/wp-social-login.php']) ){
	    unset( $value->no_update['wordpress-social-login/wp-social-login.php'] );
    	return $value;
    }
}
add_action( 'admin_init', 'dreamvilla_filter_plugin_updates' );

// Counrt agent publish property
function dreamvilla_mp_agent_public_property($Agent_ID){
	
	$Current_User_Detail = get_user_meta( $Agent_ID );
	if( isset($Current_User_Detail['pagentproperty'][0]) ){		
		$Property_Agent_Properties = get_user_meta( $Agent_ID, 'pagentproperty', true );
		if( !empty($Property_Agent_Properties) ){
			$Agent_Public_Properties = array();
			foreach($Property_Agent_Properties as $key => $value){
				if( get_post_status( $value ) == 'publish' ){
					$Agent_Public_Properties[] = $value;
				}
			}			
		}		
	}
	
	if( !empty($Agent_Public_Properties) ) { 
		if( count($Agent_Public_Properties) > 1 ) {
			echo '<span>'.count($Agent_Public_Properties).' '.esc_html__('Properties','dreamvilla-multiple-property').'</span>';
		} else {
			echo '<span>'.count($Agent_Public_Properties).' '.esc_html__('Property','dreamvilla-multiple-property').'</span>';
		}
	} else {
		echo '<span>'.esc_html__('0 Property','dreamvilla-multiple-property').'</span>';
	}
}

// Detect ddevice and get image
function dreamvilla_get_device_image( $post_id ){

	$thumbnail_image 	= wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), "thumbnail" );
	$medium_image 		= wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), "medium" );
	$full_image 		= wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), "full" );
	if( wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ) ) ){
		//return 'src="'.esc_attr($full_image[0]).'" srcset="'.$full_image[0].' 1x,'.$medium_image[0].' 2x,'.$thumbnail_image[0].' 3x"';
		return 'src="'.esc_attr($full_image[0]).'"';
	} else if (wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ) )){
		return 'src="'.esc_attr($full_image[0]).'"';
	} else {
		return '';
	}
}

?>