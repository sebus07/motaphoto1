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

    // Enqueue scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('mon_script_js', get_stylesheet_directory_uri() . '/asset/js/mon_script.js', array('jquery'), '1.0', true);
}
add_action('admin_enqueue_scripts', 'motaphoto1_enqueue_assets');
add_action('wp_enqueue_scripts', 'motaphoto1_enqueue_assets');


function motaphoto1_add_admin_pages() {
    add_menu_page(__('Paramètres du thème motaphoto1', 'motaphoto1'), __('motaphoto1', 'motaphoto1'), 'manage_options', 'motaphoto1-settings', 'motaphoto1_theme_settings', 'dashicons-admin-settings', 60); 
}

function motaphoto1_theme_settings() {
    echo '<h1>'.esc_html( get_admin_page_title() ).'</h1>';
    echo '<form action="options.php" method="post" name="motaphoto1_settings">';
    echo '<div>';

    settings_fields('motaphoto1_settings_fields');
    do_settings_sections('motaphoto1_settings_section');
    submit_button();

    echo '</div>';
    echo '</form>';
}

function motaphoto1_settings_register() {
    register_setting('motaphoto1_settings_fields', 'motaphoto1_settings_fields', 'motaphoto1_settings_fields_validate');
    add_settings_section('motaphoto1_settings_section', __('Paramètres', 'motaphoto1'), 'motaphoto1_settings_section_Titre', 'motaphoto1_settings_section');
    add_settings_field('motaphoto1_settings_field_Titre', __('Titre', 'motaphoto1'), 'motaphoto1_settings_field_Titre_output', 'motaphoto1_settings_section', 'motaphoto1_settings_section');
    add_settings_field('motaphoto1_settings_field_Reference', __('Référence', 'motaphoto1'), 'motaphoto1_settings_field_Reference_output', 'motaphoto1_settings_section', 'motaphoto1_settings_section');
    add_settings_field('motaphoto1_settings_field_Categorie', __('Catégorie', 'motaphoto1'), 'motaphoto1_settings_field_Categorie_output', 'motaphoto1_settings_section', 'motaphoto1_settings_section');
    add_settings_field('motaphoto1_settings_field_Annee', __('Année', 'motaphoto1'), 'motaphoto1_settings_field_Annee_output', 'motaphoto1_settings_section', 'motaphoto1_settings_section');
    add_settings_field('motaphoto1_settings_field_Format', __('Format', 'motaphoto1'), 'motaphoto1_settings_field_Format_output', 'motaphoto1_settings_section', 'motaphoto1_settings_section');
    add_settings_field('motaphoto1_settings_field_Type', __('Type', 'motaphoto1'), 'motaphoto1_settings_field_Type_output', 'motaphoto1_settings_section', 'motaphoto1_settings_section');
    add_settings_field('motaphoto1_settings_field_Photo', __('Photo', 'motaphoto1'), 'motaphoto1_settings_field_Photo_output', 'motaphoto1_settings_section', 'motaphoto1_settings_section');
}

function motaphoto1_settings_section_Titre() {
    echo __('Paramètrez les différentes options de votre thème motaphoto1.', 'motaphoto1');
}

function motaphoto1_settings_fields_validate($inputs) {  
    if(isset($_POST) && !empty($_POST)) {
        if(isset($_POST['motaphoto1_settings_field_Titre']) && !empty($_POST['motaphoto1_settings_field_Titre'])) {
            update_option('motaphoto1_settings_field_Titre', $_POST['motaphoto1_settings_field_Titre']);
        }
        if(isset($_POST['motaphoto1_settings_field_Reference']) && !empty($_POST['motaphoto1_settings_field_Reference'])) {
            update_option('motaphoto1_settings_field_Reference', $_POST['motaphoto1_settings_field_Reference']);
        }
        if(isset($_POST['motaphoto1_settings_field_Categorie']) && !empty($_POST['motaphoto1_settings_field_Categorie'])) {
            update_option('motaphoto1_settings_field_Categorie', $_POST['motaphoto1_settings_field_Categorie']);
        }
        if(isset($_POST['motaphoto1_settings_field_Annee']) && !empty($_POST['motaphoto1_settings_field_Annee'])) { 
            update_option('motaphoto1_settings_field_Annee', $_POST['motaphoto1_settings_field_Annee']);
        }
        if(isset($_POST['motaphoto1_settings_field_Format']) && !empty($_POST['motaphoto1_settings_field_Format'])) {
            update_option('motaphoto1_settings_field_Format', $_POST['motaphoto1_settings_field_Format']);
        }
        if(isset($_POST['motaphoto1_settings_field_Type']) && !empty($_POST['motaphoto1_settings_field_Type'])) {
            update_option('motaphoto1_settings_field_Type', $_POST['motaphoto1_settings_field_Type']);
        }
        if(isset($_FILES['motaphoto1_settings_field_Photo']['name']) && !empty($_FILES['motaphoto1_settings_field_Photo']['name'])) {
            $uploaded_file = $_FILES['motaphoto1_settings_field_Photo'];

            $valid_types = array('jpg', 'jpeg', 'png', 'gif');

            // Vérifier le type de fichier
            $file_type = wp_check_filetype($uploaded_file['name'], $valid_types);
            if (!in_array($file_type['ext'], $valid_types)) {
                add_settings_error(
                    'motaphoto1_settings_field_Photo',
                    'invalid_filetype',
                    'Le type de fichier n\'est pas autorisé. Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.',
                    'error'
                );
                return $inputs;
            }

            // Télécharger le fichier
            $upload_overrides = array('test_form' => false);
            $movefile = wp_handle_upload($uploaded_file, $upload_overrides);

            if ($movefile && !isset($movefile['error'])) {
                $url = $movefile['url'];
                update_option('motaphoto1_settings_field_Photo', $url);
            } else {
                add_settings_error(
                    'motaphoto1_settings_field_Photo',
                    'upload_error',
                    'Une erreur s\'est produite lors du téléchargement du fichier.',
                    'error'
                );
            }
        }
    }
    return $inputs;
}

