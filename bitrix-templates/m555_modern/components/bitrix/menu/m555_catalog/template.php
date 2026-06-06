<?php
/** Меню каталогу у випадному списку. Верхній рівень розділів. */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (empty($arResult)) return;
?>
<ul class="cat-menu">
<?php foreach ($arResult as $arItem):
	if ($arItem["DEPTH_LEVEL"] > 1) continue;
	if ($arItem["PERMISSION"] < "R") continue;
	?>
	<li>
		<a href="<?= $arItem["LINK"] ?>"<?= $arItem["SELECTED"] ? ' class="is-active"' : '' ?>>
			<svg viewBox="0 0 24 24" width="18" height="18" style="opacity:.6"><path d="M4 6h16v2H4V6Zm0 5h16v2H4v-2Zm0 5h10v2H4v-2Z"/></svg>
			<span><?= $arItem["TEXT"] ?></span>
		</a>
	</li>
<?php endforeach; ?>
</ul>
