<?php
/**
 * Сітка категорій каталогу для головної (bitrix:catalog.section.list).
 * Виводить розділи інфоблоку картками у стилі шаблону.
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
if (empty($arResult["SECTIONS"])) return;
?>
<div class="cat-grid">
<?php foreach ($arResult["SECTIONS"] as $section):
	$url = $section["SECTION_PAGE_URL"];
	$cnt = isset($section["ELEMENT_CNT"]) ? (int)$section["ELEMENT_CNT"] : 0;
	?>
	<a class="cat-card" href="<?= htmlspecialcharsbx($url) ?>">
		<span class="cat-card__ic">
			<?php if (!empty($section["PICTURE"]["SRC"])): ?>
				<img src="<?= $section["PICTURE"]["SRC"] ?>" alt="<?= htmlspecialcharsbx($section["NAME"]) ?>" loading="lazy">
			<?php else: ?>
				<svg viewBox="0 0 24 24"><path d="M4 6h16v2H4V6Zm0 5h16v2H4v-2Zm0 5h10v2H4v-2Z"/></svg>
			<?php endif; ?>
		</span>
		<b><?= htmlspecialcharsbx($section["NAME"]) ?></b>
		<?php if ($cnt > 0): ?><span><?= $cnt ?> товарів</span><?php endif; ?>
	</a>
<?php endforeach; ?>
</div>
