<?php
/**
 * Банер-слайдер головної (bitrix:news.list).
 * Слайди беруться з інфоблоку «Банери»:
 *   - Назва        → заголовок слайда
 *   - Анонс (текст)→ підпис під заголовком
 *   - Картинка     → фон слайда (анонсна або детальна)
 *   - Властивість LINK (рядок) → куди веде кнопка (необов'язково;
 *                    інакше використовується посилання на елемент)
 *   - Властивість BTN (рядок)  → текст кнопки (необов'язково)
 * Потрібні CSS (home.css) і JS (script.js) — вже є у шаблоні.
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
if (empty($arResult["ITEMS"])) return;
?>
<div class="home-slider" data-slider>
	<div class="home-slider__track" data-slider-track>
		<?php foreach ($arResult["ITEMS"] as $item):
			$bg = !empty($item["DETAIL_PICTURE"]["SRC"]) ? $item["DETAIL_PICTURE"]["SRC"]
				: (!empty($item["PREVIEW_PICTURE"]["SRC"]) ? $item["PREVIEW_PICTURE"]["SRC"] : "");
			$link = !empty($item["PROPERTIES"]["LINK"]["VALUE"]) ? $item["PROPERTIES"]["LINK"]["VALUE"] : $item["DETAIL_PAGE_URL"];
			$btn  = !empty($item["PROPERTIES"]["BTN"]["VALUE"]) ? $item["PROPERTIES"]["BTN"]["VALUE"] : "Детальніше";
			$style = $bg ? ' style="background-image:url(\'' . $bg . '\')"' : '';
			?>
			<a class="home-slider__slide" href="<?= htmlspecialcharsbx($link) ?>"<?= $style ?>>
				<div class="home-slider__content">
					<h2><?= htmlspecialcharsbx($item["NAME"]) ?></h2>
					<?php if (!empty($item["PREVIEW_TEXT"])): ?>
						<p><?= $item["PREVIEW_TEXT"] ?></p>
					<?php endif; ?>
					<span class="btn btn--accent"><?= htmlspecialcharsbx($btn) ?></span>
				</div>
			</a>
		<?php endforeach; ?>
	</div>

	<?php if (count($arResult["ITEMS"]) > 1): ?>
		<button class="home-slider__arrow home-slider__arrow--prev" type="button" data-slider-prev aria-label="Назад">‹</button>
		<button class="home-slider__arrow home-slider__arrow--next" type="button" data-slider-next aria-label="Вперед">›</button>
		<div class="home-slider__dots" data-slider-dots></div>
	<?php endif; ?>
</div>
