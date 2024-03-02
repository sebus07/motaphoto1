
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
                        $('.dropbtn3').text('Aucune photo trouvée');
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


////// popup d'ouvertur des photo/////





