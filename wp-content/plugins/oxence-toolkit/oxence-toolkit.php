<?php
/**
 * Plugin Name: Oxence Toolkit
 * Description: A Helper plugin for all Oxence Wordpress Themes
 * Plugin URI: #
 * Author: Webtend
 * AUthor URI: http://webtend.net/
 * Version: 1.1
 * Text Domain: oxence-toolkit
 * License: GPL2 or later
 * License URI: http://www.gnu.org/licences/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * The Main Plugin class
 */
final class Oxence_Toolkit {

    /**
     * Addon Version
     *
     * @since 1.0.0
     * @var string The Plugin version.
     */
    const version = '1.1';

    /**
     * Minimum PHP Version
     *
     * @since 1.0.0
     * @var string Minimum PHP version required to run the Plugin.
     */
    const MINIMUM_PHP_VERSION = '5.6';

    /**
     * Class Constructor
     */
    private function __construct() {
        $this->define_constants();

        add_action( 'plugin_loaded', [$this, 'init_plugin'] );
    }

    /**
     * Initializes a singleton instance
     *
     * @return \Oxence_Toolkit
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Define the required plugin constants
     *
     * @return void
     */
    public function define_constants() {
        define( 'OT_VERSION', self::version );
        define( 'OT_FILE', __FILE__ );
        define( 'OT_PATH', plugin_dir_path( OT_FILE ) );
        define( 'OT_URL', plugin_dir_url( OT_FILE ) );
        define( 'OT_ASSETS', untrailingslashit( OT_URL . 'assets' ) );
        define( 'OT_INCLUDES', untrailingslashit( OT_PATH . 'includes' ) );
        define( 'OT_WP_WIDGETS', untrailingslashit( OT_PATH . 'includes/wp-widgets' ) );
    }

    /**
     * Load Textdomain
     *
     * Load plugin localization files.
     *
     * Fired by `init` action hook.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function i18n() {
        load_plugin_textdomain( 'oxence-toolkit', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin() {
        if ( $this->is_compatible() ) {
            $this->include_files();
        }
    }

    /**
     * Get current theme slug
     *
     * @access public
     * @static
     */
    public static function get_theme_slug() {
        return str_replace( '-child', '', wp_get_theme()->get( 'TextDomain' ) );
    }

    /**
     * Check Compatible
     *
     * @access public
     * @static
     *
     * @return boolean
     */
    public static function theme_is_compatible() {
        $plugin_name = trim( dirname( plugin_basename( __FILE__ ) ) );
        $theme_name  = self::get_theme_slug();

        return false !== stripos( $plugin_name, $theme_name );
    }

    /**
     * Compatibility Checks
     *
     * Checks whether the site meets the addon requirement.
     *
     * @since 1.0.0
     * @access public
     */
    public function is_compatible() {
        // Check for required PHP version
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [$this, 'admin_notice_minimum_php_version'] );
            return false;
        }

        // Check For 'oxence-toolkit' Theme install or active
        if ( ! self::theme_is_compatible() ) {
            add_action( 'admin_notices', [$this, 'admin_notice_missing_main_theme'] );
            return false;
        }

        return true;
    }

    public function is_active_elementor() {
        if ( ! did_action( 'elementor/loaded' ) ) {
            return false;
        }

        return true;
    }

    /**
     * Include required plugin files
     *
     * @return void
     */
    public function include_files() {
        include_once OT_INCLUDES . '/library/codestar-framework/codestar-framework.php';
        include_once OT_INCLUDES . '/helper/functions.php';

        include_once OT_INCLUDES . '/post-type/services/class-services.php';
        include_once OT_INCLUDES . '/post-type/portfolio/class-portfolio.php';
        include_once OT_INCLUDES . '/post-type/team/class-team-member.php';

        include_once OT_INCLUDES . '/helper/theme-options.php';
        include_once OT_INCLUDES . '/helper/metaboxes.php';

        if ( $this->is_active_elementor() ) {
            include_once OT_INCLUDES . '/elementor/init.php';
            include_once OT_INCLUDES . '/template-builder/template-builder.php';
        }

        include_once OT_WP_WIDGETS . '/oxence-recent-post.php';
        include_once OT_WP_WIDGETS . '/oxence-cta.php';

        include_once OT_INCLUDES . '/demo-config/demo-config.php';
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required PHP version.
     *
     * @since 1.0.0
     * @access public
     */
    public function admin_notice_minimum_php_version() {

        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'oxence-toolkit' ),
            '<strong>' . esc_html__( 'Oxence Toolkit', 'oxence-toolkit' ) . '</strong>',
            '<strong>' . esc_html__( 'PHP', 'oxence-toolkit' ) . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have Oxence theme installed or activated.
     *
     * @since 1.0.0
     * @access public
     */
    public function admin_notice_missing_main_theme() {

        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

        $message = sprintf(
            esc_html__( '"%1$s" plugin requires Oxence theme to be installed and activated', 'oxence-toolkit' ),
            '<strong>' . esc_html__( 'Oxence Toolkit', 'oxence-toolkit' ) . '</strong>'
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }
}

/**
 * Initializes the main plugin
 *
 * @return void
 */
function oxence_toolkit_loading() {
    return Oxence_Toolkit::init();
}

// kick-off the plugin
oxence_toolkit_loading();