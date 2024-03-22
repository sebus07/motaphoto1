
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



jQuery(function($){
    var page = 1;
    var canBeLoaded = true;

    $('.dropbtn3').on('click', function(){
        if(canBeLoaded){
            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: {
                    action: 'load_more_photos',
                    page: page,
                    filter: 'mariage' // Passer le filtre pour la catégorie "Mariage"
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
                        $('.dropbtn3').text('Fin des photos');
                        canBeLoaded = false;
                    }
                }
            });
        }
    });

    // Ajouter un événement de clic pour les images chargées
    $('.grid').on('click', '.grid-item a', function(e){
        e.preventDefault(); // Empêcher le lien par défaut
        var link = $(this).attr('href');

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


////////////// trier par date///////////////////////////////////

jQuery(function($) {
    var page = 1;
    var canBeLoaded = true;
    var orderBy = ''; // Variable pour stocker l'ordre de tri

    // Fonction pour charger les photos triées par année
    $('.filter-annee').on('click', function(e) {
        e.preventDefault();
        var orderType = $(this).data('type'); // Récupérer l'ordre de tri depuis l'attribut de données

        // Déterminer l'ordre de tri en fonction du type spécifié
        if (orderType === 'ascendant') {
            orderBy = 'ASC';
        } else if (orderType === 'descendant') {
            orderBy = 'DESC';
        }

        if (canBeLoaded) {
            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: {
                    action: 'load_photos_sorted_by_year', // Action pour charger les photos triées par année
                    page: page,
                    order_by: orderBy // Passer l'ordre de tri
                },
                beforeSend: function() {
                    $('.grid').html(''); // Efface les photos actuelles avant de charger les nouvelles
                },
                success: function(response) {
                    if (response) {
                        $('.grid').append(response);
                        page++;
                    } else {
                        canBeLoaded = false;
                    }
                }
            });
        }
    });
});
///////////////////////////

////////menu burger//////////////////////////////////////////
document.addEventListener("DOMContentLoaded", function() {
    var menuToggle = document.querySelector(".menu-toggle");
    var mobileMenu = document.querySelector(".mobile-menu");

    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener("click", function() {
            this.classList.toggle("menu-open");
            mobileMenu.classList.toggle("menu-open");
        });

        // Fermer le menu lorsque vous cliquez sur un lien du menu
        var mobileMenuLinks = document.querySelectorAll(".mobile-menu a");

        mobileMenuLinks.forEach(function(link) {
            link.addEventListener("click", function() {
                // Ajoutez une vérification pour voir si le lien a un parent avec la classe "mobile-menu"
                if (this.closest('.mobile-menu')) {
                    menuToggle.classList.remove("menu-open");
                    mobileMenu.classList.remove("menu-open");
                }
            });
        });
    }
});

/////// ouverture de la modal-contact si clic sur menu contact//////////////////////////////////////
jQuery(function($){
    var page = 1;
    var canBeLoaded = true;

 
    // Filtrer par catégorie
    $('.filter-category').on('click', function(e){
        e.preventDefault();
        var filterCategory = $(this).data('category');
        loadFilteredPhotos(filterCategory, '', '');
    });

    // Filtrer par format
    $('.filter-format').on('click', function(e){
        e.preventDefault();
        var filterFormat = $(this).data('format');
        loadFilteredPhotos('', filterFormat, '');
    });

    // Trier les photos
    $('.sort-by').on('click', function(e){
        e.preventDefault();
        var sortBy = $(this).data('sort');
        loadFilteredPhotos('', '', sortBy);
    });

    // Charger plus de photos
    $('.dropbtn3').on('click', function(){
        var filterCategory = $('.filter-category.active').data('category');
        var filterFormat = $('.filter-format.active').data('format');
        var sortBy = $('.sort-by.active').data('sort');
        loadFilteredPhotos(filterCategory, filterFormat, sortBy);
    });

    // Ajouter un événement de clic pour les images chargées
    $('.grid').on('click', '.grid-item a', function(e){
        e.preventDefault(); // Empêcher le lien par défaut
        var link = $(this).attr('href');
        // Ouvrir le lien dans une nouvelle fenêtre
        window.open(link, '_blank');
    });

    // Menu burger
    var menuToggle = document.querySelector(".menu-toggle");
    var mobileMenu = document.querySelector(".mobile-menu");

    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener("click", function() {
            this.classList.toggle("menu-open");
            mobileMenu.classList.toggle("menu-open");
        });

        // Fermer le menu lorsque vous cliquez sur un lien du menu
        var mobileMenuLinks = document.querySelectorAll(".mobile-menu a");

        mobileMenuLinks.forEach(function(link) {
            link.addEventListener("click", function() {
                menuToggle.classList.remove("menu-open");
                mobileMenu.classList.remove("menu-open");
            });
        });

        // Empêcher la redirection sur la page de contact sur mobile
        mobileMenuLinks.forEach(function(link) {
            link.addEventListener("click", function(e) {
                if ($(window).width() <= 768) {
                    e.preventDefault();
                    var modal = document.getElementById('modal-contact');
                    modal.style.display = 'block';
                }
            });
        });
    }

    // Afficher la modal contact en cliquant sur le lien CONTACT
    $('#menu-item-20 a').on('click', function(e){
        e.preventDefault();
        var modal = document.getElementById('modal-contact');
        modal.style.display = 'block';
    });

    // Fermer la modal contact en cliquant sur le bouton de fermeture
    $('.close').on('click', function(){
        var modal = document.getElementById('modal-contact');
        modal.style.display = 'none';
    });

    // Fermer la modal contact en cliquant en dehors de la modal
    window.addEventListener('click', function(event) {
        var modal = document.getElementById('modal-contact');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });
});



