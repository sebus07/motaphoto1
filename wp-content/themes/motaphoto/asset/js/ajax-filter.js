// Attend que le document soit prêt
jQuery(document).ready(function($) {
    // Vérifie si la page est la page d'accueil
    if ($('body').hasClass('home')) {
        // Fonction pour charger les photos
        function loadPhotos(offset = 0, append = true) {
            // Données à envoyer via AJAX
            var data = {
                action: 'my_ajax_filter_search',
                categorie: $('#categorie-dropdown .dropbtn').data('value'),
                format: $('#format-dropdown .dropbtn').data('value'),
                annee: $('#filtre-dropdown .dropbtn2').data('value'),
                order: $('#filtre-dropdown .dropbtn2').data('value') === 'ascendant' ? 'asc' : 'desc',
                offset: offset
            };
            // Envoi de la requête AJAX
            $.post(ajaxurl, data, function(response) {
                // Si la réponse est réussie
                if (response.success) {
                    var grid = $('.grid');
                    // Vide la grille si on ne fait pas d'ajout
                    if (!append) {
                        grid.empty();
                        totalLoadedCount = 0;
                    }
                    // Parcours des données de la réponse
                    response.data.forEach(function(item) {
                        // Construction de l'élément HTML pour chaque photo
                        var newItem = '<div class="grid-item survol-photo" data-categorie="' + item.categorie + '" data-format="' + item.format + '" data-annee="' + item.annee + '" data-reference="' + item.reference + '">'
                            + '<a href="' + item.link + '" class="photo-link">'
                            + '<img class="photo-clickable" src="' + item.image + '" alt="' + item.title + '">'
                            + '</a>'
                            + '</div>';
                        // Ajout de l'élément à la grille
                        grid.append(newItem);
                        totalLoadedCount++;
                    });
                    // Affichage ou masquage du bouton de chargement supplémentaire
                    if (response.data.length < 8) {
                        $('.dropbtn3').hide();
                    } else {
                        $('.dropbtn3').show();
                    }
                } else {
                    // Affichage d'une alerte en cas d'erreur
                    alert('fin des photos.');
                }
            });
        }
        // Charge les photos lors du chargement initial de la page
        loadPhotos(0, false);

        // Gestion du clic sur le bouton de chargement supplémentaire
        $('.dropbtn3').click(function() {
            var offset = $('.grid-item').length;
            loadPhotos(offset, true);
        });

        // Gestion du clic sur les options de sélection de catégorie
        $('.dropdown-content .category-option').click(function() {
            $('#categorie-dropdown .dropbtn').text($(this).text()).data('value', $(this).data('value'));
            loadPhotos(0, false);
        });

        // Gestion du clic sur les options de sélection de format
        $('.dropdown-content .format-option').click(function() {
            $('#format-dropdown .dropbtn').text($(this).text()).data('value', $(this).data('value'));
            loadPhotos(0, false);
        });

        // Gestion du clic sur les options de sélection de filtre
        $('.dropdown-content .filtre-option').click(function() {
            $('#filtre-dropdown .dropbtn2').text($(this).text()).data('value', $(this).data('value'));
            loadPhotos(0, false);
        });
    }
});
