<?php

namespace Hexlet\Code;

function parse($path)
{
    if (!file_exists($path)) {
        throw new \Exception("File not found!: {$path}");
    }
    $contents = file_get_contents($path);
    $data = json_decode($contents);
    return (get_object_vars($data));
}
