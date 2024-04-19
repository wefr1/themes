<?php
// Inclut le fichier d'en-tête de WordPress
get_header();
?>

	<main>

		<section id="header">
			<?php get_template_part('template-parts/hero'); ?>
			<!-- Inclut le template part pour la section de l'en-tête -->
		</section>

		<section id="filtrePhoto">
			<?php get_template_part('template-parts/photo-filtre'); ?>
			<!-- Inclut le template part pour la section de filtrage des photos -->
		</section>
		
		<section id="containerPhoto" class="blockCatalogue">
			<?php get_template_part('template-parts/photo-container'); ?>
			<!-- Inclut le template part pour la section du conteneur de photos -->
		</section>

        <script>
        var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
        // Définit la variable ajaxurl avec l'URL de admin-ajax.php pour les requêtes AJAX
        </script>
    
	</main>

<?php
// Inclut le fichier de pied de page de WordPress
get_footer();
