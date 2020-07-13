<?php

namespace project;

include_once $_SERVER['DOCUMENT_ROOT'] . '/system/lang/' . $_SESSION['lang'] . '.php';

/**
 * Запросы к базе данных
 * 
 * $sqlLight = new \project\sqlLight();<br/>
 * <br/>
 * $query = "SELECT * FROM `table`";<br/>
 * $objs = $sqlLight->queryList($query);<br/>
 * if ($sqlLight->getCount() > 0) {<br/>
 *  <br/>
 * }<br/>
 */

class sqlLight {

    public $db_prefix;
    private $errArr = array();
    private $count = 0;
    /* @var $mysqli new mysqli */
    private $mysqli;

    public function __construct() {
        
        $this->conect();
    }

    public function conect() {
        
        global $lang;
        include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
        $this->db_prefix = $cfg_db_prefix;

        $this->mysqli = new \mysqli($cfg_db_host, $cfg_db_user, $cfg_db_pass, $cfg_db_name);

        /* проверка соединения */
        if ($this->mysqli->connect_errno) {
            printf("{$lang['sql_connect_error']} %s\n", $mysqli->connect_error);
            $this->errArr[] = $lang['sql_connect_error'];
            exit();
        }

        if (!$this->mysqli) {
            $this->errArr[] = $lang['sql_connect_error'];
        }

        //mysql_query("SET NAMES 'cp1251' ", $conn);
        if ($this->mysqli->query("SET NAMES 'utf8'") === FALSE) {
            echo "{$lang['sql_set_names_true']}\n";
        }
        
        return $this->mysqli;
    }

    public function getCount() {
        return $this->count;
    }

    public function setCount($count) {
        $this->count = $count;
    }

    /**
     * Замена по очереди вхождений строки
     * @param type $search
     * @param type $replace
     * @param type $text
     * @return type
     */
    private function str_replace_once($search, $replace, $text) {
        $pos = strpos($text, $search);
        return $pos !== false ? substr_replace($text, $replace, $pos, strlen($search)) : $text;
    }

    /**
     * Отправим запро к DB
     * @param string $query
     * @return boolian
     */
    public function query($query, $values = array()) {
        $ret = false;
        // Защитим отиньекций
        if (count($values) > 0) {
            foreach ($values as $value) {
                $value = $this->mysqli->real_escape_string($value);
                $query = $this->str_replace_once('?', $value, $query);
            }
        }

        /* Включить режим фиксации */
        $this->mysqli->autocommit(TRUE);
        if ($this->mysqli->query($query) === FALSE) {
            echo "{$lang['sql_query_false']} - (" . $this->mysqli->connect_errno . ") \n";
        } else {
            /* Фиксировать транзакцию */
            if (!$this->mysqli->commit()) {
                echo "{$lang['sql_query_commit_false']} - (" . $this->mysqli->connect_errno . ") \n";
            } else {
                $ret = true;
            }
        }

        return $ret;
    }

    /**
     * Получить массив с данными из DB
     * @param string $query
     * @return boolian
     */
    public function queryList($query, $values = array()) {
        $this->setCount(0);
        $buffer = array();
        $i = 0;
        
        // Защитим отиньекций
        if (count($values) > 0) {
            foreach ($values as $value) {
                $value = $this->mysqli->real_escape_string($value);
                $query = $this->str_replace_once('?', $value, $query);
            }
        }
        //echo $query . "<br/>\n";
        /* Select запросы возвращают результирующий набор */
        if ($result = $this->mysqli->query($query)) {
            $this->count = $result->num_rows;

            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $i++;
                $buffer[] = $row;
            }
            $result->free();
        }

        $this->setCount($i);
        return $buffer;
    }

    public function close() {
        $this->setCount(0);
        $this->mysqli->close();
    }

    public function __destruct() {
        $this->close();
    }

}