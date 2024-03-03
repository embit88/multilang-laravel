<?php

namespace Embit88\MultiLang\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{

    protected $table = 'languages';
    public $timestamps = false;

    protected $fillable = ['title', 'code', 'url', 'encoding', 'locale', 'base', 'status', 'sort_order'];

}
