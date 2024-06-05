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

<body <?php body_class(); ?>>
    <div class="hero">
        <a href="#">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/asset/img/header.webp" alt="Description de l'image">
        </a>
    </div>
    <section class="blocCategories">
        <div class="filtres">
            <div class="dropdown" id="categorie-dropdown">
                <div class="home-filter dropbtn poppins-font" data-value="all">Catégories</div>
                <div class="dropdown-content">
                    <div class="category-option" data-value="all">Catégories</div>
                    <?php
                    $terms = get_terms(array(
                        'taxonomy' => 'categorie',
                        'hide_empty' => false,
                    ));
                    if ($terms && !is_wp_error($terms)) {
                        foreach ($terms as $term) {
                            echo '<div class="category-option" data-value="' . $term->slug . '">' . $term->name . '</div>';
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="dropdown poppins-font" id="format-dropdown">
                <div class="home-filter dropbtn poppins-font" data-value="all">Formats</div>
                <div class="dropdown-content">
                    <div class="format-option" data-value="all">Formats</div>
                    <?php
                    $terms = get_terms(array(
                        'taxonomy' => 'format',
                        'hide_empty' => false,
                    ));
                    if ($terms && !is_wp_error($terms)) {
                        foreach ($terms as $term) {
                            echo '<div class="format-option" data-value="' . $term->slug . '">' . $term->name . '</div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="blocAnne">
            <div class="marge"></div>
            <div class="dropdown poppins-font" id="filtre-dropdown">
                <div class="home-filter dropbtn2 poppins-font" data-value="all">Trier par</div>
                <div class="dropdown-content">
                    <div class="filtre-option" data-value="all">Trier par</div>
                    <?php
                    $terms = get_terms(array(
                        'taxonomy' => 'annee',
                        'hide_empty' => false,
                    ));
                    if ($terms && !is_wp_error($terms)) {
                        foreach ($terms as $term) {
                            echo '<div class="filtre-option" data-value="' . $term->slug . '">' . $term->name . '</div>';
                        }
                    }
                    ?>
                    <div class="filtre-option" data-value="ascendant">DATE-ordre croissant</div>
                    <div class="filtre-option" data-value="descendant">DATE-ordre décroissant</div>
                </div>
            </div>
        </div>
    </section>
    <div class="photo">
        <div class="grid">
            <?php
            $args = array(
                'post_type' => 'cif_FichierPhotos',
                'posts_per_page' => -1,
            );

            $query = new WP_Query($args);

            $count = 0;
            $hidden_photos = array();

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();

                    $categorie = get_field('categorie');
                    $format = get_field('format');
                    $annee = get_field('annee');
                    $image = get_field('image');
                    $reference = get_field('reference');

                    if ($count < 8) {
                        echo '<div class="grid-item survol-photo" data-categorie="' . $categorie . '" data-reference="' . $reference . '" data-format="' . $format . '" data-annee="' . $annee . '">';
                        echo '<a href="' . esc_url(get_permalink()) . '" class="photo-link">';
                        echo '<img class="photo-clickable" src="' . $image['url'] . '" alt="' . get_the_title() . '">';
                        echo '</a>';
                        echo '</div>';

                        $count++;
                    } else {
                        $hidden_photos[] = '<div class="grid-item survol-photo hidden" data-categorie="' . $categorie . '" data-reference="' . $reference . '" data-format="' . $format . '" data-annee="' . $annee . '">'
                            . '<a href="' . esc_url(get_permalink()) . '" class="photo-link">'
                            . '<img class="photo-clickable" src="' . $image['url'] . '" alt="' . get_the_title() . '">'
                            . '</a>'
                            . '</div>';
                    }
                }

                wp_reset_postdata();
            } else {
                echo 'Aucun FichierPhoto trouvé.';
            }

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