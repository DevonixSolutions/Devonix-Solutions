<?php
namespace OxenceToolkit\TemplateBuilder;

use CSF;

defined( 'ABSPATH' ) || exit;

class Template_Metaboxes {

    protected static $instance = null;
    private $prefix            = 'oxence_template_meta';

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function initialize() {
        if ( ! class_exists( 'CSF' ) ) {
            return;
        }

        $this->init_metaboxes();
    }

    public function init_metaboxes() {
        CSF::createMetabox( $this->prefix, [
            'title'        => esc_html__( 'Template Settings', 'oxence-toolkit' ),
            'post_type'    => 'oxence_template',
            'show_restore' => true,
            'theme'        => 'dark',
            'data_type'    => 'unserialize',
        ] );

        CSF::createSection( $this->prefix, [
            'fields' => [
                [
                    'id'     => 'oxence_tb_settings',
                    'type'   => 'fieldset',
                    'title'  => esc_html__( 'Common Settings', 'oxence-toolkit' ),
                    'fields' => [
                        [
                            'id'          => 'template_type',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Template Type', 'oxence-toolkit' ),
                            'placeholder' => esc_html__( 'Select Type', 'oxence-toolkit' ),
                            'options'     => [
                                'header'    => esc_html__( 'Header', 'oxence-toolkit' ),
                                'footer'    => esc_html__( 'Footer', 'oxence-toolkit' ),
                                'block'     => esc_html__( 'Block', 'oxence-toolkit' ),
                                'popup'     => esc_html__( 'Popup', 'oxence-toolkit' ),
                                'offcanvas' => esc_html__( 'OffCanvas', 'oxence-toolkit' ),
                            ],
                            'default'     => 'block',
                        ],
                        [
                            'id'         => 'popup_width',
                            'type'       => 'select',
                            'title'      => esc_html__( 'Popup Width', 'oxence-toolkit' ),
                            'subtitle'   => esc_html__( 'Select or type a value (PX)', 'oxence-toolkit' ),
                            'options'    => [
                                'full'   => esc_html__( 'Full', 'oxence-toolkit' ),
                                'custom' => esc_html__( 'Custom', 'oxence-toolkit' ),
                            ],
                            'default'    => 'custom',
                            'dependency' => ['template_type', '==', 'popup'],
                        ],
                        [
                            'id'         => 'set_popup_width',
                            'type'       => 'dimensions',
                            'title'      => esc_html__( 'Popup Width', 'oxence-toolkit' ),
                            'default'    => [
                                'width' => '820',
                            ],
                            'height'     => false,
                            'units'      => ['px'],
                            'show_units' => false,
                            'dependency' => ['template_type|popup_width', '==|==', 'popup|custom'],
                        ],
                        [
                            'id'         => 'popup_height',
                            'type'       => 'select',
                            'title'      => esc_html__( 'Popup Height', 'oxence-toolkit' ),
                            'subtitle'   => esc_html__( 'Set the popup max height.', 'oxence-toolkit' ),
                            'options'    => [
                                'fit_content' => esc_html__( 'Fit Content', 'oxence-toolkit' ),
                                'full'        => esc_html__( 'Full', 'oxence-toolkit' ),
                                'custom'      => esc_html__( 'Custom', 'oxence-toolkit' ),
                            ],
                            'default'    => 'fit_content',
                            'dependency' => ['template_type', '==', 'popup'],
                        ],
                        [
                            'id'         => 'set_popup_height',
                            'type'       => 'dimensions',
                            'title'      => esc_html__( 'Height', 'oxence-toolkit' ),
                            'default'    => [
                                'height' => '520',
                            ],
                            'width'      => false,
                            'units'      => ['px'],
                            'show_units' => false,
                            'dependency' => ['template_type|popup_height', '==|==', 'popup|custom'],
                        ],
                        [
                            'id'         => 'popup_position',
                            'type'       => 'select',
                            'title'      => esc_html__( 'Popup Position', 'oxence-toolkit' ),
                            'subtitle'   => esc_html__( 'Choose the popup position on page.', 'oxence-toolkit' ),
                            'options'    => [
                                'center-center' => esc_html__( 'Center Center', 'oxence-toolkit' ),
                                'center-left'   => esc_html__( 'Center Left', 'oxence-toolkit' ),
                                'center-right'  => esc_html__( 'Center Right', 'oxence-toolkit' ),
                                'bottom-center' => esc_html__( 'Bottom Center', 'oxence-toolkit' ),
                                'top-center'    => esc_html__( 'Top Center', 'oxence-toolkit' ),
                                'bottom-left'   => esc_html__( 'Bottom Left', 'oxence-toolkit' ),
                                'top-left'      => esc_html__( 'Top Left', 'oxence-toolkit' ),
                                'bottom-right'  => esc_html__( 'Bottom Right', 'oxence-toolkit' ),
                                'top-right'     => esc_html__( 'Top Right', 'oxence-toolkit' ),
                            ],
                            'default'    => 'center-center',
                            'dependency' => ['template_type', '==', 'popup'],
                        ],
                        [
                            'id'         => 'popup_overly_color',
                            'type'       => 'color',
                            'title'      => esc_html__( 'Popup Overly Color', 'oxence-toolkit' ),
                            'dependency' => ['template_type', '==', 'popup'],
                            'default'    => 'rgba(0, 0, 0, 0.5)',
                        ],
                        [
                            'id'         => 'popup_close_color',
                            'type'       => 'color',
                            'title'      => esc_html__( 'Popup Close Color', 'oxence-toolkit' ),
                            'dependency' => ['template_type', '==', 'popup'],
                            'default'    => '#fb2614',
                        ],
                        [
                            'id'         => 'popup_close_bg',
                            'type'       => 'color',
                            'title'      => esc_html__( 'Popup Close Color', 'oxence-toolkit' ),
                            'dependency' => ['template_type', '==', 'popup'],
                            'default'    => '#ffffff',
                        ],
                        [
                            'id'         => 'popup_close_size',
                            'type'       => 'dimensions',
                            'title'      => esc_html__( 'Popup Close Size', 'oxence-toolkit' ),
                            'dependency' => ['template_type', '==', 'popup'],
                            'units'      => ['px'],
                            'default'    => [
                                'width'  => '40',
                                'height' => '40',
                            ],
                            'show_units' => false,
                        ],
                        [
                            'id'         => 'popup_close_radius',
                            'type'       => 'number',
                            'title'      => esc_html__( 'Popup Close Radius', 'oxence-toolkit' ),
                            'dependency' => ['template_type', '==', 'popup'],
                        ],
                        [
                            'id'         => 'popup_delay',
                            'type'       => 'number',
                            'title'      => esc_html__( 'Popup Delay', 'oxence-toolkit' ),
                            'dependency' => ['template_type', '==', 'popup'],
                            'default'    => 3,
                            'subtitle'   => esc_html__( 'Show when page is loaded (Second).', 'oxence-toolkit' ),
                        ],
                        [
                            'id'         => 'offcanvas_width',
                            'type'       => 'dimensions',
                            'title'      => esc_html__( 'Width', 'oxence-toolkit' ),
                            'height'     => false,
                            'units'      => ['px'],
                            'default'    => [
                                'width' => '420',
                            ],
                            'show_units' => false,
                            'dependency' => ['template_type', '==', 'offcanvas'],
                        ],
                    ],
                ],
                [
                    'id'           => 'oxence_tb_include',
                    'type'         => 'repeater',
                    'title'        => esc_html__( 'Display On', 'oxence-toolkit' ),
                    'subtitle'     => esc_html__( 'Select the locations where this item should be visible.', 'oxence-toolkit' ),
                    'button_title' => esc_html__( 'Add Display Rule', 'oxence-toolkit' ),
                    'dependency'   => ['template_type', 'any', 'header,footer,popup'],
                    'fields'       => [
                        [
                            'type'    => 'subheading',
                            'content' => esc_html__( 'Define Rule', 'oxence-toolkit' ),
                        ],
                        [
                            'id'      => 'rule',
                            'type'    => 'select',
                            'title'   => esc_html__( 'Display on', 'oxence-toolkit' ),
                            'options' => [
                                'entire_website'    => esc_html__( 'Entire Website', 'oxence-toolkit' ),
                                'all_pages'         => esc_html__( 'All Pages', 'oxence-toolkit' ),
                                'front_page'        => esc_html__( 'Front Page', 'oxence-toolkit' ),
                                'post_page'         => esc_html__( 'Post Page', 'oxence-toolkit' ),
                                'post_details'      => esc_html__( 'Post Details', 'oxence-toolkit' ),
                                'all_archive'       => esc_html__( 'All Archive', 'oxence-toolkit' ),
                                'date_archive'      => esc_html__( 'Date Archive', 'oxence-toolkit' ),
                                'author_archive'    => esc_html__( 'Author Archive', 'oxence-toolkit' ),
                                'search_page'       => esc_html__( 'Search Page', 'oxence-toolkit' ),
                                '404_page'          => esc_html__( '404 Page', 'oxence-toolkit' ),
                                'specific_pages'    => esc_html__( 'Specific Pages', 'oxence-toolkit' ),
                                'specific_posts'    => esc_html__( 'Specific Posts', 'oxence-toolkit' ),
                                'shop_page'         => esc_html__( 'Shop Page', 'oxence-toolkit' ),
                                'product_details'   => esc_html__( 'Product Details', 'oxence-toolkit' ),
                                'specific_products' => esc_html__( 'Specific Products', 'oxence-toolkit' ),
                            ],
                        ],
                        [
                            'id'          => 'page_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Pages', 'oxence-toolkit' ),
                            'placeholder' => esc_html__( 'Select Pages', 'oxence-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'pages',
                            'dependency'  => ['rule', '==', 'specific_pages'],
                        ],
                        [
                            'id'          => 'posts_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Posts', 'oxence-toolkit' ),
                            'placeholder' => esc_html__( 'Select Posts', 'oxence-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'posts',
                            'dependency'  => ['rule', '==', 'specific_posts'],
                        ],
                        [
                            'id'          => 'product_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Products', 'oxence-toolkit' ),
                            'placeholder' => esc_html__( 'Select Products', 'oxence-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'post',
                            'query_args'  => [
                                'post_type' => 'product',
                            ],
                            'dependency'  => ['rule', '==', 'specific_products'],
                        ],
                    ],
                ],
                [
                    'id'           => 'oxence_tb_exclude',
                    'type'         => 'repeater',
                    'title'        => esc_html__( 'Hide On', 'oxence-toolkit' ),
                    'subtitle'     => esc_html__( 'Select the locations where this item should be visible.', 'oxence-toolkit' ),
                    'button_title' => esc_html__( 'Add Hide Rule', 'oxence-toolkit' ),
                    'dependency'   => ['template_type', 'any', 'header,footer,popup'],
                    'fields'       => [
                        [
                            'type'    => 'subheading',
                            'content' => esc_html__( 'Hide Rule', 'oxence-toolkit' ),
                        ],
                        [
                            'id'      => 'rule',
                            'type'    => 'select',
                            'title'   => esc_html__( 'Hide on', 'oxence-toolkit' ),
                            'options' => [
                                'entire_website'    => esc_html__( 'Entire Website', 'oxence-toolkit' ),
                                'all_pages'         => esc_html__( 'All Pages', 'oxence-toolkit' ),
                                'front_page'        => esc_html__( 'Front Page', 'oxence-toolkit' ),
                                'post_page'         => esc_html__( 'Post Page', 'oxence-toolkit' ),
                                'post_details'      => esc_html__( 'Post Details', 'oxence-toolkit' ),
                                'all_archive'       => esc_html__( 'All Archive', 'oxence-toolkit' ),
                                'date_archive'      => esc_html__( 'Date Archive', 'oxence-toolkit' ),
                                'author_archive'    => esc_html__( 'Author Archive', 'oxence-toolkit' ),
                                'search_page'       => esc_html__( 'Search Page', 'oxence-toolkit' ),
                                '404_page'          => esc_html__( '404 Page', 'oxence-toolkit' ),
                                'specific_pages'    => esc_html__( 'Specific Pages', 'oxence-toolkit' ),
                                'specific_posts'    => esc_html__( 'Specific Posts', 'oxence-toolkit' ),
                                'shop_page'         => esc_html__( 'Shop Page', 'oxence-toolkit' ),
                                'product_details'   => esc_html__( 'Product Details', 'oxence-toolkit' ),
                                'specific_products' => esc_html__( 'Specific Products', 'oxence-toolkit' ),
                            ],
                        ],
                        [
                            'id'          => 'page_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Pages', 'oxence-toolkit' ),
                            'placeholder' => esc_html__( 'Select Pages', 'oxence-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'pages',
                            'dependency'  => ['rule', '==', 'specific_pages'],
                        ],
                        [
                            'id'          => 'posts_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Posts', 'oxence-toolkit' ),
                            'placeholder' => esc_html__( 'Select Posts', 'oxence-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'posts',
                            'dependency'  => ['rule', '==', 'specific_posts'],
                        ],
                        [
                            'id'          => 'product_ids',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Select Products', 'oxence-toolkit' ),
                            'placeholder' => esc_html__( 'Select Products', 'oxence-toolkit' ),
                            'chosen'      => true,
                            'ajax'        => true,
                            'multiple'    => true,
                            'sortable'    => true,
                            'options'     => 'post',
                            'query_args'  => [
                                'post_type' => 'product',
                            ],
                            'dependency'  => ['rule', '==', 'specific_products'],
                        ],
                    ],
                ],
            ],
        ] );
    }
}

Template_Metaboxes::instance()->initialize();