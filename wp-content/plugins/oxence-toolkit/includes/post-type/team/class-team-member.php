<?php

namespace OxenceToolkit\PostType;

/**
 * Team CPT
 */
class Team_Member {

    /**
     * @var string
     *
     * Set post type params
     */
    private $type = 'oxence_team';
    private $slug;
    private $name;
    private $singular_name;
    private $plural_name;

    /**
     * Team constructor.
     *
     * When class is instantiated
     */
    public function __construct() {
        $this->name          = esc_html__( 'Team Member', 'oxence-toolkit' );
        $this->singular_name = esc_html__( 'Member', 'oxence-toolkit' );
        $this->plural_name   = esc_html__( 'Team Members', 'oxence-toolkit' );

        $opt        = get_option( 'oxence_options' );
        $this->slug = ! empty( $opt['team_slug'] ) ? strtolower( str_replace( ' ', '', $opt['team_slug'] ) ) : 'team-members';

        add_action( 'init', [$this, 'register_post_type'] );

        // Register templates
        add_filter( 'single_template', [$this, 'get_single_template'] );
        add_filter( 'archive_template', [$this, 'get_archive_template'] );

        // Change Title Placeholder
        add_filter( 'enter_title_here', [$this, 'title_placeholder'], 20, 2 );
    }

    /**
     * Register post type
     */
    public function register_post_type() {
        $labels = [
            'name'                  => $this->name,
            'singular_name'         => $this->singular_name,
            'add_new'               => sprintf( esc_html__( 'Add New %s', 'oxence-toolkit' ), $this->singular_name ),
            'add_new_item'          => sprintf( esc_html__( 'Add New %s', 'oxence-toolkit' ), $this->singular_name ),
            'edit_item'             => sprintf( esc_html__( 'Edit %s', 'oxence-toolkit' ), $this->singular_name ),
            'new_item'              => sprintf( esc_html__( 'New %s', 'oxence-toolkit' ), $this->singular_name ),
            'all_items'             => sprintf( esc_html__( 'All %s', 'oxence-toolkit' ), $this->singular_name ),
            'view_item'             => sprintf( esc_html__( 'View %s', 'oxence-toolkit' ), $this->name ),
            'search_items'          => sprintf( esc_html__( 'Search %s', 'oxence-toolkit' ), $this->name ),
            'not_found'             => sprintf( esc_html__( 'No %s found', 'oxence-toolkit' ), strtolower( $this->name ) ),
            'not_found_in_trash'    => sprintf( esc_html__( 'No %s found in Trash', 'oxence-toolkit' ), strtolower( $this->name ) ),
            'parent_item_colon'     => '',
            'menu_name'             => $this->name,
            'featured_image'        => sprintf( esc_html__( '%s Photo ', 'oxence-toolkit' ), $this->singular_name ),
            'set_featured_image'    => sprintf( esc_html__( 'Set %s Photo', 'oxence-toolkit' ), $this->singular_name ),
            'remove_featured_image' => esc_html__( 'Remove ', 'oxence-toolkit' ) . $this->singular_name . esc_html__( ' Photo', 'oxence-toolkit' ),
            'use_featured_image'    => sprintf( esc_html__( 'Use as %s Photo', 'oxence-toolkit' ), $this->singular_name ),
        ];

        $args = [
            'labels'        => $labels,
            'public'        => true,
            'show_ui'       => true,
            'show_in_menu'  => true,
            'query_var'     => true,
            'rewrite'       => ['slug' => $this->slug],
            'has_archive'   => true,
            'menu_position' => 12,
            'supports'      => [
                'title',
                'author',
                'thumbnail',
                'page-attributes',
            ],
            'menu_icon'     => 'dashicons-id-alt',
        ];

        register_post_type( $this->type, $args );
    }

    /**
     * Single Page
     *
     * @param $single_template
     * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/single_template;
     */
    public function get_single_template( $single_template ) {
        global $post;

        if ( $post->post_type == $this->type ) {
            if ( file_exists( get_template_directory() . '/single-team-member.php' ) ) {
                return $single_template;
            }

            $single_template = plugin_dir_path( dirname( __FILE__ ) ) . 'team/templates/single-team-member.php';
        }

        return $single_template;
    }

    /**
     * Archive Page
     *
     * @param $archive_template
     * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/archive_template
     */
    public function get_archive_template( $archive_template ) {
        global $post;

        if ( is_post_type_archive( $this->type ) || ( is_archive() && ! empty( $post->post_type ) && $post->post_type == 'oxence_team' ) ) {
            if ( file_exists( get_template_directory() . '/archive-team-member.php' ) ) {
                return $archive_template;
            }

            $archive_template = plugin_dir_path( dirname( __FILE__ ) ) . 'team/templates/archive-team-member.php';
        }

        return $archive_template;
    }

    /**
     *  Title Placeholder
     */
    function title_placeholder( $title, $post ) {

        if ( $post->post_type == 'oxence_team' ) {
            $my_title = esc_html__( 'Member Name', 'oxence-toolkit' );
            return $my_title;
        }

        return $title;

    }

}

new Team_Member();