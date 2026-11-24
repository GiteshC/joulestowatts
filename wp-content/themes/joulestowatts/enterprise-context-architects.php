<?php /* Template Name: Enterprise Context Architects */ get_header(); ?>
<?php
$eca_arrow   = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M18.7504 15.7496V5.99958C18.7504 5.80067 18.6714 5.6099 18.5307 5.46925C18.3901 5.3286 18.1993 5.24958 18.0004 5.24958H8.25042C8.0515 5.24958 7.86074 5.3286 7.72009 5.46925C7.57943 5.6099 7.50042 5.80067 7.50042 5.99958C7.50042 6.19849 7.57943 6.38926 7.72009 6.52991C7.86074 6.67057 8.0515 6.74958 8.25042 6.74958H16.1901L5.46979 17.469C5.32906 17.6097 5.25 17.8006 5.25 17.9996C5.25 18.1986 5.32906 18.3895 5.46979 18.5302C5.61052 18.6709 5.80139 18.75 6.00042 18.75C6.19944 18.75 6.39031 18.6709 6.53104 18.5302L17.2504 7.8099V15.7496C17.2504 15.9485 17.3294 16.1393 17.4701 16.2799C17.6107 16.4206 17.8015 16.4996 18.0004 16.4996C18.1993 16.4996 18.3901 16.4206 18.5307 16.2799C18.6714 16.1393 18.7504 15.9485 18.7504 15.7496Z" fill="#19060F"/></svg>';
$eca_dashed  = '<svg class="lineanim" width="669" height="25" viewBox="0 0 669 25" fill="none" preserveAspectRatio="none" aria-hidden="true"><path d="M0 12.0625H669" stroke-width="3" stroke-dasharray="3.98 3.98" stroke="url(#ecaDashGradient)"/></svg>';
?>

<svg width="0" height="0" class="ecaSvgDefs" aria-hidden="true" focusable="false">
    <defs>
        <linearGradient id="ecaDashGradient" x1="864.278" y1="12.0625" x2="-143.666" y2="12.0625" gradientUnits="userSpaceOnUse">
            <stop offset="0.0192308" stop-color="#420730" stop-opacity="0"/>
            <stop offset="0.569714" stop-color="#1A9BA4"/>
            <stop offset="1" stop-color="#420730" stop-opacity="0"/>
        </linearGradient>
    </defs>
</svg>

