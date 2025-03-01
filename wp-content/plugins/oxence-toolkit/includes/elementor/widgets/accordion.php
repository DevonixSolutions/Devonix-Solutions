<?php
namespace OxenceToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Accordion extends Widget_Base {

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
        return 'oxence-accordion';
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
        return esc_html__( 'Accordion', 'oxence-toolkit' );
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
        return 'eicon-accordion';
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
        return ['oxence', 'toolkit', 'accordion', 'collapse'];
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
            'section_content_accordion',
            [
                'label' => esc_html__( 'Accordion', 'oxence-toolkit' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'acc_title',
            [
                'label'       => esc_html__( 'Title', 'oxence-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Accordion Title', 'oxence-toolkit' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'content_type', [
                'label'   => esc_html__( 'Content Type', 'oxence-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'content'   => esc_html__( 'Content', 'oxence-toolkit' ),
                    'block'     => esc_html__( 'Builder Block', 'oxence-toolkit' ),
                    'template' => esc_html__( 'Elementor Templates', 'oxence-toolkit' ),
                ],
                'default' => 'content',
            ]
        );

        $repeater->add_control(
            'acc_content',
            [
                'label'      => esc_html__( 'Content', 'oxence-toolkit' ),
                'type'       => Controls_Manager::WYSIWYG,
                'default'    => esc_html__( 'Accordion Content', 'oxence-toolkit' ),
                'show_label' => true,
                'condition'  => [
                    'content_type' => 'content',
                ],
            ]
        );

        $repeater->add_control(
            'block_id',
            [
                'label'     => esc_html__( 'Select Block', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => ot_select_builder_block(),
                'condition' => [
                    'content_type' => 'block',
                ],
            ]
        );

        $repeater->add_control(
            'template_id',
            [
                'label'     => esc_html__( 'Select Template', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => ot_select_elementor_template(),
                'condition' => [
                    'content_type' => 'template',
                ],
            ]
        );

        $this->add_control(
            'accordions',
            [
                'label'       => esc_html__( 'Accordion Items', 'oxence-toolkit' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'acc_title'   => esc_html__( 'Accordion #1', 'oxence-toolkit' ),
                        'acc_content' => esc_html__( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'oxence-toolkit' ),
                    ],
                    [
                        'acc_title'   => esc_html__( 'Accordion #2', 'oxence-toolkit' ),
                        'acc_content' => esc_html__( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'oxence-toolkit' ),
                    ],
                ],
                'title_field' => '{{{ acc_title }}}',
            ]
        );

        $this->add_control(
            'selected_icon',
            [
                'label'            => esc_html__( 'Icon', 'oxence-toolkit' ),
                'type'             => Controls_Manager::ICONS,
                'separator'        => 'before',
                'fa4compatibility' => 'icon',
                'default'          => [
                    'value'   => 'fas fa-angle-right',
                    'library' => 'fa-solid',
                ],
                'skin'             => 'inline',
                'label_block'      => false,
            ]
        );

        $this->add_control(
            'selected_active_icon',
            [
                'label'            => esc_html__( 'Active Icon', 'oxence-toolkit' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon_active',
                'default'          => [
                    'value'   => 'fas fa-angle-down',
                    'library' => 'fa-solid',
                ],
                'skin'             => 'inline',
                'label_block'      => false,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'accordion_item',
            [
                'label' => esc_html__( 'Accordion Item', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'item_gap',
            [
                'label'      => esc_html__( 'Item Gap', 'oxence-toolkit' ),
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
                    '{{WRAPPER}} .oxence-accordion .accordion-item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'acc_padding',
            [
                'label'      => esc_html__( 'Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-accordion .accordion-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'acc_item_tabs' );

        $this->start_controls_tab(
            'acc_normal_tab',
            ['label' => esc_html__( 'Normal', 'oxence-toolkit' )]
        );

        $this->add_control(
            'acc_normal_bg',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-accordion .accordion-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'acc_normal_border',
                'label'    => esc_html__( 'Border', 'oxence-toolkit' ),
                'selector' => '{{WRAPPER}} .oxence-accordion .accordion-item',
            ]
        );

        $this->add_responsive_control(
            'acc_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-accordion .accordion-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'acc_box_shadow',
                'selector' => '{{WRAPPER}} .oxence-accordion .accordion-item',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'acc_active_tab',
            ['label' => esc_html__( 'Active', 'oxence-toolkit' )]
        );

        $this->add_control(
            'acc_active_bg',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-accordion .accordion-item.active-accordion' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'acc_active_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'acc_normal_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .oxence-accordion .accordion-item.active-accordion ' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'acc_active_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-accordion .accordion-item.active-accordion' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'acc_active_box_shadow',
                'selector' => '{{WRAPPER}} .oxence-accordion .accordion-item.active-accordion',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'accordion_header',
            [
                'label' => esc_html__( 'Accordion Header', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'acc_header_padding',
            [
                'label'      => esc_html__( 'Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-accordion .accordion-item .accordion-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'header_typography',
                'selector' => '{{WRAPPER}} .oxence-accordion .accordion-item .accordion-header',
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'      => esc_html__( 'Icon Size', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 40,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-accordion .accordion-item .accordion-header .icons' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'acc_header_tabs' );

        $this->start_controls_tab(
            'header_normal_tab',
            ['label' => esc_html__( 'Normal', 'oxence-toolkit' )]
        );

        $this->add_control(
            'header_normal_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-accordion .accordion-item .accordion-header' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_normal_color',
            [
                'label'     => esc_html__( 'Icon Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-accordion .accordion-item .accordion-header .icons' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'header_active_tab',
            ['label' => esc_html__( 'Active', 'oxence-toolkit' )]
        );

        $this->add_control(
            'header_active_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-accordion .accordion-item .accordion-header.active' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_active_color',
            [
                'label'     => esc_html__( 'Icon Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-accordion .accordion-item .accordion-header.active .icons' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'accordion_content',
            [
                'label' => esc_html__( 'Accordion Content', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-accordion .accordion-item .accordion-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .oxence-accordion .accordion-item .accordion-content',
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => esc_html__( 'Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-accordion .accordion-item .accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
    public function render() {
        $settings = $this->get_settings_for_display();

        $dynamic_id = rand( 20, 999999 );

        $this->add_render_attribute( 'accordion', [
            'id'    => 'accordion-' . $dynamic_id,
            'class' => 'oxence-accordion',
        ] );

        if ( empty( $settings['accordions'] ) ) {
            return;
        }

        ?>
        <div <?php echo $this->get_render_attribute_string( 'accordion' ); ?>>
            <?php foreach ( $settings['accordions'] as $index => $item ) :
                $title_key   = $this->get_repeater_setting_key( 'acc_title', 'accordions', $index );
                $content_key = $this->get_repeater_setting_key( 'acc_content', 'accordions', $index );

                $this->add_render_attribute( $title_key, [
                    'class'       => ['accordion-header'],
                    'data-target' => '#accordion-content-' . $dynamic_id . $index . '',
                ] );

                $this->add_render_attribute( $content_key, [
                    'class' => 'accordion-content',
                    'id'    => 'accordion-content-' . $dynamic_id . $index . '',
                ] );

                if ( '0' == $index ) {
                    $this->add_render_attribute( $title_key, 'class', 'active' );
                    $this->add_render_attribute( $content_key, 'style', 'display:block;' );
                } else {
                    $this->add_render_attribute( $content_key, 'style', 'display:none;' );
                }
                ?>
                <div class="accordion-item<?php if( '0' == $index ) : ?> active-accordion<?php endif; ?>">
                    <div <?php echo $this->get_render_attribute_string( $title_key ) ?>>
                        <span class="text">
                            <?php echo esc_html( $item['acc_title'] ) ?>
                        </span>
                        <span class="icons">
                            <span class="icon-open">
                                <?php
                                    $migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
                                    $is_new   = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

                                    if ( $is_new || $migrated ) {
                                        Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                                    } else {
                                        printf( '<i class="%1$s" aria-hidden="true"></i>',
                                            esc_attr( $settings['icon'] )
                                        );
                                    }
                                ?>
                            </span>
                            <span class="icon-close">
                                <?php
                                    $migrated_active = isset( $settings['__fa4_migrated']['selected_active_icon'] );
                                    $is_new_active   = empty( $settings['icon_active'] ) && Icons_Manager::is_migration_allowed();

                                    if ( $is_new_active || $migrated_active ) {
                                        Icons_Manager::render_icon( $settings['selected_active_icon'], [ 'aria-hidden' => 'true' ] );
                                    } else {
                                        printf( '<i class="%1$s" aria-hidden="true"></i>',
                                            esc_attr( $settings['icon_active'] )
                                        );
                                    }
                                ?>
                            </span>
                        </span>
                    </div>
                    <div <?php echo $this->get_render_attribute_string( $content_key ) ?>>
                        <div class="content-inner">
                            <?php
                                if( 'template' === $item['content_type'] || 'block' === $item['content_type'] ) {
                                    if ( 'template' === $item['content_type'] ) {
                                        $t_id = $item['template_id'];
                                    } elseif ( 'block' === $item['content_type'] ) {
                                        $t_id = $item['block_id'];
                                    }

                                    echo Plugin::$instance->frontend->get_builder_content_for_display( $t_id, true );
                                } else {
                                    echo wp_kses_post( wpautop( $item['acc_content'] ) );
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            endforeach; ?>
        </div>
        <?php
    }
}