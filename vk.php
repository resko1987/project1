<?php

session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/init.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/users/inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/auth/inc.php';

$p_user = new \project\user();
$p_auth = new \project\auth();

//$vk_client_id = $vk_client_id; // ID приложения
//$vk_client_secret = $vk_client_secret; // Защищённый ключ
$redirect_uri = 'https://edgardzaycev.com/vk.php?s_login=273456781'; // Адрес сайта

$url = 'http://oauth.vk.com/authorize'; // Ссылка для авторизации на стороне ВК

$params = ['client_id' => $vk_client_id,
    'redirect_uri' => $redirect_uri,
    'scope' => 'email',
    'response_type' => 'code']; // Массив данных, который нужно передать для ВК содержит ИД приложения код, ссылку для редиректа и запрос code для дальнейшей авторизации токеном
if (empty($_SESSION['user']['info']['id']) && $_SESSION['user']['info']['id'] > 0) {
    location_href('/auth/');
    echo "Вы уже авторизованы";
} else {
    echo $link = '<p><a href="' . $url . '?' . urldecode(http_build_query($params)) . '">Аутентификация через ВКонтакте</a></p>';
}

if (isset($_GET['code'])) {
    $result = false;
    $params = [
        'client_id' => $vk_client_id,
        'client_secret' => $vk_client_secret,
        'code' => $_GET['code'],
        'scope' => 'email',
        'redirect_uri' => $redirect_uri
    ];

    $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);

    if (isset($token['access_token'])) {

        //print_r($token);
        $params = [
            'uids' => $token['user_id'],
            'fields' => 'uid,contacts,first_name,last_name,screen_name,sex,bdate,photo_big',
            'access_token' => $token['access_token'],
            'v' => '5.101'];

        $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
        if (isset($userInfo['response'][0]['id'])) {

            $userInfo['response'][0]['email'] = $token['email'];
            $userInfo = $userInfo['response'][0];
            $result = true;
        }
    }

    if ($result) {
//        print_r($userInfo);
//        echo "ID пользователя: " . $userInfo['id'] . '<br />';
//        echo "Имя пользователя: " . $userInfo['first_name'] . '<br />';
//        echo "email: " . $userInfo['email'] . '<br />';
//        echo "Ссылка на профиль: " . $userInfo['screen_name'] . '<br />';
//        echo "Пол: " . $userInfo['sex'] . '<br />';
//        echo "День Рождения: " . $userInfo['bdate'] . '<br />';
//        echo '<img src="' . $userInfo['photo_big'] . '" />';
//        echo "<br />";

        $email = $userInfo['email'];
        //$phone = (isset($json_s['phone']) || strlen($json_s['phone']) > 0) ? $json_s['phone'] : '';
        $first_name = $userInfo['first_name'];
        $uid = $userInfo['id'];
        // проверка на секрет
        if ($uid > 0 && $_GET['s_login'] == '273456781') {
            //$phone = $this->phoneReplace($phone);
            //echo "first_name: {$phone}<br/>\n";

            $sqlLight = new \project\sqlLight();
            if (strlen($phone) == 0) {
                $query = "SELECT * FROM `zay_users` u WHERE u.`email`='?' and `active`=0";
                $user_not_activate = $sqlLight->queryList($query, array($email), 0);
                if (count($user_not_activate) > 0) {
                    $_SESSION['errors'][] = 'Активируйте учетную запись<br/>письмо уже выслано на электронный адрес ( ' . $email . ' ) ';
                    return false;
                } else {
                    $query = "SELECT * FROM `zay_users` u WHERE u.`email`='?' and `active`=1";
                    $users = $sqlLight->queryList($query, array($email), 0);
                }
            } else {
                $query = "SELECT * FROM `zay_users` u WHERE (u.`email`='?' or u.`phone`='?') and `active`=1";
                $users = $sqlLight->queryList($query, array($email, $phone), 0);
            }

            //print_r($users);

            if (count($users) > 0) {
                $_SESSION['user']['info'] = $users[0];
                $data = $p_user->getUserInfo($users[0]['id']);
                //print_r($data);
                $_SESSION['user']['info'] = $data;
                $result = true;
            } else {
                $password = $p_auth->password_generate();
                /*
                 * Нужно еще отправлять пароль пользователю на почту !!!!!!!!!!!!!
                 */
                $send_emails = new \project\send_emails();
                //$send_emails->send('new_password', $email, array('user_password' => $password));
                // Процесс регистрации
                if ($p_auth->register($email, $phone, $password, $password, 1, 1)) {
                    $query = "SELECT * FROM `zay_users` u WHERE (u.`email`='?' or u.`phone`='?') and `active` = 1";
                    $users = $sqlLight->queryList($query, array($email, $phone), 0);
                    if (count($users) > 0) {
                        $_SESSION['user']['info'] = $users[0];
                        $p_auth->insertRole($users[0]['id'], 3);
                        $data = $p_user->getUserInfo($users[0]['id']);
                        //print_r($data);
                        $_SESSION['user']['info'] = $data;
                        $result = true;
                    }
                } else {
                    $_SESSION['errors'][] = 'Ошибка авторизации';
                }
            }
        }
    }
    var_dump($result);
    location_href('/auth/');
}

//$_SESSION['id'] = $userInfo['id'];
