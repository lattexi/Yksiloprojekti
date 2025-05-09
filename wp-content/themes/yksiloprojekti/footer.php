</div>
<footer>
  <?php
    wp_nav_menu( [
      'theme_location' => 'footer',
      'container'      => 'nav',
      'fallback_cb'    => false,
    ] );
  ?>
  <p>© <?php echo date( 'Y' ); ?> Seksilelukauppa</p>
</footer>

<?php wp_footer(); ?>
</body>
</html>