<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('koleksi', function (Blueprint $table) {
        $table->unsignedInteger('article_count')->default(0);
    });
}

public function down()
{
    Schema::table('koleksi', function (Blueprint $table) {
        $table->dropColumn('article_count');
    });
}    
};
