<?php get_header(); ?>

<section class="hero">
<?php
  $hero_src = get_header_image();
  if ( $hero_src ) {
      echo '<img src="' . esc_url( $hero_src ) . '" alt="">';
  } else {
      echo '<img src="' . esc_url( get_template_directory_uri() . '/hero.jpg' ) . '" alt="">';
  }
?>
</section>

<div class="site-wrapper">
<?php the_content(); ?>

<?php
$loop = new WP_Query( [
    'post_type'      => 'product',
    'posts_per_page' => 4,
    'meta_key'       => '_is_featured_product',
    'meta_value'     => '1',        // vain featured
    'meta_compare'   => '=',
    'meta_type'      => 'NUMERIC',
] );

if ( $loop->have_posts() ) : ?>
  <div class="products-grid">
    <?php
      while ( $loop->have_posts() ) : $loop->the_post();
        get_template_part( 'template-parts/content', 'product-card' );
      endwhile;
      wp_reset_postdata();
    ?>
  </div>
<?php endif; ?>

<?php get_footer(); ?>