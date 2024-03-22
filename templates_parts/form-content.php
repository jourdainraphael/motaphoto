<?php 
  function genere_menu_items_taxonomy($taxonomy){
      $terms = get_terms([
       'taxonomy' => $taxonomy,
        'hide_empty' => false,
      ]);
      foreach ($terms as $term){
       echo('<option value="' . $term->slug .'">' . $term->name . '</option>');
      }
      echo ('</select>');
  }
 ?>
 
 <form  class="form-categories" action="<?php echo admin_url( 'admin-ajax.php' ); ?>">
  <!-- <form  class="form-categories" action=""> -->
  
  <select name="Categories" id="categories-select" >
     <option value="">Catégories</option>
  <?php   genere_menu_items_taxonomy('categorie'); ?>
  
  <select name="Formats" id="formats-select">
    <option value="">Formats</option> 
  <?php   genere_menu_items_taxonomy('format');    ?>

  <!-- <select name="date" id="tri-date-select">
     <option value="DESC">Trier par</option>
    <option value="DESC" >desc</option>  
    <option value="ASC">asc</option>  
  </select> -->
  <select name="triDate" id="tri-date-select">
    <option value="">Trier par</option>
    <option value="DESC">Date décroissante</option>
    <option value="ASC">Date croissante</option>
  </select>
  
<!-- <form action="" method="post" class="form-categories" >
  <select name="Categories" id="categories-select" onchange="this.form.submit()">
   
    <option value="">Catégories</option>
    <option value="mariage">Mariage</option>
    <option value="reception">Réception</option>
    <option value="concert">Concert</option>
    <option value="television">Télévision</option>
  </select> -->
  <!-- <select name="Formats" id="formats-select" onchange="this.form.submit()">
    <option value="">Formats</option>
    <option value="portrait">Portrait</option>
    <option value="paysage">Paysage</option>
  </select> -->
</form>

   
