<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/bootstrap/app.php';

$app = require __DIR__ . '/bootstrap/app.php';
$app->boot();

// Create admin user
$user = App\Models\User::firstOrCreate(
    ['email' => 'admin@admin.com'],
    [
        'name' => 'Admin',
        'password' => bcrypt('password'),
        'email_verified_at' => now(),
    ]
);

echo "Admin user created: " . $user->email . " (password: password)\n";
