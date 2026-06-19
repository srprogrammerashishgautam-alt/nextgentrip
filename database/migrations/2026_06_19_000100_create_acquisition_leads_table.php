<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('acquisition_leads', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->uuid('hotel_id')->nullable()->index();

            $table->string('hotel_name');
            $table->string('slug')->nullable()->index();
            $table->string('status')->default('new')->index();

            $table->string('source')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable()->index();
            $table->string('phone')->nullable()->index();

            $table->text('address')->nullable();
            $table->string('city')->nullable()->index();
            $table->string('state')->nullable()->index();
            $table->string('country')->default('India')->index();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->unsignedTinyInteger('star_rating')->nullable();
            $table->decimal('review_rating', 3, 2)->nullable();
            $table->unsignedInteger('review_count')->default(0);
            $table->unsignedInteger('estimated_room_count')->nullable();
            $table->decimal('estimated_average_rate', 12, 2)->nullable();

            $table->json('ota_presence')->nullable();
            $table->json('nearby_points_of_interest')->nullable();
            $table->json('raw_payload')->nullable();

            $table->unsignedTinyInteger('score')->default(0)->index();
            $table->timestamp('last_scored_at')->nullable();
            $table->timestamp('invited_at')->nullable();

            $table->uuid('created_by')->nullable()->index();
            $table->uuid('updated_by')->nullable()->index();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['city', 'status']);
            $table->index(['score', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('acquisition_leads');
    }
};