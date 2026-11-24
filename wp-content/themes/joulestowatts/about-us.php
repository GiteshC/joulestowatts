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
</section>

<section class="aboutQuestionsSec homeImpactSec" aria-labelledby="aboutQuestionsTitle">
	<div class="homeImpactGlow" aria-hidden="true">
        <img src="<?php echo get_template_directory_uri(); ?>/images/home-glow.webp" alt="" />
        <img src="<?php echo get_template_directory_uri(); ?>/images/home-glow.webp" alt="" />
    </div>
	<div class="aboutQuestionBg" aria-hidden="true">
		<img src="<?php echo esc_url( get_template_directory_uri() . '/images/common-light-bottom.webp' ); ?>" alt="" loading="lazy" class="lines">
	</div>
	<?php if( have_rows('capability_section') ): ?>
		<?php while( have_rows('capability_section') ): the_row(); ?>
			<div class="wrapper">
				<div class="questionsIntro">
					<h2 class="manrope" id="aboutQuestionsTitle"><?php echo get_sub_field('heading'); ?></h2>
					<p><?php echo get_sub_field('description'); ?></p>
					<a href="<?php echo get_sub_field('cta_link'); ?>" class="transparentCTA manrope"><?php echo get_sub_field('cta_text'); ?>
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17 17 7M8.5 7H17v8.5"/></svg>
					</a>
				</div>
				<ol class="questionsList">
					<?php if( have_rows('capability_content') ): ?>
						<?php $counter=1; while( have_rows('capability_content') ): the_row(); ?>
							<li class="questionRow">
								<div class="questionHead">
									<span class="num" aria-hidden="true"><?php echo sprintf('%02d', $counter); ?></span>
									<h3><?php echo get_sub_field('question'); ?></h3>
								</div>
								<div class="questionBody">
									<h4><?php echo get_sub_field('answer_heading'); ?></h4>
									<p><?php echo get_sub_field('answer_description'); ?></p>
								</div>
							</li>
						<?php $counter++; endwhile; ?>
					<?php endif; ?>
				</ol>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
</section>

<section class="aboutLeadersSec" id="leaders">
	<?php if( have_rows('leadersmain_section') ): ?>
		<?php while( have_rows('leadersmain_section') ): the_row(); ?>
			<div class="wrapper">
				<h2 class="manrope"><?php echo get_sub_field('section_heading'); ?></h2>
				<div class="leadersGrid">
					<?php if( have_rows('leaders_content') ): ?>
						<?php $counter=1; while( have_rows('leaders_content') ): the_row(); ?>
							<div class="leaderCard" id="leaderCard<?php echo $counter; ?>">
								<div class="leaderPerson">
									<?php $leaderimage = get_sub_field('leader_image'); if( !empty( $leaderimage ) ): ?>
										<img src="<?php echo esc_url($leaderimage['url']); ?>" loading="lazy" alt="<?php echo esc_attr($leaderimage['alt']); ?>" />
									<?php endif; ?>
									<div>
										<p class="name"><?php echo get_sub_field('leaders_name'); ?></p>
										<p class="role"><?php echo get_sub_field('leaders_designation'); ?></p>
									</div>
								</div>
								<div class="leaderBody">
									<div class="leaderText">
										<p class="eyebrow manrope"><?php echo get_sub_field('sub_heading'); ?></p>
										<h3><?php echo get_sub_field('heading'); ?></h3>
										<p><?php echo get_sub_field('card_description'); ?></p>
										<!-- <?php $content = wp_strip_all_tags(get_sub_field('description')); echo '<p class="">' . substr($content, 0, 250) . '...</p>'; ?> -->
									</div>
									<button class="transparentCTA manrope" type="button" data-letter="cooLetter" aria-haspopup="dialog" aria-controls="cooLetter" aria-expanded="false"><?php echo get_sub_field('cta_text'); ?>
										<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17 17 7M8.5 7H17v8.5"/></svg>
									</button>
								</div>
							</div>
						<?php $counter++; endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
</section>

