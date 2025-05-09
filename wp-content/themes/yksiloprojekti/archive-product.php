<?php
get_header(); ?>

<h1 style="text-align:center;margin:2rem 0;">Tuotteet</h1>

<?php if ( have_posts() ) : ?>
  <div class="products-grid">
    <?php
      while ( have_posts() ) : the_post();
        get_template_part( 'template-parts/content', 'product-card' );
      endwhile;
    ?>
  </div>
<?php
  the_posts_pagination();
else :
  echo '<p style="text-align:center;">Ei tuotteita.</p>';
endif;

get_footer();