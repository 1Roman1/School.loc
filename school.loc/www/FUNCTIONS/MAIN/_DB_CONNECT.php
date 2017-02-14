<?php
/**
 * Created by PhpStorm.
 * User: foo
 * Date: 05.01.2017
 * Time: 17:58
 */

class DB_CONNECT
{
    private static $instance = null;
    private $mysqli = null;

    function __construct()
    {
        $this->mysqli = new mysqli("localhost", "root", "", "school");
        if (!$this->mysqli->connect_errno) {
            if ($this->mysqli->set_charset("utf8")) {

            } else {
                LOG::sendLog("Ошибка смены кодировки ", $this->mysqli);
                die("Error: " . $this->mysqli->errno);
            }
        } else {
            LOG::sendLog("Ошибка подключения к базе данных ", $this->mysqli);
            die("Error: " . $this->mysqli->errno);
        }
    }

    function __destruct()
    {
        $this->mysqli->close();
    }


    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    //---------------------------------------------------------------------

    public function escape($str)
    {
        return $this->mysqli->escape_string($str);
    }

    public function startTransaction()
    {
        $this->mysqli->autocommit(false);
    }

    public function commit()
    {
        $this->mysqli->commit();
        $this->mysqli->autocommit(true);
    }

    public function rollback()
    {
        $this->mysqli->rollback();
        $this->mysqli->autocommit(true);
    }

    public function query($query)
    {
        return $this->mysqli->query($query);
    }

    public function insertId()
    {
        return $this->mysqli->insert_id;
    }

    public function err()
    {
        if ($this->mysqli->error) return $this->mysqli->error;
        else return "";
    }
}