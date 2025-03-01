<?php
namespace OxenceToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Fancy_List extends Widget_Base {

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
        return 'oxence-fancy-list';
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
        return esc_html__( 'Fancy List', 'oxence-toolkit' );
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
        return 'eicon-bullet-list';
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
        return ['oxence', 'toolkit', 'list', 'fancy'];
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
                'label' => esc_html__( 'Fancy List', 'oxence-toolkit' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__( 'Title', 'oxence-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__( 'List Title', 'oxence-toolkit' ),
                'default'     => esc_html__( 'Company Mission', 'oxence-toolkit' ),
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label'       => esc_html__( 'Description', 'oxence-toolkit' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__( 'List Description', 'oxence-toolkit' ),
                'default'     => esc_html__( 'Focus provide beautiful layout client look make import.', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'fancy_list',
            [
                'label'       => esc_html__( 'Items', 'oxence-toolkit' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'       => esc_html__( 'Title HTML Tag', 'oxence-toolkit' ),
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

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_fancy_list',
            [
                'label' => esc_html__( 'Fancy List', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'item_space',
            [
                'label'     => esc_html__( 'Item Space', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .oxence-fancy-list .list-item:not(:last-child)' => 'padding-bottom: {{SIZE}}px; margin-bottom: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'divider_width',
            [
                'label'     => esc_html__( 'Divider Width', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .oxence-fancy-list .list-item:not(:last-child)' => 'border-width: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'divider_color',
            [
                'label'     => esc_html__( 'Divider Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-fancy-list .list-item:not(:last-child)' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'shape_fill_color',
            [
                'label'     => esc_html__( 'Shape Fill Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-fancy-list .list-item::before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'shape_border_color',
            [
                'label'     => esc_html__( 'Shape Border Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-fancy-list .list-item::after' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__( 'Content', 'oxence-toolkit' ),
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
                    '{{WRAPPER}} .oxence-fancy-list .list-item .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .oxence-fancy-list .list-item .title',
            ]
        );

        $this->add_responsive_control(
            'title_bottom_space',
            [
                'label'     => esc_html__( 'Spacing', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .oxence-fancy-list .list-item .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'desc_heading',
            [
                'label'     => esc_html__( 'Description', 'oxence-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-fancy-list .list-item .description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'desc_typography',
                'selector' => '{{WRAPPER}} .oxence-fancy-list .list-item .description',
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
        ?>
        <div class="oxence-fancy-list">
            <?php foreach ( $settings['fancy_list'] as $index => $item ) : ?>
                <div class="list-item">
                    <?php
                        if ( ! empty( $item['title'] ) ) {
                            $title_key = $this->get_repeater_setting_key( 'title', 'fancy_list', $index );
                            $this->add_render_attribute( $title_key, 'class', 'title' );
                            $this->add_inline_editing_attributes( $title_key, 'none' );

                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                ot_escape_tags( $settings['title_tag'], 'h4' ),
                                $this->get_render_attribute_string( $title_key ),
                                ot_kses_basic( $item['title'] )
                            );
                        }

                        if ( ! empty( $item['description'] ) ) {
                            $description_key = $this->get_repeater_setting_key( 'description', 'fancy_list', $index );
                            $this->add_render_attribute( $description_key, 'class', 'description' );
                            $this->add_inline_editing_attributes( $description_key, 'basic' );

                            printf( '<p %1$s>%2$s</p>',
                                $this->get_render_attribute_string( $description_key ),
                                ot_kses_basic( $item['description'] )
                            );
                        }
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
    }

    /**
	 * Render icon list widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */
	protected function content_template() {
        ?>
        <# if ( settings.fancy_list ) { #>
        <div class="oxence-fancy-list">
            <# _.each( settings.fancy_list, function( item, index ) { #>
                <div class="list-item">
                    <# if ( item.title ) {
                        var titleKey = view.getRepeaterSettingKey( 'title', 'fancy_list', index );
                        view.addRenderAttribute( titleKey, 'class', 'title' );
                        view.addInlineEditingAttributes( titleKey, 'none' );
                        #>
                        <{{{ settings.title_tag }}} {{{ view.getRenderAttributeString( titleKey ) }}}>
                            {{{ item.title }}}
                        </{{{ settings.title_tag }}}>
                        <#
                    } #>
                    <# if ( item.description ) {
                        var descriptionKey = view.getRepeaterSettingKey( 'description', 'fancy_list', index );
                        view.addRenderAttribute( descriptionKey, 'class', 'description' );
                        view.addInlineEditingAttributes( descriptionKey, 'basic' );
                        #>
                        <p {{{ view.getRenderAttributeString( descriptionKey ) }}}>
                            {{{ item.description }}}
                        </p>
                        <#
                    } #>
                </div>
            <# } ); #>
        </div>
        <# } #>
        <?php
    }
}