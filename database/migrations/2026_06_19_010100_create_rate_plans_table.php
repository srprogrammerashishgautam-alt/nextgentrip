<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rate_plans', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->foreignUuid('hotel_id')->constrained('hotels')->cascadeOnDelete();
            $table->foreignUuid('room_type_id')->constrained('room_types')->cascadeOnDelete();
            $table->string('name');
            $table->string('code');
            $table->string('meal_plan')->default('EP');
            $table->string('currency', 3)->default('INR');
            $table->decimal('base_rate', 12, 2)->default(0);
            $table->decimal('tax_rate', 5, 2)->default(0);
            $table->boolean('is_refundable')->default(true);
            $table->text('cancellation_policy')->nullable();
            $table->enum('status', ['draft', 'active', 'inactive'])->default('active');
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['hotel_id', 'code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rate_plans');
    }
};
