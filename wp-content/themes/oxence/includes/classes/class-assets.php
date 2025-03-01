<?php
namespace OxenceTheme\Classes;

defined( 'ABSPATH' ) || exit;

/**
 * Load Theme Assets
 */
class Oxence_Assets {

    protected static $instance = null;

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function initialize() {
        add_action( 'wp_enqueue_scripts', [$this, 'enqueue_styles'] );
        add_action( 'wp_enqueue_scripts', [$this, 'enqueue_scripts'] );
        add_action( 'wp_enqueue_scripts', [$this, 'inline_css'] );

        add_action( 'admin_enqueue_scripts', [$this, 'enqueue_admin_styles'] );

        add_action( 'wp_head', [$this, 'custom_header_scripts'] );
        add_action( 'wp_footer', [$this, 'custom_footer_scripts'] );
    }

    /**
     * Load Google Font
     *
     * @return string
     */
    public function google_font_url() {
        $fonts_url     = '';
        $font_families = [];
        $subsets       = 'latin';

        $primary_font   = Oxence_Helper::get_option( 'primary_font', ['font-family' => ''] );
        $secondary_font = Oxence_Helper::get_option( 'secondary_font', ['font-family' => ''] );

        if ( '' == $primary_font || is_array( $primary_font ) && ! $primary_font['font-family'] ) {
            if ( 'off' !== _x( 'on', 'Roboto', 'oxence' ) ) {
                $font_families[] = 'Roboto:300i,300,400i,400,500i,500,600,700,800';
            }
        }

        if ( '' == $primary_font || is_array( $secondary_font ) && ! $secondary_font['font-family'] ) {
            if ( 'off' !== _x( 'on', 'Merriweather', 'oxence' ) ) {
                $font_families[] = 'Merriweather:300i,300,400i,400,700i,700,900';
            }
        }

        if ( $font_families ) {
            $fonts_url = add_query_arg( [
                'family' => urlencode( implode( '|', $font_families ) ),
                'subset' => urlencode( $subsets ),
            ], 'https://fonts.googleapis.com/css' );
        }

        return esc_url_raw( $fonts_url );
    }

    /**
     * Enqueue Theme Style
     *
     * @return void
     */
    public function enqueue_styles() {
        wp_enqueue_style( 'oxence-fonts', $this->google_font_url(), [], null );
        wp_enqueue_style( 'fontawesome', OXENCE_ASSETS . '/css/font-awesome.min.css', [], '5.14' );
        wp_enqueue_style( 'slick', OXENCE_ASSETS . '/css/slick.min.css', [], '1.8.1' );
        wp_enqueue_style( 'magnific-popup', OXENCE_ASSETS . '/css/magnific-popup.min.css', [], '1.1.0' );
        wp_enqueue_style( 'animation', OXENCE_ASSETS . '/css/animations.min.css', [], '1.0' );
        wp_enqueue_style( 'oxence-theme', OXENCE_ASSETS . '/css/theme.min.css', [], OXENCE_VERSION );
        wp_enqueue_style( 'oxence-style', get_stylesheet_uri(), [], OXENCE_VERSION );
    }

    /**
     * Inline CSS
     *
     * @return void
     */
    public function inline_css() {
        $primary_font    = Oxence_Helper::get_option( 'primary_font', ['font-family' => ''] );
        $secondary_font  = Oxence_Helper::get_option( 'secondary_font', ['font-family' => ''] );

        $inline_css = [];

        if ( is_array( $primary_font ) && $primary_font['font-family'] ) {
            $inline_css[] = '--oxence-primary-font: ' . $primary_font['font-family'];
        } else {
            $inline_css[] = '--oxence-primary-font: Roboto';
        }

        if ( is_array( $primary_font ) && $secondary_font['font-family'] ) {
            $inline_css[] = '--oxence-secondary-font: ' . $secondary_font['font-family'];
        } else {
            $inline_css[] = '--oxence-secondary-font: Merriweather';
        }

        $colors = Oxence_Helper::get_global_colors();

        foreach ( $colors as $key => $color ) {
            $inline_css[] = '--' . $color['slug'] . ':' . $color['value'];
        }

        if ( did_action( 'elementor/loaded' ) ) {
            foreach ( $colors as $key => $color ) {
                $inline_css[] = '--e-global-color-' . $key . ':' . $color['value'];
            }
        }

        $output = '
        :root {
            ' . esc_attr( implode( '; ', $inline_css ) ) . '
        }
        ';

        wp_add_inline_style( 'oxence-theme', $output );
    }

    /**
     * Enqueue Theme Scripts
     *
     * @return void
     */
    public function enqueue_scripts() {
        wp_enqueue_script( 'slick', OXENCE_ASSETS . '/js/slick.min.js', ['jquery'], '1.8.1', true );
        wp_enqueue_script( 'magnific-popup', OXENCE_ASSETS . '/js/magnific-popup.min.js', ['jquery'], '1.1.0', true );
        wp_enqueue_script( 'isotope', OXENCE_ASSETS . '/js/isotope.pkgd.min.js', ['jquery', 'imagesloaded'], '3.0.6', true );
        wp_enqueue_script( 'easypiechart', OXENCE_ASSETS . '/js/jquery.easypiechart.min.js', ['jquery'], '2.1.7', true );
        wp_enqueue_script( 'oxence-theme', OXENCE_ASSETS . '/js/theme.min.js', ['jquery'], OXENCE_VERSION, true );

        wp_localize_script(
            'oxence-theme',
            'oxenceLocalize', [
                'ajax_url' => admin_url( 'admin-ajax.php' ),
            ]
        );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }

    /**
     * Admin CSS
     */
    public function enqueue_admin_styles() {
        wp_enqueue_style( 'oxence-admin', OXENCE_ASSETS . '/css/admin.min.css', [], OXENCE_VERSION, 'all' );
    }

    /**
     * Custom Header Scripts
     */
    public function custom_header_scripts() {
        if ( '' !== Oxence_Helper::get_option( 'custom_header_scripts' ) ): ?>
        <script>
            <?php echo Oxence_Helper::get_option( 'custom_header_scripts' ); ?>
        </script>
        <?php endif;
    }

    /**
     * Custom Scripts
     */
    public function custom_footer_scripts() {
        if ( '' !== Oxence_Helper::get_option( 'custom_footer_scripts' ) ): ?>
        <script>
            <?php echo Oxence_Helper::get_option( 'custom_footer_scripts' ); ?>
        </script>
        <?php endif;
    }
}

Oxence_Assets::instance()->initialize();