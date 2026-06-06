<?php
/**
 * Шаблон m555_modern — footer.php
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var CMain $APPLICATION */

$PHONE_MAIN     = "0 800 50 17 65";
$PHONE_MAIN_TEL = "0800501765";
$PHONE_ALT      = "050 317 08 22";
$PHONE_ALT_TEL  = "0503170822";
$EMAIL          = "info@m555.com.ua";
$YEAR           = date("Y");
?>
		</div><!-- /.content-area -->
	</main>

	<!-- ───────────────────────── FOOTER ───────────────────────── -->
	<footer class="site-footer">
		<div class="container">
			<div class="footer-grid">

				<div class="footer-col footer-col--brand">
					<a class="logo logo--footer" href="<?= SITE_DIR ?>">
						<span class="logo__mark">M</span>
						<span class="logo__text">
							<b>M555<span>.com.ua</span></b>
							<small>Альянс Сервіс Україна</small>
						</span>
					</a>
					<p class="footer-about">
						Офіційний імпортер. Причепи, контейнери, товари для бізнесу,
						дому та саду. Супер ціни та гарантія від виробника.
					</p>
					<div class="footer-social">
						<a href="https://www.facebook.com/people/Інтернет-магазин-M555comua/100063581796774/" target="_blank" rel="noopener" aria-label="Facebook">
							<svg viewBox="0 0 24 24"><path d="M14 9h3V6h-3c-2.2 0-4 1.8-4 4v2H7v3h3v7h3v-7h3l1-3h-4v-2c0-.6.4-1 1-1Z"/></svg>
						</a>
						<a href="viber://chat?number=%2B<?= $PHONE_ALT_TEL ?>" aria-label="Viber">
							<svg viewBox="0 0 24 24"><path d="M12 3c-4.4 0-8 3.2-8 7.2 0 1.8.8 3.5 2 4.8L5 21l4.4-1.7c.8.2 1.7.3 2.6.3 4.4 0 8-3.2 8-7.2S16.4 3 12 3Z"/></svg>
						</a>
						<a href="https://t.me/" target="_blank" rel="noopener" aria-label="Telegram">
							<svg viewBox="0 0 24 24"><path d="m21 4-3 16-5-4-3 3-1-5L4 12l17-8Z"/></svg>
						</a>
					</div>
				</div>

				<div class="footer-col">
					<h3 class="footer-title">Покупцям</h3>
					<?php $APPLICATION->IncludeComponent(
						"bitrix:menu", "m555_footer",
						array(
							"ROOT_MENU_TYPE"        => "bottom",
							"MAX_LEVEL"             => "1",
							"CHILD_MENU_TYPE"       => "left",
							"USE_EXT"               => "N",
							"DELAY"                 => "N",
							"ALLOW_MULTI_SELECT"    => "N",
							"MENU_CACHE_TYPE"       => "A",
							"MENU_CACHE_TIME"       => "3600",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_CACHE_GET_VARS"   => array(),
						),
						false
					); ?>
				</div>

				<div class="footer-col">
					<h3 class="footer-title">Компанія</h3>
					<ul class="footer-links">
						<li><a href="<?= SITE_DIR ?>about/">Про магазин</a></li>
						<li><a href="<?= SITE_DIR ?>services/">Послуги</a></li>
						<li><a href="<?= SITE_DIR ?>brands/">Бренди</a></li>
						<li><a href="<?= SITE_DIR ?>contacts/">Контакти</a></li>
						<li><a href="<?= SITE_DIR ?>sale/">Акції та знижки</a></li>
					</ul>
				</div>

				<div class="footer-col footer-col--contacts">
					<h3 class="footer-title">Контакти</h3>
					<a class="footer-phone" href="tel:<?= $PHONE_MAIN_TEL ?>"><?= $PHONE_MAIN ?></a>
					<a class="footer-phone footer-phone--alt" href="tel:<?= $PHONE_ALT_TEL ?>"><?= $PHONE_ALT ?></a>
					<a class="footer-mail" href="mailto:<?= $EMAIL ?>"><?= $EMAIL ?></a>
					<p class="footer-addr">м. Львів, вул. Ковельська, 109&nbsp;Б</p>
					<div class="footer-pay">
						<span class="pay-badge">Visa</span>
						<span class="pay-badge">Mastercard</span>
						<span class="pay-badge">Готівка</span>
						<span class="pay-badge">Розстрочка</span>
					</div>
				</div>
			</div>

			<div class="footer-bottom">
				<span>© <?= $YEAR ?> M555.COM.UA — ТзОВ «Альянс Сервіс Україна». Усі права захищені.</span>
				<nav class="footer-bottom__links">
					<a href="<?= SITE_DIR ?>privacy/">Політика конфіденційності</a>
					<a href="<?= SITE_DIR ?>oferta/">Публічна оферта</a>
				</nav>
			</div>
		</div>
	</footer>

	<a class="to-top" href="#top" aria-label="Нагору" data-to-top>
		<svg viewBox="0 0 24 24"><path d="m12 6 8 8-1.4 1.4L12 8.8 5.4 15.4 4 14l8-8Z"/></svg>
	</a>
</div><!-- /.page-wrapper -->
</body>
</html>
