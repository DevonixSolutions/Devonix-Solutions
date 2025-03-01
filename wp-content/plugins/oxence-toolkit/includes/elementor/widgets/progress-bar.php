<?php
namespace OxenceToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Progress_Bar extends Widget_Base {

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
        return 'oxence-progress-bar';
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
        return esc_html__( 'Progress Bar', 'oxence-toolkit' );
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
        return 'eicon-skill-bar';
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
        return ['oxence', 'toolkit', 'skill', 'progress', 'bar', 'chart'];
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
                'options' => [
                    'circle' => esc_html__( 'Circle', 'oxence-toolkit' ),
                    'line'   => esc_html__( 'Line', 'oxence-toolkit' ),
                ],
                'default' => 'line',
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => esc_html__( 'Title', 'oxence-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Web Design', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'percentage',
            [
                'label'   => esc_html__( 'Percentage', 'oxence-toolkit' ),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 80,
                    'unit' => '%',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'bar_style',
            [
                'label' => esc_html__( 'Progress Bar', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'line_color',
            [
                'label'     => esc_html__( 'Line Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-progress-bar .elementor-progress-wrapper' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'layout' => 'line',
                ],
            ]
        );

        $this->add_control(
            'base_color',
            [
                'label'     => esc_html__( 'Base Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-progress-bar .elementor-progress-wrapper .elementor-progress-bar' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'layout' => 'line',
                ],
            ]
        );

        $this->add_responsive_control(
            'line_height',
            [
                'label'      => esc_html__( 'Line Height', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 50,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-progress-bar .elementor-progress-wrapper' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'layout' => 'line',
                ],
            ]
        );

        $this->add_control(
            'bar_color',
            [
                'label'     => esc_html__( 'Bar Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'layout' => 'circle',
                ],
            ]
        );

        $this->add_control(
            'track_color',
            [
                'label'     => esc_html__( 'Base Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'layout' => 'circle',
                ],
            ]
        );

        $this->add_responsive_control(
            'bar_width',
            [
                'label'      => esc_html__( 'Bar Width', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 50,
                        'step' => 1,
                    ],
                ],
                'condition'  => [
                    'layout' => 'circle',
                ],
            ]
        );

        $this->add_responsive_control(
            'canvas_size',
            [
                'label'      => esc_html__( 'Canvas Size', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 500,
                        'step' => 1,
                    ],
                ],
                'condition'  => [
                    'layout' => 'circle',
                ],
            ]
        );

        $this->add_control(
            'canvas_color',
            [
                'label'     => esc_html__( 'Canvas Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-progress-bar canvas' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'layout' => 'circle',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'header_style',
            [
                'label' => esc_html__( 'Header Style', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_header',
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
                    '{{WRAPPER}} .oxence-progress-bar .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .oxence-progress-bar .title',
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
                        'min'  => 0,
                        'max'  => 50,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-progress-bar.progress-line  .progress-header'   => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .oxence-progress-bar.progress-circle  .progress-header' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'percentage_header',
            [
                'label'     => esc_html__( 'Percentage', 'oxence-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'percentage_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-progress-bar .elementor-counter-number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'percentage_typography',
                'selector' => '{{WRAPPER}} .oxence-progress-bar .elementor-counter-number',
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
        $settings = $this->get_settings();

        $this->add_render_attribute( 'title', 'class', 'title' );
        $this->add_inline_editing_attributes( 'title', 'none' );

        $this->add_render_attribute( 'counter', [
            'class'         => 'elementor-counter-number',
            'data-duration' => '1500',
            'data-to-value' => $settings['percentage']['size'],
        ] );

        $this->add_render_attribute( 'progressbar-wrap', [
            'class'         => 'elementor-progress-wrapper',
            'role'          => 'progressbar',
            'aria-valuemin' => '0',
            'aria-valuemax' => '100',
            'aria-valuenow' => $settings['percentage']['size'],
        ] );

        $this->add_render_attribute( 'progressbar', [
            'class'    => 'elementor-progress-bar',
            'data-max' => $settings['percentage']['size'],
        ] );

        $this->add_render_attribute( 'chart', [
            'class'        => 'progress-chart',
            'data-percent' => $settings['percentage']['size'],
        ] );

        if ( $settings['bar_width']['size'] ) {
            $this->add_render_attribute( 'chart', 'data-line-width', $settings['bar_width']['size'] );
        }

        if ( $settings['canvas_size']['size'] ) {
            $this->add_render_attribute( 'chart', 'data-size', $settings['canvas_size']['size'] );
        }

        if ( $settings['bar_color'] ) {
            $this->add_render_attribute( 'chart', 'data-bar-color', $settings['bar_color'] );
        }

        if ( $settings['track_color'] ) {
            $this->add_render_attribute( 'chart', 'data-track-color', $settings['track_color'] );
        }

        ?>
        <div class="oxence-progress-bar progress-<?php echo esc_attr( $settings['layout'] ) ?>">
            <?php if ( 'circle' === $settings['layout'] ): ?>
            <div <?php echo $this->get_render_attribute_string( 'chart' ); ?>>
                <span <?php echo $this->get_render_attribute_string( 'counter' ); ?>>0</span>
            </div>
            <?php endif;?>
            <div class="progress-header">
                <span <?php echo $this->get_render_attribute_string( 'title' ); ?>> <?php echo esc_html( $settings['title'] ) ?> </span>
                <?php if ( 'line' === $settings['layout'] ): ?>
                <span <?php echo $this->get_render_attribute_string( 'counter' ); ?>>0</span>
                <?php endif;?>
            </div>
            <?php if ( 'line' === $settings['layout'] ): ?>
            <div <?php echo $this->get_render_attribute_string( 'progressbar-wrap' ); ?>>
                <div <?php echo $this->get_render_attribute_string( 'progressbar' ); ?>></div>
            </div>
            <?php endif;?>
        </div>
        <?php
    }
}