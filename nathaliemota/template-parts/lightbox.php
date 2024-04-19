<div class="containerLightbox">
    <!-- Conteneur de la lightbox -->

    <div id="lightbox" class="lightbox">
        <!-- Element de la lightbox -->

        <div class="lightbox-content">
            <!-- Contenu de la lightbox -->

            <!-- Emplacement pour afficher la catégorie de la photo -->
            <span class="lightboxCategorie"></span>
            <!-- Emplacement pour afficher la référence de la photo -->
            <span class="lightboxReference"></span>
            
            <!-- Bouton pour fermer la lightbox -->
            <img class="fermelightbox" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/Cross_white.png'; ?>" alt="croix">
            
            <!-- Texte indiquant la photo précédente -->
            <span class="lightboxPrecedent">&#8592; précédente</span>
            
            <!-- Conteneur de la photo -->
            <div class="lightboxPhoto">
                <!-- Emplacement pour afficher la photo -->
                <img class="lightboxImage" src="" alt="">
            </div>
            
            <!-- Texte indiquant la photo suivante -->
            <span class="lightboxSuivant">suivante &#8594;</span>
        </div>
    </div>
</div>
