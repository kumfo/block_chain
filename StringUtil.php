<?php
/**
 * Created by PhpStorm.
 * User: kumfo
 * Date: 2018/2/24
 * Time: 上午9:55
 */

class StringUtil
{
    public static function applySha256($input) {
        return hash('sha256',$input);
    }
}