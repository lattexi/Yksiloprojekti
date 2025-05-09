<?php
get_header(); ?>

<main style="max-width:900px;margin:2rem auto;padding:0 1rem;">

  <?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

      <?php
        get_template_part(
          'template-parts/content',
          get_post_type(),
          [ 'in_index' => true ]
        );
      ?>

    <?php endwhile; ?>

    <?php the_posts_navigation(); ?>

  <?php else : ?>

    <?php get_template_part( 'template-parts/content', 'none' ); ?>

  <?php endif; ?>

</main>

<?php get_footer(); ?>