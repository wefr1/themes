<?php
// Obtient l'URL de l'image mise en avant du post actuel au format "large"
$photo_url = get_the_post_thumbnail_url(null, "large");
// Obtient le titre du post actuel
$photo_titre = get_the_title();
// Obtient l'URL du post actuel
$post_url = get_permalink();
// Obtient la valeur du champ personnalisé 'reference' pour le post actuel
$reference = get_field('reference');
// Obtient les termes de la taxonomie 'categorie' du post actuel
$categories = get_the_terms(get_the_ID(), 'categorie');
// Obtient le nom de la première catégorie du post actuel
$categorie_name = $categories[0]->name;

// Convertit le titre du post en majuscules
$PHOTO_TITRE = strtoupper(get_the_title());
// Convertit le nom de la catégorie en majuscules (le champ personnalisé 'categorie' n'est pas utilisé ici)
$CATEGORIE_NAME = strtoupper(get_field('categorie')); 
?>

<div class="blockPhotoRelative">
    <!-- Affiche l'image avec l'URL récupérée précédemment -->
    <img src="<?php echo esc_url($photo_url); ?>" alt="<?php the_title_attribute(); ?>">

    <div class="overlay">
        <!-- Affiche le titre du post -->
        <h2><?php echo esc_html($photo_titre); ?></h2>
        <!-- Affiche le nom de la catégorie -->
        <h3><?php echo esc_html($CATEGORIE_NAME); ?></h3>

        <div class="eye-icon">
            <!-- Lien vers la page du post -->
            <a href="<?php echo esc_url(get_permalink()); ?>">
                <!-- Icône pour voir la photo -->
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/icon_eye.png" alt="voir la photo">
            </a>
        </div>
        <div class="fullscreen-icon" data-full="<?php echo esc_url($photo_url); ?>" data-category="<?php echo esc_attr($categorie_name); ?>" data-reference="<?php echo esc_attr($reference); ?>">
            <!-- Icône pour afficher la photo en plein écran -->
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/Icon_fullscreen.png" alt="Icone fullscreen">
        </div>
    </div>
</div>

            
       