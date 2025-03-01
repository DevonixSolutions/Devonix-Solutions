<?php
namespace OxenceToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use OxenceToolkit\ElementorAddon\Templates\Recent_Post_Template;

defined( 'ABSPATH' ) || exit;

class Posts_List extends Widget_Base {

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
        return 'oxence-posts-list';
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
        return esc_html__( 'Posts Lists', 'oxence-toolkit' );
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
        return 'eicon-post-list';
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
            'post_source',
            [
                'label'     => esc_html__( 'Source', 'oxence-toolkit' ),
                'type'      => Controls_Manager::HEADING,
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
                'default' => 2,
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

        $this->add_control(
            'show_thumbnail',
            [
                'label'        => esc_html__( 'Show Thumbnail?', 'oxence-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'oxence-toolkit' ),
                'label_off'    => esc_html__( 'Hide', 'oxence-toolkit' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'post_thumbnail',
                'default'   => 'large',
                'exclude'   => [
                    'custom',
                ],
                'condition' => [
                    'show_thumbnail' => 'yes',
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
            ]
        );

        $this->add_control(
            'excerpt_count',
            [
                'label'     => esc_html__( 'Excerpt Word', 'oxence-toolkit' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 12,
                'condition' => [
                    'show_excerpt' => 'yes',
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
                'label'     => esc_html__( 'Read More Text', 'oxence-toolkit' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__( 'Read More', 'oxence-toolkit' ),
                'condition' => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_post_date',
            [
                'label'        => esc_html__( 'Show Post Date', 'oxence-toolkit' ),
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

        $this->end_controls_section();

        $this->start_controls_section(
            'section_item',
            [
                'label' => esc_html__( 'Item', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'divider_color',
            [
                'label'     => esc_html__( 'Divider Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-post-list .post-list-item:not(:last-child)' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'divider_size',
            [
                'label'     => esc_html__( 'Divider Height', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => 0,
                        'step' => 1,
                        'max'  => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .oxence-post-list .post-list-item:not(:last-child)' => 'border-width: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_gap',
            [
                'label'     => esc_html__( 'Item Gap', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => 0,
                        'step' => 1,
                        'max'  => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .oxence-post-list .post-list-item:not(:last-child)' => 'margin-bottom: {{SIZE}}px; padding-bottom: {{SIZE}}px;',
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
                    '{{WRAPPER}} .oxence-post-list .post-list-item'            => 'text-align: {{Value}};',
                    '{{WRAPPER}} .oxence-post-list .post-list-item .post-date' => 'justify-content: {{Value}};',
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
                    '{{WRAPPER}} .oxence-post-list .post-list-item .entry-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-post-list .post-list-item .entry-title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .oxence-post-list .post-list-item .entry-title',
            ]
        );

        $this->add_control(
            'category_heading',
            [
                'label'     => esc_html__( 'Post Date', 'oxence-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show_post_date' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'category_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-post-list .post-list-item .post-date' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_post_date' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'categories_typography',
                'selector'  => '.oxence-post-list .post-list-item .post-date',
                'condition' => [
                    'show_post_date' => 'yes',
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
                    '{{WRAPPER}} .oxence-post-list .post-list-item .post-date' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'show_post_date' => 'yes',
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
                    '{{WRAPPER}} .oxence-post-list .post-list-item p' => 'color: {{VALUE}};',
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
                'selector'  => '{{WRAPPER}} .oxence-post-list .post-list-item p',
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'excerpt_gap',
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
                    '{{WRAPPER}} .oxence-post-list .post-list-item p' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_button',
            [
                'label'     => esc_html__( 'Read More button', 'oxence-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_read_more' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_padding',
            [
                'label'      => esc_html__( 'Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                'selector' => '{{WRAPPER}} .oxence-button',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'border',
                'selector' => '{{WRAPPER}} .oxence-button',
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .oxence-button'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-button svg' => 'fill: {{VALUE}};',
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
                    '{{WRAPPER}} .oxence-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .oxence-button',
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
                    '{{WRAPPER}} .oxence-button:hover'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-button:hover svg' => 'fill: {{VALUE}};',
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
                    '{{WRAPPER}} .oxence-button:before, {{WRAPPER}} .oxence-button:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'hover_box_shadow',
                'selector' => '{{WRAPPER}} .oxence-button:hover',
            ]
        );

        $this->add_control(
            'hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .oxence-button:hover ' => 'border-color: {{VALUE}};',
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
        $template->post_list( $settings );
    }
}