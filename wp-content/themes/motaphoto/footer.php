<?php
get_template_part( 'modal-contact' );
?>


<?php get_template_part('template-parts/footer/footer-widgets'); ?>

<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="container2">
        <nav id="footer-navigation" class="footer-navigation" role="navigation">
            <?php
            wp_nav_menu(array(
                'menu' => 'footer', // Remplacez 'footer' par le nom de votre menu du footer
                'menu_id' => 'footer-menu',
            ));
            ?>
        </nav><!-- #footer-navigation -->
    </div><!-- .container -->
</footer><!-- #colophon -->

</div><!-- #page -->

</body>

</html>