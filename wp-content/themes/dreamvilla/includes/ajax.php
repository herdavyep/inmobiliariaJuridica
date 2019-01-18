<?php

// Send visiter message to agent
add_action( 'wp_ajax_dreamvilla_mp_send_agent_comment', 'dreamvilla_mp_send_agent_comment' );
add_action( 'wp_ajax_nopriv_dreamvilla_mp_send_agent_comment', 'dreamvilla_mp_send_agent_comment' );

function dreamvilla_mp_send_agent_comment(){
	
	$first_name 			= $_GET['first_name'];
	$last_name 				= $_GET['last_name'];
	$phone 					= $_GET['phone'];
	$comment 				= $_GET['comment'];
	$agent_email_address 	= $_GET['agent_email_address'];

	$to 		= $agent_email_address;
	$subject 	= 'Visitor Comment';

	$body  = '<html><body>';
	$body .= '<p>First Name : '.$first_name.' </p>';
	$body .= '<p>Last Number : '.$last_name.' </p>';
	$body .= '<p>Phone : '.$phone.' </p>';
	$body .= '<p>Comment : '.$comment.'</p>';
	$body .= '</body></html>';
	
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";	

	// Send email
	$email_status = wp_mail( $to, $subject, $body, $headers );
		
	if( $email_status ){
		$result['mail_info'] = "success";
	} else {
		$result['mail_info'] = "failed";
	}	
	
	echo json_encode($result);
  	die();
}

// Send visiter message to agent
add_action( 'wp_ajax_dreamvilla_mp_send_visiter_message', 'dreamvilla_mp_send_visiter_message' );
add_action( 'wp_ajax_nopriv_dreamvilla_mp_send_visiter_message', 'dreamvilla_mp_send_visiter_message' );

function dreamvilla_mp_send_visiter_message(){
	
	$full_name 				= $_GET['full_name'];
	$phone_number 			= $_GET['phone_number'];
	$email_address 			= $_GET['email_address'];
	$message 				= $_GET['message'];
	$agent_email_address 	= $_GET['agent_email_address'];

	$to 		= $agent_email_address;
	$subject 	= 'Property Schedule Visite';

	$body  = '<html><body>';
	$body .= '<p>Name : '.$full_name.' </p>';
	$body .= '<p>Phone Number : '.$phone_number.' </p>';
	$body .= '<p>Email Address : '.$email_address.' </p>';
	$body .= '<p>Message : '.$message.'</p>';
	$body .= '</body></html>';
	
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	// Send email
	$email_status = wp_mail( $to, $subject, $body, $headers );
		
	if( $email_status ){
		$result['mail_info'] = "success";
	} else {
		$result['mail_info'] = "failed";
	}	
	
	echo json_encode($result);
  	die();
}

// Send visiter message to agent and/or company
add_action( 'wp_ajax_dreamvilla_mp_propety_send_visiter_message', 'dreamvilla_mp_propety_send_visiter_message' );
add_action( 'wp_ajax_nopriv_dreamvilla_mp_propety_send_visiter_message', 'dreamvilla_mp_propety_send_visiter_message' );

