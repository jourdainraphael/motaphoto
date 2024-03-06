
<form action="" method="get" class="form-categories">
  <select name="Categories" id="categories-select">
    <option value="">Catégories</option>
    <option value="mariage">Mariage</option>
    <option value="reception">Réception</option>
    <option value="concert">Concert</option>
    <option value="television">Télévision</option>
  </select>
  <label for="formats-select">Format</label>
  <select name="Formats" id="formats-select">
    <option value="">Formats</option>
    <option value="portrait">Portrait</option>
    <option value="paysage">Paysage</option>
  </select>
</form>

<?php

// On place les critères de la requête dans un Array
$args = array(
  'post_type' => 'photo',
  'posts_per_page' => 8,
  'orderby' => 'date',
  'paged' => 1,
);
//On crée ensuite une instance de requête WP_Query basée sur les critères placés dans la variables $args
$loop = new WP_Query($args);?>
<div class="filtre-container">
<?php 
  while ( $loop->have_posts() ) : $loop->the_post(); ?>


<?php 
// recuperer les url de l'image de chaque post
    $image_url = get_the_post_thumbnail_url(); 

// Récupère le texte alternatif de l'image.
    $image_alt = get_post_meta(get_the_ID(), '_wp_attachment_image_alt', true); 

?>



    <article class="card">
        <h3 class="title"><?php  echo the_title() ?></h3>
        <span><?php echo the_terms(get_the_ID(), 'categorie', false); ?> </span>
        <img src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>">        
            <img
							class="fullscreen"
							src="http://localhost:10034/wp-content/themes/twentytwentyone_child/assets/Icon_fullscreen.png"
							alt="logo"
							role="button"
							aria-pressed="false"
						/>
						<img
							class="lightbox-eye"
							alt="lightbox eye"
							role="button"
							aria-pressed="false"
							src="http://localhost:10034/wp-content/themes/twentytwentyone_child/assets/Icon_eye.png"
						/>

      <?php 
    
      //$terms = get_the_terms( $post->ID, 'format' );  // pour une instance de photo post 
      //echo ( $terms[0]->name);   // on recupere la valeur de la categorie format (par exemple : "Portrait")    ?>
    </article>
    
  

  

    <?php $custom = get_post_custom( $post_id ); //on récupere les valeurs des champs personnalisée
      //var_dump($custom);
    ?>


  <?php
  
  /*
  the_terms( $post->ID, 'categorie', 'Categorie de la photo : ' );
   the_terms( $post->ID, 'format', 'Format de la photo : ' ); 
  the_terms( $post->ID, 'reference', 'Reference de la photo : ' );
  */

  ?>
  



<?php endwhile; ?> 

</div><!---    ./ filtre-container   --->
<?php wp_reset_postdata(); // On réinitialise les données ?> 