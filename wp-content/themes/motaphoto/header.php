<?php
wp_enqueue_script('jquery');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php wp_head(); ?>
    
    <style>
    .burger-icon {
    display: block;
    width: 30px;
    height: 30px;
    background: url('<?php echo get_stylesheet_directory_uri(); ?>/asset/img/Menu.png') no-repeat center;
    background-size: contain;
    transition: transform 0.3s ease-in-out;
    }

    .menu-open .burger-icon{
    transform: rotate(-45deg);  /* Rotation existante */
    background: url('<?php echo get_stylesheet_directory_uri(); ?>/asset/img/Menux.png') no-repeat center;  /* Image existante */
    background-size: contain;  /* Taille existante */
    position: relative;        /* Positionnement relatif pour superposer */
    z-index: 1000;            /* Valeur plus élevée que le menu pour rester au-dessus */
    }
    </style>
</head>

<body <?php body_class(); ?>>

    <header id="masthead" class="site-header" role="banner">
        <div class="container">
            <div class="site-branding">
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
            </nav>

            <!-- Menu déroulant mobile -->
            <div class="mobile-menu" id="mobile-menu">
                <?php
                wp_nav_menu(array(
                    'menu' => 'principal',
                    'menu_id' => 'mobile-menu-list',
                ));
                ?>
            </div>
        </div>
    </header>

    <?php wp_footer(); ?>
    <script>
    const menuToggleBtn = document.querySelector('.menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    menuToggleBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('active');
        menuToggleBtn.setAttribute('aria-expanded', mobileMenu.classList.contains('active'));
    });
    </script>
</body>
</html>