<!-- Drawers: one per letter. The JS moves them to the end of body. -->
<?php if( have_rows('leadersmain_section') ): ?>
<?php while( have_rows('leadersmain_section') ): the_row(); ?>
<?php if( have_rows('leaders_content') ): ?>
	<?php $counter=1; while( have_rows('leaders_content') ): the_row(); ?>
		<aside class="aboutLetterDrawer" id="founder<?php echo $counter; ?>" role="dialog" aria-modal="true" aria-label="Why JoulestoWatts exists, and where it goes next">
			<div class="drawerOverlay"></div>
			<div class="drawerPanel">
				<button class="drawerClose" type="button" aria-label="Close letter">
					<svg viewBox="0 0 35 34" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" aria-hidden="true"><path d="M7 6.5 28 27.5M28 6.5 7 27.5"/></svg>
				</button>
				<div class="drawerScroll">
					<div class="drawerHead">
						<p class="eyebrow manrope"><?php echo get_sub_field('sub_heading'); ?></p>
						<h3 class="manrope"><?php echo get_sub_field('heading'); ?></h3>
					</div>
					<div class="drawerAuthor">
						<?php $leaderimage = get_sub_field('leader_image'); if( !empty( $leaderimage ) ): ?>
							<img src="<?php echo esc_url($leaderimage['url']); ?>" loading="lazy" alt="<?php echo esc_attr($leaderimage['alt']); ?>" />
						<?php endif; ?>
						<div>
							<p class="name"><?php echo get_sub_field('leaders_name'); ?></p>
							<p class="role"><?php echo get_sub_field('leaders_designation'); ?></p>
						</div>
					</div>
					<p class="drawerMeta">12 Dec 2026 • 8 min Read</p>
					<div class="drawerBody">
						<div class="innerBody">
							<p><?php echo get_sub_field('description'); ?></p>
						</div>				
					</div>
				</div>
			</div>
		</aside>
	<?php $counter++; endwhile; ?>
<?php endif; ?>
<?php endwhile; ?>
<?php endif; ?>

