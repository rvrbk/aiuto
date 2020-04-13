<?php

namespace App\Http\Middleware;

use Closure;

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
            if(!file_exists(public_path() . '/locale.json')) {
                $f = fopen(public_path() . '/locale.json', 'w');

                fwrite($f, json_encode(array_merge(__('app'), __('form')), true));
                fclose($f);
            }
        }

        return $next($request);
    }
}
