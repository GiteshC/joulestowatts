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
	},
});

// Header — hamburger toggles the slide-in main menu (and morphs into a close icon).
(function () {
	"use strict";

	document.addEventListener("DOMContentLoaded", function () {
		var header = document.querySelector("header");
		var burger = header ? header.querySelector(".hamburger") : null;
		var menu = header ? header.querySelector(".mainMenu") : null;

		if (!burger || !menu) {
			return;
		}

		// Make the div behave like a proper button for keyboard/screen readers.
		menu.id = menu.id || "mainMenu";
		burger.setAttribute("role", "button");
		burger.setAttribute("tabindex", "0");
		burger.setAttribute("aria-controls", menu.id);
		burger.setAttribute("aria-label", "Open menu");
		burger.setAttribute("aria-expanded", "false");

		function setOpen(open) {
			header.classList.toggle("menu-open", open);
			burger.setAttribute("aria-expanded", open ? "true" : "false");
			burger.setAttribute(
				"aria-label",
				open ? "Close menu" : "Open menu",
			);
		}

		burger.addEventListener("click", function () {
			setOpen(!header.classList.contains("menu-open"));
		});

		burger.addEventListener("keydown", function (e) {
			if (e.key === "Enter" || e.key === " ") {
				e.preventDefault();
				burger.click();
			}
		});

		// Close after picking a link, or with Escape.
		menu.querySelectorAll("a").forEach(function (link) {
			link.addEventListener("click", function () {
				setOpen(false);
			});
		});

		document.addEventListener("keydown", function (e) {
			if (e.key === "Escape") {
				setOpen(false);
			}
		});
	});
})();

// Banner heading — letter-by-letter typing effect on the plain text only.
// Anything wrapped in a child element (e.g. <span>Amplified</span>) is left alone.
(function () {
	"use strict";

	function initBannerTyping() {
		var heading = document.querySelector(".bannerSection h1");

		if (!heading || typeof gsap === "undefined") {
			return;
		}

		if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
			return;
		}

		var chars = [];

		// The stylesheet's `h1 span` gradient rule would also hit the spans we
		// create here, so force them back to plain white text.
		function makePlain(el) {
			el.style.background = "none";
			el.style.webkitTextFillColor = "currentColor";
		}

		// Keep the full sentence readable for screen readers / SEO.
		heading.setAttribute(
			"aria-label",
			heading.textContent.replace(/\s+/g, " ").trim(),
		);

		// Only the h1's own text nodes (not the ones inside <span>).
		Array.prototype.slice.call(heading.childNodes).forEach(function (node) {
			if (node.nodeType !== 3 || !node.textContent.trim()) {
				return;
			}

			var text = node.textContent;
			var parts = text.split(/\s+/).filter(Boolean);
			var frag = document.createDocumentFragment();

			// Keep the spaces at the edges of the text (e.g. the space
			// between "Truth" and <span>Amplified</span>).
			if (/^\s/.test(text)) {
				frag.appendChild(document.createTextNode(" "));
			}

			parts.forEach(function (word, i) {
				var wordSpan = document.createElement("span");

				wordSpan.className = "typeWord";
				wordSpan.style.whiteSpace = "nowrap";
				wordSpan.setAttribute("aria-hidden", "true");
				makePlain(wordSpan);

				word.split("").forEach(function (letter) {
					var charSpan = document.createElement("span");

					charSpan.className = "typeChar";
					charSpan.style.display = "inline-block";
					makePlain(charSpan);
					charSpan.textContent = letter;
					wordSpan.appendChild(charSpan);
					chars.push(charSpan);
				});

				frag.appendChild(wordSpan);

				if (i < parts.length - 1) {
					frag.appendChild(document.createTextNode(" "));
				}
			});

			if (/\s$/.test(text)) {
				frag.appendChild(document.createTextNode(" "));
			}

			heading.replaceChild(frag, node);
		});

		if (!chars.length) {
			return;
		}

		// Letters start hidden and slightly lower (autoAlpha keeps layout stable).
		gsap.set(chars, { autoAlpha: 0, y: 20 });

		gsap.to(chars, {
			autoAlpha: 1,
			y: 0,
			duration: 0.5,
			ease: "power2.out",
			stagger: 0.05,
			delay: 0.3,
		});
	}

	if (document.readyState === "loading") {
		document.addEventListener("DOMContentLoaded", initBannerTyping);
	} else {
		initBannerTyping();
	}
})();

