<?php
namespace OxenceToolkit\ElementorAddon\Templates;

use OxenceTheme\Classes\Oxence_Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Team Template
 */
class Team_Template {
    /**
     * Render Template
     *
     * @param array $settings
     * @return void
     */
    public function render( $settings ) {
        $class     = 'oxence-team';
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
            'post_type'           => 'oxence_team',
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
            self::render_team_item( $settings );
        endwhile;
        wp_reset_postdata();
    }

    /**
     * Render Render team Item
     *
     * @param array $settings
     * @return void
     */
    public static function render_team_item( $settings ) {
        $idd    = get_the_ID();
        $column = $settings['grid_col'] . ' ' . $settings['grid_col_tablet'] . ' ' . $settings['grid_col_mobile'];

        if ( 'grid' === $settings['layout'] ) {
            $item_class = $column;
        } elseif ( 'slider' === $settings['layout'] ) {
            $item_class = 'oxence-slider-item';
        }

        $position     = Oxence_Helper::get_meta( 'oxence_team_meta', 'member_title', '', $idd );
        $social_links = Oxence_Helper::get_meta( 'oxence_team_meta', 'social_links', [], $idd );
        ?>
        <div class="<?php echo esc_attr( $item_class ) ?>">
            <div class="team-member-box">
                <div class="member-photo">
                    <?php echo get_the_post_thumbnail( $idd, $settings['post_thumbnail_size'] ) ?>
                </div>
                <h5 class="member-name">
                    <a href="<?php echo get_the_permalink(); ?>"><?php echo esc_html( get_the_title() ) ?></a>
                </h5>
                <?php if ( $position ) : ?>
                <span class="member-title"><?php echo esc_html( $position ) ?></span>
                <?php endif; ?>
                <?php if ( $social_links ) : ?>
                <ul class="member-socials">
                    <?php foreach ( $social_links as $links ) : ?>
                    <li>
                        <a href="<?php echo esc_url( $links['url'] ) ?>"><i class="<?php echo esc_attr( $links['icon'] ) ?>"></i></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}