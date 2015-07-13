<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// Returns the carousel images as an array
function btcrg_getcarousel($btcrg_shortcode=null){
    if($btcrg_shortcode === null || $btcrg_shortcode===""){
        return false;
    }
    if(is_int($btcrg_shortcode)){
        // The ID of the carousel has been specified
        // Get the records
        $sliderpostsArg = array(
            'post_type'		=> 'btcrg',
            'p' => intval($btcrg_shortcode),
            'post_status' => 'publish',
            'posts_per_page' => 1,
        );

    }else{
        // The shortname has been supplied
        // Get the records
        $sliderpostsArg = array(
            'post_type'		=> 'btcrg',
            'meta_query'	=> array(
                array(
                    'key'	  	=> 'rg_carousel_shortname',
                    'value'	  	=> $btcrg_shortcode,
                )
            ),
            'post_status' => 'publish',
            'posts_per_page' => 1,
        );

    }
    $sliderposts = new WP_Query($sliderpostsArg);

    if($sliderposts->have_posts()) {
        $carouselSet = null;
        while($sliderposts->have_posts()) {
            $carouselSetEntry = null;
            $sliderposts->the_post();
            if (get_field('rg_carousel_items', $sliderposts->post->ID)) {
                $carouselSetEntry['shortname']= get_field('rg_carousel_shortname', $sliderposts->post->ID);
                $carouselSetEntry['autoplay']=get_field('rg_carousel_autoplay', $sliderposts->post->ID);

                $carouselSetEntry['rg_carousel_left_arrow']=get_field('rg_carousel_left_arrow',$sliderposts->post->ID);
                if($carouselSetEntry['rg_carousel_left_arrow'] == ""){$carouselSetEntry['rg_carousel_left_arrow']="glyphicon glyphicon-chevron-left";}
                $carouselSetEntry['rg_carousel_right_arrow']=get_field('rg_carousel_right_arrow',$sliderposts->post->ID);
                if($carouselSetEntry['rg_carousel_right_arrow'] == ""){$carouselSetEntry['rg_carousel_right_arrow']="glyphicon glyphicon-chevron-right";}

                $bannerSet = null;
                $buttonStyle = get_field('rg_carousel_button_style', $sliderposts->post->ID);
                if ($buttonStyle == "none") {
                    $buttonStyle = "btn-" . $shortname;
                } elseif ($buttonStyle == "") {
                    $buttonStyle = "btn-default";
                }


                // CSS Gradient Background
                $carouselSet['gradient_overlay'] = null;
                $colorDataRaw = null;
                while (has_sub_field('rg_carousel_gradient_overlay', $sliderposts->post->ID)) {
                    $gradientOverlayOffset = intval(get_sub_field('rg_carousel_gradient_position_offset'));
                    $colorDataRaw[$gradientOverlayOffset] = hex2rgb(get_sub_field('rg_carousel_gradient_position_color'));
                    $colorDataRaw[$gradientOverlayOffset][] = floatval(get_sub_field('rg_carousel_gradient_position_alpha')/100);
                }
                $colorDataPositionCount = count($colorDataRaw);
                if($colorDataPositionCount>=0 && is_array($colorDataRaw)){
                    //gradient detected
                    $i=1;
                    foreach($colorDataRaw as $colorOffset => $colorBlob){
                        $colorBlobImploded = implode(",",$colorBlob);

                        // Mozilla
                        if($i == 1 && $colorOffset != 0){
                            // No start Listed.  Use first Entry
                            $carouselSetEntry['gradient_overlay']['general-gradient'][$colorOffset] = "rgba($colorBlobImploded) 0%";
                        }
                        $carouselSetEntry['gradient_overlay']['general-gradient'][$colorOffset] = "rgba($colorBlobImploded) $colorOffset%";
                        if($i == $colorDataPositionCount && $colorOffset != 100){
                            // No start Listed.  Use first Entry
                            $carouselSetEntry['gradient_overlay']['general-gradient'][$colorOffset] = "rgba($colorBlobImploded) 100%";
                        }
                        $carouselSetEntry['gradient_overlay']['general-gradient'][$colorOffset] = "rgba($colorBlobImploded) $colorOffset%";


                        // Webkit Gradient
                        if($i == 1 && $colorOffset != 0){
                            // No start Listed.  Use first Entry
                            $carouselSetEntry['gradient_overlay']['webkit-gradient'][$colorOffset] = "color-stop(0% rgba($colorBlobImploded))";
                        }
                        $carouselSetEntry['gradient_overlay']['webkit-gradient'][$colorOffset] = "color-stop($colorOffset% rgba($colorBlobImploded))";
                        if($i == $colorDataPositionCount && $colorOffset != 100){
                            // No start Listed.  Use first Entry
                            $carouselSetEntry['gradient_overlay']['webkit-gradient'][$colorOffset] = "color-stop(100% rgba($colorBlobImploded))";
                        }


                        $i++;
                    }
                }



                // The Slides
                while (has_sub_field('rg_carousel_items', $sliderposts->post->ID)) {
                    // loop through the rows of data
                    // Foreach slide
                    // rg_carousel_item_image  rg_carousel_item_text_content   rg_carousel_item_cta_label         rg_carousel_item_cta_link
                    $bannerEntry = null;
                    $bannerEntry['rg_carousel_item_image'] = get_sub_field('rg_carousel_item_image');
                    $bannerEntry['rg_carousel_item_text_content'] = get_sub_field('rg_carousel_item_text_content');
                    $bannerEntry['rg_carousel_item_cta_label'] = get_sub_field('rg_carousel_item_cta_label');
                    $bannerEntry['rg_carousel_item_cta_link'] = get_sub_field('rg_carousel_item_cta_link');
                    $bannerEntry['rg_carousel_button_style'] = $buttonStyle;

                    $bannerSet[] = $bannerEntry;


                    // display a sub field value
                    //get_sub_field('sub_field_name');

                }
                $carouselSetEntry['bannerSet']=$bannerSet;

            }
            $carouselSet = $carouselSetEntry;
        }
        wp_reset_postdata();
        return $carouselSet;
    }else{
        wp_reset_postdata();
        return false;
    }

}// btcrg_getcarousel



