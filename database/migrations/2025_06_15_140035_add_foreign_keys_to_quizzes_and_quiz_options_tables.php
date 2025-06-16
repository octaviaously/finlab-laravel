<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quiz_options', function (Blueprint $table) {
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
        });

        Schema::table('quizzes', function (Blueprint $table) {
            $table->foreign('jawaban_benar')->references('id')->on('quiz_options')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('quiz_options', function (Blueprint $table) {
            $table->dropForeign(['quiz_id']);
        });

        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropForeign(['jawaban_benar']);
        });
    }
};