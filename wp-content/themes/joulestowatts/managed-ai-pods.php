<?php /* Template Name: Managed-ai-pods */ get_header(); ?>

<section class="bannerInnerSection">
    <div class="wrapper">
        <?php if( have_rows('banner_section') ): ?>
            <?php while( have_rows('banner_section') ): the_row(); ?>
                <div class="bannerContent">
                    <div class="bannerHeading">
                        <h1 class="manrope"><?php echo get_sub_field('heading'); ?></h1>
                        <p><?php echo get_sub_field('description'); ?></p>
                    </div>
                    <?php $bannerimage = get_sub_field('banner_image'); if( !empty( $bannerimage ) ): ?>
                        <img src="<?php echo esc_url($bannerimage['url']); ?>" loading="eager" alt="<?php echo esc_attr($bannerimage['alt']); ?>" />
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>

<section class="introSection">
    <div class="mpodsLens" aria-hidden="true">
        <img src="<?php echo esc_url( get_template_directory_uri() . '/images/mpods-lens-glow.webp' ); ?>" alt="" loading="eager">
    </div>
    <div class="wrapper">
        <div class="introContent">
            <?php if( have_rows('intro_section') ): ?>
                <?php while( have_rows('intro_section') ): the_row(); ?>
                    <div class="secHeading">
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

<section class="whatgetSection">
    <div class="wrapper">
        <?php if( have_rows('what_you_get_section') ): ?>
            <?php while( have_rows('what_you_get_section') ): the_row(); ?>
                <div class="secHeading">
                    <h2 class="manrope"><?php echo get_sub_field('heading'); ?></h2>
                </div>
                <div class="whatgetContent">
                    <?php if( have_rows('what_you_get_content') ): ?>
                        <?php while( have_rows('what_you_get_content') ): the_row(); ?>
                            <div class="whatgetBox">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/whatgetbg.webp" class="whatgetbg">
                                <?php $whatgetimg = get_sub_field('card_image'); if( !empty( $whatgetimg ) ): ?>
                                    <img src="<?php echo esc_url($whatgetimg['url']); ?>" loading="lazy" class="iconImg" alt="<?php echo esc_attr($whatgetimg['alt']); ?>" />
                                <?php endif; ?>
                                <h3 class="manrope"><?php echo get_sub_field('card_heading'); ?></h3>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>

