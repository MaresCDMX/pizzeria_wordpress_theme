<?php

function lapizzeria_setup() {
/** Titulos para SEO */
  add_theme_support('title-tag');

  /** Gutenberg */

  // Soporte a estilos por default de Gutenberg en el tema

  add_theme_support( 'wp-block-styles' );

  // Soporte a contenido completo

  add_theme_support( 'align-wide' );

  // Paleta de Colores
  add_theme_support('editor-color-palette', array(
    array(
      'name' => 'Amarillo',
      'slug' => 'amarillo',
      'color' => '#fcdf7b
      '
    ),
    array(
      'name' => 'Verde',
      'slug' => 'verde',
      'color' => '#127427'
    ),
    array(
      'name' => 'Rojo',
      'slug' => 'rojo',
      'color' => '#dd4826'
    ),
    array(
      'name' => 'Naranja',
      'slug' => 'naranja',
      'color' => '#f7b917'
    ),
    array(
      'name' => 'Gris',
      'slug' => 'gris',
      'color' => '#c1c1c1'
    ),
    array(
      'name' => 'Blanco',
      'slug' => 'blanco',
      'color' => '#FFFFFF'
    ),
    array(
      'name' => 'Negro',
      'slug' => 'negro',
      'color' => '#000000'
    )
  ));
  //Deshabilitar el editor de colores
  add_theme_support( 'disable-custom-colors' );

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

// Agregar zona de widgets

function lapizzeria_widgets() {
  register_sidebar( array(
    'name' => 'Blog Sidebar',
    'id' => 'blog_sidebar',
    'before_widget' => '<div class="widget">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  ));
  
}
add_action( 'widgets_init', 'lapizzeria_widgets' );
// Agregar botones a paginador

function lapizzeria_botones_paginador() {
  return 'class="boton boton-secundario"';
}

add_filter( 'next_posts_link_attributes', 'lapizzeria_botones_paginador' );
add_filter( 'previous_posts_link_attributes', 'lapizzeria_botones_paginador' );