// Uses the array returned by get function to render the carousel / slider
function btcrg_render($btcrg_shortcode=null){
    $carouselSetEntry = btcrg_getcarousel($btcrg_shortcode);
    if($carouselSetEntry == false){
        return false;
    }

        ?>
        <div id="rg-carousel-<?php echo $carouselSetEntry['shortname'] ?>" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php
                // Render container close
                foreach ($carouselSetEntry['bannerSet'] as $key => $value) {
                    if ($key == 0) {
                        $bannerActive = "class=\"active\"";
                    } else {
                        $bannerActive = "";
                    }
                    echo "\n<li data-target=\"#rg-carousel-".$carouselSetEntry['shortname']."\" data-slide-to=\"$key\" $bannerActive></li>";
                }
                ?>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php
                foreach ($carouselSetEntry['bannerSet'] as $key => $value) {
                    if ($key == 0) {
                        $bannerActive = " active";
                    } else {
                        $bannerActive = "";
                    }
                    ?>
                    <div class="item itemnumber-<?php echo $key . $bannerActive; ?>">
                        <?php
                        if(count($carouselSetEntry['gradient_overlay'])>0){
                            // Gradient Image Overlay Present
                            echo "\n<div class=\"bootstrap-carousel-rg-gradient\">&nbsp;</div>\n";

                        }
                        ?>
                        <img src="<?php echo $value['rg_carousel_item_image']['sizes']['bootstrapcarouselrgslide']; ?>" alt="<?php echo $value['rg_carousel_item_image']['title']; ?>">

                        <div class="carousel-caption">
                            <?php

                            echo $value['rg_carousel_item_text_content'];
                            if ($value['rg_carousel_item_cta_link'] != "") {
                                if ($value['rg_carousel_item_cta_label'] == "") {
                                    $value['rg_carousel_item_cta_label'] = "Learn More";
                                }
                                echo "<p><a href=\"" . $value['rg_carousel_item_cta_link'] . "\" class=\"btn " . $value['rg_carousel_button_style'] . "\">" . $value['rg_carousel_item_cta_label'] . "</a></p>";
                            }

                            ?>
                        </div>
                        <!-- end carousel-caption -->
                    </div><!-- end item -->
                <?php
                }
                ?>

            </div>
            <!-- end carousel-inner -->

            <!-- Controls -->
            <a class="left carousel-control" href="#rg-carousel-<?php echo $carouselSetEntry['shortname'] ?>" role="button"
               data-slide="prev">
                <span class="<?php echo $carouselSetEntry['rg_carousel_left_arrow']; ?>" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#rg-carousel-<?php echo $carouselSetEntry['shortname'] ?>" role="button"
               data-slide="next">
                <span class="<?php echo $carouselSetEntry['rg_carousel_right_arrow']; ?>" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <?php
        if ($carouselSetEntry['autoplay'] !== true) {
            ?>
            <script type="text/javascript">
                jQuery(document).ready(function () {
                    jQuery('#rg-carousel-<?php echo $carouselSetEntry['shortname'] ?>').carousel({interval: false});
                });
            </script>
            <?php
        }

        if(count($carouselSetEntry['gradient_overlay'])>0){
                // Output CSS for gradient Style
                ?>
                <style type="text/css">

                    #rg-carousel-<?php echo $carouselSetEntry['shortname']; ?> .bootstrap-carousel-rg-gradient {
                        width: 100%;
                        height: 100%;
                        position: absolute;
                        z-index: 9;
                        top: 0;
                        left: 0;
                        background: -moz-linear-gradient(top, <?php echo implode(", ",$carouselSetEntry['gradient_overlay']['general-gradient']); ?>); /* FF3.6+ */
                        background: -webkit-gradient(linear, left top, left bottom, <?php echo implode(", ",$carouselSetEntry['gradient_overlay']['webkit-gradient']); ?>); /* Chrome,Safari4+ */
                        background: -webkit-linear-gradient(top, <?php echo implode(", ",$carouselSetEntry['gradient_overlay']['general-gradient']); ?>); /* Chrome10+,Safari5.1+ */
                        background: -o-linear-gradient(top, <?php echo implode(", ",$carouselSetEntry['gradient_overlay']['general-gradient']); ?>); /* Opera 11.10+ */
                        background: -ms-linear-gradient(top, <?php echo implode(", ",$carouselSetEntry['gradient_overlay']['general-gradient']); ?>); /* IE10+ */
                        background: linear-gradient(to bottom, <?php echo implode(", ",$carouselSetEntry['gradient_overlay']['general-gradient']); ?>); /* W3C */
                    }

                    .carousel-control {
                        z-index: 507;
                    }
                    .carousel-indicators {
                        z-index: 505;
                    }
                    .carousel-indicators > li {
                        z-index: 506;
                    }
                </style>

                <?php

            }



}//btcrg_render



if( !function_exists('hex2rgb') ){
function hex2rgb($hex) {
    $hex = str_replace("#", "", $hex);

    if(strlen($hex) == 3) {
        $r = hexdec(substr($hex,0,1).substr($hex,0,1));
        $g = hexdec(substr($hex,1,1).substr($hex,1,1));
        $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
    }
    $rgb = array($r, $g, $b);
    //return implode(",", $rgb); // returns the rgb values separated by commas
    return $rgb; // returns an array with the rgb values
}
}
if( !function_exists('rgb2hex') ) {

    function rgb2hex($rgb)
    {
        $hex = "#";
        $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

        return $hex; // returns the hex value including the number sign (#)
    }
}