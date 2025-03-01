<?php
/**
 * Template part for displaying Main Header
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Oxence
 */
use OxenceTheme\Classes\Oxence_Helper as Helper;

$site_logo_type  = Helper::get_option( 'site_logo_type', 'text' );
$site_text_logo  = Helper::get_option( 'site_text_logo', __( 'Oxence', 'oxence' ) );
$site_image_logo = Helper::get_option( 'site_image_logo', ['url' => OXENCE_ASSETS . '/img/logo.png'] );

$panel_logo_type  = Helper::get_option( 'panel_logo_type', 'image' );
$panel_text_logo  = Helper::get_option( 'panel_text_logo', __( 'Oxence', 'oxence' ) );
$panel_image_logo = Helper::get_option( 'panel_image_logo', ['url' => OXENCE_ASSETS . '/img/logo.png'] );

$header_button = Helper::get_option( 'header_button', 'disabled' );
$button_text    = Helper::get_option( 'button_text', __( 'Get a Free Quote', 'oxence' ) );
$button_url     = Helper::get_option( 'button_text', '#' );
$button_icon    = Helper::get_option( 'button_icon', 'fas fa-angle-double-right' );

?>
<header class="site-header default-header">
    <div class="header-container">
        <div class="header-navigation">
            <div class="oxence-site-logo">
                <a href="<?php echo esc_url( home_url() ) ?>">
                <?php if ( 'text' === $site_logo_type && ! empty ( $site_text_logo ) ) : ?>
                    <?php echo esc_html( $site_text_logo )?>
                <?php elseif ( 'image' === $site_logo_type && ! empty ( $site_image_logo['url'] ) ) : ?>
                    <img src="<?php echo esc_url( $site_image_logo['url'] ) ?>" alt="<?php echo get_bloginfo() ?>">
                <?php endif; ?>
                </a>
            </div>
            <nav class="oxence-nav-menu" data-breakpoint="<?php echo helper::get_option( 'header_breakpoint', '1024' ) ?>">
                <?php
                    $args = [
                        'container'       => 'div',
                        'container_class' => 'nav-menu-wrapper nav-right',
                        'menu_class'      => 'primary-menu',
                        'after'           => '',
                        'link_before'     => '<span class="link-text">',
                        'link_after'      => '</span>',
        				'fallback_cb'     => false,
                    ];

                    if ( has_nav_menu( 'primary_menu' ) ) {
                        $args['theme_location'] = 'primary_menu';
                    }

                    wp_nav_menu( $args );
                ?>
                <?php if ( 'enabled' === $header_button ) : ?>
                <div class="oxence-button-wrapper">
                    <a href="<?php echo esc_url( $button_url ) ?>" class="oxence-button hover-normal">
                        <?php if ( $button_icon ) : ?>
                        <span class="button-icon icon-align-right">
                            <i aria-hidden="true" class="<?php echo esc_attr( $button_icon ) ?>"></i>
                        </span>
                        <?php endif; ?>
                        <span class="button-text">
                            <?php echo esc_html( $button_text ); ?>
                        </span>
                    </a>
                </div>
                <?php endif; ?>
                <div class="navbar-toggler">
                    <span>
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </span>
                </div>
                <div class="slide-panel-wrapper">
                    <div class="slide-panel-overly"></div>
                    <div class="slide-panel-content">
                        <div class="slide-panel-close">
                            <i class="fal fa-times"></i>
                        </div>
                        <div class="slide-panel-logo">
                        <?php if ( 'text' === $panel_logo_type && ! empty( $panel_text_logo ) ) : ?>
                            <?php echo esc_html( $panel_text_logo )?>
                        <?php elseif ( 'image' === $panel_logo_type && ! empty( $panel_image_logo['url'] ) ) : ?>
                            <img src="<?php echo esc_url( $panel_image_logo['url'] ) ?>" alt="<?php echo get_bloginfo() ?>">
                        <?php endif; ?>
                        </div>
                        <?php
                            $args['container_class'] = 'slide-panel-menu';
                            wp_nav_menu( $args );
                        ?>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>