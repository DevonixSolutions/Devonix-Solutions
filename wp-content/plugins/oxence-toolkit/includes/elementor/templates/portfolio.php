<?php
namespace OxenceToolkit\ElementorAddon\Templates;

use OxenceTheme\Classes\Oxence_Helper;
use WP_Query;

defined( 'ABSPATH' ) || exit;

/**
 * Portfolio Template
 */
class Portfolio_Template {
    /**
     * Render Template
     *
     * @param array $settings
     * @return void
     */
    public function render( $settings ) {
        if ( 'yes' === $settings['show_filter'] ) {
            $class     = 'oxence-portfolio isotope-filter';
            $row_class = 'row isotope-filter-grid';
        } else {
            $class     = 'oxence-portfolio';
            $row_class = 'row';
        }

        if ( 'slider' === $settings['layout'] ) {
            $row_class = 'oxence-slider-active';

            if ( 'yes' === $settings['center_mode'] ) {
                $row_class = 'oxence-slider-active center-mode-on';
            }
        }
        ?>
        <div class="<?php echo esc_attr( $class ) ?>">
            <?php $this->render_filter_nav( $settings ) ?>

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
            'post_type'           => 'oxence_portfolio',
            'post_status'         => 'publish',
            'posts_per_page'      => $settings['post_limit'],
            'orderby'             => $settings['order_by'],
            'order'               => $settings['sort_order'],
            'ignore_sticky_posts' => 1,
        ];

