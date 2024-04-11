<?php
/*
Template Name: Single Custom Photo Template
*/

$annee = get_field('annee');
$categorie = get_field('categorie');
$format = get_field('format');
$image = get_field('image');
$reference = get_field('reference');
$type = get_field('type');
get_header();

if (have_posts()) :
    while (have_posts()) : the_post();

        // Récupérer les métadonnées ACF
        $annee = get_field('annee');
        $categorie = get_field('categorie');
        $format = get_field('format');
        $image = get_field('image');
        $reference = get_field('reference');
        $type = get_field('type');

        // Afficher les détails de la photo à gauche
        echo '<div class="photo-details-container">';
        echo '<div id="motafont"class="photo-details motaphoto-font">';
        echo '<h2 class="marge">' . get_the_title() . '</h2>';
        echo '<p class="marge">Référence : ' . $reference . '</p>';
        echo '<p class="marge">Catégorie : ' . $categorie . '</p>';
        echo '<p class="marge">Format : ' . $format . '</p>';
        echo '<p class="marge">Type : ' . $type . '</p>';
        echo '<p class="margel">Année : ' . $annee . '</p>';
        echo '</div>';

        // Afficher l'image à droite avec le lien vers la lightbox
        if ($image) {
            echo '<div class="photo-image survol-photo ">';
            echo '<a class="photo-link " href="#" onclick="openLightbox(\'' . $image['url'] . '\', \'' . get_the_title() . '\', \'' . $categorie . '\', \'' . $reference . '\')">';
            echo '<img src="' . $image['url'] . '" alt="' . get_the_title() . '" data-reference="' . $reference . '" data-categorie="' . $categorie . '">';
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
        <!-- miniature de la lightbox -->
        <div class="thumbnail-container">
            <img id="thumbnail-image" src="" alt="Miniature" class="thumbnail-image">
            <div class="caroussel">
                <span class="arrow previous-arrow" onclick="prevImage()">←</span>
                <span class="arrow next-arrow" onclick="nextImage()">→</span>
            </div>
        </div>
        <div class="visible">
        <?php
        get_template_part('lightbox');
        ?>
        </div>
    </div>
</div>
<?php

// Définir les arguments pour la nouvelle requête des images similaires
$args_similaires = array(
    'post_type' => 'cif_FichierPhotos',
    'posts_per_page' => 2, // Nombre de photos similaires à afficher
    'post__not_in' => array(get_the_ID()), // Exclure l'image actuelle
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
<script>

// Fonction pour afficher l'image précédente dans la miniature
function prevImage() {
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    document.getElementById('lightbox-image').src = images[currentIndex];
    document.querySelector('.reference').innerText = references[currentIndex];
    document.querySelector('.categorie').innerText = categories[currentIndex];
    // Mettre à jour la miniature avec l'image précédente
    let prevIndex = (currentIndex - 1 + images.length) % images.length;
    document.getElementById('thumbnail-image').src = images[prevIndex];
}

// Fonction pour afficher l'image suivante dans la miniature
function nextImage() {
    currentIndex = (currentIndex + 1) % images.length;
    document.getElementById('lightbox-image').src = images[currentIndex];
    document.querySelector('.reference').innerText = references[currentIndex];
    document.querySelector('.categorie').innerText = categories[currentIndex];
    // Mettre à jour la miniature avec l'image suivante
    let nextIndex = (currentIndex + 1) % images.length;
    document.getElementById('thumbnail-image').src = images[nextIndex];
}

</script>
