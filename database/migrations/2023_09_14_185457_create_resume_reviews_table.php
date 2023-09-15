<?php

use App\Enums\ReviewStatusEnum;
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
        Schema::create('resume_reviews', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('reviewer_id')->constrained('users')->onDelete('cascade');
            $table->foreignUuid('resume_id')->constrained()->onDelete('cascade');
            $table->text('summary');
            $table->enum('status', ReviewStatusEnum::values())->default(ReviewStatusEnum::PENDING->value);
            $table->dateTimeTz('assigned_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resume_reviews');
    }
};
