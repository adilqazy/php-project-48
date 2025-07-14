<?php

namespace Hexlet\Code;
use function Funct\Collection\sortBy;

function compare($data1, $data2): string
{
    $allKeys = sortBy(array_unique(array_merge(array_keys($data1), array_keys($data2))), function ($sort) {
        return $sort[$key];
    });

    $lines = [];

    foreach ($allKeys as $key)
    {
        $val1 = $data1[$key] ?? null;
        $val2 = $data2[$key] ?? null;

        if (array_key_exists($key, $data1) && array_key_exists($key, $data2)) {
            if ($val1 === $val2) {
                $lines[] = "  {$key}: " . var_export($val1, true);
            } else {
                $lines[] = "- {$key}: " . var_export($val1, true);
                $lines[] = "+ {$key}: " . var_export($val2, true);
            }
        } elseif (array_key_exists($key, $data1)) {
            $lines[] = "- {$key}: " . var_export($val1, true);
        } elseif (array_key_exists($key, $data2)) {
            $lines[] = "+ {$key}: " . var_export($val2, true);
        }
    }

    //$sorted = sortBy($lines, function ($sort) {
    //    return $sort[$key];
    //});
    return implode(PHP_EOL, $lines);
}