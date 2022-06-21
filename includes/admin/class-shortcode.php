<?php
/*
* Shortcode for display google map
*/
function bgm_maps_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
    "align" => 'center', "width" => '500', "height" => '300', "address" => '', "info_window" => 'A',
    "zoom" => '14', "companycode" => '',"maptype" => 'm' ), $atts));

    $query_string = 'q=' . urlencode($address) . '&cid=' . urlencode($companycode) . '&t=' . urlencode($maptype) . '&center=' . urlencode($address);
    
    return '<div class="bg-map"><iframe align="'.$align.'" width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?&'.htmlentities($query_string).'&output=embed&z='.$zoom.'&iwloc='.$info_window.'&visual_refresh=true"></iframe></div>';
    }
	add_shortcode("bgm_map", "bgm_maps_shortcode");
?>