<section class="bannerInnerSection">
    <div class="wrapper">
        <?php if ( have_rows( 'banner_section' ) ) : ?>
            <?php while ( have_rows( 'banner_section' ) ) : the_row(); ?>
                <div class="bannerContent">
                    <div class="bannerHeading">
                        <h1 class="manrope"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h1>
                        <?php if ( get_sub_field( 'tagline' ) ) : ?>
                            <p class="tagline"><?php echo esc_html( get_sub_field( 'tagline' ) ); ?></p>
                        <?php endif; ?>
                        <p><?php echo wp_kses_post( get_sub_field( 'description' ) ); ?></p>
                        <a href="<?php get_sub_field('primary_cta_link'); ?>" class="primaryCTA"><?php echo esc_html( get_sub_field( 'primary_cta_text' ) ); ?>
                            <div class="arrowBox">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M18.7504 15.7496V5.99958C18.7504 5.80067 18.6714 5.6099 18.5307 5.46925C18.3901 5.3286 18.1993 5.24958 18.0004 5.24958H8.25042C8.0515 5.24958 7.86074 5.3286 7.72009 5.46925C7.57943 5.6099 7.50042 5.80067 7.50042 5.99958C7.50042 6.19849 7.57943 6.38926 7.72009 6.52991C7.86074 6.67057 8.0515 6.74958 8.25042 6.74958H16.1901L5.46979 17.469C5.32906 17.6097 5.25 17.8006 5.25 17.9996C5.25 18.1986 5.32906 18.3895 5.46979 18.5302C5.61052 18.6709 5.80139 18.75 6.00042 18.75C6.19944 18.75 6.39031 18.6709 6.53104 18.5302L17.2504 7.8099V15.7496C17.2504 15.9485 17.3294 16.1393 17.4701 16.2799C17.6107 16.4206 17.8015 16.4996 18.0004 16.4996C18.1993 16.4996 18.3901 16.4206 18.5307 16.2799C18.6714 16.1393 18.7504 15.9485 18.7504 15.7496Z" fill="#19060F"/>
                                </svg>
                            </div>
                        </a>
                    </div>
                    <?php $bannerimg = get_sub_field('banner_image'); if( !empty( $bannerimg ) ): ?>
                        <img src="<?php echo esc_url($bannerimg['url']); ?>" loading="lazy" alt="<?php echo esc_attr($bannerimg['alt']); ?>" />
                    <?php endif; ?>
                </div>
                <?php if ( get_sub_field( 'cta_text' ) ) : ?>
                    <div class="casestudyCTA">
                        <a href="<?php echo esc_url( get_sub_field( 'cta_link' ) ); ?>" class="teritaryCTA"><?php echo esc_html( get_sub_field( 'cta_text' ) ); ?>
                            <span>
                                <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path d="M2.35288 9.41198C2.35288 9.56799 2.41486 9.71761 2.52517 9.82792C2.63549 9.93824 2.78511 10.0002 2.94112 10.0002H14.4624L10.172 14.2899C10.1173 14.3446 10.074 14.4095 10.0444 14.4809C10.0148 14.5523 9.99961 14.6288 9.99961 14.7061C9.99961 14.7834 10.0148 14.8599 10.0444 14.9313C10.074 15.0027 10.1173 15.0676 10.172 15.1223C10.2267 15.1769 10.2915 15.2203 10.3629 15.2499C10.4343 15.2794 10.5109 15.2947 10.5882 15.2947C10.6655 15.2947 10.742 15.2794 10.8134 15.2499C10.8848 15.2203 10.9497 15.1769 11.0044 15.1223L16.2985 9.82815C16.3532 9.77352 16.3965 9.70865 16.4262 9.63724C16.4558 9.56582 16.471 9.48928 16.471 9.41198C16.471 9.33467 16.4558 9.25813 16.4262 9.18672C16.3965 9.11531 16.3532 9.05043 16.2985 8.9958L11.0044 3.70168C10.894 3.59131 10.7443 3.5293 10.5882 3.5293C10.4321 3.5293 10.2824 3.59131 10.172 3.70168C10.0616 3.81206 9.99961 3.96176 9.99961 4.11786C9.99961 4.27396 10.0616 4.42366 10.172 4.53404L14.4624 8.82374H2.94112C2.78511 8.82374 2.63549 8.88572 2.52517 8.99603C2.41486 9.10635 2.35288 9.25597 2.35288 9.41198Z" fill="white"/>
                                </svg>
                            </span>
                        </a>
                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
    <div class="bannerBG">
        <img src="<?php echo esc_url( get_template_directory_uri() . '/images/etd-glow.webp' ); ?>" class="bannerGlow" alt="" loading="eager">
    </div>
</section>

<section class="ecaVoicesSec">
    <?php if( have_rows('eca_testimonial') ): ?>
        <?php while( have_rows('eca_testimonial') ): the_row(); ?>
            <img class="ecaVoicesWaves" src="images/eca-waves.svg" alt="" aria-hidden="true">
            <div class="wrapper">
                <div class="secHeading">
                    <h2><?php echo get_sub_field('sub_heading'); ?></h2>
                    <p><?php echo get_sub_field('sub_heading'); ?></p>
                </div>
                <div class="voicesGrid">
                    <?php if( have_rows('eca_voices') ): ?>
                        <?php while( have_rows('eca_voices') ): the_row(); ?>
                            <div class="voiceCard">
                                <button class="voicePlay" type="button" data-video="<?php echo get_sub_field('video_link'); ?>" aria-label="Play video: Queen Rachel Joyce D">
                                    <!-- <img class="voicePoster" src="images/eca-voice-1.webp" alt="" loading="lazy"> -->
                                    <span class="playIcon" aria-hidden="true"><svg viewBox="0 0 68 68" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linejoin="round"><circle cx="34" cy="34" r="32"/><path d="M28 22 46 34 28 46Z"/></svg></span>
                                </button>
                                <div class="voiceMeta">
                                    <?php $personimage = get_sub_field('person_image'); if( !empty( $personimage ) ): ?>
                                        <img src="<?php echo esc_url($personimage['url']); ?>" class="voiceAvatar" loading="lazy" alt="<?php echo esc_attr($personimage['alt']); ?>" />
                                    <?php endif; ?>
                                    <!-- <img  src="<?php echo get_template_directory_uri(); ?>/images/eca-video-person.png" alt="Queen Rachel Joyce D" width="76" height="76" loading="lazy"> -->
                                    <div class="voiceInfo">
                                        <h3><?php echo get_sub_field('name'); ?></h3>
                                        <p class="voiceRole"><?php echo get_sub_field('role'); ?></p>
                                        <p class="voiceDomain"><?php echo get_sub_field('domain'); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    <!-- Cards 2 and 3: same markup, own video URL, poster and avatar. -->
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</section>

