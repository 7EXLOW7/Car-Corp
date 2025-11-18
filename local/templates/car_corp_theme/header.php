<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/main.css");
$APPLICATION->AddHeadString('<link rel="preconnect" href="https://fonts.googleapis.com">', true);
$APPLICATION->AddHeadString('<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>', true);
$APPLICATION->AddHeadString('<link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@400;500;700&display=swap" rel="stylesheet">', true);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?$APPLICATION->ShowTitle()?></title>
  <?$APPLICATION->ShowHead();?>
</head>
<body class="page">
<?$APPLICATION->ShowPanel();?>

