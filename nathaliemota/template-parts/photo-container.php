<?php
// Récupération de 12 photos aléatoires pour le bloc initial
$args = array(
    'post_type' => 'photos',
    'posts_per_page' => 12,
    'orderby' => 'date',
    'order' => 'ASC',
);
$photo_block = new WP_Query($args);

// Envoie des paramètres Ajax au script 'Ajax-charge-plus-images'
wp_localize_script('Ajax-charge-plus-images', 'ajaxloadmore', array(
    'ajaxurl' => admin_url('admin-ajax.php'), // URL du fichier Ajax
    'query_vars' => json_encode($args) // Paramètres de requête à envoyer
));

if ($photo_block->have_posts()) :
    // Définit les arguments pour le bloc de photo
    set_query_var('photo_block_args', array('context' => 'front-page'));
    while ($photo_block->have_posts()) :
        $photo_block->the_post();
        // Charge le template pour chaque photo
        get_template_part('template-parts/photo_block', get_post_format()); 
    endwhile; 
    // Réinitialise les données de la requête principale
    wp_reset_postdata(); 
else :
    echo 'Aucune photo trouvée.';
endif; 
?>

<!-- Affiche le bouton pour charger plus d'images -->
<div id="blockPusdImage">
    <button id="plusDImage" data-page="1" data-url="<?php echo admin_url('admin-ajax.php'); ?>">Charger plus</button>
</div>
