<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('resume_review_remarks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('resume_review_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('remark_id')->constrained()->onDelete('cascade');
            $table->text('description');
            $table->float('score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resume_review_remarks');
    }
};
