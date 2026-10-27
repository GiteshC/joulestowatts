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

		var backdrop = document.querySelector(".menuBackdrop");

		function setOpen(open) {
			header.classList.toggle("menu-open", open);
			document.body.classList.toggle("menu-is-open", open);
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

		// Close by clicking the dimmed page behind the menu.
		if (backdrop) {
			backdrop.addEventListener("click", function () {
				setOpen(false);
			});
		}

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

//Ai Section
if ($(".ourAiSection").length) {
	window.addEventListener("load", () => {
		const DEBUG = false;
		const SNAP = false; // snap chahiye to true

		if (
			typeof gsap === "undefined" ||
			typeof ScrollTrigger === "undefined"
		) {
			console.error("GSAP ya ScrollTrigger load nahi hua");
			return;
		}
		gsap.registerPlugin(ScrollTrigger);

		const section = document.querySelector("#ips");
		if (!section) return;

		const right = section.querySelector(".righttextPart");
		const track = section.querySelector(".track");
		const cards = gsap.utils.toArray(".aiImgBox", track);
		const panels = gsap.utils.toArray(
			".cardHeadingGroup .cardHeading",
			section,
		);
		const n = cards.length;

		if (!right || !track || n < 2 || panels.length !== n) {
			console.error("Setup galat:", { cards: n, panels: panels.length });
			return;
		}

		const cssVar = (name) =>
			parseFloat(getComputedStyle(section).getPropertyValue(name));

		// card i ko container ke bilkul beech me laane ke liye track ka y
		const yFor = (i) =>
			right.clientHeight / 2 -
			(cards[i].offsetTop + cards[i].offsetHeight / 2);

		function build() {
			const inactiveScale = cssVar("--inactive-scale") || 0.9;
			const inactiveOpacity = cssVar("--inactive-opacity") || 0.4;

			// ---- left panels ----
			let current = 0;
			function swap(i) {
				if (i === current) return;
				const dir = i > current ? 1 : -1;
				const inn = panels[i];
				current = i;

				gsap.killTweensOf(panels);
				panels.forEach((p) => gsap.killTweensOf(p.children));

				panels.forEach((p) => {
					if (p !== inn) {
						gsap.to(p, {
							autoAlpha: 0,
							y: -16 * dir,
							duration: 0.2,
							ease: "power2.in",
						});
					}
				});
				gsap.fromTo(
					inn,
					{ autoAlpha: 0, y: 24 * dir },
					{
						autoAlpha: 1,
						y: 0,
						duration: 0.45,
						delay: 0.15,
						ease: "power3.out",
					},
				);
				gsap.fromTo(
					inn.children,
					{ opacity: 0, y: 14 * dir },
					{
						opacity: 1,
						y: 0,
						duration: 0.45,
						delay: 0.18,
						stagger: 0.06,
						ease: "power3.out",
					},
				);
			}

			// ---- ek timeline: har segment = 1 unit = ek card ka move ----
			const tl = gsap.timeline({
				defaults: { ease: "none" },
				scrollTrigger: {
					trigger: section,
					start: () =>
						section.offsetHeight < window.innerHeight
							? "center center"
							: "top top",
					end: () => "+=" + (n - 1) * window.innerHeight * 0.8,
					pin: true,
					pinSpacing: true,
					anticipatePin: 1,
					scrub: true,
					markers: DEBUG,
					snap: SNAP
						? {
								snapTo: 1 / (n - 1),
								duration: { min: 0.2, max: 0.5 },
								ease: "power1.inOut",
								delay: 0.05,
							}
						: false,
					invalidateOnRefresh: true,
					onUpdate: (self) =>
						swap(Math.round(self.progress * (n - 1))),
				},
			});

			// track: card i se card i+1 tak
			for (let i = 0; i < n - 1; i++) {
				tl.fromTo(
					track,
					{ y: () => yFor(i) },
					{
						y: () => yFor(i + 1),
						duration: 1,
						immediateRender: i === 0,
					},
					i,
				);
			}

			// cards: aate waqt active, jaate waqt inactive
			cards.forEach((c, i) => {
				if (i > 0) {
					tl.fromTo(
						c,
						{ opacity: inactiveOpacity, scale: inactiveScale },
						{ opacity: 1, scale: 1, duration: 1 },
						i - 1,
					);
				}
				if (i < n - 1) {
					tl.fromTo(
						c,
						{ opacity: 1, scale: 1 },
						{
							opacity: inactiveOpacity,
							scale: inactiveScale,
							duration: 1,
							immediateRender: false,
						},
						i,
					);
				}
			});

			// cleanup: breakpoint badalne par sab CSS ke initial state par wapas
			return () => {
				gsap.killTweensOf(panels);
				panels.forEach((p) => gsap.killTweensOf(p.children));
				gsap.set(panels, { clearProps: "all" });
				panels.forEach((p) =>
					gsap.set(p.children, { clearProps: "all" }),
				);
				gsap.set(cards, { clearProps: "all" });
				gsap.set(track, { clearProps: "all" });
			};
		}

		// breakpoint badle to naye CSS variables ke saath dobara build hoga
		const mm = gsap.matchMedia();
		mm.add(
			{
				desktop: "(min-width: 1081px)",
				mobile: "(min-width: 1081px)",
			},
			(ctx) => {
				const { tablet } = ctx.conditions;
				return build(tablet); // pass a flag and use e.g. 0.6 instead of 0.8 for scroll distance
			},
		);

		// images late load hon to ek baar refresh
		let t;
		track.querySelectorAll("img").forEach((img) => {
			if (!img.complete) {
				img.addEventListener("load", () => {
					clearTimeout(t);
					t = setTimeout(() => ScrollTrigger.refresh(), 150);
				});
			}
		});
	});
}

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

		// Position of card i relative to the active card, wrapping around so the
		// last card waits on the left of the first one (as in the design).
		function offset(i, state) {
			var pos = (((i - state) % total) + total) % total;
			return pos > total / 2 ? pos - total : pos;
		}

		function slot(i, state) {
			var pos = offset(i, state);
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
				slide.style.zIndex = total - Math.abs(offset(i, state));
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
		if (w <= 720) return 1.1;
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
		if (w <= 720) return 1.1;
		if (w <= 1024) return 2.3;
		if (w <= 1280) return 2.8;
		return 3.5;
	}

	$slider.slick({
		slidesToShow: getSlides(),
		slidesToScroll: 1,
		infinite: false,

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

//  platform page — Banner heading and image fade in from below, staggered.
(function () {
	"use strict";

	function initPlatformBanner() {
		var section = document.querySelector(".bannerInnerSection");
		if (!section || typeof gsap === "undefined") {
			return;
		}
		if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
			return;
		}

		var heading = section.querySelector(".bannerContent .bannerHeading");
		var image = section.querySelector(".bannerContent > img");

		var items = [heading, image].filter(Boolean);
		if (!items.length) {
			return;
		}

		var DISTANCE = 80;
		var DURATION = 1.8;
		var EASE = "power2.out";
		var START_DELAY = 0.3; // before the heading starts
		var IMAGE_DELAY = 1.2; // extra wait after the heading starts, before the image

		if (heading) {
			gsap.fromTo(
				heading,
				{ y: DISTANCE, autoAlpha: 0 },
				{
					y: 0,
					autoAlpha: 1,
					duration: DURATION,
					ease: EASE,
					delay: START_DELAY,
				},
			);
		}
		if (image) {
			gsap.fromTo(
				image,
				{ y: DISTANCE, autoAlpha: 0 },
				{
					y: 0,
					autoAlpha: 1,
					duration: DURATION,
					ease: EASE,
					delay: START_DELAY + IMAGE_DELAY,
				},
			);
		}
	}

	if (document.readyState === "loading") {
		document.addEventListener("DOMContentLoaded", initPlatformBanner);
	} else {
		initPlatformBanner();
	}
})();

//Solution Section JS
// document.addEventListener("DOMContentLoaded", () => {
// 	document
// 		.querySelectorAll(".secWrapper .cardContainer")
// 		.forEach((container) => {
// 			const cards = [...container.querySelectorAll(".solutionCard")];

// 			if (!cards.length) return;

// 			const mobileQuery = window.matchMedia("(max-width: 820px)");

// 			function setImageHeight(card, isOpen) {
// 				const imgBox = card.querySelector(".imgBox");

// 				if (!imgBox) return;

// 				if (!isOpen || !mobileQuery.matches) {
// 					imgBox.style.maxHeight = "0px";
// 					return;
// 				}

// 				const updateHeight = () => {
// 					if (
// 						!mobileQuery.matches ||
// 						!card.classList.contains("solutionActiveCard")
// 					) {
// 						return;
// 					}

// 					imgBox.style.maxHeight = `${imgBox.scrollHeight}px`;
// 				};

// 				const img = imgBox.querySelector("img");

// 				if (img && !img.complete) {
// 					img.addEventListener("load", updateHeight, { once: true });
// 					img.addEventListener("error", updateHeight, { once: true });
// 					return;
// 				}

// 				requestAnimationFrame(updateHeight);
// 			}

// 			function openCard(card) {
// 				cards.forEach((item) => {
// 					const isCurrent = item === card;

// 					item.classList.toggle("solutionActiveCard", isCurrent);

// 					setImageHeight(item, isCurrent);
// 				});
// 			}

// 			function closeAllCards() {
// 				cards.forEach((card) => {
// 					card.classList.remove("solutionActiveCard");
// 					setImageHeight(card, false);
// 				});
// 			}

// 			function initializeAccordion() {
// 				if (mobileQuery.matches) {
// 					const activeCard = cards.find((card) =>
// 						card.classList.contains("solutionActiveCard"),
// 					);

// 					// Preserve the current selection; default to first card.
// 					openCard(activeCard || cards[0]);
// 				} else {
// 					closeAllCards();
// 				}
// 			}

// 			// Initial state
// 			initializeAccordion();

// 			cards.forEach((card) => {
// 				card.addEventListener("click", (event) => {
// 					if (!mobileQuery.matches) return;

// 					if (event.target.closest("a, button")) return;

// 					const isActive =
// 						card.classList.contains("solutionActiveCard");

// 					if (isActive) {
// 						closeAllCards();
// 					} else {
// 						openCard(card);
// 					}
// 				});
// 			});

// 			// Only update when crossing the mobile/desktop breakpoint.
// 			// Do not reset the accordion on every resize event.
// 			if (mobileQuery.addEventListener) {
// 				mobileQuery.addEventListener("change", initializeAccordion);
// 			} else {
// 				mobileQuery.addListener(initializeAccordion);
// 			}

// 			// Recalculate the open image height when its size changes.
// 			window.addEventListener("resize", () => {
// 				if (!mobileQuery.matches) return;

// 				const activeCard = cards.find((card) =>
// 					card.classList.contains("solutionActiveCard"),
// 				);

// 				if (activeCard) {
// 					setImageHeight(activeCard, true);
// 				}
// 			});
// 		});
// });

document.addEventListener("DOMContentLoaded", () => {
	const containers = document.querySelectorAll(".secWrapper .cardContainer");

	const mobileQuery = window.matchMedia("(max-width: 820px)");

	containers.forEach((container) => {
		const cards = [...container.querySelectorAll(".solutionCard")];

		if (!cards.length) return;

		function setImageHeight(card, isOpen) {
			const imgBox = card.querySelector(".imgBox");

			if (!imgBox) return;

			if (!mobileQuery.matches || !isOpen) {
				imgBox.style.maxHeight = "";
				return;
			}

			const updateHeight = () => {
				if (
					!mobileQuery.matches ||
					!card.classList.contains("solutionActiveCard")
				) {
					return;
				}

				imgBox.style.maxHeight = `${imgBox.scrollHeight}px`;
			};

			const img = imgBox.querySelector("img");

			if (img && !img.complete) {
				img.addEventListener("load", updateHeight, { once: true });
				img.addEventListener("error", updateHeight, { once: true });
			} else {
				requestAnimationFrame(updateHeight);
			}
		}

		function openCard(activeCard) {
			if (!mobileQuery.matches) return;

			cards.forEach((card) => {
				const isActive = card === activeCard;

				card.classList.toggle("solutionActiveCard", isActive);
				setImageHeight(card, isActive);
			});
		}

		function closeAllCards() {
			cards.forEach((card) => {
				card.classList.remove("solutionActiveCard");
				setImageHeight(card, false);
			});
		}

		function initializeAccordion() {
			if (mobileQuery.matches) {
				// First card ko sirf tab open karo jab initial setup ho.
				const activeCard = cards.find((card) =>
					card.classList.contains("solutionActiveCard"),
				);

				if (activeCard) {
					openCard(activeCard);
				} else if (!container.dataset.accordionInitialized) {
					openCard(cards[0]);
				}

				container.dataset.accordionInitialized = "true";
			} else {
				closeAllCards();

				cards.forEach((card) => {
					const imgBox = card.querySelector(".imgBox");

					if (imgBox) {
						imgBox.style.maxHeight = "";
					}
				});

				container.dataset.accordionInitialized = "";
			}
		}

		initializeAccordion();

		cards.forEach((card) => {
			card.addEventListener("click", (event) => {
				if (!mobileQuery.matches) return;

				// Links aur buttons ko ignore karo
				if (event.target.closest("a, button")) return;

				// Sirf clicked card ki state change hogi
				if (card.classList.contains("solutionActiveCard")) {
					closeAllCards();
				} else {
					openCard(card);
				}
			});
		});

		// Outside click par accordion state change nahi hogi
		document.addEventListener("click", (event) => {
			if (!mobileQuery.matches) return;

			const clickedInside = event.target.closest(
				".secWrapper .cardContainer .solutionCard",
			);

			if (!clickedInside) {
				// Intentionally do nothing
				return;
			}
		});

		if (mobileQuery.addEventListener) {
			mobileQuery.addEventListener("change", initializeAccordion);
		} else {
			mobileQuery.addEventListener(initializeAccordion);
		}

		window.addEventListener("resize", () => {
			if (!mobileQuery.matches) return;

			const activeCard = cards.find((card) =>
				card.classList.contains("solutionActiveCard"),
			);

			if (activeCard) {
				setImageHeight(activeCard, true);
			}
		});
	});
});

// Platform page — Diagnosis section intro:
// heading rises from the section centre to its place, then the image zooms in
// at the centre, then the left box slides in from the left and the right box
// from the right.
(function () {
	"use strict";

	// 1 = base timing below. Higher = slower (1.5 = 50% slower, 2 = twice as slow).
	var SPEED = 1.2;

	var D = {
		heading: 1.2, // heading drops into place
		image: 1.4, // image zoom-in
		label: 1.6, // "AI CHARTER" fade
		side: 1.6, // leftBox / rightBox slide-in
	};
	var GAP = 0.2; // pause between steps (seconds, before SPEED is applied)
	var SIDE_OFFSET = 200;

	function initDiagnosis() {
		var section = document.querySelector(".diagnosisSection");
		if (
			!section ||
			typeof gsap === "undefined" ||
			typeof ScrollTrigger === "undefined"
		) {
			return;
		}
		if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
			return;
		}

		var heading = section.querySelector(".secHeading");
		var content = section.querySelector(".diagnosisContent");
		var leftBox = section.querySelector(".leftBox");
		var rightBox = section.querySelector(".rightBox");
		var image = section.querySelector(".middleBox img");
		var label = section.querySelector(".middleBox p");
		if (!heading || !content || !leftBox || !rightBox || !image) {
			return;
		}

		gsap.registerPlugin(ScrollTrigger);

		// Distance from the heading's natural spot to the centre of the content area.
		function headingStartY() {
			var h = heading.getBoundingClientRect();
			var c = content.getBoundingClientRect();
			var current = gsap.getProperty(heading, "y") || 0;
			return c.top + c.height / 2 - (h.top + h.height / 2) + current;
		}

		var tl = gsap.timeline({
			defaults: { ease: "power3.out" },
			scrollTrigger: {
				trigger: section,
				start: "center 80%",
				toggleActions: "restart none restart none",
				invalidateOnRefresh: true,
			},
		});

		// 1. Heading
		tl.fromTo(
			heading,
			{ y: headingStartY, autoAlpha: 0 },
			{ y: 0, autoAlpha: 1, duration: D.heading, ease: "power2.out" },
		);

		// 2. Image zoom (starts while heading is settling)
		tl.fromTo(
			image,
			{ scale: 0.4, autoAlpha: 0, transformOrigin: "50% 50%" },
			{ scale: 1, autoAlpha: 1, duration: D.image, ease: "power2.inOut" },
			">-0.3",
		);

		if (label) {
			tl.fromTo(
				label,
				{ autoAlpha: 0 },
				{ autoAlpha: 1, duration: D.label, ease: "power1.out" },
				"<0.9",
			);
		}

		// 3. Side boxes
		tl.fromTo(
			leftBox,
			{ x: -SIDE_OFFSET, autoAlpha: 0 },
			{ x: 0, autoAlpha: 1, duration: D.side, ease: "power2.out" },
			">" + (GAP - 0.3),
		);
		tl.fromTo(
			rightBox,
			{ x: SIDE_OFFSET, autoAlpha: 0 },
			{ x: 0, autoAlpha: 1, duration: D.side, ease: "power2.out" },
			"<",
		);

		// Slow everything uniformly.
		tl.timeScale(1 / SPEED);

		if (document.fonts && document.fonts.ready) {
			document.fonts.ready.then(function () {
				ScrollTrigger.refresh();
			});
		}
	}

	if (document.readyState === "complete") {
		initDiagnosis();
	} else {
		window.addEventListener("load", initDiagnosis);
	}
})();

// Platform page — Video fullscreen effect: when a video box is clicked, it expands to fill the screen, and shrinks back when closed.
(function () {
	"use strict";

	function initVideoFullscreen() {
		var boxes = document.querySelectorAll(".videofullSection .videoBox");
		if (!boxes.length || typeof gsap === "undefined") {
			return;
		}

		var CLOSE_ICON =
			'<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"><path d="M5 5l14 14M19 5L5 19"/></svg>';
		var DUR = 0.8;
		var EASE = "power3.inOut";

		var backdrop = document.createElement("div");
		backdrop.className = "videoBackdrop";
		document.body.appendChild(backdrop);

		var active = null; // { box, video, placeholder, closeBtn }
		var busy = false;

		function open(box) {
			if (active || busy) {
				return;
			}
			busy = true;

			var video = box.querySelector("video");
			var r = box.getBoundingClientRect();

			// Placeholder holds the layout space while the box is fixed.
			var placeholder = document.createElement("div");
			placeholder.className = "videoPlaceholder";
			placeholder.style.width = r.width + "px";
			placeholder.style.height = r.height + "px";
			box.parentNode.insertBefore(placeholder, box);

			var closeBtn = document.createElement("button");
			closeBtn.type = "button";
			closeBtn.className = "closeBtn";
			closeBtn.setAttribute("aria-label", "Close video");
			closeBtn.innerHTML = CLOSE_ICON;
			box.appendChild(closeBtn);

			active = {
				box: box,
				video: video,
				placeholder: placeholder,
				closeBtn: closeBtn,
			};

			// Pin the box exactly where it is, then grow it.
			box.classList.add("is-open");
			gsap.set(box, {
				top: r.top,
				left: r.left,
				width: r.width,
				height: r.height,
			});
			document.documentElement.style.overflow = "hidden";

			gsap.to(backdrop, {
				opacity: 1,
				duration: DUR,
				ease: "power2.out",
			});
			backdrop.style.pointerEvents = "auto";
			gsap.to(box, {
				top: 0,
				left: 0,
				width: window.innerWidth,
				height: window.innerHeight,
				duration: DUR,
				ease: EASE,
				onComplete: function () {
					busy = false;
					video.controls = true;
					video.play().catch(function () {});
				},
			});
		}

		function close() {
			if (!active || busy) {
				return;
			}
			busy = true;

			var a = active;
			a.video.pause();
			a.video.controls = false;

			// Where the placeholder is NOW (page may have moved/resized).
			var r = a.placeholder.getBoundingClientRect();

			gsap.to(backdrop, {
				opacity: 0,
				duration: DUR,
				ease: "power2.out",
			});
			gsap.to(a.box, {
				top: r.top,
				left: r.left,
				width: r.width,
				height: r.height,
				duration: DUR,
				ease: EASE,
				onComplete: function () {
					a.box.classList.remove("is-open");
					gsap.set(a.box, { clearProps: "top,left,width,height" });
					a.placeholder.parentNode.removeChild(a.placeholder);
					a.closeBtn.parentNode.removeChild(a.closeBtn);
					backdrop.style.pointerEvents = "none";
					document.documentElement.style.overflow = "";
					active = null;
					busy = false;
				},
			});
		}

		boxes.forEach(function (box) {
			box.addEventListener("click", function (e) {
				if (e.target.closest(".closeBtn")) {
					close();
					return;
				}
				if (!box.classList.contains("is-open")) {
					open(box);
				}
			});
		});

		backdrop.addEventListener("click", close);
		document.addEventListener("keydown", function (e) {
			if (e.key === "Escape") {
				close();
			}
		});

		// Keep it full-screen if the window is resized while open.
		window.addEventListener("resize", function () {
			if (active && !busy) {
				gsap.set(active.box, {
					top: 0,
					left: 0,
					width: window.innerWidth,
					height: window.innerHeight,
				});
			}
		});
	}

	if (document.readyState === "loading") {
		document.addEventListener("DOMContentLoaded", initVideoFullscreen);
	} else {
		initVideoFullscreen();
	}
})();

// Diagnosis Center section effect
(function () {
	"use strict";

	function initDiagnosisCenter() {
		var section = document.querySelector(".diagnosiscenterSection");
		if (
			!section ||
			typeof gsap === "undefined" ||
			typeof ScrollTrigger === "undefined"
		) {
			return;
		}
		if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
			return;
		}

		gsap.registerPlugin(ScrollTrigger);

		/* ---------- 1. Image: scale in / out loop ---------- */
		var img = section.querySelector(".diagnosiscenterImg img");
		if (img) {
			var pulse = gsap.fromTo(
				img,
				{ scale: 0.92 },
				{
					scale: 1.06,
					duration: 2,
					ease: "sine.inOut",
					yoyo: true,
					repeat: -1,
					paused: true,
					transformOrigin: "50% 50%",
				},
			);
			// Only run the loop while the image is on screen.
			ScrollTrigger.create({
				trigger: img,
				start: "top bottom",
				end: "bottom top",
				onToggle: function (self) {
					self.isActive ? pulse.play() : pulse.pause();
				},
			});
		}

		/* ---------- 2. Heading line draws, then circle travels ---------- */
		var svg = section.querySelector(".secHeading > svg");
		if (!svg) {
			return;
		}

		var line = svg.querySelector(":scope > g"); // the dashed line
		var dot = svg.querySelector(":scope > path"); // the circle
		if (!line || !dot) {
			return;
		}

		svg.style.overflow = "visible"; // so the circle isn't clipped at the start

		// A mask whose width grows = the line "draws" left to right
		// (the line is dashed, so stroke-dashoffset can't be used).
		var NS = "http://www.w3.org/2000/svg";
		var defs =
			svg.querySelector("defs") ||
			svg.insertBefore(
				document.createElementNS(NS, "defs"),
				svg.firstChild,
			);
		var mask = document.createElementNS(NS, "mask");
		mask.setAttribute("id", "diagLineMask");
		mask.setAttribute("maskUnits", "userSpaceOnUse");
		mask.setAttribute("x", "0");
		mask.setAttribute("y", "0");
		mask.setAttribute("width", "669");
		mask.setAttribute("height", "25");
		var rect = document.createElementNS(NS, "rect");
		rect.setAttribute("x", "0");
		rect.setAttribute("y", "0");
		rect.setAttribute("width", "0");
		rect.setAttribute("height", "25");
		rect.setAttribute("fill", "#fff");
		mask.appendChild(rect);
		defs.appendChild(mask);
		line.setAttribute("mask", "url(#diagLineMask)");

		// Circle's resting centre is ~x137; start it at the line's left end.
		var CIRCLE_REST_X = 137;

		gsap.set(dot, { x: -CIRCLE_REST_X, autoAlpha: 0 });

		var tl = gsap.timeline({
			scrollTrigger: {
				trigger: svg,
				start: "top 85%",
				toggleActions: "restart none restart none",
			},
		});

		tl.to(rect, {
			attr: { width: 669 },
			duration: 2,
			ease: "power2.inOut",
		});
		tl.to(dot, { autoAlpha: 1, duration: 0.3, ease: "none" });
		tl.to(dot, { x: 0, duration: 1.4, ease: "power3.out" }, "<");
	}

	if (document.readyState === "complete") {
		initDiagnosisCenter();
	} else {
		window.addEventListener("load", initDiagnosisCenter);
	}
})();

