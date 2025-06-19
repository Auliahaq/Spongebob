<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
    {
        Schema::create('koleksi_artikel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('koleksi_id')->constrained('koleksi')->onDelete('cascade');
            $table->foreignId('artikel_id')->constrained('artikel')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['koleksi_id', 'artikel_id']); // mencegah duplikat
        });
    }

    public function down()
    {
        Schema::dropIfExists('koleksi_artikel');
    }    
};
