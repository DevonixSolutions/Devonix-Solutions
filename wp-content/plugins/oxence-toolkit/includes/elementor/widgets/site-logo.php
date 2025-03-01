<?php
namespace OxenceToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use OxenceTheme\Classes\Oxence_Helper;

defined( 'ABSPATH' ) || exit;

class Site_Logo extends Widget_Base {

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
        return 'oxence-site-logo';
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
        return esc_html__( 'Site Logo', 'oxence-toolkit' );
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
        return 'eicon-site-logo';
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
        return ['oxence', 'toolkit', 'header', 'footer', 'logo', 'site'];
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
            'logo_form',
            [
                'label'   => esc_html__( 'Logo', 'oxence-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'default' => esc_html__( 'Default', 'oxence-toolkit' ),
                    'custom'  => esc_html__( 'Custom', 'oxence-toolkit' ),
                ],
                'default' => 'default',
            ]
        );

        $this->add_control(
            'logo_type',
            [
                'label'     => esc_html__( 'Type', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'text'  => esc_html__( 'Text', 'oxence-toolkit' ),
                    'image' => esc_html__( 'Image', 'oxence-toolkit' ),
                ],
                'default'   => 'text',
                'condition' => [
                    'logo_form' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'text_logo',
            [
                'label'      => esc_html__( 'Text logo', 'oxence-toolkit' ),
                'type'       => Controls_Manager::TEXT,
                'default'    => 'Oxence',
                'conditions' => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'logo_form',
                            'operator' => '==',
                            'value'    => 'custom',
                        ],
                        [
                            'name'     => 'logo_type',
                            'operator' => '==',
                            'value'    => 'text',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'image_logo',
            [
                'label'      => esc_html__( 'Image Logo', 'oxence-toolkit' ),
                'type'       => Controls_Manager::MEDIA,
                'default'    => [
                    'url' => OT_ASSETS . '/img/options/logo.png',
                ],
                'conditions' => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'logo_form',
                            'operator' => '==',
                            'value'    => 'custom',
                        ],
                        [
                            'name'     => 'logo_type',
                            'operator' => '==',
                            'value'    => 'image',
                        ],
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'logo_alignment',
            [
                'label'       => esc_html__( 'Logo Alignment', 'oxence-toolkit' ),
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
                    '{{WRAPPER}} .oxence-site-logo' => 'text-align: {{VALUE}};',
                ],
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'url_type',
            [
                'label'   => esc_html__( 'URL Type', 'oxence-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'default' => esc_html__( 'Default', 'oxence-toolkit' ),
                    'custom'  => esc_html__( 'Custom', 'oxence-toolkit' ),
                ],
                'default' => 'default',
            ]
        );

        $this->add_control(
            'custom_url',
            [
                'label'       => esc_html__( 'Custom URL', 'oxence-toolkit' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => home_url(),
                'condition'   => [
                    'url_type' => 'custom',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_image',
            [
                'label' => esc_html__( 'Style', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'logo_typography',
                'selector' => '{{WRAPPER}} .oxence-site-logo',
            ]
        );

        $this->add_control(
            'logo_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-site-logo a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'logo_hover_color',
            [
                'label'     => esc_html__( 'Color(Hover)', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-site-logo a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label'          => esc_html__( 'Width', 'oxence-toolkit' ),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units'     => ['%', 'px', 'vw'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .oxence-site-logo img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'max_width',
            [
                'label'          => esc_html__( 'Max Width', 'oxence-toolkit' ),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units'     => ['%', 'px', 'vw'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .oxence-site-logo' => 'max-width: {{SIZE}}{{UNIT}};',
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
        $settings = $this->get_settings();

        if ( 'custom' === $settings['url_type'] && ! empty( $settings['custom_url']['url'] ) ) {
            $url = $settings['custom_url']['url'];
        } else {
            $url = home_url();
        }

        $site_logo_type  = Oxence_Helper::get_option( 'site_logo_type', 'text' );
        $site_text_logo  = Oxence_Helper::get_option( 'site_text_logo', 'Oxence' );
        $site_image_logo = Oxence_Helper::get_option( 'site_image_logo', ['url' => ''] );
        ?>
        <div class="oxence-site-logo">
            <a href="<?php echo esc_url( $url ) ?>">
                <?php if ( 'custom' === $settings['logo_form'] ): ?>
                    <?php if ( 'text' === $settings['logo_type'] ): ?>
                        <?php echo esc_html( $settings['text_logo'] )?>
                    <?php elseif ( $settings['image_logo']['url'] ): ?>
                        <img src="<?php echo esc_url( $settings['image_logo']['url'] ) ?>" alt="<?php echo get_bloginfo() ?>">
                    <?php endif;?>
                <?php else : ?>
                    <?php if ( 'text' === $site_logo_type && ! empty ( $site_text_logo ) ) : ?>
                        <?php echo esc_html( $site_text_logo )?>
                    <?php elseif ( 'image' === $site_logo_type && ! empty ( $site_image_logo['url'] ) ) : ?>
                        <img src="<?php echo esc_url( $site_image_logo['url'] ) ?>" alt="<?php echo get_bloginfo() ?>">
                    <?php endif; ?>
                <?php endif;?>
            </a>
        </div>
        <?php
    }
}