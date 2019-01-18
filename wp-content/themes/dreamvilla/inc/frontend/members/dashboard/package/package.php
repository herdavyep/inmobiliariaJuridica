<div class="DiningRoom inner-page-gallery-two-columns-dimension-detail">
    <div class="package-section">
        <div class="ajax-message"></div>
        <?php 
        
        global $dreamvilla_options;

        $User_ID                = get_current_user_id();
        $Current_User_Detail    = get_user_meta( $User_ID );
        $active_package_detail  = get_user_meta( $User_ID, 'package_detail' );
        $Used_Free_Package      = get_user_meta( $User_ID, 'free_package_detail', true );

        if( !empty( $active_package_detail ) ){
            
            $Total_List      = get_post_meta( $active_package_detail[0]['id'], 'packagelist', true );
            $Total_Featured  = get_post_meta( $active_package_detail[0]['id'], 'packagefeatured', true );
            $Package_Type    = get_post_meta( $active_package_detail[0]['id'], 'packagetype', true );

            $Remain_List     = $active_package_detail[0]['list_item_remain'];
            $Remain_Featured = $active_package_detail[0]['featured_item_remain'];
            
            if( empty($Total_List) || $Total_List == 0 )
                $Total_List = "Unlimited listings";
            
            if( empty($Total_Featured) || $Total_Featured == 0 )
                $Total_List = "Unlimited Featured";

            if( ( empty($Remain_List) || $Remain_List == 0 ) && $Remain_List != "done" )
                $Remain_List = "Unlimited";

            if( $Remain_List == "done" )
                $Remain_List = 0;
            
            if( ( empty($Remain_Featured) || $Remain_Featured == 0 ) && $Remain_Featured != "done" )
                $Remain_Featured = "Unlimited";
            
            if( $Remain_Featured == "done" )
                $Remain_Featured = 0;

            if( isset($active_package_detail[0]['expiry_date']) && ( $active_package_detail[0]['expiry_date'] == "0" || $active_package_detail[0]['expiry_date'] == "")  ){ 
                $Expiry_Date = "Unlimited";
            } else {
                $Expiry_Date = $active_package_detail[0]['expiry_date'];
            } ?>
            <div class="current-package-section">
                <div class="current-page-title">
                    <?php esc_html_e('Your current package:','dreamvilla-multiple-property'); ?>
                    <span><?php printf( esc_html__('%s','dreamvilla-multiple-property'),get_the_title($active_package_detail[0]['id']) ); ?></span>
                </div>
                <ul class="package-feature-list">
                    <li><img src="<?php echo get_template_directory_uri(); ?>/inc/frontend/images/liarrow.png" alt="Arrow"><lable><?php printf( esc_html__('Listings Included: %s','dreamvilla-multiple-property'),$Total_List ); ?></lable></li>
                    <li><img src="<?php echo get_template_directory_uri(); ?>/inc/frontend/images/liarrow.png" alt="Arrow"><lable><?php printf( esc_html__('Featured Included: %s','dreamvilla-multiple-property'),$Total_Featured ); ?></lable></li>
                    <li><img src="<?php echo get_template_directory_uri(); ?>/inc/frontend/images/liarrow.png" alt="Arrow"><lable><?php printf( esc_html__('Listings Remaining: %s','dreamvilla-multiple-property'), $Remain_List); ?></lable></li>
                    <li><img src="<?php echo get_template_directory_uri(); ?>/inc/frontend/images/liarrow.png" alt="Arrow"><lable><?php printf( esc_html__('Featured Remaining: %s','dreamvilla-multiple-property'), $Remain_Featured); ?></lable></li>
                    <?php if( $Package_Type != "per_listing" ){ ?>
                    <li><img src="<?php echo get_template_directory_uri(); ?>/inc/frontend/images/liarrow.png" alt="Arrow"><lable><?php printf( esc_html__('Expired On: %s','dreamvilla-multiple-property'), $Expiry_Date); ?></lable></li>
                    <?php } ?>
                </ul>                
            </div><?php
        } ?>
        <div class="choose-package-section">            
            <h2><?php esc_html_e('CHOOSE A PACKAGE:','dreamvilla-multiple-property'); ?></h2>
            <h3><?php esc_html_e('SELECT THE PACKAGES AND START ADDING YOUR PROPERTIES','dreamvilla-multiple-property'); ?></h3>
            <ul class="package-plan-list"><?php                
                $args = array(
                    'post_type'      => 'package',
                    'posts_per_page' => -1,
                    'order'          => 'ASC'                  
                );
                $package_list = new WP_Query( $args );

                if($package_list->have_posts()){
                    while($package_list->have_posts()):$package_list->the_post();
                        
                        $Package_Type           = get_post_meta( $package_list->post->ID, 'packagetype', true );
                        $Package_Price_Label    = get_post_meta( $package_list->post->ID, 'packagepricelabel', true );
                        $Package_Price          = get_post_meta( $package_list->post->ID, 'packageprice', true );
                        $Package_Time_Label     = get_post_meta( $package_list->post->ID, 'packagetimelabel', true );
                        $Package_Time_Day       = get_post_meta( $package_list->post->ID, 'packagetimeday', true );                        
                        $Package_List_Label     = get_post_meta( $package_list->post->ID, 'packagelistlabel', true );
                        $Package_List           = get_post_meta( $package_list->post->ID, 'packagelist', true );
                        $Package_Featured_Label = get_post_meta( $package_list->post->ID, 'packagefeaturedlabel', true );
                        $Package_Featured       = get_post_meta( $package_list->post->ID, 'packagefeatured', true );
                        $Package_Free           = get_post_meta( $package_list->post->ID, 'packagefree', true ); ?>
                        
                        <li>
                            <div class="package-plan-header">
                                <div class="plan-title"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$package_list->post->post_title); ?></div>
                                <div class="plan-price"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$Package_Price_Label); ?></div>
                            </div>
                            <div class="package-plan-body">
                                <?php if( $Package_Type != "per_listing" ){ ?>
                                    <p><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$Package_Time_Label); ?></p>
                                <?php } ?>
                                <p><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$Package_List_Label); ?></p>
                                <p><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$Package_Featured_Label); ?></p>
                                <?php if( $Package_Free == "yes" ){ ?>
                                    <a href="javascript:void(0);" data-id="<?php echo $package_list->post->ID; ?>" class="<?php if( $Used_Free_Package == $package_list->post->ID ){ echo "used-package"; } else { echo "free-package"; } ?> plan-book-now"><?php esc_html_e('Book Now','dreamvilla-multiple-property'); ?></a><?php
                                } else {
                                    $Current_Package = '';
                                    $Package_Status  = '';
                                    
                                    if( isset($active_package_detail) && !empty($active_package_detail) ){
                                        $Current_Package = $active_package_detail[0]['id'];
                                        $Package_Status  = $active_package_detail[0]['status'];
                                    }
                                    if( $Package_Status == "active" && $Current_Package == $package_list->post->ID ){ ?>
                                        <a href="javascript:void(0);" data-id="<?php echo $package_list->post->ID; ?>" class="used-package plan-book-now"><?php esc_html_e('Book Now','dreamvilla-multiple-property'); ?></a><?php
                                    } else { ?>

                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#<?php echo esc_attr($package_list->post->ID); ?>" class="plan-book-now"><?php esc_html_e('BOOK NOW','dreamvilla-multiple-property'); ?></a>
                                        <!-- Modal -->
                                        <div id="<?php echo esc_attr($package_list->post->ID); ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog add-single-property-model">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['dreamvilla_mp_model_title']); ?></h4>
                                                    </div>
                                                    <div class="modal-body"><?php
                                                        if( $dreamvilla_options['dreamvilla_mp_paypal_payment'] == 1 ){
                                                            dreamvilla_mp_payment_button($package_list->post->ID,$User_ID);
                                                        }                                        
                                                        if( $dreamvilla_options['enable_stripe'] == 1 ){
                                                            dreamvilla_show_stripe_form($package_list->post->ID, $User_ID);
                                                        } ?>
                                                    </div>                                            
                                                </div>
                                            </div>
                                        </div><?php
                                    }
                                } ?>
                            </div>
                        </li><?php

                    endwhile;
                 } ?>                                
            </ul>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function(){
        "use strict";        
        jQuery('.paypal-button.large').html('<i class="fa fa-paypal"></i> Pay With Paypal');
        jQuery('.stripe-button-el span').html('<i class="fa fa-credit-card"></i> Pay with Credit Card');
    });
</script>