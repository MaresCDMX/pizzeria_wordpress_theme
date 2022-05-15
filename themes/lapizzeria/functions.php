<?php

function lapizzeria_setup() {
  //Imagenes destacadas
  add_theme_support('post-thumbnails');
  //Tamaño de imagen destacada
  set_post_thumbnail_size(825, 510, true);
  //Tamaño personalizado de imagen destacada
  add_image_size('nosotros', 437, 291, true);
  //Tamaño personalizado de imagen destacada
  add_image_size('especialidades', 768, 515, true);
  //Tamaño personalizado de imagen destacada
  add_image_size('especialidades-portrait', 435, 526, true);
  //Tamaño personalizado de imagen destacada
  add_image_size('galeria', 437, 291, true);
  //Tamaño personalizado de imagen destacada
  add_image_size('galeria-thumb', 576, 515, true);
  //Tamaño personalizado de imagen destacada
  add_image_size('blog', 437, 291, true);
  //Tamaño personalizado de imagen destacada
  add_image_size('blog-thumb', 576, 515, true);
  //Tamaño personalizado de imagen destacada
  add_image_size('slider', 1600, 600, true);
  //Tamaño personalizado de imagen destacada
  add_image_size('testimoniales', 768, 515, true);
  //Tamaño personalizado de imagen destacada
  add_image_size('testimoniales-thumb', 576, 515, true);
  //Tamaño personalizado de imagen destacada
  add_image_size('logo', 768, 515, true);
  //Tamaño personalizado de imagen destacada
  add_image_size('logo-thumb', 576, 515, true);

  
}
add_action( 'after_setup_theme', 'lapizzeria_setup' );

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