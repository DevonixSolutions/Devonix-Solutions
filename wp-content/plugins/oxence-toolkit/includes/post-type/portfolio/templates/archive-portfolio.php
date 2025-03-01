<?php
/**
 * Portfolio Archive Template
 */

use OxenceTheme\Classes\Oxence_Helper as Helper;
use OxenceTheme\Classes\Oxence_Post_Helper;
use OxenceToolkit\ElementorAddon\Templates\Portfolio_Template;

get_header();

$settings = [
    'layout'              => 'grid',
    'design'              => 'normal',
    'show_filter'         => 'no',
    'title_word'          => '8',
    'grid_col'            => 'col-lg-4',
    'grid_col_tablet'     => 'col-md-6',
    'grid_col_mobile'     => 'col-12',
    'post_thumbnail_size' => 'large',
    'show_category'       => 'no',
]

?>

<div class="<?php Helper::container_class()?>">
    <div class="content-wrapper no-sidebar">
        <div class="content-area">
            <div class="oxence-portfolio portfolio-archive">
                <div class="row">
                    <?php
                        if ( have_posts() ):
                            /* Start the Loop */
                            while ( have_posts() ): the_post();

                            Portfolio_Template::render_portfolio_item( $settings );

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
