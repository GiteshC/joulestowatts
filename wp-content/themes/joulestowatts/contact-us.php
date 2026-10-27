<?php /* Template Name: Contact Us */ get_header(); ?>

<section class="bannerInnerSection contactBannerSec">
    <div class="wrapper">
        <?php if( have_rows('banner_section') ): ?>
            <?php while( have_rows('banner_section') ): the_row(); ?>
                <div class="bannerContent">
                    <div class="bannerHeading">
                        <?php if( get_sub_field('sub_heading') ): ?>
                            <h4 class="manrope"><?php echo esc_html( get_sub_field('sub_heading') ); ?></h4>
                        <?php endif; ?>
                        <h1 class="manrope"><?php echo wp_kses_post( get_sub_field('heading') ); ?></h1>
                        <p><?php echo esc_html( get_sub_field('description') ); ?></p>
                    </div>
                    <?php
                    $form_shortcode = (string) get_sub_field('form_shortcode');
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
            <?php endwhile; ?>
        <?php endif; ?>
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