(function () {
	"use strict";
	document.addEventListener("DOMContentLoaded", function () {
		var section = document.querySelector(".enterpriseSection");
		if (!section) {
			return;
		}
		// GSAP + ScrollTrigger are expected to be loaded already (enqueued
		// in header.php, before this script runs in the footer).
		if (
			typeof gsap === "undefined" ||
			typeof ScrollTrigger === "undefined"
		) {
			// Fail safe: if GSAP didn't load for any reason, don't leave
			// the section stuck invisible.
			return;
		}
		gsap.registerPlugin(ScrollTrigger);
		var reduceMotion = window.matchMedia(
			"(prefers-reduced-motion: reduce)",
		).matches;
		var globe = section.querySelector(".globeEffect");
		var content = section.querySelector(".enterpriseContent");
		if (reduceMotion || !globe || !content) {
			return;
		}
		gsap.timeline({
			scrollTrigger: {
				trigger: section,
				start: "top 80%",
				toggleActions: "restart none restart none",
			},
		})
			.fromTo(
				globe,
				{ opacity: 0, y: 150 },
				{ opacity: 1, y: 0, duration: 0.9, ease: "power2.out" },
			)
			.fromTo(
				content,
				{ opacity: 0, y: 150 },
				{ opacity: 1, y: 0, duration: 0.9, ease: "power2.out" },
				"-=0.75",
			);
	});
})();

// What We Do — each content box slides in from the right edge of the screen.
(function () {
	"use strict";
	document.addEventListener("DOMContentLoaded", function () {
		var section = document.querySelector(".whatwedoSection");
		if (
			!section ||
			typeof gsap === "undefined" ||
			typeof ScrollTrigger === "undefined"
		) {
			return;
		}
		var boxes = section.querySelectorAll(".contentBox");
		if (!boxes.length) {
			return;
		}
		var reduceMotion = window.matchMedia(
			"(prefers-reduced-motion: reduce)",
		).matches;
		if (reduceMotion) {
			return;
		}
		boxes.forEach(function (box) {
			gsap.fromTo(
				box,
				{ opacity: 0, x: "100vw" },
				{
					opacity: 1,
					x: 0,
					duration: 1.5,
					delay: 0.5,
					ease: "power2.out",
					scrollTrigger: {
						trigger: box,
						start: "top 85%",
						toggleActions: "restart none restart none",
					},
				},
			);
		});
	});
})();

// Counter section — each number animates from 0 up to its target value
// once it scrolls into view.
(function () {
	"use strict";
	document.addEventListener("DOMContentLoaded", function () {
		var counters = document.querySelectorAll(
			".counterSection .counterBox h4",
		);
		if (
			!counters.length ||
			typeof gsap === "undefined" ||
			typeof ScrollTrigger === "undefined"
		) {
			return;
		}
		var reduceMotion = window.matchMedia(
			"(prefers-reduced-motion: reduce)",
		).matches;
		counters.forEach(function (counter) {
			// Numbers may contain commas (e.g. "5,500") — strip them to get
			// the numeric target, keep the original for comma formatting.
			var target = parseInt(counter.textContent.replace(/,/g, ""), 10);
			if (isNaN(target)) {
				return;
			}
			if (reduceMotion) {
				counter.textContent = target.toLocaleString("en-US");
				return;
			}
			var counterObj = { value: 0 };
			gsap.to(counterObj, {
				value: target,
				duration: 1.6,
				delay: 0.3,
				ease: "power1.out",
				onUpdate: function () {
					counter.textContent = Math.round(
						counterObj.value,
					).toLocaleString("en-US");
				},
				scrollTrigger: {
					trigger: counter.closest(".counterBox"),
					start: "top 85%",
					toggleActions: "restart none restart none",
				},
			});
		});
	});
})();