<section class="introSection">
    <div class="wrapper">
        <div class="introContent">
            <?php if( have_rows('intro_section') ): ?>
                <?php while( have_rows('intro_section') ): the_row(); ?>
                    <div class="secHeading">
                        <h3 class="manrope"><?php echo get_sub_field('sub_heading'); ?></h3>
                        <h2 class="manrope"><?php echo get_sub_field('heading'); ?></h2>
                        <p><?php echo get_sub_field('description'); ?></p>    
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="introPatch">
        <img src="<?php bloginfo('template_directory');?>/images/intro-patch.webp" alt="">
    </div>
</section>

<section class="solutionSection scrollAnimation" id="offerings">
    <div class="secWrapper">
        <?php if( have_rows('solution_section') ): ?>
            <?php while( have_rows('solution_section') ): the_row(); ?>
                <div class="secHeading">
                    <h3 class="manrope"><?php echo get_sub_field('sub_heading'); ?></h3>
                    <h2 class="manrope"><?php echo wp_kses_post( get_sub_field('heading') ); ?></h2>
                </div>
                <div class="cardContainer" data-accordion>
                    <?php if( have_rows('solution_content') ): ?>
                        <?php $solutionsec = get_field('solution_section'); $solutioncount = ! empty( $solutionsec['solution_content'] ) ? count( $solutionsec['solution_content'] ) : 0; $counter=1; while( have_rows('solution_content') ): the_row(); ?>
                            <div class="solutionCard<?php echo $counter === $solutioncount ? ' is-open' : ''; ?>" data-accordion-item role="button" tabindex="0" aria-expanded="<?php echo $counter === $solutioncount ? 'true' : 'false'; ?>">
                                <div class="imgBox">
                                    <?php $solutionimg = get_sub_field('box_image'); if( !empty( $solutionimg ) ): ?>
                                        <img src="<?php echo esc_url($solutionimg['url']); ?>" loading="lazy" alt="<?php echo esc_attr($solutionimg['alt']); ?>" />
                                    <?php endif; ?>
                                </div>
                                <div class="bottomContent">
                                    <?php $boxLink = get_sub_field('box_link'); ?>
                                    <a <?php echo $boxLink ? 'href="' . esc_url( $boxLink ) . '"' : 'tabindex="0"'; ?>>
                                        <span class="manrope num"><?php echo sprintf('%02d', $counter); ?></span>
                                        <h3 class="manrope"><?php echo wp_kses_post( get_sub_field('box_heading') ); ?></h3>
                                        <div class="description">
                                            <div class="descriptionInner">
                                                <p><?php echo wp_kses_post( get_sub_field('box_description') ); ?></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php $counter++; endwhile; ?>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>

