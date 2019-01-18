<?php
vc_map(
    array(
         "name"         => "Our Clients",
         "base"         => "ourclientsbox",
         "description"  => esc_html__( "Our Clients Box", 'dreamvilla' ),
         "category"     => esc_html__( 'Dreamvilla Shortcodes', 'dreamvilla' ),
         "icon"         => "dreamvilla_ourclients",
         "params" => array(

              array(
                "type"         => "attach_images",
                "heading"      => esc_html__("Clients Images", "dreamvilla"),
                "description"  => esc_html__("Our Clients Images", "dreamvilla"),
                "param_name"   => "client_images",
              ),          
         ),
    )
);
?>