// Compounds section — trigger the SVG's inline CSS animations
(function () {
	"use strict";
	document.addEventListener("DOMContentLoaded", function () {
		var section = document.querySelector(".compoundsSection");
		if (
			!section ||
			typeof gsap === "undefined" ||
			typeof ScrollTrigger === "undefined"
		) {
			return;
		}
		ScrollTrigger.create({
			trigger: section,
			start: "top 30%",
			once: true,
			onEnter: function () {
				section.classList.add("in-view");
			},
		});
	});
})();

// Building section — pinned 3-card carousel driven by scroll.
(function () {
	"use strict";

	var EDGE_GAP = 30; // px between screen edge and outer edge of the side cards
	var SIDE_SCALE = 0.85;

	function initBuilding() {
		var section = document.querySelector(".buildingSection");

		if (
			!section ||
			typeof gsap === "undefined" ||
			typeof ScrollTrigger === "undefined"
		) {
			return;
		}

		var slides = gsap.utils.toArray(
			section.querySelectorAll(".cardContainer .slide"),
		);
		var total = slides.length;
		var isDesktop = window.matchMedia("(min-width: 992px)").matches;
		var reduceMotion = window.matchMedia(
			"(prefers-reduced-motion: reduce)",
		).matches;

		if (total < 2 || !isDesktop || reduceMotion) {
			return;
		}

		gsap.registerPlugin(ScrollTrigger);
		section.classList.add("is-carousel");

		// Side offset (in % of card width) so the side cards' outer edge
		// sits exactly EDGE_GAP px from the screen edge.
		var sideX = 30;

		function measureSide() {
			var w = slides[0].offsetWidth;
			var half = section.clientWidth / 2;

			sideX = Math.max(
				0,
				((half - EDGE_GAP - (SIDE_SCALE * w) / 2) / w) * 100,
			);
		}

		function slot(i, state) {
			var pos = i - state;
			var dir = pos < 0 ? -1 : 1;

			if (pos === 0) {
				return { x: 0, scale: 1, opacity: 1 };
			}
			if (Math.abs(pos) === 1) {
				return { x: dir * sideX, scale: SIDE_SCALE, opacity: 0.25 };
			}
			return { x: dir * sideX, scale: 0.75, opacity: 0 };
		}

		function stateVars(state) {
			return {
				xPercent: function (i) {
					return slot(i, state).x;
				},
				scale: function (i) {
					return slot(i, state).scale;
				},
				opacity: function (i) {
					return slot(i, state).opacity;
				},
			};
		}

		function setActive(state) {
			slides.forEach(function (slide, i) {
				slide.classList.toggle("is-active", i === state);
				slide.style.zIndex = total - Math.abs(i - state);
			});
		}

		measureSide();
		gsap.set(slides, stateVars(0));
		setActive(0);

		var tl = gsap.timeline({
			defaults: { duration: 1, ease: "power2.inOut" },
			scrollTrigger: {
				trigger: section,
				start: "top top",
				end: function () {
					return "+=" + (total - 1) * window.innerHeight * 0.9;
				},
				pin: true,
				anticipatePin: 1,
				refreshPriority: 1,
				scrub: 0.6,
				snap: {
					snapTo: 1 / (total - 1),
					duration: { min: 0.2, max: 0.5 },
					ease: "power1.inOut",
				},
				invalidateOnRefresh: true,
				// Re-measure on resize/refresh so the 30px gap stays exact.
				onRefreshInit: function () {
					measureSide();
					gsap.set(slides, stateVars(0));
				},
				onUpdate: function (self) {
					setActive(Math.round(self.progress * (total - 1)));
				},
			},
		});

		for (var s = 1; s < total; s++) {
			tl.to(slides, stateVars(s));
		}

		if (document.fonts && document.fonts.ready) {
			document.fonts.ready.then(function () {
				ScrollTrigger.refresh();
			});
		}
	}

	if (document.readyState === "complete") {
		initBuilding();
	} else {
		window.addEventListener("load", initBuilding);
	}
})();

