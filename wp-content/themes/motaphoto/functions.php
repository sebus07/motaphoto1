<?php
function motaphoto1_enqueue_assets() {
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

    // Enqueue scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('mon_script_js', get_stylesheet_directory_uri() . '/asset/js/mon_script.js', array('jquery'), '1.0', true);

    
    
}
add_action('wp_enqueue_scripts', 'motaphoto1_enqueue_assets');


////////////////////////////création du fichier photo dans le backoffice/////////////////////////////////
function motaphoto1_register_custom_post_types() {
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
function motaphoto1_get_theme_settings() {
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

//////////////////////////////// Ajouter la variable ajaxurl au script mon_script.js////////////////////////////////////////////
function add_ajaxurl_to_scripts() {
    wp_enqueue_script('mon_script', get_stylesheet_directory_uri() . '/mon_script.js', array('jquery'), '1.0', true);
    wp_localize_script('mon_script', 'ajaxurl', admin_url('admin-ajax.php'));
}
add_action('wp_enqueue_scripts', 'add_ajaxurl_to_scripts');

add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');

function load_more_photos(){
    $page = $_POST['page'];

    $args = array(
        'post_type' => 'cif_FichierPhotos',
        'posts_per_page' => 8,
        'paged' => $page, // Utilisez la pagination
    );

    $query = new WP_Query($args);

    if($query->have_posts()){
        while($query->have_posts()){
            $query->the_post();
            
            // Récupérer l'image depuis le champ ACF 'image'
            $image = get_field('image');
            
            // Afficher l'image si elle existe
            if($image){
                echo '<div class="grid-item">';
                echo '<img src="' . $image['url'] . '" alt="' . get_the_title() . '">';
                echo '</div>';
            }
        }

        wp_reset_postdata(); // Réinitialiser les données du post
    } else {
        // Retourne 0 si aucune photo trouvée ne rien renvoyer
    }

    die(); // Arrêter l'exécution de PHP
}




// Fonction pour charger les photos de la catégorie "Mariage" via AJAX////////////////////////////////////////////////////////////
add_action('wp_ajax_load_photos_by_mariage', 'load_photos_by_mariage');
add_action('wp_ajax_nopriv_load_photos_by_mariage', 'load_photos_by_mariage'); // Pour les utilisateurs non connectés

function load_photos_by_mariage() {
    $page = $_POST['page'];

    $args = array(
        'post_type' => 'cif_FichierPhotos',
        'posts_per_page' => 8,
        'paged' => $page,
        'meta_query' => array(
            array(
                'key' => 'categorie',
                'value' => 'Mariage', // Valeur de la catégorie "Mariage" dans votre ACF
                'compare' => '=',
            ),
        ),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            
            // Récupérer l'image depuis le champ ACF 'image'
            $image = get_field('image');
            
            // Afficher l'image si elle existe
            if ($image) {
                echo '<div class="grid-item">';
                echo '<img src="' . $image['url'] . '" alt="' . get_the_title() . '">';
                echo '</div>';
            }
        }
        wp_reset_postdata();
    } else {
        echo 'Aucune photo trouvée.';
    }

    die(); // Important pour terminer la réponse AJAX
}



// Fonction pour charger les photos de la catégorie "concert" via AJAX
add_action('wp_ajax_load_photos_by_concert', 'load_photos_by_concert');
add_action('wp_ajax_nopriv_load_photos_by_concert', 'load_photos_by_concert'); // Pour les utilisateurs non connectés

function load_photos_by_concert() {
    $page = $_POST['page'];

    $args = array(
        'post_type' => 'cif_FichierPhotos',
        'posts_per_page' => 8,
        'paged' => $page,
        'meta_query' => array(
            array(
                'key' => 'categorie',
                'value' => 'concert', // Valeur de la catégorie "concert" dans votre ACF
                'compare' => '=',
            ),
        ),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            
            // Récupérer l'image depuis le champ ACF 'image'
            $image = get_field('image');
            
            // Afficher l'image si elle existe
            if ($image) {
                echo '<div class="grid-item">';
                echo '<img src="' . $image['url'] . '" alt="' . get_the_title() . '">';
                echo '</div>';
            }
        }
        wp_reset_postdata();
    } else {
        echo 'Aucune photo trouvée.';
    }

    die(); // Important pour terminer la réponse AJAX
}



// Fonction pour charger les photos de la catégorie "reception" via AJAX
add_action('wp_ajax_load_photos_by_reception', 'load_photos_by_reception');
add_action('wp_ajax_nopriv_load_photos_by_reception', 'load_photos_by_reception'); // Pour les utilisateurs non connectés

function load_photos_by_reception() {
    $page = $_POST['page'];

    $args = array(
        'post_type' => 'cif_FichierPhotos',
        'posts_per_page' => 8,
        'paged' => $page,
        'meta_query' => array(
            array(
                'key' => 'categorie',
                'value' => 'reception', // Valeur de la catégorie "reception" dans votre ACF
                'compare' => '=',
            ),
        ),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            
            // Récupérer l'image depuis le champ ACF 'image'
            $image = get_field('image');
            
            // Afficher l'image si elle existe
            if ($image) {
                echo '<div class="grid-item">';
                echo '<img src="' . $image['url'] . '" alt="' . get_the_title() . '">';
                echo '</div>';
            }
        }
        wp_reset_postdata();
    } else {
        echo 'Aucune photo trouvée.';
    }

    die(); // Important pour terminer la réponse AJAX
}


