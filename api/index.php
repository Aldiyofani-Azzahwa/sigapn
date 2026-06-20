<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if (! is_dir('/tmp/views')) {
    mkdir('/tmp/views', 0777, true);
}

if (! is_dir('/tmp/cache')) {
    mkdir('/tmp/cache', 0777, true);
}

$_ENV['VIEW_COMPILED_PATH'] = '/tmp/views';
$_SERVER['VIEW_COMPILED_PATH'] = '/tmp/views';

try {
    require __DIR__ . '/../public/index.php';
} catch (Throwable $e) {
    http_response_code(500);

    echo '<pre style="white-space: pre-wrap; font-family: monospace;">';
    echo 'ERROR CLASS: ' . get_class($e) . PHP_EOL;
    echo 'MESSAGE: ' . $e->getMessage() . PHP_EOL . PHP_EOL;
    echo 'FILE: ' . $e->getFile() . ':' . $e->getLine() . PHP_EOL . PHP_EOL;
    echo $e->getTraceAsString();
    echo '</pre>';
}