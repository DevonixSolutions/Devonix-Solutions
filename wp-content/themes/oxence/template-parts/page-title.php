<?php
/**
 * Template part for displaying page Title
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Oxence
 */

use OxenceTheme\Classes\Oxence_Helper as Helper;
use OxenceTheme\Classes\Oxence_Post_Helper;

if ( is_404() ) {
    return;
}

$active_title = Helper::get_option( 'site_page_title', 'enabled' );
$breadcrumb   = Helper::get_option( 'site_breadcrumb', 'enabled' );
$title        = '';
$custom_title = '';
$title_output = [];

if ( is_page() && ! is_home() ) {
    $page_title        = Helper::get_meta( 'oxence_page_meta', 'page_title', 'default' );
    $page_breadcrumb   = Helper::get_meta( 'oxence_page_meta', 'page_breadcrumb', 'default' );
    $page_title_type   = Helper::get_meta( 'oxence_page_meta', 'page_title_type', 'default' );
    $page_custom_title = Helper::get_meta( 'oxence_page_meta', 'page_custom_title', '' );

    if ( 'default' !== $page_title ) {
        $active_title = $page_title;
    }

    if ( 'custom' === $page_title_type && ! empty( $page_custom_title ) ) {
        $custom_title = $page_custom_title;
    }

    if ( 'default' !== $page_breadcrumb ) {
        $breadcrumb = $page_breadcrumb;
    }

} elseif ( is_single() && 'post' === get_post_type() ) {
    $post_page_title   = Helper::get_meta( 'oxence_post_meta', 'post_page_title', 'default' );
    $post_breadcrumb   = Helper::get_meta( 'oxence_post_meta', 'post_breadcrumb', 'default' );
    $post_title_type   = Helper::get_meta( 'oxence_post_meta', 'post_title_type', 'default' );
    $post_custom_title = Helper::get_meta( 'oxence_post_meta', 'post_custom_title', __( 'News Details', 'oxence' ) );

    if ( 'default' !== $post_page_title ) {
        $active_title = $post_page_title;
    }

    if ( 'custom' === $post_title_type && ! empty( $post_custom_title ) ) {
        $custom_title = $post_custom_title;
    }

    if ( 'default' !== $post_breadcrumb ) {
        $breadcrumb = $post_breadcrumb;
    }
} elseif ( is_single() && 'oxence_service' === get_post_type() ) {
    $service_page_title   = Helper::get_meta( 'oxence_service_meta', 'service_page_title', 'default' );
    $service_breadcrumb   = Helper::get_meta( 'oxence_service_meta', 'service_breadcrumb', 'default' );
    $service_title_type   = Helper::get_meta( 'oxence_service_meta', 'service_page_title_type', 'default' );
    $service_custom_title = Helper::get_meta( 'oxence_service_meta', 'service_custom_title', __( 'Service Details', 'oxence' ) );

    if ( 'default' !== $service_page_title ) {
        $active_title = $service_page_title;
    }

    if ( 'custom' === $service_title_type && ! empty( $service_custom_title ) ) {
        $custom_title = $service_custom_title;
    }

    if ( 'default' !== $service_breadcrumb ) {
        $breadcrumb = $service_breadcrumb;
    }
} elseif ( is_single() && 'oxence_portfolio' === get_post_type() ) {
    $portfolio_page_title   = Helper::get_meta( 'oxence_portfolio_meta', 'portfolio_page_title', 'default' );
    $portfolio_breadcrumb   = Helper::get_meta( 'oxence_portfolio_meta', 'portfolio_breadcrumb', 'default' );
    $portfolio_title_type   = Helper::get_meta( 'oxence_portfolio_meta', 'portfolio_page_title_type', 'default' );
    $portfolio_custom_title = Helper::get_meta( 'oxence_portfolio_meta', 'portfolio_custom_title', __( 'Project Details', 'oxence' ) );

    if ( 'default' !== $portfolio_page_title ) {
        $active_title = $portfolio_page_title;
    }

    if ( 'custom' === $portfolio_title_type && ! empty( $portfolio_custom_title ) ) {
        $custom_title = $portfolio_custom_title;
    }

    if ( 'default' !== $portfolio_breadcrumb ) {
        $breadcrumb = $portfolio_breadcrumb;
    }
} elseif ( is_single() && 'oxence_team' === get_post_type() ) {
    $team_page_title   = Helper::get_meta( 'oxence_team_meta', 'team_page_title', 'default' );
    $team_breadcrumb   = Helper::get_meta( 'oxence_team_meta', 'team_breadcrumb', 'default' );
    $team_title_type   = Helper::get_meta( 'oxence_team_meta', 'team_page_title_type', 'default' );
    $team_custom_title = Helper::get_meta( 'oxence_team_meta', 'team_custom_title', __( 'Member Details', 'oxence' ) );

    if ( 'default' !== $team_page_title ) {
        $active_title = $team_page_title;
    }

    if ( 'custom' === $team_title_type && ! empty( $team_custom_title ) ) {
        $custom_title = $team_custom_title;
    }

    if ( 'default' !== $team_breadcrumb ) {
        $breadcrumb = $team_breadcrumb;
    }
} elseif ( is_single() && 'product' === get_post_type() ) {
    $product_page_title   = Helper::get_meta( 'oxence_product_meta', 'product_page_title', 'default' );
    $product_breadcrumb   = Helper::get_meta( 'oxence_product_meta', 'product_breadcrumb', 'default' );
    $product_title_type   = Helper::get_meta( 'oxence_product_meta', 'product_page_title_type', 'default' );
    $product_custom_title = Helper::get_meta( 'oxence_product_meta', 'product_custom_title', '' );

    if ( 'default' !== $product_page_title ) {
        $active_title = $product_page_title;
    }

    if ( 'custom' === $product_title_type && ! empty( $product_custom_title ) ) {
        $custom_title = $product_custom_title;
    }

    if ( 'default' !== $product_breadcrumb ) {
        $breadcrumb = $product_breadcrumb;
    }
}

