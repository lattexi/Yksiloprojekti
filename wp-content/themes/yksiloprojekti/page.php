<?php get_header(); ?>

<main style="max-width:800px;margin:2rem auto;padding:0 1rem;">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>
  <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>