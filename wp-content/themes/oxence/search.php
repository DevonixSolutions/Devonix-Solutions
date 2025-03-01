<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Oxence
 */

use OxenceTheme\Classes\Oxence_Helper as Helper;
use OxenceTheme\Classes\Oxence_Post_Helper;

get_header();
?>

<div class="<?php Helper::container_class()?>">
    <div class="<?php Helper::content_wrap_class()?>">
        <div class="content-area">
            <div class="entry-posts">
                <div class="row">
                    <?php
                        if ( have_posts() ):
                            /* Start the Loop */
                            while ( have_posts() ): the_post();
                                /*
                                * Include the Post-Type-specific template for the content.
                                * If you want to override this in a child theme, then include a file
                                * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                                */
                                get_template_part( 'template-parts/contents/content');

                            endwhile;

                            Oxence_Post_Helper::pagination();
                        else:
                            get_template_part( 'template-parts/contents/content', 'none' );
                        endif;
                    ?>
                </div>
			</div>
        </div>
        <?php get_sidebar()?>
    </div>
</div>

<?php
get_footer();