if (window.innerWidth <= 1024) {
	$(".whyItSlider").slick({
		slidesToShow: 2.6,
		slidesToScroll: 1,
		arrows: false,
		dots: false,
		centerMode: false,
		infinite: false,
		responsive: [
			{
				breakpoint: 720,
				settings: {
					slidesToShow: 1.4,
					slidesToScroll: 1,
				},
			},
		],
	});
}

$(".mainSliderBox").slick({
	slidesToShow: 1,
	slidesToScroll: 1,
	arrows: false,
	fade: true,
	infinite: false,
	asNavFor: ".textSlider",
});
$(".textSlider").slick({
	slidesToShow: 1,
	slidesToScroll: 1,
	arrows: true,
	prevArrow: $(".prevArrow"),
	nextArrow: $(".nextArrow"),
	asNavFor: ".mainSliderBox",
	dots: false,
	fade: true,
	infinite: false,
	centerMode: false,
	focusOnSelect: false,
});

$(document).ready(function () {
	const $slider = $(".resultCardSlider").not(".platformResultSlider");

	function getSlides() {
		const w = window.innerWidth;
		if (w <= 720) return 1.4;
		if (w <= 1024) return 2.3;
		if (w <= 1280) return 2.8;
		return 3.5;
	}

	$slider.slick({
		slidesToShow: getSlides(),
		slidesToScroll: 1,
		infinite: false,
		arrows: true,
		prevArrow: $(".resultPrevArrow"),
		nextArrow: $(".resultNextArrow"),
	});

	$(window).on("resize", function () {
		$slider.slick("slickSetOption", "slidesToShow", getSlides(), true);
	});
});

//footer accordian
document.addEventListener("DOMContentLoaded", () => {
	const mq = window.matchMedia("(max-width: 768px)");
	const columns = document.querySelectorAll(".footerLinks .column");

	function closeAll() {
		columns.forEach((col) => {
			col.classList.remove("active");
			const links = col.querySelector(".links");
			if (links) links.style.maxHeight = null;
		});
	}

	function toggleColumn(col) {
		const links = col.querySelector(".links");
		const isOpen = col.classList.contains("active");

		// Ek time par ek hi open rahe (chahiye to yeh block hata do)
		columns.forEach((c) => {
			c.classList.remove("active");
			const l = c.querySelector(".links");
			if (l) l.style.maxHeight = null;
		});

		if (!isOpen) {
			col.classList.add("active");
			links.style.maxHeight = links.scrollHeight + 40 + "px";
		}
	}

	columns.forEach((col) => {
		const heading = col.querySelector(".linkHeading");

		heading.addEventListener("click", () => {
			if (!mq.matches) return; // desktop par kuch nahi
			toggleColumn(col);
		});

		// Keyboard accessibility
		heading.setAttribute("tabindex", "0");
		heading.setAttribute("role", "button");
		heading.addEventListener("keydown", (e) => {
			if (!mq.matches) return;
			if (e.key === "Enter" || e.key === " ") {
				e.preventDefault();
				toggleColumn(col);
			}
		});
	});

	// Desktop par switch hone par reset
	mq.addEventListener("change", (e) => {
		if (!e.matches) closeAll();
	});
});

if (window.innerWidth <= 820) {
	document
		.querySelectorAll(
			".whatwedoSection .wrapper .secHeading .headingGroup p",
		)
		.forEach((p) => {
			p.innerHTML = p.innerHTML.replace(/<br\s*\/?>/gi, " ");
		});
}

