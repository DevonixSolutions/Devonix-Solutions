<?php

namespace OxenceTheme\Classes;

defined( 'ABSPATH' ) || exit;

/**
 * Initial Helper functions for this theme.
 */
class Oxence_Helper {
    /**
     * Get Theme Options
     *
     * @param $option Required Option id
     * @param $default Optional set default value
     *
     * @return mixed
     */
    public static function get_option( $option, $default = null ) {
        $options = get_option( 'oxence_options' );
        return ( isset( $options[$option] ) ) ? $options[$option] : $default;
    }

    /**
     * Get a metaboxes
     *
     * @param $prefix_key Required Meta unique slug
     * @param $meta_key Required Meta slug
     * @param $default Optional Set default value
     * @param $id Optional Set post id
     *
     * @return mixed
     */
    public static function get_meta( $prefix_key, $meta_key, $default = null, $id = '' ) {
        if ( ! $id ) {
            $id = get_the_ID();
        }

        $meta_boxes = get_post_meta( $id, $prefix_key, true );
        return ( isset( $meta_boxes[$meta_key] ) ) ? $meta_boxes[$meta_key] : $default;
    }

    /**
     * Get content layout
     *
     * @return string
     */
    public static function content_layout() {
        $layout = 'boxed-layout';

        if ( is_page() ) {
            $page_layout = self::get_meta( 'oxence_page_meta', 'content_layout', 'boxed-layout' );
            $layout      = $page_layout;

            if ( class_exists( 'Woocommerce' ) ) {
                $shop_layout = self::get_option( 'shop_layout', 'boxed-layout' );

                if ( is_cart() || is_checkout() || is_account_page() || is_wc_endpoint_url() ) {
                    $layout = $shop_layout;
                }
            }

        } elseif ( is_single() && 'post' === get_post_type() ) {
            $layout      = self::get_option( 'blog_details_layout', 'boxed-layout' );
            $post_layout = self::get_meta( 'oxence_post_meta', 'post_details_layout', 'default' );

            if ( 'default' !== $post_layout ) {
                $layout = $post_layout;
            }
        } elseif ( is_single() && 'oxence_service' === get_post_type() ) {
            $service_layout = self::get_meta( 'oxence_service_meta', 'content_layout', 'boxed-layout' );
            $layout         = $service_layout;
        } elseif ( is_single() && 'oxence_team' === get_post_type() ) {
            $layout = self::get_option( 'team_single_layout', 'boxed-layout' );
        } elseif ( is_single() && 'oxence_portfolio' === get_post_type() ) {
            $layout = self::get_option( 'portfolio_single_layout', 'boxed-layout' );
        } elseif ( is_single() && 'product' === get_post_type() ) {
            $layout = self::get_option( 'shop_layout', 'boxed-layout' );
        } elseif ( is_archive() ) {
            if ( is_post_type_archive( 'oxence_service' ) ) {
                $layout = self::get_option( 'service_archive_layout', 'boxed-layout' );
            } elseif ( is_post_type_archive( 'oxence_team' ) ) {
                $layout = self::get_option( 'team_archive_layout', 'boxed-layout' );
            } elseif ( is_post_type_archive( 'oxence_portfolio' ) ) {
                $layout = self::get_option( 'portfolio_archive_layout', 'boxed-layout' );
            } elseif ( class_exists( 'Woocommerce' ) ) {
                $shop_layout = self::get_option( 'shop_layout', 'boxed-layout' );

                if ( is_shop() ) {
                    $layout = $shop_layout;
                }
            }
        } elseif ( ! is_page() ) {
            $layout = self::get_option( 'blog_archive_layout', 'boxed-layout' );
        }

        return $layout;
    }

    /**
     * Get Content Sidebar
     *
     * @return string
     */
    public static function content_sidebar() {
        $sidebar = 'right-sidebar';

        if ( is_page() ) {
            $page_sidebar = self::get_meta( 'oxence_page_meta', 'content_sidebar', 'no-sidebar' );
            $sidebar      = $page_sidebar;
        } elseif ( is_single() && 'post' === get_post_type() ) {
            $sidebar      = self::get_option( 'blog_details_sidebar', 'right-sidebar' );
            $post_sidebar = self::get_meta( 'oxence_post_meta', 'post_details_sidebar', 'default' );

            if ( 'default' !== $post_sidebar ) {
                $sidebar = $post_sidebar;
            }
        } elseif ( is_single() && 'oxence_service' === get_post_type() ) {
            $service_sidebar = self::get_meta( 'oxence_service_meta', 'content_sidebar', 'no-sidebar' );
            $sidebar         = $service_sidebar;
        } elseif ( ! is_page() ) {
            $sidebar = self::get_option( 'blog_archive_sidebar', 'right-sidebar' );
        }

        if ( ! is_active_sidebar( 'primary_sidebar' ) ) {
            $sidebar = 'no-sidebar';
        }

        return $sidebar;
    }

    /**
     * Set Container Class
     *
     * @return string|string[] $classes Space-separated string or array of class.
     */
    public static function container_class() {
        $classes = ['content-container'];

        if ( 'full-width-layout' === self::content_layout() ) {
            $classes[] = 'full-width';
        }

        echo esc_attr( implode( ' ', $classes ) );
    }

    /**
     * Set Container Inner classes
     *
     * @return string|string[] $classes Space-separated string or array of class.
     */
    public static function content_wrap_class() {
        $classes = ['content-wrapper'];

        if ( 'left-sidebar' === self::content_sidebar() ) {
            $classes[] = 'left-sidebar';
        } elseif ( 'right-sidebar' === self::content_sidebar() ) {
            $classes[] = 'right-sidebar';
        } elseif ( 'no-sidebar' === self::content_sidebar() ) {
            $classes[] = 'no-sidebar';
        }

        // return the $classes array
        echo esc_attr( implode( ' ', $classes ) );
    }

