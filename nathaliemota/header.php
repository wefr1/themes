<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php wp_head(); // Inclut les scripts et styles WordPress ?>
</head>

<body class="mainContainer">
<?php wp_body_open(); // Inclut les actions nécessaires pour le corps du document ?>

	<header class="site-header">
		<nav id="site-navigation" class="siteNavigation" role="navigation">
			<div class="logo">
				<a href="<?php echo home_url('/'); ?>">
					<!-- Affiche le logo avec un lien vers la page d'accueil -->
					<img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/Logo.png'; ?>" alt="Logo">
				</a>
			</div>
	
			<div class="burgerMenu">
				<!-- Menu hamburger pour les appareils mobiles -->
				<span class="bar"></span>
				<span class="bar"></span>
				<span class="bar"></span>
			</div>
								
			<div class="navigation">
				<?php
				// Affiche le menu de navigation principal
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'container'      => 'false', // Pas de conteneur supplémentaire pour le menu
						'menu_class'     => 'menuNavigation', // Classe CSS pour le menu
					)
				);
				?>
			</div>	
		</nav>
	</header>

