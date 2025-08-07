<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visit;
use Carbon\Carbon;

class TrackVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only track GET requests to avoid tracking form submissions, etc.
        if ($request->isMethod('GET') && !$request->is('admin*')) {
            $this->recordVisit($request);
        }

        return $next($request);
    }

    /**
     * Record the visit
     */
    private function recordVisit(Request $request)
    {
        $ipAddress = $this->getClientIpAddress($request);

        // Check if this IP visited the same page in the last 5 minutes
        // to avoid counting refreshes as separate visits
        $recentVisit = Visit::where('ip_address', $ipAddress)
            ->where('page_url', $request->fullUrl())
            ->where('visited_at', '>', Carbon::now()->subMinutes(5))
            ->exists();

        if (!$recentVisit) {
            Visit::create([
                'ip_address' => $ipAddress,
                'user_agent' => $request->userAgent(),
                'page_url' => $request->fullUrl(),
                'page_title' => $this->getPageTitle($request),
                'referer' => $request->header('referer'),
                'visited_at' => Carbon::now(),
            ]);
        }
    }

    /**
     * Get client IP address
     */
    private function getClientIpAddress(Request $request)
    {
        $ipKeys = ['HTTP_X_FORWARDED_FOR', 'HTTP_X_REAL_IP', 'HTTP_CLIENT_IP'];

        foreach ($ipKeys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }

        return $request->ip();
    }

    /**
     * Get page title based on route
     */
    private function getPageTitle(Request $request)
    {
        $route = $request->route();
        if (!$route)
            return 'Unknown Page';

        $routeName = $route->getName();

        $titles = [
            'portfolio.index' => 'Home',
            'portfolio.projects' => 'Projects',
            'portfolio.project' => 'Project Details',
            'portfolio.experiences' => 'Experiences',
            'portfolio.skills' => 'Skills',
            'portfolio.education' => 'Education',
            'portfolio.certifications' => 'Certifications',
            'portfolio.about' => 'About',
            'portfolio.contact' => 'Contact',
        ];

        return $titles[$routeName] ?? 'Portfolio Page';
    }
}
