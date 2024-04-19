<footer>

<nav>
        <?php
        // Affiche le menu de navigation pour le pied de page
        wp_nav_menu(
            array(
                'theme_location' => 'menu-2', // Emplacement du menu
                'container'      => 'false', // Pas de conteneur supplémentaire pour le menu
                'menu_class'     => 'cssFooter', // Classe CSS pour le menu
            )
        );
        ?>
        
        <?php get_template_part('template-parts/modale'); ?>
        <!-- Inclut le template part pour la modale -->

        <!-- Appel de la lightBox -->
        <?php get_template_part('template-parts/lightbox'); ?>
        <!-- Inclut le template part pour la lightbox -->

</nav>
    
</footer>

<?php wp_footer(); ?>
<!-- Inclut les scripts et balises de pied de page de WordPress -->

</body>
</html>
