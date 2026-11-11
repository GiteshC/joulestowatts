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

<section class="aboutQuestionsSec" aria-labelledby="aboutQuestionsTitle">
	<div class="wrapper">
		<div class="questionsIntro">
			<h2 class="manrope" id="aboutQuestionsTitle">Every capability center starts with the same questions.</h2>
			<p>We answer them as one partner, from the first diagnosis to the team that runs your center day to day.</p>
			<a class="questionsCTA" href="#">
				<span>Explore more</span>
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
					<path d="M18.7504 15.7496V5.99958C18.7504 5.80067 18.6714 5.6099 18.5307 5.46925C18.3901 5.3286 18.1993 5.24958 18.0004 5.24958H8.25042C8.0515 5.24958 7.86074 5.3286 7.72009 5.46925C7.57943 5.6099 7.50042 5.80067 7.50042 5.99958C7.50042 6.19849 7.57943 6.38926 7.72009 6.52991C7.86074 6.67057 8.0515 6.74958 8.25042 6.74958H16.1901L5.46979 17.469C5.32906 17.6097 5.25 17.8006 5.25 17.9996C5.25 18.1986 5.32906 18.3895 5.46979 18.5302C5.61052 18.6709 5.80139 18.75 6.00042 18.75C6.19944 18.75 6.39031 18.6709 6.53104 18.5302L17.2504 7.8099V15.7496C17.2504 15.9485 17.3294 16.1393 17.4701 16.2799C17.6107 16.4206 17.8015 16.4996 18.0004 16.4996C18.1993 16.4996 18.3901 16.4206 18.5307 16.2799C18.6714 16.1393 18.7504 15.9485 18.7504 15.7496Z" fill="#fff"/>
				</svg>
			</a>
		</div>
		<ol class="questionsList">
			<li class="questionRow">
				<div class="questionHead">
					<span class="num" aria-hidden="true">01</span>
					<h3>Where should we build, and what will it cost?</h3>
				</div>
				<div class="questionBody">
					<h4>GCC Accelerator</h4>
					<p>Reads your public footprint, benchmarks peer GCCs, and models where to build and what it costs.</p>
				</div>
			</li>
			<li class="questionRow">
				<div class="questionHead">
					<span class="num" aria-hidden="true">02</span>
					<h3>How does our enterprise really work?</h3>
				</div>
				<div class="questionBody">
					<h4>Enterprise Context Architects (ECAs)</h4>
					<p>Engineers trained to read an enterprise before changing it, each accountable for a business number.</p>
				</div>
			</li>
			<li class="questionRow">
				<div class="questionHead">
					<span class="num" aria-hidden="true">03</span>
					<h3>Where will AI pay back?</h3>
				</div>
				<div class="questionBody">
					<h4>AI Atlas</h4>
					<p>Writes the AI Charter: why, where, and how AI goes, with the return at each step.</p>
				</div>
			</li>
			<li class="questionRow">
				<div class="questionHead">
					<span class="num" aria-hidden="true">04</span>
					<h3>Who will run it, day to day?</h3>
				</div>
				<div class="questionBody">
					<h4>Talent Solutions and Managed Talent Pods</h4>
					<p>The right mix of people and pods, composed for the outcome you need.</p>
				</div>
			</li>
		</ol>
	</div>
</section>

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


