<?php
/**
 * Template for Team CPT single page
 *
 * @since 1.0.0
 */

use OxenceTheme\Classes\Oxence_Helper as Helper;

get_header();

$idd = get_the_ID();

$member_title = Helper::get_meta( 'oxence_team_meta', 'member_title', __( 'Web Designer', 'oxence-toolkit' ), $idd );
$member_desc  = Helper::get_meta( 'oxence_team_meta', 'member_desc', '', $idd );

$social_section_title = Helper::get_meta( 'oxence_team_meta', 'social_section_title', __( 'Follow Me', 'oxence-toolkit' ), $idd );
$social_links         = Helper::get_meta( 'oxence_team_meta', 'social_links', [], $idd );

$skill_section_title = Helper::get_meta( 'oxence_team_meta', 'skill_section_title', __( 'Best Skill', 'oxence-toolkit' ), $idd );
$skills              = Helper::get_meta( 'oxence_team_meta', 'skills', [], $idd );

$experience_section_title = Helper::get_meta( 'oxence_team_meta', 'experience_section_title', __( 'Experience', 'oxence-toolkit' ), $idd );
$experiences              = Helper::get_meta( 'oxence_team_meta', 'experiences', [], $idd );

?>

<div class="team-details-wrapper">
	<div class="<?php Helper::container_class()?>">
		<div class="row">
			<div class="col-lg-5">
				<div class="member-photo">
					<?php the_post_thumbnail( 'full', ['alt' => wp_kses_post( get_the_title( $idd ) )] ); ?>
				</div>
			</div>
			<div class="col-lg-7">
				<div class="team-member-details">
					<div class="member-info">
						<?php
							the_title( '<h3 class="member-name">', '</h3>' );

							if ( $member_title ) {
								echo '<span class="member-title">' . esc_html( $member_title ) . '</span>';
							}

							if ( $member_desc ) {
								echo wpautop( esc_html( $member_desc ) );
							}
						?>
					</div>
					<div class="member-social-info">
						<?php
							if ( $social_section_title ) {
								echo '<h4 class="info-common-title">' . esc_html( $social_section_title ) . '</h4>';
							}
						?>

						<?php if ( $social_links ) : ?>
						<ul>
							<?php foreach( $social_links as $item ) : ?>
								<li>
									<a href="<?php echo esc_url( $item['url'] ) ?>">
										<i class="<?php echo esc_attr( $item['icon'] ) ?>"></i>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
						<?php endif; ?>
					</div>
					<div class="member-skills-wrapper">
						<?php
							if ( $skill_section_title ) {
								echo '<h4 class="info-common-title">' . esc_html( $skill_section_title ) . '</h4>';
							}
						?>
						<?php if ( $skills ) : ?>
						<div class="member-skills">
							<?php foreach ( $skills as $skill ) : ?>
							<div class="oxence-progress-bar progress-circle team-default">
								<div
									class="progress-chart"
									data-percent="80"
									<?php if ( $skill['line_color'] ) : ?>
									data-bar-color="<?php echo esc_attr( $skill['line_color'] ) ?>"
									<?php endif; ?>
									<?php if ( $skill['line_bg_color'] ) : ?>
									data-track-color="<?php echo esc_attr( $skill['line_bg_color'] ) ?>"
									<?php endif; ?>
									>
									<span class="elementor-counter-number">
										<?php echo esc_attr( $skill['percentage'] ) ?>
									</span>
								</div>
								<div class="progress-header">
									<span class="title"><?php echo esc_html( $skill['title'] ) ?></span>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
						<?php endif; ?>
					</div>
					<div class="member-experience">
						<?php
							if ( $experience_section_title ) {
								echo '<h4 class="info-common-title">' . esc_html( $experience_section_title ) . '</h4>';
							}
						?>

						<?php if ( $experiences ) : ?>
						<ul>
							<?php foreach( $experiences as $experience ) : ?>
							<li>
								<div class="icon">
									<img src="<?php echo esc_url( $experience['icon']['url'] ) ?>">
								</div>
								<div class="desc">
									<h5 class="title"><?php echo esc_html( $experience['title'] ) ?></h5>
									<span class="duration"><?php echo esc_html( $experience['duration'] ) ?></span>
									<?php echo wpautop( esc_html( $experience['desc'] ) ) ?>
								</div>
							</li>
							<?php endforeach; ?>
						</ul>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();