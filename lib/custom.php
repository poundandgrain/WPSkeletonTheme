<?php
/**
 * Custom functions
 */

function print_rr($thing) {
    print "<style>.nav-popout{display:none}</style>";
    print "<pre>";
    print_r($thing);
    print "</pre>";
}

function getImgUrl($field, $size) {

    if (is_string($field)) {
        $field = get_field($field);
    }

    $id = $field;
    if (is_array($field) && isset($field["id"])) {
        $id = $field["id"];
    }

    $image = wp_get_attachment_image_src( $id, $size);
    return isset($image[0]) ? $image[0] : "";
}

function getDateFormatted($date, $format) {
    $date = new DateTime($date);
    if ($date) {
        return date_format($date, "F j, Y");
    }
    return "";
}

function addFbUrls($text){
    // The Regular Expression filter
    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

    // Check if there is a url in the text

    // force http: on www.
    $text = preg_replace( "@www\.@", "http://www.", $text );
    // eliminate duplicates after force
    $text = preg_replace( "@http://http://www\.@", "http://www.", $text );
    $text = preg_replace( "@https://http://www\.@", "https://www.", $text );

    if(preg_match($reg_exUrl, $text, $url)) {
        // make the urls hyper links
        $text = preg_replace($reg_exUrl, '<a href="'.$url[0].'" rel="nofollow" target="_blank">'.$url[0].'</a>', $text);
    }

    return ($text);
}

if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions
}

if ( function_exists( 'add_image_size' ) ) {
    //add_image_size('homepage-banner', 584, 650, true);
}