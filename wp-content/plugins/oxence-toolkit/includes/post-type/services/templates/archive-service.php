<?php
/**
 * Service Archive Template
 */

use OxenceTheme\Classes\Oxence_Helper as Helper;
use OxenceTheme\Classes\Oxence_Post_Helper;
use OxenceToolkit\ElementorAddon\Templates\Service_Template;

get_header();

$settings = [
    'layout'              => 'grid',
    'grid_col'            => 'col-lg-4',
    'grid_col_tablet'     => 'col-md-6',
    'grid_col_mobile'     => 'col-12',
    'post_thumbnail_size' => 'full',
    'show_read_more' => 'yes',
    'read_more_text' => __( 'Service Details', 'oxence-toolkit' )
];

?>

<div class="<?php Helper::container_class()?>">
    <div class="content-wrapper no-sidebar">
        <div class="content-area">
            <div class="oxence-services service-archive">
                <div class="row">
                    <?php
                        if ( have_posts() ):
                            /* Start the Loop */
                            while ( have_posts() ): the_post();

                            Service_Template::render_service_item( $settings );

                            endwhile;

                            Oxence_Post_Helper::pagination();
                        else:
                            get_template_part( 'template-parts/contents/content', 'none' );
                        endif;
                    ?>
                </div>
			</div>
        </div>
    </div>
</div>

<?php
get_footer();