//Platform page

$(document).ready(function () {
	const $slider = $(".platformResultSlider");

	function getSlides() {
		const w = window.innerWidth;
		if (w <= 720) return 1.4;
		if (w <= 1024) return 2.3;
		if (w <= 1280) return 2.8;
		return 3.5;
	}

	$slider.slick({
		slidesToShow: getSlides(),
		slidesToScroll: 1,
		infinite: true,

		autoplay: true,
		autoplaySpeed: 5000,
		speed: 1000,
		cssEase: "ease",

		arrows: true,

		prevArrow: $(".platformResultPrevArrow"),
		nextArrow: $(".platformResultNextArrow"),
	});

	$(window).on("resize", function () {
		$slider.slick("slickSetOption", "slidesToShow", getSlides(), true);
	});
});

// Platform page — Diagnosis section intro:
// heading rises from the section centre to its place, then the image zooms in
// at the centre, then the left box slides in from the left and the right box
// from the right.
( function () {
	'use strict';

	// 1 = base timing below. Higher = slower (1.5 = 50% slower, 2 = twice as slow).
	var SPEED = 1.2;

	var D = {
		heading: 1.2,   // heading drops into place
		image:   1.4,   // image zoom-in
		label:   1.6,   // "AI CHARTER" fade
		side:    1.6,   // leftBox / rightBox slide-in
	};
	var GAP = 0.2;      // pause between steps (seconds, before SPEED is applied)
	var SIDE_OFFSET = 200;

	function initDiagnosis() {
		var section = document.querySelector( '.diagnosisSection' );
		if ( ! section || typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined' ) { return; }
		if ( window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) { return; }

		var heading  = section.querySelector( '.secHeading' );
		var content  = section.querySelector( '.diagnosisContent' );
		var leftBox  = section.querySelector( '.leftBox' );
		var rightBox = section.querySelector( '.rightBox' );
		var image    = section.querySelector( '.middleBox img' );
		var label    = section.querySelector( '.middleBox p' );
		if ( ! heading || ! content || ! leftBox || ! rightBox || ! image ) { return; }

		gsap.registerPlugin( ScrollTrigger );

		// Distance from the heading's natural spot to the centre of the content area.
		function headingStartY() {
			var h = heading.getBoundingClientRect();
			var c = content.getBoundingClientRect();
			var current = gsap.getProperty( heading, 'y' ) || 0;
			return ( c.top + c.height / 2 ) - ( h.top + h.height / 2 ) + current;
		}

		var tl = gsap.timeline( {
			defaults: { ease: 'power3.out' },
			scrollTrigger: {
				trigger: section,
				start: 'center 80%',
				toggleActions: 'restart none restart none',
				invalidateOnRefresh: true,
			},
		} );

		// 1. Heading
		tl.fromTo( heading,
			{ y: headingStartY, autoAlpha: 0 },
			{ y: 0, autoAlpha: 1, duration: D.heading, ease: 'power2.out' }
		);

		// 2. Image zoom (starts while heading is settling)
		tl.fromTo( image,
			{ scale: 0.4, autoAlpha: 0, transformOrigin: '50% 50%' },
			{ scale: 1, autoAlpha: 1, duration: D.image, ease: 'power2.inOut' },
			'>-0.3'
		);

		if ( label ) {
			tl.fromTo( label, { autoAlpha: 0 }, { autoAlpha: 1, duration: D.label, ease: 'power1.out' }, '<0.9' );
		}

		// 3. Side boxes
		tl.fromTo( leftBox,
			{ x: -SIDE_OFFSET, autoAlpha: 0 },
			{ x: 0, autoAlpha: 1, duration: D.side, ease: 'power2.out' },
			'>' + ( GAP - 0.3 )
		);
		tl.fromTo( rightBox,
			{ x: SIDE_OFFSET, autoAlpha: 0 },
			{ x: 0, autoAlpha: 1, duration: D.side, ease: 'power2.out' },
			'<'
		);

		// Slow everything uniformly.
		tl.timeScale( 1 / SPEED );

		if ( document.fonts && document.fonts.ready ) {
			document.fonts.ready.then( function () { ScrollTrigger.refresh(); } );
		}
	}

	if ( document.readyState === 'complete' ) {
		initDiagnosis();
	} else {
		window.addEventListener( 'load', initDiagnosis );
	}
} )();

// Platform page — Video fullscreen effect: when a video box is clicked, it expands to fill the screen, and shrinks back when closed.
( function () {
	'use strict';

	function initVideoFullscreen() {
		var boxes = document.querySelectorAll( '.videofullSection .videoBox' );
		if ( ! boxes.length || typeof gsap === 'undefined' ) { return; }

		var CLOSE_ICON = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"><path d="M5 5l14 14M19 5L5 19"/></svg>';
		var DUR = 0.8;
		var EASE = 'power3.inOut';

		var backdrop = document.createElement( 'div' );
		backdrop.className = 'videoBackdrop';
		document.body.appendChild( backdrop );

		var active = null; // { box, video, placeholder, closeBtn }
		var busy = false;

		function open( box ) {
			if ( active || busy ) { return; }
			busy = true;

			var video = box.querySelector( 'video' );
			var r = box.getBoundingClientRect();

			// Placeholder holds the layout space while the box is fixed.
			var placeholder = document.createElement( 'div' );
			placeholder.className = 'videoPlaceholder';
			placeholder.style.width = r.width + 'px';
			placeholder.style.height = r.height + 'px';
			box.parentNode.insertBefore( placeholder, box );

			var closeBtn = document.createElement( 'button' );
			closeBtn.type = 'button';
			closeBtn.className = 'closeBtn';
			closeBtn.setAttribute( 'aria-label', 'Close video' );
			closeBtn.innerHTML = CLOSE_ICON;
			box.appendChild( closeBtn );

			active = { box: box, video: video, placeholder: placeholder, closeBtn: closeBtn };

			// Pin the box exactly where it is, then grow it.
			box.classList.add( 'is-open' );
			gsap.set( box, { top: r.top, left: r.left, width: r.width, height: r.height } );
			document.documentElement.style.overflow = 'hidden';

			gsap.to( backdrop, { opacity: 1, duration: DUR, ease: 'power2.out' } );
			backdrop.style.pointerEvents = 'auto';
			gsap.to( box, {
				top: 0, left: 0, width: window.innerWidth, height: window.innerHeight,
				duration: DUR, ease: EASE,
				onComplete: function () {
					busy = false;
					video.controls = true;
					video.play().catch( function () {} );
				},
			} );
		}

		function close() {
			if ( ! active || busy ) { return; }
			busy = true;

			var a = active;
			a.video.pause();
			a.video.controls = false;

			// Where the placeholder is NOW (page may have moved/resized).
			var r = a.placeholder.getBoundingClientRect();

			gsap.to( backdrop, { opacity: 0, duration: DUR, ease: 'power2.out' } );
			gsap.to( a.box, {
				top: r.top, left: r.left, width: r.width, height: r.height,
				duration: DUR, ease: EASE,
				onComplete: function () {
					a.box.classList.remove( 'is-open' );
					gsap.set( a.box, { clearProps: 'top,left,width,height' } );
					a.placeholder.parentNode.removeChild( a.placeholder );
					a.closeBtn.parentNode.removeChild( a.closeBtn );
					backdrop.style.pointerEvents = 'none';
					document.documentElement.style.overflow = '';
					active = null;
					busy = false;
				},
			} );
		}

		boxes.forEach( function ( box ) {
			box.addEventListener( 'click', function ( e ) {
				if ( e.target.closest( '.closeBtn' ) ) { close(); return; }
				if ( ! box.classList.contains( 'is-open' ) ) { open( box ); }
			} );
		} );

		backdrop.addEventListener( 'click', close );
		document.addEventListener( 'keydown', function ( e ) {
			if ( e.key === 'Escape' ) { close(); }
		} );

		// Keep it full-screen if the window is resized while open.
		window.addEventListener( 'resize', function () {
			if ( active && ! busy ) {
				gsap.set( active.box, { top: 0, left: 0, width: window.innerWidth, height: window.innerHeight } );
			}
		} );
	}

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', initVideoFullscreen );
	} else {
		initVideoFullscreen();
	}
} )();