        if ( 'categories' == $settings['post_from'] && $settings['cat_slugs'] ) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'oxence_portfolio_category',
                    'field'    => 'slug',
                    'terms'    => $settings['cat_slugs'],
                ],
            ];
        }

        if ( 'specific-post' == $settings['post_from'] && $settings['post_ids'] ) {
            $args['post__in'] = $settings['post_ids'];
        }

        $wp_query = new WP_Query( $args );

        while ( $wp_query->have_posts() ): $wp_query->the_post();
            self::render_portfolio_item( $settings );
        endwhile;
        wp_reset_postdata();
    }

    /**
     * Render Render portfolio Item
     *
     * @param array $settings
     * @return void
     */
    public static function render_portfolio_item( $settings ) {
        $idd             = get_the_ID();
        $categories_list = get_the_term_list( $idd, 'oxence_portfolio_category', '', '<span>,</span>', '' );

        $categories    = get_the_terms( $idd, 'oxence_portfolio_category' );
        $item_cat_slug = '';

        if ( $categories && ! is_wp_error( $categories ) ) {
            $slugs = [];

            foreach ( $categories as $category ) {
                $slugs[] = $category->slug;
            }

            $item_cat_slug = join( " ", $slugs );
        }

        if ( $settings['title_word'] ) {
            $the_title = wp_trim_words( get_the_title(), $settings['title_word'], '..' );
        } else {
            $the_title = get_the_title();
        }

        if ( 'creative' == $settings['design'] ) {
            $column = 'col-12';
        } else {
            $column = $settings['grid_col'] . ' ' . $settings['grid_col_tablet'] . ' ' . $settings['grid_col_mobile'];
        }

        if ( 'grid' === $settings['layout'] ) {
            $item_class = $column . ' ' . $item_cat_slug;

            if ( 'yes' === $settings['show_filter'] ) {
                $item_class = 'isotope-filter-item' . ' ' . $column . ' ' . $item_cat_slug;
            }
        } elseif ( 'slider' === $settings['layout'] ) {
            $item_class = 'oxence-slider-item';
        }
        ?>
        <div class="<?php echo esc_attr( $item_class ) ?>">
            <div class="portfolio-item style-<?php echo esc_attr( $settings['design'] ) ?>">
                <div class="portfolio-thumbnail">
                    <?php echo get_the_post_thumbnail( $idd, $settings['post_thumbnail_size'] ) ?>
                    <?php if ( 'normal' === $settings['design'] || 'on-image' === $settings['design'] ) : ?>
                    <a href="<?php echo esc_url( get_the_permalink() ) ?>" class="portfolio-link">
                        <i class="far fa-arrow-right"></i>
                    </a>
                    <?php endif; ?>
                </div>
                <div class="portfolio-content">
                    <div class="content">
                        <?php if ( 'hover-content' === $settings['design'] ) : ?>
                        <a href="<?php echo esc_url( get_the_permalink() ) ?>" class="portfolio-link">
                            <i class="far fa-arrow-right"></i>
                        </a>
                        <?php endif; ?>
                        <h4 class="title">
                            <a href="<?php echo esc_url( get_the_permalink() ) ?>">
                                <?php echo esc_html( $the_title ) ?>
                            </a>
                        </h4>
                        <?php if ( 'yes' === $settings['show_category'] && !is_wp_error( $categories_list ) && $categories_list ): ?>
                        <div class="categories">
                            <?php echo $categories_list ?>
                        </div>
                        <?php endif;?>
                        <?php if ( 'creative' === $settings['design'] ) : ?>
                        <?php
                            if( 'yes' === $settings['show_excerpt'] ) {
                                if( has_excerpt() ) {
                                    $content = get_the_excerpt();
                                } else {
                                    $content = get_the_content();
                                }

                                if ( $settings['content_word'] ) {
                                    echo wpautop( esc_html( wp_trim_words( $content, $settings['content_word'] ) ) );
                                } else {
                                    echo wpautop( esc_html( $content ) );
                                }
                            }
                        ?>
                        <div class="oxence-button-wrapper">
                            <a href="<?php echo esc_url( get_the_permalink() ) ?>" class="oxence-button hover-normal">
                                <span class="button-icon icon-align-right">
                                    <i class="far fa-angle-double-right"></i>
                                </span>
                                <span class="button-text"><?php echo esc_html( $settings['details_btn_text'] ) ?></span>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php if ( 'on-image-two' === $settings['design'] ) : ?>
                        <a href="<?php echo esc_url( get_the_permalink() ) ?>" class="portfolio-link">
                            <?php echo Oxence_Helper::render_svg_icon( 'arrow-right' ); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Filter Nav
     *
     * @param array $settings
     * @return void
     */
    public function render_filter_nav( $settings ) {
        if ( 'yes' !== $settings['show_filter'] ) {
            return;
        }

        if ( $settings['filter_cat_slugs'] ) {
            $categories = $settings['filter_cat_slugs'];
        } else {
            $categories = get_terms( [
                'taxonomy' => 'oxence_portfolio_category',
            ] );
        }
        ?>
        <div class="filter-nav-wrap">
            <ul class="filter-nav-items">
                <li data-filter="*" class="active"><?php echo esc_html( $settings['all_text'] ) ?></li>
                <?php foreach ( $categories as $category ) : ?>
                    <?php
                        if ( $settings['filter_cat_slugs'] ) {
                            $category = get_term_by( 'slug', $category, 'oxence_portfolio_category' );
                        }

                        if ( is_object ( $category ) && !is_wp_error( $category ) ): ?>
                        <li data-filter=".<?php echo esc_html( $category->slug ) ?>"><?php echo esc_html( $category->name ) ?></li>
                        <?php endif;
                    ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php
    }

    /**
     * Related Portfolio
     *
     * @return void
     */
    public static function render_related_portfolio( $idd ) {
        $args = [
            'post_type'           => 'oxence_portfolio',
            'post_status'         => 'publish',
            'posts_per_page'      => '9',
            'orderby'             => 'rand',
            'ignore_sticky_posts' => 1,
            'post__not_in'        => [$idd],
        ];

        $categories = get_the_terms( $idd, 'oxence_portfolio_category' );

        if ( $categories ) {
            $categories_ids    = wp_list_pluck( $categories, 'term_id' );
            $args['tax_query'] = [
                [
                    'taxonomy' => 'oxence_portfolio_category',
                    'field'    => 'term_id',
                    'terms'    => $categories_ids,
                    'operator' => 'IN',
                ],
            ];
        }

        $query = new WP_Query( $args );

        $options = [
            'layout'              => 'slider',
            'design'              => 'on-image',
            'show_filter'         => 'no',
            'title_word'          => '4',
            'grid_col'            => '',
            'grid_col_tablet'     => '',
            'grid_col_mobile'     => '',
            'post_thumbnail_size' => 'large',
            'show_category'       => 'no',
        ]

        ?>
        <div class="oxence-portfolio">
            <div class="portfolio-related-slider center-mode-on">
                <?php while ( $query->have_posts() ): $query->the_post(); ?>
                <?php self::render_portfolio_item( $options ); ?>
                <?php endwhile; wp_reset_postdata() ?>
            </div>
        </div>
        <?php
    }
}