<?php
$annee = get_field('annee');
$categorie = get_field('categorie');
$format = get_field('format');
$image = get_field('image');
$Référence = get_field('reference');
$type = get_field('type');

get_header();
?>

</head>
<body>
    <div class="hero">
        <a href="#">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/asset/img/header.webp" alt="Description de l'image">
        </a>
    </div>
    <section class="">
        <div class="filtres">
            <div class="dropdown">
                <button class="dropbtn poppins-font">CATÉGORIES</button>
                <div class="dropdown-content poppins-font">
                    <a href="#" class="filter-category" data-category="reception">Réception</a>
                    <a href="#" class="filter-category" data-category="television">Télévision</a>
                    <a href="#" class="filter-category" data-category="concert">Concert</a>
                    <a href="#" class="filter-category" data-category="mariage">Mariage</a>
                </div>
            </div>
            <div class="dropdown poppins-font">
                <button class="dropbtn poppins-font">FORMATS</button>
                <div class="dropdown-content">
                    <a href="#" class="filter-format" data-format="paysage">Paysage</a>
                    <a href="#" class="filter-format" data-format="portrait">Portrait</a>
                </div>
            </div>
        </div>
        <div class="filtres2">
            <div class="dropdown">
                <button class="dropbtn2 poppins-font">TRIER PAR</button>
                <div class="dropdown-content">
                    <a href="#" class="filter-date" data-order="ascendant">DATE-ordre croissant</a>
                    <a href="#" class="filter-date" data-order="descendant">DATE-ordre décroissant</a>
                </div>
            </div>
        </div>
    </section>
    <div class="photo">
        <div class="grid">
            <?php
            $args = array(
                'post_type' => 'cif_FichierPhotos', // Votre type de post personnalisé
                'posts_per_page' => 8, // Pour afficher tous les posts, utilisez -1
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();

                    // Récupérer l'image depuis le champ ACF 'image'
                    $image = get_field('image');

                    // Autres champs que vous souhaitez passer
                    $annee = get_field('annee');
                    $categorie = get_field('categorie');
                    $format = get_field('format');
                    $Référence = get_field('reference');
                    $type = get_field('type');

                    // Ajoutez une classe et des attributs data avec les données
                    if ($image) {
                        echo '<div class="grid-item survol-photo ' . $categorie . ' ' . $format . '">';
                        // Ajoutez le lien autour de l'image avec une classe spécifique pour sélectionner avec JavaScript
                        echo '<a href="' . esc_url(get_permalink()) . '" class="photo-link">';
                        echo '<img class="photo-clickable" data-annee="' . $annee . '" data-categorie="' . $categorie . '" data-format="' . $format . '" data-referentiel="' . $Référence . '" data-type="' . $type . '" src="' . $image['url'] . '" alt="' . get_the_title() . '">';
                        echo '</a>';
                        echo '</div>';
                    }
                }

                wp_reset_postdata(); // Réinitialiser les données du post
            } else {
                // Aucun post trouvé
                echo 'Aucun FichierPhoto trouvé.';
            }
            ?>
        </div>
    </div>

    <div class="chargerplus motaphoto-font">
        <button class="dropbtn3 motaphoto-font">Charger plus</button>
    </div>

    <!-- Vos balises de pied de page ici -->

    <!-- Ajoutez ce code JavaScript à la fin de votre page HTML -->
    <script>
        // Récupérer tous les éléments avec la classe "filter-category"
        const categoryFilters = document.querySelectorAll('.filter-category');
        // Récupérer tous les éléments avec la classe "filter-format"
        const formatFilters = document.querySelectorAll('.filter-format');
        // Récupérer tous les éléments avec la classe "filter-date"
        const dateFilters = document.querySelectorAll('.filter-date');
        // Sélectionner le bouton "Charger plus"
        const loadMoreButton = document.querySelector('.dropbtn3');

        // Parcourir chaque filtre de catégorie et ajouter un gestionnaire d'événements de clic
        categoryFilters.forEach(function(filter) {
            filter.addEventListener('click', function(event) {
                event.preventDefault(); // Empêcher le comportement par défaut du lien
                const category = this.getAttribute('data-category');
                // Afficher un message dans la console pour vérification
                console.log('Filtre Catégorie ' + category + ' cliqué');

                // Filtrer les éléments de la grille en fonction de la catégorie sélectionnée
                filterGridItems(category);

                // Charger 8 photos si la catégorie sélectionnée est "Réception"
                if (category === 'reception') {
                    loadFilteredPhotos();
                }
            });
        });

        // Parcourir chaque filtre de format et ajouter un gestionnaire d'événements de clic
        formatFilters.forEach(function(filter) {
            filter.addEventListener('click', function(event) {
                event.preventDefault(); // Empêcher le comportement par défaut du lien
                const format = this.getAttribute('data-format');
                // Afficher un message dans la console pour vérification
                console.log('Filtre Format ' + format + ' cliqué');

                // Filtrer les éléments de la grille en fonction du format sélectionné
                filterGridItems(format);
            });
        });

        // Parcourir chaque filtre de date et ajouter un gestionnaire d'événements de clic
        dateFilters.forEach(function(filter) {
            filter
            .addEventListener('click', function(event) {
                event.preventDefault(); // Empêcher le comportement par défaut du lien
                const order = this.getAttribute('data-order');
                // Afficher un message dans la console pour vérification
                console.log('Filtre Date ' + order + ' cliqué');

                // Trier les éléments de la grille en fonction de la date sélectionnée
                sortGridItems(order);
            });
        });

        // Ajouter un gestionnaire d'événements de clic sur le bouton "Charger plus"
        loadMoreButton.addEventListener('click', function() {
            loadMorePhotos(); // Appel de la fonction pour charger plus de photos
        });

        // Fonction pour filtrer les éléments de la grille en fonction de la catégorie sélectionnée
        function filterGridItems(filterValue) {
            const
            gridItems = document.querySelectorAll('.grid-item');
            gridItems.forEach(function(item) {
                if (filterValue === 'all') {
                    item.style.display = 'block'; // Afficher tous les éléments si la valeur du filtre est "all"
                } else {
                    if (item.classList.contains(filterValue)) {
                        item.style.display = 'block'; // Afficher l'élément s'il correspond au filtre sélectionné
                    } else {
                        item.style.display = 'none'; // Masquer l'élément s'il ne correspond pas au filtre sélectionné
                    }
                }
            });
        }

    // Fonction pour charger 8 photos si la catégorie "Réception" est sélectionnée
    function loadFilteredPhotos(category) {
        const gridItems = document.querySelectorAll('.grid-item');
        let count = 0;
        gridItems.forEach(function(item) {
            if (category === 'all' || item.classList.contains(category)) {
                if (count < 8 && (category === 'reception' || !category)) {
                    item.style.display = 'block'; // Afficher l'élément si la catégorie correspond et si le nombre maximum n'est pas atteint
                    count++;
                } else {
                    item.style.display = 'none'; // Masquer l'élément si le nombre maximum est atteint ou si la catégorie n'est pas "Réception"
                }
            } else {
                item.style.display = 'none'; // Masquer l'élément s'il ne correspond pas à la catégorie sélectionnée
            }
        });
    }
        // Fonction pour trier les éléments de la grille en fonction de la date
        function sortGridItems(order) {
            const grid = document.querySelector('.grid');
            const items = Array.from(grid.children);

            items.sort(function(a, b) {
                const dateA = new Date(a.querySelector('.photo-clickable').getAttribute('data-annee'));
                const dateB = new Date(b.querySelector('.photo-clickable').getAttribute('data-annee'));

                if (order === 'ascendant') {
                    return dateA - dateB;
                } else {
                    return dateB - dateA;
                }
            });

            // Vider la grille et réinsérer les éléments triés
            while (grid.firstChild) {
                grid.removeChild(grid.firstChild);
            }

            items.forEach(function(item) {
                grid.appendChild(item);
            });
        }

        // Fonction pour charger plus de photos
        function loadMorePhotos() {
            const visibleItems = document.querySelectorAll('.grid-item:not([style*="display: none"])');
            const hiddenItems = document.querySelectorAll('.grid-item[style*="display: none"]');
            let count = 0;

            // Afficher jusqu'à 8 éléments cachés
            hiddenItems.forEach(function(item) {
                if (count < 8 && visibleItems.length + count < 16) {
                    item.style.display = 'block';
                    count++;
                }
            });

            // Masquer le bouton si tous les éléments sont affichés
            if (visibleItems.length + count >= 16) {
                loadMoreButton.textContent = 'Plus de photos';
                loadMoreButton.disabled = true;
            }
            console.log(document.querySelector('.filter-category'));

        }
    </script>
</body>
</html>