if ($(".ourAiSection").length) {
	if (window.innerWidth <= 1080) {
		$(".aiImgSlider").slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			fade: true,
			infinite: false,
			asNavFor: ".texBoxtSlider",
		});
		$(".aiTextSlider").slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: true,
			prevArrow: $(".aiSecPrevArrow"),
			nextArrow: $(".aiSecNextArrow"),
			asNavFor: ".aiImgSlider",
			dots: false,
			fade: true,
			infinite: false,
			centerMode: false,
			focusOnSelect: false,
		});
	}
}

//Ai -Atlas Js
if ($(".agentSection").length) {
	$(".imgBoxes").slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		fade: false,
		speed: 500,
		infinite: false,
		asNavFor: ".texBoxtSlider",
	});
	$(".texBoxtSlider").slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: true,
		prevArrow: $(".studioPrevArrow"),
		nextArrow: $(".studioNextArrow"),
		asNavFor: ".imgBoxes",
		dots: false,
		fade: true,
		infinite: false,
		centerMode: false,
		focusOnSelect: false,
	});
}

// What Get Section
(function () {
	"use strict";

	function initWhatGetSequence() {
		var section = document.querySelector(".whatgetSection");
		if (
			!section ||
			typeof gsap === "undefined" ||
			typeof ScrollTrigger === "undefined"
		) {
			return;
		}
		if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
			return;
		}

		gsap.registerPlugin(ScrollTrigger);

		var INCLUDE_BG = true; // .whatgetbg changes together with the image
		var FADE = 1.2; // how slowly the next image appears (higher = slower)
		var HOLD = 1; // how long each image stays fully visible
		var OUT = 0.1; // quick drop-out of the old image, after the new one is fully in

		var mm = gsap.matchMedia();

		// Runs only when the viewport is 720px or wider.
		mm.add("(min-width: 720px)", function () {
			var boxes = section.querySelectorAll(".whatgetBox");
			if (boxes.length < 2) {
				return;
			}

			var groups = [];
			boxes.forEach(function (box) {
				var g = [box.querySelector("img:not(.whatgetbg)")];
				if (INCLUDE_BG) {
					g.push(box.querySelector(".whatgetbg"));
				}
				g = g.filter(Boolean);
				if (g.length) {
					groups.push(g);
				}
			});
			var n = groups.length;
			if (n < 2) {
				return;
			}

			var all = [].concat.apply([], groups);
			gsap.set(all, { opacity: 0 });

			var STEP = HOLD + FADE;

			// Handover k: the next image fades in while the current one stays at full opacity,
			// then the current one drops out quickly. Nothing is ever dimmed in between.
			var tl = gsap.timeline({ repeat: -1, paused: true });
			for (var k = 1; k <= n; k++) {
				var from = groups[k - 1];
				var to = groups[k % n];
				var at = k * STEP - FADE;
				tl.to(
					to,
					{ opacity: 1, duration: FADE, ease: "sine.inOut" },
					at,
				);
				tl.to(
					from,
					{ opacity: 0, duration: OUT, ease: "none" },
					at + FADE,
				);
			}

			var started = false;
			ScrollTrigger.create({
				trigger: section,
				start: "top 80%",
				end: "bottom top",
				onToggle: function (self) {
					if (!self.isActive) {
						tl.pause();
						return;
					}
					if (!started) {
						started = true;
						// First image fades in slowly, then the loop takes over.
						gsap.to(groups[0], {
							opacity: 1,
							duration: FADE,
							ease: "sine.inOut",
							onComplete: function () {
								tl.play(0);
							},
						});
					} else {
						tl.play();
					}
				},
			});
		});
	}

	if (document.readyState === "complete") {
		initWhatGetSequence();
	} else {
		window.addEventListener("load", initWhatGetSequence);
	}
})();

