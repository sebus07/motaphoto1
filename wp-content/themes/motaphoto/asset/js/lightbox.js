document.addEventListener('DOMContentLoaded', function () {

    // Gestion de la lightbox
    let lightbox = document.getElementById('lightbox');
    let closeBtnLightbox = document.querySelector('.close-btn');
    let photos = document.querySelectorAll('.photo-image img');
    let currentIndex = 0;

    function openLightbox(index) {
        let photo = photos[index];
        let imageSrc = photo.src;
        let reference = photo.getAttribute('data-reference');
        let categorie = photo.getAttribute('data-categorie');

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
    let previousBtn = document.getElementById('previousPhoto');
    let nextBtn = document.getElementById('nextPhoto');

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


});
