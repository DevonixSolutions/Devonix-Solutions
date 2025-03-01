<?php
namespace OxenceToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use OxenceTheme\Classes\Oxence_Helper;

defined( 'ABSPATH' ) || exit;

class Feature_List extends Widget_Base {

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
        return 'oxence-feature-list';
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
        return esc_html__( 'Feature List', 'oxence-toolkit' );
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
        return 'eicon-editor-list-ul';
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
        return ['oxence', 'toolkit', 'list', 'feature'];
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
                'label' => esc_html__( 'Feature List', 'oxence-toolkit' ),
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
                'default'     => esc_html__( 'Awards Winning Company', 'oxence-toolkit' ),
            ]
        );

        $repeater->add_control(
            'icon_type',
            [
                'label'   => esc_html__( 'Icon Type', 'oxence-toolkit' ),
                'type'    => Controls_Manager::CHOOSE,
                'toggle'  => false,
                'default' => 'icon',
                'options' => [
                    'icon'  => [
                        'title' => esc_html__( 'Icon', 'oxence-toolkit' ),
                        'icon'  => 'fas fa-star',
                    ],
                    'image' => [
                        'title' => esc_html__( 'Image', 'oxence-toolkit' ),
                        'icon'  => 'far fa-image',
                    ],
                ],
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
                'condition'        => [
                    'icon_type' => 'icon',
                ],
                'label_block'      => true,
            ]
        );

        $repeater->add_control(
            'selected_image',
            [
                'label'       => esc_html__( 'Image Icon', 'oxence-toolkit' ),
                'type'        => Controls_Manager::MEDIA,
                'render_type' => 'template',
                'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition'   => [
                    'icon_type' => 'image',
                ],
            ]
        );

        $repeater->add_control(
            'item_link',
            [
                'label' => esc_html__( 'link', 'oxence-toolkit' ),
                'type'  => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $this->add_control(
            'feature_list',
            [
                'label'       => esc_html__( 'Items', 'oxence-toolkit' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'title'         => esc_html__( 'Awards Winning Company', 'oxence-toolkit' ),
                        'icon_type'     => 'icon',
                        'selected_icon' => [
                            'value' => 'fas fa-award',
                            'library' => 'fa-solid',
                        ],
                        'item_link' => [
                            'url' => '#'
                        ]
                    ],
                    [
                        'title'         => esc_html__( 'Experience Team Members', 'oxence-toolkit' ),
                        'icon_type'     => 'icon',
                        'selected_icon' => [
                            'value' => 'fas fa-users',
                            'library' => 'fa-solid',
                        ],
                        'item_link' => [
                            'url' => '#'
                        ]
                    ],
                    [
                        'title'         => esc_html__( '25+ Years Experience In Product Design', 'oxence-toolkit' ),
                        'icon_type'     => 'icon',
                        'selected_icon' => [
                            'value' => 'fas fa-chart-line',
                            'library' => 'fa-solid',
                        ],
                        'item_link' => [
                            'url' => '#'
                        ]
                    ],
                ],
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
            'section_wrapper',
            [
                'label'     => esc_html__( 'Wrapper', 'oxence-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label'      => esc_html__( 'Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-feature-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_margin',
            [
                'label'      => esc_html__( 'Margin', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-feature-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'wrapper_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .oxence-feature-list',
            ]
        );

        $this->add_responsive_control(
            'wrapper_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-feature-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'wrapper_bg',
                'selector' => '{{WRAPPER}} .oxence-feature-list',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'info_box_shadow',
                'selector' => '{{WRAPPER}} .oxence-feature-list',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_item',
            [
                'label'     => esc_html__( 'Item', 'oxence-toolkit' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'divider_color',
            [
                'label' => esc_html__( 'Divider Color', 'oxence-toolkit' ),
                'type'  => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .oxence-feature-list .feature-item' => 'border-color: {{VALUE}};',
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
                    '{{WRAPPER}} .oxence-feature-list .feature-item' => 'border-width: {{SIZE}}px;',
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
                    '{{WRAPPER}} .oxence-feature-list .feature-item' => 'padding-bottom: {{SIZE}}px;',
                    '{{WRAPPER}} .oxence-feature-list .feature-item:not(:last-child)' => 'margin-bottom: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'title_heading',
            [
                'label' => esc_html__( 'Title', 'oxence-toolkit' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-feature-list .feature-item .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .oxence-feature-list .feature-item .title',
            ]
        );

        $this->add_control(
            'link_arrow_heading',
            [
                'label' => esc_html__( 'Link Arrow', 'oxence-toolkit' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'arrow_gap',
            [
                'label'     => esc_html__( 'Size', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => 0,
                        'step' => 1,
                        'max'  => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .oxence-feature-list .feature-item .link svg' => 'width: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-feature-list .feature-item .link svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_icon',
            [
                'label'      => esc_html__( 'Icon/Image', 'oxence-toolkit' ),
                'tab'        => Controls_Manager::TAB_STYLE,
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
                        'max'  => 150,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-feature-list .feature-item .icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'icon_typography',
                'selector'  => '{{WRAPPER}} .oxence-feature-list .feature-item .icon',
                'label'     => esc_html__( 'Icon Size', 'oxence-toolkit' ),
                'exclude'   => [
                    'font_family',
                    'letter_spacing',
                    'word_spacing',
                    'font_style',
                    'text_transform',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'      => esc_html__( 'Image Size', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'vh', 'vw'],
                'range'      => [
                    'px' => [
                        'min' => 6,
                        'max' => 500,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-feature-list .feature-item .icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_background',
            [
                'label'     => esc_html__( 'Icon Background', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-feature-list .feature-item .icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'icon_border',
                'placeholder' => '0',
                'default'     => '0',
                'selector'    => '{{WRAPPER}} .oxence-feature-list .feature-item .icon',
            ]
        );

        $this->add_responsive_control(
            'icon_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-feature-list .feature-item .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_shadow',
                'selector' => '{{WRAPPER}} .oxence-feature-list .feature-item .icon',
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
        <div class="oxence-feature-list">
            <?php foreach ( $settings['feature_list'] as $index => $item ) : ?>
                <div class="feature-item">
                    <?php if ( $item['selected_icon'] || $item['selected_image']['url'] ) : ?>
                    <div class="icon">
                        <?php if ( 'image' == $item['icon_type'] ) : ?>
                            <img src="<?php echo esc_url( $item['selected_image']['url'] ) ?>" alt="<?php esc_html_e( 'Icon', 'oxence-toolkit' ) ?>">
                        <?php else :
                            $migrated = isset( $item['__fa4_migrated']['selected_icon'] );
                            $is_new   = empty( $item['icon'] ) && Icons_Manager::is_migration_allowed();

                            $this->add_render_attribute( 'font-icon', 'class', $item['selected_icon'] );
                            $this->add_render_attribute( 'font-icon', 'aria-hidden', 'true' );

                            if ( $is_new || $migrated ) :
                                Icons_Manager::render_icon( $item['selected_icon'], ['aria-hidden' => 'true'] );
                            else: ?>
                                <i <?php echo $this->get_render_attribute_string( 'font-icon' ); ?>></i>
                            <?php endif;?>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <?php
                        if ( ! empty( $item['title'] ) ) {
                            $title_key = $this->get_repeater_setting_key( 'title', 'feature_list', $index );
                            $this->add_render_attribute( $title_key, 'class', 'title' );
                            $this->add_inline_editing_attributes( $title_key, 'none' );

                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                ot_escape_tags( $settings['title_tag'], 'h4' ),
                                $this->get_render_attribute_string( $title_key ),
                                ot_kses_basic( $item['title'] )
                            );
                        }

                        if ( $item['item_link']['url'] )  {
                            $link_key = $this->get_repeater_setting_key( 'item_link', 'feature_list', $index );
                            $this->add_render_attribute( $link_key, 'class', 'link' );
                            $this->add_link_attributes( $link_key, $item['item_link'] );

                            printf( '<a %1$s>%2$s</a>',
                                $this->get_render_attribute_string( $link_key ),
                                Oxence_Helper::render_svg_icon( 'arrow-right' )
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
        <# if ( settings.feature_list ) { #>
        <div class="oxence-feature-list">
            <# _.each( settings.feature_list, function( item, index ) { #>
                <div class="feature-item">
                    <# if (( item.selected_image.url && item.icon_type == 'image' ) || ( item.selected_icon.value  && item.icon_type == 'icon' )) { #>
                    <div class="icon">
                        <#
                            var iconHTML = elementor.helpers.renderIcon( view, item.selected_icon, { 'aria-hidden': true }, 'i' , 'object' );
                            var migrated = elementor.helpers.isIconMigrated( item, 'selected_icon' );
                        #>
                        <# if ( item.selected_image.url && item.icon_type == 'image' ) { #>
                            <img src="{{{item.selected_image.url}}}" alt="{{{ item.title }}}">
                        <# } else if ( item.selected_icon.value  && item.icon_type == 'icon' ) { #>
                            <# if ( iconHTML && iconHTML.rendered && ( ! item.icon || migrated ) ) { #>
                                {{{ iconHTML.value }}}
                            <# } else { #>
                                <i class="{{ item.icon }}" aria-hidden="true"></i>
                            <# } #>
                        <# } #>
                    </div>
                    <# } #>
                    <# if ( item.title ) {
                        var titleKey = view.getRepeaterSettingKey( 'title', 'feature_list', index );
                        view.addRenderAttribute( titleKey, 'class', 'title' );
                        view.addInlineEditingAttributes( titleKey, 'none' );
                        #>
                        <{{{ settings.title_tag }}} {{{ view.getRenderAttributeString( titleKey ) }}}>
                            {{{ item.title }}}
                        </{{{ settings.title_tag }}}>
                        <#
                    } #>
                    <# if ( item.item_link.url )  { #>
                    <a href="#" class="link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 512 384">
                            <path d="M303.616,0L283.747,22.481,458.514,177H0V207H458.514L283.747,361.519,303.616,384,512,199.762V184.238Z"/>
                        </svg>
                    </a>
                    <# } #>
                </div>
            <# } ); #>
        </div>
        <# } #>
        <?php
    }
}