<?php /* Template Name: Enterprise Truth Diagnosis */ get_header(); ?>
<?php
$etd_arrow   = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M18.7504 15.7496V5.99958C18.7504 5.80067 18.6714 5.6099 18.5307 5.46925C18.3901 5.3286 18.1993 5.24958 18.0004 5.24958H8.25042C8.0515 5.24958 7.86074 5.3286 7.72009 5.46925C7.57943 5.6099 7.50042 5.80067 7.50042 5.99958C7.50042 6.19849 7.57943 6.38926 7.72009 6.52991C7.86074 6.67057 8.0515 6.74958 8.25042 6.74958H16.1901L5.46979 17.469C5.32906 17.6097 5.25 17.8006 5.25 17.9996C5.25 18.1986 5.32906 18.3895 5.46979 18.5302C5.61052 18.6709 5.80139 18.75 6.00042 18.75C6.19944 18.75 6.39031 18.6709 6.53104 18.5302L17.2504 7.8099V15.7496C17.2504 15.9485 17.3294 16.1393 17.4701 16.2799C17.6107 16.4206 17.8015 16.4996 18.0004 16.4996C18.1993 16.4996 18.3901 16.4206 18.5307 16.2799C18.6714 16.1393 18.7504 15.9485 18.7504 15.7496Z" fill="#19060F"/></svg>';
?>

<section class="bannerInnerSection etdBannerSec">
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
                    </div>
                    <?php $bannerimage = get_sub_field( 'banner_image' ); if ( ! empty( $bannerimage ) ) : ?>
                        <img src="<?php echo esc_url( $bannerimage['url'] ); ?>" width="<?php echo esc_attr( $bannerimage['width'] ); ?>" height="<?php echo esc_attr( $bannerimage['height'] ); ?>" loading="eager" alt="<?php echo esc_attr( $bannerimage['alt'] ); ?>" />
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

<section class="etdPathSec">
    <img src="<?php echo esc_url( get_template_directory_uri() . '/images/etd-glow.webp' ); ?>" class="etdGlowDown" alt="" loading="lazy">
    <img src="<?php echo esc_url( get_template_directory_uri() . '/images/etd-sparkle.webp' ); ?>" class="etdSparkle" alt="" loading="lazy">
    <div class="wrapper">
        <?php if ( have_rows( 'pathways' ) ) : ?>
            <?php while ( have_rows( 'pathways' ) ) : the_row(); ?>
                <div class="etdPathGrid">
                    <?php if ( have_rows( 'cards' ) ) : ?>
                        <?php while ( have_rows( 'cards' ) ) : the_row(); ?>
                            <div class="etdPathCard">
                                <div class="etdPathContent">
                                    <span class="eyebrow manrope"><?php echo esc_html( get_sub_field( 'eyebrow' ) ); ?></span>
                                    <h2 class="manrope"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2>
                                    <p><?php echo wp_kses_post( get_sub_field( 'description' ) ); ?></p>
                                    <?php if ( get_sub_field( 'cta_text' ) ) : ?>
                                        <a href="<?php echo esc_url( get_sub_field( 'cta_link' ) ); ?>" class="secondaryCTA"><span><?php echo esc_html( get_sub_field( 'cta_text' ) ); ?></span>
                                            <div class="arrowBox"><?php echo $etd_arrow; // phpcs:ignore WordPress.Security.EscapeOutput -- static SVG. ?></div>
                                        </a>
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

<?php if ( have_rows( 'hour_by_hour' ) ) : ?>
    <?php while ( have_rows( 'hour_by_hour' ) ) : the_row(); ?>
        <section class="etdHourSec">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/images/etd-topo-vertical.webp' ); ?>" class="etdHourTopo" alt="" loading="lazy">
            <div class="wrapper">
                <h2 class="manrope"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2>
            </div>
            <div class="etdTimeline" data-etd-timeline data-autoplay="3500">
                <div class="etdTimelineTrack">
                    <span class="etdTimelineLine" aria-hidden="true"></span>
                    <?php if ( have_rows( 'steps' ) ) : ?>
                        <?php $etd_step = 0; while ( have_rows( 'steps' ) ) : the_row(); ?>
                            <button type="button" class="etdTimelineItem<?php echo 0 === $etd_step ? ' is-active' : ''; ?>" data-etd-timeline-item aria-pressed="<?php echo 0 === $etd_step ? 'true' : 'false'; ?>">
                                <span class="glow" aria-hidden="true"></span>
                                <span class="imgBox">
                                    <?php $etd_hour_img = get_sub_field( 'image' ); if ( ! empty( $etd_hour_img ) ) : ?>
                                        <img src="<?php echo esc_url( $etd_hour_img['url'] ); ?>" loading="lazy" alt="<?php echo esc_attr( $etd_hour_img['alt'] ); ?>" />
                                    <?php endif; ?>
                                </span>
                                <span class="dot" aria-hidden="true"></span>
                                <span class="title manrope"><?php echo esc_html( get_sub_field( 'title' ) ); ?></span>
                                <span class="desc"><?php echo wp_kses_post( get_sub_field( 'description' ) ); ?></span>
                            </button>
                        <?php $etd_step++; endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>

