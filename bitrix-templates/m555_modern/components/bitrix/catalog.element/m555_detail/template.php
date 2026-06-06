<?php
/**
 * Детальна картка товару (bitrix:catalog.element).
 * Двоколонкова розкладка: галерея + інформація/ціна/кнопка купити + властивості.
 * Потрібен CSS: catalog.css.
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
/** @var array $arParams */

$name = $arResult["NAME"];
$main = !empty($arResult["DETAIL_PICTURE"]["SRC"]) ? $arResult["DETAIL_PICTURE"]["SRC"]
	: (!empty($arResult["PREVIEW_PICTURE"]["SRC"]) ? $arResult["PREVIEW_PICTURE"]["SRC"] : "");

// Ціна
$priceNow = ""; $priceOld = ""; $discount = "";
if (!empty($arResult["MIN_PRICE"])) {
	$priceNow = $arResult["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"] ?: $arResult["MIN_PRICE"]["PRINT_VALUE"];
	if (!empty($arResult["MIN_PRICE"]["DISCOUNT_DIFF"]) && $arResult["MIN_PRICE"]["DISCOUNT_DIFF"] > 0) {
		$priceOld = $arResult["MIN_PRICE"]["PRINT_VALUE"];
		if (!empty($arResult["MIN_PRICE"]["DISCOUNT_DIFF_PERCENT"]))
			$discount = "−" . $arResult["MIN_PRICE"]["DISCOUNT_DIFF_PERCENT"] . "%";
	}
}

$buyUrl = $arParams["~BUY_URL_TEMPLATE"] ?: ("?action=BUY&id=" . $arResult["ID"]);
?>
<div class="product">
	<div class="product__gallery">
		<div class="product__photo">
			<?php if ($main): ?>
				<img id="productMainPhoto" src="<?= $main ?>" alt="<?= htmlspecialcharsbx($name) ?>">
			<?php else: ?>
				<svg viewBox="0 0 24 24" width="120" height="120" style="color:#c2cadb"><path d="M4 7h12v8H4V7Zm13 2h2l3 3v3h-1.2a2 2 0 1 1-3.6 0H8.8a2 2 0 1 1-3.6 0H4v-1h13V9Z"/></svg>
			<?php endif; ?>
		</div>
		<?php if (!empty($arResult["MORE_PHOTO"]) && count($arResult["MORE_PHOTO"]) > 1): ?>
		<div class="product__thumbs">
			<?php foreach ($arResult["MORE_PHOTO"] as $photo): ?>
				<img src="<?= $photo["SRC"] ?>" alt="" loading="lazy"
					onclick="document.getElementById('productMainPhoto').src=this.src">
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>

	<div class="product__info">
		<h1 class="product__title"><?= htmlspecialcharsbx($name) ?></h1>

		<div class="product__meta">
			<?php if (!empty($arResult["CATALOG_AVAILABLE"]) && $arResult["CATALOG_AVAILABLE"] === "Y"): ?>
				<span><b>● В наявності</b></span>
			<?php else: ?>
				<span>Під замовлення</span>
			<?php endif; ?>
			<?php if (!empty($arResult["PROPERTIES"]["ARTNUMBER"]["VALUE"])): ?>
				<span>Артикул: <?= htmlspecialcharsbx($arResult["PROPERTIES"]["ARTNUMBER"]["VALUE"]) ?></span>
			<?php endif; ?>
		</div>

		<?php
		// Торгові пропозиції (SKU): рендеримо як перемикач варіантів.
		// Кожен варіант несе свою ціну та посилання купівлі (data-атрибути),
		// клік оновлює ціну і кнопку — без залежності від внутрішнього JS Бітрікс.
		$offers = !empty($arResult["OFFERS"]) ? $arResult["OFFERS"] : array();
		?>
		<?php if ($priceNow || $offers): ?>
		<div class="product__pricebox">
			<div class="product__price">
				<b id="productPrice"><?= $priceNow ?: "—" ?></b>
				<?php if ($priceOld): ?><s id="productPriceOld"><?= $priceOld ?></s><?php endif; ?>
				<?php if ($discount): ?><span class="product__badge"><?= $discount ?></span><?php endif; ?>
			</div>

			<?php if ($offers): ?>
			<div class="product__offers" data-offers>
				<div class="product__offers-label">Виберіть варіант:</div>
				<div class="product__offers-list">
					<?php foreach ($offers as $i => $offer):
						$oPrice = !empty($offer["MIN_PRICE"]) ? ($offer["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"] ?: $offer["MIN_PRICE"]["PRINT_VALUE"]) : "";
						// Назва варіанта: з SKU-властивостей або з назви пропозиції
						$label = $offer["NAME"];
						if (!empty($offer["DISPLAY_PROPERTIES"])) {
							$parts = array();
							foreach ($offer["DISPLAY_PROPERTIES"] as $p)
								$parts[] = is_array($p["DISPLAY_VALUE"]) ? implode("/", $p["DISPLAY_VALUE"]) : $p["DISPLAY_VALUE"];
							if ($parts) $label = implode(" · ", $parts);
						}
						?>
						<button type="button" class="product__offer<?= $i === 0 ? ' is-active' : '' ?>"
							data-offer
							data-price="<?= htmlspecialcharsbx($oPrice) ?>"
							data-buy="?action=BUY&id=<?= $offer["ID"] ?>">
							<?= htmlspecialcharsbx($label) ?>
						</button>
					<?php endforeach; ?>
				</div>
			</div>
			<?php endif; ?>

			<div class="product__actions">
				<a class="btn btn--accent product__buy" id="productBuy" href="<?= htmlspecialcharsbx($buyUrl) ?>" rel="nofollow">
					<svg viewBox="0 0 24 24" width="20" height="20"><path d="M7 18a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm10 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4ZM6.2 4 5.4 2H2v2h2.2l3.1 9.6-1.2 2.1A2 2 0 0 0 7.8 19H20v-2H8.4l1-2h7.5a2 2 0 0 0 1.8-1.2L21.7 7H7.1l-.9-3Z"/></svg>
					Купити
				</a>
				<a class="btn btn--ghost product-fav" href="<?= SITE_DIR ?>personal/cart/?action=DELAY&id=<?= $arResult["ID"] ?>" rel="nofollow" title="Додати в обране">
					<svg viewBox="0 0 24 24" width="20" height="20"><path d="M12 21s-7-4.35-9.5-8.5C.9 9.7 2.3 6 5.6 6c2 0 3.2 1.2 4.4 2.6C11.2 7.2 12.4 6 14.4 6c3.3 0 4.7 3.7 3.1 6.5C19 16.65 12 21 12 21Z"/></svg>
					В обране
				</a>
			</div>
		</div>
		<?php endif; ?>

		<?php if (!empty($arResult["DISPLAY_PROPERTIES"])): ?>
		<table class="product__props">
			<?php foreach ($arResult["DISPLAY_PROPERTIES"] as $prop): ?>
			<tr>
				<th><?= htmlspecialcharsbx($prop["NAME"]) ?></th>
				<td><?= is_array($prop["DISPLAY_VALUE"]) ? implode(", ", $prop["DISPLAY_VALUE"]) : $prop["DISPLAY_VALUE"] ?></td>
			</tr>
			<?php endforeach; ?>
		</table>
		<?php endif; ?>
	</div>
