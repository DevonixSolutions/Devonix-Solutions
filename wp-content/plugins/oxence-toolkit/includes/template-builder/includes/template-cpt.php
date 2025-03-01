<?php
namespace OxenceToolkit\TemplateBuilder;

defined( 'ABSPATH' ) || exit;

/**
 * Builder Header CPT Class
 */
class Template_CPT {
    /**
     * @var string
     *
     * Set post type params
     */
    private $type = 'oxence_template';
    private $slug = 'oxence_template';
    private $name;
    private $singular_name;
    private $plural_name;

    /**
     * Class Constructor
     */
    public function __construct() {
        $this->name          = __( 'Template Builder', 'oxence-toolkit' );
        $this->singular_name = __( 'Template', 'oxence-toolkit' );
        $this->plural_name   = __( 'Templates', 'oxence-toolkit' );

        add_action( 'init', [$this, 'register_post_type'] );
        add_filter( 'single_template', [$this, 'custom_templates'] );
    }

    /**
     * Register post type
     */
    public function register_post_type() {
        $labels = [
            'name'               => $this->name,
            'singular_name'      => $this->singular_name,
            'add_new'            => sprintf( esc_html__( 'Add New %s', 'oxence-toolkit' ), $this->singular_name ),
            'add_new_item'       => sprintf( esc_html__( 'Add New %s', 'oxence-toolkit' ), $this->singular_name ),
            'edit_item'          => sprintf( esc_html__( 'Edit %s', 'oxence-toolkit' ), $this->singular_name ),
            'new_item'           => sprintf( esc_html__( 'New %s', 'oxence-toolkit' ), $this->singular_name ),
            'all_items'          => sprintf( esc_html__( 'All %s', 'oxence-toolkit' ), $this->plural_name ),
            'view_item'          => sprintf( esc_html__( 'View %s', 'oxence-toolkit' ), $this->name ),
            'search_items'       => sprintf( esc_html__( 'Search %s', 'oxence-toolkit' ), $this->name ),
            'not_found'          => sprintf( esc_html__( 'No %s found', 'oxence-toolkit' ), strtolower( $this->name ) ),
            'not_found_in_trash' => sprintf( esc_html__( 'No %s found in Trash', 'oxence-toolkit' ), strtolower( $this->name ) ),
            'parent_item_colon'  => '',
            'menu_name'          => $this->name,
        ];

        $args = [
            'labels'              => $labels,
            'has_archive'         => false,
            'show_ui'             => true,
            'show_in_menu'        => false,
            'show_in_admin_bar'   => false,
            'show_in_nav_menu'    => true,
            'public'              => true,
            'rewrite'             => ['slug' => $this->slug],
            'show_in_rest'        => false,
            'exclude_from_search' => true,
            'capability_type'     => 'post',
            'hierarchical'        => false,
            'menu_icon'           => 'dashicons-layout',
            'supports'            => ['title', 'author', 'elementor'],
        ];

        register_post_type( $this->type, $args );
    }

    /**
     * Custom Template
     *
     * @param $single_template
     * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/single_template;
     */
    public function custom_templates( $single_template ) {
        global $post;

        if ( $post->post_type == $this->type ) {
            $meta = get_post_meta( $post->ID, 'oxence_tb_settings', true );

            if ( isset( $meta['template_type'] ) ) {
                $template_type = $meta['template_type'];
            } else {
                $template_type = '';
            }

            if ( 'popup' === $template_type ) {
                $single_template = OT_INCLUDES . '/template-builder/templates/popup.php';
            } elseif ( 'offcanvas' === $template_type ) {
                $single_template = OT_INCLUDES . '/template-builder/templates/offcanvas.php';
            } else {
                $single_template = OT_INCLUDES . '/template-builder/templates/canvas.php';
            }
        }

        return $single_template;
    }
}

new Template_CPT();