<?php

namespace Hexlet\Code;

use function Funct\Collection\sortBy;

function compare($data1, $data2): string
{
    $allKeys = sortBy(array_unique(array_merge(array_keys($data1), array_keys($data2))), function ($sort) {
        return $sort;
    });

    $lines = [];

    foreach ($allKeys as $key) {
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

    return implode(PHP_EOL, $lines);
}

function genDiff(string $firstFile, string $secondFile): string
{
    // Парсим файлы
    $data1 = json_decode(file_get_contents($firstFile), true);
    $data2 = json_decode(file_get_contents($secondFile), true);
    
    // Получаем все ключи
    $allKeys = array_unique(array_merge(array_keys($data1), array_keys($data2)));
    sort($allKeys);
    
    $lines = ['{'];
    
    foreach ($allKeys as $key) {
        $exists1 = array_key_exists($key, $data1);
        $exists2 = array_key_exists($key, $data2);
        
        if ($exists1 && $exists2) {
            if ($data1[$key] === $data2[$key]) {
                // Без изменений
                $lines[] = "    {$key}: " . formatValue($data1[$key]);
            } else {
                // Изменено
                $lines[] = "  - {$key}: " . formatValue($data1[$key]);
                $lines[] = "  + {$key}: " . formatValue($data2[$key]);
            }
        } elseif ($exists1) {
            // Удалено
            $lines[] = "  - {$key}: " . formatValue($data1[$key]);
        } else {
            // Добавлено
            $lines[] = "  + {$key}: " . formatValue($data2[$key]);
        }
    }
    
    $lines[] = '}';
    
    return implode("\n", $lines);
}

function formatValue($value): string
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }
    
    if (is_null($value)) {
        return 'null';
    }
    
    return (string) $value;
}
