<?php

if (! function_exists('percentChange')) {
    function percentChange($initialValue, $finalValue, $precision = 1)
    {
        if (abs($initialValue) === 0) {
            return;
        }

        $percentChange = ($finalValue - $initialValue) / abs($initialValue) * 100;

        return round($percentChange, $precision);
    }
}
