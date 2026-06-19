<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lead_activities', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->foreignUuid('acquisition_lead_id')
                ->constrained('acquisition_leads')
                ->cascadeOnDelete();

            $table->string('type')->index();
            $table->string('channel')->nullable()->index();
            $table->string('status')->default('pending')->index();
            $table->text('notes')->nullable();
            $table->json('payload')->nullable();

            $table->timestamp('scheduled_at')->nullable()->index();
            $table->timestamp('completed_at')->nullable();

            $table->uuid('created_by')->nullable()->index();
            $table->uuid('updated_by')->nullable()->index();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lead_activities');
    }
};