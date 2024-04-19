/* Affichage Modale */
console.log("Affichage modale Contact : son js est chargé");

$(document).ready(function() {
    // Sélection des éléments DOM nécessaires
    const lienContact = $('#menu-item-60'); // Lien dans le menu pour ouvrir la modale
    const boutonContact = $('#boutonContact'); // Bouton de contact pour ouvrir la modale
    const modalOverlay = $('.popup-overlay'); // Overlay de la modale
    const referencePhoto = $('#referencePhoto'); // Champ de référence de photo dans la modale

    // Fonction pour ouvrir la modale
    const openModal = function() {
        modalOverlay.css('display', 'flex'); // Affiche la modale en mode flexbox

        // Vérifie si le bouton de contact a une référence de photo et la place dans le champ approprié de la modale
        if (boutonContact.attr('data-reference') && boutonContact.attr('data-reference').trim() !== "") {
            referencePhoto.val(boutonContact.attr('data-reference'));
        }
    };

    // Fonction pour fermer la modale
    const closeModal = function() {
        modalOverlay.css('display', 'none'); // Masque la modale
    };

    // Événement pour ouvrir la modale lorsque l'utilisateur clique sur le lien de contact dans le menu
    lienContact.on('click', function(event) {
        event.preventDefault(); // Empêche le comportement par défaut du lien
        openModal(); // Appelle la fonction pour ouvrir la modale
    });

    // Événement pour ouvrir la modale lorsque l'utilisateur clique sur le bouton de contact
    boutonContact.on('click', function(event) {
        event.preventDefault(); // Empêche le comportement par défaut du bouton
        openModal(); // Appelle la fonction pour ouvrir la modale
    });

    // Événement pour fermer la modale lorsque l'utilisateur clique en dehors de celle-ci
    $(window).on('click', function(event) {
        if (event.target === modalOverlay[0]) { // Vérifie si l'élément cliqué est l'overlay de la modale
            closeModal(); // Appelle la fonction pour fermer la modale
        }
    });
});