// Fonction pour charger les photos de la catégorie "television" via AJAX
add_action('wp_ajax_load_photos_by_television', 'load_photos_by_television');
add_action('wp_ajax_nopriv_load_photos_by_television', 'load_photos_by_television'); // Pour les utilisateurs non connectés

function load_photos_by_television() {
    $page = $_POST['page'];

    $args = array(
        'post_type' => 'cif_FichierPhotos',
        'posts_per_page' => 8,
        'paged' => $page,
        'meta_query' => array(
            array(
                'key' => 'categorie',
                'value' => 'television', // Valeur de la catégorie "television" dans votre ACF
                'compare' => '=',
            ),
        ),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            
            // Récupérer l'image depuis le champ ACF 'image'
            $image = get_field('image');
            
            // Afficher l'image si elle existe
            if ($image) {
                echo '<div class="grid-item">';
                echo '<img src="' . $image['url'] . '" alt="' . get_the_title() . '">';
                echo '</div>';
            }
        }
        wp_reset_postdata();
    } else {
        echo 'Aucune photo trouvée.';
    }

    die(); // Important pour terminer la réponse AJAX
}

// Fonction pour charger les photos du format "paysage" via AJAX////////////////////////////////////////////////////
add_action('wp_ajax_load_photos_by_paysage', 'load_photos_by_paysage');
add_action('wp_ajax_nopriv_load_photos_by_paysage', 'load_photos_by_paysage'); // Pour les utilisateurs non connectés

function load_photos_by_paysage() {
    $page = $_POST['page'];

    $args = array(
        'post_type' => 'cif_FichierPhotos',
        'posts_per_page' => 8,
        'paged' => $page,
        'meta_query' => array(
            array(
                'key' => 'format',
                'value' => 'paysage', // Valeur de la catégorie "paysage" dans votre ACF
                'compare' => '=',
            ),
        ),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            
            // Récupérer l'image depuis le champ ACF 'image'
            $image = get_field('image');
            
            // Afficher l'image si elle existe
            if ($image) {
                echo '<div class="grid-item">';
                echo '<img src="' . $image['url'] . '" alt="' . get_the_title() . '">';
                echo '</div>';
            }
        }
        wp_reset_postdata();
    } else {
        echo 'Aucune photo trouvée.';
    }

    die(); // Important pour terminer la réponse AJAX
}

// Fonction pour charger les photos du format "portrait" via AJAX////////////////////////////////////////////////////
add_action('wp_ajax_load_photos_by_portrait', 'load_photos_by_portrait');
add_action('wp_ajax_nopriv_load_photos_by_portrait', 'load_photos_by_portrait'); // Pour les utilisateurs non connectés

function load_photos_by_portrait() {
    $page = $_POST['page'];

    $args = array(
        'post_type' => 'cif_FichierPhotos',
        'posts_per_page' => 8,
        'paged' => $page,
        'meta_query' => array(
            array(
                'key' => 'format',
                'value' => 'portrait', // Valeur de la catégorie "portrait" dans votre ACF
                'compare' => '=',
            ),
        ),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            
            // Récupérer l'image depuis le champ ACF 'image'
            $image = get_field('image');
            
            // Afficher l'image si elle existe
            if ($image) {
                echo '<div class="grid-item">';
                echo '<img src="' . $image['url'] . '" alt="' . get_the_title() . '">';
                echo '</div>';
            }
        }
        wp_reset_postdata();
    } else {
        echo 'Aucune photo trouvée.';
    }

    die(); // Important pour terminer la réponse AJAX
}



// Fonction pour charger les photos par type (argentique ou numérique) via AJAX
// Fonction pour charger les photos selon le type sélectionné
add_action('wp_ajax_load_photos_by_type', 'load_photos_by_type');
add_action('wp_ajax_nopriv_load_photos_by_type', 'load_photos_by_type'); // Pour les utilisateurs non connectés

function load_photos_by_type() {
    $page = $_POST['page'];
    $filter_type = $_POST['filter_type'];

    $args = array(
        'post_type' => 'cif_FichierPhotos',
        'posts_per_page' => 8,
        'paged' => $page,
        'meta_query' => array(
            array(
                'key' => 'type',
                'value' => $filter_type, // Utiliser le type de filtre passé depuis AJAX
                'compare' => '=',
            ),
        ),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            
            // Récupérer l'image depuis le champ ACF 'image'
            $image = get_field('image');
            
            // Afficher l'image si elle existe
            if ($image) {
                echo '<div class="grid-item">';
                echo '<img src="' . $image['url'] . '" alt="' . get_the_title() . '">';
                echo '</div>';
            }
        }
        wp_reset_postdata();
    } else {
        echo 'Aucune photo trouvée.';
    }

    die(); // Important pour terminer la réponse AJAX
}





