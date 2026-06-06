<?php
/**
 * ПРИКЛАД вмісту головної сторінки під шаблон m555_modern.
 *
 * Як використати:
 *   1. Скопіюйте вміст цього файлу у головну сторінку сайту
 *      (/index.php для рос. версії або /ua/index.php для укр.).
 *   2. Замініть значення $IBLOCK_TYPE та $IBLOCK_ID на ваші
 *      (Контент → Інфоблоки → ваш каталог товарів).
 *   3. За потреби відредагуйте тексти героя, акцій і переваг.
 *
 * Статичні блоки (герой/акції/переваги) можна редагувати прямо тут
 * або винести у візуальний редактор як включені області.
 */

define("MAIN_PAGE", true); // ховаємо хлібні крихти на головній
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

/** @var CMain $APPLICATION */

// Підключаємо стилі блоків головної
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/home.css");
$APPLICATION->SetTitle("M555.COM.UA — товари для бізнесу, дому та саду");

// ↓↓↓ ВКАЖІТЬ ВАШІ ІНФОБЛОКИ ↓↓↓
$IBLOCK_TYPE   = "catalog";   // тип інфоблоку каталогу
$IBLOCK_ID     = "1";         // ID каталогу товарів
$BANNERS_TYPE  = "content";   // тип інфоблоку банерів
$BANNERS_ID    = "2";         // ID інфоблоку «Банери» для слайдера
// ↑↑↑ ────────────────────────────── ↑↑↑
?>

<!-- ───────── БАНЕР-СЛАЙДЕР ───────── -->
<?php $APPLICATION->IncludeComponent(
	"bitrix:news.list", "m555_slider",
	array(
		"IBLOCK_TYPE"            => $BANNERS_TYPE,
		"IBLOCK_ID"              => $BANNERS_ID,
		"NEWS_COUNT"             => "6",
		"SORT_BY1"               => "SORT",
		"SORT_ORDER1"            => "ASC",
		"FIELD_CODE"             => array("DETAIL_PICTURE", "PREVIEW_PICTURE", ""),
		"PROPERTY_CODE"          => array("LINK", "BTN", ""),
		"DETAIL_URL"             => "",
		"PREVIEW_TRUNCATE_LEN"   => "160",
		"ACTIVE_DATE_FORMAT"     => "d.m.Y",
		"CACHE_TYPE"             => "A",
		"CACHE_TIME"             => "3600",
		"CACHE_GROUPS"           => "Y",
		"DISPLAY_TOP_PAGER"      => "N",
		"DISPLAY_BOTTOM_PAGER"   => "N",
		"SET_TITLE"              => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"AJAX_MODE"              => "N",
	),
	false
); ?>
<?php /*
   Якщо інфоблоку банерів ще немає — створіть його (Контент → Інфоблоки),
   додайте 3–6 елементів із картинкою та текстом. До появи банерів
   замість слайдера можна тимчасово лишити статичний герой:

	<section class="home-hero">
		<div class="home-hero__deco"></div>
		<div class="home-hero__inner">
			<span class="home-hero__badge">🚚 Офіційний імпортер · Гарантія</span>
			<h1>Все для бізнесу, дому та саду — в одному магазині</h1>
			<p>Причепи, контейнери, інструмент і тактичне спорядження.</p>
			<div class="home-hero__cta">
				<a class="btn btn--accent" href="<?= SITE_DIR ?>catalog/">Перейти в каталог</a>
			</div>
		</div>
	</section>
*/ ?>

<!-- ───────── КАТЕГОРІЇ ───────── -->
<section class="home-section reveal">
	<div class="home-section__head">
		<h2>Популярні категорії</h2>
		<a href="<?= SITE_DIR ?>catalog/">Усі категорії →</a>
	</div>
	<?php $APPLICATION->IncludeComponent(
		"bitrix:catalog.section.list", "m555_categories",
		array(
			"IBLOCK_TYPE"      => $IBLOCK_TYPE,
			"IBLOCK_ID"        => $IBLOCK_ID,
			"SECTION_ID"       => "0",
			"SECTION_CODE"     => "",
			"COUNT_ELEMENTS"   => "Y",
			"TOP_DEPTH"        => "1",
			"SECTION_FIELDS"   => array("", ""),
			"SECTION_USER_FIELDS" => array("", ""),
			"CACHE_TYPE"       => "A",
			"CACHE_TIME"       => "3600",
			"CACHE_GROUPS"     => "Y",
			"ADD_SECTIONS_CHAIN" => "N",
		),
		false
	); ?>
