<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Oxence
 */

use OxenceTheme\Classes\Oxence_Helper as Helper;
?>
    </main>
    <?php
        if (  class_exists( 'Oxence_Toolkit' ) ) {
            do_action( "oxence_builder_after_main" );
        }

        if( 'enabled' === Helper::check_default_footer() ) {
            get_template_part( 'template-parts/footer/footer', 'default' );
        }
    ?>
</div>

<?php wp_footer();?>

</body>
</html>
