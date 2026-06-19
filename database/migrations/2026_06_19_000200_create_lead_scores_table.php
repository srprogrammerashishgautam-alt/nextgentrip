<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lead_scores', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->foreignUuid('acquisition_lead_id')
                ->constrained('acquisition_leads')
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('star_rating_score')->default(0);
            $table->unsignedTinyInteger('review_score')->default(0);
            $table->unsignedTinyInteger('location_score')->default(0);
            $table->unsignedTinyInteger('revenue_potential_score')->default(0);
            $table->unsignedTinyInteger('ota_presence_score')->default(0);
            $table->unsignedTinyInteger('photo_quality_score')->default(0);
            $table->unsignedTinyInteger('medical_tourism_score')->default(0);
            $table->unsignedTinyInteger('wedding_events_score')->default(0);
            $table->unsignedTinyInteger('corporate_travel_score')->default(0);
            $table->unsignedTinyInteger('international_traveler_score')->default(0);

            $table->unsignedTinyInteger('total_score')->default(0)->index();
            $table->json('breakdown')->nullable();

            $table->uuid('created_by')->nullable()->index();
            $table->uuid('updated_by')->nullable()->index();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lead_scores');
    }
};