</section>

<!-- ───────── ХІТИ ПРОДАЖІВ ───────── -->
<section class="home-section reveal">
	<div class="home-section__head">
		<h2>Хіти продажів</h2>
		<a href="<?= SITE_DIR ?>catalog/">Дивитись усе →</a>
	</div>
	<?php $APPLICATION->IncludeComponent(
		"bitrix:catalog.top", "m555_hits",
		array(
			"IBLOCK_TYPE"        => $IBLOCK_TYPE,
			"IBLOCK_ID"          => $IBLOCK_ID,
			"ELEMENT_COUNT"      => "8",
			"LINE_ELEMENT_COUNT" => "4",
			"PROPERTY_CODE"      => array("", ""),
			"SHOW_DISCOUNT_PERCENT" => "Y",
			"SHOW_OLD_PRICE"     => "Y",
			"PRICE_CODE"         => array("BASE"),
			"PRICE_VAT_INCLUDE"  => "Y",
			"BASKET_URL"         => SITE_DIR . "personal/cart/",
			"ACTION_VARIABLE"    => "action",
			"PRODUCT_ID_VARIABLE"=> "id",
			"SHOW_PRODUCTS_1"    => "Y",
			"ELEMENT_SORT_FIELD" => "SHOWS",
			"ELEMENT_SORT_ORDER" => "DESC",
			"CACHE_TYPE"         => "A",
			"CACHE_TIME"         => "3600",
			"CACHE_GROUPS"       => "Y",
		),
		false
	); ?>
</section>

<!-- ───────── АКЦІЙНІ БАНЕРИ ───────── -->
<section class="promo reveal">
	<div class="promo__card promo__card--a">
		<h3>Безкоштовна доставка</h3>
		<p>На замовлення від 3 000 ₴ по всій Україні</p>
		<a class="btn" style="background:#fff;color:#16a34a;align-self:flex-start" href="<?= SITE_DIR ?>delivery/">Умови доставки</a>
	</div>
	<div class="promo__card promo__card--b">
		<h3>Розпродаж сезону</h3>
		<p>Знижки до 40% на товари для дому та саду</p>
		<a class="btn" style="background:#fff;color:#e85214;align-self:flex-start" href="<?= SITE_DIR ?>sale/">До акцій</a>
	</div>
</section>

<!-- ───────── ПЕРЕВАГИ ───────── -->
<section class="home-section reveal">
	<div class="adv-grid">
		<div class="adv"><span class="adv__ic"><svg viewBox="0 0 24 24"><path d="M12 2 4 5v6c0 5 3.4 9.7 8 11 4.6-1.3 8-6 8-11V5l-8-3Zm-1 13-3-3 1.4-1.4L11 12.2l4.6-4.6L17 9l-6 6Z"/></svg></span><div><b>Офіційна гарантія</b><span>Прямі поставки від виробників</span></div></div>
		<div class="adv"><span class="adv__ic"><svg viewBox="0 0 24 24"><path d="M3 6h11v9H3V6Zm12 3h3l3 3v3h-2a2 2 0 1 1-4 0h-3V9Z"/></svg></span><div><b>Швидка доставка</b><span>Нова Пошта, кур'єр, самовивіз</span></div></div>
		<div class="adv"><span class="adv__ic"><svg viewBox="0 0 24 24"><path d="M3 5h18v12H3V5Zm2 2v8h14V7H5Zm2 9h10v2H7v-2Z"/></svg></span><div><b>Зручна оплата</b><span>Картка, готівка, розстрочка</span></div></div>
		<div class="adv"><span class="adv__ic"><svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20Zm1 10.4 4 2.3-.9 1.6L11 13V6h2v6.4Z"/></svg></span><div><b>Підтримка 0 800</b><span>Безкоштовна гаряча лінія</span></div></div>
	</div>
</section>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
