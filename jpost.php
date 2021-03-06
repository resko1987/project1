<?php

/*
 * Все POST запросы отправляем на эту форму
 */
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
//include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php'; не подключаем а то токен не будет работать
include_once $_SERVER['DOCUMENT_ROOT'] . '/system/extension/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';

if (isset($_POST)) {
    //echo "post \n";
    // Результат выполнения запроса
    $result = array();
    $_SESSION['errors'] = array();

    /*
     *  Регистрация token
     */
    if (isset($_POST['t'])) {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/class/token.php';
        $token = new \project\token();

        // Сам хеш если он есть 
        if (!isset($_SESSION['token_hash'])) {
            $_SESSION['token_hash'] = '';
        }

        if ($token->register()) {
            /*
             * Соберем статистику о посетителе
             */
            if (is_file($_SERVER['DOCUMENT_ROOT'] . '/extension/statistic/inc.php')) {
                include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/statistic/inc.php';
                $statistic = new \project\statistic();
                $_SESSION['browser']['height'] = $_POST['h'];
                $_SESSION['browser']['width'] = $_POST['w'];
                $statistic->visitorInit();
                unset($_SESSION['browser']['height']);
                unset($_SESSION['browser']['width']);
            }
            $result = array('t' => 1);
        } else {
            $result = array('t' => 0);
        }
    }

    /*
     * Регистрация разрешения cookie 
     */
    if (isset($_POST['bottom_cookie_btn'])) {
        $cookie_val = $_SESSION['SERVER_NAME'] . '_cookie_access';
        setcookie($cookie_val, '1');
        $result = array('success' => 1, 'success_text' => '', 'data' => $cookie_val);
    }

    // Определим пользователя и разрешим ему отправлять запросы
    if (isset($_SESSION['token_hash']) && strlen($_SESSION['token_hash']) > 0) {
        //include_once $_SERVER['DOCUMENT_ROOT'] . '/system/user/auth/jpost.php';

        /*
         * Отправляем данные на расширения
         */
        if (isset($_GET['extension']) && strlen($_GET['extension']) > 0) {
            if (is_file($_SERVER['DOCUMENT_ROOT'] . '/extension/' . $_GET['extension'] . '/jpost.php')) {
                //echo $_SERVER['DOCUMENT_ROOT'] . '/extension/' . $_GET['extension'] . '/jpost.php' . "\n";
                include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/' . $_GET['extension'] . '/jpost.php';
            } else {
                $_SESSION['errors'][] = 'Not file jpost!';
            }
        }
    }

    /*
     * Отправка только редакторы сайта
     */
    $user = new \project\user();
    if ($user->isEditor()) {
        include $_SERVER['DOCUMENT_ROOT'] . '/system/extension/jpost.php';
    }

    /*
     * Обработки
     * Если имеются ошибки!
     */
    if ($result['success'] == '0') {
        //$result = array('success' => 0, 'errors' => array($result['success_text']));
        if (isset($result['success_text']) && strlen($result['success_text']) > 0) {
            $_SESSION['errors'] = array();
            $_SESSION['errors'][] = $result['success_text'];
        }
    }
    if (is_array($_SESSION['errors']) && count($_SESSION['errors']) > 0) {
        $result = array('success' => 0, 'errors' => $_SESSION['errors']);
    }


    $_SESSION['errors'] = array();

    echo json_encode($result);
}