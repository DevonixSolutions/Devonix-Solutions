<?php
namespace OxenceToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Iconic_Box extends Widget_Base {

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
        return 'oxence-iconic-box';
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
        return esc_html__( 'Iconic Box', 'oxence-toolkit' );
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
        return 'eicon-icon-box';
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
        return ['oxence', 'toolkit', 'image', 'icon', 'iconic'];
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
            'section_general',
            [
                'label' => esc_html__( 'General', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'design',
            [
                'label'   => esc_html__( 'Design', 'oxence-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'design-one',
                'options' => [
                    'design-one'   => esc_html__( 'Design One', 'oxence-toolkit' ),
                    'design-two'   => esc_html__( 'Design Two', 'oxence-toolkit' ),
                    'design-three' => esc_html__( 'Design Three', 'oxence-toolkit' ),
                ],
            ]
        );

        $this->add_control(
            'icon_type',
            [
                'label'   => esc_html__( 'Icon Type', 'oxence-toolkit' ),
                'type'    => Controls_Manager::CHOOSE,
                'toggle'  => false,
                'default' => 'icon',
                'options' => [
                    'icon'  => [
                        'title' => esc_html__( 'Icon', 'oxence-toolkit' ),
                        'icon'  => 'fas fa-star',
                    ],
                    'image' => [
                        'title' => esc_html__( 'Image', 'oxence-toolkit' ),
                        'icon'  => 'far fa-image',
                    ],
                ],
            ]
        );

        $this->add_control(
            'selected_icon',
            [
                'label'            => esc_html__( 'Icon', 'oxence-toolkit' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default'          => [
                    'value'   => 'fas fa-fill-drip',
                    'library' => 'fa-solid',
                ],
                'condition'        => [
                    'icon_type' => 'icon',
                ],
                'label_block'      => true,
            ]
        );

        $this->add_control(
            'image',
            [
                'label'       => esc_html__( 'Image Icon', 'oxence-toolkit' ),
                'type'        => Controls_Manager::MEDIA,
                'render_type' => 'template',
                'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition'   => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label'       => esc_html__( 'Title', 'oxence-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your box title', 'oxence-toolkit' ),
                'default'     => esc_html__( 'Iconic Box Heading', 'oxence-toolkit' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'       => esc_html__( 'HTML Tag', 'oxence-toolkit' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'h1' => [
                        'title' => esc_html__( 'H1', 'oxence-toolkit' ),
                        'icon'  => 'eicon-editor-h1',
                    ],
                    'h2' => [
                        'title' => esc_html__( 'H2', 'oxence-toolkit' ),
                        'icon'  => 'eicon-editor-h2',
                    ],
                    'h3' => [
                        'title' => esc_html__( 'H3', 'oxence-toolkit' ),
                        'icon'  => 'eicon-editor-h3',
                    ],
                    'h4' => [
                        'title' => esc_html__( 'H4', 'oxence-toolkit' ),
                        'icon'  => 'eicon-editor-h4',
                    ],
                    'h5' => [
                        'title' => esc_html__( 'H5', 'oxence-toolkit' ),
                        'icon'  => 'eicon-editor-h5',
                    ],
                    'h6' => [
                        'title' => esc_html__( 'H6', 'oxence-toolkit' ),
                        'icon'  => 'eicon-editor-h6',
                    ],
                ],
                'default'     => 'h5',
                'toggle'      => false,
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label'       => esc_html__( 'Description', 'oxence-toolkit' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => '',
                'placeholder' => esc_html__( 'Enter your description', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'selected_link_icon',
            [
                'label'            => esc_html__( 'Link Icon', 'oxence-toolkit' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'link_icon',
                'condition'        => [
                    'design' => 'design-two',
                ],
                'label_block'      => true,
            ]
        );

        $this->add_control(
            'box_url',
            [
                'label'       => esc_html( 'Box URL', 'oxence-toolkit' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => 'http://your-link.com',
            ]
        );

        $this->add_control(
            'box_index',
            [
                'label'     => esc_html__( 'Box Index', 'oxence-toolkit' ),
                'type'      => Controls_Manager::TEXT,
                'condition' => [
                    'design' => 'design-three',
                ],
                'default'   => esc_html( '01' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_iconic_box',
            [
                'label' => esc_html__( 'Iconic Box', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'iconic_text_align',
            [
                'label'     => esc_html__( 'Alignment', 'oxence-toolkit' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'oxence-toolkit' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'oxence-toolkit' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'oxence-toolkit' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .oxence-iconic-box' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'iconic_box_padding',
            [
                'label'      => esc_html__( 'Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-iconic-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'iconic_box_margin',
            [
                'label'      => esc_html__( 'Margin', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-iconic-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'iconic_box_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .oxence-iconic-box',
            ]
        );

        $this->add_responsive_control(
            'iconic_box_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-iconic-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'iconic_box_tab' );

        $this->start_controls_tab(
            'iconic_box_normal',
            [
                'label' => esc_html__( 'Normal', 'oxence-toolkit' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'iconic_box_bg',
                'selector' => '{{WRAPPER}} .oxence-iconic-box',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'iconic_box_shadow',
                'selector' => '{{WRAPPER}} .oxence-iconic-box',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'iconic_box_hover',
            [
                'label' => esc_html__( 'Hover', 'oxence-toolkit' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'iconic_box_hover_bg',
                'selector' => '{{WRAPPER}} .oxence-iconic-box:hover',
            ]
        );

        $this->add_control(
            'iconic_box_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .oxence-iconic-box:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'iconic_box_border_border!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'iconic_box_hover_shadow',
                'selector' => '{{WRAPPER}} .oxence-iconic-box:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_icon',
            [
                'label'      => esc_html__( 'Icon/Image', 'oxence-toolkit' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'name'     => 'selected_icon[value]',
                            'operator' => '!=',
                            'value'    => '',
                        ],
                        [
                            'name'     => 'image[url]',
                            'operator' => '!=',
                            'value'    => '',
                        ],
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_space',
            [
                'label'     => esc_html__( 'Spacing', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .oxence-iconic-box .box-icon' => 'margin-bottom: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'      => esc_html__( 'Size', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'vh', 'vw'],
                'range'      => [
                    'px' => [
                        'min' => 6,
                        'max' => 500,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-iconic-box .box-icon'     => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .oxence-iconic-box .box-icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'icon_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .oxence-iconic-box .box-icon',
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
            'icon_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-iconic-box .box-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'icon_tabs' );

        $this->start_controls_tab(
            'icon_colors_normal',
            [
                'label' => esc_html__( 'Normal', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-iconic-box .box-icon'       => 'color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-iconic-box .box-icon svg *' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'icon_type!' => 'image',
                ],
            ]
        );

        $this->add_control(
            'icon_index_color',
            [
                'label'     => esc_html__( 'Icon Index Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-iconic-box .box-icon .box-index' => '-webkit-text-stroke-color: {{VALUE}};',
                ],
                'condition' => [
                    'design' => 'design-three',
                ],
            ]
        );

        $this->add_control(
            'icon_background',
            [
                'label'     => esc_html__( 'Icon Background', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-iconic-box .box-icon::after'  => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-iconic-box .box-icon::before' => 'border-color: {{VALUE}};',
                ],
                'separator' => 'after',
                'condition' => [
                    'design' => 'design-three',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_shadow',
                'selector' => '{{WRAPPER}} .oxence-iconic-box .box-icon',
            ]
        );

        $this->add_responsive_control(
            'rotate',
            [
                'label'     => esc_html__( 'Rotate', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'unit' => 'deg',
                ],
                'range'     => [
                    'deg' => [
                        'max' => 360,
                        'min' => -360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .oxence-iconic-box .box-icon i, {{WRAPPER}} .oxence-iconic-box .box-icon img, {{WRAPPER}} .oxence-iconic-box .box-icon svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_background_rotate',
            [
                'label'     => esc_html__( 'Background Rotate', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'unit' => 'deg',
                ],
                'range'     => [
                    'deg' => [
                        'max' => 360,
                        'min' => -360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .oxence-iconic-box .box-icon' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_hover',
            [
                'label' => esc_html__( 'Hover', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'icon_hover_color',
            [
                'label'     => esc_html__( 'Icon Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-iconic-box:hover .box-icon'       => 'color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-iconic-box:hover .box-icon svg *' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'icon_type!' => 'image',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_bg',
            [
                'label'     => esc_html__( 'Icon Background', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-iconic-box:hover .box-icon::after'  => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-iconic-box:hover .box-icon::before' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'design' => 'design-three',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .oxence-iconic-box:hover .box-icon' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'icon_border_border!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_hover_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'separator'  => 'after',
                'selectors'  => [
                    '{{WRAPPER}} .oxence-iconic-box:hover .box-icon'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .oxence-iconic-box:hover .box-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_hover_shadow',
                'selector' => '{{WRAPPER}} .oxence-iconic-box:hover .box-icon',
            ]
        );

        $this->add_responsive_control(
            'icon_hover_rotate',
            [
                'label'     => esc_html__( 'Rotate', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'unit' => 'deg',
                ],
                'range'     => [
                    'deg' => [
                        'max' => 360,
                        'min' => -360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .oxence-iconic-box:hover .box-icon i, {{WRAPPER}} .oxence-iconic-box:hover .box-icon img, {{WRAPPER}} .oxence-iconic-box:hover .box-icon svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_hover_background_rotate',
            [
                'label'     => esc_html__( 'Background Rotate', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'unit' => 'deg',
                ],
                'range'     => [
                    'deg' => [
                        'max' => 360,
                        'min' => -360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .oxence-iconic-box:hover .box-icon' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__( 'Content', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs-content_style' );

        $this->start_controls_tab(
            'tab_content_style_normal',
            [
                'label' => esc_html__( 'Normal', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'title_heading',
            [
                'label' => esc_html__( 'Title', 'oxence-toolkit' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-iconic-box .box-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .oxence-iconic-box .box-title',
            ]
        );

        $this->add_control(
            'desc_heading',
            [
                'label'     => esc_html__( 'Description', 'oxence-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-iconic-box .description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'desc_typography',
                'selector' => '{{WRAPPER}} .oxence-iconic-box .description',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_content_style_hover',
            [
                'label' => esc_html__( 'Hover', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'title_hover_heading',
            [
                'label' => esc_html__( 'Title', 'oxence-toolkit' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-iconic-box:hover .box-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'desc_hover_heading',
            [
                'label'     => esc_html__( 'Description', 'oxence-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'desc_hover_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-iconic-box:hover .description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /**
     * Render Icon
     *
     * @return void
     */
    protected function render_icon() {
        $settings = $this->get_settings_for_display();

        $has_icon  = ! empty( $settings['icon'] );
        $has_image = ! empty( $settings['image']['url'] );

        if ( $has_icon && 'icon' == $settings['icon_type'] ) {
            $this->add_render_attribute( 'font-icon', 'class', $settings['selected_icon'] );
            $this->add_render_attribute( 'font-icon', 'aria-hidden', 'true' );
        } elseif ( $has_image && 'image' == $settings['icon_type'] ) {
            $this->add_render_attribute( 'image-icon', 'src', $settings['image']['url'] );
            $this->add_render_attribute( 'image-icon', 'alt', $settings['title_text'] );
        }

        if ( ! $has_icon && ! empty( $settings['selected_icon']['value'] ) ) {
            $has_icon = true;
        }

        $migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
        $is_new   = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

        if ( $has_icon || $has_image ): ?>
        <div class="box-icon">
            <?php if ( $has_icon and 'icon' == $settings['icon_type'] ): ?>
                <?php if ( $is_new || $migrated ): ?>
                    <?php Icons_Manager::render_icon( $settings['selected_icon'], ['aria-hidden' => 'true'] );?>
                <?php else: ?>
                    <i <?php echo $this->get_render_attribute_string( 'font-icon' ); ?>></i>
                <?php endif;?>
            <?php elseif ( $has_image and 'image' == $settings['icon_type'] ): ?>
                <img <?php echo $this->get_render_attribute_string( 'image-icon' ); ?>>
            <?php endif;?>
            <?php if ( $settings['box_index'] && 'design-three' === $settings['design'] ): ?>
            <span class="box-index"><?php echo esc_html( $settings['box_index'] ) ?></span>
            <?php endif;?>
        </div>
        <?php endif;
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
    public function render() {
        $settings      = $this->get_settings_for_display();
        $wrapper_class = 'oxence-iconic-box ' . $settings['design'];

        $this->add_render_attribute( 'box_url', 'class', 'box-url' );
        $this->add_link_attributes( 'box_url', $settings['box_url'] );
        ?>
        <div class="<?php echo esc_attr( $wrapper_class ) ?>">
            <?php $this->render_icon(); ?>
            <div class="box-content">
                <?php
                    if ( ! empty( $settings['title_text'] ) ) {
                        $this->add_render_attribute( 'title_text', 'class', 'box-title' );
                        $this->add_inline_editing_attributes( 'title_text', 'none' );

                        printf( '<%1$s %2$s>%3$s</%1$s>',
                            ot_escape_tags( $settings['title_tag'], 'h5' ),
                            $this->get_render_attribute_string( 'title_text' ),
                            ot_kses_basic( $settings['title_text'] )
                        );
                    }
                ?>
                <?php
                    if ( ! empty( $settings['description_text'] ) ) {
                        $this->add_render_attribute( 'description_text', 'class', 'description' );
                        $this->add_inline_editing_attributes( 'description_text', 'basic' );

                        printf( '<p %1$s>%2$s</p>',
                            $this->get_render_attribute_string( 'description_text' ),
                            ot_kses_basic( $settings['description_text'] )
                        );
                    }
                ?>
                <?php if ( 'design-two' === $settings['design'] && ! empty( $settings['box_url']['url'] ) ) : ?>
                    <a <?php echo $this->get_render_attribute_string( 'box_url' ) ?>>
                    <?php
                        $migrated_icon = isset( $settings['__fa4_migrated']['selected_link_icon'] );
                        $is_new_icon   = empty( $settings['link_icon'] ) && Icons_Manager::is_migration_allowed();

                        $this->add_render_attribute( 'link-icon', 'class', $settings['selected_link_icon'] );
                        $this->add_render_attribute( 'link-icon', 'aria-hidden', 'true' );

                        if ( $is_new_icon || $migrated_icon ) {
                            Icons_Manager::render_icon( $settings['selected_link_icon'], ['aria-hidden' => 'true'] );
                        } else {
                            printf( '<i %1$s></i>',
                                $this->get_render_attribute_string( 'link-icon' )
                            );
                        }
                    ?>
                    </a>
                <?php endif; ?>
            </div>
            <?php
                if ( ! empty( $settings['box_url']['url'] ) && 'design-two' !== $settings['design'] ) {
                    printf( '<a %1$s></a>',
                        $this->get_render_attribute_string( 'box_url' )
                    );
                }
            ?>
        </div>
        <?php
    }

    protected function content_template() {
        ?>
        <#
            var iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, { 'aria-hidden': true }, 'i' , 'object' );
            var migrated = elementor.helpers.isIconMigrated( settings, 'selected_icon' );
            var wrapper_class = 'oxence-iconic-box ' + settings.design;
        #>
        <div class="{{{ wrapper_class }}}">
            <div class="box-icon">
                <# if ( settings.image.url && settings.icon_type == 'image' ) { #>
                    <img src="{{{settings.image.url}}}" alt="{{{ settings.title_text }}}">
                <# } else if ( settings.selected_icon.value  && settings.icon_type == 'icon' ) { #>
                    <# if ( iconHTML && iconHTML.rendered && ( ! settings.icon || migrated ) ) { #>
                        {{{ iconHTML.value }}}
                    <# } else { #>
                        <i class="{{ settings.icon }}" aria-hidden="true"></i>
                    <# } #>
                <# } #>
                <# if ( settings.box_index && 'design-three' === settings.design ) { #>
                <span class="box-index">{{{ settings.box_index }}}</span>
                <# } #>
            </div>
            <div class="box-content">
                <# if ( settings.title_text ) {
                    view.addRenderAttribute( 'title_text', 'class', 'box-title' );
                    view.addInlineEditingAttributes( 'title_text', 'none' ); #>

                    <{{{settings.title_tag}}} {{{view.getRenderAttributeString( 'title_text' )}}}>
                        {{{ settings.title_text }}}
                    </{{{settings.title_tag}}}>
                <# } #>
                <# if ( settings.description_text ) {
                    view.addRenderAttribute( 'description_text', 'class', 'description' );
                    view.addInlineEditingAttributes( 'description_text', 'basic' ); #>

                    <p {{{ view.getRenderAttributeString('description_text') }}}>
                        {{{ settings.description_text }}}
                    </p>
                <# } #>
                <# if ( 'design-two' === settings.design && settings.box_url.url ) { #>
                    <a href="{{{ settings.box_url.url }}}" class="box-url">
                        <#
                            var linkIconHTML = elementor.helpers.renderIcon( view, settings.selected_link_icon, { 'aria-hidden': true }, 'i' , 'object' );
                            var linkIconMigrated = elementor.helpers.isIconMigrated( settings, 'selected_link_icon' );
                        #>
                        <# if ( linkIconHTML && linkIconHTML.rendered && ( ! settings.link_icon || linkIconMigrated ) ) { #>
                            {{{ linkIconHTML.value }}}
                        <# } else { #>
                            <i class="{{ settings.link_icon }}" aria-hidden="true"></i>
                        <# } #>
                    </a>
                <# } #>
            </div>
            <# if ( settings.box_url.url && 'design-two' !== settings.design ) { #>
                <a href="#" class="box-url"></a>
            <# } #>
        </div>
        <?php
    }
}