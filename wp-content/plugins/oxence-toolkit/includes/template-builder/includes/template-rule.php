<?php
namespace OxenceToolkit\TemplateBuilder;

class Template_Rule {

    /**
     * Current page type
     *
     * @var $current_page_type
     *
     * @access private
     * @static
     */
    private static $current_page_type = null;

    /**
     * Current page data
     *
     * @var $current_page_data
     *
     * @access private
     * @static
     */
    private static $current_page_data = [];

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @return \Template_Rule
     */
    public static function instance() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Checks for the display condition for the current page/
     *
     * Returns true or false depending on if the $rules match for the current page and the layout is to displayed.
     *
     * @param  int   $page_id Current Page ID.
     * @param  array $rules   Array of rules Display on | Exclude on.
     *
     * @return boolean
     */
    public function parse_exclusion_condition( $page_id, $rules ) {
        $hide = false;

        if ( is_array( $rules ) && ! empty( $rules ) ) {
            foreach ( $rules as $key => $rule ) {

                if ( strrpos( $rule['rule'], 'entire_website' ) !== false ) {
                    $rule_case = 'entire_website';
                } else {
                    $rule_case = $rule['rule'];
                }

                switch ( $rule_case ) {
                case 'entire_website':
                    $hide = true;
                    break;
                case 'all_pages':
                    if ( is_page() ) {
                        $hide = true;
                    }
                    break;
                case 'front_page':
                    if ( is_front_page() ) {
                        $hide = true;
                    }
                    break;
                case 'post_page':
                    if ( is_home() ) {
                        $hide = true;
                    }
                    break;
                case 'post_details':
                    if ( is_singular( 'post' ) ) {
                        $hide = true;
                    }
                    break;
                case 'all_archive':
                    if ( is_archive() ) {
                        $hide = true;
                    }
                    break;
                case 'date_archive':
                    if ( is_date() ) {
                        $hide = true;
                    }
                    break;
                case 'author_archive':
                    if ( is_author() ) {
                        $hide = true;
                    }
                    break;
                case 'search_page':
                    if ( is_search() ) {
                        $hide = true;
                    }
                    break;
                case '404_page':
                    if ( is_404() ) {
                        $hide = true;
                    }
                    break;
                case 'specific_pages':
                    if ( isset( $rule['page_ids'] ) && is_array( $rule['page_ids'] ) ) {
                        foreach ( $rule['page_ids'] as $local_page_id ) {
                            if ( $local_page_id == $page_id ) {
                                $hide = true;
                            }
                        };
                    }
                    break;
                case 'specific_posts':
                    if ( isset( $rule['posts_ids'] ) && is_array( $rule['posts_ids'] ) ) {
                        foreach ( $rule['posts_ids'] as $local_page_id ) {
                            if ( $local_page_id == $page_id ) {
                                $hide = true;
                            }
                        };
                    }
                    break;
                case 'shop_page':
                    if ( function_exists( 'is_shop' ) && is_shop() ) {
                        $hide = true;
                    }
                    break;
                case 'product_details':
                    if ( is_singular( 'product' ) ) {
                        $hide = true;
                    }
                    break;
                case 'specific_products':
                    if ( isset( $rule['product_ids'] ) && is_array( $rule['product_ids'] ) ) {
                        foreach ( $rule['product_ids'] as $local_product_id ) {
                            if ( $local_product_id == $page_id ) {
                                $hide = true;
                            }
                        };
                    }
                    break;
                }

                if ( $hide ) {
                    break;
                }
            }
        }

        return $hide;
    }

    /**
     * Get current page type
     *
     * @return string Page Type.
     */
    public function get_current_page_type() {
        if ( null === self::$current_page_type ) {
            $page_type  = '';
            $current_id = false;

            if ( is_front_page() ) {
                $page_type  = 'is_front_page';
                $current_id = get_the_id();
            } elseif ( is_home() ) {
                $page_type = 'is_home';
            } elseif ( is_page() ) {
                $page_type  = 'is_page';
                $current_id = get_the_id();

                if ( function_exists( 'is_shop' ) && is_shop() ) {
                    $page_type = 'is_shop_page';
                }
            } elseif ( is_archive() ) {
                $page_type = 'is_archive';
                if ( is_date() ) {
                    $page_type = 'is_date';
                } elseif ( is_author() ) {
                    $page_type = 'is_author';
                }
            } elseif ( is_search() ) {
                $page_type = 'is_search';
            } elseif ( is_404() ) {
                $page_type = 'is_404';
            } elseif ( is_singular( 'post' ) ) {
                $page_type  = 'is_single';
                $current_id = get_the_id();
            } elseif ( is_singular( 'product' ) ) {
                $page_type  = 'is_product';
                $current_id = get_the_id();
            } else {
                $current_id = get_the_id();
            }

            self::$current_page_data['page_id'] = $current_id;
            self::$current_page_type            = $page_type;
        }

        return self::$current_page_type;
    }

