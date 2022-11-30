<?php

if (!function_exists('explodeImplode')) {
    function explodeImplode($str, $symbol_explode = '-', $symbol_implode = ' ')
    {
        $explode = explode($symbol_explode, $str);
        $implode = implode($symbol_implode, $explode);

        return $implode;
    }
}
