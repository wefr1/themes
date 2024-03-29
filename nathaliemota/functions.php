<?php

function theme_enqueue_styles(){
    // Chargement du style.css du theme
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/style.css'));

}

// Action qui permet de charger des scripts dans notre theme
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

/* Ajout de la librairie JQuery  */
function librairie_JQuery() {
    wp_enqueue_script('JQuery-js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', array('jquery'), '3.7.1', true);
}
add_action( 'wp_enqueue_scripts', 'librairie_JQuery' );


/* Chargement des script JS du theme */
function script_JS_Custo() {

    // Gestion de la Modale (script JQuery)
    wp_enqueue_script('ModaleJS', get_stylesheet_directory_uri() . '/assets/js/modalePopupContact.js', array('jquery'), '1.0.0', true);

}
add_action( 'wp_enqueue_scripts', 'script_JS_Custo' );

function enregistrement_nav_menus() {

	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primaire', 'nathaliemota' ),
			'menu-2' => esc_html__( 'Secondaire', 'nathaliemota' ),
		)
	);
}
add_action( 'after_setup_theme', 'enregistrement_nav_menus' );


