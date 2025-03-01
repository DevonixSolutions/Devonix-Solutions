<?php
/**
 * Template for Services CPT single page
 *
 * @since 1.0.0
 */

use OxenceTheme\Classes\Oxence_Helper as Helper;

get_header();
?>
<div class="<?php Helper::container_class()?>">
    <div class="<?php Helper::content_wrap_class()?>">
        <div class="content-area">
            <?php the_content(); ?>
        </div>
        
        <?php get_sidebar(); ?>
    </div>
</div>
<?php
get_footer();