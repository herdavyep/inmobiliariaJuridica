<?php
/*
     Template Name:Property Listing List
*/
	
	get_header();

$property_type_counter = array();

$dreamvilla_options = get_option('dreamvilla_options');

$post;

$title_bar_meta = null;
$sidebar_pos 	= null;
$sidebar_type 	= null;
$have_sidebar 	= null;

$title_bar_meta						= rwmb_meta( 'dreamvilla_page_title_bar_meta' );
$sidebar_pos 						= rwmb_meta( 'dreamvilla_sidebar_position_meta' );
$sidebar_type						= rwmb_meta( 'dreamvilla_sidebar' );
$have_sidebar						= $sidebar_pos ? true : false;

if(function_exists('dreamvilla_mp_the_breadcrumbs')) dreamvilla_mp_the_breadcrumbs(); ?>
<section>
	<div class="property-listing multiple-recent-properties property-listing-all property-listing-special-element">
		<div class="container"><?php
			if( $have_sidebar )
				echo '<div class="row">';
			else
				echo '<div class="row property-listing-special-element-child">';

				if( !$have_sidebar ) { ?>
					<div class="col-md-9 property-type-menu">
					<?php
					$category = get_terms( 'property_category', array( 'taxonomy' => 'property_category' ) );
					if($category){
						$flag = 0; ?>						
							<ul class="property-type">
								<li><a data-id="all-proeprty" class="active" href="javascript:void(0);"><?php esc_html_e("Todo","dreamvilla-multiple-property"); ?></a></li><?php
								foreach($category as $cat){ ?>
									<li><a href="javascript:void(0);" data-id="<?php echo esc_attr($cat->term_id);?>"><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$cat->name);?></a></li><?php 
									$flag = 1; 
								} ?>
							</ul><?php						
						} ?>					
					</div>
					<div class="col-md-3">
						<ul class="property-listing-type-button">
							<li><a href="javascript:void(0);" class="active"><img src="<?php echo get_template_directory_uri();?>/images/list_view.png" alt="list_view" /></a></li>
							<li><a href="<?php echo esc_url(get_permalink($dreamvilla_options["Theme_Page_Property_Listing_Grid"])); ?>"><img src="<?php echo get_template_directory_uri();?>/images/gride_view_disabled.png" alt="gride_view" /></a></li>
							<li><a href="<?php echo esc_url(get_permalink($dreamvilla_options["Theme_Page_Property_Listing_Map"])); ?>"><img src="<?php echo get_template_directory_uri();?>/images/map_view_disabled.png" alt="map_view" /></a></li>
						</ul>
					</div><?php 
				} ?>
			</div>
			<div class="row property-list-area list-type-add-padding"><?php
				if( $have_sidebar ){
					if( ('left' == $sidebar_pos) ) {
						property_list_sidebar($sidebar_type);
					}
					echo '<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 property-listing-special-element-child">';

					echo '<div class="property-list-area property-list-with-sidebar">';

					$property_sidebar = "with";
				} else {
					$property_sidebar = "without";
				}

				$category = get_terms( 'property_category', array( 'taxonomy' => 'property_category' ) );
				if($category){
					$flag = 0;
					if( $have_sidebar ){ ?>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-8">
								<select class="property-type">
									<option value="all-proeprty" data-id="all-proeprty" class="active"><?php esc_html_e("Ver todo","dreamvilla-multiple-property"); ?></option><?php
									foreach($category as $cat){ ?>
										<option value="<?php echo esc_attr($cat->term_id); ?>" data-id="<?php echo esc_attr($cat->term_id); ?>" ><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$cat->name);?></option><?php
										$flag = 1; 
									} ?>
								</select>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<ul class="property-listing-type-button">
									<li><a href="javascript:void(0);" class="active"><img src="<?php echo get_template_directory_uri();?>/images/list_view.png" alt="list_view" /></a></li>
									<li><a href="<?php echo esc_url(get_permalink($dreamvilla_options["Theme_Page_Property_Listing_Grid"])); ?>"><img src="<?php echo get_template_directory_uri();?>/images/gride_view_disabled.png" alt="gride_view" /></a></li>
									<li><a href="<?php echo esc_url(get_permalink($dreamvilla_options["Theme_Page_Property_Listing_Map"])); ?>"><img src="<?php echo get_template_directory_uri();?>/images/map_view_disabled.png" alt="map_view" /></a></li>
								</ul>
							</div>
						</div><?php
					} 
				}

				$args = array(
						'post_type'			=> 'property',
						'posts_per_page' 	=> $dreamvilla_options['dreamvilla_number_list_page'],
						'meta_key' 		 	=> 'pfetured',
			            'orderby'   	 	=> 'meta_value',
			            'suppress_filters' 	=> 0
					);
				$property_listing_list = get_posts($args);

				if($property_listing_list){
					foreach($property_listing_list as $post => $property_value){ 

						if( $property_sidebar == "with" ){
							echo '<div class="col-xs-12 list-type-no-padding">';
						} ?>

						<div class="property-list-list property-list-grid" data-target="all-proeprty"><?php

						$dreamvilla_property_list = $dreamvilla_options['dreamvilla_property_list_list_variation'];
						
						switch($dreamvilla_property_list) {
 
	        				case 'list1_layout_full_width': echo dreamvilla_mp_listing_full_list_version1( $property_value->ID, $property_sidebar );
	        				break;

	        				case 'list2_layout_full_width': echo dreamvilla_mp_listing_full_list_version2( $property_value->ID, $property_sidebar );
        					break;
		        		} ?>

						</div><?php
						
						if( $property_sidebar == "with" ){
							echo '</div>';
						}
					}
				}
				
				$category = get_terms( 'property_category', 'hide_empty=0' );
				if( $category ){
					$flag = 0;
					foreach( $category as $cat ){
						
						wp_reset_query();
						$count_args = array(
								'post_type'			=>	'property',
								'posts_per_page' 	=> -1,
								'meta_key' 		 	=> 'pfetured',
		            			'orderby'   	 	=> 'meta_value',
								'tax_query' 		=> array(
															    array(
															      'taxonomy' 	=> 'property_category',
															      'field' 		=> 'id',
															      'terms'		=> intval(function_exists('icl_object_id')?icl_object_id($cat->term_id,'property_category',false):$cat->term_id)
															    )
															),
								'suppress_filters' 	=> 0
							);				
						$count_post_query = new WP_Query( $count_args );							
						$PropertyID = intval(function_exists('icl_object_id')?icl_object_id($cat->term_id,'property_category',false):$cat->term_id);
						$property_type_counter[$PropertyID] = $count_post_query->post_count;

						$args = array(
									'post_type'			=> 'property',
									'posts_per_page' 	=> $dreamvilla_options['dreamvilla_number_list_page'],
									'meta_key' 		 	=> 'pfetured',
		            				'orderby'   	 	=> 'meta_value',
									'tax_query' 		=> array(
																    array(
																	      'taxonomy' 	=> 'property_category',
																	      'field' 		=> 'id',
																	      'terms'		=> intval(function_exists('icl_object_id')?icl_object_id($cat->term_id,'property_category',false):$cat->term_id)
									    							)
									  							),
								'suppress_filters' 	=> 0
							);
						$property_list = get_posts($args);								 
						if($property_list){
							foreach($property_list as $post => $value ){ 

								if( $property_sidebar == "with" ){
									echo '<div class="col-xs-12 list-type-no-padding">';
								} ?>

								<div class="property-list-list property-list-grid" data-target="<?php echo esc_attr($cat->term_id); ?>"><?php
								
								$dreamvilla_property_list = $dreamvilla_options['dreamvilla_property_list_list_variation'];
								
								switch($dreamvilla_property_list) {
 
			        				case 'list1_layout_full_width': echo dreamvilla_mp_listing_full_list_version1( $value->ID, $property_sidebar );
			        				break;

			        				case 'list2_layout_full_width': echo dreamvilla_mp_listing_full_list_version2( $value->ID, $property_sidebar );
			        				break;
			        			} ?>

								</div><?php

								if( $property_sidebar == "with" ){
									echo '</div>';
								}
							}
						} 
					}
				}			

				if( $have_sidebar ){ ?>
					</div>
					<div class="load_more_special_element">
						<div class="ajax_load" style="display:none;">
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/ajax_load.gif" alt="ajax_load" class="img-responsive">
						</div>
						<div class="row load_more text-center" data-target="all-proeprty">
							<button class="load_more_btn"><?php esc_html_e('Load more','dreamvilla-multiple-property'); ?></button>
						</div>
						<?php	
						if( $category ){
							foreach( $category as $cat ){
								if( $property_type_counter[$cat->term_id] > $dreamvilla_options['dreamvilla_number_list_page'] ) { ?>
									<div class="row load_more text-center" data-target="<?php echo esc_attr($cat->term_id); ?>">
										<button class="load_more_btn"><?php esc_html_e('Load more','dreamvilla-multiple-property'); ?></button>
									</div><?php
								}
							} 
						}
						echo "</div>";
					echo "</div>";
				} 
				if( 'right' == $sidebar_pos ){
					property_list_sidebar($sidebar_type);
				} ?>
			</div><?php

			if( 'left' == $sidebar_pos ){
				echo '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>';
				echo '<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">';
			}
			if( 'right' == $sidebar_pos ){
				echo '<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">';
			}
			 
			if( !$have_sidebar ){ ?>				
				<div class="ajax_load" style="display:none;">
					<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/ajax_load.gif" alt="ajax_load" class="img-responsive">
				</div>
				<div class="row load_more text-center" data-target="all-proeprty">
					<button class="load_more_btn"><?php esc_html_e('Load more','dreamvilla-multiple-property'); ?></button>
				</div>
				<?php	
				if( $category ){
					foreach( $category as $cat ){
						if( $property_type_counter[$cat->term_id] > $dreamvilla_options['dreamvilla_number_list_page'] ) { ?>
							<div class="row load_more text-center" data-target="<?php echo esc_attr($cat->term_id); ?>">
								<button class="load_more_btn"><?php esc_html_e('Load more','dreamvilla-multiple-property'); ?></button>
							</div><?php
						}
					} 
				}				
			}

			if( 'left' == $sidebar_pos ){
				echo '</div>';					
			} 
			if( 'right' == $sidebar_pos ){
				echo '</div>';
				echo '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>';
			} ?>			
		</div>
	</div>
