<?php

global $dreamvilla_options;

$User_ID                = get_current_user_id();
$User_Detail            = get_userdata( $User_ID );
$Current_User_Detail    = get_user_meta( $User_ID );

$Saved_Searches = get_user_meta( $User_ID, 'saved_searches', true ); ?>

<div class="submit-property saved-search inner-page-gallery-two-columns-dimension-detail">
    <div class="property-listing multiple-recent-properties">
        <div class="row property-list-area"><?php
        if( !empty($Saved_Searches) ) {
            
            $Saved_Searches = array_reverse($Saved_Searches, true);

            $keys = array_keys($Saved_Searches);

            $URL_Array = array();
            for($i = 0; $i < count($Saved_Searches); $i++) {
                $URL_Attributes = '';
                $URL_Sep_Flag = '';
                foreach($Saved_Searches[$keys[$i]][0] as $URL_Key => $URL_Value) {
                    if( $URL_Value ){
                        if( $URL_Sep_Flag ){
                            $URL_Sep = "&";
                        } else {
                            $URL_Sep = "?";
                        }
                        if($URL_Key == "keyword") { 
                            $URL_Attributes .= $URL_Sep."keyword=".$URL_Value;
                            $URL_Sep_Flag = true;
                        } else if($URL_Key == "type") { 
                            $URL_Attributes .= $URL_Sep."type=".$URL_Value;
                            $URL_Sep_Flag = true;
                        } else if($URL_Key == "status") { 
                            $URL_Attributes .= $URL_Sep."status=".$URL_Value;
                            $URL_Sep_Flag = true;
                        } else if($URL_Key == "location") { 
                            $URL_Attributes .= $URL_Sep."location=".$URL_Value;
                            $URL_Sep_Flag = true;
                        } else if($URL_Key == "bedroom") { 
                            $URL_Attributes .= $URL_Sep."bedroom=".$URL_Value;
                            $URL_Sep_Flag = true;
                        } else if($URL_Key == "bathroom") { 
                            $URL_Attributes .= $URL_Sep."bathroom=".$URL_Value;
                            $URL_Sep_Flag = true;
                        } else if($URL_Key == "garage") { 
                            $URL_Attributes .= $URL_Sep."garage=".$URL_Value;
                            $URL_Sep_Flag = true;
                        } else if($URL_Key == "sprice") { 
                            $URL_Attributes .= $URL_Sep."sprice=".$URL_Value;
                            $URL_Sep_Flag = true;
                        } else if($URL_Key == "eprice") {
                            $URL_Attributes .= $URL_Sep."eprice=".$URL_Value;
                            $URL_Sep_Flag = true;
                        } else if($URL_Key == "features"){
                            if( !empty($URL_Value) ){
                                foreach ($URL_Value as $features_key => $features_value) {
                                    $URL_Attributes .= $URL_Sep."features[]=".$features_value;
                                    $URL_Sep_Flag = true;
                                }
                            }
                        }                        
                    }
                }
                $URL_Array[$i] = get_permalink( $dreamvilla_options['Theme_Page_Property_Listing_Search'] ).$URL_Attributes;
            }

            for($i = 0; $i < count($Saved_Searches); $i++) { ?>
                <div class="property-list-list" id="<?php echo esc_attr($keys[$i]); ?>"><?php                    
                    foreach($Saved_Searches[$keys[$i]][0] as $key => $value) {
                        if( $value ){                            
                            if($key == "title") { ?>
                                <a href="<?php echo  $URL_Array[$i]; ?>"><h3><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$value); ?></h3></a><?php
                            } else if($key == "sprice") { ?>
                                <label><?php esc_html_e('Start Price','dreamvilla-multiple-property'); ?> : <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$value); ?></label><?php
                            } else if($key == "eprice") { ?>
                                <label><?php esc_html_e('End Price','dreamvilla-multiple-property'); ?> : <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$value); ?></label><?php
                            } else if($key == "type") { ?>
                                <label><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$key); ?> : <?php printf( esc_html__('%s','dreamvilla-multiple-property'),dreamvilla_mp_get_taxonomy_name_by_id($value,'property_category')); ?></label><?php
                            } else if($key == "location") { ?>
                                <label><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$key); ?> : <?php printf( esc_html__('%s','dreamvilla-multiple-property'),dreamvilla_mp_get_taxonomy_name_by_id($value,'location')); ?></label><?php
                            } else if($key == "features"){ ?>
                                <label><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$key); ?> : <?php
                                if( !empty($value) ){
                                    foreach ($value as $features_key => $features_value) {
                                        printf( esc_html__('%s , ','dreamvilla-multiple-property'),dreamvilla_mp_get_taxonomy_name_by_id($features_value,'features'));
                                    }
                                } ?>
                                </label><?php
                            } else { ?>
                                <label><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$key); ?> : <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$value); ?></label><?php
                            }
                        }                        
                    } ?>
                    <a href="javascript:void(0);" class="delete-saved-searches" data-id="<?php echo $keys[$i]; ?>"><i class="fa fa-trash-o"></i></a>
                </div><?php
            }
        } ?>
        </div>
    </div>
</div>