<section class="aboutDecadeSec" id="first-ten-years">
	<div class="wrapper">
		<div class="decadeHead">
			<h2 class="manrope">The first ten years of a billion-dollar ambition.</h2>
			<p>Keep scrolling to move through the years, or pick a year. Red marks the years that changed the company.</p>
		</div>
		<div class="yearTabs" aria-label="Pick a year">
			<button class="yearTab is-active" type="button" aria-current="true">2015</button>
			<button class="yearTab" type="button">2016</button>
			<button class="yearTab" type="button">2017</button>
			<button class="yearTab" type="button">2018</button>
			<button class="yearTab" type="button">2019</button>
			<button class="yearTab" type="button">2020</button>
			<button class="yearTab" type="button">2021</button>
			<button class="yearTab" type="button">2022</button>
			<button class="yearTab" type="button">2023</button>
			<button class="yearTab" type="button">2024</button>
			<button class="yearTab" type="button">2025</button>
			<button class="yearTab" type="button">2026</button>
		</div>
	</div>

	<!-- Outside the wrapper so the years run to the screen edge. -->
	<div class="decadeStage">
		<span class="decadeLine" aria-hidden="true"></span>
		<div class="decadeViewport" tabindex="0" role="region" aria-label="Company timeline, 2015 to 2026">
			<ol class="decadeTrack">
				<li class="decadeItem is-active">
					<figure class="decadeImg">
						<img src="<?php bloginfo('template_directory'); ?>/images/timeline-img-1.webp" alt="" loading="lazy">
					</figure>
					<span class="dot" aria-hidden="true"></span>
					<div class="decadeCard">
						<span class="year manrope">2015</span>
						<h3>A founder bets on India's GCCs</h3>
						<p>In July 2015, serial entrepreneur Priti Sawant founded JoulestoWatts in Bengaluru on one conviction: India's</p>
					</div>
				</li>
				<li class="decadeItem">
					<figure class="decadeImg"><img src="<?php bloginfo('template_directory'); ?>/images/timeline-img-2.webp" alt="" loading="lazy"></figure>
					<span class="dot" aria-hidden="true"></span>
					<div class="decadeCard">
						<span class="year manrope">2016</span>
						<h3>Backed by India's first women-focused tech fund</h3>
						<p>Saha Fund, India's first women entrepreneurship</p>
					</div>
				</li>
				<li class="decadeItem">
					<figure class="decadeImg">
						<img src="<?php bloginfo('template_directory'); ?>/images/timeline-img-3.webp" alt="" loading="lazy">
					</figure>
					<span class="dot" aria-hidden="true"></span>
					<div class="decadeCard">
						<span class="year manrope">2015</span>
						<h3>A founder bets on India's GCCs</h3>
						<p>In July 2015, serial entrepreneur Priti Sawant founded JoulestoWatts in Bengaluru on one conviction: India's</p>
					</div>
				</li>
				<li class="decadeItem">
					<figure class="decadeImg">
						<img src="<?php bloginfo('template_directory'); ?>/images/timeline-img-4.webp" alt="" loading="lazy">
					</figure>
					<span class="dot" aria-hidden="true"></span>
					<div class="decadeCard">
						<span class="year manrope">2016</span>
						<h3>Backed by India's first women-focused tech fund</h3>
						<p>Saha Fund, India's first women entrepreneurship</p>
					</div>
				</li>
				<li class="decadeItem">
					<figure class="decadeImg">
						<img src="<?php bloginfo('template_directory'); ?>/images/timeline-img-5.webp" alt="" loading="lazy">
					</figure>
					<span class="dot" aria-hidden="true"></span>
					<div class="decadeCard">
						<span class="year manrope">2015</span>
						<h3>A founder bets on India's GCCs</h3>
						<p>In July 2015, serial entrepreneur Priti Sawant founded JoulestoWatts in Bengaluru on one conviction: India's</p>
					</div>
				</li>
				<li class="decadeItem">
					<figure class="decadeImg">
						<img src="<?php bloginfo('template_directory'); ?>/images/timeline-img-6.webp" alt="" loading="lazy">
					</figure>
					<span class="dot" aria-hidden="true"></span>
					<div class="decadeCard">
						<span class="year manrope">2016</span>
						<h3>Backed by India's first women-focused tech fund</h3>
						<p>Saha Fund, India's first women entrepreneurship</p>
					</div>
				</li>
				<li class="decadeItem">
					<figure class="decadeImg">
						<img src="<?php bloginfo('template_directory'); ?>/images/timeline-img-7.webp" alt="" loading="lazy">
					</figure>
					<span class="dot" aria-hidden="true"></span>
					<div class="decadeCard">
						<span class="year manrope">2015</span>
						<h3>A founder bets on India's GCCs</h3>
						<p>In July 2015, serial entrepreneur Priti Sawant founded JoulestoWatts in Bengaluru on one conviction: India's</p>
					</div>
				</li>
				<li class="decadeItem">
					<figure class="decadeImg">
						<img src="<?php bloginfo('template_directory'); ?>/images/timeline-img-8.webp" alt="" loading="lazy">
					</figure>
					<span class="dot" aria-hidden="true"></span>
					<div class="decadeCard">
						<span class="year manrope">2016</span>
						<h3>Backed by India's first women-focused tech fund</h3>
						<p>Saha Fund, India's first women entrepreneurship</p>
					</div>
				</li>
				<li class="decadeItem">
					<figure class="decadeImg">
						<img src="<?php bloginfo('template_directory'); ?>/images/timeline-img-9.webp" alt="" loading="lazy">
					</figure>
					<span class="dot" aria-hidden="true"></span>
					<div class="decadeCard">
						<span class="year manrope">2015</span>
						<h3>A founder bets on India's GCCs</h3>
						<p>In July 2015, serial entrepreneur Priti Sawant founded JoulestoWatts in Bengaluru on one conviction: India's</p>
					</div>
				</li>
				<li class="decadeItem">
					<figure class="decadeImg">
						<img src="<?php bloginfo('template_directory'); ?>/images/timeline-img-10.webp" alt="" loading="lazy">
					</figure>
					<span class="dot" aria-hidden="true"></span>
					<div class="decadeCard">
						<span class="year manrope">2016</span>
						<h3>Backed by India's first women-focused tech fund</h3>
						<p>Saha Fund, India's first women entrepreneurship</p>
					</div>
				</li>
				<li class="decadeItem">
					<figure class="decadeImg">
						<img src="<?php bloginfo('template_directory'); ?>/images/timeline-img-11.webp" alt="" loading="lazy">
					</figure>
					<span class="dot" aria-hidden="true"></span>
					<div class="decadeCard">
						<span class="year manrope">2015</span>
						<h3>A founder bets on India's GCCs</h3>
						<p>In July 2015, serial entrepreneur Priti Sawant founded JoulestoWatts in Bengaluru on one conviction: India's</p>
					</div>
				</li>
				<li class="decadeItem">
					<figure class="decadeImg">
						<img src="<?php bloginfo('template_directory'); ?>/images/timeline-img-12.webp" alt="" loading="lazy">
					</figure>
					<span class="dot" aria-hidden="true"></span>
					<div class="decadeCard">
						<span class="year manrope">2015</span>
						<h3>A founder bets on India's GCCs</h3>
						<p>In July 2015, serial entrepreneur Priti Sawant founded JoulestoWatts in Bengaluru on one conviction: India's</p>
					</div>
				</li>
			</ol>
		</div>
	</div>
