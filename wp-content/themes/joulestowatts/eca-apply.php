<?php /* Template Name: ECA-Apply */ get_header(); ?>

<section class="bannerInnerSection contactBannerSec">
    <div class="wrapper">
        <div class="bannerContent">
            <div class="bannerHeading">
                <h1 class="manrope"><?php echo get_field('heading'); ?></h1>
                <p><?php echo get_field('description'); ?></p>
            </div>
            <?php
            $form_shortcode = (string) get_field('form_shortcode');
            if ( ! $form_shortcode && class_exists( 'WPCF7_ContactForm' ) ) {
                $form_post = get_page_by_path( 'talk-to-a-partner', OBJECT, 'wpcf7_contact_form' );
                $form_shortcode = $form_post ? WPCF7_ContactForm::get_instance( $form_post->ID )->shortcode() : '';
            }
            ?>
            <?php if( $form_shortcode ): ?>
                <div class="contactFormBox">
                    <?php echo do_shortcode( $form_shortcode ); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="contactLines" aria-hidden="true">
        <img src="<?php echo get_template_directory_uri(); ?>/images/contact-lines-left.webp" alt="" class="linesLeft" loading="lazy">
        <img src="<?php echo get_template_directory_uri(); ?>/images/contact-lines-right.webp" alt="" class="linesRight" loading="lazy">
    </div>
    <div class="contactGlow" aria-hidden="true">
        <img src="<?php echo get_template_directory_uri(); ?>/images/contact-hero-glow.webp" alt="" loading="eager">
    </div>
</section>

<?php get_footer(); ?>
