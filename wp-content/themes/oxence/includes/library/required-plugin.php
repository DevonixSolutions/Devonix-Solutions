<?php
/**
 * Required Plugin for Oxence theme
 *
 * @package Oxence
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit( 'No direct script access allowed' );
}

add_action( 'tgmpa_register', 'oxence_register_required_plugins' );
function oxence_register_required_plugins() {
    $plugins = [
        [
            'name'     => esc_html__( 'Elementor Website Builder', 'oxence' ),
            'slug'     => 'elementor',
            'required' => true,
            'version'  => '3.0',
        ],
        [
            'name'     => esc_html__( 'Oxence Toolkit', 'oxence' ),
            'slug'     => 'oxence-toolkit',
            'source'   => OXENCE_INCLUDES . '/library/plugins/oxence-toolkit.zip',
            'required' => true,
            'version'  => '1.1',
        ],
        [
            'name'     => esc_html__( 'Contact Form 7', 'oxence' ),
            'slug'     => 'contact-form-7',
            'required' => false,
        ],
        [
            'name'     => esc_html__( 'Breadcrumb NavXT', 'oxence' ),
            'slug'     => 'breadcrumb-navxt',
            'required' => false,
        ],
        [
            'name'     => esc_html__( 'MC4WP: Mailchimp for WordPress', 'oxence' ),
            'slug'     => 'mailchimp-for-wp',
            'required' => false,
        ],
        [
            'name'     => esc_html__( 'WooCommerce', 'oxence' ),
            'slug'     => 'woocommerce',
            'required' => false,
        ],
        [
            'name'     => esc_html__( 'One Click Demo Import', 'oxence' ),
            'slug'     => 'one-click-demo-import',
            'required' => false,
        ],
    ];

    $config = [
        'default_path' => '',
        'menu'         => 'oxence_install_plugins',
        'has_notices'  => true,
        'dismissable'  => false,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
    ];

    tgmpa( $plugins, $config );
}
