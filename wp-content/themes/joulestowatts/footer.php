<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package joulestowatts
 */

?>

	<footer>
		<div class="footerWrapper">
			<div class="footerHead">
				<h2 class="manrope"><?php the_field('footer_heading','option'); ?></h2>
				<a href="<?php the_field('cta_link','option'); ?>" class="primaryCTA"><span><?php the_field('cta_text','option'); ?></span>
					<div class="arrowBox">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<path d="M18.7504 15.7496V5.99958C18.7504 5.80067 18.6714 5.6099 18.5307 5.46925C18.3901 5.3286 18.1993 5.24958 18.0004 5.24958H8.25042C8.0515 5.24958 7.86074 5.3286 7.72009 5.46925C7.57943 5.6099 7.50042 5.80067 7.50042 5.99958C7.50042 6.19849 7.57943 6.38926 7.72009 6.52991C7.86074 6.67057 8.0515 6.74958 8.25042 6.74958H16.1901L5.46979 17.469C5.32906 17.6097 5.25 17.8006 5.25 17.9996C5.25 18.1986 5.32906 18.3895 5.46979 18.5302C5.61052 18.6709 5.80139 18.75 6.00042 18.75C6.19944 18.75 6.39031 18.6709 6.53104 18.5302L17.2504 7.8099V15.7496C17.2504 15.9485 17.3294 16.1393 17.4701 16.2799C17.6107 16.4206 17.8015 16.4996 18.0004 16.4996C18.1993 16.4996 18.3901 16.4206 18.5307 16.2799C18.6714 16.1393 18.7504 15.9485 18.7504 15.7496Z" fill="#19060F"/>
						</svg>
					</div>
				</a>
			</div>
			<div class="footerLinks">
				<div class="linkBoxes">
					<div class="column">
						<div class="linkHeading">
							<h3 class="manrope"><?php the_field('menu_heading_one','option'); ?></h3>
							<span class="downIcon">
								<svg xmlns="http://www.w3.org/2000/svg" width="13" height="8" viewBox="0 0 13 8" fill="none">
									<path d="M0.884766 0.884277L6.19148 6.191L11.4982 0.884277" stroke="black" stroke-width="1.76891" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</span>
						</div>
						<?php
							wp_nav_menu( array(
								'theme_location' => 'Footer-Menu-One',
								'container'      => false,
								'items_wrap'     => '<ul class="links">%3$s</ul>',
								'fallback_cb'    => false,
							) );
						?>
					</div>
					<div class="column">
						<div class="linkHeading">
							<h3 class="manrope"><?php the_field('menu_heading_two','option'); ?></h3>
							<span class="downIcon">
								<svg xmlns="http://www.w3.org/2000/svg" width="13" height="8" viewBox="0 0 13 8" fill="none">
									<path d="M0.884766 0.884277L6.19148 6.191L11.4982 0.884277" stroke="black" stroke-width="1.76891" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</span>
						</div>
						<?php
							wp_nav_menu( array(
								'theme_location' => 'Footer-Menu-Two',
								'container'      => false,
								'items_wrap'     => '<ul class="links">%3$s</ul>',
								'fallback_cb'    => false,
							) );
						?>
					</div>
					<div class="column">
						<div class="linkHeading">
							<h3 class="manrope"><?php the_field('menu_heading_three','option'); ?></h3>
							<span class="downIcon">
								<svg xmlns="http://www.w3.org/2000/svg" width="13" height="8" viewBox="0 0 13 8" fill="none">
									<path d="M0.884766 0.884277L6.19148 6.191L11.4982 0.884277" stroke="black" stroke-width="1.76891" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</span>
						</div>
						<?php
							wp_nav_menu( array(
								'theme_location' => 'Footer-Menu-Three',
								'container'      => false,
								'items_wrap'     => '<ul class="links">%3$s</ul>',
								'fallback_cb'    => false,
							) );
						?>
					</div>
				</div>
			</div>
			<div class="footerlogo">
				<div class="mailBox">
					<p class="manrope"><?php the_field('copyright','option'); ?></p>
					<a href="mailto: <?php the_field('email_id','option'); ?>"><?php the_field('email_id','option'); ?></a>
				</div>
				<div class="logoBox">
					<?php $footerlogo = get_field('footer_logo', 'option'); if( !empty( $footerlogo ) ): ?>
						<img src="<?php echo esc_url($footerlogo['url']); ?>" loading="lazy" alt="<?php echo esc_attr($footerlogo['alt']); ?>" />
					<?php endif; ?>
				</div>
			</div>
		</div>
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/MotionPathPlugin.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.15/dist/SplitText.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vivus/0.4.6/vivus.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/slick.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/custom.js"></script>

<script>
$('button').click(function(){
  new Vivus('Layer_1', {duration: 150 });
});
</script>

<?php wp_footer(); ?>

</body>
</html>
