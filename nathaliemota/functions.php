<?php

// Fonction pour charger le style CSS du thème
function theme_enqueue_styles(){
    // Chargement du style.css du thème
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/style.css'));
}

// Action pour charger les scripts dans le thème
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

/* Ajout de la librairie JQuery  */
function librairie_JQuery() {
    // Chargement de la bibliothèque jQuery depuis un CDN
    wp_enqueue_script('JQuery-js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', array('jquery'), '3.7.1', true);
}
add_action( 'wp_enqueue_scripts', 'librairie_JQuery' );

/* Chargement des scripts JS du thème */
function script_JS_Custo() {
    // Gestion de la Modale (script jQuery)
    wp_enqueue_script('ModaleJS', get_stylesheet_directory_uri() . '/assets/js/modalePopupContact.js', array('jquery'), '1.0.0', true);

    // Gestion du Menu Burger (script jQuery)
    wp_enqueue_script('menuBurgerJS', get_stylesheet_directory_uri() . '/assets/js/menuBurger.js', array('jquery'), '1.0.0', true);

    // Affichage des images miniature (script jQuery)
    wp_enqueue_script('AffichageMiniatureJS', get_stylesheet_directory_uri() . '/assets/js/AffichageMiniature.js', array('jquery'), '1.0.0', true);

    // Gestion des Filtres (script jQuery)
    wp_enqueue_script('FiltresJS', get_stylesheet_directory_uri() . '/assets/js/Filtres.js', array('jquery'), '1.0.0', true);

    // Gestion de la LightBox (script jQuery)
    wp_enqueue_script('LightBoxJS', get_stylesheet_directory_uri() . '/assets/js/LightBox.js', array('jquery'), '1.0.0', true);

    // Chargement de plus d'images avec Ajax (script jQuery)
    wp_enqueue_script('Ajax-charge-plus-images', get_stylesheet_directory_uri() . '/assets/js/Ajax-charge-plus-images.js', array('jquery'), '1.0.0', true);

    // Custom JS (script jQuery)
    wp_enqueue_script('CustomJS', get_stylesheet_directory_uri() . '/assets/js/CustomJS.js', array('jquery'), '1.0.0', true);
}
add_action( 'wp_enqueue_scripts', 'script_JS_Custo' );

// Astuce pour éviter d'avoir des <p> partout dans CF7
add_filter('wpcf7_autop_or_not', '__return_false');

// Enregistrement des menus de navigation
function enregistrement_nav_menus() {
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primaire', 'nathaliemota' ),
			'menu-2' => esc_html__( 'Secondaire', 'nathaliemota' ),
		)
	);
}
add_action( 'after_setup_theme', 'enregistrement_nav_menus' );


/* Chargement des photos via Ajax load more */

function load_more_photos() {
    // Récupération de la page à charger et des paramètres de requête Ajax
    $paged = $_POST['page'] + 1;
    $query_vars = json_decode(stripslashes($_POST['query']), true);
    $query_vars['paged'] = $paged;
    $query_vars['posts_per_page'] = 12;
    $query_vars['orderby'] = 'date';

    // Exécution de la requête pour charger plus de photos
    $photos = new WP_Query($query_vars);
    if ($photos->have_posts()) {
        ob_start();
        while ($photos->have_posts()) {
            $photos->the_post();
            get_template_part('template-parts/photo_block', null);
        }
        wp_reset_postdata();

        $output = ob_get_clean(); // Récupère le tampon et le nettoie
        echo $output; // Affiche le résultat
    }
    else {
        ob_clean(); // Nettoie toute sortie précédente
        echo 'no_posts';
    }
    die(); // Arrête l'exécution du script
}
add_action('wp_ajax_nopriv_load_more', 'load_more_photos');
add_action('wp_ajax_load_more', 'load_more_photos');

/* Fonction de filtrage des photos */
// Définit une fonction pour filtrer les photos

function filter_photos_function(){

    $filter = $_POST['filter']; // Récupère les filtres envoyés via la méthode POST

    $args = array(
        'post_type' => 'photos', // Type de post à récupérer
        'posts_per_page' => -1, // Nombre de posts à afficher (-1 pour tous)
        'tax_query' => array( // Requête de taxonomie
            'relation' => 'AND', // Relation entre les filtres (ET)
        )
    );

    // Ajoute chaque filtre à la requête s'il est défini
    if(!empty($filter['categorie'])){
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie', // Taxonomie à filtrer (catégorie)
            'field'    => 'slug', // Champ à comparer (slug)
            'terms'    => $filter['categorie'], // Termes à filtrer (valeurs des filtres)
        );
    }

    if(!empty($filter['format'])){
        $args['tax_query'][] = array(
            'taxonomy' => 'format', // Taxonomie à filtrer (format)
            'field'    => 'slug', // Champ à comparer (slug)
            'terms'    => $filter['format'], // Termes à filtrer (valeurs des filtres)
        );
    }

    if(!empty($filter['annees'])){
        $args['tax_query'][] = array(
            'taxonomy' => 'annees', // Taxonomie à filtrer (années)
            'field'    => 'slug', // Champ à comparer (slug)
            'terms'    => $filter['annees'], // Termes à filtrer (valeurs des filtres)
        );
    }

    // Exécution de la requête avec les filtres
    $query = new WP_Query($args); // Effectue la requête WordPress avec les arguments définis

    if($query->have_posts()){ // Vérifie si des posts ont été trouvés avec la requête
        while($query->have_posts()){ // Parcourt chaque post trouvé
            $query->the_post(); // Initialise les données du post courant

            get_template_part('template-parts/photo_block', null); // Inclut le template part pour afficher le bloc de photo
        }
        wp_reset_postdata(); // Réinitialise les données du post global
    } else {
        // Affiche un message si aucune photo ne correspond aux critères de filtrage
        echo '<p class="critereFiltrage">Aucune photo ne correspond aux critères de filtrage</p>';
    }

    die(); // Arrête l'exécution du script
}

// Actions pour les utilisateurs connectés et non connectés
// Ajoute l'action pour les utilisateurs connectés (wp_ajax_filter_photos)
add_action('wp_ajax_filter_photos', 'filter_photos_function');
// Ajoute l'action pour les utilisateurs non connectés (wp_ajax_nopriv_filter_photos)
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos_function');
