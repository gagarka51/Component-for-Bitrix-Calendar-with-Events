<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Type\DateTime;

class VeditaEventsComponent extends CBitrixComponent
{
	public function onIncludeComponentLang()
    {
        Loc::loadMessages(__FILE__);
    }

    protected function checkModules()
    {
        if (!Loader::includeModule('highloadblock')){
        	ShowError("Модуль highloadblock(«highload-блоки») не подключен");
    	}
    }

    public function onPrepareComponentParams($arParams)
    {
        if (!isset($arParams["HLBLOCK_ID"])) {
			ShowError("Highload-блок не был выбран");
    	}

        return $arParams;
    }

    public function getResult()
    {
        if (!$this->checkModules()) {
            $arHlBlock = HighloadBlockTable::getById($this->arParams['HLBLOCK_ID'])->fetch();
            $obEntity = HighloadBlockTable::compileEntity($arHlBlock);
            $strEntityDataClass = $obEntity->getDataClass();
            $rsData = $strEntityDataClass::getList(array(
                'select' => array('*'),
                'order' => array('ID')
            ))->fetchALL();

            $arResult["ITEMS"] = $rsData;
        }

        return $arResult;
    }

    public function executeComponent()
    {
    	if (!$this->checkModules()) {
            $this->arResult = $this->getResult();
    		$this->IncludeComponentTemplate();
    	}
    }
}