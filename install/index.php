<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
use Bitrix\Iblock\IblockTable;
use Bitrix\Iblock\PropertyTable;
use Bitrix\Iblock\TypeTable;

Loader::includeModule("iblock");

$iblockTypeId = "car_corp_forms";
$iblockCode = "car_corp_forms";
$iblockName = "Заявки Car Corp";

$iblockType = new CIBlockType;
$arFieldsType = array(
    "ID" => $iblockTypeId,
    "SECTIONS" => "Y",
    "EDIT_FILE_BEFORE" => "",
    "EDIT_FILE_AFTER" => "",
    "IN_RSS" => "N",
    "SORT" => 100,
    "LANG" => array(
        "ru" => array(
            "NAME" => "Формы Car Corp",
            "SECTION_NAME" => "Разделы",
            "ELEMENT_NAME" => "Элементы"
        )
    )
);

$res = $iblockType->Add($arFieldsType);
if (!$res && $iblockType->LAST_ERROR) {
    if (strpos($iblockType->LAST_ERROR, "already exists") === false) {
        echo "Ошибка создания типа инфоблока: " . $iblockType->LAST_ERROR . "<br>";
    }
}

$iblock = new CIBlock;
$arFields = Array(
    "ACTIVE" => "Y",
    "NAME" => $iblockName,
    "CODE" => $iblockCode,
    "IBLOCK_TYPE_ID" => $iblockTypeId,
    "SITE_ID" => array("s1"),
    "SORT" => 500,
    "LIST_PAGE_URL" => "",
    "DETAIL_PAGE_URL" => "",
    "SECTION_PAGE_URL" => "",
    "CANONICAL_PAGE_URL" => "",
    "PICTURE" => "",
    "DESCRIPTION" => "",
    "DESCRIPTION_TYPE" => "text",
    "RSS_TTL" => 24,
    "RSS_ACTIVE" => "Y",
    "RSS_FILE_ACTIVE" => "N",
    "RSS_FILE_LIMIT" => "",
    "RSS_FILE_DAYS" => "",
    "RSS_YANDEX_ACTIVE" => "N",
    "XML_ID" => "",
    "INDEX_ELEMENT" => "Y",
    "INDEX_SECTION" => "N",
    "WORKFLOW" => "N",
    "BIZPROC" => "N",
    "SECTION_CHOOSER" => "L",
    "LIST_MODE" => "",
    "RIGHTS_MODE" => "S",
    "SECTION_PROPERTY" => "N",
    "PROPERTY_INDEX" => "N",
    "VERSION" => 1,
    "LAST_CONV_ELEMENT" => 0,
    "SOCNET_GROUP_ID" => "",
    "EDIT_FILE_BEFORE" => "",
    "EDIT_FILE_AFTER" => "",
    "SECTIONS_NAME" => "Разделы",
    "SECTION_NAME" => "Раздел",
    "ELEMENTS_NAME" => "Элементы",
    "ELEMENT_NAME" => "Элемент",
    "EXTERNAL_ID" => "",
    "LANG_DIR" => "/",
    "SERVER_NAME" => ""
);

$iblockId = $iblock->Add($arFields);

if ($iblockId) {
    COption::SetOptionString("main", "car_corp_iblock_id", $iblockId);

    $arProps = array(
        array(
            "NAME" => "Диапазон от",
            "ACTIVE" => "Y",
            "SORT" => "100",
            "CODE" => "RANGE_FROM",
            "PROPERTY_TYPE" => "N",
            "MULTIPLE" => "N",
            "IS_REQUIRED" => "N",
            "IBLOCK_ID" => $iblockId
        ),
        array(
            "NAME" => "Диапазон до",
            "ACTIVE" => "Y",
            "SORT" => "200",
            "CODE" => "RANGE_TO",
            "PROPERTY_TYPE" => "N",
            "MULTIPLE" => "N",
            "IS_REQUIRED" => "N",
            "IBLOCK_ID" => $iblockId
        ),
        array(
            "NAME" => "Значение select",
            "ACTIVE" => "Y",
            "SORT" => "300",
            "CODE" => "SELECT_VALUE",
            "PROPERTY_TYPE" => "S",
            "MULTIPLE" => "N",
            "IS_REQUIRED" => "N",
            "IBLOCK_ID" => $iblockId
        ),
        array(
            "NAME" => "Радио кнопка",
            "ACTIVE" => "Y",
            "SORT" => "400",
            "CODE" => "RADIO_OPTION",
            "PROPERTY_TYPE" => "S",
            "MULTIPLE" => "N",
            "IS_REQUIRED" => "N",
            "IBLOCK_ID" => $iblockId
        ),
        array(
            "NAME" => "ФИО",
            "ACTIVE" => "Y",
            "SORT" => "500",
            "CODE" => "FULL_NAME",
            "PROPERTY_TYPE" => "S",
            "MULTIPLE" => "N",
            "IS_REQUIRED" => "N",
            "IBLOCK_ID" => $iblockId
        ),
        array(
            "NAME" => "Возраст",
            "ACTIVE" => "Y",
            "SORT" => "600",
            "CODE" => "AGE",
            "PROPERTY_TYPE" => "N",
            "MULTIPLE" => "N",
            "IS_REQUIRED" => "N",
            "IBLOCK_ID" => $iblockId
        ),
        array(
            "NAME" => "Обязательный checkbox",
            "ACTIVE" => "Y",
            "SORT" => "700",
            "CODE" => "REQUIRED_CHECKBOX",
            "PROPERTY_TYPE" => "S",
            "MULTIPLE" => "N",
            "IS_REQUIRED" => "N",
            "IBLOCK_ID" => $iblockId
        ),
        array(
            "NAME" => "Необязательный checkbox",
            "ACTIVE" => "Y",
            "SORT" => "800",
            "CODE" => "OPTIONAL_CHECKBOX",
            "PROPERTY_TYPE" => "S",
            "MULTIPLE" => "N",
            "IS_REQUIRED" => "N",
            "IBLOCK_ID" => $iblockId
        )
    );

    $ibp = new CIBlockProperty;
    foreach ($arProps as $arProp) {
        $ibp->Add($arProp);
    }

    echo "Инфоблок успешно создан. ID: " . $iblockId;
} else {
    echo "Ошибка создания инфоблока: " . $iblock->LAST_ERROR;
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>

