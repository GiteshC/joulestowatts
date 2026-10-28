<?php /* Template Name: Accelerator Family */ get_header(); ?>

<?php
// Links may be stored as full URLs or as paths relative to the site root (e.g. "contact-us/").
$accfam_url = static function ( $link ) {
	$link = is_array( $link ) ? ( $link['url'] ?? '' ) : (string) $link;
	if ( '' === $link ) {
		return '';
	}
	return preg_match( '#^([a-z][a-z0-9+.-]*:|/|\#)#i', $link ) ? $link : home_url( '/' . $link );
};
$accfam_arrow = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M18.7504 15.7496V5.99958C18.7504 5.80067 18.6714 5.6099 18.5307 5.46925C18.3901 5.3286 18.1993 5.24958 18.0004 5.24958H8.25042C8.0515 5.24958 7.86074 5.3286 7.72009 5.46925C7.57943 5.6099 7.50042 5.80067 7.50042 5.99958C7.50042 6.19849 7.57943 6.38926 7.72009 6.52991C7.86074 6.67057 8.0515 6.74958 8.25042 6.74958H16.1901L5.46979 17.469C5.32906 17.6097 5.25 17.8006 5.25 17.9996C5.25 18.1986 5.32906 18.3895 5.46979 18.5302C5.61052 18.6709 5.80139 18.75 6.00042 18.75C6.19944 18.75 6.39031 18.6709 6.53104 18.5302L17.2504 7.8099V15.7496C17.2504 15.9485 17.3294 16.1393 17.4701 16.2799C17.6107 16.4206 17.8015 16.4996 18.0004 16.4996C18.1993 16.4996 18.3901 16.4206 18.5307 16.2799C18.6714 16.1393 18.7504 15.9485 18.7504 15.7496Z" fill="#19060F"/></svg>';
?>

<section class="bannerInnerSection accFamBanner">
	<div class="wrapper">
		<?php if ( have_rows( 'banner_section' ) ) : ?>
			<?php while ( have_rows( 'banner_section' ) ) : the_row(); ?>
				<div class="bannerContent">
					<div class="bannerHeading">
						<h1 class="manrope"><?php echo wp_kses_post( get_sub_field( 'heading' ) ); ?></h1>
						<p><?php echo wp_kses_post( get_sub_field( 'description' ) ); ?></p>
					</div>
					<?php $bannerimage = get_sub_field( 'banner_image' ); ?>
					<?php if ( ! empty( $bannerimage ) ) : ?>
						<img src="<?php echo esc_url( $bannerimage['url'] ); ?>" loading="eager" alt="<?php echo esc_attr( $bannerimage['alt'] ); ?>" />
					<?php else : ?>
						<img src="<?php echo esc_url( get_template_directory_uri() . '/images/accelerator-family-hero.svg' ); ?>" width="1170" height="397" loading="eager" alt="" />
					<?php endif; ?>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</section>

<section class="introSection accFamIntro">
	<div class="accFamBand" aria-hidden="true"></div>
	<div class="wrapper">
		<?php if ( have_rows( 'intro_section' ) ) : ?>
			<?php while ( have_rows( 'intro_section' ) ) : the_row(); ?>
				<div class="introContent">
					<div class="secHeading">
						<h2 class="manrope"><?php echo wp_kses_post( get_sub_field( 'heading' ) ); ?></h2>
						<p><?php echo wp_kses_post( get_sub_field( 'description' ) ); ?></p>
					</div>
				</div>
				<?php if ( have_rows( 'stats' ) ) : ?>
					<div class="accFamStats">
						<?php while ( have_rows( 'stats' ) ) : the_row(); ?>
							<?php
							$stat_value = (string) get_sub_field( 'stat_value' );
							$stat_count = preg_match( '/\d[\d,]*/', $stat_value, $m ) ? str_replace( ',', '', $m[0] ) : '';
							?>
							<div class="accFamStat" data-reveal>
								<h3 class="manrope"<?php echo $stat_count ? ' data-count="' . esc_attr( $stat_count ) . '"' : ''; ?>><?php echo esc_html( $stat_value ); ?></h3>
								<p><?php echo esc_html( get_sub_field( 'stat_label' ) ); ?></p>
							</div>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</section>

<section class="accFamFamilySec">
	<div class="wrapper">
		<?php if ( have_rows( 'family_section' ) ) : ?>
			<?php while ( have_rows( 'family_section' ) ) : the_row(); ?>
				<div class="secHeading">
					<h2 class="manrope"><?php echo wp_kses_post( get_sub_field( 'heading' ) ); ?></h2>
					<p><?php echo wp_kses_post( get_sub_field( 'description' ) ); ?></p>
				</div>
				<?php if ( have_rows( 'family_cards' ) ) : ?>
					<div class="accFamGrid">
						<?php while ( have_rows( 'family_cards' ) ) : the_row(); ?>
							<?php
							$card_link = $accfam_url( get_sub_field( 'card_link' ) );
							$card_text = get_sub_field( 'card_link_text' );
							?>
							<article class="accFamCard" data-reveal>
								<?php if ( get_sub_field( 'card_tag' ) ) : ?>
									<span class="tag manrope"><?php echo esc_html( get_sub_field( 'card_tag' ) ); ?></span>
								<?php endif; ?>
								<div class="bottomContent">
									<h3 class="manrope"><?php echo esc_html( get_sub_field( 'card_heading' ) ); ?></h3>
									<p><?php echo esc_html( get_sub_field( 'card_description' ) ); ?></p>
									<?php if ( $card_link && $card_text ) : ?>
										<a href="<?php echo esc_url( $card_link ); ?>" class="cardLink"><?php echo esc_html( $card_text ); ?></a>
									<?php endif; ?>
								</div>
							</article>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</section>

<section class="talkToPartnerSec accFamPartner">
	<div class="accFamBand" aria-hidden="true"></div>
	<div class="secWrapper">
		<div class="imgBox">
			<img src="<?php bloginfo( 'template_directory' ); ?>/images/talk-to-partner-bg.webp" alt="" class="desktopBg">
			<img src="<?php bloginfo( 'template_directory' ); ?>/images/talk-to-partner-bg-mbl.webp" alt="" class="mblBg">
		</div>
		<?php if ( have_rows( 'talk_to_partner' ) ) : ?>
			<?php while ( have_rows( 'talk_to_partner' ) ) : the_row(); ?>
				<div class="secHeading">
					<h2 class="manrope"><?php echo wp_kses_post( get_sub_field( 'heading' ) ); ?></h2>
					<p><?php echo wp_kses_post( get_sub_field( 'description' ) ); ?></p>
					<?php if ( get_sub_field( 'cta_text' ) ) : ?>
						<a href="<?php echo esc_url( $accfam_url( get_sub_field( 'cta_link' ) ) ); ?>" class="primaryCTA"><span><?php echo esc_html( get_sub_field( 'cta_text' ) ); ?></span>
							<div class="arrowBox"><?php echo $accfam_arrow; // phpcs:ignore WordPress.Security.EscapeOutput -- static markup. ?></div>
						</a>
					<?php endif; ?>
					<?php if ( get_sub_field( 'secondary_link_text' ) ) : ?>
						<a href="<?php echo esc_url( $accfam_url( get_sub_field( 'secondary_link' ) ) ); ?>" class="accFamTextLink"><?php echo esc_html( get_sub_field( 'secondary_link_text' ) ); ?></a>
					<?php endif; ?>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>
