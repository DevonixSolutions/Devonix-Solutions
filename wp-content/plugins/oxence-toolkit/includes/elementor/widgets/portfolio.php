<?php
namespace OxenceToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use OxenceToolkit\ElementorAddon\Templates\Portfolio_Template;

defined( 'ABSPATH' ) || exit;

class Portfolio extends Widget_Base {

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
        return 'oxence-portfolio';
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
        return esc_html__( 'Portfolio', 'oxence-toolkit' );
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
        return ['oxence', 'toolkit', 'portfolio', 'project', 'recent', 'grid', 'slider'];
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
                'default' => 'normal',
                'options' => [
                    'normal'        => esc_html__( 'Normal', 'oxence-toolkit' ),
                    'on-image'      => esc_html__( 'On Image Content', 'oxence-toolkit' ),
                    'hover-content' => esc_html__( 'Hover Content', 'oxence-toolkit' ),
                    'creative'      => esc_html__( 'Creative Style', 'oxence-toolkit' ),
                    'on-image-two'  => esc_html__( 'On Image Two', 'oxence-toolkit' ),
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
                'label'   => esc_html__( 'Portfolio From', 'oxence-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'all'           => esc_html__( 'All Portfolio', 'oxence-toolkit' ),
                    'categories'    => esc_html__( 'Categories', 'oxence-toolkit' ),
                    'specific-post' => esc_html__( 'Specific Portfolio', 'oxence-toolkit' ),
                ],
                'default' => 'all',
            ]
        );

        $this->add_control(
            'post_ids',
            [
                'label'       => esc_html__( 'Select Portfolio', 'oxence-toolkit' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => ot_select_post( 'oxence_portfolio' ),
                'multiple'    => true,
                'label_block' => true,
                'condition'   => [
                    'post_from' => 'specific-post',
                ],
            ]
        );

        $this->add_control(
            'cat_slugs',
            [
                'label'       => esc_html__( 'Select Categories', 'oxence-toolkit' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => ot_select_category( 'oxence_portfolio_category' ),
                'multiple'    => true,
                'label_block' => true,
                'condition'   => [
                    'post_from' => 'categories',
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

        $this->add_control(
            'show_filter',
            [
                'label'     => esc_html__( 'Show Filter', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_off' => esc_html__( 'Hide', 'oxence-toolkit' ),
                'label_on'  => esc_html__( 'Show', 'oxence-toolkit' ),
                'default'   => 'no',
                'separator' => 'before',
                'condition' => [
                    'layout' => 'grid',
                ],
            ]
        );

        $this->add_control(
            'important_note_isotope',
            [
                'label'      => esc_html__( 'Important Note', 'oxence-toolkit' ),
                'show_label' => false,
                'type'       => \Elementor\Controls_Manager::RAW_HTML,
                'raw'        => esc_html__( 'This will enable an Isotope filter option for your user. If you want specific categories for filtering, select the categories or leave them as they are', 'oxence-toolkit' ),
                'condition'  => [
                    'show_filter' => 'yes',
                    'layout'      => 'grid',
                ],
            ]
        );

        $this->add_control(
            'filter_cat_slugs',
            [
                'label'       => esc_html__( 'Filter Categories', 'oxence-toolkit' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => ot_select_category( 'oxence_portfolio_category' ),
                'multiple'    => true,
                'label_block' => true,
                'condition'   => [
                    'show_filter' => 'yes',
                    'layout'      => 'grid',
                ],
            ]
        );

        $this->add_control(
            'all_text', [
                'label'       => esc_html__( 'All Button Text', 'oxence-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'All', 'oxence-toolkit' ),
                'condition'   => [
                    'show_filter' => 'yes',
                    'layout'      => 'grid',
                ],
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
                'default' => 'large',
                'exclude' => [
                    'custom',
                ],
            ]
        );

        $this->add_control(
            'title_word',
            [
                'label'   => esc_html__( 'Title Length', 'oxence-toolkit' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 5,
            ]
        );

        $this->add_control(
            'show_category',
            [
                'label'        => esc_html__( 'Show Category?', 'oxence-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'oxence-toolkit' ),
                'label_off'    => esc_html__( 'Hide', 'oxence-toolkit' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'details_btn_text',
            [
                'label'     => esc_html__( 'Button Text?', 'oxence-toolkit' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html( 'Project Details', 'oxence-toolkit' ),
                'condition' => [
                    'design' => 'creative',
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
                'default'      => 'no',
                'condition'    => [
                    'design' => 'creative',
                ],
            ]
        );

        $this->add_control(
            'content_word',
            [
                'label'     => esc_html__( 'Excerpt Length', 'oxence-toolkit' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 25,
                'condition' => [
                    'show_excerpt' => 'yes',
                    'design'       => 'creative',
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
                    'layout'  => 'grid',
                    'design!' => 'creative',
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
                    'layout'  => 'grid',
                    'design!' => 'creative',
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
                    'layout'  => 'grid',
                    'design!' => 'creative',
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
                    'layout'  => 'grid',
                    'design!' => 'creative',
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

        $this->add_control(
            'center_mode',
            [
                'type'               => Controls_Manager::SWITCHER,
                'label'              => esc_html__( 'Center Mode', 'oxence-toolkit' ),
                'default'            => '',
                'label_off'          => esc_html__( 'Hide', 'oxence-toolkit' ),
                'label_on'           => esc_html__( 'Show', 'oxence-toolkit' ),
                'frontend_available' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'filter_area_style',
            [
                'label'     => esc_html__( 'Filter Buttons', 'oxence-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_filter' => 'yes',
                    'layout'      => 'grid',
                ],
            ]
        );

        $this->add_responsive_control(
            'filter_align',
            [
                'label'     => esc_html__( 'Alignment', 'oxence-toolkit' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
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
                'selectors' => [
                    '{{WRAPPER}} .oxence-portfolio .filter-nav-items' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'filter_area_margin',
            [
                'label'      => esc_html__( 'Margin', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-portfolio .filter-nav-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'filter_typography',
                'selector' => '{{WRAPPER}} .oxence-portfolio .filter-nav-items li',
            ]
        );

        $this->add_responsive_control(
            'filter_item_padding',
            [
                'label'      => esc_html__( 'Filter Item Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-portfolio .filter-nav-items li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'filter_item_margin',
            [
                'label'      => esc_html__( 'Filter Item Margin', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-portfolio .filter-nav-items li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'filter_tab' );

        $this->start_controls_tab(
            'filter_normal',
            [
                'label' => esc_html__( 'Normal', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'filter_normal_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-portfolio .filter-nav-items li' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'filter_normal_bg',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-portfolio .filter-nav-items li' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'filter_normal_shadow',
                'selector' => '{{WRAPPER}}  .oxence-portfolio .filter-nav-items li',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'filter_active',
            [
                'label' => esc_html__( 'Active', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'filter_active_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-portfolio .filter-nav-items li.active' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'filter_active_bg',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-portfolio .filter-nav-items li.active' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'filter_active_shadow',
                'selector' => '{{WRAPPER}}  .oxence-portfolio .filter-nav-items li.active',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'portfolio_item_style',
            [
                'label' => esc_html__( 'Portfolio Item', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'portfolio_item_margin',
            [
                'label'      => esc_html__( 'Margin', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-portfolio .portfolio-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'portfolio_item_padding',
            [
                'label'      => esc_html__( 'Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-portfolio .portfolio-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'column_gap',
            [
                'label'      => esc_html( 'Column Gap', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-portfolio > .row'                 => 'margin-left: -{{SIZE}}{{UNIT}}; margin-right: -{{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .oxence-portfolio > .row > [class*=col-]' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
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
                    '{{WRAPPER}} .oxence-portfolio .portfolio-item .portfolio-content' => 'text-align: {{Value}};',
                ],
                'condition' => [
                    'design!' => 'on-image-two',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'content_area_style',
            [
                'label' => esc_html__( 'Content', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_area_padding',
            [
                'label'      => esc_html__( 'Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-portfolio .portfolio-item .portfolio-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_area_margin',
            [
                'label'      => esc_html__( 'Margin', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-portfolio .portfolio-item .portfolio-content' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'content_area_bg',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-portfolio .portfolio-item .portfolio-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_area_shadow',
                'selector' => '{{WRAPPER}}  .oxence-portfolio .portfolio-item .portfolio-content',
            ]
        );

        $this->add_responsive_control(
            'thumb_height',
            [
                'label'      => esc_html__( 'Thumbnail Height', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 800,
                    ],
                ],
                'separator'  => 'before',
                'selectors'  => [
                    '{{WRAPPER}} .oxence-portfolio .portfolio-item .portfolio-thumbnail' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'overly_color',
            [
                'label'     => esc_html__( 'Overly Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-portfolio .portfolio-item .portfolio-thumbnail::before' => 'background-color: {{VALUE}};',
                ],
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
                    '{{WRAPPER}} .oxence-portfolio .portfolio-content .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-portfolio .portfolio-content .title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .oxence-portfolio .portfolio-content .title',
            ]
        );

        $this->add_control(
            'category_heading',
            [
                'label'     => esc_html__( 'Category', 'oxence-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show_category' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'category_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-portfolio .portfolio-content .categories'         => 'color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-portfolio .portfolio-content .categories a'       => 'color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-portfolio .portfolio-content .categories::before' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-portfolio .portfolio-content .categories::after'  => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'show_category' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'categories_typography',
                'selector'  => '{{WRAPPER}} .oxence-portfolio .portfolio-content .categories a',
                'condition' => [
                    'show_category' => 'yes',
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
                    'design'       => 'creative',
                ],
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-portfolio .portfolio-content p' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_excerpt' => 'yes',
                    'design'       => 'creative',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'excerpt_typography',
                'selector'  => '{{WRAPPER}} .oxence-portfolio .portfolio-content p',
                'condition' => [
                    'show_excerpt' => 'yes',
                    'design'       => 'creative',
                ],
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
            'button_size',
            [
                'label'      => esc_html__( 'Width/Height', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-portfolio .portfolio-item .portfolio-link' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'design!' => 'creative',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_font_size',
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
                    '{{WRAPPER}} .oxence-portfolio .portfolio-item .portfolio-link'     => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .oxence-portfolio .portfolio-item .portfolio-link svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'design!' => 'creative',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'button_typography',
                'selector'  => '{{WRAPPER}} .oxence-portfolio .portfolio-item .portfolio-link, {{WRAPPER}} .oxence-portfolio .portfolio-item .oxence-button',
                'condition' => [
                    'design' => 'creative',
                ],
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
                    '{{WRAPPER}} .oxence-portfolio .portfolio-item .portfolio-link'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-portfolio .portfolio-item .oxence-button'      => 'color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-portfolio .portfolio-item .portfolio-link svg' => 'fill: {{VALUE}};',
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
                    '{{WRAPPER}} .oxence-portfolio .portfolio-item .portfolio-link' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-portfolio .portfolio-item .oxence-button'  => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_shadow',
                'selector' => '{{WRAPPER}} .oxence-portfolio .portfolio-item .portfolio-link, {{WRAPPER}} .oxence-portfolio .portfolio-item .oxence-button',
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
                    '{{WRAPPER}} .oxence-portfolio .portfolio-item .portfolio-link:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-portfolio .portfolio-item .oxence-button:hover'  => 'color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-portfolio .portfolio-item .portfolio-link svg'   => 'fill: {{VALUE}};',
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
                    '{{WRAPPER}} .oxence-portfolio .portfolio-item .portfolio-link:hover'                                                                       => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-portfolio .portfolio-item .oxence-button::before, {{WRAPPER}} .oxence-portfolio .portfolio-item .oxence-button::after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'hover_button_shadow',
                'selector' => '{{WRAPPER}} .oxence-portfolio .portfolio-item .portfolio-link:hover, {{WRAPPER}} .oxence-portfolio .portfolio-item .oxence-button:hover',
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

        $template = new Portfolio_Template();
        $template->render( $settings );
    }
}