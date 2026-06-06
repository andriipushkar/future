<?php
/** Хлібні крихти. */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */

$strReturn = '';
$itemSize  = count($arResult);
if ($itemSize <= 0) return '';

$strReturn .= '<nav class="breadcrumbs" aria-label="Хлібні крихти">';

for ($i = 0; $i < $itemSize; $i++) {
	$title = htmlspecialcharsex($arResult[$i]["TITLE"]);
	$last  = ($i == $itemSize - 1);

	if ($arResult[$i]["LINK"] <> "" && !$last) {
		$strReturn .= '<a href="' . $arResult[$i]["LINK"] . '">' . $title . '</a>';
		$strReturn .= '<span class="breadcrumbs__sep">›</span>';
	} else {
		$strReturn .= '<span class="breadcrumbs__current">' . $title . '</span>';
	}
}

$strReturn .= '</nav>';

return $strReturn;
