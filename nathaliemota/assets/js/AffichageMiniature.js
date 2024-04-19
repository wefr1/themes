/* Affichage Miniature */
console.log("Affichage Miniature : son js est chargé");

$(document).ready(function() {
    const miniPicture = $('#miniPicture'); // Sélectionne l'élément #miniPicture

    // Gère les événements de survol des flèches de navigation gauche et droite
    $('.arrow-left, .arrow-right').hover(
        function() { // Fonction exécutée au survol de la flèche
            // Affiche la miniature avec l'URL et l'alt de la photo correspondante
            miniPicture.css({
                visibility: 'visible',
                opacity: 1
            }).html(`<a href="${$(this).data('target-url')}">
                        <img src="${$(this).data('thumbnail-url')}" alt="${$(this).hasClass('arrow-left') ? 'Photo précédente' : 'Photo suivante'}">
                    </a>`);
        },
        function() { // Fonction exécutée lorsque le survol se termine
            // Cache la miniature
            miniPicture.css({
                visibility: 'hidden',
                opacity: 0
            });
        }
    );

    // Redirige l'utilisateur vers l'URL de la photo lorsqu'il clique sur une flèche
    $('.arrow-left, .arrow-right').click(function() {
        window.location.href = $(this).data('target-url');
    });
});