</div>

<?php if (!empty($arResult["DETAIL_TEXT"])): ?>
<div class="product__desc">
	<h2>Опис товару</h2>
	<?= $arResult["DETAIL_TEXT"] ?>
</div>
<?php endif; ?>

<?php
// ───────── Схожі товари ─────────
// Популярні товари з того ж каталогу (за бажанням замініть на товари того ж розділу).
if (!empty($arResult["IBLOCK_ID"])): ?>
<section class="home-section product-related">
	<div class="home-section__head"><h2>Схожі товари</h2></div>
	<?php $APPLICATION->IncludeComponent(
		"bitrix:catalog.top", "m555_hits",
		array(
			"IBLOCK_TYPE"        => $arResult["IBLOCK_TYPE_ID"] ?? "catalog",
			"IBLOCK_ID"          => $arResult["IBLOCK_ID"],
			"ELEMENT_COUNT"      => "4",
			"LINE_ELEMENT_COUNT" => "4",
			"PRICE_CODE"         => array("BASE"),
			"SHOW_OLD_PRICE"     => "Y",
			"BASKET_URL"         => SITE_DIR . "personal/cart/",
			"ELEMENT_SORT_FIELD" => "SHOWS",
			"ELEMENT_SORT_ORDER" => "DESC",
			"CACHE_TYPE"         => "A",
			"CACHE_TIME"         => "3600",
			"CACHE_GROUPS"       => "Y",
		),
		false
	); ?>
</section>
<?php endif; ?>
