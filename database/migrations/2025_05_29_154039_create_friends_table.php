<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('friends', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');     // pengirim
            $table->foreignId('friend_id')->constrained('users')->onDelete('cascade');   // penerima

            $table->string('name');
            $table->string('email');
            $table->string('avatar')->nullable();

            $table->enum('status', ['pending', 'accepted'])->default('pending'); // status permintaan

            $table->timestamps();

            // Optional: cegah duplikat permintaan dari user ke user sama
            $table->unique(['user_id', 'friend_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('friends');
    }
};
