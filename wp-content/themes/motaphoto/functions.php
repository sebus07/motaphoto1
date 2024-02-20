<?php


 add_action( 'wp_enqueue_scripts', 'theme_enqueue_style' );
 function theme_enqueue_style() {
	 // Inclure le style.css de votre propre thème
	 wp_enqueue_style( 'motaphoto-style', get_stylesheet_uri() );
 
	 // Inclure le fichier header.css
	 wp_enqueue_style( 'header-style', get_template_directory_uri() . '/asset/css/header.css');
 
	 // Inclure le fichier footer.css
	 wp_enqueue_style( 'footer-style', get_template_directory_uri() . '/asset/css/footer.css');
 }


 function ajouter_scripts_personnalises() {
    wp_enqueue_script('mon_script_js', get_stylesheet_directory_uri() . '/js/mon_script.js', array('jquery'), '1.0', true);
}
	add_action('wp_enqueue_scripts', 'ajouter_scripts_personnalises');