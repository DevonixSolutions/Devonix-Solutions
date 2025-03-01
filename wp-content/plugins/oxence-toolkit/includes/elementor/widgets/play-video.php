<?php
namespace OxenceToolkit\ElementorAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit;

class Play_Video extends Widget_Base {

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
        return 'oxence-play-video';
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
        return esc_html__( 'Play Video', 'oxence-toolkit' );
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
        return 'eicon-youtube';
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
        return ['oxence', 'toolkit', 'video', 'youtube', 'play'];
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
            'video_type',
            [
                'label'   => esc_html__( 'Source', 'oxence-toolkit' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'youtube',
                'options' => [
                    'youtube'     => esc_html__( 'YouTube', 'oxence-toolkit' ),
                    'vimeo'       => esc_html__( 'Vimeo', 'oxence-toolkit' ),
                    'dailymotion' => esc_html__( 'Dailymotion', 'oxence-toolkit' ),
                    'hosted'      => esc_html__( 'Self Hosted', 'oxence-toolkit' ),
                ],
            ]
        );

        $this->add_control(
            'youtube_url',
            [
                'label'       => esc_html__( 'Link', 'oxence-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your URL', 'oxence-toolkit' ) . ' (YouTube)',
                'default'     => 'https://www.youtube.com/watch?v=XHOmBV4js_E',
                'label_block' => true,
                'condition'   => [
                    'video_type' => 'youtube',
                ],
            ]
        );

        $this->add_control(
            'vimeo_url',
            [
                'label'       => esc_html__( 'Link', 'oxence-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your URL', 'oxence-toolkit' ) . ' (Vimeo)',
                'default'     => 'https://vimeo.com/235215203',
                'label_block' => true,
                'condition'   => [
                    'video_type' => 'vimeo',
                ],
            ]
        );

        $this->add_control(
            'dailymotion_url',
            [
                'label'       => esc_html__( 'Link', 'oxence-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your URL', 'oxence-toolkit' ) . ' (Dailymotion)',
                'default'     => 'https://www.dailymotion.com/video/x6tqhqb',
                'label_block' => true,
                'condition'   => [
                    'video_type' => 'dailymotion',
                ],
            ]
        );

        $this->add_control(
            'insert_url',
            [
                'label'     => esc_html__( 'External URL', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'video_type' => 'hosted',
                ],
            ]
        );

        $this->add_control(
            'hosted_url',
            [
                'label'      => esc_html__( 'Choose File', 'oxence-toolkit' ),
                'type'       => Controls_Manager::MEDIA,
                'media_type' => 'video',
                'condition'  => [
                    'video_type' => 'hosted',
                    'insert_url' => '',
                ],
            ]
        );

