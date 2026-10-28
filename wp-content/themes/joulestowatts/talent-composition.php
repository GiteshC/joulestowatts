<?php /* Template Name: Talent Composition */ get_header(); ?>

<?php
// Teal lens glow used behind several sections (same shape as the other inner pages).
$glow_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="2168" height="658" viewBox="0 0 2168 658" fill="none" aria-hidden="true">
    <g filter="url(#filter0_f_952_6788)">
        <path d="M1891.15 658C1891.15 517.314 1806.12 382.39 1654.74 282.91C1503.37 183.43 1298.07 127.542 1084 127.542C869.929 127.542 664.626 183.43 513.255 282.91C361.885 382.39 276.845 517.314 276.845 658L1891.15 658Z" fill="url(#paint0_linear_952_6788)" fill-opacity="0.984314"/>
    </g>
    <defs>
        <filter id="filter0_f_952_6788" x="-123.155" y="-272.458" width="2414.31" height="1330.46" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
            <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
            <feGaussianBlur stdDeviation="200" result="effect1_foregroundBlur_952_6788"/>
        </filter>
        <linearGradient id="paint0_linear_952_6788" x1="1084" y1="658" x2="1109.13" y2="-74.7586" gradientUnits="userSpaceOnUse">
            <stop stop-color="#01D3C7"/>
            <stop offset="0.151345" stop-color="#08A8A2" stop-opacity="0.57"/>
            <stop offset="0.237738" stop-color="#0B908E" stop-opacity="0.49"/>
            <stop offset="0.320429" stop-color="#0F797A" stop-opacity="0.34"/>
            <stop offset="0.43204" stop-color="#14595F" stop-opacity="0.28"/>
            <stop offset="0.740931" stop-color="#210214" stop-opacity="0"/>
            <stop offset="1" stop-color="#210214"/>
        </linearGradient>
    </defs>
</svg>';
?>

<section class="bannerInnerSection">
    <div class="wrapper">
        <?php if( have_rows('banner_section') ): ?>
            <?php while( have_rows('banner_section') ): the_row(); ?>
                <div class="bannerContent">
                    <div class="bannerHeading">
                        <h1 class="manrope"><?php echo wp_kses_post( get_sub_field('heading') ); ?></h1>
                        <?php if( get_sub_field('description') ): ?>
                            <p><?php echo esc_html( get_sub_field('description') ); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php $bannerimage = get_sub_field('banner_image'); if( !empty( $bannerimage ) ): ?>
                        <img src="<?php echo esc_url($bannerimage['url']); ?>" loading="eager" alt="<?php echo esc_attr($bannerimage['alt']); ?>" />
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
    <div class="bannerBG"><?php echo $glow_svg; // phpcs:ignore WordPress.Security.EscapeOutput -- static markup ?></div>
</section>

<section class="solutionSection fourArtifactsSec">
    <div class="secWrapper">
        <?php if( have_rows('steps_section') ): ?>
            <?php while( have_rows('steps_section') ): the_row(); ?>
                <div class="secHeading">
                    <h2 class="manrope"><?php echo wp_kses_post( get_sub_field('heading') ); ?></h2>
                    <?php if( get_sub_field('description') ): ?>
                        <p><?php echo esc_html( get_sub_field('description') ); ?></p>
                    <?php endif; ?>
                </div>
                <div class="cardContainer" data-accordion>
                    <?php if( have_rows('steps_content') ): ?>
                        <?php $counter = 1; while( have_rows('steps_content') ): the_row(); ?>
                            <div class="solutionCard<?php echo 1 === $counter ? ' is-open' : ''; ?>" data-accordion-item role="button" tabindex="0" aria-expanded="<?php echo 1 === $counter ? 'true' : 'false'; ?>">
                                <div class="imgBox">
                                    <?php $stepimg = get_sub_field('card_image'); if( !empty( $stepimg ) ): ?>
                                        <img src="<?php echo esc_url($stepimg['url']); ?>" loading="lazy" alt="<?php echo esc_attr($stepimg['alt']); ?>" />
                                    <?php endif; ?>
                                </div>
                                <div class="bottomContent">
                                    <span class="manrope num"><?php echo esc_html( sprintf( '%02d', $counter ) ); ?></span>
                                    <h3 class="manrope"><?php echo esc_html( get_sub_field('card_heading') ); ?></h3>
                                    <div class="description">
                                        <div class="descriptionInner">
                                            <?php if( get_sub_field('card_description') ): ?>
                                                <p><?php echo esc_html( get_sub_field('card_description') ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php $counter++; endwhile; ?>
                    <?php endif; ?>
                </div>
                <?php if( get_sub_field('cta_text') ): ?>
                    <div class="casestudyCTA talentStepsCTA">
                        <a href="<?php echo esc_url( get_sub_field('cta_link') ); ?>" class="teritaryCTA"><?php echo esc_html( get_sub_field('cta_text') ); ?>
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
    <div class="fourArtifactsBG"><?php echo $glow_svg; // phpcs:ignore WordPress.Security.EscapeOutput -- static markup ?></div>
</section>

<section class="talkToPartnerSec">
    <div class="secWrapper">
        <div class="imgBox">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/talk-to-partner-bg.webp" alt="" class="desktopBg">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/talk-to-partner-bg-mbl.webp" alt="" class="mblBg">
        </div>
        <?php if( have_rows('talk_to_partner') ): ?>
            <?php while( have_rows('talk_to_partner') ): the_row(); ?>
                <div class="secHeading">
                    <?php if( get_sub_field('sub_heading') ): ?>
                        <h3 class="manrope"><?php echo esc_html( get_sub_field('sub_heading') ); ?></h3>
                    <?php endif; ?>
                    <h2 class="manrope"><?php echo wp_kses_post( get_sub_field('heading') ); ?></h2>
                    <p><?php echo esc_html( get_sub_field('description') ); ?></p>
                    <a href="<?php echo esc_url( get_sub_field('cta_link') ); ?>" class="primaryCTA"><span><?php echo esc_html( get_sub_field('cta_text') ); ?></span>
                        <div class="arrowBox">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
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
