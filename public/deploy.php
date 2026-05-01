<?php

/**
 * Deployment Helper Script for Hostinger/Shared Hosting
 * Access this via yourdomain.com/deploy.php
 */

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

// 1. Load Laravel
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

// 2. Simple security (Optional: add a secret key check)
// if ($_GET['key'] !== 'YOUR_SECRET_KEY') die('Unauthorized');

header('Content-Type: text/plain');

try {
    echo "Starting Deployment Helper...\n\n";

    echo "1. Running Migrations...\n";
    Artisan::call('migrate', ['--force' => true]);
    echo Artisan::output() . "\n";

    echo "2. Clearing/Caching Configuration...\n";
    Artisan::call('config:cache');
    echo Artisan::output() . "\n";

    echo "3. Clearing/Caching Routes...\n";
    Artisan::call('route:cache');
    echo Artisan::output() . "\n";

    echo "4. Clearing/Caching Views...\n";
    Artisan::call('view:cache');
    echo Artisan::output() . "\n";

    echo "5. Creating Storage Symlink...\n";
    // Check if symlink exists
    if (!File::exists(public_path('storage'))) {
        Artisan::call('storage:link');
        echo Artisan::output() . "\n";
    } else {
        echo "Storage link already exists.\n";
    }

    echo "\nDeployment helper finished successfully!\n";
    echo "IMPORTANT: Delete this file after use for security reasons.";

} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
