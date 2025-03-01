<?php
namespace OxenceToolkit\TemplateBuilder;

defined( 'ABSPATH' ) || exit;

/**
 * Template Builder
 */
class Template_Builder {

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @return \Template_Builder
     */
    public static function instance() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Constructor
     *
     * @since 1.0.0
     */
    public function __construct() {
        $this->include_builder_cpt();
    }

    public function include_builder_cpt() {
        include_once OT_INCLUDES . '/template-builder/includes/template-cpt.php';
        include_once OT_INCLUDES . '/template-builder/includes/template-metaboxes.php';
        include_once OT_INCLUDES . '/template-builder/includes/template-rule.php';
        include_once OT_INCLUDES . '/template-builder/includes/template-admin.php';
        include_once OT_INCLUDES . '/template-builder/includes/template-frontend.php';
    }
}

Template_Builder::instance();