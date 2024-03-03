<?php

namespace Embit88\MultiLang\Middleware;

use Closure;
use App;
use Illuminate\Http\Request;
use Embit88\MultiLang\Services\MultiLanguage as MultiLanguageHelper;

class MultiLanguage
{

    protected static array $languages;

    public function handle(Request $request, Closure $next): object
    {
        self::$languages = MultiLanguageHelper::getInstance()->getLanguages();

        return $next($request);
    }

    public static function getLocale(): string
    {
        $uri = request()->path();
        $segmentsURI = explode('/',$uri);

        if (!empty($segmentsURI[0]) && in_array($segmentsURI[0], self::$languages)) {
            return $segmentsURI[0];
        }

        return MultiLanguageHelper::getInstance()->encoding();
    }



}
