<?php

?>
<!doctype html>
<html >
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
    
</head>

<header id="masthead" class="site-header" role="banner">
    <div class="container">
        <div class="site-branding">
            <!-- Insérez le lien de votre logo ci-dessous -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/asset/img/Logo.webp" alt="Logo du site">
            </a>
        </div>

        <nav id="site-navigation" class="main-navigation" role="navigation">
            <?php
            wp_nav_menu( array(
                'menu' => 'principal', 
                'menu_id' => 'primary-menu',
            ) );
            ?>
        </nav><!-- #site-navigation -->
    </div><!-- .container -->

</header><!-- #masthead -->