<section class="whyItSection">
    <?php if( have_rows('how_to_apply') ): ?>
        <?php while( have_rows('how_to_apply') ): the_row(); ?>
            <div class="secWrapper">
                <div class="secHeading">
                    <h3 class="manrope"><?php echo get_sub_field('sub_heading'); ?></h3>
                    <h2 class="manrope"><?php echo get_sub_field('heading'); ?></h2>
                    <p><?php echo get_sub_field('description'); ?></p>
                </div>
                <div class="cardContainer whyItSlider">
                    <?php if( have_rows('cards') ): ?>
                        <?php $counter=1; while( have_rows('cards') ): the_row(); ?>
                            <div class="card">
                                <div class="imgBox">
                                    <?php $whyitcardimg = get_sub_field('image'); if( !empty( $whyitcardimg ) ): ?>
                                        <img src="<?php echo esc_url($whyitcardimg['url']); ?>" loading="lazy" alt="<?php echo esc_attr($whyitcardimg['alt']); ?>" />
                                    <?php endif; ?>
                                </div>
                                <div class="contentBox">
                                    <h4><?php echo sprintf('%02d', $counter); ?></h4>
                                    <div class="headingContent">
                                        <h3><?php echo get_sub_field('title'); ?></h3>
                                        <div class="moreContent">
                                            <p><?php echo get_sub_field('description'); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php $counter=$counter+1; endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</section>

<section class="ecaTiersSec">
    <div class="wrapper">
        <?php if ( have_rows( 'what_you_get' ) ) : ?>
            <?php while ( have_rows( 'what_you_get' ) ) : the_row(); ?>
                <div class="secHeading">
                    <h2 class="manrope"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2>
                    <p><?php echo wp_kses_post( get_sub_field( 'description' ) ); ?></p>
                </div>
                <div class="ecaTiers" data-accordion data-autoplay="3000">
                    <?php if ( have_rows( 'tiers' ) ) : ?>
                        <?php $eca_tier = 0; while ( have_rows( 'tiers' ) ) : the_row(); ?>
                            <div class="ecaTier<?php echo 0 === $eca_tier ? ' is-open' : ''; ?>" data-accordion-item role="button" tabindex="0" aria-expanded="<?php echo 0 === $eca_tier ? 'true' : 'false'; ?>">
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/whatgetbg.webp' ); ?>" class="tierBg" alt="" loading="lazy">
                                <?php $eca_tier_img = get_sub_field( 'image' ); if ( ! empty( $eca_tier_img ) ) : ?>
                                    <img src="<?php echo esc_url( $eca_tier_img['url'] ); ?>" loading="lazy" class="tierImg" alt="<?php echo esc_attr( $eca_tier_img['alt'] ); ?>" />
                                <?php endif; ?>
                                <div class="tierText">
                                    <h3 class="manrope"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h3>
                                    <div class="tierDesc">
                                        <ul>
                                            <?php if ( have_rows( 'tags_list' ) ) : ?>
                                                <?php while ( have_rows( 'tags_list' ) ) : the_row(); ?>
                                                    <li><?php echo esc_html( get_sub_field( 'tags' ) ); ?></li>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                        </ul>
                                        <p><?php echo wp_kses_post( get_sub_field( 'description' ) ); ?></p>
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

<section class="evidenceSec">
    <div class="wrapper">
        <?php if( have_rows('evidence_section') ): ?>
            <?php while( have_rows('evidence_section') ): the_row(); ?>
                <div class="secHeading">
                    <h3 class="manrope"><?php echo get_sub_field('sub_heading'); ?></h3>
                    <h2 class="manrope"><?php echo get_sub_field('heading'); ?></h2>
                    <p><?php echo get_sub_field('description'); ?></p>
                </div>
                <div class="evidenceContent">
                    <?php if( have_rows('evidence_content') ): ?>
                        <?php while( have_rows('evidence_content') ): the_row(); ?>
                            <div class="boxHeading">
                                <h4 class="manrope"><?php echo get_sub_field('sub_heading'); ?></h4>
                                <h3 class="manrope"><?php echo get_sub_field('heading'); ?></h3>
                            </div>
                            <div class="evidenceBox">
                                <div class="evidenceBoxInner">
                                    <?php if( have_rows('evidence_box') ): ?>
                                        <?php while( have_rows('evidence_box') ): the_row(); ?>
                                            <div class="evidenceBoxContent">
                                                <h4 class="manrope"><?php echo get_sub_field('box_heading'); ?></h4>
                                                <p><?php echo get_sub_field('box_description'); ?></p>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>

