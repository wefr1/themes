<?php
$photo_url = get_the_post_thumbnail_url(null, "large");
$photo_titre = get_the_title();
$post_url = get_permalink();
$reference = get_field('reference');
$categories = get_the_terms(get_the_ID(), 'categorie');
$categorie_name = $categories[0]->name;

$PHOTO_TITRE = strtoupper (get_the_title());
$CATEGORIE_NAME = strtoupper (get_field('categorie')); 
?>


            <div class="blockPhotoRelative">
                <img src="<?php echo esc_url($photo_url); ?>" alt="<?php the_title_attribute(); ?>">

                <div class="overlay">

                    <h2><?php echo esc_html($photo_titre); ?></h2>
                    <h3><?php echo esc_html($CATEGORIE_NAME); ?></h3>

                    <div class="eye-icon">
                        <a href="<?php echo esc_url(get_permalink()); ?>">
                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/" alt="voir la photo">
                        </a>
                    </div>
                    <div class="fullscreen-icon" data-full="<?php echo esc_url($photo_url); ?>" data-category="<?php echo esc_attr($categorie_name); ?>" data-reference="<?php echo esc_attr($reference); ?>">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/" alt="">
                    </div>
                </div>
            </div>
            
       