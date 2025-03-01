<?php
namespace OxenceToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use Elementor\Plugin;

defined( 'ABSPATH' ) || exit;

class Offcanvas extends Widget_Base {

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
        return 'oxence-offcanvas';
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
        return esc_html__( 'Offcanvas', 'oxence-toolkit' );
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
        return 'eicon-apps';
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
        return ['oxence', 'toolkit', 'header', 'footer', 'nav', 'menu'];
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
            'template_id',
            [
                'label'   => esc_html__( 'Select Template', 'oxence-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => $this->select_saved_template(),
            ]
        );

        $this->add_control(
            'toggle_align',
            [
                'label'   => esc_html__( 'Toggle Alignment', 'oxence-toolkit' ),
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
                'default' => 'right',
                'toggle'  => false,
            ]
        );

        $this->add_control(
            'canvas_position',
            [
                'label'   => esc_html__( 'Canvas Position', 'oxence-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'left'  => esc_html__( 'Left', 'oxence-toolkit' ),
                    'right' => esc_html__( 'Right', 'oxence-toolkit' ),
                ],
                'default' => 'right',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style',
            [
                'label' => esc_html__( 'Toggle', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'toggle_style',
            [
                'label'   => esc_html__( 'Style', 'oxence-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'one' => esc_html__( 'One', 'oxence-toolkit' ),
                    'two' => esc_html__( 'Two', 'oxence-toolkit' ),
                ],
                'default' => 'one',
            ]
        );

        $this->add_control(
            'toggle_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-offcanvas .offcanvas-toggle span' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-offcanvas .offcanvas-toggle'      => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'toggle_bg',
            [
                'label'     => esc_html__( 'Background', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-offcanvas .offcanvas-toggle' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'toggle_size',
            [
                'label'      => esc_html__( 'Width/Height', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 200,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-offcanvas .offcanvas-toggle' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .oxence-offcanvas .offcanvas-toggle' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'toggle_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-offcanvas .offcanvas-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'toggle_box_shadow',
                'selector' => '{{WRAPPER}} .oxence-offcanvas .offcanvas-toggle',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'close_style',
            [
                'label' => esc_html__( 'Close', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'close_width_height',
            [
                'label'       => esc_html__( 'Size', 'oxence-toolkit' ),
                'type'        => Controls_Manager::NUMBER,
                'label_block' => false,
                'min'         => 1,
                'max'         => 100,
                'selectors'   => [
                    '{{WRAPPER}} .oxence-offcanvas .offcanvas-close' => 'width: {{VALUE}}px; height: {{VALUE}}px;',
                ],
            ]
        );

        $this->add_control(
            'close_bg',
            [
                'label'     => esc_html__( 'Background', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-offcanvas .offcanvas-close' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'close_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-offcanvas .offcanvas-close' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'canvas_style',
            [
                'label' => esc_html__( 'Canvas', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'overly_color',
            [
                'label'     => esc_html__( 'Overly Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-offcanvas-wrapper .offcanvas-overly' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'canvas_width',
            [
                'label'       => esc_html__( 'Width', 'oxence-toolkit' ),
                'type'        => Controls_Manager::NUMBER,
                'label_block' => false,
                'min'         => 100,
                'max'         => 2000,
                'selectors'   => [
                    '{{WRAPPER}} .oxence-offcanvas-wrapper .offcanvas-container' => 'width: {{VALUE}}px;',
                ],
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
        $settings = $this->get_settings_for_display();

        if ( ! $settings['template_id'] ) {
            return;
        }

        $this->add_render_attribute( 'toggle', [
            'class'        => 'offcanvas-toggle toggle-' . esc_attr( $settings['toggle_align'] ) .' style-'. $settings['toggle_style'],
        ] );

        ?>
        <div class="oxence-offcanvas">
            <div <?php echo $this->get_render_attribute_string( 'toggle' ); ?>>
                <div class="toggle-inner">
                    <?php if ( 'one' === $settings['toggle_style'] ) : ?>
                    <span></span>
                    <span></span>
                    <span></span>
                    <?php elseif ( 'two' === $settings['toggle_style'] ) : ?>
                    <i class="far fa-align-right"></i>
                    <?php endif; ?>
                </div>
            </div>
            <div class="oxence-offcanvas-wrapper offcanvas-<?php echo esc_attr( $settings['canvas_position'] ) ?>">
                <div class="offcanvas-overly"></div>
                <div class="offcanvas-container">
                    <div class="offcanvas-close"><i class="fal fa-times"></i></div>
                    <?php echo Plugin::$instance->frontend->get_builder_content( $settings['template_id'], true );?>
                </div>
            </div>

        </div>
        <?php
    }

    /**
     * Get ALl Elementor Saved Template
     *
     * @since 1.0.0
     * @access protected
     */
    protected function select_saved_template() {
        $args = [
            'post_type'   => 'oxence_template',
            'numberposts' => -1,
            'orderby'     => 'title',
            'order'       => 'ASC',
        ];

        $query_query = get_posts( $args );

        $posts = [];

        if ( $query_query ) {
            foreach ( $query_query as $query ) {
                if ( 'offcanvas' === $this->template_type( $query->ID ) ) {
                    $posts[$query->ID] = $query->post_title;
                }
            }
        } else {
            $posts[0] = esc_html__( 'No Template found', 'oxence-toolkit' );
        }

        return $posts;
    }

    /**
     * Template Type
     */
    protected function template_type( $post_id ) {

        $meta = get_post_meta( $post_id, 'oxence_tb_settings', true );

        if ( isset( $meta['template_type'] ) ) {
            $template_type = $meta['template_type'];
        } else {
            $template_type = '';
        }

        return $template_type;
    }
}