</section>

<!-- <?php if ( have_rows( 'our_story' ) ) : ?>
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
<?php endif; ?> -->

<section class="aboutAwardsSec" id="our-awards">
	<div class="wrapper">
		<div class="awardsHead">
			<h2 class="manrope">Recognized along the way</h2>
			<p>Hover to pause. Select any badge to see every recognition, year by year.</p>
		</div>

		<div class="awardsFeature">
			<div class="featureArt">
				<img src="<?php bloginfo('template_directory'); ?>/images/about-us-recognized-img.webp" alt="6X Great Place To Work" loading="lazy">
			</div>
			<div class="featureText">
				<span class="manrope eyebrow ">Flagship recognition</span>
				<h3 class="manrope">Great Place To Work, Six Times In A Row</h3>
				<p>Certified by the Great Place to Work® Institute, India, for the trust, ownership, and inclusion our people experience every day.</p>
				<a href="#" class="transparentCTA manrope">See All Awards
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17 17 7M8.5 7H17v8.5"/></svg>
				</a>
			</div>
		</div>
	</div>

	<div class="awardsMarquee">
		<div class="marqueeRow">			
			<div class="marqueeGroup leftSlider">
				<a class="awardCard" href="#">
					<span class="badgeIcon " aria-hidden="true">
						<span class="year">2017</span>
					</span>
					<span class="badgeText">
						<h4 class="manrope">Smart CEO Award</h4>
						<p>Femina, World Women Leadership Congress</p>
					</span>
				</a>
				<a class="awardCard" href="#">
					<span class="badgeIcon" aria-hidden="true"><span class="year">2019</span></span>
					<span class="badgeText">
						<h4 class="manrope">Great Place to Work</h4>
						<p>Certified six times in a row</p>
					</span>
				</a>
				<a class="awardCard" href="#">
					<span class="badgeIcon" aria-hidden="true"><span class="year">2023</span></span>
					<span class="badgeText">
						<h4 class="manrope">GE HealthCare Collaboration and Innovation Award</h4>
						<p>Runner-up, for data-driven delivery</p>
					</span>
				</a>
				<a class="awardCard" href="#">
					<span class="badgeIcon" aria-hidden="true"><span class="year">2023</span></span>
					<span class="badgeText">
						<h4 class="manrope">GE HealthCare Collaboration and Innovation Award</h4>
						<p>Runner-up, for data-driven delivery</p>
					</span>
				</a>
				<a class="awardCard" href="#">
					<span class="badgeIcon" aria-hidden="true"><span class="year">2023</span></span>
					<span class="badgeText">
						<h4 class="manrope">GE HealthCare Collaboration and Innovation Award</h4>
						<p>Runner-up, for data-driven delivery</p>
					</span>
				</a>
				<a class="awardCard" href="#">
					<span class="badgeIcon" aria-hidden="true"><span class="year">2023</span></span>
					<span class="badgeText">
						<h4 class="manrope">GE HealthCare Collaboration and Innovation Award</h4>
						<p>Runner-up, for data-driven delivery</p>
					</span>
				</a>
				<a class="awardCard" href="#">
					<span class="badgeIcon" aria-hidden="true"><span class="year">2023</span></span>
					<span class="badgeText">
						<h4 class="manrope">GE HealthCare Collaboration and Innovation Award</h4>
						<p>Runner-up, for data-driven delivery</p>
					</span>
				</a>
				<a class="awardCard" href="#">
					<span class="badgeIcon" aria-hidden="true"><span class="year">2023</span></span>
					<span class="badgeText">
						<h4 class="manrope">GE HealthCare Collaboration and Innovation Award</h4>
						<p>Runner-up, for data-driven delivery</p>
					</span>
				</a>
			</div>
		</div>
		<div class="marqueeRow">
			<div class="marqueeGroup rightSlider">
				<a class="awardCard" href="#">
					<span class="badgeIcon" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 4h8v5a4 4 0 0 1-8 0V4Z"/><path d="M8 6H5v1a3 3 0 0 0 3 3M16 6h3v1a3 3 0 0 1-3 3M12 13v4M9 20h6M10 17h4"/></svg>
					</span>
					<span class="badgeText">
						<h4 class="manrope">Women-Owned Business</h4>
						<p>Femina, World Women Leadership Congress</p>
					</span>
				</a>
				<a class="awardCard" href="#">
					<span class="badgeIcon" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 4h8v5a4 4 0 0 1-8 0V4Z"/><path d="M8 6H5v1a3 3 0 0 0 3 3M16 6h3v1a3 3 0 0 1-3 3M12 13v4M9 20h6M10 17h4"/></svg>
					</span>
					<span class="badgeText">
						<h4 class="manrope">CMMI Certified</h4>
						<p>Process Maturity</p>
					</span>
				</a>
				<a class="awardCard" href="#">
					<span class="badgeIcon" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 4h8v5a4 4 0 0 1-8 0V4Z"/><path d="M8 6H5v1a3 3 0 0 0 3 3M16 6h3v1a3 3 0 0 1-3 3M12 13v4M9 20h6M10 17h4"/></svg>
					</span>
					<span class="badgeText">
						<h4 class="manrope">CMMI Certified</h4>
						<p>Process Maturity</p>
					</span>
				</a>
				<a class="awardCard" href="#">
					<span class="badgeIcon" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 4h8v5a4 4 0 0 1-8 0V4Z"/><path d="M8 6H5v1a3 3 0 0 0 3 3M16 6h3v1a3 3 0 0 1-3 3M12 13v4M9 20h6M10 17h4"/></svg>
					</span>
					<span class="badgeText">
						<h4 class="manrope">Women-Owned Business</h4>
						<p>Femina, World Women Leadership Congress</p>
					</span>
				</a>
				<a class="awardCard" href="#">
					<span class="badgeIcon" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 4h8v5a4 4 0 0 1-8 0V4Z"/><path d="M8 6H5v1a3 3 0 0 0 3 3M16 6h3v1a3 3 0 0 1-3 3M12 13v4M9 20h6M10 17h4"/></svg>
					</span>
					<span class="badgeText">
						<h4 class="manrope">CMMI Certified</h4>
						<p>Process Maturity</p>
					</span>
				</a>
				<a class="awardCard" href="#">
					<span class="badgeIcon" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 4h8v5a4 4 0 0 1-8 0V4Z"/><path d="M8 6H5v1a3 3 0 0 0 3 3M16 6h3v1a3 3 0 0 1-3 3M12 13v4M9 20h6M10 17h4"/></svg>
					</span>
					<span class="badgeText">
						<h4 class="manrope">CMMI Certified</h4>
						<p>Process Maturity</p>
					</span>
				</a>
				<a class="awardCard" href="#">
					<span class="badgeIcon" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 4h8v5a4 4 0 0 1-8 0V4Z"/><path d="M8 6H5v1a3 3 0 0 0 3 3M16 6h3v1a3 3 0 0 1-3 3M12 13v4M9 20h6M10 17h4"/></svg>
					</span>
					<span class="badgeText">
						<h4 class="manrope">Women-Owned Business</h4>
						<p>Femina, World Women Leadership Congress</p>
					</span>
				</a>
				<a class="awardCard" href="#">
					<span class="badgeIcon" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 4h8v5a4 4 0 0 1-8 0V4Z"/><path d="M8 6H5v1a3 3 0 0 0 3 3M16 6h3v1a3 3 0 0 1-3 3M12 13v4M9 20h6M10 17h4"/></svg>
					</span>
					<span class="badgeText">
						<h4 class="manrope">CMMI Certified</h4>
						<p>Process Maturity</p>
					</span>
				</a>
				<a class="awardCard" href="#">
					<span class="badgeIcon" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 4h8v5a4 4 0 0 1-8 0V4Z"/><path d="M8 6H5v1a3 3 0 0 0 3 3M16 6h3v1a3 3 0 0 1-3 3M12 13v4M9 20h6M10 17h4"/></svg>
					</span>
					<span class="badgeText">
						<h4 class="manrope">CMMI Certified</h4>
						<p>Process Maturity</p>
					</span>
				</a>
			</div>
		</div>
	</div>

	<div class="wrapper">
		<div class="awardsMore">
			<a href="#" class="transparentCTA manrope">See Every Recognition
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17 17 7M8.5 7H17v8.5"/></svg>
			</a>
		</div>
	</div>
