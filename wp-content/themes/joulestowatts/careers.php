<?php /* Template Name: Careers */ get_header(); ?>

<section class="bannerSec">
	<div class="wrapper">
        <?php if( have_rows('banner_section') ): ?>
            <?php while( have_rows('banner_section') ): the_row(); ?>
                <div class="bannerTxt">
                    <div class="chIntro">
                        <h3><?php echo get_sub_field('sub_heading'); ?></h3>
                        <h1><?php echo get_sub_field('heading'); ?></h1>
                    </div>
                    <p><?php echo get_sub_field('description'); ?></p>
                    <div class="chBtns">
                        <a class="primaryCTA" href="#openings"><span><?php echo get_sub_field('cta_text_one'); ?></span>
                            <div class="arrowBox">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M18.7504 15.7496V5.99958C18.7504 5.80067 18.6714 5.6099 18.5307 5.46925C18.3901 5.3286 18.1993 5.24958 18.0004 5.24958H8.25042C8.0515 5.24958 7.86074 5.3286 7.72009 5.46925C7.57943 5.6099 7.50042 5.80067 7.50042 5.99958C7.50042 6.19849 7.57943 6.38926 7.72009 6.52991C7.86074 6.67057 8.0515 6.74958 8.25042 6.74958H16.1901L5.46979 17.469C5.32906 17.6097 5.25 17.8006 5.25 17.9996C5.25 18.1986 5.32906 18.3895 5.46979 18.5302C5.61052 18.6709 5.80139 18.75 6.00042 18.75C6.19944 18.75 6.39031 18.6709 6.53104 18.5302L17.2504 7.8099V15.7496C17.2504 15.9485 17.3294 16.1393 17.4701 16.2799C17.6107 16.4206 17.8015 16.4996 18.0004 16.4996C18.1993 16.4996 18.3901 16.4206 18.5307 16.2799C18.6714 16.1393 18.7504 15.9485 18.7504 15.7496Z" fill="#19060F"/>
                                </svg>
                            </div>
                        </a>
                        <a class="transparentCTA" href="#residency"><span><?php echo get_sub_field('cta_text_two'); ?></span>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 17L17 7M17 7H8M17 7V16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>

		<form class="chForm" id="apply" action="#" method="post" enctype="multipart/form-data" novalidate>
			<h2 class="chFormTitle">Apply</h2>
			<p class="chFor">Applying for : <span data-apply-role>General Applications</span></p>
			<div class="chFields">
				<label class="chField">
					<span class="chSr">Name</span>
					<input class="chInput" type="text" name="name" placeholder="Name" autocomplete="name" required>
				</label>
				<label class="chField">
					<span class="chSr">Work email</span>
					<input class="chInput" type="email" name="email" placeholder="Work email" autocomplete="email" required>
				</label>
				<label class="chField chUpload">
					<input class="chFile" type="file" name="resume" accept=".pdf,.doc,.docx">
					<span class="chUploadText" data-upload-text>Resume (PDF or Word)</span>
					<span class="chUploadBtn">Upload</span>
				</label>
			</div>
			<p class="chNote">By submitting, you agree we may use your details to consider you for role</p>
			<button class="chSubmit" type="submit"><span>Send</span><svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 17L17 7M17 7H8M17 7V16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
		</form>
	</div>
</section>

<section class="openrolseSec homeImpactSec" id="openings">
    <div class="homeImpactGlow" aria-hidden="true">
        <img src="<?php echo get_template_directory_uri(); ?>/images/home-glow.webp" alt="" />
        <img src="<?php echo get_template_directory_uri(); ?>/images/home-glow.webp" alt="" />
    </div>
    <?php if( have_rows('open_roles_section') ): ?>
        <?php while( have_rows('open_roles_section') ): the_row(); ?>
            <div class="wrapper">
                <div class="secHeading">
                    <h3><?php echo get_sub_field('sub_heading'); ?></h3>
                    <h2><?php echo get_sub_field('heading'); ?></h2>
                    <div class="rolesDate">
                        <p><?php echo get_sub_field('roles_open'); ?></p>
                        <p><?php echo get_sub_field('date'); ?></p>
                    </div>
                </div>
                <?php if( have_rows('jobs_content') ): ?>
                    <?php while( have_rows('jobs_content') ): the_row(); ?>
                        <div class="osGroup">
                            <h3 class="osRegion"><?php echo get_sub_field('region'); ?></h3>
                            <ul class="osList">
                                <?php if( have_rows('job_lists') ): ?>
                                    <?php while( have_rows('job_lists') ): the_row(); ?>
                                        <li class="osRow">
                                            <div class="osInfo">
                                                <div class="osTitleRow">
                                                    <h4 class="osTitle"><?php echo get_sub_field('job_name'); ?></h4>
                                                    <?php $value = get_sub_field( "tag" ); if ( $value ) {?>
                                                        <span class="osNew"><?php echo get_sub_field('tag'); ?></span>
                                                    <?php } ?>
                                                </div>
                                                <p class="osMeta"><?php echo get_sub_field('location'); ?></p>
                                            </div>
                                            <a class="primaryCTA" href="<?php echo get_sub_field('cta_link'); ?>"><span><?php echo get_sub_field('cta_text'); ?></span><svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7 17L17 7M17 7H8M17 7V16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
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

