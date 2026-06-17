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
         Schema::create('hotels', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('hotel_name');
            $table->string('hotel_slug')->unique();

            $table->string('email')->nullable();
            $table->string('mobile')->nullable();

            $table->text('address')->nullable();

            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->default('India');

            $table->decimal('latitude',10,7)->nullable();
            $table->decimal('longitude',10,7)->nullable();

            $table->string('gst_number')->nullable();
            $table->string('pan_number')->nullable();

            $table->integer('star_rating')->nullable();

            $table->enum('status',[
                'draft',
                'pending',
                'active',
                'inactive'
            ])->default('draft');

            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