// document.addEventListener("DOMContentLoaded", () => {
// 	const containers = document.querySelectorAll(".wrapper .whatgetContent");

// 	const mobileQuery = window.matchMedia("(max-width: 720px)");

// 	containers.forEach((container) => {
// 		const cards = [...container.querySelectorAll(".whatgetBox")];

// 		if (!cards.length) return;

// 		function setImageHeight(card, isOpen) {
// 			const imgBox = card.querySelector(".imgBox");

// 			if (!imgBox) return;

// 			if (!mobileQuery.matches || !isOpen) {
// 				imgBox.style.maxHeight = "";
// 				return;
// 			}

// 			const updateHeight = () => {
// 				if (
// 					!mobileQuery.matches ||
// 					!card.classList.contains("solutionActiveCard")
// 				) {
// 					return;
// 				}

// 				imgBox.style.maxHeight = `${imgBox.scrollHeight}px`;
// 			};

// 			const img = imgBox.querySelector("img");

// 			if (img && !img.complete) {
// 				img.addEventListener("load", updateHeight, { once: true });
// 				img.addEventListener("error", updateHeight, { once: true });
// 			} else {
// 				requestAnimationFrame(updateHeight);
// 			}
// 		}

// 		function openCard(activeCard) {
// 			if (!mobileQuery.matches) return;

