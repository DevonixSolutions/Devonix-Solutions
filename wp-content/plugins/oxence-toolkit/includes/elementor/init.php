<?php
namespace OxenceToolkit\ElementorAddon;

defined( 'ABSPATH' ) || exit;

use Elementor\Plugin;

/**
 * Oxence Elementor Addon
 */
class Oxence_Elementor_Addon {

    /**
     * The default path to elementor dir on this plugin.
     *
     * @var string
     */
    private $dir_path;

    /**
     * Instance
     *
     * @since 1.0.0
     *
     * @access private
     * @static
     */
    protected static $instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.0.0
     *
     * @access public
     * @static
     */
    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Initialize Addons
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function initialize() {
        $this->dir_path = plugin_dir_path( __FILE__ );

        add_action( 'elementor/init', [$this, 'elementor_init'] );
    }

    /**
     * Initialize Elementor Action
     *
     * Load the plugin only after Elementor are loaded.
     *
     * Fired by `plugins_loaded` action hook.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function elementor_init() {

        // Add New Elementor Categories
        add_action( 'elementor/elements/categories_registered', [$this, 'init_categories'] );

        // Register New Widgets
        add_action( 'elementor/widgets/register', [$this, 'init_widgets'] );

        // Disable Default elementor animations
        add_action('elementor/frontend/after_enqueue_scripts',function() {
            wp_deregister_style('e-animations' );
            wp_dequeue_style( 'e-animations' );
        }, 20 );

        // Include Files
        $this->include_templates();

        // Include Helper
        $this->include_files();
    }

    /**
     * Widgets Category
     *
     * @since 1.0.0
     * @access public
     */
    public function init_categories( $elements_manager ) {
        $categories = [];

        $categories['oxence_elements'] = [
            'title' => esc_html__( 'Oxence Elements', 'oxence-toolkit' ),
            'icon'  => 'fa fa-smile-o',
        ];

        $old_categories = $elements_manager->get_categories();
        $categories     = array_merge( $categories, $old_categories );

        $set_categories = function ( $categories ) {
            $this->categories = $categories;
        };

        $set_categories->call( $elements_manager, $categories );
    }

    /**
     * Init Widgets
     *
     * Include widgets files and register them
     *
     * @since 1.0.0
     * @access public
     */
    public function init_widgets() {
        $template_names       = [];
        $template_path        = '/oxence-toolkit/elementor/widgets/';
        $plugin_template_path = $this->dir_path . 'widgets/';
        $widgets_manager      = Plugin::instance()->widgets_manager;

        foreach ( glob( $plugin_template_path . '*.php' ) as $file ) {
            $template_name = basename( $file );
            array_push( $template_names, $template_name );
        }

        $files = ot_get_locate_template( $template_names, '/elementor/widgets/', $template_path );

        foreach ( (array) $files as $file ) {
            $filename = basename( str_replace( '.php', '', $file ) );
            $class    = ucwords( str_replace( '-', ' ', $filename ) );
            $class    = str_replace( ' ', '_', $class );
            $class    = sprintf( 'OxenceToolkit\ElementorAddon\Widgets\%s', $class );

            // Require Files
            require_once $file;

            // Class File
            if ( class_exists( $class ) ) {
                $widgets_manager->register( new $class );
            }
        }
    }

    /**
     * Init Widget Templates
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function include_templates() {
        $templates_path = OT_INCLUDES . '/elementor/templates/';

        foreach ( glob( $templates_path . '*.php' ) as $file_path ) {
            require_once $file_path;
        }
    }

    /**
     * Include required addon files
     *
     * @return void
     */
    public function include_files() {
        include_once OT_INCLUDES . '/elementor/helper/extenders.php';
        include_once OT_INCLUDES . '/elementor/helper/icons-manager.php';
    }
}

Oxence_Elementor_Addon::instance()->initialize();