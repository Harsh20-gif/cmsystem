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
        Schema::create('about_facility_cards', function (Blueprint $table) {
            $table->id();
            $table->enum('icon_type', ['font', 'image'])->default('font');
            $table->string('icon_class')->nullable();
            $table->string('image_path')->nullable();
            $table->string('color_class')->default('navy');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('order_position')->default(0);
            $table->enum('status', ['draft', 'published'])->default('published');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_facility_cards');
    }
};