if ( is_home() ) {
    $title = Helper::get_option( 'blog_archive_title', __( 'Latest News', 'oxence' ) );
} elseif ( is_search() ) {
    $title = esc_html__( 'Search Results for: ', 'oxence' ) . get_search_query();
} elseif ( is_archive() ) {
    $title = strip_tags( get_the_archive_title() );

    if (  ( class_exists( 'WooCommerce' ) && is_shop() ) ) {
        $shop_id = get_option( 'woocommerce_shop_page_id', '' );
        $title   = get_the_title( $shop_id );
    }
} elseif ( ! empty( $custom_title ) ) {
    $title = esc_html( $custom_title );
} else {
    $title = wp_kses_post( get_the_title() );
}

if ( $title ) {
    $svg_icon       = Helper::render_svg_icon( 'page-title-1' );
    $formatted      = preg_replace( '/\S+$/', '<span class="last-word">$0 <span class="svg-line-one">' . $svg_icon . '</span></span>', $title );
    $title_output[] = sprintf( '%s', $formatted );
}

if ( 'enabled' !== $active_title ) {
    return;
}

$show_post_meta = Helper::get_option( 'blog_details_meta', 'yes' );

?>

<div class="page-title-area">
    <div class="container">
        <div class="page-title-inner">
            <h1 class="page-title">
                <?php echo implode( '', $title_output ); ?>
            </h1>
            <?php if ( is_single() && 'post' === get_post_type() && 'yes' === $show_post_meta ) : ?>
            <?php Oxence_Post_Helper::render_meta(); ?>
            <?php elseif ( 'disabled' !== $breadcrumb && function_exists( 'bcn_display' ) ): ?>
                <div class="breadcrumb">
                    <?php bcn_display()?>
                </div>
            <?php endif;?>
        </div>
    </div>
    <div class="shapes">
        <span class="svg-line-two">
            <?php echo Helper::render_svg_icon( 'page-title-2' ) ?>
        </span>
        <span class="svg-line-three">
            <?php echo Helper::render_svg_icon( 'page-title-3' ) ?>
        </span>
        <span class="dots-one"></span>
        <span class="dots-two"></span>
    </div>
</div>