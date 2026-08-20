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
        Schema::table('students', function (Blueprint $table) {
            $table->string('email')->nullable()->unique()->after('name');
            $table->string('phone')->nullable()->after('email');
            $table->string('college')->nullable()->after('phone');
            $table->string('course_enrolled')->nullable()->after('college');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['email', 'phone', 'college', 'course_enrolled']);
        });
    }
};
