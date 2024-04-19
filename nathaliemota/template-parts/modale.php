<div class="popup-overlay">
    <!-- Overlay de la popup de contact -->
	<div class="popup-contact">
        <!-- Contenu de la popup de contact -->

        <!-- Image de l'en-tête de la popup de contact -->
        <img src="<?php echo get_template_directory_uri() . '/assets/images/Contact_header.png'; ?>" alt="contact">

		<?php
        // Affiche le formulaire de contact en utilisant le shortcode de Contact Form 7
		echo do_shortcode('[contact-form-7 id="9730552" title="NousContacter"]');
		?>
        <!-- Affiche le formulaire de contact -->
	</div>
</div>
