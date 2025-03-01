<?php
namespace OxenceToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Widget_Base;
use OxenceTheme\Classes\Oxence_Helper;

defined( 'ABSPATH' ) || exit;

class Text_Timeline extends Widget_Base {

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
        return 'oxence-text-timeline';
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
        return esc_html__( 'Text Timeline', 'oxence-toolkit' );
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
        return 'eicon-carousel';
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
        return ['oxence', 'toolkit', 'text', 'timeline', 'slider', 'carousel'];
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
                'label' => esc_html__( 'Text Timeline', 'oxence-toolkit' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__( 'Title', 'oxence-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'Timeline Title', 'oxence-toolkit' ),
            ]
        );

        $repeater->add_control(
            'item_link',
            [
                'label'   => esc_html__( 'link', 'oxence-toolkit' ),
                'type'    => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'items',
            [
                'label'       => esc_html__( 'Items', 'oxence-toolkit' ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'title'     => esc_html__( 'Web Design', 'oxence-toolkit' ),
                        'item_link' => [
                            'url' => '#',
                        ],
                    ],
                    [
                        'title'     => esc_html__( 'Product Design', 'oxence-toolkit' ),
                        'item_link' => [
                            'url' => '#',
                        ],
                    ],
                    [
                        'title'     => esc_html__( 'Web Development', 'oxence-toolkit' ),
                        'item_link' => [
                            'url' => '#',
                        ],
                    ],
                    [
                        'title'     => esc_html__( 'SEO Optimization', 'oxence-toolkit' ),
                        'item_link' => [
                            'url' => '#',
                        ],
                    ],
                    [
                        'title'     => esc_html__( 'UX/UI Strategy', 'oxence-toolkit' ),
                        'item_link' => [
                            'url' => '#',
                        ],
                    ],
                    [
                        'title'     => esc_html__( 'Graphics', 'oxence-toolkit' ),
                        'item_link' => [
                            'url' => '#',
                        ],
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_additional_options',
            [
                'label' => esc_html__( 'Carousel Options', 'oxence-toolkit' ),
            ]
        );

        $slides_per_view = range( 1, 10 );
        $slides_per_view = array_combine( $slides_per_view, $slides_per_view );

        $this->add_responsive_control(
            'slides_per_view',
            [
                'type'                 => Controls_Manager::SELECT,
                'label'                => esc_html__( 'Slides Per View', 'oxence-toolkit' ),
                'options'              => $slides_per_view,
                'widescreen_default'   => 4,
                'default'              => 4,
                'laptop_default'       => 4,
                'tablet_extra_default' => 3,
                'tablet_default'       => 3,
                'mobile_extra_default' => 2,
                'mobile_default'       => 2,
                'frontend_available'   => true,
            ]
        );

        $this->add_responsive_control(
            'slides_to_scroll',
            [
                'type'                 => Controls_Manager::SELECT,
                'label'                => esc_html__( 'Slides to Scroll', 'oxence-toolkit' ),
                'description'          => esc_html__( 'Set how many slides are scrolled per swipe.', 'oxence-toolkit' ),
                'options'              => $slides_per_view,
                'widescreen_default'   => 1,
                'default'              => 1,
                'laptop_default'       => 1,
                'tablet_extra_default' => 1,
                'tablet_default'       => 1,
                'mobile_extra_default' => 1,
                'mobile_default'       => 1,
                'frontend_available'   => true,
            ]
        );

        $this->add_control(
            'speed',
            [
                'label'              => esc_html__( 'Animation Duration', 'oxence-toolkit' ),
                'type'               => Controls_Manager::NUMBER,
                'default'            => 500,
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'              => esc_html__( 'Autoplay', 'oxence-toolkit' ),
                'type'               => Controls_Manager::SWITCHER,
                'default'            => 'yes',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label'              => esc_html__( 'Autoplay Speed', 'oxence-toolkit' ),
                'type'               => Controls_Manager::NUMBER,
                'default'            => 5000,
                'condition'          => [
                    'autoplay' => 'yes',
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'loop',
            [
                'label'              => esc_html__( 'Infinite Loop', 'oxence-toolkit' ),
                'type'               => Controls_Manager::SWITCHER,
                'default'            => 'yes',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label'              => esc_html__( 'Pause on Hover', 'oxence-toolkit' ),
                'type'               => Controls_Manager::SWITCHER,
                'default'            => 'yes',
                'condition'          => [
                    'autoplay' => 'yes',
                ],
                'frontend_available' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'team_item_style',
            [
                'label' => esc_html__( 'Timeline Text', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-text-timeline .timeline-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'text_typography',
                'selector' => '{{WRAPPER}} .oxence-text-timeline .timeline-text',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'star_style',
            [
                'label' => esc_html__( 'Star Icon', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'star_size',
            [
                'label'      => esc_html__( 'Size', 'oxence-toolkit' ),
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
                    '{{WRAPPER}} .oxence-text-timeline .timeline-star svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'star_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-text-timeline .timeline-star svg' => 'fill: {{VALUE}};',
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
        ?>
        <div class="oxence-text-timeline oxence-slider-active">
            <?php foreach ( $settings['items'] as $index => $item ) : ?>
            <div class="oxence-slider-item">
                <div class="timeline-item">
                    <div class="timeline-star">
                        <?php echo Oxence_Helper::render_svg_icon( 'star' ); ?>
                    </div>
                    <?php
                        $title_key = $this->get_repeater_setting_key( 'title', 'items', $index );
                        $this->add_render_attribute( $title_key, 'class', 'timeline-text' );

                        if ( ! empty( $item['item_link']['url'] ) ) {
                            $this->add_link_attributes( $title_key, $item['item_link'] );

                            printf( '<a %1$s>%2$s</a>',
                                $this->get_render_attribute_string( $title_key ),
                                ot_kses_basic( $item['title'] )
                            );
                        } else {
                            printf( '<span %1$s>%2$s</span>',
                                $this->get_render_attribute_string( $title_key ),
                                ot_kses_basic( $item['title'] )
                            );
                        }
                    ?>
                </div>
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
        <# if ( settings.items ) { #>
            <div class="oxence-text-timeline oxence-slider-active">
                <# _.each( settings.items, function( item, index ) { #>
                <div class="oxence-slider-item">
                    <div class="timeline-item">
                        <div class="timeline-star">
                            <svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg">
                                <path d="m250 5 46.9 131.8 126.3-60-60 126.3 131.8 46.9-131.8 46.9 60 126.3-126.3-60-46.9 131.8-46.9-131.8-126.3 60 60-126.3-131.8-46.9 131.8-46.9-60-126.3 126.3 60z"/>
                            </svg>
                        </div>
                        <# if ( item.item_link.url ) {  #>
                            <a href="#" class="timeline-text">{{{ item.title }}}</a>
                        <# } else {  #>
                            <span class="timeline-text">{{{ item.title }}}</span>
                        <# } #>
                    </div>
                </div>
                <# } ); #>
            </div>
        <# } #>
        <?php
    }
}