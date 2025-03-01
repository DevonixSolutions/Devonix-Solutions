<?php
/**
 * Template Help center
 *
 * Help Center Template for admin panel
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
<div class="oxence-help-center-wrapper">
    <div class="help-center-container">
        <h1 class="help-center-title">
            <?php echo esc_html__( 'Need Help? Webtend Help Center Here', 'oxence' ); ?>
        </h1>
        <div class="help-center-content">
            <p class="help-center-subtitle">
                <?php echo wp_kses( __( 'Please read a <a target="_blank" href="https://themeforest.net/page/item_support_policy">Support Policy</a> before submitting a ticket and make sure that your question related to our product issues.', 'oxence' ), $allowed_html ); ?>
                <br/>
                <?php echo esc_html__( 'If you did not find an answer to your question, feel free to contact us.', 'oxence' ); ?>
            </p>
        </div>
        <div class="help-center-boxes">
            <div class="help-center-box">
                <div class="box-icon">
                    <i class="dashicons dashicons-admin-page"></i>
                </div>
                <div class="box-content">
                    <h3 class="box-title">
                        <?php esc_html_e( 'Documentation', 'oxence' );?>
                    </h3>
                    <p>
                        <?php esc_html_e( 'Before submitting a ticket, please read the documentation. Probably, your issue already described.', 'oxence' );?>
                    </p>
                    <a target="_blank" href="https://webtend-support.gitbook.io/docs/" class="box-btn">
                        <?php esc_html_e( 'Visit Documentation', 'oxence' );?>
                    </a>
                </div>
            </div>
            <div class="help-center-box">
                <div class="box-icon">
                    <i class="dashicons dashicons-video-alt3"></i>
                </div>
                <div class="box-content">
                    <h3 class="box-title">
                        <?php esc_html_e( 'Video Tutorials', 'oxence' );?>
                    </h3>
                    <p>
                        <?php esc_html_e( 'There you can watch tutorial for main issues. How to import demo content? etc.', 'oxence' );?>
                    </p>
                    <a target="_blank" href="https://www.youtube.com/channel/UC6OYi2U7vaoC25ZTMPMXzBw" class="box-btn">
                        <?php esc_html_e( 'Watch Tutorials', 'oxence' );?>
                    </a>
                </div>
            </div>
            <div class="help-center-box">
                <div class="box-icon">
                    <i class="dashicons dashicons-editor-help"></i>
                </div>
                <div class="box-content">
                    <h3 class="box-title">
                        <?php esc_html_e( 'Support forum', 'oxence' );?>
                    </h3>
                    <p>
                        <?php esc_html_e( 'If you did not find an answer to your question, submit a ticket with well describe your issue.', 'oxence' );?>
                    </p>
                    <a target="_blank" href="https://themeforest.net/user/webtend#contact" class="box-btn">
                        <?php esc_html_e( 'Contact Us', 'oxence' );?>
                    </a>
                </div>
            </div>
        </div>
        <div class="help-center-desc">
            <?php echo wp_kses( __( 'Do You have some other questions? Need Customization? Pre-purchase questions? Ask it <a  target="_blank"  href="mailto:12hasibur@gmail.com">there!</a>', 'oxence' ), $allowed_html ); ?>
        </div>
    </div>
</div>