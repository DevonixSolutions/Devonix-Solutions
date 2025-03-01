<?php
/**
 * Oxence functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Oxence
 */

/**
 * Define constant
 */
$theme = wp_get_theme();

if ( ! empty( $theme['Template'] ) ) {
    $theme = wp_get_theme( $theme['Template'] );
}

define( 'OXENCE_NAME', $theme['Name'] );
define( 'OXENCE_VERSION', $theme['Version'] );
define( 'OXENCE_PATH', untrailingslashit( get_template_directory() ) );
define( 'OXENCE_URI', untrailingslashit( get_template_directory_uri() ) );
define( 'OXENCE_ASSETS', untrailingslashit( get_template_directory_uri() ) . '/assets' );
define( 'OXENCE_INCLUDES', OXENCE_PATH . '/includes' );
define( 'OXENCE_CLASSES', OXENCE_PATH . '/includes/classes' );
define( 'OXENCE_ADMIN', OXENCE_PATH . '/includes/admin' );
define( 'OXENCE_IS_RTL', is_rtl() ? true : false );

/**
 * Load theme files
 */
require_once OXENCE_CLASSES . '/class-setup.php';
require_once OXENCE_CLASSES . '/class-helper.php';
require_once OXENCE_CLASSES . '/class-assets.php';
require_once OXENCE_CLASSES . '/class-post-helper.php';
require_once OXENCE_CLASSES . '/class-comment-walker.php';
require_once OXENCE_ADMIN . '/class-admin-panel.php';
require_once OXENCE_INCLUDES . '/library/class-tgm-plugin-activation.php';
require_once OXENCE_INCLUDES . '/library/required-plugin.php';
require_once OXENCE_CLASSES . '/class-woocommerce.php';