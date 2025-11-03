<?php

require __DIR__ . '/../vendor/autoload.php';

use OpenApi\Generator;

try {
    $files = [
        __DIR__ . '/../app/Swagger/OpenApiInfo.php',
        __DIR__ . '/../app/Swagger/OpenApiRoot.php',
        __DIR__ . '/../app/Http/Controllers/AuthController.php',
        __DIR__ . '/../routes/api.php',
    ];

    echo "Scanning files:\n" . implode("\n", $files) . "\n\n";

    $openapi = Generator::scan($files);
    if ($openapi) {
        echo "OpenAPI object found. Info property present? ";
        echo $openapi->info ? "Yes\n" : "No\n";
        echo "\nFull spec:\n";
        echo $openapi->toJson();
    } else {
        echo "No OpenAPI definition generated.\n";
    }
} catch (\Throwable $e) {
    echo "Error while scanning: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
