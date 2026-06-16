<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        foreach (config('nextgentrip.modules', []) as $module) {
            if ($module === 'audit') {
                continue;
            }

            Schema::create("{$module}_records", function (Blueprint $table) use ($module): void {
                $table->uuid('id')->primary();
                $table->uuid('hotel_id')->nullable()->index();
                $table->string('name')->nullable();
                $table->json('payload')->nullable();
                $table->uuid('created_by')->nullable()->index();
                $table->uuid('updated_by')->nullable()->index();
                $table->softDeletes();
                $table->timestamps();
                $table->index(['hotel_id', 'deleted_at'], "{$module}_tenant_deleted_idx");
            });
        }
    }

    public function down(): void
    {
        foreach (array_reverse(config('nextgentrip.modules', [])) as $module) {
            if ($module === 'audit') {
                continue;
            }

            Schema::dropIfExists("{$module}_records");
        }
    }
};