        $this->add_control(
            'external_url',
            [
                'label'       => esc_html__( 'URL', 'oxence-toolkit' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your URL', 'oxence-toolkit' ) . ' (External)',
                'label_block' => true,
                'condition'   => [
                    'video_type' => 'hosted',
                    'insert_url' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_image',
            [
                'label'     => esc_html__( 'Show Image', 'oxence-toolkit' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_off' => esc_html__( 'Hide', 'oxence-toolkit' ),
                'label_on'  => esc_html__( 'Show', 'oxence-toolkit' ),
            ]
        );

        $this->add_control(
            'video_image',
            [
                'label'     => esc_html__( 'Choose Image', 'oxence-toolkit' ),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'show_image' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'video_image',
                'default'   => 'full',
                'separator' => 'none',
                'condition' => [
                    'show_image' => 'yes',
                ],
                'exclude'   => [
                    'custom',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'widget_style',
            [
                'label' => esc_html__( 'Video Area', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label'      => esc_html__( 'Padding', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-video' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'margin',
            [
                'label'      => esc_html__( 'Margin', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-video' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_img_width',
            [
                'label'      => esc_html__( 'Width', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    '%'  => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-video .oxence-image' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'show_image' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_img_height',
            [
                'label'      => esc_html__( 'Height', 'oxence-toolkit' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    '%'  => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-video .oxence-image' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'show_image' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_align',
            [
                'label'     => esc_html__( 'Video Align', 'oxence-toolkit' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'oxence-toolkit' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'     => [
                        'title' => esc_html__( 'Center', 'oxence-toolkit' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'flex-end'   => [
                        'title' => esc_html__( 'Right', 'oxence-toolkit' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .oxence-video' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'widget_btn_style',
            [
                'label' => esc_html__( 'Video Btn', 'oxence-toolkit' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'video_animated_border',
            [
                'label' => esc_html__( 'Show Animated Border', 'oxence-toolkit' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_responsive_control(
            'video_font_size',
            [
                'label'      => esc_html__( 'Font Size', 'oxence-toolkit' ),
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
                    '{{WRAPPER}} .oxence-video .popup-video' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_width',
            [
                'label'      => esc_html__( 'Width', 'oxence-toolkit' ),
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
                    '{{WRAPPER}} .oxence-video .popup-video' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_height',
            [
                'label'      => esc_html__( 'Height', 'oxence-toolkit' ),
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
                    '{{WRAPPER}} .oxence-video .popup-video' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'video_btn_border',
                'label'    => esc_html__( 'Border', 'oxence-toolkit' ),
                'selector' => '{{WRAPPER}} .oxence-video .popup-video',
            ]
        );

        $this->add_responsive_control(
            'video_btn_radius',
            [
                'label'      => esc_html__( 'Radius', 'oxence-toolkit' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .oxence-video .popup-video, {{WRAPPER}} .oxence-video .popup-video::before, {{WRAPPER}} .oxence-video .popup-video::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'video_btn_color',
            [
                'label'     => esc_html__( 'Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-video .popup-video' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'video_btn_shadow',
                'label'    => esc_html__( 'Box Shadow', 'oxence-toolkit' ),
                'selector' => '{{WRAPPER}} .oxence-video .popup-video',
            ]
        );

        $this->add_control(
            'video_btn_animated_border',
            [
                'label'     => esc_html__( 'Animated Border Color', 'oxence-toolkit' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .oxence-video .popup-video::before, {{WRAPPER}} .oxence-video .popup-video::after' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'video_animated_border' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'video_btn_bg',
                'label'    => esc_html__( 'Background', 'oxence-toolkit' ),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .oxence-video .popup-video',
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

        $video_url = '';

        if ( 'hosted' === $settings['video_type'] ) {
            if ( !empty( $settings['insert_url'] ) ) {
                $video_url = $settings['external_url'];
            } else {
                $video_url = $settings['hosted_url']['url'];
            }
        } elseif ( 'dailymotion' === $settings['video_type'] ) {
            $video_url = $settings['dailymotion_url'];
        } elseif ( 'vimeo' === $settings['video_type'] ) {
            $video_url = $settings['vimeo_url'];

        } elseif ( 'youtube' === $settings['video_type'] ) {
            $video_url = $settings['youtube_url'];
        }

        if ( empty( $settings['video_image']['id'] && ! empty( $settings['video_image']['url'] ) ) ) {
            $image_url = $settings['video_image']['url'];
        } else {
            $image_url = Group_Control_Image_Size::get_attachment_image_src( $settings['video_image']['id'], 'video_image', $settings );
        }

        if( 'yes' == $settings['video_animated_border'] ) {
            $btn_class = 'popup-video animated-border';
        } else {
            $btn_class = 'popup-video';
        }

        ?>
        <div class="oxence-video">
            <?php if( 'yes' === $settings['show_image'] ) : ?>
                <div class="oxence-image" style="background-image: url( <?php echo esc_url( $image_url ) ?> );">
                    <?php if( ! empty( $video_url ) ) : ?>
                        <a href="<?php echo esc_url( $video_url ) ?>" class="<?php echo esc_attr( $btn_class ) ?>"><i class="fas fa-play"></i></a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <?php if( ! empty( $video_url ) ) : ?>
                    <a href="<?php echo esc_url( $video_url ) ?>" class="<?php echo esc_attr( $btn_class ) ?>"><i class="fas fa-play"></i></a>
                <?php endif; ?>
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
            var video_url = '';

            if( 'hosted' === settings.video_type ) {
                if( settings.insert_url ) {
                    video_url = settings.external_url;
                } else {
                    video_url = settings.hosted_url.url;
                }
            } else if( 'dailymotion' === settings.video_type ) {
                video_url = settings.dailymotion_url;
            } else if( 'vimeo' === settings.video_type ) {
                video_url = settings.vimeo_url;
            } else if ( 'youtube' === settings.video_type ) {
                video_url = settings.youtube_url;
            }

            var image = {
                id: settings.video_image.id,
                url: settings.video_image.url,
                size: settings.video_image_size,
                dimension: settings.image_custom_dimension,
                model: view.getEditModel()
            };

            imageUrl = elementor.imagesManager.getImageUrl( image );

            if( 'yes' == settings.video_animated_border ) {
                var btn_class = 'popup-video animated-border';
            } else {
                var btn_class = 'popup-video';
            }
        #>
        <div class="oxence-video">
            <# if( 'yes' === settings.show_image ) { #>
                <div class="oxence-image" style="background-image: url({{{imageUrl}}});">
                    <a href="{{video_url}}" class="{{btn_class}}"><i class="fas fa-play"></i></a>
                </div>
            <# } else { #>
                <a href="{{video_url}}" class="{{btn_class}}"><i class="fas fa-play"></i></a>
            <# } #>
        </div>
        <?php
    }
}