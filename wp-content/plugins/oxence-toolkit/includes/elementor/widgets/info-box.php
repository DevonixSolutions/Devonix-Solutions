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

class Info_Box extends Widget_Base {

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
        return 'oxence-info-box';
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
        return esc_html__( 'Info Box', 'oxence-toolkit' );
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
        return 'eicon-image-box';
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
        return ['oxence', 'toolkit', 'info', 'image', 'icon', 'iconic'];
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
            'section_content_additional',
            [
                'label' => esc_html__( 'Additional Options', 'oxence-toolkit' ),
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
                'default'     => 'h4',
                'toggle'      => false,
            ]
        );

        $this->add_control(
            'read_more',
            [
                'label'        => esc_html__( 'Read More Button', 'oxence-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'badge',
            [
                'label'        => esc_html__( 'Badge', 'oxence-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'global_link',
            [
                'label'        => esc_html( 'Global Link', 'oxence-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes',
                'description'  => esc_html( 'Be aware! When Global Link activated then title link and read more link will not work', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'global_link_url',
            [
                'label'       => esc_html( 'Global Link URL', 'oxence-toolkit' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => 'http://your-link.com',
                'condition'   => [
                    'global_link' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_heading',
            [
                'label' => esc_html__( 'Info Box', 'oxence-toolkit' ),
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
                    'value'   => 'fas fa-check',
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
                'default'     => esc_html__( 'Info Box Heading', 'oxence-toolkit' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title_link',
            [
                'label'        => esc_html__( 'Title Link', 'oxence-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'title_link_url',
            [
                'label'       => esc_html__( 'Title Link URL', 'oxence-toolkit' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => 'http://your-link.com',
                'condition'   => [
                    'title_link' => 'yes',
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label'       => esc_html__( 'Description', 'oxence-toolkit' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'Focus provide beautiful layout client look make import.', 'oxence-toolkit' ),
                'placeholder' => esc_html__( 'Enter your description', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'icon_position',
            [
                'label'      => esc_html__( 'Icon Position', 'oxence-toolkit' ),
                'type'       => Controls_Manager::CHOOSE,
                'separator'  => 'before',
                'default'    => 'top',
                'options'    => [
                    'left'  => [
                        'title' => esc_html__( 'Left', 'oxence-toolkit' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'top'   => [
                        'title' => esc_html__( 'Top', 'oxence-toolkit' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'oxence-toolkit' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default'    => 'top',
                'toggle'     => false,
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

        $this->add_control(
            'icon_inline',
            [
                'label'     => esc_html__( 'Icon Inline', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'icon_position' => ['left', 'right'],
                ],
            ]
        );

        $this->add_control(
            'icon_vertical_alignment',
            [
                'label'     => esc_html__( 'Icon Vertical Alignment', 'oxence-toolkit' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [
                        'title' => esc_html__( 'Top', 'oxence-toolkit' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'center'     => [
                        'title' => esc_html__( 'Middle', 'oxence-toolkit' ),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'flex-end'   => [
                        'title' => esc_html__( 'Bottom', 'oxence-toolkit' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'default'   => 'center',
                'toggle'    => false,
                'condition' => [
                    'icon_position' => ['left', 'right'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .oxence-info-box'            => 'align-items: {{VALUE}};',
                    '{{WRAPPER}} .oxence-info-box .box-title' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_align',
            [
                'label'     => esc_html__( 'Alignment', 'oxence-toolkit' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'text-left'   => [
                        'title' => esc_html__( 'Left', 'oxence-toolkit' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__( 'Center', 'oxence-toolkit' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'text-right'  => [
                        'title' => esc_html__( 'Right', 'oxence-toolkit' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'text-left',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_read_more',
            [
                'label'     => esc_html( 'Read More', 'oxence-toolkit' ),
                'condition' => [
                    'read_more' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'read_more_text',
            [
                'label'       => esc_html__( 'Text', 'oxence-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Read More', 'oxence-toolkit' ),
                'placeholder' => esc_html__( 'Read More', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'read_more_link',
            [
                'label'       => esc_html__( 'Link to', 'oxence-toolkit' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'oxence-toolkit' ),
                'default'     => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'read_more_icon',
            [
                'label'            => esc_html__( 'Icon', 'oxence-toolkit' ),
                'type'             => Controls_Manager::ICONS,
                'default'          => [
                    'value'   => 'fas fa-angle-double-right',
                    'library' => 'fa-solid',
                ],
                'fa4compatibility' => 'read_more_icon_f4',
            ]
        );

        $this->add_control(
            'read_more_icon_align',
            [
                'label'     => esc_html__( 'Icon Position', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'right',
                'options'   => [
                    'left'  => esc_html__( 'Left', 'oxence-toolkit' ),
                    'right' => esc_html__( 'Right', 'oxence-toolkit' ),
                ],
                'condition' => [
                    'read_more_icon[value]!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_badge',
            [
                'label'     => esc_html__( 'Badge', 'oxence-toolkit' ),
                'condition' => [
                    'badge' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label'       => esc_html__( 'Badge Text', 'oxence-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'POPULAR', 'oxence-toolkit' ),
                'placeholder' => esc_html__( 'Type Badge Title', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'badge_position',
            [
                'label'   => esc_html__( 'Position', 'oxence-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'top-right',
                'options' => [
                    'top-right'    => esc_html__( 'Top Right', 'oxence-toolkit' ),
                    'top-left'     => esc_html__( 'Top Left', 'oxence-toolkit' ),
                    'bottom-right' => esc_html__( 'Bottom Right', 'oxence-toolkit' ),
                    'bottom-left'  => esc_html__( 'Bottom Left', 'oxence-toolkit' ),
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_horizontal_offset',
            [
                'label'     => esc_html__( 'Horizontal Offset', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => -300,
                        'step' => 2,
                        'max'  => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .oxence-info-box' => '--badge-h-offset: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_vertical_offset',
            [
                'label'     => esc_html__( 'Vertical Offset', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => -300,
                        'step' => 2,
                        'max'  => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .oxence-info-box ' => '--badge-v-offset: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_rotate',
            [
                'label'     => esc_html__( 'Rotate', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => -360,
                        'max'  => 360,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .oxence-info-box ' => '--badge-rotate: {{SIZE}}deg;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_info_box',
            [
                'label' => esc_html__( 'Info Box', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'info_box_padding',
            [
                'label'      => esc_html__( 'Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-info-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'info_box_margin',
            [
                'label'      => esc_html__( 'Margin', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-info-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'info_box_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .oxence-info-box',
            ]
        );

        $this->add_responsive_control(
            'info_box_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-info-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'info_box_tab' );

        $this->start_controls_tab(
            'info_box_normal',
            [
                'label' => esc_html__( 'Normal', 'oxence-toolkit' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'info_box_bg',
                'selector' => '{{WRAPPER}} .oxence-info-box',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'info_box_shadow',
                'selector' => '{{WRAPPER}} .oxence-info-box',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'info_box_hover',
            [
                'label' => esc_html__( 'Hover', 'oxence-toolkit' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'info_box_hover_bg',
                'selector' => '{{WRAPPER}} .oxence-info-box:hover',
            ]
        );

        $this->add_control(
            'info_box_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-info-box:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'info_box_border_border!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'info_box_hover_shadow',
                'selector' => '{{WRAPPER}} .oxence-info-box:hover',
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
            'icon_padding',
            [
                'label'      => esc_html__( 'Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-info-box .box-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'icon_typography',
                'selector'  => '{{WRAPPER}} .oxence-info-box .box-icon',
                'condition' => [
                    'icon_type!' => 'image',
                ],
                'label'     => esc_html__( 'Icon Size', 'oxence-toolkit' ),
                'exclude'   => [
                    'font_family',
                    'letter_spacing',
                    'word_spacing',
                    'font_style',
                    'text_transform',
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
                    '{{WRAPPER}} .oxence-info-box ' => '--icon-space: {{SIZE}}px;',
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
                    '{{WRAPPER}} .oxence-info-box .box-icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'icon_type' => 'image',
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
                    '{{WRAPPER}} .oxence-info-box .box-icon'       => 'color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-info-box .box-icon svg *' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'icon_type!' => 'image',
                ],
            ]
        );

        $this->add_control(
            'icon_background',
            [
                'label'     => esc_html__( 'Icon Background', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-info-box .box-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'icon_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .oxence-info-box .box-icon',
            ]
        );

        $this->add_responsive_control(
            'icon_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-info-box .box-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_shadow',
                'selector' => '{{WRAPPER}} .oxence-info-box .box-icon',
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
                    '{{WRAPPER}} .oxence-info-box .box-icon i, {{WRAPPER}} .oxence-info-box .box-icon img, {{WRAPPER}} .oxence-info-box .box-icon svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
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
                    '{{WRAPPER}} .oxence-info-box .box-icon' => 'transform: rotate({{SIZE}}{{UNIT}});',
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
            'icon_effect',
            [
                'label'   => esc_html__( 'Effect', 'oxence-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__( 'None', 'oxence-toolkit' ),
                    'a'    => esc_html__( 'Effect A', 'oxence-toolkit' ),
                    'b'    => esc_html__( 'Effect B', 'oxence-toolkit' ),
                    'c'    => esc_html__( 'Effect C', 'oxence-toolkit' ),
                    'd'    => esc_html__( 'Effect D', 'oxence-toolkit' ),
                    'e'    => esc_html__( 'Effect E', 'oxence-toolkit' ),
                ],
            ]
        );

        $this->add_control(
            'icon_hover_color',
            [
                'label'     => esc_html__( 'Icon Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-info-box:hover .box-icon'       => 'color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-info-box:hover .box-icon svg *' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .oxence-info-box:hover .box-icon' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .oxence-info-box:hover .box-icon' => 'border-color: {{VALUE}};',
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
                    '{{WRAPPER}} .oxence-info-box:hover .box-icon'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .oxence-info-box:hover .box-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_hover_shadow',
                'selector' => '{{WRAPPER}} .oxence-info-box:hover .box-icon',
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
                    '{{WRAPPER}} .oxence-info-box:hover .box-icon i, {{WRAPPER}} .oxence-info-box:hover .box-icon img, {{WRAPPER}} .oxence-info-box:hover .box-icon svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
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
                    '{{WRAPPER}} .oxence-info-box:hover .box-icon' => 'transform: rotate({{SIZE}}{{UNIT}});',
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
                    '{{WRAPPER}} .oxence-info-box .box-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .oxence-info-box .box-title',
            ]
        );

        $this->add_responsive_control(
            'title_bottom_space',
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
                    '{{WRAPPER}} .oxence-info-box .box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
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
                    '{{WRAPPER}} .oxence-info-box .description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'desc_typography',
                'selector' => '{{WRAPPER}} .oxence-info-box .description',
            ]
        );

        $this->add_responsive_control(
            'desc_bottom_space',
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
                    '{{WRAPPER}} .oxence-info-box .description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
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
                    '{{WRAPPER}} .oxence-info-box:hover .box-title' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .oxence-info-box:hover .description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_read_more',
            [
                'label'     => esc_html__( 'Read More', 'oxence-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'read_more' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'read_more_padding',
            [
                'label'      => __( 'Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-info-box .read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'read_more_top_space',
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
                    '{{WRAPPER}} .oxence-info-box .read-more' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'read_more_icon_space',
            [
                'label'     => esc_html__( 'Icon Spacing', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .oxence-info-box .read-more.icon-left i'    => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .oxence-info-box .read-more.icon-left svg'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .oxence-info-box .read-more.icon-right i'   => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .oxence-info-box .read-more.icon-right svg' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'read_more_typography',
                'selector' => '{{WRAPPER}} .oxence-info-box .read-more span',
            ]
        );

        $this->add_responsive_control(
            'read_more_icon_size',
            [
                'label'     => esc_html__( 'Icon Size', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .oxence-info-box .read-more i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_read_more_style' );

        $this->start_controls_tab(
            'tab_read_more_normal',
            [
                'label' => esc_html__( 'Normal', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'read_more_color',
            [
                'label'     => esc_html__( 'Text Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-info-box .read-more'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-info-box .read-more svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'read_more_bg',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-info-box .read-more' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'read_more_border',
                'placeholder' => '0',
                'separator'   => 'before',
                'selector'    => '{{WRAPPER}} .oxence-info-box .read-more',
            ]
        );

        $this->add_responsive_control(
            'read_more_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'separator'  => 'after',
                'selectors'  => [
                    '{{WRAPPER}} .oxence-info-box .read-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'read_more_shadow',
                'selector' => '{{WRAPPER}} .oxence-info-box .read-more',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_read_more_hover',
            [
                'label' => esc_html__( 'Hover', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'read_more_hover_color',
            [
                'label'     => esc_html__( 'Text Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-info-box:hover .read-more'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-info-box:hover .read-more svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'read_more_hover_bg',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-info-box:hover .read-more' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'read_more_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-info-box:hover .read-more' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'read_more_border_border!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'read_more_hover_shadow',
                'selector' => '{{WRAPPER}} .oxence-info-box:hover .read-more',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_badge',
            [
                'label'     => esc_html__( 'Badge', 'oxence-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'badge' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'badge_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-info-box .box-badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'badge_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-info-box .box-badge' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'badge_border',
                'placeholder' => '0',
                'separator'   => 'before',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .oxence-info-box .box-badge',
            ]
        );

        $this->add_responsive_control(
            'badge_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'separator'  => 'after',
                'selectors'  => [
                    '{{WRAPPER}} .oxence-info-box .box-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'badge_shadow',
                'selector' => '{{WRAPPER}} .oxence-info-box .box-badge',
            ]
        );

        $this->add_responsive_control(
            'badge_padding',
            [
                'label'      => esc_html__( 'Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-info-box .box-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'badge_typography',
                'selector' => '{{WRAPPER}} .oxence-info-box .box-badge',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render Icon
     *
     * @return void
     */
    protected function render_icon( $icon_inline = false ) {
        $settings = $this->get_settings_for_display();

        $has_icon = ! empty( $settings['icon'] );
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

        if ( $icon_inline ) {
            $wrapper_tag = 'span';
        } else {
            $wrapper_tag = 'div';
        }

        if ( $has_icon || $has_image ): ?>
        <<?php echo ot_escape_tags( $wrapper_tag ) ?> class="box-icon">
            <?php if ( $has_icon and 'icon' == $settings['icon_type'] ): ?>
                <?php if ( $is_new || $migrated ): ?>
                    <?php Icons_Manager::render_icon( $settings['selected_icon'], ['aria-hidden' => 'true'] );?>
                <?php else: ?>
                    <i <?php echo $this->get_render_attribute_string( 'font-icon' ); ?>></i>
                <?php endif;?>
            <?php elseif ( $has_image and 'image' == $settings['icon_type'] ): ?>
                <img <?php echo $this->get_render_attribute_string( 'image-icon' ); ?>>
            <?php endif;?>
        </<?php echo ot_escape_tags( $wrapper_tag ) ?>>
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
        $settings = $this->get_settings_for_display();
        $wrapper_class = 'oxence-info-box ' . $settings['text_align'] . ' icon-' . $settings['icon_position'];
        ?>
        <div class="<?php echo esc_attr( $wrapper_class ) ?>">
            <?php if ( 'yes' !== $settings['icon_inline'] ) {
                $this->render_icon();
            }?>
            <div class="box-content">
                <?php if ( ! empty( $settings['title_text'] ) ) : ?>
                    <<?php echo ot_escape_tags( $settings['title_tag'], 'h4' ) ?> class="box-title">
                        <?php
                            if ( 'yes' === $settings['icon_inline'] && 'top' !== $settings['icon_position'] ) {
                                $this->render_icon( true );
                            }
                            if ( ! empty( $settings['title_text'] ) ) {
                                $this->add_inline_editing_attributes( 'title_text', 'none' );
                                $this->add_render_attribute( 'title_text', 'class', 'title-text' );

                                if ( 'yes' == $settings['title_link'] && ! empty( $settings['title_link_url']['url'] ) ) {
                                    $this->add_link_attributes( 'title_text', $settings['title_link_url'] );

                                    printf( '<a %1$s>%2$s</a>',
                                        $this->get_render_attribute_string( 'title_text' ),
                                        ot_kses_basic( $settings['title_text'] )
                                    );
                                } else {
                                    printf( '<span %1$s>%2$s</span>',
                                        $this->get_render_attribute_string( 'title_text' ),
                                        wp_kses_post( $settings['title_text'] )
                                    );
                                }
                            }
                        ?>
                    </<?php echo ot_escape_tags( $settings['title_tag'], 'h4' ) ?>>
                <?php endif; ?>
                <?php
                    if ( ! empty( $settings['description_text'] ) ) {
                        $this->add_render_attribute( 'description_text', 'class', 'description' );
                        $this->add_inline_editing_attributes( 'description_text', 'basic' );

                        printf( '<p %1$s>%2$s</p>',
                            $this->get_render_attribute_string( 'description_text' ),
                            ot_kses_basic( $settings['description_text'] )
                        );
                    }

                    if ( 'yes' === $settings['read_more'] && $settings['read_more_link']['url'] ) :
                        $this->add_render_attribute( 'read_more', 'class', 'read-more' );
                        $this->add_render_attribute( 'read_more', 'class', 'icon-' . $settings['read_more_icon_align'] );
                        $this->add_inline_editing_attributes( 'read_more_text', 'none' );

                        if ( ! empty( $settings['read_more_link']['url'] ) ) {
                            $this->add_link_attributes( 'read_more', $settings['read_more_link'] );
                        }

                        $read_more_migrated  = isset( $settings['__fa4_migrated']['read_more_icon'] );
                        $read_more_is_new    = empty( $settings['read_more_icon_f4'] ) && Icons_Manager::is_migration_allowed();
                        ?>
                        <a <?php echo $this->get_render_attribute_string( 'read_more' ); ?>>
                            <span <?php echo $this->get_render_attribute_string( 'read_more_text' ) ?>><?php echo esc_html( $settings['read_more_text'] ); ?></span>
                            <?php
                                if ( $read_more_is_new || $read_more_migrated  ) {
                                    Icons_Manager::render_icon( $settings['read_more_icon'], ['aria-hidden' => 'true'] );
                                } else {
                                    echo '<i class=" '. esc_attr( $settings['read_more_icon_f4'] ) .' "></i>';
                                }
                            ?>
                        </a>
                        <?php
                    endif;
                ?>
            </div>
            <?php if ( 'yes' === $settings['badge'] && '' != $settings['badge_text'] ) : ?>
            <div class="box-badge badge-<?php echo esc_attr( $settings['badge_position'] ); ?>">
                <?php echo esc_html( $settings['badge_text'] ); ?>
            </div>
            <?php endif; ?>
            <?php
                if ( 'yes' === $settings['global_link'] ) {
                    $this->add_render_attribute( 'global_link', 'class', 'box-global-link' );
                    $this->add_link_attributes( 'global_link', $settings['global_link_url'] );

                    printf( '<a %1$s></a>',
                        $this->get_render_attribute_string( 'global_link' )
                    );
                }
            ?>
        </div>
        <?php
    }

    /**
     * Render heading widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function content_template() {
        ?>
        <#
            var iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, { 'aria-hidden': true }, 'i' , 'object' );
            var migrated = elementor.helpers.isIconMigrated( settings, 'selected_icon' );
            var wrapper_class = 'oxence-info-box ' + settings.text_align + ' icon-' + settings.icon_position;
        #>
        <div class="{{{ wrapper_class }}}">
            <# if ( 'top' == settings.icon_position || 'yes' != settings.icon_inline ) { #>
                <# if (( settings.image.url && settings.icon_type == 'image' ) || ( settings.icon  && settings.icon_type == 'icon' ) || ( settings.selected_icon.value  && settings.icon_type == 'icon' )) { #>
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
                </div>
                <# } #>
            <# } #>
            <div class="box-content">
                <# if ( settings.title_text ) { #>
                    <{{{settings.title_tag}}} class="box-title">
                        <# if ( 'yes' == settings.icon_inline && 'top' != settings.icon_position ) { #>
                            <# if (( settings.image.url && settings.icon_type == 'image' ) || ( settings.icon  && settings.icon_type == 'icon' ) || ( settings.selected_icon.value  && settings.icon_type == 'icon' )) { #>
                            <span class="box-icon">
                                <# if ( settings.image.url && settings.icon_type == 'image' ) { #>
                                    <img src="{{{settings.image.url}}}" alt="{{{ settings.title_text }}}">
                                <# } else if ( settings.selected_icon.value  && settings.icon_type == 'icon' ) { #>
                                    <# if ( iconHTML && iconHTML.rendered && ( ! settings.icon || migrated ) ) { #>
                                        {{{ iconHTML.value }}}
                                    <# } else { #>
                                        <i class="{{ settings.icon }}" aria-hidden="true"></i>
                                    <# } #>
                                <# } #>
                            </span>
                            <# } #>
                        <# } #>
                        <#
                            view.addInlineEditingAttributes( 'title_text', 'none' );
                            view.addRenderAttribute( 'title_text', 'class', 'title-text' );

                            if( 'yes' == settings.title_link && settings.title_link_url ) {
                                view.addRenderAttribute( 'title_text', 'href', settings.title_link_url.url );

                                var title_html = '<a ' + view.getRenderAttributeString( 'title_text' ) + '>' + settings.title_text + '</a>';
                                print( title_html );
                            } else {
                                var title_html = '<span ' + view.getRenderAttributeString( 'title_text' ) + '>' + settings.title_text + '</span>';
                                print( title_html );
                            }
                        #>
                    </{{{settings.title_tag}}}>
                <# } #>
                <# if ( settings.description_text ) {
                    view.addRenderAttribute( 'description_text', 'class', 'description' );
                    view.addInlineEditingAttributes( 'description_text', 'basic' ); #>
                    <p {{{ view.getRenderAttributeString('description_text') }}}>
                        {{{ settings.description_text }}}
                    </p>
                <# } #>
                <# if ( 'yes' == settings['read_more'] && settings.read_more_link.url ) {
                    view.addRenderAttribute( 'read_more', 'class', 'read-more' );
                    view.addRenderAttribute( 'read_more', 'class', 'icon-' + settings.read_more_icon_align );
                    view.addRenderAttribute( 'read_more', 'href', settings.read_more_link.url );
                    view.addInlineEditingAttributes( 'read_more_text', 'none' );

                    var iconHTMLMore = elementor.helpers.renderIcon( view, settings.read_more_icon, { 'aria-hidden': true }, 'i' , 'object' );
                    var migratedMore = elementor.helpers.isIconMigrated( settings, 'read_more_icon' ); #>
                    <a {{{ view.getRenderAttributeString('read_more') }}}>
                        <span {{{ view.getRenderAttributeString('read_more_text') }}}>{{{ settings.read_more_text }}}</span>
                        <# if ( iconHTMLMore && iconHTMLMore.rendered && ( ! settings.read_more_icon_f4 || migratedMore ) ) { #>
                            {{{ iconHTMLMore.value }}}
                        <# } else { #>
                            <i class="{{ settings.read_more_icon_f4 }}" aria-hidden="true"></i>
                        <# } #>
                    </a>
                <# } #>
            </div>
            <# if ( 'yes' === settings.badge && settings.badge_text != '' ) { #>
            <div class="box-badge badge-{{{settings.badge_position}}}">
                {{{settings.badge_text}}}
            </div>
            <# } #>
            <# if ( 'yes' === settings.global_link ) {
                view.addRenderAttribute( 'global_link', 'class', 'box-global-link' );
                view.addRenderAttribute( 'global_link', settings.global_link_url.url );

                var link_html = '<a ' + view.getRenderAttributeString( 'global_link' ) + '></a>';
                print( link_html );
            } #>
        </div>
        <?php
    }
}