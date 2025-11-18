<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

if (!Loader::includeModule("iblock")) {
    if ($_POST["AJAX"] == "Y") {
        header('Content-Type: application/json');
        echo json_encode(array("success" => false, "message" => "Модуль инфоблоков не подключен"));
        require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
        die();
    }
    return;
}

$iblockId = COption::GetOptionString("main", "car_corp_iblock_id", 0);

if (!$iblockId) {
    if ($_POST["AJAX"] == "Y") {
        header('Content-Type: application/json');
        echo json_encode(array("success" => false, "message" => "Инфоблок не настроен. Запустите install/index.php"));
        require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
        die();
    }
    return;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["FORM_SUBMIT"]) && $_POST["FORM_SUBMIT"] == "Y" && check_bitrix_sessid()) {
    $rangeFrom = isset($_POST["RANGE_FROM"]) ? intval($_POST["RANGE_FROM"]) : 0;
    $rangeTo = isset($_POST["RANGE_TO"]) ? intval($_POST["RANGE_TO"]) : 0;
    $selectValue = isset($_POST["SELECT_VALUE"]) ? htmlspecialcharsbx($_POST["SELECT_VALUE"]) : "";
    $radioValue = isset($_POST["RADIO_OPTION"]) ? htmlspecialcharsbx($_POST["RADIO_OPTION"]) : "";
    $fullName = isset($_POST["FULL_NAME"]) ? htmlspecialcharsbx($_POST["FULL_NAME"]) : "";
    $age = isset($_POST["AGE"]) ? intval($_POST["AGE"]) : 0;
    $requiredCheckbox = isset($_POST["REQUIRED_CHECKBOX"]) && $_POST["REQUIRED_CHECKBOX"] == "Y" ? "Y" : "N";
    $optionalCheckbox = isset($_POST["OPTIONAL_CHECKBOX"]) && $_POST["OPTIONAL_CHECKBOX"] == "Y" ? "Y" : "N";

    $arFields = array(
        "IBLOCK_ID" => $iblockId,
        "NAME" => $fullName ? $fullName : "Заявка от " . date("d.m.Y H:i"),
        "ACTIVE" => "Y",
        "PROPERTY_VALUES" => array(
            "RANGE_FROM" => $rangeFrom,
            "RANGE_TO" => $rangeTo,
            "SELECT_VALUE" => $selectValue,
            "RADIO_OPTION" => $radioValue,
            "FULL_NAME" => $fullName,
            "AGE" => $age,
            "REQUIRED_CHECKBOX" => $requiredCheckbox,
            "OPTIONAL_CHECKBOX" => $optionalCheckbox,
        ),
    );

    $el = new CIBlockElement;
    $result = $el->Add($arFields);

    if ($result) {
        $response = array(
            "success" => true,
            "message" => "Заявка успешно отправлена",
            "id" => $result
        );
    } else {
        $errorMessage = $el->LAST_ERROR ? $el->LAST_ERROR : "Неизвестная ошибка";
        $response = array(
            "success" => false,
            "message" => "Ошибка при сохранении: " . $errorMessage
        );
    }

    if (isset($_POST["AJAX"]) && $_POST["AJAX"] == "Y") {
        header('Content-Type: application/json');
        echo json_encode($response);
        require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
        die();
    }
}

