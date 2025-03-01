<?php
namespace OxenceToolkit\Helper;

use CSF;

defined( 'ABSPATH' ) || exit;

/**
 * Oxence Toolkit Helper
 */

class Oxence_Metaboxes {
    protected static $instance = null;

    private $post_prefix      = 'oxence_post_meta';
    private $page_prefix      = 'oxence_page_meta';
    private $user_prefix      = 'oxence_user_meta';
    private $service_prefix   = 'oxence_service_meta';
    private $portfolio_prefix = 'oxence_portfolio_meta';
    private $team_prefix      = 'oxence_team_meta';
    private $product_prefix   = 'oxence_product_meta';

    private $template_builder_url;

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

        $this->template_builder_url = admin_url( 'edit.php?post_type=oxence_template' );

        $this->post_metaboxes();
        $this->page_metaboxes();
        $this->user_metaboxes();
        $this->service_metaboxes();
        $this->portfolio_metaboxes();
        $this->team_metaboxes();
        $this->product_metaboxes();
    }

    public function post_metaboxes() {
        CSF::createMetabox( $this->post_prefix, [
            'title'        => esc_html__( 'Oxence Post Options', 'oxence-toolkit' ),
            'post_type'    => 'post',
            'show_restore' => true,
        ] );

        // Page Layout
        CSF::createSection( $this->post_prefix, [
            'title'  => esc_html__( 'Layout', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Post Layout', 'oxence-toolkit' ),
                ],
                [
                    'id'       => 'post_details_layout',
                    'type'     => 'image_select',
                    'title'    => esc_html__( 'Content Layout', 'oxence-toolkit' ),
                    'options'  => [
                        'default'           => OT_ASSETS . '/img/options/default.jpg',
                        'boxed-layout'      => OT_ASSETS . '/img/options/boxed-layout.jpg',
                        'full-width-layout' => OT_ASSETS . '/img/options/full-width-layout.jpg',
                    ],
                    'default'  => 'default',
                    'desc'     => esc_html__( 'Select Post layout. Full width or In container', 'oxence-toolkit' ),
                    'subtitle' => esc_html__( 'Default Comes From Theme Option', 'oxence-toolkit' ),
                ],
                [
                    'id'       => 'post_details_sidebar',
                    'type'     => 'image_select',
                    'title'    => esc_html__( 'Sidebar', 'oxence-toolkit' ),
                    'options'  => [
                        'default'       => OT_ASSETS . '/img/options/default.jpg',
                        'left-sidebar'  => OT_ASSETS . '/img/options/left-sidebar.jpg',
                        'right-sidebar' => OT_ASSETS . '/img/options/right-sidebar.jpg',
                        'no-sidebar'    => OT_ASSETS . '/img/options/no-sidebar.jpg',
                    ],
                    'default'  => 'default',
                    'desc'     => esc_html__( 'Select Page Sidebar. Left sidebar or right sidebar or No sidebar', 'oxence-toolkit' ),
                    'subtitle' => esc_html__( 'Default Comes From Theme Option', 'oxence-toolkit' ),

                ],
                [
                    'id'         => 'content_spacing',
                    'type'       => 'spacing',
                    'title'      => esc_html__( 'Content Spacing', 'oxence-toolkit' ),
                    'show_units' => false,
                    'desc'       => esc_html__( 'Default top: 130px, right: 15px, bottom: 130px, left: 15px', 'oxence-toolkit' ),
                    'output'     => '.content-container',
                ],
            ],
        ] );

        // Header
        CSF::createSection( $this->post_prefix, [
            'title'  => esc_html__( 'Header', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__( 'If you used theme builder for post header then disable default header', 'oxence-toolkit' ),
                ],
                [
                    'id'       => 'post_default_header',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Default Header', 'oxence-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable post default header. Default comes form theme option', 'oxence-toolkit' ),
                    'options'  => [
                        'default'  => esc_html__( 'Default', 'oxence-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'oxence-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'oxence-toolkit' ),
                    ],
                    'default'  => 'default',

                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__( 'You disabled default header. Set your post header form ', 'oxence-toolkit' ) . '<a href="' . esc_url( $this->template_builder_url ) . '">' . esc_html__( 'here', 'oxence-toolkit' ) . '</a>',
                    'dependency' => [
                        'post_default_header', '==', 'disabled',
                    ],
                ],
                [
                    'id'      => 'post_transparent_header',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Transparent Header', 'oxence-toolkit' ),
                    'desc'    => esc_html__( 'Set header to transparent background before scroll.', 'oxence-toolkit' ),
                    'options' => [
                        'default'  => esc_html__( 'Default', 'oxence-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'oxence-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'oxence-toolkit' ),
                    ],
                    'default' => 'default',
                ],
            ],
        ] );

        // Page Title
        CSF::createSection( $this->post_prefix, [
            'title'  => esc_html__( 'Page Title', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Page Title', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'post_page_title',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Page Title', 'oxence-toolkit' ),
                    'options' => [
                        'default'  => esc_html__( 'Default', 'oxence-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'oxence-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'oxence-toolkit' ),
                    ],
                    'default' => 'default',
                ],
                [
                    'id'         => 'post_title_type',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Page Title Type', 'oxence-toolkit' ),
                    'options'    => [
                        'default' => esc_html__( 'Default', 'oxence-toolkit' ),
                        'custom'  => esc_html__( 'Custom', 'oxence-toolkit' ),
                    ],
                    'default'    => 'default',
                    'dependency' => ['post_page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'post_custom_title',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Custom Title', 'oxence-toolkit' ),
                    'dependency' => [
                        ['post_page_title', '!=', 'disabled'],
                        ['post_title_type', '==', 'custom'],
                    ],
                    'default'    => esc_html__( 'News Details', 'oxence-toolkit' ),
                ],
                [
                    'id'         => 'customize_page_title_style',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Customize Style', 'oxence-toolkit' ),
                    'options'    => [
                        'yes' => esc_html__( 'Yes', 'oxence-toolkit' ),
                        'no'  => esc_html__( 'No', 'oxence-toolkit' ),
                    ],
                    'default'    => 'no',
                    'dependency' => ['post_page_title', '!=', 'disabled'],
                ],
                [
                    'type'       => 'subheading',
                    'content'    => esc_html__( 'Page Title Styling', 'oxence-toolkit' ),
                    'dependency' => [
                        ['post_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'page_title_padding',
                    'type'        => 'spacing',
                    'title'       => esc_html__( 'Padding', 'oxence-toolkit' ),
                    'output'      => '.page-title-area',
                    'output_mode' => 'padding',
                    'dependency'  => [
                        ['post_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'page_title_border',
                    'type'       => 'border',
                    'title'      => esc_html__( 'Border', 'oxence-toolkit' ),
                    'output'     => '.page-title-area',
                    'dependency' => [
                        ['post_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'page_title_bg',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Background Color', 'oxence-toolkit' ),
                    'output'      => '.page-title-area',
                    'output_mode' => 'background-color',
                    'dependency'  => [
                        ['post_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'page_title_typo',
                    'type'       => 'typography',
                    'title'      => esc_html( 'Typography', 'oxence-toolkit' ),
                    'output'     => '.page-title-area .page-title',
                    'dependency' => [
                        ['post_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'page_breadcrumb_typo',
                    'type'       => 'typography',
                    'title'      => esc_html( 'Breadcrumb Typography', 'oxence-toolkit' ),
                    'output'     => '.page-title-area .breadcrumb, .page-title-area .breadcrumb a',
                    'dependency' => [
                        ['post_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
            ],
        ] );

        // Footer
        CSF::createSection( $this->post_prefix, [
            'title'  => esc_html__( 'Footer', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__( 'If you used theme builder for post footer then disable default footer', 'oxence-toolkit' ),
                ],
                [
                    'id'       => 'post_default_footer',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Default Footer', 'oxence-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable post default footer. Default comes form theme option', 'oxence-toolkit' ),
                    'options'  => [
                        'default'  => esc_html__( 'Default', 'oxence-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'oxence-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'oxence-toolkit' ),
                    ],
                    'default'  => 'default',

                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__( 'You disabled default footer. Set your post footer form ', 'oxence-toolkit' ) . '<a href="' . esc_url( $this->template_builder_url ) . '">' . esc_html__( 'here', 'oxence-toolkit' ) . '</a>',
                    'dependency' => [
                        'post_default_footer', '==', 'disabled',
                    ],
                ],
            ],
        ] );
    }

    public function page_metaboxes() {
        CSF::createMetabox( $this->page_prefix, [
            'title'        => esc_html__( 'Oxence Page Options', 'oxence-toolkit' ),
            'post_type'    => 'page',
            'show_restore' => true,
        ] );

        // Page Layout
        CSF::createSection( $this->page_prefix, [
            'title'  => esc_html__( 'Layout', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Page Layout', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'content_layout',
                    'type'    => 'image_select',
                    'title'   => esc_html__( 'Content Layout', 'oxence-toolkit' ),
                    'options' => [
                        'boxed-layout'      => OT_ASSETS . '/img/options/boxed-layout.jpg',
                        'full-width-layout' => OT_ASSETS . '/img/options/full-width-layout.jpg',
                    ],
                    'default' => 'boxed-layout',
                    'desc'    => esc_html__( 'Select Page layout. Full width or In container', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'content_sidebar',
                    'type'    => 'image_select',
                    'title'   => esc_html__( 'Sidebar', 'oxence-toolkit' ),
                    'options' => [
                        'left-sidebar'  => OT_ASSETS . '/img/options/left-sidebar.jpg',
                        'right-sidebar' => OT_ASSETS . '/img/options/right-sidebar.jpg',
                        'no-sidebar'    => OT_ASSETS . '/img/options/no-sidebar.jpg',
                    ],
                    'default' => 'no-sidebar',
                    'desc'    => esc_html__( 'Select Page Sidebar. Left sidebar or right sidebar or No sidebar', 'oxence-toolkit' ),
                ],
                [
                    'id'         => 'content_spacing',
                    'type'       => 'spacing',
                    'title'      => esc_html__( 'Content Spacing', 'oxence-toolkit' ),
                    'show_units' => false,
                    'desc'       => esc_html__( 'Default top: 130px, right: 15px, bottom: 130px, left: 15px', 'oxence-toolkit' ),
                    'output'     => '.content-container',
                ],
            ],
        ] );

        // Header
        CSF::createSection( $this->page_prefix, [
            'title'  => esc_html__( 'Header', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__( 'If you used theme builder for page header then disable default header', 'oxence-toolkit' ),
                ],
                [
                    'id'       => 'page_default_header',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Default Header', 'oxence-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable page default header. Default comes form theme option', 'oxence-toolkit' ),
                    'options'  => [
                        'default'  => esc_html__( 'Default', 'oxence-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'oxence-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'oxence-toolkit' ),
                    ],
                    'default'  => 'default',
                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__( 'You disabled default header. Set your page header form ', 'oxence-toolkit' ) . '<a href="' . esc_url( $this->template_builder_url ) . '">' . esc_html__( 'here', 'oxence-toolkit' ) . '</a>',
                    'dependency' => [
                        'page_default_header', '==', 'disabled',
                    ],
                ],
                [
                    'id'      => 'page_transparent_header',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Transparent Header', 'oxence-toolkit' ),
                    'desc'    => esc_html__( 'Set header to transparent background before scroll.', 'oxence-toolkit' ),
                    'options' => [
                        'default'  => esc_html__( 'Default', 'oxence-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'oxence-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'oxence-toolkit' ),
                    ],
                    'default' => 'default',
                ],
            ],
        ] );

        // Page Title
        CSF::createSection( $this->page_prefix, [
            'title'  => esc_html__( 'Page Title', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Page Title', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'page_title',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Page Title', 'oxence-toolkit' ),
                    'options' => [
                        'default'  => esc_html__( 'Default', 'oxence-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'oxence-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'oxence-toolkit' ),
                    ],
                    'default' => 'default',
                ],
                [
                    'id'         => 'page_title_type',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Page Title Type', 'oxence-toolkit' ),
                    'options'    => [
                        'default' => esc_html__( 'Default', 'oxence-toolkit' ),
                        'custom'  => esc_html__( 'Custom', 'oxence-toolkit' ),
                    ],
                    'default'    => 'default',
                    'dependency' => ['page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'page_custom_title',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Custom Title', 'oxence-toolkit' ),
                    'dependency' => [
                        ['page_title', '!=', 'disabled'],
                        ['page_title_type', '==', 'custom'],
                    ],
                ],
                [
                    'id'         => 'page_breadcrumb',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Page Breadcrumb', 'oxence-toolkit' ),
                    'options'    => [
                        'default'  => esc_html__( 'Default', 'oxence-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'oxence-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'oxence-toolkit' ),
                    ],
                    'default'    => 'default',
                    'dependency' => ['page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'customize_page_title_style',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Customize Style', 'oxence-toolkit' ),
                    'options'    => [
                        'yes' => esc_html__( 'Yes', 'oxence-toolkit' ),
                        'no'  => esc_html__( 'No', 'oxence-toolkit' ),
                    ],
                    'default'    => 'no',
                    'dependency' => ['page_title', '!=', 'disabled'],
                ],
                [
                    'type'       => 'subheading',
                    'content'    => esc_html__( 'Page Title Styling', 'oxence-toolkit' ),
                    'dependency' => [
                        ['page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'page_title_padding',
                    'type'        => 'spacing',
                    'title'       => esc_html__( 'Padding', 'oxence-toolkit' ),
                    'output'      => '.page-title-area',
                    'output_mode' => 'padding',
                    'dependency'  => [
                        ['page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'page_title_border',
                    'type'       => 'border',
                    'title'      => esc_html__( 'Border', 'oxence-toolkit' ),
                    'output'     => '.page-title-area',
                    'dependency' => [
                        ['page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'page_title_bg',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Background Color', 'oxence-toolkit' ),
                    'output'      => '.page-title-area',
                    'output_mode' => 'background-color',
                    'dependency'  => [
                        ['page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'page_title_typo',
                    'type'       => 'typography',
                    'title'      => esc_html( 'Typography', 'oxence-toolkit' ),
                    'output'     => '.page-title-area .page-title',
                    'dependency' => [
                        ['page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'page_breadcrumb_typo',
                    'type'       => 'typography',
                    'title'      => esc_html( 'Breadcrumb Typography', 'oxence-toolkit' ),
                    'output'     => '.page-title-area .breadcrumb, .page-title-area .breadcrumb a',
                    'dependency' => [
                        ['page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
            ],
        ] );

        // Footer
        CSF::createSection( $this->page_prefix, [
            'title'  => esc_html__( 'Footer', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__( 'If you used theme builder for page footer then disable default footer', 'oxence-toolkit' ),
                ],
                [
                    'id'       => 'page_default_footer',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Default Footer', 'oxence-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable page default footer. Default comes form theme option', 'oxence-toolkit' ),
                    'options'  => [
                        'default'  => esc_html__( 'Default', 'oxence-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'oxence-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'oxence-toolkit' ),
                    ],
                    'default'  => 'default',
                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__( 'You disabled default footer. Set your page footer form ', 'oxence-toolkit' ) . '<a href="' . esc_url( $this->template_builder_url ) . '">' . esc_html__( 'here', 'oxence-toolkit' ) . '</a>',
                    'dependency' => [
                        'page_default_footer', '==', 'disabled',
                    ],
                ],
            ],
        ] );
    }

    public function user_metaboxes() {
        CSF::createProfileOptions( $this->user_prefix, [
            'data_type' => 'serialize',
        ] );

        CSF::createSection( $this->user_prefix, [
            'fields' => [
                [
                    'title' => esc_html__( 'Oxence Author Options', 'oxence-toolkit' ),
                    'type'  => 'heading',
                ],
                [
                    'id'           => 'user_social_links',
                    'type'         => 'repeater',
                    'title'        => esc_html__( 'User Social Links', 'oxence-toolkit' ),
                    'button_title' => esc_html__( 'Add New', 'oxence-toolkit' ),
                    'fields'       => [
                        [
                            'id'    => 'social_icon',
                            'type'  => 'icon',
                            'title' => esc_html__( 'Icon', 'oxence-toolkit' ),
                        ],
                        [
                            'id'    => 'social_link',
                            'type'  => 'text',
                            'title' => esc_html__( 'Link', 'oxence-toolkit' ),
                        ],
                    ],
                ],
            ],
        ] );
    }

    public function service_metaboxes() {
        CSF::createMetabox( $this->service_prefix, [
            'title'        => esc_html__( 'Oxence Service Options', 'oxence-toolkit' ),
            'post_type'    => 'oxence_service',
            'show_restore' => true,
        ] );

        // Page Layout
        CSF::createSection( $this->service_prefix, [
            'title'  => esc_html__( 'Layout', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Page Layout', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'content_layout',
                    'type'    => 'image_select',
                    'title'   => esc_html__( 'Content Layout', 'oxence-toolkit' ),
                    'options' => [
                        'boxed-layout'      => OT_ASSETS . '/img/options/boxed-layout.jpg',
                        'full-width-layout' => OT_ASSETS . '/img/options/full-width-layout.jpg',
                    ],
                    'default' => 'boxed-layout',
                    'desc'    => esc_html__( 'Select Page layout. Full width or In container', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'content_sidebar',
                    'type'    => 'image_select',
                    'title'   => esc_html__( 'Sidebar', 'oxence-toolkit' ),
                    'options' => [
                        'left-sidebar'  => OT_ASSETS . '/img/options/left-sidebar.jpg',
                        'right-sidebar' => OT_ASSETS . '/img/options/right-sidebar.jpg',
                        'no-sidebar'    => OT_ASSETS . '/img/options/no-sidebar.jpg',
                    ],
                    'default' => 'no-sidebar',
                    'desc'    => esc_html__( 'Select Page Sidebar. Left sidebar or right sidebar or No sidebar', 'oxence-toolkit' ),
                ],
                [
                    'id'         => 'content_spacing',
                    'type'       => 'spacing',
                    'title'      => esc_html__( 'Content Spacing', 'oxence-toolkit' ),
                    'show_units' => false,
                    'desc'       => esc_html__( 'Default top: 130px, right: 15px, bottom: 130px, left: 15px', 'oxence-toolkit' ),
                    'output'     => '.content-container',
                ],
            ],
        ] );

        // Page Title
        CSF::createSection( $this->service_prefix, [
            'title'  => esc_html__( 'Page Title', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Page Title', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'service_page_title',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Page Title', 'oxence-toolkit' ),
                    'options' => [
                        'default'  => esc_html__( 'Default', 'oxence-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'oxence-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'oxence-toolkit' ),
                    ],
                    'default' => 'default',
                ],
                [
                    'id'         => 'service_page_title_type',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Page Title Type', 'oxence-toolkit' ),
                    'options'    => [
                        'default' => esc_html__( 'Default', 'oxence-toolkit' ),
                        'custom'  => esc_html__( 'Custom', 'oxence-toolkit' ),
                    ],
                    'default'    => 'default',
                    'dependency' => ['service_page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'service_custom_title',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Custom Title', 'oxence-toolkit' ),
                    'dependency' => [
                        ['service_page_title', '!=', 'disabled'],
                        ['service_page_title_type', '==', 'custom'],
                    ],
                ],
                [
                    'id'         => 'service_breadcrumb',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Service Breadcrumb', 'oxence-toolkit' ),
                    'options'    => [
                        'default'  => esc_html__( 'Default', 'oxence-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'oxence-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'oxence-toolkit' ),
                    ],
                    'default'    => 'default',
                    'dependency' => ['service_page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'customize_page_title_style',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Customize Style', 'oxence-toolkit' ),
                    'options'    => [
                        'yes' => esc_html__( 'Yes', 'oxence-toolkit' ),
                        'no'  => esc_html__( 'No', 'oxence-toolkit' ),
                    ],
                    'default'    => 'no',
                    'dependency' => ['service_page_title', '!=', 'disabled'],
                ],
                [
                    'type'       => 'subheading',
                    'content'    => esc_html__( 'Page Title Styling', 'oxence-toolkit' ),
                    'dependency' => [
                        ['service_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'page_title_padding',
                    'type'        => 'spacing',
                    'title'       => esc_html__( 'Padding', 'oxence-toolkit' ),
                    'output'      => '.page-title-area',
                    'output_mode' => 'padding',
                    'dependency'  => [
                        ['service_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'page_title_border',
                    'type'       => 'border',
                    'title'      => esc_html__( 'Border', 'oxence-toolkit' ),
                    'output'     => '.page-title-area',
                    'dependency' => [
                        ['service_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'page_title_bg',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Background Color', 'oxence-toolkit' ),
                    'output'      => '.page-title-area',
                    'output_mode' => 'background-color',
                    'dependency'  => [
                        ['service_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'page_title_typo',
                    'type'       => 'typography',
                    'title'      => esc_html( 'Typography', 'oxence-toolkit' ),
                    'output'     => '.page-title-area .page-title',
                    'dependency' => [
                        ['service_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'page_breadcrumb_typo',
                    'type'       => 'typography',
                    'title'      => esc_html( 'Breadcrumb Typography', 'oxence-toolkit' ),
                    'output'     => '.page-title-area .breadcrumb, .page-title-area .breadcrumb a',
                    'dependency' => [
                        ['service_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
            ],
        ] );
    }

    public function portfolio_metaboxes() {
        CSF::createMetabox( $this->portfolio_prefix, [
            'title'        => esc_html__( 'Oxence Portfolio Options', 'oxence-toolkit' ),
            'post_type'    => 'oxence_portfolio',
            'show_restore' => true,
        ] );

        // General
        CSF::createSection( $this->portfolio_prefix, [
            'title'  => esc_html__( 'General', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Project Information', 'oxence-toolkit' ),
                ],
                [
                    'id'    => 'project_gallery',
                    'type'  => 'gallery',
                    'title' => esc_html__( 'Project Gallery', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'information_heading',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Information Heading', 'oxence-toolkit' ),
                    'default' => esc_html__( 'Project Information', 'oxence-toolkit' ),
                ],
                [
                    'id'           => 'information',
                    'type'         => 'group',
                    'title'        => esc_html__( 'Information', 'oxence-toolkit' ),
                    'button_title' => esc_html__( 'Add New', 'oxence-toolkit' ),
                    'fields'       => [
                        [
                            'id'    => 'info_title',
                            'type'  => 'text',
                            'title' => esc_html__( 'Info Title', 'oxence-toolkit' ),
                        ],
                        [
                            'id'    => 'info_desc',
                            'type'  => 'textarea',
                            'title' => esc_html__( 'Info Description', 'oxence-toolkit' ),
                        ],
                    ],
                ],
                [
                    'id'      => 'details_heading',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Details Heading', 'oxence-toolkit' ),
                    'default' => esc_html__( 'Project Details', 'oxence-toolkit' ),
                ],
            ],
        ] );

        // Page Title
        CSF::createSection( $this->portfolio_prefix, [
            'title'  => esc_html__( 'Page Title', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Page Title', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'portfolio_page_title',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Page Title', 'oxence-toolkit' ),
                    'options' => [
                        'default'  => esc_html__( 'Default', 'oxence-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'oxence-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'oxence-toolkit' ),
                    ],
                    'default' => 'default',
                ],
                [
                    'id'         => 'portfolio_page_title_type',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Page Title Type', 'oxence-toolkit' ),
                    'options'    => [
                        'default' => esc_html__( 'Default', 'oxence-toolkit' ),
                        'custom'  => esc_html__( 'Custom', 'oxence-toolkit' ),
                    ],
                    'default'    => 'default',
                    'dependency' => ['portfolio_page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'portfolio_custom_title',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Custom Title', 'oxence-toolkit' ),
                    'dependency' => [
                        ['portfolio_page_title', '!=', 'disabled'],
                        ['portfolio_page_title_type', '==', 'custom'],
                    ],
                    'default'    => esc_html__( 'Portfolio Details', 'oxence-toolkit' ),
                ],
                [
                    'id'         => 'portfolio_breadcrumb',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Portfolio Breadcrumb', 'oxence-toolkit' ),
                    'options'    => [
                        'default'  => esc_html__( 'Default', 'oxence-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'oxence-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'oxence-toolkit' ),
                    ],
                    'default'    => 'default',
                    'dependency' => ['portfolio_page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'customize_page_title_style',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Customize Style', 'oxence-toolkit' ),
                    'options'    => [
                        'yes' => esc_html__( 'Yes', 'oxence-toolkit' ),
                        'no'  => esc_html__( 'No', 'oxence-toolkit' ),
                    ],
                    'default'    => 'no',
                    'dependency' => ['portfolio_page_title', '!=', 'disabled'],
                ],
                [
                    'type'       => 'subheading',
                    'content'    => esc_html__( 'Page Title Styling', 'oxence-toolkit' ),
                    'dependency' => [
                        ['portfolio_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'page_title_padding',
                    'type'        => 'spacing',
                    'title'       => esc_html__( 'Padding', 'oxence-toolkit' ),
                    'output'      => '.page-title-area',
                    'output_mode' => 'padding',
                    'dependency'  => [
                        ['portfolio_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'page_title_border',
                    'type'       => 'border',
                    'title'      => esc_html__( 'Border', 'oxence-toolkit' ),
                    'output'     => '.page-title-area',
                    'dependency' => [
                        ['portfolio_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'page_title_bg',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Background Color', 'oxence-toolkit' ),
                    'output'      => '.page-title-area',
                    'output_mode' => 'background-color',
                    'dependency'  => [
                        ['portfolio_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'page_title_typo',
                    'type'       => 'typography',
                    'title'      => esc_html( 'Typography', 'oxence-toolkit' ),
                    'output'     => '.page-title-area .page-title',
                    'dependency' => [
                        ['portfolio_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'page_breadcrumb_typo',
                    'type'       => 'typography',
                    'title'      => esc_html( 'Breadcrumb Typography', 'oxence-toolkit' ),
                    'output'     => '.page-title-area .breadcrumb, .page-title-area .breadcrumb a',
                    'dependency' => [
                        ['portfolio_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
            ],
        ] );
    }

    public function team_metaboxes() {
        CSF::createMetabox( $this->team_prefix, [
            'title'        => esc_html__( 'Oxence Team Options', 'oxence-toolkit' ),
            'post_type'    => 'oxence_team',
            'show_restore' => true,
        ] );

        CSF::createSection( $this->team_prefix, [
            'title'  => esc_html__( 'General', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'General', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'member_title',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Title', 'oxence-toolkit' ),
                    'default' => esc_html__( 'Web Designer', 'oxence-toolkit' ),
                ],
                [
                    'id'    => 'member_desc',
                    'type'  => 'textarea',
                    'title' => esc_html__( 'Description', 'oxence-toolkit' ),
                ],
            ],
        ] );

        CSF::createSection( $this->team_prefix, [
            'title'  => esc_html__( 'Social Links', 'oxence-toolkit' ),
            'fields' => [
                [
                    'id'      => 'social_section_title',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Title', 'oxence-toolkit' ),
                    'default' => esc_html__( 'Follow Me', 'oxence-toolkit' ),
                ],
                [
                    'id'           => 'social_links',
                    'type'         => 'group',
                    'title'        => esc_html__( 'Social Links', 'oxence-toolkit' ),
                    'button_title' => esc_html__( 'Add New', 'oxence-toolkit' ),
                    'fields'       => [
                        [
                            'id'    => 'icon',
                            'type'  => 'icon',
                            'title' => esc_html__( 'Icon', 'oxence-toolkit' ),
                        ],
                        [
                            'id'    => 'url',
                            'type'  => 'text',
                            'title' => esc_html__( 'URL', 'oxence-toolkit' ),
                        ],
                    ],
                ],
            ],
        ] );

        CSF::createSection( $this->team_prefix, [
            'title'  => esc_html__( 'Skills', 'oxence-toolkit' ),
            'fields' => [
                [
                    'id'      => 'skill_section_title',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Title', 'oxence-toolkit' ),
                    'default' => esc_html__( 'Best Skills', 'oxence-toolkit' ),
                ],
                [
                    'id'           => 'skills',
                    'type'         => 'group',
                    'title'        => esc_html__( 'Skills', 'oxence-toolkit' ),
                    'button_title' => esc_html__( 'Add New', 'oxence-toolkit' ),
                    'fields'       => [
                        [
                            'id'    => 'title',
                            'type'  => 'text',
                            'title' => esc_html__( 'Title', 'oxence-toolkit' ),
                        ],
                        [
                            'id'    => 'percentage',
                            'type'  => 'slider',
                            'min'   => 0,
                            'max'   => 100,
                            'step'  => 1,
                            'title' => esc_html__( 'Percentage', 'oxence-toolkit' ),
                        ],
                        [
                            'id'    => 'line_color',
                            'type'  => 'color',
                            'title' => esc_html__( 'Line Color', 'oxence-toolkit' ),
                        ],
                        [
                            'id'    => 'line_bg_color',
                            'type'  => 'color',
                            'title' => esc_html__( 'Line Backgroud', 'oxence-toolkit' ),
                        ],
                    ],
                ],
            ],
        ] );

        CSF::createSection( $this->team_prefix, [
            'title'  => esc_html__( 'Experience', 'oxence-toolkit' ),
            'fields' => [
                [
                    'id'      => 'experience_section_title',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Title', 'oxence-toolkit' ),
                    'default' => esc_html__( 'Experience', 'oxence-toolkit' ),
                ],
                [
                    'id'           => 'experiences',
                    'type'         => 'group',
                    'title'        => esc_html__( 'Experiences', 'oxence-toolkit' ),
                    'button_title' => esc_html__( 'Add New', 'oxence-toolkit' ),
                    'fields'       => [
                        [
                            'id'    => 'title',
                            'type'  => 'text',
                            'title' => esc_html__( 'Title', 'oxence-toolkit' ),
                        ],
                        [
                            'id'    => 'duration',
                            'type'  => 'text',
                            'title' => esc_html__( 'Duration', 'oxence-toolkit' ),
                        ],
                        [
                            'id'    => 'desc',
                            'type'  => 'textarea',
                            'title' => esc_html__( 'Description', 'oxence-toolkit' ),
                        ],
                        [
                            'id'      => 'icon',
                            'type'    => 'media',
                            'title'   => esc_html__( 'Logo', 'oxence-toolkit' ),
                            'library' => 'image',
                        ],
                    ],
                ],
            ],
        ] );

        CSF::createSection( $this->team_prefix, [
            'title'  => esc_html__( 'Page Title', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Page Title', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'team_page_title',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Page Title', 'oxence-toolkit' ),
                    'options' => [
                        'default'  => esc_html__( 'Default', 'oxence-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'oxence-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'oxence-toolkit' ),
                    ],
                    'default' => 'default',
                ],
                [
                    'id'         => 'team_page_title_type',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Page Title Type', 'oxence-toolkit' ),
                    'options'    => [
                        'default' => esc_html__( 'Default', 'oxence-toolkit' ),
                        'custom'  => esc_html__( 'Custom', 'oxence-toolkit' ),
                    ],
                    'default'    => 'custom',
                    'dependency' => ['team_page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'team_custom_title',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Custom Title', 'oxence-toolkit' ),
                    'dependency' => [
                        ['team_page_title', '!=', 'disabled'],
                        ['team_page_title_type', '==', 'custom'],
                    ],
                    'default'    => esc_html__( 'Member Details', 'oxence-toolkit' ),
                ],
                [
                    'id'         => 'team_breadcrumb',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Breadcrumb', 'oxence-toolkit' ),
                    'options'    => [
                        'default'  => esc_html__( 'Default', 'oxence-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'oxence-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'oxence-toolkit' ),
                    ],
                    'default'    => 'default',
                    'dependency' => ['team_page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'customize_page_title_style',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Customize Style', 'oxence-toolkit' ),
                    'options'    => [
                        'yes' => esc_html__( 'Yes', 'oxence-toolkit' ),
                        'no'  => esc_html__( 'No', 'oxence-toolkit' ),
                    ],
                    'default'    => 'no',
                    'dependency' => ['team_page_title', '!=', 'disabled'],
                ],
                [
                    'type'       => 'subheading',
                    'content'    => esc_html__( 'Page Title Styling', 'oxence-toolkit' ),
                    'dependency' => [
                        ['team_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'page_title_padding',
                    'type'        => 'spacing',
                    'title'       => esc_html__( 'Padding', 'oxence-toolkit' ),
                    'output'      => '.page-title-area',
                    'output_mode' => 'padding',
                    'dependency'  => [
                        ['team_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'page_title_border',
                    'type'       => 'border',
                    'title'      => esc_html__( 'Border', 'oxence-toolkit' ),
                    'output'     => '.page-title-area',
                    'dependency' => [
                        ['team_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'page_title_bg',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Background Color', 'oxence-toolkit' ),
                    'output'      => '.page-title-area',
                    'output_mode' => 'background-color',
                    'dependency'  => [
                        ['team_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'page_title_typo',
                    'type'       => 'typography',
                    'title'      => esc_html( 'Typography', 'oxence-toolkit' ),
                    'output'     => '.page-title-area .page-title',
                    'dependency' => [
                        ['team_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'page_breadcrumb_typo',
                    'type'       => 'typography',
                    'title'      => esc_html( 'Breadcrumb Typography', 'oxence-toolkit' ),
                    'output'     => '.page-title-area .breadcrumb, .page-title-area .breadcrumb a',
                    'dependency' => [
                        ['team_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
            ],
        ] );
    }

    public function product_metaboxes() {
        CSF::createMetabox( $this->product_prefix, [
            'title'        => esc_html__( 'Portfolio Options', 'oxence-toolkit' ),
            'post_type'    => 'product',
            'show_restore' => true,
        ] );

        // Page Title
        CSF::createSection( $this->product_prefix, [
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Page Title', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'product_page_title',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Page Title', 'oxence-toolkit' ),
                    'options' => [
                        'default'  => esc_html__( 'Default', 'oxence-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'oxence-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'oxence-toolkit' ),
                    ],
                    'default' => 'default',
                ],
                [
                    'id'         => 'product_page_title_type',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Page Title Type', 'oxence-toolkit' ),
                    'options'    => [
                        'default' => esc_html__( 'Default', 'oxence-toolkit' ),
                        'custom'  => esc_html__( 'Custom', 'oxence-toolkit' ),
                    ],
                    'default'    => 'default',
                    'dependency' => ['product_page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'product_custom_title',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Custom Title', 'oxence-toolkit' ),
                    'dependency' => [
                        ['product_page_title', '!=', 'disabled'],
                        ['product_page_title_type', '==', 'custom'],
                    ],
                    'default'    => esc_html__( 'Product Details', 'oxence-toolkit' ),
                ],
                [
                    'id'         => 'product_breadcrumb',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Portfolio Breadcrumb', 'oxence-toolkit' ),
                    'options'    => [
                        'default'  => esc_html__( 'Default', 'oxence-toolkit' ),
                        'enabled'  => esc_html__( 'Enable', 'oxence-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'oxence-toolkit' ),
                    ],
                    'default'    => 'default',
                    'dependency' => ['product_page_title', '!=', 'disabled'],
                ],
                [
                    'id'         => 'customize_product_title_style',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Customize Style', 'oxence-toolkit' ),
                    'options'    => [
                        'yes' => esc_html__( 'Yes', 'oxence-toolkit' ),
                        'no'  => esc_html__( 'No', 'oxence-toolkit' ),
                    ],
                    'default'    => 'no',
                    'dependency' => ['product_page_title', '!=', 'disabled'],
                ],
                [
                    'type'       => 'subheading',
                    'content'    => esc_html__( 'Page Title Styling', 'oxence-toolkit' ),
                    'dependency' => [
                        ['product_page_title', '!=', 'disabled'],
                        ['customize_product_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'product_title_padding',
                    'type'        => 'spacing',
                    'title'       => esc_html__( 'Padding', 'oxence-toolkit' ),
                    'output'      => '.page-title-area',
                    'output_mode' => 'padding',
                    'dependency'  => [
                        ['product_page_title', '!=', 'disabled'],
                        ['customize_product_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'product_title_border',
                    'type'       => 'border',
                    'title'      => esc_html__( 'Border', 'oxence-toolkit' ),
                    'output'     => '.page-title-area',
                    'dependency' => [
                        ['product_page_title', '!=', 'disabled'],
                        ['customize_product_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'          => 'product_title_bg',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Background Color', 'oxence-toolkit' ),
                    'output'      => '.page-title-area',
                    'output_mode' => 'background-color',
                    'dependency'  => [
                        ['product_page_title', '!=', 'disabled'],
                        ['customize_product_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'product_title_typo',
                    'type'       => 'typography',
                    'title'      => esc_html( 'Typography', 'oxence-toolkit' ),
                    'output'     => '.page-title-area .page-title',
                    'dependency' => [
                        ['portfolio_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
                [
                    'id'         => 'product_breadcrumb_typo',
                    'type'       => 'typography',
                    'title'      => esc_html( 'Breadcrumb Typography', 'oxence-toolkit' ),
                    'output'     => '.page-title-area .breadcrumb, .page-title-area .breadcrumb a',
                    'dependency' => [
                        ['portfolio_page_title', '!=', 'disabled'],
                        ['customize_page_title_style', '==', 'yes'],
                    ],
                ],
            ],
        ] );
    }
}

Oxence_Metaboxes::instance()->initialize();