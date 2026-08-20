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
        Schema::table('pages', function (Blueprint $table) {
            $table->longText('content')->nullable()->after('title');
            $table->string('featured_image')->nullable()->after('content');
            $table->string('seo_title')->nullable()->after('featured_image');
            $table->text('seo_description')->nullable()->after('seo_title');
            $table->string('status')->default('published')->after('seo_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['content', 'featured_image', 'seo_title', 'seo_description', 'status']);
        });
    }
};
