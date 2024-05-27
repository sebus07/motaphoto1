<?php
function motaphoto1_enqueue_assets()
{
    // Enqueue styles
    wp_enqueue_style('motaphoto-style', get_stylesheet_uri());
    wp_enqueue_style('header-style', get_template_directory_uri() . '/asset/css/header.css');
    wp_enqueue_style('footer-style', get_template_directory_uri() . '/asset/css/footer.css');
    wp_enqueue_style('modal-style', get_template_directory_uri() . '/asset/css/modal.css');
    wp_enqueue_style('index-style', get_template_directory_uri() . '/asset/css/index.css');
    wp_enqueue_style('grid-style', get_template_directory_uri() . '/asset/css/grid.css');
    wp_enqueue_style('photo-style', get_template_directory_uri() . '/asset/css/photo.css');
    wp_enqueue_style('detailPhoto-style', get_template_directory_uri() . '/asset/css/detailPhoto.css');
    wp_enqueue_style('menu_mobile-style', get_template_directory_uri() . '/asset/css/menu_mobile.css');
    wp_enqueue_style('lightbox-style', get_template_directory_uri() . '/asset/css/lightbox.css');

    // Enqueue scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('mon_script_js', get_stylesheet_directory_uri() . '/asset/js/mon_script.js', array('jquery'), '1.0', true);
    wp_enqueue_script('lightbox_js', get_stylesheet_directory_uri() . '/asset/js/lightbox.js', array('jquery'), '1.0', true);
    wp_enqueue_script('filtre_chargerPlus.js', get_stylesheet_directory_uri() . '/asset/js/filtre_chargerPlus.js', array('jquery'), '1.0', true);
    wp_enqueue_script('ajax-filter.js', get_stylesheet_directory_uri() . '/asset/js/ajax-filter.js', array('jquery'), '1.0', true);


    // Localize script with AJAX URL 
    wp_add_inline_script('mon_script_js', 'var ajaxurl = ' . wp_json_encode(admin_url('admin-ajax.php')) . ';');
}

add_action('wp_enqueue_scripts', 'motaphoto1_enqueue_assets');



// Création du custom post type "FichierPhoto"
function motaphoto1_register_custom_post_types()
{
    $labels_FichierPhoto = array(
        'menu_name'             => __('FichierPhoto', 'motaphoto1'),
        'name_admin_bar'        => __('FichierPhoto', 'motaphoto1'),
        'add_new_item'          => __('Ajouter un nouvel FichierPhoto', 'motaphoto1'),
        'new_item'              => __('Nouvel FichierPhoto', 'motaphoto1'),
        'edit_item'             => __('Modifier l\'FichierPhoto', 'motaphoto1'),
    );

    $args_ingredient = array(
        'label'                 => __('FichierPhoto', 'motaphoto1'),
        'description'           => __('FichierPhoto', 'motaphoto1'),
        'labels'                => $labels_FichierPhoto,
        'supports'              => array('title', 'thumbnail', 'excerpt', 'editor'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 40,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'menu_icon'             => 'dashicons-drumstick',
    );

    register_post_type('cif_FichierPhotos', $args_ingredient);
}
add_action('init', 'motaphoto1_register_custom_post_types', 11);



function my_ajax_filter_search() {
    $args = array(
        'post_type' => 'cif_FichierPhotos',
        'posts_per_page' => 8,
        'offset' => $_POST['offset'],
        'orderby' => 'date',
        'order' => $_POST['order'],
    );

    if (isset($_POST['categorie']) && $_POST['categorie'] != 'all') {
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => $_POST['categorie'],
        );
    }

    if (isset($_POST['format']) && $_POST['format'] != 'all') {
        $args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field' => 'slug',
            'terms' => $_POST['format'],
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        $results = array();
        while ($query->have_posts()): $query->the_post();
            $results[] = array(
                'link' => get_permalink(),
                'image' => get_field('image')['url'],
                'title' => get_the_title(),
                'categorie' => get_field('categorie'),
                'format' => get_field('format'),
                'annee' => get_field('annee'),
                'reference' => get_field('reference') 
            );
        endwhile;
        wp_send_json_success($results);
    else:
        wp_send_json_error('No posts found');
    endif;

    wp_die();
}
add_action('wp_ajax_my_ajax_filter_search', 'my_ajax_filter_search');
add_action('wp_ajax_nopriv_my_ajax_filter_search', 'my_ajax_filter_search');
