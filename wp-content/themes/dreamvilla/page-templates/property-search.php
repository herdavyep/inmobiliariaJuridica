<?php
/*
	Template Name:Property Search
*/
	get_header();

	$dreamvilla_options = get_option('dreamvilla_options');
	$layout             = $dreamvilla_options['filter_manager']['enabled'];

if(function_exists('dreamvilla_mp_the_breadcrumbs')) dreamvilla_mp_the_breadcrumbs();

	if( empty($_POST["sprice"]) && empty($_POST['eprice']) )
		$price = '';
	else
		$price = array( 'key' => 'price', 'value' => array( $_POST["sprice"], $_POST["eprice"] ), 'compare' => 'BETWEEN', 'type' => 'NUMERIC' );
	
	if( empty($_POST["keyword"]) )
		$keyword = '';
	else
		$keyword = $_POST["keyword"];

	if( empty($_POST["type"]) )
		$type = '';
	else
		$type = array( 'taxonomy' => 'property_category', 'field' => 'term_id', 'terms' => $_POST["type"] );

	if( empty($_POST["status"]) )
		$status = '';
	else
		$status = array( 'key' => 'pstatus', 'value' => $_POST["status"], 'compare' 	=> 'Like' );

	if( empty($_POST["location"]) )
		$location = '';
	else
		$location = array( 'taxonomy' => 'location', 'field' => 'term_id', 'terms' => $_POST["location"] );

	if( empty($_POST["bedroom"]) )
		$bedroom = "";
	else
		$bedroom = array( 'key' => 'propertytotalroom', 'value' => $_POST["bedroom"], 'compare' => 'Like' );

	if( empty($_POST["bathroom"]) )
		$bathroom = "";
	else
		$bathroom = array( 'key' => 'propertytotalbathroom', 'value' => $_POST["bathroom"], 'compare' => 'Like' );

	if( empty($_POST["garage"]) )
		$garage = "";
	else
		$garage = array( 'key' => 'pnoofgarage', 'value' => $_POST["garage"], 'compare' => 'Like' );

	if( empty($_POST["features"]) )
		$features = '';
	else
		$features = array( 'taxonomy' => 'features', 'field' => 'term_id', 'terms' => $_POST["features"], 'operator' => 'AND' );

	$args = array(
					'post_type' 	 => 'property',
					'posts_per_page' => $dreamvilla_options['dreamvilla_search_number_property'],
					's' 			 => $keyword,
					'meta_key' 		 => 'pfetured',
		            'orderby'   	 => 'meta_value',
		            'meta_query'	 => array(
												$price,
												$status,
												$bedroom,
												$bathroom,
												$garage												
										),
					'tax_query' 	=> array(
						'relation' 	=> 'AND',
						$type,
						$location,
						$features
					),

					'suppress_filters' 	=> 0
				);
	
	$property_query = new WP_Query( $args );
