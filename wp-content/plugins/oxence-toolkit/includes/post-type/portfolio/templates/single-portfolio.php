<?php
/**
 * Template for Portfolio CPT single page
 *
 * @since 1.0.0
 */

use OxenceTheme\Classes\Oxence_Helper as Helper;
use OxenceToolkit\ElementorAddon\Templates\Portfolio_Template;

get_header();

$idd        = get_the_ID();
$categories = get_the_term_list( $idd, 'oxence_portfolio_category', '', ', ', '' );

$project_gallery = Helper::get_meta( 'oxence_portfolio_meta', 'project_gallery', '', $idd );

$information         = Helper::get_meta( 'oxence_portfolio_meta', 'information', [], $idd );
$information_heading = Helper::get_meta( 'oxence_portfolio_meta', 'information_heading', __( 'Project Information', 'oxence-toolkit' ), $idd );

$details_heading = Helper::get_meta( 'oxence_portfolio_meta', 'details_heading', __( 'Project Details', 'oxence-toolkit' ), $idd );

$show_related_portfolio = Helper::get_option( 'show_related_portfolio', false );
$related_title          = Helper::get_option( 'related_title', __( 'Related Portfolio', 'oxence-toolkit' ) );
$related_sub_title      = Helper::get_option( 'related_sub_title', __( 'Pre-made Template', 'oxence-toolkit' ) );

$show_nav = Helper::get_option( 'show_portfolio_nav', false );
?>

<div class="portfolio-details-wrapper">
	<div class="<?php Helper::container_class()?>">
		<?php if ( has_post_thumbnail() || $project_gallery ): ?>
		<div class="portfolio-thumbnail">
			<?php if ( $project_gallery ) :
				$gallery_ids = explode( ',', $project_gallery ); ?>
				<div class="portfolio-gallery-slider">
				<?php foreach ( $gallery_ids as $gallery_id ): ?>
					<div class="single-gallery-img">
						<?php echo wp_get_attachment_image( $gallery_id, 'oxence_1320x650', false, ['alt' => wp_kses_post( get_the_title() )] ); ?>
					</div>
					<?php endforeach; ?>
				</div>
			<?php else :
				the_post_thumbnail( 'oxence_1320x650', ['alt' => wp_kses_post( get_the_title( $idd ) )] );
			endif; ?>
		</div>
		<?php endif;?>
		<div class="portfolio-information">
			<h4 class="information-heading">
				<?php echo esc_html( $information_heading ) ?>
			</h4>
			<?php if ( $information ): ?>
			<ul class="information-list">
				<?php foreach ( $information as $info ): ?>
					<li>
						<span class="info-title">
							<?php echo esc_html( $info['info_title'] ) ?>
						</span>
						<span class="info-desc">
							<?php echo wp_kses_post( $info['info_desc'] ) ?>
						</span>
					</li>
				<?php endforeach;?>
			</ul>
			<?php endif;?>
		</div>
		<div class="portfolio-details">
			<h4 class="details-heading">
				<?php echo esc_html( $details_heading ); ?>
			</h4>
			<?php the_content();?>
		</div>
		<?php if ( $show_nav ) : ?>
		<div class="portfolio-post-nav">
			<?php
				$prev_post = get_previous_post();
				$next_post = get_next_post();

				if ( $prev_post ) : ?>
				<div class="prev-post">
					<div class="thumbnail">
						<?php echo get_the_post_thumbnail( $prev_post->ID, 'thumbnail' ) ?>
					</div>
					<div class="desc">
						<h4 class="title">
							<a href="<?php echo get_permalink( $prev_post->ID ) ?>"><?php echo esc_html( get_the_title( $prev_post->ID ) ) ?></a>
						</h4>
						<div class="categories">
							<?php
								$prev_categories = get_the_term_list( $prev_post->ID, 'oxence_portfolio_category', '', ', ', '' );
								echo $prev_categories;
							?>
						</div>
						<a href="<?php echo get_permalink( $prev_post->ID ) ?>" class="view-more">
							<?php esc_html_e( 'View Details', 'oxence-toolkit' ) ?>
							<i class="far fa-arrow-right"></i>
						</a>
					</div>
				</div>
				<?php endif;
				if ( $next_post ) : ?>
				<div class="next-post">
					<div class="thumbnail">
						<?php echo get_the_post_thumbnail( $next_post->ID, 'thumbnail' ) ?>
					</div>
					<div class="desc">
						<h4 class="title">
							<a href="<?php echo get_permalink( $next_post->ID ) ?>"><?php echo esc_html( get_the_title( $next_post->ID ) ) ?></a>
						</h4>
						<div class="categories">
							<?php
								$next_categories = get_the_term_list( $next_post->ID, 'oxence_portfolio_category', '', ', ', '' );
								echo $next_categories;
							?>
						</div>
						<a href="<?php echo get_permalink( $next_post->ID ) ?>" class="view-more">
							<?php esc_html_e( 'View Details', 'oxence-toolkit' ) ?>
							<i class="far fa-arrow-right"></i>
						</a>
					</div>
				</div>
				<?php endif;
			?>
		</div>
		<?php endif; ?>
	</div>
	<?php if ( $show_related_portfolio ) : ?>
	<div class="related-portfolio-wrapper">
		<div class="content-container full-width">
			<div class="oxence-advanced-heading">
				<div class="sub-heading">
					<span class="sub-heading-text"><?php echo esc_html( $related_sub_title ) ?></span>
				</div>
				<h3 class="main-heading"><?php echo esc_html( $related_title ) ?></h3>
			</div>
			<?php Portfolio_Template::render_related_portfolio( get_the_ID() ) ?>
		</div>
	</div>
	<?php endif; ?>
</div>

<?php
get_footer();