<?php

use Embit88\MultiLang\Models\Language;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->getTableName(), function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->string('code', 2);
            $table->string('url', 2)->nullable();
            $table->string('encoding', 5);
            $table->string('locale', 2);
            $table->boolean('status')->default(0);
            $table->boolean('base')->default(0);
            $table->integer('sort_order')->default(0);
        });

        if (config('multilang.seed_status') && Schema::hasTable($this->getTableName())){

            DB::table($this->getTableName())->insert([
                'title' => 'English',
                'code' => 'en',
                'encoding' => 'en',
                'locale' => 'en',
                'status' => 1,
                'base' => 1,
                'sort_order' => 1,
            ]);

            DB::table($this->getTableName())->insert([
                'title' => 'Русский',
                'code' => 'ru',
                'encoding' => 'ru',
                'locale' => 'ru',
                'url' => 'ru',
                'status' => 1,
                'base' => 0,
                'sort_order' => 2,
            ]);

        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->getTableName());
    }

    private function getTableName(): string
    {
        return config('multilang.table_name') ?? 'em_languages';
    }
};