<section class="aboutDecadeSec homeImpactSec" id="first-ten-years">
	<div class="homeImpactGlow" aria-hidden="true">
        <img src="<?php echo get_template_directory_uri(); ?>/images/home-glow.webp" alt="" />
        <img src="<?php echo get_template_directory_uri(); ?>/images/home-glow.webp" alt="" />
    </div>
	<?php if( have_rows('our_story') ): ?>
		<?php while( have_rows('our_story') ): the_row(); ?>
			<div class="wrapper">
				<div class="decadeHead">
					<h2 class="manrope"><?php echo get_sub_field('sub_heading'); ?></h2>
					<p><?php echo get_sub_field('heading'); ?></p>
				</div>
				<div class="yearTabs" aria-label="Pick a year">
					<?php if( have_rows('timeline') ): ?>
						<?php $counter=1; while( have_rows('timeline') ): the_row(); ?>
							<button class="yearTab <?php if($counter==1) { echo 'is-active'; } ?>" type="button" aria-current="true"><?php echo get_sub_field('year'); ?></button>
						<?php $counter++; endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="decadeStage">
				<span class="decadeLine" aria-hidden="true"></span>
				<div class="decadeViewport" tabindex="0" role="region" aria-label="Company timeline, 2015 to 2026">
					<ol class="decadeTrack">
						<?php if( have_rows('timeline') ): ?>
							<?php $counter=1; while( have_rows('timeline') ): the_row(); ?>
								<li class="decadeItem <?php if($counter==1) { echo 'is-active'; } ?>">
									<figure class="decadeImg">
										<?php $tlimage = get_sub_field('image'); if( !empty( $tlimage ) ): ?>
											<img src="<?php echo esc_url($tlimage['url']); ?>" loading="lazy" alt="<?php echo esc_attr($tlimage['alt']); ?>" />
										<?php endif; ?>
									</figure>
									<span class="dot" aria-hidden="true"></span>
									<div class="decadeCard">
										<span class="year manrope"><?php echo get_sub_field('year'); ?></span>
										<h3><?php echo get_sub_field('caption'); ?></h3>
										<p><?php echo get_sub_field('description'); ?></p>
									</div>
								</li>
							<?php $counter++; endwhile; ?>
						<?php endif; ?>
					</ol>
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
</section>

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
				<div class="awardCard">
					<span class="badgeIcon " aria-hidden="true">
						<span class="year">2017</span>
					</span>
					<span class="badgeText">
						<h4 class="manrope">Smart CEO Award</h4>
						<p>Femina, World Women Leadership Congress</p>
					</span>
				</div>
				<div class="awardCard">
					<span class="badgeIcon" aria-hidden="true"><span class="year">2019</span></span>
					<span class="badgeText">
						<h4 class="manrope">Great Place to Work</h4>
						<p>Certified six times in a row</p>
					</span>
				</div>
				<div class="awardCard">
					<span class="badgeIcon" aria-hidden="true"><span class="year">2023</span></span>
					<span class="badgeText">
						<h4 class="manrope">GE HealthCare Collaboration and Innovation Award</h4>
						<p>Runner-up, for data-driven delivery</p>
					</span>
				</div>
				<div class="awardCard">
					<span class="badgeIcon" aria-hidden="true"><span class="year">2023</span></span>
					<span class="badgeText">
						<h4 class="manrope">GE HealthCare Collaboration and Innovation Award</h4>
						<p>Runner-up, for data-driven delivery</p>
					</span>
				</div>
				<div class="awardCard">
					<span class="badgeIcon" aria-hidden="true"><span class="year">2023</span></span>
					<span class="badgeText">
						<h4 class="manrope">GE HealthCare Collaboration and Innovation Award</h4>
						<p>Runner-up, for data-driven delivery</p>
					</span>
				</div>
				<div class="awardCard">
					<span class="badgeIcon" aria-hidden="true"><span class="year">2023</span></span>
					<span class="badgeText">
						<h4 class="manrope">GE HealthCare Collaboration and Innovation Award</h4>
						<p>Runner-up, for data-driven delivery</p>
					</span>
				</div>
				<div class="awardCard">
					<span class="badgeIcon" aria-hidden="true"><span class="year">2023</span></span>
					<span class="badgeText">
						<h4 class="manrope">GE HealthCare Collaboration and Innovation Award</h4>
						<p>Runner-up, for data-driven delivery</p>
					</span>
				</div>
				<div class="awardCard">
					<span class="badgeIcon" aria-hidden="true"><span class="year">2023</span></span>
					<span class="badgeText">
						<h4 class="manrope">GE HealthCare Collaboration and Innovation Award</h4>
						<p>Runner-up, for data-driven delivery</p>
					</span>
				</div>
			</div>
		</div>
		<div class="marqueeRow">
			<div class="marqueeGroup rightSlider">
				<a class="awardCard">
					<span class="badgeIcon" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 4h8v5a4 4 0 0 1-8 0V4Z"/><path d="M8 6H5v1a3 3 0 0 0 3 3M16 6h3v1a3 3 0 0 1-3 3M12 13v4M9 20h6M10 17h4"/></svg>
					</span>
					<span class="badgeText">
						<h4 class="manrope">Women-Owned Business</h4>
						<p>Femina, World Women Leadership Congress</p>
					</span>
				</a>
				<a class="awardCard">
					<span class="badgeIcon" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 4h8v5a4 4 0 0 1-8 0V4Z"/><path d="M8 6H5v1a3 3 0 0 0 3 3M16 6h3v1a3 3 0 0 1-3 3M12 13v4M9 20h6M10 17h4"/></svg>
					</span>
					<span class="badgeText">
						<h4 class="manrope">CMMI Certified</h4>
						<p>Process Maturity</p>
					</span>
				</a>
				<a class="awardCard">
					<span class="badgeIcon" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 4h8v5a4 4 0 0 1-8 0V4Z"/><path d="M8 6H5v1a3 3 0 0 0 3 3M16 6h3v1a3 3 0 0 1-3 3M12 13v4M9 20h6M10 17h4"/></svg>
					</span>
					<span class="badgeText">
						<h4 class="manrope">CMMI Certified</h4>
						<p>Process Maturity</p>
					</span>
				</a>
				<a class="awardCard">
					<span class="badgeIcon" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 4h8v5a4 4 0 0 1-8 0V4Z"/><path d="M8 6H5v1a3 3 0 0 0 3 3M16 6h3v1a3 3 0 0 1-3 3M12 13v4M9 20h6M10 17h4"/></svg>
					</span>
					<span class="badgeText">
						<h4 class="manrope">Women-Owned Business</h4>
						<p>Femina, World Women Leadership Congress</p>
					</span>
				</a>
				<a class="awardCard">
					<span class="badgeIcon" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 4h8v5a4 4 0 0 1-8 0V4Z"/><path d="M8 6H5v1a3 3 0 0 0 3 3M16 6h3v1a3 3 0 0 1-3 3M12 13v4M9 20h6M10 17h4"/></svg>
					</span>
					<span class="badgeText">
						<h4 class="manrope">CMMI Certified</h4>
						<p>Process Maturity</p>
					</span>
				</a>
				<a class="awardCard">
					<span class="badgeIcon" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 4h8v5a4 4 0 0 1-8 0V4Z"/><path d="M8 6H5v1a3 3 0 0 0 3 3M16 6h3v1a3 3 0 0 1-3 3M12 13v4M9 20h6M10 17h4"/></svg>
					</span>
					<span class="badgeText">
						<h4 class="manrope">CMMI Certified</h4>
						<p>Process Maturity</p>
					</span>
				</a>
				<a class="awardCard">
					<span class="badgeIcon" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 4h8v5a4 4 0 0 1-8 0V4Z"/><path d="M8 6H5v1a3 3 0 0 0 3 3M16 6h3v1a3 3 0 0 1-3 3M12 13v4M9 20h6M10 17h4"/></svg>
					</span>
					<span class="badgeText">
						<h4 class="manrope">Women-Owned Business</h4>
						<p>Femina, World Women Leadership Congress</p>
					</span>
				</a>
				<a class="awardCard">
					<span class="badgeIcon" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 4h8v5a4 4 0 0 1-8 0V4Z"/><path d="M8 6H5v1a3 3 0 0 0 3 3M16 6h3v1a3 3 0 0 1-3 3M12 13v4M9 20h6M10 17h4"/></svg>
					</span>
					<span class="badgeText">
						<h4 class="manrope">CMMI Certified</h4>
						<p>Process Maturity</p>
					</span>
				</a>
				<a class="awardCard">
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
	<?php if( have_rows('leaders_section') ): ?>
		<?php while( have_rows('leaders_section') ): the_row(); ?>
			<div class="wrapper">
				<h2 class="teamTitle manrope" data-team-title><?php echo get_sub_field('heading'); ?></h2>
				<div class="teamTabs" role="tablist" aria-label="Team">
					<button type="button" class="teamTab is-active" role="tab" id="team-tab-1" aria-controls="team-panel-1" data-team-tab data-title="Leadership">Leadership</button>
					<button type="button" class="teamTab" role="tab" id="team-tab-2" aria-controls="team-panel-2" data-team-tab data-title="Board">Board</button>
					<button type="button" class="teamTab" role="tab" id="team-tab-3" aria-controls="team-panel-3" data-team-tab data-title="Backed By">Backed By</button>
				</div>

				<!-- Leadership -->
				 <?php if( have_rows('leaders_content_box') ): ?>
					<?php while( have_rows('leaders_content_box') ): the_row(); ?>
						<div class="teamPanel" role="tabpanel" aria-labelledby="team-tab-1" data-team-panel>
							<div class="panelHead">
								<h3 class="manrope"><?php echo get_sub_field('heading'); ?></h3>
								<p><?php echo get_sub_field('description'); ?></p>
							</div>
							<ul class="leaderGrid">
								<?php if( have_rows('leaders') ): ?>
									<?php while( have_rows('leaders') ): the_row(); ?>
										<li class="leaderCard" data-profile-open="<?php $str = get_sub_field('name'); echo str_replace(' ', '-', strtolower($str));?>">
											<figure class="leaderImg">
												<?php $leaderimage = get_sub_field('photo'); if( !empty( $leaderimage ) ): ?>
													<img src="<?php echo esc_url($leaderimage['url']); ?>" loading="lazy" alt="<?php echo esc_attr($leaderimage['alt']); ?>" />
												<?php endif; ?>
											</figure>
											<div class="leaderInfo">
												<h4><?php echo get_sub_field('name'); ?></h4>
												<p><?php echo get_sub_field('role'); ?></p>
											</div>
										</li>
									<?php endwhile; ?>
								<?php endif; ?>
							</ul>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
