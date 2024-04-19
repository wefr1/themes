// Chargement de plus d'images avec Ajax
console.log("Chargement de plus d'images avec Ajax : son js est chargé");

(function($) {
    // Écoute l'événement click sur le bouton "#plusDImage"
    $('#plusDImage').click(function() {
        var button = $(this),
            data = {
                'action': 'load_more', // Action à exécuter dans WordPress
                'query': ajaxloadmore.query_vars, // Paramètres de la requête
                'page': button.data('page') // Numéro de la page à charger
            };

        // Effectue une requête Ajax pour charger plus d'images
        $.ajax({
            url: ajaxurl, // URL de l'action Ajax définie par WordPress
            data: data, // Données à envoyer pour le chargement
            type: 'POST', // Type de requête HTTP
            beforeSend: function(xhr) {
                // Avant l'envoi de la requête, met à jour le texte du bouton
                button.text('Chargement...');
            },
            success: function(data) {
                // En cas de succès de la requête
                if (data === 'no_posts') {
                    // S'il n'y a plus de publications à charger, supprime le bouton
                    button.remove();
                } else if(data) {
                    // Si des données sont retournées, met à jour le numéro de page
                    button.data('page', button.data('page') + 1);
                    // Insère les nouvelles données avant le bloc #blockPusdImage
                    $('#blockPusdImage').before($(data));
                    // Met à jour le texte du bouton
                    button.text('Charger plus');
                    // Attache les événements aux nouvelles images chargées
                    attachEventsToImages(); 
                } else {
                    // Si aucune donnée n'est retournée, met à jour le texte du bouton
                    button.text('Plus de photos à charger');
                }
            }
        });
    });
})(jQuery);






