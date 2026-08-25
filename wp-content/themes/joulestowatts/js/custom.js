gsap.registerPlugin(ScrollTrigger);

ScrollTrigger.create({
    start: "150% top",
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

// What We Do — cursor-follow image reveal, one floating image swapped/moved
// as the user hovers each .contentBox (same pattern as Agilitas's
// "Where to next / Keep moving" section).
( function () {
	'use strict';

	document.addEventListener( 'DOMContentLoaded', function () {
		var wrap = document.querySelector( '.whatwedoContent' );

		if ( ! wrap ) {
			return;
		}

		var followImage = wrap.querySelector( '.hoverFollowImage' );
		var followImgTag = followImage ? followImage.querySelector( 'img' ) : null;
		var boxes = wrap.querySelectorAll( '.contentBox' );

		if ( ! followImage || ! followImgTag || ! boxes.length ) {
			return;
		}

		var hasGsap = typeof gsap !== 'undefined';
		var moveX, moveY;

		if ( hasGsap ) {
			moveX = gsap.quickTo( followImage, 'x', { duration: 0.5, ease: 'power3' } );
			moveY = gsap.quickTo( followImage, 'y', { duration: 0.5, ease: 'power3' } );
		}

		function positionImage( e ) {
			if ( hasGsap ) {
				moveX( e.clientX );
				moveY( e.clientY );
			} else {
				followImage.style.transform = 'translate(' + e.clientX + 'px, ' + e.clientY + 'px) translate(-50%, -50%)';
			}
		}

		boxes.forEach( function ( box ) {
			var imgSrc = box.getAttribute( 'data-hover-img' );

			box.addEventListener( 'mouseenter', function ( e ) {
				if ( imgSrc ) {
					followImgTag.src = imgSrc;
				}
				followImage.classList.add( 'is-active' );
				positionImage( e );
			} );

			box.addEventListener( 'mousemove', positionImage );

			box.addEventListener( 'mouseleave', function () {
				followImage.classList.remove( 'is-active' );
			} );
		} );
	} );
} )();