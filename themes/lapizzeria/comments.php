<div class="contenedor comentarios">
  <?php 
    //Comentarios
    $args = array(
      'class_submit' => 'boton boton-primario',
      'title_reply' => 'Deja un comentario',
      'comment_notes_after' => '',
      'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><br /><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
      'comment_notes_before' => '',
      'comment_notes_after' => '',
      'label_submit' => 'Publicar comentario',
      'fields' => array(
        'author' => '<p class="comment-form-author"><label for="author">' . __( 'Name' ) . '</label><br /><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" /></p>',
        'email' => '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . '</label><br /><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" /></p>',
        'url' => '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label><br /><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'
      )
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