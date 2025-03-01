<?php
namespace OxenceToolkit\ElementorAddon\Templates;

use OxenceTheme\Classes\Oxence_Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Service Template
 */
class Service_Template {
    /**
     * Render Template
     *
     * @param array $settings
     * @return void
     */
    public function render( $settings ) {
        $class     = 'oxence-services';
        $row_class = 'row';

        if ( 'slider' === $settings['layout'] ) {
            $row_class = 'oxence-slider-active';
        }
        ?>
        <div class="<?php echo esc_attr( $class ) ?>">
            <div class="<?php echo esc_attr( $row_class ) ?>">
                <?php $this->render_loop( $settings );?>
            </div>
        </div>
        <?php
    }

    /**
     * Render Loop
     *
     * @param array $settings
     * @return void
     */
    public function render_loop( $settings ) {
        $args = [
            'post_type'           => 'oxence_service',
            'post_status'         => 'publish',
            'posts_per_page'      => $settings['post_limit'],
            'orderby'             => $settings['order_by'],
            'order'               => $settings['sort_order'],
            'ignore_sticky_posts' => 1,
        ];

        if ( 'specific-post' == $settings['post_from'] && $settings['post_ids'] ) {
            $args['post__in'] = $settings['post_ids'];
        }

        $wp_query = new \WP_Query( $args );

        while ( $wp_query->have_posts() ): $wp_query->the_post();
            self::render_service_item( $settings );
        endwhile;
        wp_reset_postdata();
    }

    /**
     * Render Render service Item
     *
     * @param array $settings
     * @return void
     */
    public static function render_service_item( $settings ) {
        $idd    = get_the_ID();
        $column = $settings['grid_col'] . ' ' . $settings['grid_col_tablet'] . ' ' . $settings['grid_col_mobile'];

        if ( 'grid' === $settings['layout'] ) {
            $item_class = $column;
        } elseif ( 'slider' === $settings['layout'] ) {
            $item_class = 'oxence-slider-item';
        }

        ?>
        <div class="<?php echo esc_attr( $item_class ) ?>">
            <div class="service-box">
                <?php if ( has_post_thumbnail() ) : ?>
                <div class="service-thumbnail">
                    <?php echo get_the_post_thumbnail( $idd, $settings['post_thumbnail_size'] ) ?>
                </div>
                <?php endif; ?>
                <div class="service-desc">
                    <h4 class="title">
                        <a href="<?php echo get_the_permalink( $idd ) ?>"><?php echo wp_kses_post( get_the_title() ) ?></a>
                    </h4>
                    <?php if ( 'yes' === $settings['show_read_more'] ) : ?>
                    <a href="<?php echo get_the_permalink( $idd ) ?>" class="read-more-btn">
                        <?php echo esc_html( $settings['read_more_text'] ); ?>
                        <i class="far fa-angle-double-right"></i>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    }
}