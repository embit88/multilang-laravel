<?php

namespace Embit88\MultiLang\Services;

use Embit88\MultiLang\Models\Language;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Schema;

class MultiLanguage
{
    private static object $instance;

    protected string $title;

    protected string $code;

    protected string $encoding;
    protected string $locale;

    protected string|null $url;
    protected int|null $language_id;

    private function __construct() {}

    public static function getInstance(): object
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function encoding(): string
    {
        return$this->encoding;
    }

    public function locale(): string
    {
        return $this->locale;
    }

    public function id(): int|null
    {
        return $this->language_id ?? null;
    }

    public function url(): string|null
    {
        return $this->url ?? null;
    }

    public function start(): void
    {
        if (Schema::hasTable('languages')){
            $lang_url =  Request::segment(1) ?? null;

            $detected_language = Language::where('status', '=', 1)->where('code', '=', $lang_url)->first();

            $language = $detected_language ?? Language::where('status', '=', 1)->where('base', '=', 1)->whereNull('url')->first();

            if(isset($language)) {
                $this->title = $language->title;
                $this->code = $language->code;
                $this->encoding = $language->encoding;
                $this->locale = $language->locale;
                $this->url = $language->url;
                $this->language_id = $language->id;

                app()->setLocale($language->locale);
                if (strlen($lang_url) === 2 && $this->url !== $lang_url){
                    abort(404);
                }
            }
        }
    }

    public function getLanguages(): array
    {
        if(config('multilang.cache_status')) {
            return Cache::remember("middleware_language_cache", config('multilang.cache_time'), function()
            {
                return Language::where('status', 1)->orderBy('sort_order', 'desc')->pluck('code', 'code')->toArray();
            });
        }

        return Language::where('status', 1)->orderBy('sort_order', 'desc')->pluck('code', 'code')->toArray();

    }

}
