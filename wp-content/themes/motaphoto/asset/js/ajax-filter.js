jQuery(document).ready(function($) {
    // Vérifiez si vous êtes sur la page d'accueil
    if ($('body').hasClass('home')) {
        function loadPhotos(offset = 0, append = true) {
            var data = {
                action: 'my_ajax_filter_search',
                categorie: $('#categorie-select').val(),
                format: $('#format-select').val(),
                annee: $('#filtre-select').val(),
                order: $('#filtre-select').val() === 'ascendant' ? 'asc' : 'desc',
                offset: offset
            };

            $.post(ajaxurl, data, function(response) {
                if (response.success) {
                    var grid = $('.grid');
                    if (!append) {
                        grid.empty(); // Vider la grille si on ne l'ajoute pas
                        totalLoadedCount = 0; // Réinitialiser le compteur total des chargements
                    }

                    response.data.forEach(function(item) {
                        var newItem = '<div class="grid-item survol-photo" data-categorie="' + item.categorie + '" data-format="' + item.format + '" data-annee="' + item.annee + '" data-reference="' + item.reference + '">'
                            + '<a href="' + item.link + '" class="photo-link">'
                            + '<img class="photo-clickable" src="' + item.image + '" alt="' + item.title + '">'
                            + '</a>'
                            + '</div>';
                        grid.append(newItem);
                        totalLoadedCount++; // Mettre à jour le compteur total des chargements
                    });

                    // Afficher ou masquer le bouton "Charger plus" en fonction des résultats
                    if (response.data.length < 8) {
                        $('.dropbtn3').hide();
                    } else {
                        $('.dropbtn3').show();
                    }
                } else {
                    alert('fin des photos.');
                }
            });
        }

        // Chargement initial des photos
        loadPhotos(0, false);

        $('.dropbtn3').click(function() {
            var offset = $('.grid-item').length;
            loadPhotos(offset, true);
        });

        $('.home-filter').change(function() {
            loadPhotos(0, false);
        });
    }
});
