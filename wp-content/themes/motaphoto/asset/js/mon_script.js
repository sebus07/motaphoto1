
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

    // Ajouter un événement de clic pour les images chargées
    $('.grid').on('click', '.grid-item a', function(e){
        e.preventDefault(); // Empêcher le lien par défaut
        var link = $(this).attr('href');
        // Ouvrir le lien dans une nouvelle fenêtre
        window.open(link, '_self');
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

    $(document).ready(function() {
        // Afficher la modal contact en cliquant sur le lien CONTACT dans le menu
        $('#menu-item-101 a').on('click', function(e){
            e.preventDefault();
            var modal = document.getElementById('modal-contact');
            modal.style.display = 'block';
        });
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
    const lightboxImage = document.querySelector(".lightbox-image");
    const lightbox = document.getElementById("lightbox");
    const closeBtn = document.querySelector(".close-btn");
    const previousBtn = document.getElementById("previousPhoto");
    
    const nextBtn = document.getElementById("nextPhoto");
    const photos = document.querySelectorAll('.photo-image img'); // Sélectionnez toutes les grandes images

    let currentIndex = 0;

    // Fonction pour ouvrir la lightbox avec la photo correspondante
    function openLightbox(index) {
        const photo = photos[index];
        const imageSrc = photo.src;
        const reference = photo.getAttribute("data-reference");
        const categorie = photo.getAttribute("data-categorie");

        lightboxImage.src = imageSrc;
        document.querySelector(".reference").textContent = "Référence : " + reference;
        document.querySelector(".categorie").textContent = "Catégorie : " + categorie;
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
        if (currentIndex < photos.length - 1) {
            openLightbox(currentIndex + 1);
        }
    }

    // Ajout d'écouteurs d'événements pour les boutons de navigation précédent et suivant
    previousBtn.addEventListener("click", previousLightboxPhoto);
    nextBtn.addEventListener("click", nextLightboxPhoto);

    // Ajouter un écouteur d'événement à chaque grande photo
    photos.forEach((photo, index) => {
        photo.addEventListener("click", function() {
            openLightbox(index);
        });
    });

    // Fermer la lightbox en cliquant sur le bouton de fermeture
    closeBtn.addEventListener("click", function() {
        lightbox.style.display = "none";
    });
});



/////////////////////////////////gestion de la modal contact///////////////////

document.addEventListener('DOMContentLoaded', function() {
    // Sélectionner la modal et le bouton de fermeture
    var modal = document.getElementById('modal-contact');
    var closeButton = modal.querySelector('.close');

    // Initialiser la modal comme masquée au chargement de la page
    modal.style.display = 'none';

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

// Modal contact lors du clic sur le lien dans le menu
jQuery(document).ready(function($) {
    $('#menu-item-101 a').on('click', function(e){
        e.preventDefault();
        var modal = document.getElementById('modal-contact');
        modal.style.display = 'block';
    });
});

// Fermeture de la modal au clic sur le bouton de fermeture
jQuery(document).ready(function($) {
    $('.close').on('click', function(){
        var modal = document.getElementById('modal-contact');
        modal.style.display = 'none';
    });
});





