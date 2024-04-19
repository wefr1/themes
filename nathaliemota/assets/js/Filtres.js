/* les Filtres */
console.log("les Filtres : son js est chargé");

(function($){

    // Fonction pour récupérer les photos filtrées
    function fetchFilteredPhotos(){
        // Récupère les valeurs des filtres
        var filter = {
            'categorie': $('#categorie').val(),
            'format': $('#format').val(),
            'annees': $('#annees').val(),
        };

        // Effectue une requête Ajax pour filtrer les photos
        $.ajax({
            url: ajaxurl, // URL de l'action Ajax définie par WordPress
            data: {
                'action': 'filter_photos', // Action à exécuter dans WordPress
                'filter': filter // Données à envoyer pour le filtrage
            },
            type: 'POST', // Type de requête HTTP
            beforeSend: function(){
                // Avant l'envoi de la requête, affiche un message de chargement
                $('#containerPhoto').html('<div class="loading">Chargement...</div>');
            },
            success: function(data) {
                // En cas de succès, remplace le contenu de #containerPhoto avec les photos filtrées
                $('#containerPhoto').html(data);
                // Attache les événements aux images chargées
                attachEventsToImages();
                // Fait défiler la page jusqu'au conteneur de photos
                setTimeout(function() {
                    document.getElementById('containerPhoto').scrollIntoView();
                }, 0);
            }
        });
    }

    // Écoute les changements dans les menus déroulants de filtre et déclenche la fonction de filtrage
    $('#filtrePhoto select').on('change', function(event){
        event.preventDefault();
        fetchFilteredPhotos();
    });
})(jQuery);

