
<?php
/**
 ** customize theme   
 */
function my_theme_scripts() {
    // Enregistrement du fichier JavaScript
    wp_enqueue_script('my-theme-script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '1.0', true);
    wp_enqueue_script('ajax-script', get_template_directory_uri() . '/assets/js/ajax.js', array('jquery'), '1.0', true);

    
    // Enregistrement du fichier CSS
    wp_enqueue_style('my-theme-style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'my_theme_scripts');



// add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
// function theme_enqueue_styles()
// {
//     wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
//     wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/css/theme.css'));
// }



function montheme_customize_register($wp_customize)
{
    // Ajout d'une section pour le logo personnalisé
    $wp_customize->add_section('montheme_logo_section', array(
        'title'      => __('Custom logo here', 'montheme'),
        'priority'   => 30,
    ));

    // Ajout de la fonctionnalité de logo personnalisé
    $wp_customize->add_setting('montheme_log');

    // Ajout du contrôle pour téléverser le logo personnalisé
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'montheme_log', array(
        'label'    => __('Téléverser votre logo', 'montheme'),
        'section'  => 'montheme_logo_section',
        'settings' => 'montheme_log',
    )));
}
add_action('customize_register', 'montheme_customize_register');


register_nav_menus( array(
	'main' => 'Menu principal',
	'footer' => 'Menu de pied de page',
) );

// On remplace le lien href="#4a97b10" par du javascript
add_filter('wp_nav_menu', 'active_contact_link', 999);
/**
 * Replace # with js
 * @param string $menu_item item HTML
 * @return string item HTML
 */
function active_contact_link($menu_item) {
    if (strpos($menu_item, 'href="#4a97b10"') !== false) {
        $menu_item = str_replace('href="#4a97b10"', 'href="javascript:menuItemContact.click();"', $menu_item);
    }
    return $menu_item;
}


/*  récupérer la date   */
// function add_date_support_to_photo_cpt() {
//     add_post_type_support( 'photo', 'date' );
//     }
// add_action( 'init', 'add_date_support_to_photo_cpt' );

/*  actions ajax   */

function filter(){
    $format = $_POST['format'];
    $categorie = $_POST['categorie'];
    $triDate = $_POST['triDate'];
    $order = ($triDate == 'DESC') ? 'DESC' : 'ASC';
    echo("<p>categories =". $categorie. "     format = " .$format . "       triDate=" .$triDate ."</p><br/>");

function add_date_support_to_photo_cpt() {
    add_post_type_support( 'photo', 'date' );}
    add_action( 'init', 'add_date_support_to_photo_cpt' );


  


    // On place les critères de la requête dans un Array
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'orderby' => 'date',
        'order' => $order,
        'paged' => 1,
        // 'meta_query' => array(
        //     array(
        //         'key' => 'annee',  // Your ACF field key
        //         'compare' => 'EXISTS',
        //     ),
        // ),



        // 'meta_key' => 'annee',
        
        // 'order' => '$triDate',
       
    );
    
    if (!($format =="" && $categorie =="")){  // on doit applique un filtre car au moins une taxonomy a été selectionnée
        if ($format == "" || $categorie == "")
            $relation = "OR"; //si une des 2 taxonomies n'est pas choisie 
        else
            $relation = "AND"; // si les 2 taxonomies ont été choisies
        // Ajout du filtre
        $args['tax_query'] = 
            array(
                 'relation' => $relation,
                    array(
                        'taxonomy' => 'categorie',
                        'field' => 'slug',
                        'terms' => $categorie,
                    ),
                    array(
                        'taxonomy' => 'format',
                        'field' => 'slug',
                        'terms' => $format,
                    ),
                );
    }

   

  
    //On crée ensuite une instance de requête WP_Query basée sur les critères placés dans la variables $args
    $loop = new WP_Query($args);

    while ( $loop->have_posts() ) : $loop->the_post();

        // recuperer les url de l'image de chaque post
        $image_url = get_the_post_thumbnail_url(); 

        // Récupère le texte alternatif de l'image.
        $image_alt = get_post_meta(get_the_ID(), '_wp_attachment_image_alt', true); 
        
        ?>
        <article class="card">
            <h3 class="title"><?php  echo the_title() ?></h3>
             <span><?php  $custom = get_post_custom( get_the_ID() ); //on récupere les valeurs des champs personnalisée
                    var_dump($custom['annee']);
                    ?> </span>
            <span><?php echo the_terms(get_the_ID(), 'categorie', false); ?> </span>
            <img src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>"> 
        </article>

<?php
    endwhile; 
    wp_die();
}

add_action('wp_ajax_filter', 'filter');
// requeste sans etre logged in
add_action('wp_ajax_nopriv_filter', 'filter');

?>


