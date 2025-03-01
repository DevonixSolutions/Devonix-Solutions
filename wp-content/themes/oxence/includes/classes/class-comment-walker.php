<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Oxence_Comment_Walker' ) ) {
    class Oxence_Comment_Walker extends Walker_Comment {

        /**
         * Starts the element output.
         */
        public function start_el( &$output, $comment, $depth = 0, $args = [], $id = 0 ) {
            $depth++;
            $GLOBALS['comment_depth'] = $depth;
            $GLOBALS['comment']       = $comment;
            if ( ! empty( $args['callback'] ) ) {
                ob_start();
                call_user_func( $args['callback'], $comment, $args, $depth );
                $output .= ob_get_clean();
                return;
            }
            if (  ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) && $args['short_ping'] ) {
                ob_start();
                $this->ping( $comment, $depth, $args );
                $output .= ob_get_clean();
            } else {
                ob_start();
                $this->comment( $comment, $depth, $args );
                $output .= ob_get_clean();
            }
        }

        /**
         * Outputs a pingback comment.
        */
        protected function ping( $comment, $depth, $args ) { ?>
            <li <?php comment_class();?> id="li-comment-<?php comment_ID()?>">
                <div class="comment-body" id="div-comment-<?php comment_ID()?>">
                    <div class="comment-content">
                        <div class="author-info">
                            <h5 class="name"><?php printf( '%s', get_comment_author_link() )?></h5>
                            <span class="date"><?php printf( '%1$s', get_comment_date() )?></span>
                        </div>
                        <div class="comment-text">
                            <?php comment_text()?>
                        </div>
                    </div>
                </div>
        <?php }

        /**
         * Outputs a single comment.
         */
        protected function comment( $comment, $depth, $args ) {
            $max_depth_comment = $args['max_depth'] > 4 ? 4 : $args['max_depth'];

            $GLOBALS['comment'] = $comment;?>

            <li <?php comment_class();?> id="li-comment-<?php comment_ID()?>">
                <div id="comment-<?php comment_ID();?>" class="comment-body">
                    <div class="comment-avatar">
                        <?php echo get_avatar( $comment->comment_author_email, 85 ); ?>
                    </div>
                    <div class="comment-content">
                        <div class="author-info">
                            <h5 class="name"><?php printf( '%s', get_comment_author_link() )?></h5>
                            <span class="date"><?php printf( '%1$s', get_comment_date() )?></span>
                        </div>
                        <div class="comment-text">
                            <?php if ( $comment->comment_approved == '0' ): ?>
                                <p><?php esc_html_e( 'Your comment is awaiting moderation.', 'oxence' );?></p>
                            <?php endif;?>

                            <?php
                                comment_text();

                                comment_reply_link( array_merge( $args, [
                                    'depth'      => $depth,
                                    'reply_text' => esc_html__( 'Reply', 'oxence' ) . '<i class="far fa-angle-double-right"></i>',
                                    'max_depth'  => $max_depth_comment,
                                ] ) );
                            ?>
                        </div>
                    </div>
                </div>
            <?php
        }
    }
}