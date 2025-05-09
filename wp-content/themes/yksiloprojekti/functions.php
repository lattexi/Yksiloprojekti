<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style( 'sexshop-style', get_stylesheet_uri(), [], '1.0' );
} );

register_nav_menus( [
    'primary' => 'Päävalikko',
    'footer'  => 'Footer‑valikko',
] );

add_action( 'init', function () {
    register_post_type( 'product', [
        'labels' => [
            'name'          => 'Tuotteet',
            'singular_name' => 'Tuote',
            'add_new_item'  => 'Lisää uusi tuote',
            'edit_item'     => 'Muokkaa tuotetta',
        ],
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => [ 'slug' => 'tuotteet' ],
        'menu_icon'    => 'dashicons-cart',
        'supports'     => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
    ] );
} );

add_filter( 'template_include', function ( $template ) {
    if ( is_singular( 'product' ) ) {
        $single = locate_template( 'single-product.php' );
        if ( $single ) return $single;
    }
    if ( is_post_type_archive( 'product' ) ) {
        $archive = locate_template( 'archive-product.php' );
        if ( $archive ) return $archive;
    }
    return $template;
} );

add_action( 'after_setup_theme', function () {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'product-card', 400, 300, true );
    add_theme_support( 'custom-header', [
        'width'         => 1920,
        'height'        => 800,
        'flex-width'    => true,
        'flex-height'   => true,
        'uploads'       => true,
    ] );

    add_theme_support( 'custom-logo', [
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
        'unlink-homepage-logo' => false,
    ] );
} );

add_action( 'add_meta_boxes', function () {
    add_meta_box(
        'product_featured_mb',
        'Featured product',
        function ( $post ) {
            $checked = get_post_meta( $post->ID, '_is_featured_product', true ) === '1';
            echo '<label><input type="checkbox" name="is_featured_product" value="1" ' . checked( $checked, true, false ) . '> Show as featured</label>';
        },
        'product',
        'side',
        'high'
    );
} );

add_action( 'save_post_product', function ( $post_id, $post, $update ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    $is_featured = isset( $_POST['is_featured_product'] ) ? '1' : '0';
    update_post_meta( $post_id, '_is_featured_product', $is_featured );
}, 10, 3 );