<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Oxence
 */

use OxenceTheme\Classes\Oxence_Helper as Helper;

get_header();

$error_title        = Helper::get_option( 'error_title', __( '404', 'oxence' ) );
$error_sub_title    = Helper::get_option( 'error_sub_title', __( 'Sorry, This page is not found.', 'oxence' ) );
$error_note         = Helper::get_option( 'error_note', __( 'The page you are looking for was moved, removed, renamed or might never existed.', 'oxence' ) );
$button_text        = Helper::get_option( 'error_button_text', __( 'Return To Home', 'oxence' ) );
?>

        <div class="error-content-area">
            <div class="error-content">
                <?php if ( $error_title ): ?>
                <h2 class="error-title"><?php echo esc_html( $error_title ) ?></h2>
                <?php endif;?>
                <?php if ( $error_sub_title ): ?>
                <p class="error-subtitle"><?php echo esc_html( $error_sub_title ) ?></p>
                <?php endif;?>
                <?php if ( $error_note ): ?>
                <p class="error-note"><?php echo wp_kses_post( $error_note ) ?></p>
                <?php endif;?>
                <a class="oxence-button hover-normal" href="<?php echo esc_url( home_url( '/' ) ) ?>">
                    <span class="button-icon icon-align-right"><i class="fas fa-angle-double-right"></i></span>
                    <span class="button-text"><?php echo esc_html( $button_text ) ?></span>
                </a>
            </div>
        </div>
    </main>
</div>
<?php
wp_footer();