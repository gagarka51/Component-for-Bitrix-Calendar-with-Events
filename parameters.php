<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Highloadblock\HighloadBlockTable;

if (!CModule::IncludeModule('highloadblock'))
    return;

$arHlBlocksList = [];

$hlBlocks = HighloadBlockTable::getList(array(
    'select' => array('ID', 'NAME'),
    'order' => array('ID'),
    'limit' => 10
));

while ($hlBlock = $hlBlocks->fetch()) {
    $arHlBlocksList[$hlBlock['ID']] = '[' . $hlBlock['ID'] . '] ' . $hlBlock['NAME'];;
}

$arComponentParameters = [
    'PARAMETERS' => [
        'HLBLOCK_ID' => [
            'PARENT' => 'BASE',
            'NAME' => GetMessage('VED_EVENTS_HL_BLOCK_NAME'),
            'TYPE' => 'LIST',
            'MULTIPLE' => 'N',
            'VALUES' => $arHlBlocksList,
            'REFRESH' => 'Y'
        ]
    ]
];
