<?php
namespace OxenceToolkit\Helper;

use CSF;

defined( 'ABSPATH' ) || exit;

/**
 * Oxence Toolkit Helper
 */

class Oxence_Theme_Options {
    protected static $instance = null;

    private $options_prefix = 'oxence_options';
    private $menu_slug      = 'oxence_options';
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

        $this->theme_options();
        $this->preloader_section();
        $this->header_section();
        $this->page_title_section();
        $this->footer_section();
        $this->blog_section();
        $this->team_section();
        $this->portfolio_section();
        $this->service_section();
        $this->shop_section();
        $this->error_section();
        $this->color_scheme_section();
        $this->typography_section();
        $this->custom_scrips_section();
        $this->backup_section();
    }

    /**
     * Create Theme Option
     */
    public function theme_options() {
        CSF::createOptions( $this->options_prefix, [
            'menu_title'         => esc_html__( 'Theme Options', 'oxence-toolkit' ),
            'menu_slug'          => $this->menu_slug,
            'framework_title'    => esc_html__( 'Theme Options', 'oxence-toolkit' ),
            'show_in_customizer' => true,
            'menu_type'          => 'submenu',
            'menu_parent'        => 'oxence_dashboard',
        ] );
    }

    /**
     * Preloader option
     */
    public function preloader_section() {
        CSF::createSection( $this->options_prefix, [
            'title'  => esc_html__( 'Preloader', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Preloader', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'site_preloader',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Preloader?', 'oxence-toolkit' ),
                    'options' => [
                        'enabled'  => esc_html__( 'Enable', 'oxence-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'oxence-toolkit' ),
                    ],
                    'default' => 'enabled',
                ],
                [
                    'id'          => 'preloader_color_1',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Color One', 'oxence-toolkit' ),
                    'output'      => '.site-preloader',
                    'output_mode' => '--preloader-color-1',
                    'dependency'  => [
                        'site_preloader', '==', 'enabled',
                    ],
                ],
                [
                    'id'          => 'preloader_color_2',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Color Two', 'oxence-toolkit' ),
                    'output'      => '.site-preloader',
                    'output_mode' => '--preloader-color-2',
                    'dependency'  => [
                        'site_preloader', '==', 'enabled',
                    ],
                ],
                [
                    'id'          => 'preloader_color_3',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Color Three', 'oxence-toolkit' ),
                    'output'      => '.site-preloader',
                    'output_mode' => '--preloader-color-3',
                    'dependency'  => [
                        'site_preloader', '==', 'enabled',
                    ],
                ],
            ],
        ] );
    }

    /**
     * Header Options
     */
    public function header_section() {
        CSF::createSection( $this->options_prefix, [
            'id'    => 'header_options',
            'title' => esc_html__( 'Header', 'oxence-toolkit' ),
        ] );

        CSF::createSection( $this->options_prefix, [
            'parent' => 'header_options',
            'title'  => esc_html__( 'General', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'General', 'oxence-toolkit' ),
                ],
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__( 'If you used theme builder for site header then disable default theme header', 'oxence-toolkit' ),
                ],
                [
                    'id'       => 'default_header',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Default Header', 'oxence-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable Theme default header', 'oxence-toolkit' ),
                    'options'  => [
                        'enabled'  => esc_html__( 'Enable', 'oxence-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'oxence-toolkit' ),
                    ],
                    'default'  => 'enabled',
                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__( 'You disabled default theme header. Set your site header form ', 'oxence-toolkit' ) . '<a href="' . esc_url( $this->template_builder_url ) . '">' . esc_html__( 'here', 'oxence-toolkit' ) . '</a>',
                    'dependency' => [
                        'default_header', '==', 'disabled',
                    ],
                ],
                [
                    'id'         => 'header_breakpoint',
                    'type'       => 'number',
                    'title'      => esc_html__( 'Header Breakpoint', 'oxence-toolkit' ),
                    'default'    => 1200,
                    'desc'       => esc_html__( 'Enter when the slide menu will appear', 'oxence-toolkit' ),
                    'dependency' => [
                        'default_header', '==', 'enabled',
                    ],
                ],
                [
                    'id'         => 'header_button',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Show Header Button', 'oxence-toolkit' ),
                    'subtitle'   => esc_html__( 'Show a button to header right side', 'oxence-toolkit' ),
                    'options'    => [
                        'enabled'  => esc_html__( 'Enable', 'oxence-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'oxence-toolkit' ),
                    ],
                    'default'    => 'disabled',
                    'dependency' => [
                        'default_header', '==', 'enabled',
                    ],
                ],
                [
                    'id'         => 'button_text',
                    'title'      => esc_html__( 'Button Text', 'oxence-toolkit' ),
                    'type'       => 'text',
                    'default'    => esc_html__( 'Get a Free Quote', 'oxence-toolkit' ),
                    'dependency' => [
                        ['default_header', '==', 'enabled'],
                        ['header_button', '==', 'enabled'],
                    ],
                ],
                [
                    'id'         => 'button_url',
                    'title'      => esc_html__( 'Button URL', 'oxence-toolkit' ),
                    'type'       => 'text',
                    'default'    => '#',
                    'dependency' => [
                        ['default_header', '==', 'enabled'],
                        ['header_button', '==', 'enabled'],
                    ],
                ],
                [
                    'id'         => 'button_icon',
                    'title'      => esc_html__( 'Button Icon', 'oxence-toolkit' ),
                    'type'       => 'icon',
                    'default'    => 'fa fa-angle-double-right',
                    'dependency' => [
                        ['default_header', '==', 'enabled'],
                        ['header_button', '==', 'enabled'],
                    ],
                ],
                [
                    'id'      => 'transparent_header',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Transparent Header', 'oxence-toolkit' ),
                    'desc'    => esc_html__( 'Set header to transparent background before scroll.', 'oxence-toolkit' ),
                    'options' => [
                        'enabled'  => esc_html__( 'Enable', 'oxence-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'oxence-toolkit' ),
                    ],
                    'default' => 'enabled',
                ],
            ],
        ] );

        CSF::createSection( $this->options_prefix, [
            'parent' => 'header_options',
            'title'  => esc_html__( 'Logo', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Logo', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'site_logo_type',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Site Logo Type', 'oxence-toolkit' ),
                    'options' => [
                        'text'  => esc_html__( 'Text', 'oxence-toolkit' ),
                        'image' => esc_html__( 'Image', 'oxence-toolkit' ),
                    ],
                    'default' => 'image',
                ],
                [
                    'id'         => 'site_text_logo',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Text logo', 'oxence-toolkit' ),
                    'default'    => esc_html__( 'Oxence', 'oxence-toolkit' ),
                    'dependency' => ['site_logo_type', '==', 'text'],
                ],
                [
                    'id'         => 'site_image_logo',
                    'type'       => 'media',
                    'title'      => esc_html__( 'Image logo', 'oxence-toolkit' ),
                    'library'    => 'image',
                    'url'        => false,
                    'default'    => [
                        'url'       => OT_ASSETS . '/img/options/logo.png',
                        'thumbnail' => OT_ASSETS . '/img/options/logo.png',
                    ],
                    'dependency' => ['site_logo_type', '==', 'image'],
                ],
                [
                    'id'         => 'logo_dimension',
                    'type'       => 'dimensions',
                    'title'      => esc_html__( 'Logo Dimensions', 'oxence-toolkit' ),
                    'output'     => '.default-header .oxence-site-logo img',
                    'dependency' => ['site_logo_type', '==', 'image'],
                ],
                [
                    'id'          => 'logo_max_width',
                    'type'        => 'number',
                    'unit'        => 'px',
                    'title'       => esc_html__( 'Max Width', 'oxence-toolkit' ),
                    'desc'        => esc_html__( 'Logo wrapper max width', 'oxence-toolkit' ),
                    'output'      => '.default-header .oxence-site-logo',
                    'output_mode' => 'max-width',
                ],
                [
                    'id'      => 'panel_logo_type',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Panel Logo Type', 'oxence-toolkit' ),
                    'options' => [
                        'text'  => esc_html__( 'Text', 'oxence-toolkit' ),
                        'image' => esc_html__( 'Image', 'oxence-toolkit' ),
                    ],
                    'default' => 'text',
                ],
                [
                    'id'         => 'panel_text_logo',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Text logo', 'oxence-toolkit' ),
                    'default'    => 'Oxence',
                    'dependency' => ['panel_logo_type', '==', 'text'],
                ],
                [
                    'id'         => 'panel_image_logo',
                    'type'       => 'media',
                    'title'      => esc_html__( 'Image logo', 'oxence-toolkit' ),
                    'library'    => 'image',
                    'url'        => false,
                    'default'    => [
                        'url'       => OT_ASSETS . '/img/options/logo.png',
                        'thumbnail' => OT_ASSETS . '/img/options/logo.png',
                    ],
                    'dependency' => ['panel_logo_type', '==', 'image'],
                ],
                [
                    'id'         => 'slide_panel_dimension',
                    'type'       => 'dimensions',
                    'title'      => esc_html__( 'Logo Dimensions', 'oxence-toolkit' ),
                    'output'     => '.default-header .slide-panel-logo img',
                    'dependency' => ['panel_logo_type', '==', 'image'],
                ],
            ],
        ] );

        CSF::createSection( $this->options_prefix, [
            'parent' => 'header_options',
            'title'  => esc_html__( 'Styling', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Header Styling', 'oxence-toolkit' ),
                ],
                [
                    'id'               => 'header_bg',
                    'type'             => 'color',
                    'title'            => esc_html__( 'Header Background', 'oxence-toolkit' ),
                    'output'           => ['.site-header.default-header'],
                    'output_mode'      => 'background-color',
                    'output_important' => true,
                ],
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Menu Items', 'oxence-toolkit' ),
                ],
                [
                    'id'          => 'menu_item_color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Menu Item Color', 'oxence-toolkit' ),
                    'desc'        => esc_html__( 'This is the menu item font color.', 'oxence-toolkit' ),
                    'output'      => ['.default-header .oxence-nav-menu .nav-menu-wrapper a'],
                    'output_mode' => 'color',
                ],
                [
                    'id'          => 'menu_item_hover_color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Active/Current Color', 'oxence-toolkit' ),
                    'desc'        => esc_html__( 'This is the menu item font color.', 'oxence-toolkit' ),
                    'output'      => ['.default-header .oxence-nav-menu .nav-menu-wrapper a:hover, .default-header .oxence-nav-menu .nav-menu-wrapper li.current_page_item > a'],
                    'output_mode' => 'color',
                ],
                [
                    'id'     => 'menu_typography',
                    'type'   => 'typography',
                    'title'  => esc_html__( 'Menu Typography', 'oxence-toolkit' ),
                    'color'  => false,
                    'output' => '.default-header .oxence-nav-menu .nav-menu-wrapper a',
                ],
                [
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Submenu', 'oxence-toolkit' ),
                ],
                [
                    'id'          => 'submenu_bg',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Submenu Background', 'oxence-toolkit' ),
                    'output'      => '.default-header .oxence-nav-menu .nav-menu-wrapper .sub-menu',
                    'output_mode' => 'background-color',
                ],
                [
                    'id'          => 'submenu_item_divider',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Item Divider', 'oxence-toolkit' ),
                    'output'      => '.default-header .oxence-nav-menu .nav-menu-wrapper .sub-menu li:not(:last-child)',
                    'output_mode' => 'border-color',
                ],
                [
                    'id'          => 'submenu_item_color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Item Color', 'oxence-toolkit' ),
                    'output'      => '.default-header .oxence-nav-menu .nav-menu-wrapper .sub-menu a',
                    'output_mode' => 'color',
                ],
                [
                    'id'          => 'submenu_item_hover_color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Item Hover Color', 'oxence-toolkit' ),
                    'output'      => '.default-header .oxence-nav-menu .nav-menu-wrapper .sub-menu a:hover',
                    'output_mode' => 'color',
                ],
                [
                    'id'     => 'submenu_typography',
                    'type'   => 'typography',
                    'title'  => esc_html__( 'Item Typography', 'oxence-toolkit' ),
                    'color'  => false,
                    'output' => '.default-header .oxence-nav-menu .nav-menu-wrapper .sub-menu a',
                ],
                [
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Slide Panel', 'oxence-toolkit' ),
                ],
                [
                    'id'     => 'toggler_color',
                    'type'   => 'color',
                    'title'  => esc_html__( 'Toggler Color', 'oxence-toolkit' ),
                    'output' => [
                        'border-color'     => '.default-header .oxence-nav-menu .navbar-toggler',
                        'background-color' => '.default-header .oxence-nav-menu .navbar-toggler .line',
                    ],
                ],
                [
                    'id'          => 'slide_panel_bg',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Background', 'oxence-toolkit' ),
                    'output'      => '.default-header .oxence-nav-menu .slide-panel-wrapper.show-panel .slide-panel-content',
                    'output_mode' => 'background-color',
                ],
                [
                    'id'          => 'panel_item_divider',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Item Divider', 'oxence-toolkit' ),
                    'output'      => ['.default-header .oxence-nav-menu .slide-panel-wrapper .slide-panel-menu a', '.default-header .oxence-nav-menu .slide-panel-wrapper ul.primary-menu'],
                    'output_mode' => 'border-color',
                ],
                [
                    'id'          => 'panel_item_color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Item Color', 'oxence-toolkit' ),
                    'output'      => ['.default-header .oxence-nav-menu .slide-panel-wrapper .slide-panel-menu a', '.default-header .oxence-nav-menu .slide-panel-wrapper .slide-panel-close'],
                    'output_mode' => 'color',
                ],
                [
                    'id'          => 'panel_item_hover_color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Item Hover Color', 'oxence-toolkit' ),
                    'output'      => '.default-header .oxence-nav-menu .slide-panel-wrapper .slide-panel-menu li.current_page_item > a',
                    'output_mode' => 'color',
                ],
                [
                    'id'     => 'panel_typography',
                    'type'   => 'typography',
                    'title'  => esc_html__( 'Item Typography', 'oxence-toolkit' ),
                    'color'  => false,
                    'output' => '.default-header .oxence-nav-menu .slide-panel-wrapper .slide-panel-menu a',
                ],
            ],
        ] );
    }

    /**
     * Page Title
     */
    public function page_title_section() {
        CSF::createSection( $this->options_prefix, [
            'title'  => esc_html__( 'Page Title', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Page Title', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'site_page_title',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Site Page Title', 'oxence-toolkit' ),
                    'options' => [
                        'enabled'  => esc_html__( 'Enable', 'oxence-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'oxence-toolkit' ),
                    ],
                    'default' => 'enabled',
                ],
                [
                    'id'         => 'site_breadcrumb',
                    'type'       => 'button_set',
                    'title'      => esc_html__( 'Site Breadcrumb', 'oxence-toolkit' ),
                    'options'    => [
                        'enabled'  => esc_html__( 'Enable', 'oxence-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'oxence-toolkit' ),
                    ],
                    'default'    => 'enabled',
                    'dependency' => ['site_page_title', '==', 'enabled'],
                ],
                [
                    'type'       => 'subheading',
                    'content'    => esc_html__( 'Page Title Styling', 'oxence-toolkit' ),
                    'dependency' => ['site_page_title', '==', 'enabled'],
                ],
                [
                    'id'          => 'page_title_padding',
                    'type'        => 'spacing',
                    'title'       => esc_html__( 'Padding', 'oxence-toolkit' ),
                    'output'      => '.page-title-area',
                    'output_mode' => 'padding',
                    'dependency'  => ['site_page_title', '==', 'enabled'],
                ],
                [
                    'id'         => 'page_title_border',
                    'type'       => 'border',
                    'title'      => esc_html__( 'Border', 'oxence-toolkit' ),
                    'output'     => '.page-title-area',
                    'dependency' => ['site_page_title', '==', 'enabled'],
                ],
                [
                    'id'          => 'page_title_bg',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Background Color', 'oxence-toolkit' ),
                    'output'      => '.page-title-area',
                    'output_mode' => 'background-color',
                    'dependency'  => ['site_page_title', '==', 'enabled'],
                ],
                [
                    'id'         => 'page_title_typo',
                    'type'       => 'typography',
                    'title'      => esc_html( 'Typography', 'oxence-toolkit' ),
                    'output'     => '.page-title-area .page-title',
                    'dependency' => ['site_page_title', '==', 'enabled'],
                ],
                [
                    'id'         => 'page_breadcrumb_typo',
                    'type'       => 'typography',
                    'title'      => esc_html( 'Breadcrumb Typography', 'oxence-toolkit' ),
                    'output'     => '.page-title-area .breadcrumb, .page-title-area .breadcrumb a',
                    'dependency' => ['site_page_title', '==', 'enabled'],
                ],
            ],
        ] );
    }

    /**
     * Footer Options
     */
    public function footer_section() {
        CSF::createSection( $this->options_prefix, [
            'id'    => 'footer_options',
            'title' => esc_html__( 'Footer', 'oxence-toolkit' ),
        ] );

        CSF::createSection( $this->options_prefix, [
            'parent' => 'footer_options',
            'title'  => esc_html__( 'General', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'General', 'oxence-toolkit' ),
                ],
                [
                    'type'    => 'notice',
                    'style'   => 'info',
                    'content' => esc_html__( 'If you used theme builder for site footer then disable default theme header', 'oxence-toolkit' ),
                ],
                [
                    'id'       => 'default_footer',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Default Footer', 'oxence-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable Theme default footer', 'oxence-toolkit' ),
                    'options'  => [
                        'enabled'  => esc_html__( 'Enable', 'oxence-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'oxence-toolkit' ),
                    ],
                    'default'  => 'enabled',
                ],
                [
                    'type'       => 'notice',
                    'style'      => 'warning',
                    'content'    => esc_html__( 'You disabled default theme footer. Set your site footer form ', 'oxence-toolkit' ) . '<a href="' . esc_url( $this->template_builder_url ) . '">' . esc_html__( 'here', 'oxence-toolkit' ) . '</a>',
                    'dependency' => [
                        'default_footer', '==', 'disabled',
                    ],
                ],
            ],
        ] );

        CSF::createSection( $this->options_prefix, [
            'parent' => 'footer_options',
            'title'  => esc_html__( 'Footer Widgets', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Footer Widgets', 'oxence-toolkit' ),
                ],
                [
                    'id'          => 'footer_background',
                    'type'        => 'background',
                    'title'       => esc_html__( 'Footer background', 'oxence-toolkit' ),
                    'output'      => '.site-footer .footer-widgets',
                    'output_mode' => 'background-color',
                ],
                [
                    'id'          => 'footer_divider',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Divider Color', 'oxence-toolkit' ),
                    'output'      => '.site-footer .footer-widgets',
                    'output_mode' => 'border-color',
                ],
                [
                    'id'     => 'footer_text_color',
                    'type'   => 'color',
                    'title'  => esc_html__( 'Text Color', 'oxence-toolkit' ),
                    'output' => [
                        'color' => '.footer-widgets .widget, .footer-widgets .widget a, .footer-widgets .widget.widget_pages a::before, .footer-widgets .widget.widget_pages a, .footer-widgets .widget.widget_meta a::before, .footer-widgets .widget.widget_meta a, .footer-widgets .widget.widget_nav_menu a::before, .footer-widgets .widget.widget_nav_menu a, .footer-widgets .widget.widget_recent_entries a::before, .footer-widgets .widget.widget_recent_entries a, .footer-widgets .widget.widget_block .wp-block-categories a, .footer-widgets .widget.widget_block .wp-block-archives a, .footer-widgets .widget.widget_categories a, .footer-widgets .widget.widget_archive a, .footer-widgets .widget.widget_tag_cloud .wp-block-tag-cloud a, .footer-widgets .widget.widget_tag_cloud .tagcloud a, .footer-widgets .widget.widget_block .wp-block-latest-comments a, .footer-widgets .widget.widget_recent_comments a',
                    ],
                ],
                [
                    'id'     => 'footer_text_hover_color',
                    'type'   => 'color',
                    'title'  => esc_html__( 'Hover Color', 'oxence-toolkit' ),
                    'output' => [
                        'color'            => '.footer-widgets .widget.widget_pages a:hover, .footer-widgets .widget.widget_meta a:hover, .footer-widgets .widget.widget_nav_menu a:hover, .footer-widgets .widget.widget_recent_entries a:hover, .footer-widgets .widget.widget_block .wp-block-categories a:hover, .footer-widgets .widget.widget_block .wp-block-archives a:hover, .footer-widgets .widget.widget_categories a:hover, .footer-widgets .widget.widget_archive a:hover, .footer-widgets .widget.widget_rss a.rsswidget:hover, .footer-widgets .widget.widget_block .wp-block-latest-comments a:hover, .footer-widgets .widget.widget_recent_comments a:hover',
                        'border-color'     => '.footer-widgets .widget.widget_tag_cloud .wp-block-tag-cloud a:hover, .footer-widgets .widget.widget_tag_cloud .tagcloud a:hover',
                        'background-color' => '.footer-widgets .widget.widget_tag_cloud .wp-block-tag-cloud a:hover, .footer-widgets .widget.widget_tag_cloud .tagcloud a:hover, .footer-widgets .widget.widget_search button, .footer-widgets .widget.widget_search button:hover',
                    ],
                ],
                [
                    'id'               => 'footer_content_typography',
                    'type'             => 'typography',
                    'title'            => esc_html__( 'Content Typography', 'oxence-toolkit' ),
                    'color'            => false,
                    'line_height_unit' => 'em',
                    'preview'          => false,
                    'output'           => ['.site-footer .footer-widgets .widget'],
                ],
                [
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Widget Title', 'oxence-toolkit' ),
                ],
                [
                    'id'               => 'footer_title_typography',
                    'type'             => 'typography',
                    'title'            => esc_html__( 'Title', 'oxence-toolkit' ),
                    'output'           => '.footer-widgets .widget .widget-title',
                    'color'            => false,
                    'line_height_unit' => 'em',
                    'preview'          => false,
                ],
                [
                    'id'     => 'footer_title_color',
                    'type'   => 'color',
                    'title'  => esc_html__( 'Color', 'oxence-toolkit' ),
                    'output' => '.footer-widgets .widget .widget-title, .footer-widgets .widget.widget_rss a.rsswidget',
                ],
            ],
        ] );

        CSF::createSection( $this->options_prefix, [
            'parent' => 'footer_options',
            'title'  => esc_html__( 'Footer Copyright', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Footer', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'copyright_text',
                    'type'    => 'textarea',
                    'title'   => esc_html__( 'Copyright Text', 'oxence-toolkit' ),
                    'default' => esc_html__( 'Copyright © 2022. All rights reserved.', 'oxence-toolkit' ),
                ],
                [
                    'type'    => 'subheading',
                    'content' => esc_html__( 'Style', 'oxence-toolkit' ),
                ],
                [
                    'id'          => 'copyright_color_bg',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Copyright Background', 'oxence-toolkit' ),
                    'output'      => '.site-footer .footer-copyright',
                    'output_mode' => 'background-color',
                ],
                [
                    'id'     => 'copyright_color',
                    'type'   => 'color',
                    'title'  => esc_html__( 'Copyright text color', 'oxence-toolkit' ),
                    'output' => '.site-footer .footer-copyright, .site-footer .footer-copyright a',
                ],
            ],
        ] );
    }

    /**
     * Blog Options
     */
    public function blog_section() {
        CSF::createSection( $this->options_prefix, [
            'id'    => 'blog_options',
            'title' => esc_html__( 'Blog', 'oxence-toolkit' ),
        ] );

        CSF::createSection( $this->options_prefix, [
            'parent' => 'blog_options',
            'title'  => esc_html__( 'Blog Archive', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Blog Archive', 'oxence-toolkit' ),
                ],
                [
                    'id'          => 'blog_archive_title',
                    'type'        => 'text',
                    'title'       => esc_html__( 'Blog Archive Title', 'oxence-toolkit' ),
                    'placeholder' => esc_html__( 'Type title', 'oxence-toolkit' ),
                    'default'     => esc_html__( 'Latest News', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'blog_archive_layout',
                    'type'    => 'image_select',
                    'title'   => esc_html__( 'Archive Layout', 'oxence-toolkit' ),
                    'options' => [
                        'boxed-layout'      => OT_ASSETS . '/img/options/boxed-layout.jpg',
                        'full-width-layout' => OT_ASSETS . '/img/options/full-width-layout.jpg',
                    ],
                    'default' => 'boxed-layout',
                    'desc'    => esc_html__( 'Select Archive layout. Full width or In container.  Settings will also apply on the blog category and tag archive pages', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'blog_archive_sidebar',
                    'type'    => 'image_select',
                    'title'   => esc_html__( 'Sidebar', 'oxence-toolkit' ),
                    'options' => [
                        'left-sidebar'  => OT_ASSETS . '/img/options/left-sidebar.jpg',
                        'right-sidebar' => OT_ASSETS . '/img/options/right-sidebar.jpg',
                        'no-sidebar'    => OT_ASSETS . '/img/options/no-sidebar.jpg',
                    ],
                    'default' => 'right-sidebar',
                    'desc'    => esc_html__( 'Select Page Sidebar. Left sidebar or right sidebar or No sidebar', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'blog_post_view',
                    'type'    => 'image_select',
                    'title'   => esc_html__( 'Post View', 'oxence-toolkit' ),
                    'options' => [
                        'grid-view' => OT_ASSETS . '/img/options/grid.jpg',
                        'list-view' => OT_ASSETS . '/img/options/list.jpg',
                    ],
                    'default' => 'list-view',
                    'desc'    => esc_html__( 'Select Page Sidebar. Left sidebar or right sidebar or No sidebar', 'oxence-toolkit' ),
                ],
                [
                    'id'       => 'archive_post_meta',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Show Post Meta', 'oxence-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable Post meta on Blog Archive page', 'oxence-toolkit' ),
                    'options'  => [
                        'yes' => esc_html__( 'Yes', 'oxence-toolkit' ),
                        'no'  => esc_html__( 'No', 'oxence-toolkit' ),
                    ],
                    'default'  => 'yes',
                ],
                [
                    'id'       => 'archive_post_excerpt',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Show Post Excerpt', 'oxence-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable Post Excerpt on Blog Archive page', 'oxence-toolkit' ),
                    'options'  => [
                        'yes' => esc_html__( 'Yes', 'oxence-toolkit' ),
                        'no'  => esc_html__( 'No', 'oxence-toolkit' ),
                    ],
                    'default'  => 'yes',
                ],
                [
                    'id'         => 'post_excerpt_count',
                    'type'       => 'number',
                    'title'      => esc_html__( 'Excerpt Word Count', 'oxence-toolkit' ),
                    'subtitle'   => esc_html__( 'Set how many words you want to show in the post Excerpt', 'oxence-toolkit' ),
                    'default'    => 12,
                    'dependency' => [
                        'archive_post_excerpt', '==', 'yes',
                    ],
                ],
                [
                    'id'       => 'archive_post_button',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Show Read More Button', 'oxence-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable Post Read More Button on Blog Archive page', 'oxence-toolkit' ),
                    'options'  => [
                        'yes' => esc_html__( 'Yes', 'oxence-toolkit' ),
                        'no'  => esc_html__( 'No', 'oxence-toolkit' ),
                    ],
                    'default'  => 'yes',
                ],
                [
                    'id'         => 'post_button_text',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Button Text', 'oxence-toolkit' ),
                    'default'    => esc_html__( 'Read More', 'oxence-toolkit' ),
                    'dependency' => [
                        'archive_post_button', '==', 'yes',
                    ],
                ],
            ],
        ] );

        CSF::createSection( $this->options_prefix, [
            'parent' => 'blog_options',
            'title'  => esc_html__( 'Blog Single', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Blog single', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'blog_details_layout',
                    'type'    => 'image_select',
                    'title'   => esc_html__( 'Details Layout', 'oxence-toolkit' ),
                    'options' => [
                        'boxed-layout'      => OT_ASSETS . '/img/options/boxed-layout.jpg',
                        'full-width-layout' => OT_ASSETS . '/img/options/full-width-layout.jpg',
                    ],
                    'default' => 'boxed-layout',
                    'desc'    => esc_html__( 'Select Blog details layout. Full width or In container', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'blog_details_sidebar',
                    'type'    => 'image_select',
                    'title'   => esc_html__( 'Sidebar', 'oxence-toolkit' ),
                    'options' => [
                        'left-sidebar'  => OT_ASSETS . '/img/options/left-sidebar.jpg',
                        'right-sidebar' => OT_ASSETS . '/img/options/right-sidebar.jpg',
                        'no-sidebar'    => OT_ASSETS . '/img/options/no-sidebar.jpg',
                    ],
                    'default' => 'right-sidebar',
                    'desc'    => esc_html__( 'Select Blog Details Sidebar. Left sidebar or right sidebar or No sidebar', 'oxence-toolkit' ),
                ],
                [
                    'id'       => 'blog_details_meta',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Show Post Meta', 'oxence-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable Post meta on Blog Details page', 'oxence-toolkit' ),
                    'options'  => [
                        'yes' => esc_html__( 'Yes', 'oxence-toolkit' ),
                        'no'  => esc_html__( 'No', 'oxence-toolkit' ),
                    ],
                    'default'  => 'yes',
                ],
                [
                    'id'       => 'blog_details_share',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Show Post Share Links', 'oxence-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable Post social share links.', 'oxence-toolkit' ),
                    'options'  => [
                        'yes' => esc_html__( 'Yes', 'oxence-toolkit' ),
                        'no'  => esc_html__( 'No', 'oxence-toolkit' ),
                    ],
                    'default'  => 'no',
                ],
                [
                    'id'         => 'social_share_item',
                    'type'       => 'sorter',
                    'title'      => esc_html__( 'Social Share Links', 'oxence-toolkit' ),
                    'default'    => [
                        'enabled'  => [
                            'facebook'  => esc_html__( 'Facebook', 'oxence-toolkit' ),
                            'twitter'   => esc_html__( 'Twitter', 'oxence-toolkit' ),
                            'pinterest' => esc_html__( 'Pinterest', 'oxence-toolkit' ),
                            'linkedin'  => esc_html__( 'Linkedin', 'oxence-toolkit' ),
                        ],
                        'disabled' => [
                            'reddit'   => esc_html__( 'Reddit', 'oxence-toolkit' ),
                            'whatsapp' => esc_html__( 'Whatsapp', 'oxence-toolkit' ),
                            'telegram' => esc_html__( 'Telegram', 'oxence-toolkit' ),
                        ],
                    ],
                    'dependency' => [
                        'blog_details_share', '==', 'yes',
                    ],
                ],
                [
                    'id'       => 'blog_details_tag',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Show Related Tags', 'oxence-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable related tag on Blog Details page', 'oxence-toolkit' ),
                    'options'  => [
                        'yes' => esc_html__( 'Yes', 'oxence-toolkit' ),
                        'no'  => esc_html__( 'No', 'oxence-toolkit' ),
                    ],
                    'default'  => 'yes',
                ],
                [
                    'id'       => 'blog_details_nav',
                    'type'     => 'button_set',
                    'title'    => esc_html__( 'Show Post Nav', 'oxence-toolkit' ),
                    'subtitle' => esc_html__( 'Enable or Disable Post nav on Blog Details page', 'oxence-toolkit' ),
                    'options'  => [
                        'yes' => esc_html__( 'Yes', 'oxence-toolkit' ),
                        'no'  => esc_html__( 'No', 'oxence-toolkit' ),
                    ],
                    'default'  => 'yes',
                ],
                [
                    'id'      => 'blog_author_info',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Show Author Information', 'oxence-toolkit' ),
                    'options' => [
                        'yes' => esc_html__( 'Yes', 'oxence-toolkit' ),
                        'no'  => esc_html__( 'No', 'oxence-toolkit' ),
                    ],
                    'default' => 'no',
                ],
            ],
        ] );
    }

    /**
     * Team Section
     *
     * @return void
     */
    public function team_section() {
        CSF::createSection( $this->options_prefix, [
            'title'  => esc_html__( 'Team(CPT)', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Team Archive', 'oxence-toolkit' ),
                ],
                [
                    'id'          => 'team_slug',
                    'type'        => 'text',
                    'title'       => esc_html__( 'Team Slug', 'oxence-toolkit' ),
                    'placeholder' => esc_html__( 'team-members', 'oxence-toolkit' ),
                    'desc'        => esc_html__( 'You can customize the permalink structure (site_domain/post_type_slug/post_slug) by changing the post type slug (post_type_slug) from here. Don\'t forget to save the permalinks settings from Settings > Permalinks after changing the slug value.', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'team_archive_layout',
                    'type'    => 'image_select',
                    'title'   => esc_html__( 'Team Archive Layout', 'oxence-toolkit' ),
                    'options' => [
                        'boxed-layout'      => OT_ASSETS . '/img/options/boxed-layout.jpg',
                        'full-width-layout' => OT_ASSETS . '/img/options/full-width-layout.jpg',
                    ],
                    'default' => 'boxed-layout',
                    'desc'    => esc_html__( 'Select Team archive layout. Full width or In container.', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'team_post_per_page',
                    'type'    => 'number',
                    'title'   => esc_html__( 'Post Per Page', 'oxence-toolkit' ),
                    'default' => 12,
                    'desc'    => esc_html__( 'Number of posts to show per page', 'oxence-toolkit' ),
                ],
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Team Single', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'team_single_layout',
                    'type'    => 'image_select',
                    'title'   => esc_html__( 'Team Single Layout', 'oxence-toolkit' ),
                    'options' => [
                        'boxed-layout'      => OT_ASSETS . '/img/options/boxed-layout.jpg',
                        'full-width-layout' => OT_ASSETS . '/img/options/full-width-layout.jpg',
                    ],
                    'default' => 'boxed-layout',
                    'desc'    => esc_html__( 'Select Team single layout. Full width or In container.', 'oxence-toolkit' ),
                ],
            ],
        ] );
    }

    /**
     * Portfolio Section
     *
     * @return void
     */
    public function portfolio_section() {
        CSF::createSection( $this->options_prefix, [
            'title'  => esc_html__( 'Portfolio(CPT)', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Portfolio Archive', 'oxence-toolkit' ),
                ],
                [
                    'id'          => 'portfolio_slug',
                    'type'        => 'text',
                    'title'       => esc_html__( 'Portfolio Slug', 'oxence-toolkit' ),
                    'placeholder' => esc_html__( 'portfolio', 'oxence-toolkit' ),
                    'desc'        => esc_html__( 'You can customize the permalink structure (site_domain/post_type_slug/post_slug) by changing the post type slug (post_type_slug) from here. Don\'t forget to save the permalinks settings from Settings > Permalinks after changing the slug value.', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'portfolio_archive_layout',
                    'type'    => 'image_select',
                    'title'   => esc_html__( 'Portfolio Archive Layout', 'oxence-toolkit' ),
                    'options' => [
                        'boxed-layout'      => OT_ASSETS . '/img/options/boxed-layout.jpg',
                        'full-width-layout' => OT_ASSETS . '/img/options/full-width-layout.jpg',
                    ],
                    'default' => 'boxed-layout',
                    'desc'    => esc_html__( 'Select Portfolio archive layout. Full width or In container.', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'portfolio_post_per_page',
                    'type'    => 'number',
                    'title'   => esc_html__( 'Post Per Page', 'oxence-toolkit' ),
                    'default' => 12,
                    'desc'    => esc_html__( 'Number of posts to show per page', 'oxence-toolkit' ),
                ],
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Portfolio Single', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'portfolio_single_layout',
                    'type'    => 'image_select',
                    'title'   => esc_html__( 'Portfolio Single Layout', 'oxence-toolkit' ),
                    'options' => [
                        'boxed-layout'      => OT_ASSETS . '/img/options/boxed-layout.jpg',
                        'full-width-layout' => OT_ASSETS . '/img/options/full-width-layout.jpg',
                    ],
                    'default' => 'boxed-layout',
                    'desc'    => esc_html__( 'Select Team single layout. Full width or In container.', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'show_related_portfolio',
                    'type'    => 'switcher',
                    'title'   => esc_html__( 'Show Related Portfolio', 'oxence-toolkit' ),
                    'default' => false,
                ],
                [
                    'id'         => 'related_title',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Related Title', 'oxence-toolkit' ),
                    'default'    => esc_html__( 'Related Portfolio', 'oxence-toolkit' ),
                    'dependency' => [
                        'show_related_portfolio', '==', 'true',
                    ],
                ],
                [
                    'id'         => 'related_sub_title',
                    'type'       => 'text',
                    'title'      => esc_html__( 'Related Subtitle', 'oxence-toolkit' ),
                    'default'    => esc_html__( 'Pre-made Template', 'oxence-toolkit' ),
                    'dependency' => [
                        'show_related_portfolio', '==', 'true',
                    ],
                ],
                [
                    'id'      => 'show_portfolio_nav',
                    'type'    => 'switcher',
                    'title'   => esc_html__( 'Show Portfolio Nav', 'oxence-toolkit' ),
                    'default' => false,
                ],
            ],
        ] );
    }

    /**
     * Services Section
     *
     * @return void
     */
    public function service_section() {
        CSF::createSection( $this->options_prefix, [
            'title'  => esc_html__( 'Services(CPT)', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Service Archive', 'oxence-toolkit' ),
                ],
                [
                    'id'          => 'service_slug',
                    'type'        => 'text',
                    'title'       => esc_html__( 'Services Slug', 'oxence-toolkit' ),
                    'placeholder' => esc_html__( 'services', 'oxence-toolkit' ),
                    'desc'        => esc_html__( 'You can customize the permalink structure (site_domain/post_type_slug/post_slug) by changing the post type slug (post_type_slug) from here. Don\'t forget to save the permalinks settings from Settings > Permalinks after changing the slug value.', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'service_archive_layout',
                    'type'    => 'image_select',
                    'title'   => esc_html__( 'Team Archive Layout', 'oxence-toolkit' ),
                    'options' => [
                        'boxed-layout'      => OT_ASSETS . '/img/options/boxed-layout.jpg',
                        'full-width-layout' => OT_ASSETS . '/img/options/full-width-layout.jpg',
                    ],
                    'default' => 'boxed-layout',
                    'desc'    => esc_html__( 'Select Service archive layout. Full width or In container.', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'service_post_per_page',
                    'type'    => 'number',
                    'title'   => esc_html__( 'Post Per Page', 'oxence-toolkit' ),
                    'default' => 8,
                    'desc'    => esc_html__( 'Number of posts to show per page', 'oxence-toolkit' ),
                ],
            ],
        ] );
    }

    /**
     * Shop Section
     */
    public function shop_section() {
        CSF::createSection( $this->options_prefix, [
            'id'     => 'shop_options',
            'title'  => esc_html__( 'Shop', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Shop', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'shop_layout',
                    'type'    => 'image_select',
                    'title'   => esc_html__( 'Team Archive Layout', 'oxence-toolkit' ),
                    'options' => [
                        'boxed-layout'      => OT_ASSETS . '/img/options/boxed-layout.jpg',
                        'full-width-layout' => OT_ASSETS . '/img/options/full-width-layout.jpg',
                    ],
                    'default' => 'boxed-layout',
                    'desc'    => esc_html__( 'Select Service archive layout. Full width or In container.', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'cart_sidebar',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Cart Sidebar', 'oxence-toolkit' ),
                    'options' => [
                        'enabled'  => esc_html__( 'Enable', 'oxence-toolkit' ),
                        'disabled' => esc_html__( 'Disable', 'oxence-toolkit' ),
                    ],
                    'default' => 'enabled',
                    'desc'    => esc_html__( 'Enable Or Disable floating shopping cart', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'product_loop_columns',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Columns', 'oxence-toolkit' ),
                    'options' => [
                        '1' => esc_html__( 'One', 'oxence-toolkit' ),
                        '2' => esc_html__( 'Two', 'oxence-toolkit' ),
                        '3' => esc_html__( 'Three', 'oxence-toolkit' ),
                    ],
                    'default' => '3',
                    'desc'    => esc_html__( 'How many column should be shown per row?', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'product_loop_per_page',
                    'type'    => 'number',
                    'title'   => esc_html__( 'Product Per page', 'oxence-toolkit' ),
                    'default' => 9,
                    'desc'    => esc_html__( 'How many products should be shown per page?', 'oxence-toolkit' ),
                ],
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Related Product', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'enable_related_product',
                    'type'    => 'switcher',
                    'title'   => esc_html__( 'Related Product', 'oxence-toolkit' ),
                    'default' => true,
                ],

                [
                    'id'      => 'related_product_columns',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Columns', 'oxence-toolkit' ),
                    'options' => [
                        '1' => esc_html__( 'One', 'oxence-toolkit' ),
                        '2' => esc_html__( 'Two', 'oxence-toolkit' ),
                        '3' => esc_html__( 'Three', 'oxence-toolkit' ),
                    ],
                    'default' => '3',
                    'desc'    => esc_html__( 'How many column should be shown per row?', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'related_product_per_page',
                    'type'    => 'number',
                    'title'   => esc_html__( 'Product Per page', 'oxence-toolkit' ),
                    'default' => 3,
                    'desc'    => esc_html__( 'How many products should be shown per page?', 'oxence-toolkit' ),
                ],
            ],
        ] );
    }

    /**
     * Error Options
     */
    public function error_section() {
        CSF::createSection( $this->options_prefix, [
            'title'  => esc_html__( 'Error 404', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Error Page', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'error_title',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Title', 'oxence-toolkit' ),
                    'default' => esc_html__( '404', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'error_sub_title',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Sub Title', 'oxence-toolkit' ),
                    'default' => esc_html__( 'Sorry, This page is not found.', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'error_note',
                    'type'    => 'textarea',
                    'title'   => esc_html__( 'Error Page Note', 'oxence-toolkit' ),
                    'default' => esc_html__( 'The page you are looking for was moved, removed, renamed or might never existed.', 'oxence-toolkit' ),
                ],
                [
                    'id'      => 'error_button_text',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Error Button Text', 'oxence-toolkit' ),
                    'default' => esc_html__( 'Return To Home', 'oxence-toolkit' ),
                ],
            ],
        ] );
    }

    /**
     * Color Options
     */
    public function color_scheme_section() {
        CSF::createSection( $this->options_prefix, [
            'title'  => esc_html__( 'Color Scheme', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Color Scheme', 'oxence-toolkit' ),
                ],
                [
                    'id'       => 'primary_color',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Primary Color', 'oxence-toolkit' ),
                    'subtitle' => esc_html__( 'Your main brand color. Used by most elements throughout the website.', 'oxence-toolkit' ),
                    'default'  => '#3180fc',
                    'desc'     => esc_html__( 'Default: #3180fc', 'oxence-toolkit' ),
                ],
                [
                    'id'       => 'secondary_color',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Secondary Color', 'oxence-toolkit' ),
                    'subtitle' => esc_html__( 'Your secondary brand color. Used mainly as hover color or by secondary elements.', 'oxence-toolkit' ),
                    'default'  => '#293043',
                    'desc' => esc_html__( 'Default: #293043', 'oxence-toolkit' ),
                ],
                [
                    'id'       => 'headline_color',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Headline', 'oxence-toolkit' ),
                    'default'  => '#293043',
                    'subtitle' => esc_html__( 'A dark, contrasting color, used by all headlines in your website.', 'oxence-toolkit' ),
                    'desc'     => esc_html__( 'Default: #293043', 'oxence-toolkit' ),
                ],
                [
                    'id'       => 'body_color',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Body Color', 'oxence-toolkit' ),
                    'subtitle' => esc_html__( 'A neutral grey, easy to read color, used by all text elements.', 'oxence-toolkit' ),
                    'default'  => '#696e7b',
                    'desc' => esc_html__( 'Default: #696e7b', 'oxence-toolkit' ),
                ],
                [
                    'id'       => 'border_color',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Border Color', 'oxence-toolkit' ),
                    'subtitle' => esc_html__( 'Generally used as common background colors for inputs etc.', 'oxence-toolkit' ),
                    'default'  => '#e9eaec',
                    'desc' => esc_html__( 'Default: #e9eaec', 'oxence-toolkit' ),
                ],
                [
                    'id'       => 'light_neutral',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Light Neutral', 'oxence-toolkit' ),
                    'subtitle' => esc_html__( 'Generally used as background color for light, alternating sections.', 'oxence-toolkit' ),
                    'default'  => '#f7f9fd',
                    'desc' => esc_html__( 'Default: #f7f9fd', 'oxence-toolkit' ),
                ],
                [
                    'id'       => 'white_color',
                    'type'     => 'color',
                    'title'    => esc_html__( 'White', 'oxence-toolkit' ),
                    'default'  => '#ffffff',
                    'subtitle' => esc_html__( 'Generally used as background for white sections.', 'oxence-toolkit' ),
                    'desc'     => esc_html__( 'Default: #ffffff', 'oxence-toolkit' ),
                ],
            ],
        ] );
    }

    /**
     * Typography Options
     */
    public function typography_section() {
        CSF::createSection( $this->options_prefix, [
            'title'  => esc_html__( 'Typography', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Typography', 'oxence-toolkit' ),
                ],
                [
                    'id'                 => 'primary_font',
                    'type'               => 'typography',
                    'title'              => esc_html__( 'Primary Font', 'oxence-toolkit' ),
                    'font_weight'        => true,
                    'font_style'         => true,
                    'extra_styles'       => true,
                    'font_size'          => false,
                    'line_height'        => false,
                    'letter_spacing'     => false,
                    'text_align'         => false,
                    'text_transform'     => false,
                    'color'              => false,
                    'backup_font_family' => false,
                    'subset'             => true,
                    'preview'            => false,
                ],
                [
                    'id'                 => 'secondary_font',
                    'type'               => 'typography',
                    'title'              => esc_html__( 'Secondary Font', 'oxence-toolkit' ),
                    'font_weight'        => true,
                    'font_style'         => true,
                    'extra_styles'       => true,
                    'font_size'          => false,
                    'line_height'        => false,
                    'letter_spacing'     => false,
                    'text_align'         => false,
                    'text_transform'     => false,
                    'color'              => false,
                    'backup_font_family' => false,
                    'subset'             => true,
                    'preview'            => false,
                ],
                [
                    'id'      => 'body_typo_types',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Body Typography', 'oxence-toolkit' ),
                    'options' => [
                        'default-font' => esc_html__( 'Default', 'oxence-toolkit' ),
                        'custom-font'  => esc_html__( 'Custom', 'oxence-toolkit' ),
                    ],
                    'default' => 'default-font',
                ],
                [
                    'id'               => 'body_typo',
                    'type'             => 'typography',
                    'title'            => esc_html__( 'Body', 'oxence-toolkit' ),
                    'output'           => 'body',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        'body_typo_types', '==', 'custom-font',
                    ],
                ],
                [
                    'id'      => 'heading_typo_type',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Heading Typography', 'oxence-toolkit' ),
                    'options' => [
                        'default-font' => esc_html__( 'Default', 'oxence-toolkit' ),
                        'custom-font'  => esc_html__( 'Custom', 'oxence-toolkit' ),
                    ],
                    'default' => 'default-font',
                ],
                [
                    'id'               => 'heading1_typo',
                    'type'             => 'typography',
                    'title'            => esc_html__( 'Heading 1', 'oxence-toolkit' ),
                    'output'           => 'h1',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        'heading_typo_type', '==', 'custom-font',
                    ],
                ],
                [
                    'id'               => 'heading2_typo',
                    'type'             => 'typography',
                    'title'            => esc_html__( 'Heading 2', 'oxence-toolkit' ),
                    'output'           => 'h2',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        'heading_typo_type', '==', 'custom-font',
                    ],
                ],
                [
                    'id'               => 'heading3_typo',
                    'type'             => 'typography',
                    'title'            => esc_html__( 'Heading 3', 'oxence-toolkit' ),
                    'output'           => 'h3',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        'heading_typo_type', '==', 'custom-font',
                    ],
                ],
                [
                    'id'               => 'heading4_typo',
                    'type'             => 'typography',
                    'title'            => esc_html__( 'Heading 4', 'oxence-toolkit' ),
                    'output'           => 'h4',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        'heading_typo_type', '==', 'custom-font',
                    ],
                ],
                [
                    'id'               => 'heading5_typo',
                    'type'             => 'typography',
                    'title'            => esc_html__( 'Heading 5', 'oxence-toolkit' ),
                    'output'           => 'h5',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        'heading_typo_type', '==', 'custom-font',
                    ],
                ],
                [
                    'id'               => 'heading6_typo',
                    'type'             => 'typography',
                    'title'            => esc_html__( 'Heading 6', 'oxence-toolkit' ),
                    'output'           => 'h6',
                    'line_height_unit' => 'em',
                    'dependency'       => [
                        'heading_typo_type', '==', 'custom-font',
                    ],
                ],
            ],
        ] );
    }

    /**
     * Custom Script Options
     */
    public function custom_scrips_section() {
        CSF::createSection( $this->options_prefix, [
            'title'  => esc_html__( 'Custom Scripts', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Custom Scripts', 'oxence-toolkit' ),
                ],
                [
                    'id'       => 'custom_header_scripts',
                    'type'     => 'code_editor',
                    'title'    => esc_html__( 'Js Code(Head)', 'oxence-toolkit' ),
                    'settings' => [
                        'theme' => 'mbo',
                        'mode'  => 'javascript',
                    ],
                    'subtitle' => esc_html__( 'Add your custom js code here. Must Be type without script tag and valid code, It will insert the code to wp_head hook.
                    ', 'oxence-toolkit' ),
                ],
                [
                    'id'       => 'custom_footer_scripts',
                    'type'     => 'code_editor',
                    'title'    => esc_html__( 'Js Code(Footer)', 'oxence-toolkit' ),
                    'settings' => [
                        'theme' => 'mbo',
                        'mode'  => 'javascript',
                    ],
                    'subtitle' => esc_html__( 'Add your custom js code here. Must Be type without script tag and valid code, It will insert the code to wp_footer hook.
                    ', 'oxence-toolkit' ),
                ],
                [
                    'type'    => 'submessage',
                    'style'   => 'info',
                    'content' => esc_html__( 'You Can add also custom css in Appearance>Customize>Additional CSS', 'oxence-toolkit' ),
                ],
            ],
        ] );
    }

    /**
     * Backup Options
     */
    public function backup_section() {
        CSF::createSection( $this->options_prefix, [
            'title'  => esc_html__( 'Backup', 'oxence-toolkit' ),
            'fields' => [
                [
                    'type'    => 'heading',
                    'content' => esc_html__( 'Backup', 'oxence-toolkit' ),
                ],
                [
                    'type' => 'backup',
                ],
            ],
        ] );
    }
}

Oxence_Theme_Options::instance()->initialize();