<?php

use App\Enums\StatusEnum;
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
            $table->foreignUuid('reviewer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignUuid('resume_id')->constrained()->cascadeOnDelete();
            $table->text('summary')->nullable();
            $table->enum('status', StatusEnum::values())->default(StatusEnum::PENDING->value);
            $table->dateTimeTz('assigned_at')->nullable();
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
