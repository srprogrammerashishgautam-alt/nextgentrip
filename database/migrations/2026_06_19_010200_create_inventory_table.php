<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory', function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->foreignUuid('hotel_id')->constrained('hotels')->cascadeOnDelete();
            $table->foreignUuid('room_type_id')->constrained('room_types')->cascadeOnDelete();
            $table->date('inventory_date');
            $table->unsignedInteger('available')->default(0);
            $table->unsignedInteger('sold')->default(0);
            $table->unsignedInteger('blocked')->default(0);
            $table->boolean('stop_sell')->default(false);
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['hotel_id', 'room_type_id', 'inventory_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
