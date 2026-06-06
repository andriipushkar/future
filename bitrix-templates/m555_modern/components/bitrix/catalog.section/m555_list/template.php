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
