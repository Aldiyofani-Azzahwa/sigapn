<?php

if (! is_dir('/tmp/views')) {
    mkdir('/tmp/views', 0777, true);
}

if (! is_dir('/tmp/cache')) {
    mkdir('/tmp/cache', 0777, true);
}

$_ENV['VIEW_COMPILED_PATH'] = '/tmp/views';
$_SERVER['VIEW_COMPILED_PATH'] = '/tmp/views';

require __DIR__ . '/../public/index.php';