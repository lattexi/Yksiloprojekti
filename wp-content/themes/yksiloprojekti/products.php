<?php
get_header(); ?>

<main style="max-width:1200px;margin:0 auto;padding:0 1rem;">

<?php
if ( have_posts() ) :
    while ( have_posts() ) : the_post(); ?>
        <h1 style="text-align:center;margin:2rem 0;"><?php the_title(); ?></h1>

        <div class="page-intro" style="margin-bottom:3rem;">
            <?php the_content(); ?>
        </div>
<?php
    endwhile;
endif;

$paged = max( 1, get_query_var( 'paged' ) );
$prod_query = new WP_Query( [
    'post_type'      => 'product',
    'post_status'    => 'publish',
    'posts_per_page' => 12,
    'paged'          => $paged,

    'meta_key'       => '_is_featured_product',

    'meta_type'      => 'NUMERIC',                 // ↑ uusi: pakottaa num‑vertailun
    'orderby'        => [
        'meta_value_num' => 'DESC',                // 1 ennen 0
        'date'           => 'DESC',                // saman arvon sisällä uusin ensin
    ],
] );

if ( $prod_query->have_posts() ) : ?>
    <div class="products-grid">
        <?php
            while ( $prod_query->have_posts() ) : $prod_query->the_post();
                get_template_part( 'template-parts/content', 'product-card' );
            endwhile;
        ?>
    </div>

    <div style="text-align:center;margin:3rem 0;">
        <?php
            echo paginate_links( [
                'total'   => $prod_query->max_num_pages,
                'current' => $paged,
            ] );
        ?>
    </div>
<?php
    wp_reset_postdata();
else :
    echo '<p style="text-align:center;">Ei tuotteita.</p>';
endif;
?>

</main>

<?php get_footer(); ?>