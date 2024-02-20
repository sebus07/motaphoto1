
<!-- Modal Contact -->
<div id="modal-contact" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/asset/img/Contact-header.webp" alt="texte_alternatif">
        <!-- Contenu du formulaire de contact -->
        <?php echo do_shortcode('[wpforms id="29"]'); ?>
    </div>
</div>