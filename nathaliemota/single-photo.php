<?php
/*
Template Name: Single
*/
// Spécifie le modèle de page comme modèle "Single"

get_header(); // Inclut le fichier d'en-tête de WordPress
?>

<?php
// Récupère les champs personnalisés avec ACF
$photo_url = get_field('photo'); // URL de la photo
$reference = get_field('reference'); // Référence de la photo
$REFERENCE = strtoupper(get_field('reference')); // Référence de la photo en majuscules
$type = get_field('type'); // Type de la photo

// Récupère les termes de taxonomie pour les catégories, les formats et l'année
$year = get_field('annee'); // Année de la photo
$categories = get_the_terms(get_the_ID(), 'categorie'); // Catégories de la photo
$formats = get_the_terms(get_the_ID(), 'format'); // Formats de la photo
$categorie_name = $categories[0]->name; // Nom de la première catégorie de la photo

// Détermine les URLs des vignettes pour les posts précédent et suivant
$nextPost = get_next_post(); // Post suivant
$previousPost = get_previous_post(); // Post précédent
$previousThumbnailURL = $previousPost ? get_the_post_thumbnail_url($previousPost->ID, 'thumbnail') : ''; // URL de la vignette du post précédent s'il existe
$nextThumbnailURL = $nextPost ? get_the_post_thumbnail_url($nextPost->ID, 'thumbnail') : ''; // URL de la vignette du post suivant s'il existe
?>

<section class="cataloguePhotos">
    <div class="galleryPhotos">
        <div class="detailPhoto">
            <div class="containerPhoto">
                <!-- Affiche l'image principale du post -->
                <img src="<?php echo $photo_url; ?>" alt="<?php the_title_attribute(); ?>">
                <div class="singlePhotoOverlay">
                    <div class="fullscreen-icon" data-reference="<?php echo esc_attr($reference); ?>" data-full="<?php echo esc_url($photo_url); ?>" data-category="<?php echo esc_attr($categorie_name); ?>">
                        <!-- Affiche l'icône pour passer en plein écran -->
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/Icon_fullscreen.png" alt="Icone fullscreen">
                    </div>
                </div>
            </div>
            <div class="infoPhotos">
                <h2><?php echo get_the_title(); ?></h2>
                <div class="taxonomies">
                    <!-- Affiche les détails du post tels que la référence, la catégorie, le format, le type et l'année -->
                    <p>RÉFÉRENCE : <span id="single-reference"><?php echo strtoupper($reference) ?></span></p>
                    <p>CATÉGORIE : <?php foreach ($categories as $key => $cat) {
                                        $categoryNameSingle = $cat->name;
                                        echo strtoupper($categoryNameSingle);
                                    }  ?></p>
                    <p>FORMAT : <?php foreach ($formats as $key => $format) {
                                    $formatName = $format->name;
                                    echo strtoupper($formatName);
                                } ?></p>
                    <p>TYPE : <?php echo strtoupper($type) ?> </p>
                    <p>ANNÉE : <?php echo $year ?> </p>
                </div>
            </div>
        </div>
    </div>
    <div class="contenairContact">
        <div class="contact">
            <p class="interesser"> Cette photo vous intéresse ? </p>
            <!-- Bouton pour contacter -->
            <button id="boutonContact" data-reference="<?php echo $REFERENCE; ?>">Contact</button>
        </div>
        <div class="naviguationPhotos">
            <!-- Conteneur pour la miniature -->
            <div class="miniPicture" id="miniPicture">
                <!-- La miniature sera chargée ici par JavaScript -->
            </div>
            <div class="naviguationArrow">
                <?php if (!empty($previousPost)) : ?>
                    <!-- Flèche pour le post précédent si disponible -->
                    <img class="arrow arrow-left" src="<?php echo get_theme_file_uri() . '/assets/images/left.png'; ?>" alt="Photo précédente" data-thumbnail-url="<?php echo $previousThumbnailURL; ?>" data-target-url="<?php echo esc_url(get_permalink($previousPost->ID)); ?>">
                <?php endif; ?>
                <?php if (!empty($nextPost)) : ?>
                    <!-- Flèche pour le post suivant si disponible -->
                    <img class="arrow arrow-right" src="<?php echo get_theme_file_uri() . '/assets/images/right.png'; ?>" alt="Photo suivante" data-thumbnail-url="<?php echo $nextThumbnailURL; ?>" data-target-url="<?php echo esc_url(get_permalink($nextPost->ID)); ?>">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="titreVousAimerezAussi">
        <!-- Titre pour la section des photos similaires -->
        <h3>VOUS AIMEREZ AUSSI</h3>
    </div>
    <div class="PhotoSimilaire">
        <?php
        // Requête pour les photos similaires basées sur les catégories
        $categories = get_the_terms(get_the_ID(), 'categorie');
        if ($categories && !is_wp_error($categories)) {
            $category_ids = wp_list_pluck($categories, 'term_id');
            $args = array(
                'post_type' => 'photos',
                'posts_per_page' => 2,
                'orderby' => 'rand',
                'post__not_in' => array(get_the_ID()),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'categorie',
                        'field' => 'term_id',
                        'terms' => $category_ids,
                    ),
                ),
            );
            $compteur = 0;
            $related_block = new WP_Query($args);
            while ($related_block->have_posts()) {
                $related_block->the_post();
                $photo_url = get_the_post_thumbnail_url(null, "large");
                $reference = get_field('reference');
                $categorie_name = isset($categories[0]) ? $categories[0]->name : '';
                // Inclut le template part pour afficher le bloc de photo similaire
                get_template_part('template-parts/photo_block');
                $compteur++;
            }
            if ($compteur === 0) {
                // Affiche un message si aucune photo similaire n'est trouvée
                echo "<p class='photoNotFound'> Pas de photo similaire trouvée pour la catégorie ''" . $categorie_name . "'' </p>";
            }
        }
        ?>
    </div>
</section>

<?php get_footer(); // Inclut le fichier de pied de page de WordPress ?>
