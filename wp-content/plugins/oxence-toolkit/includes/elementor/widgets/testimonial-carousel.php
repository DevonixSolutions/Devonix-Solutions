<?php
namespace OxenceToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Testimonial_Carousel extends Widget_Base {

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
        return 'oxence-testimonial';
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
        return esc_html__( 'Testimonial Carousel', 'oxence-toolkit' );
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
        return 'eicon-testimonial-carousel';
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
        return ['oxence', 'toolkit', 'fancy', 'iconic'];
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
                'label' => esc_html__( 'Testimonial', 'oxence-toolkit' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'content',
            [
                'label' => esc_html__( 'Content', 'oxence-toolkit' ),
                'type'  => Controls_Manager::TEXTAREA,
                'rows'  => 10,
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label'     => esc_html__( 'Image', 'oxence-toolkit' ),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'placarder' => esc_html__( 'Enter client feedback', 'oxence-toolkit' ),
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'name',
            [
                'label'     => esc_html__( 'Name', 'oxence-toolkit' ),
                'type'      => Controls_Manager::TEXT,
                'placarder' => esc_html__( 'Enter client name', 'oxence-toolkit' ),
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'     => esc_html__( 'Title', 'oxence-toolkit' ),
                'type'      => Controls_Manager::TEXT,
                'placarder' => esc_html__( 'Enter client title', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'label'       => esc_html__( 'Testimonials', 'oxence-toolkit' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => $this->get_repeater_defaults(),
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->add_control(
            'image_position',
            [
                'label'   => esc_html__( 'Image Position', 'oxence-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'image-inline',
                'options' => [
                    'image-inline'  => esc_html__( 'Image Inline', 'oxence-toolkit' ),
                    'image-stacked' => esc_html__( 'Image Stacked', 'oxence-toolkit' ),
                    'image-above'   => esc_html__( 'Image Above', 'oxence-toolkit' ),
                    'image-left'    => esc_html__( 'Image Left', 'oxence-toolkit' ),
                    'image-right'   => esc_html__( 'Image Right', 'oxence-toolkit' ),
                ],
            ]
        );

        $this->add_control(
            'alignment',
            [
                'label'   => esc_html__( 'Alignment', 'oxence-toolkit' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
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
            ]
        );

        $this->add_control(
            'quote_icon',
            [
                'label'   => esc_html__( 'Quote Icon', 'oxence-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none'          => esc_html__( 'None', 'oxence-toolkit' ),
                    'above-content' => esc_html__( 'Above Content', 'oxence-toolkit' ),
                    'on-image'      => esc_html__( 'On Author Image', 'oxence-toolkit' ),
                    'on-top-center'        => esc_html__( 'On Top Center', 'oxence-toolkit' ),
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_additional_options',
            [
                'label' => esc_html__( 'Carousel Options', 'oxence-toolkit' ),
            ]
        );

        $slides_per_view = range( 1, 10 );
        $slides_per_view = array_combine( $slides_per_view, $slides_per_view );

        $this->add_responsive_control(
            'slides_per_view',
            [
                'type'                 => Controls_Manager::SELECT,
                'label'                => esc_html__( 'Slides Per View', 'oxence-toolkit' ),
                'options'              => $slides_per_view,
                'widescreen_default'   => 1,
                'default'              => 1,
                'laptop_default'       => 1,
                'tablet_extra_default' => 1,
                'tablet_default'       => 1,
                'mobile_extra_default' => 1,
                'mobile_default'       => 1,
                'frontend_available'   => true,
            ]
        );

        $this->add_responsive_control(
            'slides_to_scroll',
            [
                'type'                 => Controls_Manager::SELECT,
                'label'                => esc_html__( 'Slides to Scroll', 'oxence-toolkit' ),
                'description'          => esc_html__( 'Set how many slides are scrolled per swipe.', 'oxence-toolkit' ),
                'options'              => $slides_per_view,
                'widescreen_default'   => 1,
                'default'              => 1,
                'laptop_default'       => 1,
                'tablet_extra_default' => 1,
                'tablet_default'       => 1,
                'mobile_extra_default' => 1,
                'mobile_default'       => 1,
                'frontend_available'   => true,
            ]
        );

        $this->add_control(
            'show_arrows',
            [
                'type'               => Controls_Manager::SWITCHER,
                'label'              => esc_html__( 'Arrows', 'oxence-toolkit' ),
                'default'            => '',
                'label_off'          => esc_html__( 'Hide', 'oxence-toolkit' ),
                'label_on'           => esc_html__( 'Show', 'oxence-toolkit' ),
                'frontend_available' => true,
                'separator'          => 'before',
            ]
        );

        $this->add_control(
            'show_dots',
            [
                'type'               => Controls_Manager::SWITCHER,
                'label'              => esc_html__( 'Dots', 'oxence-toolkit' ),
                'default'            => '',
                'label_off'          => esc_html__( 'Hide', 'oxence-toolkit' ),
                'label_on'           => esc_html__( 'Show', 'oxence-toolkit' ),
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'speed',
            [
                'label'              => esc_html__( 'Animation Duration', 'oxence-toolkit' ),
                'type'               => Controls_Manager::NUMBER,
                'default'            => 500,
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'              => esc_html__( 'Autoplay', 'oxence-toolkit' ),
                'type'               => Controls_Manager::SWITCHER,
                'default'            => 'yes',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label'              => esc_html__( 'Autoplay Speed', 'oxence-toolkit' ),
                'type'               => Controls_Manager::NUMBER,
                'default'            => 5000,
                'condition'          => [
                    'autoplay' => 'yes',
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'loop',
            [
                'label'              => esc_html__( 'Infinite Loop', 'oxence-toolkit' ),
                'type'               => Controls_Manager::SWITCHER,
                'default'            => 'yes',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label'              => esc_html__( 'Pause on Hover', 'oxence-toolkit' ),
                'type'               => Controls_Manager::SWITCHER,
                'default'            => 'yes',
                'condition'          => [
                    'autoplay' => 'yes',
                ],
                'frontend_available' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'testimonial_item',
            [
                'label' => esc_html__( 'Testimonial Item', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'testimonial_margin',
            [
                'label'      => esc_html__( 'Margin', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-testimonial' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonial_padding',
            [
                'label'      => esc_html__( 'Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'testimonial_bg',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-testimonial' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'testimonial_normal_border',
                'label'    => esc_html__( 'Border', 'oxence-toolkit' ),
                'selector' => '{{WRAPPER}} .oxence-testimonial',
            ]
        );

        $this->add_responsive_control(
            'testimonial_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-testimonial' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'testimonial_box_shadow',
                'selector' => '{{WRAPPER}} .oxence-testimonial',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'content',
            [
                'label' => esc_html__( 'Content', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-testimonial .content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .oxence-testimonial .content p',
            ]
        );

        $this->add_control(
            'content_spacing',
            [
                'label'      => esc_html__( 'Spacing', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-testimonial .content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'author_info',
            [
                'label' => esc_html__( 'Author Information', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'name_heading',
            [
                'label' => esc_html__( 'Name', 'oxence-toolkit' ),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-testimonial .author-info .name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typography',
                'selector' => '{{WRAPPER}} .oxence-testimonial .author-info .name',
            ]
        );

        $this->add_control(
            'name_spacing',
            [
                'label'      => esc_html__( 'Bottom Spacing', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-testimonial .author-info .name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_heading',
            [
                'label'     => esc_html__( 'Title', 'oxence-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-testimonial .author-info .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .oxence-testimonial .author-info .title',
            ]
        );

        $this->add_control(
            'photo_heading',
            [
                'label'     => esc_html__( 'Photo', 'oxence-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'photo_size',
            [
                'label'      => esc_html__( 'Photo Size', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 500,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-testimonial .author-img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'photo_border',
                'label'    => esc_html__( 'Border', 'oxence-toolkit' ),
                'selector' => '{{WRAPPER}} .oxence-testimonial .author-img img',
            ]
        );

        $this->add_responsive_control(
            'photo_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-testimonial .author-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_gap',
            [
                'label'      => esc_html__( 'Spacing', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-testimonial' => '--image-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'photo_shadow',
                'selector' => '{{WRAPPER}} .oxence-testimonial .author-img img',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'quote_icon_style',
            [
                'label'     => esc_html__( 'Quote Icon', 'oxence-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'quote_icon!' => 'none',
                ],
            ]
        );

        $this->add_control(
            'quote_icon_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-testimonial .quote-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'quote_icon_bg',
            [
                'label'     => esc_html__( 'Background', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-testimonial .quote-icon' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'quote_icon_size',
            [
                'label'      => esc_html__( 'Size', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-testimonial .quote-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'quote_icon_width_height',
            [
                'label'      => esc_html__( 'Height/Width', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 250,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-testimonial .quote-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'quote_icon_shadow',
                'selector' => '{{WRAPPER}} .oxence-testimonial .quote-icon',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_dots_nav_style',
            [
                'label'      => esc_html__( 'Dots/Nav', 'oxence-toolkit' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'name'     => 'show_dots',
                            'operator' => '==',
                            'value'    => 'yes',
                        ],
                        [
                            'name'     => 'show_arrows',
                            'operator' => '==',
                            'value'    => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'dots_header',
            [
                'label'     => esc_html__( 'Dots', 'oxence-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'show_dots' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'dots_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-slider-active .slick-dots li' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'show_dots' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'dots_active_color',
            [
                'label'     => esc_html__( 'Color(Active)', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-slider-active .slick-dots li.slick-active' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'show_dots' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'dots_margin_top',
            [
                'label'      => esc_html__( 'Top Space', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'separator'  => 'before',
                'selectors'  => [
                    '{{WRAPPER}} .oxence-slider-active .slick-dots' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'arrows_header',
            [
                'label'     => esc_html__( 'Arrows', 'oxence-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'show_arrows' => 'yes',
                ],
            ]
        );

        $this->start_controls_tabs( 'arrows_tab' );

        $this->start_controls_tab(
            'arrows_normal',
            [
                'label'     => esc_html__( 'Normal', 'oxence-toolkit' ),
                'condition' => [
                    'show_arrows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrows_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-slider-active .slick-arrow' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_arrows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrows_bg',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-slider-active .slick-arrow' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'show_arrows' => 'yes',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'arrows_hover',
            [
                'label' => esc_html__( 'Hover', 'oxence-toolkit' ),
                'condition' => [
                    'show_arrows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrows_hover_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-slider-active .slick-arrow:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_arrows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrows_hover_bg',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-slider-active .slick-arrow:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'show_arrows' => 'yes',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /**
     * Repeater Defaults
     *
     * @return void
     */
    protected function get_repeater_defaults() {
        $placeholder_image_src = Utils::get_placeholder_image_src();

        return [
            [
                'content' => esc_html__( 'Sed ut perspiciatis unde omnis natus error voluptatem accusantium dolore laudantuce totam rem aperiam eaque inventore', 'oxence-toolkit' ),
                'image'   => [
                    'url' => $placeholder_image_src,
                ],
                'name'    => esc_html__( 'Jonathan B. Bohnert', 'oxence-toolkit' ),
                'title'   => esc_html__( 'CEO & Founder', 'oxence-toolkit' ),
            ],
            [
                'content' => esc_html__( 'Sed ut perspiciatis unde omnis natus error voluptatem accusantium dolore laudantuce totam rem aperiam eaque inventore', 'oxence-toolkit' ),
                'image'   => [
                    'url' => $placeholder_image_src,
                ],
                'name'    => esc_html__( 'Nicholas R. Gomez', 'oxence-toolkit' ),
                'title'   => esc_html__( 'Medical Officers', 'oxence-toolkit' ),
            ],
            [
                'content' => esc_html__( 'Sed ut perspiciatis unde omnis natus error voluptatem accusantium dolore laudantuce totam rem aperiam eaque inventore', 'oxence-toolkit' ),
                'image'   => [
                    'url' => $placeholder_image_src,
                ],
                'name'    => esc_html__( 'James R. Lawrence', 'oxence-toolkit' ),
                'title'   => esc_html__( 'Junior Manager', 'oxence-toolkit' ),
            ],
        ];
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
        $wrapper = 'oxence-testimonial alignment-' . $settings['alignment'] . ' '. $settings['image_position'] . ' quote-' .  $settings['quote_icon'];
        ?>
        <div class="oxence-slider-active oxence-testimonial-carousel">
            <?php foreach ( $settings['testimonials'] as $index => $testimonial ) : ?>
                <div class="oxence-slider-item">
                    <div class="<?php echo esc_attr( $wrapper ) ?>">
                        <?php
                            if ( 'on-top-center' === $settings['quote_icon'] ) {
                                echo '<span class="quote-icon"><i class="fas fa-quote-left"></i></span>';
                            }
                        ?>
                        <?php if ( 'image-inline' !== $settings['image_position'] && 'image-stacked' !== $settings['image_position'] ) : ?>
                        <div class="author-img">
                            <?php
                                printf( '<img src="%1$s" alt="%2$s">',
                                    esc_url( $testimonial['image']['url'] ),
                                    esc_html( $testimonial['name'] )
                                );
                                if ( 'on-image' === $settings['quote_icon'] ) {
                                    echo '<span class="quote-icon"><i class="fas fa-quote-left"></i></span>';
                                }
                            ?>
                        </div>
                        <?php endif; ?>
                        <div class="content">
                            <?php
                                if ( 'above-content' === $settings['quote_icon'] ) {
                                    echo '<span class="quote-icon"><i class="fas fa-quote-right"></i></span>';
                                }
                                printf( '<p>%1$s</p>',
                                    esc_html( $testimonial['content'] )
                                );
                            ?>
                            <?php if ( 'image-inline' !== $settings['image_position'] && 'image-stacked' !== $settings['image_position'] ) : ?>
                                <div class="author-info">
                                    <?php
                                        if( $testimonial['name'] ) {
                                            printf( '<h5 class="name">%1$s</h5>',
                                                esc_html( $testimonial['name'] )
                                            );
                                        }
                                        if( $testimonial['title'] ) {
                                            printf( '<span class="title">%1$s</span>',
                                                esc_html( $testimonial['title'] )
                                            );
                                        }
                                    ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if ( 'image-inline' === $settings['image_position'] || 'image-stacked' === $settings['image_position'] ) : ?>
                            <div class="author-info-wrapper">
                                    <?php if ( $testimonial['image']['url'] ) : ?>
                                    <div class="author-img">
                                        <?php
                                            printf( '<img src="%1$s" alt="%2$s">',
                                                esc_url( $testimonial['image']['url'] ),
                                                esc_html( $testimonial['name'] )
                                            );
                                            if ( 'on-image' === $settings['quote_icon'] ) {
                                                echo '<span class="quote-icon"><i class="fas fa-quote-right"></i></span>';
                                            }
                                        ?>
                                    </div>
                                <?php endif; ?>
                                <div class="author-info">
                                    <?php
                                        if( $testimonial['name'] ) {
                                            printf( '<h5 class="name">%1$s</h5>',
                                                esc_html( $testimonial['name'] )
                                            );
                                        }
                                        if( $testimonial['title'] ) {
                                            printf( '<span class="title">%1$s</span>',
                                                esc_html( $testimonial['title'] )
                                            );
                                        }
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <?php
    }
}