</section>

<section class="aboutTeamSec" id="our-team" data-team>
	<div class="wrapper">
		<h2 class="teamTitle manrope" data-team-title>Leadership</h2>
		<div class="teamTabs" role="tablist" aria-label="Team">
			<button type="button" class="teamTab is-active" role="tab" id="team-tab-1" aria-controls="team-panel-1" data-team-tab data-title="Leadership">Leadership</button>
			<button type="button" class="teamTab" role="tab" id="team-tab-2" aria-controls="team-panel-2" data-team-tab data-title="Board">Board</button>
			<button type="button" class="teamTab" role="tab" id="team-tab-3" aria-controls="team-panel-3" data-team-tab data-title="Backed By">Backed By</button>
		</div>

		<!-- Leadership -->
		<div class="teamPanel" role="tabpanel" id="team-panel-1" aria-labelledby="team-tab-1" data-team-panel>
			<div class="panelHead">
				<h3 class="manrope">Leadership</h3>
				<p>Business heads and directors who listen, scope your need and stay with the account.</p>
			</div>
			<ul class="leaderGrid">
				<li class="leaderCard">
					<figure class="leaderImg">
							<img src="<?php bloginfo('template_directory'); ?>/images/about-team-dummy.webp" alt="" loading="lazy">
					</figure>
					<div class="leaderInfo">
						<h4>Priti Sawant</h4>
						<p>Founder &amp; Chief Executive Officer</p>
					</div>
				</li>
				<li class="leaderCard">
					<figure class="leaderImg"><img src="<?php bloginfo('template_directory'); ?>/images/about-team-dummy.webp" alt="" loading="lazy"></figure>
					<div class="leaderInfo">
						<h4>Priya Mohan</h4>
						<p>Chief Operating Officer</p>
					</div>
				</li>
				<li class="leaderCard">
					<figure class="leaderImg"><img src="<?php bloginfo('template_directory'); ?>/images/about-team-dummy.webp" alt="" loading="lazy"></figure>
					<div class="leaderInfo">
						<h4>Banita Choudhary</h4>
						<p>Chief Finance Officer</p>
					</div>
				</li>
				<li class="leaderCard">
					<figure class="leaderImg"><img src="<?php bloginfo('template_directory'); ?>/images/about-team-dummy.webp" alt="" loading="lazy"></figure>
					<div class="leaderInfo">
						<h4>Deepak Desai</h4>
						<p>Chief Business Officer</p>
					</div>
				</li>
				<li class="leaderCard">
					<figure class="leaderImg"><img src="<?php bloginfo('template_directory'); ?>/images/about-team-dummy.webp" alt="" loading="lazy"></figure>
					<div class="leaderInfo">
						<h4>Ashok Datla</h4>
						<p>VP, Engineering</p>
					</div>
				</li>
				<li class="leaderCard">
					<figure class="leaderImg"><img src="<?php bloginfo('template_directory'); ?>/images/about-team-dummy.webp" alt="" loading="lazy"></figure>
					<div class="leaderInfo">
						<h4>Manish Kapoor</h4>
						<p>Head of AI</p>
					</div>
				</li>
			</ul>
		</div>

		<!-- Your first conversation -->
		<div class="teamPanel" role="tabpanel" id="team-panel-1" aria-labelledby="team-tab-1" data-team-panel>
			<div class="panelHead">
				<h3 class="manrope">Your first conversation</h3>
				<p>Business heads and directors who listen, scope your need and stay with the account.</p>
			</div>
			<ul class="leaderGrid">
				<li class="leaderCard">
					<figure class="leaderImg">
							<img src="<?php bloginfo('template_directory'); ?>/images/about-team-dummy.webp" alt="" loading="lazy">
					</figure>
					<div class="leaderInfo">
						<h4>Priti Sawant</h4>
						<p>Founder &amp; Chief Executive Officer</p>
					</div>
				</li>
				<li class="leaderCard">
					<figure class="leaderImg"><img src="<?php bloginfo('template_directory'); ?>/images/about-team-dummy.webp" alt="" loading="lazy"></figure>
					<div class="leaderInfo">
						<h4>Priya Mohan</h4>
						<p>Chief Operating Officer</p>
					</div>
				</li>
				<li class="leaderCard">
					<figure class="leaderImg"><img src="<?php bloginfo('template_directory'); ?>/images/about-team-dummy.webp" alt="" loading="lazy"></figure>
					<div class="leaderInfo">
						<h4>Banita Choudhary</h4>
						<p>Chief Finance Officer</p>
					</div>
				</li>
				<li class="leaderCard">
					<figure class="leaderImg"><img src="<?php bloginfo('template_directory'); ?>/images/about-team-dummy.webp" alt="" loading="lazy"></figure>
					<div class="leaderInfo">
						<h4>Deepak Desai</h4>
						<p>Chief Business Officer</p>
					</div>
				</li>
				<li class="leaderCard">
					<figure class="leaderImg"><img src="<?php bloginfo('template_directory'); ?>/images/about-team-dummy.webp" alt="" loading="lazy"></figure>
					<div class="leaderInfo">
						<h4>Ashok Datla</h4>
						<p>VP, Engineering</p>
					</div>
				</li>
				<li class="leaderCard">
					<figure class="leaderImg"><img src="<?php bloginfo('template_directory'); ?>/images/about-team-dummy.webp" alt="" loading="lazy"></figure>
					<div class="leaderInfo">
						<h4>Manish Kapoor</h4>
						<p>Head of AI</p>
					</div>
				</li>
			</ul>
		</div>
		<!-- Leadership -->
		<div class="teamPanel" role="tabpanel" id="team-panel-1" aria-labelledby="team-tab-1" data-team-panel>
			<div class="panelHead">
				<h3 class="manrope">Delivery</h3>
				<p>The people who run your engagement day to day.</p>
			</div>
			<ul class="leaderGrid">
				<li class="leaderCard">
					<figure class="leaderImg">
							<img src="<?php bloginfo('template_directory'); ?>/images/about-team-dummy.webp" alt="" loading="lazy">
					</figure>
					<div class="leaderInfo">
						<h4>Priti Sawant</h4>
						<p>Founder &amp; Chief Executive Officer</p>
					</div>
				</li>
				<li class="leaderCard">
					<figure class="leaderImg">
						<img src="<?php bloginfo('template_directory'); ?>/images/about-team-dummy.webp" alt="" loading="lazy">
					</figure>
					<div class="leaderInfo">
						<h4>Priya Mohan</h4>
						<p>Chief Operating Officer</p>
					</div>
				</li>
				<li class="leaderCard">
					<figure class="leaderImg">
						<img src="<?php bloginfo('template_directory'); ?>/images/about-team-dummy.webp" alt="" loading="lazy">
					</figure>
					<div class="leaderInfo">
						<h4>Banita Choudhary</h4>
						<p>Chief Finance Officer</p>
					</div>
				</li>
				<li class="leaderCard">
					<figure class="leaderImg">
						<img src="<?php bloginfo('template_directory'); ?>/images/about-team-dummy.webp" alt="" loading="lazy">
					</figure>
					<div class="leaderInfo">
						<h4>Deepak Desai</h4>
						<p>Chief Business Officer</p>
					</div>
				</li>
				<li class="leaderCard">
					<figure class="leaderImg"><img src="<?php bloginfo('template_directory'); ?>/images/about-team-dummy.webp" alt="" loading="lazy"></figure>
					<div class="leaderInfo">
						<h4>Ashok Datla</h4>
						<p>VP, Engineering</p>
					</div>
				</li>
				<li class="leaderCard">
					<figure class="leaderImg"><img src="<?php bloginfo('template_directory'); ?>/images/about-team-dummy.webp" alt="" loading="lazy"></figure>
					<div class="leaderInfo">
						<h4>Manish Kapoor</h4>
						<p>Head of AI</p>
					</div>
				</li>
			</ul>
		</div>
	</div>
