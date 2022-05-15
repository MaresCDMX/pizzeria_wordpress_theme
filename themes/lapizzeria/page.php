<?php get_header(); ?>

<?php while(have_posts()): the_post(  ); ?>
    <div class="hero" style="background-image: url(<?php echo get_the_post_thumbnail_url(  ); ?>)">
        <div class="contenido-hero">
            <h1><?php the_title(); ?></h1>
        </div>
        </div>
    </div>
    <div class="seccion contenedor">
        <main class="contenido-principal">
            <?php the_content( ); ?>
        </main>
    </div>
    
<?php endwhile; ?>

<?php get_footer(); ?>