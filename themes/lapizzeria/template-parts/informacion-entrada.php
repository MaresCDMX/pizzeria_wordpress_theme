<header class="informacion-entrada"><div class="fecha">
    <time><?php the_time('d'); ?></time>
      <span><?php the_time('M'); ?></span>
  </div>
  <?php if(is_home()): ?>
    <div class="titulo-entrada"> 
         <h2> <?php the_title(); ?> </h2> 
    </div>
  <?php endif; ?>
 </header>
    <div class="autor">
        <p>Escrito por:
           <span>
             <?php the_author(); ?>
         </span> 
       </p>
    </div>