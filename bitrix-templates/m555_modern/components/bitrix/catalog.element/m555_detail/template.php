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

		<?php if ($priceNow): ?>
		<div class="product__pricebox">
			<div class="product__price">
				<b><?= $priceNow ?></b>
				<?php if ($priceOld): ?><s><?= $priceOld ?></s><?php endif; ?>
				<?php if ($discount): ?><span class="product__badge"><?= $discount ?></span><?php endif; ?>
			</div>
			<div class="product__actions">
				<a class="btn btn--accent product__buy" href="<?= htmlspecialcharsbx($buyUrl) ?>" rel="nofollow">
					<svg viewBox="0 0 24 24" width="20" height="20"><path d="M7 18a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm10 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4ZM6.2 4 5.4 2H2v2h2.2l3.1 9.6-1.2 2.1A2 2 0 0 0 7.8 19H20v-2H8.4l1-2h7.5a2 2 0 0 0 1.8-1.2L21.7 7H7.1l-.9-3Z"/></svg>
					Купити
				</a>
				<a class="btn btn--ghost" href="<?= SITE_DIR ?>personal/cart/">У кошик →</a>
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
