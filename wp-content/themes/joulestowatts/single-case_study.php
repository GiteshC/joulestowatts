<?php
/**
 * A single customer impact story (case_study post type).
 *
 * @package joulestowatts
 */

get_header();

while ( have_posts() ) :
	the_post();

	$story_id = get_the_ID();
	$banner   = get_field( 'banner_section' ) ?: array();
	$card     = get_field( 'card' ) ?: array();
	$facts    = get_field( 'facts' ) ?: array();
	$problem  = get_field( 'problem_section' ) ?: array();
	$impact   = get_field( 'impact_section' ) ?: array();
	$solution = get_field( 'solution_section' ) ?: array();
	$involved = get_field( 'involved_section' ) ?: array();
	$complex  = get_field( 'complexity_section' ) ?: array();
	$lessons  = get_field( 'lessons_section' ) ?: array();
	$explore  = get_field( 'impact_stories' ) ?: array();
	$partner  = get_field( 'talk_to_partner' ) ?: array();

	$heading     = ! empty( $banner['heading'] ) ? $banner['heading'] : esc_html( get_the_title() );
	$sub_heading = ! empty( $banner['sub_heading'] ) ? $banner['sub_heading'] : ( $card['story_tag'] ?? '' );
	$description = ! empty( $banner['description'] ) ? $banner['description'] : ( $card['summary'] ?? '' );

	// Fact boxes in the hero card, in design order (two columns).
	$fact_boxes = array(
		array( $facts['impact_label'] ?? '', 'Impact On', $facts['impact'] ?? '' ),
		array( $facts['nature_label'] ?? '', 'Nature of solution', $facts['nature'] ?? '' ),
		array( $facts['complexity_label'] ?? '', 'Complexity', $facts['complexity'] ?? '', 'rating' ),
		array( $facts['engagement_label'] ?? '', 'Engagement length', $facts['engagement'] ?? '' ),
		array( $facts['stakeholders_label'] ?? '', 'Stakeholders', $facts['stakeholders'] ?? '' ),
		array( $facts['band_label'] ?? '', 'On the band', $facts['band'] ?? '', 'band' ),
	);
	$has_facts = (bool) array_filter( array_column( $fact_boxes, 2 ) );

	// Content blocks with their navigation labels; empty blocks are left out.
	$blocks = array(
		'cs-problem'    => array( $problem, 'The business problem', ! empty( $problem['description'] ) ),
		'cs-impact'     => array( $impact, 'Where the impact landed', ! empty( $impact['description'] ) || ! empty( $impact['cards'] ) ),
		'cs-solution'   => array( $solution, 'Nature of the solution', ! empty( $solution['description'] ) || ! empty( $solution['tags'] ) ),
		'cs-involved'   => array( $involved, 'Who was involved', ! empty( $involved['people'] ) ),
		'cs-complexity' => array( $complex, 'Complexity', ! empty( $complex['description'] ) ),
		'cs-lessons'    => array( $lessons, 'Key lessons', ! empty( $lessons['lessons'] ) ),
	);
	$blocks = array_filter( $blocks, function ( $block ) { return $block[2]; } );

	$partner_heading = ! empty( $partner['heading'] ) ? $partner['heading'] : 'Start the same way this one started.';
	$partner_nav     = ! empty( $partner['nav_label'] ) ? $partner['nav_label'] : 'Start the same way';
	$others          = joulestowatts_case_study_posts( $story_id );
	?>

