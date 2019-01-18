<?php
if ( !function_exists( 'dreamvilla_create_dynamic_style' ) ) {
    
    function dreamvilla_create_dynamic_style() {

        $dreamvilla_dynamic_css = array();
        $dreamvilla_dynamic_css_min_width_1200px = array();        

        $dreamvilla_option = get_option('dreamvilla_options');

        $Fonts1 = $dreamvilla_option["Fonts1"]["font-family"];
        $Fonts2 = $dreamvilla_option["Fonts2"]["font-family"];

        $FontsColor1 = $dreamvilla_option["dreamvilla_text_color_1"];
        $FontsColor2 = $dreamvilla_option["dreamvilla_text_color_2"];
        $FontsColor3 = $dreamvilla_option["dreamvilla_text_color_3"];
        $FontsColor4 = $dreamvilla_option["dreamvilla_text_color_4"];

        $Color1 = $dreamvilla_option["dreamvilla_color_1"];
        $Color2 = $dreamvilla_option["dreamvilla_color_2"];
        $Color3 = $dreamvilla_option["dreamvilla_color_3"];
        $Color4 = $dreamvilla_option["dreamvilla_color_4"];
        $Color5 = $dreamvilla_option["dreamvilla_color_5"];
        $Color6 = $dreamvilla_option["dreamvilla_color_6"];
        $Color7 = $dreamvilla_option["dreamvilla_color_7"];

        // Change Font 1
        if( $Fonts1 != "Montserrat" && $dreamvilla_option['dreamvilla_change_font'] == 1 ){
            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  'h1,h2,h3,h4,h5,h6,ol,ol li,ul,ul li,.welcome_header,.menu, .menu .nav_link > li > a,.menu .sub-menu > li > a,.contact_info,.phone_number h5,.home-page-slider-header .property_info_header,.property_info_header > label,.about-city-estate b,.services-we-offer a,.property-list-with-sidebar .feature_property_list_item label,.multiple-featured-properties label,.property-list-with-sidebar .feature_property_list_item .featured-properties-price,.multiple-featured-properties .featured-properties-price,.property-list-with-sidebar .feature_property_list_item .featured-properties-price,.multiple-featured-properties .featured-properties-price,.property-list-with-sidebar .feature_property_list_item .featured-properties-address,.multiple-featured-properties .featured-properties-address,.multiple-recent-properties .recent-properties-price,.multiple-recent-properties label,ul.property-type > li a,.multiple-get-in-touch-button > a,.multiple-people-to-say .people-position,.multiple-recent-posts .multiple-blog-title,.multiple-recent-posts span,.multiple-recent-posts .multiple-blog-read-more,.multiple-time-detail .multiple-schedule_visit a,.multiple-agent-detail .agent-certificate-name,.multiple-agent-detail .agent-contact-information,.multiple-agent-form .multiple-send-message,.inner-page-header-area .property_info_header,.inner-page-property-details-header-area .property-detail-info label.property_type,.property-detail-info .property-detail-address,.property-detail .property-documents-area ul li a,.property-detail-info .property-detail-facility .property-detail-price,.property-detail-info .property-detail-facility .property-detail-facility-icon label,.property-detail-info .property-detail-facility .property-detail-facility-icon span,.agent-contact-form-sidebar .multiple-send-message,.get-direction button,.near-location-info .right,.load_more_btn,.property-listing-map-info-window .image-with-label label,.property-listing-map-info-window .featured-properties-detail .featured-properties-address,.property-listing-map-info-window .featured-properties-detail .featured-properties-price,.blog_info ul li a,.blog_page_information .load_more_btn,.blog_info .archieves li a,.blog_info .blogimagedescription h3,.blog_info .blogimagedescription h3 a,.blog_info .blogimagedescription .detail,.blog_info .blogimagedescription .detail a,.entry-footer > .tag-links > a,.tagcloud > a,.blog_post_page .detail a,.blog_post_reply_btn,.comment-reply-link,.reply_date_time,.blog_comment_submit_btn,.blog_comment_submit_btn, .comment_form_block .blog_comment_submit_btn, .comment-form .blog_comment_submit_btn,.inner-contact-agent-area .send-message,.inner-faq-house-info p,#inner-faq-agent-form h1,#inner-faq-agent-form .send-message,.inner-page-gallery-two-columns-dimension-detail .image_description p, .inner-page-gallery-three-columns-dimension-detail .image_description p,.inner-page-shedule div a,.content-area h2,.contact-form h5,.modal-title,.inner-page-search .page-header h1.page-title, .inner-page-search .entry-header h2.entry-title a, h2.screen-reader-text,.fresh-approch p,.homepage-varation2-contactform .multiple-send-message,.searchfilter-homepage-variation-2 .search-label,.searchfilter .search-label,.search-filter-form .submit-filter,.dsidx-primary-data .dsidx-price,.dsidx-address,.dsidx-widget-single-listing,.dsidx-widget-single-listing .dsidx-widget-single-listing-slideshow,#dsidx.dsidx-details .dsidx-contact-form table #dsidx-contact-form-submit,.dsidx-resp-search-form .dsidx-resp-area.dsidx-resp-area-submit .submit,.dsidx-resp-search-form .dsidx-resp-area.dsidx-resp-area-submit .dsidx-resp-submit,.agent-list-info .top-header h2,.agent-list-info .top-header span,.agent-detail-contact-form h2,.agent-recent-properties h2,.agent-detail-contact-form form .submit-btn,.agent-recent-properties h6,.agent-recent-properties .recent-properties-address,.agent-recent-properties .recent-properties-price,.agent-recent-properties label,ul.property-type > li a,.agent-detail-info h2,.agent-detail-info span',
                'property'  =>  'font-family',
                'value'     =>  $Fonts1. '!important'
            );
        }
    
        // Change Font 2
        if( $Fonts2 != "Lato" && $dreamvilla_option['dreamvilla_change_font'] == 1 ){
            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  'body,p,table,.phone_number h2.phone_number_h2,.home-page-slider-header .property_info_header h5,.home-page-slider-header .property_info_header .know,.slider_text .property_info_header h2.price,.multiple-recent-properties .recent-properties-address,.multiple-get-in-touch-description p,.multiple-people-to-say .people-message p,.multiple-people-to-say .people-name,.multiple-recent-posts .multiple-blog-overview,.multiple-address-area p, .multiple-time-detail p, .multiple-contact-detail a,.multiple-time-detail h6,.multiple-contact-agent p,.multiple-agent-form input, textarea,p.multiple-copyright-text,.inner-page-header-area .property_info_header h5,.inner-page-header-area .property_info_header h5 a,.default-template-inner-page p,#amenities-content li,.inner-page-features-villa .description,.inner-page-features .description,.footer,.information-label,.information-value,.agent-contact-form-sidebar input,.pac-item-query,.pac-item,.pac-item-container,.pac-item-matched,.get-direction input#GetDirectionsAddress,.near-location-info ul,.near-location-info ul li,.near-location-info span,.blog_info.blog-thumbnail input.form-input,.blog_info.blog-thumbnail #searchsubmit,ul.single_page,ul.single_page > li,.blog_page_information .search_box .custom_input, .blog_page_information .search_box .form-control,.blog_info .blogimagedescription .discription,.blog_page_information ul,blockquote > p, .inner-page-shortcodes blockquote p,.blog_discription_paragraphs,.bolg_post_list,.bolg_post_list li,.discription_detail,.reply_message,.comment-form input,.comment-form textarea,.comment_form_block input, .comment_form_block textarea,.inner-contact-agent-area input, .inner-contact-agent-area textarea,#inner-contact-agent-intro h3 span,.inner-contact-icon,.inner-faq .description,.inner-faq-panel-title > a,.inner-faq-house-info h2,#inner-faq-agent-form input, #inner-faq-agent-form textarea,.inner-page-gallery-two-columns .description,.inner-page-gallery-three-columns .description,.inner-page-gallery-two-columns-dimension-btn a, .inner-page-gallery-three-columns-dimension-btn a,.inner-page-left-sidebar li, .inner-page-right-sidebar li,.inner-page-shortcodes .alert,#inner-page-shortcodes-table-data table,.content-area ul.agent-address li,.contact-form h5 span,.agent-info p,.agnet-contact-form input, .agnet-contact-form textarea,.send-message,.inner-page-search p, .inner-page-search .entry-summary,.people-say p,.homepage-varation2-contactform input,.homepage-varation2-contactform textarea,.home-page-slider-header > p ,.home-page-slider-header > span,.search-filter-form input,.search-filter-form .dropdown-menu.inner li,.search-filter-form #more-filter-options,.dsidx-paging-control,.dsidx-sorting-control .btn.dropdown-toggle.btn-default,.dsidx-resp-submit,.dsidx-resp-area .submit,#dsidx-contact-form-submit,#dsidx-primary-data > tbody > tr > th, #dsidx-secondary-data > tbody > tr > th, .dsidx-supplemental-data.dsidx-fields > tbody > tr > th,#dsidx-primary-data > tbody > tr > td, #dsidx-secondary-data > tbody > tr > td, .dsidx-supplemental-data.dsidx-fields > tbody > tr > td,.dsidx-secondary-data-line,.dsidx-secondary-data-mls-number,#dsidx.dsidx-details .dsidx-contact-form table input[type="text"],#dsidx.dsidx-details .dsidx-contact-form table textarea,.dsidx-resp-search-form .dsidx-resp-area #dsidx-resp-location,.dsidx-resp-search-form .dsidx-resp-area #idx-q-PriceMin,.dsidx-resp-search-form .dsidx-resp-area #idx-q-PriceMax,.dsidx-resp-search-form .dsidx-resp-area #idx-q-MlsNumbers,.dsidx-resp-search-form .dsidx-resp-area #idx-q-ImprovedSqFtMin,.dsidx-resp-search-form .dsidx-resp-area label,.dsidx-details #dsidx-actions .dsidx-actions-button,.agent-list-info .agent-excerpt,.agent-list-info .agnet-list-contact-info li,.agent-detail-contact-form form input[type="text"],.agent-detail-contact-form form textarea,.agent-detail-contact-info ul li, .agent-detail-contact-info .list-item,.agent-detail-contact-info ul li a, .agent-detail-contact-info .list-item a,.agent-detail-info p,.multiple-recent-properties .property-category-list,.print-document,.share-property-on-social-media li a',
                'property'  =>  'font-family',
                'value'     =>  $Fonts2. '!important'
            );
        }

        // Change Text Color 1
        if( ($FontsColor1 != "#435061") ){
            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  'h1,h2,h3,h4,h5,h6,a:hover,.menu .navbar-default .navbar-nav > .active > a, .menu .navbar-default .navbar-nav > .active > a:focus, .menu .navbar-default .navbar-nav > .active > a:hover, .menu .nav > li > a:hover,.contact_detial,.property_info_header p .fa.fa-circle,.multiple-get-in-touch-button > a,.multiple-recent-posts .multiple-blog-title,.multiple-recent-posts .multiple-blog-read-more,.multiple-recent-posts .multiple-blog-read-more a,.default-template-inner-page p,.property-detail-info .property-detail-facility .property-detail-facility-icon span,.near-location-info .right,.property-list-list ul li.right span,.blog_info ul li a,ul.single_page,.blog_info .archieves li a,.blog_info .blogimagedescription h3, .blog_info .blogimagedescription h3 a,.blog_info .blogimagedescription .detail, .blog_info .blogimagedescription .detail a,.blog_post_page .detail a,.bolg_post_list,.bolg_post_list li,.reply_date_time,.inner-contact #inner-contact-address p,.inner-contact-agent-area input, .inner-contact-agent-area textarea,.inner-contact-agent-area textarea,.inner-faq-panel-title > a,.inner-page-left-sidebar li, .inner-page-right-sidebar li,.content-area ul.agent-address li,.agnet-contact-form input, .agnet-contact-form textarea,.modal-title,.inner-page-search .page-header h1.page-title, .inner-page-search .entry-header h2.entry-title a, h2.screen-reader-text,.search-filter-form-homepage-variation-2 input,.search-filter-form-homepage-variation-2 .btn-group.bootstrap-select,.search-filter-form input,.search-filter-form .btn-group.bootstrap-select,.search-filter-form input,.dsidx-resp-search-form .dsidx-resp-area label,.dsidx-details #dsidx-actions .dsidx-actions-button,.agent-list-info .top-header h2,.agent-detail-contact-form h2,.agent-recent-properties h2,.multiple-recent-properties .property-category-list,.inner-page-property-details-header-area.property-detail2 h1,.inner-page-property-details-header-area.property-detail2 .property-detail-facility-icon label,.property-detail .property-documents-area ul li a,.agent-recent-properties h6,.menu .sub-menu > li > a:hover,.multiple-recent-posts .fa.fa-long-arrow-right,.inner-page-gallery-two-columns-dimension-btn a, .inner-page-gallery-three-columns-dimension-btn a',
                'property'  =>  'color',
                'value'     =>  $FontsColor1. '!important'
            );            
        }

        // Change Text Color 2
        if( ($FontsColor2 != "#7e8c99") ){
            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  'p,ol,ol li,ul,ul li,a,.welcome_header,.welcome_header h6,.menu .navbar-default .menu-item-has-children > a::after,.drop_down:after,.phone_number h5,.about-city-estate b,.property-list-with-sidebar .feature_property_list_item .featured-properties-price,.multiple-featured-properties .featured-properties-price,.multiple-recent-properties .recent-properties-address,.multiple-recent-properties .carousel-indicators li,ul.property-type > li a,.multiple-recent-posts span,.multiple-recent-posts .multiple-blog-overview,.inner-page-features-villa .description,.inner-page-features .description,.property-detail p,.information-label,.information-value,.agent-contact-form-sidebar input,.agent-contact-form-sidebar textarea,.property-listing-type-button > li > a,.blog_info .blogimagedescription .discription,.blog_page_information ul,.blog_post_page, .blog_post_page p,.blog_discription_paragraphs,.reply_message,.comment-form input,.comment-form textarea,.comment_form_block input, .comment_form_block textarea,.inner-faq .description,.inner-page-gallery-two-columns .description,.inner-page-gallery-three-columns .description,#inner-page-shortcodes-table-data td,#dsidx-primary-data > tbody > tr > th, #dsidx-secondary-data > tbody > tr > th, .dsidx-supplemental-data.dsidx-fields > tbody > tr > th,#dsidx-primary-data > tbody > tr > td, #dsidx-secondary-data > tbody > tr > td, .dsidx-supplemental-data.dsidx-fields > tbody > tr > td,#dsidx.dsidx-details .dsidx-contact-form table textarea,#dsidx.dsidx-details .dsidx-contact-form table input[type="text"],#dsidx.dsidx-details .dsidx-contact-form table textarea,#dsidx.dsidx-details .dsidx-contact-form table textarea,.agent-list-info .top-header span,.agent-list-info .agent-excerpt,.agent-list-info .agnet-list-contact-info li,.agent-list-info .agnet-list-contact-info li a,.agent-detail-contact-form form input[type="text"],.agent-detail-contact-form form textarea,.agent-recent-properties .recent-properties-address,.agent-recent-properties .carousel-indicators li,ul.property-type > li a,.agent-detail-contact-info ul li, .agent-detail-contact-info .list-item,.agent-detail-contact-info ul li a, .agent-detail-contact-info .list-item a,.inner-page-property-details-header-area.property-detail2 .property-detail-address,.blog_post_page, .blog_post_page p,.menu .sub-menu > li > a,.search-filter-form input,.search-filter-form .bootstrap-select > .dropdown-toggle,.more-filter,#more-filter-options label,.multiple-people-to-say .people-position,.people-say h5 span,.near-location-info span,.get-direction input#GetDirectionsAddress,.inner-page-header-area .property_info_header h5, .inner-page-header-area .property_info_header h5 a,.blog_info.blog-thumbnail input.form-input,.blog_info.blog-thumbnail #searchsubmit,.agent-detail-info span,.btn-default,.multiple-agent-form input, textarea,.multiple-agent-detail .agent-certificate-name,.homepage-varation2-contactform input,.homepage-varation2-contactform .multiple-send-message',
                'property'  =>  'color',
                'value'     =>  $FontsColor2. '!important'
            );            
        }

        // Change Text Color 3
        if( ($FontsColor3 != "#ffffff") ){
            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  'table th,table th a,table th a:hover,blockquote,blockquote p,.property_info_header .know_more,.menu .sub-menu .menu-item-has-children > a::after,.multiple-get-in-touch-description h3,.multiple-get-in-touch-contact .fa,.multiple-get-in-touch-contact .phone_number_h2,.multiple-people-to-say .people-to-say,.multiple-location-detail h3.multiple-location-title,.multiple-contact-detail span,.multiple-time-detail .multiple-schedule_visit a,.multiple-agent-detail h3,.multiple-agent-detail h4,.multiple-agent-detail .agent-contact-information,.schedule_visit_btn:hover, .schedule_visit_btn_header:hover, .schedule_visit_btn:hover > a, .schedule_visit_btn_header:hover > a, a.schedule_visit_href_btn:hover,.inner-page-header-area .property_info_header h2,.inner_slider_text.inner_slider_text_2 h2,#amenities-content h2,.inner-page-property-details-header-area .property-detail-info h1,.agent-contact-form-sidebar .multiple-send-message,.get-direction button,.entry-footer > .tag-links > a,.tagcloud > a,.tag-links > a:hover,.tagcloud > a:hover,blockquote > p, .inner-page-shortcodes blockquote p,.blog_comment_submit_btn, .comment_form_block .blog_comment_submit_btn, .comment-form .blog_comment_submit_btn,.fresh-approch h3,h3.multiple-location-title-homepage2,.home-page-slider-header > h1,.home-page-slider-header > h2,.home-page-slider-header > h3,.home-page-slider-header > h4,.home-page-slider-header > h5,.home-page-slider-header > h6,.home-page-slider-header span,.home-page-slider-header > p ,.home-page-slider-header > span,.searchfilter-homepage-variation-2 .search-label,.search-filter-form-homepage-variation-2 .submit-filter,.searchfilter .search-label,.search-filter-form .submit-filter,.dsidx-resp-submit,.dsidx-resp-area .submit,#dsidx-contact-form-submit,.widget-title > a,.dsidx-widget-single-listing-detail-description,.jbn-nav-button.jbn-left-button.jb-classifier-layer:before,.jbn-nav-button.jbn-right-button.jb-classifier-layer:before,.jbn-nav-button.jbn-left-button.jb-classifier-layer,.jbn-nav-button.jbn-right-button.jb-classifier-layer,.dsidx-widget-single-listing .dsidx-widget-single-listing-meta .dsidx-widget-single-listing-photo-count,.dsidx-widget-single-listing-price,#dsidx.dsidx-details .dsidx-contact-form table #dsidx-contact-form-submit,.dsidx-resp-search-form .dsidx-resp-area.dsidx-resp-area-submit .submit,.dsidx-resp-search-form .dsidx-resp-area.dsidx-resp-area-submit .dsidx-resp-submit,.agent-social a i,.photo-social-section,.photo-social-section a,.agent-detail-info h2,.agent-detail-info p,.filter-header h3,.multiple-people-to-say .people-name,.multiple-address-area p, .multiple-time-detail p, .multiple-contact-detail a,.multiple-agent-form .multiple-send-message:hover,a.multiple-mail-link,.schedule_visit_btn, .schedule_visit_btn_header, .view_on_map_btn, .schedule_visit_href_btn,.schedule_visit_btn > a, .schedule_visit_btn_header > a,#amenities-content,#amenities-content li,#amenities-content li span,.inner-page-property-details-header-area .property-detail-info label.property_type,.property-detail-info .property-detail-address,.property-detail-info .property-detail-facility .property-detail-price,.property-detail-info .property-detail-facility .property-detail-facility-icon label,.load_more_btn,.property-listing-map-info-window .image-with-label label,.blog_page_information .load_more_btn,.discription_detail,.blog_post_reply_btn,.comment-reply-link,.blog_post_reply_btn:hover,.comment-reply-link:hover,.blog_comment_submit_btn,.inner-contact-agent-area .send-message,.inner-faq-agent-contact h1,.inner-faq-agent-contact h2,.inner-faq-agent-contact p,#inner-faq-agent-info a,#inner-faq-agent-form h1,#inner-faq-agent-form .send-message:hover,.inner-page-gallery-two-columns-dimension-btn a.active, .inner-page-gallery-two-columns-dimension-btn a:hover, .inner-page-gallery-three-columns-dimension-btn a.active, .inner-page-gallery-three-columns-dimension-btn a:hover,.inner-page-gallery-two-columns-dimension-detail .image_description p, .inner-page-gallery-three-columns-dimension-detail .image_description p,.inner-page-banner-paragraph p,#inner-page-shortcodes-table-data thead,.send-message,.dsidx-widget-single-listing,.dsidx-widget-single-listing .dsidx-widget-single-listing-slideshow,.agent-recent-properties label,.property_info_header > label,.multiple-recent-properties label,.property-list-with-sidebar .feature_property_list_item label, .multiple-featured-properties label,.agent-detail-contact-form form .submit-btn,.agent-contact-social.collapsed::before,.agent-contact-social::before,.agent-detail-contact-form form .submit-btn,.carousel-control,.agent-detail-contact-info .contact_agent_icon i,.property_info_header h2,.property_info_header label,.property_info_header h5,.price',
                'property'  =>  'color',
                'value'     =>  $FontsColor3. '!important'
            );            
        }        

        // Change Text Color 4
        if( ($FontsColor4 != "#0e90d9") ){
            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '.multiple-agent-form .multiple-send-message,.inner-contact-icon .glyphicon.glyphicon-earphone, .inner-contact-icon .glyphicon.glyphicon-envelope,#inner-faq-agent-form .send-message,.agent-info .glyphicon.glyphicon-earphone, .agent-info .glyphicon.glyphicon-envelope,.property-detail .property-documents-area ul li a i',
                'property'  =>  'color',
                'value'     =>  $FontsColor4. '!important'
            );            
        }

        // Change Color 1
        if( ($Color1 != "#31a2e1") ){
            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  'table th,blockquote,.home-page-slider-header .property_info_header,.row.services-we-offer-part .services-we-offer-background,.multiple-get-in-touch .multiple-get-in-touch-inner,.multiple-location-detail #multiple-contact-part,.inner-page-header-area .property_info_header,#amenities-content,.carousel-indicators .active,.property-detail-info .property-detail-facility .property-detail-price,.load_more_btn,.blog_page_information .blogimage,ul.single_page > li::before,.blog_page_information .load_more_btn,.bolg_post_list > li::before,.discription_detail,.blog_comment_submit_btn,.blog_comment_submit_btn, .comment_form_block .blog_comment_submit_btn, .comment-form .blog_comment_submit_btn,.inner-faq-agent-contact,.inner-page-banner-paragraph,#inner-page-shortcodes-table-data thead tr th,#inner-page-shortcodes-table-data thead tr th:nth-child(1),#inner-page-shortcodes-table-data thead tr th:nth-last-child(1),#inner-page-shortcodes-table-data thead,.img-background,.left-right-arrow.blue-white a:hover,.left-right-arrow.blue-white a:active,.left-right-arrow.blue-white a:focus,.home-page-slider-header .property_info_header h2.price span,.searchfilter-homepage-variation-2 .search-label,.search-filter-form .submit-filter,.ui-slider-horizontal .ui-slider-handle,#dsidx.dsidx-details .dsidx-contact-form table #dsidx-contact-form-submit,.dsidx-resp-search-form .dsidx-resp-area.dsidx-resp-area-submit .submit,.dsidx-resp-search-form .dsidx-resp-area.dsidx-resp-area-submit .dsidx-resp-submit,.agent-detail-container,.agent-detail-contact-form form .submit-btn,.menu .sub-menu,.multiple-time-detail .multiple-schedule_visit a:hover,.blog_post_reply_btn, .comment-reply-link:hover,.agent-contact-form-sidebar .multiple-send-message:hover',
                'property'  =>  'background',
                'value'     =>  $Color1. '!important'
            );

            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '.services-we-offer-variation svg',
                'property'  =>  'fill',
                'value'     =>  $Color1. '!important'
            );

            $color_rgb = dreamvilla_hex2rgb($Color1);
            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '.row.services-we-offer-part .services-we-offer-background::after',
                'property'  =>  'border-color',
                'value'     =>  $color_rgb.' rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) !important'
            );

            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  'table th,.carousel-indicators .active,.agent-contact-form-sidebar .multiple-send-message:hover,',
                'property'  =>  'border-color',
                'value'     =>  $Color1. '!important'
            );

            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '.agent-contact-detail-sidebar p i',
                'property'  =>  'color',
                'value'     =>  $Color1. '!important'
            );            
        }

        // Change Color 2
        if( ($Color2 != "#ff551a") ){
            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '.property_info_header .know_more,.property-list-with-sidebar .feature_property_list_item label,.multiple-featured-properties label,.multiple-recent-properties label,.multiple-recent-properties .carousel-indicators .active,.multiple-time-detail .multiple-schedule_visit,.schedule_visit_btn, .schedule_visit_btn_header, .view_on_map_btn, .schedule_visit_href_btn,.inner-page-property-details-header-area .property-detail-info label.property_type,.get-direction button,.property-listing-map-info-window .image-with-label label,.inner-contact-agent-area .send-message,.send-message,.search-filter-form-homepage-variation-2 .submit-filter,.searchfilter .search-label,.dsidx-widget-single-listing .dsidx-widget-single-listing-meta .dsidx-widget-single-listing-photo-count,.agent-recent-properties label,.agent-recent-properties .carousel-indicators .active,.filter-header,.filter-widget-body .ui-slider-horizontal .ui-slider-handle,.dsidx-primary-data .dsidx-price,.agent-detail-contact-info .contact_agent_icon,.dsidx-primary-data .dsidx-price,.home-page-slider-header .property_info_header h2.price::before',
                'property'  =>  'background',
                'value'     =>  $Color2. '!important'
            );

            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '.services-we-offer a,.inner-page-property-details-header-area .property-detail-banner img',
                'property'  =>  'border-color',
                'value'     =>  $Color2. '!important'
            );                    
        }

        // Change Color 3
        if( ($Color3 != "#ffffff") ){
            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '.menu .navbar-default,.menu .navbar-toggle:hover .icon-bar,.menu .navbar-toggle:focus .icon-bar,.menu .navbar-toggle:active .icon-bar,.slider_bullets > li,.multiple-featured-properties .featured-properties-detail,.multiple-get-in-touch-button > a,.property-listing-map-info-window,.feature_property_list_item,.featured_property_description,.left-right-arrow.blue-white,.people-say,.homepage-varation2-contactform .multiple-send-message,.welcome_header_menu.welcome-header-homepage-variation-2 .container,.search-filter-form-homepage-variation-2,.more-filter,.jbn-left-button,.dsidx-widget-single-listing-slideshow-control.dsidx-widget-single-listing-slideshow-prev,.jbn-right-button,.dsidx-widget-single-listing-slideshow-control.dsidx-widget-single-listing-slideshow-next,.agent-detail-contact-form form input[type="text"],.agent-detail-contact-form form textarea,.property-list-area.property-list-with-sidebar .property-list-list-info,.filter-widget-body .search-filter-form,.filter-widget-body #amount,.recent-proeprties-sidebar.widget-area.multiple-featured-properties,.recent-proeprties-sidebar.widget-area.multiple-featured-properties,.services-we-offer,.property-list-with-sidebar .feature_property_list_item .featured-properties-detail.multiple-featured-properties .featured-properties-detail,.property-list-with-sidebar .feature_property_list_item .featured-properties-address-div,.multiple-featured-properties .featured-properties-address-div,.multiple-people-to-say .people-message,.multiple-agent-form .multiple-send-message,.slider_div,.carousel-indicators li,.property-detail-info .property-detail-facility .property-detail-facility-icon span,.property-list-list ul li.right span,.property-listing-map-info-window .featured-properties-detail,#inner-faq-agent-form .send-message,header,.about-city-estate,.multiple-recent-properties,.main-get-in-touch,.multiple-recent-posts,.multiple-valuable-clients-area,.search-filter-form #amount,.single-agent,.inner-page-features-villa,.blog section,.single-post,.comment-form input, .comment-form textarea, .comment_form_block input, .comment_form_block textarea,.page-main-section-color,.inner-contact-agent-area input, .inner-contact-agent-area textarea,.single-propertym,.page-main-section-color #property-price-range',
                'property'  =>  'background',
                'value'     =>  $Color3. '!important'
            );

            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '.row.services-we-offer-part .services-we-offer-background svg,.property-detail-info .property-detail-facility .property-detail-facility-icon img,.property-detail-info .property-detail-facility .property-detail-facility-icon svg,.services-we-offer-part .img-background svg',
                'property'  =>  'fill',
                'value'     =>  $Color3. '!important'
            );

            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '.agent-profile-image > img,.carousel-indicators li,.inner-page-gallery-three-columns-dimension-detail img,.welcome_header_menu > li,.search-filter-form .filter-footer,.agent-profile-image > img, .carousel-indicators li, .inner-page-gallery-three-columns-dimension-detail img, .welcome_header_menu > li, .search-filter-form .filter-footer,.slider_div,.inner-page-gallery-two-columns-dimension-detail img',
                'property'  =>  'border-color',
                'value'     =>  $Color3. '!important'
            ); 

            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '.people-message::after',
                'property'  =>  'border-color',
                'value'     =>  $Color3.' transparent transparent '.$Color3.' !important'
            );         
        }

        // Change Color 4
        if( ($Color4 != "#435060") ){
            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '.menu .navbar-toggle .icon-bar,.menu .navbar-toggle .icon-bar,.multiple-agent-form .multiple-send-message:hover,.load_more_btn:hover,.blog_page_information .load_more_btn:hover,.blog_comment_submit_btn:hover,.blog_comment_submit_btn:hover,#inner-faq-agent-form .send-message:hover,.agent-detail-contact-form form .submit-btn:hover,.agent-detail-contact-form form .submit-btn:hover,.home-page-slider-header .slider_text,.property_info_header > label,.multiple-location-detail-inner .container,.multiple-locations,.footer,.blog_info.blog-thumbnail input.form-input,.blog_info.blog-thumbnail #searchsubmit,.blog_page_information .search_box,.blog_page_information .search_box .custom_input, .blog_page_information .search_box .form-control,.blog_post_reply_btn,.comment-reply-link,.blog_info.blog-thumbnail .form-search-custom,.location-map-contact-form,.welcome_header.welcome-header-homepage-variation-2 .container,.home-page-slider-header .slider_text,.multiple-recent-properties .carousel-indicators li,.multiple-people-to-say,.multiple-location-detail-inner .container',
                'property'  =>  'background',
                'value'     =>  $Color4. '!important'
            );
            
            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '.inner-page-property-details-header-area.property-detail2 .property-detail-facility-icon svg',
                'property'  =>  'fill',
                'value'     =>  $Color4. '!important'
            );

            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '#primary-sidebar div.blog_info.blog-thumbnail ul li',
                'property'  =>  'border-color',
                'value'     =>  $Color4. '!important'
            );            

            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '.multiple-location-detail-inner',
                'property'  =>  'background',
                'value'     =>  'rgba(0,0,0,0) linear-gradient(360deg,'.$Color4.' 60%,rgba(255,255,255,0) 40%) !important'
            );

            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '.multiple-location-detail-inner',
                'property'  =>  'background',
                'value'     =>  'rgba(0,0,0,0) -webkit-linear-gradient(360deg,'.$Color4.' 60%,rgba(255,255,255,0) 40%) !important'
            );

            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '.multiple-location-detail-inner',
                'property'  =>  'background',
                'value'     =>  'rgba(0,0,0,0) -moz-linear-gradient(360deg,'.$Color4.' 60%,rgba(255,255,255,0) 40%) !important'
            );

            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '.multiple-location-detail-inner',
                'property'  =>  'background',
                'value'     =>  'rgba(0,0,0,0) -o-linear-gradient(360deg,'.$Color4.' 60%,rgba(255,255,255,0) 40%) !important'
            );

            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '.multiple-location-detail-inner',
                'property'  =>  'background',
                'value'     =>  'rgba(0,0,0,0) -ms-linear-gradient(360deg,'.$Color4.' 60%,rgba(255,255,255,0) 40%) !important'
            );
        }

        // Change Color 5
        
        if( ($Color5 != "#eaf0f3") ){
            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '.welcome_header,.search-filter-form,.multiple-featured-properties,.searchfilter .search-filter-form #amount,h3.section-heading::before,.about-city-estate p.banner,.property-list-with-sidebar .feature_property_list_item .featured-properties-detail ul li span, .multiple-featured-properties .featured-properties-detail ul li span,.ui-slider.ui-slider-horizontal.ui-widget.ui-widget-content.ui-corner-all,.col-xs-12.col-sm-8.col-md-8.agent-info-row,.blog_page_information .blog_info, .inner-faq .blog_info,.inner-page-features,.reply_list .comment-body,.inner-page-gallery-two-columns-dimension-btn a, .inner-page-gallery-three-columns-dimension-btn a,.inner-contact-agent-area,.property-listing.multiple-recent-properties .property-list-area .property-list-list.property-listing-list-full, .property-listing.multiple-recent-properties .property-list-area .property-list-list,.property-listing-type-button > li > a:hover, .property-listing-type-button > li > a.active,.recent-proeprties-sidebar.widget-area.multiple-featured-properties .featured-properties-detail, .recent-proeprties-sidebar.widget-area.multiple-featured-properties .featured-properties-address-div,.agent-profile-sidebar,.agent-contact-form-sidebar input,.agent-contact-form-sidebar textarea',
                'property'  =>  'background',
                'value'     =>  $Color5. '!important'
            );

            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '.homepage-varaiton2-welcome-header .welcome_header.welcome-header-homepage-variation-2',
                'property'  =>  'background',
                'value'     =>  'none !important'
            );            

            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '.property-list-with-sidebar .feature_property_list_item .featured-properties-address, .multiple-featured-properties .featured-properties-address,.more-filter,.search-filter-form .filter-footer,.image_description_recent_property,.image_description_recent_property .property-features,.image_description_recent_property .property-features li,.multiple-recent-posts-homepage2 .blog-post-description,.multiple-recent-posts-homepage2 .multiple-blog-read-more,.agent-detail-contact-info ul li, .agent-detail-contact-info .list-item,.agent-detail-contact-form form input[type="text"], .agent-detail-contact-form form textarea,.comment-form input, .comment-form textarea, .comment_form_block input, .comment_form_block textarea,.inner-contact-border,#inner-page-shortcodes-table-data table,#inner-page-shortcodes-table-data tr td, #inner-page-shortcodes-table-data thead tr th,.property-listing-type-button > li,.property-list-area.property-list-with-sidebar .property-list-list-info,.property-list-area.property-list-with-sidebar .property-list-list-facility,.filter-widget-body,.recent-proeprties-sidebar.widget-area h4,.property-list-with-sidebar .featured_property_description,.property-detail h4,.agent-profile-sidebar,.near-location-info span,.get-direction,.agent-contact-sidebar,.agent-contact-detail-sidebar,.agent-contact-form-sidebar input,.agent-contact-form-sidebar textarea',
                'property'  =>  'border-color',
                'value'     =>  $Color5. '!important'
            );
        }

        // Change Color 6
        if( ($Color6 != "#0e90d9") ){
            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '.multiple-agent-form input, textarea,#inner-faq-agent-form input, #inner-faq-agent-form textarea,.inner-page-gallery-two-columns-dimension-detail .image_description, .inner-page-gallery-three-columns-dimension-detail .image_description',
                'property'  =>  'background',
                'value'     =>  $Color6. '!important'
            );

            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '.agent-list-info .agnet-list-contact-info li i',
                'property'  =>  'color',
                'value'     =>  $Color6. '!important'
            );
            
            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '.multiple-agent-form input, textarea,.social-left,.social-right,.blog_info .blogimagedescription .discription',
                'property'  =>  'border-color',
                'value'     =>  $Color6. '!important'
            );

            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '.search-filter-form-homepage-variation-2',
                'property'  =>  'box-shadow',
                'value'     =>  '1px 1px 5px '.$Color6.' !important'
            );            
        }

        if( ($Color1 != "#31a2e1") ||  ($Color6 != "#0e90d9") ){
            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '.fresh-approch',
                'property'  =>  'background',
                'value'     =>  'linear-gradient(to right, '.$Color1.' 0%,'.$Color1.' 50%,'.$Color1.' 50%,'.$Color6.' 50%,'.$Color6.' 100%) !important'
            );            
        }

        if( ($Color7 != "#3d4a5b") ){
            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '.contact-us-detail,.homepage-varation2-contactform input,.homepage-varation2-contactform .multiple-send-message:hover,.homepage-varation2-contactform .message,.inner-page-gallery-two-columns-dimension-btn a.active, .inner-page-gallery-two-columns-dimension-btn a:hover, .inner-page-gallery-three-columns-dimension-btn a.active, .inner-page-gallery-three-columns-dimension-btn a:hover',
                'property'  =>  'background',
                'value'     =>  $Color7. '!important'
            );

            $dreamvilla_dynamic_css[] = array(
                'elements'  =>  '.property-list-list .list-v2',
                'property'  =>  'border-color',
                'value'     =>  $Color7. '!important'
            );
            
        }

        // Start generating if related arrays are populated
        if ( count( $dreamvilla_dynamic_css ) > 0 ) {
            echo "<style type='text/css' id='dreamvilla-dynamic-css'>\n\n";
            
            // Basic dynamic CSS
            if ( count( $dreamvilla_dynamic_css ) > 0 ) {
                dreamvilla_dynamic_style ( $dreamvilla_dynamic_css );
            }            
            echo '</style>';
        }

    }
}
add_action( 'wp_head', 'dreamvilla_create_dynamic_style' );

if ( !function_exists( 'dreamvilla_dynamic_style' ) ) {
    
    function dreamvilla_dynamic_style( $dreamvilla_css_array ){
        foreach ( $dreamvilla_css_array as $css_part ) {
            if ( ! empty( $css_part[ 'value' ] ) ) {
                echo $css_part[ 'elements' ] . "{\n";
                echo $css_part[ 'property' ] . ":" . $css_part[ 'value' ] . ";\n";
                echo "}\n\n";
            }
        }
    }

    function dreamvilla_hex2rgb($hex) {
       $hex = str_replace("#", "", $hex);

       if(strlen($hex) == 3) {
          $r = hexdec(substr($hex,0,1).substr($hex,0,1));
          $g = hexdec(substr($hex,1,1).substr($hex,1,1));
          $b = hexdec(substr($hex,2,1).substr($hex,2,1));
       } else {
          $r = hexdec(substr($hex,0,2));
          $g = hexdec(substr($hex,2,2));
          $b = hexdec(substr($hex,4,2));
       }
       $rgb = "rgb(".$r.', '.$g.', '.$b.')';
       //return implode(",", $rgb); // returns the rgb values separated by commas
       return $rgb; // returns an array with the rgb values
    }
}