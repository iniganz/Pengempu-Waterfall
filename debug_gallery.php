<?php
// Quick debug script
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Use DB facade
use Illuminate\Support\Facades\DB;

$posts = DB::table('gallery_posts')->orderBy('created_at', 'desc')->limit(10)->get();

echo "Total posts in database: " . DB::table('gallery_posts')->count() . "\n\n";

echo "Latest 10 posts:\n";
foreach ($posts as $post) {
    echo "ID: {$post->id}, Name: {$post->name}, Status: {$post->status}, Created: {$post->created_at}\n";
}

// Check recent logs
$logs = file_get_contents('storage/logs/laravel.log');
$lines = explode("\n", $logs);
$lines = array_reverse($lines);

echo "\n\nRecent log entries (last 30 lines):\n";
$count = 0;
foreach ($lines as $line) {
    if (++$count > 30) break;
    if (stripos($line, 'gallery') !== false || stripos($line, 'error') !== false) {
        echo $line . "\n";
    }
}
?>
