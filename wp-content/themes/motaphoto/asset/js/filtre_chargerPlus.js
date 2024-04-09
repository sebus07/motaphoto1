document.addEventListener('DOMContentLoaded', function() {
    const categorieSelect = document.getElementById('categorie-select');
    const formatSelect = document.getElementById('format-select');
    const filtreSelect = document.getElementById('filtre-select');
    const gridItems = document.querySelectorAll('.grid-item');
    const loadMoreButton = document.querySelector('.chargerplus button'); // Déplacer la déclaration du bouton en dehors de la fonction
    let loadedCount = 0; // Compteur pour le nombre de photos déjà chargées
    let totalLoadedCount = 0; // Compteur pour le nombre total de photos chargées

    // Fonction pour charger plus de photos
    function loadMorePhotos() {
        const gridItemsArray = Array.from(gridItems);
        let count = 0; // Compteur pour le nombre de photos à charger

        gridItemsArray.forEach(function(item, index) {
            if (index >= totalLoadedCount && count < 8) {
                const categorie = item.getAttribute('data-categorie');
                const format = item.getAttribute('data-format');
                const categorieMatch = categorieSelect.value === 'all' || categorie === categorieSelect.value;
                const formatMatch = formatSelect.value === 'all' || format === formatSelect.value;

                if (categorieMatch && formatMatch) {
                    item.style.display = 'block';
                    count++;
                }
            }
        });

        loadedCount += count; // Mettre à jour le compteur de photos chargées
        totalLoadedCount += count; // Mettre à jour le compteur total de photos chargées
        checkLoadMoreButton(); // Vérifier si le bouton "Charger plus" doit être affiché
    }

    // Fonction pour vérifier si le bouton "Charger plus" doit être affiché
    function checkLoadMoreButton() {
        if (totalLoadedCount >= gridItems.length) {
            loadMoreButton.style.display = 'none'; // Cacher le bouton si toutes les photos sont chargées
        } else {
            loadMoreButton.style.display = 'block'; // Afficher le bouton s'il reste des photos à charger
        }
    }

    // Ajouter un gestionnaire d'événements pour le bouton "Charger plus"
    loadMoreButton.addEventListener('click', loadMorePhotos);

    // Afficher initialement seulement 8 photos sans filtrage
    gridItems.forEach(function(item, index) {
        if (index < 8) {
            item.style.display = 'block';
            loadedCount++; // Incrémente le compteur
            totalLoadedCount++; // Incrémente le compteur total
        } else {
            item.style.display = 'none'; // Cacher les photos supplémentaires
        }
    });

    // Ajoutez un gestionnaire d'événements pour le changement de sélection de catégorie
    categorieSelect.addEventListener('change', filterGridItems);

    // Ajoutez un gestionnaire d'événements pour le changement de sélection de format
    formatSelect.addEventListener('change', filterGridItems);

    // Ajoutez un gestionnaire d'événements pour le changement de sélection de filtre
    filtreSelect.addEventListener('change', filterGridItems);

    // Fonction pour filtrer les photos
    function filterGridItems() {
        const categorieValue = categorieSelect.value;
        const formatValue = formatSelect.value;
        const filtreValue = filtreSelect.value;

        let count = 0; // Initialiser le compteur de photos

        // Convertir les nœuds NodeList en un tableau pour faciliter le tri
        const gridItemsArray = Array.from(gridItems);

        gridItemsArray.sort(function(a, b) {
            const dateA = a.getAttribute('data-annee');
            const dateB = b.getAttribute('data-annee');

            if (filtreValue === 'ascendant') {
                // Tri croissant
                return new Date(dateA) - new Date(dateB);
            } else if (filtreValue === 'descendant') {
                // Tri décroissant
                return new Date(dateB) - new Date(dateA);
            }
        });

        gridItemsArray.forEach(function(item) {
            const categorie = item.getAttribute('data-categorie');
            const format = item.getAttribute('data-format');
            const annee = item.getAttribute('data-annee');

            const categorieMatch = categorieValue === 'all' || categorie === categorieValue;
            const formatMatch = formatValue === 'all' || format === formatValue;

            if (categorieMatch && formatMatch && count < loadedCount) { // Utilisez loadedCount au lieu de 8
                item.style.display = 'block';
                count++; // Incrémente le compteur
            } else {
                item.style.display = 'none';
            }
        });

        checkLoadMoreButton(); // Vérifier si le bouton "Charger plus" doit être affiché

        // Mettre à jour l'ordre des éléments dans le DOM
        const grid = document.querySelector('.grid');
        gridItemsArray.forEach(function(item) {
            grid.appendChild(item);
        });
    }
});