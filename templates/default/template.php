<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Localization\Loc;
/**
* @var array $arParams
* @var array $arResult
* @var CMain $APPLICATION
* @var CBitrixComponent $component
* @var CBitrixComponentTemplate $this
*/
$arInfoEvs = [];

foreach ($arResult["ITEMS"] as $key => $value) {
	$arInfoEvs[$key]["ID"] = $value["ID"];
	$arInfoEvs[$key]["UF_NAME_EVENT"] = $value["UF_NAME_EVENT"];
	$arInfoEvs[$key]["UF_DESC_EVENT"] = $value["UF_DESC_EVENT"];
	$arInfoEvs[$key]["UF_DATE"] = $value["UF_DATE"]->format("Y-m-d");
	$arInfoEvs[$key]["UF_IMG_EVENT"] = $value["UF_IMG_EVENT"];
}

$calendar = new lib\Calendar();
?>
<div class="calendar">
	<div class="calendar__header">
		<div id="cal-month" class="calendar-month"><?=$calendar->showMonthAndYear(date("M"), date("Y")); ?></div>
	</div>
	<div class="calendar__body">
		<table class="cal-table" id="cal-table">
			<thead>
				<tr class="cal-days-names">
					<td>Пн</td>
					<td>Вт</td>
					<td>Ср</td>
					<td>Чт</td>
					<td>Пт</td>
					<td>Сб</td>
					<td>Вс</td>
				</tr>
			</thead>
			<tbody class="cal-days" id="cal-days">
				<?=$calendar->getCurMonth(date("n"), date("Y"), $arInfoEvs); ?>
			</tbody>
		</table>
	</div>
</div>
