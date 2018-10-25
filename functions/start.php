<?php

//Use this file for wp menus, sidebars, image sizes, loadup scripts.



//enqueue scripts and styles *use production assets. Dev assets are located in  /css and /js
function loadup_scripts() {
    //wp_enqueue_script( 'tools-js', '//cdnjs.cloudflare.com/ajax/libs/jquery-tools/1.2.7/jquery.tools.min.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'slick-js', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '1.0.0', true );

    wp_enqueue_script( 'ui-js', get_template_directory_uri().'/js/jquery.ui.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'kinetic-js', get_template_directory_uri().'/js/jquery.kinetic.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'sidr-js', get_template_directory_uri().'/js/jquery.sidr.min.js', array('jquery'), '1.0.0', true );
     wp_enqueue_script( 'smooth-js', get_template_directory_uri().'/js/smoothdivscroll.js', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'theme-js', get_template_directory_uri().'/js/mesh.js', array('jquery'), '1.0.0', true );

    wp_enqueue_style( 'slick-style', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', true );
    wp_enqueue_style( 'sidr-style', get_template_directory_uri().'/css/jquery.sidr.bare.css', true );

    //wp_enqueue_style( 'slick-theme', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css', true );
}
add_action( 'wp_enqueue_scripts', 'loadup_scripts' );

// Add Thumbnail Theme Support
add_theme_support('post-thumbnails');
add_image_size('background-fullscreen', 1800, 1200, true);
add_image_size('short-banner', 1800, 800, true);
add_image_size('listing-bg', 1800, 900, true); //Event Listing Background
add_image_size('home-feature', 1800, 1200, true); //Home page featured event
add_image_size('event-banner', 1800, 1000, true); //Single Event Banner
add_image_size('large', 700, '', true); // Large Thumbnail
add_image_size('medium', 250, '', true); // Medium Thumbnail
add_image_size('small', 120, '', true); // Small Thumbnail
add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

add_image_size('square', 800, 800, true);



//Register WP Menus
register_nav_menus(
    array(
        'main_nav' => 'Header and breadcrumb trail heirarchy',
        'footer_nav' => 'Navigation located in footer',
        'social_nav' => 'Social menu used throughout'
    )
);

// Register Widget Area for the Sidebar
register_sidebar( array(
    'name' => __( 'Primary Widget Area', 'Sidebar' ),
    'id' => 'primary-widget-area',
    'description' => __( 'The primary widget area', 'Sidebar' ),
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
) );









?>
