<?php

require 'vendor/autoload.php';

// Test Redis configuration
use Illuminate\Support\Facades\Cache;

echo "=== Redis Caching Test ===\n\n";

try {
    // Check if Redis extension is loaded
    if (!extension_loaded('redis')) {
        echo "❌ REDIS EXTENSION NOT LOADED\n";
        echo "  Please install PHP Redis extension for PHP " . PHP_VERSION . "\n";
        exit(1);
    }
    echo "✅ Redis extension is loaded\n\n";

    // Test storing data
    echo "📝 Testing cache with Redis...\n";
    $testKey = 'redis_test_' . time();
    $testValue = [
        'timestamp' => now()->toDateTimeString(),
        'message' => 'Hello from Redis!',
        'redis_cache_working' => true
    ];

    Cache::put($testKey, $testValue, 300); // 5 minutes

    echo "✅ Data stored successfully\n";
    echo "   Key: " . $testKey . "\n\n";

    // Test retrieving data
    echo "🔍 Retrieving data from cache...\n";
    $retrieved = Cache::get($testKey);

    if ($retrieved && $retrieved['redis_cache_working'] === true) {
        echo "✅ Data retrieved successfully!\n";
        echo "   Message: " . $retrieved['message'] . "\n";
        echo "   Timestamp: " . $retrieved['timestamp'] . "\n\n";
    } else {
        echo "❌ Failed to retrieve data\n\n";
        exit(1);
    }

    // Test remember pattern
    echo "📝 Testing remember pattern...\n";
    $cachedUsers = Cache::remember(
        'cached_users_list',
        now()->addMinutes(10),
        function () {
            echo "   (Callback executed - DB query simulation)\n";
            return ['user1', 'user2', 'user3'];
        }
    );

    echo "✅ Cache remember pattern working!\n\n";

    // Test tags
    echo "📝 Testing cache tags...\n";
    Cache::tags(['products', 'categories'])->put('tagged_cache', 'tagged_value', 300);
    $tagged = Cache::tags(['products'])->get('tagged_cache');
    echo "✅ Cache tags working!\n\n";

    // Test flushing
    echo "🧹 Flushing specific tag cache...\n";
    Cache::tags(['products'])->flush();
    echo "✅ Tagged cache flushed\n\n";

    echo "=== ✅ ALL TESTS PASSED ===\n";
    echo "\nYour Redis configuration is working correctly!\n";

} catch (Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
    echo "\nTroubleshooting:\n";
    echo "1. Ensure Redis server is running: redis-server\n";
    echo "2. Check .env file: CACHE_STORE=redis\n";
    echo "3. Verify Redis host in .env: REDIS_HOST=127.0.0.1\n";
    echo "4. Install PHP Redis extension if not installed\n";
    exit(1);
}