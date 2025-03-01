<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Oxence
 */

use OxenceTheme\Classes\Oxence_Helper as Helper;

get_header();
?>

<div class="<?php Helper::container_class()?>">
    <div class="<?php Helper::content_wrap_class()?>">
        <div class="content-area">
            <?php
                while ( have_posts() ):
                    the_post();

                    get_template_part( 'template-parts/contents/content', 'page' );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ):
                        comments_template();
                    endif;

                endwhile; // End of the loop.
            ?>
        </div>
        <?php get_sidebar()?>
    </div>
</div>

<?php
get_footer();
