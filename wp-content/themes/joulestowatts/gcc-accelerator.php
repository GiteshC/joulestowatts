<?php /* Template Name: GCC Accelerator */ get_header(); ?>

<?php
// Soft teal horizon glow used behind several sections (same artwork as the other inner pages).
$gcc_glow = function () {
	?>
	<svg xmlns="http://www.w3.org/2000/svg" width="2168" height="658" viewBox="0 0 2168 658" fill="none" aria-hidden="true">
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
	</svg>
	<?php
};
?>

<section class="bannerInnerSection gccBannerSec">
    <div class="wrapper">
        <?php if( have_rows('banner_section') ): ?>
            <?php while( have_rows('banner_section') ): the_row(); ?>
                <div class="bannerContent">
                    <div class="bannerHeading">
                        <?php if( get_sub_field('sub_heading') ): ?>
                            <h4 class="manrope"><?php echo esc_html( get_sub_field('sub_heading') ); ?></h4>
                        <?php endif; ?>
                        <h1 class="manrope"><?php echo wp_kses_post( get_sub_field('heading') ); ?></h1>
                        <p><?php echo wp_kses_post( get_sub_field('description') ); ?></p>
                    </div>
                    <?php $bannerimage = get_sub_field('banner_image'); if( !empty( $bannerimage ) ): ?>
                        <img src="<?php echo esc_url($bannerimage['url']); ?>" width="550" height="450" loading="eager" alt="<?php echo esc_attr($bannerimage['alt']); ?>" />
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
    <div class="bannerBG"><?php $gcc_glow(); ?></div>
    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/gcc-horizon.webp" class="gccHorizon" alt="" loading="eager">
</section>

<section class="gccReadsSec">
    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/gcc-horizon.webp" class="gccHorizon gccHorizonDown" alt="" loading="lazy">
    <div class="wrapper">
        <?php if( have_rows('what_it_reads') ): ?>
            <?php while( have_rows('what_it_reads') ): the_row(); ?>
                <div class="mainContainer" data-accordion>
                    <?php
                    $reads       = array();
                    $first_image = null;
                    if( have_rows('reads_content') ):
                        while( have_rows('reads_content') ): the_row();
                            $img = get_sub_field('card_image');
                            if ( empty( $first_image ) && ! empty( $img ) ) {
                                $first_image = $img;
                            }
                            $reads[] = array(
                                'heading'     => get_sub_field('card_heading'),
                                'description' => get_sub_field('card_description'),
                                'image'       => $img,
                            );
                        endwhile;
                    endif;
                    ?>
                    <div class="imgBox">
                        <?php foreach( $reads as $i => $read ): $img = ! empty( $read['image'] ) ? $read['image'] : $first_image; ?>
                            <div class="readsImg<?php echo 0 === $i ? ' is-open' : ''; ?>" data-accordion-detail>
                                <?php if( !empty( $img ) ): ?>
                                    <img src="<?php echo esc_url($img['url']); ?>" loading="lazy" alt="<?php echo esc_attr($img['alt']); ?>" />
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="textBox">
                        <h3 class="manrope"><?php echo esc_html( get_sub_field('sub_heading') ); ?></h3>
                        <div class="readsList">
                            <?php foreach( $reads as $i => $read ): ?>
                                <div class="readsItem<?php echo 0 === $i ? ' is-open' : ''; ?>" data-accordion-item role="button" tabindex="0" aria-expanded="<?php echo 0 === $i ? 'true' : 'false'; ?>">
                                    <h2 class="manrope"><?php echo esc_html( $read['heading'] ); ?></h2>
                                    <?php if( $read['description'] ): ?>
                                        <div class="description">
                                            <div class="descriptionInner">
                                                <p><?php echo wp_kses_post( $read['description'] ); ?></p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/curved-linebg.webp" class="readsLinesLeft" alt="" loading="lazy">
    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/curved-linebg.webp" class="readsLinesRight" alt="" loading="lazy">
</section>

<section class="solutionSection fourArtifactsSec gccReturnsSec">
    <div class="secWrapper">
        <?php if( have_rows('what_it_returns') ): ?>
            <?php while( have_rows('what_it_returns') ): the_row(); ?>
                <div class="secHeading">
                    <h2 class="manrope"><?php echo wp_kses_post( get_sub_field('heading') ); ?></h2>
                    <?php if( get_sub_field('description') ): ?>
                        <p><?php echo wp_kses_post( get_sub_field('description') ); ?></p>
                    <?php endif; ?>
                </div>
                <div class="cardContainer" data-accordion>
                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/gcc-horizon.webp" class="gccHorizon gccHorizonDown" alt="" loading="lazy">
                    <?php if( have_rows('returns_content') ): ?>
                        <?php $counter = 1; while( have_rows('returns_content') ): the_row(); ?>
                            <div class="solutionCard<?php echo 1 === $counter ? ' is-open' : ''; ?>" data-accordion-item role="button" tabindex="0" aria-expanded="<?php echo 1 === $counter ? 'true' : 'false'; ?>">
                                <div class="imgBox">
                                    <?php $faimg = get_sub_field('card_image'); if( !empty( $faimg ) ): ?>
                                        <img src="<?php echo esc_url($faimg['url']); ?>" loading="lazy" alt="<?php echo esc_attr($faimg['alt']); ?>" />
                                    <?php endif; ?>
                                </div>
                                <div class="bottomContent">
                                    <span class="manrope num"><?php echo esc_html( sprintf( '%02d', $counter ) ); ?></span>
                                    <h3 class="manrope"><?php echo esc_html( get_sub_field('card_heading') ); ?></h3>
                                    <div class="description">
                                        <div class="descriptionInner">
                                            <?php if( get_sub_field('card_description') ): ?>
                                                <p><?php echo wp_kses_post( get_sub_field('card_description') ); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php $counter++; endwhile; ?>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
    <div class="fourArtifactsBG"><?php $gcc_glow(); ?></div>
</section>

<section class="talkToPartnerSec oneInstrumentSec">
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
                    <p><?php echo wp_kses_post( get_sub_field('description') ); ?></p>
                    <a href="<?php echo esc_url( get_sub_field('cta_link') ); ?>" class="primaryCTA"><span><?php echo esc_html( get_sub_field('cta_text') ); ?></span>
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
