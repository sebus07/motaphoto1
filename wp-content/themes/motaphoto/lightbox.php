<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lightbox</title>
</head>
<body>
<!-- Aperçu de la première image -->
<div class="photo">
    <div class="grid">
        <?php
        // Récupérer la première image pour l'aperçu sur la page principale
$first_image = get_field('image', get_page_by_path('cif_FichierPhotos', OBJECT, 'cif_FichierPhotos'));

if ($first_image) {
    // Définition des variables $reference et $categorie à l'intérieur de la condition if
    $reference = get_field('reference');
    $categorie = get_field('categorie');

    echo '<div class="grid-item ">';
    echo '<a href="#" class="photo-link" onclick="openLightbox(\'' . $first_image['url'] . '\', \'' . get_the_title() . '\', \'' . get_field('reference', get_page_by_path('cif_FichierPhotos', OBJECT, 'cif_FichierPhotos')) . '\', \'' . get_field('categorie', get_page_by_path('cif_FichierPhotos', OBJECT, 'cif_FichierPhotos')) . '\')">';
    echo '<img class="photo-clickable" src="' . $first_image['url'] . '" alt="' . get_the_title() . '">';
    echo '</a>';
    echo '</div>';
} else {
    echo 'Aucune image trouvée.';
}
        ?>
    </div>
</div>

<!-- La lightbox -->
<div class="lightbox " id="lightbox">
    <span onclick="closeLightbox()" style="position: fixed; top: 20px; right: 20px; cursor: pointer; color: #fff; font-size: 24px;">&times;</span>
    <div class="fleche2">
        <a href="#" onclick="prevImage()"><img id="previousPhoto" src="<?php echo get_stylesheet_directory_uri(); ?>/asset/img/previousPhoto.png" alt="Previous Photo"></a>
        <img id="lightbox" src="" alt="">
        <a href="#" onclick="nextImage()"><img id="nextPhoto" src="<?php echo get_stylesheet_directory_uri(); ?>/asset/img/nextPhoto.png" alt="Next Photo"></a>
    </div>
    <img id="lightbox-image" src="" alt="">
    <div class="image-details">
        <p class="reference"></p>
        <p class="categorie"></p>
    </div>
</div>

<!-- JavaScript pour contrôler l'ouverture et la fermeture de la lightbox, et la navigation -->
<script>
    var images = []; // Tableau pour stocker les URL des images
    var references = []; // Tableau pour stocker les références des images
    var categories = []; // Tableau pour stocker les catégories des images
    var currentIndex = 0; // Indice de l'image actuellement affichée

    // Fonction pour ouvrir la lightbox avec une image spécifique
    function openLightbox(imageUrl, title, reference, categorie) {
        document.getElementById('lightbox-image').src = imageUrl;
        document.getElementById('lightbox-image').alt = title;
        document.querySelector('.reference').innerText = reference;
        document.querySelector('.categorie').innerText = categorie;
        document.getElementById('lightbox').style.display = 'block';
        // Mettre à jour currentIndex pour l'image actuelle
        currentIndex = images.indexOf(imageUrl);
    }
    
    // Fonction pour fermer la lightbox
    function closeLightbox() {
        document.getElementById('lightbox').style.display = 'none';
    }
    // Fonction pour afficher l'image précédente
    function prevImage() {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        document.getElementById('lightbox-image').src = images[currentIndex];
        document.querySelector('.reference').innerText = references[currentIndex];
        document.querySelector('.categorie').innerText = categories[currentIndex];
    }
    // Fonction pour afficher l'image suivante
    function nextImage() {
        currentIndex = (currentIndex + 1) % images.length;
        document.getElementById('lightbox-image').src = images[currentIndex];
        document.querySelector('.reference').innerText = references[currentIndex];
        document.querySelector('.categorie').innerText = categories[currentIndex];
    }
    <?php
    // Récupérer toutes les images
    $args = array(
        'post_type' => 'cif_FichierPhotos',
        'posts_per_page' => -1,
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $image = get_field('image');
            $reference = get_field('reference');
            $categorie = get_field('categorie');
            echo 'images.push("' . $image['url'] . '");';
            echo 'references.push("' . $reference . '");';
            echo 'categories.push("' . $categorie . '");';
        }
    }
    ?>
</script>

</body>
</html>
