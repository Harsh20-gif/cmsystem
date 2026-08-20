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
        Schema::table('branches', function (Blueprint $table) {
            $table->string('city')->after('address')->default('');
            $table->string('state')->nullable()->after('city');
            $table->string('zip_code')->nullable()->after('state');
            $table->boolean('is_head_office')->default(false)->after('email');
            $table->renameColumn('map_embed', 'map_embed_code');
            $table->integer('order_position')->default(0)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->dropColumn(['city', 'state', 'zip_code', 'is_head_office', 'order_position']);
            $table->renameColumn('map_embed_code', 'map_embed');
        });
    }
};
