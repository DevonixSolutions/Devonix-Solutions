<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Oxence
 */

use OxenceTheme\Classes\Oxence_Helper as Helper;
use OxenceTheme\Classes\Oxence_Woocommerce;

?>
<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo( 'charset' );?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head();?>
</head>

<body <?php body_class();?>>
<?php wp_body_open();?>
<div id="page" class="site<?php if ( 'enabled' === Helper::transparent_header() ) :?> absolute-header-on<?php endif; ?>">
    <?php
        if ( 'enabled' === Helper::get_option( 'site_preloader', 'disabled' ) ) {
            get_template_part( 'template-parts/preloader' );
        }

        if (  class_exists( 'Oxence_Toolkit' ) ) {
            do_action( "oxence_builder_before_main" );
        }

        if( 'enabled' === Helper::check_default_header() ) {
            get_template_part( 'template-parts/header/header', 'default' );
        }

        if ( class_exists( 'Woocommerce' ) ) {
           Oxence_Woocommerce::mini_cart_sidebar();
        }
    ?>
    <main id="content" class="site-main">
        <?php get_template_part( 'template-parts/page-title' ); ?>