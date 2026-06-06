<?php
/**
 * Список товарів у розділі каталогу (bitrix:catalog.section).
 * Картки у стилі шаблону + панель сортування + пагінація.
 * Потрібні CSS: home.css (картки) + catalog.css (панель/пагінація).
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
/** @var array $arParams */
/** @var CMain $APPLICATION */

if (empty($arResult["ITEMS"])):
	?><div class="cat-empty">У цьому розділі поки немає товарів.</div><?php
	return;
endif;
?>
<div class="cat-toolbar">
	<div class="cat-toolbar__count">Знайдено <b><?= (int)$arResult["NAV_RESULT"]->NavRecordCount ?></b> товарів</div>
	<div class="cat-sort">
		<label for="catSort">Сортувати:</label>
		<select id="catSort" onchange="if(this.value)location.href=this.value">
			<option value="">за популярністю</option>
			<option value="?sort=price&order=asc">спочатку дешевші</option>
			<option value="?sort=price&order=desc">спочатку дорожчі</option>
			<option value="?sort=name&order=asc">за назвою</option>
		</select>
	</div>
</div>

<div class="prod-grid">
<?php foreach ($arResult["ITEMS"] as $item):
	$url  = $item["DETAIL_PAGE_URL"];
	$name = $item["NAME"];
	$img  = !empty($item["PREVIEW_PICTURE"]["SRC"]) ? $item["PREVIEW_PICTURE"]["SRC"]
		: (!empty($item["DETAIL_PICTURE"]["SRC"]) ? $item["DETAIL_PICTURE"]["SRC"] : "");

	$priceNow = ""; $priceOld = "";
	if (!empty($item["MIN_PRICE"])) {
		$priceNow = $item["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"] ?: $item["MIN_PRICE"]["PRINT_VALUE"];
		if (!empty($item["MIN_PRICE"]["DISCOUNT_DIFF"]) && $item["MIN_PRICE"]["DISCOUNT_DIFF"] > 0)
			$priceOld = $item["MIN_PRICE"]["PRINT_VALUE"];
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
			<div class="prod__price"><b><?= $priceNow ?></b><?php if ($priceOld): ?><s><?= $priceOld ?></s><?php endif; ?></div>
			<?php endif; ?>
			<a class="btn btn--accent prod__buy" href="<?= htmlspecialcharsbx($url) ?>">Детальніше</a>
		</div>
	</div>
<?php endforeach; ?>
</div>

<?php if (!empty($arResult["NAV_STRING"])): ?>
	<div class="cat-pager"><?= $arResult["NAV_STRING"] ?></div>
<?php endif; ?>
