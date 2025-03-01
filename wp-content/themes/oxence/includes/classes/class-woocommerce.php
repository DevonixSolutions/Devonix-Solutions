<?php

namespace OxenceTheme\Classes;

defined( 'ABSPATH' ) || exit;

/**
 * Initial setup for this theme
 */
class Oxence_Woocommerce {
    protected static $instance = null;

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function initialize() {
        $related_product = Oxence_Helper::get_option( 'enable_related_product', true );

        add_action( 'after_setup_theme', [$this, 'setup'] );
        add_filter( 'body_class', [$this, 'body_class'] );
        add_filter( 'woocommerce_show_page_title', [$this, 'hide_page_title'] );

        $this->product_loop_hooks();
        $this->product_details_hooks();

        if ( ! $related_product ) {
            remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
        }

        add_filter( 'woocommerce_add_to_cart_fragments', [$this, 'mini_cart_item_fragment'] );

    }

    /**
     * WooCommerce setup.
     *
     * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
     * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
     * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
     *
     * @return void
     */
    public function setup() {
        add_theme_support( 'woocommerce' );
        // add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-slider' );
    }

    /**
     * Add 'woocommerce-active' class to the body tag.
     *
     * @param  array $classes CSS classes applied to the body tag.
     * @return array $classes modified to include 'woocommerce-active' class.
     */
    public function body_class( $classes ) {
        $classes[] = 'woocommerce-active';

        return $classes;
    }

    /**
     * Removes the "shop" title on the main shop page
     *
     * @return false
     */
    public function hide_page_title() {
        return false;
    }

    /**
     * All Product Loop hooks
     *
     * @return void
     */
    public function product_loop_hooks() {
        remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
        remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

        remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
        remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
        remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
        remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

        add_filter( 'loop_shop_columns', [$this, 'loop_columns'], 999 );
        add_filter( 'loop_shop_per_page', [$this, 'product_per_page'], 30 );

        add_action( 'woocommerce_before_shop_loop', [$this, 'loop_top_markup'], 2 );
        add_filter( 'woocommerce_after_shop_loop_item', [$this, 'product_loop'] );

        add_filter( 'subcategory_archive_thumbnail_size', function ( $size ) {
            $size['width']  = 410;
            $size['height'] = 270;
            $size['crop']   = 1;
            return $size;
        } );

        add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function ( $size ) {
            $size['width']  = 150;
            $size['height'] = 150;
            $size['crop']   = 1;
            return $size;
        } );

