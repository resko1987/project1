<?php

namespace project;

defined('__CMS__') or die;

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/sqlLight.php';

/*
 * Управление расширениями на сайте
 */

class extension {

    public function __construct() { 
        $this->init();
    }

    /**
     * Заполение данных о расширениях
     */
    public function init() {
        if (!isset($_SESSION['extension_init']))
            $_SESSION['extension_init'] = 0;
        if ($_SESSION['extension_init'] == 0) {
            $sqlLight = new \project\sqlLight();
            include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';

            // Получим список доступных расширений
            $dirs = directoryListDirArray(DOCUMENT_ROOT . '/extension');

            if (count($dirs) > 0) {
                foreach ($dirs as $value) {
                    $lang_file = '';
                    // конфиг расширения
                    $lang_file = $_SERVER['DOCUMENT_ROOT'] . '/extension/' . $value . '/lang.php';
                    if (is_file($lang_file)) {
                        include $lang_file;
                    }
                    $conf = $_SERVER['DOCUMENT_ROOT'] . '/extension/' . $value . '/conf.php';
                    if (is_file($conf)) {
                        include $conf;
                    }

                    $querySelect = "SELECT `id`, `extension_url`, `version` FROM `zay_extension` e WHERE e.extension_url='?'";
                    $e = $sqlLight->queryList($querySelect, array($value));

                    // Добавим в список если его небыло
                    if (count($e) == 0) {
                        $queryInsert = "INSERT INTO `zay_extension`(`extension_url`, `version`) "
                                . "VALUES ('?','?')";
                        if ($sqlLight->query($queryInsert, array($value, $config['version']))) {
                            $querySelect = "SELECT `id`, `extension_url`, `version` FROM `zay_extension` e WHERE e.extension_url='?'";
                            $e = $sqlLight->queryList($querySelect, array($value));
                            // Добавим ссылки для вставки 
                            if (count($e) > 0) {
                                $this->setExtensionUrls($e[0]['id'], $config);
                            }
                        }
                    }

                    // обновим версию расширения
                    if ($e[0]['version'] != $config['version']) {
                        $queryUpdate = "UPDATE `zay_extension` SET `version`='?' WHERE e.extension_url='?'";
                        $sqlLight->query($queryInsert, array($config['version'], $value));
                    }
                }
            }
            $_SESSION['extension_init'] = 1;
        }
    }

    /**
     * Рабочие ссылки расширений создаем здесь<br/>
     * Данные из файла конфигурации
     * @param type $extension_id
     * @param type $config
     */
    private function setExtensionUrls($extension_id, $config) {
        $sqlLight = new \project\sqlLight();
        if ($extension_id > 0) {
            foreach ($config['urls'] as $key => $value) {
//                $querySelect = "SELECT * FROM `zay_extension_urls` WHERE extension_id='?' and url='?'";
//                $e = $sqlLight->queryList($querySelect, array($extension_id, $value));
//                if (count($e) > 0) {
//                    $queryUpdate = "UPDATE `zay_extension_urls` set extension_id='?', title='?', url='?' ";
//                    $sqlLight->query($queryInsert, array($extension_id, $key, $value));
//                } else {
                $queryInsert = "INSERT INTO `zay_extension_urls`(`extension_id`, `title`, `url`) "
                        . "VALUES ('?','?','?')";
                $sqlLight->query($queryInsert, array($extension_id, $key, $value));
                //}
            }
        }
    }

    /**
     * Данные по расширению
     * @param type $extension_id Идентификатор ссылки на расширение
     * @return type array
     */
    public function getExtensionListArray($extension_id = 0) {
        $sqlLight = new \project\sqlLight();
        $data = array();
        if ($extension_id > 0) {
            $querySelect = "SELECT  e.`id`, e.`extension_url`, e.`version`, eu.`id` as eu_id, eu.`url`, eu.`title` "
                    . "FROM `zay_extension` e "
                    . "left join `zay_extension_urls` eu on eu.extension_id=e.id "
                    . "WHERE eu.`id`='?' ";
            $data = $sqlLight->queryList($querySelect, array($extension_id));
        } else {
            $querySelect = "SELECT  e.`id`, e.`extension_url`, e.`version`, eu.`id` as eu_id, eu.`url`, eu.`title` "
                    . "FROM `zay_extension` e "
                    . "left join `zay_extension_urls` eu on eu.extension_id=e.id "
                    . "WHERE eu.url IS NOT NULL";
            $data = $sqlLight->queryList($querySelect, array(), 0);
        }

        return $data;
    }

    /*
     * Вспомогающие методы
     */

    public function getSelectArray($querySelect, $queryValues = array(), $see = 0) {
        $sqlLight = new \project\sqlLight();
        $data = $sqlLight->queryList($querySelect, $queryValues, $see);
        return $data;
    }

    public function query($query, $queryValues = array(), $see = 0) {
        $sqlLight = new \project\sqlLight();
        return $sqlLight->query($query, $queryValues, $see);
    }

    public function updateOneRow($table, $elm_id, $row, $val) {
        $sqlLight = new \project\sqlLight();
        $s = "UPDATE ? set ?='?' WHERE id='?' ";
        return $sqlLight->query($s, array($table, $row, $val, $elm_id));
    }

    /**
     * Возвращаем html тэги
     * @param type $str
     * @return type
     */
    public function getNormalHTML($str) {
        $sqlLight = new \project\sqlLight();
        return $sqlLight->getNormalHTML($str);
    }

    /**
     * Возвращает настройки расширения
     * @param type $extension_name
     * @return type 
     */
    public function getConfigData($extension_name) {
        include DOCUMENT_ROOT . '/extension/' . $extension_name . '/conf.php';
        return $config;
    }

    /**
     * Изменение еденичного поля в таблице 
     * @param type $table
     * @param type $itm_id
     * @param type $row
     * @param type $value
     * @return type
     */
    public function editTableRowValue($table, $itm_id, $row, $value) {
        $sqlLight = new \project\sqlLight();
        $query = "UPDATE `?` SET `?`='?' WHERE `id`='?'";
        return $sqlLight->query($query, array($table, $row, $value, $itm_id), 0);
    }

    /**
     * Инициализация супер формы<br>
     * отправка данных прямо с полей<br>
     * Пример:<br>
     * <input type="text" name="elm_name" value="elm_val" elm_id="" elm_table="" elm_row="" class="init_elm_edit" />
     */
    public function initSuperForm() {
        ?>
        <script src="/system/extension/admin_super_init.js<?= $_SESSION['rand'] ?>"></script>
        <?
    }

    /**
     * Отправка данны в БД из супер формы
     * @param type $elm_id
     * @param type $value
     * @param type $elm_table
     * @param type $elm_row
     * @return type
     */
    public function initSuperFormPOST($elm_id, $value, $elm_table, $elm_row) {
        $sqlLight = new \project\sqlLight();
        $query = "UPDATE `?` SET `?`='?' WHERE id='?'";
        return $sqlLight->query($query, array($elm_table, $elm_row, $value, $elm_id));
    }

    /**
     * Удаление элемента
     * @param type $elm_id
     * @return type
     */
    public function initSuperFormDelete($elm_id, $elm_table) {
        $sqlLight = new \project\sqlLight();
        $query = "DELETE FROM `?` WHERE id='?'";
        return $sqlLight->query($query, array($elm_table, $elm_id));
    }

}
