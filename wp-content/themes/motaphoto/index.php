<?php
$annee = get_field('annee');
$categorie = get_field('categorie');
$format = get_field('format');
$image = get_field('image');
$Référence = get_field('Référence');
$type = get_field('type');


get_header();
?>

<!doctype html>
<html>

<body>
    <div class="hero">
        <a href="/motaphoto1">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/asset/img/header.webp" alt="Description de l'image">
        </a>
    </div>
    <section class="">
        <div class="filtres">
            <div class="dropdown">
                <button class="dropbtn poppins-font">CATÉGORIES</button>
                <div class="dropdown-content poppins-font">
                    <a href="#" class="filter-reception">Réception</a>
                    <a href="#" class="filter-television">Télévision</a>
                    <a href="#" class="filter-concert">Concert</a>
                    <a href="#" class="filter-mariage">Mariage</a>
                </div>
            </div>
            <div class="dropdown poppins-font">
                <button class="dropbtn poppins-font">FORMATS</button>
                <div class="dropdown-content">
                    <a href="#" class="filter-paysage">Paysage</a>
                    <a href="#" class="filter-portrait">Portrait</a>
                </div>
            </div>
        </div>
        <div class="filtres2">
    <div class="dropdown">
        <button class="dropbtn2 poppins-font">TRIER PAR</button>
        <div class="dropdown-content">
            <a href="#" class="filter-type" data-type="argentique">Argentique</a>
            <a href="#" class="filter-type" data-type="numerique">Numérique</a>
        </div>
    </div>
</div>
    </section>
    <div class="photo">
        <div class="grid">
            <?php
            $args = array(
                'post_type' => 'cif_FichierPhotos', // Votre type de post personnalisé
                'posts_per_page' => 8, // Pour afficher tous les posts, utilisez -1
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();

                    // Récupérer l'image depuis le champ ACF 'image'
                    $image = get_field('image');
                    
                    // Autres champs que vous souhaitez passer
                    $annee = get_field('annee');
                    $categorie = get_field('categorie');
                    $format = get_field('format');
                    $Référence = get_field('Référence');
                    $type = get_field('type');

                    // Ajoutez une classe et des attributs data avec les données
                    if ($image) {
                        echo '<div class="grid-item">';
                        // Ajoutez le lien autour de l'image
                        echo '<a href="' . esc_url(get_permalink()) . '">';
                        echo '<img class="photo-clickable" data-annee="' . $annee . '" data-categorie="' . $categorie . '" data-format="' . $format . '" data-referentiel="' . $Référence . '" data-type="' . $type . '" src="' . $image['url'] . '" alt="' . get_the_title() . '">';
                        echo '</a>';
                        echo '</div>';
                    }
                }

                wp_reset_postdata(); // Réinitialiser les données du post
            } else {
                // Aucun post trouvé
                echo 'Aucun FichierPhoto trouvé.';
            }
            ?>
        </div>
    </div>

    <div class="chargerplus motaphoto-font">
        <button class="dropbtn3 motaphoto-font">Charger plus</button>
    </div>
	
</body>

<?php
/* Start the Loop */
while (have_posts()) :
    the_post();
    get_template_part('wp-content\themes\motaphoto-child\page.php');
endwhile; // End of the loop.

get_footer();
?>
