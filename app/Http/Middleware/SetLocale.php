<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Config;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $header = $request->server('HTTP_ACCEPT_LANGUAGE');
        $language = 'en';
        $currency = 'USD';
        $languages = explode(',', Config::get('app.languages'));
        if (!empty($header)) {
            $accept_language = trim(substr($header, 0, 3), '-');
            $key = array_search($accept_language, $languages);
            if ($key != false) {
                $language = $accept_language;
                $currency = explode(',', Config::get('app.currencies'))[$key];
            }
        }

        App::setLocale($language);

        return $next($request);
    }
}
