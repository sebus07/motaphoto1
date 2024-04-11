<?php
$annee = get_field('annee');
$categorie = get_field('categorie');
$format = get_field('format');
$image = get_field('image');
$reference = get_field('reference');
$type = get_field('type');

get_header();

?>

</head>

<body>
    <div class="hero">
        <a href="#">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/asset/img/header.webp" alt="Description de l'image">
        </a>
    </div>
    <section class="blocCategories">
        <div class="filtres">
            <div class="dropdown">
                <select id="categorie-select" class="home-filter dropbtn poppins-font">
                    <option value="all" class="category-option">Catégories</option>
                    <?php
                    // Récupérer tous les termes de la taxonomie catégorie
                    $terms = get_terms(array(
                        'taxonomy' => 'categorie',
                        'hide_empty' => false,
                    ));
                    // Vérifier s'il y a des termes
                    if ($terms && !is_wp_error($terms)) {
                        foreach ($terms as $term) {
                            // Ajouter la classe 'category-option' à chaque option
                            echo '<option value="' . $term->slug . '" class="category-option">' . $term->name . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="dropdown poppins-font">
                <select id="format-select" class="home-filter  dropbtn poppins-font">
                    <option value="all">Formats</option>
                    <?php
                    // Récupérer tous les termes de la taxonomie format
                    $terms = get_terms(array(
                        'taxonomy' => 'format',
                        'hide_empty' => false,
                    ));
                    // Vérifier s'il y a des termes
                    if ($terms && !is_wp_error($terms)) {
                        foreach ($terms as $term) {
                            echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="blocAnne">
            <div class="marge"></div>
                <div class="dropdown poppins-font">
                    <select id="filtre-select" class="home-filter dropbtn2 poppins-font">
                        <option value="all">Trier par</option>
                        <?php
                        // Récupérer tous les termes de la taxonomie année
                        $terms = get_terms(array(
                            'taxonomy' => 'annee',
                            'hide_empty' => false,
                        ));
                        // Vérifier s'il y a des termes
                        if ($terms && !is_wp_error($terms)) {
                            foreach ($terms as $term) {
                                echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
                            }
                        }
                        ?>
                        <optgroup label="Filtrer par date">
                            <option value="ascendant">DATE-ordre croissant</option>
                            <option value="descendant">DATE-ordre décroissant</option>
                        </optgroup>
                    </select>
                </div>
            </div>
        </div>
    </section>
    <div class="photo">
        <div class="grid">
            <?php
            $args = array(
                'post_type' => 'cif_FichierPhotos', // Votre type de post personnalisé
                'posts_per_page' => -1, // -1 pour afficher tous les posts
            );

            $query = new WP_Query($args);

            $count = 0; // Initialiser le compteur de photos
            $hidden_photos = array(); // Initialiser un tableau pour stocker les photos cachées

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();

                    // Récupérer les données pertinentes
                    $categorie = get_field('categorie');
                    $format = get_field('format');
                    $annee = get_field('annee');
                    $image = get_field('image');
                    $reference = get_field('reference');

                    // Vérifier si le compteur est inférieur à 8
                    if ($count < 8) {
                        // Si oui, afficher la photo normalement
                        echo '<div class="grid-item survol-photo" data-categorie="' . $categorie .'" data-reference="' . $reference . '" data-format="' . $format . '" data-annee="' . $annee . '">';
                        echo '<a href="' . esc_url(get_permalink()) . '" class="photo-link">';
                        echo '<img class="photo-clickable" src="' . $image['url'] . '" alt="' . get_the_title() . '">';
                        echo '</a>';
                        echo '</div>';
                    
                        $count++; // Incrémenter le compteur de photos affichées
                    } else {
                        // Sinon, cacher la photo et la stocker dans le tableau des photos cachées
                        $hidden_photos[] = '<div class="grid-item survol-photo hidden" data-categorie="' . $categorie . '" data-reference="' . $reference .'" data-format="' . $format . '" data-annee="' . $annee . '">'
                            . '<a href="' . esc_url(get_permalink()) . '" class="photo-link">'
                            . '<img class="photo-clickable" src="' . $image['url'] . '" alt="' . get_the_title() . '">'
                            . '</a>'

                            . '</div>';
                    }
                }

                wp_reset_postdata(); // Réinitialiser les données du post
            } else {
                // Aucun post trouvé
                echo 'Aucun FichierPhoto trouvé.';
            }

            // Afficher les photos cachées
            foreach ($hidden_photos as $hidden_photo) {
                echo $hidden_photo;
            }
            ?>
        </div>
    </div>

    <div class="chargerplus motaphoto-font">
        <button class="dropbtn3 motaphoto-font">Charger plus</button>
    </div>
</body>

<?php
get_footer();
?>

</html>