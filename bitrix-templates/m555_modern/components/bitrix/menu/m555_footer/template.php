<?php
/** Меню підвалу (тип "bottom"). Один рівень. */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (empty($arResult)) return;
?>
<ul class="footer-links">
<?php foreach ($arResult as $arItem):
	if ($arItem["DEPTH_LEVEL"] > 1) continue;
	if ($arItem["PERMISSION"] < "R") continue;
	?>
	<li><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
<?php endforeach; ?>
</ul>