</section>

<section class="boardSection">
	<?php if( have_rows('investors_section') ): ?>
		<?php while( have_rows('investors_section') ): the_row(); ?>
			<div class="wrapper">
				<!-- Board: design not shared yet -->
				<div class="teamPanel" role="tabpanel" id="team-panel-2" aria-labelledby="team-tab-2" data-team-panel >
					<div class="panelTitle">
						<h2 class="manrope teamTitle"><?php echo get_sub_field('heading'); ?></h2>
					</div>
					<ul class="infoGrid">
						<?php if( have_rows('investors_box') ): ?>
							<?php while( have_rows('investors_box') ): the_row(); ?>
								<li class="infoCard hasAvatar">
									<div class="cardRow">
										<figure class="cardAvatar">
											<?php $avimage = get_sub_field('photo'); if( !empty( $avimage ) ): ?>
												<img src="<?php echo esc_url($avimage['url']); ?>" loading="lazy" alt="<?php echo esc_attr($avimage['alt']); ?>" />
											<?php endif; ?>
										</figure>
										<div class="cardText">
											<h4><?php echo get_sub_field('name'); ?></h4>
											<p><?php echo get_sub_field('role'); ?></p>
										</div>
									</div>
								</li>
							<?php endwhile; ?>
						<?php endif; ?>
					</ul>
					<div class="quoteRow">
						<?php if( have_rows('quotes') ): ?>
							<?php while( have_rows('quotes') ): the_row(); ?>
								<figure class="quoteItem">
									<div class="quoteBody">
										<blockquote class="manrope"><?php echo get_sub_field('quote'); ?></blockquote>
										<figcaption class="quoteBy"><strong><?php echo get_sub_field('name'); ?></strong><span><?php echo get_sub_field('role'); ?></span></figcaption>
									</div>
								</figure>
							<?php endwhile; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