    /**
     * Check Theme Default Header
     */
    public static function check_default_header() {
        $default_header = self::get_option( 'default_header', 'enabled' );

        if ( is_page() ) {
            $page_default_header = self::get_meta( 'oxence_page_meta', 'page_default_header', 'default' );

            if ( 'default' !== $page_default_header ) {
                $default_header = $page_default_header;
            }
        } elseif ( is_single() && 'post' === get_post_type() ) {
            $post_default_header = self::get_meta( 'oxence_post_meta', 'post_default_header', 'default' );

            if ( 'default' !== $post_default_header ) {
                $default_header = $post_default_header;
            }
        }

        return $default_header;
    }

    /**
     * Check Default Footer
     *
     * @return void
     */
    public static function check_default_footer() {
        $default_footer = self::get_option( 'default_footer', 'enabled' );

        if ( is_page() ) {
            $page_default_footer = self::get_meta( 'oxence_page_meta', 'page_default_footer', 'default' );

            if ( 'default' !== $page_default_footer ) {
                $default_footer = $page_default_footer;
            }
        } elseif ( is_single() && 'post' === get_post_type() ) {
            $post_default_footer = self::get_meta( 'oxence_post_meta', 'post_default_footer', 'default' );

            if ( 'default' !== $post_default_footer ) {
                $default_footer = $post_default_footer;
            }
        }

        return $default_footer;
    }

    /**
     * Check Transparent Header
     *
     * @return void
     */
    public static function transparent_header() {
        $transparent_header = self::get_option( 'transparent_header', 'enabled' );

        if ( is_page() ) {
            $page_transparent = self::get_meta( 'oxence_page_meta', 'page_transparent_header', 'default' );

            if ( 'default' !== $page_transparent ) {
                $transparent_header = $page_transparent;
            }
        } elseif ( is_single() && 'post' === get_post_type() ) {
            $post_transparent = self::get_meta( 'oxence_post_meta', 'post_transparent_header', 'default' );

            if ( 'default' !== $post_transparent ) {
                $transparent_header = $post_transparent;
            }
        }

        return $transparent_header;
    }

    /**
     * Get theme Global Color
     *
     * @return array
     */
    public static function get_global_colors() {
        $colors = [];

        $primary_color   = self::get_option( 'primary_color', '' );
        $secondary_color = self::get_option( 'secondary_color', '' );
        $headline_color  = self::get_option( 'oxence_headline', '' );
        $body_color      = self::get_option( 'body_color', '' );
        $border_color    = self::get_option( 'border_color', '' );
        $border_color    = self::get_option( 'border_color', '' );
        $light_neutral   = self::get_option( 'light_neutral', '' );
        $white_color     = self::get_option( 'white_color', '' );

        $colors['oxence_primary'] = [
            'slug'  => 'oxence-primary-color',
            'title' => esc_html__( 'Oxence Primary Color', 'oxence' ),
            'value' => ! empty( $primary_color ) ? $primary_color : '#3180fc',
        ];

        $colors['oxence_secondary'] = [
            'slug'  => 'oxence-secondary-color',
            'title' => esc_html__( 'Oxence Secondary Color', 'oxence' ),
            'value' => ! empty( $secondary_color ) ? $secondary_color : '#293043',
        ];

        $colors['oxence_headline'] = [
            'slug'  => 'oxence-headline-color',
            'title' => esc_html__( 'Oxence Headline Color', 'oxence' ),
            'value' => ! empty( $headline_color ) ? $headline_color : '#293043',
        ];

        $colors['oxence_body'] = [
            'slug'  => 'oxence-body-color',
            'title' => esc_html__( 'Oxence Body Color', 'oxence' ),
            'value' => ! empty( $body_color ) ? $body_color : '#696e7b',
        ];

        $colors['oxence_border'] = [
            'slug'  => 'oxence-border-color',
            'title' => esc_html__( 'Oxence Border Color', 'oxence' ),
            'value' => ! empty( $border_color ) ? $border_color : '#e8e8ea',
        ];

        $colors['oxence_light'] = [
            'slug'  => 'oxence-light-color',
            'title' => esc_html__( 'Oxence light Color', 'oxence' ),
            'value' => ! empty( $light_neutral ) ? $light_neutral : '#f7f7f9',
        ];

        $colors['oxence_white'] = [
            'slug'  => 'oxence-white-color',
            'title' => esc_html__( 'Oxence White Color', 'oxence' ),
            'value' => ! empty( $white_color ) ? $white_color : '#ffffff',
        ];

        return $colors;
    }

    /**
     * Get Elementor content for display
     *
     * @param int $content_id
     */
    public static function get_elementor_content( $content_id ) {
        $content = '';
        if ( \class_exists( '\Elementor\Plugin' ) ) {
            $elementor_instance = \Elementor\Plugin::instance();
            $content            = $elementor_instance->frontend->get_builder_content_for_display( $content_id );
        }
        return $content;
    }

    /**
     * Undocumented function
     *
     * @param string $name Svg Icon Name
     * @return void
     */
    public static function render_svg_icon( $name ) {
        $icon_path = OXENCE_PATH . "/assets/img/svg/{$name}.svg";

        if ( ! file_exists( $icon_path ) ) {
            return false;
        }

        ob_start();

        include $icon_path;

        $svg = ob_get_clean();

        return $svg;
    }
}
