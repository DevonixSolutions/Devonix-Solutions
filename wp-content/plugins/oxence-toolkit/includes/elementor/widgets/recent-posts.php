<?php
namespace OxenceToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use OxenceToolkit\ElementorAddon\Templates\Recent_Post_Template;

defined( 'ABSPATH' ) || exit;

class Recent_Posts extends Widget_Base {

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
        return 'oxence-recent-posts';
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
        return esc_html__( 'Recent Posts', 'oxence-toolkit' );
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
        return 'eicon-posts-grid';
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
        return ['oxence', 'toolkit', 'recent', 'post', 'grid', 'slider', 'blog'];
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
            'design',
            [
                'label'   => esc_html__( 'Design', 'oxence-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'grid-view',
                'options' => [
                    'grid-view' => esc_html__( 'Design One', 'oxence-toolkit' ),
                    'list-view' => esc_html__( 'Design Two', 'oxence-toolkit' ),
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
                'label'   => esc_html__( 'Post From', 'oxence-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'all'           => esc_html__( 'All Posts', 'oxence-toolkit' ),
                    'specific-post' => esc_html__( 'Specific Post', 'oxence-toolkit' ),
                ],
                'default' => 'all',
            ]
        );

        $this->add_control(
            'post_ids',
            [
                'label'       => esc_html__( 'Select Post', 'oxence-toolkit' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => ot_select_post( 'post' ),
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
                'default'     => 'h4',
                'toggle'      => false,
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'post_thumbnail',
                'default' => 'large',
                'exclude' => [
                    'custom',
                ],
            ]
        );

        $this->add_control(
            'show_excerpt',
            [
                'label'        => esc_html__( 'Show Excerpt?', 'oxence-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'oxence-toolkit' ),
                'label_off'    => esc_html__( 'Hide', 'oxence-toolkit' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'excerpt_count',
            [
                'label' => esc_html__( 'Excerpt Word', 'oxence-toolkit' ),
                'type'  => Controls_Manager::NUMBER,
                'default' => 12,
                'condition' => [
                    'show_excerpt' => 'yes'
                ]
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
                'label'     => esc_html__( 'Read More Text', 'oxence-toolkit' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__( 'Read More', 'oxence-toolkit' ),
                'condition' => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_post_meta',
            [
                'label'        => esc_html__( 'Show Post Meta', 'oxence-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'label_on'     => esc_html__( 'Yes', 'oxence-toolkit' ),
                'label_off'    => esc_html__( 'No', 'oxence-toolkit' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label'        => esc_html__( 'Show Pagination', 'oxence-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'label_on'     => esc_html__( 'Yes', 'oxence-toolkit' ),
                'label_off'    => esc_html__( 'No', 'oxence-toolkit' ),
                'return_value' => 'yes',
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
            'recent_post_style',
            [
                'label' => esc_html__( 'Recent Post', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'item_margin',
            [
                'label'      => esc_html__( 'Margin', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-recent-post .entry-post' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label'      => esc_html__( 'Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-recent-post .entry-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_align',
            [
                'label'     => esc_html__( 'Text Align', 'oxence-toolkit' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
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
                'selectors' => [
                    '{{WRAPPER}} .oxence-recent-post .entry-post'                => 'text-align: {{Value}};',
                    '{{WRAPPER}} .oxence-recent-post .entry-summary .entry-post-meta' => 'justify-content: {{Value}};',
                ],
            ]
        );

        $this->add_control(
            'item_bg',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-recent-post .entry-post' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'recent_post_shadow',
                'selector' => '{{WRAPPER}} .oxence-recent-post .entry-post',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'thumbnail_style',
            [
                'label' => esc_html__( 'Thumbnail', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'thumbnail_width',
            [
                'label'      => esc_html__( 'Width', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .entry-post .entry-media' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'thumbnail_height',
            [
                'label'      => esc_html__( 'Height', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .entry-post .entry-media' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'content_area',
            [
                'label' => esc_html__( 'Content Area', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_margin',
            [
                'label'      => esc_html__( 'Margin', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .entry-post .entry-summary' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => esc_html__( 'Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .entry-post .entry-summary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'content_area_bg',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .entry-post .entry-summary' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_area_shadow',
                'selector' => '{{WRAPPER}} .entry-post .entry-summary',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'content_color_typography',
            [
                'label' => esc_html__( 'Color & Typography', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
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
                    '{{WRAPPER}} .entry-post .entry-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .entry-post .entry-title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .entry-post .entry-title',
            ]
        );

        $this->add_responsive_control(
            'title_gap',
            [
                'label'      => esc_html__( 'Gap', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .entry-post .entry-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'category_heading',
            [
                'label'     => esc_html__( 'Post Meta', 'oxence-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show_post_meta' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'category_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .entry-post .entry-summary .entry-post-meta a, {{WRAPPER}} .entry-post .entry-summary .entry-post-meta' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .entry-post .entry-summary .entry-post-meta span:not(:last-child)::after'                          => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'show_post_meta' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'category_color_hover',
            [
                'label'     => esc_html__( 'Color(Hover)', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .entry-post .entry-summary .entry-post-meta a:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_post_meta' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'categories_typography',
                'selector'  => '.entry-post .entry-summary .entry-post-meta',
                'condition' => [
                    'show_post_meta' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'meta_gap',
            [
                'label'      => esc_html__( 'Gap', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .entry-post .entry-summary .entry-post-meta' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'show_post_meta' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'excerpt_heading',
            [
                'label'     => esc_html__( 'Excerpt', 'oxence-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .entry-post .entry-summary p' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'excerpt_typography',
                'selector'  => '{{WRAPPER}} .entry-post .entry-summary p',
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'button_heading',
            [
                'label'     => esc_html__( 'Read More', 'oxence-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_gap',
            [
                'label'      => esc_html__( 'Gap', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .entry-post .entry-summary .read-more' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .entry-post .entry-summary .read-more' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'button_color_hover',
            [
                'label'     => esc_html__( 'Color(Hover)', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .entry-post .entry-summary .read-more:hover' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'button_typography',
                'selector'  => '{{WRAPPER}} .entry-post .entry-summary .read-more',
                'condition' => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pagination_style',
            [
                'label'     => esc_html__( 'Pagination', 'oxence-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_pagination' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_gap',
            [
                'label'      => esc_html__( 'Gap', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-pagination' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_size',
            [
                'label'      => esc_html__( 'Size', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-pagination .page-numbers' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'      => esc_html__( 'Text Size', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-pagination .page-numbers' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_pagination_style' );

        $this->start_controls_tab(
            'tab_pagination_normal',
            [
                'label' => esc_html__( 'Normal', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'pagination_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-pagination .page-numbers' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-pagination .page-numbers' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_bg',
            [
                'label'     => esc_html__( 'Background', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-pagination .page-numbers' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_pagination_hover',
            [
                'label' => esc_html__( 'Hover', 'oxence-toolkit' ),
            ]
        );
        $this->add_control(
            'hover_pagination_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-pagination .page-numbers:hover, {{WRAPPER}} .oxence-pagination .page-numbers.current' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_pagination_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-pagination .page-numbers:hover, {{WRAPPER}} .oxence-pagination .page-numbers.current' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_pagination_bg',
            [
                'label'     => esc_html__( 'Background', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-pagination .page-numbers:hover, {{WRAPPER}} .oxence-pagination .page-numbers.current' => 'background-color: {{VALUE}};',
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
                'separator' => 'before',
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
                'label'     => esc_html__( 'Hover', 'oxence-toolkit' ),
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

        $template = new Recent_Post_Template();
        $template->render( $settings );
    }
}