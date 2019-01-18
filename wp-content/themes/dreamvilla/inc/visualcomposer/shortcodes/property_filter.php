<?php
vc_map(
    array(
         "name"         => "Property Filter",
         "base"         => "property_filter",
         "description"  => esc_html__( "Property Filter Section ", 'dreamvilla' ),
         "category"     => esc_html__( 'Dreamvilla Shortcodes', 'dreamvilla' ),
         "icon"         => "dreamvilla_ourclients",
         "params" => array(

              array(
                "type"        => "dropdown",
                "heading"     => esc_html__( "Type", 'dreamvilla' ),
                "param_name"  => "filter_type",
                "value"       => array(
                                      "Type 1" => '1',
                                      "Type 2" => '2',                    
                                    ),
                "description" => esc_html__( "You can choose among these pre-designed types.", 'dreamvilla')
            ), 

         ),
    )
);
?>