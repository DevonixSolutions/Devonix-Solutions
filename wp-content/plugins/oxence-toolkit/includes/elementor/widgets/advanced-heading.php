<?php
namespace OxenceToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use OxenceTheme\Classes\Oxence_Helper;

defined( 'ABSPATH' ) || exit;

class Advanced_Heading extends Widget_Base {

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
        return 'oxence-advanced-heading';
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
        return esc_html__( 'Advanced Heading', 'oxence-toolkit' );
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
        return 'eicon-heading';
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
        return ['oxence', 'toolkit', 'heading'];
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
            'section_content_heading',
            [
                'label' => esc_html__( 'Heading', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'sub_heading',
            [
                'label'       => esc_html__( 'Sub Heading', 'oxence-toolkit' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter your subtitle', 'oxence-toolkit' ),
                'default'     => esc_html__( 'Sub Heading Here', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'main_heading',
            [
                'label'       => esc_html__( 'Main Heading', 'oxence-toolkit' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter your main heading here', 'oxence-toolkit' ),
                'default'     => esc_html__( 'I am Advanced Heading', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'split_main_heading',
            [
                'label'     => esc_html__( 'Split Main Heading', 'oxence-toolkit' ),
                'separator' => 'before',
                'type'      => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'split_text',
            [
                'label'       => esc_html__( 'Split Text', 'oxence-toolkit' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__( 'Enter your split text', 'oxence-toolkit' ),
                'default'     => esc_html__( 'Split Text', 'oxence-toolkit' ),
                'condition'   => [
                    'split_main_heading' => 'yes',
                ],
                'separator'   => 'after',
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'       => esc_html__( 'HTML Tag', 'oxence-toolkit' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'h1' => [
                        'title' => esc_html__( 'H1', 'oxence-toolkit' ),
                        'icon'  => 'eicon-editor-h1',
                    ],
                    'h2' => [
                        'title' => esc_html__( 'H2', 'oxence-toolkit' ),
                        'icon'  => 'eicon-editor-h2',
                    ],
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
                'default'     => 'h3',
                'toggle'      => false,
            ]
        );

        $this->add_responsive_control(
            'align',
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
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .oxence-advanced-heading' => 'text-align: {{VALUE}};',
                ],

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_sub_heading',
            [
                'label'     => esc_html__( 'Sub Heading', 'oxence-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'sub_heading!' => '',
                ],
            ]
        );

        $this->add_control(
            'sub_heading_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-advanced-heading .sub-heading-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'sub_heading_typography',
                'selector' => '{{WRAPPER}} .oxence-advanced-heading .sub-heading-text',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'sub_heading_text_shadow',
                'selector' => '{{WRAPPER}} .oxence-advanced-heading .sub-heading-text',
            ]
        );

        $this->add_control(
            'sub_heading_style',
            [
                'label'     => esc_html__( 'Style', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'none'  => esc_html__( 'None', 'oxence-toolkit' ),
                    'dots'  => esc_html__( 'Dots', 'oxence-toolkit' ),
                    'arrow' => esc_html__( 'Arrow Line', 'oxence-toolkit' ),
                ],
                'separator' => 'before',
                'default'   => 'none'
            ]
        );

        $this->add_control(
            'sub_heading_style_color',
            [
                'label'     => esc_html__( 'Style Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-advanced-heading .sub-heading .dots span'      => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .oxence-advanced-heading .sub-heading .arrow-line svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'sub_heading_style!' => 'none',
                ],
            ]
        );

        $this->add_responsive_control(
            'sub_heading_style_width',
            [
                'label'     => esc_html__( 'Width', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .oxence-advanced-heading .sub-heading .dots span'  => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .oxence-advanced-heading .sub-heading .arrow-line' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'sub_heading_style!' => 'none'
                ],
            ]
        );

        $this->add_responsive_control(
            'sub_heading_style_height',
            [
                'label'     => esc_html__( 'Height', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .oxence-advanced-heading .sub-heading .dots span' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'sub_heading_style' => 'dots',
                ],
            ]
        );

        $this->add_control(
            'sub_heading_style_align',
            [
                'label'     => esc_html__( 'Style Position', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'right',
                'options'   => [
                    'right'      => esc_html__( 'After', 'oxence-toolkit' ),
                    'left'       => esc_html__( 'Before', 'oxence-toolkit' ),
                    'left-right' => esc_html__( 'After and Before', 'oxence-toolkit' ),
                    'bottom'     => esc_html__( 'Bottom', 'oxence-toolkit' ),
                ],
                'condition' => [
                    'sub_heading_style' => 'dots',
                ],
            ]
        );

        $this->add_responsive_control(
            'sub_heading_style_indent',
            [
                'label'     => esc_html__( 'Style Spacing', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'condition' => [
                    'sub_heading_style!' => 'none'
                ],
                'selectors' => [
                    '{{WRAPPER}} .oxence-advanced-heading .sub-heading .dots-right'  => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .oxence-advanced-heading .sub-heading .dots-left'   => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .oxence-advanced-heading .sub-heading .dots-bottom' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .oxence-advanced-heading .sub-heading .arrow-line'  => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_main_heading',
            [
                'label'     => esc_html__( 'Main Heading', 'oxence-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'main_heading!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'main_heading_margin',
            [
                'label'      => esc_html__( 'Margin', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-advanced-heading .main-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'main_heading_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-advanced-heading .main-heading' => 'color: {{VALUE}}; -webkit-text-stroke-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'main_heading_text_shadow',
                'selector' => '{{WRAPPER}} .oxence-advanced-heading .main-heading',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'main_heading_typography',
                'selector' => '{{WRAPPER}} .oxence-advanced-heading .main-heading',
            ]
        );

        $this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'main_text_stroke',
				'selector' => '{{WRAPPER}} .oxence-advanced-heading .main-heading',
			]
		);

        $this->add_control(
            'heading_main_split_text',
            [
                'label'     => esc_html__( 'Split Text', 'oxence-toolkit' ),
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'split_main_heading' => 'yes',
                    'split_text!'        => '',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'split_text_space',
            [
                'label'     => esc_html__( 'Split Space', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .oxence-advanced-heading .main-heading .split-text' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'split_main_heading' => 'yes',
                    'split_text!'        => '',
                ],
            ]
        );

        $this->add_control(
            'split_text_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-advanced-heading .main-heading .split-text' => 'color: {{VALUE}}; -webkit-text-stroke-color: {{VALUE}};',
                ],
                'condition' => [
                    'split_main_heading' => 'yes',
                    'split_text!'        => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'      => 'split_text_shadow',
                'selector'  => '{{WRAPPER}} .oxence-advanced-heading .main-heading .split-text',
                'condition' => [
                    'split_main_heading' => 'yes',
                    'split_text!'        => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'split_text_typography',
                'selector'  => '{{WRAPPER}} .oxence-advanced-heading .main-heading .split-text',
                'condition' => [
                    'split_main_heading' => 'yes',
                    'split_text!'        => '',
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'split_text_stroke',
				'selector' => '{{WRAPPER}} .oxence-advanced-heading .main-heading .split-text',
                'condition' => [
                    'split_main_heading' => 'yes',
                    'split_text!'        => '',
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

        if ( empty( $settings['sub_heading'] ) && empty( $settings['main_heading'] ) ) {
            return;
        }

        $this->add_render_attribute( 'wrapper', 'class', 'oxence-advanced-heading' );

        if ( 'bottom' === $settings['sub_heading_style_align'] ) {
            $dots_class = 'dots dots-bottom';
        } elseif ( 'right' === $settings['sub_heading_style_align'] ) {
            $dots_class = 'dots dots-right';
        } else {
            $dots_class = 'dots dots-left';
        }

        ?>
        <div <?php echo $this->get_render_attribute_string( 'wrapper' ) ?>>
            <?php if ( ! empty( $settings['sub_heading'] ) ): ?>
                <div class="sub-heading">
                    <?php if ( 'arrow' === $settings['sub_heading_style'] ): ?>
                        <span class="arrow-line">
                            <?php echo Oxence_Helper::render_svg_icon( 'arrow-line' ); ?>
                        </span>
                    <?php endif; ?>
                    <?php
                        $this->add_render_attribute( 'sub_heading', 'class', 'sub-heading-text' );
                        $this->add_inline_editing_attributes( 'sub_heading', 'none' );

                        printf( '<span %1$s>%2$s</span>',
                            $this->get_render_attribute_string( 'sub_heading' ),
                            esc_html( $settings['sub_heading'] )
                        );
                    ?>
                    <?php if ( 'dots' === $settings['sub_heading_style'] ): ?>
                        <span class="<?php echo esc_attr( $dots_class ) ?>">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                        <?php if ( 'left-right' === $settings['sub_heading_style_align'] ): ?>
                        <span class="dots dots-right">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                        <?php endif;?>
                    <?php endif;?>
                </div>
            <?php endif;?>
            <?php
                if ( ! empty( $settings['main_heading'] ) ) {
                    $this->add_render_attribute( 'main_heading', 'class', 'main-text' );
                    $this->add_inline_editing_attributes( 'main_heading', 'none' );


                    if ( 'yes' == $settings['split_main_heading'] && ! empty( $settings['split_text'] ) ) {
                        $this->add_render_attribute( 'split_text', 'class', 'split-text' );
                        $this->add_inline_editing_attributes( 'split_text', 'none' );

                        printf( '<%1$s class="main-heading"><span %2$s>%3$s</span> <span %4$s>%5$s</span></%1$s>',
                            tag_escape( $settings['title_tag'] ),
                            $this->get_render_attribute_string( 'main_heading' ),
                            wp_kses_post( $settings['main_heading'] ),
                            $this->get_render_attribute_string( 'split_text' ),
                            wp_kses_post( $settings['split_text'] )
                        );
                    } else {
                        printf( '<%1$s class="main-heading"><span %2$s>%3$s</span></%1$s>',
                            tag_escape( $settings['title_tag'] ),
                            $this->get_render_attribute_string( 'main_heading' ),
                            wp_kses_post( $settings['main_heading'] )
                        );
                    }
                }
            ?>
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
            view.addRenderAttribute( 'wrapper', 'class', 'oxence-advanced-heading');

            if ( 'bottom' === settings.sub_heading_style_align ) {
                var dots_class = 'dots dots-bottom';
            } else if ( 'right' === settings.sub_heading_style_align ) {
                var dots_class = 'dots dots-right';
            } else {
                var dots_class = 'dots dots-left';
            }
        #>
        <div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>
            <# if ( settings.sub_heading ) { #>
                <#
                    view.addRenderAttribute( 'sub_heading', 'class', 'sub-heading-text' );
                    view.addInlineEditingAttributes( 'sub_heading', 'none' );
                #>
                <div class="sub-heading">
                    <# if ( 'arrow' === settings.sub_heading_style ) { #>
                        <span class="arrow-line">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4.15 1.83"><path d="M0.1,0.57C0.25,0.5,0.39,0.4,0.54,0.32C0.69,0.25,0.85,0.2,1.01,0.19c0.3-0.02,0.57,0.11,0.69,0.39 c0.12,0.27,0.14,0.57,0.39,0.76c0.22,0.17,0.5,0.21,0.77,0.22c0.16,0,0.33-0.01,0.49-0.03C3.43,1.51,3.52,1.5,3.61,1.48 c0.08-0.01,0.17-0.02,0.24-0.06c0.04-0.02,0.02-0.07-0.02-0.07C3.75,1.34,3.68,1.37,3.61,1.38C3.53,1.4,3.46,1.42,3.38,1.43 C3.23,1.46,3.07,1.47,2.91,1.47c-0.29,0-0.63-0.04-0.84-0.26c-0.23-0.23-0.2-0.59-0.39-0.84C1.52,0.18,1.26,0.1,1.01,0.11 C0.85,0.12,0.69,0.17,0.54,0.24c-0.16,0.08-0.34,0.17-0.47,0.3C0.06,0.55,0.08,0.58,0.1,0.57L0.1,0.57z"/><polygon points="4.06,1.39 3.81,1.24 3.55,1.09 3.78,1.41 3.61,1.76 3.84,1.57"/></svg>
                        </span>
                    <# } #>
                    <span {{{ view.getRenderAttributeString( 'sub_heading' ) }}}>{{{settings.sub_heading}}}</span>
                    <# if ( 'dots' === settings.sub_heading_style ) { #>
                        <span class="{{{ dots_class }}}">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                        <# if ( 'left-right' === settings.sub_heading_style_align ) { #>
                        <span class="dots dots-right">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                        <# } #>
                    <# } #>
                </div>
            <# } #>
            <# if ( settings.main_heading ) {
                view.addRenderAttribute( 'main_heading', 'class', 'main-text' );
                view.addInlineEditingAttributes( 'main_heading', 'none' ); #>

                <{{{settings.title_tag}}} class="main-heading">
                    <# if ( 'yes' == settings.split_main_heading && settings.split_text ) {
                        view.addRenderAttribute( 'split_text', 'class', 'split-text' );
                        view.addInlineEditingAttributes( 'split_text', 'none' ); #>
                        <span {{{ view.getRenderAttributeString( 'main_heading' ) }}}>{{{ settings.main_heading }}}</span>
                        <span {{{ view.getRenderAttributeString( 'split_text' ) }}}>{{{ settings.split_text }}}</span>
                    <# } else { #>
                        <span {{{ view.getRenderAttributeString( 'main_heading' ) }}}>{{{ settings.main_heading }}}</span>
                    <# } #>
                </{{{settings.title_tag}}}>
            <# } #>
        </div>
        <?php
    }
}