    /**
     * Get templates by condition
     *
     * @return object  Posts.
     */
    public function get_templates_by_condition() {
        global $wpdb;
        global $post;

        $include   = 'oxence_tb_include';
        $post_type = 'oxence_template';

        if ( is_array( self::$current_page_data ) && isset( self::$current_page_data[$post_type] ) ) {
            return self::$current_page_data[$post_type];
        }

        $current_page_type                   = $this->get_current_page_type();
        self::$current_page_data[$post_type] = [];

        $current_post_id = false;

        $query = "SELECT p.ID, p.post_title, pm.meta_value FROM {$wpdb->postmeta} as pm INNER JOIN {$wpdb->posts} as p ON pm.post_id = p.ID WHERE pm.meta_key = '{$include}' AND p.post_type = '{$post_type}' AND p.post_status = 'publish'";

        $orderby   = ' ORDER BY p.post_date DESC';
        $meta_args = "pm.meta_value LIKE '%\"entire_website\"%'";

        switch ( $current_page_type ) {
        case 'is_page':
            $current_id      = esc_sql( get_the_id() );
            $current_post_id = $current_id;
            $meta_args .= " OR pm.meta_value LIKE '%\"all_pages\"%'";
            $meta_args .= " OR pm.meta_value LIKE '%\"{$current_id}\"%'";
            break;
        case 'is_front_page':
            $current_id      = esc_sql( get_the_id() );
            $current_post_id = $current_id;
            $meta_args .= " OR pm.meta_value LIKE '%\"front_page\"%'";
            $meta_args .= " OR pm.meta_value LIKE '%\"{$current_id}\"%'";
            break;
        case 'is_home':
            $meta_args .= " OR pm.meta_value LIKE '%\"post_page\"%'";
            break;
        case 'is_archive':
        case 'is_date':
        case 'is_author':
            $meta_args .= " OR pm.meta_value LIKE '%\"all_archive\"%'";

            if ( 'is_date' == $current_page_type ) {
                $meta_args .= " OR pm.meta_value LIKE '%\"date_archive\"%'";
            } elseif ( 'is_author' == $current_page_type ) {
                $meta_args .= " OR pm.meta_value LIKE '%\"author_archive\"%'";
            }
            break;
        case 'is_search':
            $meta_args .= " OR pm.meta_value LIKE '%\"search_page\"%'";
            break;
        case 'is_404':
            $meta_args .= " OR pm.meta_value LIKE '%\"404_page\"%'";
            break;
        case 'is_single':
            $current_id      = esc_sql( get_the_id() );
            $current_post_id = $current_id;
            $meta_args .= " OR pm.meta_value LIKE '%\"post_details\"%'";
            $meta_args .= " OR pm.meta_value LIKE '%\"{$current_id}\"%'";
            break;
        case 'is_shop_page':
            $meta_args .= " OR pm.meta_value LIKE '%\"shop_page\"%'";
            break;
        case 'is_product':
            $current_id      = esc_sql( get_the_id() );
            $current_post_id = $current_id;
            $meta_args .= " OR pm.meta_value LIKE '%\"product_details\"%'";
            $meta_args .= " OR pm.meta_value LIKE '%\"{$current_id}\"%'";
            break;
        case '':
            $current_post_id = get_the_id();
            break;
        }

        // Ignore the PHPCS warning about constant declaration.
        // @codingStandardsIgnoreStart
        $templates = $wpdb->get_results( $query . ' AND (' . $meta_args . ')' . $orderby );
        // @codingStandardsIgnoreEnd

        foreach ( $templates as $local_template ) {
            $meta = get_post_meta( $local_template->ID, 'oxence_tb_settings', true );

            if ( isset( $meta['template_type'] ) ) {
                $template_type = $meta['template_type'];
            } else {
                $template_type = '';
            }

            self::$current_page_data[$post_type][$local_template->ID] = [
                'id'       => $local_template->ID,
                'type'     => $template_type,
                'location' => unserialize( $local_template->meta_value ),
            ];
        }

        $this->remove_exclusion_rule_templates( $post_type, $current_post_id );

        return self::$current_page_data[$post_type];
    }

    /**
     * Remove exclusion rule templates.
     *
     * @since  1.0.0
     * @param  string $post_type Post Type.
     * @param  array  $current_post_id Current post ID.
     */
    public function remove_exclusion_rule_templates( $post_type, $current_post_id ) {
        $exclude         = 'oxence_tb_exclude';
        $current_post_id = $current_post_id ? $current_post_id : false;

        foreach ( self::$current_page_data[$post_type] as $c_post_id => $c_data ) {

            $exclusion_rules = get_post_meta( $c_post_id, $exclude, true );
            $is_exclude      = $this->parse_exclusion_condition( $current_post_id, $exclusion_rules );

            if ( $is_exclude ) {
                unset( self::$current_page_data[$post_type][$c_post_id] );
            }
        }
    }
}

Template_Rule::instance();