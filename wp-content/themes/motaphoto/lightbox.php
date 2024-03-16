<!-- Lightbox -->
<div class="lightbox" id="lightbox">
    <span class="close-btn">&times;</span>
    <img class="lightbox-image" src="" alt="Lightbox Image">
    <div class="image-details">
        <p class="reference"></p>
        <p class="categorie"></p>
        <div class="fleche2">
        <div><img id="previousPhoto" src="<?php echo get_stylesheet_directory_uri(); ?>/asset/img/previousPhoto.png" alt=""></div>
        <div><img id="nextPhoto" src="<?php echo get_stylesheet_directory_uri(); ?>/asset/img/nextPhoto.png" alt=""></div> 
    </div>
    </div>
</div>

<!-- Galerie de miniatures -->
<div class="gallery">
    <?php
if (have_posts()) :
    while (have_posts()) : the_post();
        $image = get_field('image');
        $reference = get_field('Référence');
        $categorie = get_field('categorie'); // Récupérer la valeur de la catégorie
        if ($image) {
            echo '<div class="thumbnail-container">';
            echo '<img class="thumbnail" src="' . $image['url'] . '" alt="' . get_the_title() . '" data-reference="' . $reference . '" data-categorie="' . $categorie . '">';
            echo '</div>';
        }
    endwhile;
endif;
?>
</div>