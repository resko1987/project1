<?php
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';

include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/lang/' . $_SESSION['lang'] . '.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/auth/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
$user = new \project\user();

if (!$user->isEditor()) {
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
    location_href('/');
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Докумнтация</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    </head>
    <body style="display: flex;flex-direction: column;height:98vh;margin: 0;padding: 0;">
        <div class="container-fluid h-100">
            <div class="row h-100" >
                <div class="col-2">
                    <h3>Меню</h3>
                    <p><a href="items/index.html" target="iframe_a">Главная</a></p>
                    <p><a href="items/login.html" target="iframe_a">Логин</a></p>
                    <p>Товары</p>
                    <p><a href="items/statistik.html" target="iframe_a">Статистика</a></p>
                    <p><a href="items/consultation.html" target="iframe_a">Консультации</a></p>
                    <p><a href="items/pays.html" target="iframe_a">Покупки</a></p>
                    <p><a href="items/products.html" target="iframe_a">Продукты</a></p>
                    <p><a href="items/wares.html" target="iframe_a">Товары</a></p>
                    <p>Сайт</p> 
                    <p><a href="items/pages.html" target="iframe_a">Страницы</a></p>
                    <p><a href="items/menu.html" target="iframe_a">Меню</a></p>
                    <p><a href="items/users.html" target="iframe_a">Пользователи</a></p>
                    <p><a href="items/themes.html" target="iframe_a">Шаблоны</a></p>
                    <p>Настройки</p>
                    <p><a href="items/configs.html" target="iframe_a">Настройки сайта</a></p>
                    <p><a href="items/config_email.html" target="iframe_a">Почтовые оповещения</a></p>
                </div>
                <div class="col-10 h-100">
                    <iframe src="items/index.html" name="iframe_a" class="w-100 h-100" style="border: none;"></iframe>
                </div>
            </div>
        </div>
    </body>
</html>
