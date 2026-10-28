<?php /* Template Name: About Us */ get_header(); ?>

<?php

// Image URL at a size that is still sharp on 2x screens, falling back to the original.
$about_img_url = function ( $img, $size = 'medium_large' ) {
	if ( empty( $img ) || ! is_array( $img ) ) {
		return '';
	}
	return ! empty( $img['sizes'][ $size ] ) ? $img['sizes'][ $size ] : $img['url'];
};
?>

<section class="bannerInnerSection aboutBannerSec">
	<div class="wrapper">
		<?php if ( have_rows( 'banner_section' ) ) : ?>
			<?php while ( have_rows( 'banner_section' ) ) : the_row(); ?>
				<div class="bannerContent">
					<div class="bannerHeading">
						<h4 class="manrope"><?php echo esc_html( get_sub_field( 'sub_heading' ) ); ?></h4>
						<h1 class="manrope"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h1>
						<p><?php echo esc_html( get_sub_field( 'description' ) ); ?></p>
					</div>
					<?php $bannerimage = get_sub_field( 'banner_image' ); if ( ! empty( $bannerimage ) ) : ?>
						<img src="<?php echo esc_url( $bannerimage['url'] ); ?>" width="1114" height="557" loading="eager" alt="<?php echo esc_attr( $bannerimage['alt'] ); ?>" />
					<?php endif; ?>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
	<div class="bannerBG">
		<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/about-hero-glow.webp" alt="" aria-hidden="true">
	</div>
</section>

<?php if ( have_rows( 'our_story' ) ) : ?>
	<?php while ( have_rows( 'our_story' ) ) : the_row(); ?>
		<section class="aboutStorySec" id="our-story">
			<div class="wrapper">
				<div class="secHeading">
					<h3 class="manrope"><?php echo esc_html( get_sub_field( 'sub_heading' ) ); ?></h3>
					<h2 class="manrope"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2>
				</div>
			</div>
			<?php if ( have_rows( 'timeline' ) ) : ?>
				<div class="aboutTimeline" data-about-timeline>
					<div class="aboutTimelineTrack">
						<?php while ( have_rows( 'timeline' ) ) : the_row(); ?>
							<?php
							$year   = (string) get_sub_field( 'year' );
							$target = get_sub_field( 'target' ) ? get_sub_field( 'target' ) : $year;
							$img    = get_sub_field( 'image' );
							?>
							<a class="aboutTimelineItem" href="#year-<?php echo esc_attr( sanitize_title( $target ) ); ?>" data-timeline-item>
								<span class="imgBox">
									<?php if ( ! empty( $img ) ) : ?>
										<img src="<?php echo esc_url( $about_img_url( $img ) ); ?>" loading="lazy" alt="<?php echo esc_attr( $img['alt'] ); ?>" />
									<?php endif; ?>
								</span>
								<span class="dot" aria-hidden="true"></span>
								<span class="year manrope"><?php echo esc_html( $year ); ?></span>
								<span class="caption"><?php echo esc_html( get_sub_field( 'caption' ) ); ?></span>
							</a>
						<?php endwhile; ?>
					</div>
				</div>
			<?php endif; ?>
		</section>
	<?php endwhile; ?>
<?php endif; ?>

<?php if ( have_rows( 'story_years' ) ) : ?>
	<section class="aboutYearsSec">
		<?php while ( have_rows( 'story_years' ) ) : the_row(); ?>
			<?php $year = (string) get_sub_field( 'year' ); ?>
			<article class="aboutYearRow<?php echo get_sub_field( 'glow_after' ) ? ' hasGlow' : ''; ?>" id="year-<?php echo esc_attr( sanitize_title( $year ) ); ?>" data-reveal>
				<div class="wrapper">
					<div class="yearLabel manrope"><?php echo esc_html( $year ); ?></div>
					<div class="yearContent">
						<h2 class="manrope"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2>
						<p><?php echo esc_html( get_sub_field( 'description' ) ); ?></p>
						<?php if ( have_rows( 'cards' ) ) : ?>
							<div class="aboutCards">
								<?php while ( have_rows( 'cards' ) ) : the_row(); ?>
									<div class="aboutCard<?php echo 'large' === get_sub_field( 'text_size' ) ? ' isLarge' : ''; ?>">
										<h3 class="manrope"><span><?php echo esc_html( get_sub_field( 'title' ) ); ?></span></h3>
										<?php if ( get_sub_field( 'text' ) ) : ?>
											<p><?php echo esc_html( get_sub_field( 'text' ) ); ?></p>
										<?php endif; ?>
									</div>
								<?php endwhile; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</article>
		<?php endwhile; ?>
	</section>
<?php endif; ?>

