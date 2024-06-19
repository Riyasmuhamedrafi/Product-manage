<?php


/**
 * Generate otp
 *
 * @param string $date
 * @param string $format
 */

use Carbon\Carbon;

if (!function_exists('generate_product_code')) {
    function generate_product_code($length = 5)
    {
        return "p_".substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)))), 1, $length);
    }
}
if (!function_exists('dateTimeFormat')) {
    function dateTimeFormat($date, $format = 'd M Y h:i A')
    {
        return date($format, strtotime($date));
    }
}
