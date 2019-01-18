<?php

global $dreamvilla_options;

$User_ID                = get_current_user_id();
$User_Detail            = get_userdata( $User_ID );
$Current_User_Detail    = get_user_meta( $User_ID );

$Property_Agent_Favorites = dreamvilla_mp_agent_favorites_property(); ?>

<div class="submit-property inner-page-gallery-two-columns-dimension-detail">
    <div class="property-listing multiple-recent-properties">
        <div class="row property-list-area"><?php
        if( !empty($Property_Agent_Favorites) ) {
            $args = array(
                    'post_type'         => 'property',
                    'posts_per_page'    => -1,
                    'include'           => $Property_Agent_Favorites,
                    'suppress_filters'  => 0
            );

            $i = 0;
            $Agent_Property = get_posts($args);

            if( $Agent_Property ){
                foreach ($Agent_Property as $key => $value) { ?>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="property-list-list" id="<?php echo esc_attr($value->ID); ?>" data-target="Residential">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-4 col-md-4 property-list-list-image">
                                        <img <?php echo dreamvilla_mp_get_device_image( $value->ID ); ?> alt="<?php printf( esc_html__('%s','dreamvilla-multiple-property'),$value->post_title); ?>" class="img-responsive">
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-8 property-list-list-info">
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <h5><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$value->post_title); ?></h5>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <label class="property-list-list-label"><?php 
                                            $property_status = get_post_meta( $value->ID, 'pstatus', true );
                                            if ( $property_status == "sale" ){
                                                printf( esc_html__('On Sale','dreamvilla-multiple-property') );
                                            } else {
                                                printf( esc_html__('On Rent','dreamvilla-multiple-property') );
                                            } ?>
                                            </label>                                
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">   
                                            <span class="recent-properties-address">
                                                <?php if( get_post_meta( $value->ID, 'pcountry', true ) || get_post_meta( $value->ID, 'pstate', true ) ){ ?>
                                                <p class="featured-properties-address"><i class="fa fa-map-marker fa-lg"> </i><?php printf( esc_html__(' %s','dreamvilla-multiple-property'),get_post_meta( $value->ID, 'pcountry', true )); if( get_post_meta( $value->ID, 'pcountry', true ) && get_post_meta( $value->ID, 'pstate', true ) ){ echo " / "; } printf( esc_html__('%s','dreamvilla-multiple-property'),get_post_meta( $value->ID, 'pstate', true )); ?></p>
                                                <?php } ?>                                    
                                            </span>
                                            
                                            <p><strong><?php esc_html_e('Posted on: ','dreamvilla-multiple-property'); ?></strong><?php echo date( "d F Y", strtotime( $value->post_date ) ); ?></p>
                                            <p><strong><?php esc_html_e('Status: ','dreamvilla-multiple-property'); ?></strong><?php printf( esc_html__('%s','dreamvilla-multiple-property'), ucfirst($value->post_status) ); ?></p>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6 property-list-list-facility">
                                            <ul>
                                                <li class="left">
                                                    <a href="javascript:void(0);" class="delete-favorites-property" data-id="<?php echo $value->ID; ?>" property-id="<?php echo $value->ID; ?>"><i class="fa fa-trash-o"></i><?php esc_html_e(' Delete','dreamvilla-multiple-property'); ?></a>
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