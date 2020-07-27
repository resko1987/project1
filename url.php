<?php

/*
 * Обработка запросов на сайте
 */

session_start();

defined('__CMS__') or die;

/*
 * Для пользователя
 */
include_once DOCUMENT_ROOT . "/extension/auth/get.php";
include_once DOCUMENT_ROOT . "/system/page/inc.php";
include_once DOCUMENT_ROOT . "/system/theme/inc.php";

/*
 * Отобразим страницы сайта
 */
//if ($p == 0) {
// Токен
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/token.php';
$token = new \project\token();

/**
 * Регистрируем javascript скрипты здесь
 */
$token_js = $token->javascript();
if (strlen($token_js) > 0) {
    $_SESSION['body_javascript'][] = $token_js;
}

$page = new \project\page();
//array_reverse($_SESSION['url']);
$pageArray = $page->init();
//echo "site_title: {$_SESSION['site_title']}<br/>\n";
//print_r($pageArray);
//print_r($_SESSION);

$theme = new \project\theme();
if (count($_SESSION['page']) > 0) {
    $html = $theme->getTemplateFile($pageArray['server_name'], '');
} else {
    $html = $theme->getTemplateFile($pageArray['server_name'], 'E');
}
//print_r($_SESSION['page']['info']);

echo $html;
//}



