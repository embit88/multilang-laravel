<?php

namespace Embit88\MultiLang\Services\Facades;

use Illuminate\Support\Facades\Facade;

class LanguageFacade extends Facade
{
     protected static function getFacadeAccessor(): string
     {
         return 'languages';
     }

}
