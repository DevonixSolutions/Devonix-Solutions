<?php
namespace OxenceToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Mini_Search extends Widget_Base {

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
        return 'oxence-mini-search';
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
        return esc_html__( 'Mini Search', 'oxence-toolkit' );
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
        return 'eicon-search';
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
        return ['oxence', 'toolkit', 'header', 'footer', 'search', 'site', 'mini'];
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

        $this->add_responsive_control(
            'button_alignment',
            [
                'label'       => esc_html__( 'Button Alignment', 'oxence-toolkit' ),
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
                'default'     => 'left',
                'toggle'      => false,
                'selectors'   => [
                    '{{WRAPPER}} .oxence-search-wrapper' => 'text-align: {{VALUE}};',
                ],
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'form_alignment',
            [
                'label'       => esc_html__( 'Form Alignment', 'oxence-toolkit' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'form-left'  => [
                        'title' => esc_html__( 'Left', 'oxence-toolkit' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'form-right' => [
                        'title' => esc_html__( 'Right', 'oxence-toolkit' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default'     => 'form-left',
                'toggle'      => false,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'search_button_style',
            [
                'label' => esc_html__( 'Search Button', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'search_button_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-search-wrapper .search-btn' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'search_button_height',
            [
                'label'      => esc_html__( 'Height', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-search-wrapper .search-btn' => 'height: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'search_button_size',
            [
                'label'      => esc_html__( 'Size', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-search-wrapper .search-btn' => 'font-size: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_item_padding',
            [
                'label'      => esc_html__( 'Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-search-wrapper .search-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'search_wrapper',
            [
                'label' => esc_html__( 'Search Area', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'search_area_bg',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-search-wrapper .oxence-search-form' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'search_area_shadow',
                'selector' => '{{WRAPPER}} .oxence-search-wrapper .oxence-search-form',
            ]
        );

        $this->add_control(
            'input_heading',
            [
                'label'     => esc_html__( 'Input', 'oxence-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'field_height',
            [
                'label'      => esc_html__( 'Height', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-search-form input' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'field_padding',
            [
                'label'      => esc_html__( 'Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-search-form input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'field_border',
                'selector' => '{{WRAPPER}} .oxence-search-form input',
            ]
        );

        $this->add_responsive_control(
            'field_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-search-form input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'field_typography',
                'label'    => esc_html__( 'Typography', 'oxence-toolkit' ),
                'selector' => '{{WRAPPER}} .oxence-search-form input',
            ]
        );

        $this->start_controls_tabs( 'tabs_field_state' );

        $this->start_controls_tab(
            'tab_field_normal',
            [
                'label' => esc_html__( 'Normal State', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'field_text_color',
            [
                'label'     => esc_html__( 'Field Text Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-search-form input' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'field_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-search-form input' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_field_focus',
            [
                'label' => esc_html__( 'Focus', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'field_focus_text_color',
            [
                'label'     => esc_html__( 'Field Text Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-search-form input:focus' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'field_focus_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-search-form input:focus' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'field_focus_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-search-form input:focus' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'search_submit_style',
            [
                'label' => esc_html__( 'Search Submit', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'search_submit_size',
            [
                'label'      => esc_html__( 'Size', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-search-form .search-submit' => 'font-size: {{SIZE}}px;',
                ],
            ]
        );

        $this->start_controls_tabs( 'submit_tabs' );

        $this->start_controls_tab(
            'normal_submit',
            [
                'label' => esc_html__( 'Normal', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'search_submit_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-search-form .search-submit' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'search_submit_bg',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-search-form .search-submit' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'hover_submit',
            [
                'label' => esc_html__( 'Hover', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'search_submit_hover_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-search-form .search-submit:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'search_submit_hover_bg',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-search-form .search-submit:hover' => 'background-color: {{VALUE}}',
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
        ?>
        <div class="oxence-search-wrapper <?php echo esc_attr( $settings['form_alignment'] ) ?>">
            <a href="#" class="search-btn">
                <i class="fas fa-search open"></i>
                <i class="fas fa-times close"></i>
            </a>
            <?php get_search_form();?>
        </div>
        <?php
    }
}