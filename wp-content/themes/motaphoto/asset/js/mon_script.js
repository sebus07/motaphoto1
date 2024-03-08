
document.addEventListener('DOMContentLoaded', function() {
    // Sélectionner la modal et le bouton de fermeture
    var modal = document.getElementById('modal-contact');
    var closeButton = modal.querySelector('.close');

    // Afficher automatiquement la modal au chargement de la page
    modal.style.display = 'block';

    // Fermer la modal lorsqu'on clique sur le bouton de fermeture de la modal
    closeButton.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });
});



////requete ajax pour charger plus////////////////
jQuery(function($){
    var page = 2;
    var canBeLoaded = true;

    $('.dropbtn3').on('click', function(){
        if(canBeLoaded){
            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: {
                    action: 'load_more_photos',
                    page: page,
                },
                beforeSend:function(){
                    $('.dropbtn3').text('Chargement...');
                },
                success:function(response){
                    if(response){
                        $('.grid').append(response);
                        page++;
                        $('.dropbtn3').text('Charger plus');
                    } else {
                        $('.dropbtn3').text('Fin des photo');
                        canBeLoaded = false;
                    }
                }
            });
        }
    });
});


/////////////requete ajax pour filter les categorie///////////////////////

jQuery(function($){
    var page = 1;
    var canBeLoaded = true;

    // Fonction pour charger les photos de la catégorie "Mariage" via AJAX
    $('.filter-mariage').on('click', function(e){
        e.preventDefault();
        
        if(canBeLoaded){
            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: {
                    action: 'load_photos_by_mariage',
                    page: page,
                },
                beforeSend:function(){
                    $('.grid').html(''); // Efface les photos actuelles avant de charger les nouvelles
                    $('.dropbtn3').text('Chargement...');
                },
                success:function(response){
                    if(response){
                        $('.grid').append(response);
                        page++;
                        $('.dropbtn3').text('Charger plus');
                    } else {
                        $('.dropbtn3').text('Aucune photo trouvée');
                        canBeLoaded = false;
                    }
                }
            });
        }
    });
})


/////////////concert

jQuery(function($){
    var page = 1;
    var canBeLoaded = true;

    // Fonction pour charger les photos de la catégorie "Concert" via AJAX
    $('.filter-concert').on('click', function(e){
        e.preventDefault();
        
        if(canBeLoaded){
            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: {
                    action: 'load_photos_by_concert',
                    page: page,
                },
                beforeSend:function(){
                    $('.grid').html(''); // Efface les photos actuelles avant de charger les nouvelles
                    $('.dropbtn3').text('Chargement...');
                },
                success:function(response){
                    if(response){
                        $('.grid').append(response);
                        page++;
                        $('.dropbtn3').text('Charger plus');
                    } else {
                        $('.dropbtn3').text('Aucune photo trouvée');
                        canBeLoaded = false;
                    }
                }
            });
        }
    });
})

/////////////television

jQuery(function($){
    var page = 1;
    var canBeLoaded = true;

    // Fonction pour charger les photos de la catégorie "television" via AJAX
    $('.filter-television').on('click', function(e){
        e.preventDefault();
        
        if(canBeLoaded){
            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: {
                    action: 'load_photos_by_television',
                    page: page,
                },
                beforeSend:function(){
                    $('.grid').html(''); // Efface les photos actuelles avant de charger les nouvelles
                    $('.dropbtn3').text('Chargement...');
                },
                success:function(response){
                    if(response){
                        $('.grid').append(response);
                        page++;
                        $('.dropbtn3').text('Charger plus');
                    } else {
                        $('.dropbtn3').text('Aucune photo trouvée');
                        canBeLoaded = false;
                    }
                }
            });
        }
    });
})

/////////////reception

jQuery(function($){
    var page = 1;
    var canBeLoaded = true;

    // Fonction pour charger les photos de la catégorie "reception" via AJAX
    $('.filter-reception').on('click', function(e){
        e.preventDefault();
        
        if(canBeLoaded){
            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: {
                    action: 'load_photos_by_reception',
                    page: page,
                },
                beforeSend:function(){
                    $('.grid').html(''); // Efface les photos actuelles avant de charger les nouvelles
                    $('.dropbtn3').text('Chargement...');
                },
                success:function(response){
                    if(response){
                        $('.grid').append(response);
                        page++;
                        $('.dropbtn3').text('Charger plus');
                    } else {
                        $('.dropbtn3').text('Aucune photo trouvée');
                        canBeLoaded = false;
                    }
                }
            });
        }
    });
})

/////////////format paysage///////////////////////////////////////////////////////////////

jQuery(function($){
    var page = 1;
    var canBeLoaded = true;

    // Fonction pour charger les photos du format "paysage" via AJAX
    $('.filter-paysage').on('click', function(e){
        e.preventDefault();
        
        if(canBeLoaded){
            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: {
                    action: 'load_photos_by_paysage',
                    page: page,
                },
                beforeSend:function(){
                    $('.grid').html(''); // Efface les photos actuelles avant de charger les nouvelles
                    $('.dropbtn3').text('Chargement...');
                },
                success:function(response){
                    if(response){
                        $('.grid').append(response);
                        page++;
                        $('.dropbtn3').text('Charger plus');
                    } else {
                        $('.dropbtn3').text('Aucune photo trouvée');
                        canBeLoaded = false;
                    }
                }
            });
        }
    });
})

/////////////format portrait///////////////////////////////////////////////////////////////

jQuery(function($){
    var page = 1;
    var canBeLoaded = true;

    // Fonction pour charger les photos du format "portrait" via AJAX
    $('.filter-portrait').on('click', function(e){
        e.preventDefault();
        
        if(canBeLoaded){
            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: {
                    action: 'load_photos_by_portrait',
                    page: page,
                },
                beforeSend:function(){
                    $('.grid').html(''); // Efface les photos actuelles avant de charger les nouvelles
                    $('.dropbtn3').text('Chargement...');
                },
                success:function(response){
                    if(response){
                        $('.grid').append(response);
                        page++;
                        $('.dropbtn3').text('Charger plus');
                    } else {
                        $('.dropbtn3').text('Aucune photo trouvée');
                        canBeLoaded = false;
                    }
                }
            });
        }
    });
})




jQuery(function($){
    var page = 1;
    var canBeLoaded = true;

    // Fonction pour charger les photos selon le type sélectionné
    $('.filter-type').on('click', function(e){
        e.preventDefault();
        var filterType = $(this).data('type');
        
        if(canBeLoaded){
            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: {
                    action: 'load_photos_by_type', // Utiliser la même action pour charger les photos par type
                    page: page,
                    filter_type: filterType, // Passer le type de filtre
                },
                beforeSend:function(){
                    $('.grid').html(''); // Efface les photos actuelles avant de charger les nouvelles
                    $('.dropbtn2').text('Chargement...');
                },
                success:function(response){
                    if(response){
                        $('.grid').append(response);
                        page++;
                        $('.dropbtn2').text('Charger plus');
                    } else {
                        $('.dropbtn2').text('Aucune photo trouvée');
                        canBeLoaded = false;
                    }
                }
            });
        }
    });
});



////////menu burger//////////////////////////////////////////

// JavaScript pour le menu burger

