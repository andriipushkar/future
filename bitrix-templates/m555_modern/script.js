/* M555.COM.UA — шаблон m555_modern — інтерактив шапки */
(function () {
	"use strict";

	function ready(fn) {
		if (document.readyState !== "loading") fn();
		else document.addEventListener("DOMContentLoaded", fn);
	}

	ready(function () {
		var header  = document.getElementById("site-header");
		var navbar  = document.getElementById("navbar");
		var burger  = document.querySelector("[data-burger]");
		var catBtn  = document.querySelector("[data-catalog-toggle]");
		var catMenu = document.querySelector("[data-catalog-menu]");
		var toTop   = document.querySelector("[data-to-top]");

		/* Overlay для мобільного меню */
		var overlay = document.createElement("div");
		overlay.className = "nav-overlay";
		document.body.appendChild(overlay);

		/* Липка шапка + кнопка нагору */
		function onScroll() {
			var y = window.pageYOffset || document.documentElement.scrollTop;
			if (header) header.classList.toggle("is-stuck", y > 4);
			if (toTop)  toTop.classList.toggle("is-visible", y > 600);
		}
		window.addEventListener("scroll", onScroll, { passive: true });
		onScroll();

		/* Бургер: відкрити/закрити мобільне меню */
		function closeMobile() {
			if (burger) burger.classList.remove("is-active");
			if (navbar) navbar.classList.remove("is-open");
			overlay.classList.remove("is-visible");
			document.body.style.overflow = "";
		}
		if (burger && navbar) {
			burger.addEventListener("click", function () {
				var open = navbar.classList.toggle("is-open");
				burger.classList.toggle("is-active", open);
				overlay.classList.toggle("is-visible", open);
				document.body.style.overflow = open ? "hidden" : "";
			});
		}
		overlay.addEventListener("click", closeMobile);

		/* Дропдаун каталогу (десктоп) */
		if (catBtn && catMenu) {
			catBtn.addEventListener("click", function (e) {
				e.stopPropagation();
				catMenu.classList.toggle("is-open");
			});
			document.addEventListener("click", function (e) {
				if (!catMenu.contains(e.target) && !catBtn.contains(e.target)) {
					catMenu.classList.remove("is-open");
				}
			});
		}

		/* Плавний скрол «нагору» */
		if (toTop) {
			toTop.addEventListener("click", function (e) {
				e.preventDefault();
				window.scrollTo({ top: 0, behavior: "smooth" });
			});
		}

		/* Esc закриває все */
		document.addEventListener("keydown", function (e) {
			if (e.key === "Escape") {
				closeMobile();
				if (catMenu) catMenu.classList.remove("is-open");
			}
		});

		/* ───────── Банер-слайдер ───────── */
		document.querySelectorAll("[data-slider]").forEach(function (slider) {
			var track  = slider.querySelector("[data-slider-track]");
			var slides = track ? track.children : [];
			if (!track || slides.length === 0) return;

			var dotsBox = slider.querySelector("[data-slider-dots]");
			var index   = 0;
			var timer   = null;
			var DELAY   = 6000;

			// крапки
			var dots = [];
			if (dotsBox && slides.length > 1) {
				for (var i = 0; i < slides.length; i++) {
					var b = document.createElement("button");
					b.type = "button";
					b.setAttribute("aria-label", "Слайд " + (i + 1));
					(function (n) { b.addEventListener("click", function () { go(n); restart(); }); })(i);
					dotsBox.appendChild(b);
					dots.push(b);
				}
			}

			function go(n) {
				index = (n + slides.length) % slides.length;
				track.style.transform = "translateX(" + (-index * 100) + "%)";
				dots.forEach(function (d, i) { d.classList.toggle("is-active", i === index); });
			}
			function next() { go(index + 1); }
			function prev() { go(index - 1); }
			function start() { if (slides.length > 1) timer = setInterval(next, DELAY); }
			function stop()  { if (timer) { clearInterval(timer); timer = null; } }
			function restart() { stop(); start(); }

			var pn = slider.querySelector("[data-slider-next]");
			var pp = slider.querySelector("[data-slider-prev]");
			if (pn) pn.addEventListener("click", function () { next(); restart(); });
			if (pp) pp.addEventListener("click", function () { prev(); restart(); });

			slider.addEventListener("mouseenter", stop);
			slider.addEventListener("mouseleave", start);

			// свайп на тач-екранах
			var x0 = null;
			track.addEventListener("touchstart", function (e) { x0 = e.touches[0].clientX; stop(); }, { passive: true });
			track.addEventListener("touchend", function (e) {
				if (x0 === null) return;
				var dx = e.changedTouches[0].clientX - x0;
				if (Math.abs(dx) > 40) { dx < 0 ? next() : prev(); }
				x0 = null; start();
			}, { passive: true });

			go(0);
			start();
		});

		/* ───────── Перемикач теми (світла/темна) ───────── */
		var themeBtn = document.querySelector("[data-theme-toggle]");
		if (themeBtn) {
			themeBtn.addEventListener("click", function () {
				var cur = document.documentElement.getAttribute("data-theme") === "dark" ? "dark" : "light";
				var next = cur === "dark" ? "light" : "dark";
				document.documentElement.setAttribute("data-theme", next);
				try { localStorage.setItem("m555-theme", next); } catch (e) {}
			});
		}

		/* ───────── Поява блоків при скролі ───────── */
		var reveals = document.querySelectorAll(".reveal");
		if (reveals.length) {
			if (!("IntersectionObserver" in window)) {
				reveals.forEach(function (el) { el.classList.add("is-visible"); });
			} else {
				var io = new IntersectionObserver(function (entries) {
					entries.forEach(function (entry) {
						if (entry.isIntersecting) {
							entry.target.classList.add("is-visible");
							io.unobserve(entry.target);
						}
					});
				}, { threshold: 0.12, rootMargin: "0px 0px -8% 0px" });
				reveals.forEach(function (el) { io.observe(el); });
			}
		}

		/* ───────── Перемикач варіантів товару (SKU) ───────── */
		document.querySelectorAll("[data-offers]").forEach(function (box) {
			var offers   = box.querySelectorAll("[data-offer]");
			var priceEl  = document.getElementById("productPrice");
			var buyEl    = document.getElementById("productBuy");

			function select(btn) {
				offers.forEach(function (o) { o.classList.remove("is-active"); });
				btn.classList.add("is-active");
				if (priceEl && btn.dataset.price) priceEl.textContent = btn.dataset.price;
				if (buyEl && btn.dataset.buy) buyEl.setAttribute("href", btn.dataset.buy);
			}
			offers.forEach(function (btn) {
				btn.addEventListener("click", function () { select(btn); });
			});
			// застосувати початково обраний (перший)
			var active = box.querySelector("[data-offer].is-active") || offers[0];
			if (active) select(active);
		});
	});
})();
