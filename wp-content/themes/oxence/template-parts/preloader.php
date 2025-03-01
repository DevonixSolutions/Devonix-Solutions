<?php
/**
 * Template part for site preloader
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Oxence
 */


if ( defined( 'ELEMENTOR_VERSION' ) && \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
    echo '';
} else {
    ?>
    <div class="site-preloader">
        <div class="preloader-inner">
            <div><span></span></div>
            <div><span></span></div>
            <div><span></span></div>
        </div>
    </div>
    <?php
}
?>