<?php if ( have_rows( 'leaders_section' ) ) : ?>
	<?php while ( have_rows( 'leaders_section' ) ) : the_row(); ?>
		<section class="aboutLeadersSec">
			<div class="wrapper">
				<div class="secHeading">
					<h2 class="manrope"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2>
				</div>
				<?php if ( have_rows( 'leaders' ) ) : ?>
					<div class="aboutLeaders">
						<?php while ( have_rows( 'leaders' ) ) : the_row(); ?>
							<div class="aboutLeaderCard" data-reveal>
								<?php $photo = get_sub_field( 'photo' ); ?>
								<div class="aboutPerson">
									<?php if ( ! empty( $photo ) ) : ?>
										<img src="<?php echo esc_url( $about_img_url( $photo, 'thumbnail' ) ); ?>" width="81" height="81" loading="lazy" alt="<?php echo esc_attr( $photo['alt'] ? $photo['alt'] : get_sub_field( 'name' ) ); ?>" />
									<?php endif; ?>
									<div class="aboutPersonText">
										<h3><?php echo esc_html( get_sub_field( 'name' ) ); ?></h3>
										<span><?php echo esc_html( get_sub_field( 'role' ) ); ?></span>
									</div>
								</div>
								<p><?php echo esc_html( get_sub_field( 'bio' ) ); ?></p>
							</div>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
			</div>
		</section>
	<?php endwhile; ?>
<?php endif; ?>

<?php if ( have_rows( 'investors_section' ) ) : ?>
	<?php while ( have_rows( 'investors_section' ) ) : the_row(); ?>
		<section class="aboutInvestorsSec">
			<div class="wrapper">
				<div class="secHeading">
					<h2 class="manrope"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2>
				</div>
				<?php if ( have_rows( 'quotes' ) ) : ?>
					<div class="aboutQuotes">
						<img class="aboutQuotesGlow" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/about-investors-glow.webp" alt="" aria-hidden="true">
						<?php while ( have_rows( 'quotes' ) ) : the_row(); ?>
							<figure class="aboutQuote" data-reveal>
								<blockquote class="manrope"><?php echo esc_html( get_sub_field( 'quote' ) ); ?></blockquote>
								<figcaption class="aboutPerson">
									<?php $photo = get_sub_field( 'photo' ); if ( ! empty( $photo ) ) : ?>
										<img src="<?php echo esc_url( $about_img_url( $photo, 'thumbnail' ) ); ?>" width="81" height="81" loading="lazy" alt="<?php echo esc_attr( $photo['alt'] ? $photo['alt'] : get_sub_field( 'name' ) ); ?>" />
									<?php endif; ?>
									<span class="aboutPersonText">
										<span class="name"><?php echo esc_html( get_sub_field( 'name' ) ); ?></span>
										<span><?php echo esc_html( get_sub_field( 'role' ) ); ?></span>
									</span>
								</figcaption>
							</figure>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
			</div>
		</section>
	<?php endwhile; ?>
<?php endif; ?>

<?php if ( have_rows( 'certifications_section' ) ) : ?>
	<?php while ( have_rows( 'certifications_section' ) ) : the_row(); ?>
		<section class="aboutCertsSec">
			<div class="wrapper">
				<div class="secHeading">
					<h2 class="manrope"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2>
				</div>
				<?php if ( have_rows( 'items' ) ) : ?>
					<ul class="aboutCerts">
						<?php while ( have_rows( 'items' ) ) : the_row(); ?>
							<li><?php echo esc_html( get_sub_field( 'label' ) ); ?></li>
						<?php endwhile; ?>
					</ul>
				<?php endif; ?>
			</div>
		</section>
	<?php endwhile; ?>
<?php endif; ?>

<section class="talkToPartnerSec aboutTalkSec">
	<div class="secWrapper">
		<div class="imgBox">
			<img src="<?php bloginfo( 'template_directory' ); ?>/images/talk-to-partner-bg.webp" alt="" class="desktopBg">
			<img src="<?php bloginfo( 'template_directory' ); ?>/images/talk-to-partner-bg-mbl.webp" alt="" class="mblBg">
		</div>
		<?php if ( have_rows( 'talk_to_partner' ) ) : ?>
			<?php while ( have_rows( 'talk_to_partner' ) ) : the_row(); ?>
				<div class="secHeading">
					<h2 class="manrope"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2>
					<p><?php echo esc_html( get_sub_field( 'description' ) ); ?></p>
					<a href="<?php echo esc_url( get_sub_field( 'cta_link' ) ); ?>" class="primaryCTA"><span><?php echo esc_html( get_sub_field( 'cta_text' ) ); ?></span>
						<div class="arrowBox">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<path d="M18.7504 15.7496V5.99958C18.7504 5.80067 18.6714 5.6099 18.5307 5.46925C18.3901 5.3286 18.1993 5.24958 18.0004 5.24958H8.25042C8.0515 5.24958 7.86074 5.3286 7.72009 5.46925C7.57943 5.6099 7.50042 5.80067 7.50042 5.99958C7.50042 6.19849 7.57943 6.38926 7.72009 6.52991C7.86074 6.67057 8.0515 6.74958 8.25042 6.74958H16.1901L5.46979 17.469C5.32906 17.6097 5.25 17.8006 5.25 17.9996C5.25 18.1986 5.32906 18.3895 5.46979 18.5302C5.61052 18.6709 5.80139 18.75 6.00042 18.75C6.19944 18.75 6.39031 18.6709 6.53104 18.5302L17.2504 7.8099V15.7496C17.2504 15.9485 17.3294 16.1393 17.4701 16.2799C17.6107 16.4206 17.8015 16.4996 18.0004 16.4996C18.1993 16.4996 18.3901 16.4206 18.5307 16.2799C18.6714 16.1393 18.7504 15.9485 18.7504 15.7496Z" fill="#19060F"/>
							</svg>
						</div>
					</a>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>
