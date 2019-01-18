<?php

global $dreamvilla_options;

$User_ID                = get_current_user_id();
$User_Detail            = get_userdata( $User_ID );
$Current_User_Detail    = get_user_meta( $User_ID );

$active_package_detail  = get_user_meta( $User_ID, 'package_detail' );
$single_property_detail = get_user_meta( $User_ID, 'add_single_property', true );

?>
<div class="submit-property inner-page-gallery-two-columns-dimension-detail">
    <?php

    if( isset($Current_User_Detail['pagentproperty'][0]) ){                            
        $Agent_Property_List = get_user_meta( $User_ID, 'pagentproperty' );
        $Property_Agent_Properties = array();
        
        foreach ($Agent_Property_List[0] as $key => $value) {
            $Property_Agent_Properties[$key] = $Agent_Property_List[0][$key];
        }
    }

    if( isset($_GET['action']) && isset($_GET['property_id']) && $_GET['action'] == "edit" ){ 
        if( isset($_GET['property_id']) && in_array($_GET['property_id'], $Property_Agent_Properties) ){
            $Property_ID        = $_GET['property_id'];
            $Property_Detail    = get_post( $_GET['property_id'] ); 

            $PropertyPrice = get_post_meta( $Property_ID, 'pprice', true );
            if( isset($PropertyPrice[0]) )
                $Property_Price = $PropertyPrice[0];

            if( isset($PropertyPrice[1]) )
                $Property_Price_Type = $PropertyPrice[1];

            $PropertyBanner     = get_post_meta( $Property_ID, 'propertybannerimage', true );
            $Property_Address   = get_post_meta( $Property_ID, 'paddress', true );
            $Property_City      = get_post_meta( $Property_ID, 'pcity', true );
            $Property_State     = get_post_meta( $Property_ID, 'pstate', true );
            $Property_Country   = get_post_meta( $Property_ID, 'pcountry', true );
            $Property_Pincode   = get_post_meta( $Property_ID, 'ppincode', true );
            $Property_LatLon    = get_post_meta( $Property_ID, 'platlon', true );
            if( isset($Property_LatLon[0]) )
                $Property_Lat = $Property_LatLon[0];

            if( isset($Property_LatLon[1]) )
                $Property_Lon = $Property_LatLon[1];


            $PropertySBuilupArea = get_post_meta( $Property_ID, 'psbuilduparea', true );
            if( isset($PropertySBuilupArea[0]) )
                $Property_SBuilup_Area = $PropertySBuilupArea[0];

            if( isset($PropertySBuilupArea[1]) )
                $Property_SBuilup_Area_In = $PropertySBuilupArea[1];            
            
            $PropertyFlooring           = get_post_meta( $Property_ID, 'pflooring', true);
            $PropertyGoodsIncluded      = get_post_meta( $Property_ID, 'pgoodsincluded', true);
            ?>
            <form name="submit-property-form" id="submit-property-form" class="submit-property-form" enctype="multipart/form-data" method="post">
                <input type="hidden" name="property_action" class="property_action" value="edit">
                <input type="hidden" name="property_id" value="<?php echo esc_attr($Property_ID); ?>" >
                <div class="property-description-form">
                    <div class="">
                        <div class="row">
                            <div class="col-xs-12 col-sm-9 col-md-9">
                                <h3><?php esc_html_e('Property Description &amp; Price','dreamvilla-multiple-property'); ?></h3>
                                <div class="contianer-fluid">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <input type="text" name="ptitle" value="<?php echo esc_attr($Property_Detail->post_title); ?>" class="required" placeholder="<?php esc_html_e("*Title (mandatory)","dreamvilla-multiple-property"); ?>" title="<?php esc_html_e('Property Title Is Required.', 'dreamvilla-multiple-property'); ?>" />
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <textarea  name="pdescription" class="required" placeholder="<?php esc_html_e("*Description (mandatory)","dreamvilla-multiple-property"); ?>" title="<?php esc_html_e('Property Description Is Required.', 'dreamvilla-multiple-property'); ?>"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$Property_Detail->post_content); ?></textarea>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <input type="text" value="<?php echo esc_attr($Property_Price); ?>" name="pprice" class="required" placeholder="<?php esc_html_e("*Price in $","dreamvilla-multiple-property"); ?>" title="<?php esc_html_e('Property Price Is Required.', 'dreamvilla-multiple-property'); ?>" />
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <input type="text" value="<?php echo esc_attr($Property_Price_Type); ?>" name="ppricetype" placeholder="<?php esc_html_e("After Price Label (ex: 'per month')","dreamvilla-multiple-property"); ?>" />
                                        </div>                            
                                    </div>
                                </div>                   

                                <h3 class="hr"><?php esc_html_e('Listing Media','dreamvilla-multiple-property'); ?></h3>
                                
                                <div class="form-option">
                                    <div id="property-gallery-container" class="clearfix"><?php 
                                        
                                        $Featured_Image_ID = get_post_thumbnail_id( $Property_ID );
                                        if( isset($Featured_Image_ID) && !empty($Featured_Image_ID) ){ ?>
                                            <div class="gallery-thumb" id="holder-o_1ahtn9vjtr6ee3h1cug1hrnd2ub<?php echo $Featured_Image_ID; ?>">
                                                <img <?php echo dreamvilla_mp_get_device_image( $Property_ID ); ?> alt="featured-image" >                                                
                                                <a href="#remove-image" data-attachment-id="<?php echo esc_attr($Featured_Image_ID); ?>" data-property-id="0" class="remove-image"><i class="fa fa-trash-o"></i></a>
                                                <a href="#mark-featured" data-attachment-id="<?php echo esc_attr($Featured_Image_ID); ?>" data-property-id="0" class="mark-featured"><i class="fa fa-star"></i></a>
                                                <input type="hidden" value="<?php echo esc_attr($Featured_Image_ID); ?>" name="property_gallery[]" class="gallery-image-id">
                                                <input type="hidden" value="<?php echo esc_attr($Featured_Image_ID); ?>" name="featured_image_id" class="featured-img-id">
                                            </div><?php
                                        }

                                        $PropertyGallery = get_post_meta( $Property_ID, 'propertygallery', true );
                                        if( isset($PropertyGallery) && !empty($PropertyGallery) ){ 
                                            foreach ($PropertyGallery as $key => $value) {
                                                if( $PropertyGallery[$key]['pgallery'] ){
                                                    $Attachment_ID = dreamvilla_mp_get_image_id($PropertyGallery[$key]['pgallery']); ?>                                                
                                                    <div class="gallery-thumb" id="holder-o_1ahtn9vjtr6ee3h1cug1hrnd2ub<?php echo $Attachment_ID; ?>">
                                                        <img src="<?php echo esc_attr($PropertyGallery[$key]['pgallery']); ?>" alt="gallery-image" >
                                                        <a href="#remove-image" data-attachment-id="<?php echo esc_attr($Attachment_ID); ?>" data-property-id="0" class="remove-image"><i class="fa fa-trash-o"></i></a>
                                                        <a href="#mark-featured" data-attachment-id="<?php echo esc_attr($Attachment_ID); ?>" data-property-id="0" class="mark-featured"><i class="fa fa-star-o"></i></a>
                                                        <input type="hidden" value="<?php echo esc_attr($Attachment_ID); ?>" name="property_gallery[]" class="gallery-image-id">
                                                    </div><?php
                                                }
                                            }
                                        } ?>
                                    </div>
                                    <div id="drag-and-drop">
                                        <div class="drag-drop-area text-center">
                                            <i class="fa fa-cloud-upload"></i>&nbsp;&nbsp;<?php esc_html_e('Drag and drop images here', 'dreamvilla-multiple-property'); ?>
                                            <br/>
                                            <span class="drag-or"><?php esc_html_e('OR', 'dreamvilla-multiple-property'); ?></span>
                                            <br/>
                                            <button class="select-media drag-btn" id="select-images"><?php esc_html_e('Select Media','dreamvilla-multiple-property'); ?></button>                                
                                        </div>
                                    </div>

                                    <div id="plupload-container"></div>
                                    <div id="errors-report"></div>
                                </div>

                                <p class="select-mdia-instruction"><?php esc_html_e('* At least 1 image is required for a valid submission.Minimum size is 500/500px','dreamvilla-multiple-property'); ?></p>
                                <p class="select-mdia-instruction"><?php esc_html_e('** Double click on the image to select featured.','dreamvilla-multiple-property'); ?></p>
                                <p class="select-mdia-instruction"><?php esc_html_e('*** Change images order with Drag &amp; Drop.','dreamvilla-multiple-property'); ?></p>
                                
                                <h3 class="hr"><?php esc_html_e('Listing Location','dreamvilla-multiple-property'); ?></h3>
                                <p><?php esc_html_e('*Address (mandatory)','dreamvilla-multiple-property'); ?></p>
                                <div class="contianer-fluid">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <input type="text" name="paddress" value="<?php echo esc_attr($Property_Address); ?>" class="required" id="paddress" placeholder="<?php esc_html_e("Enter Address","dreamvilla-multiple-property"); ?>" title="<?php esc_html_e('Property Address Is Required.', 'dreamvilla-multiple-property'); ?>" />
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <input type="text" name="pcity" value="<?php echo esc_attr($Property_City); ?>" class="required" id="pcity" placeholder="<?php esc_html_e("City","dreamvilla-multiple-property"); ?>" title="<?php esc_html_e('Property City Is Required.', 'dreamvilla-multiple-property'); ?>" />
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <input type="text" name="pstate" value="<?php echo esc_attr($Property_State); ?>" class="required" id="pstate" placeholder="<?php esc_html_e("State","dreamvilla-multiple-property"); ?>" title="<?php esc_html_e('Property State Is Required.', 'dreamvilla-multiple-property'); ?>" />
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <input type="text" name="pcountry" value="<?php echo esc_attr($Property_Country); ?>" class="required" id="pcountry" placeholder="<?php esc_html_e("Country","dreamvilla-multiple-property"); ?>" title="<?php esc_html_e('Property Country Is Required.', 'dreamvilla-multiple-property'); ?>" />
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <input type="text" name="ppincode" value="<?php echo esc_attr($Property_Pincode); ?>" class="required digits" id="ppincode" placeholder="<?php esc_html_e("Zip","dreamvilla-multiple-property"); ?>" title="<?php esc_html_e('Property Zip Code Is Required.', 'dreamvilla-multiple-property'); ?>" />
                                        </div>                            
                                        <div class="clearfix"></div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <a href="javascript:void(0);" class="submit-location"><?php esc_html_e('PLACE PIN WITH PROPERTY ADDRESS','dreamvilla-multiple-property'); ?></a>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div id="property_google_map" style="width:800px;height:290px;margin:25px 0;"></div>                                
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <input type="text" name="platitude" value="<?php echo esc_attr($Property_Lat); ?>" class="required" id="platitude" placeholder="<?php esc_html_e("*Latitude (for Google Maps)","dreamvilla-multiple-property"); ?>" title="<?php esc_html_e('Property Latitude Is Required.', 'dreamvilla-multiple-property'); ?>" />
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <input type="text" name="plongitude" value="<?php echo esc_attr($Property_Lon); ?>" class="required" id="plongitude" placeholder="<?php esc_html_e("*Longitude (for Google Maps)","dreamvilla-multiple-property"); ?>" title="<?php esc_html_e('Property Longitude Is Required.', 'dreamvilla-multiple-property'); ?>" />
                                        </div>                            
                                    </div>
                                </div>

                                <?php 
                                if ( !empty($dreamvilla_options['property_detail_page_variation'] ) && $dreamvilla_options['property_detail_page_variation'] == 2 ) { 
                                    $PropertyBanner = get_post_meta( $Property_ID, 'propertybannerimage', true ); ?>
                                    <h3 class="hr"><?php esc_html_e('Banner Image','dreamvilla-multiple-property'); ?></h3>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <?php if( isset($PropertyBanner) && !empty($PropertyBanner) ){ ?>
                                                <div class="gallery-thumb" id="holder-o_1ahtn9vjtr6ee3h1cug1hrnd2ub<?php echo dreamvilla_mp_get_image_id($PropertyBanner); ?>">
                                                    <img src="<?php echo esc_attr($PropertyBanner); ?>" height="25px" class="theme_favicon_icon" alt="slider">
                                                    <input type="hidden" name="property_media_id[]" class="property-media-id" value="<?php echo esc_attr(dreamvilla_mp_get_image_id($PropertyBanner)); ?>" >
                                                </div>
                                            <?php } ?>
                                            <button type="button" class="btn btn-default uploadlogo pull-right" title="Upload a image"><span class="glyphicon glyphicon-paperclip"></span></button>
                                            <input type="hidden" name="propertybannerimage" class="pbimagestore" value="<?php echo esc_attr($PropertyBanner); ?>" >
                                        </div>
                                    </div><?php 
                                } ?>

                                <h3 class="hr"><?php esc_html_e('Essential Information','dreamvilla-multiple-property'); ?></h3>
                                <div class="contianer-fluid">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <table id="addessential" class="table show-table-property" >
                                                <tbody><?php
                                                    $PropertyEssential = get_post_meta( $Property_ID, 'essentialinformation', true );
                                                    if( $PropertyEssential ){ 
                                                        foreach ($PropertyEssential as $key => $value) { ?>
                                                        <tr class="main-row">
                                                            <td>
                                                                <input type="text" placeholder="Title" name="essentialtitle[]" value="<?php echo esc_attr($PropertyEssential[$key]['essentialtitle']); ?>" class="no-margin">
                                                            </td>
                                                            <td>
                                                                <input type="text" placeholder="Description" name="essentialvalue[]" value="<?php echo esc_attr($PropertyEssential[$key]['essentialvalue']); ?>" class="no-margin">
                                                            </td>
                                                            <td class="text-right">
                                                                <button style="display: none;" class="btn btn-default removebedroom" type="button">
                                                                    <span class="glyphicon glyphicon-remove"></span>
                                                                </button>
                                                                <button class="btn btn-default addmorebedroombtn" type="button">
                                                                    <span class="glyphicon glyphicon-plus"></span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                    } else { ?>
                                                        <tr class="main-row">
                                                            <td>
                                                                <input type="text" placeholder="Title" name="essentialtitle[]" class="no-margin">
                                                            </td>
                                                            <td>
                                                                <input type="text" placeholder="Value" name="essentialvalue[]" class="no-margin">
                                                            </td>
                                                            <td class="text-right">
                                                                <button style="display: none;" class="btn btn-default removebedroom" type="button">
                                                                    <span class="glyphicon glyphicon-remove"></span>
                                                                </button>
                                                                <button class="btn btn-default addmorebedroombtn" type="button">
                                                                    <span class="glyphicon glyphicon-plus"></span>
                                                                </button>
                                                            </td>
                                                        </tr><?php 
                                                    } ?>
                                                </tbody>
                                            </table>       
                                        </div>                    
                                    </div>
                                </div>
                                <!-- <div class="contianer-fluid">
                                    <div class="contianer-fluid">
                                        <div class="row">
                                            
                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <input type="text" name="psbuilduparea" value="<?php if( isset($Property_SBuilup_Area) ){ echo esc_attr($Property_SBuilup_Area); } ?>" class="digits" placeholder="<?php esc_html_e("Super Build Up Area","dreamvilla-multiple-property"); ?>" />
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <input type="text" name="psbuildupareamessure" value="<?php if( isset($Property_SBuilup_Area_In) ){ echo esc_attr($Property_SBuilup_Area_In); } ?>" placeholder="<?php esc_html_e("Super Build Up Area Messure Ex. FT2","dreamvilla-multiple-property"); ?>" />
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <input type="text" name="pbuiltupyear" value="<?php if( $PropertyBuiltupYear ){ echo esc_attr($PropertyBuiltupYear); } ?>" class="digits" placeholder="<?php esc_html_e("Built Up Year","dreamvilla-multiple-property"); ?>" />
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <input type="text" name="pmls" value="<?php if( $PropertyMLS ){ echo esc_attr($PropertyMLS); } ?>" placeholder="<?php esc_html_e("MLS","dreamvilla-multiple-property"); ?>" />
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <input type="text" name="pfullbath" value="<?php if( $PropertyFullBath ){ echo esc_attr($PropertyFullBath); } ?>" class="digits" placeholder="<?php esc_html_e("Full Baths","dreamvilla-multiple-property"); ?>" />
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <input type="text" name="phalfbath" value="<?php if( $PropertyHalfBath ){ echo esc_attr($PropertyHalfBath); } ?>" class="digits" placeholder="<?php esc_html_e("Half Baths","dreamvilla-multiple-property"); ?>" />
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <input type="text" name="plostsoft" value="<?php if( $PropertyLostSoft ){ echo esc_attr($PropertyLostSoft); } ?>" class="digits" placeholder="<?php esc_html_e("Lost Soft Ex. 1245","dreamvilla-multiple-property"); ?>" />
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <input type="text" name="ptype" value="<?php if( $PropertyType ){ echo esc_attr($PropertyType); } ?>" placeholder="<?php esc_html_e("Type Ex. Single Family","dreamvilla-multiple-property"); ?>" />
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <input type="text" name="pstyle" value="<?php if( $PropertyStyle ){ echo esc_attr($PropertyStyle); } ?>" placeholder="<?php esc_html_e("Style Ex. Bi-Level","dreamvilla-multiple-property"); ?>" />
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <input type="text" name="pcurrentstatus" value="<?php if( $PropertyCurrentStatus ){ echo esc_attr($PropertyCurrentStatus); } ?>" placeholder="<?php esc_html_e("Status Ex. Active","dreamvilla-multiple-property"); ?>" />
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                <input type="text" name="pnoofgarage" value="<?php if( $PropertyGarage ){ echo esc_attr($PropertyGarage); } ?>" class="digits" placeholder="<?php esc_html_e("No Of Garage","dreamvilla-multiple-property"); ?>" />
                                            </div>

                                        </div>
                                    </div>
                                </div> -->

                                <h3 class="hr"><?php esc_html_e('Amenities','dreamvilla-multiple-property'); ?></h3>
                                <div class="contianer-fluid">
                                    <div class="contianer-fluid">
                                    <div class="row">    
                                        <div class="col-xs-12 col-sm-12 col-md-12">                  
                                            <table id="addamenities" class="table show-table-property">
                                                <tbody><?php
                                                $PropertyAmenities = get_post_meta( $Property_ID, 'propertyamenities', true );
                                                if( $PropertyAmenities ){ 
                                                    foreach ($PropertyAmenities as $key => $value) { ?>
                                                    <tr class="main-row">
                                                        <td>
                                                            <input type="text" placeholder="Amenities" name="pamenities[]" value="<?php echo esc_attr($PropertyAmenities[$key]['pamenities']); ?>" class="no-margin">
                                                        </td>
                                                        <td id="uploadlogoBtn_container">
                                                            <?php if( $PropertyAmenities[$key]['pamenitiesphoto'] ){ ?>
                                                                <div class="gallery-thumb" id="holder-o_1ahtn9vjtr6ee3h1cug1hrnd2ub<?php echo dreamvilla_mp_get_image_id($PropertyAmenities[$key]['pamenitiesphoto']); ?>">
                                                                    <img src="<?php echo esc_url($PropertyAmenities[$key]['pamenitiesphoto']); ?>" height="25px" class="theme_favicon_icon" alt="amenities-icon">
                                                                    <input type="hidden" name="property_media_id[]" class="property-media-id" value="<?php echo esc_attr(dreamvilla_mp_get_image_id($PropertyAmenities[$key]['pamenitiesphoto'])); ?>" >
                                                                </div>
                                                            <?php } ?>
                                                            <button type="button" id="uploadlogoBtn" class="btn btn-default uploadlogo pull-right" title="Upload a image"><span class="glyphicon glyphicon-paperclip"></span></button>
                                                            <input type="hidden" name="pamenitiesphoto[]" class="pbimagestore" value="<?php echo esc_attr(dreamvilla_mp_get_image_id($PropertyAmenities[$key]['pamenitiesphoto'])); ?>" >
                                                        </td>
                                                        <td class="text-right">
                                                            <button style="display: none;" class="btn btn-default removebedroom" type="button">
                                                                <span class="glyphicon glyphicon-remove"></span>
                                                            </button>
                                                            <button class="btn btn-default addmorebedroombtn" type="button">
                                                                <span class="glyphicon glyphicon-plus"></span>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php }
                                                } else { ?>
                                                    <tr class="main-row">
                                                        <td>
                                                            <input type="text" placeholder="Amenities" name="pamenities[]" class="no-margin">
                                                        </td>
                                                        <td id="uploadlogoBtn_container">
                                                            <button type="button" id="uploadlogoBtn" class="btn btn-default uploadlogo pull-right" title="Upload a image"><span class="glyphicon glyphicon-paperclip"></span></button>
                                                            <input type="hidden" name="pamenitiesphoto[]" class="pbimagestore" value="<?php echo esc_attr("Property_Agent_Photo"); ?>" >
                                                        </td>
                                                        <td class="text-right">
                                                            <button style="display: none;" class="btn btn-default removebedroom" type="button">
                                                                <span class="glyphicon glyphicon-remove"></span>
                                                            </button>
                                                            <button class="btn btn-default addmorebedroombtn" type="button">
                                                                <span class="glyphicon glyphicon-plus"></span>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>                              
                                                </tbody>
                                            </table>
                                        </div>              
                                    </div>
                                </div>
                                </div>

                                <h3 class="hr"><?php esc_html_e('Interior','dreamvilla-multiple-property'); ?></h3>
                                <div class="contianer-fluid">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <table id="addinterior" class="table show-table-property" >
                                                <tbody><?php
                                                    $PropertyInterior = get_post_meta( $Property_ID, 'pinteriorarray', true );
                                                    if( $PropertyInterior ){ 
                                                        foreach ($PropertyInterior as $key => $value) { ?>
                                                        <tr class="main-row">
                                                            <td>
                                                                <input type="text" placeholder="Title" name="interiortitle[]" value="<?php echo esc_attr($PropertyInterior[$key]['interiortitle']); ?>" class="no-margin">
                                                            </td>
                                                            <td>
                                                                <input type="text" placeholder="Description" name="interiordescription[]" value="<?php echo esc_attr($PropertyInterior[$key]['interiordescription']); ?>" class="no-margin">
                                                            </td>
                                                            <td class="text-right">
                                                                <button style="display: none;" class="btn btn-default removebedroom" type="button">
                                                                    <span class="glyphicon glyphicon-remove"></span>
                                                                </button>
                                                                <button class="btn btn-default addmorebedroombtn" type="button">
                                                                    <span class="glyphicon glyphicon-plus"></span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                    } else { ?>
                                                        <tr class="main-row">
                                                            <td>
                                                                <input type="text" placeholder="Title" name="interiortitle[]" class="no-margin">
                                                            </td>
                                                            <td>
                                                                <input type="text" placeholder="Description" name="interiordescription[]" class="no-margin">
                                                            </td>
                                                            <td class="text-right">
                                                                <button style="display: none;" class="btn btn-default removebedroom" type="button">
                                                                    <span class="glyphicon glyphicon-remove"></span>
                                                                </button>
                                                                <button class="btn btn-default addmorebedroombtn" type="button">
                                                                    <span class="glyphicon glyphicon-plus"></span>
                                                                </button>
                                                            </td>
                                                        </tr><?php 
                                                    } ?>
                                                </tbody>
                                            </table>       
                                        </div>                    
                                    </div>
                                </div>

                                <h3 class="hr"><?php esc_html_e('Exterior','dreamvilla-multiple-property'); ?></h3>
                                <div class="contianer-fluid">
                                    <div class="row">                            
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <table id="addexterior" class="table show-table-property" >
                                                <tbody><?php
                                                    $PropertyExterior = get_post_meta( $Property_ID, 'pexteriorarray', true );
                                                    if( $PropertyExterior ){ 
                                                        foreach ($PropertyExterior as $key => $value) { ?>
                                                        <tr class="main-row">
                                                            <td>
                                                                <input type="text" placeholder="Title" name="exteriortitle[]" value="<?php echo esc_attr($PropertyExterior[$key]['exteriortitle']); ?>" class="no-margin">
                                                            </td>
                                                            <td>
                                                                <input type="text" placeholder="Description" name="exteriordescription[]" value="<?php echo esc_attr($PropertyExterior[$key]['exteriordescription']); ?>" class="no-margin">
                                                            </td>
                                                            <td class="text-right">
                                                                <button style="display: none;" class="btn btn-default removebedroom" type="button">
                                                                    <span class="glyphicon glyphicon-remove"></span>
                                                                </button>
                                                                <button class="btn btn-default addmorebedroombtn" type="button">
                                                                    <span class="glyphicon glyphicon-plus"></span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                    } else {?>
                                                        <tr class="main-row">
                                                            <td>
                                                                <input type="text" placeholder="Title" name="exteriortitle[]" class="no-margin">
                                                            </td>
                                                            <td>
                                                                <input type="text" placeholder="Description" name="exteriordescription[]" class="no-margin">
                                                            </td>
                                                            <td class="text-right">
                                                                <button style="display: none;" class="btn btn-default removebedroom" type="button">
                                                                    <span class="glyphicon glyphicon-remove"></span>
                                                                </button>
                                                                <button class="btn btn-default addmorebedroombtn" type="button">
                                                                    <span class="glyphicon glyphicon-plus"></span>
                                                                </button>
                                                            </td>
                                                        </tr><?php 
                                                    } ?>
                                                </tbody>
                                            </table>       
                                        </div>                           
                                    </div>
                                </div>

                                <h3 class="hr"><?php esc_html_e('Dimensions','dreamvilla-multiple-property'); ?></h3>
                                <div class="contianer-fluid">
                                    <div class="row">                            
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <button type="button" id="room" class="btn btn-info" data-toggle="modal" data-target="#roommodel"><?php esc_html_e("Room","dreamvilla-multiple-property"); ?> <span class="glyphicon glyphicon-plus"></span></button>
                                                </div>

                                                <div class="col-sm-4">
                                                    <button type="button" id="bathroom" class="btn btn-info" data-toggle="modal" data-target="#bathroommodel"><?php esc_html_e("Bathroom","dreamvilla-multiple-property"); ?> <span class="glyphicon glyphicon-plus"></span></button>
                                                </div>
                                                
                                                <div class="col-sm-4">
                                                    <button type="button" id="kitchen" class="btn btn-info" data-toggle="modal" data-target="#kitchenmodel"><?php esc_html_e("Kitchen","dreamvilla-multiple-property"); ?> <span class="glyphicon glyphicon-plus"></span></button>
                                                </div>
                                                
                                                <div class="col-sm-4">
                                                    <button type="button" id="swimminpool" class="btn btn-info" data-toggle="modal" data-target="#swimmingpoolmodel"><?php esc_html_e("Swimming pool","dreamvilla-multiple-property"); ?> <span class="glyphicon glyphicon-plus"></span></button>
                                                </div>
                                                
                                                <div class="col-sm-4">
                                                    <button type="button" id="gym" class="btn btn-info" data-toggle="modal" data-target="#gymmodel"><?php esc_html_e("Gym","dreamvilla-multiple-property"); ?> <span class="glyphicon glyphicon-plus"></span></button>
                                                </div>
                                            </div>
                                        </div>                        
                                    </div>
                                </div>

                                <h3 class="hr"><?php esc_html_e('Floor Plan','dreamvilla-multiple-property'); ?></h3>
                                <div class="contianer-fluid">
                                    <div class="row">                            
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <table id="addfloorplans" class="table show-table-property">
                                                <tbody><?php
                                                    $PropertyFloors = get_post_meta( $Property_ID, 'propertyfloors', true );
                                                    if( $PropertyFloors ){ 
                                                        foreach ($PropertyFloors as $key => $value) { ?>
                                                        <tr class="main-row">
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                                                        <input type="text" placeholder="Floor title" name="floortitle[]" value="<?php echo esc_attr($PropertyFloors[$key]['floortitle']); ?>">
                                                                    </div>
                                                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                                                        <input type="text" placeholder="Price" name="floorprice[]" value="<?php echo esc_attr($PropertyFloors[$key]['floorprice']); ?>">
                                                                    </div>
                                                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                                                        <input type="text" placeholder="Squre Foot" name="floorsqrt[]" value="<?php echo esc_attr($PropertyFloors[$key]['floorsqrt']); ?>">
                                                                    </div>
                                                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                                                        <input type="text" placeholder="Bedrooms" name="floorbedrooms[]" value="<?php echo esc_attr($PropertyFloors[$key]['floorbedrooms']); ?>">
                                                                    </div>
                                                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                                                        <input type="text" placeholder="Bathrooms" name="floorbathrooms[]" value="<?php echo esc_attr($PropertyFloors[$key]['floorbathrooms']); ?>">
                                                                    </div>
                                                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                                                        <textarea placeholder="Detail" name="floordetail[]"><?php echo esc_textarea($PropertyFloors[$key]['floordetail']); ?></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                                        <?php if( $PropertyFloors[$key]['floorplanimage'] ){ ?>
                                                                            <div class="gallery-thumb" id="holder-o_1ahtn9vjtr6ee3h1cug1hrnd2ub<?php echo dreamvilla_mp_get_image_id($PropertyFloors[$key]['floorplanimage']); ?>">
                                                                                <img src="<?php echo esc_attr($PropertyFloors[$key]['floorplanimage']); ?>" height="25px" class="theme_favicon_icon" alt="slider">
                                                                                <input type="hidden" name="property_media_id[]" class="property-media-id" value="<?php echo esc_attr(dreamvilla_mp_get_image_id($PropertyFloors[$key]['floorplanimage'])); ?>" >
                                                                            </div>
                                                                        <?php } ?>
                                                                        <button type="button" class="btn btn-default uploadlogo pull-right" title="Upload a image"><span class="glyphicon glyphicon-paperclip"></span></button>
                                                                        <input type="hidden" name="floorplanimage[]" class="pbimagestore" value="<?php echo esc_attr(dreamvilla_mp_get_image_id($PropertyFloors[$key]['floorplanimage'])); ?>" >
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-right">
                                                                <button style="display: none;" class="btn btn-default removebedroom" type="button">
                                                                    <span class="glyphicon glyphicon-remove"></span>
                                                                </button>
                                                                <button class="btn btn-default addmorebedroombtn" type="button">
                                                                    <span class="glyphicon glyphicon-plus"></span>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                    } else {?>
                                                        <tr class="main-row">
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                                                        <input type="text" placeholder="Floor title" name="floortitle[]">
                                                                    </div>
                                                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                                                        <input type="text" placeholder="Price" name="floorprice[]">
                                                                    </div>
                                                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                                                        <input type="text" placeholder="Squre Foot" name="floorsqrt[]">
                                                                    </div>
                                                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                                                        <input type="text" placeholder="Bedrooms" name="floorbedrooms[]">
                                                                    </div>
                                                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                                                        <input type="text" placeholder="Bathrooms" name="floorbathrooms[]">
                                                                    </div>
                                                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                                                        <textarea placeholder="Detail" name="floordetail[]"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                                        <button type="button" class="btn btn-default uploadlogo pull-right" title="Upload a image"><span class="glyphicon glyphicon-paperclip"></span></button>
                                                                        <input type="hidden" name="floorplanimage[]" class="pbimagestore">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-right">
                                                                <button style="display: none;" class="btn btn-default removebedroom" type="button">
                                                                    <span class="glyphicon glyphicon-remove"></span>
                                                                </button>
                                                                <button class="btn btn-default addmorebedroombtn" type="button">
                                                                    <span class="glyphicon glyphicon-plus"></span>
                                                                </button>
                                                            </td>
                                                        </tr><?php
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>                        
                                    </div>
                                </div>

                                <h3 class="hr"><?php esc_html_e('Property Documents','dreamvilla-multiple-property'); ?></h3>
                                <div class="contianer-fluid">
                                    <div class="row">                            
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <table class="table show-table-property" id="addaboutdocuments">
                                                <tbody><?php
                                                $Documents = get_post_meta( $Property_ID, 'pdocuments', true );
                                                if( !empty($Documents) ){
                                                    foreach ($Documents as $key => $value) { ?>
                                                        <tr class="main-row">
                                                            <td>
                                                                <input type="text" size="6" name="pdocumentslabel[]" class="form-control" placeholder="<?php esc_html_e("Label","dreamvilla-multiple-property"); ?>"  value="<?php if( $Documents[$key]['pdocumentslabel'] ){ echo esc_attr($Documents[$key]['pdocumentslabel']); } ?>">
                                                            </td>                           
                                                            <td>
                                                                <input type="text" size="6" name="pdocumentslink[]" class="form-control" placeholder="<?php esc_html_e("Link","dreamvilla-multiple-property"); ?>"  value="<?php if( $Documents[$key]['pdocumentslabel'] ){ echo esc_attr($Documents[$key]['pdocumentslink']); } ?>">
                                                            </td>                                           
                                                            <td class="text-right">
                                                                <button type="button" class="btn btn-default removebedroom"><span class="glyphicon glyphicon-remove"></span></button>
                                                                <button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
                                                            </td>
                                                        </tr><?php
                                                    }
                                                } else { ?>
                                                    <tr class="main-row">
                                                        <td>
                                                            <input type="text" size="6" name="pdocumentslabel[]" class="form-control" placeholder="<?php esc_html_e("Label","dreamvilla-multiple-property"); ?>" >
                                                        </td>                           
                                                        <td>
                                                            <input type="text" size="6" name="pdocumentslink[]" class="form-control" placeholder="<?php esc_html_e("Link","dreamvilla-multiple-property"); ?>" >
                                                        </td>                                           
                                                        <td class="text-right">
                                                            <button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
                                                            <button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
                                                        </td>
                                                    </tr><?php
                                                } ?>
                                                </tbody>
                                            </table>
                                        </div>                       
                                    </div>
                                </div>

                                <h3 class="hr"><?php esc_html_e('Near By Place','dreamvilla-multiple-property'); ?></h3>
                                <div class="contianer-fluid">
                                    <div class="row">                            
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <table id="nearbyplaces" class="table show-table-property">
                                                <tbody><?php
                                                $Near_By_Place = get_post_meta( $Property_ID, 'google_near_by_place', true );
                                                if( $Near_By_Place ){
                                                    foreach ($Near_By_Place as $Near_By_Place_Key => $Near_By_Place_Value) { ?>
                                                    <tr class="main-row">
                                                        <td>
                                                            <select name="google_near_by_place_type[]">
                                                                <option value="">Select</option><?php
                                                                $google_places = dreamvilla_mp_google_places();
                                                                foreach ($google_places as $key => $value) { ?>
                                                                    <option value="<?php echo esc_attr($key); ?>" <?php if( $Near_By_Place[$Near_By_Place_Key]['google_near_by_place_type'] == $key ){ echo "selected=selected"; } ?> ><?php echo esc_html($value); ?></option><?php
                                                                } ?>
                                                            </select>                                       
                                                        </td>
                                                        <td>
                                                            <input type="text" placeholder="Place Label" name="google_near_by_place_label[]" value="<?php echo esc_attr($Near_By_Place[$Near_By_Place_Key]['google_near_by_place_label']); ?>" class="no-margin" size="15">
                                                        </td>
                                                        <td>
                                                            <?php if( $Near_By_Place[$Near_By_Place_Key]['google_near_by_place_icon'] ){ ?>
                                                                <div class="gallery-thumb" id="holder-o_1ahtn9vjtr6ee3h1cug1hrnd2ub<?php echo dreamvilla_mp_get_image_id($Near_By_Place[$Near_By_Place_Key]['google_near_by_place_icon']); ?>">
                                                                    <img src="<?php echo esc_attr($Near_By_Place[$Near_By_Place_Key]['google_near_by_place_icon']); ?>" height="25px" class="theme_favicon_icon" alt="amenities-icon">
                                                                    <input type="hidden" name="property_media_id[]" class="property-media-id" value="<?php echo esc_attr(dreamvilla_mp_get_image_id($Near_By_Place[$Near_By_Place_Key]['google_near_by_place_icon'])); ?>" >
                                                                </div>
                                                            <?php } ?>
                                                            <button type="button" class="btn btn-default uploadlogo pull-right" title="Upload a image"><span class="glyphicon glyphicon-paperclip"></span></button>
                                                            <input type="hidden" name="google_near_by_place_icon[]" class="pbimagestore" value="<?php echo esc_attr(dreamvilla_mp_get_image_id($Near_By_Place[$Near_By_Place_Key]['google_near_by_place_icon'])); ?>" >
                                                        </td>
                                                        <td class="text-right">
                                                            <button style="display: none;" class="btn btn-default removebedroom" type="button">
                                                                <span class="glyphicon glyphicon-remove"></span>
                                                            </button>
                                                            <button class="btn btn-default addmorebedroombtn" type="button">
                                                                <span class="glyphicon glyphicon-plus"></span>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php }
                                                    } else { ?>
                                                    <tr class="main-row">
                                                        <td>
                                                            <select name="google_near_by_place_type[]">
                                                                <option value="">Select</option><?php
                                                                $google_places = dreamvilla_mp_google_places();
                                                                foreach ($google_places as $key => $value) { ?>
                                                                    <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option><?php
                                                                } ?>                                        
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" placeholder="Place Label" name="google_near_by_place_label[]" class="no-margin" size="15" >
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-default uploadlogo pull-right" title="Upload a image"><span class="glyphicon glyphicon-paperclip"></span></button>
                                                            <input type="hidden" name="google_near_by_place_icon[]" class="pbimagestore" value="" >
                                                        </td>
                                                        <td class="text-right">
                                                            <button style="display: none;" class="btn btn-default removebedroom" type="button">
                                                                <span class="glyphicon glyphicon-remove"></span>
                                                            </button>
                                                            <button class="btn btn-default addmorebedroombtn" type="button">
                                                                <span class="glyphicon glyphicon-plus"></span>
                                                            </button>
                                                        </td>
                                                    </tr><?php 
                                                } ?>
                                            </table>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <p><?php echo esc_html_e( 'Enter your custom near by places as per your choice.', 'dreamvilla-multiple-property'); ?></p>
                                            <table id="nearbycustomplaces" class="table show-table-property">
                                                <tbody><?php
                                                    $Near_By_Custom_Place = get_post_meta( $Property_ID, 'google_near_by_custom_place', true );
                                                    if( $Near_By_Custom_Place ){
                                                        foreach ($Near_By_Custom_Place as $Near_By_Custom_Place_Key => $Near_By_Custom_Place_Value) { ?>
                                                        <tr class="main-row">
                                                            <td>
                                                                <input type="text" placeholder="Place Label" name="google_near_by_custom_place_label[]" value="<?php echo esc_attr($Near_By_Custom_Place[$Near_By_Custom_Place_Key]['google_near_by_custom_place_label']); ?>" class="no-margin" size="10">                             
                                                            </td>
                                                            <td>
                                                                <textarea placeholder="Detail" cols="10" name="google_near_by_custom_place_detail[]" class="no-margin"><?php echo esc_attr($Near_By_Custom_Place[$Near_By_Custom_Place_Key]['google_near_by_custom_place_detail']); ?></textarea>
                                                            </td>
                                                            <td>
                                                                <input type="text" placeholder="Latitude" name="google_near_by_custom_place_latitude[]" value="<?php echo esc_attr($Near_By_Custom_Place[$Near_By_Custom_Place_Key]['google_near_by_custom_place_latitude']); ?>" class="no-margin" size="5">
                                                            </td>
                                                            <td>
                                                                <input type="text" placeholder="Longitude" name="google_near_by_custom_place_longitude[]" value="<?php echo esc_attr($Near_By_Custom_Place[$Near_By_Custom_Place_Key]['google_near_by_custom_place_longitude']); ?>" class="no-margin" size="5">
                                                            </td>
                                                            <td>
                                                                <?php if( $Near_By_Custom_Place[$Near_By_Custom_Place_Key]['google_near_by_custom_place_icon'] ){ ?>
                                                                    <div class="gallery-thumb" id="holder-o_1ahtn9vjtr6ee3h1cug1hrnd2ub<?php echo dreamvilla_mp_get_image_id($Near_By_Custom_Place[$Near_By_Custom_Place_Key]['google_near_by_custom_place_icon']); ?>">
                                                                        <img src="<?php echo esc_attr($Near_By_Custom_Place[$Near_By_Custom_Place_Key]['google_near_by_custom_place_icon']); ?>" height="25px" class="theme_favicon_icon" alt="amenities-icon">
                                                                        <input type="hidden" name="property_media_id[]" class="property-media-id" value="<?php echo esc_attr(dreamvilla_mp_get_image_id($Near_By_Custom_Place[$Near_By_Custom_Place_Key]['google_near_by_custom_place_icon'])); ?>" >
                                                                    </div>
                                                                <?php } ?>
                                                                <button type="button" class="btn btn-default uploadlogo pull-right" title="Upload a image"><span class="glyphicon glyphicon-paperclip"></span></button>
                                                                <input type="hidden" name="google_near_by_custom_place_icon[]" class="pbimagestore" value="<?php echo esc_attr(dreamvilla_mp_get_image_id($Near_By_Custom_Place[$Near_By_Custom_Place_Key]['google_near_by_custom_place_icon'])); ?>" >
                                                            </td>
                                                            <td class="text-right">
                                                                <button style="display: none;" class="btn btn-default removebedroom" type="button">
                                                                    <span class="glyphicon glyphicon-remove"></span>
                                                                </button>
                                                                <button class="btn btn-default addmorebedroombtn" type="button">
                                                                    <span class="glyphicon glyphicon-plus"></span>
                                                                </button>
                                                            </td>
                                                        </tr><?php
                                                        }
                                                    } else { ?>
                                                        <tr class="main-row">
                                                            <td>
                                                                <input type="text" placeholder="Place Label" name="google_near_by_custom_place_label[]" class="no-margin" size="10">
                                                            </td>
                                                            <td>
                                                                <textarea placeholder="Detail" cols="10" name="google_near_by_custom_place_detail[]" class="no-margin"></textarea>
                                                            </td>
                                                            <td>
                                                                <input type="text" placeholder="Latitude" name="google_near_by_custom_place_latitude[]" class="no-margin" size="5">
                                                            </td>
                                                            <td>
                                                                <input type="text" placeholder="Longitude" name="google_near_by_custom_place_longitude[]" class="no-margin" size="5">
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-default uploadlogo pull-right" title="Upload a image"><span class="glyphicon glyphicon-paperclip"></span></button>
                                                                <input type="hidden" name="google_near_by_custom_place_icon[]" class="pbimagestore" value="" >
                                                            </td>
                                                            <td class="text-right">
                                                                <button style="display: none;" class="btn btn-default removebedroom" type="button">
                                                                    <span class="glyphicon glyphicon-remove"></span>
                                                                </button>
                                                                <button class="btn btn-default addmorebedroombtn" type="button">
                                                                    <span class="glyphicon glyphicon-plus"></span>
                                                                </button>
                                                            </td>
                                                        </tr><?php 
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>                           
                                    </div>
                                </div>


                                <h3 class="hr"><?php esc_html_e('Other','dreamvilla-multiple-property'); ?></h3>
                                <div class="contianer-fluid">
                                    <div class="row">                            
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <textarea name="pflooring" placeholder="<?php esc_html_e("Flooring Detail","dreamvilla-multiple-property"); ?>"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$PropertyFlooring); ?></textarea>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <textarea name="pgoodsincluded" placeholder="<?php esc_html_e("Goods Included Detail","dreamvilla-multiple-property"); ?>"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$PropertyGoodsIncluded); ?></textarea>
                                        </div>                                        
                                    </div>
                                </div>

                                <h3 class="hr"><?php esc_html_e('PROPERTY STREET VIEW','dreamvilla-multiple-property'); ?></h3>
                                <div class="contianer-fluid">
                                    <div class="row">                            
                                        <!-- start our custom code -->
                                        <?php
                                            $Propertystreetviewlat   = get_post_meta( $Property_ID, 'streetviewlat', true);    
                                            $Propertystreetviewlng   = get_post_meta( $Property_ID, 'streetviewlng', true);
                                        ?>
                                        <div class="clearfix"></div>

                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <input type="text" name="prostreetviewlat" value="<?php echo esc_attr($Propertystreetviewlat); ?>" id="prostreetviewlat" placeholder="<?php esc_html_e("*Latitude (for Google Maps Street View)","dreamvilla-multiple-property"); ?>" title="<?php esc_html_e('Property Streetview Latitude Is Required.', 'dreamvilla-multiple-property'); ?>" />
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <input type="text" name="prostreetviewlng" value="<?php echo esc_attr($Propertystreetviewlng); ?>" id="prostreetviewlng" placeholder="<?php esc_html_e("*Longitude (for Google Maps Street View)","dreamvilla-multiple-property"); ?>" title="<?php esc_html_e('Property Steetview Longitude Is Required.', 'dreamvilla-multiple-property'); ?>" />
                                        </div>                        
                                        <!-- end our custom code -->                                        
                                    </div>
                                </div>
                                <div class="contianer-fluid">
                                    <div class="row">                            
                                        <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:50px;">
                                            <input type="submit" class="select-media" value="<?php esc_html_e('Save Changes','dreamvilla-multiple-property'); ?>">
                                            <?php wp_nonce_field('dreamvilla-ajax-submit-property-nonce', 'submit-property-security'); ?>
                                            <p class="status"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-3 col-md-3 ">
                                <div class="membership-info"><?php
                                    if( !empty($active_package_detail) ){
                                        $Total_List      = get_post_meta( $active_package_detail[0]['id'], 'packagelist', true );
                                        $Total_Featured  = get_post_meta( $active_package_detail[0]['id'], 'packagefeatured', true );
                                        $Package_Type    = get_post_meta( $active_package_detail[0]['id'], 'packagetype', true );

                                        $Remain_List     = $active_package_detail[0]['list_item_remain'];
                                        $Remain_Featured = $active_package_detail[0]['featured_item_remain'];
                                        
                                        if( empty($Total_List) || $Total_List == 0 )
                                            $Total_List = "Unlimited";
                                        
                                        if( empty($Total_Featured) || $Total_Featured == 0 )
                                            $Total_List = "Unlimited";

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
                                        <h4><?php esc_html_e('Membership','dreamvilla-multiple-property'); ?></h4>
                                        <p class="package-title-info"><?php printf( esc_html__('Your Current Package: %s','dreamvilla-multiple-property'),get_the_title($active_package_detail[0]['id'])); ?></p>
                                        <p class="remainign-info"><?php printf( esc_html__('%s Listings: %s Remaining','dreamvilla-multiple-property'),$Total_List,$Remain_List); ?></p>
                                        <p class="remainign-info"><?php printf( esc_html__('%s Featured listings: %s Remaining','dreamvilla-multiple-property'),$Total_Featured,$Remain_Featured); ?></p>
                                        <?php if( $Package_Type != "per_listing" ){ ?>
                                        <p class="remainign-info"><?php printf( esc_html__('Expired On: %s','dreamvilla-multiple-property'),$Expiry_Date); ?></p><?php
                                        }
                                    } ?>
                                </div>
                                <h3 class="featured-submission-title"><?php esc_html_e('Featured Submission','dreamvilla-multiple-property'); ?></h3>
                                <p class="featured-submission-detail">
                                    <?php
                                    $featured_item_remain = $active_package_detail[0]['featured_item_remain'];
                                    if( $featured_item_remain != "done" ){
                                        $PropertyFetured = get_post_meta( $Property_ID, 'pfetured', true); ?>
                                        <input type="checkbox" name="featured_property" value="yes" <?php if( $PropertyFetured == "yes" ){ echo esc_attr("checked"); } ?> ><?php
                                    } else { ?>
                                        <input type="checkbox" name="featured_property" value="yes" disabled><?php
                                    } ?>                      
                                    <?php esc_html_e('Make this listing featured from property list.','dreamvilla-multiple-property'); ?>      
                                </p>
                                <h3 class="hr"><?php esc_html_e('Select Categories','dreamvilla-multiple-property'); ?></h3>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <?php $Property_Cat = get_the_terms( $Property_ID, 'property_category' );
                                        if( isset($Property_Cat[0]->term_id) )
                                            $Property_Cat = $Property_Cat[0]->term_id;
                                        else
                                            $Property_Cat = '';
                                        ?>
                                        <select name="property_type" id="property_type">
                                            <option value=""><?php esc_html_e('Category','dreamvilla-multiple-property'); ?></option>
                                            <?php $property_categories = get_terms("property_category", array("orderby" => "slug", "parent" => 0, 'hide_empty' => 0) );
                                            if ( ! empty( $property_categories ) && ! is_wp_error( $property_categories ) ){
                                                foreach ( $property_categories as $term ) { ?>
                                                    <option value="<?php echo esc_attr($term->term_id); ?>" <?php if( $Property_Cat == $term->term_id ){ echo "selected=selected"; } ?> ><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$term->name); ?></option><?php
                                                    dreamvilla_mp_get_category($term->term_id,'property_category',$Property_Cat);
                                                }                                   
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <?php $Property_Location = get_the_terms( $Property_ID, 'location' );
                                        if( isset($Property_Location[0]->term_id) )
                                            $Property_Location = $Property_Location[0]->term_id;
                                        else
                                            $Property_Location = '';
                                        ?>
                                        <select name="property_location" id="property_location">
                                            <option value=""><?php esc_html_e('Location','dreamvilla-multiple-property'); ?></option>
                                            <?php $property_location = get_terms("location", array("orderby" => "slug", "parent" => 0, 'hide_empty' => 0) );
                                            if ( ! empty( $property_location ) && ! is_wp_error( $property_location ) ){
                                                foreach ( $property_location as $term ) { ?>
                                                    <option value="<?php echo esc_attr($term->term_id); ?>" <?php if( $Property_Location == $term->term_id ){ echo "selected=selected"; } ?> ><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$term->name); ?></option><?php
                                                    dreamvilla_mp_get_category($term->term_id,'location',$Property_Location);
                                                }                                   
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <h3 class="hr"><?php esc_html_e('Select Property Listed In','dreamvilla-multiple-property'); ?></h3>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <?php $PropertyStatus = get_post_meta( $Property_ID, 'pstatus', true ); ?>
                                        <select name="property_listed">
                                            <option value=""><?php esc_html_e('Listed In','dreamvilla-multiple-property'); ?></option>
                                            <option value="rent" <?php if($PropertyStatus == "rent" ){ echo "selected=selected"; } ?> ><?php esc_html_e('Rent','dreamvilla-multiple-property'); ?></option>
                                            <option value="sale" <?php if($PropertyStatus == "sale" ){ echo "selected=selected"; } ?> ><?php esc_html_e('Sale','dreamvilla-multiple-property'); ?></option>                                
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <?php $Property_Status = get_the_terms( $Property_ID, 'property_status' );
                                        if( isset($Property_Status[0]->term_id) )
                                            $Property_Status = $Property_Status[0]->term_id;
                                        else
                                            $Property_Status = '';
                                        ?>
                                        <select name="property_status" id="property_status">
                                            <option value=""><?php esc_html_e('Status','dreamvilla-multiple-property'); ?></option>
                                            <?php $property_Status = get_terms("property_status", array("orderby" => "slug", "parent" => 0, 'hide_empty' => 0) );
                                            if ( ! empty( $property_Status ) && ! is_wp_error( $property_Status ) ){
                                                foreach ( $property_Status as $term ) { ?>
                                                    <option value="<?php echo esc_attr($term->term_id); ?>" <?php if( $Property_Status == $term->term_id ){ echo "selected=selected"; } ?> ><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$term->name); ?></option><?php
                                                    dreamvilla_mp_get_category($term->term_id,'property_status',$Property_Status);
                                                }                                   
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <h3 class="hr"><?php esc_html_e('Property Features','dreamvilla-multiple-property'); ?></h3>
                                <div class="row"><?php 
                                    $property_features = get_terms("features", array("orderby" => "slug", "parent" => 0, 'hide_empty' => 0) );

                                    $Property_Save_Featured = get_the_terms( $Property_ID, 'features' );
                                    $PropertySaveFeatured = array();
                                    if( $Property_Save_Featured ){
                                        foreach($Property_Save_Featured as $key => $value) {
                                            $PropertySaveFeatured[$key] = $value->term_id;
                                        }
                                    }

                                    if ( ! empty( $property_features ) && ! is_wp_error( $property_features ) ){
                                        foreach ( $property_features as $term ) { ?>
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="property_features[]" value="<?php echo esc_attr($term->term_id); ?>" <?php if( isset($PropertySaveFeatured) && in_array($term->term_id, $PropertySaveFeatured) ){ echo "checked"; } ?> > <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$term->name); ?>
                                                    </label>
                                                </div>
                                            </div><?php                                
                                        }                                   
                                    } ?>
                                </div>
                                <h3 class="hr"><?php esc_html_e('Video And Ads Option','dreamvilla-multiple-property'); ?></h3>
                                <div class="row"><?php
                                    //$PropertyVideo              = get_post_meta( $Property_ID, 'pvideo', true);
                                    $PropertyVideoUrl           = get_post_meta( $Property_ID, 'pvideourl', true);
                                    $PropertyVideoWidth         = get_post_meta( $Property_ID, 'pvideowidth', true);
                                    $PropertyVideoHeight        = get_post_meta( $Property_ID, 'pvideoheight', true);

                                    $PropertyAdvertisement      = get_post_meta( $Property_ID, 'padvertisement', true);    
                                    $PropertyVideoPlaceholder   = get_post_meta( $Property_ID, 'pvideoplaceholder', true); ?>
                                    <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                                        <input type="text" name="video_url" value="<?php echo esc_attr($PropertyVideo); ?>" placeholder="<?php esc_html_e("Video Source URL","dreamvilla-multiple-property"); ?>" />
                                    </div> -->

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <input type="text" name="provideourl" value="<?php echo esc_attr($PropertyVideoUrl); ?>" placeholder="<?php esc_html_e("Video Embed URL","dreamvilla-multiple-property"); ?>" />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <input type="text" name="provideoheight" value="<?php echo esc_attr($PropertyVideoHeight); ?>" placeholder="<?php esc_html_e("Video Height","dreamvilla-multiple-property"); ?>" />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <input type="text" name="provideowidth" value="<?php echo esc_attr($PropertyVideoWidth); ?>" placeholder="<?php esc_html_e("Video Width","dreamvilla-multiple-property"); ?>" />
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12 img_video_container">
                                        <?php if( $PropertyVideoPlaceholder ){ ?>
                                            <div class="gallery-thumb" id="holder-o_1ahtn9vjtr6ee3h1cug1hrnd2ub<?php echo dreamvilla_mp_get_image_id($PropertyVideoPlaceholder); ?>">
                                                <img src="<?php echo esc_url($PropertyVideoPlaceholder); ?>" width="250px" class="theme_favicon_icon" alt="slider">
                                                <input type="hidden" name="property_media_id[]" class="property-media-id" value="<?php echo esc_attr(dreamvilla_mp_get_image_id($PropertyVideoPlaceholder)); ?>" >
                                            </div>
                                        <?php } ?>
                                        <button type="button" class="btn btn-default uploadlogo" title="Upload a image"><span class="glyphicon glyphicon-paperclip"></span></button>
                                        <input type="hidden" name="video_placeholder" class="pbimagestore" value="<?php echo esc_attr(dreamvilla_mp_get_image_id($PropertyVideoPlaceholder)); ?>" >
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <textarea  name="advertisement_code" placeholder="<?php esc_html_e("Advertisement Code","dreamvilla-multiple-property"); ?>"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$PropertyAdvertisement); ?></textarea>
                                    </div>

                                </div>
                                <h3 class="hr"> </h3>                        
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal for the room start here -->
                <div class="modal fade" id="roommodel" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><?php esc_html_e("Add Room","dreamvilla-multiple-property"); ?></h4>
                            </div>
                            <div class="modal-body">
                                <table class="table show-table-property" id="addroomtable">
                                <?php
                                $RoomDetails = get_post_meta( $Property_ID, 'propertyroom', true );
                                if( $RoomDetails ){ 
                                    foreach ($RoomDetails as $key => $value) { ?>
                                        <tr class="main-row">
                                            <td>
                                                <input type="text" size="6" name="proomsize[]" class="form-control" placeholder="<?php esc_html_e("Size","dreamvilla-multiple-property"); ?>"  value="<?php echo esc_attr($RoomDetails[$key]['proomsize']); ?>">
                                            </td>                           
                                            <td>
                                                <select name="proomtype[]" class="form-control">
                                                    <option value=""><?php esc_html_e("Select","dreamvilla-multiple-property"); ?></option><?php
                                                $roomtype = dreamvilla_mp_get_room_type();
                                                if( $roomtype ){
                                                    foreach ($roomtype as $room_key => $room_value) { ?>
                                                        <option value="<?php echo esc_attr($room_key); ?>" <?php if( $RoomDetails[$key]['proomtype'] == $room_key ) { echo "selected=selected"; } ?> ><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$room_value); ?></option><?php 
                                                    } 
                                                } ?>
                                                </select>
                                            </td>
                                            <td class="text-right">
                                                <button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
                                                <button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
                                            </td>
                                        </tr><?php
                                    }
                                } else { ?>
                                    <tr class="main-row">
                                        <td>
                                            <input type="text" size="6" name="proomsize[]" class="form-control" placeholder="<?php esc_html_e("Size","dreamvilla-multiple-property"); ?>" >
                                        </td>                           
                                        <td>
                                            <select name="proomtype[]" class="form-control">
                                                <option value=""><?php esc_html_e("Select","dreamvilla-multiple-property"); ?></option><?php
                                            $room = dreamvilla_mp_get_room_type();
                                            if( $room ){
                                                foreach ($room as $key => $value) { ?>
                                                    <option value="<?php echo esc_attr($key); ?>" ><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$value); ?></option><?php 
                                                } 
                                            } ?>
                                            <select>
                                        </td>
                                        <td class="text-right">
                                            <button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
                                            <button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><?php esc_html_e("Save changes","dreamvilla-multiple-property"); ?></button>
                            </div>
                        </div>
                    </div>
                </div>      
                <!-- Modal for the room end here -->
                <!-- Modal for the bathroom start here -->
                <div class="modal fade" id="bathroommodel" tabindex="-1" role="dialog" aria-hidden="true">
                     <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><?php esc_html_e("Add Bathroom","dreamvilla-multiple-property"); ?></h4>
                            </div>
                            <div class="modal-body">
                                <table class="table show-table-property" id="addbathroomtable">
                                    <?php
                                    $BathroomDetails = get_post_meta( $Property_ID, 'propertybathroom', true );                    
                                    if( $BathroomDetails ){ 
                                        foreach ($BathroomDetails as $key => $value) { ?>
                                            <tr class="main-row">
                                                <td>
                                                    <input type="text" size="6" name="pbathroomsize[]" class="form-control" placeholder="<?php esc_html_e("Size","dreamvilla-multiple-property"); ?>"  value="<?php echo esc_attr($BathroomDetails[$key]['pbathroomsize']); ?>">
                                                </td>                               
                                                <td class="text-right">
                                                    <button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
                                                    <button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
                                                </td>
                                            </tr><?php
                                        }
                                    } else { ?>
                                        <tr class="main-row">
                                            <td>
                                                <input type="text" size="6" name="pbathroomsize[]" class="form-control" placeholder="<?php esc_html_e("Size","dreamvilla-multiple-property"); ?>" >
                                            </td>                       
                                            <td class="text-right">
                                                <button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
                                                <button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><?php esc_html_e("Save changes","dreamvilla-multiple-property"); ?></button>
                            </div>
                        </div>
                    </div>
                </div>      
                <!-- Modal for the bathroom end here -->
                <!-- Modal for the kitchen start here -->
                <div class="modal fade" id="kitchenmodel" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><?php esc_html_e("Add Kitchen","dreamvilla-multiple-property"); ?></h4>
                            </div>
                            <div class="modal-body">
                                <table class="table show-table-property" id="addkitchentable">
                                    <?php
                                    $KitchenDetails = get_post_meta( $Property_ID, 'propertykitchen', true );                  
                                    if( $KitchenDetails ){ 
                                        foreach ($KitchenDetails as $key => $value) { ?>
                                            <tr class="main-row">
                                                <td>
                                                    <input type="text" size="6" name="pkitchensize[]" class="form-control" placeholder="<?php esc_html_e("Size","dreamvilla-multiple-property"); ?>"  value="<?php echo esc_attr($KitchenDetails[$key]['pkitchensize']); ?>">
                                                </td>                               
                                                <td class="text-right">
                                                    <button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
                                                    <button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
                                                </td>
                                            </tr><?php
                                        }
                                    } else { ?>
                                        <tr class="main-row">
                                            <td>
                                                <input type="text" size="6" name="pkitchensize[]" class="form-control" placeholder="<?php esc_html_e("Size","dreamvilla-multiple-property"); ?>" >
                                            </td>                       
                                            <td class="text-right">
                                                <button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
                                                <button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><?php esc_html_e("Save changes","dreamvilla-multiple-property"); ?></button>
                            </div>
                        </div>
                    </div>
                </div>      
                <!-- Modal for the kitchen end here -->
                <!-- Modal for the swimmingpool start here -->
                <div class="modal fade" id="swimmingpoolmodel" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><?php esc_html_e("Add Swimming Pool","dreamvilla-multiple-property"); ?></h4>
                            </div>
                            <div class="modal-body">
                                <table class="table show-table-property" id="addswimmingpooltable">
                                    <?php
                                    $SwimmingPoolDetails = get_post_meta( $Property_ID, 'propertyswimmingpool', true );                    
                                    if( $SwimmingPoolDetails ){ 
                                        foreach ($SwimmingPoolDetails as $key => $value) { ?>
                                            <tr class="main-row">
                                                <td>
                                                    <input type="text" size="6" name="pswimmingpoolsize[]" class="form-control" placeholder="<?php esc_html_e("Size","dreamvilla-multiple-property"); ?>"  value="<?php echo esc_attr($SwimmingPoolDetails[$key]['pswimmingpoolsize']); ?>">
                                                </td>                               
                                                <td class="text-right">
                                                    <button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
                                                    <button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
                                                </td>
                                            </tr><?php
                                        }
                                    } else { ?>
                                        <tr class="main-row">
                                            <td>
                                                <input type="text" size="6" name="pswimmingpoolsize[]" class="form-control" placeholder="<?php esc_html_e("Size","dreamvilla-multiple-property"); ?>" >
                                            </td>                       
                                            <td class="text-right">
                                                <button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
                                                <button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><?php esc_html_e("Save changes","dreamvilla-multiple-property"); ?></button>
                            </div>
                        </div>
                    </div>
                </div>      
                <!-- Modal for the swimmingrool end here -->
                <!-- Modal for the gym start here -->
                <div class="modal fade" id="gymmodel" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><?php esc_html_e("Add Gym","dreamvilla-multiple-property"); ?></h4>
                            </div>
                            <div class="modal-body">
                                <table class="table show-table-property" id="addgymtable">
                                    <?php
                                    $GymDetails = get_post_meta( $Property_ID, 'propertygym', true );
                                    if( $GymDetails ){ 
                                        foreach ($GymDetails as $key => $value) { ?>
                                            <tr class="main-row">
                                                <td>
                                                    <input type="text" size="6" name="pgymsize[]" class="form-control" placeholder="<?php esc_html_e("Size","dreamvilla-multiple-property"); ?>"  value="<?php echo esc_attr($GymDetails[$key]['pgymsize']); ?>">
                                                </td>                               
                                                <td class="text-right">
                                                    <button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
                                                    <button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
                                                </td>
                                            </tr><?php
                                        }
                                    } else { ?>
                                        <tr class="main-row">
                                            <td>
                                                <input type="text" size="6" name="pgymsize[]" class="form-control" placeholder="<?php esc_html_e("Size","dreamvilla-multiple-property"); ?>" >
                                            </td>                       
                                            <td class="text-right">
                                                <button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
                                                <button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><?php esc_html_e("Save changes","dreamvilla-multiple-property"); ?></button>
                            </div>
                        </div>
                    </div>
                </div>      
                <!-- Modal for the bathroom end here -->
            </form><?php
        }
    } else {

        if( ( empty($active_package_detail) || $active_package_detail[0]['status'] != "active" ) && empty($single_property_detail) ){ ?>
            <div class="choose-package-section">
                <div class="">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <p class="package-option-title"><?php esc_html_e('CHOOSE OPTION FOR SUBMITTING YOUR PROPERTY.','dreamvilla-multiple-property'); ?></p>
                            <p><?php esc_html_e('We have two options for Submitting your Property, Please Choose one from below.','dreamvilla-multiple-property'); ?></p>
                            
                            <?php if( !empty($dreamvilla_options['dreamvilla_mp_single_payment']) && $dreamvilla_options['dreamvilla_mp_single_payment'] == 1 ) { ?>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="package-style-box">
                                            <span><?php esc_html_e('Please upgrade your plan','dreamvilla-multiple-property'); ?></span>
                                            <p class="package-option-title">
                                                <?php esc_html_e('we would suggest you to choose','dreamvilla-multiple-property'); ?><br>
                                                <?php esc_html_e('this plan, as it has different package.','dreamvilla-multiple-property'); ?>
                                            </p>
                                            <a href="<?php echo esc_url(get_permalink($dreamvilla_options['user_dashboard_package'])); ?>" class="choose-plan-url"><?php esc_html_e('Submit Multiple Properties','dreamvilla-multiple-property'); ?></a>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="package-style-box">
                                            <span><?php esc_html_e('Please upgrade your plan','dreamvilla-multiple-property'); ?></span>
                                            <p class="package-option-title">
                                                <?php esc_html_e('WE WOULD SUGGEST YOU TO WITH','dreamvilla-multiple-property'); ?> <br>
                                                <?php esc_html_e('PAY PER LISTING OPTION.','dreamvilla-multiple-property'); ?>
                                            </p>
                                            <a href="javascript:void(0);" class="choose-plan-url choose-add-single-property"><?php esc_html_e('Submit Only One Property','dreamvilla-multiple-property'); ?></a>
                                        </div>
                                        <div class="package-style-box show-hide">
                                            <span><?php esc_html_e('LOOKING TO ADD ONLY ONE PROPERTY?','dreamvilla-multiple-property'); ?></span>
                                            <p class="package-option-title">
                                                <?php esc_html_e('WE WOULD SUGGEST YOU TO WITH','dreamvilla-multiple-property'); ?> <br>
                                                <?php esc_html_e('PAY PER LISTING OPTION.','dreamvilla-multiple-property'); ?>
                                            </p>
                                            <div class="single-property-pay">
                                                <p class="text-left">
                                                    <input type="radio" name="selectList" class="radio-cost" value="1" checked> <label><?php esc_html_e('STANDARD LISTING','dreamvilla-multiple-property'); ?> <span>(<?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['dreamvilla_mp_simple_price']); printf( esc_html__(' %s','dreamvilla-multiple-property'),$dreamvilla_options['dreamvilla_mp_paypal_currency_code']); ?>)</span></label>
                                                </p>
                                                <p class="text-left">
                                                    <input type="radio" name="selectlist" class="radio-cost" value="2"> <label><?php esc_html_e('FEATUREDLISTING','dreamvilla-multiple-property'); ?> <span>(<?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['dreamvilla_mp_featured_price']); printf( esc_html__(' %s','dreamvilla-multiple-property'),$dreamvilla_options['dreamvilla_mp_paypal_currency_code']); ?>)</span><i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="<?php esc_html_e('With featured listing your property will show on top of other listings','dreamvilla-multiple-property'); ?>"></i></label>
                                                    <?php 
                                                    $simple_price       = $dreamvilla_options['dreamvilla_mp_simple_price'] * 100;
                                                    $feature_price      = $dreamvilla_options['dreamvilla_mp_featured_price'] * 100; ?>
                                                    <script>
                                                        jQuery(document).ready(function(){
                                                            jQuery('[data-toggle="tooltip"]').tooltip();

                                                            jQuery('.radio-cost').change(function(){
                                                                if( jQuery(this).val() == 1 ){
                                                                    jQuery(".paypal-button input[name='amount']").val("<?php echo $dreamvilla_options['dreamvilla_mp_simple_price']; ?>");
                                                                    jQuery(".paypal-button input[name='item_name']").val("Single_Property");

                                                                    jQuery("#stripe_form_simple_listing script").attr("data-amount","<?php echo $simple_price; ?>");
                                                                    jQuery("#stripe_form_simple_listing input[name='pay_ammout']").val("<?php echo $simple_price; ?>");
                                                                    jQuery("#stripe_form_simple_listing input[name='Package_Type']").val("1");
                                                                }
                                                                if( jQuery(this).val() == 2 ){                                                                    
                                                                    jQuery(".paypal-button input[name='amount']").val("<?php echo $dreamvilla_options['dreamvilla_mp_featured_price']; ?>");
                                                                    jQuery(".paypal-button input[name='item_name']").val("Single_Property_Featured_Type");

                                                                    jQuery("#stripe_form_simple_listing script").attr("data-amount","<?php echo $feature_price; ?>");                                                                    
                                                                    jQuery("#stripe_form_simple_listing input[name='pay_ammout']").val("<?php echo $feature_price; ?>");
                                                                    jQuery("#stripe_form_simple_listing input[name='Package_Type']").val("2");
                                                                }
                                                            });
                                                        });
                                                    </script>
                                                </p>
                                                <div class="row">
                                                    <?php 
                                                    if( $dreamvilla_options['dreamvilla_mp_paypal_payment'] == 1 ){ ?> 
                                                        <div class="col-xs-12 col-sm-6 col-md-6"> <?php dreamvilla_mp_single_payment( 1, $dreamvilla_options['dreamvilla_mp_simple_price'], $User_ID ); ?> </div> <?php
                                                    } 
                                                    if( $dreamvilla_options['enable_stripe'] == 1 ){ ?>
                                                         <div class="col-xs-12 col-sm-6 col-md-6"> <?php dreamvilla_show_stripe_per( 1, $dreamvilla_options['dreamvilla_mp_simple_price'], $User_ID ); ?> </div>
                                                    <?php } ?>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div id="AddPropertyModel" class="modal fade" role="dialog">
                                    <div class="modal-dialog add-single-property-model">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['dreamvilla_mp_si_mo_title']); ?></h4>
                                            </div>
                                            <div class="modal-body"><div class="single-property-pay">
                                                        <?php 
                                                        if( $dreamvilla_options['dreamvilla_mp_paypal_payment'] == 1 ){
                                                            dreamvilla_mp_single_payment( 1, $dreamvilla_options['dreamvilla_mp_simple_price'], $User_ID ); 
                                                        } 
                                                        if( $dreamvilla_options['enable_stripe'] == 1 ){ 
                                                            dreamvilla_show_stripe_per( 1, $dreamvilla_options['dreamvilla_mp_simple_price'], $User_ID ); 
                                                        } ?>
                                                    </div>
                                                    <div class="button-div">
                                                        <button name="feature_property_pay"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$dreamvilla_options['dreamvilla_mp_fe_pr_dis']); ?></button>
                                                    </div>
                                                    <div class="single-property-pay">
                                                        <?php 
                                                        if( $dreamvilla_options['dreamvilla_mp_paypal_payment'] == 1 ){
                                                            dreamvilla_mp_single_payment( 2, $dreamvilla_options['dreamvilla_mp_featured_price'], $User_ID ); 
                                                        } 
                                                        if( $dreamvilla_options['enable_stripe'] == 1 ){ 
                                                            dreamvilla_show_stripe_per( 2, $dreamvilla_options['dreamvilla_mp_featured_price'], $User_ID ); 
                                                        } ?>                                                        
                                                    </div>                                               
                                                <p style="font-size:11px;padding:10px 0;text-align:center;"><?php esc_html_e('Feature Property will get more exposure and can also be featured on Homepage','dreamvilla-multiple-property'); ?></p>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <a href="<?php echo esc_url(get_permalink($dreamvilla_options['user_dashboard_package'])); ?>" class="choose-plan-url"><?php esc_html_e('CHOOSE PLAN','dreamvilla-multiple-property'); ?></a>
                            <?php } ?>
                            <hr/>
                        </div>
                    </div>
                </div>
            </div><?php
        } else { ?>
        <form name="submit-property-form" id="submit-property-form" class="submit-property-form" enctype="multipart/form-data" method="post">
            <input type="hidden" name="property_action" class="property_action" value="submit">
            <div class="property-description-form">
                <div class="">
                    <div class="row">
                        <div class="col-xs-12 col-sm-9 col-md-9">
                            <h3><?php esc_html_e('Property Description &amp; Price','dreamvilla-multiple-property'); ?></h3>
                            <div class="contianer-fluid">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <input type="text" name="ptitle" class="required" placeholder="<?php esc_html_e("*Title (mandatory)","dreamvilla-multiple-property"); ?>" title="<?php esc_html_e('Property Title Is Required.', 'dreamvilla-multiple-property'); ?>" />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <textarea  name="pdescription" class="required" placeholder="<?php esc_html_e("*Description (mandatory)","dreamvilla-multiple-property"); ?>" title="<?php esc_html_e('Property Description Is Required.', 'dreamvilla-multiple-property'); ?>"></textarea>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <input type="text" name="pprice" class="required" placeholder="<?php esc_html_e("*Price in $","dreamvilla-multiple-property"); ?>" title="<?php esc_html_e('Property Price Is Required.', 'dreamvilla-multiple-property'); ?>" />
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <input type="text" name="ppricetype" placeholder="<?php esc_html_e("After Price Label (ex: 'per month')","dreamvilla-multiple-property"); ?>" />
                                    </div>                            
                                </div>
                            </div>                   

                            <h3 class="hr"><?php esc_html_e('Listing Media','dreamvilla-multiple-property'); ?></h3>
                            
                            <div class="form-option">
                                <div id="property-gallery-container" class="clearfix"></div>
                                <div id="drag-and-drop">
                                    <div class="drag-drop-area text-center">
                                        <i class="fa fa-cloud-upload"></i>&nbsp;&nbsp;<?php esc_html_e('Drag and drop images here', 'dreamvilla-multiple-property'); ?>
                                        <br/>
                                        <span class="drag-or"><?php esc_html_e('OR', 'dreamvilla-multiple-property'); ?></span>
                                        <br/>
                                        <button class="select-media drag-btn" id="select-images"><?php esc_html_e('Select Media','dreamvilla-multiple-property'); ?></button>                                
                                    </div>
                                </div>

                                <div id="plupload-container"></div>
                                <div id="errors-report"></div>
                            </div>

                            <p class="select-mdia-instruction"><?php esc_html_e('* At least 1 image is required for a valid submission.Minimum size is 500/500px','dreamvilla-multiple-property'); ?></p>
                            <p class="select-mdia-instruction"><?php esc_html_e('** Double click on the image to select featured.','dreamvilla-multiple-property'); ?></p>
                            <p class="select-mdia-instruction"><?php esc_html_e('*** Change images order with Drag &amp; Drop.','dreamvilla-multiple-property'); ?></p>
                            
                            <h3 class="hr"><?php esc_html_e('Listing Location','dreamvilla-multiple-property'); ?></h3>
                            <p><?php esc_html_e('*Address (mandatory)','dreamvilla-multiple-property'); ?></p>
                            <div class="contianer-fluid">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <input type="text" name="paddress" class="required" id="paddress" placeholder="<?php esc_html_e("Enter Address","dreamvilla-multiple-property"); ?>" title="<?php esc_html_e('Property Address Is Required.', 'dreamvilla-multiple-property'); ?>" />
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <input type="text" name="pcity" class="required" id="pcity" placeholder="<?php esc_html_e("City","dreamvilla-multiple-property"); ?>" title="<?php esc_html_e('Property City Is Required.', 'dreamvilla-multiple-property'); ?>" />
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <input type="text" name="pstate" class="required" id="pstate" placeholder="<?php esc_html_e("State","dreamvilla-multiple-property"); ?>" title="<?php esc_html_e('Property State Is Required.', 'dreamvilla-multiple-property'); ?>" />
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <input type="text" name="pcountry" class="required" id="pcountry" placeholder="<?php esc_html_e("Country","dreamvilla-multiple-property"); ?>" title="<?php esc_html_e('Property Country Is Required.', 'dreamvilla-multiple-property'); ?>" />
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <input type="text" name="ppincode" class="required digits" id="ppincode" placeholder="<?php esc_html_e("Zip","dreamvilla-multiple-property"); ?>" title="<?php esc_html_e('Property Zip Code Is Required.', 'dreamvilla-multiple-property'); ?>" />
                                    </div>                            
                                    <div class="clearfix"></div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <a href="javascript:void(0);" class="submit-location"><?php esc_html_e('PLACE PIN WITH PROPERTY ADDRESS','dreamvilla-multiple-property'); ?></a>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div id="property_google_map" style="width:800px;height:290px;margin:25px 0;"></div>                                
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <input type="text" name="platitude" class="required" id="platitude" placeholder="<?php esc_html_e("*Latitude (for Google Maps)","dreamvilla-multiple-property"); ?>" title="<?php esc_html_e('Property Latitude Is Required.', 'dreamvilla-multiple-property'); ?>" />
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <input type="text" name="plongitude" class="required" id="plongitude" placeholder="<?php esc_html_e("*Longitude (for Google Maps)","dreamvilla-multiple-property"); ?>" title="<?php esc_html_e('Property Longitude Is Required.', 'dreamvilla-multiple-property'); ?>" />
                                    </div>                            
                                </div>
                            </div>

                            <?php 
                            if ( !empty($dreamvilla_options['property_detail_page_variation'] ) && $dreamvilla_options['property_detail_page_variation'] == 2 ) { ?>
                                <h3 class="hr"><?php esc_html_e('Banner Image','dreamvilla-multiple-property'); ?></h3>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">                                            
                                        <button type="button" class="btn btn-default uploadlogo pull-right" title="Upload a image"><span class="glyphicon glyphicon-paperclip"></span></button>
                                        <input type="hidden" name="propertybannerimage" class="pbimagestore">
                                    </div>
                                </div><?php 
                            } ?>

                            <h3 class="hr"><?php esc_html_e('Essential Information','dreamvilla-multiple-property'); ?></h3>
                            <div class="contianer-fluid">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <table id="addessential" class="table show-table-property" >
                                            <tbody>                                               
                                                <tr class="main-row">
                                                    <td>
                                                        <input type="text" placeholder="Title" name="essentialtitle[]" class="no-margin">
                                                    </td>
                                                    <td>
                                                        <input type="text" placeholder="Value" name="essentialvalue[]" class="no-margin">
                                                    </td>
                                                    <td class="text-right">
                                                        <button style="display: none;" class="btn btn-default removebedroom" type="button">
                                                            <span class="glyphicon glyphicon-remove"></span>
                                                        </button>
                                                        <button class="btn btn-default addmorebedroombtn" type="button">
                                                            <span class="glyphicon glyphicon-plus"></span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>       
                                    </div>                    
                                </div>
                            </div>
                            <!-- <div class="contianer-fluid">
                                <div class="contianer-fluid">
                                    <div class="row">
                                        
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <input type="text" name="psbuilduparea" class="digits" placeholder="<?php esc_html_e("Super Build Up Area","dreamvilla-multiple-property"); ?>" />
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <input type="text" name="psbuildupareamessure" placeholder="<?php esc_html_e("Super Build Up Area Messure Ex. FT2","dreamvilla-multiple-property"); ?>" />
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <input type="text" name="pbuiltupyear" class="digits" placeholder="<?php esc_html_e("Built Up Year","dreamvilla-multiple-property"); ?>" />
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <input type="text" name="pmls" placeholder="<?php esc_html_e("MLS","dreamvilla-multiple-property"); ?>" />
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <input type="text" name="pfullbath" class="digits" placeholder="<?php esc_html_e("Full Baths","dreamvilla-multiple-property"); ?>" />
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <input type="text" name="phalfbath" class="digits" placeholder="<?php esc_html_e("Half Baths","dreamvilla-multiple-property"); ?>" />
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <input type="text" name="plostsoft" class="digits" placeholder="<?php esc_html_e("Lost Soft Ex. 1245","dreamvilla-multiple-property"); ?>" />
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <input type="text" name="ptype" placeholder="<?php esc_html_e("Type Ex. Single Family","dreamvilla-multiple-property"); ?>" />
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <input type="text" name="pstyle" placeholder="<?php esc_html_e("Style Ex. Bi-Level","dreamvilla-multiple-property"); ?>" />
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <input type="text" name="pcurrentstatus" placeholder="<?php esc_html_e("Status Ex. Active","dreamvilla-multiple-property"); ?>" />
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <input type="text" name="pnoofgarage" class="digits" placeholder="<?php esc_html_e("No Of Garage","dreamvilla-multiple-property"); ?>" />
                                        </div>

                                    </div>
                                </div>
                            </div> -->

                            <h3 class="hr"><?php esc_html_e('Amenities','dreamvilla-multiple-property'); ?></h3>
                            <div class="contianer-fluid">
                                <div class="contianer-fluid">
                                <div class="row">    
                                    <div class="col-xs-12 col-sm-12 col-md-12">                  
                                        <table id="addamenities" class="table show-table-property">
                                            <tbody>                                
                                                <tr class="main-row">
                                                    <td>
                                                        <input type="text" placeholder="<?php esc_html_e("Amenities","dreamvilla-multiple-property"); ?>" name="pamenities[]" class="no-margin">
                                                    </td>
                                                    <td id="uploadlogoBtn_container">                                                
                                                        <span class="amenities-image"></span>
                                                        <button type="button" id="uploadlogoBtn" class="btn btn-default uploadlogo pull-right" title="<?php esc_html_e("Upload a image","dreamvilla-multiple-property"); ?>"><span class="glyphicon glyphicon-paperclip"></span></button>
                                                        <input type="hidden" name="pamenitiesphoto[]" class="pbimagestore" >
                                                    </td>
                                                    <td class="text-right">
                                                        <button style="display: none;" class="btn btn-default removebedroom" type="button">
                                                            <span class="glyphicon glyphicon-remove"></span>
                                                        </button>
                                                        <button class="btn btn-default addmorebedroombtn" type="button">
                                                            <span class="glyphicon glyphicon-plus"></span>
                                                        </button>
                                                    </td>
                                                </tr>                              
                                            </tbody>
                                        </table>
                                    </div>              
                                </div>
                            </div>
                            </div>

                            <h3 class="hr"><?php esc_html_e('Interior','dreamvilla-multiple-property'); ?></h3>
                            <div class="contianer-fluid">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <table id="addinterior" class="table show-table-property" >
                                            <tbody>                                
                                                <tr class="main-row">
                                                    <td>
                                                        <input type="text" placeholder="<?php esc_html_e("Title","dreamvilla-multiple-property"); ?>" name="interiortitle[]" class="no-margin">
                                                    </td>
                                                    <td>
                                                        <input type="text" placeholder="<?php esc_html_e("Description","dreamvilla-multiple-property"); ?>" name="interiordescription[]" class="no-margin">
                                                    </td>
                                                    <td class="text-right">
                                                        <button style="display: none;" class="btn btn-default removebedroom" type="button">
                                                            <span class="glyphicon glyphicon-remove"></span>
                                                        </button>
                                                        <button class="btn btn-default addmorebedroombtn" type="button">
                                                            <span class="glyphicon glyphicon-plus"></span>
                                                        </button>
                                                    </td>
                                                </tr>                             
                                            </tbody>
                                        </table>       
                                    </div>                    
                                </div>
                            </div>

                            <h3 class="hr"><?php esc_html_e('Exterior','dreamvilla-multiple-property'); ?></h3>
                            <div class="contianer-fluid">
                                <div class="row">                            
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <table id="addexterior" class="table show-table-property" >
                                            <tbody>                                
                                                <tr class="main-row">
                                                    <td>
                                                        <input type="text" placeholder="<?php esc_html_e("Title","dreamvilla-multiple-property"); ?>" name="exteriortitle[]" class="no-margin">
                                                    </td>
                                                    <td>
                                                        <input type="text" placeholder="<?php esc_html_e("Description","dreamvilla-multiple-property"); ?>" name="exteriordescription[]" class="no-margin">
                                                    </td>
                                                    <td class="text-right">
                                                        <button style="display: none;" class="btn btn-default removebedroom" type="button">
                                                            <span class="glyphicon glyphicon-remove"></span>
                                                        </button>
                                                        <button class="btn btn-default addmorebedroombtn" type="button">
                                                            <span class="glyphicon glyphicon-plus"></span>
                                                        </button>
                                                    </td>
                                                </tr>                              
                                            </tbody>
                                        </table>       
                                    </div>                           
                                </div>
                            </div>

                            <h3 class="hr"><?php esc_html_e('Dimensions','dreamvilla-multiple-property'); ?></h3>
                            <div class="contianer-fluid">
                                <div class="row">                            
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <button type="button" id="room" class="btn btn-info" data-toggle="modal" data-target="#roommodel"><?php esc_html_e("Room","dreamvilla-multiple-property"); ?> <span class="glyphicon glyphicon-plus"></span></button>
                                            </div>

                                            <div class="col-sm-4">
                                                <button type="button" id="bathroom" class="btn btn-info" data-toggle="modal" data-target="#bathroommodel"><?php esc_html_e("Bathroom","dreamvilla-multiple-property"); ?> <span class="glyphicon glyphicon-plus"></span></button>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <button type="button" id="kitchen" class="btn btn-info" data-toggle="modal" data-target="#kitchenmodel"><?php esc_html_e("Kitchen","dreamvilla-multiple-property"); ?> <span class="glyphicon glyphicon-plus"></span></button>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <button type="button" id="swimminpool" class="btn btn-info" data-toggle="modal" data-target="#swimmingpoolmodel"><?php esc_html_e("Swimming pool","dreamvilla-multiple-property"); ?> <span class="glyphicon glyphicon-plus"></span></button>
                                            </div>
                                            
                                            <div class="col-sm-4">
                                                <button type="button" id="gym" class="btn btn-info" data-toggle="modal" data-target="#gymmodel"><?php esc_html_e("Gym","dreamvilla-multiple-property"); ?> <span class="glyphicon glyphicon-plus"></span></button>
                                            </div>
                                        </div>
                                    </div>                        
                                </div>
                            </div>

                            <h3 class="hr"><?php esc_html_e('Floor Plan','dreamvilla-multiple-property'); ?></h3>
                            <div class="contianer-fluid">
                                <div class="row">                            
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <table id="addfloorplans" class="table show-table-property">
                                            <tbody>
                                                <tr class="main-row">
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                                <input type="text" placeholder="<?php esc_html_e("Floor title","dreamvilla-multiple-property"); ?>" name="floortitle[]">
                                                            </div>
                                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                                <input type="text" placeholder="<?php esc_html_e("Price","dreamvilla-multiple-property"); ?>" name="floorprice[]">
                                                            </div>
                                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                                <input type="text" placeholder="<?php esc_html_e("Squre Foot","dreamvilla-multiple-property"); ?>" name="floorsqrt[]">
                                                            </div>
                                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                                <input type="text" placeholder="<?php esc_html_e("Bedrooms","dreamvilla-multiple-property"); ?>" name="floorbedrooms[]">
                                                            </div>
                                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                                <input type="text" placeholder="<?php esc_html_e("Bathrooms","dreamvilla-multiple-property"); ?>" name="floorbathrooms[]">
                                                            </div>
                                                            <div class="col-xs-12 col-sm-6 col-md-6">
                                                                <textarea placeholder="<?php esc_html_e("Detail","dreamvilla-multiple-property"); ?>" name="floordetail[]"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                                <button type="button" class="btn btn-default uploadlogo pull-right" title="<?php esc_html_e("Upload a image","dreamvilla-multiple-property"); ?>"><span class="glyphicon glyphicon-paperclip"></span></button>
                                                                <input type="hidden" name="floorplanimage[]" class="pbimagestore">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-right">
                                                        <button style="display: none;" class="btn btn-default removebedroom" type="button">
                                                            <span class="glyphicon glyphicon-remove"></span>
                                                        </button>
                                                        <button class="btn btn-default addmorebedroombtn" type="button">
                                                            <span class="glyphicon glyphicon-plus"></span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>                        
                                </div>
                            </div>

                            <h3 class="hr"><?php esc_html_e('Property Documents','dreamvilla-multiple-property'); ?></h3>
                            <div class="contianer-fluid">
                                <div class="row">                            
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <table class="table show-table-property" id="addaboutdocuments">
                                            <tbody>
                                                <tr class="main-row">
                                                    <td>
                                                        <input type="text" size="6" name="pdocumentslabel[]" class="form-control" placeholder="<?php esc_html_e("Label","dreamvilla-multiple-property"); ?>" >
                                                    </td>                           
                                                    <td>
                                                        <input type="text" size="6" name="pdocumentslink[]" class="form-control" placeholder="<?php esc_html_e("Link","dreamvilla-multiple-property"); ?>" >
                                                    </td>                                           
                                                    <td class="text-right">
                                                        <button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
                                                        <button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>                       
                                </div>
                            </div>

                            <h3 class="hr"><?php esc_html_e('Near By Place','dreamvilla-multiple-property'); ?></h3>
                            <div class="contianer-fluid">
                                <div class="row">                            
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <table id="nearbyplaces" class="table show-table-property">
                                            <tbody>
                                                <tr class="main-row">
                                                    <td>
                                                        <select name="google_near_by_place_type[]">
                                                            <option value=""><?php esc_html_e('Select','dreamvilla-multiple-property'); ?></option><?php
                                                            $google_places = dreamvilla_mp_google_places();
                                                            foreach ($google_places as $key => $value) { ?>
                                                                <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option><?php
                                                            } ?>                                        
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" placeholder="<?php esc_html_e("Place Label","dreamvilla-multiple-property"); ?>" name="google_near_by_place_label[]" class="no-margin" size="15" >
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-default uploadlogo pull-right" title="<?php esc_html_e("Upload a image","dreamvilla-multiple-property"); ?>"><span class="glyphicon glyphicon-paperclip"></span></button>
                                                        <input type="hidden" name="google_near_by_place_icon[]" class="pbimagestore" value="" >
                                                    </td>
                                                    <td class="text-right">
                                                        <button style="display: none;" class="btn btn-default removebedroom" type="button">
                                                            <span class="glyphicon glyphicon-remove"></span>
                                                        </button>
                                                        <button class="btn btn-default addmorebedroombtn" type="button">
                                                            <span class="glyphicon glyphicon-plus"></span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <p><?php echo esc_html_e( 'Enter your custom near by places as per your choice.', 'dreamvilla-multiple-property'); ?></p>
                                        <table id="nearbycustomplaces" class="table show-table-property">
                                            <tbody>
                                                <tr class="main-row">
                                                    <td>
                                                        <input type="text" placeholder="<?php esc_html_e("Place Label","dreamvilla-multiple-property"); ?>" name="google_near_by_custom_place_label[]" class="no-margin" size="10">
                                                    </td>
                                                    <td>
                                                        <textarea placeholder="<?php esc_html_e("Detail","dreamvilla-multiple-property"); ?>" cols="10" name="google_near_by_custom_place_detail[]" class="no-margin"></textarea>
                                                    </td>
                                                    <td>
                                                        <input type="text" placeholder="<?php esc_html_e("Latitude","dreamvilla-multiple-property"); ?>" name="google_near_by_custom_place_latitude[]" class="no-margin" size="5">
                                                    </td>
                                                    <td>
                                                        <input type="text" placeholder="<?php esc_html_e("Longitude","dreamvilla-multiple-property"); ?>" name="google_near_by_custom_place_longitude[]" class="no-margin" size="5">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-default uploadlogo pull-right" title="<?php esc_html_e("Upload a image","dreamvilla-multiple-property"); ?>"><span class="glyphicon glyphicon-paperclip"></span></button>
                                                        <input type="hidden" name="google_near_by_custom_place_icon[]" class="pbimagestore" value="" >
                                                    </td>
                                                    <td class="text-right">
                                                        <button style="display: none;" class="btn btn-default removebedroom" type="button">
                                                            <span class="glyphicon glyphicon-remove"></span>
                                                        </button>
                                                        <button class="btn btn-default addmorebedroombtn" type="button">
                                                            <span class="glyphicon glyphicon-plus"></span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>                           
                                </div>
                            </div>


                            <h3 class="hr"><?php esc_html_e('Other','dreamvilla-multiple-property'); ?></h3>
                            <div class="contianer-fluid">
                                <div class="row">                            
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <textarea name="pflooring" placeholder="<?php esc_html_e("Flooring Detail","dreamvilla-multiple-property"); ?>"></textarea>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <textarea name="pgoodsincluded" placeholder="<?php esc_html_e("Goods Included Detail","dreamvilla-multiple-property"); ?>"></textarea>
                                    </div>
                                </div>
                            </div>

                            <h3 class="hr"><?php esc_html_e('PROPERTY STREET VIEW','dreamvilla-multiple-property'); ?></h3>
                            <div class="contianer-fluid">
                                <div class="row">                            
                                    <!-- start our custom code -->
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <input type="text" name="prostreetviewlat" id="prostreetviewlat" placeholder="<?php esc_html_e("*Latitude (for Google Maps Street View)","dreamvilla-multiple-property"); ?>" title="<?php esc_html_e('Property Streetview Latitude Is Required.', 'dreamvilla-multiple-property'); ?>" />
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <input type="text" name="prostreetviewlng" id="prostreetviewlng" placeholder="<?php esc_html_e("*Longitude (for Google Maps Street View)","dreamvilla-multiple-property"); ?>" title="<?php esc_html_e('Property Steetview Longitude Is Required.', 'dreamvilla-multiple-property'); ?>" />
                                    </div>                        
                                    <!-- end our custom code -->                                   
                                </div>
                            </div>
                            <div class="contianer-fluid">
                                <div class="row">                            
                                    <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:50px;">
                                        <input type="submit" class="select-media" value="<?php esc_html_e('Add Property','dreamvilla-multiple-property'); ?>">
                                        <?php wp_nonce_field('dreamvilla-ajax-submit-property-nonce', 'submit-property-security'); ?>
                                        <p class="status"></p>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                        <div class="col-xs-12 col-sm-3 col-md-3 ">
                            <?php if( empty($single_property_detail ) ){ ?>
                                <div class="membership-info"><?php
                                    $Total_List      = get_post_meta( $active_package_detail[0]['id'], 'packagelist', true );
                                    $Total_Featured  = get_post_meta( $active_package_detail[0]['id'], 'packagefeatured', true );
                                    $Package_Type    = get_post_meta( $active_package_detail[0]['id'], 'packagetype', true );

                                    $Remain_List     = $active_package_detail[0]['list_item_remain'];
                                    $Remain_Featured = $active_package_detail[0]['featured_item_remain'];
                                    
                                    if( empty($Total_List) || $Total_List == 0 )
                                        $Total_List = "Unlimited";
                                    
                                    if( empty($Total_Featured) || $Total_Featured == 0 )
                                        $Total_List = "Unlimited";

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
                                    <h4><?php esc_html_e('Membership','dreamvilla-multiple-property'); ?></h4>
                                    <p class="package-title-info"><?php printf( esc_html__('Your Current Package: %s','dreamvilla-multiple-property'),get_the_title($active_package_detail[0]['id'])); ?></p>
                                    <p class="remainign-info"><?php printf( esc_html__('%s Listings - %s remaining','dreamvilla-multiple-property'),$Total_List,$Remain_List); ?></p>
                                    <p class="remainign-info"><?php printf( esc_html__('%s Featured listings - %s remaining','dreamvilla-multiple-property'),$Total_Featured,$Remain_Featured); ?></p>
                                    <?php if( $Package_Type != "per_listing" ){ ?>
                                    <p class="remainign-info"><?php printf( esc_html__('Expired On: %s','dreamvilla-multiple-property'),$Expiry_Date); ?></p>
                                    <?php } ?>
                                </div>
                            <?php } 
                            if( empty($single_property_detail) ){ ?>
                                <h3 class="featured-submission-title"><?php esc_html_e('Featured Submission','dreamvilla-multiple-property'); ?></h3>
                                <p class="featured-submission-detail">
                                    <?php
                                    if( !empty($active_package_detail[0]['featured_item_remain']))
                                        $featured_item_remain = $active_package_detail[0]['featured_item_remain'];
                                    else
                                        $featured_item_remain = '';

                                    if( $featured_item_remain != "done" ){ ?>
                                        <input type="checkbox" name="featured_property" value="yes"><?php
                                    } else { ?>
                                        <input type="checkbox" name="featured_property" value="yes" disabled><?php
                                    }                                
                                    esc_html_e('Make this listing featured from property list.','dreamvilla-multiple-property'); ?>
                                </p>                                
                            <?php }
                            if( empty($single_property_detail) ){ ?>
                                <h3 class="hr"><?php esc_html_e('Select Categories','dreamvilla-multiple-property'); ?></h3>
                            <?php } else { ?>
                                <h3><?php esc_html_e('Select Categories','dreamvilla-multiple-property'); ?></h3>
                            <?php } ?>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <select name="property_type" id="property_type">
                                        <option value=""><?php esc_html_e('Category','dreamvilla-multiple-property'); ?></option>
                                        <?php $property_categories = get_terms("property_category", array("orderby" => "slug", "parent" => 0, 'hide_empty' => 0) );
                                        if ( ! empty( $property_categories ) && ! is_wp_error( $property_categories ) ){
                                            foreach ( $property_categories as $term ) { ?>
                                                <option value="<?php echo esc_attr($term->term_id); ?>" ><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$term->name); ?></option><?php
                                                dreamvilla_mp_get_category($term->term_id,'property_category','');
                                            }                                   
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <select name="property_location" id="property_location">
                                        <option value=""><?php esc_html_e('Location','dreamvilla-multiple-property'); ?></option>
                                        <?php $property_location = get_terms("location", array("orderby" => "slug", "parent" => 0, 'hide_empty' => 0) );
                                        if ( ! empty( $property_location ) && ! is_wp_error( $property_location ) ){
                                            foreach ( $property_location as $term ) { ?>
                                                <option value="<?php echo esc_attr($term->term_id); ?>" ><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$term->name); ?></option><?php
                                                dreamvilla_mp_get_category($term->term_id,'location','');
                                            }                                   
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <h3 class="hr"><?php esc_html_e('Select Property Listed In','dreamvilla-multiple-property'); ?></h3>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <select name="property_listed">
                                        <option value=""><?php esc_html_e('Listed In','dreamvilla-multiple-property'); ?></option>
                                        <option value="rent"><?php esc_html_e('Rent','dreamvilla-multiple-property'); ?></option>
                                        <option value="sale"><?php esc_html_e('Sale','dreamvilla-multiple-property'); ?></option>                                
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <select name="property_status" id="property_status">
                                        <option value=""><?php esc_html_e('Status','dreamvilla-multiple-property'); ?></option>
                                        <?php $property_Status = get_terms("property_status", array("orderby" => "slug", "parent" => 0, 'hide_empty' => 0) );
                                        if ( ! empty( $property_Status ) && ! is_wp_error( $property_Status ) ){
                                            foreach ( $property_Status as $term ) { ?>
                                                <option value="<?php echo esc_attr($term->term_id); ?>"><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$term->name); ?></option><?php
                                                dreamvilla_mp_get_category($term->term_id,'property_status',$Property_Status);
                                            }                                   
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <h3 class="hr"><?php esc_html_e('Property Features','dreamvilla-multiple-property'); ?></h3>
                            <div class="row">
                                <?php $property_features = get_terms("features", array("orderby" => "slug", "parent" => 0, 'hide_empty' => 0) );
                                if ( ! empty( $property_features ) && ! is_wp_error( $property_features ) ){
                                    foreach ( $property_features as $term ) { ?>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="property_features[]" value="<?php echo esc_attr($term->term_id); ?>"> <?php printf( esc_html__('%s','dreamvilla-multiple-property'),$term->name); ?>
                                                </label>
                                            </div>
                                        </div><?php                                
                                    }                                   
                                } ?>
                            </div>
                            <h3 class="hr"><?php esc_html_e('Video And Ads Option','dreamvilla-multiple-property'); ?></h3>
                            <div class="row">
                                <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                                    <input type="text" name="video_url" placeholder="<?php //esc_html_e("Video Source URL","dreamvilla-multiple-property"); ?>" />
                                </div> -->

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <input type="text" name="provideourl" placeholder="<?php esc_html_e("Video Embed URL","dreamvilla-multiple-property"); ?>" />
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <input type="text" name="provideoheight" placeholder="<?php esc_html_e("Video Height","dreamvilla-multiple-property"); ?>" />
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <input type="text" name="provideowidth" placeholder="<?php esc_html_e("Video Width","dreamvilla-multiple-property"); ?>" />
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 img_video_container">
                                    <button type="button" class="btn btn-default uploadlogo" title="Upload a image"><span class="glyphicon glyphicon-paperclip"></span></button>
                                    <input type="hidden" name="video_placeholder" class="pbimagestore" value="" >
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <textarea  name="advertisement_code" placeholder="<?php esc_html_e("Advertisement Code","dreamvilla-multiple-property"); ?>"></textarea>
                                </div>
                            </div>
                            <h3 class="hr"> </h3>                        
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal for the room start here -->
            <div class="modal fade" id="roommodel" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><?php esc_html_e("Add Room","dreamvilla-multiple-property"); ?></h4>
                        </div>
                        <div class="modal-body">
                            <table class="table show-table-property" id="addroomtable">
                                <tr class="main-row">
                                    <td>
                                        <input type="text" size="6" name="proomsize[]" class="form-control" placeholder="<?php esc_html_e("Size","dreamvilla-multiple-property"); ?>" >
                                    </td>                           
                                    <td>
                                        <select name="proomtype[]" class="form-control">
                                            <option value=""><?php esc_html_e("Select","dreamvilla-multiple-property"); ?></option><?php
                                        $room = dreamvilla_mp_get_room_type();
                                        if( $room ){
                                            foreach ($room as $key => $value) { ?>
                                                <option value="<?php echo esc_attr($key); ?>" ><?php printf( esc_html__('%s','dreamvilla-multiple-property'),$value); ?></option><?php 
                                            } 
                                        } ?>
                                        <select>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
                                        <button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
                                    </td>
                                </tr>                
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><?php esc_html_e("Save changes","dreamvilla-multiple-property"); ?></button>
                        </div>
                    </div>
                </div>
            </div>      
            <!-- Modal for the room end here -->
            <!-- Modal for the bathroom start here -->
            <div class="modal fade" id="bathroommodel" tabindex="-1" role="dialog" aria-hidden="true">
                 <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><?php esc_html_e("Add Bathroom","dreamvilla-multiple-property"); ?></h4>
                        </div>
                        <div class="modal-body">
                            <table class="table show-table-property" id="addbathroomtable">
                                <tr class="main-row">
                                    <td>
                                        <input type="text" size="6" name="pbathroomsize[]" class="form-control" placeholder="<?php esc_html_e("Size","dreamvilla-multiple-property"); ?>" >
                                    </td>                       
                                    <td>
                                        <button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
                                        <button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
                                    </td>
                                </tr>                    
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><?php esc_html_e("Save changes","dreamvilla-multiple-property"); ?></button>
                        </div>
                    </div>
                </div>
            </div>      
            <!-- Modal for the bathroom end here -->
            <!-- Modal for the kitchen start here -->
            <div class="modal fade" id="kitchenmodel" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><?php esc_html_e("Add Kitchen","dreamvilla-multiple-property"); ?></h4>
                        </div>
                        <div class="modal-body">
                            <table class="table show-table-property" id="addkitchentable">
                                <tr class="main-row">
                                    <td>
                                        <input type="text" size="6" name="pkitchensize[]" class="form-control" placeholder="<?php esc_html_e("Size","dreamvilla-multiple-property"); ?>" >
                                    </td>                       
                                    <td>
                                        <button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
                                        <button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
                                    </td>
                                </tr>                    
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><?php esc_html_e("Save changes","dreamvilla-multiple-property"); ?></button>
                        </div>
                    </div>
                </div>
            </div>      
            <!-- Modal for the kitchen end here -->
            <!-- Modal for the swimmingpool start here -->
            <div class="modal fade" id="swimmingpoolmodel" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><?php esc_html_e("Add Swimming Pool","dreamvilla-multiple-property"); ?></h4>
                        </div>
                        <div class="modal-body">
                            <table class="table show-table-property" id="addswimmingpooltable">
                                <tr class="main-row">
                                    <td>
                                        <input type="text" size="6" name="pswimmingpoolsize[]" class="form-control" placeholder="<?php esc_html_e("Size","dreamvilla-multiple-property"); ?>" >
                                    </td>                       
                                    <td>
                                        <button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
                                        <button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
                                    </td>
                                </tr>                    
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><?php esc_html_e("Save changes","dreamvilla-multiple-property"); ?></button>
                        </div>
                    </div>
                </div>
            </div>      
            <!-- Modal for the swimmingrool end here -->
            <!-- Modal for the gym start here -->
            <div class="modal fade" id="gymmodel" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><?php esc_html_e("Add Gym","dreamvilla-multiple-property"); ?></h4>
                        </div>
                        <div class="modal-body">
                            <table class="table show-table-property" id="addgymtable">                  
                                <tr class="main-row">
                                    <td>
                                        <input type="text" size="6" name="pgymsize[]" class="form-control" placeholder="<?php esc_html_e("Size","dreamvilla-multiple-property"); ?>" >
                                    </td>                       
                                    <td>
                                        <button type="button" class="btn btn-default removebedroom" style="display:none;"><span class="glyphicon glyphicon-remove"></span></button>
                                        <button type="button" class="btn btn-default addmorebedroombtn"><span class="glyphicon glyphicon-plus"></span></button>
                                    </td>
                                </tr>                    
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal"><?php esc_html_e("Save changes","dreamvilla-multiple-property"); ?></button>
                        </div>
                    </div>
                </div>
            </div>      
            <!-- Modal for the bathroom end here -->
        </form><?php
        }
    } ?>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
    "use strict";
    jQuery('.paypal-button.large').html('<i class="fa fa-paypal"></i> Pay With Paypal');
    jQuery('.stripe-button-el span').html('<i class="fa fa-credit-card"></i> Pay with Credit Card');
});
</script>