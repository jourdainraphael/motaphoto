
<?php
/**
 ** customize theme   
 */
function my_theme_scripts() {
    // Enregistrement du fichier JavaScript
    wp_enqueue_script('my-theme-script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '1.0', true);
    
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

// wp_nav_menu( array('theme_location'=> 'main') );
// wp_nav_menu( array('theme_location'=> 'footer') );
// function register_my_menu() {
//     register_nav_menu( array('main-menu' => 'Menu principal'));
// }
// add_action( 'after_setup_theme', 'register_my_menu' );
?>