function dreamvilla_mp_propety_send_visiter_message(){
	
	$full_name 				= $_GET['full_name'];
	$phone_number 			= $_GET['phone_number'];
	$email_address 			= $_GET['email_address'];
	$message 				= $_GET['message'];
	$agent_email_address 	= $_GET['agent_email_address'];
	$mail_status_1			= false;
	$mail_status_2			= false;

	$to 		= $agent_email_address;
	$subject 	= 'Property Schedule Visite';

	$body  = '<html><body>';
	$body .= '<p>Name : '.$full_name.' </p>';
	$body .= '<p>Phone Number : '.$phone_number.' </p>';
	$body .= '<p>Email Address : '.$email_address.' </p>';
	$body .= '<p>Message : '.$message.'</p>';
	$body .= '</body></html>';
	
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	$dreamvilla_options = get_option('dreamvilla_options');
	if( !empty($dreamvilla_options['sendinquirymailagent']) && $dreamvilla_options['sendinquirymailagent'] == "yes" ){
		$mail_agent = wp_mail( $to, $subject, $body, $headers );
		if(  $mail_agent ){
			$mail_status_1 = true;
		} else {
			$mail_status_1 = false;
		}
	}

	if( !empty($dreamvilla_options['sendinquirymailcompany']) && $dreamvilla_options['sendinquirymailcompany'] == "yes" ){
		$mail_company = wp_mail( $dreamvilla_options['office_email'], $subject, $body, $headers );
		if( $mail_company ){
			$mail_status_2 = true;
		} else {
			$mail_status_2 = false;
		}
	}

	if( $mail_status_1 || $mail_status_2 ){
		$result['mail_info'] = "success";
	} else {
		$result['mail_info'] = "failed";
	}
	
	echo json_encode($result);
  	die();
}

// Load more blod post
add_action( 'wp_ajax_dreamvilla_mp_ajax_load_more_blog_post', 'dreamvilla_mp_ajax_load_more_blog_post' );
add_action('wp_ajax_nopriv_dreamvilla_mp_ajax_load_more_blog_post', 'dreamvilla_mp_ajax_load_more_blog_post');

function dreamvilla_mp_ajax_load_more_blog_post() {
	$offset 		= $_REQUEST['offset'];
	$posts_per_page	= $_REQUEST['posts_per_page'];	
	
	wp_reset_query();

	$args = array(
        'post_type' 		=> 'post',
        'post_status' 		=> 'publish',
        'posts_per_page' 	=> $posts_per_page,
        'offset' 			=> $offset,
        'suppress_filters' 	=> 0
    );

    $post_query = new WP_Query( $args );
	
	$html = '';

	if( $post_query->post_count > 0 ){
		while ( $post_query->have_posts() ) {
			$post_query->the_post();
			
			$date 		= '';
			$fname 		= '';
			$lname 		= '';
			$image_url 	= '';
			$img_tag    = '';

			$post_date 	= strtotime( $post_query->post->post_date );
			$fname 		= get_the_author_meta( 'first_name', $post_query->post->post_author);
			$lname 		= get_the_author_meta( 'last_name', $post_query->post->post_author);
			$image_url 	= wp_get_attachment_image_src( get_post_thumbnail_id( $post_query->post->ID ),"full");
			
			$archive_year  = get_the_time('Y',$post_query->post->ID); 
			$archive_month = get_the_time('m',$post_query->post->ID); 
			$archive_day   = get_the_time('d',$post_query->post->ID);
			
			if( has_post_thumbnail( $post_query->post->ID ) ){
				$img_tag = '<div class="blogimage text-center"><img src="'.esc_attr($image_url[0]).'" alt="Post Feature Image"></div>';	
			}
			if( is_sticky( $post_query->post->ID ) ){
				$img_tag = '<div class="sticky-image"></div>'.$img_tag;
			}
			$html .=
			'<div class="col-md-6 blog-thumbnail grid_item_mas col-sm-12 col-xs-12">
				'.$img_tag.'
				<div class="blog_info">
					<div class="blogimagedescription">
						<h3><a href="'.esc_url(get_permalink($post_query->post->ID)).'">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$post_query->post->post_title).'</a></h3>
						<p class="discription">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),wp_trim_words($post_query->post->post_excerpt,20)).'</p>
						<p class="detail">
							<span>
								<a href="'.esc_url(get_day_link( $archive_year, $archive_month, $archive_day)).'">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'), date_i18n( "F d,Y", $post_date ) ).'</a>
							</span>
							<span>
								<a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$fname)." ".sprintf( esc_html__('%s','dreamvilla-multiple-property'),$lname).'</a>
							</span>
						</p>
					</div>
				</div>
			</div>';
		}
	}

	wp_reset_query();

	$args = array(
					'post_type' 		=> 'post',
					'post_status' 		=> 'publish',
					'posts_per_page' 	=> -1,
					'suppress_filters' 	=> 0					
				);					
	$count_post_query = new WP_Query( $args );					
	if( $count_post_query->post_count > $offset + 4 )
		$result['total_post'] = $offset;
	else
		$result['total_post'] = "no";

	$result['html'] = $html;
	
  	echo json_encode($result);
  	die();
}

