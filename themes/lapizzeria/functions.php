<?php

/** CSS y JS */

function lapizzeria_styles() {
// agregar hoja de estilos CSS
wp_enqueue_style('normalize', 'https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css', array(), '8.0.1');
wp_enqueue_style('slicknavCSS', 'https://cdnjs.cloudflare.com/ajax/libs/SlickNav/1.0.10/slicknav.min.css', array('normalize'), '1.0.10');
wp_enqueue_style('style', get_stylesheet_uri(), array('normalize'), '1.0.0');
wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Arimo&family=Quicksand:wght@300;500;700&display=swap', array(), '1.0.0');
// Scripts
wp_enqueue_script( 'slicknavJS', 'https://cdnjs.cloudflare.com/ajax/libs/SlickNav/1.0.10/jquery.slicknav.min.js
', array('jquery'), '1.0.0', true );

}
wp_enqueue_script( 'scripts', get_template_directory_uri().'/js/scripts.js', array('jquery'), '1.0.0', true );

add_action( 'wp_enqueue_scripts', 'lapizzeria_styles' );

/** Menus */
function lapizzeria_menus() {
  register_nav_menus(array(
    'header-menu' => __('Header Menu', 'lapizzeria'),
    'social-menu' => __('Social Menu', 'lapizzeria'),
  ));
}
add_action( 'init', 'lapizzeria_menus' );