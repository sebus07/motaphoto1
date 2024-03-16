<?php
/*
Template Name: Single Custom Photo Template
*/

use ParagonIE\Sodium\Core\Curve25519\H;
$annee = get_field('annee');
$categorie = get_field('categorie');
$format = get_field('format');
$image = get_field('image');
$reference = get_field('Référence');
$type = get_field('type');
get_header();

if (have_posts()) :
    while (have_posts()) : the_post();

        // Récupérer les métadonnées ACF
        $annee = get_field('annee');
        $categorie = get_field('categorie');
        $format = get_field('format');
        $image = get_field('image');
        $reference = get_field('Référence');
        $type = get_field('type');
        
        // Afficher les détails de la photo à gauche et la photo à droite
        echo '<div class="photo-details-container">';
        echo '<div id="motafont"class="photo-details motaphoto-font">';
        echo '<h2 class="marge">' . get_the_title() . '</h2>';
        echo '<p class="marge">Référence : ' . $reference . '</p>';
        echo '<p class="marge">Catégorie : ' . $categorie . '</p>';
        echo '<p class="marge">Format : ' . $format . '</p>';
        echo '<p class="marge">Type : ' . $type . '</p>';
        echo '<p class="margel">Année : ' . $annee . '</p>';
        echo '</div>';

        // Afficher l'image à droite
        if ($image) {
            echo '<div class="photo-image">';
            echo '<a class="lightbox-trigger" href="#lightbox-container">'; // Ajout de la classe "lightbox-trigger" et de l'attribut href vers l'ID de la lightbox
            echo '<img src="' . $image['url'] . '" alt="' . get_the_title() . '">';
            echo '</a>';
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
            <button class="dropbtn4" data-reference="<?php echo esc_attr($reference); ?>">Contact</button>
        </div>

        <div class="fleche">
        <?php
            // Inclure le contenu de lightbox.php
            get_template_part('lightbox');
            ?>
            <div class="fleche_2">
                <div><img id="previousPhoto2" src="<?php echo get_stylesheet_directory_uri(); ?>/asset/img/Line6.png" alt=""></div>
                <div><img id="nextPhoto2" src="<?php echo get_stylesheet_directory_uri(); ?>/asset/img/Line7.png" alt=""></div>
            </div>    
        </div>
    </div>
</div>

<?php




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
            echo '<a href="' . $lien_image_similaire . '">'; // Supprimer target="_blank"
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
