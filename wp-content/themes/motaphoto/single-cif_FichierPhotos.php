<?php
/*
Template Name: Single Custom Photo Template
*/

use ParagonIE\Sodium\Core\Curve25519\H;
$annee = get_field('annee');
$categorie = get_field('categorie');
$format = get_field('format');
$image = get_field('image');
$Référence = get_field('Référence');
$type = get_field('type');
get_header();

if (have_posts()) :
    while (have_posts()) : the_post();

        // Récupérer les métadonnées ACF
        $annee = get_field('annee');
        $categorie = get_field('categorie');
        $format = get_field('format');
        $image = get_field('image');
        $Référence = get_field('Référence');
        $type = get_field('type');

        // Afficher les détails de la photo à gauche et la photo à droite
        echo '<div class="photo-details-container">';
        echo '<div class="photo-details motaphoto-font">';
        echo '<h2>' . get_the_title() . '</h2>';
        echo '<p>Référence : ' . $Référence . '</p>';
        echo '<p>Catégorie : ' . $categorie . '</p>';
        echo '<p>Format : ' . $format . '</p>';
        echo '<p>Type : ' . $type . '</p>';
        echo '<p>Année : ' . $annee . '</p>';
        echo '</div>';

        // Afficher l'image à droite
        if ($image) {
            echo '<div class="photo-image">';
            echo '<img src="' . $image['url'] . '" alt="' . get_the_title() . '">';
            echo '</div>';
        } else {
            echo 'Aucune image disponible.';
        }

        echo '</div>'; // Fin de photo-details-container

    endwhile;
endif;
?>
<div class="flex-centre">
    <div class="contact_photo">
        <div class="texte">
            <p>Cette photo vous intéresse ?</p>
        </div>
        <div class="chargerplus1">
            <button class="dropbtn4">Contact</button>
        </div>
        <div class="mignature">

        <?php
    // Définir les arguments pour la nouvelle requête des images similaires
$args_similaires = array(
    'post_type' => 'cif_FichierPhotos',
    'posts_per_page' => 1, // Nombre de photos similaires à afficher
    'post__not_in' => array( get_the_ID() ), // Exclure l'image actuelle
    'meta_query' => array(
        array(
            'key' => 'categorie',
            'value' => $categorie, // Chercher des images de la même catégorie
            'compare' => 'LIKE'
        )
    )
);

$query_similaires = new WP_Query($args_similaires);

if ($query_similaires->have_posts()) :
    while ($query_similaires->have_posts()) : $query_similaires->the_post();
        $image_similaire = get_field('image');
        $lien_image_similaire = get_permalink();
        if ($image_similaire) {
            echo '<img src="' . $image_similaire['url'] . '" alt="' . get_the_title() . '">';
            echo '</a>';
        }
    endwhile;
    wp_reset_postdata();
endif;
?>
            <div class="fleche">
                <div><img id="previousPhoto" src="<?php echo get_stylesheet_directory_uri(); ?>/asset/img/Line6.png" alt=""></div>
                <div><img id="nextPhoto" src="<?php echo get_stylesheet_directory_uri(); ?>/asset/img/Line7.png" alt=""></div> 
            </div>
        </div>
    </div>
    
</div>
<?php
// Récupérer les métadonnées ACF de l'image actuelle


// Définir les arguments pour la nouvelle requête des images similaires
$args_similaires = array(
    'post_type' => 'cif_FichierPhotos',
    'posts_per_page' => 2, // Nombre de photos similaires à afficher
    'post__not_in' => array( get_the_ID() ), // Exclure l'image actuelle
    'meta_query' => array(
        array(
            'key' => 'categorie',
            'value' => $categorie, // Chercher des images de la même catégorie
            'compare' => 'LIKE'
        )
    )
);

$query_similaires = new WP_Query($args_similaires);

if ($query_similaires->have_posts()) :
    echo '<div class="flex-centre2">';
    echo '<div class="centre7">';
    echo '<p>VOUS AIMEREZ AUSSI</p>';
    echo '<div class="grid">';
    while ($query_similaires->have_posts()) : $query_similaires->the_post();
        $image_similaire = get_field('image');
        $lien_image_similaire = get_permalink();
        if ($image_similaire) {
            echo '<div class="grid-item">';
            echo '<a href="' . $lien_image_similaire . '">';
            echo '<img src="' . $image_similaire['url'] . '" alt="' . get_the_title() . '">';
            echo '</a>';
            echo '</div>';
        }
    endwhile;
    echo '</div>'; // grid
    echo '</div>'; // "Vous aimerez AUSSI"
    wp_reset_postdata();
endif;

?>

<?php
get_footer();
?>