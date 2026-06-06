<?php
/**
 * Шаблон m555_modern — header.php
 * Сучасний адаптивний шаблон для інтернет-магазину M555.COM.UA (1С-Бітрікс).
 *
 * Використовує лише стандартні компоненти ядра (menu, breadcrumb, search),
 * тому встановлюється без правок структури сайту.
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var CMain $APPLICATION */

use Bitrix\Main\Page\Asset;

IncludeTemplateLangFile(__FILE__);

// Контактні дані магазину (за потреби змініть тут)
$PHONE_MAIN     = "0 800 50 17 65";
$PHONE_MAIN_TEL = "0800501765";
$PHONE_ALT      = "050 317 08 22";
$PHONE_ALT_TEL  = "0503170822";
$EMAIL          = "info@m555.com.ua";
$WORK_HOURS     = "Пн–Пт 9:00–18:00";

$tpl = SITE_TEMPLATE_PATH;
?><!DOCTYPE html>
<html lang="<?= LANGUAGE_ID ?>">
<head>
	<?php $APPLICATION->ShowHead(); ?>
	<title><?php $APPLICATION->ShowTitle(); ?></title>
	<meta charset="<?= LANG_CHARSET ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<meta name="theme-color" content="#0f3aa0">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
	<?php
	Asset::getInstance()->addCss($tpl . "/template_styles.css");
	Asset::getInstance()->addJs($tpl . "/script.js");
	?>
</head>
<body class="m555">
<?php $APPLICATION->ShowPanel(); ?>

<div class="page-wrapper" id="top">

	<!-- ───────────────────────── TOP BAR ───────────────────────── -->
	<div class="topbar">
		<div class="container topbar__inner">
			<div class="topbar__left">
				<span class="topbar__city">
					<svg viewBox="0 0 24 24" class="ic"><path d="M12 2a7 7 0 0 0-7 7c0 5 7 13 7 13s7-8 7-13a7 7 0 0 0-7-7Zm0 9.5A2.5 2.5 0 1 1 12 6.5a2.5 2.5 0 0 1 0 5Z"/></svg>
					Львів, вул. Ковельська 109&nbsp;Б
				</span>
				<span class="topbar__hours">
					<svg viewBox="0 0 24 24" class="ic"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20Zm1 10.4 4 2.3-.9 1.6L11 13V6h2v6.4Z"/></svg>
					<?= $WORK_HOURS ?>
				</span>
			</div>
			<nav class="topbar__nav">
				<?php $APPLICATION->IncludeComponent(
					"bitrix:menu", "m555_top",
					array(
						"ROOT_MENU_TYPE"        => "top",
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
			</nav>
		</div>
	</div>

	<!-- ───────────────────────── HEADER ───────────────────────── -->
	<header class="site-header" id="site-header">
		<div class="container site-header__inner">

			<button class="burger" type="button" aria-label="Меню" data-burger>
				<span></span><span></span><span></span>
			</button>

			<a class="logo" href="<?= SITE_DIR ?>">
				<span class="logo__mark">M</span>
				<span class="logo__text">
					<b>M555<span>.com.ua</span></b>
					<small>Альянс Сервіс Україна</small>
				</span>
			</a>

			<form class="search" action="<?= SITE_DIR ?>search/" method="get" role="search">
				<input class="search__input" type="text" name="q" placeholder="Пошук товарів: причепи, контейнери, інструмент…" autocomplete="off">
				<button class="search__btn" type="submit" aria-label="Знайти">
					<svg viewBox="0 0 24 24"><path d="M10 4a6 6 0 1 0 3.9 10.6l4.7 4.7 1.4-1.4-4.7-4.7A6 6 0 0 0 10 4Zm0 2a4 4 0 1 1 0 8 4 4 0 0 1 0-8Z"/></svg>
					<span>Знайти</span>
				</button>
			</form>

			<div class="header-actions">
				<a class="ha ha--phone" href="tel:<?= $PHONE_MAIN_TEL ?>">
					<svg viewBox="0 0 24 24" class="ha__ic"><path d="M6.6 10.8a15 15 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1-.25 11.4 11.4 0 0 0 3.6.6 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.46.6 3.6a1 1 0 0 1-.25 1l-2.25 2.2Z"/></svg>
					<span class="ha__txt">
						<b><?= $PHONE_MAIN ?></b>
						<small>Безкоштовно по Україні</small>
					</span>
				</a>
				<a class="ha ha--cart" href="<?= SITE_DIR ?>personal/cart/">
					<svg viewBox="0 0 24 24" class="ha__ic"><path d="M7 18a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm10 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4ZM6.2 4 5.4 2H2v2h2.2l3.1 9.6-1.2 2.1A2 2 0 0 0 7.8 19H20v-2H8.4l1-2h7.5a2 2 0 0 0 1.8-1.2L21.7 7H7.1l-.9-3Z"/></svg>
					<span class="ha__txt">
						<b>Кошик</b>
						<small data-cart-count>порожній</small>
					</span>
				</a>
			</div>
		</div>
	</header>

	<!-- ───────────────────────── NAV ───────────────────────── -->
	<nav class="navbar" id="navbar">
		<div class="container navbar__inner">
			<button class="catalog-btn" type="button" data-catalog-toggle>
				<svg viewBox="0 0 24 24"><path d="M3 5h18v2H3V5Zm0 6h18v2H3v-2Zm0 6h18v2H3v-2Z"/></svg>
				<span>Каталог товарів</span>
			</button>

			<div class="catalog-dropdown" data-catalog-menu>
				<?php $APPLICATION->IncludeComponent(
					"bitrix:menu", "m555_catalog",
					array(
						"ROOT_MENU_TYPE"        => "left",
						"MAX_LEVEL"             => "2",
						"CHILD_MENU_TYPE"       => "left",
						"USE_EXT"               => "Y",
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

			<nav class="navbar__links">
				<a href="<?= SITE_DIR ?>about/">Про магазин</a>
				<a href="<?= SITE_DIR ?>services/">Послуги</a>
				<a href="<?= SITE_DIR ?>delivery/">Доставка та оплата</a>
				<a href="<?= SITE_DIR ?>brands/">Бренди</a>
				<a class="navbar__links-accent" href="<?= SITE_DIR ?>sale/">Акції</a>
			</nav>
		</div>
	</nav>

	<!-- ───────────────────────── MAIN ───────────────────────── -->
	<main class="site-main">
		<?php if (!defined("MAIN_PAGE")): // на головній breadcrumb не показуємо ?>
		<div class="container">
			<?php $APPLICATION->IncludeComponent(
				"bitrix:breadcrumb", "m555",
				array(
					"START_FROM" => "0",
					"PATH"       => "",
					"SITE_ID"    => SITE_ID,
				),
				false
			); ?>
		</div>
		<?php endif; ?>

		<div class="container content-area">
