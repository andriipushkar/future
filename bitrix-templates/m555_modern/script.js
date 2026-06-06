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
	});
})();
