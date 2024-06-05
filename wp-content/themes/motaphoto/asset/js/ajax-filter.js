jQuery(document).ready(function($) {
    if ($('body').hasClass('home')) {
        function loadPhotos(offset = 0, append = true) {
            var data = {
                action: 'my_ajax_filter_search',
                categorie: $('#categorie-dropdown .dropbtn').data('value'),
                format: $('#format-dropdown .dropbtn').data('value'),
                annee: $('#filtre-dropdown .dropbtn2').data('value'),
                order: $('#filtre-dropdown .dropbtn2').data('value') === 'ascendant' ? 'asc' : 'desc',
                offset: offset
            };

            $.post(ajaxurl, data, function(response) {
                if (response.success) {
                    var grid = $('.grid');
                    if (!append) {
                        grid.empty();
                        totalLoadedCount = 0;
                    }

                    response.data.forEach(function(item) {
                        var newItem = '<div class="grid-item survol-photo" data-categorie="' + item.categorie + '" data-format="' + item.format + '" data-annee="' + item.annee + '" data-reference="' + item.reference + '">'
                            + '<a href="' + item.link + '" class="photo-link">'
                            + '<img class="photo-clickable" src="' + item.image + '" alt="' + item.title + '">'
                            + '</a>'
                            + '</div>';
                        grid.append(newItem);
                        totalLoadedCount++;
                    });

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

        loadPhotos(0, false);

        $('.dropbtn3').click(function() {
            var offset = $('.grid-item').length;
            loadPhotos(offset, true);
        });

        $('.dropdown-content .category-option').click(function() {
            $('#categorie-dropdown .dropbtn').text($(this).text()).data('value', $(this).data('value'));
            loadPhotos(0, false);
        });

        $('.dropdown-content .format-option').click(function() {
            $('#format-dropdown .dropbtn').text($(this).text()).data('value', $(this).data('value'));
            loadPhotos(0, false);
        });

        $('.dropdown-content .filtre-option').click(function() {
            $('#filtre-dropdown .dropbtn2').text($(this).text()).data('value', $(this).data('value'));
            loadPhotos(0, false);
        });
    }
});