?>
<section>
	<div class="searchfilter">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<span class="search-label">
						<?php printf(esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options["dreamvilla_search_form_title"]); ?>
					</span>
				</div>
			</div>
		</div>
		<form name="property-filter" method="post" class="search-filter-form">
			<div class="container">			
				<div class="search-filter-form">
					<div class="row"><?php
						$status_keyword = $status_category = $status_status = $status_location = $status_bedroom = $status_bathroom = $status_garage = $status_sprice = $status_eprice = $status_features = true;
						if ($layout):
                            foreach ($layout as $key=>$value) {     
                                switch($key) {         
                                    case 'keyword': ?>
                                        <div class="col-xs-12 col-sm-6 col-md-3">
											<input type="text" name="keyword" id="keyword" value="<?php echo esc_attr($keyword); ?>" placeholder="<?php esc_html_e("Palabra clave","dreamvilla-multiple-property"); ?>">
										</div><?php
										$status_keyword = false;									
                                    break;

                                    case 'category': ?>
                                        <div class="col-xs-12 col-sm-6 col-md-3">
											<select name="type" id="type" class="selectpicker" data-width="100%">
												<option value=""><?php esc_html_e('Tipo de inmueble','dreamvilla-multiple-property'); ?></option>
												<?php $property_categories = get_terms("property_category", array("orderby" => "slug", "parent" => 0, 'hide_empty' => 0) );
												if ( ! empty( $property_categories ) && ! is_wp_error( $property_categories ) ){
													foreach ( $property_categories as $term ) { ?>
														<option value="<?php echo esc_attr($term->term_id); ?>" <?php if( isset($_POST['type']) && $_POST['type'] == $term->term_id ){ echo "selected=selected"; } ?> ><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$term->name); ?></option><?php
														dreamvilla_mp_get_category($term->term_id,'property_category',$_POST['type']);
													}									
												} ?>
											</select>
										</div><?php
										$status_category = false;
                                    break;

                                    case 'status': ?>
                                        <div class="col-xs-12 col-sm-6 col-md-3">
										    <select name="status" id="status" class="selectpicker" data-width="100%">
												<option value="" selected><?php esc_html_e('Estados','dreamvilla-multiple-property'); ?></option>
												<option value="sale" <?php if( isset($_POST['status']) && $_POST['status'] == "sale" ){ echo "selected=selected"; } ?> ><?php esc_html_e('Venta','dreamvilla-multiple-property'); ?></option>
												<option value="rent" <?php if( isset($_POST['status']) && $_POST['status'] == "rent" ){ echo "selected=selected"; } ?> ><?php esc_html_e('Alquiler','dreamvilla-multiple-property'); ?></option>
											</select>
										</div><?php
										$status_status = false;
                                    break;

                                    case 'location': ?>
                                        <div class="col-xs-12 col-sm-6 col-md-3">
											<select name="location" id="location" class="selectpicker" data-width="100%">
												<option value=""><?php esc_html_e('Todas las ubicaciones','dreamvilla-multiple-property'); ?></option>
												<?php $property_categories = get_terms("location", array("orderby" => "slug", "parent" => 0, 'hide_empty' => 0) );
												if ( ! empty( $property_categories ) && ! is_wp_error( $property_categories ) ){
													foreach ( $property_categories as $term ) { ?>
														<option value="<?php echo esc_attr($term->term_id); ?>" <?php if( isset($_POST['location']) && $_POST['location'] == $term->term_id ){ echo "selected=selected"; } ?> ><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$term->name); ?></option><?php
														dreamvilla_mp_get_category($term->term_id,'location',$_POST['location']);
													}									
												} ?>
											</select>
										</div><?php
										$status_location = false;
                                    break;

                                    case 'bedrooms': ?>
                                        <div class="col-xs-12 col-sm-6 col-md-3">
											<select name="bedroom" id="bedroom" class="selectpicker" data-width="100%">
												<option value=""><?php esc_html_e('Número de habitaciones','dreamvilla-multiple-property'); ?></option>
												<?php for ($i=1; $i <=10; $i++) { ?>
													<option value="<?php echo esc_attr($i); ?>" <?php if( isset($_POST['bedroom']) && $_POST['bedroom'] == $i ){ echo "selected=selected"; } ?> ><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$i); ?></option>
												<?php } ?>
											</select>
										</div><?php
										$status_bedrooms = false;
                                    break;

                                    case 'bathrooms': ?>
                                        <div class="col-xs-12 col-sm-6 col-md-3">
											<select name="bathroom" id="bathroom" class="selectpicker" data-width="100%">
												<option value=""><?php esc_html_e('Número de baños','dreamvilla-multiple-property'); ?></option>
												<?php for ($i=1; $i <=10; $i++) { ?>
													<option value="<?php echo esc_attr($i); ?>" <?php if( isset($_POST['bathroom']) && $_POST['bathroom'] == $i ){ echo "selected=selected"; } ?> ><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$i); ?></option>
												<?php } ?>
											</select>
										</div><?php
										$status_bathrooms = false;
                                    break;

                                    case 'garages': ?>
                                        <div class="col-xs-12 col-sm-6 col-md-3">
											<select name="garage" id="garage" class="selectpicker" data-width="100%">
												<option value=""><?php esc_html_e('Número de garajes','dreamvilla-multiple-property'); ?></option>
												<?php for ($i=1; $i <=10; $i++) { ?>
													<option value="<?php echo esc_attr($i); ?>" <?php if( isset($_POST['garage']) && $_POST['garage'] == $i ){ echo "selected=selected"; } ?> ><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$i); ?></option>
												<?php } ?>
											</select>
										</div><?php
										$status_garages = false;
                                    break;

                                    case 'price': ?>
                                        <div class="col-xs-12 col-sm-6 col-md-3">
											<div id="property-price-range"></div>
											<input type="text" id="amount" name="price" readonly style="border:0; color:#f6931f; font-weight:bold;">
											<input type="hidden" id="sprice" name="sprice">
											<input type="hidden" id="eprice" name="eprice">
										</div><?php
										$status_sprice = false;
										$status_eprice = false;
                                    break;                                        
                                }
                            }
                        endif;

                        echo '</div>';
                                           
                        if ($layout):
                            foreach ($layout as $key=>$value) {     
                                switch($key) {         
                                    case 'more_filter': ?>
                                    <div class="row">
				    					<div class="col-xs-12 col-sm-12 col-md-12">
				    						<div class="filter-footer"></div>
				    					</div>
				    					<div class="col-xs-6 col-sm-4 col-md-2">
				    						<span class="more-filter" id="more-filter">
				    							<?php esc_html_e('Más filtros','dreamvilla-multiple-property'); ?> <i class="glyphicon glyphicon-triangle-bottom"> </i>
				    						</span>
				    					</div><?php
				    					if( is_user_logged_in() ) { ?>
				    						<div class="col-xs-12 col-sm-3 col-md-4">
				    							<input type="text" name="saved_searches_title" class="saved_searches_title" placeholder="Search Name">
				    							<input type="button" name="saved_searches" class="saved_searches" value="Save Search">
				    							<p class="ajax_status"></p>
				    						</div><?php
				    					} ?>
				    					<div class="col-xs-6 col-sm-5 col-md-3 pull-right">
				    						<button class="submit-filter"><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options["dreamvilla_search_button_title"]); ?></button>
				    					</div>
				    					<div class="col-xs-12 col-sm-12 col-md-12" id="more-filter-options">
				    						<div class="row">
				    							<?php $property_features = get_terms("features", array("orderby" => "name", "parent" => 0, 'hide_empty' => 0) );
				    							if ( ! empty( $property_features ) && ! is_wp_error( $property_features ) ){
				    								foreach ( $property_features as $term ) { ?>
				    									<div class="col-xs-12 col-sm-4 col-md-3 option">
				    										<input id="<?php echo esc_attr($term->slug); ?>" type="checkbox" name="features[]" value="<?php echo esc_attr($term->term_id); ?>" <?php if( isset( $_POST['features'] ) && in_array($term->term_id, $_POST['features'] ) == 'yes' ){ echo esc_attr("checked"); } ?> >
				    										<label for="<?php echo esc_attr($term->slug); ?>"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$term->name); echo '(' . $term->count . ')'; ?></label>
				    									</div><?php
				    								}									
				    							} ?>
				    						</div>
				    					</div>
				    				</div><?php
				    				$status_features = false;                                    
                                    break;                                        
                                }
                            }
                        endif;

                        if( $status_features ){ ?>
                            <div class="row">
		    					<div class="col-xs-12 col-sm-12 col-md-12">
		    						<div class="filter-footer"></div>
		    					</div>
		    					<?php
		    					if( is_user_logged_in() ) { ?>
		    						<div class="col-xs-12 col-sm-3 col-md-4">
		    							<input type="text" name="saved_searches_title" class="saved_searches_title" placeholder="Search Name">
		    							<input type="button" name="saved_searches" class="saved_searches" value="Save Search">
		    							<p class="ajax_status"></p>
		    						</div><?php
		    					} ?>
		    					<div class="col-xs-6 col-sm-5 col-md-3 pull-right">
		    						<button class="submit-filter"><?php printf(esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options["dreamvilla_search_button_title"]); ?></button>
		    					</div>
		    				</div><?php
                        }

                        if( $status_keyword ){ ?>
                        	<input type="hidden" name="keyword" id="keyword" value="" ><?php
                        }

                        if( $status_category ){ ?>
                        	<input type="hidden" name="type" id="type" value="" ><?php
                        }

                        if( $status_status ){ ?>
                        	<input type="hidden" name="status" id="status" value="" ><?php
                        }

                        if( $status_location ){ ?>
                        	<input type="hidden" name="location" id="location" value="" ><?php
                        }

                        if( $status_bedroom ){ ?>
                        	<input type="hidden" name="bedroom" id="bedroom" value="" ><?php
                        }

                        if( $bathroom ){ ?>
                        	<input type="hidden" name="bathroom" id="bathroom" value="" ><?php
                        }

                        if( $status_garage ){ ?>
                        	<input type="hidden" name="garage" id="garage" value="" ><?php
                        }

                        if( $status_sprice ){ ?>
                        	<input type="hidden" name="sprice" id="sprice" value="" ><?php
                        }

                        if( $status_eprice ){ ?>
                        	<input type="hidden" name="eprice" id="eprice" value="" ><?php
                        }

                        if( $status_features ){ ?>
                        	<input type="hidden" name="features[]" id="features" value="" ><?php
                        } ?>					
				</div>
			</div>
		</form>		
	</div>
