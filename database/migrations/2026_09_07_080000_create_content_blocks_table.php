<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('content_blocks', function (Blueprint $table) {
            $table->id();
            $table->string('page_key', 50)->index();       // e.g. 'home', 'about', 'contact'
            $table->string('block_type', 80)->index();      // e.g. 'gateway_cards', 'why_choose_us', 'what_we_do'
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('icon_class', 100)->nullable();  // FontAwesome class
            $table->string('color_class', 50)->nullable();  // e.g. 'orange', 'navy', 'green'
            $table->string('image')->nullable();             // Storage path
            $table->string('link')->nullable();
            $table->string('link_label')->nullable();
            $table->json('extra_json')->nullable();          // Flexible overflow
            $table->unsignedInteger('order_position')->default(0);
            $table->enum('status', ['published', 'draft'])->default('published');
            $table->timestamps();

            $table->index(['page_key', 'block_type', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_blocks');
    }
};