<section class="ecaRolesSec">
    <?php if( have_rows('existing_roles') ): ?>
        <?php while( have_rows('existing_roles') ): the_row(); ?>
            <div class="wrapper">
                <div class="secHeading">
                    <h3 class="manrope"><?php echo get_sub_field('sub_heading'); ?></h3>
                    <h2 class="manrope"><?php echo get_sub_field('heading'); ?></h2>
                    <p><?php echo get_sub_field('description'); ?></p>
                </div>
                <div class="rolesTabs" role="tablist" aria-label="Roles">
                    <?php if( have_rows('roles_tabs_content') ): ?>
                        <?php $counter=1; while( have_rows('roles_tabs_content') ): the_row(); ?>
                            <button class="rolesTab <?php if($counter==1) { echo 'is-active'; } ?>" type="button" role="tab" id="roleTab<?php echo $counter; ?>" aria-controls="rolePanel<?php echo $counter; ?>" aria-selected="true"><?php echo get_sub_field('tab_heading'); ?></button>
                        <?php $counter++; endwhile; ?>
                    <?php endif; ?>
                </div>
                <div class="rolesPanels">
                    <?php if( have_rows('roles_tabs_content') ): ?>
                        <?php $counter=1; while( have_rows('roles_tabs_content') ): the_row(); ?>
                            <div class="rolesPanel <?php if($counter==1) { echo 'is-active'; } ?>" role="tabpanel" id="rolePanel<?php echo $counter; ?>" aria-labelledby="roleTab<?php echo $counter; ?>">
                                <?php $tabimage = get_sub_field('tab_image'); if( !empty( $tabimage ) ): ?>
                                    <img src="<?php echo esc_url($tabimage['url']); ?>" loading="lazy" class="rolesImg" alt="<?php echo esc_attr($tabimage['alt']); ?>" />
                                <?php endif; ?>
                                <!-- <img  src="<?php echo get_template_directory_uri(); ?>/images/eca-existing1.webp" alt="" width="660" height="440" loading="lazy"> -->
                                <div class="rolesCols">
                                    <?php if( have_rows('tab_pointers') ): ?>
                                        <?php while( have_rows('tab_pointers') ): the_row(); ?>
                                            <div class="rolesCol">
                                                <h3><?php echo get_sub_field('pointer_heading'); ?></h3>
                                                <p><?php echo get_sub_field('pointer_text'); ?></p></div>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php $counter++; endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</section>

<section class="ecaChangesSec">
	<div class="wrapper">
        <?php if( have_rows('business_outcomes') ): ?>
            <?php while( have_rows('business_outcomes') ): the_row(); ?>
                <div class="secHeading">
                    <h3 class="manrope"><?php echo get_sub_field('sub_heading'); ?></h3>
                    <h2 class="manrope"><?php echo get_sub_field('heading'); ?></h2>
                </div>
                <div class="changesGrid">
                    <?php if( have_rows('outcomes_content') ): ?>
                        <?php while( have_rows('outcomes_content') ): the_row(); ?>
                            <div class="changeCard">
                                <h3><?php echo get_sub_field('box_heading'); ?></h3>
                                <p><?php echo get_sub_field('box_description'); ?></p>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
	</div>
</section>

