<?php

namespace App\Http\Middleware;

use App\Models\Redirect;
use Closure;
use Illuminate\Http\Request;

class RedirectFromOldSlug
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $url = parse_url($request->url());
        $current_url = array_key_exists('path', $url) ? $url['path'] : '';

        $redirect = Redirect::query()
            ->where('old_slug', $current_url)
                ->orderByDesc('created_at')
                    ->orderByDesc('id')
                        ->first();

        $new_slug = null;

        while ($redirect !== null)
        {
            $current_url = $redirect->new_slug;
            $new_slug = $redirect;

            $redirect = Redirect::query()
                ->where('old_slug', $current_url)
                    ->where('created_at', '>', $redirect->created_at)
                        ->orderByDesc('created_at')
                            ->orderByDesc('id')
                                ->first();
        }

        if ($new_slug !== null)
        {
            return redirect($current_url);
        }

        return $next($request);
    }
}
