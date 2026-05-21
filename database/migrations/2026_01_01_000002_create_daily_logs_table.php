<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('log_date');
            $table->enum('type', ['food', 'water', 'exercise', 'sleep']);
            $table->json('data');
            $table->timestamps();

            $table->index(['user_id', 'log_date', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_logs');
    }
};