<section class="ecaWorkSec">
    <?php if( have_rows('enterprise_leaders') ): ?>
        <?php while( have_rows('enterprise_leaders') ): the_row(); ?>
            <div class="wrapper">
                <div class="secHeading">
                    <h3 class="manrope"><?php echo get_sub_field('sub_heading'); ?></h3>
                    <h2 class="manrope"><?php echo get_sub_field('heading'); ?></h2>
                </div>
                <div class="workGrid">
                    <?php if( have_rows('enterprise_leaders_content') ): ?>
                        <?php while( have_rows('enterprise_leaders_content') ): the_row(); ?>
                            <div class="workCol">
                                <div class="workHead"><h3><?php echo get_sub_field('heading'); ?></h3></div>
                                <div class="workBody">
                                    <div>
                                        <p class="workDesc"><?php echo get_sub_field('description'); ?></p>
                                        <p class="workNote"><?php echo get_sub_field('note'); ?></p>
                                    </div>
                                    <a class="primaryCTA" href="<?php echo get_sub_field('cta_link'); ?>"><?php echo get_sub_field('cta_text'); ?>
                                        <div class="arrowBox">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M18.7504 15.7496V5.99958C18.7504 5.80067 18.6714 5.6099 18.5307 5.46925C18.3901 5.3286 18.1993 5.24958 18.0004 5.24958H8.25042C8.0515 5.24958 7.86074 5.3286 7.72009 5.46925C7.57943 5.6099 7.50042 5.80067 7.50042 5.99958C7.50042 6.19849 7.57943 6.38926 7.72009 6.52991C7.86074 6.67057 8.0515 6.74958 8.25042 6.74958H16.1901L5.46979 17.469C5.32906 17.6097 5.25 17.8006 5.25 17.9996C5.25 18.1986 5.32906 18.3895 5.46979 18.5302C5.61052 18.6709 5.80139 18.75 6.00042 18.75C6.19944 18.75 6.39031 18.6709 6.53104 18.5302L17.2504 7.8099V15.7496C17.2504 15.9485 17.3294 16.1393 17.4701 16.2799C17.6107 16.4206 17.8015 16.4996 18.0004 16.4996C18.1993 16.4996 18.3901 16.4206 18.5307 16.2799C18.6714 16.1393 18.7504 15.9485 18.7504 15.7496Z" fill="#19060F"/>
                                            </svg>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</section>

<section class="ecaTiersSec">
    <div class="wrapper">
        <?php if ( have_rows( 'enterprise_context' ) ) : ?>
            <?php while ( have_rows( 'enterprise_context' ) ) : the_row(); ?>
                <div class="secHeading">
                    <h2 class="manrope"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2>
                    <p><?php echo wp_kses_post( get_sub_field( 'description' ) ); ?></p>
                </div>
                <div class="ecaTiers" data-accordion data-autoplay="3000">
                    <?php if ( have_rows( 'tiers' ) ) : ?>
                        <?php $eca_tier = 0; while ( have_rows( 'tiers' ) ) : the_row(); ?>
                            <div class="ecaTier<?php echo 0 === $eca_tier ? ' is-open' : ''; ?>" data-accordion-item role="button" tabindex="0" aria-expanded="<?php echo 0 === $eca_tier ? 'true' : 'false'; ?>">
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/whatgetbg.webp' ); ?>" class="tierBg" alt="" loading="lazy">
                                <?php $eca_tier_img = get_sub_field( 'image' ); if ( ! empty( $eca_tier_img ) ) : ?>
                                    <img src="<?php echo esc_url( $eca_tier_img['url'] ); ?>" loading="lazy" class="tierImg" alt="<?php echo esc_attr( $eca_tier_img['alt'] ); ?>" />
                                <?php endif; ?>
                                <div class="tierText">
                                    <h3 class="manrope"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h3>
                                    <div class="tierDesc">
                                        <ul>
                                            <?php if ( have_rows( 'tags_list' ) ) : ?>
                                                <?php while ( have_rows( 'tags_list' ) ) : the_row(); ?>
                                                    <li><?php echo esc_html( get_sub_field( 'tags' ) ); ?></li>
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                        </ul>
                                        <p><?php echo wp_kses_post( get_sub_field( 'description' ) ); ?></p>
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

<section class="talkToPartnerSec">
    <div class="secWrapper">
        <?php if ( have_rows( 'joulestowatts_certified' ) ) : ?>
            <?php while ( have_rows( 'joulestowatts_certified' ) ) : the_row(); ?>
                <div class="secHeading">
                    <h2 class="manrope"><?php echo wp_kses_post( get_sub_field( 'heading' ) ); ?></h2>
                    <p><?php echo wp_kses_post( get_sub_field( 'description' ) ); ?></p>
                    <a href="<?php echo esc_url( get_sub_field( 'cta_link' ) ); ?>" class="primaryCTA"><span><?php echo esc_html( get_sub_field( 'cta_text' ) ); ?></span>
                        <div class="arrowBox"><?php echo $eca_arrow; // phpcs:ignore WordPress.Security.EscapeOutput -- static SVG. ?></div>
                    </a>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>

