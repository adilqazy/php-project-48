<?php
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 0);
ini_set('log_errors', 0);

ob_start();
passthru('php vendor/bin/phpcs', $return_code);
$output = ob_get_clean();

// Фильтруем только полезный вывод
$lines = explode("\n", $output);
$filtered = [];

foreach ($lines as $line) {
    if (strpos($line, 'PHP Deprecated:') === false &&
        strpos($line, 'PHP Stack trace:') === false &&
        strpos($line, 'Call Stack:') === false &&
        !preg_match('/^\s*[0-9]+/', $line) &&
        !preg_match('/^\s*PHP\s+[0-9]+/', $line) &&
        trim($line) !== '') {
        $filtered[] = $line;
    }
}

echo implode("\n", $filtered);
exit($return_code);
