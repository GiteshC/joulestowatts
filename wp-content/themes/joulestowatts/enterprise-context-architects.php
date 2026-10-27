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

<section class="bannerInnerSection ecaBannerSec">
    <div class="wrapper">
        <?php if ( have_rows( 'banner_section' ) ) : ?>
            <?php while ( have_rows( 'banner_section' ) ) : the_row(); ?>
                <div class="bannerContent">
                    <div class="bannerHeading">
                        <h1 class="manrope"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h1>
                        <p><?php echo wp_kses_post( get_sub_field( 'description' ) ); ?></p>
                    </div>
                    <?php $bannerimage = get_sub_field( 'banner_image' ); ?>
                    <div class="ecaHeroDrawing">
                        <?php if ( ! empty( $bannerimage ) ) : ?>
                            <img src="<?php echo esc_url( $bannerimage['url'] ); ?>" loading="eager" alt="<?php echo esc_attr( $bannerimage['alt'] ); ?>" />
                        <?php else : ?>
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/images/eca-hero-drawing.svg' ); ?>" width="1129" height="452" loading="eager" alt="<?php esc_attr_e( 'Campus graduates and consultants moving through training and certification into enterprise client teams', 'joulestowatts' ); ?>" />
                        <?php endif; ?>
                    </div>
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

<section class="ecaTiersSec">
    <img src="<?php echo esc_url( get_template_directory_uri() . '/images/etd-glow.webp' ); ?>" class="etdGlowDown" alt="" loading="lazy">
    <img src="<?php echo esc_url( get_template_directory_uri() . '/images/etd-waves.webp' ); ?>" class="ecaTiersWaves" alt="" loading="lazy">
    <div class="wrapper">
        <?php if ( have_rows( 'what_you_get' ) ) : ?>
            <?php while ( have_rows( 'what_you_get' ) ) : the_row(); ?>
                <div class="secHeading">
                    <h2 class="manrope"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2>
                    <p><?php echo wp_kses_post( get_sub_field( 'description' ) ); ?></p>
                </div>
                <div class="ecaTiers" data-accordion data-autoplay="4000">
                    <?php if ( have_rows( 'tiers' ) ) : ?>
                        <?php $eca_tier = 0; while ( have_rows( 'tiers' ) ) : the_row(); ?>
                            <div class="ecaTier<?php echo 0 === $eca_tier ? ' is-open' : ''; ?>" data-accordion-item role="button" tabindex="0" aria-expanded="<?php echo 0 === $eca_tier ? 'true' : 'false'; ?>">
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/whatgetbg.webp' ); ?>" class="tierBg" alt="" loading="lazy">
                                <?php $eca_tier_img = get_sub_field( 'image' ); if ( ! empty( $eca_tier_img ) ) : ?>
                                    <img src="<?php echo esc_url( $eca_tier_img['url'] ); ?>" loading="lazy" class="tierImg" alt="<?php echo esc_attr( $eca_tier_img['alt'] ); ?>" />
                                <?php endif; ?>
                                <div class="tierText">
                                    <h3 class="manrope"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h3>
                                    <div class="tierDesc"><p><?php echo wp_kses_post( get_sub_field( 'description' ) ); ?></p></div>
                                </div>
                            </div>
                        <?php $eca_tier++; endwhile; ?>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>

<section class="talkToPartnerSec oneInstrumentSec ecaApplySec">
    <div class="secWrapper">
        <div class="imgBox">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/images/talk-to-partner-bg.webp' ); ?>" alt="" class="desktopBg" loading="lazy">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/images/talk-to-partner-bg-mbl.webp' ); ?>" alt="" class="mblBg" loading="lazy">
        </div>
        <?php if ( have_rows( 'apply_cta' ) ) : ?>
            <?php while ( have_rows( 'apply_cta' ) ) : the_row(); ?>
                <div class="secHeading">
                    <h3 class="manrope"><?php echo esc_html( get_sub_field( 'sub_heading' ) ); ?></h3>
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

<?php if ( have_rows( 'what_you_become' ) ) : ?>
    <?php while ( have_rows( 'what_you_become' ) ) : the_row(); ?>
        <section class="ecaBecomeSec">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/images/etd-glow.webp' ); ?>" class="etdGlowDown" alt="" loading="lazy">
            <div class="wrapper">
                <div class="secHeading">
                    <h2 class="manrope"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2>
                </div>
                <?php if ( have_rows( 'roles' ) ) : ?>
                    <?php while ( have_rows( 'roles' ) ) : the_row(); ?>
                        <div class="ecaBecomeCard">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/images/eca-become-bg.webp' ); ?>" class="cardBg" alt="" loading="lazy">
                            <?php $eca_role_img = get_sub_field( 'image' ); if ( ! empty( $eca_role_img ) ) : ?>
                                <img src="<?php echo esc_url( $eca_role_img['url'] ); ?>" class="roleImg" loading="lazy" alt="<?php echo esc_attr( $eca_role_img['alt'] ); ?>" />
                            <?php endif; ?>
                            <h3 class="manrope"><?php echo esc_html( get_sub_field( 'title' ) ); ?></h3>
                            <p><?php echo wp_kses_post( get_sub_field( 'description' ) ); ?></p>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>

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