// Load more agent post
add_action( 'wp_ajax_dreamvilla_mp_ajax_load_more_agent', 'dreamvilla_mp_ajax_load_more_agent' );
add_action('wp_ajax_nopriv_dreamvilla_mp_ajax_load_more_agent', 'dreamvilla_mp_ajax_load_more_agent');

function dreamvilla_mp_ajax_load_more_agent() {
	$offset 		= $_REQUEST['offset'];
	$posts_per_page	= $_REQUEST['posts_per_page'];	
	
	$args = array(
	    'role' 		=> 'subscriber',
	    'number'  	=> $posts_per_page,
        'offset' 	=> $offset,
	    'orderby' 	=> 'user_nicename',
	    'order' 	=> 'ASC'
	);

	$post_query = get_users($args);

	$counter = 0;

	$html = '';

	if( isset($post_query) ){
		foreach ($post_query as $user) {
			$counter++;
			
			$User_Detail            		= get_userdata( $user->ID );
			$Current_User_Detail    		= get_user_meta( $user->ID );

			$Property_Agent_Name = "";
			$Property_Agent_About= "";
			$Property_Agent_Contact_Number = "";
			$Property_Agent_Email_ID = "";
			$Property_Agent_Photo = "";

			if( isset($Current_User_Detail['fullname'][0]) )
				$Property_Agent_Name = $Current_User_Detail['fullname'][0];

			if( isset($Current_User_Detail['aboutme'][0]) )
				$Property_Agent_About = $Current_User_Detail['aboutme'][0];
			
			if( isset($Current_User_Detail['phone'][0]) )
				$Property_Agent_Contact_Number = $Current_User_Detail['phone'][0];
			
			if( isset($User_Detail->user_email) )
				$Property_Agent_Email_ID = $User_Detail->user_email; 
			
			if( isset($Current_User_Detail['profile_image_id'][0]) )
				$Property_Agent_Photo = $Current_User_Detail['profile_image_id'][0];
			
			if( isset($Current_User_Detail['pagentproperty'][0]) ){
				
				$Agent_Property_List = get_user_meta( $user->ID, 'pagentproperty' );
				$Property_Agent_Properties = array();
				
				foreach ($Agent_Property_List[0] as $key => $value) {
					$Property_Agent_Properties[$key] = $Agent_Property_List[0][$key];
				}							
			}

			if( isset($Current_User_Detail['twitterurl'][0]) )
				$Property_Agent_Social_Twitter = $Current_User_Detail['twitterurl'][0];
			
			if( isset($Current_User_Detail['facebookurl'][0]) )
				$Property_Agent_Social_Facebook = $Current_User_Detail['facebookurl'][0];
			
			if( isset($Current_User_Detail['pinteresturl'][0]) )
				$Property_Agent_Social_Pinteresturl_Plus = $Current_User_Detail['pinteresturl'][0];
			
			if( isset($Current_User_Detail['linkedinurl'][0]) )
				$Property_Agent_Social_Linkedin = $Current_User_Detail['linkedinurl'][0];
			
			$html .='<div class="col-xs-12 col-sm-4 col-md-4 agent-photo-row">';

				if( isset( $Current_User_Detail['profile_image_id'] ) ) {
                    $profile_image_id = intval( $Current_User_Detail['profile_image_id'][0] );
                    if ( $profile_image_id ) {
                        $html .= wp_get_attachment_image( $profile_image_id, 'full', false, array( 'class' => 'img-responsive' ) );
                    }
                }
				
				$html .= '<div class="agent-social-area">	
					<a class="agent-contact-social collapsed" href="javascript:void(0);"></a>
					<div id="agent'.$user->ID.'" class="collapse agent-social" aria-labelledby="heading14" role="tabpanel">';

						if( !empty($Property_Agent_Social_Facebook) ){
							$html .= '<a href="'.esc_url($Property_Agent_Social_Facebook).'" target="_blank"><i class="fa fa-facebook"></i></a>';
						} else {
							$html .= '<a href="#"><i class="fa fa-facebook"></i></a>';
						}

						if( !empty($Property_Agent_Social_Twitter) ){
							$html .= '<a href="'.esc_url($Property_Agent_Social_Twitter).'" target="_blank"><i class="fa fa-twitter"></i></a>';
						} else {
							$html .= '<a href="#"><i class="fa fa-twitter"></i></a>';
						}

						if( !empty($Property_Agent_Social_Pinteresturl_Plus) ){
							$html .= '<a href="'.esc_url($Property_Agent_Social_Pinteresturl_Plus).'" target="_blank"><i class="fa fa-pinterest"></i></a>';
						} else {
							$html .= '<a href="#"><i class="fa fa-pinterest"></i></a>';
						}

						if( !empty($Property_Agent_Social_Linkedin) ){
							$html .= '<a href="'.esc_url($Property_Agent_Social_Linkedin).'" target="_blank"><i class="fa fa-linkedin"></i></a>';
						} else {
							$html .= '<a href="#"><i class="fa fa-linkedin"></i></a>';
						}
			$html .= '</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-8 col-md-8 agent-info-row">
				<div class="agent-list-info">
					<div class="top-header">';
						$dreamvilla_options = get_option('dreamvilla_options');
						$html .= '<a href="'.esc_url( get_permalink( $dreamvilla_options['Theme_Page_Agent_Page'] ).'?id='.$user->ID ).'"><h2>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$Property_Agent_Name).'</h2></a>';
						if( !empty($Property_Agent_Properties) ) { 
							if( count($Property_Agent_Properties) > 1 ) {
								$html .= '<span>'.count($Property_Agent_Properties).' '.esc_html__('Properties','dreamvilla-multiple-property').'</span>';
							} else {
								$html .= '<span>'.count($Property_Agent_Properties).' '.esc_html__('Property','dreamvilla-multiple-property').'</span>';
							}
						} else {
							$html .= '<span>'.esc_html__('0 Property','dreamvilla-multiple-property').'</span>';
						}
					$html .= '</div>
					<p class="agent-excerpt">';

					if( !empty($Property_Agent_About) ){
						$html .= sprintf( esc_html__('%s','dreamvilla-multiple-property'), wp_trim_words( $Property_Agent_About, $num_words = 25, $more = '… ' ) );
					}
					$html .= '
					</p>
					<ul class="agnet-list-contact-info">
						<li>';
						if( !empty($Property_Agent_Contact_Number) ) {
						$html .='<i class="fa fa-phone"></i>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$Property_Agent_Contact_Number);
						}
					$html .='</li>
						<li>';
							if( !empty($Property_Agent_Email_ID) ){
								$html .= '<i class="fa fa-envelope"></i> <a href="mailto:'.antispambot( sanitize_email($Property_Agent_Email_ID ),1).'">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$Property_Agent_Email_ID).'</a>';
							} else {
								$html .= '<i class="fa fa-envelope"></i>';
							}
			 	$html .= '</li>
					</ul>
				</div>
			</div>';
		}
	}
	
	$args = array(
	    'role' => 'subscriber',
	    'orderby' => 'user_nicename',
	    'order' => 'ASC'
	);

	$count_post_query = get_users($args);

	if( count($count_post_query) > $offset + 5 )
		$result['total_post'] = $offset;
	else
		$result['total_post'] = "no";

	$result['html'] = $html;
	
  	echo json_encode($result);
  	die();
}

