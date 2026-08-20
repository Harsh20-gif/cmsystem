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
        Schema::table('placements', function (Blueprint $table) {
            $table->renameColumn('job_role', 'position');
            $table->renameColumn('testimonial', 'testimonial_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('placements', function (Blueprint $table) {
            $table->renameColumn('position', 'job_role');
            $table->renameColumn('testimonial_text', 'testimonial');
        });
    }
};
