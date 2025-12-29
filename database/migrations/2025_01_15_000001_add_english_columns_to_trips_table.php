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
        Schema::table('trips', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->text('description_en')->nullable()->after('description');
            $table->text('short_description_en')->nullable()->after('short_description');
            $table->string('location_en')->nullable()->after('location');
            $table->string('meeting_point_en')->nullable()->after('meeting_point');
            $table->text('cancellation_policy_en')->nullable()->after('cancellation_policy');
            $table->string('meta_title_en')->nullable()->after('meta_title');
            $table->text('meta_description_en')->nullable()->after('meta_description');
            $table->string('meta_keywords_en')->nullable()->after('meta_keywords');
            $table->json('included_items_en')->nullable()->after('included_items');
            $table->json('excluded_items_en')->nullable()->after('excluded_items');
            $table->json('requirements_en')->nullable()->after('requirements');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->dropColumn([
                'title_en',
                'description_en',
                'short_description_en',
                'location_en',
                'meeting_point_en',
                'cancellation_policy_en',
                'meta_title_en',
                'meta_description_en',
                'meta_keywords_en',
                'included_items_en',
                'excluded_items_en',
                'requirements_en'
            ]);
        });
    }
};