<?php if ( have_rows( 'what_you_keep' ) ) : ?>
    <?php while ( have_rows( 'what_you_keep' ) ) : the_row(); ?>
        <section class="etdKeepSec">
            <div class="wrapper">
                <div class="secHeading">
                    <h2 class="manrope"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2>
                </div>
                <div class="etdKeepCards" data-toggle-group>
                    <?php if ( have_rows( 'cards' ) ) : ?>
                        <?php $etd_card = 1; while ( have_rows( 'cards' ) ) : the_row(); ?>
                            <div class="etdKeepCard" data-toggle-item>
                                <div class="imgBox">
                                    <?php $etd_keep_img = get_sub_field( 'image' ); if ( ! empty( $etd_keep_img ) ) : ?>
                                        <img src="<?php echo esc_url( $etd_keep_img['url'] ); ?>" loading="lazy" alt="<?php echo esc_attr( $etd_keep_img['alt'] ); ?>" />
                                    <?php endif; ?>
                                </div>
                                <div class="etdKeepPanel" role="button" tabindex="0" aria-expanded="false" data-toggle>
                                    <svg class="tab" viewBox="0 0 196 26" preserveAspectRatio="none" aria-hidden="true"><path class="fill" d="M0 26V24Q0 1 22 1H150Q157 1 163 4.6L196 26Z"/><path class="line" d="M0.3 26V24Q0.3 1.3 22 1.3H150Q156.8 1.3 162.8 4.9L196 25.7" fill="none"/></svg>
                                    <div class="panelBody">
                                        <span class="num manrope"><?php echo esc_html( sprintf( '%02d', $etd_card ) ); ?></span>
                                        <div class="titleBox"><h3><?php echo esc_html( get_sub_field( 'title' ) ); ?></h3></div>
                                        <p><?php echo wp_kses_post( get_sub_field( 'description' ) ); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php $etd_card++; endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>

<?php if ( have_rows( 'book_section' ) ) : ?>
    <?php while ( have_rows( 'book_section' ) ) : the_row(); ?>
        <section class="etdBookSec" id="book-the-ten-hours">
            <div class="etdLens" aria-hidden="true">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/etd-glow.webp' ); ?>" alt="" loading="lazy">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/etd-glow.webp' ); ?>" alt="" loading="lazy" class="flip">
            </div>
            <img src="<?php echo esc_url( get_template_directory_uri() . '/images/etd-waves.webp' ); ?>" class="etdBookWaves left" alt="" loading="lazy">
            <img src="<?php echo esc_url( get_template_directory_uri() . '/images/etd-waves.webp' ); ?>" class="etdBookWaves right" alt="" loading="lazy">
            <div class="wrapper">
                <div class="etdBookCard">
                    <h2 class="manrope"><?php echo esc_html( get_sub_field( 'heading' ) ); ?></h2>
                    <?php if ( get_sub_field( 'form_shortcode' ) ) : ?>
                        <div class="etdBookForm"><?php echo do_shortcode( get_sub_field( 'form_shortcode' ) ); ?></div>
                    <?php else : ?>
                        <?php $etd_weeks = array_filter( array_map( 'trim', explode( "\n", (string) get_sub_field( 'week_options' ) ) ) ); ?>
                        <form class="etdBookForm" action="#" method="post">
                            <label class="screen-reader-text" for="etd-book-name"><?php echo esc_html( get_sub_field( 'name_placeholder' ) ); ?></label>
                            <input type="text" id="etd-book-name" name="name" autocomplete="name" required placeholder="<?php echo esc_attr( get_sub_field( 'name_placeholder' ) ); ?>">
                            <label class="screen-reader-text" for="etd-book-email"><?php echo esc_html( get_sub_field( 'email_placeholder' ) ); ?></label>
                            <input type="email" id="etd-book-email" name="email" autocomplete="email" required placeholder="<?php echo esc_attr( get_sub_field( 'email_placeholder' ) ); ?>">
                            <label class="screen-reader-text" for="etd-book-company"><?php echo esc_html( get_sub_field( 'company_placeholder' ) ); ?></label>
                            <input type="text" id="etd-book-company" name="company" autocomplete="organization" placeholder="<?php echo esc_attr( get_sub_field( 'company_placeholder' ) ); ?>">
                            <?php if ( $etd_weeks ) : ?>
                                <div class="selectBox">
                                    <label class="screen-reader-text" for="etd-book-week"><?php esc_html_e( 'Preferred week', 'joulestowatts' ); ?></label>
                                    <select id="etd-book-week" name="week">
                                        <?php foreach ( $etd_weeks as $etd_week ) : ?>
                                            <option value="<?php echo esc_attr( $etd_week ); ?>"><?php echo esc_html( $etd_week ); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="chevron" aria-hidden="true"><svg width="11" height="7" viewBox="0 0 11 7" fill="none"><path d="M1 1L5.5 5.5L10 1" stroke="#19060F" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                                </div>
                            <?php endif; ?>
                            <label class="screen-reader-text" for="etd-book-unit"><?php echo esc_html( get_sub_field( 'business_unit_placeholder' ) ); ?></label>
                            <input type="text" id="etd-book-unit" name="business_unit" placeholder="<?php echo esc_attr( get_sub_field( 'business_unit_placeholder' ) ); ?>">
                            <button type="submit" class="primaryCTA"><span><?php echo esc_html( get_sub_field( 'cta_text' ) ); ?></span>
                                <div class="arrowBox"><?php echo $etd_arrow; // phpcs:ignore WordPress.Security.EscapeOutput -- static SVG. ?></div>
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
