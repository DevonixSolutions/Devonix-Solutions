<?php
namespace OxenceToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Pricing_Table extends Widget_Base {

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
        return 'oxence-pricing-table';
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
        return esc_html__( 'Pricing Table', 'oxence-toolkit' );
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
        return 'eicon-price-table';
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
        return ['oxence', 'toolkit', 'price', 'table'];
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
            'section_general',
            [
                'label' => esc_html__( 'General', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'layout',
            [
                'label'   => esc_html__( 'Layout', 'oxence-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'one',
                'options' => [
                    'one'   => esc_html__( 'Layout One', 'oxence-toolkit' ),
                    'two'   => esc_html__( 'Layout Two', 'oxence-toolkit' ),
                    'three' => esc_html__( 'Layout Three', 'oxence-toolkit' ),
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_header',
            [
                'label' => esc_html__( 'Header', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => esc_html__( 'Title', 'oxence-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Basic Plan', 'oxence-toolkit' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pricing',
            [
                'label' => esc_html__( 'Pricing', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'currency',
            [
                'label'       => esc_html__( 'Currency', 'oxence-toolkit' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => false,
                'options'     => [
                    ''             => esc_html__( 'None', 'oxence-toolkit' ),
                    'baht'         => '&#3647; ' . _x( 'Baht', 'Currency Symbol', 'oxence-toolkit' ),
                    'bdt'          => '&#2547; ' . _x( 'BD Taka', 'Currency Symbol', 'oxence-toolkit' ),
                    'dollar'       => '&#36; ' . _x( 'Dollar', 'Currency Symbol', 'oxence-toolkit' ),
                    'euro'         => '&#128; ' . _x( 'Euro', 'Currency Symbol', 'oxence-toolkit' ),
                    'franc'        => '&#8355; ' . _x( 'Franc', 'Currency Symbol', 'oxence-toolkit' ),
                    'guilder'      => '&fnof; ' . _x( 'Guilder', 'Currency Symbol', 'oxence-toolkit' ),
                    'krona'        => 'kr ' . _x( 'Krona', 'Currency Symbol', 'oxence-toolkit' ),
                    'lira'         => '&#8356; ' . _x( 'Lira', 'Currency Symbol', 'oxence-toolkit' ),
                    'peseta'       => '&#8359 ' . _x( 'Peseta', 'Currency Symbol', 'oxence-toolkit' ),
                    'peso'         => '&#8369; ' . _x( 'Peso', 'Currency Symbol', 'oxence-toolkit' ),
                    'pound'        => '&#163; ' . _x( 'Pound Sterling', 'Currency Symbol', 'oxence-toolkit' ),
                    'real'         => 'R$ ' . _x( 'Real', 'Currency Symbol', 'oxence-toolkit' ),
                    'ruble'        => '&#8381; ' . _x( 'Ruble', 'Currency Symbol', 'oxence-toolkit' ),
                    'rupee'        => '&#8360; ' . _x( 'Rupee', 'Currency Symbol', 'oxence-toolkit' ),
                    'indian_rupee' => '&#8377; ' . _x( 'Rupee (Indian)', 'Currency Symbol', 'oxence-toolkit' ),
                    'shekel'       => '&#8362; ' . _x( 'Shekel', 'Currency Symbol', 'oxence-toolkit' ),
                    'won'          => '&#8361; ' . _x( 'Won', 'Currency Symbol', 'oxence-toolkit' ),
                    'yen'          => '&#165; ' . _x( 'Yen/Yuan', 'Currency Symbol', 'oxence-toolkit' ),
                    'custom'       => esc_html__( 'Custom', 'oxence-toolkit' ),
                ],
                'default'     => 'dollar',
            ]
        );

        $this->add_control(
            'currency_custom',
            [
                'label'     => esc_html__( 'Custom Symbol', 'oxence-toolkit' ),
                'type'      => Controls_Manager::TEXT,
                'condition' => [
                    'currency' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'price',
            [
                'label'   => esc_html__( 'Price', 'oxence-toolkit' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '248',
            ]
        );

        $this->add_control(
            'period',
            [
                'label'   => esc_html__( 'Period', 'oxence-toolkit' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( 'Monthly', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'price_note',
            [
                'label'   => esc_html__( 'Note', 'oxence-toolkit' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( 'Save 25%', 'oxence-toolkit' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_features',
            [
                'label' => esc_html__( 'Features', 'oxence-toolkit' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'text',
            [
                'label'   => esc_html__( 'Text', 'oxence-toolkit' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Exciting Feature', 'oxence-toolkit' ),
            ]
        );

        $repeater->add_control(
            'selected_icon',
            [
                'label'            => esc_html__( 'Icon', 'oxence-toolkit' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default'          => [
                    'value'   => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
                'recommended'      => [
                    'fa-regular' => [
                        'check-square',
                        'window-close',
                    ],
                    'fa-solid'   => [
                        'check',
                    ],
                ],
            ]
        );

        $this->add_control(
            'features_list',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'show_label'  => false,
                'default'     => [
                    [
                        'text' => esc_html__( 'Standard Feature', 'oxence-toolkit' ),
                        'icon' => 'fa fa-check',
                    ],
                    [
                        'text' => esc_html__( 'Another Great Feature', 'oxence-toolkit' ),
                        'icon' => 'fa fa-check',
                    ],
                    [
                        'text' => esc_html__( 'Obsolete Feature', 'oxence-toolkit' ),
                        'icon' => 'fa fa-close',
                    ],
                    [
                        'text' => esc_html__( 'Exciting Feature', 'oxence-toolkit' ),
                        'icon' => 'fa fa-check',
                    ],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->add_control(
            'hide_icon',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Hide Icon', 'oxence-toolkit' ),
                'default'      => 'no',
                'label_on'     => esc_html__( 'Yes', 'oxence-toolkit' ),
                'label_off'    => esc_html__( 'No', 'oxence-toolkit' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'show_dots',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Show Dots', 'oxence-toolkit' ),
                'default'      => '',
                'label_off'    => esc_html__( 'Hide', 'oxence-toolkit' ),
                'label_on'     => esc_html__( 'Show', 'oxence-toolkit' ),
                'return_value' => ' show-feature-dots',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_button',
            [
                'label' => esc_html__( 'Button', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'       => esc_html__( 'Button Text', 'oxence-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Choose Package', 'oxence-toolkit' ),
                'placeholder' => esc_html__( 'Type button text here', 'oxence-toolkit' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label'       => esc_html__( 'Link', 'oxence-toolkit' ),
                'type'        => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => 'https://example.com',
                'default'     => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'selected_button_icon',
            [
                'label'            => esc_html__( 'Icon', 'oxence-toolkit' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'button_icon',
                'default'          => [
                    'value'   => 'fas fa-angle-double-right',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_badge',
            [
                'label' => esc_html__( 'Badge', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'show_badge',
            [
                'label'        => esc_html__( 'Show', 'oxence-toolkit' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'oxence-toolkit' ),
                'label_off'    => esc_html__( 'Hide', 'oxence-toolkit' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label'       => esc_html__( 'Badge Text', 'oxence-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Popular', 'oxence-toolkit' ),
                'placeholder' => esc_html__( 'Type badge text', 'oxence-toolkit' ),
                'condition'   => [
                    'show_badge' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_general',
            [
                'label' => esc_html__( 'General', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'table_margin',
            [
                'label'      => esc_html__( 'Margin', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-pricing-table' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'table_padding',
            [
                'label'      => esc_html__( 'Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-pricing-table' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'   => [
                    'layout!' => 'three',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'table_bg',
                'selector' => '{{WRAPPER}} .oxence-pricing-table',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'table_border',
                'selector'  => '{{WRAPPER}} .oxence-pricing-table',
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'table_box_shadow',
                'selector' => '{{WRAPPER}} .oxence-pricing-table',
            ]
        );

        $this->add_control(
            'pricing_divider',
            [
                'label'      => esc_html__( 'Divider Color', 'oxence-toolkit' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .oxence-pricing-table.layout-three .pricing-btn-price' => 'border-color: {{VALUE}};',
                ],
                'condition'   => [
                    'layout' => 'three',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_header',
            [
                'label' => esc_html__( 'Header', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label'      => esc_html__( 'Bottom Spacing', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'min'        => 1,
                'max'        => 120,
                'selectors'  => [
                    '{{WRAPPER}} .oxence-pricing-table .pricing-table-title'            => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .oxence-pricing-table.layout-two .pricing-table-title' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Title Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-pricing-table .pricing-table-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .oxence-pricing-table .pricing-table-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'title_text_shadow',
                'selector' => '{{WRAPPER}} .oxence-pricing-table .pricing-table-title',
            ]
        );

        $this->add_control(
            'header_divider',
            [
                'label'      => esc_html__( 'Divider Color', 'oxence-toolkit' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .oxence-pricing-table .pricing-table-title' => 'border-color: {{VALUE}};',
                ],
                'condition'   => [
                    'layout' => 'two',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_pricing',
            [
                'label' => esc_html__( 'Pricing', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'price_spacing',
            [
                'label'      => esc_html__( 'Top Spacing', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-pricing-table .pricing-table-price' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition'   => [
                    'layout!' => 'three',
                ],
            ]
        );

        $this->add_control(
            'heading_price',
            [
                'type'  => Controls_Manager::HEADING,
                'label' => esc_html__( 'Price', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label'     => esc_html__( 'Text Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-pricing-table .pricing-table-price-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'price_typography',
                'selector' => '{{WRAPPER}} .oxence-pricing-table .pricing-table-price-text',
            ]
        );

        $this->add_control(
            'heading_currency',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__( 'Currency', 'oxence-toolkit' ),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'currency_spacing',
            [
                'label'      => esc_html__( 'Side Spacing', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-pricing-table .pricing-table-currency' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'currency_color',
            [
                'label'     => esc_html__( 'Text Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-pricing-table .pricing-table-currency' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'currency_typography',
                'selector' => '{{WRAPPER}} .oxence-pricing-table .pricing-table-currency',
            ]
        );

        $this->add_control(
            'heading_period',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__( 'Period', 'oxence-toolkit' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'period_color',
            [
                'label'     => esc_html__( 'Text Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-pricing-table .pricing-table-period' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'period_typography',
                'selector' => '{{WRAPPER}} .oxence-pricing-table .pricing-table-period',
            ]
        );

        $this->add_control(
            'heading_note',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__( 'Note', 'oxence-toolkit' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'note_color',
            [
                'label'     => esc_html__( 'Text Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-pricing-table .pricing-note' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'note_typography',
                'selector' => '{{WRAPPER}} .oxence-pricing-table .pricing-note',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_features',
            [
                'label' => esc_html__( 'Features', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'features_list_spacing',
            [
                'label'      => esc_html__( 'Spacing Between', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'min'        => 1,
                'max'        => 100,
                'selectors'  => [
                    '{{WRAPPER}} .oxence-pricing-table .pricing-features-list li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'features_list_color',
            [
                'label'     => esc_html__( 'Text Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-pricing-table .pricing-features-list' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'features_list_typography',
                'selector' => '{{WRAPPER}} .oxence-pricing-table .pricing-features-list',
            ]
        );

        $this->add_control(
            'features_icon_color',
            [
                'label'     => esc_html__( 'Icon/Dots Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-pricing-table .pricing-features-list li::before'    => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-pricing-table .pricing-features-list .feature-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_button',
            [
                'label' => esc_html__( 'Button', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_margin',
            [
                'label'      => esc_html__( 'Margin', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-pricing-table .pricing-table-btn' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label'      => esc_html__( 'Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-pricing-table .pricing-table-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'button_border',
                'selector' => '{{WRAPPER}} .oxence-pricing-table .pricing-table-btn',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-pricing-table .pricing-table-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'selector' => '{{WRAPPER}} .oxence-pricing-table .pricing-table-btn',
            ]
        );

        $this->start_controls_tabs( 'tabs_button' );

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
                'selectors' => [
                    '{{WRAPPER}} .oxence-pricing-table .pricing-table-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-pricing-table .pricing-table-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .oxence-pricing-table .pricing-table-btn',
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
                'selectors' => [
                    '{{WRAPPER}} .oxence-pricing-table .pricing-table-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-pricing-table .pricing-table-btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label'     => esc_html__( 'Border Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-pricing-table .pricing-table-btn:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .oxence-pricing-table .pricing-table-btn:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_badge',
            [
                'label' => esc_html__( 'Badge', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition'   => [
                    'show_badge' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_padding',
            [
                'label'      => esc_html__( 'Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-pricing-table .pricing-table-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'badge_color',
            [
                'label'     => esc_html__( 'Text Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-pricing-table .pricing-table-badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'badge_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-pricing-table .pricing-table-badge' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'badge_border',
                'selector' => '{{WRAPPER}} .oxence-pricing-table .pricing-table-badge',
            ]
        );

        $this->add_responsive_control(
            'badge_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-pricing-table .pricing-table-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'badge_box_shadow',
                'selector' => '{{WRAPPER}} .oxence-pricing-table .pricing-table-badge',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'badge_typography',
                'label'    => esc_html__( 'Typography', 'oxence-toolkit' ),
                'selector' => '{{WRAPPER}} .oxence-pricing-table .pricing-table-badge',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Get Currency symbol
     *
     * @param $symbol_name
     * @return void
     */
    private static function get_currency_symbol( $symbol_name ) {
        $symbols = [
            'baht'         => '&#3647;',
            'bdt'          => '&#2547;',
            'dollar'       => '&#36;',
            'euro'         => '&#128;',
            'franc'        => '&#8355;',
            'guilder'      => '&fnof;',
            'indian_rupee' => '&#8377;',
            'pound'        => '&#163;',
            'peso'         => '&#8369;',
            'peseta'       => '&#8359',
            'lira'         => '&#8356;',
            'ruble'        => '&#8381;',
            'shekel'       => '&#8362;',
            'rupee'        => '&#8360;',
            'real'         => 'R$',
            'krona'        => 'kr',
            'won'          => '&#8361;',
            'yen'          => '&#165;',
        ];

        return isset( $symbols[$symbol_name] ) ? $symbols[$symbol_name] : '';
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

        $this->add_inline_editing_attributes( 'badge_text', 'none' );
        $this->add_render_attribute( 'badge_text', 'class', 'pricing-table-badge' );

        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'pricing-table-title' );

        $this->add_inline_editing_attributes( 'price', 'none' );
        $this->add_render_attribute( 'price', 'class', 'pricing-table-price-text' );

        $this->add_inline_editing_attributes( 'period', 'none' );
        $this->add_render_attribute( 'period', 'class', 'pricing-table-period' );

        $this->add_inline_editing_attributes( 'price_note', 'none' );
        $this->add_render_attribute( 'price_note', 'class', 'pricing-note' );

        $this->add_inline_editing_attributes( 'button_text', 'none' );

        $this->add_link_attributes( 'button_url', $settings['button_link'] );
        $this->add_render_attribute( 'button_url', 'class', 'pricing-table-btn' );

        if ( $settings['currency'] === 'custom' ) {
            $currency = $settings['currency_custom'];
        } else {
            $currency = self::get_currency_symbol( $settings['currency'] );
        }

        $button_migrated = isset( $feature['__fa4_migrated']['selected_button_icon'] );
        $button_is_new   = empty( $feature['button_icon'] ) && Icons_Manager::is_migration_allowed();

        ?>
        <div class="oxence-pricing-table layout-<?php echo esc_attr( $settings['layout'] ) ?>">
            <?php if ( $settings['title'] ): ?>
            <h4 <?php echo $this->get_render_attribute_string( 'title' );?>>
                <?php echo wp_kses_post( $settings['title'] ); ?>
            </h4>
            <?php endif;?>

            <?php if ( is_array( $settings['features_list'] ) ) : ?>
            <ul class="pricing-features-list<?php echo esc_attr( $settings['show_dots'] ) ?>">
                <?php foreach ( $settings['features_list'] as $index => $feature ) :
                    $feature_key = $this->get_repeater_setting_key( 'text', 'features_list', $index );
                    $this->add_inline_editing_attributes( $feature_key, 'none' );
                    $this->add_render_attribute( $feature_key, 'class', 'pricing-feature-text' );

                    $migrated = isset( $feature['__fa4_migrated']['selected_icon'] );
                    $is_new   = empty( $feature['icon'] ) && Icons_Manager::is_migration_allowed();
                    ?>
                    <li>
                        <?php if ( 'yes' !== $settings['hide_icon'] ) : ?>
                        <span class="feature-icon">
                            <?php if ( $is_new || $migrated ): ?>
                                <?php Icons_Manager::render_icon( $feature['selected_icon'], ['aria-hidden' => 'true'] );?>
                            <?php else: ?>
                                <i class="<?php echo esc_attr( $feature['icon'] ) ?>"></i>
                            <?php endif;?>
                        </span>
                        <?php endif; ?>
                        <span <?php echo $this->get_render_attribute_string( $feature_key ); ?>>
                            <?php echo esc_html( $feature['text'] ); ?>
                        </span>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <div class="pricing-btn-price">
                <div class="pricing-table-price">
                    <span class="pricing-table-currency">
                        <?php echo esc_html( $currency ); ?>
                    </span>
                    <span <?php echo $this->get_render_attribute_string( 'price' ); ?>>
                        <?php echo esc_html( $settings['price'] ); ?>
                    </span>
                    <?php if ( $settings['period'] ) : ?>
                    <span <?php echo $this->get_render_attribute_string( 'period' ); ?>>
                        <?php echo esc_html( $settings['period'] ); ?>
                    </span>
                    <?php endif; ?>
                </div>
                <?php if ( $settings['price_note'] ) : ?>
                <span <?php echo $this->get_render_attribute_string( 'price_note' ) ?>>
                    <?php echo esc_html( $settings['price_note'] ) ?>
                </span>
                <?php endif; ?>
                <?php if ( $settings['button_text'] ) : ?>
                <a <?php $this->print_render_attribute_string( 'button_url' ); ?>>
                    <span <?php echo $this->get_render_attribute_string( 'button_text' ); ?>>
                        <?php echo esc_html( $settings['button_text'] ); ?>
                    </span>
                    <?php if ( $button_is_new || $button_migrated ): ?>
                        <?php Icons_Manager::render_icon( $settings['selected_button_icon'], ['aria-hidden' => 'true'] );?>
                    <?php else: ?>
                        <i class="<?php echo esc_attr( $settings['button_icon'] ) ?>"></i>
                    <?php endif;?>
                </a>
                <?php endif; ?>

                <?php if ( 'yes' === $settings['show_badge'] && 'three' === $settings['layout'] ) : ?>
                <span <?php echo $this->get_render_attribute_string( 'badge_text' ); ?>>
                    <?php echo esc_html( $settings['badge_text'] ); ?>
                </span>
                <?php endif; ?>
            </div>

            <?php if ( 'yes' === $settings['show_badge'] && 'three' !== $settings['layout'] ) : ?>
            <span <?php echo $this->get_render_attribute_string( 'badge_text' ); ?>>
                <?php echo esc_html( $settings['badge_text'] ); ?>
            </span>
            <?php endif; ?>
        </div>
        <?php
    }

    /**
     * Render heading widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function content_template() {
        ?>
        <#
            view.addInlineEditingAttributes( 'badge_text', 'none' );
            view.addRenderAttribute( 'badge_text', 'class', 'pricing-table-badge' );

            view.addInlineEditingAttributes( 'title', 'basic' );
            view.addRenderAttribute( 'title', 'class', 'pricing-table-title' );

            view.addInlineEditingAttributes( 'price', 'none' );
            view.addRenderAttribute( 'price', 'class', 'pricing-table-price-text' );

            view.addInlineEditingAttributes( 'period', 'none' );
            view.addRenderAttribute( 'period', 'class', 'pricing-table-period' );

            view.addInlineEditingAttributes( 'price_note', 'none' );
            view.addRenderAttribute( 'price_note', 'class', 'pricing-note' );

            view.addInlineEditingAttributes( 'button_text', 'none' );

            var iconsHTML = {},
				migrated = {};

            var symbols = {
                baht         : '&#3647;',
                bdt          : '&#2547;',
                dollar       : '&#36;',
                euro         : '&#128;',
                franc        : '&#8355;',
                guilder      : '&fnof;',
                indian_rupee : '&#8377;',
                pound        : '&#163;',
                peso         : '&#8369;',
                peseta       : '&#8359',
                lira         : '&#8356;',
                ruble        : '&#8381;',
                shekel       : '&#8362;',
                rupee        : '&#8360;',
                real         : 'R$',
                krona        : 'kr',
                won          : '&#8361;',
                yen          : '&#165;',
            };

            var symbol = '';

            if ( settings.currency ) {
				if ( 'custom' !== settings.currency ) {
					symbol = symbols[ settings.currency ];
				} else {
					symbol = settings.currency_custom;
				}
			}
        #>
        <div class="oxence-pricing-table layout-{{{ settings.layout }}}">
            <# if ( settings.title ) { #>
            <h4 {{{ view.getRenderAttributeString( 'title' ) }}}>
                {{{ settings.title }}}
            </h4>
            <# } #>

            <# if ( settings.features_list ) { #>
            <ul class="pricing-features-list{{{ settings.show_dots }}}">
                <# _.each( settings.features_list, function( feature, index ) {
                    var feature_key = view.getRepeaterSettingKey( 'text', 'features_list', index );
                    view.addInlineEditingAttributes( feature_key, 'none' );
                    view.addRenderAttribute( feature_key, 'class', 'pricing-feature-text' ); #>
                    <li>
                        <# if ( 'yes' != settings.hide_icon ) { #>
                        <span class="feature-icon">
                            <#
								iconsHTML[ index ] = elementor.helpers.renderIcon( view, feature.selected_icon, { 'aria-hidden': true }, 'i', 'object' );
								migrated[ index ] = elementor.helpers.isIconMigrated( feature, 'selected_icon' );
								if ( iconsHTML[ index ] && iconsHTML[ index ].rendered && ( ! feature.icon || migrated[ index ] ) ) { #>
									{{{ iconsHTML[ index ].value }}}
								<# } else { #>
									<i class="{{ feature.icon }}" aria-hidden="true"></i>
								<# }
							#>
                        </span>
                        <# } #>
                        <span {{{ view.getRenderAttributeString( feature_key ) }}}>
                            {{{ feature.text }}}
                        </span>
                    </li>
                <# } ); #>
            </ul>
            <# } #>

            <div class="pricing-btn-price">
                <div class="pricing-table-price">
                    <span class="pricing-table-currency">
                        {{{ symbol }}}
                    </span>
                    <span {{{ view.getRenderAttributeString( 'price' ) }}}>
                        {{{ settings.price }}}
                    </span>
                    <# if ( settings.period ) { #>
                    <span {{{ view.getRenderAttributeString( 'period' ) }}}>
                        {{{ settings.period }}}
                    </span>
                    <# } #>
                </div>
                <# if ( settings.price_note ) { #>
                <span {{{ view.getRenderAttributeString( 'price_note' ) }}}>
                    {{{ settings.price_note }}}
                </span>
                <# } #>
                <# if ( settings.button_text ) { #>
                <a class="pricing-table-btn" href="#">
                    <span {{{ view.getRenderAttributeString( 'button_text' ) }}}>
                        {{{ settings.button_text }}}
                    </span>
                    <#
                        var iconHTML = elementor.helpers.renderIcon( view, settings.selected_button_icon, { 'aria-hidden': true }, 'i' , 'object' ),
				        migrated = elementor.helpers.isIconMigrated( settings, 'selected_button_icon' );

                        if ( iconHTML && iconHTML.rendered && ( ! settings.icon || migrated ) ) { #>
                            {{{ iconHTML.value }}}
                        <# } else { #>
                            <i class="{{ settings.icon }}" aria-hidden="true"></i>
                        <# }
                    #>
                </a>
                <# } #>

                <# if ( 'yes' === settings.show_badge && 'three' === settings.layout ) { #>
                <span {{{ view.getRenderAttributeString( 'badge_text' ) }}}>
                    {{{ settings.badge_text }}}
                </span>
                <# } #>
            </div>

            <# if ( 'yes' === settings.show_badge && 'three' !== settings.layout ) { #>
            <span {{{ view.getRenderAttributeString( 'badge_text' ) }}}>
                {{{ settings.badge_text }}}
            </span>
            <# } #>
        </div>
        <?php
    }
}