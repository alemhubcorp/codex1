<?php

namespace App\Http\Middleware;

use Closure;

class HttpsProtocol {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $forwardedProto = $request->headers->get('x-forwarded-proto');
        $isProxiedHttps = is_string($forwardedProto) && strtolower($forwardedProto) === 'https';

        if (env('FORCE_HTTPS') == "On" && !$request->secure() && !$isProxiedHttps) {
            return redirect()->secure($request->getRequestUri());
        }
        return $next($request);
    }
}