</section>

<section class="boardSection">
	<div class="wrapper">
		<!-- Board: design not shared yet -->
		<div class="teamPanel" role="tabpanel" id="team-panel-2" aria-labelledby="team-tab-2" data-team-panel >
			<div class="panelTitle">
				<h2 class="manrope teamTitle">Board and investors</h2>
			</div>
			<ul class="infoGrid">
				<li class="infoCard hasAvatar">
					<div class="cardRow">
						<figure class="cardAvatar">
							<img src="<?php bloginfo('template_directory'); ?>/images/priti-sawant-profile-pic.webp" alt="" loading="lazy">
						</figure>
						<div class="cardText">
							<h4>Priti Sawant</h4>
							<p>Founder and CEO</p>
						</div>
					</div>
				</li>
				<li class="infoCard hasAvatar">
					<div class="cardRow">
						<figure class="cardAvatar">
							<img src="<?php bloginfo('template_directory'); ?>/images/priti-sawant-profile-pic.webp" alt="" loading="lazy">
						</figure>
						<div class="cardText">
							<h4>Priti Sawant</h4>
							<p>Founder and CEO</p>
						</div>
					</div>
				</li>
				<li class="infoCard hasAvatar">
					<div class="cardRow">
						<figure class="cardAvatar">
							<img src="<?php bloginfo('template_directory'); ?>/images/priti-sawant-profile-pic.webp" alt="" loading="lazy">
						</figure>
						<div class="cardText">
							<h4>Priti Sawant</h4>
							<p>Founder and CEO</p>
						</div>
					</div>
				</li>
			</ul>
			<div class="quoteRow">
				<figure class="quoteItem">
					<div class="quoteBody">
						<blockquote class="manrope">“Our 40x MOIC on JoulestoWatts is a strong validation of our early confidence in Priti and her vision, reinforcing our commitment to supporting women-led enterprises”</blockquote>
						<figcaption class="quoteBy"><strong>Ankita Vashistha</strong><span>Founder, Saha Fund</span></figcaption>
					</div>
				</figure>
				<figure class="quoteItem">
					<div class="quoteBody">
						<blockquote class="manrope">“This milestone validates our belief in JoulestoWatts' strategic growth path, its visionary leadership, and the long-term value we see in the company”</blockquote>
						<figcaption class="quoteBy"><strong>Dr. Ranjan Pai</strong><span>Chairman, MEMG</span></figcaption>
					</div>
				</figure>
			</div>
		</div>
	</div>
