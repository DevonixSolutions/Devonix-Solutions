<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Oxence
 */

use OxenceTheme\Classes\Oxence_Helper as Helper;

$copyright = Helper::get_option( 'copyright_text', __( 'Copyright © 2022. All rights reserved.', 'oxence' ) );

?>

<footer class="site-footer default-footer">
    <?php if ( is_active_sidebar( 'footer_widgets' ) ): ?>
    <div class="footer-widgets">
        <div class="container">
            <div class="row">
                <?php dynamic_sidebar( 'footer_widgets' );?>
            </div>
        </div>
    </div>
    <?php endif;?>
    <div class="footer-copyright">
        <div class="container">
            <?php echo esc_html( $copyright ) ?>
        </div>
    </div>
</footer>