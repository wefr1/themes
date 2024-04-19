<div class="banner">
    <!-- Div de la bannière -->

    <h1>Photographe event</h1>
    <!-- Titre de la bannière -->

    <?php
    // Arguments de la requête pour récupérer une photo aléatoire
    $photo_args = array(
        'post_type' => 'photos', // Type de post à récupérer
        'posts_per_page' => 1, // Nombre de posts à afficher (1 pour une seule photo)
        'orderby' => 'rand', // Tri aléatoire
    );

    // Exécute la requête avec les arguments définis
    $photo_query = new WP_Query($photo_args);

    // Vérifie s'il y a des posts dans la requête
    if ($photo_query->have_posts()) {
        // Boucle sur chaque post trouvé dans la requête
        while ($photo_query->have_posts()) {
            // Initialise les données du post courant dans la boucle
            $photo_query->the_post();
            // Affiche la miniature de la photo à la taille 'full'
            echo get_the_post_thumbnail(get_the_ID(), 'full'); 
        }
        // Réinitialise les données du post global
        wp_reset_postdata();
    }
    ?>
</div>