</section>

<section class="backedBySection">
	<div class="wrapper">
		<!-- 3. Backed By (note the isBacked class) -->
		<div class="teamPanel isBacked" role="tabpanel" id="team-panel-3" aria-labelledby="team-tab-3" data-team-panel >
			<div class="panelTitle">
				<h2 class="manrope">Backed By</h2>
			</div>
			<ul class="infoGrid">
				<li class="infoCard">
					<div class="cardText">
						<h4>Manipal Education and Medical Group (MEMG)</h4>
						<p>Long-term investor</p>
					</div>
				</li>
				<li class="infoCard">
					<div class="cardText">
						<h4>Manipal Global Education Services (MaGE)</h4>
						<p>Backer since our first year</p>
					</div>
				</li>
				<li class="infoCard">
					<div class="cardText">
						<h4>Saha Fund</h4>
						<p>Early investor, 2016 to 2025</p>
					</div>
				</li>
			</ul>
			<div class="quoteRow">
				<figure class="quoteItem">
					<div class="quoteBody">
						<blockquote class="manrope">“Our 40x MOIC on JoulestoWatts is a strong validation of our early confidence in Priti and her vision, reinforcing our commitment to supporting women-led enterprises”</blockquote>
						<figcaption class="quoteBy"><strong>Ankita Vashistha</strong><span>Founder, Saha Fund</span></figcaption>
					</div>
				</figure>
				<figure class="quoteItem">
					<div class="quoteBody">
						<blockquote class="manrope">“This milestone validates our belief in JoulestoWatts' strategic growth path, its visionary leadership, and the long-term value we see in the company”</blockquote>
						<figcaption class="quoteBy"><strong>Dr. Ranjan Pai</strong><span>Chairman, MEMG</span></figcaption>
					</div>
				</figure>
			</div>
		</div>
	</div>
