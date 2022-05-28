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
    'lapizzeria/boxes'
  ];
  // Recorrer arreglo de bloques, agergar scripts y estilos
  foreach($blocks as $block){
    register_block_type($block, array(
      'editor_script' => 'lapizzeria-editor-script', // Scripts para el editor
      'editor_style' => 'lapizzeria-editor-style', // Estilos para el editor
      'style' => 'lapizzeria-front-style' // Estilos para el frontend
    ));
  }

}
add_action( 'init', 'lapizzeria_registrar_bloques' );