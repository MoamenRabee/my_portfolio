<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Visit extends Model
{
    protected $fillable = [
        'ip_address',
        'user_agent',
        'page_url',
        'page_title',
        'referer',
        'country',
        'city',
        'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];

    /**
     * Get visits count for today
     */
    public static function todayCount()
    {
        return static::whereDate('visited_at', Carbon::today())->count();
    }

    /**
     * Get visits count for this week
     */
    public static function thisWeekCount()
    {
        return static::whereBetween('visited_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();
    }

    /**
     * Get visits count for this month
     */
    public static function thisMonthCount()
    {
        return static::whereMonth('visited_at', Carbon::now()->month)
            ->whereYear('visited_at', Carbon::now()->year)
            ->count();
    }

    /**
     * Get unique visitors count for today
     */
    public static function uniqueVisitorsToday()
    {
        return static::whereDate('visited_at', Carbon::today())
            ->distinct('ip_address')
            ->count('ip_address');
    }

    /**
     * Get visits grouped by date for charts
     */
    public static function getVisitsByDate($days = 30)
    {
        return static::selectRaw('DATE(visited_at) as date, COUNT(*) as count')
            ->where('visited_at', '>=', Carbon::now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    /**
     * Get most visited pages
     */
    public static function getMostVisitedPages($limit = 10)
    {
        return static::selectRaw('page_url, page_title, COUNT(*) as visits')
            ->groupBy('page_url', 'page_title')
            ->orderByDesc('visits')
            ->limit($limit)
            ->get();
    }

    /**
     * Get most visited pages with proper data for table widgets
     */
    public static function getMostVisitedPagesForTable($limit = 10)
    {
        return static::selectRaw('MAX(id) as id, page_title, page_url, COUNT(*) as visits')
            ->whereNotNull('page_title')
            ->where('page_title', '!=', '')
            ->groupBy('page_title', 'page_url')
            ->orderByDesc('visits')
            ->limit($limit)
            ->get();
    }

    /**
     * Get visitor countries with proper data for table widgets
     */
    public static function getVisitorCountriesForTable($limit = 10)
    {
        return static::selectRaw('MAX(id) as id, country, COUNT(*) as visits, COUNT(DISTINCT ip_address) as unique_visitors')
            ->whereNotNull('country')
            ->where('country', '!=', '')
            ->groupBy('country')
            ->orderByDesc('visits')
            ->limit($limit)
            ->get();
    }
}
