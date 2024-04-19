/* Navigation menu burger mobile */
console.log("Navigation menu burger mobile : son js est chargé");

$(document).ready(function () {
    // Sélection des éléments DOM nécessaires
    const header = $('header'); // En-tête du site
    const menuBurger = $('.burgerMenu'); // Bouton du menu burger
    const nav = $('.navigation'); // Menu de navigation
    const menuLinks = $('.menuNavigation li a'); // Liens du menu de navigation

    // Événement de clic sur le bouton du menu burger
    menuBurger.on('click', function () {
        // Vérifie si le menu est ouvert
        const isOpen = header.hasClass('open');

        // Bascule les classes pour ouvrir ou fermer le menu
        header.toggleClass('open', !isOpen); // Ajoute ou supprime la classe 'open' de l'en-tête
        menuBurger.toggleClass('open', !isOpen); // Ajoute ou supprime la classe 'open' du bouton du menu burger
        nav.toggleClass('open', !isOpen); // Ajoute ou supprime la classe 'open' du menu de navigation
    });
});

