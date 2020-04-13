<?php

namespace App\Http\Middleware;

use Closure;
use App;

class SetLanguage
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
        $rawlocale = $request->server('HTTP_ACCEPT_LANGUAGE'); 

        if(isset($rawlocale)) {
            $rawlocale = explode(';', $rawlocale);

            if(count($rawlocale) > 0) {
                $rawlocale = explode(',', $rawlocale[0]);

                if(count($rawlocale) > 0) {
                    $locale = $rawlocale[0];

                    App::setLocale($locale);
                }
                else {
                    App::setLocale('en');
                }
            }
            else {
                App::setLocale('en');
            }
        }
        else {
            App::setLocale('en');
        }

        return $next($request);
    }
}