</section>
<script type="text/javascript">
	jQuery(document).ready(function(){
		var page = {};
	 	jQuery('.load_more').each(function(){
	 		page[jQuery(this).attr("data-target")] = 1;
	 	});		
	    
	    var posts_per_page = '<?php echo $dreamvilla_options["dreamvilla_number_list_page"]; ?>';
	    var have_sidebar = '<?php echo $have_sidebar; ?>';

		jQuery(".load_more_btn").click(function(){
			"use strict";
			
			jQuery(".ajax_load").css("display","block");
			
			var id=jQuery(".property-type").find(".active").attr("data-id");
			var ajaxurl = "<?php echo esc_js(admin_url('admin-ajax.php')); ?>";
			var thisButton = jQuery(this);
		    jQuery.ajax({
		    url:ajaxurl,
		      data: {
		          'action'  		: 'dreamvilla_mp_ajax_load_more_property_grid',
		          'offset'			: (page[id] * posts_per_page),
		          'posts_per_page'	: posts_per_page,
		          'id'				: id,
		          'listtype'		: 'list',
		          'have_sidebar'    : have_sidebar
		      },
		    }).done(function(data){
		      	data = jQuery.parseJSON( data );
		      	
		      	page[id]++;
		      		
		      	var property_sidebar = '<?php echo $property_sidebar; ?>';
		      	if( property_sidebar == "with" ){
		      		jQuery(".property-list-area.property-list-with-sidebar").append(data.html);
		      	} else {
		      		jQuery(".property-list-area").append(data.html);
		      	}
		      	
		      	if( data.total_post == "no" ){
		      		thisButton.remove();		      		
		      	} else {
		      		jQuery(".current_post").attr("value",data.total_post);
		      	}

		      	jQuery(".ajax_load").css("display","none");
		    });
		});
	});
</script>						
<?php
	get_footer(); 
?>