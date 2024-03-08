<?php
wp_enqueue_script('jquery');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php wp_head(); ?>
    
</head>

<body <?php body_class(); ?>>

<header id="masthead" class="site-header" role="banner">
    <div class="container">
        <div class="site-branding">
            <!-- Insérez le lien de votre logo ci-dessous -->
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/asset/img/Logo.webp" alt="Logo du site">
            </a>
        </div>

        <!-- Bouton burger pour le menu mobile -->
        <button class="menu-toggle" aria-controls="mobile-menu" aria-expanded="false">
            <span class="burger-icon"></span>
            
        </button>

        <!-- Menu principal -->
        <nav id="site-navigation" class="main-navigation" role="navigation">
            <?php
            wp_nav_menu(array(
                'menu' => 'principal',
                'menu_id' => 'primary-menu',
            ));
            ?>
        </nav><!-- #site-navigation -->

        <!-- Menu déroulant mobile -->
        <div class="mobile-menu" id="mobile-menu">
            <?php
            wp_nav_menu(array(
                'menu' => 'principal',
                'menu_id' => 'mobile-menu-list',
            ));
            ?>
        </div>
    </div><!-- .container -->
</header><!-- #masthead -->
<style>
    .burger-icon {
        display: block;
        width: 30px;
        height: 30px;
        background: url('<?php echo get_stylesheet_directory_uri(); ?>/asset/img/Menu.png') no-repeat center;
        background-size: contain;
        transition: transform 0.3s ease-in-out;
    }

    .menu-open .burger-icon {
        transform: rotate(-45deg);
        background: url('<?php echo get_stylesheet_directory_uri(); ?>/asset/img/Menux.png') no-repeat center;
        background-size: contain;
    }
</style>

<?php wp_footer(); ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var menuToggle = document.querySelector(".menu-toggle");
        var mobileMenu = document.querySelector(".mobile-menu");

        menuToggle.addEventListener("click", function() {
            this.classList.toggle("menu-open");
            mobileMenu.classList.toggle("menu-open");
        });

        // Fermer le menu lorsque vous cliquez sur un lien du menu
        var mobileMenuLinks = document.querySelectorAll(".mobile-menu a");

        mobileMenuLinks.forEach(function(link) {
            link.addEventListener("click", function() {
                menuToggle.classList.remove("menu-open");
                mobileMenu.classList.remove("menu-open");
            });
        });
    });
</script>

</body>
</html>
