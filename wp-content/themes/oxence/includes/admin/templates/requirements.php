<?php
/**
 * Template Requirements
 *
 * Requirements Template for admin panel
 *
 * @package Oxence
 */

global $wpdb;
$php_requirements = 7.0;
$memory_limit_requirements = 134217728;
$max_upload_size = 134217728;
$max_input_vars_requirements = 3000;
$max_input_time_requirements = 600;
$max_execution_time_requirements = 600;
?>

<div class="oxence-requirements-wrapper">
    <table class="oxence-panel-table info_table widefat">
        <thead>
            <tr>
                <th colspan="4"><?php esc_html_e( 'Theme Config', 'oxence' );?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php esc_html_e( 'Theme Name', 'oxence' );?>:</td>
                <td><?php echo esc_html( wp_get_theme()->get( 'Name' ) ); ?></td>
            </tr>
            <tr>
                <td><?php esc_html_e( 'Version', 'oxence' );?>:</td>
                <td><?php echo esc_html( wp_get_theme()->get( 'Version' ) ); ?></td>
            </tr>
            <tr>
                <td><?php esc_html_e( 'Author', 'oxence' );?>:</td>
                <td><?php echo esc_html( wp_get_theme()->get( 'Author' ) ); ?></td>
            </tr>
            <tr>
                <td><?php esc_html_e( 'Author URL', 'oxence' );?>:</td>
            <td>
                <a href="<?php echo esc_url_raw( wp_get_theme()->get( 'AuthorURI' ) ) ?>" target="_blank">
                    <?php echo esc_html( wp_get_theme()->get( 'AuthorURI' ) ); ?>
                </a>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="oxence-panel-table info_table widefat">
        <thead>
            <tr>
                <th colspan="4"><?php esc_html_e( 'Server Settings', 'oxence' );?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php esc_html_e( 'PHP Version', 'oxence' );?>:</td>
                <td>
                    <?php if ( version_compare( phpversion(), $php_requirements, '<' ) ): ?>
                    <span class="message-info message-info-error">
                        <span class="dashicons dashicons-warning"></span>
                        <?php
                            echo esc_html( phpversion() );
                            esc_html_e( '- We recommend a minimum PHP version of ', 'oxence' );
                            echo esc_html( $php_requirements );
                        ?>
                    </span>
                    <?php else: ?>
                    <span class="message-info message-info-success">
                        <?php echo esc_html( phpversion() ); ?>
                    </span>
                    <?php endif;?>
                </td>
            </tr>
            <tr>
                <td><?php esc_html_e( 'PHP Post Max Size', 'oxence' );?>:</td>
                <td>
                    <span class="message-info message-info-info">
                        <span class="dashicons dashicons-warning"></span>
                        <?php
                            esc_html_e( 'You cannot upload images, themes and plugins that have a size bigger than this value: ', 'oxence' );
                            echo esc_html( size_format( $this->let_to_num(  ( ini_get( 'post_max_size' ) ) ) ) );
                        ?>
                        <br/>
                        <a target="_blank" href="http://www.wpbeginner.com/wp-tutorials/how-to-increase-the-maximum-file-upload-size-in-wordpress/">
                            <?php esc_html_e( 'To know how you to change this please check this guide', 'oxence' );?>
                        </a>
                    </span>
                </td>
            </tr>
            <tr>
                <td><?php esc_html_e( 'PHP Max Execution Time Limit', 'oxence' );?>:</td>
                <td>
                    <?php if ( $max_execution_time_requirements > ini_get( 'max_execution_time' ) ): ?>
                    <span class="message-info message-info-error">
                        <span class="dashicons dashicons-warning"></span>
                        <?php
                            echo esc_html( ini_get( 'max_execution_time' ) );
                            esc_html_e( '- We recommend setting max execution time to at least ', 'oxence' );
                            echo esc_html( $max_execution_time_requirements );
                        ?>
                        <br/>
                        <a target="_blank" href="http://www.wpbeginner.com/wp-tutorials/how-to-increase-the-maximum-file-upload-size-in-wordpress/">
                            <?php esc_html_e( 'To see how you can change this please check this guide', 'oxence' );?>
                        </a>
                    </span>
                    <?php else: ?>
                    <span class="message-info message-info-success">
                        <?php echo esc_html( ini_get( 'max_execution_time' ) ); ?>
                    </span>
                    <?php endif;?>
                </td>
            </tr>
            <tr>
				<td><?php esc_html_e( 'PHP Max Input Time', 'oxence' );?>:</td>
				<td>
                    <?php if ( $max_input_time_requirements > ini_get( 'max_input_time' ) ): ?>
                    <span class="message-info message-info-error">
                        <span class="dashicons dashicons-warning"></span>
                        <?php
                            echo esc_html( ini_get( 'max_input_time' ) );
                            esc_html_e( '- We recommend setting max execution time to at least ', 'oxence' );
                            echo esc_html( $max_input_time_requirements );
                        ?>
                        <br/>
                        <a target="_blank" href="http://www.wpbeginner.com/wp-tutorials/how-to-increase-the-maximum-file-upload-size-in-wordpress/">
                            <?php esc_html_e( 'To see how you can change this please check this guide', 'oxence' );?>
                        </a>
                    </span>
                    <?php else: ?>
                    <span class="message-info message-info-success">
                        <?php echo esc_html( ini_get( 'max_input_time' ) ); ?>
                    </span>
                    <?php endif;?>
                </td>
            </tr>
			<tr>
				<td><?php esc_html_e( 'PHP Max Input Vars', 'oxence' );?>:</td>
				<td>
                    <?php if ( $max_input_vars_requirements > ini_get( 'max_input_vars' ) ): ?>
                    <span class="message-info message-info-error">
                        <span class="dashicons dashicons-warning"></span>
                        <?php
                                echo esc_html( ini_get( 'max_input_vars' ) );
                                esc_html_e( '- We recommend setting max execution time to at least ', 'oxence' );
                                echo esc_html( $max_input_vars_requirements );
                                ?>
                        <br/>
                        <a target="_blank" href="https://betterstudio.com/blog/increase-max-input-vars-limit/">
                            <?php esc_html_e( 'To see how you can change this please check this guide', 'oxence' );?>
                        </a>
                    </span>
                    <?php else: ?>
                    <span class="message-info message-info-success">
                        <?php echo esc_html( ini_get( 'max_input_vars' ) ); ?>
                    </span>
                    <?php endif;?>
                </td>
            </tr>
			<tr>
				<td><?php esc_html_e( 'MySql Version', 'oxence' );?>:</td>
				<td><?php echo ( ! empty( $wpdb->is_mysql ) ? $wpdb->db_version() : '' ); ?></td>
            </tr>
			<tr>
				<td><?php esc_html_e( 'Max upload size', 'oxence' );?>:</td>
				<td>
					<?php if ( $max_upload_size > wp_max_upload_size() ): ?>
                    <span class="message-info message-info-error">
                        <span class="dashicons dashicons-warning"></span>
                            <?php
                                echo esc_html( size_format( wp_max_upload_size() ) );
                                esc_html_e( '- We recommend minimum value: 128 MB.', 'oxence' );
                            ?>
                        <br/>
                        <a target="_blank" href="http://www.wpbeginner.com/wp-tutorials/how-to-increase-the-maximum-file-upload-size-in-wordpress/">
                            <?php esc_html_e( 'To see how you can change this please check this guide', 'oxence' );?>
                        </a>
                    </span>
                    <?php else: ?>
                    <span class="message-info message-info-success">
                        <?php echo esc_html( size_format( wp_max_upload_size() ) ); ?>
                    </span>
                    <?php endif;?>
				</td>
            </tr>
			<tr>
				<td><?php esc_html_e( 'SimpleXML', 'oxence' );?>:</td>
				<td>
					<?php if ( ! extension_loaded( 'simplexml' ) ): ?>
                    <span class="message-info message-info-error">
                        <?php esc_html_e( 'To ensure successful installation of demo content The SimpleXML extension should be installed on your web server. Please contact your hosting provider to install and activate SimpleXML extension.', 'oxence' ) ?>
                    </span>
					<?php else: ?>
                    <span class="message-info message-info-success">
                        <?php echo esc_html__( 'Enabled', 'oxence' ); ?>
                    </span>
					<?php endif;?>
				</td>
            </tr>
        </tbody>
    </table>

	<table class="oxence-panel-table info_table widefat">
        <thead>
            <tr>
                <th colspan="4"><?php esc_html_e( 'WordPress Settings', 'oxence' );?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php esc_html_e( 'Home URL', 'oxence' );?>:</td>
				<td><?php echo esc_html( home_url( '/' ) ); ?></td>
            </tr>
			<tr>
				<td><?php esc_html_e( 'Site Url', 'oxence' );?>:</td>
				<td><?php echo esc_html( home_url( '/' ) ); ?></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Version', 'oxence' );?>:</td>
				<td><?php echo esc_html( get_bloginfo( 'version' ) ); ?></td>
			</tr>
			<tr>
				<td><?php esc_html_e( 'Memory Limit', 'oxence' );?>:</td>
				<td>
					<?php if ( $memory_limit_requirements > $this->memory_limit() ): ?>
                    <span class="message-info message-info-error">
                        <span class="dashicons dashicons-warning"></span>
                        <?php
                            echo esc_html( size_format( $this->memory_limit() ) );
                            esc_html_e( '- .We recommend setting memory to be at least 128MB', 'oxence' );
                        ?>
                        <br/>
                        <a target="_blank" href="http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP">
                            <?php esc_html_e( 'To see how you can change this please check this guide', 'oxence' );?>
                        </a>
                    </span>
                    <?php else: ?>
                    <span class="message-info message-info-success">
                        <?php echo esc_html( size_format( $this->memory_limit() ) ); ?>
                    </span>
                    <?php endif;?>
				</td>
			</tr>
            <tr>
		    	<td>
		    		<?php echo esc_html( 'WP_DEBUG' );?>
		    	</td>

		    	<td>
		    		<?php if ( defined( 'WP_DEBUG' ) and WP_DEBUG === true ): ?>
                    <?php echo esc_html__( 'WP_DEBUG is enabled.', 'oxence' ); ?>
                    <a target="_blank" href="https://wordpress.org/support/article/debugging-in-wordpress/">
                        <?php echo esc_html__( ' How to disable WP_DEBUG mode.', 'oxence' ); ?>
                    </a>
		    		<?php else: ?>
                    <?php echo esc_html__( 'WP_DEBUG is disabled.', 'oxence' ); ?>
		    		<?php endif;?>
		    	</td>
		    </tr>
        </tbody>
    </table>
</div>