<section class="talkToPartnerSec">
    <div class="secWrapper">
        <div class="secHeading">
            <h2 class="manrope">Don't see the right role?</h2>
            <p> Send a general application.</p>
            <a href="" class="primaryCTA">Send A General Application
                <div class="arrowBox">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M18.7504 15.7496V5.99958C18.7504 5.80067 18.6714 5.6099 18.5307 5.46925C18.3901 5.3286 18.1993 5.24958 18.0004 5.24958H8.25042C8.0515 5.24958 7.86074 5.3286 7.72009 5.46925C7.57943 5.6099 7.50042 5.80067 7.50042 5.99958C7.50042 6.19849 7.57943 6.38926 7.72009 6.52991C7.86074 6.67057 8.0515 6.74958 8.25042 6.74958H16.1901L5.46979 17.469C5.32906 17.6097 5.25 17.8006 5.25 17.9996C5.25 18.1986 5.32906 18.3895 5.46979 18.5302C5.61052 18.6709 5.80139 18.75 6.00042 18.75C6.19944 18.75 6.39031 18.6709 6.53104 18.5302L17.2504 7.8099V15.7496C17.2504 15.9485 17.3294 16.1393 17.4701 16.2799C17.6107 16.4206 17.8015 16.4996 18.0004 16.4996C18.1993 16.4996 18.3901 16.4206 18.5307 16.2799C18.6714 16.1393 18.7504 15.9485 18.7504 15.7496Z" fill="#19060F"/>
                    </svg>
                </div>
            </a>
        </div>
    </div>
</section>

<section class="ecaTiersSec" id="residency">
    <div class="wrapper">
        <?php if ( have_rows( 'what_you_get_section' ) ) : ?>
            <?php while ( have_rows( 'what_you_get_section' ) ) : the_row(); ?>
                <div class="secHeading">
                    <h2 class="manrope"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2>
                    <p><?php echo wp_kses_post( get_sub_field( 'description' ) ); ?></p>
                    <a href="<?php echo get_sub_field('cta_link'); ?>" class="primaryCTA"><?php echo get_sub_field('cta_text'); ?>
                        <div class="arrowBox">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M18.7504 15.7496V5.99958C18.7504 5.80067 18.6714 5.6099 18.5307 5.46925C18.3901 5.3286 18.1993 5.24958 18.0004 5.24958H8.25042C8.0515 5.24958 7.86074 5.3286 7.72009 5.46925C7.57943 5.6099 7.50042 5.80067 7.50042 5.99958C7.50042 6.19849 7.57943 6.38926 7.72009 6.52991C7.86074 6.67057 8.0515 6.74958 8.25042 6.74958H16.1901L5.46979 17.469C5.32906 17.6097 5.25 17.8006 5.25 17.9996C5.25 18.1986 5.32906 18.3895 5.46979 18.5302C5.61052 18.6709 5.80139 18.75 6.00042 18.75C6.19944 18.75 6.39031 18.6709 6.53104 18.5302L17.2504 7.8099V15.7496C17.2504 15.9485 17.3294 16.1393 17.4701 16.2799C17.6107 16.4206 17.8015 16.4996 18.0004 16.4996C18.1993 16.4996 18.3901 16.4206 18.5307 16.2799C18.6714 16.1393 18.7504 15.9485 18.7504 15.7496Z" fill="#19060F"/>
                            </svg>
                        </div>
                    </a>
                </div>
                <div class="ecaTiers" data-accordion data-autoplay="3000">
                    <?php if ( have_rows( 'what_you_get_content' ) ) : ?>
                        <?php $eca_tier = 0; while ( have_rows( 'what_you_get_content' ) ) : the_row(); ?>
                            <div class="ecaTier<?php echo 0 === $eca_tier ? ' is-open' : ''; ?> is-open" data-accordion-item role="button" tabindex="0" aria-expanded="<?php echo 0 === $eca_tier ? 'true' : 'false'; ?>">
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/whatgetbg.webp' ); ?>" class="tierBg" alt="" loading="lazy">
                                <?php $eca_tier_img = get_sub_field( 'card_image' ); if ( ! empty( $eca_tier_img ) ) : ?>
                                    <img src="<?php echo esc_url( $eca_tier_img['url'] ); ?>" loading="lazy" class="tierImg" alt="<?php echo esc_attr( $eca_tier_img['alt'] ); ?>" />
                                <?php endif; ?>
                                <div class="tierText">
                                    <h3 class="manrope"><?php echo esc_html( get_sub_field( 'card_heading' ) ); ?></h3>
                                    <div class="tierDesc">
                                        <p><?php echo wp_kses_post( get_sub_field( 'card_description' ) ); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php $eca_tier++; endwhile; ?>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>

<section class="deployedSec careersLife">
    <?php if( have_rows('life_at_joulestowatts') ): ?>
        <?php while( have_rows('life_at_joulestowatts') ): the_row(); ?>
            <div class="dsWrap">
                <div class="dsHead">
                    <h3 class="manrope"><?php echo get_sub_field('sub_heading'); ?></h3>
                    <h2 class="manrope"><?php echo get_sub_field('heading'); ?></h2>
                </div>
            </div>
            <div class="dsTrack" tabindex="0" aria-label="Team stories, scroll sideways for more">
                <?php if( have_rows('content_box') ): ?>
                    <?php while( have_rows('content_box') ): the_row(); ?>
                        <div class="dsCard">
                            <p class="dsQuote"><?php echo get_sub_field('description'); ?></p>
                            <div class="dsPerson">
                                <?php $perimage = get_sub_field('person_image'); if( !empty( $perimage ) ): ?>
                                    <img src="<?php echo esc_url($perimage['url']); ?>" loading="lazy" alt="<?php echo esc_attr($perimage['alt']); ?>" />
                                <?php endif; ?>
                                <div class="dsInfo">
                                    <p class="dsName"><?php echo get_sub_field('name'); ?></p>
                                    <p class="dsRole"><?php echo get_sub_field('role'); ?></p>
                                    <p class="dsSector"><?php echo get_sub_field('domain'); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</section>

<?php get_footer(); ?>