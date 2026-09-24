gsap.registerPlugin(ScrollTrigger);

ScrollTrigger.create({
    start: function () {
        return window.innerHeight * 0.2;
    },
    onEnter: () => {
        document.querySelector("header").classList.add("scrolled");
    },
    onLeaveBack: () => {
        document.querySelector("header").classList.remove("scrolled");
    }
});

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

// What We Do — each content box slides in from the right edge of the screen.
( function () {
	'use strict';
	document.addEventListener( 'DOMContentLoaded', function () {
		var section = document.querySelector( '.whatwedoSection' );
		if ( ! section || typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined' ) {
			return;
		}
		var boxes = section.querySelectorAll( '.contentBox' );
		if ( ! boxes.length ) {
			return;
		}
		var reduceMotion = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
		if ( reduceMotion ) {
			return;
		}
		boxes.forEach( function ( box ) {
			gsap.fromTo( box,
				{ opacity: 0, x: '100vw' },
				{
					opacity: 1,
					x: 0,
					duration: 1.5,
					delay: 0.5,
					ease: 'power2.out',
					scrollTrigger: {
						trigger: box,
						start: 'top 85%',
						toggleActions: 'restart none restart none',
					},
				}
			);
		} );
	} );
} )();

// Counter section — each number animates from 0 up to its target value
// once it scrolls into view.
( function () {
	'use strict';
	document.addEventListener( 'DOMContentLoaded', function () {
		var counters = document.querySelectorAll( '.counterSection .counterBox h4' );
		if ( ! counters.length || typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined' ) {
			return;
		}
		var reduceMotion = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
		counters.forEach( function ( counter ) {
			// Numbers may contain commas (e.g. "5,500") — strip them to get
			// the numeric target, keep the original for comma formatting.
			var target = parseInt( counter.textContent.replace( /,/g, '' ), 10 );
			if ( isNaN( target ) ) {
				return;
			}
			if ( reduceMotion ) {
				counter.textContent = target.toLocaleString( 'en-US' );
				return;
			}
			var counterObj = { value: 0 };
			gsap.to( counterObj, {
				value: target,
				duration: 1.6,
				delay: 0.3,
				ease: 'power1.out',
				onUpdate: function () {
					counter.textContent = Math.round( counterObj.value ).toLocaleString( 'en-US' );
				},
				scrollTrigger: {
					trigger: counter.closest( '.counterBox' ),
					start: 'top 85%',
					toggleActions: 'restart none restart none',
				},
			} );
		} );
	} );
} )();

// Compounds section — trigger the SVG's inline CSS animations
( function () {
	'use strict';
	document.addEventListener( 'DOMContentLoaded', function () {
		var section = document.querySelector( '.compoundsSection' );
		if ( ! section || typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined' ) {
			return;
		}
		ScrollTrigger.create( {
			trigger: section,
			start: 'top 30%',
			once: true,
			onEnter: function () {
				section.classList.add( 'in-view' );
			},
		} );
	} );
} )();