</section>
<section>
	<div class="property-listing multiple-recent-properties property-search-list-grid">
		<div class="container">
			<div class="row property-list-area">
				<?php
				if( $property_query->found_posts <= 0 ) { ?>
					<p class='no-property'><?php esc_html_e('No se encontraron propiedades.','dreamvilla-multiple-property'); ?></p>
				<?php }

				$dreamvilla_property_list = $dreamvilla_options['dreamvilla_search_page_list_variation'];
										
				if( $property_query ){
					while ($property_query->have_posts()) : $property_query->the_post();
						
						switch($dreamvilla_property_list) {
	 
	        				case 'list1_layout_full_width': echo dreamvilla_mp_listing_full_list_version1( $post->ID, 'without' );
	        				break;

	        				case 'list2_layout_full_width': echo dreamvilla_mp_listing_full_list_version2( $post->ID, 'without' );
	        				break;

	        				case 'grid1_Layout_Full_width': echo dreamvilla_mp_listing_full_grid_version1( $post->ID, 'without' );
	        				break;

	        				case 'grid2_Layout_Full_width': echo dreamvilla_mp_listing_full_grid_version2( $post->ID, 'without' );
	        				break;
	        			}        			
						
					endwhile;
				} ?>											
			</div>
			<div class="ajax_load" style="display:none;">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/ajax_load.gif" alt="ajax_load" class="img-responsive">
			</div>
			<?php 
			if( $property_query->found_posts > $dreamvilla_options['dreamvilla_search_number_property'] )
				$load_more = "style=display:block;";
			else
				$load_more = "style=display:none;";
			?>
			<div class="row load_more text-center" data-target="1">
				<button class="load_more_btn" <?php echo esc_attr($load_more); ?> ><?php esc_html_e('Cargar más','dreamvilla-multiple-property'); ?></button>
			</div>			
		</div>
	</div>
