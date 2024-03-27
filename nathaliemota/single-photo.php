
<?php
/*
Template Name: Single
*/

get_header();
?>

<?php

//ACF
$photo_url = get_field('photo');
$reference = get_field('reference');
$REFERENCE = strtoupper (get_field('reference'));
$type = get_field('type');

// Taxo
// $annees = get_the_terms(get_the_ID(), 'annees');
$year = get_field('annee');

$categories = get_the_terms(get_the_ID(), 'categorie');
$formats = get_the_terms(get_the_ID(), 'format');
$categorie_name = $categories[0]->name;



?>

<section class="cataloguePhotos">
    <div class="galleryPhotos" >
        <div class="detailPhoto">

            <div class="containerPhoto">
                     <img   src="<?php echo $photo_url; ?>" alt="<?php the_title_attribute(); ?>">
                          <div class="singlePhotoOverlay">
                               <div  data-reference="<?php echo esc_attr($reference); ?>" data-full="<?php echo esc_url($photo_url); ?>" data-category="<?php echo esc_attr($categorie_name); ?>">
                                     <img src="<?php echo esc_url(get_template_directory_uri()); ?>" >
                               </div>
                          </div>
            </div>

            <div class="selecteurK">
                <h2><?php echo get_the_title(); ?></h2>

                <div class="taxonomies">

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
    		<button id="boutonContact" data-reference="<?php echo $REFERENCE; ?>">Contact</button>
    	</div>

    	<div class="naviguationPhotos">

      </div>
    </div>
</section>

<section>
	<div class="titreVousAimerezAussi">
	     <h3>VOUS AIMEREZ AUSSI</h3>
	</div>

	<div class="PhotoSimilaire">

	  <?php

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

						      get_template_part('template-parts/photo_block');
						      $compteur++;
						     // echo $compteur;
						      
						     }

	     } 
	  ?>

	</div>
</section>


<?php get_footer(); ?>