</section>

<section class="aboutNewsSec" id="in-the-news">
	<div class="wrapper">
		<div class="newsHead">
			<div class="newsIntro">
				<p class="eyebrow manrope">JoulestoWatts in the news</p>
				<h2 class="manrope">What our investors say</h2>
				<p>Published coverage from 2025 and 2026. Hover to pause.</p>
			</div>
			<a class="manrope transparentCTA" href="#">See all Coverage
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17 17 7M8.5 7H17v8.5"/></svg>
			</a>
		</div>

		<!-- Featured story -->
		<a class="newsFeature" href="#">
			<div class="newsText">
				<span class="tag">GCC News • Industry</span>
				<h3>What's moving across India's capability centers</h3>
				<p class="lead">New GCCs, expansions and the numbers behind them, tracked by our team.</p>
				<span class="source">The NFA Post · 8 Oct 2025</span>
			</div>
			<figure class="newsMedia">
				<img src="<?php bloginfo('template_directory'); ?>/images/aboutus-investors-say-feature-img.webp" alt="" loading="lazy">
			</figure>
		</a>

		<!-- Story cards: outside the wrapper so the row runs edge to edge. -->
		<div class="newsMarquee">
			<div class="marqueeTrack">
				<div class="investorMarqueeGroup investorSlider">
					<a class="newsCard" href="#">
						<span class="tag">Milestone</span>
						<h4>JoulestoWatts Delivers 40× Investor Exit in Landmark Buyback, Redefines India's GCC Growth Story</h4>
						<span class="source">The NFA Post · 8 Oct 2025</span>
					</a>
					<a class="newsCard" href="#">
						<span class="tag">Feature</span>
						<h4>JoulestoWatts Delivers 40× Investor Exit in Landmark Buyback, Redefines India's GCC Growth Story</h4>
						<span class="source">The NFA Post · 8 Oct 2025</span>
					</a>
					<a class="newsCard" href="#">
						<span class="tag">Growth</span>
						<h4>JoulestoWatts Delivers 40× Investor Exit in Landmark Buyback, Redefines India's GCC Growth Story</h4>
						<span class="source">The NFA Post · 8 Oct 2025</span>
					</a>
					<a class="newsCard" href="#">
						<span class="tag">Event</span>
						<h4>JoulestoWatts Delivers 40× Investor Exit in Landmark Buyback, Redefines India's GCC Growth Story</h4>
						<span class="source">The NFA Post · 8 Oct 2025</span>
					</a>
				</div>
			</div>
		</div>
	</div>	