// Diagnosis Center section effect
( function () {
	'use strict';

	function initDiagnosisCenter() {
		var section = document.querySelector( '.diagnosiscenterSection' );
		if ( ! section || typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined' ) { return; }
		if ( window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) { return; }

		gsap.registerPlugin( ScrollTrigger );

		/* ---------- 1. Image: scale in / out loop ---------- */
		var img = section.querySelector( '.diagnosiscenterImg img' );
		if ( img ) {
			var pulse = gsap.fromTo( img,
				{ scale: 0.92 },
				{ scale: 1.06, duration: 2, ease: 'sine.inOut', yoyo: true, repeat: -1, paused: true, transformOrigin: '50% 50%' }
			);
			// Only run the loop while the image is on screen.
			ScrollTrigger.create( {
				trigger: img,
				start: 'top bottom',
				end: 'bottom top',
				onToggle: function ( self ) { self.isActive ? pulse.play() : pulse.pause(); },
			} );
		}

		/* ---------- 2. Heading line draws, then circle travels ---------- */
		var svg = section.querySelector( '.secHeading > svg' );
		if ( ! svg ) { return; }

		var line = svg.querySelector( ':scope > g' );     // the dashed line
		var dot  = svg.querySelector( ':scope > path' );  // the circle
		if ( ! line || ! dot ) { return; }

		svg.style.overflow = 'visible'; // so the circle isn't clipped at the start

		// A mask whose width grows = the line "draws" left to right
		// (the line is dashed, so stroke-dashoffset can't be used).
		var NS = 'http://www.w3.org/2000/svg';
		var defs = svg.querySelector( 'defs' ) || svg.insertBefore( document.createElementNS( NS, 'defs' ), svg.firstChild );
		var mask = document.createElementNS( NS, 'mask' );
		mask.setAttribute( 'id', 'diagLineMask' );
		mask.setAttribute( 'maskUnits', 'userSpaceOnUse' );
		mask.setAttribute( 'x', '0' ); mask.setAttribute( 'y', '0' );
		mask.setAttribute( 'width', '669' ); mask.setAttribute( 'height', '25' );
		var rect = document.createElementNS( NS, 'rect' );
		rect.setAttribute( 'x', '0' ); rect.setAttribute( 'y', '0' );
		rect.setAttribute( 'width', '0' ); rect.setAttribute( 'height', '25' );
		rect.setAttribute( 'fill', '#fff' );
		mask.appendChild( rect );
		defs.appendChild( mask );
		line.setAttribute( 'mask', 'url(#diagLineMask)' );

		// Circle's resting centre is ~x137; start it at the line's left end.
		var CIRCLE_REST_X = 137;

		gsap.set( dot, { x: -CIRCLE_REST_X, autoAlpha: 0 } );

		var tl = gsap.timeline( {
			scrollTrigger: {
				trigger: svg,
				start: 'top 85%',
				toggleActions: 'restart none restart none',
			},
		} );

		tl.to( rect, { attr: { width: 669 }, duration: 2, ease: 'power2.inOut' } );
		tl.to( dot, { autoAlpha: 1, duration: 0.3, ease: 'none' } );
		tl.to( dot, { x: 0, duration: 1.4, ease: 'power3.out' }, '<' );
	}

	if ( document.readyState === 'complete' ) {
		initDiagnosisCenter();
	} else {
		window.addEventListener( 'load', initDiagnosisCenter );
	}
} )();