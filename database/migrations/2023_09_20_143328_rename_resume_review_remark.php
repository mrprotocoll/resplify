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
        Schema::rename('resume_review_remarks', 'remark_resume_review');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('remark_resume_review', 'resume_review_remarks');
    }
};