// 			cards.forEach((card) => {
// 				const isActive = card === activeCard;

// 				card.classList.toggle("solutionActiveCard", isActive);
// 				setImageHeight(card, isActive);
// 			});
// 		}

// 		function closeAllCards() {
// 			cards.forEach((card) => {
// 				card.classList.remove("solutionActiveCard");
// 				setImageHeight(card, false);
// 			});
// 		}

// 		function initializeAccordion() {
// 			if (mobileQuery.matches) {
// 				// First card ko sirf tab open karo jab initial setup ho.
// 				const activeCard = cards.find((card) =>
// 					card.classList.contains("solutionActiveCard"),
// 				);

// 				if (activeCard) {
// 					openCard(activeCard);
// 				} else if (!container.dataset.accordionInitialized) {
// 					openCard(cards[0]);
// 				}

// 				container.dataset.accordionInitialized = "true";
// 			} else {
// 				closeAllCards();

// 				cards.forEach((card) => {
// 					const imgBox = card.querySelector(".imgBox");

// 					if (imgBox) {
// 						imgBox.style.maxHeight = "";
// 					}
// 				});

// 				container.dataset.accordionInitialized = "";
// 			}
// 		}

// 		initializeAccordion();

// 		cards.forEach((card) => {
// 			card.addEventListener("click", (event) => {
// 				if (!mobileQuery.matches) return;

// 				// Links aur buttons ko ignore karo
// 				if (event.target.closest("a, button")) return;

// 				// Sirf clicked card ki state change hogi
// 				if (card.classList.contains("solutionActiveCard")) {
// 					closeAllCards();
// 				} else {
// 					openCard(card);
// 				}
// 			});
// 		});

// 		// Outside click par accordion state change nahi hogi
// 		document.addEventListener("click", (event) => {
// 			if (!mobileQuery.matches) return;

// 			const clickedInside = event.target.closest(
// 				".secWrapper .cardContainer .solutionCard",
// 			);

// 			if (!clickedInside) {
// 				// Intentionally do nothing
// 				return;
// 			}
// 		});

// 		if (mobileQuery.addEventListener) {
// 			mobileQuery.addEventListener("change", initializeAccordion);
// 		} else {
// 			mobileQuery.addEventListener(initializeAccordion);
// 		}

// 		window.addEventListener("resize", () => {
// 			if (!mobileQuery.matches) return;

// 			const activeCard = cards.find((card) =>
// 				card.classList.contains("solutionActiveCard"),
// 			);

// 			if (activeCard) {
// 				setImageHeight(activeCard, true);
// 			}
// 		});
// 	});
// });

