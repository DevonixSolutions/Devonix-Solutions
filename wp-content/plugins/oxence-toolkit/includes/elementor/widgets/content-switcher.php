<?php
namespace OxenceToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Content_Switcher extends Widget_Base {

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
        return 'oxence-content-switcher';
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
        return esc_html__( 'Content Switcher', 'oxence-toolkit' );
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
        return 'eicon-exchange';
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
        return ['oxence', 'toolkit', 'content', 'switcher', 'pricing'];
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

        $this->start_controls_tabs( 'content_selection_tab' );

        $this->start_controls_tab(
            'content_one_tab',
            [
                'label' => esc_html__( 'Content One', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => esc_html__( 'Title', 'oxence-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => esc_html__( 'Monthly', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'content_type',
            [
                'label'   => esc_html__( 'Type', 'oxence-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'plain_content' => esc_html__( 'Plain/ HTML Text', 'oxence-toolkit' ),
                    'block'         => esc_html__( 'Builder Block', 'oxence-toolkit' ),
                    'templates'     => esc_html__( 'Elementor Templates', 'oxence-toolkit' ),
                ],
                'default' => 'plain_content',
            ]
        );

        $this->add_control(
            'plain_content',
            [
                'label'     => esc_html__( 'Plain/ HTML Text', 'oxence-toolkit' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows'      => 10,
                'condition' => [
                    'content_type' => 'plain_content',
                ],
                'default'   => esc_html__( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'builder_block',
            [
                'label'     => esc_html__( 'Builder Block', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => ot_select_builder_block(),
                'default'   => '0',
                'condition' => [
                    'content_type' => 'block',
                ],
            ]
        );

        $this->add_control(
            'elementor_template',
            [
                'label'     => esc_html__( 'Elementor Template', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => ot_select_elementor_template(),
                'default'   => '0',
                'condition' => [
                    'content_type' => 'templates',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'content_two_tab',
            [
                'label' => esc_html__( 'Content Two', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'title_two',
            [
                'label'       => esc_html__( 'Title', 'oxence-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,
                'default'     => esc_html__( 'Yearly', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'content_type_two',
            [
                'label'   => esc_html__( 'Type', 'oxence-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'plain_content' => esc_html__( 'Plain/ HTML Text', 'oxence-toolkit' ),
                    'block'         => esc_html__( 'Builder Block', 'oxence-toolkit' ),
                    'templates'     => esc_html__( 'Elementor Templates', 'oxence-toolkit' ),
                ],
                'default' => 'plain_content',
            ]
        );

        $this->add_control(
            'plain_content_two',
            [
                'label'     => esc_html__( 'Plain/ HTML Text', 'oxence-toolkit' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows'      => 10,
                'condition' => [
                    'content_type_two' => 'plain_content',
                ],
                'default'   => esc_html__( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'builder_block_two',
            [
                'label'     => esc_html__( 'Builder Block', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => ot_select_builder_block(),
                'default'   => '0',
                'condition' => [
                    'content_type_two' => 'block',
                ],
            ]
        );

        $this->add_control(
            'elementor_template_two',
            [
                'label'     => esc_html__( 'Elementor Template', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => ot_select_elementor_template(),
                'default'   => '0',
                'condition' => [
                    'content_type_two' => 'templates',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_switch_bar',
            [
                'label' => esc_html__( 'Switch Bar', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'switch_bar_alignment',
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
                'toggle'      => true,
                'selectors'   => [
                    '{{WRAPPER}} .oxence-content-switcher .switcher-btn-wrapper' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'switch_margin',
            [
                'label'      => esc_html__( 'Margin', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-content-switcher .switcher-btn-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'switch_heading',
            [
                'label'     => esc_html__( 'Switch', 'oxence-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'switch_padding',
            [
                'label'      => esc_html__( 'Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-content-switcher .switcher-btns' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'switch_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-content-switcher .switcher-btns .switch-btn' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'switch_bg',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-content-switcher .switcher-btns' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'switch_border',
                'label'    => esc_html__( 'Border', 'oxence-toolkit' ),
                'selector' => '{{WRAPPER}} .oxence-content-switcher .switcher-btns',
            ]
        );

        $this->add_control(
            'switch_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-content-switcher .switcher-btns' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'switch_box_shadow',
                'selector' => '{{WRAPPER}} .oxence-content-switcher .switcher-btns',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'switch_control',
            [
                'label' => esc_html__( 'Switcher Control', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'switch_control_width',
            [
                'label'      => esc_html__( 'Switcher Width (px)', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 200,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-content-switcher .switcher-input-label' => 'width: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'switch_control_height',
            [
                'label'      => esc_html__( 'Switcher Height (px)', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 200,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-content-switcher .switcher-input-label'    => 'height: {{SIZE}}px;',
                    '{{WRAPPER}} .oxence-content-switcher .switcher-slider::before' => 'width: {{SIZE}}px; height: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'switcher_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-content-switcher .switcher-slider::before' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'switcher_bg',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-content-switcher .switcher-slider' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'switcher_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-content-switcher .switcher-slider'         => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    '{{WRAPPER}} .oxence-content-switcher .switcher-slider::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_content',
            [
                'label' => esc_html__( 'Content', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => esc_html__( 'Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-content-switcher .switcher-content-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .oxence-content-switcher .switcher-content-container',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-content-switcher .switcher-content-container' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'content_bg',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-content-switcher .switcher-content-container' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'content_alignment',
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
                    '{{WRAPPER}} .oxence-content-switcher .switcher-content-container' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'content_box',
                'label'    => esc_html__( 'Border', 'oxence-toolkit' ),
                'selector' => '{{WRAPPER}} .oxence-content-switcher .switcher-content-container',

            ]
        );
        $this->add_control(
            'content_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-content-switcher .switcher-content-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_box_shadow',
                'label'    => esc_html__( 'Box Shadow', 'oxence-toolkit' ),
                'selector' => '{{WRAPPER}} .oxence-content-switcher .switcher-content-container',

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
        $settings     = $this->get_settings_for_display();
        $primary_id   = rand( 10, 100 );
        $secondary_id = rand( 10, 100 );
        ?>
        <div class="oxence-content-switcher">
            <div class="switcher-btn-wrapper">
                <div class="switcher-btns">
                    <div class="switch-btn primary-switch active" data-content-id="<?php echo esc_attr( $primary_id ); ?>">
                        <?php echo esc_html( $settings['title'] ); ?>
                    </div>
                    <label class="switcher-input-label">
                        <input type="checkbox" class="switcher-checkbox">
                        <span class="switcher-slider"></span>
                    </label>
                    <div class="switch-btn secondary-switch" data-content-id="<?php echo esc_attr( $secondary_id ); ?>">
                        <?php echo esc_html( $settings['title_two'] ); ?>
                    </div>
                </div>
            </div>
			<div class="switcher-content-container">
                <div class="switcher-content-wrap primary-switch-content active">
                    <?php
                        if( 'template' === $settings['content_type'] || 'block' === $settings['content_type'] ) {
                            if ( 'template' === $settings['content_type'] ) {
                                $t_id = $settings['elementor_template'];
                            } elseif ( 'block' === $settings['content_type'] ) {
                                $t_id = $settings['builder_block'];
                            }

                            echo Plugin::$instance->frontend->get_builder_content_for_display( $t_id, true );
                        } else {
                            echo ot_kses_basic( $settings['plain_content'] );
                        }
                    ?>
                </div>
                <div class="switcher-content-wrap secondary-switch-content">
                    <?php
                        if( 'template' === $settings['content_type_two'] || 'block' === $settings['content_type_two'] ) {
                            if ( 'template' === $settings['content_type_two'] ) {
                                $t_id = $settings['elementor_template_two'];
                            } elseif ( 'block' === $settings['content_type_two'] ) {
                                $t_id = $settings['builder_block_two'];
                            }

                            echo Plugin::$instance->frontend->get_builder_content_for_display( $t_id, true );
                        } else {
                            echo ot_kses_basic( $settings['plain_content_two'] );
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
}