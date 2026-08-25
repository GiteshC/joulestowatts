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
				<h2 class="roboto-mono">The future belongs to those who scale without losing their truth
					<svg xmlns="http://www.w3.org/2000/svg" width="12" height="16" class="headingIcon" viewBox="0 0 12 16" fill="none">
						<path d="M0 15.7028V11.0988H3.69961V8.30356H0V3.78182H3.69961V0H8.30356V3.78182H12.0032V8.30356H8.30356V11.0988H12.0032V15.7028H7.48143V11.921H4.52174V15.7028H0Z" fill="#CC2033"/>
					</svg>
				</h2>
				<a href="#" class="primaryBlackCTA roboto-mono "><span>Talk to a Partner</span>
					<div class="peelBox"></div>
					<div class="hoverBox"></div>
				</a>
			</div>
			<div class="footerLinks">
				<div class="linkBoxes">
					<div class="column">
						<p class="roboto-mono">Company</p>
						<div class="links">
							<a href="http://" target="_blank" rel="noopener noreferrer">
								<div class="linkGroup">
									<div class="text-default">About</div>
									<div class="text-hover">About</div>
								</div>
							</a>
							<a href="http://" target="_blank" rel="noopener noreferrer">
								<div class="linkGroup">
									<div class="text-default">Leadership</div>
									<div class="text-hover">Leadership</div>
								</div>
							</a>
							<a href="http://" target="_blank" rel="noopener noreferrer">
								<div class="linkGroup">
									<div class="text-default">Careers</div>
									<div class="text-hover">Careers</div>
								</div>
							</a>
							<a href="http://" target="_blank" rel="noopener noreferrer">
								<div class="linkGroup">
									<div class="text-default">Press</div>
									<div class="text-hover">Press</div>
								</div>
							</a>
						</div>
					</div>
					<div class="column">
						<p class="roboto-mono">What we do</p>
						<div class="links">
							<a href="http://" target="_blank" rel="noopener noreferrer">
								<div class="linkGroup">
									<div class="text-default" >Workforce Solutions</div>
									<div class="text-hover">Workforce Solutions</div>
								</div>
							</a>
							<a href="http://" target="_blank" rel="noopener noreferrer">
								<div class="linkGroup">
									<div class="text-default" >AI-First Pods</div>
									<div class="text-hover">AI-First Pods</div>
								</div>
							</a>
							<a href="http://" target="_blank" rel="noopener noreferrer">
								<div class="linkGroup">
									<div class="text-default" >Managed Services</div>
									<div class="text-hover">Managed Services</div>
								</div>
							</a>
							<a href="http://" target="_blank" rel="noopener noreferrer">
								<div class="linkGroup">
									<div class="text-default" >AI Atlas</div>
									<div class="text-hover">AI Atlas</div>
								</div>
							</a>
						</div>
					</div>
					<div class="column">
						<p class="roboto-mono">Who we serve</p>
						<div class="links">
							<a href="http://" target="_blank" rel="noopener noreferrer">
								<div class="linkGroup">
									<div class="text-default">Leadership</div>
									<div class="text-hover">Leadership</div>
								</div>
							</a>
							<a href="http://" target="_blank" rel="noopener noreferrer">
								<div class="linkGroup">
									<div class="text-default">Enterprises</div>
									<div class="text-hover">Enterprises</div>
								</div>
							</a>
							<a href="http://" target="_blank" rel="noopener noreferrer">
								<div class="linkGroup">
									<div class="text-default">Investors</div>
									<div class="text-hover">Investors</div>
								</div>
							</a>
							<a href="http://" target="_blank" rel="noopener noreferrer">
								<div class="linkGroup">
									<div class="text-default">Engineers</div>
									<div class="text-hover">Engineers</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="footerlogo">
				<div class="mailBox">
					<p>ISO 9001:2015 · CMMI Certified · Women-Owned · © JoulestoWatts 2026</p>
					<a href="mailto:hello@joulestowatts.com">hello@joulestowatts.com</a>
				</div>
				<div class="logoBox">
					<img src="<?php bloginfo('template_directory'); ?>/images/footer-logo.png" alt="">
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
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/slick.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/custom.js"></script>

<?php wp_footer(); ?>

</body>
</html>
