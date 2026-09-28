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

$('.resultCardSlider').slick({
	slidesToShow: 3.5,
	slidesToScroll: 1,
	autoplay: false,
	autoplaySpeed: 2500,
	infinite: false,
	arrows: true,
	prevArrow: $(".resultPrevArrow"),
	nextArrow: $(".resultNextArrow"),
	focusOnSelect: true,
});


$('.mainSliderBox').slick({
	slidesToShow: 1,
	slidesToScroll: 1,
	arrows: false,
	fade: true,
	infinite: false,
	asNavFor: '.textSlider'
});
$('.textSlider').slick({
	slidesToShow: 1,
	slidesToScroll: 1,
	arrows: true,
	prevArrow: $(".prevArrow"),
	nextArrow: $(".nextArrow"),
	asNavFor: '.mainSliderBox',
	dots: false,
	fade: true,
	infinite: false,
	centerMode: false,
	focusOnSelect: false
});

// Building section — pinned 3-card carousel driven by scroll.
( function () {
	'use strict';

	var EDGE_GAP = 30;    // px between screen edge and outer edge of the side cards
	var SIDE_SCALE = 0.85;

	function initBuilding() {
		var section = document.querySelector( '.buildingSection' );

		if ( ! section || typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined' ) {
			return;
		}

		var slides = gsap.utils.toArray( section.querySelectorAll( '.cardContainer .slide' ) );
		var total = slides.length;
		var isDesktop = window.matchMedia( '(min-width: 992px)' ).matches;
		var reduceMotion = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

		if ( total < 2 || ! isDesktop || reduceMotion ) {
			return;
		}

		gsap.registerPlugin( ScrollTrigger );
		section.classList.add( 'is-carousel' );

		// Side offset (in % of card width) so the side cards' outer edge
		// sits exactly EDGE_GAP px from the screen edge.
		var sideX = 30;

		function measureSide() {
			var w = slides[ 0 ].offsetWidth;
			var half = section.clientWidth / 2;

			sideX = Math.max( 0, ( ( half - EDGE_GAP - ( SIDE_SCALE * w ) / 2 ) / w ) * 100 );
		}

		function slot( i, state ) {
			var pos = i - state;
			var dir = pos < 0 ? -1 : 1;

			if ( pos === 0 ) {
				return { x: 0, scale: 1, opacity: 1 };
			}
			if ( Math.abs( pos ) === 1 ) {
				return { x: dir * sideX, scale: SIDE_SCALE, opacity: 0.25 };
			}
			return { x: dir * sideX, scale: 0.75, opacity: 0 };
		}

		function stateVars( state ) {
			return {
				xPercent: function ( i ) { return slot( i, state ).x; },
				scale: function ( i ) { return slot( i, state ).scale; },
				opacity: function ( i ) { return slot( i, state ).opacity; },
			};
		}

		function setActive( state ) {
			slides.forEach( function ( slide, i ) {
				slide.classList.toggle( 'is-active', i === state );
				slide.style.zIndex = total - Math.abs( i - state );
			} );
		}

		measureSide();
		gsap.set( slides, stateVars( 0 ) );
		setActive( 0 );

		var tl = gsap.timeline( {
			defaults: { duration: 1, ease: 'power2.inOut' },
			scrollTrigger: {
				trigger: section,
				start: 'top top',
				end: function () {
					return '+=' + ( total - 1 ) * window.innerHeight * 0.9;
				},
				pin: true,
				anticipatePin: 1,
				refreshPriority: 1,
				scrub: 0.6,
				snap: {
					snapTo: 1 / ( total - 1 ),
					duration: { min: 0.2, max: 0.5 },
					ease: 'power1.inOut',
				},
				invalidateOnRefresh: true,
				// Re-measure on resize/refresh so the 30px gap stays exact.
				onRefreshInit: function () {
					measureSide();
					gsap.set( slides, stateVars( 0 ) );
				},
				onUpdate: function ( self ) {
					setActive( Math.round( self.progress * ( total - 1 ) ) );
				},
			},
		} );

		for ( var s = 1; s < total; s++ ) {
			tl.to( slides, stateVars( s ) );
		}

		if ( document.fonts && document.fonts.ready ) {
			document.fonts.ready.then( function () {
				ScrollTrigger.refresh();
			} );
		}
	}

	if ( document.readyState === 'complete' ) {
		initBuilding();
	} else {
		window.addEventListener( 'load', initBuilding );
	}
} )();