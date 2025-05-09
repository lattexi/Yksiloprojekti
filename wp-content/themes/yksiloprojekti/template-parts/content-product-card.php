<article id="post-<?php the_ID(); ?>" <?php post_class( 'product-card' ); ?>>
  <a href="<?php the_permalink(); ?>">
    <?php
      if ( has_post_thumbnail() ) {
          the_post_thumbnail( 'product-card' );
      } else {
          echo '<img src="' . esc_url( get_template_directory_uri() . '/placeholder-400x400.jpg' ) . '" alt="">';
      }
    ?>
    <h3><?php the_title(); ?></h3>
    <?php
      $price = get_post_meta( get_the_ID(), 'price', true );
      if ( $price ) echo '<p class="price">' . esc_html( $price ) . ' €</p>';
    ?>
  </a>
</article>