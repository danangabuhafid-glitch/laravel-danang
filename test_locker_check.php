<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Locker;
use Illuminate\Http\Request;

// Create dummy locker if none exist
if (Locker::count() == 0) {
    Locker::create([
        'locker_code' => 'L001',
        'locker_name' => 'Locker 1',
        'major' => 'Web Programming',
        'locker_status' => 'Available',
        'batch' => '1',
    ]);
}

$firstLocker = Locker::first();
echo "Testing with existing locker code: " . $firstLocker->locker_code . "\n";

// Test checking code without ID (Create Mode)
$request1 = Request::create('/locker/check-code', 'GET', ['locker_code' => $firstLocker->locker_code]);
$response1 = app()->handle($request1);
echo "Check existing code (should be available: false): " . $response1->getContent() . "\n";

$request2 = Request::create('/locker/check-code', 'GET', ['locker_code' => 'L999']);
$response2 = app()->handle($request2);
echo "Check non-existing code (should be available: true): " . $response2->getContent() . "\n";

// Test checking code with ID (Edit Mode)
$request3 = Request::create('/locker/check-code', 'GET', ['locker_code' => $firstLocker->locker_code, 'id' => $firstLocker->id]);
$response3 = app()->handle($request3);
echo "Check existing code with its own ID (should be available: true): " . $response3->getContent() . "\n";
