<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Oxence
 */

use OxenceTheme\Classes\Oxence_Helper as Helper;
use OxenceTheme\Classes\Oxence_Post_Helper;

$show_meta     = Helper::get_option( 'archive_post_meta', 'yes' );
$show_excerpt  = Helper::get_option( 'archive_post_excerpt', 'yes' );
$excerpt_count = Helper::get_option( 'post_excerpt_count', 12 );
$show_button   = Helper::get_option( 'archive_post_button', 'yes' );
$button_text   = Helper::get_option( 'post_button_text', __( 'Read More', 'oxence' ) );

$post_view = Helper::get_option( 'blog_post_view', 'list-view' );

if ( 'list-view' === $post_view ) {
    $col = 'col-12';
} else {
    $col = 'col-lg-4 col-md-6 col-12';

    if ( 'no-sidebar' !== Helper::content_sidebar() ) {
        $col = 'col-lg-6 col-md-6 col-12';
    }
}

$post_class = 'entry-post clearfix ' . $post_view;

?>

<div class="<?php echo esc_attr( $col ) ?>">
    <article id="post-<?php the_ID();?>" <?php post_class( $post_class );?>>
        <?php Oxence_Post_Helper::render_media(); ?>
        <div class="entry-summary">
            <?php
                if( 'yes' === $show_meta ) {
                    Oxence_Post_Helper::render_meta();
                }

                the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );

                if ( 'yes' === $show_excerpt ) {
                    if ( has_excerpt() ) {
                        echo wpautop( wp_trim_words( get_the_excerpt(), $excerpt_count, '...' ) );
                    } else {
                        echo wpautop( wp_trim_words( get_the_content(), $excerpt_count, '...' ) );
                    }
                }

                if ( 'yes' === $show_button && ! empty( $button_text ) ) {
                    echo '<a href="' . esc_url( get_permalink() ) . '" class="read-more"><span>' . esc_html( $button_text ) . '</span> <i class="far fa-arrow-right"></i></a>';
                }
            ?>
        </div>
    </article>
</div>