        add_filter( 'woocommerce_pagination_args', [$this, 'pagination_args'], 10, 1 );
    }

    /**
     * Product Details Hooks
     *
     * @return void
     */
    public function product_details_hooks() {
        add_action( 'woocommerce_before_single_product_summary', [$this, 'single_summer_start'], 0 );
        add_action( 'woocommerce_after_single_product_summary', [$this, 'single_summer_end'], 5 );

        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

        add_action( 'woocommerce_single_product_summary', [$this, 'single_product_price'], 10 );
        add_action( 'woocommerce_single_product_summary', [$this, 'single_product_rating'], 15 );
        add_action( 'woocommerce_single_product_summary', [$this, 'single_product_meta'], 20 );
        add_action( 'woocommerce_single_product_summary', [$this, 'single_product_sharing'], 20 );

        add_filter( 'woocommerce_output_related_products_args', [$this, 'related_products_args'], 20 );
    }

    /**
     * Change number or products per row to 3
     */
    public function loop_columns() {
        $product_row_columns = Oxence_Helper::get_option( 'product_loop_columns', 3 );

        return $product_row_columns;
    }

    /**
     * Product Per Page
     *
     * @return void
     */
    function product_per_page() {
        $product_per_page = Oxence_Helper::get_option( 'product_loop_per_page', 9 );

        return $product_per_page;
    }

    /**
     * Loop Top Markup
     *
     * @return void
     */
    public function loop_top_markup() {
        ?>
         <div class="woocommerce-loop-top">
            <div class="woocommerce-result">
                <?php woocommerce_result_count();?>
            </div>
            <div class="woocommerce-ordering">
                <?php woocommerce_catalog_ordering();?>
            </div>
        </div>
        <?php
    }

    /**
     * Html Markup For Product Loop
     */
    public function product_loop() {
        ?>
        <div class="woocommerce-product-inner">
            <?php woocommerce_show_product_sale_flash();?>
            <div class="product-thumbnail">
                <?php woocommerce_template_loop_product_thumbnail();?>
            </div>
            <div class="product-content">
                <h4 class="product-title">
                    <a href="<?php the_permalink();?>" ><?php the_title();?></a>
                </h4>
                <div class="product-cat-rating">
                    <div class="categories">
                        <?php echo wc_get_product_category_list( get_the_ID(), ', ', __( 'In ', 'oxence' ) ) ?>
                    </div>
                    <?php woocommerce_template_loop_rating();?>
                </div>
                <div class="product-price-button">
                    <?php woocommerce_template_loop_price();?>
                    <div class="cart-button">
                        <?php woocommerce_template_loop_add_to_cart();?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Pagination Args
     */
    public function pagination_args( $array ) {
        $html_prev          = '<i class="fas fa-angle-left"></i>';
        $html_next          = '<i class="fas fa-angle-right"></i>';
        $array['end_size']  = 1;
        $array['mid_size']  = 1;
        $array['prev_text'] = $html_prev;
        $array['next_text'] = $html_next;
        $array['type']      = 'plain';
        return $array;
    }

    /**
     * Summary Wrapper
     */
    public function single_summer_start() {
        echo '<div class="woocommerce-summary-wrap">';
    }

    public function single_summer_end() {
        echo '</div>';
    }

    public function single_product_price() {
        woocommerce_template_single_price();
    }

    public function single_product_rating() {
        global $product;
        woocommerce_template_single_rating();
    }

    public function single_product_meta() {
        woocommerce_template_single_meta();
    }

    public function single_product_sharing() {
        woocommerce_template_single_sharing();
    }

    /**
     * Related Product Args
     * @return void
     */
    public function related_products_args( $args ) {
        $post_col      = Oxence_Helper::get_option( 'related_product_columns', 3 );
        $post_per_page = Oxence_Helper::get_option( 'related_product_per_page', 3 );

        $args['posts_per_page'] = $post_per_page;
        $args['columns']        = $post_col;
        return $args;
    }

    public function mini_cart_item_fragment( $fragments ) {
        global $woocommerce;
        ob_start();
        ?>
        <div class="widget_shopping_cart">
            <div class="widget_shopping_title">
                <?php echo esc_html__( 'Shopping Cart', 'oxence' ); ?> <span class="widget_cart_counter">(<?php echo sprintf( _n( '%d item', '%d items', WC()->cart->cart_contents_count, 'oxence' ), WC()->cart->cart_contents_count ); ?>)</span>
            </div>
            <div class="widget_shopping_cart_content">
                <?php $cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0; ?>
                <ul class="cart_list product_list_widget">

                    <?php if ( !WC()->cart->is_empty() ) :
                        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                            $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

                                $product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
                                $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                                $product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                            ?>
                            <li>
                                <?php if ( !empty( $thumbnail ) ): ?>
                                    <div class="cart-product-image">
                                        <a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>">
                                            <?php echo str_replace( [ 'http:', 'https:' ], '', $thumbnail ); ?>
                                        </a>
                                    </div>
                                <?php endif;?>
                                <div class="cart-product-meta">
                                    <h3><a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>"><?php echo esc_html( $product_name ); ?></a></h3>
                                    <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
                                    <?php
                                        echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                                            '<a href="%s" class="remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><i class="fal fa-times-circle"></i></a>',
                                            esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                            esc_attr__( 'Remove this item', 'oxence' ),
                                            esc_attr( $product_id ),
                                            esc_attr( $cart_item_key ),
                                            esc_attr( $_product->get_sku() )
                                        ), $cart_item_key );
                                    ?>
                                </div>
                            </li>
                            <?php
                            }
                        }
                    ?>

                    <?php else: ?>

                        <li class="empty">
                            <span><?php esc_html_e( 'Your cart is empty', 'oxence' );?></span>
                            <a class="cart-btn" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><?php echo esc_html__( 'Browse Shop', 'oxence' ); ?></a>
                        </li>

                    <?php endif;?>

                </ul><!-- end product list -->
            </div>
            <?php if ( !WC()->cart->is_empty() ): ?>
                <div class="widget_shopping_cart_footer">
                    <p class="total"><strong><?php esc_html_e( 'Subtotal', 'oxence' );?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

                    <?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' );?>

                    <p class="buttons">
                        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="cart-btn wc-forward"><?php esc_html_e( 'View Cart', 'oxence' );?></a>
                        <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="cart-btn checkout wc-forward"><?php esc_html_e( 'Checkout', 'oxence' );?></a>
                    </p>
                </div>
            <?php endif;?>
        </div>
        <?php
    $fragments['div.widget_shopping_cart'] = ob_get_clean();
        return $fragments;
    }

    public static function mini_cart_sidebar() {
        $cart_sidebar = Oxence_Helper::get_option( 'cart_sidebar', 'enabled' );
        if ('disabled' !== $cart_sidebar ) :
        ?>
        <div class="widget-cart-wrap">
            <div class="widget-cart-sidebar">
                <div class="cart-close"><i class="far fa-times"></i></div>
                <div class="widget_shopping_cart">
                    <div class="widget_shopping_cart_content">
                        <?php woocommerce_mini_cart() ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        endif;
    }
}

/**
 * Run Class
 */
Oxence_Woocommerce::instance()->initialize();