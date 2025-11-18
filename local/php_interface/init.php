<?php
AddEventHandler("iblock", "OnBeforeIBlockElementAdd", "OnBeforeIBlockElementAddTranslit");

function OnBeforeIBlockElementAddTranslit(&$arFields)
{
    $iblockId = COption::GetOptionString("main", "car_corp_iblock_id", 0);
    
    if ($iblockId && $arFields["IBLOCK_ID"] == $iblockId) {
        if (!empty($arFields["NAME"])) {
            $arFields["CODE"] = CUtil::translit(
                $arFields["NAME"],
                "ru",
                array(
                    "max_len" => 100,
                    "change_case" => "L",
                    "replace_space" => "-",
                    "replace_other" => "-",
                    "delete_repeat_replace" => true,
                    "use_google" => false,
                )
            );
        }
    }
}