/////////////////////// reference photo dans la modale contact//////////////////////////////
document.addEventListener('DOMContentLoaded', function() {
    // Sélectionner le bouton "Contact"
    var contactButton = document.querySelector('.dropbtn4');
    
    // Sélectionner la modal et le champ de formulaire
    var modal = document.getElementById('modal-contact');
    var referenceField = document.getElementById('wpforms-102-field_3');
    
    // Gérer le clic sur le bouton "Contact"
    contactButton.addEventListener('click', function() {
        // Récupérer la référence de la photo depuis l'attribut data
        var photoReference = contactButton.getAttribute('data-reference');
        
        // Ouvrir la modal
        modal.style.display = 'block';
        
        // Insérer la référence dans le champ de formulaire
        referenceField.value = photoReference;
    });
    
    // Fermer la modal lorsqu'on clique sur le bouton de fermeture
    var closeButton = modal.querySelector('.close');
    closeButton.addEventListener('click', function() {
        modal.style.display = 'none';
    });
    
    // Fermer la modal lorsqu'on clique en dehors de la modal
    window.addEventListener('click', function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });
});





/////// ligntbox//////////////////////////////

document.addEventListener("DOMContentLoaded", function() {
    const thumbnails = document.querySelectorAll(".thumbnail");
    const lightbox = document.getElementById("lightbox");
    const theNextPhoto = document.getElementById("nextPhoto");
    const thePreviousPhoto = document.getElementById("previousPhoto");
    const miniatureNextPhoto = document.getElementById("nextPhoto2");
    const miniaturethePreviousPhoto = document.getElementById("previousPhoto2");
    const lightboxImage = document.querySelector(".lightbox-image");
    const lightboxReference = document.querySelector(".reference");
    const lightboxCategorie = document.querySelector(".categorie");
    const closeBtn = document.querySelector(".close-btn");
    const lightboxContainer = document.querySelector("#lightbox");

    let currentIndex = 0; // Variable pour suivre l'index de la photo actuellement affichée dans la lightbox

    // Fonction pour ouvrir la lightbox avec la photo correspondante
    function openLightbox(index) {
        const thumbnail = thumbnails[index];
        const imageSrc = thumbnail.src;
        const reference = thumbnail.getAttribute("data-reference");
        const categorie = thumbnail.getAttribute("data-categorie");

        lightboxImage.src = imageSrc;
        lightboxReference.textContent = "Référence : " + reference;
        lightboxCategorie.textContent = "Catégorie : " + categorie;
        lightbox.style.display = "block";
        currentIndex = index;
    }

    // Fonction pour passer à la photo précédente dans la lightbox
    function previousLightboxPhoto() {
        if (currentIndex > 0) {
            openLightbox(currentIndex - 1);
        }
    }

    // Fonction pour passer à la photo suivante dans la lightbox
    function nextLightboxPhoto() {
        if (currentIndex < thumbnails.length - 1) {
            openLightbox(currentIndex + 1);
        }
    }

    // Ajout d'écouteurs d'événements aux boutons de navigation dans la lightbox
    thePreviousPhoto.addEventListener("click", previousLightboxPhoto);
    theNextPhoto.addEventListener("click", nextLightboxPhoto);

    // Ajout d'écouteurs d'événements aux boutons de navigation dans la galerie miniature
    miniaturethePreviousPhoto.addEventListener("click", function() {
        if (currentIndex > 0) {
            thumbnails[currentIndex - 1].click();
        }
    });
    miniatureNextPhoto.addEventListener("click", function() {
        if (currentIndex < thumbnails.length - 1) {
            thumbnails[currentIndex + 1].click();
        }
    });

    // Ajouter un écouteur d'événement à chaque miniature
    thumbnails.forEach((thumbnail, index) => {
        thumbnail.addEventListener("click", function() {
            openLightbox(index);
        });
    });

    // Fermer la lightbox en cliquant sur le bouton de fermeture
    closeBtn.addEventListener("click", function() {
        lightbox.style.display = "none";
    });
});


/////////////////////////////////photo yeux///////////////////