<section class="howrunSection">
    <div class="wrapper">
        <?php if( have_rows('how_it_runs') ): ?>
            <?php while( have_rows('how_it_runs') ): the_row(); ?>
                <div class="howrunContent">
                    <div class="howrunImg">
                        <?php $howrunimg = get_sub_field('section_image'); if( !empty( $howrunimg ) ): ?>
                            <img src="<?php echo esc_url($howrunimg['url']); ?>" loading="lazy" alt="<?php echo esc_attr($howrunimg['alt']); ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="secHeading">
                        <h2 class="manrope"><?php echo get_sub_field('heading'); ?></h2>
                        <svg class="lineanim" width="669" height="25" viewBox="0 0 669 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g filter="url(#filter0_n_1219_1907)">
                                <path d="M0 12.0625H1.9917M669 12.0625H667.009M663.027 12.0625H659.045M655.062 12.0625L651.08 12.0625M647.098 12.0625H643.116M639.134 12.0625H635.152M631.17 12.0625H627.187M623.205 12.0625H619.223M615.241 12.0625H611.259M607.277 12.0625H603.295M599.313 12.0625L595.33 12.0625M591.348 12.0625H587.366M583.384 12.0625H579.402M575.42 12.0625H571.438M567.455 12.0625H563.473M559.491 12.0625H555.509M551.527 12.0625H547.545M543.563 12.0625H539.58M535.598 12.0625H531.616M527.634 12.0625H523.652M519.67 12.0625H515.688M511.705 12.0625L507.723 12.0625M503.741 12.0625H499.759M495.777 12.0625H491.795M487.812 12.0625H483.83M479.848 12.0625H475.866M471.884 12.0625H467.902M463.92 12.0625H459.937M455.955 12.0625H451.973M447.991 12.0625H444.009M440.027 12.0625H436.045M432.062 12.0625H428.08M424.098 12.0625L420.116 12.0625M416.134 12.0625H412.152M408.17 12.0625H404.187M400.205 12.0625H396.223M392.241 12.0625H388.259M384.277 12.0625H380.295M376.312 12.0625H372.33M368.348 12.0625L364.366 12.0625M360.384 12.0625H356.402M352.419 12.0625H348.437M344.455 12.0625H340.473M336.491 12.0625L332.509 12.0625M328.527 12.0625H324.544M320.562 12.0625H316.58M312.598 12.0625H308.616M304.634 12.0625H300.652M296.669 12.0625H292.687M288.705 12.0625H284.723M280.741 12.0625L276.759 12.0625M272.777 12.0625H268.794M264.812 12.0625H260.83M256.848 12.0625H252.866M248.884 12.0625L244.902 12.0625M240.919 12.0625H236.937M232.955 12.0625H228.973M224.991 12.0625H221.009M217.026 12.0625H213.044M209.062 12.0625H205.08M201.098 12.0625H197.116M193.134 12.0625L189.151 12.0625M185.169 12.0625H181.187M177.205 12.0625H173.223M169.241 12.0625H165.259M161.276 12.0625H157.294M153.312 12.0625H149.33M145.348 12.0625H141.366M137.384 12.0625H133.402M129.419 12.0625H125.437M121.455 12.0625H117.473M113.491 12.0625H109.509M105.527 12.0625L101.545 12.0625M97.5625 12.0625H93.5804M89.5983 12.0625H85.6161M81.634 12.0625H77.6519M73.6698 12.0625H69.6877M65.7056 12.0625H61.7235M57.7413 12.0625H53.7592M49.7771 12.0625H45.795M41.8129 12.0625H37.8307M33.8486 12.0625H29.8665M25.8844 12.0625H21.9023M17.9202 12.0625L13.938 12.0625M9.95592 12.0625H5.97383" stroke-width="3" stroke="url(#paint0_linear_1219_1907)"/>
                            </g>
                            <defs>
                                <filter id="filter0_n_1219_1907" x="0" y="10.5625" width="669" height="3" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"/>
                                <feTurbulence type="fractalNoise" baseFrequency="0.24390244483947754 0.24390244483947754" stitchTiles="stitch" numOctaves="3" result="noise" seed="4392" />
                                <feColorMatrix in="noise" type="luminanceToAlpha" result="alphaNoise" />
                                <feComponentTransfer in="alphaNoise" result="coloredNoise1">
                                <feFuncA type="discrete" tableValues="1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 1 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 "/>
                                </feComponentTransfer>
                                <feComposite operator="in" in2="shape" in="coloredNoise1" result="noise1Clipped" />
                                <feFlood flood-color="rgba(0, 240, 255, 0.8)" result="color1Flood" />
                                <feComposite operator="in" in2="noise1Clipped" in="color1Flood" result="color1" />
                                <feMerge result="effect1_noise_1219_1907">
                                <feMergeNode in="shape" />
                                <feMergeNode in="color1" />
                                </feMerge>
                                </filter>
                                <linearGradient id="paint0_linear_1219_1907" x1="864.278" y1="12.0625" x2="-143.666" y2="12.0625" gradientUnits="userSpaceOnUse">
                                    <stop offset="0.0192308" stop-color="#420730" stop-opacity="0"/>
                                    <stop offset="0.569714" stop-color="#1A9BA4"/>
                                    <stop offset="1" stop-color="#420730" stop-opacity="0"/>
                                </linearGradient>
                            </defs>
                        </svg>
                        <?php echo get_sub_field('description'); ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
    <div class="howrunbg">
        <img src="<?php echo get_template_directory_uri(); ?>/images/curved-linebg.webp" loading="lazy">
    </div>
</section>

<section class="mpodsTeamSec">
    <div class="wrapper">
        <?php if( have_rows('team_section') ): ?>
            <?php while( have_rows('team_section') ): the_row(); ?>
                <div class="secHeading">
                    <h2 class="manrope"><?php echo esc_html( get_sub_field('heading') ); ?></h2>
                    <p><?php echo esc_html( get_sub_field('description') ); ?></p>
                </div>
                <div class="mpodsTeamGrid">
                    <?php if( have_rows('team_members') ): $teamcard = 0; ?>
                        <?php while( have_rows('team_members') ): the_row(); $teamcard++; ?>
                            <div class="mpodsTeamCard">
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/mpods-team-card-' . ( ( ( $teamcard - 1 ) % 3 ) + 1 ) . '.webp' ); ?>" class="mpodsTeamTexture" alt="" loading="lazy">
                                <span class="tag manrope"><?php echo esc_html( get_sub_field('tag') ); ?></span>
                                <div class="mpodsTeamBottom">
                                    <p class="quote"><?php echo esc_html( get_sub_field('quote') ); ?></p>
                                    <div class="person">
                                        <?php $teamphoto = get_sub_field('photo'); if( !empty( $teamphoto ) ): ?>
                                            <img src="<?php echo esc_url($teamphoto['url']); ?>" loading="lazy" alt="<?php echo esc_attr($teamphoto['alt']); ?>" />
                                        <?php endif; ?>
                                        <div class="personText">
                                            <h3><?php echo esc_html( get_sub_field('name') ); ?></h3>
                                            <span><?php echo esc_html( get_sub_field('role') ); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>

<section class="resultSection platformResultSec mpodsImpactSec">
    <div class="secWrapper">
        <?php if( have_rows('use_cases') ): ?>
            <?php while( have_rows('use_cases') ): the_row(); ?>
                <div class="secHeading ">
                    <div class="headingGroup">
                        <h2 class="manrope"><?php echo esc_html( get_sub_field('heading') ); ?></h2>
                    </div>
                    <?php if( get_sub_field('cta_text') ): ?>
                        <a href="<?php echo esc_url( get_sub_field('cta_link') ); ?>" class="primaryCTA"><span><?php echo esc_html( get_sub_field('cta_text') ); ?></span>
                            <div class="arrowBox">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M18.7504 15.7496V5.99958C18.7504 5.80067 18.6714 5.6099 18.5307 5.46925C18.3901 5.3286 18.1993 5.24958 18.0004 5.24958H8.25042C8.0515 5.24958 7.86074 5.3286 7.72009 5.46925C7.57943 5.6099 7.50042 5.80067 7.50042 5.99958C7.50042 6.19849 7.57943 6.38926 7.72009 6.52991C7.86074 6.67057 8.0515 6.74958 8.25042 6.74958H16.1901L5.46979 17.469C5.32906 17.6097 5.25 17.8006 5.25 17.9996C5.25 18.1986 5.32906 18.3895 5.46979 18.5302C5.61052 18.6709 5.80139 18.75 6.00042 18.75C6.19944 18.75 6.39031 18.6709 6.53104 18.5302L17.2504 7.8099V15.7496C17.2504 15.9485 17.3294 16.1393 17.4701 16.2799C17.6107 16.4206 17.8015 16.4996 18.0004 16.4996C18.1993 16.4996 18.3901 16.4206 18.5307 16.2799C18.6714 16.1393 18.7504 15.9485 18.7504 15.7496Z" fill="#19060F"/>
                                </svg>
                            </div>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="resultsCardLayout">
                    <div class="resultCardSlider platformResultSlider">
                        <?php if( have_rows('use_cases_content') ): ?>
                            <?php while( have_rows('use_cases_content') ): the_row(); $cardlink = get_sub_field('card_link'); ?>
                                <a <?php if( $cardlink ): ?>href="<?php echo esc_url( $cardlink ); ?>"<?php else: ?>tabindex="0" role="button"<?php endif; ?>>
                                    <div class="box">
                                        <span class="tag manrope"><?php echo esc_html( get_sub_field('card_tag') ); ?></span>
                                        <div class="bottomContent">
                                            <h3 class="manrope"><?php echo esc_html( get_sub_field('card_heading') ); ?></h3>
                                            <?php if( get_sub_field('card_description') ): ?>
                                                <div class="moreContent">
                                                    <p><?php echo esc_html( get_sub_field('card_description') ); ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </a>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                    <div class="arrowBox">
                        <span class="platformResultPrevArrow ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="22" viewBox="0 0 26 22" fill="none">
                                <path d="M9.90509 20.9813L0.305793 11.382C0.109955 11.1861 -6.67789e-05 10.9205 -6.81276e-05 10.6436C-6.67789e-05 10.3666 0.109955 10.101 0.305793 9.90515L9.90509 0.305849C10.1009 0.110011 10.3665 -1.03086e-05 10.6435 -1.0983e-05C10.9205 -1.014e-05 11.1861 0.11001 11.3819 0.305848C11.5777 0.501686 11.6878 0.7673 11.6878 1.04426C11.6878 1.32121 11.5777 1.58683 11.3819 1.78266L3.56494 9.59963L24.6732 9.59871C24.9504 9.59871 25.2161 9.70879 25.4121 9.90474C25.608 10.1007 25.7181 10.3664 25.7181 10.6436C25.7181 10.9207 25.608 11.1864 25.4121 11.3824C25.2161 11.5783 24.9504 11.6884 24.6732 11.6884L3.56494 11.6875L11.3819 19.5044C11.5777 19.7003 11.6878 19.9659 11.6878 20.2429C11.6878 20.5198 11.5777 20.7854 11.3819 20.9813C11.1861 21.1771 10.9205 21.2871 10.6435 21.2871C10.3665 21.2871 10.1009 21.1771 9.90509 20.9813Z" fill="#19060F"/>
                            </svg>
                        </span>
                        <span class="platformResultNextArrow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="22" viewBox="0 0 26 22" fill="none">
                                <path d="M15.8129 20.9813L25.4122 11.382C25.6081 11.1861 25.7181 10.9205 25.7181 10.6436C25.7181 10.3666 25.6081 10.101 25.4122 9.90515L15.8129 0.305849C15.6171 0.110011 15.3515 -1.03086e-05 15.0745 -1.0983e-05C14.7976 -1.014e-05 14.5319 0.11001 14.3361 0.305848C14.1403 0.501686 14.0303 0.7673 14.0303 1.04426C14.0303 1.32121 14.1403 1.58683 14.3361 1.78266L22.1531 9.59963L1.04478 9.59871C0.767665 9.59871 0.501903 9.70879 0.305957 9.90474C0.11001 10.1007 -7.1796e-05 10.3664 -7.17854e-05 10.6436C-7.1796e-05 10.9207 0.11001 11.1864 0.305957 11.3824C0.501903 11.5783 0.767665 11.6884 1.04478 11.6884L22.1531 11.6875L14.3361 19.5044C14.1403 19.7003 14.0303 19.9659 14.0303 20.2429C14.0303 20.5198 14.1403 20.7854 14.3361 20.9813C14.5319 21.1771 14.7976 21.2871 15.0745 21.2871C15.3515 21.2871 15.6171 21.1771 15.8129 20.9813Z" fill="#19060F"/>
                            </svg>
                        </span>
                    </div>
                </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>

<section class="talkToPartnerSec">
    <div class="mpodsLens" aria-hidden="true">
        <img src="<?php echo esc_url( get_template_directory_uri() . '/images/mpods-lens-glow.webp' ); ?>" alt="" loading="lazy">
    </div>
    <div class="secWrapper">
        <div class="imgBox">
            <img src="<?php bloginfo('template_directory');?>/images/talk-to-partner-bg.webp" alt="" class="desktopBg">
            <img src="<?php bloginfo('template_directory');?>/images/talk-to-partner-bg-mbl.webp" alt="" class="mblBg">
        </div>
        <?php if( have_rows('talk_to_partner') ): ?>
            <?php while( have_rows('talk_to_partner') ): the_row(); ?>
                <div class="secHeading">
                    <h2 class="manrope"><?php echo get_sub_field('heading'); ?></h2>
                    <p><?php echo get_sub_field('description'); ?></p>
                    <a href="<?php echo get_sub_field('cta_link'); ?>" class="primaryCTA"><span><?php echo get_sub_field('cta_text'); ?></span>
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