<?php
/**
 * Created by PhpStorm.
 * User: foo
 * Date: 05.01.2017
 * Time: 21:52
 */

function is($arr, $keys) {
    if (is_array($arr) && is_array($keys)) {
        foreach ($keys as $key) {
            if (!isset($arr[$key])) return false;
        }
        return true;
    }
    return false;
}

function isErr($r) {
    if (is_array($r) && isset($r['error'])) return true;
    else return false;
}

function len($str) {
    return mb_strlen($str, "utf-8");
}

function isLen($str, $min, $max) {
    if (len($str) < $min || len($str) > $max) return false;
    return true;
}