<section class="csDetailHero">
    <div class="wrapper">
        <div class="csHeroText">
            <?php if ( $sub_heading ) : ?>
                <h4 class="manrope"><?php echo esc_html( $sub_heading ); ?></h4>
            <?php endif; ?>
            <h1 class="manrope"><?php echo wp_kses_post( $heading ); ?></h1>
            <?php if ( $description ) : ?>
                <p><?php echo esc_html( $description ); ?></p>
            <?php endif; ?>
        </div>
        <?php if ( $has_facts ) : ?>
            <div class="csFacts">
                <?php foreach ( $fact_boxes as $box ) :
                    if ( '' === (string) $box[2] ) {
                        echo '<div class="csFact"></div>';
                        continue;
                    }
                    ?>
                    <div class="csFact">
                        <span class="label manrope"><?php echo esc_html( $box[0] ?: $box[1] ); ?></span>
                        <p class="manrope"><?php echo wp_kses_post( $box[2] ); ?></p>
                        <?php if ( 'rating' === ( $box[3] ?? '' ) && '' !== (string) ( $facts['complexity_rating'] ?? '' ) ) :
                            $rating = max( 0, min( 5, (float) $facts['complexity_rating'] ) );
                            ?>
                            <span class="csRating" role="img" aria-label="<?php echo esc_attr( sprintf( '%s out of 5', $rating ) ); ?>">
                                <?php for ( $i = 1; $i <= 5; $i++ ) :
                                    $state = $rating >= $i ? 'is-full' : ( $rating > $i - 1 ? 'is-half' : '' );
                                    ?>
                                    <span class="<?php echo esc_attr( $state ); ?>"></span>
                                <?php endfor; ?>
                            </span>
                        <?php endif; ?>
                        <?php if ( 'band' === ( $box[3] ?? '' ) ) :
                            $position = max( 0, min( 100, (float) ( $facts['band_position'] ?? 50 ) ) );
                            ?>
                            <span class="csBand" aria-hidden="true"><span class="dot" style="left: <?php echo esc_attr( $position ); ?>%;"></span></span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="csHeroLines" aria-hidden="true">
        <img src="<?php echo get_template_directory_uri(); ?>/images/case-study-detail-hero-lines.webp" alt="" loading="eager">
    </div>
    <div class="csHeroGlow" aria-hidden="true">
        <img src="<?php echo get_template_directory_uri(); ?>/images/case-study-detail-glow.webp" alt="" loading="eager">
    </div>
</section>

<?php if ( $blocks ) : ?>
<section class="csDetailBody">
    <div class="wrapper">
        <nav class="csToc" aria-label="On this page" data-case-toc>
            <ul>
                <?php foreach ( $blocks as $id => $block ) : ?>
                    <li><a href="#<?php echo esc_attr( $id ); ?>"><?php echo esc_html( ! empty( $block[0]['nav_label'] ) ? $block[0]['nav_label'] : $block[1] ); ?></a></li>
                <?php endforeach; ?>
                <li><a href="#cs-start"><?php echo esc_html( $partner_nav ); ?></a></li>
            </ul>
        </nav>
        <div class="csContent">
            <?php if ( isset( $blocks['cs-problem'] ) ) : ?>
                <div class="csBlock" id="cs-problem">
                    <h2 class="csBlockTitle"><?php echo esc_html( $problem['heading'] ?? '' ); ?></h2>
                    <p><?php echo esc_html( $problem['description'] ); ?></p>
                </div>
            <?php endif; ?>

            <?php if ( isset( $blocks['cs-impact'] ) ) : ?>
                <div class="csBlock" id="cs-impact">
                    <h2 class="csBlockTitle"><?php echo esc_html( $impact['heading'] ?? '' ); ?></h2>
                    <?php if ( ! empty( $impact['description'] ) ) : ?>
                        <p><?php echo esc_html( $impact['description'] ); ?></p>
                    <?php endif; ?>
                    <?php if ( ! empty( $impact['cards'] ) ) : ?>
                        <div class="csImpactCards">
                            <?php foreach ( $impact['cards'] as $impact_card ) : ?>
                                <div class="csImpactCard">
                                    <span class="label manrope"><?php echo esc_html( $impact_card['label'] ); ?></span>
                                    <h3 class="manrope"><?php echo esc_html( $impact_card['value'] ); ?></h3>
                                    <p class="manrope"><?php echo esc_html( $impact_card['description'] ); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ( isset( $blocks['cs-solution'] ) ) : ?>
                <div class="csBlock" id="cs-solution">
                    <h2 class="csBlockTitle"><?php echo esc_html( $solution['heading'] ?? '' ); ?></h2>
                    <?php if ( ! empty( $solution['tags'] ) ) : ?>
                        <ul class="csTags manrope">
                            <?php foreach ( $solution['tags'] as $tag ) : ?>
                                <li><?php echo esc_html( $tag['label'] ); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <?php if ( ! empty( $solution['description'] ) ) : ?>
                        <p><?php echo esc_html( $solution['description'] ); ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ( isset( $blocks['cs-involved'] ) ) : ?>
                <div class="csBlock" id="cs-involved">
                    <h2 class="csBlockTitle"><?php echo esc_html( $involved['heading'] ?? '' ); ?></h2>
                    <div class="csPeople">
                        <?php foreach ( $involved['people'] as $person ) : ?>
                            <div class="csPerson">
                                <h3 class="manrope csDotTitle"><?php echo esc_html( $person['role'] ); ?></h3>
                                <p class="manrope"><?php echo esc_html( $person['who'] ); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ( isset( $blocks['cs-complexity'] ) ) : ?>
                <div class="csBlock" id="cs-complexity">
                    <h2 class="csBlockTitle"><?php echo esc_html( $complex['heading'] ?? '' ); ?></h2>
                    <p><?php echo esc_html( $complex['description'] ); ?></p>
                </div>
            <?php endif; ?>

            <?php if ( isset( $blocks['cs-lessons'] ) ) : ?>
                <div class="csBlock" id="cs-lessons">
                    <h2 class="csBlockTitle"><?php echo esc_html( $lessons['heading'] ?? '' ); ?></h2>
                    <div class="csLessons">
                        <?php foreach ( $lessons['lessons'] as $lesson ) : ?>
                            <div class="csLesson">
                                <h3 class="manrope csDotTitle"><?php echo esc_html( $lesson['title'] ); ?></h3>
                                <p><?php echo esc_html( $lesson['description'] ); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="csContourLines" aria-hidden="true">
        <img src="<?php echo get_template_directory_uri(); ?>/images/case-study-detail-contour-lines.webp" alt="" loading="lazy">
    </div>
