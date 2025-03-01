<?php
namespace OxenceToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use OxenceTheme\Classes\Oxence_Helper;

defined( 'ABSPATH' ) || exit;

class Nav_Menu extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'oxence-nav-menu';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Nav Menu', 'oxence-toolkit' );
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-nav-menu';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['oxence_elements'];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return ['oxence', 'toolkit', 'header', 'footer', 'nav', 'menu'];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls() {

        $this->start_controls_section(
            'widget_content',
            [
                'label' => esc_html__( 'General', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'menu_type',
            [
                'label'   => esc_html__( 'Menu', 'oxence-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'theme-default' => esc_html__( 'Theme Default', 'oxence-toolkit' ),
                    'custom'        => esc_html__( 'Custom Menu', 'oxence-toolkit' ),
                ],
                'default' => 'theme-default',
            ]
        );

        $this->add_control(
            'selected_menu',
            [
                'label'     => esc_html__( 'Select Menu', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $this->get_menus_list(),
                'condition' => [
                    'menu_type' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'menu_alignment',
            [
                'label'       => esc_html__( 'Menu Alignment', 'oxence-toolkit' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'oxence-toolkit' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'oxence-toolkit' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'oxence-toolkit' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default'     => 'center',
                'toggle'      => false,
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
            'menu_height',
            [
                'label'       => esc_html__( 'Menu Height', 'oxence-toolkit' ),
                'type'        => Controls_Manager::NUMBER,
                'min'         => 0,
                'label_block' => false,
                'selectors'   => [
                    '{{WRAPPER}} .oxence-nav-menu .nav-menu-wrapper ul.primary-menu > li' => 'height: {{VALUE}}px;',
                    '{{WRAPPER}} .oxence-nav-menu.breakpoint-on'                          => 'height: {{VALUE}}px;',
                ],
            ]
        );

        $this->add_control(
            'slide_panel_heading',
            [
                'label'     => esc_html__( 'Slide Panel', 'oxence-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'breakpoint',
            [
                'label'       => esc_html__( 'Breakpoint', 'oxence-toolkit' ),
                'type'        => Controls_Manager::NUMBER,
                'min'         => 0,
                'default'     => 1024,
                'label_block' => false,
                'description' => esc_html__( 'Define when the toggle will appear?', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'toggle_alignment',
            [
                'label'       => esc_html__( 'Toggle Alignment', 'oxence-toolkit' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'oxence-toolkit' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center'     => [
                        'title' => esc_html__( 'Center', 'oxence-toolkit' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'flex-end'   => [
                        'title' => esc_html__( 'Right', 'oxence-toolkit' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default'     => 'flex-end',
                'toggle'      => false,
                'selectors'   => [
                    '{{WRAPPER}} .oxence-nav-menu.breakpoint-on' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'panel_logo_form',
            [
                'label'   => esc_html__( 'Panel Logo', 'oxence-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'default' => esc_html__( 'Default', 'oxence-toolkit' ),
                    'custom'  => esc_html__( 'Custom', 'oxence-toolkit' ),
                ],
                'default' => 'default',
            ]
        );

        $this->add_control(
            'panel_logo_type',
            [
                'label'     => esc_html__( 'Type', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'text'  => esc_html__( 'Text', 'oxence-toolkit' ),
                    'image' => esc_html__( 'Image', 'oxence-toolkit' ),
                ],
                'default'   => 'text',
                'condition' => [
                    'panel_logo_form' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'panel_text_logo',
            [
                'label'      => esc_html__( 'Text logo', 'oxence-toolkit' ),
                'type'       => Controls_Manager::TEXT,
                'default'    => 'Oxence',
                'conditions' => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'panel_logo_form',
                            'operator' => '==',
                            'value'    => 'custom',
                        ],
                        [
                            'name'     => 'panel_logo_type',
                            'operator' => '==',
                            'value'    => 'text',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'panel_image_logo',
            [
                'label'      => esc_html__( 'Image Logo', 'oxence-toolkit' ),
                'type'       => Controls_Manager::MEDIA,
                'default'    => [
                    'url' => OT_ASSETS . '/img/options/logo.png',
                ],
                'conditions' => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'panel_logo_form',
                            'operator' => '==',
                            'value'    => 'custom',
                        ],
                        [
                            'name'     => 'panel_logo_type',
                            'operator' => '==',
                            'value'    => 'image',
                        ],
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'widget_style',
            [
                'label' => esc_html__( 'Menu Items', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'nav_item_spacing',
            [
                'label'       => esc_html__( 'Item Spacing', 'oxence-toolkit' ),
                'type'        => Controls_Manager::NUMBER,
                'label_block' => false,
                'min'         => 0,
                'max'         => 100,
                'selectors'   => [
                    '{{WRAPPER}} .oxence-nav-menu .nav-menu-wrapper li' => 'margin: 0 {{VALUE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'nav_item_padding',
            [
                'label'      => esc_html__( 'Item Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-nav-menu .nav-menu-wrapper li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'menu_item_typography',
                'selector' => '{{WRAPPER}} .oxence-nav-menu .nav-menu-wrapper li a',
            ]
        );

        $this->add_control(
            'submenu_heading',
            [
                'label'     => esc_html__( 'Submenu', 'oxence-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'submenu_bg',
            [
                'label'     => esc_html__( 'Submenu Background', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-nav-menu .nav-menu-wrapper .sub-menu' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'submenu_shadow',
                'selector' => '{{WRAPPER}} .oxence-nav-menu .nav-menu-wrapper .sub-menu',
            ]
        );

        $this->add_control(
            'submenu_item_divider',
            [
                'label'     => esc_html__( 'Item Divider', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-nav-menu .nav-menu-wrapper .sub-menu li:not(:last-child)' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submenu_item_padding',
            [
                'label'      => esc_html__( 'Item Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-nav-menu .nav-menu-wrapper .sub-menu a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'submenu_item_typography',
                'selector' => '{{WRAPPER}} .oxence-nav-menu .nav-menu-wrapper .sub-menu a',
            ]
        );

        $this->start_controls_tabs( 'nav-menu-tab' );

        $this->start_controls_tab(
            'menu_item_normal',
            [
                'label' => esc_html__( 'Normal', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'menu_item_color',
            [
                'label'     => esc_html__( 'Item Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-nav-menu .nav-menu-wrapper li a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'submenu_item_color',
            [
                'label'     => esc_html__( 'Submenu Item Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-nav-menu .nav-menu-wrapper .sub-menu a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'menu_item_hover',
            [
                'label' => esc_html__( 'Hover/Current', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'menu_item_hover_color',
            [
                'label'     => esc_html__( 'Item Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-nav-menu .nav-menu-wrapper li a:hover'               => 'color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-nav-menu .nav-menu-wrapper li.current_page_item > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'submenu_item_hover_color',
            [
                'label'     => esc_html__( 'Submenu Item Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-nav-menu .nav-menu-wrapper .sub-menu a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'panel_style',
            [
                'label' => esc_html__( 'Slide Panel', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'toggler_color',
            [
                'label'     => esc_html__( 'Toggler Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-nav-menu .navbar-toggler'       => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-nav-menu .navbar-toggler .line' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'panel_bg',
            [
                'label'     => esc_html__( 'Background', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-nav-menu .slide-panel-wrapper .slide-panel-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'panel_typography',
                'selector' => '{{WRAPPER}} .oxence-nav-menu .slide-panel-wrapper .slide-panel-menu a',
            ]
        );

        $this->add_control(
            'panel_item_divider',
            [
                'label'     => esc_html__( 'Item Divider', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-nav-menu .slide-panel-wrapper ul.primary-menu'     => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-nav-menu .slide-panel-wrapper .slide-panel-menu a' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'panel-menu-tab' );

        $this->start_controls_tab(
            'panel_item_normal',
            [
                'label' => esc_html__( 'Normal', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'panel_item_color',
            [
                'label'     => esc_html__( 'Item Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-nav-menu .slide-panel-wrapper .slide-panel-menu a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-nav-menu .slide-panel-wrapper .slide-panel-close'  => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'panel_item_hover',
            [
                'label' => esc_html__( 'Current', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'panel_item_hover_color',
            [
                'label'     => esc_html__( 'Item Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-nav-menu .slide-panel-wrapper .slide-panel-menu li.current_page_item > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'logo_heading',
            [
                'label'     => esc_html__( 'Panel Logo', 'oxence-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'logo_typography',
                'selector' => '{{WRAPPER}} .slide-panel-logo',
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label'          => esc_html__( 'Width', 'oxence-toolkit' ),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units'     => ['%', 'px', 'vw'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .slide-panel-logo img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'max_width',
            [
                'label'          => esc_html__( 'Max Width', 'oxence-toolkit' ),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units'     => ['%', 'px', 'vw'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .slide-panel-logo' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings();

        if ( $settings['breakpoint'] ) {
            $breakpoint = $settings['breakpoint'];
        } else {
            $breakpoint = 1024;
        }

        $args = [
            'container'       => 'div',
            'container_class' => 'nav-menu-wrapper nav-' . $settings['menu_alignment'],
            'menu_class'      => 'primary-menu',
            'after'           => '',
            'link_before'     => '<span class="link-text">',
            'link_after'      => '</span>',
            'fallback_cb'     => false,
        ];

        if ( 'custom' == $settings['menu_type'] && ! empty( $settings['selected_menu'] ) ) {
            $args['menu'] = $settings['selected_menu'];
        } elseif ( has_nav_menu( 'primary_menu' ) ) {
            $args['theme_location'] = 'primary_menu';
        }

        $panel_logo_type  = Oxence_Helper::get_option( 'panel_logo_type', 'text' );
        $panel_text_logo  = Oxence_Helper::get_option( 'panel_text_logo', __( 'Oxence', 'oxence-toolkit' ) );
        $panel_image_logo = Oxence_Helper::get_option( 'panel_image_logo', ['url' => get_template_directory_uri() . '/assets/img/logo.png'] );
        ?>
        <nav class="oxence-nav-menu" data-breakpoint="<?php echo esc_attr( $breakpoint ) ?>">
            <?php wp_nav_menu( $args );?>
            <div class="navbar-toggler">
                <span>
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </span>
            </div>
            <div class="slide-panel-wrapper">
                <div class="slide-panel-overly"></div>
                <div class="slide-panel-content">
                    <div class="slide-panel-close">
                        <i class="fal fa-times"></i>
                    </div>
                    <div class="slide-panel-logo">
                        <?php if ( 'custom' === $settings['panel_logo_form'] ): ?>
                            <?php if ( 'text' === $settings['panel_logo_type'] ): ?>
                                <?php echo esc_html( $settings['panel_text_logo'] )?>
                            <?php elseif ( $settings['panel_image_logo']['url'] ): ?>
                                <img src="<?php echo esc_url( $settings['panel_image_logo']['url'] ) ?>" alt="<?php echo get_bloginfo() ?>">
                            <?php endif;?>
                        <?php else : ?>
                            <?php if ( 'text' === $panel_logo_type && ! empty ( $panel_text_logo ) ) : ?>
                                <?php echo esc_html( $panel_text_logo )?>
                            <?php elseif ( 'image' === $panel_logo_type && ! empty ( $panel_image_logo['url'] ) ) : ?>
                                <img src="<?php echo esc_url( $panel_image_logo['url'] ) ?>" alt="<?php echo get_bloginfo() ?>">
                            <?php endif; ?>
                        <?php endif;?>
                    </div>
                    <?php
                        $args['container_class'] = 'slide-panel-menu';
                        wp_nav_menu( $args );
                    ?>
                </div>
            </div>
        </nav>
        <?php
}

    /**
     * Get Menus List
     *
     * @since 1.0.0
     * @access protected
     */
    protected function get_menus_list() {
        $nav_menus = [];
        $terms     = get_terms( 'nav_menu' );
        foreach ( $terms as $term ) {
            $nav_menus[$term->name] = $term->name;
        }

        return $nav_menus;
    }
}