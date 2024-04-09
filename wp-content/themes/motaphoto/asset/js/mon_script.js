document.addEventListener('DOMContentLoaded', function () {
    // Modal contact
    let modalContact = document.getElementById('modal-contact');
    let closeButtonContact = modalContact.querySelector('.close');
    let menuContactLink = document.getElementById('menu-item-101');

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

    // Sélectionner le bouton "Contact"
    let contactButton = document.querySelector('.dropbtn4');

    // Sélectionner la modal et le champ de formulaire
    let modal = document.getElementById('modal-contact');
    let referenceField = document.getElementById('wpforms-102-field_3');

    // Gérer le clic sur le bouton "Contact"
    contactButton.addEventListener('click', function () {
        // Récupérer la référence de la photo depuis l'attribut data
        let photoReference = contactButton.getAttribute('data-reference');

        // Ouvrir la modal
        modal.style.display = 'block';

        // Insérer la référence dans le champ de formulaire
        referenceField.value = photoReference;
    });

    // Fermer la modal lorsqu'on clique sur le bouton de fermeture
    let closeButton = modal.querySelector('.close');
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