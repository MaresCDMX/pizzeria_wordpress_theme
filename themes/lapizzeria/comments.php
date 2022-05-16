<div class="contenedor comentarios">
  <?php 
    //Comentarios
    $args = array(
      'class_submit' => 'boton boton-primario'
      
    );
      comment_form($args); 
  ?>
  <h2 class="text-center comments-title">Comentarios</h2>
  <ul class="lista-comentarios">
      <?php 
        $args = array(
          'post_id' => $post->ID,
          'status' => 'approve'
        );
        $comments = get_comments($args);
        $args2 = array(
          'per_page' => 10,
          'reverse_top_level' => __return_false()
        );
        wp_list_comments($args2, $comments);
      ?>
  </ul>
</div>