</section>
<script type="text/javascript">
	jQuery(document).ready(function(){
		
		var page = '';
	 	jQuery('.load_more').each(function(){
	 		page = jQuery(this).attr("data-target");
	 	});

	    var posts_per_page = '<?php echo $dreamvilla_options["dreamvilla_search_number_property"]; ?>';
		jQuery(".load_more_btn, .submit-filter").click(function(event){

			jQuery(".ajax_load").css("display","block");

			event.preventDefault();
			var submitfilter = false;

			if( jQuery(this).attr("class") == "submit-filter" ){
				page = 0;
				submitfilter = true;
			}

			"use strict";
			var ajaxurl = "<?php echo esc_js(admin_url('admin-ajax.php')); ?>";
			var thisButton=jQuery(this);
		    
		    var sprice 		= jQuery("#sprice").val();
			var eprice 		= jQuery("#eprice").val();
			var keyword 	= jQuery("#keyword").val();
			var type 		= jQuery("#type").val();
			var status 		= jQuery("#status").val();
			var location 	= jQuery("#location").val();
			var bedroom 	= jQuery("#bedroom").val();
			var bathroom 	= jQuery("#bathroom").val();
			var garage 		= jQuery("#garage").val();
			
			var features = [];
			if( jQuery("#features").val() == '' ){
				features = [];
			} else {
		        jQuery(':checkbox:checked').each(function(i){
		          features[i] = jQuery(this).val();
		        });
		    }

			jQuery.ajax({
		    	url:ajaxurl,
		      	type: 'post',
		      	data: {
					'action'  			: 'dreamvilla_mp_ajax_load_more_propert_search',
					'offset'			: (page * posts_per_page),
					'posts_per_page'	: posts_per_page,
					'sprice'			: sprice,
					'eprice'			: eprice,
					'keyword'			: keyword,
					'type'				: type,
					'status'			: status,
					'location'			: location,
					'bedroom'			: bedroom,
					'bathroom'			: bathroom,
					'garage'	       	: garage,
					'features' 			: features
		      	},
		    }).done(function(data){
		      	data = jQuery.parseJSON( data );
		      	
		      	page++;
		      	jQuery('.load_more').attr("data-target",page);
				jQuery("#more-filter-options").hide('slow');

		      	if( data.total_post == "no" )
		      		jQuery(".load_more_btn").hide();

		      	if( submitfilter ){
					jQuery(".property-list-list").remove();
					jQuery(".property-list-grid").remove();
		      		jQuery(".property-list-area").append(data.html);

		      		jQuery('html,body').animate({ scrollTop: jQuery(".submit-filter").offset().top}, 'slow');
		      		
		      		if( data.total_post == "no" )
		      			jQuery(".load_more_btn").hide();
		      		else
		      			jQuery(".load_more_btn").show();
		      	} else {
		      		jQuery(".property-list-area").append(data.html);
		      	}

		      	if( data.foundproperty == "no" ){
		      		jQuery(".property-list-area .no-property").remove();
		      		jQuery(".property-list-area").append("<p class='no-property'><?php echo esc_html__('No Property Found.','dreamvilla-multiple-property'); ?></p>");
		      	} else {
		      		jQuery(".property-list-area .no-property").remove();
		      	}

		      	jQuery(".ajax_load").css("display","none");
		    });
		});
	});
</script>						
<?php
	get_footer();
?>