<?php

function dreamvilla_property_filter_shortcode( $atts, $content = null ){

    extract(shortcode_atts(array(
        'filter_type' => '1',        
    ), $atts));

    $out = '';

    $dreamvilla_options = get_option('dreamvilla_options'); 
    $form_title         = $dreamvilla_options["dreamvilla_search_form_title"];
    $layout             = $dreamvilla_options['filter_manager']['enabled'];

    if( $filter_type == 1 ){
        $out .=
        '<div>
            <div class="searchfilter">
                <div>
                    <div class="row">
                        <div class="col-md-12">
                            <span class="search-label">
                                '.sprintf(esc_html__('%s','dreamvilla-multiple-property'),$form_title).'
                            </span>
                        </div>
                    </div>
                </div>
                <form name="property-filter" method="post" class="search-filter-form" action="'.esc_url(get_permalink( $dreamvilla_options['Theme_Page_Property_Listing_Search'] )).'" >
                    <div>        
                        <div class="search-filter-form">
                            <div class="row">';
                            if ($layout):
                                foreach ($layout as $key=>$value) {     
                                    switch($key) {         
                                        case 'keyword':
                                             $out .= '
                                            <div class="col-xs-12 col-sm-6 col-md-3">
                                                <input type="text" name="keyword" id="keyword" placeholder="'.esc_html__("Keyword","dreamvilla-multiple-property").'">
                                            </div>';
                                        break;

                                        case 'category':
                                            $out .= '
                                            <div class="col-xs-12 col-sm-6 col-md-3">
                                                <select name="type" class="selectpicker" data-width="100%">
                                                    <option value="">'.esc_html__('All Type','dreamvilla-multiple-property').'</option>';
                                                    $property_categories = get_terms("property_category", array("orderby" => "slug", "parent" => 0, 'hide_empty' => 0) );
                                                    if ( ! empty( $property_categories ) && ! is_wp_error( $property_categories ) ){
                                                        foreach ( $property_categories as $term ) {
                                                            $out .= '<option value="'.esc_attr($term->term_id).'">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$term->name).'</option>';
                                                            dreamvilla_mp_get_category_shortcode($term->term_id,'property_category','');
                                                        }                                   
                                                    }
                                                $out .= '
                                                </select>
                                            </div>';
                                        break;

                                        case 'status':
                                            $out .= '
                                            <div class="col-xs-12 col-sm-6 col-md-3">
                                                <select name="status" class="selectpicker" data-width="100%">
                                                    <option value="" selected>'.esc_html__('All Status','dreamvilla-multiple-property').'</option>
                                                    <option value="sale" >'.esc_html__('For Sale','dreamvilla-multiple-property').'</option>
                                                    <option value="rent" >'.esc_html__('For Rent','dreamvilla-multiple-property').'</option>
                                                </select>
                                            </div>';
                                        break;

                                        case 'location':
                                            $out .= '
                                            <div class="col-xs-12 col-sm-6 col-md-3">
                                                <select name="location" class="selectpicker" data-width="100%">
                                                    <option value="">'.esc_html__('All Location','dreamvilla-multiple-property').'</option>';
                                                    $property_categories = get_terms("location", array("orderby" => "slug", "parent" => 0, 'hide_empty' => 0) );
                                                    if ( ! empty( $property_categories ) && ! is_wp_error( $property_categories ) ){
                                                        foreach ( $property_categories as $term ) {
                                                            $out .= '<option value="'.esc_attr($term->term_id).'" >'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$term->name).'</option>';
                                                            dreamvilla_mp_get_category_shortcode($term->term_id,'location','');
                                                        }
                                                    }
                                                $out .= '
                                                </select>
                                            </div>';
                                        break;

                                        case 'bedrooms':
                                            $out .= '
                                            <div class="col-xs-12 col-sm-6 col-md-3">
                                                <select name="bedroom" class="selectpicker" data-width="100%">
                                                    <option value="">'.esc_html__('All Bedrooms','dreamvilla-multiple-property').'</option>';
                                                    for ($i=1; $i <=10; $i++) {
                                                        $out .= '<option value="'.esc_attr($i).'" >'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$i).'</option>';
                                                    }
                                                $out .= '
                                                </select>
                                            </div>';
                                        break;

                                        case 'bathrooms':
                                            $out .= '
                                            <div class="col-xs-12 col-sm-6 col-md-3">
                                                <select name="bathroom" class="selectpicker" data-width="100%">
                                                    <option value="">'.esc_html__('All Bathrooms','dreamvilla-multiple-property').'</option>';
                                                    for ($i=1; $i <=10; $i++) {
                                                        $out .= '<option value="'.esc_attr($i).'" >'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$i).'</option>';
                                                    }
                                                $out .= '
                                                </select>
                                            </div>';
                                        break;

                                        case 'garages':
                                            $out .= '
                                            <div class="col-xs-12 col-sm-6 col-md-3">
                                                <select name="garage" class="selectpicker" data-width="100%">
                                                    <option value="">'.esc_html__('All Garages','dreamvilla-multiple-property').'</option>';
                                                    for ($i=1; $i <=10; $i++) {
                                                        $out .= '<option value="'.esc_attr($i).'" >'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$i).'</option>';
                                                    }
                                                $out .= '
                                                </select>
                                            </div>';
                                        break;

                                        case 'price':
                                            $out .= '
                                            <div class="col-xs-12 col-sm-6 col-md-3">
                                                <div id="property-price-range"></div>
                                                <input type="text" id="amount" name="price" readonly style="border:0; color:#f6931f; font-weight:bold;">';
                                                $sprice = '';
                                                if( isset($_GET["sprice"]) )
                                                    $sprice = $_GET["sprice"];
                                                else
                                                    $sprice = '';

                                                $eprice = '';
                                                if( isset($_GET["eprice"]) )
                                                    $eprice = $_GET["eprice"];
                                                else
                                                    $eprice = '';

                                                $out .= '
                                                <input type="hidden" id="sprice" name="sprice" value="'.$sprice.'">
                                                <input type="hidden" id="eprice" name="eprice" value="'.$eprice.'">
                                            </div>';
                                        break;                                        
                                    }
                                }
                            endif;

                            $out .= '</div>';
                                               
                            $flag = true;
                            if ($layout):
                                foreach ($layout as $key=>$value) {     
                                    switch($key) {         
                                        case 'more_filter':
                                        $out .= '
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="filter-footer"></div>
                                            </div>
                                            <div class="col-xs-6 col-sm-4 col-md-2">
                                                <span class="more-filter" id="more-filter">
                                                    '.esc_html__('More Filters','dreamvilla-multiple-property').' <i class="glyphicon glyphicon-triangle-bottom"> </i>
                                                </span>
                                            </div>
                                            <div class="col-xs-6 col-sm-5 col-md-3 pull-right">
                                                <button class="submit-filter">'.sprintf(esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options["dreamvilla_search_button_title"]).'</button>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12" id="more-filter-options">
                                                <div class="row">';
                                                    $property_features = get_terms("features", array("orderby" => "name", "parent" => 0, 'hide_empty' => 0) );
                                                    if ( ! empty( $property_features ) && ! is_wp_error( $property_features ) ){
                                                        foreach ( $property_features as $term ) {
                                                            $out .= '
                                                            <div class="col-xs-12 col-sm-4 col-md-3 option">
                                                                <input id="'.esc_attr($term->slug).'" type="checkbox" name="features[]" value="'.esc_attr($term->term_id).'" >
                                                                <label for="'.esc_attr($term->slug).'">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$term->name).' '. '(' . $term->count . ')'.'</label>
                                                            </div>';
                                                        }                        
                                                    }
                                                $out .= '
                                                </div>
                                            </div>
                                        </div>';
                                        $flag = false;
                                        break;                                        
                                    }
                                }
                            endif;

                            if( $flag ){
                                $out .= '
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="filter-footer"></div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4 col-md-2">                                                
                                    </div>
                                    <div class="col-xs-6 col-sm-5 col-md-3 pull-right">
                                        <button class="submit-filter">'.sprintf(esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options["dreamvilla_search_button_title"]).'</button>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12" id="more-filter-options">                                                
                                    </div>
                                </div>';
                            }
                            $out .= '                   
                        </div>
                    </div>
                </form>
            </div>
        </div>';
    } else {
        $out .= '
        <div class="page-main-div-color">
            <div class="searchfilter-homepage-variation-2">
                <div>
                    <span class="search-label">
                        '.sprintf(esc_html__('%s','dreamvilla-multiple-property'),$form_title).'
                    </span>
                    <form name="property-filter" method="post" class="search-filter-form" action="'.esc_url( get_permalink( $dreamvilla_options['Theme_Page_Property_Listing_Search'] ) ).'" >
                        <div class="search-filter-form-homepage-variation-2">
                            <div class="row">';
                                if ($layout):
                                    foreach ($layout as $key=>$value) {     
                                        switch($key) {         
                                            case 'keyword':
                                                 $out .= '
                                                <div class="col-xs-12 col-sm-6 col-md-3">
                                                    <input type="text" name="keyword" id="keyword" placeholder="'.esc_html__("Keyword","dreamvilla-multiple-property").'">
                                                </div>';
                                            break;

                                            case 'category':
                                                $out .= '
                                                <div class="col-xs-12 col-sm-6 col-md-3">
                                                    <select name="type" class="selectpicker" data-width="100%">
                                                        <option value="">'.esc_html__('All Type','dreamvilla-multiple-property').'</option>';
                                                        $property_categories = get_terms("property_category", array("orderby" => "slug", "parent" => 0, 'hide_empty' => 0) );
                                                        if ( ! empty( $property_categories ) && ! is_wp_error( $property_categories ) ){
                                                            foreach ( $property_categories as $term ) {
                                                                $out .= '<option value="'.esc_attr($term->term_id).'">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$term->name).'</option>';
                                                                dreamvilla_mp_get_category_shortcode($term->term_id,'property_category','');
                                                            }                                   
                                                        }
                                                    $out .= '
                                                    </select>
                                                </div>';
                                            break;

                                            case 'status':
                                                $out .= '
                                                <div class="col-xs-12 col-sm-6 col-md-3">
                                                    <select name="status" class="selectpicker" data-width="100%">
                                                        <option value="" selected>'.esc_html__('All Status','dreamvilla-multiple-property').'</option>
                                                        <option value="sale" >'.esc_html__('For Sale','dreamvilla-multiple-property').'</option>
                                                        <option value="rent" >'.esc_html__('For Rent','dreamvilla-multiple-property').'</option>
                                                    </select>
                                                </div>';
                                            break;

                                            case 'location':
                                                $out .= '
                                                <div class="col-xs-12 col-sm-6 col-md-3">
                                                    <select name="location" class="selectpicker" data-width="100%">
                                                        <option value="">'.esc_html__('All Location','dreamvilla-multiple-property').'</option>';
                                                        $property_categories = get_terms("location", array("orderby" => "slug", "parent" => 0, 'hide_empty' => 0) );
                                                        if ( ! empty( $property_categories ) && ! is_wp_error( $property_categories ) ){
                                                            foreach ( $property_categories as $term ) {
                                                                $out .= '<option value="'.esc_attr($term->term_id).'" >'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$term->name).'</option>';
                                                                dreamvilla_mp_get_category_shortcode($term->term_id,'location','');
                                                            }
                                                        }
                                                    $out .= '
                                                    </select>
                                                </div>';
                                            break;

                                            case 'bedrooms':
                                                $out .= '
                                                <div class="col-xs-12 col-sm-6 col-md-3">
                                                    <select name="bedroom" class="selectpicker" data-width="100%">
                                                        <option value="">'.esc_html__('All Bedrooms','dreamvilla-multiple-property').'</option>';
                                                        for ($i=1; $i <=10; $i++) {
                                                            $out .= '<option value="'.esc_attr($i).'" >'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$i).'</option>';
                                                        }
                                                    $out .= '
                                                    </select>
                                                </div>';
                                            break;

                                            case 'bathrooms':
                                                $out .= '
                                                <div class="col-xs-12 col-sm-6 col-md-3">
                                                    <select name="bathroom" class="selectpicker" data-width="100%">
                                                        <option value="">'.esc_html__('All Bathrooms','dreamvilla-multiple-property').'</option>';
                                                        for ($i=1; $i <=10; $i++) {
                                                            $out .= '<option value="'.esc_attr($i).'" >'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$i).'</option>';
                                                        }
                                                    $out .= '
                                                    </select>
                                                </div>';
                                            break;

                                            case 'garages':
                                                $out .= '
                                                <div class="col-xs-12 col-sm-6 col-md-3">
                                                    <select name="garage" class="selectpicker" data-width="100%">
                                                        <option value="">'.esc_html__('All Garages','dreamvilla-multiple-property').'</option>';
                                                        for ($i=1; $i <=10; $i++) {
                                                            $out .= '<option value="'.esc_attr($i).'" >'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$i).'</option>';
                                                        }
                                                    $out .= '
                                                    </select>
                                                </div>';
                                            break;

                                            case 'price':
                                                $out .= '
                                                <div class="col-xs-12 col-sm-6 col-md-3">
                                                    <div id="property-price-range"></div>
                                                    <input type="text" id="amount" name="price" readonly style="border:0; color:#f6931f; font-weight:bold;">';
                                                    $sprice = '';
                                                    if( isset($_GET["sprice"]))
                                                        $sprice = $_GET["sprice"];
                                                    else
                                                        $sprice = '';

                                                    $eprice = '';
                                                    if( isset($_GET["eprice"]))
                                                        $eprice = $_GET["eprice"];
                                                    else
                                                        $eprice = '';

                                                    $out .= '
                                                    <input type="hidden" id="sprice" name="sprice" value="'.$sprice.'">
                                                    <input type="hidden" id="eprice" name="eprice" value="'.$eprice.'">
                                                </div>';
                                            break;                                        
                                        }
                                    }
                                endif;

                                $out .= '</div>';
                                                   
                                $flag = true;
                                if ($layout):
                                    foreach ($layout as $key=>$value) {     
                                        switch($key) {         
                                            case 'more_filter':
                                            $out .= '
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div class="filter-footer"></div>
                                                </div>
                                                <div class="col-xs-6 col-sm-4 col-md-2">
                                                    <span class="more-filter" id="more-filter">
                                                        '.esc_html__('More Filters','dreamvilla-multiple-property').' <i class="glyphicon glyphicon-triangle-bottom"> </i>
                                                    </span>
                                                </div>
                                                <div class="col-xs-6 col-sm-5 col-md-3 pull-right">
                                                    <button class="submit-filter">'.sprintf(esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options["dreamvilla_search_button_title"]).'</button>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12" id="more-filter-options">
                                                    <div class="row">';
                                                        $property_features = get_terms("features", array("orderby" => "name", "parent" => 0, 'hide_empty' => 0) );
                                                        if ( ! empty( $property_features ) && ! is_wp_error( $property_features ) ){
                                                            foreach ( $property_features as $term ) {
                                                                $out .= '
                                                                <div class="col-xs-12 col-sm-4 col-md-3 option">
                                                                    <input id="'.esc_attr($term->slug).'" type="checkbox" name="features[]" value="'.esc_attr($term->term_id).'" >
                                                                    <label for="'.esc_attr($term->slug).'">'.sprintf( esc_html__('%s','dreamvilla-multiple-property'),$term->name).' '. '(' . $term->count . ')'.'</label>
                                                                </div>';
                                                            }                        
                                                        }
                                                    $out .= '
                                                    </div>
                                                </div>
                                            </div>';
                                            $flag = false;
                                            break;                                        
                                        }
                                    }
                                endif;

                                if( $flag ){
                                    $out .= '
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="filter-footer"></div>
                                        </div>
                                        <div class="col-xs-6 col-sm-4 col-md-2">                                                
                                        </div>
                                        <div class="col-xs-6 col-sm-5 col-md-3 pull-right">
                                            <button class="submit-filter">'.sprintf(esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options["dreamvilla_search_button_title"]).'</button>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12" id="more-filter-options">                                                
                                        </div>
                                    </div>';
                                }
                            $out .= '
                        </div>
                    </form>
                </div>
            </div>
        </div>';
    }

    return $out;
}
add_shortcode("property_filter", "dreamvilla_property_filter_shortcode");

?>