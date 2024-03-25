document.addEventListener('DOMContentLoaded', function () {
    // Modal contact
    var modalContact = document.getElementById('modal-contact');
    var closeButtonContact = modalContact.querySelector('.close');
    var menuContactLink = document.getElementById('menu-item-101');

    // Ouvrir la modal contact lors du clic sur le lien dans le menu
    if (menuContactLink) {
        menuContactLink.addEventListener('click', function (e) {
            e.preventDefault();
            modalContact.style.display = 'block';
        });
    }

    // Fermer la modal contact lors du clic sur le bouton de fermeture
    if (closeButtonContact) {
        closeButtonContact.addEventListener('click', function () {
            modalContact.style.display = 'none';
        });
    }

    // Gestion de la lightbox
    var lightbox = document.getElementById('lightbox');
    var closeBtnLightbox = document.querySelector('.close-btn');
    var photos = document.querySelectorAll('.photo-image img');
    var currentIndex = 0;

    function openLightbox(index) {
        var photo = photos[index];
        var imageSrc = photo.src;
        var reference = photo.getAttribute('data-reference');
        var categorie = photo.getAttribute('data-categorie');

        document.querySelector('.lightbox-image').src = imageSrc;
        document.querySelector('.reference').textContent = 'Référence : ' + reference;
        document.querySelector('.categorie').textContent = 'Catégorie : ' + categorie;
        lightbox.style.display = 'block';
        currentIndex = index;
    }

    photos.forEach(function (photo, index) {
        photo.addEventListener('click', function () {
            openLightbox(index);
        });
    });

    closeBtnLightbox.addEventListener('click', function () {
        lightbox.style.display = 'none';
    });

    // Navigation dans la lightbox
    var previousBtn = document.getElementById('previousPhoto');
    var nextBtn = document.getElementById('nextPhoto');

    previousBtn.addEventListener('click', function () {
        if (currentIndex > 0) {
            openLightbox(currentIndex - 1);
        }
    });

    nextBtn.addEventListener('click', function () {
        if (currentIndex < photos.length - 1) {
            openLightbox(currentIndex + 1);
        }
    });

    // Sélectionner le bouton "Contact"
    var contactButton = document.querySelector('.dropbtn4');

    // Sélectionner la modal et le champ de formulaire
    var modal = document.getElementById('modal-contact');
    var referenceField = document.getElementById('wpforms-102-field_3');

    // Gérer le clic sur le bouton "Contact"
    contactButton.addEventListener('click', function () {
        // Récupérer la référence de la photo depuis l'attribut data
        var photoReference = contactButton.getAttribute('data-reference');

        // Ouvrir la modal
        modal.style.display = 'block';

        // Insérer la référence dans le champ de formulaire
        referenceField.value = photoReference;
    });

    // Fermer la modal lorsqu'on clique sur le bouton de fermeture
    var closeButton = modal.querySelector('.close');
    closeButton.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    // Fermer la modal lorsqu'on clique en dehors de la modal
    window.addEventListener('click', function (event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });
});
document.addEventListener('DOMContentLoaded', function () {
    var menuContactLink = document.getElementById('menu-item-101');
    console.log(menuContactLink); // Vérifiez si menuContactLink est null ou non
});