document.addEventListener("DOMContentLoaded", () => {
	const containers = document.querySelectorAll(
		".whatgetSection .whatgetContent",
	);
	const mobileQuery = window.matchMedia("(max-width: 720px)"); // apne SCSS ke media query se match rakhna

	containers.forEach((container) => {
		const cards = [...container.querySelectorAll(".whatgetBox")];
		if (!cards.length) return;

		function openCard(activeCard) {
			cards.forEach((card) => {
				card.classList.toggle("activeCard", card === activeCard);
			});
		}

		function initializeAccordion() {
			if (mobileQuery.matches) {
				// Agar koi card pehle se active nahi hai to pehla open karo
				const activeCard = cards.find((card) =>
					card.classList.contains("activeCard"),
				);
				openCard(activeCard || cards[0]);
			} else {
				// Desktop par sab reset
				cards.forEach((card) => card.classList.remove("activeCard"));
			}
		}

		initializeAccordion();

		cards.forEach((card) => {
			card.addEventListener("click", (event) => {
				if (!mobileQuery.matches) return;
				if (event.target.closest("a, button")) return;

				if (card.classList.contains("activeCard")) {
					card.classList.remove("activeCard");
				} else {
					openCard(card);
				}
			});
		});

		if (mobileQuery.addEventListener) {
			mobileQuery.addEventListener("change", initializeAccordion);
		} else {
			mobileQuery.addListener(initializeAccordion); // old Safari
		}
	});
});

// How Run Animation
(function () {
	"use strict";

	function initHowRun() {
		var section = document.querySelector(".howrunSection");
		if (
			!section ||
			typeof gsap === "undefined" ||
			typeof ScrollTrigger === "undefined"
		) {
			return;
		}
		if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
			return;
		}

		gsap.registerPlugin(ScrollTrigger);

		var img = section.querySelector(".howrunImg img");
		var svg = section.querySelector(".secHeading .lineanim");
		var line = svg ? svg.querySelector(":scope > g") : null;
		var heading = section.querySelector(".howrunContent .secHeading");

		var IMG_DISTANCE = 250; // px it rises from the bottom
		var IMG_TIME = 2; // image speed (higher = slower)
		var LINE_TIME = 2; // line draw speed
		var LINE_DELAY = 0.4; // line starts this long after the image starts

		/* Line draw: a mask that grows left to right (the line is dashed, so
		   stroke-dashoffset can't be used). */
		var rect = null;
		if (svg && line) {
			var NS = "http://www.w3.org/2000/svg";
			var defs =
				svg.querySelector("defs") ||
				svg.insertBefore(
					document.createElementNS(NS, "defs"),
					svg.firstChild,
				);
			var mask = document.createElementNS(NS, "mask");
			mask.setAttribute("id", "howrunLineMask");
			mask.setAttribute("maskUnits", "userSpaceOnUse");
			mask.setAttribute("x", "0");
			mask.setAttribute("y", "0");
			mask.setAttribute("width", "669");
			mask.setAttribute("height", "25");
			rect = document.createElementNS(NS, "rect");
			rect.setAttribute("x", "0");
			rect.setAttribute("y", "0");
			rect.setAttribute("width", "0");
			rect.setAttribute("height", "25");
			rect.setAttribute("fill", "#fff");
			mask.appendChild(rect);
			defs.appendChild(mask);
			line.setAttribute("mask", "url(#howrunLineMask)");
		}

		var tl = gsap.timeline({
			scrollTrigger: {
				trigger: section,
				start: "top 70%",
				toggleActions: "restart none restart none",
			},
		});

		if (img) {
			tl.fromTo(
				img,
				{ y: IMG_DISTANCE, autoAlpha: 0 },
				{ y: 0, autoAlpha: 1, duration: IMG_TIME, ease: "power2.out" },
				0,
			);
		}
		if (heading) {
			tl.fromTo(
				heading,
				{ x: IMG_DISTANCE, autoAlpha: 0 },
				{ x: 0, autoAlpha: 1, duration: IMG_TIME, ease: "power2.out" },
				0,
			);
		}
		if (rect) {
			tl.fromTo(
				rect,
				{ attr: { width: 0 } },
				{
					attr: { width: 669 },
					duration: LINE_TIME,
					ease: "power2.inOut",
				},
				LINE_DELAY,
			);
		}
	}

	if (document.readyState === "complete") {
		initHowRun();
	} else {
		window.addEventListener("load", initHowRun);
	}
})();

// Shared section behaviour.
// Markup opts in with data attributes; nothing runs where they are absent.
//
//   data-accordion            group of panels; one is open (class is-open). Opens on click.
//     data-autoplay="5000"    optional: step through panels until the visitor clicks one.
//     data-accordion-item     a panel (role=button, tabindex=0 recommended)
//     data-accordion-detail   optional detail block shown for the open panel, same order
//   data-toggle-group         rows or cards that open on click, one at a time
//     data-toggle-item / data-toggle (the button inside the item)
//   data-tabs                 data-tab buttons switch data-tab-panel blocks, same order
//   data-reveal               fades in when scrolled into view (class is-visible)
//   data-count="350"          number counts up when visible; keeps any prefix/suffix text
//   data-marquee              children scroll continuously; content is duplicated for a seamless loop
(function () {
	'use strict';

	var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	function onVisible(el, callback, threshold) {
		if (!('IntersectionObserver' in window)) {
			callback(true);
			return;
		}
		new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				callback(entry.isIntersecting);
			});
		}, { threshold: threshold || 0.3 }).observe(el);
	}

	function accordions() {
		document.querySelectorAll('[data-accordion]').forEach(function (root) {
			var items = Array.prototype.slice.call(root.querySelectorAll('[data-accordion-item]'));
			var details = Array.prototype.slice.call(root.querySelectorAll('[data-accordion-detail]'));
			if (!items.length) return;

			var index = Math.max(0, items.findIndex(function (el) { return el.classList.contains('is-open'); }));
			var timer = null;
			var chosen = false;

			function show(next) {
				index = next;
				items.forEach(function (el, i) {
					el.classList.toggle('is-open', i === index);
					el.setAttribute('aria-expanded', String(i === index));
				});
				details.forEach(function (el, i) { el.classList.toggle('is-open', i === index); });
			}

			function choose(i) {
				chosen = true;
				clearInterval(timer);
				timer = null;
				show(i);
			}

			items.forEach(function (el, i) {
				el.addEventListener('click', function () { choose(i); });
				el.addEventListener('keydown', function (e) {
					if (e.key === 'Enter' || e.key === ' ') {
						e.preventDefault();
						choose(i);
					}
				});
			});
			show(index);

			var delay = parseInt(root.getAttribute('data-autoplay') || '0', 10);
			if (!delay || reduceMotion) return;
			onVisible(root, function (visible) {
				if (visible && !chosen && !timer) {
					timer = setInterval(function () { show((index + 1) % items.length); }, delay);
				} else if (!visible) {
					clearInterval(timer);
					timer = null;
				}
			});
		});
	}

	function toggleGroups() {
		document.querySelectorAll('[data-toggle-group]').forEach(function (group) {
			var items = Array.prototype.slice.call(group.querySelectorAll('[data-toggle-item]'));
			items.forEach(function (item) {
				var trigger = item.querySelector('[data-toggle]');
				if (!trigger) return;
				trigger.addEventListener('click', function () {
					var open = !item.classList.contains('is-open');
					items.forEach(function (other) {
						var isOpen = other === item && open;
						other.classList.toggle('is-open', isOpen);
						var t = other.querySelector('[data-toggle]');
						if (t) t.setAttribute('aria-expanded', String(isOpen));
					});
				});
			});
		});
	}

	function tabs() {
		document.querySelectorAll('[data-tabs]').forEach(function (root) {
			var buttons = Array.prototype.slice.call(root.querySelectorAll('[data-tab]'));
			var panels = Array.prototype.slice.call(root.querySelectorAll('[data-tab-panel]'));
			function show(i) {
				buttons.forEach(function (b, k) {
					b.classList.toggle('is-active', k === i);
					b.setAttribute('aria-selected', String(k === i));
				});
				panels.forEach(function (p, k) {
					p.classList.toggle('is-active', k === i);
					p.hidden = k !== i;
				});
			}
			buttons.forEach(function (b, i) { b.addEventListener('click', function () { show(i); }); });
			if (buttons.length) show(Math.max(0, buttons.findIndex(function (b) { return b.classList.contains('is-active'); })));
		});
	}

	function reveal() {
		var items = document.querySelectorAll('[data-reveal]');
		if (reduceMotion || !('IntersectionObserver' in window)) {
			items.forEach(function (el) { el.classList.add('is-visible'); });
			return;
		}
		var io = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-visible');
					io.unobserve(entry.target);
				}
			});
		}, { rootMargin: '0px 0px -10% 0px', threshold: 0.1 });
		items.forEach(function (el) { io.observe(el); });
	}

	function counters() {
		document.querySelectorAll('[data-count]').forEach(function (el) {
			var target = parseFloat(el.getAttribute('data-count'));
			var template = el.textContent;
			var digits = template.match(/[\d,.]+/);
			if (!digits || isNaN(target) || reduceMotion) return;
			var done = false;
			onVisible(el, function (visible) {
				if (!visible || done) return;
				done = true;
				var start = performance.now();
				(function step(now) {
					var t = Math.min(1, (now - start) / 1400);
					var value = Math.round(target * (1 - Math.pow(1 - t, 3)));
					el.textContent = template.replace(digits[0], value.toLocaleString('en-US'));
					if (t < 1) requestAnimationFrame(step);
				})(start);
			}, 0.5);
		});
	}

	function marquees() {
		document.querySelectorAll('[data-marquee]').forEach(function (track) {
			if (track.dataset.marqueeReady) return;
			track.dataset.marqueeReady = '1';
			Array.prototype.slice.call(track.children).forEach(function (child) {
				var copy = child.cloneNode(true);
				copy.setAttribute('aria-hidden', 'true');
				track.appendChild(copy);
			});
		});
	}

	document.addEventListener('DOMContentLoaded', function () {
		accordions();
		toggleGroups();
		tabs();
		reveal();
		counters();
		marquees();
	});
})();

