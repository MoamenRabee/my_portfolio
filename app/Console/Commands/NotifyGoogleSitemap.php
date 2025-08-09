<?php

namespace App\Console\Commands;

use App\Services\GoogleSearchConsoleService;
use Illuminate\Console\Command;

class NotifyGoogleSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'google:notify-sitemap {--url= : Specific sitemap URL to ping}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify Google Search Console about sitemap updates';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Notifying Google Search Console about sitemap updates...');

        $url = $this->option('url');

        if ($url) {
            $this->info("📤 Sending notification for: {$url}");
            $success = GoogleSearchConsoleService::notifySitemapUpdate($url);
        } else {
            $this->info('📤 Sending notification for main sitemap...');
            $success = GoogleSearchConsoleService::quickNotify();
        }

        if ($success) {
            $this->info('✅ Successfully notified Google about sitemap update!');
        } else {
            $this->error('❌ Failed to notify Google. Check logs for details.');
        }

        $this->newLine();
        $this->info('💡 Tip: Check storage/logs/laravel.log for detailed information.');

        return $success ? 0 : 1;
    }
}
