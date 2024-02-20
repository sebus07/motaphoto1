document.addEventListener('DOMContentLoaded', function() {
    // Sélectionner la modal et le bouton de fermeture
    var modal = document.getElementById('modal-contact');
    var closeButton = modal.querySelector('.close');

    // Afficher automatiquement la modal au chargement de la page
    modal.style.display = 'block';

    // Fermer la modal lorsqu'on clique sur le bouton de fermeture ou en dehors de la modal
    closeButton.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });
});
