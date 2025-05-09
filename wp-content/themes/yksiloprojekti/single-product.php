<?php get_header(); ?>

<main <?php post_class(); ?> style="max-width:900px;margin:2rem auto;padding:0 1rem;">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <h1><?php the_title(); ?></h1>
    
    <?php
      if ( has_post_thumbnail() ) {
          the_post_thumbnail( 'large', [ 'style' => 'width:400px;height:auto;margin-bottom:1.5rem;' ] );
        }
        ?>

<div><?php the_content(); ?></div>

    <?php
      $price = get_post_meta( get_the_ID(), 'price', true );
      if ( $price ) echo '<p style="font-size:1.5rem;font-weight:700;margin-top:1rem;">Hinta: ' . esc_html( $price ) . ' €</p>';
    ?>

  <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>