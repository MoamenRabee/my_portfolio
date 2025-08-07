<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DiagnoseServerCommand extends Command
{
    protected $signature = 'diagnose:server';
    protected $description = 'Diagnose server environment for email issues';

    public function handle()
    {
        $this->info('🔍 Diagnosing server environment...');
        $this->info('');

        // PHP Version
        $this->info('📋 PHP Information:');
        $this->info('- PHP Version: ' . PHP_VERSION);
        $this->info('- PHP SAPI: ' . PHP_SAPI);

        // Check required extensions
        $this->info('');
        $this->info('🔌 Required Extensions:');
        $extensions = ['openssl', 'curl', 'mbstring', 'json'];
        foreach ($extensions as $ext) {
            $status = extension_loaded($ext) ? '✅' : '❌';
            $this->info("- {$ext}: {$status}");
        }

        // Check mail-specific extensions
        $this->info('');
        $this->info('📧 Mail-related Extensions:');
        $mailExtensions = ['imap', 'smtp', 'mail'];
        foreach ($mailExtensions as $ext) {
            $status = extension_loaded($ext) ? '✅' : '❌';
            $this->info("- {$ext}: {$status}");
        }

        // Check functions
        $this->info('');
        $this->info('⚙️ Required Functions:');
        $functions = ['mail', 'fsockopen', 'curl_init'];
        foreach ($functions as $func) {
            $status = function_exists($func) ? '✅' : '❌';
            $this->info("- {$func}(): {$status}");
        }

        // Check file permissions
        $this->info('');
        $this->info('📁 File Permissions:');
        $paths = [
            'storage/logs' => storage_path('logs'),
            'storage/framework' => storage_path('framework'),
            'bootstrap/cache' => base_path('bootstrap/cache'),
        ];

        foreach ($paths as $name => $path) {
            $writable = is_writable($path) ? '✅ Writable' : '❌ Not Writable';
            $this->info("- {$name}: {$writable}");
        }

        // Test network connectivity
        $this->info('');
        $this->info('🌐 Network Connectivity:');

        // Test Gmail SMTP
        $this->info('Testing Gmail SMTP connection...');
        $connection = @fsockopen('smtp.gmail.com', 587, $errno, $errstr, 10);
        if ($connection) {
            fclose($connection);
            $this->info('✅ Gmail SMTP (smtp.gmail.com:587) - Reachable');
        } else {
            $this->error("❌ Gmail SMTP (smtp.gmail.com:587) - Not reachable: {$errstr}");
        }

        // Test SSL Gmail SMTP
        $sslConnection = @fsockopen('ssl://smtp.gmail.com', 465, $errno, $errstr, 10);
        if ($sslConnection) {
            fclose($sslConnection);
            $this->info('✅ Gmail SMTP SSL (smtp.gmail.com:465) - Reachable');
        } else {
            $this->info("ℹ️ Gmail SMTP SSL (smtp.gmail.com:465) - {$errstr}");
        }

        // Environment variables
        $this->info('');
        $this->info('🔧 Environment Variables:');
        $envVars = [
            'MAIL_MAILER',
            'MAIL_HOST',
            'MAIL_PORT',
            'MAIL_USERNAME',
            'MAIL_ENCRYPTION',
            'MAIL_FROM_ADDRESS',
            'APP_URL'
        ];

        foreach ($envVars as $var) {
            $value = env($var);
            if ($var === 'MAIL_PASSWORD') {
                $value = $value ? '***HIDDEN***' : 'NOT SET';
            }
            $status = $value ? '✅' : '❌';
            $this->info("- {$var}: {$status} " . ($value ?: 'NOT SET'));
        }

        // Laravel configuration
        $this->info('');
        $this->info('⚙️ Laravel Configuration:');
        $this->info('- App Environment: ' . config('app.env'));
        $this->info('- App Debug: ' . (config('app.debug') ? 'true' : 'false'));
        $this->info('- Default Mailer: ' . config('mail.default'));
        $this->info('- Queue Connection: ' . config('queue.default'));

        $this->info('');
        $this->info('📝 Recommendations:');

        if (!extension_loaded('openssl')) {
            $this->error('❌ OpenSSL extension is required for SMTP with TLS/SSL');
        }

        if (!function_exists('fsockopen')) {
            $this->error('❌ fsockopen() is required for SMTP connections');
        }

        if (!@fsockopen('smtp.gmail.com', 587, $errno, $errstr, 10)) {
            $this->error('❌ Cannot reach Gmail SMTP. Check firewall/network settings.');
            $this->info('   Try adding these to server firewall rules:');
            $this->info('   - Allow outbound connections to smtp.gmail.com:587');
            $this->info('   - Allow outbound connections to smtp.gmail.com:465');
        }

        $this->info('');
        $this->info('🎯 Next Steps:');
        $this->info('1. Fix any ❌ issues shown above');
        $this->info('2. Run: php artisan config:clear');
        $this->info('3. Run: php artisan test:email');
        $this->info('4. Check server logs if issues persist');

        return 0;
    }
}
