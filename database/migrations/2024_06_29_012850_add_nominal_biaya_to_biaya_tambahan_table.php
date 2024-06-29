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
        Schema::table('biaya_tambahan', function (Blueprint $table) {
            $table->string('nama_biaya')->nullable()->after('ppat_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('biaya_tambahan', function (Blueprint $table) {
            $table->dropColumn('nama_biaya');
        });
    }
};
