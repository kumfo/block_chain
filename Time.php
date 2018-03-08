<?php
/**
 * Created by PhpStorm.
 * User: kumfo
 * Date: 2018/2/24
 * Time: 上午9:54
 */

class Time
{
    public static function getMsectime() {
        list($msec, $sec) = explode(' ', microtime());
        return (floatval($msec) + floatval($sec)) * 1000;
    }
}