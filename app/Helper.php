<?php

if (!function_exists('explodeImplode')) {
    function explodeImplode($str, $symbol_explode = '-', $symbol_implode = ' ')
    {
        $explode = explode($symbol_explode, $str);
        $implode = implode($symbol_implode, $explode);

        return $implode;
    }
}

if (!function_exists('pre')) {
    function pre(...$array)
    {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
}

if (!function_exists('customRound')) {
    function customRound($nominal, $round = 2)
    {
        return round($nominal, $round);
    }
}
