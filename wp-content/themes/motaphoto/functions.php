<?php

add_action('wp_enqueue_scripts', 'theme_enqueue_assets');
function theme_enqueue_assets() {
    // Enqueue styles
    wp_enqueue_style('motaphoto-style', get_stylesheet_uri());
    wp_enqueue_style('header-style', get_template_directory_uri() . '/asset/css/header.css');
    wp_enqueue_style('footer-style', get_template_directory_uri() . '/asset/css/footer.css');
	wp_enqueue_style('modal-style', get_template_directory_uri() . '/asset/css/modal.css');
    wp_enqueue_style('index-style', get_template_directory_uri() . '/asset/css/index.css');
    wp_enqueue_style('grid-style', get_template_directory_uri() . '/asset/css/grid.css');

    // Enqueue scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('mon_script_js', get_stylesheet_directory_uri() . '/asset/js/mon_script.js', array('jquery'), '1.0', true);
}