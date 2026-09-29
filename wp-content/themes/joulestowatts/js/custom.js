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
( function () {
	'use strict';

	document.addEventListener( 'DOMContentLoaded', function () {
		var header = document.querySelector( 'header' );
		var burger = header ? header.querySelector( '.hamburger' ) : null;
		var menu = header ? header.querySelector( '.mainMenu' ) : null;

		if ( ! burger || ! menu ) {
			return;
		}

		// Make the div behave like a proper button for keyboard/screen readers.
		menu.id = menu.id || 'mainMenu';
		burger.setAttribute( 'role', 'button' );
		burger.setAttribute( 'tabindex', '0' );
		burger.setAttribute( 'aria-controls', menu.id );
		burger.setAttribute( 'aria-label', 'Open menu' );
		burger.setAttribute( 'aria-expanded', 'false' );

		function setOpen( open ) {
			header.classList.toggle( 'menu-open', open );
			burger.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
			burger.setAttribute( 'aria-label', open ? 'Close menu' : 'Open menu' );
		}

		burger.addEventListener( 'click', function () {
			setOpen( ! header.classList.contains( 'menu-open' ) );
		} );

		burger.addEventListener( 'keydown', function ( e ) {
			if ( e.key === 'Enter' || e.key === ' ' ) {
				e.preventDefault();
				burger.click();
			}
		} );

		// Close after picking a link, or with Escape.
		menu.querySelectorAll( 'a' ).forEach( function ( link ) {
			link.addEventListener( 'click', function () {
				setOpen( false );
			} );
		} );

		document.addEventListener( 'keydown', function ( e ) {
			if ( e.key === 'Escape' ) {
				setOpen( false );
			}
		} );
	} );
} )();

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

$(".resultCardSlider").slick({
	slidesToShow: 3.5,
	slidesToScroll: 1,
	autoplay: false,
	autoplaySpeed: 2500,
	infinite: false,
	arrows: true,
	prevArrow: $(".resultPrevArrow"),
	nextArrow: $(".resultNextArrow"),
	focusOnSelect: true,
	responsive: [
        {
            breakpoint: 1281,
            settings: {
                slidesToShow: 2.3,
            },
        },
        {
            breakpoint: 1025,
            settings: {
                slidesToShow: 2.3,
            },
        },
        {
            breakpoint: 721,
            settings: {
                slidesToShow: 1.2,
            },
        },
    ],
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