// Home page: typewriter on the AI Atlas chip, and impact story cards that
// open their description on click when they have no link.
(function () {
	'use strict';

	if (!document.body.classList.contains('page-template-hompage')) {
		return;
	}

	var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	// AI Atlas chip: type the word, hold, erase, repeat while it is on screen.
	function typewriter(el) {
		var text = el.getAttribute('data-typewriter') || '';
		var typed = el.querySelector('.atlasChipTyped');
		if (!typed || !text || reduceMotion) {
			return;
		}
		var count = 0;
		var deleting = false;
		var timer = null;
		var running = false;

		function step() {
			typed.textContent = text.slice(0, count);
			var delay = deleting ? 70 : 140;
			if (!deleting && count === text.length) {
				deleting = true;
				delay = 2200;
			} else if (deleting && count === 0) {
				deleting = false;
				delay = 600;
			} else {
				count += deleting ? -1 : 1;
			}
			timer = setTimeout(step, delay);
		}

		function start() {
			if (running) return;
			running = true;
			count = 0;
			deleting = false;
			step();
		}

		function stop() {
			running = false;
			clearTimeout(timer);
			typed.textContent = text;
		}

		if ('IntersectionObserver' in window) {
			new IntersectionObserver(function (entries) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						start();
					} else {
						stop();
					}
				});
			}, { threshold: 0.4 }).observe(el);
		} else {
			start();
		}
	}

	// Impact story cards without a link: click or Enter/Space shows the description.
	function impactCards() {
		document.querySelectorAll('.homeImpactSec .homeImpactCard:not([href])').forEach(function (card) {
			function toggle() {
				var open = !card.classList.contains('is-open');
				card.classList.toggle('is-open', open);
				card.setAttribute('aria-expanded', open ? 'true' : 'false');
			}
			card.addEventListener('click', function (event) {
				event.preventDefault();
				toggle();
			});
			card.addEventListener('keydown', function (event) {
				if (event.key === 'Enter' || event.key === ' ') {
					event.preventDefault();
					toggle();
				}
			});
		});
	}

	function init() {
		document.querySelectorAll('.atlasChipText[data-typewriter]').forEach(typewriter);
		impactCards();
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();

// Platform: the Customer Impact Story cards open their description on click
// (data-toggle-group, above). This adds the keyboard: Enter or Space on a focused card does the same.
(function () {
	'use strict';

	if (!document.body.classList.contains('page-template-platform')) return;

	document.querySelectorAll('.platformResultSec [data-toggle]').forEach(function (box) {
		box.addEventListener('keydown', function (event) {
			if (event.key !== 'Enter' && event.key !== ' ') return;
			event.preventDefault();
			box.click();
		});
	});
})();

// AI Atlas page.
//
// Four Artifacts: a panel opens on click (or Enter / Space), never on hover, and the
// detail block under the panels follows the open panel. On wide screens the accordion above
// leaves the panels alone (its accordion only runs at 820px and below), so the open
// state is set here; at 820px and below that accordion opens and closes the panels and
// this script only keeps the detail block in step.
//
// Customer Impact Stories: a card shows its description on hover, or on click/tap.
(function () {
	'use strict';

	if (!document.body.classList.contains('page-template-ai-atlas')) {
		return;
	}

	function artifacts() {
		var section = document.querySelector('.fourArtifactsSec');
		if (!section) return;

		var cards = Array.prototype.slice.call(section.querySelectorAll('.cardContainer .solutionCard'));
		var details = Array.prototype.slice.call(section.querySelectorAll('.artifactDetailBox .artifactDetail'));
		if (!cards.length) return;

		var mobile = window.matchMedia('(max-width: 820px)');
		// The template marks the panel open on load; the accordion above may already have removed
		// the class from the panel, but not from its detail block.
		var current = Math.max(0, details.findIndex(function (detail) {
			return detail.classList.contains('active');
		}));

		function showDetail(index) {
			details.forEach(function (detail, i) {
				var active = i === index;
				detail.classList.toggle('active', active);
				detail.hidden = !active;
			});
		}

		function syncAria() {
			cards.forEach(function (card) {
				card.setAttribute('aria-expanded', String(card.classList.contains('solutionActiveCard')));
			});
		}

		function open(index) {
			current = index;
			cards.forEach(function (card, i) {
				card.classList.toggle('solutionActiveCard', i === index);
			});
			syncAria();
			showDetail(index);
		}

		cards.forEach(function (card, i) {
			card.addEventListener('click', function () {
				if (mobile.matches) {
					// The accordion above has already opened or closed the panel.
					var openIndex = cards.findIndex(function (c) {
						return c.classList.contains('solutionActiveCard');
					});
					if (openIndex > -1) {
						current = openIndex;
						showDetail(openIndex);
					}
					syncAria();
					return;
				}
				open(i);
			});
			card.addEventListener('keydown', function (e) {
				if (e.key === 'Enter' || e.key === ' ') {
					e.preventDefault();
					card.click();
				}
			});
		});

		// The accordion above closes every panel on wide screens when it starts and when the
		// viewport crosses 820px; reopen the current one.
		if (!mobile.matches) {
			open(current);
		}
		mobile.addEventListener('change', function () {
			if (!mobile.matches) {
				open(current);
			} else {
				syncAria();
			}
		});
	}

	function impactCards() {
		var cards = document.querySelectorAll('.impactStoriesSec .resultCardSlider a');
		var canHover = window.matchMedia('(hover: hover)');

		Array.prototype.forEach.call(cards, function (card) {
			card.addEventListener('click', function (e) {
				var hasLink = card.hasAttribute('href');
				var isOpen = card.classList.contains('isOpen');
				// A linked card follows its link once its description is showing.
				if (hasLink && (isOpen || canHover.matches)) return;
				e.preventDefault();
				Array.prototype.forEach.call(cards, function (other) {
					if (other !== card) other.classList.remove('isOpen');
				});
				card.classList.toggle('isOpen', !isOpen);
			});
			card.addEventListener('keydown', function (e) {
				if (!card.hasAttribute('href') && (e.key === 'Enter' || e.key === ' ')) {
					e.preventDefault();
					card.click();
				}
			});
		});
	}

	function init() {
		artifacts();
		impactCards();
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();

// Greenfield consulting: a click on a Customer Impact Story card opens its description
// (hover still shows it on desktop). Cards without a link of their own do not reload the page.
(function () {
	'use strict';

	if (!document.body.classList.contains('page-template-greenfield-consulting')) return;

	var slider = document.querySelector('.gfImpactSec .platformResultSlider');
	if (!slider) return;

	var canHover = window.matchMedia('(hover: hover)');

	slider.addEventListener('click', function (event) {
		var card = event.target.closest('a');
		if (!card || !slider.contains(card)) return;

		var href = card.getAttribute('href');
		var box = card.querySelector('.box');
		if (!box || !box.querySelector('.moreContent')) return;

		var hasLink = href && href !== '#';
		// With a link: a mouse (which already shows the description on hover) follows it straight away;
		// on touch the first tap opens the description and the second follows the link.
		if (hasLink && (canHover.matches || box.classList.contains('is-open'))) return;

		event.preventDefault();
		var open = !box.classList.contains('is-open');
		slider.querySelectorAll('.box.is-open').forEach(function (el) { el.classList.remove('is-open'); });
		box.classList.toggle('is-open', open);
	});
})();

// Managed AI First Pods.
//
// - What you get: the first column is open from the start. The sequence earlier in this file
//   hides every image until the section scrolls into view; here the first column is shown again
//   right away, and the sequence then carries on from it as before.
// - Customer impact stories: the three cards fill the row on wide screens (the shared slider shows
//   2.8 to 3.5), and a click or tap on a card opens its description (hover still shows it on desktop).
(function () {
	'use strict';

	if (!document.body.classList.contains('page-template-managed-ai-pods')) {
		return;
	}

	function openFirstColumn() {
		var first = document.querySelector('.whatgetSection .whatgetBox');
		if (!first || window.innerWidth < 720) {
			return;
		}
		var parts = first.querySelectorAll('.iconImg, .whatgetbg');
		if (typeof gsap !== 'undefined') {
			gsap.set(parts, { opacity: 1 });
		} else {
			parts.forEach(function (el) { el.style.opacity = '1'; });
		}
	}

	// The theme's sequence starts on window load; run after it.
	if (document.readyState === 'complete') {
		openFirstColumn();
	} else {
		window.addEventListener('load', function () { setTimeout(openFirstColumn, 0); });
	}

	function cardsToShow() {
		return window.innerWidth > 1024 ? 3 : null;
	}

	if (typeof jQuery !== 'undefined') {
		jQuery(function ($) {
			var $slider = $('.mpodsImpactSec .platformResultSlider');
			if (!$slider.length || !$slider.hasClass('slick-initialized')) {
				return;
			}
			function fit() {
				var n = cardsToShow();
				if (n) {
					$slider.slick('slickSetOption', 'slidesToShow', n, true);
				}
			}
			fit();
			// Registered after the theme's own resize handler, so this wins on wide screens.
			$(window).on('resize', fit);
		});
	}

	document.querySelectorAll('.mpodsImpactSec .resultCardSlider a:not([href])').forEach(function (card) {
		function toggle() {
			var box = card.querySelector('.box');
			if (box) {
				box.classList.toggle('is-open');
				card.setAttribute('aria-expanded', String(box.classList.contains('is-open')));
			}
		}
		card.setAttribute('aria-expanded', 'false');
		card.addEventListener('click', toggle);
		card.addEventListener('keydown', function (event) {
			if (event.key === 'Enter' || event.key === ' ') {
				event.preventDefault();
				toggle();
			}
		});
	});
})();

// Talos page: the Operations and governance cards.
// The row slides sideways (it is wider than the screen); a card opens on click or Enter/Space
// through the shared data-toggle-group behaviour above.
(function ($) {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		document.querySelectorAll('.talosOpsSec [data-toggle]').forEach(function (trigger) {
			trigger.addEventListener('keydown', function (e) {
				if (e.key === 'Enter' || e.key === ' ') {
					e.preventDefault();
					trigger.click();
				}
			});
		});

		if (!$ || !$.fn || !$.fn.slick) return;
		$('.talosOpsSlider').slick({
			slidesToShow: 4.2,
			slidesToScroll: 1,
			arrows: false,
			dots: false,
			infinite: false,
			swipeToSlide: true,
			responsive: [
				{ breakpoint: 1281, settings: { slidesToShow: 3.2 } },
				{ breakpoint: 1025, settings: { slidesToShow: 2.6 } },
				{ breakpoint: 720, settings: { slidesToShow: 1.4 } }
			]
		});
	});
})(window.jQuery);

// AI Accelerators and Agents: the hero line drawing draws itself in, stroke by stroke.
// Uses Vivus (loaded in the footer); falls back to a CSS stroke-dashoffset transition.
(function () {
	'use strict';

	function start() {
		var box = document.querySelector('.aiaHeroDraw');
		var svg = box && box.querySelector('svg');
		if (!svg) return;

		function done() {
			box.classList.remove('is-pending');
		}

		if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
			done();
			return;
		}

		if (typeof window.Vivus === 'function') {
			new window.Vivus(svg, {
				type: 'oneByOne',
				duration: 240,
				start: 'autostart',
				animTimingFunction: window.Vivus.EASE_OUT
			}, function () {
				// Leave the finished drawing as plain strokes.
				svg.querySelectorAll('path').forEach(function (p) {
					p.style.strokeDasharray = '';
					p.style.strokeDashoffset = '';
				});
			});
			done();
			return;
		}

		var paths = svg.querySelectorAll('path');
		paths.forEach(function (p, i) {
			var len = p.getTotalLength();
			p.style.strokeDasharray = len + ' ' + len;
			p.style.strokeDashoffset = len;
			p.style.transition = 'stroke-dashoffset 1.2s ease-out ' + (i / paths.length * 2.8).toFixed(3) + 's';
		});
		done();
		requestAnimationFrame(function () {
			requestAnimationFrame(function () {
				paths.forEach(function (p) { p.style.strokeDashoffset = '0'; });
			});
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', start);
	} else {
		start();
	}
})();

// Enterprise Truth Diagnosis and Enterprise Context Architects.
//
//   data-etd-timeline        hour-by-hour track. Steps through its items (data-etd-timeline-item)
//     data-autoplay="3500"   until the visitor clicks, focuses or swipes; the active item is kept in view.
//   .etdKeepCard             numbered cards opened by data-toggle-group (above). This file
//                            measures how far each panel must slide up to show its text, and lets
//                            the panel open from the keyboard.
(function () {
	'use strict';

	var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	function timelines() {
		document.querySelectorAll('[data-etd-timeline]').forEach(function (root) {
			var track = root.querySelector('.etdTimelineTrack');
			var items = Array.prototype.slice.call(root.querySelectorAll('[data-etd-timeline-item]'));
			if (!track || !items.length) return;

			var index = Math.max(0, items.findIndex(function (el) { return el.classList.contains('is-active'); }));
			var timer = null;
			var chosen = false;
			var visible = false;

			function place() {
				var item = items[index];
				var last = items[items.length - 1];
				var max = Math.max(0, last.offsetLeft + last.offsetWidth - root.clientWidth);
				var target = item.offsetLeft + item.offsetWidth / 2 - root.clientWidth / 2;
				var shift = Math.min(max, Math.max(0, target));
				track.style.transform = 'translateX(' + -shift + 'px)';
			}

			function show(next) {
				index = next;
				items.forEach(function (el, i) {
					el.classList.toggle('is-active', i === index);
					el.setAttribute('aria-pressed', String(i === index));
				});
				place();
			}

			function stop() {
				clearInterval(timer);
				timer = null;
			}

			function start() {
				var delay = parseInt(root.getAttribute('data-autoplay') || '0', 10);
				if (!delay || reduceMotion || chosen || timer || !visible || items.length < 2) return;
				timer = setInterval(function () { show((index + 1) % items.length); }, delay);
			}

			function choose(i) {
				chosen = true;
				stop();
				show(i);
			}

			items.forEach(function (el, i) {
				el.addEventListener('click', function () { choose(i); });
				// Keyboard users tabbing to an item that is off to the side bring it into view.
				el.addEventListener('focus', function () { if (i !== index) choose(i); });
			});

			// Swipe left or right on touch screens to move one step.
			var startX = null;
			root.addEventListener('touchstart', function (e) { startX = e.touches[0].clientX; }, { passive: true });
			root.addEventListener('touchend', function (e) {
				if (startX === null) return;
				var dx = e.changedTouches[0].clientX - startX;
				startX = null;
				if (Math.abs(dx) < 40) return;
				choose(Math.min(items.length - 1, Math.max(0, index + (dx < 0 ? 1 : -1))));
			});

			if ('IntersectionObserver' in window) {
				new IntersectionObserver(function (entries) {
					entries.forEach(function (entry) {
						visible = entry.isIntersecting;
						if (visible) start(); else stop();
					});
				}, { threshold: 0.4 }).observe(root);
			}

			window.addEventListener('resize', place);
			show(index);
		});
	}

	function keepCards() {
		var cards = Array.prototype.slice.call(document.querySelectorAll('.etdKeepCard'));
		if (!cards.length) return;

		function measure() {
			cards.forEach(function (card) {
				var panel = card.querySelector('.etdKeepPanel');
				var body = card.querySelector('.panelBody');
				var text = body ? body.querySelector('p') : null;
				if (!panel || !body || !text) return;
				// Slide up until the description sits inside the card with the panel's bottom padding below it.
				var bottomPad = parseFloat(getComputedStyle(body).paddingBottom) || 24;
				var textBottom = panel.offsetTop + text.offsetTop + text.offsetHeight + bottomPad;
				var shift = Math.max(0, textBottom - card.clientHeight);
				card.style.setProperty('--etd-shift', shift + 'px');
			});
		}

		cards.forEach(function (card) {
			var trigger = card.querySelector('[data-toggle][role="button"]');
			if (!trigger) return;
			trigger.addEventListener('keydown', function (e) {
				if (e.key === 'Enter' || e.key === ' ') {
					e.preventDefault();
					trigger.click();
				}
			});
		});

		measure();
		window.addEventListener('resize', measure);
		window.addEventListener('load', measure);
	}

	document.addEventListener('DOMContentLoaded', function () {
		timelines();
		keepCards();
	});
})();

// About us: milestone strip in "Our story".
// The strip steps through the milestones on its own while in view, and stops for good once
// the visitor uses it. Clicking a milestone scrolls to that year's story below.
// Arrow keys move between milestones; a horizontal swipe moves one step.
(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		var root = document.querySelector('[data-about-timeline]');
		if (!root) return;

		var track = root.querySelector('.aboutTimelineTrack');
		var items = Array.prototype.slice.call(root.querySelectorAll('[data-timeline-item]'));
		if (!track || !items.length) return;

		var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
		var index = 0;
		var timer = null;
		var stopped = reduceMotion;
		var hovering = false;
		var visible = false;

		function show(next) {
			index = (next + items.length) % items.length;
			items.forEach(function (el, i) {
				el.classList.toggle('is-active', i === index);
				el.classList.toggle('is-past', i < index);
				if (i === index) {
					el.setAttribute('aria-current', 'step');
				} else {
					el.removeAttribute('aria-current');
				}
			});
			track.style.transform = 'translateX(' + (items[0].offsetLeft - items[index].offsetLeft) + 'px)';
		}

		function sync() {
			var run = !stopped && visible && !hovering;
			if (run && !timer) {
				timer = setInterval(function () { show(index + 1); }, 3000);
			} else if (!run && timer) {
				clearInterval(timer);
				timer = null;
			}
		}

		function stop() {
			stopped = true;
			sync();
		}

		items.forEach(function (el, i) {
			el.addEventListener('click', function (e) {
				var target = document.querySelector(el.getAttribute('href'));
				stop();
				show(i);
				if (target) {
					e.preventDefault();
					target.scrollIntoView({ behavior: reduceMotion ? 'auto' : 'smooth', block: 'start' });
				}
			});
			el.addEventListener('keydown', function (e) {
				var step = e.key === 'ArrowRight' ? 1 : e.key === 'ArrowLeft' ? -1 : 0;
				if (!step) return;
				e.preventDefault();
				stop();
				show(Math.min(items.length - 1, Math.max(0, i + step)));
				items[index].focus({ preventScroll: true });
			});
			el.addEventListener('focus', function () {
				if (i !== index) show(i);
			});
		});

		root.addEventListener('mouseenter', function () { hovering = true; sync(); });
		root.addEventListener('mouseleave', function () { hovering = false; sync(); });

		// Swipe: one step per horizontal drag.
		var startX = null;
		var startY = null;
		var swiped = false;
		root.addEventListener('pointerdown', function (e) { startX = e.clientX; startY = e.clientY; swiped = false; });
		root.addEventListener('pointerup', function (e) {
			if (startX === null) return;
			var dx = e.clientX - startX;
			var dy = e.clientY - startY;
			startX = null;
			if (Math.abs(dx) > 40 && Math.abs(dx) > Math.abs(dy)) {
				swiped = true;
				stop();
				show(Math.min(items.length - 1, Math.max(0, index + (dx < 0 ? 1 : -1))));
			}
		});
		// A swipe that ends on a milestone should not also follow its link.
		root.addEventListener('click', function (e) {
			if (swiped) {
				e.preventDefault();
				e.stopImmediatePropagation();
				swiped = false;
			}
		}, true);

		if ('IntersectionObserver' in window) {
			new IntersectionObserver(function (entries) {
				visible = entries[0].isIntersecting;
				sync();
			}, { threshold: 0.4 }).observe(root);
		}

		window.addEventListener('resize', function () { show(index); });
		show(0);
	});
})();

