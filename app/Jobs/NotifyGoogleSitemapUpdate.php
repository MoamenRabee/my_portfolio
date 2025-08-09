<?php

namespace App\Jobs;

use App\Services\GoogleSearchConsoleService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class NotifyGoogleSitemapUpdate implements ShouldQueue
{
    use Queueable;

    /**
     * The sitemap URL to notify Google about
     *
     * @var string|null
     */
    public $sitemapUrl;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * The maximum number of seconds the job may take.
     *
     * @var int
     */
    public $timeout = 30;

    /**
     * Create a new job instance.
     */
    public function __construct($sitemapUrl = null)
    {
        $this->sitemapUrl = $sitemapUrl;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('🔄 Starting Google Search Console notification job', [
            'sitemap_url' => $this->sitemapUrl ?: 'default'
        ]);

        $success = GoogleSearchConsoleService::notifySitemapUpdate($this->sitemapUrl);

        if ($success) {
            Log::info('✅ Google Search Console notification completed successfully', [
                'sitemap_url' => $this->sitemapUrl ?: config('app.url') . '/sitemap.xml'
            ]);
        } else {
            Log::error('❌ Google Search Console notification failed', [
                'sitemap_url' => $this->sitemapUrl ?: config('app.url') . '/sitemap.xml',
                'attempt' => $this->attempts()
            ]);
            
            // Retry if not the last attempt
            if ($this->attempts() < $this->tries) {
                $this->release(60); // Retry after 60 seconds
            }
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('💥 Google Search Console notification job failed permanently', [
            'sitemap_url' => $this->sitemapUrl ?: config('app.url') . '/sitemap.xml',
            'error' => $exception->getMessage(),
            'attempts' => $this->attempts()
        ]);
    }
}