</section>

<section class="backedBySection homeImpactSec">
	<div class="homeImpactGlow" aria-hidden="true">
        <img src="<?php echo get_template_directory_uri(); ?>/images/home-glow.webp" alt="" />
        <img src="<?php echo get_template_directory_uri(); ?>/images/home-glow.webp" alt="" />
    </div>
	<?php if( have_rows('backed_section') ): ?>
		<?php while( have_rows('backed_section') ): the_row(); ?>
			<div class="wrapper">
				<!-- 3. Backed By (note the isBacked class) -->
				<div class="teamPanel isBacked" role="tabpanel" id="team-panel-3" aria-labelledby="team-tab-3" data-team-panel >
					<div class="panelTitle">
						<h2 class="manrope teamTitle"><?php echo get_sub_field('heading'); ?></h2>
					</div>
					<ul class="infoGrid">
						<?php if( have_rows('backed_box') ): ?>
							<?php while( have_rows('backed_box') ): the_row(); ?>
								<li class="infoCard">
									<div class="cardText">
										<h4><?php echo get_sub_field('heading'); ?></h4>
										<p><?php echo get_sub_field('description'); ?></p>
									</div>
								</li>
							<?php endwhile; ?>
						<?php endif; ?>
					</ul>
					<div class="quoteRow">
						<?php if( have_rows('quotes') ): ?>
							<?php while( have_rows('quotes') ): the_row(); ?>
								<figure class="quoteItem">
									<div class="quoteBody">
										<blockquote class="manrope"><?php echo get_sub_field('quote'); ?></blockquote>
										<figcaption class="quoteBy"><strong><?php echo get_sub_field('name'); ?></strong><span><?php echo get_sub_field('role'); ?></span></figcaption>
									</div>
								</figure>
							<?php endwhile; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
