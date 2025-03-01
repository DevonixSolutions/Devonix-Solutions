<?php
namespace OxenceToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use OxenceToolkit\ElementorAddon\Templates\Service_Template;

defined( 'ABSPATH' ) || exit;

class Services extends Widget_Base {

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
        return 'oxence-services';
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
        return esc_html__( 'Services', 'oxence-toolkit' );
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
        return 'eicon-gallery-grid';
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
        return ['oxence', 'toolkit', 'service'];
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
            'layout',
            [
                'label'   => esc_html__( 'Layout', 'oxence-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid'   => esc_html__( 'Grid', 'oxence-toolkit' ),
                    'slider' => esc_html__( 'Slider', 'oxence-toolkit' ),
                ],
            ]
        );

        $this->add_control(
            'post_source',
            [
                'label'     => esc_html__( 'Source', 'oxence-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'post_from', [
                'label'   => esc_html__( 'Service From', 'oxence-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'all'           => esc_html__( 'All Services', 'oxence-toolkit' ),
                    'specific-post' => esc_html__( 'Specific Service', 'oxence-toolkit' ),
                ],
                'default' => 'all',
            ]
        );

        $this->add_control(
            'post_ids',
            [
                'label'       => esc_html__( 'Select Service', 'oxence-toolkit' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => ot_select_post( 'oxence_service' ),
                'multiple'    => true,
                'label_block' => true,
                'condition'   => [
                    'post_from' => 'specific-post',
                ],
            ]
        );

        $this->add_control(
            'post_limit', [
                'label'   => esc_html__( 'Limit Item', 'oxence-toolkit' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 10,
                'min'     => 1,
            ]
        );

        $this->add_control(
            'order_by', [
                'label'   => esc_html__( 'Order By', 'oxence-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'ID'     => esc_html__( 'ID', 'oxence-toolkit' ),
                    'author' => esc_html__( 'Author', 'oxence-toolkit' ),
                    'title'  => esc_html__( 'Title', 'oxence-toolkit' ),
                    'date'   => esc_html__( 'Date', 'oxence-toolkit' ),
                    'rand'   => esc_html__( 'Random', 'oxence-toolkit' ),
                ],
                'default' => 'date',
            ]
        );

        $this->add_control(
            'sort_order', [
                'label'   => esc_html__( 'Sort Order', 'oxence-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'ASC'  => esc_html__( 'Ascending', 'oxence-toolkit' ),
                    'DESC' => esc_html__( 'Descending', 'oxence-toolkit' ),
                ],
                'default' => 'DESC',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'post_settings',
            [
                'label' => esc_html__( 'Settings', 'oxence-toolkit' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'post_thumbnail',
                'default' => 'full',
                'exclude' => [
                    'custom',
                ],
            ]
        );

        $this->add_control(
            'show_read_more',
            [
                'label'        => esc_html__( 'Show Read More', 'oxence-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'label_on'     => esc_html__( 'Yes', 'oxence-toolkit' ),
                'label_off'    => esc_html__( 'No', 'oxence-toolkit' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'read_more_text',
            [
                'label'     => esc_html__( 'Show Read More', 'oxence-toolkit' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__( 'Service Details', 'oxence-toolkit' ),
                'condition' => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'grid_heading',
            [
                'label'     => esc_html__( 'Grid Column', 'oxence-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'layout' => 'grid',
                ],
            ]
        );

        $this->add_control(
            'grid_col',
            [
                'label'     => esc_html__( 'Desktop', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'col-lg-12' => esc_html__( '1 column', 'oxence-toolkit' ),
                    'col-lg-6'  => esc_html__( '2 column', 'oxence-toolkit' ),
                    'col-lg-4'  => esc_html__( '3 column', 'oxence-toolkit' ),
                    'col-lg-3'  => esc_html__( '4 column', 'oxence-toolkit' ),
                ],
                'default'   => 'col-lg-4',
                'condition' => [
                    'layout' => 'grid',
                ],
            ]
        );

        $this->add_control(
            'grid_col_tablet',
            [
                'label'     => esc_html__( 'Tablet', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'col-md-12' => esc_html__( '1 column', 'oxence-toolkit' ),
                    'col-md-6'  => esc_html__( '2 column', 'oxence-toolkit' ),
                    'col-md-4'  => esc_html__( '3 column', 'oxence-toolkit' ),
                    'col-md-3'  => esc_html__( '4 column', 'oxence-toolkit' ),
                ],
                'default'   => 'col-md-6',
                'condition' => [
                    'layout' => 'grid',
                ],
            ]
        );

        $this->add_control(
            'grid_col_mobile',
            [
                'label'     => esc_html__( 'Mobile', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'col-12' => esc_html__( '1 column', 'oxence-toolkit' ),
                    'col-6'  => esc_html__( '2 column', 'oxence-toolkit' ),
                    'col-4'  => esc_html__( '3 column', 'oxence-toolkit' ),
                ],
                'default'   => 'col-12',
                'condition' => [
                    'layout' => 'grid',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_additional_options',
            [
                'label'     => esc_html__( 'Carousel Options', 'oxence-toolkit' ),
                'condition' => [
                    'layout' => 'slider',
                ],
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
                'widescreen_default'   => 3,
                'default'              => 3,
                'laptop_default'       => 3,
                'tablet_extra_default' => 2,
                'tablet_default'       => 2,
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
            'service_box_style',
            [
                'label' => esc_html__( 'Service Box', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'service_box_margin',
            [
                'label'      => esc_html__( 'Margin', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-services .service-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'service_box_padding',
            [
                'label'      => esc_html__( 'Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-services .service-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'text_align',
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
                    '{{WRAPPER}} .oxence-services .service-box' => 'text-align: {{Value}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'service_box_tab' );

        $this->start_controls_tab(
            'service_box_normal',
            [
                'label' => esc_html__( 'Normal', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'item_normal_bg',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-services .service-box' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'item_border',
                'selector' => '{{WRAPPER}} .oxence-services .service-box',
            ]
        );

        $this->add_responsive_control(
            'item_box_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-services .service-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_box_shadow',
                'selector' => '{{WRAPPER}} .oxence-services .service-box',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'service_box_hover',
            [
                'label' => esc_html__( 'Hover', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'item_hover_bg',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-services .service-box:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'item_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-services .service-box:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_hover_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-services .service-box:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_box_hover_shadow',
                'selector' => '{{WRAPPER}} .oxence-services .service-box:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'title',
            [
                'label' => esc_html__( 'Title', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-services .service-box .title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-services .service-box .title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .oxence-services .service-box .title',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'button_style',
            [
                'label' => esc_html__( 'Button', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label'      => esc_html__( 'Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-services .service-box .read-more-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'selector' => '{{WRAPPER}} .oxence-services .service-box .read-more-btn',
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => esc_html__( 'Normal', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label'     => esc_html__( 'Text Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .oxence-services .service-box .read-more-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .oxence-services .service-box .read-more-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'button_border',
                'selector' => '{{WRAPPER}} .oxence-services .service-box .read-more-btn',
            ]
        );

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-services .service-box .read-more-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => esc_html__( 'Hover', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label'     => esc_html__( 'Text Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .oxence-services .service-box .read-more-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .oxence-services .service-box .read-more-btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .oxence-services .service-box .read-more-btn:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_hover_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-services .service-box .read-more-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

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
                'label' => esc_html__( 'Normal', 'oxence-toolkit' ),
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
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $template = new Service_Template();
        $template->render( $settings );
    }
}