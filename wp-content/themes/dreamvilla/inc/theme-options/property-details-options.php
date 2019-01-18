<?php
/*
 * Other Options
 */

$opt_name;
Redux::setSection( $opt_name, array(
    'title' => esc_html__('Property Detail','dreamvilla-multiple-property'),
    'id'    => 'property-detail-section',    
    'desc'  => esc_html__('This section contains options for property detail.','dreamvilla-multiple-property'),
    'fields'=> array(

        array(
                'id'       => 'property_detail_page_variation',
                'type'     => 'radio',
                'title'    => esc_html__('Property Design Variation','dreamvilla-multiple-property'), 
                'options'  => array(
                                    '1' => 'Variation One',
                                    '2' => 'Variation Two',                                    
                                ),
                'default'   => '1'
        ),

        array(
                'id'       => 'distancenearbyplaces',
                'type'     => 'select',
                'title'    => esc_html__('Near by places distance in','dreamvilla-multiple-property'), 
                'options'  => array(
                                    'km' => 'KM',
                                    'mile' => 'Mile'
                                ),
                'default'   => 'km'
        ),

        array(
            'id'        => 'map_radius',
            'type'      => 'text',
            'title'     => esc_html__( 'Map radius (In Meters)','dreamvilla-multiple-property'),
            'default'   => '5000'
        ),

        array(
                'id'       => 'sendinquirymailagent',
                'type'     => 'button_set',
                'title'    => esc_html__('Send Inquiry Mail To Agnet','dreamvilla-multiple-property'), 
                'options'  => array(
                                'yes' => 'Yes',
                                'no' => 'No'
                            ),
                'default'   => 'yes'              
        ),

        array(
                'id'       => 'sendinquirymailcompany',
                'type'     => 'button_set',
                'title'    => esc_html__('Send Inquiry Mail To Company','dreamvilla-multiple-property'), 
                'options'  => array(
                                'yes' => 'Yes',
                                'no' => 'No'
                            ),
                'default'   => 'yes'               
        ),

        array(
                'id'       => 'displaydescription',
                'type'     => 'button_set',
                'title'    => esc_html__('Display Description','dreamvilla-multiple-property'), 
                'options'  => array(
                                'yes' => 'Yes',
                                'no' => 'No'
                            ),
                'default'   => 'yes'         
        ),

        array(
            'id'        => 'descriptiontitle',
            'type'      => 'text',
            'title'     => esc_html__( 'Title Description','dreamvilla-multiple-property'),
            'default'   => 'Description'
        ),

        array(
            'id'        => 'printtitle',
            'type'      => 'text',
            'title'     => esc_html__( 'Print Title','dreamvilla-multiple-property'),
            'default'   => 'Print this property'
        ),

        array(
                'id'       => 'displayessentialinformation',
                'type'     => 'button_set',
                'title'    => esc_html__('Display Essential Information','dreamvilla-multiple-property'), 
                'options'  => array(
                                'yes' => 'Yes',
                                'no' => 'No'
                            ),
                'default'   => 'yes'               
        ),

        array(
            'id'        => 'essentialinformationtitle',
            'type'      => 'text',
            'title'     => esc_html__( 'Title Essential Information','dreamvilla-multiple-property'),
            'default'   => 'Essential Information'
        ),

        array(
                'id'       => 'displayamenities',
                'type'     => 'button_set',
                'title'    => esc_html__('Display Amenities','dreamvilla-multiple-property'), 
                'options'  => array(
                                'yes' => 'Yes',
                                'no' => 'No'
                            ),
                'default'   => 'yes'
        ),

        array(
            'id'        => 'amenitiestitle',
            'type'      => 'text',
            'title'     => esc_html__( 'Title Amenities','dreamvilla-multiple-property'),
            'default'   => 'Amenities'
        ),

        array(
                'id'       => 'displayinterior',
                'type'     => 'button_set',
                'title'    => esc_html__('Display Interior','dreamvilla-multiple-property'), 
                'options'  => array(
                                'yes' => 'Yes',
                                'no' => 'No'
                            ),
                'default'   => 'yes'            
        ),

        array(
            'id'        => 'interiortitle',
            'type'      => 'text',
            'title'     => esc_html__( 'Title Interior','dreamvilla-multiple-property'),
            'default'   => 'Interior'
        ),

        array(
                'id'       => 'displayroomdimensions',
                'type'     => 'button_set',
                'title'    => esc_html__('Display Room Dimensions','dreamvilla-multiple-property'), 
                'options'  => array(
                                'yes' => 'Yes',
                                'no' => 'No'
                            ),
                'default'   => 'yes'                
        ),

        array(
            'id'        => 'roomdimensionstitle',
            'type'      => 'text',
            'title'     => esc_html__( 'Title Room Dimensions','dreamvilla-multiple-property'),
            'default'   => 'Room Dimensions'
        ),

        array(
                'id'       => 'displayexterior',
                'type'     => 'button_set',
                'title'    => esc_html__('Display Exterior','dreamvilla-multiple-property'), 
                'options'  => array(
                                'yes' => 'Yes',
                                'no' => 'No'
                            ),
                'default'   => 'yes'                
        ),

        array(
            'id'        => 'exteriortitle',
            'type'      => 'text',
            'title'     => esc_html__( 'Title Exterior','dreamvilla-multiple-property'),
            'default'   => 'Exterior'
        ),

        array(
                'id'       => 'displaygoodsinclude',
                'type'     => 'button_set',
                'title'    => esc_html__('Display Goods Include','dreamvilla-multiple-property'), 
                'options'  => array(
                                'yes' => 'Yes',
                                'no' => 'No'
                            ),
                'default'   => 'yes'                
        ),

        array(
            'id'        => 'goodsincludetitle',
            'type'      => 'text',
            'title'     => esc_html__( 'Title Goods Include','dreamvilla-multiple-property'),
            'default'   => 'Goods Include'
        ),

        array(
                'id'       => 'displayflooring',
                'type'     => 'button_set',
                'title'    => esc_html__('Display Flooring','dreamvilla-multiple-property'), 
                'options'  => array(
                                'yes' => 'Yes',
                                'no' => 'No'
                            ),
                'default'   => 'yes'                
        ),

        array(
            'id'        => 'flooringtitle',
            'type'      => 'text',
            'title'     => esc_html__( 'Title Flooring','dreamvilla-multiple-property'),
            'default'   => 'Flooring'
        ),

        array(
                'id'       => 'displayfloorplan',
                'type'     => 'button_set',
                'title'    => esc_html__('Display Floor Plans','dreamvilla-multiple-property'), 
                'options'  => array(
                                'yes' => 'Yes',
                                'no' => 'No'
                            ),
                'default'   => 'yes'                
        ),

        array(
            'id'        => 'floorplantitle',
            'type'      => 'text',
            'title'     => esc_html__( 'Title Floor Plan','dreamvilla-multiple-property'),
            'default'   => 'Floor Plan'
        ),

        array(
                'id'       => 'displaynearbyplaces',
                'type'     => 'button_set',
                'title'    => esc_html__('Display Near By Places','dreamvilla-multiple-property'), 
                'options'  => array(
                                'yes' => 'Yes',
                                'no' => 'No'
                            ),
                'default'   => 'yes'                
        ),

        array(
            'id'        => 'nearybyplacestitle',
            'type'      => 'text',
            'title'     => esc_html__( 'Title Near By Places','dreamvilla-multiple-property'),
            'default'   => 'Near By Places'
        ),

        array(
                'id'       => 'sharepropertystatus',
                'type'     => 'button_set',
                'title'    => esc_html__('Display Share Property','dreamvilla-multiple-property'), 
                'options'  => array(
                                'yes' => 'Yes',
                                'no' => 'No'
                            ),
                'default'   => 'yes'                
        ),

        array(
            'id'        => 'sharepropertylabel',
            'type'      => 'text',
            'title'     => esc_html__( 'Title Share Property','dreamvilla-multiple-property'),
            'default'   => 'Share This Property'
        ),

        array(
                'id'       => 'displaygetdirections',
                'type'     => 'button_set',
                'title'    => esc_html__('Display Get Directions','dreamvilla-multiple-property'), 
                'options'  => array(
                                'yes' => 'Yes',
                                'no' => 'No'
                            ),
                'default'   => 'yes'                
        ),

        array(
            'id'        => 'getdirectionstitle',
            'type'      => 'text',
            'title'     => esc_html__( 'Title Get Directions','dreamvilla-multiple-property'),
            'default'   => 'Get Directions'
        ),

        array(
                'id'       => 'displaypropertyfilter',
                'type'     => 'button_set',
                'title'    => esc_html__('Display Property Filter','dreamvilla-multiple-property'), 
                'options'  => array(
                                'yes' => 'Yes',
                                'no' => 'No'
                            ),
                'default'   => 'yes'                
        ),

        array(
            'id'        => 'titlepropertyfilter',
            'type'      => 'text',
            'title'     => esc_html__( 'Title Of Property Fileter Area','dreamvilla-multiple-property'),
            'default'   => 'Find Your Dream Home'
        ),

        array(
                'id'       => 'displayagentinfo',
                'type'     => 'button_set',
                'title'    => esc_html__('Display Agent Info','dreamvilla-multiple-property'), 
                'options'  => array(
                                'yes' => 'Yes',
                                'no' => 'No'
                            ),
                'default'   => 'yes'               
        ),

        array(
            'id'        => 'agentofpropertytitle',
            'type'      => 'text',
            'title'     => esc_html__( 'Title Of Agent Property','dreamvilla-multiple-property'),
            'default'   => 'Agent Of Property'
        ),

        array(
                'id'       => 'displaysidebar',
                'type'     => 'button_set',
                'title'    => esc_html__('Display Sidebar For Mortgage And Other Widgets','dreamvilla-multiple-property'), 
                'options'  => array(
                                'yes' => 'Yes',
                                'no' => 'No'
                            ),
                'default'   => 'yes'               
        ),

        array(
                'id'       => 'displaycontactform',
                'type'     => 'button_set',
                'title'    => esc_html__('Display Contact Form','dreamvilla-multiple-property'), 
                'options'  => array(
                                'yes' => 'Yes',
                                'no' => 'No'
                            ),
                'default'   => 'yes'                
        ),

        array(
            'id'        => 'contactformtitledetail',
            'type'      => 'text',
            'title'     => esc_html__( 'Title Contact Form','dreamvilla-multiple-property'),
            'default'   => 'Request Inquiry'
        ),

        array(
                'id'       => 'displayadvertisement',
                'type'     => 'button_set',
                'title'    => esc_html__('Display Advertisement','dreamvilla-multiple-property'), 
                'options'  => array(
                                'yes' => 'Yes',
                                'no' => 'No'
                            ),
                'default'   => 'yes'                
        ),

        array(
                'id'       => 'displaypropertyvideo',
                'type'     => 'button_set',
                'title'    => esc_html__('Display Property Video','dreamvilla-multiple-property'), 
                'options'  => array(
                                'yes' => 'Yes',
                                'no' => 'No'
                            ),
                'default'   => 'yes'                
        ),

        array(
            'id'        => 'propertyvideotitle',
            'type'      => 'text',
            'title'     => esc_html__( 'Title Property Video','dreamvilla-multiple-property'),
            'default'   => 'Property Video'
        ),

        array(
                'id'       => 'displaysimilarproperty',
                'type'     => 'button_set',
                'title'    => esc_html__('Display Similar Property','dreamvilla-multiple-property'), 
                'options'  => array(
                                'yes' => 'Yes',
                                'no' => 'No'
                            ),
                'default'   => 'yes'                
        ),

        array(
            'id'        => 'similarpropertytitle',
            'type'      => 'text',
            'title'     => esc_html__( 'Title Similar Property','dreamvilla-multiple-property'),
            'default'   => 'Similar Properties'
        ),

        array(
                'id'       => 'displaysubproperty',
                'type'     => 'button_set',
                'title'    => esc_html__('Display Sub Property','dreamvilla-multiple-property'), 
                'options'  => array(
                                'yes' => 'Yes',
                                'no' => 'No'
                            ),
                'default'   => 'yes'                
        ),

        array(
            'id'        => 'subpropertytitle',
            'type'      => 'text',
            'title'     => esc_html__( 'Title Sub Property','dreamvilla-multiple-property'),
            'default'   => 'Sub Properties'
        ),

        array(
                'id'       => 'displaystreeviewmap',
                'type'     => 'button_set',
                'title'    => esc_html__('Display Property Street View Map','dreamvilla-multiple-property'), 
                'options'  => array(
                                'yes' => 'Yes',
                                'no' => 'No'
                            ),
                'default'   => 'yes'                
        ),

        array(
            'id'        => 'propertystreetviewtitle',
            'type'      => 'text',
            'title'     => esc_html__( 'Title Property Street View Map','dreamvilla-multiple-property'),
            'default'   => 'Property Street View'
        ),

    )   ) 
);