</section>

<section class="aboutNewsSec" id="in-the-news">
	<?php if( have_rows('news_section') ): ?>
		<?php while( have_rows('news_section') ): the_row(); ?>
			<div class="wrapper">
				<div class="newsHead">
					<div class="newsIntro">
						<p class="eyebrow manrope"><?php echo get_sub_field('sub_heading'); ?></p>
						<h2 class="manrope"><?php echo get_sub_field('heading'); ?></h2>
						<p><?php echo get_sub_field('description'); ?></p>
					</div>
					<a class="manrope transparentCTA" href="<?php echo get_sub_field('cta_link'); ?>"><?php echo get_sub_field('cta_text'); ?>
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17 17 7M8.5 7H17v8.5"/></svg>
					</a>
				</div>
				<?php if( have_rows('feature_news') ): ?>
					<?php while( have_rows('feature_news') ): the_row(); ?>
						<!-- Featured story -->
						<a class="newsFeature" href="<?php echo get_sub_field('news_link'); ?>">
							<div class="newsText">
								<span class="tag"><?php echo get_sub_field('sub_heading'); ?></span>
								<h3><?php echo get_sub_field('heading'); ?></h3>
								<p class="lead"><?php echo get_sub_field('description'); ?></p>
								<span class="source"><?php echo get_sub_field('date_box'); ?></span>
							</div>
							<figure class="newsMedia">
								<?php $newsimage = get_sub_field('news_image'); if( !empty( $newsimage ) ): ?>
									<img src="<?php echo esc_url($newsimage['url']); ?>" loading="lazy" alt="<?php echo esc_attr($newsimage['alt']); ?>" />
								<?php endif; ?>
							</figure>
						</a>
					<?php endwhile; ?>
				<?php endif; ?>

				<!-- Story cards: outside the wrapper so the row runs edge to edge. -->
				<div class="newsMarquee">
					<div class="marqueeTrack">
						<div class="investorMarqueeGroup investorSlider">
							<?php if( have_rows('news_content') ): ?>
								<?php while( have_rows('news_content') ): the_row(); ?>
									<a class="newsCard" href="<?php echo get_sub_field('news_link'); ?>">
										<span class="tag"><?php echo get_sub_field('news_tag'); ?></span>
										<h4><?php echo get_sub_field('heading'); ?></h4>
										<span class="source"><?php echo get_sub_field('date'); ?></span>
									</a>
								<?php endwhile; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
</section>

<section class="aboutOfficesSec homeImpactSec" id="where-we-are">
	<div class="homeImpactGlow" aria-hidden="true">
        <img src="<?php echo get_template_directory_uri(); ?>/images/home-glow.webp" alt="" />
        <img src="<?php echo get_template_directory_uri(); ?>/images/home-glow.webp" alt="" />
    </div>
	<?php if( have_rows('where_we_are') ): ?>
		<?php while( have_rows('where_we_are') ): the_row(); ?>
			<div class="wrapper">
				<div class="officesHead">
					<p class="eyebrow manrope"><?php echo get_sub_field('sub_heading'); ?></p>
					<h2 class="manrope"><?php echo get_sub_field('heading'); ?></h2>
					<p><?php echo get_sub_field('description'); ?></p>
				</div>
				<div class="officesGrid">
					<?php if( have_rows('country_box') ): ?>
						<?php while( have_rows('country_box') ): the_row(); ?>
							<div class="region">
								<p class="regionName manrope"><?php echo get_sub_field('country_name'); ?></p>
								<?php if( have_rows('locations') ): ?>
									<?php while( have_rows('locations') ): the_row(); ?>
										<div class="office">
											<h3 class="manrope"><?php echo get_sub_field('location_name'); ?></h3>
											<p><?php echo get_sub_field('location_address'); ?></p>
										</div>
									<?php endwhile; ?>
								<?php endif; ?>
							</div>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