<?php if ( have_rows( 'highlights' ) ) : ?>
    <?php while ( have_rows( 'highlights' ) ) : the_row(); ?>
        <section class="ecaStatsSec">
            <div class="wrapper">
                <div class="ecaStatsGrid">
                    <?php if ( have_rows( 'cards' ) ) : ?>
                        <?php while ( have_rows( 'cards' ) ) : the_row(); ?>
                            <div class="ecaStatCard">
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/etd-topo-lines.webp' ); ?>" class="topo" alt="" loading="lazy">
                                <h3 class="manrope"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h3>
                                <p><?php echo wp_kses_post( get_sub_field( 'description' ) ); ?></p>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>

<section class="howItRunsSec">
    <div class="wrapper">
        <div class="secHeading">
            <h2 class="manrope">What you become</h2>
        </div>
        <div class="cardContainer cardSlider">
            <div class="card">
                <div class="cardSticky">
                    <div class="imgBox">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/workforce-howItRuns-bg.webp" class="howItRunsbg">
                        <img src="<?php bloginfo('template_directory'); ?>/images/eca-become1.webp" alt="" >
                    </div>
                    <div class="contentBox">
                        <h3 class="manrope">Engineer</h3>
                        <p>Build and ship agents, integrations, and evaluations that hold up in production.</p>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="cardSticky">
                    <div class="imgBox">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/workforce-howItRuns-bg.webp" class="howItRunsbg">
                        <img src="<?php bloginfo('template_directory'); ?>/images/eca-become2.webp" alt="" >
                    </div>
                    <div class="contentBox">
                        <h3 class="manrope">Product thinker</h3>
                        <p>decide what is worth building, and drop what does not pay back.</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="cardSticky">
                    <div class="imgBox">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/workforce-howItRuns-bg.webp" class="howItRunsbg">
                        <img src="<?php bloginfo('template_directory'); ?>/images/eca-become3.webp" alt="" >
                    </div>
                    <div class="contentBox">
                        <h3 class="manrope">Listener</h3>
                        <p>sit with the people who do the work and hear what the process document leaves out.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="arrowBox">
            <span class="howItRunsPrevArrow ">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="22" viewBox="0 0 26 22" fill="none">
                    <path d="M9.90509 20.9813L0.305793 11.382C0.109955 11.1861 -6.67789e-05 10.9205 -6.81276e-05 10.6436C-6.67789e-05 10.3666 0.109955 10.101 0.305793 9.90515L9.90509 0.305849C10.1009 0.110011 10.3665 -1.03086e-05 10.6435 -1.0983e-05C10.9205 -1.014e-05 11.1861 0.11001 11.3819 0.305848C11.5777 0.501686 11.6878 0.7673 11.6878 1.04426C11.6878 1.32121 11.5777 1.58683 11.3819 1.78266L3.56494 9.59963L24.6732 9.59871C24.9504 9.59871 25.2161 9.70879 25.4121 9.90474C25.608 10.1007 25.7181 10.3664 25.7181 10.6436C25.7181 10.9207 25.608 11.1864 25.4121 11.3824C25.2161 11.5783 24.9504 11.6884 24.6732 11.6884L3.56494 11.6875L11.3819 19.5044C11.5777 19.7003 11.6878 19.9659 11.6878 20.2429C11.6878 20.5198 11.5777 20.7854 11.3819 20.9813C11.1861 21.1771 10.9205 21.2871 10.6435 21.2871C10.3665 21.2871 10.1009 21.1771 9.90509 20.9813Z" fill="#19060F"/>
                </svg>
            </span>
            <span class="howItRunsNextArrow">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="22" viewBox="0 0 26 22" fill="none">
                    <path d="M15.8129 20.9813L25.4122 11.382C25.6081 11.1861 25.7181 10.9205 25.7181 10.6436C25.7181 10.3666 25.6081 10.101 25.4122 9.90515L15.8129 0.305849C15.6171 0.110011 15.3515 -1.03086e-05 15.0745 -1.0983e-05C14.7976 -1.014e-05 14.5319 0.11001 14.3361 0.305848C14.1403 0.501686 14.0303 0.7673 14.0303 1.04426C14.0303 1.32121 14.1403 1.58683 14.3361 1.78266L22.1531 9.59963L1.04478 9.59871C0.767665 9.59871 0.501903 9.70879 0.305957 9.90474C0.11001 10.1007 -7.1796e-05 10.3664 -7.17854e-05 10.6436C-7.1796e-05 10.9207 0.11001 11.1864 0.305957 11.3824C0.501903 11.5783 0.767665 11.6884 1.04478 11.6884L22.1531 11.6875L14.3361 19.5044C14.1403 19.7003 14.0303 19.9659 14.0303 20.2429C14.0303 20.5198 14.1403 20.7854 14.3361 20.9813C14.5319 21.1771 14.7976 21.2871 15.0745 21.2871C15.3515 21.2871 15.6171 21.1771 15.8129 20.9813Z" fill="#19060F"/>
                </svg>
            </span>
        </div>
    </div>
