<?php
/**
 * Created by PhpStorm.
 * User: foo
 * Date: 05.01.2017
 * Time: 17:58
 */

class LOG {
    public static function sendLog($text, $mysql_error = null)
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $now = date("d.m.Y") . ".log";
        $time = date("H:i:s");

        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/log/" . $now, $ip . " " . $time . " " . $text . "\n", FILE_APPEND);
        if ($mysql_error !== null) file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/log/" . $now, $ip . " " . $time . " " . $mysql_error . "\n", FILE_APPEND);
    }
}