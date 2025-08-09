<?php

namespace App\Http\Middleware;

use App\Models\Project;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectSlugMiddleware
{
    /**
     * Handle an incoming request.
     * 
     * This middleware handles old URLs with numeric IDs and redirects them
     * to the new slug-based URLs for SEO purposes.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the route parameter is numeric (old ID-based URL)
        $projectParam = $request->route('project');

        if (is_numeric($projectParam)) {
            // Find project by ID and redirect to slug-based URL
            $project = Project::find($projectParam);

            if ($project && $project->slug) {
                return redirect()->route('portfolio.project', $project->slug, 301);
            }

            // If project not found, let it continue to show 404
        }

        return $next($request);
    }
}