function motaphoto1_settings_field_Titre_output() {
    $value = get_option('motaphoto1_settings_field_Titre');
    echo '<input name="motaphoto1_settings_field_Titre" type="text" value="'.$value.'" />';
}

function motaphoto1_settings_field_Reference_output() {
    $value = get_option('motaphoto1_settings_field_Reference');
    echo '<input name="motaphoto1_settings_field_Reference" type="text" value="'.$value.'" />';
}

function motaphoto1_settings_field_Categorie_output() {
    $value = get_option('motaphoto1_settings_field_Categorie');
    echo '<input name="motaphoto1_settings_field_Categorie" type="text" value="'.$value.'" />';
}

function motaphoto1_settings_field_Annee_output() {
    $value = get_option('motaphoto1_settings_field_Annee');
    echo '<input name="motaphoto1_settings_field_Annee" type="Integer" value="'.$value.'" />';
}

function motaphoto1_settings_field_Format_output() {
    $value = get_option('motaphoto1_settings_field_Format');
    echo '<input name="motaphoto1_settings_field_Format" type="text" value="'.$value.'" />';
}

function motaphoto1_settings_field_Type_output() {
    $value = get_option('motaphoto1_settings_field_Type');
    echo '<input name="motaphoto1_settings_field_Type" type="text" value="'.$value.'" />';
}

function motaphoto1_settings_field_Photo_output() {
    $value = get_option('motaphoto1_settings_field_Photo');
    $image_id = attachment_url_to_postid($value);
    $image_url = wp_get_attachment_image_src($image_id, 'thumbnail');
    ?>
    <input type="text" name="motaphoto1_settings_field_Photo" id="motaphoto1_settings_field_Photo" value="<?php echo esc_attr($value); ?>" style="display: none;" />
    <input type="button" id="motaphoto1_settings_field_Photo_button" class="button-secondary" value="<?php esc_attr_e('Upload Image', 'motaphoto1'); ?>" />
    <br />
    <img src="<?php echo esc_attr($image_url[0]); ?>" id="motaphoto1_settings_field_Photo_preview" style="max-width: 200px; height: auto; display: <?php echo ($value ? 'inline-block' : 'none'); ?>" />
    <script>
        jQuery(document).ready(function($) {
            $('#motaphoto1_settings_field_Photo_button').click(function(e) {
                e.preventDefault();
                var image = wp.media({
                    title: 'Upload Image',
                    multiple: false
                }).open().on('select', function(e){
                    var uploaded_image = image.state().get('selection').first();
                    var image_url = uploaded_image.toJSON().url;
                    $('#motaphoto1_settings_field_Photo').val(image_url);
                    var image_id = uploaded_image.toJSON().id;
                    var image_src = '<?php echo wp_get_attachment_image_src("' + image_id + '", "thumbnail")[0]; ?>';
                    $('#motaphoto1_settings_field_Photo_preview').attr('src', image_src).show();
                });
            });
        });
    </script>
    <?php
}

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

/***** Actions *****/
add_action('admin_menu', 'motaphoto1_add_admin_pages', 10);
add_action('admin_init', 'motaphoto1_settings_register');
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
        echo '0'; // Retourne 0 si aucune photo trouvée
    }

    die(); // Arrêter l'exécution de PHP
}



// Fonction pour charger les photos de la catégorie "Mariage" via AJAX
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



