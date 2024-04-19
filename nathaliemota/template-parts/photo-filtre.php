<?php
// Affichage des taxonomies
$taxonomy = [
    'categorie' => 'CATÉGORIES',
    'format' => 'FORMATS',
    'annees' => 'TRIER PAR',
];

foreach ($taxonomy as $taxonomy_slug => $label) {
    // Récupère les termes de la taxonomie
    $terms = get_terms($taxonomy_slug);
    if ($terms && !is_wp_error($terms)) {
        // Affiche le sélecteur déroulant pour cette taxonomie
        echo "<select id='$taxonomy_slug' class='custom-select taxonomy-select'>";

        // Ajoute une option par défaut avec le label de la taxonomie
        echo "<option value=''>$label</option>";

        // Affiche chaque terme de la taxonomie comme une option dans le sélecteur déroulant
        foreach ($terms as $term) {
            echo "<option value='$term->slug'>$term->name</option>";
        }
        // Ferme le sélecteur déroulant
        echo "</select>";
    }
}
?> 


