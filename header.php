<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <title>motaphoto</title>
    <?php wp_head(); ?>
</head>


<body>
    <header>
        <div class="div-logo-img">
            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/Logo.png'  ?> " alt="Logo" class="logo-img">
                     
            <?php wp_nav_menu( array( 'theme_location' => 'main' ) ); ?>
            <!-- <a href="#4a97b10" class="contact-btn">contact</a> -->
        </div>
        
    </header> 


