<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quiz_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('quiz_type', ['obesity', 'mental']);
            $table->json('result_data');
            $table->timestamps();

            $table->index(['user_id', 'quiz_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_results');
    }
};
