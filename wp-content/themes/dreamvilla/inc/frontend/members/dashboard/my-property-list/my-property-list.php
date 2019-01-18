<?php

global $dreamvilla_options;

$User_ID                = get_current_user_id();
$User_Detail            = get_userdata( $User_ID );
$Current_User_Detail    = get_user_meta( $User_ID );
$Redirect_URL  = "";
if( isset($Current_User_Detail['pagentproperty'][0]) ){                            
    $Property_Agent_Properties = get_user_meta( $User_ID, 'pagentproperty', true );
} ?>
<div class="submit-property inner-page-gallery-two-columns-dimension-detail">
    <div class="property-listing multiple-recent-properties"><?php
        // Messages for addition, updateand deletion
        if ( isset( $_GET['property-deleted'] ) && ( $_GET['property-deleted'] == true ) ) {        

            echo '<p>Property Removed Successfully!</p>';            

        } else if ( isset( $_GET['property-submited'] ) && ( $_GET['property-submited'] == true ) ) {

            echo '<p>Property Added Successfully!</p>';

        } else if ( isset( $_GET['property-updated'] ) && ( $_GET['property-updated'] == true ) ) {

            echo '<p>Property Updated Successfully!</p>';            

        } ?>
        <div class="row property-list-area"><?php
        if( !empty($Property_Agent_Properties) ) {
            $args = array(
                    'post_type'         => 'property',
                    'posts_per_page'    => -1,
                    'post_status'       => 'any',
                    'include'           => $Property_Agent_Properties,
                    'suppress_filters'  => 0
            );

            $i = 0;
            $Agent_Property = get_posts($args);

            if( $Agent_Property ){
                foreach ($Agent_Property as $key => $value) { ?>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="property-list-list" data-target="Residential">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-4 col-md-4 property-list-list-image">
                                        <img <?php echo dreamvilla_mp_get_device_image( $value->ID ); ?> alt="<?php printf( esc_html__('%s','dreamvilla-multiple-property'),$value->post_title); ?>" class="img-responsive">
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-8 property-list-list-info">
                                        <div class="col-xs-12 col-sm-9 col-md-9">
                                            <h5><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$value->post_title); ?></h5>
                                        </div>
                                        <div class="col-xs-12 col-sm-3 col-md-3">
                                            <label class="property-list-list-label"><?php 
                                            $property_status = get_post_meta( $value->ID, 'pstatus', true );
                                            if ( $property_status == "sale" ){
                                                printf( esc_html__('Venta','dreamvilla-multiple-property') );
                                            } else {
                                                printf( esc_html__('Alquiler','dreamvilla-multiple-property') );
                                            } ?>
                                            </label>                                
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">   
                                            <span>
                                                <?php if( get_post_meta( $value->ID, 'pcountry', true ) || get_post_meta( $value->ID, 'pstate', true ) ){ ?>
                                                <p class="featured-properties-address"><i class="fa fa-map-marker fa-lg"> </i><?php printf( esc_html__(' %s','dreamvilla-multiple-property'),get_post_meta( $value->ID, 'pcountry', true )); if( get_post_meta( $value->ID, 'pcountry', true ) && get_post_meta( $value->ID, 'pstate', true ) ){ echo " / "; } printf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $value->ID, 'pstate', true )); ?></p>
                                                <?php } ?>                                    
                                            </span>
                                            <p class="recent-properties-price">
                                                <?php
                                                $property_price = get_post_meta( $value->ID, 'pprice', true );
                                                if( $property_price[0] ){
                                                    if( $property_status == "sale" ){
                                                        printf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
                                                    } else {
                                                        printf( esc_html__('%s','dreamvilla-multiple-property'),$property_price[0]);
                                                        echo '<span class="price-label">';
                                                            printf( esc_html__(' / %s','dreamvilla-multiple-property'),strtoupper($property_price[1]));
                                                        echo '</span>';
                                                    }
                                                } ?></p>
                                            <p><strong><?php esc_html_e('Posted on: ','dreamvilla-multiple-property'); ?></strong><?php echo date( "d F Y", strtotime( $value->post_date ) ); ?></p>
                                            <p><strong><?php esc_html_e('Status: ','dreamvilla-multiple-property'); ?></strong><?php printf( esc_html__('%s','dreamvilla-multiple-property'), ucfirst($value->post_status) ); ?></p>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6 property-list-list-facility">
                                            <ul>
                                                <li class="left"><?php
                                                    if( !empty( $dreamvilla_options[ 'user_dashboard_submit_property' ]  ) ) {
                                                        $Properties_List_URL = get_permalink( $dreamvilla_options[ 'user_dashboard_submit_property' ] );
                                                        if ( !empty( $Properties_List_URL ) ) {
                                                            $URL_Separator = ( parse_url( $Properties_List_URL, PHP_URL_QUERY ) == NULL ) ? '?' : '&';
                                                            $URL_Parameter = 'action=edit&property_id='.$value->ID;
                                                            $Redirect_URL = $Properties_List_URL . $URL_Separator . $URL_Parameter;
                                                        }
                                                    } ?>
                                                    <a href="<?php echo esc_url($Redirect_URL); ?>"><i class="fa fa-pencil-square-o"></i><?php esc_html_e('Edit','dreamvilla-multiple-property'); ?></a></li>
                                            </ul>
                                            <ul>
                                                <li class="left">
                                                    <a href="javascript:void(0);" class="delete-property" property-id="<?php echo $value->ID; ?>" agent-id="<?php echo $User_ID; ?>"><i class="fa fa-trash-o"></i><?php esc_html_e(' Delete','dreamvilla-multiple-property'); ?>
                                                </li>
                                            </ul>
                                            <ul>
                                                <li class="left"><?php
                                                    $property_preview_link = set_url_scheme( get_permalink( $value->ID ) );
                                                    $property_preview_link = apply_filters( 'preview_post_link', add_query_arg( 'preview', 'true', $property_preview_link ) );
                                                    if ( !empty( $property_preview_link ) ) {
                                                        ?><i class="fa fa-eye"></i><a target="_blank" href="<?php echo esc_url( $property_preview_link ); ?>"><?php esc_html_e(' View','dreamvilla-multiple-property'); ?></a><?php
                                                    } ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><?php
                }
            }
        } ?>
        </div>
    </div>
</div>