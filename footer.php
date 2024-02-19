
<?php wp_footer(); ?>


<footer>
    <div class="footer-menu">
        <?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>  
        <p>TOUS DROITS RÉSERVÉS</p>
       
    </div> 
</footer>

<?php get_template_part('templates_parts/modal','content'); ?> 

</body>
</html>