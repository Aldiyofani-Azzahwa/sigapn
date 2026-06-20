<?php

$runtimePaths = [
    'VIEW_COMPILED_PATH' => '/tmp/views',
    'APP_CONFIG_CACHE' => '/tmp/config.php',
    'APP_EVENTS_CACHE' => '/tmp/events.php',
    'APP_PACKAGES_CACHE' => '/tmp/packages.php',
    'APP_ROUTES_CACHE' => '/tmp/routes.php',
    'APP_SERVICES_CACHE' => '/tmp/services.php',
];

foreach ($runtimePaths as $key => $value) {
    $_ENV[$key] = $_ENV[$key] ?? $value;
    $_SERVER[$key] = $_SERVER[$key] ?? $value;
    putenv($key.'='.($_SERVER[$key] ?? $value));
}

foreach (['/tmp/views', '/tmp/cache'] as $dir) {
    if (! is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

require __DIR__ . '/../public/index.php';