</section>

<section class="aboutOfficesSec" id="where-we-are">
	<div class="wrapper">
		<div class="officesHead">
			<p class="eyebrow manrope">Where we are</p>
			<h2 class="manrope">Ten offices, one India delivery hub</h2>
			<p>Headquartered in Bengaluru, with teams close to clients across Asia, the Middle East, Europe and North America.</p>
		</div>

		<div class="officesGrid">
			<div class="region">
				<p class="regionName manrope">India</p>
				<div class="office">
					<h3 class="manrope">Bengaluru - HQ</h3>
					<p>Novel MSR, Marathahalli</p>
				</div>
				<div class="office">
					<h3 class="manrope">Hyderabad</h3>
					<p>Sinman Dwaraka, HITEC City</p>
				</div>
				<div class="office">
					<h3 class="manrope">Mumbai</h3>
					<p>Eureka Towers, Mindspace, Malad West</p>
				</div>
				<div class="office">
					<h3 class="manrope">New Delhi</h3>
					<p>Saira Tower, Gulmohar Park</p>
				</div>
			</div>
			<div class="region">
				<p class="regionName manrope">North America</p>
				<div class="office">
					<h3 class="manrope">Dallas</h3>
					<p>JoulestoWatts Consulting Inc, Texas, USA</p>
				</div>
			</div>
			<div class="region">
				<p class="regionName manrope">Middle East</p>
				<div class="office">
					<h3 class="manrope">Dubai</h3>
					<p>Al Garhoud, UAE</p>
				</div>
			</div>
			<div class="region">
				<p class="regionName manrope">Southeast Asia</p>
				<div class="office">
					<h3 class="manrope">Singapore</h3>
					<p>Paya Lebar Square</p>
				</div>
				<div class="office">
					<h3 class="manrope">Penang</h3>
					<p>Perai, Malaysia</p>
				</div>
				<div class="office">
					<h3 class="manrope">Taguig</h3>
					<p>Bonifacio Global City, Philippines</p>
				</div>
			</div>
			<div class="region">
				<p class="regionName manrope">Europe</p>
				<div class="office">
					<h3 class="manrope">Warsaw</h3>
					<p>Poland</p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="talkToPartnerSec aboutTalkSec">
	<div class="secWrapper">
		<div class="imgBox">
			<!-- <img src="<?php bloginfo( 'template_directory' ); ?>/images/talk-to-partner-bg.webp" alt="" class="desktopBg">
			<img src="<?php bloginfo( 'template_directory' ); ?>/images/talk-to-partner-bg-mbl.webp" alt="" class="mblBg"> -->
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
					<a href="#" class="transparentCTA manrope">Start the GCC Accelerator readiness scan
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17 17 7M8.5 7H17v8.5"/></svg>
					</a>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>