</section>

<?php if ( have_rows( 'who_we_look_for' ) ) : ?>
    <?php while ( have_rows( 'who_we_look_for' ) ) : the_row(); ?>
        <section class="ecaLookSec">
            <div class="wrapper">
                <div class="ecaLookContent">
                    <div class="imgBox">
                        <?php $eca_look_img = get_sub_field( 'image' ); if ( ! empty( $eca_look_img ) ) : ?>
                            <img src="<?php echo esc_url( $eca_look_img['url'] ); ?>" loading="lazy" alt="<?php echo esc_attr( $eca_look_img['alt'] ); ?>" />
                        <?php else : ?>
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/images/eca-who-we-look-for.svg' ); ?>" width="520" height="476" loading="lazy" alt="<?php esc_attr_e( 'A builder working on a laptop surrounded by ideas, data and team connections', 'joulestowatts' ); ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="textBox">
                        <h3 class="manrope eyebrow"><?php echo esc_html( get_sub_field( 'sub_heading' ) ); ?></h3>
                        <?php if ( have_rows( 'items' ) ) : ?>
                            <?php $eca_item = 0; while ( have_rows( 'items' ) ) : the_row(); ?>
                                <?php if ( $eca_item > 0 ) { echo $eca_dashed; } // phpcs:ignore WordPress.Security.EscapeOutput -- static SVG. ?>
                                <div class="item">
                                    <h2 class="manrope"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h2>
                                    <p><?php echo wp_kses_post( get_sub_field( 'description' ) ); ?></p>
                                </div>
                            <?php $eca_item++; endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>

<section class="whyItSection">
    <?php if( have_rows('how_to_apply_section') ): ?>
        <?php while( have_rows('how_to_apply_section') ): the_row(); ?>
            <div class="secWrapper">
                <div class="secHeading">
                    <h3 class="manrope"><?php echo get_sub_field('sub_heading'); ?></h3>
                    <h2 class="manrope"><?php echo get_sub_field('heading'); ?></h2>
                    <p><?php echo get_sub_field('description'); ?></p>
                </div>
                <div class="cardContainer whyItSlider">
                    <?php if( have_rows('cards') ): ?>
                        <?php $counter=1; while( have_rows('cards') ): the_row(); ?>
                            <div class="card">
                                <div class="imgBox">
                                    <?php $whyitcardimg = get_sub_field('image'); if( !empty( $whyitcardimg ) ): ?>
                                        <img src="<?php echo esc_url($whyitcardimg['url']); ?>" loading="lazy" alt="<?php echo esc_attr($whyitcardimg['alt']); ?>" />
                                    <?php endif; ?>
                                </div>
                                <div class="contentBox">
                                    <h4><?php echo sprintf('%02d', $counter); ?></h4>
                                    <div class="headingContent">
                                        <h3><?php echo get_sub_field('title'); ?></h3>
                                        <div class="moreContent">
                                            <p><?php echo get_sub_field('description'); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php $counter=$counter+1; endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</section>

<?php get_footer(); ?>
