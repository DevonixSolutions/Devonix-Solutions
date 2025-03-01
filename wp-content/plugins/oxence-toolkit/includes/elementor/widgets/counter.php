<?php
namespace OxenceToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Base;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Counter extends Widget_Base {

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
        return 'oxence-counter';
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
        return esc_html__( 'Counter', 'oxence-toolkit' );
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
        return 'eicon-counter';
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
     * Retrieve the list of Scripts the widget depended on.
     *
     * Used to set Scripts dependencies required to run the widget.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget Scripts dependencies.
     */
    public function get_script_depends() {
        return ['jquery-numerator'];
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
        return ['oxence', 'toolkit', 'box', 'counter', 'fun'];
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
            'section_content_heading',
            [
                'label' => esc_html__( 'Counter Box', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'starting_number',
            [
                'label'   => esc_html__( 'Starting Number', 'oxence-toolkit' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 1,
                'min'     => 1,
            ]
        );

        $this->add_control(
            'ending_number',
            [
                'label'   => esc_html__( 'Ending Number', 'oxence-toolkit' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 100,
            ]
        );

        $this->add_control(
            'prefix',
            [
                'label'       => esc_html__( 'Number Prefix', 'oxence-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'placeholder' => esc_html__( 'Plus', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'suffix',
            [
                'label'       => esc_html__( 'Number Suffix', 'oxence-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'placeholder' => esc_html__( 'Plus', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'duration',
            [
                'label'   => esc_html__( 'Animation Duration', 'oxence-toolkit' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 2000,
                'min'     => 100,
                'step'    => 100,
            ]
        );

        $this->add_control(
            'thousand_separator',
            [
                'label'     => esc_html__( 'Thousand Separator', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_on'  => esc_html__( 'Show', 'oxence-toolkit' ),
                'label_off' => esc_html__( 'Hide', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'thousand_separator_char',
            [
                'label'     => esc_html__( 'Separator', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'condition' => [
                    'thousand_separator' => 'yes',
                ],
                'options'   => [
                    ''  => 'Default',
                    '.' => 'Dot',
                    ' ' => 'Space',
                ],
            ]
        );

        $this->add_control(
            'icon_type',
            [
                'label'     => esc_html__( 'Icon Type', 'oxence-toolkit' ),
                'type'      => Controls_Manager::CHOOSE,
                'toggle'    => false,
                'default'   => 'icon',
                'spectator' => 'before',
                'options'   => [
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
            'selected_image',
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
                'default'     => esc_html__( 'Counter Box Heading', 'oxence-toolkit' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label'       => esc_html__( 'Description', 'oxence-toolkit' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter your description', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'       => esc_html__( 'HTML Tag', 'oxence-toolkit' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
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
                'default'     => 'h6',
                'toggle'      => false,
            ]
        );

        $this->add_responsive_control(
            'text_align',
            [
                'label'       => esc_html__( 'Alignment', 'oxence-toolkit' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'start'  => [
                        'title' => esc_html__( 'Left', 'oxence-toolkit' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'oxence-toolkit' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'end'    => [
                        'title' => esc_html__( 'Right', 'oxence-toolkit' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors'   => [
                    '{{WRAPPER}} .oxence-counter-box'               => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .oxence-counter-box .counter-wrap' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_counter_box',
            [
                'label' => esc_html__( 'Counter Box', 'oxence-toolkit' ),
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
                    '{{WRAPPER}} .oxence-counter-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .oxence-counter-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'counter_box_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .oxence-counter-box',
            ]
        );

        $this->add_responsive_control(
            'info_box_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-counter-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs( 'counter_box_tab' );

        $this->start_controls_tab(
            'counter_box_normal',
            [
                'label' => esc_html__( 'Normal', 'oxence-toolkit' ),
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'counter_box_bg',
				'selector'  => '{{WRAPPER}} .oxence-counter-box',
			]
		);

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'counter_box_shadow',
                'selector' => '{{WRAPPER}} .oxence-counter-box',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'counter_box_hover',
            [
                'label' => esc_html__( 'Hover', 'oxence-toolkit' ),
            ]
        );

        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'counter_box_hover_bg',
				'selector'  => '{{WRAPPER}} .oxence-counter-box:hover',
			]
		);

        $this->add_control(
            'counter_box_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'counter_box_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .oxence-counter-box:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'counter_box_hover_shadow',
                'selector' => '{{WRAPPER}} .oxence-counter-box:hover',
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
                            'name'     => 'selected_image[url]',
                            'operator' => '!=',
                            'value'    => '',
                        ],
                    ],
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
                    '{{WRAPPER}} .oxence-counter-box .counter-icon'       => 'color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-counter-box .counter-icon svg *' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'icon_type!' => 'image',
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
                    '{{WRAPPER}} .oxence-counter-box .counter-icon'     => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .oxence-counter-box .counter-icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],
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
                    '{{WRAPPER}} .oxence-counter-box .counter-icon i, {{WRAPPER}} .oxence-counter-box .counter-icon img, {{WRAPPER}} .oxence-counter-box .counter-icon svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_space',
            [
                'label'     => esc_html__( 'Spacing', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'separator' => 'before',
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .oxence-counter-box .counter-icon' => 'margin-bottom: {{SIZE}}px;',
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
                    '{{WRAPPER}} .oxence-counter-box:hover .counter-icon'       => 'color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-counter-box:hover .counter-icon svg *' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'icon_type!' => 'image',
                ],
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
                    '{{WRAPPER}} .oxence-counter-box:hover .counter-icon i, {{WRAPPER}} .oxence-counter-box:hover .counter-icon img, {{WRAPPER}} .oxence-counter-box:hover .counter-icon svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_counter_style',
            [
                'label' => esc_html__( 'Counter', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs( 'tabs-counter_style' );

        $this->start_controls_tab(
            'tab_counter_style_normal',
            [
                'label' => esc_html__( 'Normal', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'counter_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-counter-box .counter-wrap' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'counter_typography',
                'selector' => '{{WRAPPER}} .oxence-counter-box .counter-wrap',
            ]
        );

        $this->add_responsive_control(
            'counter_bottom_space',
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
                    '{{WRAPPER}} .oxence-counter-box .counter-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_counter_style_hover',
            [
                'label' => esc_html__( 'Hover', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'counter_hover_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-counter-box:hover .counter-wrap' => 'color: {{VALUE}};',
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
                'conditions' => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'name'     => 'title_text',
                            'operator' => '!=',
                            'value'    => '',
                        ],
                        [
                            'name'     => 'description_text',
                            'operator' => '!=',
                            'value'    => '',
                        ],
                    ],
                ],
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
                'condition' => [
                    'title_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-counter-box .counter-title' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'title_text!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .oxence-counter-box .counter-title',
                'condition' => [
                    'title_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'desc_heading',
            [
                'label'     => esc_html__( 'Description', 'oxence-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'description_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-counter-box .counter-desc' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'description_text!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'desc_typography',
                'selector' => '{{WRAPPER}} .oxence-counter-box .counter-desc',
                'condition' => [
                    'description_text!' => '',
                ],
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
                    '{{WRAPPER}} .oxence-counter-box .counter-desc' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'description_text!' => '',
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
                'condition' => [
                    'title_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-counter-box:hover .counter-title' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'title_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'desc_hover_heading',
            [
                'label'     => esc_html__( 'Description', 'oxence-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'description_text!' => '',
                ],
            ]
        );

        $this->add_control(
            'desc_hover_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-counter-box:hover .counter-desc' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'description_text!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render_icon() {
        $settings = $this->get_settings_for_display();

        $has_icon  = ! empty( $settings['icon'] );
        $has_image = ! empty( $settings['selected_image']['url'] );

        if ( $has_icon && 'icon' == $settings['icon_type'] ) {
            $this->add_render_attribute( 'font-icon', 'class', $settings['icon'] );
            $this->add_render_attribute( 'font-icon', 'aria-hidden', 'true' );
        } elseif ( $has_image && 'image' == $settings['icon_type'] ) {
            $this->add_render_attribute( 'image-icon', 'src', $settings['selected_image']['url'] );
            $this->add_render_attribute( 'image-icon', 'alt', $settings['title_text'] );
        }

        if ( ! $has_icon && ! empty( $settings['selected_icon']['value'] ) ) {
            $has_icon = true;
        }

        $migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
        $is_new   = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

        if ( $has_icon || $has_image ): ?>
        <div class="counter-icon">
            <?php if ( $has_icon and 'icon' == $settings['icon_type'] ): ?>
                <?php if ( $is_new || $migrated ): ?>
                    <?php Icons_Manager::render_icon( $settings['selected_icon'], ['aria-hidden' => 'true'] );?>
                <?php else: ?>
                    <i <?php echo $this->get_render_attribute_string( 'font-icon' ); ?>></i>
                <?php endif;?>
            <?php elseif ( $has_image and 'image' == $settings['icon_type'] ): ?>
                <img <?php echo $this->get_render_attribute_string( 'image-icon' ); ?>>
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
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'counter', [
            'class'           => 'elementor-counter-number',
            'data-duration'   => $settings['duration'],
            'data-to-value'   => $settings['ending_number'],
            'data-from-value' => $settings['starting_number'],
        ] );

        if ( ! empty( $settings['thousand_separator'] ) ) {
            $delimiter = empty( $settings['thousand_separator_char'] ) ? ',' : $settings['thousand_separator_char'];
            $this->add_render_attribute( 'counter', 'data-delimiter', $delimiter );
        }
        ?>
        <div class="oxence-counter-box">
            <?php $this->render_icon();?>
            <?php if ( $settings['ending_number'] && $settings['starting_number'] ): ?>
            <div class="counter-wrap">
                <?php
                    if ( $settings['prefix'] ) {
                        printf( '<span class="counter-prefix">%1$s</span>',
                            esc_html( $settings['prefix'] )
                        );
                    }

                    if ( $settings['ending_number'] && $settings['starting_number'] ) {
                        printf( '<span %1$s>%2$s</span>',
                            $this->get_render_attribute_string( 'counter' ),
                            esc_html( $settings['starting_number'] )
                        );
                    }

                    if ( $settings['suffix'] ) {
                        printf( '<span class="counter-suffix">%1$s</span>',
                            esc_html( $settings['suffix'] )
                        );
                    }
                ?>
            </div>
            <?php endif;?>
            <?php
                if ( $settings['title_text'] ) {
                    $this->add_render_attribute( 'title_text', 'class', 'counter-title' );
                    $this->add_inline_editing_attributes( 'title_text', 'none' );

                    printf( '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape( $settings['title_tag'] ),
                        $this->get_render_attribute_string( 'title_text' ),
                        ot_kses_basic( $settings['title_text'] )
                    );
                }

                if ( ! empty( $settings['description_text'] ) ) {
                    $this->add_render_attribute( 'description_text', 'class', 'counter-desc' );
                    $this->add_inline_editing_attributes( 'description_text', 'basic' );

                    printf( '<p %1$s>%2$s</p>',
                        $this->get_render_attribute_string( 'description_text' ),
                        wp_kses_post( $settings['description_text'] )
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

            view.addRenderAttribute( 'title_text', 'class', 'counter-title' );
            view.addInlineEditingAttributes( 'title', 'none' );
        #>
        <div class="oxence-counter-box">
            <# if (( settings.selected_image.url && settings.icon_type == 'image' ) || ( settings.icon  && settings.icon_type == 'icon' ) || ( settings.selected_icon.value  && settings.icon_type == 'icon' )) { #>
            <div class="counter-icon">
                <# if ( settings.selected_image.url && settings.icon_type == 'image' ) { #>
                    <img src="{{{settings.selected_image.url}}}" alt="{{{ settings.title_text }}}">
                <# } else if ( settings.selected_icon.value  && settings.icon_type == 'icon' ) { #>
                    <# if ( iconHTML && iconHTML.rendered && ( ! settings.icon || migrated ) ) { #>
                        {{{ iconHTML.value }}}
                    <# } else { #>
                        <i class="{{ settings.icon }}" aria-hidden="true"></i>
                    <# } #>
                <# } #>
            </div>
            <# } #>
            <# if ( settings.ending_number && settings.starting_number ) { #>
            <div class="counter-wrap">
                <# if( settings.prefix ) { #>
                    <span class="counter-prefix">{{{ settings.prefix }}}</span>
                <# } #>
                <span class="elementor-counter-number" data-duration="{{ settings.duration }}" data-to-value="{{ settings.ending_number }}" data-delimiter="{{ settings.thousand_separator ? settings.thousand_separator_char || ',' : '' }}">{{{ settings.starting_number }}}</span>
                <# if( settings.suffix ) { #>
                    <span class="counter-suffix">{{{ settings.suffix }}}</span>
                <# } #>
            </div>
            <# } #>
            <# if( settings.title_text ) { #>
                <{{{ settings.title_tag }}} {{{ view.getRenderAttributeString( 'title_text' ) }}}>{{{ settings.title_text }}}</{{{ settings.title_tag }}}>
            <# } #>
            <# if ( settings.description_text ) {
                view.addRenderAttribute( 'description_text', 'class', 'counter-desc' );
                view.addInlineEditingAttributes( 'description_text', 'basic' ); #>
                <p {{{ view.getRenderAttributeString('description_text') }}}>
                    {{{ settings.description_text }}}
                </p>
            <# } #>
        </div>
        <?php
    }
}