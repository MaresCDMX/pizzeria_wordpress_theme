<?php get_header(); ?>
  <main class="contenedor">
    <?php while(have_posts()): the_post(); 
      the_content();
    endwhile?>
  </main>
<?php get_footer(); ?>