// Load more peroerty gride list
add_action( 'wp_ajax_dreamvilla_mp_ajax_load_more_property_grid', 'dreamvilla_mp_ajax_load_more_property_grid' );
add_action('wp_ajax_nopriv_dreamvilla_mp_ajax_load_more_property_grid', 'dreamvilla_mp_ajax_load_more_property_grid');

function dreamvilla_mp_ajax_load_more_property_grid() {
	
	$dreamvilla_options = get_option('dreamvilla_options');

	$offset 		= $_REQUEST['offset'];
	$posts_per_page	= $_REQUEST['posts_per_page'];	
	$category_id 	= $_REQUEST['id'];
	$listtype		= $_REQUEST['listtype'];
	$have_sidebar   = $_REQUEST['have_sidebar'];

	wp_reset_query();

	if( $category_id == 'all-proeprty' ){
		$args=array(
			'post_type'			=> 'property',
	        'posts_per_page' 	=> $posts_per_page,
	        'offset' 			=> $offset,
	        'meta_key' 		 	=> 'pfetured',
		    'orderby'   	 	=> 'meta_value',
	        'suppress_filters' 	=> 0
		);
	} else {
		$args = array(
			'post_type'			=> 'property',
	        'posts_per_page' 	=> $posts_per_page,
	        'meta_key' 		 	=> 'pfetured',
		    'orderby'   	 	=> 'meta_value',
	        'offset' 			=> $offset,
			'tax_query' 		=> array(
										array(
											'taxonomy'	=> 'property_category',
											'field' 	=> 'id',
											'terms' 	=> $category_id
										)
									),
			'suppress_filters' 	=> 0
		);			
	}

	$post_query = new WP_Query( $args );

	$html='';

	if( $post_query->post_count > 0 ){
		if( $listtype == 'grid' ){
			while ( $post_query->have_posts() ) {
				$post_query->the_post();
				
				$dreamvilla_property_list = $dreamvilla_options['dreamvilla_property_list_grid_variation'];	

				if( $have_sidebar ){
					$property_sidebar = "with";
				} else {
					$property_sidebar = "without";
				}

				switch($dreamvilla_property_list) {
	 
					case 'grid1_layout_full_width': $html .= dreamvilla_mp_listing_full_grid_version1( $post_query->post->ID, $property_sidebar );
					break;

					case 'grid2_layout_full_width': $html .= dreamvilla_mp_listing_full_grid_version2( $post_query->post->ID, $property_sidebar );
					break;					
				}				
			}
		} else {
			while ( $post_query->have_posts() ) {
				$post_query->the_post();
				
				$dreamvilla_property_list = $dreamvilla_options['dreamvilla_property_list_list_variation'];	

				if( $have_sidebar ){
					$property_sidebar = "with";
				} else {
					$property_sidebar = "without";
				}

				if( $property_sidebar == "with" ){
					$html .= '<div class="col-xs-12">';
				}

				$html .= '<div class="property-list-list property-list-grid" data-target="'.esc_attr($category_id).'">';
					
				switch($dreamvilla_property_list) {
	 				
					case 'list1_layout_full_width': $html .= dreamvilla_mp_listing_full_list_version1( $post_query->post->ID, $property_sidebar );
					break;

					case 'list2_layout_full_width': $html .= dreamvilla_mp_listing_full_list_version2( $post_query->post->ID, $property_sidebar );
					break;		

				}

				$html .= "</div>";

				if( $property_sidebar == "with" ){
					$html .= '</div>';
				}				
			}			
		}
	}

	wp_reset_query();

	if( $category_id == 'all-proeprty' ){
			$args = array(
				'post_type'			=> 'property',
				'posts_per_page' 	=> -1,
				'meta_key' 		 	=> 'pfetured',
		        'orderby'   	 	=> 'meta_value',
				'suppress_filters' 	=> 0
			);
		} else {
			$args=array(
				'post_type'			=> 'property',
				'posts_per_page' 	=> -1,
				'meta_key' 		 	=> 'pfetured',
		        'orderby'   	 	=> 'meta_value',
				'tax_query' 		=> array(
											array(
												'taxonomy' 	=> 'property_category',
												'field' 	=> 'id',
												'terms' 	=> $category_id
											)
										),
				'suppress_filters' 	=> 0
			);			
		}				
	$count_post_query = new WP_Query( $args );					
	if( $count_post_query->post_count > $offset + $posts_per_page )
		$result['total_post'] = $offset;
	else
		$result['total_post'] = "no";

	$result['html'] = $html;
	
  	echo json_encode($result);
  	die();
}

