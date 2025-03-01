<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Oxence
 */

?>
<div id="post-<?php the_ID();?>" <?php post_class( 'page-inner clearfix' );?>>
    <?php
        the_content();

        wp_link_pages( [
            'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'oxence' ) . '</span>',
            'after'  => '</div>',
        ] );
    ?>
</div>