<?php if ( have_rows( 'how_to_apply' ) ) : ?>
    <?php while ( have_rows( 'how_to_apply' ) ) : the_row(); ?>
        <section class="etdKeepSec ecaApplyStepsSec">
            <div class="wrapper">
                <div class="secHeading">
                    <h2 class="manrope"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2>
                </div>
                <div class="etdKeepCards" data-toggle-group>
                    <?php if ( have_rows( 'cards' ) ) : ?>
                        <?php $eca_card = 1; while ( have_rows( 'cards' ) ) : the_row(); ?>
                            <div class="etdKeepCard" data-toggle-item>
                                <div class="imgBox">
                                    <?php $eca_apply_img = get_sub_field( 'image' ); if ( ! empty( $eca_apply_img ) ) : ?>
                                        <img src="<?php echo esc_url( $eca_apply_img['url'] ); ?>" loading="lazy" alt="<?php echo esc_attr( $eca_apply_img['alt'] ); ?>" />
                                    <?php endif; ?>
                                </div>
                                <div class="etdKeepPanel" role="button" tabindex="0" aria-expanded="false" data-toggle>
                                    <svg class="tab" viewBox="0 0 196 26" preserveAspectRatio="none" aria-hidden="true"><path class="fill" d="M0 26V24Q0 1 22 1H150Q157 1 163 4.6L196 26Z"/><path class="line" d="M0.3 26V24Q0.3 1.3 22 1.3H150Q156.8 1.3 162.8 4.9L196 25.7" fill="none"/></svg>
                                    <div class="panelBody">
                                        <span class="num manrope"><?php echo esc_html( sprintf( '%02d', $eca_card ) ); ?></span>
                                        <div class="titleBox"><h3><?php echo esc_html( get_sub_field( 'title' ) ); ?></h3></div>
                                        <p><?php echo wp_kses_post( get_sub_field( 'description' ) ); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php $eca_card++; endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>

<?php if ( have_rows( 'hour_by_hour' ) ) : ?>
    <?php while ( have_rows( 'hour_by_hour' ) ) : the_row(); ?>
        <section class="etdHourSec ecaHourSec">
            <div class="wrapper">
                <h2 class="manrope"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2>
            </div>
            <div class="etdTimeline" data-etd-timeline data-autoplay="3500">
                <div class="etdTimelineTrack">
                    <span class="etdTimelineLine" aria-hidden="true"></span>
                    <?php if ( have_rows( 'steps' ) ) : ?>
                        <?php $eca_step = 0; while ( have_rows( 'steps' ) ) : the_row(); ?>
                            <button type="button" class="etdTimelineItem<?php echo 0 === $eca_step ? ' is-active' : ''; ?>" data-etd-timeline-item aria-pressed="<?php echo 0 === $eca_step ? 'true' : 'false'; ?>">
                                <span class="glow" aria-hidden="true"></span>
                                <span class="imgBox">
                                    <?php $eca_hour_img = get_sub_field( 'image' ); if ( ! empty( $eca_hour_img ) ) : ?>
                                        <img src="<?php echo esc_url( $eca_hour_img['url'] ); ?>" loading="lazy" alt="<?php echo esc_attr( $eca_hour_img['alt'] ); ?>" />
                                    <?php endif; ?>
                                </span>
                                <span class="dot" aria-hidden="true"></span>
                                <span class="title manrope"><?php echo esc_html( get_sub_field( 'title' ) ); ?></span>
                                <span class="desc"><?php echo wp_kses_post( get_sub_field( 'description' ) ); ?></span>
                            </button>
                        <?php $eca_step++; endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>

<?php if ( have_rows( 'residency_cta' ) ) : ?>
    <?php while ( have_rows( 'residency_cta' ) ) : the_row(); ?>
        <section class="ecaResidencySec">
            <div class="etdLens" aria-hidden="true">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/etd-glow.webp' ); ?>" alt="" loading="lazy">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/etd-glow.webp' ); ?>" alt="" loading="lazy" class="flip">
            </div>
            <img src="<?php echo esc_url( get_template_directory_uri() . '/images/etd-topo-lines.webp' ); ?>" class="ecaResidencyTopo" alt="" loading="lazy">
            <div class="wrapper">
                <div class="secHeading">
                    <h3 class="manrope"><?php echo esc_html( get_sub_field( 'sub_heading' ) ); ?></h3>
                    <h2 class="manrope"><?php echo wp_kses_post( get_sub_field( 'heading' ) ); ?></h2>
                    <a href="<?php echo esc_url( get_sub_field( 'cta_link' ) ); ?>" class="primaryCTA"><span><?php echo esc_html( get_sub_field( 'cta_text' ) ); ?></span>
                        <div class="arrowBox"><?php echo $eca_arrow; // phpcs:ignore WordPress.Security.EscapeOutput -- static SVG. ?></div>
                    </a>
                    <?php $eca_email = get_sub_field( 'email' ); ?>
                    <p class="contact">
                        <?php echo esc_html( get_sub_field( 'question_text' ) ); ?>
                        <?php if ( $eca_email ) : ?>
                            <br><a href="<?php echo esc_url( 'mailto:' . $eca_email ); ?>"><?php echo esc_html( $eca_email ); ?></a>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
