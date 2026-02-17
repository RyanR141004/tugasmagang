<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('period_id')->constrained('periods')->cascadeOnDelete();
            $table->foreignId('opd_id')->constrained('opds')->cascadeOnDelete();
            $table->string('respondent_name');
            $table->string('respondent_position');
            $table->string('respondent_phone', 20);
            $table->string('respondent_email')->nullable();
            $table->integer('total_score');
            $table->timestamps();

            $table->unique(['period_id', 'opd_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
