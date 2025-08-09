<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class GoogleSearchConsoleService
{
    /**
     * Google Search Console Ping URL
     */
    const PING_URL = 'https://www.google.com/ping?sitemap=';

    /**
     * Notify Google about sitemap updates
     */
    public static function notifySitemapUpdate($sitemapUrl = null)
    {
        try {
            $url = $sitemapUrl ?: config('app.url') . '/sitemap.xml';

            // Skip notification in local environment
            if (app()->environment('local') && (str_contains($url, 'localhost') || str_contains($url, '127.0.0.1'))) {
                Log::info("🔧 Local environment detected - skipping Google notification for: {$url}");
                return true; // Return true to avoid errors in local development
            }

            $pingUrl = self::PING_URL . urlencode($url);

            Log::info("🔔 Notifying Google Search Console about sitemap update: {$url}");

            $response = Http::timeout(5)
                ->withUserAgent('Laravel Portfolio Bot 1.0')
                ->get($pingUrl);

            if ($response->successful()) {
                Log::info("✅ Successfully notified Google Search Console about sitemap: {$url}");
                return true;
            } else {
                Log::warning("⚠️  Google Search Console notification failed. Status: {$response->status()}, URL: {$url}");
                return false;
            }
        } catch (Exception $e) {
            Log::error("❌ Error notifying Google Search Console: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Quick notify for project updates
     */
    public static function quickNotify()
    {
        return self::notifySitemapUpdate();
    }
}
