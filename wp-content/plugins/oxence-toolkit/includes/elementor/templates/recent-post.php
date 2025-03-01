<?php
namespace OxenceToolkit\ElementorAddon\Templates;

use OxenceTheme\Classes\Oxence_Post_Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Post Template
 */
class Recent_Post_Template {
    /**
     * Render Template
     *
     * @param array $settings
     * @return void
     */
    public function render( $settings ) {
        $class     = 'oxence-recent-post';
        $row_class = 'row';

        if ( 'slider' === $settings['layout'] ) {
            $row_class = 'oxence-slider-active';
        }

        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

        $args = [
            'post_type'           => 'post',
            'post_status'         => 'publish',
            'posts_per_page'      => $settings['post_limit'],
            'orderby'             => $settings['order_by'],
            'order'               => $settings['sort_order'],
            'ignore_sticky_posts' => 1,
            'paged' => $paged
        ];

        if ( 'specific-post' == $settings['post_from'] && $settings['post_ids'] ) {
            $args['post__in'] = $settings['post_ids'];
        }

        $wp_query = new \WP_Query( $args );

        ?>
        <div class="<?php echo esc_attr( $class ) ?>">
            <div class="<?php echo esc_attr( $row_class ) ?>">
                <?php
                    while ( $wp_query->have_posts() ): $wp_query->the_post();
                        self::render_post_item( $settings );
                    endwhile;
                    wp_reset_postdata();
                ?>
            </div>
            <?php
                if ( 'yes' === $settings['show_pagination'] ) {
                    Oxence_Post_Helper::pagination( $wp_query );
                }
            ?>
        </div>
        <?php
    }

    /**
     * Render Render team Item
     *
     * @param array $settings
     * @return void
     */
    public static function render_post_item( $settings ) {
        $idd    = get_the_ID();
        $column = $settings['grid_col'] . ' ' . $settings['grid_col_tablet'] . ' ' . $settings['grid_col_mobile'];

        if ( 'grid' === $settings['layout'] ) {
            $item_class = $column;
        } elseif ( 'slider' === $settings['layout'] ) {
            $item_class = 'oxence-slider-item';
        }

        $excerpt_count = $settings['excerpt_count'];

        $post_class = 'entry-post clearfix ' . $settings['design'];
        $author_id = get_post_field( 'post_author', $idd );
        ?>
        <div class="<?php echo esc_attr( $item_class ) ?>">
            <article id="post-<?php the_ID();?>" <?php post_class( $post_class );?>>
                <?php if ( has_post_thumbnail() ) : ?>
                <div class="entry-media">
                    <?php echo get_the_post_thumbnail( $idd, $settings['post_thumbnail_size'] ); ?>
                </div>
                <?php endif; ?>
                <div class="entry-summary">
                    <?php if ( 'yes' === $settings['show_post_meta'] ) : ?>
                    <div class="entry-post-meta">
                        <span class="admin">
                            <a href="<?php echo esc_url( get_author_posts_url( $author_id ) ) ?>">
                                <i class="far fa-user"></i>
                                <?php echo esc_html( get_the_author_meta( 'display_name', $author_id ) ) ?>
                            </a>
                        </span>
                        <span class="date">
                            <i class="far fa-calendar-alt"></i>
                            <?php echo esc_html( get_the_date() ) ?>
                        </span>
                    </div>
                    <?php endif; ?>
                    <<?php echo ot_escape_tags( $settings['title_tag'], 'h4' ); ?> class="entry-title">
                        <a href="<?php echo get_the_permalink() ?>">
                            <?php echo get_the_title(); ?>
                        </a>
                    </<?php echo ot_escape_tags( $settings['title_tag'], 'h4' ); ?>>
                    <?php
                        if ( 'yes' === $settings['show_excerpt'] ) {
                            if ( has_excerpt() ) {
                                echo wpautop( wp_trim_words( get_the_excerpt(), $excerpt_count, '...' ) );
                            } else {
                                echo wpautop( wp_trim_words( get_the_content(), $excerpt_count, '...' ) );
                            }
                        }

                        if ( 'yes' === $settings['show_read_more'] && ! empty( $settings['read_more_text'] ) ) {
                            echo '<a href="' . esc_url( get_permalink() ) . '" class="read-more"><span>' . esc_html( $settings['read_more_text'] ) . '</span> <i class="far fa-arrow-right"></i></a>';
                        }
                    ?>
                </div>
            </article>
        </div>
        <?php
    }

    public function post_list( $settings ) {
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

        $args = [
            'post_type'           => 'post',
            'post_status'         => 'publish',
            'posts_per_page'      => $settings['post_limit'],
            'orderby'             => $settings['order_by'],
            'order'               => $settings['sort_order'],
            'ignore_sticky_posts' => 1,
            'paged' => $paged
        ];

        if ( 'specific-post' == $settings['post_from'] && $settings['post_ids'] ) {
            $args['post__in'] = $settings['post_ids'];
        }

        $wp_query = new \WP_Query( $args );
        ?>
        <div class="oxence-post-list">
            <?php
                while ( $wp_query->have_posts() ): $wp_query->the_post();
                    $idd    = get_the_ID();
                    $excerpt_count = $settings['excerpt_count'];
                    ?>
                    <div class="post-list-item">
                        <?php if ( has_post_thumbnail() && 'yes' === $settings['show_thumbnail'] ) : ?>
                        <div class="entry-media">
                            <?php echo get_the_post_thumbnail( $idd, $settings['post_thumbnail_size'] ); ?>
                        </div>
                        <?php endif; ?>
                        <div class="entry-summary">
                            <?php if ( 'yes' === $settings['show_post_date'] ) : ?>
                            <span class="post-date">
                                <i class="far fa-calendar-alt"></i>
                                <?php echo esc_html( get_the_date() ) ?>
                            </span>
                            <?php endif; ?>
                            <<?php echo ot_escape_tags( $settings['title_tag'], 'h4' ); ?> class="entry-title">
                                <a href="<?php echo get_the_permalink() ?>">
                                    <?php echo get_the_title(); ?>
                                </a>
                            </<?php echo ot_escape_tags( $settings['title_tag'], 'h4' ); ?>>
                            <?php
                                if ( 'yes' === $settings['show_excerpt'] ) {
                                    if ( has_excerpt() ) {
                                        echo wpautop( wp_trim_words( get_the_excerpt(), $excerpt_count, '...' ) );
                                    } else {
                                        echo wpautop( wp_trim_words( get_the_content(), $excerpt_count, '...' ) );
                                    }
                                }
                            ?>
                            <?php if ( 'yes' === $settings['show_read_more'] && ! empty( $settings['read_more_text'] ) ) : ?>
                            <a href="<?php echo esc_url( get_permalink() ) ?>" class="oxence-button hover-normal">
                                <span class="button-icon icon-align-right">
                                <i aria-hidden="true" class="fas fa-angle-double-right"></i></span>
                                <span class="button-text"><?php echo esc_html( $settings['read_more_text'] ) ?></span>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            ?>
        </div>
        <?php
        if ( 'yes' === $settings['show_pagination'] ) {
            Oxence_Post_Helper::pagination( $wp_query );
        }
    }
}