<?php

if (! function_exists('percentChange')) {
    function percentChange($initialValue, $finalValue, $precision = 1)
    {
        $percentChange = ($finalValue - $initialValue) / abs($initialValue) * 100;

        return round($percentChange, $precision);
    }
}
