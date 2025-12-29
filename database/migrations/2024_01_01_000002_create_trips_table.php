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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('duration'); // in days
            $table->enum('difficulty_level', ['easy', 'medium', 'hard', 'expert'])->default('medium');
            $table->integer('max_participants');
            $table->integer('min_participants')->default(1);
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->string('location');
            $table->string('meeting_point')->nullable();
            $table->foreignId('category_id')->constrained('trip_categories')->onDelete('cascade');
            $table->foreignId('guide_id')->constrained('guides')->onDelete('cascade');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->boolean('has_story')->default(false);
            $table->enum('type', ['trip', 'experience', 'adventure'])->default('trip');
            $table->json('images')->nullable();
            $table->json('included_items')->nullable();
            $table->json('excluded_items')->nullable();
            $table->json('requirements')->nullable();
            $table->text('cancellation_policy')->nullable();
            $table->decimal('rating', 3, 1)->default(0);
            $table->integer('total_bookings')->default(0);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
