<?php

namespace Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Konekt\Gears\Facades\Settings;
use Illuminate\Support\Facades\DB;
use Theme;
use Schema;

class ThemeMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        if (Schema::hasTable('settings')) {
            $setting = DB::table('settings')->where('id', 'site.theme')->first();
            if ($setting) {
                $currentTheme = $setting->value;
                Theme::set($currentTheme);
            } else {
                $currentTheme = 'default';
                Theme::set($currentTheme);
            }
        } else {
            Theme::set('default');
        }
        return $next($request);
    }

}
