<?php
/**
 * Template Welcome
 *
 * Welcome Template for admin panel
 *
 * @package Oxence
 */

$allowed_html = [
    'a' => [
        'href'   => true,
        'target' => true,
    ],
];

?>

<div class="oxence-welcome-wrapper">
    <div class="oxence-welcome-title">
        <h1><?php esc_html_e( 'Welcome to', 'oxence' );?>
            <?php echo OXENCE_NAME; ?>
        </h1>
        <span class="oxence-version-theme">
            <?php esc_html_e( 'Version - ', 'oxence' );?>
            <?php echo OXENCE_VERSION; ?>
        </span>
        <span class="oxence-welcome-subtitle">
            <?php
                echo sprintf( esc_html__( '%s is already installed and ready to use! Let\'s build something impressive.', 'oxence' ), OXENCE_NAME );
            ?>
        </span>
    </div>
    <div class="oxence-welcome-step-box">
        <div class="step-box-left">
            <div class="theme-screenshot">
                <img src="<?php echo esc_url( get_template_directory_uri() . "/screenshot.png" ); ?>">
            </div>
        </div>
        <div class="step-box-right">
            <h4 class="step-subtitle">
                <?php
                    echo sprintf(
                        wp_kses( __( 'Just complete the steps below and you will be able to use all functionalities of %s theme by <a href="%s" target="_blank">WebTend</a>', 'oxence' ), $allowed_html ),
                        OXENCE_NAME,
                        esc_url( 'https://themeforest.net/user/webtend' )
                    );
                ?>
            </h4>
            <ul>
                <li>
                    <span class="step-title">
                        <?php esc_html_e( 'Step 1', 'oxence' );?>
                    </span>
                    <?php
                        echo sprintf(
                            wp_kses( __( 'Check <a href="%s">requirements</a> to avoid errors with your WordPress.', 'oxence' ), $allowed_html ),
                            esc_url( admin_url( 'admin.php?page=oxence_requirements' ) )
                        );
                    ?>
                </li>
                <li>
                    <span class="step-title">
                        <?php esc_html_e( 'Step 2', 'oxence' );?>
                    </span>
                    <?php esc_html_e( 'Install Required and recommended plugins.', 'oxence' );?>
                </li>
                <li>
                    <span class="step-title">
                        <?php esc_html_e( 'Step 3', 'oxence' );?>
                    </span>
                    <?php esc_html_e( 'Import demo content', 'oxence' );?>
                </li>
            </ul>
        </div>
    </div>
</div>