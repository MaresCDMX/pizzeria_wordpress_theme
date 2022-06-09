<?php
/*
Plugin Name: La Pizzeria Gutenberg Blocks Plugin
Plugin URI:
Description: Plugin para agregar bloques de Gutenberg nativos a la página de la Pizzeria
Version: 1.0
Author: Jesús Mares
Author URI: https://marescdmx.github.io/Portfolio-Jesus-Mares.github.io/#home
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: lapizzeria-gutenberg
*/

if(!defined('ABSPATH')){
    die;
}

//** Categorias Personalizadas */
function lapizzeria_categoria_personalizada($categories, $post){
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'lapizzeria-gutenberg',
                'title' => 'La Pizzeria Gutenberg',
                'icon' => 'wordpress',
                'description' => 'Bloques para la página de la Pizzeria'
            )
        )
    );
}
add_filter('block_categories', 'lapizzeria_categoria_personalizada', 10, 2);

/** Registrar bloques, scripts y CSS */
function lapizzeria_registrar_bloques() {
  // Si Gutenberg no está instalado, salir
  if(!function_exists('register_block_type')){
    return;
  }
  // Registrar bloques
  wp_register_script(
    'lapizzeria-editor-script',  // Nombre unico
    plugins_url('build/index.js', __FILE__), // Ruta al archivo JS con los bloques
    array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ),// Dependencias
    filemtime( plugin_dir_path( __FILE__ ) . 'build/index.js' ) // Versión del archivo JS
  );
  // Estilos para el editor de Gutenberg
  wp_register_style(
    'lapizzeria-editor-style',  // Nombre unico
    plugins_url('build/editor.css', __FILE__), // Ruta al archivo CSS para el editor
    array( 'wp-edit-blocks' ), // Dependencias
    filemtime( plugin_dir_path( __FILE__ ) . 'build/editor.css' ) // Versión del archivo CSS
  );
  // Estilos para los bloques el frontend y backend (editor y listado)
  wp_register_style(
    'lapizzeria-front-style',  // Nombre unico
    plugins_url('build/style.css', __FILE__), // Ruta al archivo CSS para el frontend
    array( ), // Dependencias
    filemtime( plugin_dir_path( __FILE__ ) . 'build/style.css' ) // Versión del archivo CSS
  );
  // Registrar bloques
  // Arreglo de bloques
  $blocks = [
    'lapizzeria/boxes',
    'lapizzeria/galeria',
    'lapizzeria/hero',
    'lapizzeria/hero2',
  ];
  // Recorrer arreglo de bloques, agergar scripts y estilos
  foreach($blocks as $block){
    register_block_type($block, array(
      'editor_script' => 'lapizzeria-editor-script', // Scripts para el editor
      'editor_style' => 'lapizzeria-editor-style', // Estilos para el editor
      'style' => 'lapizzeria-front-style' // Estilos para el frontend
    ));
  }
  // Registrar un bloque dinamico
  register_block_type('lapizzeria/menu', array(
    'editor_script' => 'lapizzeria-editor-script', // Scripts para el editor
    'editor_style' => 'lapizzeria-editor-style', // Estilos para el editor
    'style' => 'lapizzeria-front-style', // Estilos para el frontend
    'render_callback' => 'lapizzeria_especialidades_frontend' // Query a la base de datos
  ));

}
add_action( 'init', 'lapizzeria_registrar_bloques' );

//Consulta a la base de datos para mostrar los resultados en el frontend
function lapizzeria_especialidades_frontend($atts) {
  // Extraer los valores de los atributos y agregar defaults
  $cantidad = $atts['cantidadMostrar'] ? $atts['cantidadMostrar'] : 4;
  $titulo_bloque = $atts['tituloBloque'] ? $atts['tituloBloque'] : 'Nuestras Especialidades';
  $tax_query = array();

  if(isset($atts['categoriaMenu'])){
    $tax_query[] = array(
      'taxonomy' => 'categoria-menu',
      'field' => 'term_id',
      'terms' => $atts['categoriaMenu']
    );
  }

  //Obtener los datos del Query
  $especialidades = wp_get_recent_posts(array(
    'post_type' => 'especialidades',
    'post_status' => 'publish',
    'numberposts' => $cantidad,
    'tax_query' => $tax_query
    )
  );
  //Revisar que existan resultados
  if(count($especialidades) === 0){
    return 'No hay especialidades';
  }
  //Iniciar el HTML de la respuesta
  $html = '';
  //Recorrer los resultados
  $html .= '<h2 class="titulo-menu">';
  $html .= $titulo_bloque;
  $html .= '</h2>';
  $html .= '<ul class="nuestro-menu">';
  foreach($especialidades as $especialidad){
    //obtner un objeto del post
    $post = get_post($especialidad['ID']);
    setup_postdata($post);
    $html .= sprintf('<li>
              %1$s
              <div class="platillo">
                <div class="precio-titulo">
                  <h3>%2$s</h3>
                  <p>$ %3$s</p>
                </div>
                <div class="contenido-platillo">
                  <p>
                    %4$s
                  </p>
                </div>
              </div>
    </li>', get_the_post_thumbnail($post, 'especialidades'), get_the_title($post),get_field('precio', $post), get_the_content($post)
    );
    wp_reset_postdata();
  }
  $html .= '</ul>';
  return $html;
}

/** Agrega Lightbox a plugin */
function lapizzeria_frontend_scripts() {
  // Registrar el script  
  wp_enqueue_script(
    'lightboxjs',  // Nombre unico
    'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.js', // Ruta al archivo JS con los bloques
    array( 'jquery' ),// Dependencias
    '2.11.3', // Versión del archivo JS
    true // Enlazar al footer
  );

  // Registrar el estilo
  wp_enqueue_style(
    'lightbox',  // Nombre unico
    'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.css', // Ruta al archivo CSS para el editor
    array( ), // Dependencias
    '2.11.3'// Versión del archivo CSS
  );

 
}
add_action( 'wp_enqueue_scripts', 'lapizzeria_frontend_scripts' );