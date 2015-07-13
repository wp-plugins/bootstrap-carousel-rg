<?php
if ( ! defined( 'ABSPATH' ) ) exit;


// Create Shortcode
function btcrg_shortcode($atts){
    $atts = shortcode_atts(
        array(
            'shortname' => null,
        ), $atts, 'bootstrapcarouselrg' );

    if($atts['slider']!=null){
        btcrg_render($atts['shortname']);
    }

} // btcrg_shortcode()

add_shortcode( 'bootstrapcarouselrg', 'btcrg_shortcode' );




