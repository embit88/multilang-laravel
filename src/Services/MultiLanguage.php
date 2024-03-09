<?php

namespace Embit88\MultiLang\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Schema;

class MultiLanguage
{
    private const URL_LENGTH = 2;

    protected string $title;

    protected string $code;

    protected string $encoding;

    protected string $locale;

    protected string|null $url;
    protected int $language_id;

    public function title(): string
    {
        return $this->title;
    }

    public function id(): int
    {
        return $this->language_id;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function encoding(): string
    {
        return $this->encoding;
    }

    public function locale(): string
    {
        return $this->locale;
    }

    public function url(): string|null
    {
        return $this->url ?? null;
    }

    public function start(): void
    {
        if (Schema::hasTable($this->getTableName())) {
            $request_lang_url = $this->getRequestSegment();

            $detected_language = $this->currentLanguage($request_lang_url);

            $language = $detected_language ?? $this->baseLanguage();

            if(isset($language)) {
                $this->title = $language->title;
                $this->code = $language->code;
                $this->encoding = $language->encoding;
                $this->locale = $language->locale;
                $this->url = $language->url;
                $this->language_id = $language->id;

                app()->setLocale($language->locale);
                if (strlen($request_lang_url) === self::URL_LENGTH && $this->url !== $request_lang_url){
                    abort(404);
                }
            }
        }
    }

    public function getLanguages(): object
    {
        if(config('multilang.cache_status')) {
            return Cache::remember("embit_get_languages", config('multilang.cache_time') ?? 3600*24, function()
            {
                return $this->allLanguages();
            });
        }

        return $this->allLanguages();
    }

    public function getBaseLanguage(): object
    {
        if(config('multilang.cache_status')) {
            return Cache::remember("embit_get_base_language", config('multilang.cache_time') ?? 3600*24, function()
            {
                return $this->baseLanguage();
            });
        }

        return $this->baseLanguage();
    }

    public function getCurrentLanguage(): object|null
    {
        $lang_url = $this->getRequestSegment();

        if(config('multilang.cache_status')) {
            return Cache::remember("embit_get_current_language_{$lang_url}", config('multilang.cache_time') ?? 3600*24, function() use ($lang_url)
            {
                return $this->currentLanguage($lang_url);
            });
        }

        return $this->currentLanguage($lang_url);
    }

    private function allLanguages(): object
    {
        return DB::table($this->getTableName())->where('status', '=', 1)->orderBy('sort_order', 'desc')->get();
    }

    private function baseLanguage(): object
    {
        return DB::table($this->getTableName())->where('status', '=', 1)->where('base', '=', 1)->whereNull('url')->first();
    }

    private function currentLanguage($lang_url): object|null
    {
        $lang_url = $lang_url ?? $this->getRequestSegment();

        if(!is_null($lang_url)) {
            return DB::table($this->getTableName())->where('status', '=', 1)->where('code', '=', $lang_url)->first();
        }

        return $this->baseLanguage();
    }

    private function getTableName(): string
    {
        return config('multilang.table_name') ?? 'em_languages';
    }

    private function getRequestSegment(): string|null
    {
        return Request::segment(1) ?? null;
    }

}