// Case Studies listing: filter chips (one choice per row, rows combine) and
// "Show more" paging. Runs only where [data-case-studies] is present.
(function () {
	'use strict';

	function init(root) {
		var perPage = parseInt(root.getAttribute('data-per-page') || '9', 10);
		var cards = Array.prototype.slice.call(root.querySelectorAll('[data-case-card]'));
		var rows = Array.prototype.slice.call(root.querySelectorAll('[data-filter-group]'));
		var countEl = root.querySelector('[data-count-text]');
		var more = root.querySelector('.csMore');
		var moreButton = root.querySelector('[data-show-more]');
		var empty = root.querySelector('.csEmpty');
		var active = {};
		var limit = perPage;

		function values(card, group) {
			try {
				return JSON.parse(card.getAttribute('data-' + group.replace(/_/g, '-')) || '[]');
			} catch (e) {
				return [];
			}
		}

		function matches(card) {
			return Object.keys(active).every(function (group) {
				return !active[group] || values(card, group).indexOf(active[group]) !== -1;
			});
		}

		function render() {
			var matching = cards.filter(matches);
			cards.forEach(function (card) { card.classList.add('is-hidden'); });
			matching.slice(0, limit).forEach(function (card) { card.classList.remove('is-hidden'); });
			var shown = Math.min(limit, matching.length);
			if (countEl) {
				countEl.textContent = countEl.getAttribute('data-count-text')
					.replace('%1$s', shown)
					.replace('%2$s', matching.length);
			}
			if (more) more.hidden = matching.length <= limit;
			if (empty) empty.hidden = matching.length > 0;
		}

		rows.forEach(function (row) {
			var group = row.getAttribute('data-filter-group');
			var chips = Array.prototype.slice.call(row.querySelectorAll('[data-filter-value]'));
			active[group] = '';
			chips.forEach(function (chip) {
				chip.addEventListener('click', function () {
					active[group] = chip.getAttribute('data-filter-value');
					chips.forEach(function (other) {
						var on = other === chip;
						other.classList.toggle('is-active', on);
						other.setAttribute('aria-pressed', String(on));
					});
					limit = perPage;
					render();
				});
			});
		});

		if (moreButton) {
			moreButton.addEventListener('click', function () {
				limit += perPage;
				render();
			});
		}

		render();
	}

	document.addEventListener('DOMContentLoaded', function () {
		document.querySelectorAll('[data-case-studies]').forEach(init);
	});
})();