</section>

<section class="talkToPartnerSec">
	<div class="secWrapper">
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
					<a href="<?php echo get_sub_field('second_cta_link'); ?>" class="transparentCTA manrope">
						<span><?php echo get_sub_field('second_cta_text' ); ?></span>
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17 17 7M8.5 7H17v8.5"/></svg>
					</a>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</section>

<div class="profileDrawer" data-profile-drawer role="dialog" aria-modal="true" aria-label="Profile" aria-hidden="true" >
	<div class="pdOverlay"></div>
	<aside class="pdPanel">
		<button class="pdClose" type="button" aria-label="Close profile">
			<svg viewBox="0 0 35 34" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" aria-hidden="true"><path d="M7 6.5 28 27.5M28 6.5 7 27.5"/></svg>
		</button>
		<div class="pdScroll">
			<div class="pdHead">
				<p class="pdCount manrope" data-pd-count>01/01</p>
				<div class="pdPerson">
					<img src="" alt="" width="145" height="145" data-pd-img>
					<div class="pdId">
						<h3 class="pdName manrope" data-pd-name>Priya Mohan</h3>
						<p class="pdRole" data-pd-role>Chief Operating Officer</p>
					</div>
				</div>
			</div>
			<p class="pdCategory" data-pd-category>Leadership</p>
			<div class="pdBio" >
				<div class="innerBio" data-pd-bio>
					<p>An operator, investor and entrepreneur with 20+ years across venture capital, high-growth startups and investment banking. Priya was most recently a Partner at General Catalyst India and earlier Managing Partner at Venture Highway.</p>
					<p>She co-founded the EdTech platform Vidyartha, which was acquired by Byju's. A Chartered Accountant and ISB graduate, she is a Kamalnayan Bajaj Aspen Fellow.</p>
				</div>
			</div>
		</div>
		<nav class="pdNav" aria-label="Profiles">
			<button class="pdNavBtn is-prev" type="button" data-pd-prev>
				<span class="pdNavLabel manrope">Previous</span>
				<span class="pdNavName" data-pd-nav-name>Priti Sawant</span>
			</button>
			<button class="pdNavBtn is-next" type="button" data-pd-next>
				<span class="pdNavLabel manrope">Next</span>
				<span class="pdNavName" data-pd-nav-name>Banita Chaudhary</span>
			</button>
		</nav>
	</aside>
</div>

<div hidden>
	<?php if( have_rows('leaders_section') ): ?>
		<?php while( have_rows('leaders_section') ): the_row(); ?>
			<?php if( have_rows('leaders_content_box') ): ?>
				<?php while( have_rows('leaders_content_box') ): the_row(); ?>
					<?php if( have_rows('leaders') ): ?>
						<?php while( have_rows('leaders') ): the_row(); ?>
							<article data-profile-item data-profile-id="<?php $str = get_sub_field('name'); echo str_replace(' ', '-', strtolower($str));?>">
								<?php $leaderimage = get_sub_field('photo'); if( !empty( $leaderimage ) ): ?>
									<img data-f="image" src="<?php echo esc_url($leaderimage['url']); ?>" loading="lazy" alt="<?php echo esc_attr($leaderimage['alt']); ?>" />
								<?php endif; ?>
								<span data-f="name"><?php echo get_sub_field('name'); ?></span>
								<span data-f="role"><?php echo get_sub_field('role'); ?></span>
								<span data-f="category"><?php echo get_sub_field('category'); ?></span>
								<div data-f="bio">
									<p><?php echo get_sub_field('bio'); ?></p>
								</div>
							</article>
						<?php endwhile; ?>
					<?php endif; ?>
				<?php endwhile; ?>
			<?php endif; ?>
		<?php endwhile; ?>
	<?php endif; ?>
</div>

<?php get_footer(); ?>
