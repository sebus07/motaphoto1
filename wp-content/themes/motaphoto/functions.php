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

// Fonction pour récupérer les paramètres du thème
function motaphoto1_get_theme_settings()
{
    $settings = array(
        'titre' => get_option('motaphoto1_settings_field_Titre'),
        'reference' => get_option('motaphoto1_settings_field_reference'),
        'categorie' => get_option('motaphoto1_settings_field_Categorie'),
        'annee' => get_option('motaphoto1_settings_field_Annee'),
        'format' => get_option('motaphoto1_settings_field_Format'),
        'type' => get_option('motaphoto1_settings_field_Type'),
        'photo' => get_option('motaphoto1_settings_field_Photo'),
    );
    return $settings;
}

// Ajout de l'action pour gérer la requête AJAX pour charger les données des photos
add_action('wp_ajax_load_photos_data', 'load_photos_data_callback');


function load_photos_data_callback() {
    $args = array(
        'post_type' => 'cif_FichierPhotos',
        'posts_per_page' => -1,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $photos_data = array();

        while ($query->have_posts()) {
            $query->the_post();
            $photo_id = get_the_ID();
            $photo_title = get_the_title();
            $photo_url = get_the_post_thumbnail_url($photo_id, 'full'); // Utilisez la taille normale
            $photo_reference = get_post_meta($photo_id, 'reference', true);
            $photo_categorie = get_post_meta($photo_id, 'categorie', true);

            // Ajoutez les données de chaque photo dans un tableau
            $photos_data[] = array(
                'id' => $photo_id,
                'title' => $photo_title,
                'url' => $photo_url,
                'reference' => $photo_reference,
                'categorie' => $photo_categorie,
            );
        }

        // Réinitialisez les données de la requête post
        wp_reset_postdata();

        // Encodez les données au format JSON et envoyez-les
        wp_send_json($photos_data);
    } else {
        // Si aucune photo n'est trouvée, envoyez un tableau vide
        wp_send_json(array());
    }
}