// Case study detail: the "On this page" list highlights the section in view
// and scrolls smoothly to a section when clicked. Runs only where
// [data-case-toc] is present.
(function () {
	'use strict';

	function init(nav) {
		var links = Array.prototype.slice.call(nav.querySelectorAll('a[href^="#"]'));
		var targets = links.map(function (link) {
			return document.getElementById(link.getAttribute('href').slice(1));
		});
		var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
		var ticking = false;

		function setActive(index) {
			links.forEach(function (link, i) {
				link.classList.toggle('is-active', i === index);
				if (i === index) {
					link.setAttribute('aria-current', 'true');
				} else {
					link.removeAttribute('aria-current');
				}
			});
		}

		function update() {
			ticking = false;
			var line = window.innerHeight * 0.35;
			var index = 0;
			targets.forEach(function (target, i) {
				if (target && target.getBoundingClientRect().top <= line) index = i;
			});
			setActive(index);
		}

		links.forEach(function (link, i) {
			link.addEventListener('click', function (e) {
				var target = targets[i];
				if (!target) return;
				e.preventDefault();
				target.scrollIntoView({ behavior: reduceMotion ? 'auto' : 'smooth', block: 'start' });
				if (history.replaceState) history.replaceState(null, '', '#' + target.id);
				setActive(i);
			});
		});

		window.addEventListener('scroll', function () {
			if (!ticking) {
				ticking = true;
				window.requestAnimationFrame(update);
			}
		}, { passive: true });
		update();
	}

	document.addEventListener('DOMContentLoaded', function () {
		document.querySelectorAll('[data-case-toc]').forEach(init);
	});
})();