// Load more peroerty map list
add_action( 'wp_ajax_dreamvilla_mp_ajax_load_map_property', 'dreamvilla_mp_ajax_load_map_property' );
add_action('wp_ajax_nopriv_dreamvilla_mp_ajax_load_map_property', 'dreamvilla_mp_ajax_load_map_property');
function dreamvilla_mp_ajax_load_map_property() {
	$category_id 	= $_REQUEST['id' ];
	
		wp_reset_query();

		if( $category_id == 'all-proeprty' ){

			$args=array(
				'post_type'			=>	'property',
		        'posts_per_page' 	=> -1,
		        'meta_key' 		 	=> 'pfetured',
		        'orderby'   	 	=> 'meta_value',
		        'suppress_filters' 	=> 0
			);

		}else{
			
			$args = array(
				'post_type'			=>	'property',
		        'posts_per_page' 	=> -1,
		        'meta_key' 		 	=> 'pfetured',
		        'orderby'   	 	=> 'meta_value',
				'tax_query' 		=> array(
											array(
												'taxonomy' 	=> 'property_category',
												'field' 	=> 'id',
												'terms' 	=> $category_id
											)
										),
				'suppress_filters' 	=> 0
			);			
		}

		$post_query = new WP_Query( $args );
		$markers = array();
		$infoWindowContent = array();
		
		if( $post_query->post_count > 0 ){
			$i=0;
			while ( $post_query->have_posts()) {
				$post_query->the_post();
				$image_scr = dreamvilla_mp_get_device_image( $post_query->post->ID );
				
				$html='';
				$i++;
				
				$property_lat_lon = get_post_meta( $post_query->post->ID, 'platlon', true );
				$markers[] = array("London Eye, London",$property_lat_lon[0],$property_lat_lon[1]);
				
				
				$property_status_list = wp_get_post_terms($post_query->post->ID, 'property_status' );
				if( !empty($property_status_list[0]->term_id) && $property_status_list[0]->slug != "normal" ){
					$featured_proeprty_label = '<span class="featured-proeprty-label">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$property_status_list[0]->name ).'</span>';
				} else {
					$featured_proeprty_label = '';
				}

				$PropertyFetured = get_post_meta( $post_query->post->ID, 'pfetured', true);
				if( $PropertyFetured == "yes" ){
					$featured_proeprty_label_icon = '<span class="featured-property-icon" href="javascript:void(0)"><i class="fa fa-star"></i> <span class="featuredtext">Featured</span></span>';
				} else {
					$featured_proeprty_label_icon = '';
				}

				$html .=
				'<div class="property-listing-map-info-window">
		            <div class="image-with-label">
		                <a href="'.esc_url(get_permalink($post_query->post->ID)).'"> <img '.$image_scr.' alt="featured-properties-1" class="img-responsive"></a>
		                <label>';
							$property_status = get_post_meta( $post_query->post->ID, 'pstatus', true );
							if ( $property_status == "sale" ){
								$html .=sprintf( esc_html__('On Sale','dreamvilla-multiple-property'));
							} else {
								$html .=sprintf( esc_html__('On Rent','dreamvilla-multiple-property'));
							}
					$html .='</label>

					'.$featured_proeprty_label.'
					'.$featured_proeprty_label_icon.'

		            </div>
		            <div class="featured-properties-detail"> 
	                <a href="'.esc_url(get_permalink($post_query->post->ID)).'"><h6>'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$post_query->post->post_title).'</h6></a>';

	                $address_space = '';
	                if( get_post_meta( $post_query->post->ID, 'pcountry', true ) && get_post_meta( $post_query->post->ID, 'pstate', true ) ){ $address_space .= " / "; }
	                
	                $html .= '<p class="featured-properties-address">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $post_query->post->ID, 'pcountry', true )).$address_space. sprintf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $post_query->post->ID, 'pstate', true )).'</p>
	                <p class="featured-properties-price">';
						$property_price = get_post_meta( $post_query->post->ID, 'pprice', true );
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

					'.dreamvilla_mp_agent_favorites_property_icon($post_query->post->ID).'

					</div>';	
										
				$infoWindowContent[]=$html;	
			}
		}
		$result['markers']=$markers;
		$result['infoWindowContent']=$infoWindowContent;
		echo json_encode($result);
  		die();
}

