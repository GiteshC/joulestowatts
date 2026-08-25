( function () {
	'use strict';

	document.addEventListener( 'DOMContentLoaded', function () {
		var section = document.querySelector( '.enterpriseSection' );

		if ( ! section ) {
			return;
		}

		// GSAP + ScrollTrigger are expected to be loaded already (enqueued
		// in header.php, before this script runs in the footer).
		if ( typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined' ) {
			// Fail safe: if GSAP didn't load for any reason, don't leave
			// the section stuck invisible.
			return;
		}

		gsap.registerPlugin( ScrollTrigger );

		var reduceMotion = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
		var globe = section.querySelector( '.globeEffect' );
		var content = section.querySelector( '.enterpriseContent' );

		if ( reduceMotion || ! globe || ! content ) {
			return;
		}

		gsap.timeline( {
			scrollTrigger: {
				trigger: section,
				start: 'top 80%',
				toggleActions: 'restart none restart none',
			},
		} )
			.fromTo( globe,
				{ opacity: 0, y: 150 },
				{ opacity: 1, y: 0, duration: 0.9, ease: 'power2.out' }
			)
			.fromTo( content,
				{ opacity: 0, y: 150 },
				{ opacity: 1, y: 0, duration: 0.9, ease: 'power2.out' },
				'-=0.75'
			);
	} );
} )();