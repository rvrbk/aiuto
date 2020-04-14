<?php

namespace App\Http\Middleware;

use Closure;
use App;

class JsonizeTranslations
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
        if(env('APP_ENV') == 'develop') {
            $applocale = App::getLocale();
            
            foreach(['en', 'nl'] as $language) {
                $locale = App::setlocale($language);

                $f = fopen(public_path() . '/' . $language . '.locale.json', 'w');

                fwrite($f, json_encode(array_merge(__('app'), __('form')), true));
                fclose($f);
            }

            App::setlocale($applocale);
        }

        return $next($request);
    }
}
