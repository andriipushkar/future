<?php
/**
 * Картки товарів «Хіти продажів» для головної (bitrix:catalog.top).
 * Виводить товари у стилі шаблону. Картка веде на сторінку товару,
 * де працює ваш наявний компонент додавання в кошик.
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
if (empty($arResult["ITEMS"])) return;
?>
<div class="prod-grid">
<?php foreach ($arResult["ITEMS"] as $item):
	$url  = $item["DETAIL_PAGE_URL"];
	$name = $item["NAME"];
	$img  = !empty($item["PREVIEW_PICTURE"]["SRC"]) ? $item["PREVIEW_PICTURE"]["SRC"]
		: (!empty($item["DETAIL_PICTURE"]["SRC"]) ? $item["DETAIL_PICTURE"]["SRC"] : "");

	// Ціна: беремо мінімальну з розрахованих компонентом
	$priceNow = "";
	$priceOld = "";
	if (!empty($item["MIN_PRICE"])) {
		$priceNow = $item["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"] ?: $item["MIN_PRICE"]["PRINT_VALUE"];
		if (!empty($item["MIN_PRICE"]["DISCOUNT_DIFF"]) && $item["MIN_PRICE"]["DISCOUNT_DIFF"] > 0) {
			$priceOld = $item["MIN_PRICE"]["PRINT_VALUE"];
		}
	} elseif (!empty($item["PRICES"])) {
		$first = reset($item["PRICES"]);
		$priceNow = $first["PRINT_DISCOUNT_VALUE"] ?: $first["PRINT_VALUE"];
	}
	?>
	<div class="prod">
		<div class="prod__tools">
			<a class="prod__tool prod__tool--fav" href="<?= SITE_DIR ?>personal/cart/?action=DELAY&id=<?= $item["ID"] ?>" rel="nofollow" title="В обране" aria-label="В обране">
				<svg viewBox="0 0 24 24"><path d="M12 21s-7-4.35-9.5-8.5C.9 9.7 2.3 6 5.6 6c2 0 3.2 1.2 4.4 2.6C11.2 7.2 12.4 6 14.4 6c3.3 0 4.7 3.7 3.1 6.5C19 16.65 12 21 12 21Z"/></svg>
			</a>
			<a class="prod__tool prod__tool--cmp" href="?action=ADD_TO_COMPARE_LIST&id=<?= $item["ID"] ?>" rel="nofollow" title="До порівняння" aria-label="До порівняння">
				<svg viewBox="0 0 24 24"><path d="M5 21V9H8v12H5Zm5.5 0V3h3v18h-3ZM16 21v-7h3v7h-3Z"/></svg>
			</a>
		</div>
		<a class="prod__img" href="<?= htmlspecialcharsbx($url) ?>">
			<?php if (!empty($item["IS_NEW"])): ?><span class="prod__tag prod__tag--new">Новинка</span><?php endif; ?>
			<?php if ($priceOld): ?><span class="prod__tag">Знижка</span><?php endif; ?>
			<?php if ($img): ?>
				<img src="<?= $img ?>" alt="<?= htmlspecialcharsbx($name) ?>" loading="lazy">
			<?php else: ?>
				<svg viewBox="0 0 24 24"><path d="M4 7h12v8H4V7Zm13 2h2l3 3v3h-1.2a2 2 0 1 1-3.6 0H8.8a2 2 0 1 1-3.6 0H4v-1h13V9Z"/></svg>
			<?php endif; ?>
		</a>
		<div class="prod__body">
			<div class="prod__name"><a href="<?= htmlspecialcharsbx($url) ?>"><?= htmlspecialcharsbx($name) ?></a></div>
			<?php if ($priceNow): ?>
			<div class="prod__price">
				<b><?= $priceNow ?></b>
				<?php if ($priceOld): ?><s><?= $priceOld ?></s><?php endif; ?>
			</div>
			<?php endif; ?>
			<a class="btn btn--accent prod__buy" href="<?= htmlspecialcharsbx($url) ?>">Купити</a>
		</div>
	</div>
<?php endforeach; ?>
</div>