</section>
<?php endif; ?>

<?php if ( $others ) : ?>
<section class="resultSection platformResultSec impactStoriesSec csExploreSec">
    <div class="secWrapper">
        <div class="secHeading ">
            <div class="headingGroup">
                <h2 class="manrope"><?php echo esc_html( ! empty( $explore['heading'] ) ? $explore['heading'] : 'Explore Customer Impact Stories' ); ?></h2>
            </div>
        </div>
        <div class="resultsCardLayout">
            <div class="resultCardSlider platformResultSlider">
                <?php foreach ( $others as $other ) :
                    $other_card = get_field( 'card', $other->ID ) ?: array();
                    ?>
                    <a href="<?php echo esc_url( get_permalink( $other ) ); ?>">
                        <div class="box">
                            <?php if ( ! empty( $other_card['story_tag'] ) ) : ?>
                                <span class="tag manrope"><?php echo esc_html( $other_card['story_tag'] ); ?></span>
                            <?php endif; ?>
                            <div class="bottomContent">
                                <h3 class="manrope"><?php echo esc_html( get_the_title( $other ) ); ?></h3>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
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
</section>
<?php endif; ?>

<section class="talkToPartnerSec csStartSec" id="cs-start">
    <div class="secWrapper">
        <div class="imgBox">
            <img src="<?php bloginfo('template_directory');?>/images/talk-to-partner-bg.webp" alt="" class="desktopBg">
            <img src="<?php bloginfo('template_directory');?>/images/talk-to-partner-bg-mbl.webp" alt="" class="mblBg">
        </div>
        <div class="secHeading">
            <h2 class="manrope"><?php echo esc_html( $partner_heading ); ?></h2>
            <?php if ( ! empty( $partner['description'] ) ) : ?>
                <p><?php echo esc_html( $partner['description'] ); ?></p>
            <?php endif; ?>
            <?php if ( ! empty( $partner['cta_text'] ) ) : ?>
                <a href="<?php echo esc_url( ! empty( $partner['cta_link'] ) ? $partner['cta_link'] : home_url( '/contact-us/' ) ); ?>" class="primaryCTA"><span><?php echo esc_html( $partner['cta_text'] ); ?></span>
                    <div class="arrowBox">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M18.7504 15.7496V5.99958C18.7504 5.80067 18.6714 5.6099 18.5307 5.46925C18.3901 5.3286 18.1993 5.24958 18.0004 5.24958H8.25042C8.0515 5.24958 7.86074 5.3286 7.72009 5.46925C7.57943 5.6099 7.50042 5.80067 7.50042 5.99958C7.50042 6.19849 7.57943 6.38926 7.72009 6.52991C7.86074 6.67057 8.0515 6.74958 8.25042 6.74958H16.1901L5.46979 17.469C5.32906 17.6097 5.25 17.8006 5.25 17.9996C5.25 18.1986 5.32906 18.3895 5.46979 18.5302C5.61052 18.6709 5.80139 18.75 6.00042 18.75C6.19944 18.75 6.39031 18.6709 6.53104 18.5302L17.2504 7.8099V15.7496C17.2504 15.9485 17.3294 16.1393 17.4701 16.2799C17.6107 16.4206 17.8015 16.4996 18.0004 16.4996C18.1993 16.4996 18.3901 16.4206 18.5307 16.2799C18.6714 16.1393 18.7504 15.9485 18.7504 15.7496Z" fill="#19060F"/>
                        </svg>
                    </div>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
endwhile;

get_footer();