// Load more peroerty search list
add_action( 'wp_ajax_dreamvilla_mp_ajax_load_more_propert_search', 'dreamvilla_mp_ajax_load_more_propert_search' );
add_action('wp_ajax_nopriv_dreamvilla_mp_ajax_load_more_propert_search', 'dreamvilla_mp_ajax_load_more_propert_search');

function dreamvilla_mp_ajax_load_more_propert_search() {
	
	$dreamvilla_options = get_option('dreamvilla_options');
	
	$offset 		= $_POST['offset'];
	$posts_per_page	= $_POST['posts_per_page'];

	if( $_POST["sprice"] == '' )
    	$sprice = $dreamvilla_options['pricestart'];
    else 
    	$sprice = $_POST["sprice"];

    if( $_POST['eprice'] == '' )
    	$eprice = $dreamvilla_options['priceend'];
    else
    	$eprice = $_POST['eprice'];
	
	if( empty($sprice) && empty($eprice) )
		$price = '';
	else
		$price = array( 'key' => 'price', 'value' => array( $sprice, $eprice ), 'compare' => 'BETWEEN', 'type' => 'NUMERIC' );
	
	if( $_POST["keyword"] )
		$keyword = $_POST["keyword"];
	else
		$keyword = '';

	if( empty($_POST["type"]) )
		$type = '';
	else
		$type = array( 'taxonomy' => 'property_category', 'field' => 'term_id', 'terms' => $_POST["type"] );

	if( empty($_POST["status"]) )
		$status = "";
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
					'offset' 		 => $offset,
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

	$dreamvilla_property_list = $dreamvilla_options['dreamvilla_search_page_list_variation'];
	
	$html = '';
	if( $property_query->post_count > 0 ){
		while ( $property_query->have_posts() ) {
			$property_query->the_post();

			switch($dreamvilla_property_list) {
	 
				case 'list1_layout_full_width': $html .= dreamvilla_mp_listing_full_list_version1( $property_query->post->ID, 'without' );
				break;

				case 'list2_layout_full_width': $html .= dreamvilla_mp_listing_full_list_version2( $property_query->post->ID, 'without' );
				break;

				case 'grid1_Layout_Full_width': $html .= dreamvilla_mp_listing_full_grid_version1( $property_query->post->ID, 'without' );
				break;

				case 'grid2_Layout_Full_width': $html .= dreamvilla_mp_listing_full_grid_version2( $property_query->post->ID, 'without' );
				break;
			}			
		}
	}

	wp_reset_query();

	$args = array(
					'post_type' 	 => 'property',
					'posts_per_page' => -1,
					'offset' 		 => $offset,
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
	
	$count_property_query = new WP_Query( $args );

	if( $count_property_query->post_count > $offset + $dreamvilla_options['dreamvilla_search_number_property'] )
		$result['total_post'] = "yes";
	else
		$result['total_post'] = "no";

	if( $count_property_query->post_count == 0 )
		$result['foundproperty'] = "no";
	else
		$result['foundproperty'] = "yes";

	$result['html'] = $html;

	echo json_encode($result);
  	die();
}
?>